<?php
//error_reporting(0);
App::uses('Sanitize', 'Utility');
App::uses('Security', 'Utility');
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');
Configure::write('Security.salt2', 'R1ysi!84$0938sbe');
App::import('Vendor', 'Paymethodutils', array('file' => 'Interfaces/PayMethods/PayMethodUtils.php'));
/* 
 * If processor ever changes, need to write a new class to the interface, and load it here
 *  The only thing to change is in the instantion -- pass the new class as an arg to Paymethodutils
 */
App::import('Vendor', 'Paymethodbasecommerce', array('file' => 'Interfaces/PayMethods/PayMethodBasecommerce.php'));

class UsersController extends AppController {

    public function index()
    {

        //Redirect ADMIN Role
        if ( $this->Auth->user('type') == USER_TYPE_ADMIN )
        {
            $this->redirect(array('controller' => 'Admin', 'action' => 'index'));
        } //Redirect pending MANAGER
        else if ( !$this->Session->check('current_property') && $this->Auth->user('type') == USER_TYPE_MANAGER )
        {
            $this->redirect(array('controller' => 'Users', 'action' => 'pendingactivation'));
        } //Redirect active MANAGER to Billing
        else if ( $this->Auth->user('type') == USER_TYPE_MANAGER )
        {
            $this->redirect(array('controller' => 'Billing', 'action' => 'index'));
        } //Set view for TENANT
        else if ( $this->Auth->user('type') == USER_TYPE_TENANT )
        {
            if ( $this->Session->check('mobile_user') && intval($this->Session->read('mobile_user')) )
            {
                $this->layout = 'mobile';
                $this->redirect(array('controller' => 'Payments', 'action' => 'index'));
            } else
            {
                $this->view = 'tenant_index';
                $this->loadModel('Billing');
                $this->set('total_balance', $this->Billing->getBalance($this->Auth->user('unit_id')));
            }
        }
        if ( $this->Auth->user('unit_id') == 0 )
            $this->set('unassigned', true);
        else
            $this->set('unassigned', false);
        $this->set('secure_id', Security::cipher($this->Auth->user('id'), Configure::read('Security.salt2')));


    }

    function visitFullSite()
    {
        $this->Session->write('mobile_user', '0');
        $this->Session->write('nomobile', '1');


        //echo '<span style="color:#fff;"><br><br>- '. $this->Session->read('mobile_user') .' -<br><br><br></span>';

        $this->redirect(array('action' => 'index'));
    }
/*
<<<<<<< HEAD
    
    //Set view for TENANT
		else if($this->Auth->user('type') == USER_TYPE_TENANT){
			if($this->Session->check('mobile_user') && intval($this->Session->read('mobile_user'))){
    	  $this->layout = 'mobile';
    	  $this->redirect(array('controller' => 'Payments', 'action' => 'index'));
  	  }else{
    	  $this->view = 'tenant_index';
    	  $this->loadModel('Billing');
    	  $this->set('total_balance', $this->Billing->getBalance($this->Auth->user('unit_id')));
  	  }
		}
		if($this->Auth->user('unit_id') == 0)
		  $this->set('unassigned',true);
		else
		  $this->set('unassigned',false);
    $this->set('secure_id',Security::cipher($this->Auth->user('id'), Configure::read('Security.salt2')));
    
    
	}
	
	function visitFullSite(){
	  $this->Session->write('mobile_user', '0');
	  $this->Session->write('nomobile', '1');
	  
  	
  	//echo '<span style="color:#fff;"><br><br>- '. $this->Session->read('mobile_user') .' -<br><br><br></span>';
  	
  	$this->redirect(array('action'=>'index'));
	}

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->deny('*');
		$this->Auth->allow(array('register', 'login', 'resendactivation', 'activate', 'requestreset', 'resetpassword', 'propertymanager', 'resident','residentsearch','getunitsfromsearch','residentsuccess','selectunit','addSignupReminder','checkuniqueemail'));
	}
	
	function view($id = null)
	{
  	if($id != null){
  	   $user_details = $this->User->find('first',array(
  	      'conditions'=>array('User.id'=> $id),
  	      'contain'=>array(
  	          'Note'=>array('conditions'=>array('creater_id'=>$this->Auth->user('id'))),
  	          'Unit'
          )
       ));
       $this->set('user_details',$user_details);
       //Get all Units for User's Property for Move to another Unit Button
       $this->loadModel('Unit');
       $this->set('units',$this->Unit->find('list',array(
  	      'conditions'=>array('Unit.property_id'=> $user_details['User']['property_id'],'Unit.id !='=> $user_details['User']['unit_id'],'Unit.active'=>1),
  	      'contain'=>array(),
  	      'fields'=>array('Unit.id','Unit.number'),
  	      'order' => 'Unit.number + 0'
          )
       ));
*/

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny('*');
        $this->Auth->allow(array('register', 'login', 'resendactivation', 'activate', 'requestreset', 'resetpassword', 'propertymanager', 'resident', 'residentsearch', 'getunitsfromsearch', 'residentsuccess', 'selectunit', 'addSignupReminder', 'checkuniqueemail'));
    }

    function view($id = null)
    {

        //$this->payutil = new Paymethodutils(new Paymethodbasecommerce);
        //$this->payutil->submitMerchantApp($junk);
        //exit;


        if ( $id != null )
        {
            $user_details = $this->User->find('first', array(
                'conditions' => array('User.id' => $id),
                'contain'    => array(
                    'Note' => array('conditions' => array('creater_id' => $this->Auth->user('id'))),
                    'Unit'
                )
            ));
            $this->set('user_details', $user_details);
            //Get all Units for User's Property for Move to another Unit Button
            $this->loadModel('Unit');
            $this->set('units', $this->Unit->find('list', array(
                    'conditions' => array('Unit.property_id' => $user_details['User']['property_id'], 'Unit.id !=' => $user_details['User']['unit_id'], 'Unit.active' => 1),
                    'contain'    => array(),
                    'fields'     => array('Unit.id', 'Unit.number'),
                    'order'      => 'Unit.number + 0'
                )
            ));
        }
    }

    function register()
    {
        $this->layout = 'register';
    }

    function propertymanager()
    {
        $this->layout = 'register';
        $this->loadModel('State');
        $states = $this->State->find('list', array('fields' => array('State.id', 'State.full_name')));

        if ( !empty($this->request->data) )
        {
            /*
             * Instantiate payment processor
             */
            $this->payutil = new Paymethodutils(new Paymethodbasecommerce);

            $this->User->set($this->request->data);
            if ( $this->User->validates() )
            {
                $this->User->create();
                $data = $this->request->data;
                // If Copy Property Ownership is checked, copy values
                foreach ( $data['Property'] as $key => $prop )
                {
                    //Default a couple options
                    $data['Property'][$key]['before_due_reminder'] = '1';
                    $data['Property'][$key]['before_due_days'] = '0';

                    //Set fee_due_day
                    $data['Property'][ $key ]['fee_due_day'] = date('j');
                    $data['Property'][ $key ]['active'] = '1';
                    $data['Property'][ $key ]['bank_acct'] = substr($data['Property'][ $key ]['bank_account_num'], - 4, 4);

                    if ( !isset($data['Property'][ $key ]['state_inc']) || $data['Property'][ $key ]['state_inc'] == '' || is_null($data['Property'][ $key ]['state_inc']) ) $data['Property'][ $key ]['state_inc'] = 1;
                    if ( !isset($data['Property'][ $key ]['business_started']) ) $data['Property'][ $key ]['business_started'] = 0;
                    if ( !isset($data['Property'][ $key ]['ownership_started']) ) $data['Property'][ $key ]['ownership_started'] = 0;
                    if ( isset($data['Property'][ $key ]['name']) ) $data['Property'][ $key ]['legal_dba'] = $data['Property'][ $key ]['name'];

                    if ( isset($prop['previous_ownership']) )
                    {
                        if ( $prop['previous_ownership'] == 'use_previous_ownership' )
                        {
                            $copy_key = $data['Property'][ $key ]['prev_ownership'];
                            $data['Property'][ $key ]['ownership_type'] = $data['Property'][ $copy_key ]['ownership_type'];
                            $data['Property'][ $key ]['legal_name'] = $data['Property'][ $copy_key ]['legal_name'];
                            $data['Property'][ $key ]['legal_dba'] = $data['Property'][ $copy_key ]['legal_dba'];
                            $data['Property'][ $key ]['legal_street'] = $data['Property'][ $copy_key ]['legal_street'];
                            $data['Property'][ $key ]['legal_city'] = $data['Property'][ $copy_key ]['legal_city'];
                            $data['Property'][ $key ]['legal_state_id'] = $data['Property'][ $copy_key ]['legal_state_id'];
                            $data['Property'][ $key ]['legal_zip'] = $data['Property'][ $copy_key ]['legal_zip'];
                            $data['Property'][ $key ]['legal_phone'] = $data['Property'][ $copy_key ]['legal_phone'];
                            $data['Property'][ $key ]['legal_fax'] = $data['Property'][ $copy_key ]['legal_fax'];
                            $data['Property'][ $key ]['legal_website'] = $data['Property'][ $copy_key ]['legal_website'];
                            $data['Property'][ $key ]['legal_ein'] = $data['Property'][ $copy_key ]['legal_ein'];
                            $data['Property'][ $key ]['state_inc'] = $data['Property'][ $copy_key ]['state_inc'];
                            $data['Property'][ $key ]['business_started'] = $data['Property'][ $copy_key ]['business_started'];
                            $data['Property'][ $key ]['ownership_started'] = $data['Property'][ $copy_key ]['ownership_started'];
                        }
                    }
                    // If Copy Bank Account is checked, copy values
                    if ( isset($prop['previous_bank']) )
                    {
                        if ( $prop['previous_bank'] == 'use_prev_bank' )
                        {
                            $copy_key = $data['Property'][ $key ]['prev_bank'];
                            $data['Property'][ $key ]['bank_name'] = $data['Property'][ $copy_key ]['bank_name'];
                            $data['Property'][ $key ]['routing_number'] = $data['Property'][ $copy_key ]['routing_number'];
                            //$data['Property'][$key]['confirm_routing_number'] = $data['Property'][$copy_key]['confirm_routing_number'];
                            $data['Property'][ $key ]['bank_account_num'] = $data['Property'][ $copy_key ]['bank_account_num'];
                            //$data['Property'][$key]['verify_bank_account_num'] = $data['Property'][$copy_key]['verify_bank_account_num'];
                            $data['Property'][ $key ]['bank_account_type'] = $data['Property'][ $copy_key ]['bank_account_type'];
                            $data['Property'][ $key ]['vault_id'] = $data['Property'][ $copy_key ]['vault_id'];
                        }
                    } else
                    {
                        /*  
                         * PaymentProcessor API
                         *
        	         * Save Bank To Vault
        		 * Add Property Manager's bank account to the Vault
                         */
                        $paymentmethod = array();
                        $paymentmethod['first_name'] = $data['User']['first_name'];
                        $paymentmethod['last_name'] = $data['User']['last_name'];
                        $paymentmethod['account_number'] = $data['Property'][ $key ]['bank_account_num'];
                        $paymentmethod['routing_number'] = $data['Property'][ $key ]['routing_number'];
                        $paymentmethod['bank_acct_type'] = $data['Property'][ $key ]['bank_account_type'];
                        $paymentmethod['phone'] = $data['User']['phone'];
                        $paymentmethod['email'] = $data['User']['email'];
                        $paymentmethod['user_id'] = '874'; //Random - only used to gen vault id
                        list($banksave_status, $banksave_result) = $this->payutil->addBankToVault($paymentmethod);

                        // Log bc results
                        $bcr = array();
                        $bcr['users_id'] = $paymentmethod['user_id'];
                        $bcr['result_code'] = $banksave_status;
                        $bcr['result_string'] = json_encode($banksave_result);
                        $bcr['transtype'] = "add Bank Acct";
                        $bcr['request'] = json_encode($paymentmethod);
                        $this->loadModel('Bcresult');
                        $this->Bcresult->create();
                        $this->Bcresult->save($bcr);

                        if ( $banksave_status == 1 )
                        {
                            $data['Property'][ $key ]['vault_id'] = $banksave_result;
                            $this->log('Success: Vault add prop mgr - token = ' . $banksave_result, 'debug' );

                            $pmdata = array();
                            $pmdata['PaymentMethod']['vault_id'] = $banksave_result;
                            $pmdata['PaymentMethod']['first_name'] = $paymentmethod['first_name'];
                            $pmdata['PaymentMethod']['last_name'] = $paymentmethod['last_name'];
                            $pmdata['PaymentMethod']['routing_number'] = $paymentmethod['routing_number'];
                            $pmdata['PaymentMethod']['account_num'] = substr($paymentmethod['account_number'], - 4, 4);
                            $pmdata['PaymentMethod']['bank_name'] = $data['Property'][$key]['bank_name'];
                            $pmdata['PaymentMethod']['description'] = $data['User']['company_name'];
                            $pmdata['PaymentMethod']['default_method'] = '1';
                            $pmdata['PaymentMethod']['type'] = "ACH";

                            $this->loadModel('PaymentMethod'); 
                            $this->PaymentMethod->create();
                            if ( $this->PaymentMethod->save($pmdata) )
                            {
                            }

                        } else
                        {
                            //On fail, set vault_id = 1
                            $data['Property'][ $key ]['vault_id'] = 1;
                            //$this->log( 'Fail: Vault add prop mgr - ' . var_dump($banksave_result), 'PmtProcesing' );
                        }
                    }
                    //Get Timezone Id For each property
                    $city = $data['Property'][ $key ]['address'] . ', ' . $data['Property'][ $key ]['city'] . ', ' . $states[ $data['Property'][ $key ]['state_id'] ];
                    $timezone = $this->timezone_lookup($this->geocode_lookup($city));
                    //$utc_offset = $timezone['rawOffset'];
                    //$daylight_offset = $timezone['dstOffset'];
                    $data['Property'][ $key ]['timezone'] = $timezone['timeZoneId'];

                } // foreach property

                $data['User']['username'] = $data['User']['email'];
                $data['User']['is_activated'] = true;
                $data['User']['type'] = USER_TYPE_MANAGER;
                $data['User']['activation_key'] = $this->User->genActivationHash();
                $data['User']['password'] = AuthComponent::password($data['User']['password_orig']);


                //Save Property Manager in Database
                $this->log('User Controller pre save assoc: ', 'debug' );
                if ( $this->User->saveAssociated($data) )
                {
                    $newUserId = $this->User->getLastInsertID();
                    $this->log('User Controller save succes: ' . $newUserId, 'debug' );

                    $bcrsl = $this->payutil->submitMerchApp( $data );
                    $this->log('Merchant App Results: ' . json_encode($bcrsl), 'debug' );

                    // Log bc results
                    $bcr = array();
                    $bcr['users_id'] = $newUserId;
                    $bcr['result_code'] = $bcrsl[0];
                    $bcr['result_string'] = json_encode($bcrsl);
                    $bcr['transtype'] = "add Merch App";
                    $bcr['request'] = json_encode($data);
                    $this->loadModel('Bcresult');
                    $this->Bcresult->create();
                    $this->Bcresult->save($bcr);

                    if ($bcrsl[0])
                    {
                       $this->Auth->login($data['User']);		// not necessary - sending to login screen 
                       $this->redirect(array('controller' => 'Users', 'action' => 'pendingactivation', $newUserId));
                    }
                    else
                    {
                        $this->Session->setFlash('Error Signing Up. Please contact system admin.', 'flash_bad');
                        $this->redirect(array('controller' => 'Users', 'action' => 'propertymanager'));
                    }
                } else
                {
                    $this->Session->setFlash('Error Signing Up. Please contact system admin.', 'flash_bad');
                    $this->redirect(array('controller' => 'Users', 'action' => 'propertymanager'));
                }
            } else
            {
                //$errors = $this->User->invalidFields();
                $this->Session->setFlash('Please enter all required fields', 'flash_bad');
            }
        }

        $this->set('states', $states);
        $this->set('one_month_date', $this->add_month(date("F j, Y"), 1));

        $MONTHLY_25_OR_LESS = MONTHLY_25_OR_LESS;
        $MONTHLY_26_TO_50 = MONTHLY_26_TO_50;
        $MONTHLY_51_TO_100 = MONTHLY_51_TO_100;
        $MONTHLY_101_TO_200 = MONTHLY_101_TO_200;
        $MONTHLY_201_TO_300 = MONTHLY_201_TO_300;
        $MONTHLY_301_TO_400 = MONTHLY_301_TO_400;
        $MONTHLY_OVER_400 = MONTHLY_OVER_400;
        $this->set(compact('MONTHLY_25_OR_LESS', 'MONTHLY_26_TO_50', 'MONTHLY_51_TO_100', 'MONTHLY_101_TO_200', 'MONTHLY_201_TO_300', 'MONTHLY_301_TO_400', 'MONTHLY_OVER_400'));
    }

    function addByInvite()
    {
        if ( !empty($this->request->data) )
        {
            $this->User->set($this->request->data);
            if ( $this->User->validates() )
            {
                $this->User->create();
                $data = $this->request->data;
                $data['User']['username'] = $data['User']['email'];
                $data['User']['is_activated'] = false;
                $data['User']['type'] = USER_TYPE_TENANT;
                $data['User']['activation_key'] = $this->User->genActivationHash();
                $passwd = $this->randomPassword();
                $data['User']['password'] = AuthComponent::password($passwd);
                $data['User']['invitebyemail'] = true;
                //$data['User']['phone'] = preg_replace("/[^0-9]/","",$data['User']['phone']);
                if ( $this->User->save($data) )
                {
                    //$this->Session->setFlash('Thank you for registering! Please search for your property.','flash_good');
                    $this->loadModel('Property');
                    $property = $this->Property->find('first', array('conditions' => array('Property.id' => $data['User']['property_id']), 'contain' => array()));
                    if ( $this->__sendTenantInvite($data['User']['email'], $passwd, $this->User->id, $property, $data['User']['unit_number']) )
                    {
                        $this->Session->setFlash('Invite Sent.', 'flash_good');

                        /*
                         * Update the unit to occupied after the invite is sent.
                         * 2014-09-29 - As per new requirements, only update as occupied when invited if the user 
                         *    activates their account... The invite itself should NOT trigger unit as occupied
                        */
                        //$this->loadModel('Unit');
                        //$this->Unit->id = $data['User']['unit_id'];
                        //$this->Unit->saveField('occupied','Yes');

                        $this->redirect(array('controller' => 'Units', 'action' => 'edit', $data['User']['unit_id']));
                    }
                } else
                {
                    $this->Session->setFlash('Error Signing Up. Please contact system admin.', 'flash_bad');
                    $this->redirect(array('controller' => 'Units', 'action' => 'edit', $data['User']['unit_id']));
                }
            } else
            {
                $this->Session->setFlash('Sorry, please fill out all fields and provide a unique email address.', 'flash_bad');
                $this->redirect(array('controller' => 'Units', 'action' => 'edit', $this->request->data['User']['unit_id']));
            }
        }
    }

    function resident()
    {
        $this->layout = 'register';

        if ( !empty($this->request->data) )
        {
            $this->User->set($this->request->data);
            if ( $this->User->validates() )
            {
                $data = $this->request->data;
                $data['User']['username'] = $data['User']['email'];
                $data['User']['is_activated'] = false;
                $data['User']['type'] = USER_TYPE_TENANT;
                $data['User']['activation_key'] = $this->User->genActivationHash();
                $data['User']['password'] = AuthComponent::password($data['User']['password_orig']);
                $data['User']['phone'] = preg_replace("/[^0-9]/", "", $data['User']['phone']);
                $this->User->create();
                if ( $this->User->save($data) )
                {
                    //$this->Session->setFlash('Thank you for registering! Please search for your property.','flash_good');
                    $this->redirect(array('controller' => 'Users', 'action' => 'residentsearch', Security::cipher($this->User->id, Configure::read('Security.salt2'))));
                } else
                {
                    $this->Session->setFlash('Error Signing Up. Please contact system admin.', 'flash_bad');
                    //$this->redirect(array('controller' => 'Pages', 'action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('Please enter all required fields.', 'flash_bad');
            }
        }
    }

    function residentsearch($id = null, $prop_id = null)
    {
        $this->layout = 'register';
        $this->loadModel('Property');

        $this->set('user_string', $id);
        $this->set('user_id', Security::cipher($id, Configure::read('Security.salt2')));
        $this->set('prop_names', $this->Property->Find('all', array('fields' => 'Distinct(Property.name)', 'order' => 'Property.name', 'contain' => false)));

        if ( !empty($id) && !empty($prop_id) )
        {
            $this->User->id = Security::cipher($id, Configure::read('Security.salt2'));
            if ( $this->User->saveField('property_id', Security::cipher($prop_id, Configure::read('Security.salt2'))) )
            {
                $this->redirect(array('controller' => 'Users', 'action' => 'selectunit', $id, $prop_id));
            } else
            {
                $this->Session->setFlash('Error Signing Up. Please contact system admin.', 'flash_bad');
            }
        }

    }

    function getunitsfromsearch($id = null)
    {
        $this->layout = 'ajax';
        $this->loadModel('Property');
        $this->loadModel('State');

        $s_properties = array();

        $this->set('user_id', $id);

        $options['order'] = array('Property.address ASC');
        if ( !empty($this->request->data) )
        {

            $search_field = $this->request->data['User']['search'];

            $q = Sanitize::escape($search_field);

            $options['conditions'] = array("OR" => array("Property.address LIKE" => '%' . $q . '%', "Property.city LIKE" => '%' . $q . '%', "Property.zip LIKE" => '%' . $q . '%', "Property.name LIKE" => '%' . $q . '%', "SOUNDEX(Property.name)" => soundex($q)));
            if ( $this->Property->find('count', $options) )
            {
                $this->set('s_properties', $this->Property->find('all', $options));
            } else
            {
                $options['conditions'] = array(
                    "MATCH(Property.address,Property.city,Property.zip,Property.name)
          AGAINST('$q' IN BOOLEAN MODE)"
                );

                $this->set('s_properties', $this->Property->find('all', $options));
            }
            $this->State->recursive = - 1;
            $this->set('states', $this->State->find('list', array('fields' => array('State.id', 'State.abbr'))));

        }
    }

    function selectunit($user_id = null, $prop_id = null)
    {
        $this->layout = 'register';
        $this->loadModel('Property');
        $this->loadModel('Unit');
        $this->loadModel('State');

        $property_id = Security::cipher($prop_id, Configure::read('Security.salt2'));

        $user_id = Security::cipher($user_id, Configure::read('Security.salt2'));
        $prop_id = $property_id;
        $property = $this->Property->find('first', array('conditions' => array('Property.id' => $property_id)));
        $unit_list = $this->Unit->find('list', array('fields' => array('id_number', 'Unit.number'), 'order' => array('CAST(Unit.number as UNSIGNED) ASC', 'Unit.number ASC'), 'conditions' => array('Unit.property_id' => $property_id, 'Unit.active' => 1)));
        $this->set(compact('user_id', 'prop_id', 'property', 'unit_list'));
        if ( !empty($this->request->data) )
        {
            $this->User->id = $this->request->data['User']['user_id'];
            $id_number = explode("|", $this->request->data['User']['requested_unit']);
            if ( isset($id_number[0]) )
            {
                $unit_id = $id_number[0];
            }
            if ( isset($id_number[1]) )
            {
                $unit_number = $id_number[1];
            }
            if ( $this->User->saveField('requested_unit', $unit_number, true) )
            {
                /* Set to 2 so we can differentiate - i.e. know they came through this way already */
                $this->User->saveField('previoustenant', '2', false);

                //Send Email To Property Manager
                $this->__sendResidentSignup($user_id, $property, $unit_number, $unit_id);
                $this->redirect(array('controller' => 'Users', 'action' => 'residentsuccess'));
            } else
            {
                $this->Session->setFlash('Please select a unit.', 'flash_bad');
            }
        }
        $this->State->recursive = - 1;
        $this->set('states', $this->State->find('list', array('fields' => array('State.id', 'State.abbr'))));
    }

    function residentsuccess()
    {
        $this->layout = 'register';
    }

    function propertymanagersuccess()
    {
        $this->layout = 'register';
    }

    function addSignupReminder()
    {

        if ( !empty($this->request->data) )
        {
            $this->loadModel('SignupReminder');
            if ( $this->SignupReminder->save($this->request->data) )
            {
                $this->Session->setFlash('You will be reminded to signup via email tomorrow!', 'flash_good');
                $this->redirect(array('controller' => 'Pages', 'action' => 'index'));
            }
        } else
        {
            $this->Session->setFlash('Error saving reminder email. Please contact website admin.', 'flash_bad');
        }
    }

    function login()
    {
        if ( $this->Session->check('mobile_user') && intval($this->Session->read('mobile_user')) )
        {
            $this->layout = 'mobile';
            $this->view = 'mobile_login';
        } else
        {
            $this->layout = 'register';
        }

        if ( !empty($this->request->data) )
        {
            if ( $this->Auth->login() )
            {
                if ( $this->Auth->user('is_activated') )
                {
                    if ( $this->Auth->user('type') == USER_TYPE_TENANT )
                    {
                        if ( $this->Auth->user('property_id') > 0 )
                        {
                            // If property no longer active, then we must redirect
                            $this->loadModel('Property');
                            $this->Property->contain();
                            $userProp = $this->Property->findById($this->Auth->user('property_id'));
                            if ( $userProp['Property']['active'] == 0 )
                            {
                                $this->redirect(array('controller' => 'Users', 'action' => 'propertydisabled', $this->User->id));
                            }
                        } else
                        {
                            /*
                             *  If active user with no property_id they must have been removed from property
                             */
                            $this->Session->setFlash('You are no longer assigned to a property.  Please request a new property now.', 'flash_bad');
                            $redir_id = $this->Auth->User('id');
                            $this->Auth->logout();
                            $this->redirect(array('controller' => 'Users', 'action' => 'residentsearch', Security::cipher($redir_id, Configure::read('Security.salt2'))));
                        }
                    }
                    $this->redirect($this->Auth->redirect());
                } elseif ( !$this->Auth->user('is_activated') && $this->Auth->user('invitebyemail') )
                {
                    $this->User->id = $this->Auth->user('id');
                    $this->User->saveField('is_activated', true);

                    /*
                     * Update the unit to occupied after the invite is sent.
                    */
                    if ( $this->Auth->user('unit_id') > 0 )
                    {
                        $this->loadModel('Unit');
                        $this->Unit->id = $this->Auth->user('unit_id');
                        $this->Unit->saveField('occupied', 'Yes');
                    }

                    $this->redirect($this->Auth->redirect());
                } else
                {
                    $view = new View($this);
                    $html = $view->loadHelper('Html');
                    $resendLink = $html->link('Click Here', array('controller' => 'Users', 'action' => 'resendactivation', $this->Auth->user('id')));

                    /*
                     * previoustenant field can have following values
                     *  - 0 not a previous tenant
                     *  - 1 a previous tenant
                     *  - 2 a previous tenant awaiting a new activation
                     */
                    if ( $this->Auth->user('previoustenant') == 1 && $this->Auth->user('type') == USER_TYPE_TENANT )
                    {
                        /*
                         * Previous tenant, currently inactive, who is trying to log back in - so need to send
                         *  to page 2 of the tenant sign up process
                         */

                        $data = array();
                        $data['User']['id'] = $this->Auth->User('id');
                        /* Set to 2 so we can differentiate - i.e. know they came through this way already */
                        //$data['User']['previoustenant'] = '2';
                        $data['User']['property_id'] = '0';
                        $data['User']['unit_id'] = '0';
                        $data['User']['requested_unit'] = '0';
                        $data['User']['activation_key'] = $this->User->genActivationHash();
                        $this->User->set($data);
                        if ( $this->User->save($data, true, array('requested_unit', 'activation_key', 'property_id', 'unit_id')) )
                        {
                            //debug($data);
                            $redir_id = $this->Auth->User('id');
                            $this->Auth->logout();
                            $this->redirect(array('controller' => 'Users', 'action' => 'residentsearch', Security::cipher($redir_id, Configure::read('Security.salt2'))));
                        } else
                        {
                            $this->Session->setFlash('Error Signing Up. Please contact system admin.', 'flash_bad');
                        }
                    } else
                    {
                        $this->Auth->logout();
                        $this->Session->setFlash('Sorry, your account is not yet activated.', 'flash_bad');
                        $this->redirect($this->Auth->redirect());
                    }
                }
            } else
            {
                $this->Session->setFlash('Invalid username or password.', 'flash_bad');
            }
        }
    }

    function logout()
    {
        $tmpModel = 'Tempbilling' . $this->Auth->user('id');
        $tmpTable = "DROP TABLE IF EXISTS " . Inflector::tableize($tmpModel);
        $this->User->query($tmpTable);

        $this->Session->delete('current_property');
        $this->Session->destroy();
        $this->Session->setFlash('You are now logged out', 'flash_good');
        $this->redirect($this->Auth->logout());
    }

    function activate()
    {
        if ( isset($this->request->params['named']['id']) && isset($this->request->params['named']['key']) )
        {
            $this->User->id = $this->request->params['named']['id'];
            $this->User->read();
            if ( $this->User->data['User']['id'] == $this->request->params['named']['id'] && $this->User->data['User']['activation_key'] == $this->request->params['named']['key'] )
            {
                $this->User->data['User']['activation_key'] = '';
                $this->User->data['User']['is_activated'] = true;
                if ( $this->User->save() )
                    $this->Session->setFlash('Your account is now activated.', 'flash_good');
                else
                    $this->Session->setFlash('Sorry, there was an error activating your account.  Please try again.', 'flash_bad');
            } else
                $this->Session->setFlash('Incorrect activation key.  Please try again.', 'flash_bad');
        }

        $this->redirect(Router::url('/', true));
    }

    function myaccount($section = null)
    {
        $this->User->contain();
        $user = $this->User->findById($this->Auth->user('id'));
        if ( $user )
        {
            //$this->set('user', $user);
            $this->request->data = $user;
        }
        $this->User->Property->recursive = - 1;
        $this->set('property', $this->User->Property->findById($this->Session->read('current_property')));
        $this->set('payment_methods', $this->User->PaymentMethod->find('all', array('conditions' => array('user_id' => $this->Auth->user('id')))));
        if ( $section != null )
        {
            $this->set('section', $section);
        } else
        {
            $this->set('section', 'personal_info');
        }
    }

    function maupdatepersonal()
    {
        if ( !empty($this->request->data) )
        {
            $data = $this->request->data;
            $data['User']['username'] = $data['User']['email'];
            if ( $this->User->save($data, true, array('first_name', 'last_name', 'email', 'username')) )
            {
                $this->Session->setFlash('Profile updated', 'flash_good');
            } else
                $this->Session->setFlash('Sorry, an error occurred saving your profile data.  Please try again', 'flash_bad');

            $this->refreshAuth();
            $this->redirect($this->referer());
        }
    }

    function maupdatepassword()
    {
        if ( !empty($this->request->data) )
        {
            $data = $this->request->data;
            $data['User']['password'] = AuthComponent::password($data['User']['password']);
            if ( $this->User->save($data, true, array('password')) )
            {
                $this->Session->setFlash('Password updated', 'flash_good');
            } else
                $this->Session->setFlash('Sorry, an error occurred saving your profile data.  Please try again', 'flash_bad');

            $this->refreshAuth();
            $this->redirect($this->referer());
        }
    }

    function update()
    {
        if ( !empty($this->request->data) )
        {
            if ( $this->User->save($this->request->data, true, array('list_in_directory', 'email_for_rent', 'email_for_maintenance', 'email_for_messages', 'email_payment_confirmation', 'email_newsletter', 'email_payment_made', 'email_new_maint', 'email_late_payments', 'email_overdraft', 'email_newsletter', 'email_latefee_assessed')) )
            {
                $this->Session->setFlash('Profile updated', 'flash_good');
            } else
                $this->Session->setFlash('Sorry, an error occurred saving your profile data.  Please try again', 'flash_bad');

            $this->refreshAuth();
            $this->redirect($this->referer());
        }
    }

    //On Unit Edit Page -> Add Resident. Removes a resident form queue if spam or accident
    function removeFromRequestedUnit()
    {
        if ( !empty($this->request->data) )
        {
            $this->User->id = $this->request->data['User']['tenant_id'];
            $this->User->saveField('unit_id', 0);
            $this->User->saveField('property_id', 0);
            $this->Session->setFlash('Removed from queue', 'flash_good');
            $this->redirect($this->referer());
        } else
        {
            $this->redirect($this->referer());
        }
    }

    // Page: Users/view
    // Button: Remove From Property
    // Desc: removes a user from property. Sets unit_id and property_id = 0
    function deleteresident($user_id = null, $unit_id = null)
    {
        if ( $user_id != null )
        {
            $this->User->id = $user_id;
            if ( $this->User->saveField('unit_id', 0) )
            {
                $this->User->saveField('property_id', 0);
                $this->User->updateUnitOccupied($unit_id);
                $this->Session->setFlash('Tenant was removed from this Property.', 'flash_good');
                $this->redirect(array('controller' => 'Units', 'action' => 'edit', $unit_id));
            } else
            {
                $this->Session->setFlash('Could not delete Tenant from Unit.', 'flash_bad');
            }
        }
    }

    // Page: Users/view
    // Button: Move to Another Unit
    // Desc: removes a user from property. Sets unit_id and property_id = 0
    function moveUnits()
    {
        if ( !empty($this->request->data) )
        {
            $data = $this->request->data;
            $this->User->id = $data['User']['user_id'];
            if ( is_null($data['User']['new_unit_id']) || $data['User']['new_unit_id'] == '' )
            {
                $data['User']['new_unit_id'] = 0;
            }
            $this->User->saveField('unit_id', $data['User']['new_unit_id']);
            //Update Unit Occupied
            $this->User->updateUnitOccupied($this->request->data['User']['old_unit_id']);
            $this->User->updateUnitOccupied($data['User']['new_unit_id']);
            $this->Session->setFlash('Moved Resident Sucessfully.', 'flash_good');
            $this->redirect(array('controller' => 'Units', 'action' => 'edit', $this->request->data['User']['old_unit_id']));
        } else
        {
            $this->redirect($this->referer());
        }
    }


    function checkuniqueemail($emailValue = null)
    {
        if ( $emailValue != null )
        {
            $email = $this->User->find('first', array('conditions' => array('User.email' => $emailValue)));
            if ( $email )
                echo 'exists';
            else
                echo 'does_not_exits';

            return true;
        }
    }

    function requestreset()
    {
        $this->layout = 'register';
        if ( !empty($this->request->data) )
        {
            $user = $this->User->find('first', array('conditions' => array('OR' => array('User.username' => $this->request->data['User']['username'], 'User.email' => $this->request->data['User']['username']))));

            if ( $user )
            {
                if ( $this->__sendPasswordReset($user['User']['id']) )
                {
                    $this->Session->setFlash("A password reset link has been sent to your email address.", "flash_good");
                    $this->redirect(array('controller' => 'Users', 'action' => 'login'));
                } else
                {
                    $this->Session->setFlash('Sorry, there was an error sending your password reset email, please try again', 'flash_bad');
                }
            }
            $this->Session->setFlash('Sorry, that username or email address does not exist in our records', 'flash_bad');
        }
    }

    function resetpassword($id = null, $key = null)
    {
        $this->layout = 'register';
        if ( !empty($this->request->data) )
        {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['User']['id'], 'User.activation_key' => $this->request->data['User']['activation_key'])));
            if ( $user )
            {
                $user['User']['password'] = $this->User->hashPassword($this->request->data['User']['password']);
                $user['User']['confirm_password'] = $this->request->data['User']['confirm_password'];
                $user['User']['activation_key'] = '';

                if ( $this->User->save($user, true, array('password', 'confirm_password', 'activation_key')) )
                {
                    $this->Session->setFlash('Password reset successfully', 'flash_good');
                    $this->redirect(array('controller' => 'Users', 'action' => 'login'));
                } else
                    $this->Session->setFlash('Sorry, there was an unknown error resetting your password', 'flash_bad');
            } else
                $this->Session->setFlash('Your user ID and reset key do not match', 'flash_bad');
        } else if ( $id != null && $key != null )
        {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.activation_key' => $key)));
            if ( $user )
            {
                $this->set('userid', $user['User']['id']);
                $this->set('key', $user['User']['activation_key']);

                return;
            }
        }

        $this->redirect('/');
    }

    function resendactivation($id = null)
    {
        if ( $id == null )
            $this->redirect($this->referer());

        $this->User->id = $id;
        $isActivated = $this->User->field('is_activated');
        if ( !$isActivated )
        {
            $this->__sendActivationMail($id);
            $this->Session->setFlash('A new activation email has been sent to your account', 'flash_good');
        } else
            $this->Session->setFlash('Your account is already activated', 'flash_bad');

        $this->redirect($this->referer());
    }

    function pendingactivation($id = null)
    {
        /*
         * No longer valid, so repurposing here
         * Looking up properties and redirecting to billing.index as I've logged person in already
         */
        if ( $id == null )
        {
            $id = $this->Auth->user('id');
        }
        $this->set('properties', $this->User->Property->find('all', array('conditions' => array('Property.manager_id' => $id))));
        //$this->redirect(array('controller' => 'Billing', 'action' => 'index'));
        $this->Auth->logout();
        $this->Session->setFlash('Thanks For  Registering.  Log in now to get started!', 'flash_good');
        $this->redirect($this->Auth->redirect());
    }


    function propertydisabled($id = null)
    {
        if ( $id == null )
        {
            $id = $this->Auth->user('id');
        }
        $this->set('properties', $this->User->Property->find('all', array('conditions' => array('Property.manager_id' => $id))));
    }

    function pmlist()
    {
        $this->adminCheck();
        if ( !empty($this->request->data) )
        {
        } else
        {
            $this->paginate = array(
                //'conditions' => $conditions,
                'contain'    => array(
                    'State'
                ),
                'limit'      => 15,
                'order'      => array(
                    'User.last_name' => 'asc', 'User.first_name' => 'asc', 'User.zip' => 'asc'
                ),
                'conditions' => array('User.type' => 0, 'User.is_activated' => '1')
            );
            $this->Paginator->settings = $this->paginate;
            $this->set('pms', $this->Paginator->paginate('User'));

            //$this->User->contain('State');
            //$pms = $this->User->find('all', array('conditions' => array('type' => 0, 'is_activated' => '1'),
            //                                      'order' => array('last_name' => 'asc', 'first_name' => 'asc', 'zip' => 'asc')));

            //$this->set(compact('pms'));
        }
    }

    private function __sendPasswordReset($id)
    {
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        if ( $user )
        {
            $user['User']['activation_key'] = $this->User->genActivationHash();
            if ( $this->User->save($user, false) )
            {
                $from = Configure::read('RentSquare.supportemail');

                $email = new CakeEmail();
                $email->domain('rentsquaredev.com');
                $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
                $email->template('pwreset', 'generic')
                    ->emailFormat('both')
                    ->from(array($from => 'RentSquare Support'))
                    ->to($user['User']['email'])
                    ->subject('RentSquare Password Reset')
                    ->viewVars(array(
                        'name'   => $user['User']['first_name'],
                        'userid' => $user['User']['id'],
                        'key'    => $user['User']['activation_key']
                    ))
                    ->send();

                return true;
            }
        }

        return false;
    }


    private function __sendActivationMail($id)
    {
        $this->User->id = $id;
        $this->User->read();

        if ( $this->User->data['User']['id'] == $id )
        {
            $from = Configure::read('RentSquare.supportemail');

            $email = new CakeEmail();
            $email->domain('rentsquaredev.com');
            $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
            $email->template('activation', 'generic')
                ->emailFormat('both')
                ->from(array($from => 'RentSquare Support'))
                ->to($this->User->data['User']['email'])
                ->subject('RentSquare New user registration')
                ->viewVars(array(
                    'name'   => $this->User->data['User']['username'],
                    'userid' => $this->User->data['User']['id'],
                    'key'    => $this->User->data['User']['activation_key']
                ))
                ->send();

            return true;
        }

        return false;
    }

    private function __sendResidentSignup($user_id, $property, $unit_num, $unit_id)
    {
        $from = Configure::read('RentSquare.supportemail');
        $this->loadModel('Unit');
        $user_det = $this->User->findById($user_id);

        try
        {
            $email = new CakeEmail();
            $email->domain('rentsquaredev.com');
            $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
            $email->template('residentsignup', 'generic')
                ->emailFormat('html')
                ->from(array($from => 'RentSquare Support'))
                ->to($property['Manager']['email'])
                ->subject('New Resident Signup - RentSquare')
                ->viewVars(array(
                    'property_name' => $property['Property']['name'],
                    'manager_name'  => $property['Manager']['first_name'],
                    'tenant'        => $user_det,
                    'unit_num'      => $unit_num,
                    'unit_id'       => $unit_id
                ))
                ->send();
        }
        catch ( Exception $e )
        {
            return false;
        }

        return true;

    }

    private function __sendTenantInvite($emailTo, $passwd, $user_id, $property, $unit_num)
    {
        $from = Configure::read('RentSquare.supportemail');
        $this->loadModel('Unit');
        $user_det = $this->User->findById($user_id);

        try
        {
            $email = new CakeEmail();
            $email->domain('rentsquaredev.com');
            $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
            $email->template('inviteresident', 'generic')
                ->emailFormat('html')
                ->from(array($from => 'RentSquare Support'))
                ->to($emailTo)
                ->subject('You have been invited to use RentSquare')
                ->viewVars(array(
                    'user_details' => $user_det,
                    'property'     => $property,
                    'unit_num'     => $unit_num,
                    'emailAdd'     => $emailTo,
                    'passwd'       => $passwd
                ))
                ->send();
        }
        catch ( Exception $e )
        {
            return false;
        }

        return true;

    }

    private function add_month($date_str, $months)
    {
        $date = new DateTime($date_str);
        $start_day = $date->format('j');

        $date->modify("+{$months} month");
        $end_day = $date->format('j');

        //if ($start_day != $end_day)
        //    $date->modify('last day of last month');

        return $date;
    }

    private function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ( $i = 0; $i < 8; $i ++ )
        {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[ $n ];
        }

        return implode($pass); //turn the array into a string
    }

    private function geocode_lookup($string)
    {
        $string = str_replace(" ", "+", urlencode($string));
        $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $string . "&sensor=false&key=AIzaSyCxGUJAu6jz7ACqPkPih8K7h2D6H7eycEA";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
        if ( $response['status'] != 'OK' )
        {
            return null;
        }

        $geometry = $response['results'][0]['geometry'];
        $longitude = $geometry['location']['lat'];
        $latitude = $geometry['location']['lng'];

        curl_close($ch);

        $lat_long = array(
            'latitude'      => $geometry['location']['lat'],
            'longitude'     => $geometry['location']['lng'],
            'location_type' => $geometry['location_type'],
        );

        return $lat_long;

    }

    private function timezone_lookup($lat_long)
    {

        $details_url = "https://maps.googleapis.com/maps/api/timezone/json?location=" . $lat_long['latitude'] . "," . $lat_long['longitude'] . "&timestamp=" . time() . "&sensor=false&key=AIzaSyCxGUJAu6jz7ACqPkPih8K7h2D6H7eycEA";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
        if ( $response['status'] != 'OK' )
        {
            return null;
        }

        curl_close($ch);

        return $response;

    }

    function bounce( $anchor )
    {
        $this->redirect( "http://www.rentsquaredev.com/Users/myaccount#" . $anchor );
    }

}

;

?>
