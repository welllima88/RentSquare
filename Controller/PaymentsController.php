<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Sanitize', 'Utility');
App::uses('Security', 'Utility');
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');
App::import('Vendor', 'Paymethodutils', array('file' => 'Interfaces/PayMethods/PayMethodUtils.php'));
/* 
 * If processor ever changes, need to write a new class to the interface, and load it here
 *  The only thing to change is in the instantion -- pass the new class as an arg to Paymethodutils
 */
App::import('Vendor', 'Paymethodbasecommerce', array('file' => 'Interfaces/PayMethods/PayMethodBasecommerce.php'));

class PaymentsController extends AppController {

    function index($success = null, $amount = null)
    {
        //Set Mobile View if mobile
        if ( $this->Session->check('mobile_user') && intval($this->Session->read('mobile_user')) )
        {

            $this->layout = 'mobile';
            if ( $success == 'success' )
            {
                $this->set('amount', $amount);
                $this->view = 'mobile_success';
            } else
            {
                $this->view = 'mobile_index';
            }
        }

        $this->loadModel('Unit');
        $this->Unit->contain('Property');
        $this->set('unit', $this->Unit->find('first', array('conditions' => array('Unit.id' => $this->Auth->user('unit_id')))));

        $this->loadModel('Billing');
        $this->set('Billings', $this->Billing->find('all', array(
            'conditions' => array(
                'unit_id'   => $this->Auth->user('unit_id'),
                'status !=' => 'paid'
            ),
            'contain'    => array(
                'Unit',
                'Payment' => array(
                    'conditions' => array('is_fee' => 0),
                    'User'       => array('fields' => 'last_name,first_name')
                ),
                'BillingFee'
            ),
            'order'      => array('Billing.billing_end desc')
        )));

        $this->loadModel('PaymentMethod');
        $this->set('payment_methods', $this->PaymentMethod->find('all', array('conditions' => array('user_id' => $this->Auth->user('id')))));

        $this->set('subheader', 'subnav_payments');
        $this->set('make_payment', true);
    }

    function mobilerent($billing_id = null)
    {
        //Set Mobile View if mobile
        if ( $this->Session->check('mobile_user') && intval($this->Session->read('mobile_user')) )
        {
            $this->layout = 'mobile';
            $this->view = 'mobile_rent';

            $this->loadModel('Unit');
            $this->Unit->contain('Property');
            $unit = $this->Unit->find('first', array('conditions' => array('Unit.id' => $this->Auth->user('unit_id'))));

            $this->loadModel('Billing');
            $billingcycle = $this->Billing->find('first', array('conditions' => array('Billing.id' => $billing_id)));

            $this->loadModel('PaymentMethod');
            $payment_methods = $this->PaymentMethod->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'))));

            $this->set(compact('billingcycle', 'payment_methods', 'unit'));

        } else
        {
            $this->redirect(array('action' => 'index'));
        }
    }

    function autopay()
    {

        $this->loadModel('PaymentMethod');
        $this->set('payment_methods', $this->PaymentMethod->find('all', array('conditions' => array('PaymentMethod.user_id' => $this->Auth->user('id')))));

        $this->loadModel('AutoPayment');
        $this->request->data = $this->AutoPayment->find('first', array('conditions' => array('AutoPayment.user_id' => $this->Auth->user('id')), 'order' => array('AutoPayment.created' => 'desc')));

        $subheader = 'subnav_payments';
        $auto_payment = true;
        $this->set(compact('subheader', 'auto_payment'));
    }

    function history()
    {
        $subheader = 'subnav_payments';
        $hist_payment = true;
        $conditions = array('Payment.user_id' => $this->Auth->user('id'), 'Payment.is_fee' => 0);
        if ( $this->request->is('post') && $this->request->data )
        {
            if ( $this->request->data['Payment']['start_date'] != '' )
            {
                $conditions['Payment.created >='] = date("Y-m-d H:i:s", strtotime($this->request->data['Payment']['start_date']));
            }
            if ( $this->request->data['Payment']['end_date'] != '' )
            {
                $conditions['Payment.created <='] = date("Y-m-d H:i:s", strtotime($this->request->data['Payment']['end_date']));
            }
        }

        $this->paginate = array(
            'conditions' => $conditions,
            'contain'    => array(
                'User',
                'Billing'
            ),
            'limit'      => 15,
            'order'      => array(
                'Payment.id' => 'desc'
            )
        );
        $payments = $this->paginate();
        $user_name = $this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name');
        $this->set(compact('subheader', 'hist_payment', 'payments', 'user_name'));

    }

    function payrent()
    {
        if ( $this->request->is('post') || $this->request->is('put') )
        {
            $data = $this->request->data;
            $pay_amount = $data['Payment']['amount'];
            //Determine Transaction Fees
            $this->loadModel('User');
            $this->User->contain('Property', 'PaymentMethod', 'Unit');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            //Is selected payment CC or ACH
            $i = 0;
            $paymentType = "";
            foreach ( $user['PaymentMethod'] as $paymentMethod ):
                if ( $paymentMethod['vault_id'] == $data['Payment']['vault_id'] )
                {
                    $paymentType = $user['PaymentMethod'][ $i ]['type'];
                    break;
                }
                $i ++;
            endforeach;

            $data_bc = array();
            $data_bc['pay_method'] = $paymentType;
            $data_bc['payer_vault_id'] = $data['Payment']['vault_id'];

            if ( $paymentType == 'CC' )
            {
                //Payment is Credit Card
                if ( $user['Property']['prop_pays_cc_fee'] )
                {
                    $amount = floatval($pay_amount);
                    $amt_fee = $amount * floatval(CC_FEE);
                    $amt_processed = floatval($amount);
                    $total_bill = floatval($amount);
                } else
                {
                    $amount = floatval($pay_amount);
                    $amt_fee = $amount * floatval(CC_FEE);
                    $amt_processed = floatval($amount) + floatval($amt_fee);
                    $total_bill = floatval($amount) + floatval($amt_fee);
                }
            } 
            else
            {
                //Payment is ACH
                if ( $user['Property']['prop_pays_ach_fee'] )
                {
                    $amount = floatval($pay_amount);
                    $amt_fee = floatval(ACH_FEE);
                    $amt_processed = floatval($amount);
                    $total_bill = floatval($amount);
                } else
                {
                    $amount = floatval($pay_amount);
                    $amt_fee = floatval(ACH_FEE);
                    $amt_processed = floatval($amount) + floatval(ACH_FEE);
                    $total_bill = floatval($amount) + floatval(ACH_FEE);
                }
            }

            $data_bc['total_amt'] = $total_bill;
            $data_bc['fee_amt']   = $amt_fee;

            // Get Vault ID for RentSquare bank account
            $this->loadModel('PaymentMethod');
            $rsl = $this->PaymentMethod->getRsqVaultId();
            if ( isset( $rsl['status'] ) && $rsl['status'] == 1 )
            {
               $rentsquare_vault_id = $rsl['vault_id'];
            }
            else
            {
               // TODO log error - can't process payment without Rentsquare vault_id
               $this->log('Error: cant process payment without RentSquare vault_id: ' . json_encode($rsl['vault_id']), 'payment' );
               $this->Session->setFlash(__('The payment was not processed. Could not find RentSquare VaultID'), 'flash_bad');
               $this->redirect(array('action' => 'index', 'failed', number_format($amount, 2)));
            }
            $data_bc['rsq_vault_id'] = $rentsquare_vault_id;

            //Submit Payment
            $this->payutil = new Paymethodutils(new Paymethodbasecommerce);
            $jpayResult = $this->payutil->rentPayment( $data_bc );
            $payResult  = json_decode($jpayResult);

            if ( ! isset($payResult) || empty($payResult->status) )
            {
               // TODO log error - can't process payment
               $this->log('Error: cant process payment - processor failure: ' . json_encode($rsl['info']), 'payment' );
               $this->Session->setFlash(__('The payment was not processed. Error with payment processor'), 'flash_bad');
               $this->redirect(array('action' => 'index', 'failed', number_format($amount, 2)));
            }

            // Log bc results
            $bcr = array();
            $bcr['users_id'] = $this->Auth->user('id');
            $bcr['result_code'] = $payResult->status;
            $bcr['result_string'] = $jpayResult;
            $bcr['transtype'] = "paycont Rent Payment";
            $this->loadModel('Bcresult');
            $this->Bcresult->create();
            $this->Bcresult->save($bcr);

            if ( isset($payResult) && $payResult->status == 1 )
            {
                $transactionid = $payResult->info;
                $this->loadModel('Billing');
                $data['Payment']['ppresponse'] = '1';
                $data['Payment']['ppresponsetext'] = 'success';
                $data['Payment']['ppauthcode'] = '';
                $data['Payment']['pptransactionid'] = $transactionid;
                $data['Payment']['ppresponse_code'] = '';
                $data['Payment']['status'] = 'Complete';
                $data['Payment']['user_id'] = $this->Auth->user('id');
                $data['Payment']['type'] = $paymentType;
                $data['Payment']['amt_fee'] = $amt_fee;
                $data['Payment']['amt_processed'] = floatval($amt_processed);
                $data['Payment']['total_bill'] = floatval($total_bill);

                //If Payment id = 0 (AKA pay toward current balance)
                if ( $data['Payment']['billing_id'] == 0 )
                {
                    $this->loadModel('Billing');
                    $billing_ids = $this->Billing->find('all', array('conditions' => array('status !=' => 'paid', 'unit_id' => $data['Payment']['unit_id']), 'fields' => array('id', 'rent_due', 'unit_id'), 'order' => array('Billing.id')));
                    $total_payment = floatval($data['Payment']['amount']);
                    $failed = 0;
                    //For each open billing id associated to unit
                    foreach ( $billing_ids as $billing_id ):
                        //get how much is due including payments have been made
                        $total_due = floatval($billing_id['Billing']['rent_due']);
                        if ( isset($billing_id['Payment']) )
                        {
                            foreach ( $billing_id['Payment'] as $payment ):
                                $total_due = $total_due - floatval($payment['amount']);
                            endforeach; // $billing_id['Payment'] as $payment
                        }
                        if ( floatval($total_payment) > 0 ):
                            $data['Payment']['billing_id'] = $billing_id['Billing']['id'];
                            if ( $total_due < $total_payment )
                            {
                                $data['Payment']['amount'] = floatval($total_due);
                            } else
                            {
                                $data['Payment']['amount'] = floatval($total_payment);
                            }
                            $this->Payment->create();
                            if ( $this->Payment->save($data) )
                            {
                                $this->loadModel('Billing');
                                $this->Billing->updatebillingstatus($billing_id['Billing']['id']);
                                $total_payment = $total_payment - $total_due;
                            } else
                            {
                                $failed = $billing_id['Billing']['id'];
                            }
                        endif;
                    endforeach; //$billing_ids as $billing_id

                    // if $total_payment > 0 add credit to account
                    if ( $total_payment > 0 && !$failed )
                    {
                        $this->loadModel('Unit');
                        $this->Unit->creditUnit($billing_id['Billing']['unit_id'], $total_payment);
                    }

                    if ( $failed )
                    {
                        $this->Session->setFlash(__('The payment for #' . $failed . ' could not be saved. Please, try again.'), 'flash_bad');
                        $this->redirect(array('action' => 'index', 'failed', number_format($amount, 2)));
                    } else
                    {
                        $this->Session->setFlash(__('The payment has been saved!'), 'flash_good');
                    }

                } else
                {
                    if ( $this->Payment->save($data) )
                    {
                        $this->Session->setFlash(__('The payment has been saved!'), 'flash_good');
                        $this->Billing->updatebillingstatus($data['Payment']['billing_id']);
                    } else
                    {
                        $this->Session->setFlash(__('The payment could not be saved. Please, try again.'), 'flash_bad');
                        $this->redirect(array('action' => 'index', 'failed', number_format($amount, 2)));
                    }
                }

                //Send Payment Email
                $email_data['name'] = $user['User']['first_name'];
                $email_data['unit_name'] = $user['Unit']['number'];
                $email_data['prop_name'] = $user['Property']['name'];
                $email_data['trans_id'] = $transactionid;
                $email_data['amount'] = $total_bill;
                $this->__sendPaymentSuccess($user['User']['email'], $email_data);
                $this->redirect(array('action' => 'index', 'success', number_format($amount, 2)));

            } else
            {
                $this->loadModel('FailedPayment');
                $failed = $data;
                $failed['FailedPayment']['billing_id'] = $data['Payment']['billing_id'];
                $failed['FailedPayment']['unit_id'] = $data['Payment']['unit_id'];
                $failed['FailedPayment']['user_id'] = $this->Auth->user('id');
                $failed['FailedPayment']['amount'] = $amt_processed;
                $failed['FailedPayment']['amt_fee'] = $amt_fee;
                $failed['FailedPayment']['ppresponse'] = '0';
                $failed['FailedPayment']['ppresponsetext'] = json_encode($payResult->info);
                $failed['FailedPayment']['ppauthcode'] = '';
                $failed['FailedPayment']['pptransactionid'] = $transactionid;
                $failed['FailedPayment']['ppresponse_code'] = '';
                $failed['FailedPayment']['type'] = $paymentType;
                if ( $this->FailedPayment->save($failed) )
                {
                    $this->Session->setFlash(__('The payment has failed. Please contact RentSquare Support'), 'flash_bad');
                    $this->redirect(array('action' => 'index'));
                } else
                {
                    $this->Session->setFlash(__('The payment has failed with error. Please contact RentSquare Support.'), 'flash_bad');
                }
            }
        }
    }

    function manualpayment($bc_id = null, $unit_id = null)
    {

        if ( $this->request->is('post') || $this->request->is('put') )
        {
            $data = $this->request->data;
            $data['Payment']['status'] = 'Complete';
            $data['Payment']['notes'] = 'Manual Payment';
            $data['Payment']['total_bill'] = $data['Payment']['amount'];
            if ( $this->Payment->save($data) )
            {
                $this->Session->setFlash(__('The payment has been saved'), 'flash_good');
                $this->loadModel('Billing');
                $this->Billing->updatebillingstatus($data['Payment']['billing_id']);
                $this->redirect(array('controller' => 'Billing', 'action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The payment could not be saved. Please, try again.'));
            }
        }
        $this->set('bc_id', $bc_id);
        $this->set('unit_id', $unit_id);
    }

    function rentreminder()
    {
        $message = $this->request->data['Payment']['message'];
        $emails = $this->request->data['Payment']['emails'];
        $names = $this->request->data['Payment']['first_names'];
        $unit_number = $this->request->data['Payment']['unit_number'];
        $rent_due = $this->request->data['Payment']['rent_due'];
        $payment_id = $this->request->data['Payment']['payment_id'];

        $arrEmails = explode(',', $emails);
        $arrNames = explode(',', $names);
        $success = true;
        $error_email = '';
        $i = 0;
        foreach ( $arrEmails as $email ):
            if ( !$this->__sendRentReminderManual($email, $message, $unit_number, $rent_due, $payment_id, $arrNames[ $i ], $this->request->data['Payment']['billing_start'], $this->request->data['Payment']['billing_end'], $this->request->data['Payment']['rent_period']) )
            {
                $success = false;
                $error_email = $email;
            }
            $i ++;
        endforeach;
        if ( $success == false )
            $this->Session->setFlash(__('Reminder email failed to: ' . $error_email), 'flash_bad');
        else
            $this->Session->setFlash(__('Reminder email sent.'), 'flash_good');
        $this->redirect(array('controller' => 'Billing', 'action' => 'index'));
    }

    private function __sendPaymentSuccess($email_address, $email_data)
    {

        $from = Configure::read('RentSquare.supportemail');

        $email = new CakeEmail();
        $email->domain('rentsquaredev.com');
        $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
        $email->template('paymentsuccess', 'generic')
            ->emailFormat('html')
            ->from(array($from => 'RentSquare Support'))
            ->to($email_address)
            ->subject('RentSquare Payment Receipt')
            ->viewVars(array(
                'email_data' => $email_data
            ))
            ->send();

        return true;
    }

    private function __sendRentReminderManual($emailTo, $message, $unit_number, $rent_due, $payment_id, $first_name, $billing_start, $billing_end, $rent_period)
    {
        $from = Configure::read('RentSquare.supportemail');
        try
        {
            $email = new CakeEmail();
            $email->domain('rentsquaredev.com');
            $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
            $email->template('manualreminder', 'generic')
                ->emailFormat('html')
                ->from(array($from => 'RentSquare Support'))
                ->to(trim($emailTo))
                ->subject('RentSquare Rent Reminder')
                ->viewVars(array(
                    'message'       => $message,
                    'unit_number'   => $unit_number,
                    'rent_due'      => $rent_due,
                    'payment_id'    => $payment_id,
                    'first_name'    => $first_name,
                    'billing_start' => $billing_start,
                    'billing_end'   => $billing_end,
                    'rent_period'   => $rent_period
                ))
                ->send();
        }
        catch ( Exception $e )
        {
            return false;
        }

        return true;

    }

}


?>
