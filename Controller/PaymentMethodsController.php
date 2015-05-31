<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('Security', 'Utility');
App::build(array('Vendor' => array(APP . 'Vendor' . DS . 'BaseCommerce' . DS)));
App::uses('BaseCommerceClient', 'Vendor');
App::uses('BankCard', 'Vendor');
App::uses('Address', 'Vendor');

/**
 * PaymentMethods Controller
 *
 * @property PaymentMethod $PaymentMethod
 */
class PaymentMethodsController extends AppController {

public function testapi(){

		$o_bcpc = new BaseCommerceClient( RENTSQUARE_MERCH_USER, RENTSQUARE_MERCH_PASS, RENTSQUARE_MERCH_KEY );
		
    $o_bcpc->setSandbox( BC_SANDBOXVALUE );

    $o_address = new Address();
    $o_address->setName(Address::$XS_ADDRESS_NAME_BILLING);
    $o_address->setLine1("123 Some Address");
    $o_address->setCity("Tempe");
    $o_address->setState("AZ");
    $o_address->setZipcode("12345");

    $o_bc = new BankCard();
    $o_bc->setBillingAddress($o_address);
    $o_bc->setExpirationMonth("02");
    $o_bc->setExpirationYear("2015");
    $o_bc->setName("Nick 2");
    $o_bc->setNumber("4111111111111111");
    
    $o_bc->setToken("myToken12asdfas3");

    $o_bc = $o_bcpc->addBankCard( $o_bc );

    if( $o_bc->isStatus(BankCard::$XS_BC_STATUS_FAILED ) ) {
        //the add Failed, look at messages array for reason(s) why
        //var_dump( $o_bc->getMessages() );
        $this->set('message',$o_bc->getMessages());
    } else if( $o_bc->isStatus(BankCard::$XS_BC_STATUS_ACTIVE ) ) {
        //Card added successfully
        //var_dump( $o_bc->getToken() );
                $this->set('message',$o_bc->getToken());

    }     
}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PaymentMethod->recursive = 0;
		$this->set('paymentMethods', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PaymentMethod->id = $id;
		
		if (!$this->PaymentMethod->exists()) {
			throw new NotFoundException(__('Invalid payment method'));
		}
		$this->set('paymentMethod', $this->PaymentMethod->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add_cc() {
	
	  $this->loadModel('State');
	  $this->State->recursive = -1;

	  $user_id = $this->Auth->user('id');
	  $this->loadModel('User');
	  $user = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id),'contain'=> array('Property' => array('fields'=>array('pp_user','pp_pass')))));

          if ($this->request->is('post')) {
             $this->PaymentMethod->create();
             $data = $this->request->data;
             $vault_id = $user['User']['id'] . date('ymdHis',time());
             // Responses:
             //  1: Customer Added
             //  1: Customer Deleted 
             //  3: Invalid Customer Vault Id
             //  3: Duplicate Customer Vault Id      
             $url = 'https://gateway.teledraft.com/api/transact.php';
             
             //Get State Name
             $state_name = $this->State->findById($data['PaymentMethod']['billing_state_id']);
             
             //Get Phoenix Payment Password
             $pp_password = Security::rijndael($user['Property']['pp_pass'], Configure::read('Security.salt2'),'decrypt');
     
             // While in Test mode, we need to use test creds here too
             $isDebug = RENTSQUARE_MERCH_USER;
             if ($isDebug  == "demo")
             {
                $user['Property']['pp_user'] = "demo"; 
                $pp_password = "password";
             }

             $fields = array( 
     
               //Set Variables To Pass To Phoenix Payments
               'username'=>urlencode($user['Property']['pp_user']),
               'password'=>urlencode($pp_password),
               'customer_vault'=>urlencode('add_customer'),
               'customer_vault_id'=>urlencode($vault_id),
               'ccnumber' => urlencode($data['PaymentMethod']['card_number']),
               'ccexp' => urlencode($data['PaymentMethod']['expire_dt_month'] .'/'. substr($data['PaymentMethod']['expire_dt_year']['year'],2,2 )),
               'first_name'=>urlencode($data['PaymentMethod']['first_name']),
               'last_name'=>urlencode($data['PaymentMethod']['last_name']),
               'address1'=>urlencode($data['PaymentMethod']['billing_address1']),
               'address2'=>urlencode($data['PaymentMethod']['billing_address2']),
               'city'=>urlencode($data['PaymentMethod']['billing_city']),
               'state'=>urlencode($state_name['State']['full_name']),
               'zip'=>urlencode($data['PaymentMethod']['billing_zip']),
               'country'=>urlencode('USA'),
               'phone'=>urlencode($user['User']['phone']),
               'email'=>$user['User']['email']

             );
        
             //url-ify the data for the POST
             $fields_string = '';
             foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
             $fields_string = rtrim($fields_string,'&');
             //$fields_string = str_replace('-', '%2D', $fields_string);        
                
             $ch = curl_init();
             curl_setopt($ch,CURLOPT_URL,$url);
             curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
             curl_setopt($ch,CURLOPT_POST,count($fields));
             curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
             //curl_setopt($ch,CURLOPT_VERBOSE, true);
             //$verbose = fopen('./curloutput.txt', 'rw+');
             //curl_setopt($ch, CURLOPT_STDERR, $verbose);
             
             $result = curl_exec($ch);
             parse_str($result);
             curl_close($ch);
      
             //Only store last 4 digits of CC Number
             $data['PaymentMethod']['card_num'] = substr($data['PaymentMethod']['card_number'],-4,4);
             //Store Vault Id
             $data['PaymentMethod']['vault_id'] = intval($vault_id);
        
             //response comes from parse_str(result)
             if ($response == 1){
                $rs_vault_id = $user['User']['id'] . '0' . date('ymdHis',time());
	        // Responses:
                //  1: Customer Added
                //  1: Customer Deleted 
                //  3: Invalid Customer Vault Id
                //  3: Duplicate Customer Vault Id      
                $url = 'https://gateway.teledraft.com/api/transact.php';
        
                //Get State Name
                $state_name = $this->State->findById($data['PaymentMethod']['billing_state_id']);
        
                //Get Phoenix Payment Password
                $pp_password = Security::rijndael($user['Property']['pp_pass'], Configure::read('Security.salt2'),'decrypt');

                $fields = array( 

                  //Set Variables To Pass To Phoenix Payments
                  'username'=>urlencode(RENTSQUARE_MERCH_USER),
                  'password'=>urlencode(RENTSQUARE_MERCH_PASS),
                  'customer_vault'=>urlencode('add_customer'),
                  'customer_vault_id'=>urlencode($rs_vault_id),
                  'ccnumber' => urlencode($data['PaymentMethod']['card_number']),
                  'ccexp' => urlencode($data['PaymentMethod']['expire_dt_month'] .'/'. substr($data['PaymentMethod']['expire_dt_year']['year'],2,2 )),
                  'first_name'=>urlencode($data['PaymentMethod']['first_name']),
                  'last_name'=>urlencode($data['PaymentMethod']['last_name']),
                  'address1'=>urlencode($data['PaymentMethod']['billing_address1']),
                  'address2'=>urlencode($data['PaymentMethod']['billing_address2']),
                  'city'=>urlencode($data['PaymentMethod']['billing_city']),
                  'state'=>urlencode($state_name['State']['full_name']),
                  'zip'=>urlencode($data['PaymentMethod']['billing_zip']),
                  'country'=>urlencode('USA'),
                  'phone'=>urlencode($user['User']['phone']),
                  'email'=>$user['User']['email']

                );
        
                //url-ify the data for the POST
                $fields_string = '';
                foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                $fields_string = rtrim($fields_string,'&');
                //$fields_string = str_replace('-', '%2D', $fields_string);        
                        
                //open connection
                $ch = curl_init();
                
                //set the url, number of POST vars, POST data
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_POST,count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
                
                //execute post
                $result = curl_exec($ch);
                parse_str($result);
                //close connection
                curl_close($ch);
                
                $data['PaymentMethod']['rs_vault_id'] = intval($rs_vault_id);
                
                if($response == 1 && $this->PaymentMethod->save($data))
                {
                   $this->Session->setFlash(__('The payment method has been saved'),'flash_good');
                   //$this->redirect(array('controller'=>'Users', 'action' => 'myaccount','payment_method'));
                   if(isset($_SESSION['page_referer']))
                   {
                      $this->redirect($_SESSION['page_referer'].'?id='.$vault_id);
                   }
                   else
                   {
                      $this->redirect($this->referer().'?id='.$vault_id);
                   }
                }
                else
                {
                   $this->Session->setFlash(__('The payment method could not be saved. Please, try again.'),'flash_bad');
                }
             } 
             else
             {
                debug($result);
                $this->Session->setFlash(__('The payment method could not be saved. Error with Vault ID.'),'flash_bad');
             }
          }
          else
          {
             if (strpos($this->referer(), 'add_bank') == FALSE && strpos($this->referer(), 'add_cc') == FALSE)
             $_SESSION['page_referer'] = $this->referer();
          }
	
        $billingStates = $this->State->find('list', array('fields' => array('State.id', 'State.full_name')));
        $this->set(compact('billingStates', 'user_id','user'));
        }

/**
 * add method
 *
 * @return void
 */
	public function add_bank() {
	  $this->loadModel('User');
	  //$this->User->recursive = -1;
	  $user_id = $this->Auth->user('id');
	  $user = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id),'contain'=> array('Property' => array('fields'=>array('pp_user','pp_pass')))));

		if ($this->request->is('post')) {
			$this->PaymentMethod->create();
			$data = $this->request->data;
			$vault_id = $user['User']['id'] . date('ymdHis',time());
			  // Responses:
        //  1: Customer Added
        //  1: Customer Deleted 
        //  3: Invalid Customer Vault Id
        //  3: Duplicate Customer Vault Id      
        $url = 'https://gateway.teledraft.com/api/transact.php';
        
        //Get Phoenix Payment Password
        $pp_password = Security::rijndael($user['Property']['pp_pass'], Configure::read('Security.salt2'),'decrypt');
        
        $fields = array( 
          //Set Variables To Pass To Phoenix Payments
          'username'=>urlencode($user['Property']['pp_user']),
          'password'=>urlencode($pp_password),
          'customer_vault'=>urlencode('add_customer'),
          'customer_vault_id'=>urlencode($vault_id),
          'account_name' => urlencode($data['PaymentMethod']['first_name'] . ' ' . $data['PaymentMethod']['last_name']),
          'account' => urlencode($data['PaymentMethod']['account_number']),
          'routing'=>urlencode($data['PaymentMethod']['routing_number']),
          'account_type'=>urlencode($data['PaymentMethod']['bank_acct_type']),
          'first_name'=>urlencode($data['PaymentMethod']['first_name']),
          'last_name'=>urlencode($data['PaymentMethod']['last_name']),
          'country'=>urlencode('USA'),
          'phone'=>urlencode($user['User']['phone']),
          'email'=>urlencode($user['User']['email'])
        );
        
        //url-ify the data for the POST
        $fields_string = '';
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string,'&');
        
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        
        //execute post
        $result = curl_exec($ch);
        parse_str($result);
        //close connection
        curl_close($ch);

      //Only store last 4 digits of CC Number
      $data['PaymentMethod']['account_num'] = substr($data['PaymentMethod']['account_number'],-4,4);
      //Store Vault Id
      $data['PaymentMethod']['vault_id'] = intval($vault_id);
      
      if ($response == 1){
          $rs_vault_id = $user['User']['id'] . '0' .date('ymdHis',time());
    			  // Responses:
            //  1: Customer Added
            //  1: Customer Deleted 
            //  3: Invalid Customer Vault Id
            //  3: Duplicate Customer Vault Id      
            $url = 'https://gateway.teledraft.com/api/transact.php';
            
            //Get Phoenix Payment Password
            $pp_password = Security::rijndael($user['Property']['pp_pass'], Configure::read('Security.salt2'),'decrypt');
            
            $fields = array( 
              //Set Variables To Pass To Phoenix Payments
              'username'=>urlencode(RENTSQUARE_MERCH_USER),
              'password'=>urlencode(RENTSQUARE_MERCH_PASS),
              'customer_vault'=>urlencode('add_customer'),
              'customer_vault_id'=>urlencode($rs_vault_id),
              'account_name' => urlencode($data['PaymentMethod']['first_name'] . ' ' . $data['PaymentMethod']['last_name']),
              'account' => urlencode($data['PaymentMethod']['account_number']),
              'routing'=>urlencode($data['PaymentMethod']['routing_number']),
              'account_type'=>urlencode($data['PaymentMethod']['bank_acct_type']),
              'first_name'=>urlencode($data['PaymentMethod']['first_name']),
              'last_name'=>urlencode($data['PaymentMethod']['last_name']),
              'country'=>urlencode('USA'),
              'phone'=>urlencode($user['User']['phone']),
              'email'=>urlencode($user['User']['email'])
            );
            
            //url-ify the data for the POST
            $fields_string = '';
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string,'&');
            
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_POST,count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
            
            //execute post
            $result = curl_exec($ch);
            parse_str($result);
            //close connection
            curl_close($ch);
            
            $data['PaymentMethod']['rs_vault_id'] = intval($rs_vault_id);
            
    			if ($response == 1 && $this->PaymentMethod->save($data)) {
    				$this->Session->setFlash(__('The payment method has been saved'),'flash_good');
    				if(isset($_SESSION['page_referer']))
    				  $this->redirect($_SESSION['page_referer'].'?id='.$vault_id);
    				else
    				  $this->redirect($this->referer().'?id='.$vault_id);
    			} else {
    				$this->Session->setFlash(__('The payment method could not be saved. '.$responsetext.'. Please, try again.'),'flash_bad');
    			}
			}
			else{
  			$this->Session->setFlash(__('The payment method could not be saved. '.$responsetext.'. Please, try again.'),'flash_bad');
			}
		} else {
		  if (strpos($this->referer(), 'add_bank') == FALSE && strpos($this->referer(), 'add_cc') == FALSE)
        $_SESSION['page_referer'] = $this->referer();
		}
		$this->set(compact('user_id','user'));

	}
	
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	  $this->loadModel('State');
		$this->PaymentMethod->id = $id;
		if (!$this->PaymentMethod->exists()) {
			throw new NotFoundException(__('Invalid payment method'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PaymentMethod->save($this->request->data)) {
				$this->Session->setFlash(__('The payment method has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment method could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$this->request->data = $this->PaymentMethod->read(null, $id);
		}
		$billingStates = $this->State->find('list');
		$users = $this->PaymentMethod->User->find('list');
		$this->set(compact('billingStates', 'users'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
	  if(isset($this->request->data['PaymentMethod']['id'])){
  	  $id = $this->request->data['PaymentMethod']['id'];
	  }
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->PaymentMethod->id = $id;
		if (!$this->PaymentMethod->exists()) {
			throw new NotFoundException(__('Invalid payment method'));
		}
		if ($this->PaymentMethod->delete()) {
		  
  		$this->loadModel('Property');
  		$prop = $this->Property->findById($this->Auth->user('property_id'));
  		
  		//Get Phoenix Payment Password
      $pp_password = Security::rijndael($prop['Property']['pp_pass'], Configure::read('Security.salt2'),'decrypt');
        
      $paymentmethod['user_id'] = $id;
      $paymentmethod['pp_user'] = $prop['Property']['pp_user'];
      $paymentmethod['pp_password'] = $pp_password;
		  $this->PaymentMethod->delete_from_vault($paymentmethod);

			$this->Session->setFlash(__('Payment method deleted'),'flash_good');
			$this->redirect(array('controller'=>'Users','action' => 'myaccount','payment_methods'));
		}
		$this->Session->setFlash(__('Payment method was not deleted'),'flash_bad');
		$this->redirect(array('controller'=>'Users','action' => 'myaccount','payment_methods'));
	}
}
