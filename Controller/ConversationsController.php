<?php

Router::connect('/Conversations/index', array('controller' => 'Conversations', 'action' => 'inbox'));
Router::connect('/Conversations', array('controller' => 'Conversations', 'action' => 'inbox'));
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');

class ConversationsController extends AppController{
	function beforeFilter(){
		parent::beforeFilter();
		  $this->loadModel('User');
			$this->User->contain(array('Unit'));
			$tenants = $this->User->find('all', array('conditions' => array('User.property_id' => $this->propId)));
			$this->set('tenants', $tenants);
			
		$this->Auth->deny('*');
	}

	function beforeRender(){
		parent::beforeRender();
	//	$this->set('contentheader', 'messages_nav');
	}
	
	function inbox(){

if($this->Auth->user('unit_id') == 0)
                  $this->set('unassigned',true);
                else
                  $this->set('unassigned',false);



		$this->loadModel('ConversationsUser');
		$this->Paginator->settings = array(
			'ConversationsUser' => array(
				//'limit' => Configure::read('RS.MsgsPerPage'),
				'order' => array('ConversationsUser.last_msg_time' => 'DESC'),
				'contain' => array('Conversation' => array('Sender' => array('Unit','Property'=>array('fields'=>'name'))))
				)
			);

		$data = $this->paginate('ConversationsUser', array('ConversationsUser.user_id' => $this->Auth->user('id'), 'ConversationsUser.last_msg_time !=' => NULL));
		$this->set('msgs', $data);
		
	}
        
        /*
         * If a PM is responding to messages, the property name becomes ambiguous, as he may
         *  have multiple properties... So we take the conversation_id, and find the first user 
         *  who is of type tenant, and get the property_id based on the tenant...
         * This assumes this conversation is confined to tenants of the same property, which should
         *  be the case...??
         */
        /*  Not needed - much simpler.. if prop name not known due to above, just use curProp data
            as PM can only look at stuff for one property at a time, so we know the prop already
            -  see view -- using curProp
        function getPropName($id)
        {
           $this->loadModel('ConversationsUser');
           $thePropId = $this->ConversationsUser->find('first',array('conditions' => array('conversation_id' => $id, 'User.type' => '1'), 'contain' => array('User' => array('fields'=> 'id','property_id'))));
          debug($thePropId['User']['property_id']);
          $this->Property->contain();
          $thePropName = $this->Property->find('all', array('conditions' => array ('id' => $thePropId['User']['property_id']), 'fields' => array('name')));
          return($thePropName['0']['Property']['name']);
	}
        */

	function outbox(){
		$this->loadModel('Message');
		$this->Paginator->settings = array(
			'Message' => array(
				'limit' => Configure::read('RS.MsgsPerPage'),
				'order' => array('Message.created' => 'DESC'),
				'group' => array('Message.conversation_id'),
				'contain' => array(
				'Conversation' => array(
				  'ConversationsUser' => array(
				    'User' => array(
				      'fields'=>array('id','first_name','last_name','type','property_id'),
				      'Unit' => array('fields'=>'number'),
				      'Property'=>array(
				        'fields'=>array('name')
				      )
				    )
				  ),
				  'Sender' => array('Unit')))
				)
			);

		$msgs = $this->paginate('Message', array('Message.sender_id' => $this->Auth->user('id')));
		$this->set('msgs', $msgs);
	}

	function view($id = null){
		if($id != null){
			$conv = $this->Conversation->get($id, $this->Auth->user('id'));
			$this->loadModel('ConversationsUser');
			$this->ConversationsUser->status($id, $this->Auth->user('id'), MSG_STATUS_READ);
			$this->set('conv', $conv);
		}
	}

	function send($id = null,$prevConvId=null,$convTitle=null)
        {
            /*
             *  if no post data, but $id begins with 'sortby', we are coming from a link on the user list
             *   header to sort data by either unit or user (first name), so reloading page and using this data
             *   to manipulate the order by conditions
             */
            if(!empty($this->request->data))
            {
                $from = $this->Auth->user('id');
                $this->loadModel('Message');
                $this->Message->set( $this->request->data );
                if($this->Message->validates())
                {
                    $convId = null;
                    $to     = array();
                    if(isset($this->request->data['Message']['conversation_id']))
                    {
                        $convId = $this->request->data['Message']['conversation_id'];
                    }
                    else
                    {
                        $this->loadModel('User');
                        $this->User->contain();
    			        	
                        $userList = $this->request->data['Message']['to'];
    				
                        foreach($userList as $key => $val)
                        {
                            $userList[$key] = trim($val);
                        }

                        $toUsers = $this->User->find('all', array('conditions' => array('User.username' => $userList), 'fields' => array('User.id')));
    
                        foreach($toUsers as $user)
                        {
                            array_push($to, $user['User']['id']);
                        }
                    }
                    if($this->Message->send($from, $to, $this->request->data['Message']['title'], $this->request->data['Message']['content'], $convId))
                    {
                        $this->__sendMessageNotification($convId,$to,$from,$this->request->data['Message']['title'],$this->request->data['Message']['content']);
                        $this->Session->setFlash('Message sent!','flash_good');
                        $this->redirect(array('controller' => 'Conversations', 'action' => 'inbox'));
                    }
                }
                else 
                {
                    $this->Session->setFlash('Please complete all fields.','flash_bad');
                }
            }
            else
            {
                if (substr($id,0,6) == "sortby")
                {
                   $sortby = substr($id,6);
                   $id = "";
                }
                else
                {
                   $sortby = "unit";
                }
                switch ($sortby)
                {
                   case 'name':
                      $orderary1 = array('User.first_name','User.unit_id');
                      $orderary2 = array('User.first_name','CAST(Unit.number as UNSIGNED) ASC');
                      break;
                   default:
                      $orderary1 = array('User.unit_id','User.first_name');
                      $orderary2 = array('CAST(Unit.number as UNSIGNED) ASC','User.first_name');
                      break;
                }
        
                $this->loadModel('User');
                $this->User->contain(array('Unit'));
                //Find all tenants
                $tenants = $this->User->find('all', array(
                   'conditions' => array('User.property_id' => $this->propId),
                   'order' => $orderary1,
                   'order' => $orderary2
                ));
                //$this->set('tenants', $tenants);

                //Find Property Manager
                $manager = $this->User->Property->find('first', array(
                    'conditions' => array('Property.id' => $this->propId),
                    'contain' => array('Manager')
                  ));
                $this->set('manager', $manager);
	


	        $userList = array();
                $unassignedList = array();
		if(isset($manager))
                {  
                   $excludeEmail = "";
                   if ($manager['Manager']['username'] == $this->Auth->user('email') && $this->Auth->user('type') != "1")
                   {
                      $excludeEmail = "excludeEmail";
                   }
                   array_push($userList, array('<a id="'.$excludeEmail.'" class="'.$manager['Manager']['username'].'" href="#"><img src="/img/bkg-man-small-black.png" alt="Property Manager"></a>', $manager['Manager']['first_name'].' ' .$manager['Manager']['last_name']));
                }
      	
      	        //Order these to display Unassigned units 
		foreach($tenants as $tenant){
                        $excludeEmail = "";
                        if ($tenant['User']['username'] == $this->Auth->user('email') && $this->Auth->user('type') == "1")
                        {
                           $excludeEmail = "excludeEmail";
                        }
			$number = '';
			if(isset($tenant['Unit']['number'])){
				$number = $tenant['Unit']['number'];

				//Set to main list
				array_push($userList,  array($number,'<a id="'.$excludeEmail.'" class="'.$tenant['User']['username'].'" href="#">' .$tenant['User']['first_name'].' ' .$tenant['User']['last_name'] . '</a>'));
			} else {

				$number = '(Unassigned)';
				
                                if ($sortby == "name")
                                {
				   //Set to main list
				   array_push($userList,  array($number,'<a id="'.$excludeEmail.'" class="'.$tenant['User']['username'].'" href="#">' .$tenant['User']['first_name'].' ' .$tenant['User']['last_name'] . '</a>'));
                                }
                                else
                                {
				   //Set to unassigned list
				   array_push($unassignedList,  array($number,'<a id="'.$excludeEmail.'" class="'.$tenant['User']['username'].'" href="#">' .$tenant['User']['first_name'].' ' .$tenant['User']['last_name'] . '</a>'));

                                }
			}
		}

                if ($sortby != "name")
                {
                    //Merge the lists putting unassigned at the end
                    foreach( $unassignedList as $unassignedUser )
                    {
                        array_push( $userList, $unassignedUser );
                    }
                }

                $this->set(compact('userList'));




                if($id != null && $id !=0)
                {
                    $user = $this->User->get($id);
                    if($user)
                    { 
                        $this->set('toPrefill', $user);
                    }
                }
                if($prevConvId != null && $prevConvId !=0)
                {
                    // Need sender_id because Sean doesn't want sender's email in reply to list
                    //  doesn't work in all cases as this is the original sender, not 'last' sender
                    //$this->Conversation->contain();
                    //$convInfo = $this->Conversation->findById($prevConvId);
                    //$senderId = $convInfo['Conversation']['sender_id'];

                    $this->loadModel('ConversationsUser');
                    $this->set('recipients', $this->ConversationsUser->find('all',array(
                      //'conditions'=>array('ConversationsUser.conversation_id'=>$prevConvId),
                      'conditions'=>array('ConversationsUser.conversation_id'=>$prevConvId,
                                          'ConversationsUser.user_id <>'=>$this->Auth->user('id')),
                      'fields'=>array('user_id'),
                      'contain'=>array('Conversation'=>array('fields'=>'sender_id'),'User'=>array('fields'=>'username')))));
                }
                if($convTitle != null)
                {
		    $this->set('convTitle',$convTitle);
		}
            }
            $tenant_email = $this->User->find('all',array('fields' => array('User.first_name', 'User.last_name', 'User.username'),'conditions' => array('User.property_id' => $this->propId)));
            $tenant_email = Set::combine($tenant_email, '{n}.User.username', array('{0} {1}', '{n}.User.first_name', '{n}.User.last_name'));
            $this->set('tenant_email',$tenant_email);
	}

	
	 private function __sendMessageNotification($convId = null,$userIds=null,$fromUser=null,$title=null,$message=null) 
  	{
        $this->loadModel('User');
  			$from = Configure::read('RentSquare.supportemail');
  			$sender = $this->User->findById($fromUser);
  			$sender_name = $sender['User']['first_name'] . ' ' . $sender['User']['last_name'];
  			$user_ids = array();
  			//If Conversation already exists
  	    if($convId != null){
    	    $this->loadModel('ConversationsUser');
    	    $users = $this->ConversationsUser->find('all',array('conditions'=>array('ConversationsUser.conversation_id'=>$convId),'fields'=>array('user_id')));
    	    foreach($users as $user){
    	      array_push($user_ids,$user["ConversationsUser"]['user_id']);
    	    }
    	    
    	  } else {
      	  $user_ids = $userIds;
    	  }
    	  //send email to each user if they have the send email notification checked
    	  foreach($user_ids as $user_id){
    	      if($user_id != $fromUser){
    	      $this->User->contain();
    	      $user = $this->User->findById($user_id);
    	      if($user['User']['email_for_messages']){
      	        try{
                  $email = new CakeEmail();
            			$email->domain('rentsquaredev.com');
            			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
            			$email->template('newmessagenotification', 'generic')
            				->emailFormat('html')
            				->from(array($from => 'RentSquare Support'))
            				->to($user['User']['email'])
            				//->to('nick@yolodesign.com')
            				->subject('New Message - RentSquare')
                    ->viewVars(array(
          					  'fromUser' => $sender_name,
          					  'title' => $title,
          					  'message' => $message
          					))
            				->send();
                  } catch(Exception $e){
                    //return false;
                  }
    	      }
    	      }
    		}    
    			return true;
    			
    }
    
};
?>
