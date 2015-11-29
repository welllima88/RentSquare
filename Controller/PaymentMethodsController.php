<?php
//error_reporting(0);
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('Security', 'Utility');
App::import('Vendor', 'Paymethodutils', array('file' => 'Interfaces/PayMethods/PayMethodUtils.php'));
/* 
 * If processor ever changes, need to write a new class to the interface, and load it here
 *  The only thing to change is in beforeFilter -- pass the new class as an arg to Paymethodutils
 */
App::import('Vendor', 'Paymethodbasecommerce', array('file' => 'Interfaces/PayMethods/PayMethodBasecommerce.php'));

/**
 * PaymentMethods Controller
 *
 * @property PaymentMethod $PaymentMethod
 */
class PaymentMethodsController extends AppController {

    function beforeFilter()
    {
        parent::beforeFilter();

        //$this->payutil = new Paymethodutils( new Paymethodbasecommerce);
    }

    // Test function to add hardcoded info to test api communication
    //public function addtovault() {
    //   $output = $this->payutil->addCardToVault();
    //   $this->set(compact('output'));
    //}

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->PaymentMethod->recursive = 0;
        $this->set('paymentMethods', $this->paginate());
    }

    /*
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->PaymentMethod->id = $id;

        if ( !$this->PaymentMethod->exists() )
        {
            throw new NotFoundException(__('Invalid payment method'));
        }
        $this->set('paymentMethod', $this->PaymentMethod->read(null, $id));
    }


    /**
     * add_cc method
     *
     * @return void
     */
    public function add_cc()
    {
        $user_id = $this->Auth->user('id');
        $this->loadModel('User');
        $this->User->contain();
        $user = $this->User->findById($user_id);
        /*
        echo "user_id = $user_id";
        debug('userid');
        echo $this->Auth->user('id');
        debug('user');
        print_r($user);
        debug('request');
        debug($this->request->data);
        */

        if ( $this->request->is('post') )
        {
            $this->PaymentMethod->create();
            $data = $this->request->data;

            /*
             * Instantiate payment processor
             */
            $this->payutil = new Paymethodutils(new Paymethodbasecommerce);

            /*
             * PaymentProcessor API
             *
             * Save Card To Vault
             * Add Renter's bank account to the Vault
             */
            $paymentmethod = array();
            $paymentmethod['first_name'] = $data['PaymentMethod']['first_name'];
            $paymentmethod['last_name'] = $data['PaymentMethod']['last_name'];
            $paymentmethod['card_number'] = $data['PaymentMethod']['card_number'];
            $paymentmethod['expire_dt_month'] = $data['PaymentMethod']['expire_dt_month'];
            $paymentmethod['expire_dt_year'] = $data['PaymentMethod']['expire_dt_year']['year'];
            $paymentmethod['billing_address1'] = $data['PaymentMethod']['billing_address1'];
            $paymentmethod['billing_address2'] = $data['PaymentMethod']['billing_address2'];
            $paymentmethod['billing_city'] = $data['PaymentMethod']['billing_city'];
            $paymentmethod['billing_state_id'] = $data['PaymentMethod']['billing_state_id'];
            $paymentmethod['billing_zip'] = $data['PaymentMethod']['billing_zip'];
            //$paymentmethod['security_code']     = $data['PaymentMethod']['security_code'];
            $paymentmethod['phone'] = $user['User']['phone'];
            $paymentmethod['email'] = $user['User']['email'];
            list($cardsave_status, $cardsave_result) = $this->payutil->addCardToVault($paymentmethod);

            // Log bc results
            $bcr = array();
            $bcr['users_id'] = $this->Auth->user('id');
            $bcr['result_code'] = $cardsave_status;
            $bcr['result_string'] = json_encode($cardsave_result);
            $bcr['transtype'] = "paymeth add Card to Vault";
            $bcr['request'] = json_encode($paymentmethod);
            $this->loadModel('Bcresult');
            $this->Bcresult->create();
            $this->Bcresult->save($bcr);

            if ( $cardsave_status == 1 )
            {
                $this->log('Success: Vault add card for tenant - token = ' . $cardsave_result, 'debug' );
                $data['PaymentMethod']['vault_id'] = $cardsave_result;
                $data['PaymentMethod']['card_num'] = substr($data['PaymentMethod']['card_number'], - 4, 4);
                $data['PaymentMethod']['type'] = "CC";

                if ( $this->PaymentMethod->save($data) )
                {
                    /*
                    debug('success');
                    debug($_SESSION);
                    debug('referer');
                    debug($this->referer());
                    exit;
                    */
                    $this->Session->setFlash(__('The payment method has been saved'), 'flash_good');
                    if ( isset($_SESSION['page_referer']) )
                    {
                        $this->redirect($_SESSION['page_referer'] . '?id=' . $vault_id);
                    } else
                    {
                        //$this->redirect($this->referer().'?id='.$vault_id);
                    }
                } else    // response = 1
                {
                    $this->Session->setFlash(__('The payment method could not be saved. ' . $responsetext . '. Please, try again.'), 'flash_bad');
                }
            } else
            {
                //On fail, set vault_id = 1
                //$this->log( 'Fail: Vault add prop mgr - ' . var_dump($cardsave_result), 'PmtProcesing' );
                $this->Session->setFlash(__('The payment method could not be added to the vault, so it was not saved. ' . $responsetext . '. Please, try again.'), 'flash_bad');
            }
        } else   // if is post
        {
            //if (strpos($this->referer(), 'add_cc') == FALSE && strpos($this->referer(), 'add_bank') == FALSE)
            //{
            //   $_SESSION['page_referer'] = $this->referer();
            //}
        }
        $this->loadModel('State');
        $billingStates = $this->State->find('list', array('fields' => array('State.id', 'State.full_name')));
        $this->set(compact('billingStates', 'user_id', 'user'));
    }

    /**
     * add_bank method
     *
     * @return void
     */
    public function add_bank()
    {
        $user_id = $this->Auth->user('id');
        $this->loadModel('User');
        $this->User->contain();
        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));

        if ( $this->request->is('post') )
        {
            $this->PaymentMethod->create();
            $data = $this->request->data;

            /*
             * Instantiate payment processor
             */
            $this->payutil = new Paymethodutils(new Paymethodbasecommerce);

            /*
             * PaymentProcessor API
             *
             * Save Bank To Vault
             * Add Property Manager's bank account to the Vault
             */
            $paymentmethod = array();
            $paymentmethod['first_name'] = $data['PaymentMethod']['first_name'];
            $paymentmethod['last_name'] = $data['PaymentMethod']['last_name'];
            $paymentmethod['account_number'] = $data['PaymentMethod']['account_number'];
            $paymentmethod['routing_number'] = $data['PaymentMethod']['routing_number'];
            $paymentmethod['bank_acct_type'] = $data['PaymentMethod']['bank_acct_type'];
            $paymentmethod['phone'] = $user['User']['phone'];
            $paymentmethod['email'] = $user['User']['email'];
            $paymentmethod['usertype'] = $user['User']['type'];		// Use BC Partner creds if RentSquare admin user (type = 2)
            list($banksave_status, $banksave_token) = $this->payutil->addBankToVault($paymentmethod);
            $this->log("Success: Vault add bank for tenant status = $banksave_status - token = $banksave_token", 'debug' );

            // Log bc results
            $bcr = array();
            $bcr['users_id'] = $this->Auth->user('id');
            $bcr['result_code'] = $banksave_status;
            $bcr['result_string'] = json_encode($banksave_token);
            $bcr['transtype'] = "paymeth add Bank to Vault";
            $bcr['request'] = json_encode($paymentmethod);
            $this->loadModel('Bcresult');
            $this->Bcresult->create();
            $this->Bcresult->save($bcr);

            if ( $banksave_status )
            {
                $data['PaymentMethod']['vault_id'] = $banksave_token;
                $data['PaymentMethod']['account_num'] = substr($data['PaymentMethod']['account_number'], - 4, 4);
                unset($data['PaymentMethod']['account_number']);
                $data['PaymentMethod']['type'] = "ACH";

                if ( $this->PaymentMethod->save($data) )
                {
                    /*
                    debug('success');
                    debug($_SESSION);
                    debug('referer');
                    debug($this->referer());
                    exit;
                    */
                    
                    $this->Session->setFlash(__('The payment method has been saved'), 'flash_good');
                    if ( isset($_SESSION['page_referer']) )
                    {
                        $this->redirect($_SESSION['page_referer'] . '?id=' . $vault_id);
                    } else
                    {
                        $this->redirect(array('controller' => 'Users', 'action' => 'myaccount', 'payment_methods'));
                    }
                } else    // response = 1
                {
                    $this->Session->setFlash(__('The payment method could not be saved. ' . $responsetext . '. Please, try again.'), 'flash_bad');
                }
            } else
            {
                //On fail, set vault_id = 1
                //$this->log( 'Fail: Vault add prop mgr - ' . var_dump($banksave_result), 'PmtProcesing' );
                $this->Session->setFlash(__('The payment method could not be added to the vault, so it was not saved. ' . $responsetext . '. Please, try again.'), 'flash_bad');
            }
        } else   // if is post
        {
            if ( strpos($this->referer(), 'add_bank') == FALSE && strpos($this->referer(), 'add_cc') == FALSE )
            {
                $_SESSION['page_referer'] = $this->referer();
            }
        }
        $this->set(compact('user_id', 'user'));

    }

    /*
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->loadModel('State');
        $this->PaymentMethod->id = $id;
        if ( !$this->PaymentMethod->exists() )
        {
            throw new NotFoundException(__('Invalid payment method'));
        }
        if ( $this->request->is('post') || $this->request->is('put') )
        {
            if ( $this->PaymentMethod->save($this->request->data) )
            {
                $this->Session->setFlash(__('The payment method has been saved'), 'flash_good');
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The payment method could not be saved. Please, try again.'), 'flash_bad');
            }
        } else
        {
            $this->request->data = $this->PaymentMethod->read(null, $id);
        }
        $billingStates = $this->State->find('list');
        $users = $this->PaymentMethod->User->find('list');
        $this->set(compact('billingStates', 'users'));
    }

    /*
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if ( isset($this->request->data['PaymentMethod']['id']) )
        {
            $id = $this->request->data['PaymentMethod']['id'];
        }
        if ( !$this->request->is('post') )
        {
            throw new MethodNotAllowedException();
        }
        $this->PaymentMethod->id = $id;
        if ( !$this->PaymentMethod->exists() )
        {
            throw new NotFoundException(__('Invalid payment method'));
        }
        if ( $this->PaymentMethod->delete() )
        {

            $this->loadModel('Property');
            $prop = $this->Property->findById($this->Auth->user('property_id'));

            //Get Phoenix Payment Password
            $pp_password = Security::rijndael($prop['Property']['pp_pass'], Configure::read('Security.salt2'), 'decrypt');

            $paymentmethod['user_id'] = $id;
            $paymentmethod['pp_user'] = $prop['Property']['pp_user'];
            $paymentmethod['pp_password'] = $pp_password;
            //$this->PaymentMethod->delete_from_vault($paymentmethod);

            $this->Session->setFlash(__('Payment method deleted'), 'flash_good');
            $this->redirect(array('controller' => 'Users', 'action' => 'myaccount', 'payment_methods'));
        }
        $this->Session->setFlash(__('Payment method was not deleted'), 'flash_bad');
        $this->redirect(array('controller' => 'Users', 'action' => 'myaccount', 'payment_methods'));
    }
}
