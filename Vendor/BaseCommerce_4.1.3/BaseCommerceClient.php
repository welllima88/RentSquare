<?php

include 'TripleDESService.php';
include 'BaseCommerceClientException.php';
/**
 * Description of BaseCommerceClient
 * BaseCommerceClient is an entity that handles all of the client side work for creating and sending the request, 
 * as well as formatting and returning the response to the user.
 *
 * © Base Commerce
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Steven Wright <steven.wright@basecommerce.com>
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 */
class BaseCommerceClient {
    
    private $is_url = 'https://gateway.basecommerce.com';
    private $is_sandbox_url = 'https://gateway.basecommercesandbox.com';
    
    
    private $is_gateway_username;
    private $is_gateway_password;
    private $is_key;
    
    private $ib_sandbox;
    
    /**
     * 
     * Default Constructor
     * 
     */
    function __construct( $vs_gateway_username, $vs_gateway_password, $vs_key ) { 
        
        $this->is_gateway_username = $vs_gateway_username;
        $this->is_gateway_password = $vs_gateway_password;
        $this->is_key = $vs_key;
        $this->ib_sandbox = FALSE;
    }
    
        /**
     * Sets the bank card transaction to be processed through the sandbox environment.
     * 
     * @param $vb_sandbox true if it should be processed through the sandbox, false otherwise.
     */
    public function setSandbox( $vb_sandbox ) { $this->ib_sandbox = $vb_sandbox; }
    
    /**
     * Returns true if the bank card transaction is to be processed through the sandbox environment.
     * 
     * @return true if it should be processed through the sandbox, false otherwise.
     */
    public function isSandbox() { return $this->ib_sandbox; }
    
    /**
     * 
     * Returns a Bank Card Transaction given a specific id.
     * 
     * @param type $vn_bct_id     the id of a bank card transaction
     * @return the bank card transaction if one exists for the given id
     * @throws BaseCommerceClientException if an invalid bank card transaction id was give, invalid credentials were given or if there was an internal server error. Please contact tech support if there is an internal server error.
     */
    public function getBankCardTransaction( $vn_bct_id ) {
        $triple_des = new TripleDESService( $this->is_key );

        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $vn_bct_id;        
        
        $s_query = json_encode( $o_query );
        
        $response = $this->do_post_request( '/pcms/?f=API_getBankCardTransactionV4', $s_query, $triple_des );
        
        $o_bct = BankCardTransaction::buildFromJSON( $response["bank_card_transaction"] );
        
        if( array_key_exists( "exception", $response ) && !is_null( $response[ 'exception' ] ) ) {
            
            foreach ( $response['exception'] as $s_key => $s_error ) {
                $o_bct->addMessage( $s_error );
            }
            
        }
        
        return $o_bct;
    }
    
    /**
     * 
     * Processes the transaction using the specified BankCardTransaction.
     * Returns an updated BankCardTransaction containing the response information.
     * 
     * @param vo_bct    the bank card transaction
     * @return  the updated bank card transaction
     * @throws BaseCommerceClientException if invalid credentials were given or if there was an internal server error. Please contact tech support if there is an internal server error.
     */
    public function addBankCard( BankCard $vo_bc ) {
        $triple_des = new TripleDESService( $this->is_key );

        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $triple_des->encrypt( $vo_bc->getJSON() );        
        
        $s_query = json_encode( $o_query );
        
        $response = $this->do_post_request( '/pcms/?f=API_addBankCardV4', $s_query, $triple_des );
        
        $vo_bc = BankCard::buildFromJSON( $response["bank_card"] );
        
        if( array_key_exists( "exception", $response ) && !is_null( $response[ 'exception' ] ) ) {
            
            foreach ( $response['exception'] as $s_key => $s_error ) {
                $vo_bc->addMessage( $s_error );
            }
            
        }
        
        return $vo_bc;
    }
    
     /**
     * 
     * Processes the transaction using the specified BankCardTransaction.
     * Returns an updated BankCardTransaction containing the response information.
     * 
     * @param vo_bct    the bank card transaction
     * @return  the updated bank card transaction
     * @throws BaseCommerceClientException if invalid credentials were given or if there was an internal server error. Please contact tech support if there is an internal server error.
     */
    public function processBankCardTransaction( BankCardTransaction $vo_bct ) {
        $triple_des = new TripleDESService( $this->is_key );

        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $triple_des->encrypt( $vo_bct->getJSON() );        
        
        $s_query = json_encode( $o_query );
        
        $response = $this->do_post_request( '/pcms/?f=API_processBankCardTransactionV4', $s_query, $triple_des );

        $vo_bct = BankCardTransaction::buildFromJSON( $response["bank_card_transaction"] );

        if( array_key_exists( "exception", $response ) && !is_null( $response[ 'exception' ] ) ) {
            
            foreach ( $response['exception'] as $s_key => $s_error ) {
                $vo_bct->addMessage( $s_error );
            }
            
        }
        return $vo_bct;
    }
    
    /**
     * 
     * Returns a Bank Account Transaction given a specific id.
     * 
     * @param type $vn_bat_id     the id of a bank account transaction
     * @return the bank account transaction if one exists for the given id
     * @throws BaseCommerceClientException if an invalid bank card transaction id was give, invalid credentials were given or if there was an internal server error. Please contact tech support if there is an internal server error.
     */
    public function getBankAccountTransaction( $vn_bat_id ) {
        $triple_des = new TripleDESService( $this->is_key );

        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $vn_bat_id;        
        
        $s_query = json_encode( $o_query );
        
        $response = $this->do_post_request( '/pcms/?f=API_getBankAccountTransactionV4', $s_query, $triple_des );
        
        $o_bat = BankAccountTransaction::buildFromJSON( $response["bank_account_transaction"] );
        
        if( array_key_exists( "exception", $response ) && !is_null( $response[ 'exception' ] ) ) {
            
            foreach ( $response['exception'] as $s_key => $s_error ) {
                $o_bat->addMessage( $s_error );
            }
            
        }
        
        return $o_bat;
    }
    
    /**
     * 
     * Add a bank account to the system.
     * 
     * @param vo_bat    the bank account transaction
     * @return  the updated bank account transaction
     * @throws BaseCommerceClientException if invalid credentials were given or if there was an internal server error. Please contact tech support if there is an internal server error.
     */
    public function addBankAccount( BankAccount $vo_ba ) {
        $triple_des = new TripleDESService( $this->is_key );

        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $triple_des->encrypt( $vo_ba->getJSON() );        
        
        $s_query = json_encode( $o_query );
        
        $response = $this->do_post_request( '/pcms/?f=API_addBankAccountV4', $s_query, $triple_des );
        
        $vo_ba = BankAccount::buildFromJSON( $response["bank_account"] );
        
        if( array_key_exists( "exception", $response ) && !is_null( $response[ 'exception' ] ) ) {
            
            foreach ( $response['exception'] as $s_key => $s_error ) {
                $vo_ba->addMessage( $s_error );
            }
            
        }
        
        return $vo_ba;
    }
    
    /**
     * 
     * Processes the transaction using the specified BankAccountTransaction.
     * Returns an updated BankAccountTransaction containing the response information.
     * 
     * @param vo_bct    the bank account transaction
     * @return  the updated bank account transaction
     * @throws BaseCommerceClientException if invalid credentials were given or if there was an internal server error. Please contact tech support if there is an internal server error.
     */
    public function processBankAccountTransaction( BankAccountTransaction $vo_bat ) {
        $triple_des = new TripleDESService( $this->is_key );

        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $triple_des->encrypt( $vo_bat->getJSON() );        
        
        $s_query = json_encode( $o_query );
        
        $response = $this->do_post_request( '/pcms/?f=API_processBankAccountTransactionV4', $s_query, $triple_des );
        
        $vo_bat = BankAccountTransaction::buildFromJSON( $response["bank_account_transaction"] );
        
        if( array_key_exists( "exception", $response ) && !is_null( $response[ 'exception' ] ) ) {
            
            foreach ( $response['exception'] as $s_key => $s_error ) {
                $vo_bat->addMessage( $s_error );
            }
            
        }
        
        return $vo_bat;
    }
    
    public function submitApplication( MerchantApplication $vo_merch_app ) {
        
        $o_triple_des = new TripleDESService($this->is_key);
        
        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $o_triple_des->encrypt($vo_merch_app->getJSON());
        
        $s_query = json_encode( $o_query );

        $response = $this->do_post_request( '/pcms/?f=newSubmitApplication', $s_query, $o_triple_des );
//        printf("well");
//        print_r($response);
//        printf("well2\n");
        $o_merchant_applications = array();
        
        for ( $n_index = 0, $n_size = count( $response ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_merchant_applications, MerchantApplication::buildFromJSON( $response[$n_index] ) );
        }
        
        return $o_merchant_applications;
    }
    
    /**
     * 
     * Private helper function to send / recieve posts to the server.  
     * @param $url The url to attempt to post to 
     * @param $data The payload to send to the url
     * @param $triple_des  A triple DES object to decrypt messages from the server
     * @param $optional_headers  Optional headers
     * @return The decrypted response from the server
     * @throws BaseCommerceClientException    If anything goes wrong
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    private function do_post_request($url, $data, $triple_des, $optional_headers = null) {
        
        $s_url = "";
        if ( $this->ib_sandbox ) {
            $s_url = $this->is_sandbox_url.$url;
        } else {
            $s_url = $this->is_url.$url;
        }
        
        $params = array( 'http' => array(
            'method' => 'POST',
            'content' => $data,
            'header' => "Content-type: application/x-www-form-urlencoded") );
        if ($optional_headers !== null) {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        ini_set( 'user_agent', 'BaseCommerceClientPHP/4.1.3' );
        
        $fp = fopen($s_url, 'rb', false, $ctx);
        if (!$fp) {
            $lasterror = error_get_last();
            $error = $lasterror['message'];
            if (strpos($error,'403') !== false) {
                throw new BaseCommerceClientException('Invalid Credentials.', '403');
            } else if (strpos($error,'500') !== false) {
                throw new BaseCommerceClientException('Internal Server Error. Please contact tech support.', '500');
            } else if (strpos( $error, '404' ) != false ) {
                throw new BaseCommerceClientException('Invalid url or host is offline.', '404');
            }
            throw new BaseCommerceClientException($error);
        }
        
        $response = stream_get_contents($fp);
        
        if ($response === false) {
            $lasterror = error_get_last();
            $error = $lasterror['message'];
            if (strpos($error,'403') !== false) {
                throw new BaseCommerceClientException('Invalid Credentials.', '403');
            } else if (strpos($error,'500') !== false) {
                throw new BaseCommerceClientException('Internal Server Error. Please contact tech support.', '500');
            } else if (strpos($error,'404') !== false) {
                throw new BaseCommerceClientException('Invalid url or host is offline.', '404');
            }
            throw new BaseCommerceClientException($error);
        }
        $decrypted_response = $triple_des->decrypt( $response );
        
        $decrypted_response = trim($decrypted_response, "\x00..\x1F");
        
        $decrypted_response = json_decode($decrypted_response,TRUE);
        
        return $decrypted_response;
    }
    
    /**
     * creates a push notification from the passed in string
     * 
     * @param type $vs_json the passed in string
     * @return the push notification
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function handlePushNotification( $vs_json ) {
        $triple_des = new TripleDESService( $this->is_key );
        $o_json = $triple_des->decrypt( $vs_json );
        $o_json = trim($o_json, "\x00..\x1F");
        $o_json = json_decode($o_json,TRUE);

        if( array_key_exists( "push_notification_type", $o_json ) && $o_json[ "push_notification_type" ] == PushNotification::$XS_PN_TYPE_JSON )  {
            $o_return = JSONPushNotification::buildFromJSON(  $o_json  );
        } else {
            $o_return = PushNotification::buildFromJSON(  $o_json  );
        }
        return $o_return;
    }
    
    /**
     * Sets the merchants push notification url
     * @param type $vs_url the url
     * @return a JSON object with success if it worked and exception if not
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setPushNotificationURL( $vs_url ) {
        
        $o_triple_des = new TripleDESService($this->is_key);
        $o_return = "";
                
        $o_payload = array();
        $o_payload['url'] = $vs_url;
        
        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $o_triple_des->encrypt( json_encode( $o_payload ) );
        
        $s_query = json_encode( $o_query );

        $response = $this->do_post_request( '/pcms/?f=API_setPushNotificationURLV4', $s_query, $o_triple_des );
        
        if( array_key_exists( "success", $response ) ) {
            $o_return = $response[ "success" ];
        } else {
            $o_temp = $response[ "exception" ];
            $o_return = $o_temp[ "exception" ];
        }

        return $o_return;
        
    }
    
    /**
     * sends a ping JSON object to ping the server
     * @return true if everything worked, false if not
     * @throws BaseCommerceClientException if an underlying error occurs
     * @author Rob Kurst <rob.kurst@basecommerce.com> 
     */
    public function sendPing() {
        
        $b_return = FALSE;
        
        $triple_des = new TripleDESService( $this->is_key );

        $o_query = array();
        $o_payload_array = array();
        $o_payload_array['PING'] = "Ping Ping";
        
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $triple_des->encrypt( json_encode( $o_payload_array ) );

        $s_query = json_encode( $o_query );
        
        $response = $this->do_post_request( '/pcms/?f=API_PingPong', $s_query, $triple_des );
        
        if( array_key_exists( "success", $response ) ) {
            $b_return = TRUE;
        }

        return $b_return;
        
    }
    

    /**
     * Processes a generic Request.
     * @param type $vs_json the request json
     * @return a json object string that holds the return data
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function processRequest( $vs_json ) {
        
        $o_triple_des = new TripleDESService($this->is_key);
        
        $o_query = array();
        $o_query['gateway_username'] = $this->is_gateway_username;
        $o_query['gateway_password'] = $this->is_gateway_password;
        $o_query['payload'] = $o_triple_des->encrypt( json_encode( $vs_json ) );
        
        $s_query = json_encode( $o_query );

        $response = $this->do_post_request( '/pcms/?f=API_processRequest', $s_query, $o_triple_des );
        
        return $response;        
        
    }
    

}

?>
