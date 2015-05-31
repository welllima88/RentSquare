<?php
  Configure::write('MaintenanceTickets.status', array('Open' => 'Open', 'Pending' => 'Pending', 'Closed' => 'Closed'));
  App::uses('CakeEmail', 'Network/Email');
  Configure::write('RentSquare.supportemail', 'support@rentsquare.co');

   class MaintenanceTicketsController extends AppController{
      function beforeFilter(){
         parent::beforeFilter();

         $this->Auth->deny('*');
      }

		function index(){
			$this->MaintenanceTicket->contain(array('Tenant' => array('Unit')));

			$conditions = array();		
			if($this->Auth->user('type') == USER_TYPE_MANAGER){
				$this->view = 'index_manager';
				$conditions['MaintenanceTicket.property_id'] = $this->propId;
			}
			else
				$conditions['MaintenanceTicket.tenant_id'] = $this->Auth->user('id');

			$this->Paginator->settings = array(
			'MaintenanceTicket' => array(
				'limit'   => Configure::read('RS.TicketsPerPage'),
				'order'   => array('MaintenanceTicket.created' => 'DESC'),
				'contain' => array('Tenant' => array('Unit'))
				)
			);

			$this->set('tickets', $this->paginate('MaintenanceTicket', $conditions));
			
		}

		function create(){
			if(!empty($this->request->data)){
				$data = $this->request->data;

				$data['MaintenanceTicket']['property_id'] = $this->propId;
				$data['MaintenanceTicket']['tenant_id']   = $this->Auth->user('id');
				$data['MaintenanceTicket']['status']      = 'Open';
        
        //Image File Info in $data['MaintenanceTicket']['image_file']
        if(isset($data['MaintenanceTicket']['image_file']) && $data['MaintenanceTicket']['image_file']['tmp_name'] != ""):
          
          //Upload Restaurant Logo
          $results = $this->uploadphoto($data['MaintenanceTicket']['image_file']);
  
          //If Upload was sucess (not an error)
          if(!isset($results['error'])):
            $data['MaintenanceTicket']['image_url'] = $results['image_path'];
          endif;
        endif;
        
        //Image File Info in $data['MaintenanceTicket']['image_file']
        if(isset($data['MaintenanceTicket']['image_file_2']) && $data['MaintenanceTicket']['image_file_2']['tmp_name'] != ""):
          
          //Upload Restaurant Logo
          $results = $this->uploadphoto($data['MaintenanceTicket']['image_file_2']);
  
          //If Upload was sucess (not an error)
          if(!isset($results['error'])):
            $data['MaintenanceTicket']['image_url_2'] = $results['image_path'];
          endif;
        endif;
        
        //Image File Info in $data['MaintenanceTicket']['image_file']
        if(isset($data['MaintenanceTicket']['image_file_3']) && $data['MaintenanceTicket']['image_file_3']['tmp_name'] != ""):
          
          //Upload Restaurant Logo
          $results = $this->uploadphoto($data['MaintenanceTicket']['image_file_3']);
  
          //If Upload was sucess (not an error)
          if(!isset($results['error'])):
            $data['MaintenanceTicket']['image_url_3'] = $results['image_path'];
          endif;
        endif;
        
        //Image File Info in $data['MaintenanceTicket']['image_file']
        if(isset($data['MaintenanceTicket']['image_file_4']) && $data['MaintenanceTicket']['image_file_4']['tmp_name'] != ""):
          
          //Upload Restaurant Logo
          $results = $this->uploadphoto($data['MaintenanceTicket']['image_file_4']);
  
          //If Upload was sucess (not an error)
          if(!isset($results['error'])):
            $data['MaintenanceTicket']['image_url_4'] = $results['image_path'];
          endif;
        endif;
            
				if($this->MaintenanceTicket->save($data)){
					$this->Session->setFlash('Maintenance request submitted successfully','flash_good');

          //Get User -> Property -> Manager Data
          $this->loadModel('User');
          $user_details = $this->User->find('all',array('conditions'=>array('User.id'=>$this->Auth->user('id')),'contain'=>array('Unit','Property' => array('Manager'))));
          
					$this->__sendMaintenanceNotification($data,$user_details,$this->MaintenanceTicket->id,$this->Auth->user('id'));
					$this->redirect(array('controller' => 'MaintenanceTickets', 'action' => 'index'));
				}
				else
					$this->Session->setFlash('Sorry, there was an error submitting your request.  Please try again');
			}
		}

		function view($id){
			$this->MaintenanceTicket->contain(array('Tenant' => array('Unit')));
			$ticket = $this->MaintenanceTicket->get($id, $this->Auth->user(), $this->propId);
			if($ticket){
				if($ticket['MaintenanceTicket']['property_id'] == $this->propId){
					if($this->Auth->user('type') == USER_TYPE_MANAGER){
						$this->MaintenanceTicket->contain(array('Tenant' => array('Unit')));
						$tickets = $this->MaintenanceTicket->findAllForProperty($this->propId);
						$this->set('tickets', $tickets);
						$this->view = 'view_manager';
					}

					$this->set('ticket', $ticket);
					return;
				}
				else
					$this->Session->setFlash("You do not have access to that maintenance ticket.  Are you currently managing the right property?");
			}
			else
				$this->Session->setFlash("Sorry, that maintenance ticket does not exist in our system");

			$this->redirect($this->referer());
		}

		function update(){
			if(!empty($this->request->data)){
				$ticket = $this->MaintenanceTicket->get($this->request->data['MaintenanceTicket']['id'], $this->Auth->user(), $this->propId);
				if($ticket){
					$ticket['MaintenanceTicket']['status'] = $this->request->data['MaintenanceTicket']['status'];
					if($this->MaintenanceTicket->save($ticket)){
    				                $this->Session->setFlash(__('Ticket updated successfully'),'flash_good');
					}
					else
						$this->Session->setFlash('An error occurred while trying to save this ticket.  Please try again.');
				}
				else
					$this->Session->setFlash('You do not have access to modify that ticket');
			}

			if(!$this->RequestHandler->isAjax())
				$this->redirect($this->referer());
		}
		
		private function __sendMaintenanceNotification($data,$user_details,$ticket_id)
  	{

  			$from = Configure::read('RentSquare.supportemail');
  			$emailTo = "";
  			foreach($user_details as $property_manager):
  			  $emailTo = $property_manager['Property']['Manager']['email'] . ', ';
  			endforeach;
  			$emailTo = rtrim($emailTo,', ');
        try{
          $email = new CakeEmail();
    			$email->domain('rentsquaredev.com');
    			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
    			$email->template('newmaintenance', 'generic')
    				->emailFormat('html')
    				->from(array($from => 'RentSquare Support'))
    				->to($emailTo)
    				->subject('New Maintenance Ticket - RentSquare')
    				->viewVars(array(
  					  'data'   => $data,
  					  'user_details' => $user_details,
  					  'ticket_id' => $ticket_id
  					))
    				->send();
        } catch(Exception $e){
          return false;
        }
    			    
    			return true;
    			
    }

	};
?>
