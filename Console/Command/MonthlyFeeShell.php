<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Router', 'Routing');
config('routes');
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');
App::import('Vendor', 'Paymethodutils', array('file' => 'Interfaces/PayMethods/PayMethodUtils.php'));
/* 
 * If processor ever changes, need to write a new class to the interface, and load it here
 *  The only thing to change is in the instantion -- pass the new class as an arg to Paymethodutils
 */
App::import('Vendor', 'Paymethodbasecommerce', array('file' => 'Interfaces/PayMethods/PayMethodBasecommerce.php'));

class MonthlyFeeShell extends AppShell {

    public $uses = array('Property','Payment','FailedPayment','App');

    public function main(){
        
        //Get all properties where fee_due_day = today
        $properties = $this->Property->find('all',array(
          'conditions'=>array(
            'fee_due_day'=> (string)date('j'),
            'active'=>1
          ),
          'contain'=>('Manager')
        ));

        //Loop through properties
        foreach($properties as $property):
          //Determine Cost base on number of units. If actual unit_count in system is greater
          //than num_units provided by user, charge actual number
          if($property['Property']['num_units'] > $property['Property']['unit_count']){
            $amount = $this->get_monthly_fee($property['Property']['num_units']);
          } else {
            $amount = $this->get_monthly_fee($property['Property']['unit_count']);
          }
              
          //Process One Time Fee Payment to RentSquare
          // Data needed - payer_vault_id, total_amt .... rsq_valut_id & fee_amt not needed as those are for convenience fee only
          // pay_method defaults to ach if not set to CC
          $paydata = array();
          $paydata['total_amt'] = $amount;
          $paydata['payer_vault_id'] = $property['Property']['vault_id'];

          Debugger::log( $paydata );

          $this->payutil = new Paymethodutils(new Paymethodbasecommerce);
          $jpayrsl = $this->payutil->subscriberPayment( $paydata );
          $payrsl = json_decode($jpayrsl);
  		      
          Debugger::log( $payrsl );

	  if(isset($payrsl) && !empty($payrsl) && $payrsl->status == 1)
          {
             $this->out('Monthly Fee Successful Charged for Property #'.$property['Property']['id'].' - '.$property['Property']['name']);
             //Send Payment Success Email
             $transactionid = $payrsl->info;
             $email_data['manager_name'] = $property['Manager']['first_name'] . ' ' . $property['Manager']['last_name'];
             $email_data['property_name']=$property['Property']['name'];
             $email_data['amount'] = $amount;
             $email_data['trans_id'] = $transactionid;
             if($this->__sendPaymentSuccess($property['Manager']['email'],$email_data))
             {
               $this->out("Payment Received Email Sent To ".$property['Manager']['email']);
             }
             $monthly_fee = array();
  	     $monthly_fee['Payment']['ppresponse'] = '1';
  	     $monthly_fee['Payment']['ppresponsetext'] = 'success';
             $monthly_fee['Payment']['ppauthcode'] = '';
             $monthly_fee['Payment']['pptransactionid']	= $transactionid;
             $monthly_fee['Payment']['ppresponse_code'] = '';
             $monthly_fee['Payment']['status'] = 'Complete';
      	     $monthly_fee['Payment']['notes'] = 'Monthly Fee';
       	     $monthly_fee['Payment']['user_id'] = $property['Manager']['id'];
       	     $monthly_fee['Payment']['billing_id'] = 0;
       	     $monthly_fee['Payment']['unit_id'] = 0;
       	     $monthly_fee['Payment']['amount'] = $amount;
       	     $monthly_fee['Payment']['is_fee'] = 0;
       	     $monthly_fee['Payment']['amt_fee'] = 0;
       	     $monthly_fee['Payment']['amt_processed'] = floatval($amount);
       	     $monthly_fee['Payment']['total_bill'] = floatval($amount);
        			
             //Add to Payments Table
             $this->Payment->create();
             if ($this->Payment->save($monthly_fee))
             {
                $this->out("Monthly Fee Saved To Database");
             }
          }
          else
          {
             $responsetext = implode(",",$payrsl->info);
             $transactionid = '';
             $failed=$property;
             $failed['FailedPayment']['billing_id'] = 0;
             $failed['FailedPayment']['unit_id'] = 0;
             $failed['FailedPayment']['user_id'] = $property['Property']['manager_id'];
             $failed['FailedPayment']['amount'] = $amount;
             $failed['FailedPayment']['ppresponse'] = '0';
             $failed['FailedPayment']['ppresponsetext'] = $responsetext;
             $failed['FailedPayment']['ppauthcode'] = '';
             $failed['FailedPayment']['pptransactionid'] = $transactionid;
             $failed['FailedPayment']['ppresponse_code'] = '';
             $failed['FailedPayment']['notes'] = "Failed Monthly Fee Charge. Property id ".$property['Property']['id'];
             $this->FailedPayment->save($failed);
             $this->out('Failed Monthly Fee Charge. Property id '.$property['Property']['id'] . ' => '.$responsetext);                
          }
                     
        endforeach;
        
      }

      private function __sendPaymentSuccess($email_address,$email_data)
      {
	$from = Configure::read('RentSquare.supportemail');
    
    	$email = new CakeEmail();
    	$email->config('default');
    	$email->domain('rentsquaredev.com');
    	$email->sender('noreply@rentsquaredev.com','RentSquare Support');
    	$email->template('monthlyfeesuccess', 'generic')
    		->emailFormat('html')
    		->from(array($from => 'RentSquare Support'))
    		->to($email_address)
    		->subject('RentSquare Payment Receipt')
    		->viewVars(array(
      			'email_data'   => $email_data
      		))

    		->send();
    
    	return true;
    	}	
    	
    	private function get_monthly_fee($num_units){
            //0 - 25 units - $25
            if($num_units <= 25){
              return MONTHLY_25_OR_LESS;
            }
            //26 - 50 units - $50
            if($num_units <= 50){
              return MONTHLY_26_TO_50;
            }
            //51 - 100 units - $75
            elseif($num_units <= 100){
              return MONTHLY_51_TO_100;
            }
            //101 - 200 units - $125
            elseif($num_units <= 200){
              return MONTHLY_101_TO_200;
            }
            //201 - 300 units - $175
            elseif($num_units <= 300){
              return MONTHLY_201_TO_300;
            }
            //301 - 400 units - $225
            elseif($num_units <= 400){
              return MONTHLY_301_TO_400;
            }
            //400++ units - $275
            elseif($num_units > 400){
              return MONTHLY_OVER_400;
            }
            else{
              return 25;
            }
        }
  
}
