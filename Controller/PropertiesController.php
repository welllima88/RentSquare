<?php
App::import('Vendor', 'Paymethodutils', array('file' => 'Interfaces/PayMethods/PayMethodUtils.php'));
App::import('Vendor', 'Paymethodbasecommerce', array('file' => 'Interfaces/PayMethods/PayMethodBasecommerce.php'));

class PropertiesController extends AppController {

    function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->deny('*');
    }

    function add()
    {
        //	Make sure the user is a property manager.
        $this->managerCheck();
        $this->loadModel('State');
        $this->set('states', $this->State->find('list', array('fields' => array('State.id', 'State.full_name'))));
        $this->set('one_month_date', $this->add_month(date("F j, Y"), 1));
        $MONTHLY_25_OR_LESS = MONTHLY_25_OR_LESS;
        $MONTHLY_26_TO_50 = MONTHLY_26_TO_50;
        $MONTHLY_51_TO_100 = MONTHLY_51_TO_100;
        $MONTHLY_101_TO_200 = MONTHLY_101_TO_200;
        $MONTHLY_201_TO_300 = MONTHLY_201_TO_300;
        $MONTHLY_301_TO_400 = MONTHLY_301_TO_400;
        $MONTHLY_OVER_400 = MONTHLY_OVER_400;
        $this->set(compact('MONTHLY_25_OR_LESS', 'MONTHLY_26_TO_50', 'MONTHLY_51_TO_100', 'MONTHLY_101_TO_200', 'MONTHLY_201_TO_300', 'MONTHLY_301_TO_400', 'MONTHLY_OVER_400'));
        if ( !empty($this->request->data) )
        {
            $this->Property->set($this->request->data);
            if ( $this->Property->validates() )
            {
                $data = $this->request->data;

                //Set Empty values
                if ( !isset($data['Property']['state_inc']) || $data['Property']['state_inc'] == '' || is_null($data['Property']['state_inc']) ) $data['Property']['state_inc'] = 1;
                if ( !isset($data['Property']['business_started']) ) $data['Property']['business_started'] = 0;
                if ( !isset($data['Property']['ownership_started']) ) $data['Property']['ownership_started'] = 0;
                //if ( isset($data['Property']['name']) ) $data['Property']['legal_dba'] = $data['Property']['name'];


                //Set last 4 digits of account to save
                $data['Property']['bank_acct'] = substr($data['Property']['bank_account_num'], - 4, 4);

                //Set Manager Id
                $data['Property']['manager_id'] = $this->Auth->user('id');

                /*
                 * 2014-09-15 Wolff - commented out - fee_due_day will be set when property is activated
                 * 2015-07-20 - New BaseCommerce api removes the property activation process, so adding the fee_due_day back
                                and the new api to add the payment method to the vault
                 */
                //Set fee_due_day
                $data['Property']['fee_due_day'] = date('j');
                $data['Property']['active'] = '1';


                //Get User Data
                $this->loadModel('User');
                $user = $this->User->findById($this->Auth->user('id'));
                $data['User'] = $user['User'];

                /*  
                 * PaymentProcessor API
                 */
                $this->payutil = new Paymethodutils(new Paymethodbasecommerce);

                /*  
	         * Submit merch app info for new property
                 */
                 //$bcrsl = $this->payutil->submitMerchApp( $data );
                 //$this->log('Merchant App Results: ' . json_encode($bcrsl), 'debug' );
                 // **TODO need to process result, and change logic below -- pull save out of bankstatus conditional, and make conditions
                 //     upon both status' being successful?

                /*  
	         * Save Bank To Vault
       		 * Add Property Manager's bank account to the Vault
                 */
                $paymentmethod = array();
                $paymentmethod['first_name'] = $data['User']['first_name'];
                $paymentmethod['last_name'] = $data['User']['last_name'];
                $paymentmethod['account_number'] = $data['Property']['bank_account_num'];
                $paymentmethod['routing_number'] = $data['Property']['routing_number'];
                $paymentmethod['bank_acct_type'] = $data['Property']['bank_account_type'];
                $paymentmethod['phone'] = $data['User']['phone'];
                $paymentmethod['email'] = $data['User']['email'];
                list($banksave_status, $banksave_result) = $this->payutil->addBankToVault($paymentmethod);
                if ( $banksave_status == 1 )
                {
                    $data['Property']['vault_id'] = $banksave_result;
                    $this->log('Success: Vault add prop mgr - token = ' . $banksave_result, 'debug' );

                    $pmdata = array();
                    $pmdata['PaymentMethod']['vault_id'] = $banksave_result;
                    $pmdata['PaymentMethod']['first_name'] = $paymentmethod['first_name'];
                    $pmdata['PaymentMethod']['last_name'] = $paymentmethod['last_name'];
                    $pmdata['PaymentMethod']['routing_number'] = $paymentmethod['routing_number'];
                    $pmdata['PaymentMethod']['account_num'] = substr($paymentmethod['account_number'], - 4, 4);
                    $pmdata['PaymentMethod']['bank_name'] = $data['Property']['bank_name'];
                    $pmdata['PaymentMethod']['type'] = "ACH";
                    $pmdata['PaymentMethod']['user_id'] = $this->Auth->user('id');

                    $this->loadModel('PaymentMethod'); 
                    $this->PaymentMethod->create();
                    if ( $this->PaymentMethod->save($pmdata) )
                    {
                    }
                    else
                    {
                    $this->Session->setFlash('Failed to save Bank Account to Secure Vault.  Please contact admin.', 'flash_bad');
                    }

                    $data['Property']['vault_id'] = $banksave_result;

                    //Save Property Manager in Database
                    if ( $this->Property->save($data) )
                    {
                        $this->Session->setFlash('Property Saved.', 'flash_success');
                        $this->redirect(array('controller' => 'Billing', 'action' => 'index'));

                    } else
                    {
                        $this->Session->setFlash('Error saving new property. Please contact RentSquare Support.', 'flash_bad');
                    }

                }

            } else
            {
                //$errors = $this->User->invalidFields();
                $this->Session->setFlash('Please enter all required fields', 'flash_bad');
            }
        }

    }

    function select($id = null)
    {
        if ( !empty($this->request->data) )
            $id = $this->request->data['Property']['id'];
        if ( $id )
        {
            if ( $id == 'new' )
                $this->redirect(array('controller' => 'Properties', 'action' => 'add'));

            $this->Property->contain();
            $property = $this->Property->get($id, $this->Auth->user('id'));
            if ( $property )
            {
                $this->Session->write('current_property', $property['Property']['id']);
                $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            } else
                $this->Session->setFlash("Sorry, that property does not exist in our database");
        }

        $this->redirect($this->referer());
    }

    function maupdatetenantbilling()
    {
        if ( !empty($this->request->data) )
        {
            $data = $this->request->data;
            $this->Property->id = $data['Property']['id'];
            if ( $this->Property->save($data, true, array('before_due_days', 'before_due_reminder', 'invoice_day', 'day_rent_late', 'auto_late_fee', 'auto_late_fee_amt')) )
            {
                $this->Session->setFlash('Tenant Billing Settings updated successfully!', 'flash_good');
                $this->redirect(array('controller' => 'Users', 'action' => 'myaccount', 'tenant_billing'));
            }
        }
    }

    function maupdatetransfee()
    {
        if ( !empty($this->request->data) )
        {
            $data = $this->request->data;
            $this->Property->id = $data['Property']['id'];
            if ( $this->Property->save($data, true, array('prop_pays_ach_fee', 'prop_pays_cc_fee')) )
            {
                $this->Session->setFlash('Transaction Fees Settings updated successfully!', 'flash_good');
                $this->redirect(array('controller' => 'Users', 'action' => 'myaccount', 'transaction_fees'));
            }
        }
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

}

;

?>
