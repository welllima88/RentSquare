<?php
include_once 'Address.php';
/**
 * Description of BankCardTransaction
 *
 * 
 * © Base Commerce
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 * @author Steven Wright <steven.wright@basecommerce.com>
 */
class BankCardTransaction {
    
    
    /**
     * Represents an authorization transaction.
     */
    static $XS_BCT_TYPE_AUTH = "AUTH";
    
    /**
     * Represents a sale transaction.
     */
    static $XS_BCT_TYPE_SALE = "SALE";
    
    /**
     * Represents a void transaction.
     */
    static $XS_BCT_TYPE_VOID = "VOID";
    /**
     * Represents a capture transaction.
     */
    static $XS_BCT_TYPE_CAPTURE = "CAPTURE";
    /**
     * Represents a refund transaction.
     */
    static $XS_BCT_TYPE_REFUND = "REFUND";
    /**
     * Represents a credit transaction.
     */
    static $XS_BCT_TYPE_CREDIT = "CREDIT";
    
    /**
     * Represents a transaction whose status is created.
     */
    static $XS_BCT_STATUS_CREATED = "CREATED";
    /**
     * Represents a transaction whose status is authorized.
     */
    static $XS_BCT_STATUS_AUTHORIZED = "AUTHORIZED";
    /**
     * Represents a transaction whose status is captured.
     */
    static $XS_BCT_STATUS_CAPTURED = "CAPTURED";
    /**
     * Represents a transaction whose status is settled.
     */
    static $XS_BCT_STATUS_SETTLED = "SETTLED";
    /**
     * Represents a transaction whose status is voided.
     */
    static $XS_BCT_STATUS_VOIDED = "VOIDED";
    /**
     * Represents a transaction whose status is declined.
     */
    static $XS_BCT_STATUS_DECLINED = "DECLINED";
    /**
     * Represents a transaction whose status is failed.
     */
    static $XS_BCT_STATUS_FAILED = "FAILED";
    /**
     * Represents a transaction whose status is waiting for verification.
     */
    static $XS_BCT_STATUS_3DSECURE = "3DSECURE";
    /**
     * Represents a transactions whose status is verification complete.
     */
    static $XS_BCT_STATUS_VERIFIED = "VERIFIED";
    
    private $io_billing_address;
    private $is_type;
    private $is_card_number;
    private $is_card_name; 
    private $is_card_exp_month;
    private $is_card_exp_year;
    private $is_card_cvv2;
    private $is_card_track1_data;
    private $is_card_track2_data;
    private $is_ip_address;
    private $is_po_number;
    private $is_authorization_code;
    private $is_response_code;
    private $is_status;
    private $is_response_message;
    private $is_cvv_response_code;
    private $is_avs_response_code;
    private $is_encrypted_track_data;
    private $is_merchant_transaction_id;
    private $is_bank_card_transaction_verify_complete_url;
    private $is_bank_card_transaction_verify_url;
    
    private $id_amount;
    private $id_tax_amount;
    private $id_tip_amount;
        
    private $in_transaction_id;
    private $in_bank_card_transaction_settlement_batch_id;
    
    
    private $ib_check_secure_code;
    private $ib_bank_card_transaction_recurring_indicator;

    
    private $is_token;
    
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
    private $io_bank_card_transaction_settlement_date;
    private $io_bank_card_transaction_creation_date;
    private $is_cipher_pay_uuid;
    
    /**
     * 
     * Default Constructor.
     */
    function __construct() {
        $this->io_billing_address = new Address();
        $this->io_messages = array();        
    }
    
    /**
     * 
     * Returns the cvv response code of the transaction.
     * 
     * @return the cvv code
     */
    public function getCVVResponseCode() { return $this->is_cvv_response_code; }
    /**
     * 
     * Sets the cvv response code of the transaction.
     * 
     * @param $vo_cvv_response_code the cvv response code
     */
    public function setCVVResponseCode( $vo_cvv_response_code ) { $this->is_cvv_response_code = $vo_cvv_response_code; }
    
    /**
     * 
     * Returns the avs response code of the transaction.
     * 
     * @return the avs code
     */
    public function getAVSResponseCode() { return $this->is_avs_response_code; }
    /**
     * 
     * Sets the avs response code of the transaction.
     * 
     * @param $vo_avs_response_code the avs response code
     */
    public function setAVSResponseCode( $vo_avs_response_code ) { $this->is_avs_response_code = $vo_avs_response_code; }
    
    /**
     * 
     * Returns the billing address of the BankCardTransaction
     * 
     * @return the billing address
     * @see Address
     */
    public function getBillingAddress() { return $this->io_billing_address; }
    /**
     * 
     * Sets the billing address of the BankCardTransaction.
     * 
     * @param $vo_billing_address the Address
     * @see Address
     */
    public function setBillingAddress( Address $vo_billing_address ) { $this->io_billing_address = $vo_billing_address; }
    
    /**
     * 
     * Returns the type of transaction.
     * 
     * @return the type of transaction
     */
    public function getType() { return $this->is_type; }
    /**
     * 
     * Sets the type of transaction. Use one of the following static variables from this class :
     *          XS_AUTH
     *          XS_SALE
     *          XS_VOID
     *          XS_CAPTURE
     *          XS_REFUND
     *          XS_CREDIT
     * 
     * @param vs_type the type of transaction
     */
    public function setType( $vs_type ) { $this->is_type = $vs_type; }
    
    /**
     * 
     * Returns the card number used in the transaction.
     * 
     * @return  the card number
     */
    public function getCardNumber() { return $this->is_card_number; }
    /**
     * 
     * Sets the card number used in the transaction. The card number should
     * be a 16 length string of only numeric characters.
     * 
     * @param vs_card_number    the card number
     */
    public function setCardNumber( $vs_card_number ) { $this->is_card_number = $vs_card_number; }
    
    /**
     * 
     * Returns the card holders name.
     * 
     * @return the card holders name
     */
    public function getCardName() { return $this->is_card_name; }
    /**
     * 
     * Sets the card holders name.
     * 
     * @param vs_card_name  the card holders name
     */
    public function setCardName( $vs_card_name ) { $this->is_card_name = $vs_card_name; }
    
    /**
     * 
     * Returns the card's month of expiration.
     * 
     * @return the expiration month
     */
    public function getCardExpirationMonth() { return $this->is_card_exp_month; }
    /**
     * 
     * Set the card's month of expiration. The month should be represented as a
     * string of 2 digits between 01 and 12 . ie, 01 or 04 or 12
     * 
     * @param vs_card_exp_month     the expiration month
     */
    public function setCardExpirationMonth( $vs_card_exp_month ) { $this->is_card_exp_month= $vs_card_exp_month; }
    
    /**
     * 
     * Returns the card's year of expiration.
     * 
     * @return  the expiration year
     */
    public function getCardExpirationYear() { return $this->is_card_exp_year; }
    /**
     * Set the card's year of expiration. The year should be represented as a
     * string of 4 digits. ie, 2013
     * 
     * @param vs_card_exp_year  the expiration year
     */
    public function setCardExpirationYear( $vs_card_exp_year) { $this->is_card_exp_year = $vs_card_exp_year; }
    /**
     * 
     * Returns the card's cvv2 code.
     * 
     * @return  the cvv2 code
     */
    public function getCardCVV2() { return $this->is_card_cvv2; }
    /**
     * 
     * Sets the card's cvv2 code. Depending on the card issuer, this will be 
     * either the 3 or 4 digit security code on the card.
     * 
     * @param vs_card_cvv2  the cvv2 code
     */
    public function setCardCVV2( $vs_card_cvv2 ) { $this->is_card_cvv2 = $vs_card_cvv2; }
    
    /**
     * 
     * Returns the track1 data from the card.
     * 
     * @return  the track1 card data
     */
    public function getCardTrack1Data() { return $this->is_card_track1_data; }
    /**
     * 
     * Sets the track1 data from the card.
     * 
     * @param vs_card_track1_data   the track1 card data
     */
    public function setCardTrack1Data( $vs_card_track1_data ) { $this->is_card_track1_data= $vs_card_track1_data; }
    
    /**
     * 
     * Returns the track2 data from the card.
     * 
     * @return  the track2 card data
     */
    public function getCardTrack2Data() { return $this->is_card_track2_data; }
    /**
     * 
     * Sets the track2 data from the card.
     * 
     * @param vs_card_track2_data   the track2 card data
     */
    public function setCardTrack2Data( $vs_card_track2_data ) { $this->is_card_track2_data = $vs_card_track2_data; }
    
    /**
     * 
     * Returns the IP address of the cardholder.
     * 
     * @return  the IP address
     */
    public function getIPAddress() { return $this->is_ip_address; }
    /**
     * 
     * Sets the IP address of the cardholder.
     * 
     * @param vs_ip_address the IP address
     */
    public function setIPAddress( $vs_ip_address ) { $this->is_ip_address = $vs_ip_address; }
    
    /** 
     * 
     * Returns the transaction's PONumber.
     * 
     * @return  the PONumber
     */
    public function getPONumber() { return $this->is_po_number; }
    /**
     * 
     * Sets the transaction's PONumber.
     * 
     * @param vs_po_number the PONumber
     */
    public function setPONumber( $vs_po_number ) { $this->is_po_number = $vs_po_number; }
    
    /**
     * 
     * Returns the authorization code.
     * 
     * @return the authorization code
     */
    public function getAuthorizationCode() { return $this->is_authorization_code; }
    /**
     * 
     * Sets the authorization code.
     * 
     * @param vs_authorization_code     the authorization code
     */
    public function setAuthorizationCode( $vs_authorization_code ) { $this->is_authorization_code= $vs_authorization_code; }
    
    /**
     * 
     * Returns the response code.
     * 
     * @return the response code
     */
    public function getResponseCode() { return $this->is_response_code; }
    /**
     * 
     * Sets the response code
     * 
     * @param vs_response_code      the response code
     */
    public function setResponseCode( $vs_response_code ) { $this->is_response_code = $vs_response_code; }
    
    /**
     * 
     * Gets the status of the transaction.
     * 
     * @return The status of the transaction 
     */
    public function getStatus() { return $this->is_status; }
    /**
     * 
     * Sets the status of the transaction. Use one of the following static Strings defined in this class above :
     *              XS_CREATED 
     *              XS_AUTHORIZED
     *              XS_CAPTURED
     *              XS_SETTLED
     *              XS_VOIDED
     *              XS_DECLINED
     *              XS_FAILED
     * 
     * @param vs_status     the status of the transaction
     */
    public function setStatus( $vs_status ) { $this->is_status = $vs_status; }
    
    /**
     * 
     * @param type $vs_status
     * @return type
     */
    public function isStatus( $vs_status ) {
        return $this->is_status == $vs_status;
    }
    
    /**
     * 
     * Returns the response message of the transaction.
     * 
     * @return the response message
     */
    public function getResponseMessage() { return $this->is_response_message; }
    /**
     * Sets the response message of the transaction.
     * 
     * @param vs_response_message   the response message
     */
    public function setResponseMessage( $vs_response_message ) { $this->is_response_message = $vs_response_message; }
    
    /**
     * 
     * Returns the dollar amount of the transaction.
     * 
     * @return  the amount
     */
    public function getAmount() { return $this->id_amount; }
    /**
     * 
     * Sets the dollar amount of the transaction.
     * 
     * @param vd_amount     the amount
     */
    public function setAmount( $vd_amount ) { $this->id_amount = $vd_amount; }
    
    /**
     * 
     * Returns the amount of tax on the transaction.
     * 
     * @return  the amount of tax
     */
    public function getTaxAmount() { return $this->id_tax_amount; }
    /**
     * 
     * Sets the amount of tax on the transaction.
     * 
     * @param vd_tax_amount     the amount of tax
     */
    public function setTaxAmount( $vd_tax_amount ) { $this->id_tax_amount = $vd_tax_amount; }
    
    /**
     * 
     * Returns the tip amount on the transaction.
     * 
     * @return  the tip amount
     */
    public function getTipAmount() { return $this->id_tip_amount; }
    /**
     * 
     * Sets the tip amount on the transaction.
     * 
     * @param vd_tip_amount     the tip amount
     */
    public function setTipAmount( $vd_tip_amount ) { $this->id_tip_amount= $vd_tip_amount; }
    
    /** 
     * 
     * Returns the Merchant's Transaction ID.
     * 
     * @return  the id
     */
    public function getMerchantTransactionID() { return $this->is_merchant_transaction_id; }
    /**
     * 
     * Sets the Merchant's Transaction ID.
     * @param $vs_merchant_transaction_id    the id
     */
    public function setMerchantTransactionID( $vs_merchant_transaction_id ) { $this->is_merchant_transaction_id = $vs_merchant_transaction_id; }
    
    /**
     * 
     * Returns the transaction ID.
     * 
     * @return the id
     */
    public function getTransactionID() { return $this->in_transaction_id; }
    /**
     * 
     * Sets the transaction ID.
     * 
     * @param $vn_transaction_id     the id
     */
    public function setTransactionID( $vn_transaction_id ) { $this->in_transaction_id = $vn_transaction_id; }
    
    /**
     * 
     * Returns the url the merchant would like the response from verify complete to be directed to.
     * 
     * @return the url
     */
    public function getVerifyCompleteURL() { return $this->is_bank_card_transaction_verify_complete_url; }
    
    /**
     * 
     * Sets the the url the merchant would like the response from verify complete to be directed to.
     * 
     * @param $vs_bank_card_transaction_verify_complete_url  the url
     */
    public function setVerifyCompleteURL( $vs_bank_card_transaction_verify_complete_url ) { $this->is_bank_card_transaction_verify_complete_url = $vs_bank_card_transaction_verify_complete_url; }
    
    /**
     * 
     * Returns the url a customer should be directed to when when verifying a card with 3DSecure.
     * 
     * @return  the url
     */
    public function getVerifyURL() { return $this->is_bank_card_transaction_verify_url; }
    /**
     * 
     * Sets the url a customer should be directed to when attempted to when verifying a card with 3DSecure.
     * 
     * @param $vs_bank_card_transaction_verify_url  the url
     */
    public function setVerifyURL( $vs_bank_card_transaction_verify_url ) { $this->is_bank_card_transaction_verify_url = $vs_bank_card_transaction_verify_url; }
    
    /**
     * 
     * Returns the boolean value that determines if the transaction is authenticated with 3DSecure or not.
     * 
     * @return true if transaction should be authenticated, false if not
     */
    public function getCheckSecureCode() { return $this->ib_check_secure_code; }
    /**
     * 
     * Sets whether the transaction should be authenticated with 3DSecure or not.
     * 
     * @param $vb_check_secure_code true if transaction should be authenticated, false if not
     */
    public function setCheckSecureCode( $vb_check_secure_code ) { $this->ib_check_secure_code = $vb_check_secure_code; }
    
    
    public function getToken() { return $this->is_token; }
    public function setToken( $vs_token ) { $this->is_token = $vs_token; }

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
     * Sets the encrypted track data received from a card reader.
     * 
     * @param vs_encrypted_track_data the encrypted track data
     */
    public function setEncryptedTrackData( $vs_encrypted_track_data ) { $this->is_encrypted_track_data = $vs_encrypted_track_data; }
    
    /**
     * Returns the encrypted track data received from a card reader.
     * 
     * @return the encrypted track data
     */
    public function getEncryptedTrackData() { return $this->is_encrypted_track_data; }
    
    /**
     * 
     * Sets whether the transaction is recurring or not
     * 
     * @param $vb_recurring_indicator true if transaction is recurring flase if not
     */
    public function setRecurringIndicator( $vb_recurring_indicator ) { $this->ib_bank_card_transaction_recurring_indicator = $vb_recurring_indicator; }
    
    /**
     * 
     * Returns the boolean value if the transaction is recurring
     * 
     * @return true if the transaction is recurring false if it is not
     */
    public function getRecurringIndicator() { return $this->ib_bank_card_transaction_recurring_indicator; }


    /**
     * 
     * Sets the settlement batch ID
     * 
     * @param $vn_batch_id the settlement batch ID that it will be set to
     */
    public function setSettlementBatchID( $vn_batch_id ) { $this->in_bank_card_transaction_settlement_batch_id = $vn_batch_id; }
    
    /**
     * 
     * Returns the the settlement batch ID
     * 
     * @return The bank card transactions settlement batch ID
     */
    public function getSettlementBatchID() { return $this->in_bank_card_transaction_settlement_batch_id; }
    
    /**
     * sets the cipher pay uuid 
     * @param type $vs_uuid the uuid
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setCipherPayUUID( $vs_uuid ) {
        $this->is_cipher_pay_uuid = $vs_uuid;
    }
    
    /**
     * returns the cipher pay uuid
     * @return type string of the uuid
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getCipherPayUUID() {
        return $this->is_cipher_pay_uuid;
    }
    
    

    /**
     * 
     * Sets the settlement batch date
     * 
     * @param $vo_settlement_date the settlement batch date that it will be set to
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setSettlementDate( $vo_settlement_date ) {
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( PHP_VERSION < 5.3 ) {
            if( strpos($vo_settlement_date, '/') !== FALSE ) {
                $this->io_bank_card_transaction_settlement_date = $this->date_create_from_format('m/d/Y H:i:s', $vo_settlement_date )->format('m/d/Y H:i:s');
            } else {
                $this->io_bank_card_transaction_settlement_date = $this->date_create_from_format('m-d-Y H:i:s', $vo_settlement_date )->format('m/d/Y H:i:s');
            }
        } else {
            if( strpos($vo_settlement_date, '/') !== FALSE ) {
                $this->io_bank_card_transaction_settlement_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_settlement_date )->format('m/d/Y H:i:s');
            } else {
                $this->io_bank_card_transaction_settlement_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_settlement_date )->format('m/d/Y H:i:s');
            }
        }        
    }
    
    /**
     * 
     * Returns the the settlement batch date
     * 
     * @return The bank card transactions settlement batch date
     */
    public function getSettlementDate() { return $this->io_bank_card_transaction_settlement_date; }

    /**
     * 
     * Sets the creation date
     * 
     * @param $vo_creation_date the creation date of the settlement batch
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setCreationDate( $vo_creation_date ) {
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( PHP_VERSION < 5.3 ) {
            if( strpos($vo_creation_date, '/') !== FALSE ) {
                $this->io_bank_card_transaction_creation_date = $this->date_create_from_format('m/d/Y H:i:s', $vo_creation_date )->format('m/d/Y H:i:s');
            } else {
                $this->io_bank_card_transaction_creation_date = $this->date_create_from_format('m-d-Y H:i:s', $vo_creation_date )->format('m/d/Y H:i:s');
            }
        } else {
            if( strpos($vo_creation_date, '/') !== FALSE ) {
                $this->io_bank_card_transaction_creation_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_creation_date )->format('m/d/Y H:i:s');
            } else {
                $this->io_bank_card_transaction_creation_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_creation_date )->format('m/d/Y H:i:s');
            }
        }
    }
    
    /**
     * 
     * Returns the the creation date of the settlement batch
     * 
     * @return The creation date
     */
    public function getCreationDate() { return $this->io_bank_card_transaction_creation_date; }

    
    public function getMessages() {
        return $this->io_messages;
    }
    
    public function addMessage( $vs_error ) {
        array_push( $this->io_messages, $vs_error );
    }
    
    /**
     * Constructs and returns a BankCardTransaction object from a given JSONObject.
     * 
     * @param o_json    json containing the BankCardTransaction type
     * @return     the newly created bank card transaction
     * @author Ryan Murphy <steven.wright@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    static function buildFromJSON( $vo_json ) {

        $o_bct = new BankCardTransaction();

        if( array_key_exists( 'bank_card_transaction_billing_address', $vo_json) ){
            
          $o_bct->setBillingAddress( Address::buildFromJSON( $vo_json['bank_card_transaction_billing_address'] ) );
        }
        
        if (array_key_exists( 'bank_card_transaction_name', $vo_json) ) { $o_bct->setCardName( $vo_json['bank_card_transaction_name'] ); }        
        if (array_key_exists( 'token', $vo_json) ) { $o_bct->setToken( $vo_json['token'] ); }
        if (array_key_exists( 'bank_card_transaction_card_number', $vo_json) ) { $o_bct->setCardNumber( $vo_json['bank_card_transaction_card_number'] ); }
        if (array_key_exists( 'bank_card_transaction_expiration_month', $vo_json) ) { $o_bct->setCardExpirationMonth( $vo_json['bank_card_transaction_expiration_month'] ); }
        if (array_key_exists( 'bank_card_transaction_expiration_year', $vo_json) ) { $o_bct->setCardExpirationYear( $vo_json['bank_card_transaction_expiration_year'] ); }
        if (array_key_exists( 'bank_card_transaction_billing_address', $vo_json) ) { $o_bct->setBillingAddress( Address::buildFromJSON( $vo_json['bank_card_transaction_billing_address'] ) ); }
        
        if (array_key_exists( 'bank_card_transaction_type', $vo_json ) ) {
            
            if( gettype( $vo_json[ 'bank_card_transaction_type' ] ) === "array" ){
                
                $o_type = (array)$vo_json[ 'bank_card_transaction_type' ];
            
                if (array_key_exists( 'bank_card_transaction_type_name', $o_type ) ) {
                
                    $o_bct->setType( $o_type[ 'bank_card_transaction_type_name' ] );
                }
            }
            else {
                
                $o_bct->setType( $vo_json[ 'bank_card_transaction_type' ] );
            }
        }
        
        if (array_key_exists( 'bank_card_transaction_po_number', $vo_json) ) { $o_bct->setPONumber( $vo_json['bank_card_transaction_po_number'] ); }
        if (array_key_exists( 'bank_card_transaction_amount', $vo_json) ) { $o_bct->setAmount( $vo_json['bank_card_transaction_amount'] ); }
        if (array_key_exists( 'bank_card_transaction_tax_amount', $vo_json) ) { $o_bct->setTaxAmount( $vo_json['bank_card_transaction_tax_amount'] ); }
        if (array_key_exists( 'bank_card_transaction_tip_amount', $vo_json) ) { $o_bct->setTipAmount( $vo_json['bank_card_transaction_tip_amount'] ); }
        if (array_key_exists( 'bank_card_transaction_ip_address', $vo_json) ) { $o_bct->setIPAddress( $vo_json['bank_card_transaction_ip_address'] ); }
        if (array_key_exists( 'bank_card_transaction_merchant_transaction_id', $vo_json) ) { $o_bct->setMerchantTransactionID( $vo_json['bank_card_transaction_merchant_transaction_id'] ); }
        
        if (array_key_exists( 'bank_card_transaction_status', $vo_json ) ) {
            
            
            if( gettype( $vo_json[ 'bank_card_transaction_status' ] ) === "array" ){
            
                $o_status = (array)$vo_json['bank_card_transaction_status'];
            
                if (array_key_exists( 'bank_card_transaction_status_name', $o_status ) ) {
                
                    $o_bct->setStatus( $o_status['bank_card_transaction_status_name'] );
                }
            } 
            else {
                
                $o_bct->setStatus( $vo_json[ 'bank_card_transaction_status' ] );
            }
            
        }
        if (array_key_exists( 'bank_card_transction_check_secure_code', $vo_json) ) { $o_bct->setCheckSecureCode ( $vo_json['bank_card_transction_check_secure_code'] ); }
        if (array_key_exists( 'bank_card_transaction_response_message', $vo_json) ) { $o_bct->setResponseMessage ( $vo_json['bank_card_transaction_response_message'] ); }
        if (array_key_exists( 'bank_card_transaction_response_code', $vo_json) ) { $o_bct->setResponseCode( $vo_json['bank_card_transaction_response_code'] ); }
        if (array_key_exists( 'bank_card_transaction_avs_response_code', $vo_json) ) { $o_bct->setAVSResponseCode( $vo_json['bank_card_transaction_avs_response_code'] ); }
        if (array_key_exists( 'bank_card_transaction_cvv_response_code', $vo_json) ) { $o_bct->setCVVResponseCode( $vo_json['bank_card_transaction_cvv_response_code'] ); }
        if (array_key_exists( 'bank_card_transaction_card_cvv2', $vo_json) ) { $o_bct->setCardCVV2( $vo_json['bank_card_transaction_card_cvv2'] ); }
        if (array_key_exists( 'bank_card_transaction_authorization_code', $vo_json) ) { $o_bct->setAuthorizationCode( $vo_json['bank_card_transaction_authorization_code'] ); }
        if (array_key_exists( 'bank_card_transaction_id', $vo_json) ) { $o_bct->setTransactionID( $vo_json['bank_card_transaction_id'] ); }
        if (array_key_exists( 'bank_card_transaction_verify_complete_url', $vo_json) ) { $o_bct->setVerifyCompleteURL( $vo_json['bank_card_transaction_verify_complete_url'] ); }
        if (array_key_exists( 'bank_card_transaction_verify_url', $vo_json) ) { $o_bct->setVerifyURL( $vo_json['bank_card_transaction_verify_url'] ); }
        if (array_key_exists( "bank_card_transaction_encrypted_track_data", $vo_json ) ) { $o_bct->setEncryptedTrackData( $vo_json[ 'bank_card_transaction_encrypted_track_data' ] ); }
        if (array_key_exists( 'bank_card_transaction_recurring_indicator', $vo_json) ) { $o_bct->setRecurringIndicator( $vo_json['bank_card_transaction_recurring_indicator'] ); }
        if (array_key_exists( 'bank_card_transaction_settlement_batch_id', $vo_json) ) { $o_bct->setSettlementBatchID( $vo_json['bank_card_transaction_settlement_batch_id'] ); }
        if (array_key_exists( 'bank_card_transaction_settlement_date', $vo_json) ) { $o_bct->setSettlementDate( date("m/d/Y H:i:s", strtotime( $vo_json['bank_card_transaction_settlement_date'] ) ) ); }
        if (array_key_exists( 'bank_card_transaction_creation_date', $vo_json) ) { $o_bct->setCreationDate( date("m/d/Y H:i:s", strtotime( $vo_json['bank_card_transaction_creation_date'] ) ) ); }

        if ( array_key_exists( "bank_card_transaction_custom_field1", $vo_json ) ) {
            $o_bct->setCustomField1( $vo_json[ "bank_card_transaction_custom_field1" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field2", $vo_json ) ) {
            $o_bct->setCustomField2( $vo_json[ "bank_card_transaction_custom_field2" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field3", $vo_json ) ) {
            $o_bct->setCustomField3( $vo_json[ "bank_card_transaction_custom_field3" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field4", $vo_json ) ) {
            $o_bct->setCustomField4( $vo_json[ "bank_card_transaction_custom_field4" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field5", $vo_json ) ) {
            $o_bct->setCustomField5( $vo_json[ "bank_card_transaction_custom_field5" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field6", $vo_json ) ) {
            $o_bct->setCustomField6( $vo_json[ "bank_card_transaction_custom_field6" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field7", $vo_json ) ) {
            $o_bct->setCustomField7( $vo_json[ "bank_card_transaction_custom_field7" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field8", $vo_json ) ) {
            $o_bct->setCustomField8( $vo_json[ "bank_card_transaction_custom_field8" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field9", $vo_json ) ) {
            $o_bct->setCustomField9( $vo_json[ "bank_card_transaction_custom_field9" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_custom_field10", $vo_json ) ) {
            $o_bct->setCustomField10( $vo_json[ "bank_card_transaction_custom_field10" ] );
        }
        
        if ( array_key_exists( "bank_card_transaction_cipher_pay_uuid", $vo_json ) ) {
            $o_bct->setCipherPayUUID( $vo_json[ "bank_card_transaction_cipher_pay_uuid" ] );
        }
        
        return $o_bct;
    }
    
    /**
     * 
     * Returns the JSON representation of the bank card transaction.
     * 
     * @return associated array : the json representation
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    function getJSON() {
        $o_json = array();
        if( !is_null($this->is_type ) ) {
            $o_json['bank_card_transaction_type'] = $this->is_type;
        }
        if( !is_null($this->is_merchant_transaction_id ) ) {
            $o_json['bank_card_transaction_merchant_transaction_id'] = $this->is_merchant_transaction_id;
        }
        if( !is_null($this->in_transaction_id ) ) {
            $o_json['bank_card_transaction_id'] = $this->in_transaction_id;
        }
        if( !is_null($this->is_card_number ) ) {
            $o_json['bank_card_transaction_card_number'] = $this->is_card_number; 
        }
        if( !is_null($this->is_card_name ) ) {
            $o_json['bank_card_transaction_name'] = $this->is_card_name; 
        }
        if( !is_null($this->is_card_exp_month ) ) {
            $o_json['bank_card_transaction_expiration_month'] = $this->is_card_exp_month;
        }
        if( !is_null($this->is_card_exp_year ) ) {
            $o_json['bank_card_transaction_expiration_year'] = $this->is_card_exp_year;
        }
        if( !is_null($this->is_card_cvv2 ) ) {
            $o_json['bank_card_transaction_card_cvv2'] = $this->is_card_cvv2;
        }
        if( !is_null($this->is_card_track1_data ) ) {
            $o_json['bank_card_transaction_card_track1_data'] = $this->is_card_track1_data;
        }
        if( !is_null($this->is_card_track2_data ) ) {
            $o_json['bank_card_transaction_card_track2_data'] = $this->is_card_track2_data;
        }
        if( !is_null($this->is_po_number ) ) {
            $o_json['bank_card_transaction_po_number'] = $this->is_po_number;
        }
        if( !is_null($this->id_amount ) ) {
            $o_json['bank_card_transaction_amount'] = $this->id_amount;
        }
        if( !is_null($this->id_tax_amount ) ) {
            $o_json['bank_card_transaction_tax_amount'] = $this->id_tax_amount;
        }
        if( !is_null($this->id_tip_amount ) ) {
            $o_json['bank_card_transaction_tip_amount'] = $this->id_tip_amount;
        }
        if( !is_null($this->is_authorization_code ) ) {
            $o_json['bank_card_transaction_authorization_code'] = $this->is_authorization_code;
        }
        if( !is_null($this->is_response_code ) ) {
            $o_json['bank_card_transaction_response_code'] = $this->is_response_code;
        }
        if( !is_null($this->is_avs_response_code ) ) {
            $o_json['bank_card_transaction_avs_response_code'] = $this->is_avs_response_code;
        }
        if( !is_null($this->is_cvv_response_code ) ) {
            $o_json['bank_card_transaction_cvv_response_code'] = $this->is_cvv_response_code;
        }
        if( !is_null($this->is_ip_address ) ) {
            $o_json['bank_card_transaction_ip_address'] = $this->is_ip_address;
        }
        if( !is_null($this->is_status ) ) {
            $o_json['bank_card_transaction_status'] = $this->is_status;
        }
        if( !is_null($this->is_response_message ) ) {
            $o_json['bank_card_transaction_message'] = $this->is_response_message;
        }
        if( !is_null($this->is_token ) ) {
            $o_json['token'] = $this->is_token;
        }
        if( !is_null($this->ib_check_secure_code ) ) {
            $o_json['bank_card_transaction_check_secure_code'] = $this->ib_check_secure_code;
        }
        if( !is_null($this->io_billing_address) ) {
            $o_json['bank_card_transaction_billing_address'] = $this->getBillingAddress()->getJSON();
        }    
        if( !is_null($this->is_bank_card_transaction_verify_complete_url ) ) {
            $o_json['bank_card_transaction_verify_complete_url'] = $this->is_bank_card_transaction_verify_complete_url;
        }
        if( !is_null($this->is_bank_card_transaction_verify_url ) ) {
            $o_json['bank_card_transaction_verify_url'] = $this->is_bank_card_transaction_verify_url;
        }
        if( !is_null( $this->is_encrypted_track_data ) ) {
            $o_json[ 'bank_card_transaction_encrypted_track_data' ] = $this->is_encrypted_track_data;
        }        
        if( !is_null($this->ib_bank_card_transaction_recurring_indicator ) ) {
            $o_json['bank_card_transaction_recurring_indicator'] = $this->ib_bank_card_transaction_recurring_indicator;
        }
        if( !is_null($this->in_bank_card_transaction_settlement_batch_id ) ) {
            $o_json['bank_card_transaction_settlement_batch_id'] = $this->in_bank_card_transaction_settlement_batch_id;
        }
        if( !is_null($this->io_bank_card_transaction_settlement_date ) ) {
            $o_json['bank_card_transaction_settlement_date'] = $this->io_bank_card_transaction_settlement_date;
        }
        if( !is_null($this->io_bank_card_transaction_creation_date ) ) {
            $o_json['bank_card_transaction_creation_date'] = $this->io_bank_card_transaction_creation_date;
        }

        
        if ( !is_null( $this->is_custom_field1 ) ) { $o_json[ "bank_card_transaction_custom_field1" ] = $this->getCustomField1(); }
        if ( !is_null( $this->is_custom_field2 ) ) { $o_json[ "bank_card_transaction_custom_field2" ] = $this->getCustomField2(); }
        if ( !is_null( $this->is_custom_field3 ) ) { $o_json[ "bank_card_transaction_custom_field3" ] = $this->getCustomField3(); }
        if ( !is_null( $this->is_custom_field4 ) ) { $o_json[ "bank_card_transaction_custom_field4" ] = $this->getCustomField4(); }
        if ( !is_null( $this->is_custom_field5 ) ) { $o_json[ "bank_card_transaction_custom_field5" ] = $this->getCustomField5(); }
        if ( !is_null( $this->is_custom_field6 ) ) { $o_json[ "bank_card_transaction_custom_field6" ] = $this->getCustomField6(); }
        if ( !is_null( $this->is_custom_field7 ) ) { $o_json[ "bank_card_transaction_custom_field7" ] = $this->getCustomField7(); }
        if ( !is_null( $this->is_custom_field8 ) ) { $o_json[ "bank_card_transaction_custom_field8" ] = $this->getCustomField8(); }
        if ( !is_null( $this->is_custom_field9 ) ) { $o_json[ "bank_card_transaction_custom_field9" ] = $this->getCustomField9(); }
        if ( !is_null( $this->is_custom_field10 ) ) { $o_json[ "bank_card_transaction_custom_field10" ] = $this->getCustomField10(); }
        
        if( !is_null( $this->io_messages ) ){
            
            $o_json[ 'messages' ]  =  $this->io_messages;         
        }
        
        if ( !is_null( $this->is_cipher_pay_uuid ) ) { 
            $o_json[ "bank_card_transaction_cipher_pay_uuid" ] = $this->is_cipher_pay_uuid;             
        }
        
        return json_encode( $o_json );
    }
    
    function date_create_from_format( $dformat, $dvalue ) {

        $schedule = $dvalue;
        $schedule_format = str_replace(array('Y','m','d', 'H', 'i','a'),array('%Y','%m','%d', '%I', '%M', '%p' ) ,$dformat);
        // %Y, %m and %d correspond to date()'s Y m and d.
        // %I corresponds to H, %M to i and %p to a
        $ugly = strptime($schedule, $schedule_format);
        $ymd = sprintf(
            // This is a format string that takes six total decimal
            // arguments, then left-pads them with zeros to either
            // 4 or 2 characters, as needed
            '%04d-%02d-%02d %02d:%02d:%02d',
            $ugly['tm_year'] + 1900,  // This will be "111", so we need to add 1900.
            $ugly['tm_mon'] + 1,      // This will be the month minus one, so we add one.
            $ugly['tm_mday'], 
            $ugly['tm_hour'], 
            $ugly['tm_min'], 
            $ugly['tm_sec']
        );
        $new_schedule = new DateTime($ymd);

       return $new_schedule;
    }  
    
}

?>
