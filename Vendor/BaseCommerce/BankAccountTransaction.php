<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BankAccountTransaction
 *
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 * @author Steven Wright <steven.wright@basecommerce.com>
 */
class BankAccountTransaction {
    
    static $XS_BAT_TYPE_CREDIT = "CREDIT";
    static $XS_BAT_TYPE_DEBIT = "DEBIT";
    static $XS_BAT_TYPE_REVERSAL = "REVERSAL";
    static $XS_BAT_TYPE_CANCEL = "CANCEL";
    
    static $XS_BAT_STATUS_CREATED = "CREATED";
    static $XS_BAT_STATUS_INITIATED = "INITIATED";
    static $XS_BAT_STATUS_SETTLED = "SETTLED";
    static $XS_BAT_STATUS_RETURNED = "RETURNED";    
    static $XS_BAT_STATUS_CANCELED = "CANCELED";
    static $XS_BAT_STATUS_FAILED = "FAILED";
    static $XS_BAT_STATUS_REJECTED = "REJECTED";
    
    
    static $XS_BAT_METHOD_CCD = "CCD";
    static $XS_BAT_METHOD_PPD = "PPD";
    static $XS_BAT_METHOD_TEL = "TEL";
    static $XS_BAT_METHOD_WEB = "WEB";
    
    static $XS_BAT_ACCOUNT_TYPE_CHECKING = "CHECKING";
    static $XS_BAT_ACCOUNT_TYPE_SAVINGS = "SAVINGS";
    
    private $in_bank_account_transaction_id;
    
    private $is_type;
    private $is_status;
    private $is_method;
    private $is_account_type;
    
    private $is_routing_number;
    private $is_account_number;
    private $is_account_name;
    private $is_return_code;
    private $is_trace;
    private $is_merchant_transaction_id;
    private $is_bank_account_token;
    private $is_micr_data;
    
    private $id_amount;
    
    private $io_effective_date;
    private $io_settlement_date;
    private $io_return_date;
    
    private $ib_bank_account_transaction_recurring_indicator;

    
    private $is_custom_field1;
    private $is_custom_field2;
    private $is_custom_field3;
    private $is_custom_field4;
    private $is_custom_field5;
    private $is_custom_field6;
    private $is_custom_field7;
    private $is_custom_field8;
    private $is_custom_field9;
    private $is_custom_field10;
    
    private $io_messages;
    
    /**
     * 
     * Default Constructor.
     */
    function __construct() {
        $this->io_messages = array();
    }
    
    public function setBankAccountTransactionId( $vn_ba_transaction_id ) { 
        $this->in_bank_account_transaction_id = $vn_ba_transaction_id;
    }
    
    public function getBankAccountTransactionId() {
        return $this->in_bank_account_transaction_id;
    }
    
    public function setType( $vs_type ) {
        $this->is_type = $vs_type;
    }
    public function getType() {
        return $this->is_type;
    }
    public function isType( $vs_type ) {
        return $this->is_type == $vs_type;
    }
    
    public function setMethod( $vs_method ) {
        $this->is_method = $vs_method;
    }
    public function getMethod() {
        return $this->is_method;
    }
    public function isMethod( $vs_method ) {
        return $this->is_method == $vs_method;
    }
    
    public function setRoutingNumber( $vs_routing_number ) {
        $this->is_routing_number = $vs_routing_number;
    }
    public function getRoutingNumber() {
        return $this->is_routing_number;
    }
    
    public function setAccountNumber( $vs_account_number ) {
        $this->is_account_number = $vs_account_number;
    }
    public function getAccountNumber() {
        return $this->is_account_number;
    }
    
    public function setMerchantTransactionID( $vs_merchant_transaction_id ) {
        $this->is_merchant_transaction_id = $vs_merchant_transaction_id;
    }
    public function getMerchantTransactionID() {
        return $this->is_merchant_transaction_id;
    }
    
    /**
     * sets the effective date
     * @param type $vo_effective_date the effective date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setEffectiveDate( $vo_effective_date ) {
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( strpos($vo_effective_date, '/') !== FALSE ) {
            $this->io_effective_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_effective_date )->format('m/d/Y H:i:s');
        } else {
            $this->io_effective_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_effective_date )->format('m/d/Y H:i:s');
        }
    }
    public function getEffectiveDate() {
        return $this->io_effective_date;
    }
    
    /**
     * sets the settlement date
     * @param type $vo_settlement_date the settlement date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setSettlementDate( $vo_settlement_date ) {        
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( strpos($vo_settlement_date, '/') !== FALSE ) {
            $this->io_settlement_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_settlement_date )->format('m/d/Y H:i:s');
        } else {
            $this->io_settlement_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_settlement_date )->format('m/d/Y H:i:s');
        }
    }
    public function getSettlementDate() {
        return $this->io_settlement_date;
    }
    
    public function setAccountName( $vs_account_name ) {
        $this->is_account_name = $vs_account_name;
    }
    public function getAccountName() {
        return $this->is_account_name;
    }
    
    public function setStatus( $vs_status ) {
        $this->is_status = $vs_status;
    }
    public function getStatus() {
        return $this->is_status;
    }
    
    public function getToken() {
        return $this->is_bank_account_token;
    }
    
    public function setToken( $vs_bank_acount_token ) {
        $this->is_bank_account_token = $vs_bank_acount_token;
    }
    
    public function isStatus( $vs_status ) {
        return $this->is_status == $vs_status;
    }
    
    public function setReturnCode( $vs_return_code ) {
        $this->is_return_code = $vs_return_code;
    }
    public function getReturnCode() {
        return $this->is_return_code;
    }
    
    public function setTrace( $vs_trace ) {
        $this->is_trace = $vs_trace;
    }
    public function getTrace() {
        return $this->is_trace;
    }
    
    public function setAmount( $vd_amount ) {
        $this->id_amount = $vd_amount;
    }
    public function getAmount() {
        return $this->id_amount;
    }
    
    public function setAccountType( $vs_account_type ) {
        $this->is_account_type = $vs_account_type;
    }
    public function getAccountType() {
        return $this->is_account_type;
    }
    public function isAccountType( $vs_account_type ) {        
        return $this->is_account_type.equals(vs_account_type);        
    }
    
    /**
     * sets the return date
     * @param type $vo_return_date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setReturnDate( $vo_return_date ) {        
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( strpos($vo_return_date, '/') !== FALSE ) {
            $this->io_return_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_return_date )->format('m/d/Y H:i:s');
        } else {
            $this->io_return_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_return_date )->format('m/d/Y H:i:s');
        }
    }
    public function getReturnDate() { return $this->io_return_date; }
    
    public function setMICRData( $vs_micr_data ) { $this->is_micr_data = $vs_micr_data; }
    public function getMICRData() { return $this->is_micr_data; }
    
    public function setCustomField1( $vs_custom_field1 ) { $this->is_custom_field1 = $vs_custom_field1; }
    public function getCustomField1() { return $this->is_custom_field1; }
    
    public function setCustomField2( $vs_custom_field2 ) { $this->is_custom_field2 = $vs_custom_field2; }
    public function getCustomField2() { return $this->is_custom_field2; }
    
    public function setCustomField3( $vs_custom_field3 ) { $this->is_custom_field3 = $vs_custom_field3; }
    public function getCustomField3() { return $this->is_custom_field3; }
    
    public function setCustomField4( $vs_custom_field4 ) { $this->is_custom_field4 = $vs_custom_field4; }
    public function getCustomField4() { return $this->is_custom_field4; }
    
    public function setCustomField5( $vs_custom_field5 ) { $this->is_custom_field5 = $vs_custom_field5; }
    public function getCustomField5() { return $this->is_custom_field5; }
    
    public function setCustomField6( $vs_custom_field6 ) { $this->is_custom_field6 = $vs_custom_field6; }
    public function getCustomField6() { return $this->is_custom_field6; }
    
    public function setCustomField7( $vs_custom_field7 ) { $this->is_custom_field7 = $vs_custom_field7; }
    public function getCustomField7() { return $this->is_custom_field7; }
    
    public function setCustomField8( $vs_custom_field8 ) { $this->is_custom_field8 = $vs_custom_field8; }
    public function getCustomField8() { return $this->is_custom_field8; }
    
    public function setCustomField9( $vs_custom_field9 ) { $this->is_custom_field9 = $vs_custom_field9; }
    public function getCustomField9() { return $this->is_custom_field9; }
    
    public function setCustomField10( $vs_custom_field10 ) { $this->is_custom_field10 = $vs_custom_field10; }
    public function getCustomField10() { return $this->is_custom_field10; }
    
        /**
     * 
     * Sets whether the transaction is recurring or not
     * 
     * @param $vb_recurring_indicator true if transaction is recurring flase if not
     */
    public function setRecurringIndicator( $vb_recurring_indicator ) { $this->ib_bank_account_transaction_recurring_indicator = $vb_recurring_indicator; }
    
    /**
     * 
     * Returns the boolean value if the transaction is recurring
     * 
     * @return true if the transaction is recurring false if it is not
     */
    public function getRecurringIndicator() { return $this->ib_bank_account_transaction_recurring_indicator; }

    
    public function getMessages() {
        return $this->io_messages;
    }
    
    public function addMessage( $vs_message ) {
        array_push( $this->io_messages, $vs_message );
    }
    
    /***
     * builds the Bank Account Transaction object from the given json object
     * 
     * @param vo_json the json object representation of a Bank Account Transaction
     * @return     The constructed BankAccountTransaction
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    static function buildFromJSON( $vo_json ) {
        
        $o_bat = new BankAccountTransaction();
        
        if( array_key_exists( "bank_account_transaction_id", $vo_json ) ) {
            $o_bat->setBankAccountTransactionId( $vo_json[ "bank_account_transaction_id" ] );
        }
        
        if (array_key_exists( 'bank_account_transaction_type', $vo_json ) ) {
            
            if( gettype( $vo_json['bank_account_transaction_type'] ) === "array" ){
                
                $o_type = (array)$vo_json['bank_account_transaction_type'];
                
                if (array_key_exists( 'bank_account_transaction_type_name', $o_type ) ) {
                    
                    $o_bat->setType( $o_type['bank_account_transaction_type_name'] );
                }
            } else {
                
                $o_bat->setType( $vo_json['bank_account_transaction_type'] );
            }
        }
       
        if (array_key_exists( 'bank_account_transaction_method', $vo_json ) ) {
            
            if( gettype( $vo_json['bank_account_transaction_method'] ) === "array" ){
                
                $o_method = (array)$vo_json['bank_account_transaction_method'];
                
                if (array_key_exists( 'bank_account_transaction_method_name', $o_method ) ) {
                    
                    $o_bat->setMethod( $o_method['bank_account_transaction_method_name'] );
                }
            }
            else {
                
                $o_bat->setMethod( $vo_json['bank_account_transaction_method'] );
            }
        }
        
        if (array_key_exists( 'bank_account_transaction_recurring_indicator', $vo_json) ) { 
            $o_bat->setRecurringIndicator( $vo_json[ "bank_account_transaction_recurring_indicator" ] );             
        }

                
        if (array_key_exists( 'bank_account_transaction_routing_number', $vo_json ) ) {
            $o_bat->setRoutingNumber( $vo_json[ "bank_account_transaction_routing_number" ] );
        }
        
        if (array_key_exists( 'bank_account_transaction_account_number', $vo_json ) ) {
            $o_bat->setAccountNumber( $vo_json[ "bank_account_transaction_account_number" ] );
        }
        
        if (array_key_exists( 'bank_account_transaction_effective_date', $vo_json ) ) {
            $o_bat->setEffectiveDate( date("m/d/Y H:i:s", strtotime( $vo_json[ "bank_account_transaction_effective_date" ] ) ) );   
        }

        if (array_key_exists( 'bank_account_transaction_settlement_date', $vo_json ) ) {
            $o_bat->setSettlementDate( date("m/d/Y H:i:s", strtotime( $vo_json[ "bank_account_transaction_settlement_date" ] ) ) );
        }
        
        if (array_key_exists( 'bank_account_transaction_return_date', $vo_json ) ) {
            $o_bat->setReturnDate( date("m/d/Y H:i:s", strtotime( $vo_json[ "bank_account_transaction_return_date" ] ) ) );
        }
        
        if (array_key_exists( 'bank_account_transaction_account_name', $vo_json ) ) {
            $o_bat->setAccountName( $vo_json[ "bank_account_transaction_account_name" ] );
        }
        
        if (array_key_exists( 'bank_account_transaction_status', $vo_json ) ) {
            
            if( gettype( $vo_json[ 'bank_account_transaction_status' ] ) === "array" ){
                
                $o_status = (array)$vo_json[ 'bank_account_transaction_status' ];
                
                if (array_key_exists( 'bank_account_transaction_status_name', $o_status ) ) {
                    
                    $o_bat->setStatus( $o_status[ 'bank_account_transaction_status_name' ] );
                }
            }
            else {
                
                $o_bat->setStatus( $vo_json[ 'bank_account_transaction_status' ] );
            }
        }
        
        if (array_key_exists( 'bank_account_transaction_return_code', $vo_json ) ) {
            $o_bat->setReturnCode( $vo_json[ "bank_account_transaction_return_code" ] );
        }
        
        if (array_key_exists( 'bank_account_transaction_merchant_transaction_id', $vo_json ) ) {
            $o_bat->setMerchantTransactionID( $vo_json[ "bank_account_transaction_merchant_transaction_id" ] );
        }
        
        if (array_key_exists( 'bank_account_transaction_trace', $vo_json ) ) {
            $o_bat->setTrace( $vo_json[ "bank_account_transaction_trace" ] );
        }
        
        if (array_key_exists( 'bank_account_transaction_account_type', $vo_json ) ) {
            
            if( gettype( $vo_json[ 'bank_account_transaction_account_type' ] ) === "array" ){
                
            $o_account_type = (array)$vo_json[ 'bank_account_transaction_account_type' ];
            
                if (array_key_exists( 'bank_account_transaction_account_type_name', $o_account_type ) ) {

                    $o_bat->setAccountType( $o_account_type[ 'bank_account_transaction_account_type_name' ] );

                }
            }
            else {
                
                $o_bat->setAccountType( $vo_json[ 'bank_account_transaction_account_type' ] );
            }
            
        }
        
        // Added to allow intercommunication between CLIENT objects during unit testing//
        if( array_key_exists( 'messages', $vo_json  ) && !is_null( $vo_json[ 'messages' ] ) ) {
            
            foreach ( $vo_json['messages'] as $s_key => $s_msg ) {
                
                $o_bat->addMessage( $s_msg );
            }
            
        }
        
        if (array_key_exists( 'bank_account_transaction_amount', $vo_json ) ) {
            $o_bat->setAmount( $vo_json[ "bank_account_transaction_amount" ] );
        }
        
        if( array_key_exists("bank_account_token", $vo_json ) ) {
            $o_bat->setToken( $vo_json[ "bank_account_token" ] );
        }
        
        if( array_key_exists("bank_account_transaction_micr_data", $vo_json ) ) {
            $o_bat->setMICRData( $vo_json[ "bank_account_transaction_micr_data" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field1", $vo_json ) ) {
            $o_bat->setCustomField1( $vo_json[ "bank_account_transaction_custom_field1" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field2", $vo_json ) ) {
            $o_bat->setCustomField2( $vo_json[ "bank_account_transaction_custom_field2" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field3", $vo_json ) ) {
            $o_bat->setCustomField3( $vo_json[ "bank_account_transaction_custom_field3" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field4", $vo_json ) ) {
            $o_bat->setCustomField4( $vo_json[ "bank_account_transaction_custom_field4" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field5", $vo_json ) ) {
            $o_bat->setCustomField5( $vo_json[ "bank_account_transaction_custom_field5" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field6", $vo_json ) ) {
            $o_bat->setCustomField6( $vo_json[ "bank_account_transaction_custom_field6" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field7", $vo_json ) ) {
            $o_bat->setCustomField7( $vo_json[ "bank_account_transaction_custom_field7" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field8", $vo_json ) ) {
            $o_bat->setCustomField8( $vo_json[ "bank_account_transaction_custom_field8" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field9", $vo_json ) ) {
            $o_bat->setCustomField9( $vo_json[ "bank_account_transaction_custom_field9" ] );
        }
        
        if ( array_key_exists( "bank_account_transaction_custom_field10", $vo_json ) ) {
            $o_bat->setCustomField10( $vo_json[ "bank_account_transaction_custom_field10" ] );
        }
        
        return $o_bat;
        
    }
        
    /**
     * Returns the JSON representation of the bank account transaction.
     * 
     * @return associated array : the json representation
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    public function getJSON() {
        
        $o_json = array();
        
        if( !is_null($this->in_bank_account_transaction_id ) ) {
            $o_json[ "bank_account_transaction_id" ] = $this->getBankAccountTransactionId();
        }
        if( !is_null($this->is_type ) ) {
            $o_json[ "bank_account_transaction_type" ] = $this->getType();
        }
        if( !is_null($this->is_method ) ) {
            $o_json[ "bank_account_transaction_method" ] = $this->getMethod();
        }
        if( !is_null($this->is_routing_number ) ) {
            $o_json[ "bank_account_transaction_routing_number" ] = $this->getRoutingNumber();
        }
        if( !is_null($this->is_account_number ) ) {
            $o_json[ "bank_account_transaction_account_number" ] = $this->getAccountNumber();
        }
        
        if( !is_null($this->io_effective_date ) ) {    
            $o_json[ "bank_account_transaction_effective_date" ] = $this->io_effective_date;
        }
        
        if( !is_null($this->io_settlement_date ) ) {
            $o_json[ "bank_account_transaction_settlement_date" ] = $this->io_settlement_date;
        }
        
        if( !is_null($this->io_return_date ) ) {
            $o_json[ "bank_account_transaction_return_date" ] = $this->io_return_date;
        }
        
        if( !is_null($this->is_account_name ) ) {
            $o_json[ "bank_account_transaction_account_name" ] = $this->getAccountName();
        }
        if( !is_null($this->is_status ) ) {
            $o_json[ "bank_account_transaction_status" ] = $this->getStatus();
        }
        if( !is_null($this->is_return_code ) ) {
            $o_json[ "bank_account_transaction_return_code" ] = $this->getReturnCode();
        }
        if( !is_null($this->is_merchant_transaction_id ) ) {
            $o_json[ "bank_account_transaction_merchant_transaction_id" ] = $this->getMerchantTransactionID();
        }
        if( !is_null($this->is_trace ) ) {
            $o_json[ "bank_account_transaction_trace" ] = $this->getTrace();
        }
        if( !is_null($this->is_account_type ) ) {
            $o_json[ "bank_account_transaction_account_type" ] = $this->getAccountType();
        }
        if( !is_null($this->id_amount ) ) {
            $o_json[ "bank_account_transaction_amount" ] = $this->getAmount();
        }
        if( !is_null($this->is_bank_account_token ) ) {
            $o_json[ "bank_account_token" ] = $this->getToken();
        }
        if( !is_null($this->is_micr_data ) ) {
            $o_json[ "bank_account_transaction_micr_data" ] = $this->getMICRData();
        }
        
        if( !is_null($this->ib_bank_account_transaction_recurring_indicator ) ) {
            $o_json['bank_account_transaction_recurring_indicator'] = $this->getRecurringIndicator();
        }

        
        if ( !is_null( $this->is_custom_field1 ) ) { $o_json[ "bank_account_transaction_custom_field1" ] = $this->getCustomField1(); }
        if ( !is_null( $this->is_custom_field2 ) ) { $o_json[ "bank_account_transaction_custom_field2" ] = $this->getCustomField2(); }
        if ( !is_null( $this->is_custom_field3 ) ) { $o_json[ "bank_account_transaction_custom_field3" ] = $this->getCustomField3(); }
        if ( !is_null( $this->is_custom_field4 ) ) { $o_json[ "bank_account_transaction_custom_field4" ] = $this->getCustomField4(); }
        if ( !is_null( $this->is_custom_field5 ) ) { $o_json[ "bank_account_transaction_custom_field5" ] = $this->getCustomField5(); }
        if ( !is_null( $this->is_custom_field6 ) ) { $o_json[ "bank_account_transaction_custom_field6" ] = $this->getCustomField6(); }
        if ( !is_null( $this->is_custom_field7 ) ) { $o_json[ "bank_account_transaction_custom_field7" ] = $this->getCustomField7(); }
        if ( !is_null( $this->is_custom_field8 ) ) { $o_json[ "bank_account_transaction_custom_field8" ] = $this->getCustomField8(); }
        if ( !is_null( $this->is_custom_field9 ) ) { $o_json[ "bank_account_transaction_custom_field9" ] = $this->getCustomField9(); }
        if ( !is_null( $this->is_custom_field10 ) ) { $o_json[ "bank_account_transaction_custom_field10" ] = $this->getCustomField10(); }
        
        if( !is_null( $this->io_messages ) ){
            
            $o_json[ 'messages' ]  =  $this->io_messages;         
        }
           
        return json_encode( $o_json );
    }
    
}

?>