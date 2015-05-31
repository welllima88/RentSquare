<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Sanitize', 'Utility');
App::uses('Security', 'Utility');
Configure::write('Security.salt2','R1ysi!84$093dw28vH0ehe82Lsvndeu2r#729(8378sbe');
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');

class UpdateBillingShell extends AppShell {

    public $uses = array('User','Payment','Billing','Unit','Property','FailedPayment');

    public function main(){
      
      $this->out(date("Y-m-d H:i:s").' - Start');
      
      $this->Billing->recursive = 0;
	   
/*        
      Nightly Payments Update Logic
      ------------------------
      
      //Logic to 
      //Create new billing cycle 
      Get all Units
      	Loop through each unit
      	If Unit Has Resident
      		if Current_Due_Date <= today AND Current_Due_Date < Lease_End
      			Create New Billing Cycle
      				Calculate Rent Due = Rent Total + One Time Fee + Recurring Fee - Free Rent + CC fees - Rent Credit
      					ACH => Rent Total + recurring fee - free rent + fee $3.95 (fee only if tenant paying fees)
      					CC/Debit - Rent Total + recurring fee - free rent + fee  2.75% (fee only if tenant percent)
      				Update last due date
      		if has one time fee, create record
*/

	    //Find All Units
  		$units = $this->Billing->Unit->find('all',array('conditions'=>array('Unit.active'=>1)));
  		
  		//Loop through each Unit
  		foreach($units as $unit):

  		  //if unit has residents
  		  if($this->User->find('count', array('conditions' => array('User.unit_id' => $unit['Unit']['id']))) > 0):

      		//if Current Due Date <= Today and Current Due Date < End of Lease, then Create New Record
          $current_due_date = strtotime ($unit['Unit']['current_due_date']);
          if ($current_due_date <= time() &&  $current_due_date < strtotime ($unit['Unit']['lease_end'])){
            $data = array();
            $billing_end = $this->Billing->Unit->set_billing_end_date($unit);
            $total_fees =  $this->Billing->Unit->getRentTotal($unit['Unit']['id'],date("Y-m-d H:i:s",strtotime($unit['Unit']['current_due_date'])),$billing_end);
            $data["Billing"] = array(
              'unit_id' => $unit['Unit']['id'],
              'property_id' => $unit['Unit']['property_id'],
              'rent_due'=> $total_fees['Rent']['Total'],
              'balance'=> $total_fees['Rent']['Total'],
              'status'=>'unpaid',
              'billing_start'=>date("Y-m-d H:i:s",strtotime($unit['Unit']['current_due_date'])),
              'billing_end'=>$billing_end
            );
            $data['BillingFee'] = $total_fees['BillingFee'];
            $this->Billing->create();
            if($this->Billing->saveAll($data)){
              $this->out('Billing #'.$this->Billing->id.' created for Unit'.$unit['Unit']['number']);
              //Check for Unit Credit
              if(floatval($unit['Unit']['rent_credit']) > 0){
                //Determine amount of credit to use
                $credit_amount = 0;
                //if credit is greater than rent due, subtract rent due from credit
                if(floatval($unit['Unit']['rent_credit']) > $total_fees['Rent']['Total']){
                  $credit_amount = floatval($unit['Unit']['rent_credit']) - floatval($total_fees['Rent']['Total']);
                } else {
                  $credit_amount = floatval($unit['Unit']['rent_credit']);
                }
                $payment["Payment"] = array(
                  'billing_id' => $this->Billing->id,
                  'unit_id' => $unit['Unit']['id'],
                  'user_id' => 1,
                  'type'=>'Credit',
                  'amount'=> $credit_amount,
                  'status'=>'Complete',
                  'notes'=>'Unit Credit'
                );
                //save payment
                $this->Billing->Payment->create();
                if($this->Billing->Payment->saveAll($payment)){
                  //update credit 
                  $this->Unit->id = $unit['Unit']['id'];
                  $this->Unit->saveField('credit',$unit['Unit']['rent_credit'] - $credit_amount); 
                }
              }
            }
            
            //Update current due date
            $this->Billing->Unit->id = $unit['Unit']['id'];
            $this->Billing->Unit->saveField('current_due_date',$billing_end); 
            if(strtotime($billing_end) < time()){
              $this->out(date("Y-m-d H:i:s") . ' - Billing End Date is before Today for Unit '.$unit['Unit']['id']);
            }
          } 
          else{
           //Do nothing
          }
          
          //if has one time fee, create record
          foreach($unit['UnitFee'] as $unit_fee):
            if($unit_fee['one_time'] && $unit_fee['one_time_status'] == 'P'): //P -> Pending
              //Create Billing
              $data = array();
              $data["Billing"] = array(
                'unit_id' => $unit['Unit']['id'],
                'property_id' => $unit['Unit']['property_id'],
                'rent_due'=> $unit_fee['amount'],
                'balance'=> $unit_fee['amount'],
                'status'=>'unpaid',
                'billing_start'=>date("Y-m-d H:i:s"),
                'billing_end'=>date("Y-m-d H:i:s",strtotime($unit_fee['one_time_date'])),
                'type'=>'One Time Fee'
              );
              $data['BillingFee'][0]['name'] = 'One Time Fee - '.$unit_fee['name'];
              $data['BillingFee'][0]['amount'] = floatval($unit_fee['amount']);
              $this->Billing->create();
              if($this->Billing->saveAll($data)){
                $this->out('Billing Cycle #'.$this->Billing->id.' created for One Time Fee for Unit'.$unit['Unit']['number']);
                $this->Billing->Unit->UnitFee->id = $unit_fee['id'];
                $this->Billing->Unit->UnitFee->saveField('one_time_status','C');
                //__sendOneTimeFeeMail
              }
            endif; // if Unit Fee is One Time Fee
          endforeach; //foreach Unit Fee
          
        endif; //if unit has resident
  		endforeach; //foreach unit
  		$this->out(date("Y-m-d H:i:s") . ' - All Unit Loop Complete');
  		
  		/*
  		Get all open Billing Cycles not paid (unpaid,due,late)
           if unpaid
                 check if paid
      		mark as paid
                 if no paid
      		if due date = current date
      			set status = due
      			check Reminder Email [email_for_rent]
      		else
      			check Invoice Email [invoice_day]
      			check Reminder Email [before_due_reminder][before_due_days]
         
         if due
      	check if paid
      		mark as paid
              if no pay
      			mark as late
      if late
        assign late fee
    */        
    $this->Billing->Behaviors->load('Containable');
    $billing_cycles = $this->Billing->find('all',array(
        'conditions'=>array('status !=' => 'paid'),
        'contain' => array('Unit'=>array('Property'))
    ));
    
    foreach($billing_cycles as $billing_cycle):
      $this->Billing->id = $billing_cycle['Billing']['id'];
      $total_payments = 0;
      $total_payments = $this->Billing->Payment->find('all',array('fields'=>'sum(Payment.amount) as total_payment', 'conditions' => array('Payment.billing_id' => $billing_cycle['Billing']['id'])));
      $total_paid =  $total_payments[0][0]['total_payment'];
      if($total_paid > $billing_cycle['Billing']['rent_due']){
        //Over Paid
        //Mark as Paid
        $this->Billing->saveField('status','paid');
        //Add Credit [Add Code]
      } else if($total_paid == $billing_cycle['Billing']['rent_due']){
        //Paid In full
        //Mark as Paid
        $this->Billing->saveField('status','paid');
      } else if(0 >= $billing_cycle['Billing']['rent_due']){ 
        //If Rent is 0, Mark as Paid
        $this->Billing->saveField('status','paid');
      }
      else{
        //Not Paid
        //if due date = current date
        if(date('Ymd',strtotime($billing_cycle['Billing']['billing_end'])) == date('Ymd')):
            // set status = due
            $this->Billing->saveField('status','due');
            
            //if tenant checked Rent Reminder Email [User][email_for_rent], send email
            $tenants = $this->User->find('all', array(
                  'conditions' => array('User.unit_id' => $billing_cycle['Billing']['unit_id']),
                  'contain'=> array(
                    'AutoPayment' => array(
                        'order' => 'AutoPayment.created DESC',
                        'limit' => 1
                    ),
                    'PaymentMethod',
                    'Property'
                  )
                  ));
            foreach($tenants as $tenant):
              //Check to see if tenant has auto pay on
              if(isset($tenant['AutoPayment']) && count($tenant['AutoPayment']) > 0 && $billing_cycle['Billing']['type']=='Rent'){
                //If active and in time frame
                if($tenant['AutoPayment'][0]['active'] && (strtotime($tenant['AutoPayment'][0]['auto_start']) <= time() && time() <= strtotime($tenant['AutoPayment'][0]['auto_end']))){
                  //$tenant['AutoPayment'][0]['vault_id']
                  //$tenant['AutoPayment'][0]['amount']
                  //Charge Fee based on ACH or CC
                  //Determine Transaction Fees
                    $pay_amount = $tenant['AutoPayment'][0]['amount'];
                    $total_amount=0;
                    //Is selected payment CC or ACH
                    //ACH => Rent Total + recurring fee - free rent + fee $3.95 (fee only if tenant paying fees)
        					  //CC/Debit - Rent Total + recurring fee - free rent + fee  2.75% (fee only if tenant percent)
        					  //if ACH
        					    //if tenant pays
        					      //add $3.95
        					  //else CC
        					    //if tenant pays
        					      //add2.75%
                    $i=0;
                    foreach($tenant['PaymentMethod'] as $paymentMethod):
                      if($paymentMethod['vault_id'] == $tenant['AutoPayment'][0]['vault_id']){
                         $paymentType = $tenant['PaymentMethod'][$i]['type'];
                         break;
                      }
                      $i++;
                    endforeach;
                    if($paymentType == 'CC'){
                      //Payment is Credit Card
                      if($tenant['Property']['prop_pays_cc_fee']){
                        $total_amount = $pay_amount;
                      } else {
                        $total_amount = floatval($pay_amount) + (floatval($pay_amount) * floatval(CC_FEE));
                      }
                    } else {
                      //Payment is ACH
                      if($tenant['Property']['prop_pays_ach_fee']){
                        $total_amount = $pay_amount;
                      } else {
                        $total_amount = floatval($pay_amount) + floatval(ACH_FEE);
                      }
                    }
                                    
                  $result = $this->Payment->processPayment($total_amount,$tenant['AutoPayment'][0]['vault_id'],$tenant['Property']['pp_user'],Security::rijndael($tenant['Property']['pp_pass'], Configure::read('Security.salt2'),'decrypt'));

                  parse_str($result);
                      
            			if (isset($response) && $response == 1) {	 
            			      $auto_payment = array();
            			      $auto_payment['Payment']['ppresponse'] = $response;
            			      $auto_payment['Payment']['ppresponsetext'] = $responsetext;
                        $auto_payment['Payment']['ppauthcode'] = $authcode;
                        $auto_payment['Payment']['pptransactionid']	= $transactionid;
                        $auto_payment['Payment']['ppresponse_code'] = $response_code;
                  			$auto_payment['Payment']['status'] = 'Complete';
                  			$auto_payment['Payment']['notes'] = 'Auto Payment';
                  			$auto_payment['Payment']['user_id'] = $tenant['User']['id'];
                  			$auto_payment['Payment']['billing_id'] = $billing_cycle['Billing']['id'];
                  			$auto_payment['Payment']['unit_id'] = $billing_cycle['Billing']['unit_id'];
                  			$auto_payment['Payment']['amount'] = $tenant['AutoPayment'][0]['amount'];
                        //Add to Payments Table
                        if ($this->Payment->save($auto_payment)) {
                          $this->Billing->updatebillingstatus($billing_cycle['Billing']['id']);
                          $this->out($billing_cycle['Billing']['id'] .' - Applied Auto Payment of '.$tenant['AutoPayment'][0]['amount']);
                          //Send Email Payment was processed
                          $email_data['name']=$tenant['User']['first_name'];
                          $email_data['amount'] = $total_amount;
                          $email_data['trans_id'] = $transactionid;
                          $email_data['unit_name'] = $billing_cycle['Unit']['number'];
                          $email_data['prop_name'] = $billing_cycle['Unit']['Property']['name'];
                          if($this->__sendAutoPaymentSuccess($tenant['User']['email'],$email_data)){
                            $this->out('Payment Received Email sent to '.$tenant['User']['email']);
                          }
                  			}
                  }else{
                        //$failed=$data;
                        $failed = array();
                        $failed['FailedPayment']['billing_id'] = $billing_cycle['Billing']['id'];
                        $failed['FailedPayment']['unit_id'] = $billing_cycle['Billing']['unit_id'];
                        $failed['FailedPayment']['user_id'] = $tenant['User']['id'];
                        $failed['FailedPayment']['amount'] = $tenant['AutoPayment'][0]['amount'];
                        $failed['FailedPayment']['ppresponse'] = $response;
                        $failed['FailedPayment']['ppresponsetext'] = $responsetext;
                        $failed['FailedPayment']['ppauthcode'] = $authcode;
                        $failed['FailedPayment']['pptransactionid']	= $transactionid;
                        $failed['FailedPayment']['ppresponse_code'] = $response_code;
                        if($this->FailedPayment->save($failed)){
                          $this->out($billing_cycle['Billing']['id'] .' - Auto Payment FAILED');
                        }
                      
                  }
                }
              }else{
                //Else check to see if tenant wants an email reminder
                if($tenant['User']['email_for_rent'] == true):
                  //set data to pass
                  $data = array(
                    'unit_num'=>$billing_cycle['Unit']['number'],
                    'rent_due'=>$billing_cycle['Billing']['rent_due'],
                    'first_name'=>$tenant['User']['first_name'],
                    'billing_start'=>$billing_cycle['Billing']['billing_start'],
                    'billing_end'=>$billing_cycle['Billing']['billing_end'],
                    'property_name'=>$tenant['Property']['name']
                  );
                  if($this->__sendRentDueReminderMail($tenant['User']['email'],$data))
                      $this->out($billing_cycle['Billing']['id'].' - Sent Rent Due Reminder To '.$tenant['User']['email']);
                  else
                      $this->out($billing_cycle['Billing']['id'].' - Error sending Rent Due Reminder To '.$tenant['User']['email']);
                endif;
              }
            endforeach;
       
      // check if late     
        elseif(strtotime($billing_cycle['Billing']['billing_end']) < time()):
            // set status = late
            $this->Billing->saveField('status','late');
            
            //Charge Auto Late Fee if Checked
            if($billing_cycle['Unit']['Property']['auto_late_fee']):
                //$property['day_rent_late'] => Days after rent due
                $late_fee_day = $billing_cycle['Unit']['Property']['day_rent_late'];
                // if today - $late_fee_day is equal to billing end, charge late fee
                if( date('Ymd',strtotime('-'.$late_fee_day.' days')) == date('Ymd',strtotime($billing_cycle['Billing']['billing_end']))):
                    //$property['auto_late_fee_amt'] => Late Fee Amt  
                    //Charge late fee
                    if(!$billing_cycle['Billing']['auto_late_fee']){
                        if($this->Billing->addLateFee($billing_cycle['Billing']['id'],$billing_cycle['Unit']['Property']['auto_late_fee_amt'],true)){
                          $this->out($billing_cycle['Billing']['id']. ' - Auto Late Fee of $'.$billing_cycle['Unit']['Property']['auto_late_fee_amt'].' charged');
                        } else {
                          $this->out($billing_cycle['Billing']['id'] . ' - Auto Late Fee for Billing Id '.$billing_cycle['Billing']['id'].' failed.');
                        }
                    } else {
                      $this->out($billing_cycle['Billing']['id'] . ' - Auto Late Fee for Billing Id '.$billing_cycle['Billing']['id'].' already charged.');

                    }
                    
                endif;
            endif; //$property['auto_late_fee'] => Checkbox
                      
            //if tenant checked Rent Reminder Email [User][email_for_rent], send email
            $tenants = $this->User->find('all', array('conditions' => array('User.unit_id' => $billing_cycle['Billing']['unit_id'])));
            foreach($tenants as $tenant):
              if($tenant['User']['email_for_rent'] == true):
                //set data to pass
                $data = array(
                  'unit_num'=>$billing_cycle['Unit']['number'],
                  'rent_due'=>$billing_cycle['Billing']['rent_due'],
                  'first_name'=>$tenant['User']['first_name'],
                  'billing_start'=>$billing_cycle['Billing']['billing_start'],
                  'billing_end'=>$billing_cycle['Billing']['billing_end'],
                  'property_name'=>$tenant['Property']['name']
                );
                if($this->__sendRentLateReminderMail($tenant['User']['email'],$data))
                    $this->out($billing_cycle['Billing']['id'] .' - Sent Late Reminder To '.$tenant['User']['email']);
                else
                    $this->out($billing_cycle['Billing']['id'] .' - Error sending Late Reminder To  '.$tenant['User']['email']);
              endif;
            endforeach;
        
        else:
          // 		else not late and not due
          // 			check Invoice Email [invoice_day]
          //Get Property to check invoice_day - Invoice blank days before rent due
          $invoice_day = $billing_cycle['Unit']['Property']['invoice_day'];
          
          // if today + invoice days is equal to due date
          if( date('Ymd',strtotime('+'.$invoice_day.' days')) == date('Ymd',strtotime($billing_cycle['Billing']['billing_end']))):
              //Get Tenants and Send Invoice Email
              $tenants = $this->User->find('all', array('conditions' => array('User.unit_id' => $billing_cycle['Billing']['unit_id'])));
              foreach($tenants as $tenant):
                if($tenant['User']['email_for_rent'] == true):
                  //set data to pass
                  $data = array(
                    'unit_num'=>$billing_cycle['Unit']['number'],
                    'rent_due'=>$billing_cycle['Billing']['rent_due'],
                    'first_name'=>$tenant['User']['first_name'],
                    'billing_start'=>$billing_cycle['Billing']['billing_start'],
                    'billing_end'=>$billing_cycle['Billing']['billing_end'],
                    'property_name'=>$billing_cycle['Unit']['Property']['name']
                  );
                  if($this->__sendInvoiceMail($tenant['User']['email'],$data))
                      $this->out($billing_cycle['Billing']['id']. ' - Sent Invoice To '.$tenant['User']['email']);
                  else
                      $this->out($billing_cycle['Billing']['id'] .' - Error sending invoice To '.$tenant['User']['email']);
                endif;
              endforeach;
              
          endif;//End check if Invoice Day
          
          //check Reminder Email [before_due_reminder][before_due_days]
          if($billing_cycle['Unit']['Property']['before_due_reminder']):
            $reminder_day = $billing_cycle['Unit']['Property']['before_due_days'];
            // if today + reminder days is equal to due date
            if( date('Ymd',strtotime('+'.$reminder_day.' days')) == date('Ymd',strtotime($billing_cycle['Billing']['billing_end']))):
                //Get Tenants and Send Reminder Email
                $tenants = $this->User->find('all', array('conditions' => array('User.unit_id' => $billing_cycle['Billing']['unit_id'])));
                foreach($tenants as $tenant):
                  if($tenant['User']['email_for_rent'] == true):
                    //set data to pass
                    $data = array(
                      'unit_num'=>$billing_cycle['Unit']['number'],
                      'rent_due'=>$billing_cycle['Billing']['rent_due'],
                      'first_name'=>$tenant['User']['first_name'],
                      'billing_start'=>$billing_cycle['Billing']['billing_start'],
                      'billing_end'=>$billing_cycle['Billing']['billing_end'],
                      'property_name'=>$billing_cycle['Unit']['Property']['name']
                    );
                    if($this->__sendCourtesyReminderMail($tenant['User']['email'],$data))
                        $this->out($billing_cycle['Billing']['id']. ' - Sent Courtesy Reminder To '.$tenant['User']['email']);
                    else
                          $this->out($billing_cycle['Billing']['id'] .' - Error sending courtesy reminder To '.$tenant['User']['email']);
                    endif;
                endforeach;
                
            endif;//End check if Before Due Reminder Day
          
          endif; //if($property['before_due_reminder'])
        
        endif;
     
     
        
      }
      
    endforeach; //$billing_cycles as $billing_cycle

    $this->out(date("Y-m-d H:i:s").' - End');    
  }
      
      private function __sendInvoiceMail($email_address,$data)
    	{
    		
    			$from = Configure::read('RentSquare.supportemail');
    
          try{
            $email = new CakeEmail();
      			$email->domain('rentsquaredev.com');
      			
      			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
      			
            $result = $email->template('rentinvoice','generic')
      				->emailFormat('html')
      				->from(array($from => 'RentSquare Support'))
      				->to($email_address)
      				->subject('Rent Invoice - RentSquare')
      				->viewVars(array(
      					'unit_num'   => $data['unit_num'],
      					'rent_due' => $data['rent_due'] ,
      					'first_name' => $data['first_name'],
      					'billing_start'=>$data['billing_start'],
                'billing_end'=>$data['billing_end'],
                'property_name'=>$data['property_name']
      				))
      				->send();
          } catch(Exception $e){
            return false;
          }
    			
          
    			return true;
    	}
    	
    	private function __sendAutoPaymentSuccess($email_address,$email_data)
    	{
    		
    			$from = Configure::read('RentSquare.supportemail');
    
    			$email = new CakeEmail();
    			$email->domain('rentsquaredev.com');
    			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
    			$email->template('autopaymentsuccess', 'generic')
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
    	
    	private function __sendCourtesyReminderMail($email_address,$data)
    	{
    		
    			$from = Configure::read('RentSquare.supportemail');
    
          try{
            $email = new CakeEmail();
      			$email->domain('rentsquaredev.com');
      			
      			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
      			
            $result = $email->template('rentcourtesyreminder','generic')
      				->emailFormat('html')
      				->from(array($from => 'RentSquare Support'))
      				->to($email_address)
      				->subject('Rent Due Soon - RentSquare')
      				->viewVars(array(
      					'unit_num'   => $data['unit_num'],
      					'rent_due' => $data['rent_due'] ,
      					'first_name' => $data['first_name'],
      					'billing_start'=>$data['billing_start'],
                'billing_end'=>$data['billing_end'],
                'property_name'=>$data['property_name']
      				))
      				->send();
          } catch(Exception $e){
            return false;
          }
    			
          
    			return true;
    	}
    	
    	
      private function __sendRentDueReminderMail($email_address,$data)
    	{
    		
    			$from = Configure::read('RentSquare.supportemail');
    
          try{
            $email = new CakeEmail();
      			$email->domain('rentsquaredev.com');
      			
      			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
      			
            $result = $email->template('rentdue','generic')
      				->emailFormat('html')
      				->from(array($from => 'RentSquare Support'))
      				->to($email_address)
      				->subject('Rent Due Reminder - RentSquare')
      				->viewVars(array(
      					'unit_num'   => $data['unit_num'],
      					'rent_due' => $data['rent_due'] ,
      					'first_name' => $data['first_name'],
      					'billing_start'=>$data['billing_start'],
                'billing_end'=>$data['billing_end'],
                'property_name'=>$data['property_name']
      				))
      				->send();
          } catch(Exception $e){
            return false;
          }
    			
          
    			return true;
    	}
    	  

    	private function __sendRentLateReminderMail($email_address,$data)
    	{
    		
    			$from = Configure::read('RentSquare.supportemail');
    
          try{
              $email = new CakeEmail();
        			$email->domain('rentsquaredev.com');
        			
        			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
        			
              $result = $email->template('rentlate','generic')
        				->emailFormat('html')
        				->from(array($from => 'RentSquare Support'))
        				->to($email_address)
        				->subject('Rent Late Reminder - RentSquare')
        				->viewVars(array(
        					'unit_num'   => $data['unit_num'],
        					'rent_due' => $data['rent_due'] ,
        					'first_name' => $data['first_name'],
        					'billing_start'=>$data['billing_start'],
                  'billing_end'=>$data['billing_end'],
                  'property_name'=>$data['property_name']
        				))
        				->send();
          } catch(Exception $e){
            return false;
          }          
    			return true;
    	}
    	  
}



