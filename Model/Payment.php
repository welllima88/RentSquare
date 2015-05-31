<?php

	class Payment extends AppModel{
  	  public $name = 'Payment';

    	public $validate = array();
    	    	
    	public $belongsTo = array('Unit','Billing','User');
    	
    	public $actsAs = array('Containable');
      
      public function processPayment($amount=null,$vault_id=null,$user=null,$password=null){
        
         if($amount != null && $vault_id != null && $user != null && $password != null){
           //Submit Payment
      		  $url = 'https://gateway.teledraft.com/api/transact.php';
            
            //Get State Name
            $fields = array( 
    
              //Set Variables To Pass To Phoenix Payments
              'username'=>urlencode($user),
              'password'=>urlencode($password),
              'amount'=>urlencode($amount),
              'customer_vault_id'=>urlencode($vault_id)
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
            $results = curl_exec($ch);
            
            //close connection
            curl_close($ch);
            
            return $results;
         } else {
           return false;
         }
            
    
      }	
	};
?>