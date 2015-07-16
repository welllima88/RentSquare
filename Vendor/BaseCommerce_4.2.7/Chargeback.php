<?php

/**
 * Represents a Chargeback class
 *
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 */
class Chargeback {
    
    private $is_mid;
    private $io_date_received;
    private $is_card_number;
    private $io_transaction_authorization_date;
    private $io_transaction_settlement_date;
    private $id_transaction_amount;
    private $is_authorization_code;
    private $is_transaction_acquirer_reference_number;
    private $is_reason_code;
    private $is_status;
    
    
    /**
     * returns the chargeback MID
     * @return the chargeback MID
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getMid() {
        return $this->is_mid;
    }
    
    /**
     * sets the MID
     * @param type $vs_mid the MID
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setMid( $vs_mid ) {
        $this->is_mid = $vs_mid;
    }
    
    /**
     * returns the received date
     * @return the received date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getReceivedDate() {
        return $this->io_date_received;
    }
    
    /**
     * sets the received date
     * @param type $vo_date_reveived the received date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setReceivedDate( $vo_date_reveived ) {
        $this->io_date_received = $vo_date_reveived;
    }
    
    /**
     * returns the card number
     * @return the card number
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getCardNumber() {
        return $this->is_card_number;
    }
    
    /**
     * sets the card number
     * @param type $vs_card_number the card number
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setCardNumber( $vs_card_number ) {
        $this->is_card_number = $vs_card_number;
    }
    
    /**
     * returns the transaction authorization date
     * @return the transaction authorization date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getTransactionAuthorizationDate() {
        return $this->io_transaction_authorization_date;
    }
    
    /**
     * sets the transaction authorization date
     * @param type $vs_transaction_authorization_date the transaction authorization date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setTransactionAuthorizationDate( $vs_transaction_authorization_date ) {
        $this->io_transaction_authorization_date = $vs_transaction_authorization_date;
    }
    
    /**
     * returns the transaction settlement date
     * @return the transaction settlement date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getTransactionSettlementDate() {
        return $this->io_transaction_settlement_date;
    }
    
    /**
     * sets the transaction settlement date
     * @param type $vs_transaction_settlement_date the transaction settlement date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setTransactionSettlementDate( $vs_transaction_settlement_date ) {
        $this->io_transaction_settlement_date = $vs_transaction_settlement_date;
    }
    
    /**
     * returns the transaction amount
     * @return the transaction amount
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getTransactionAmount() {
        return $this->id_transaction_amount;
    }
    
    /**
     * sets the transaction amonut
     * @param type $vd_transaction_amount the transaction amount
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setTransactionAmount( $vd_transaction_amount ) {
        $this->id_transaction_amount = $vd_transaction_amount;
    }
    
    /**
     * returns the authorization code
     * @return the authorization code
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getAuthorizationCode() {
        return $this->is_authorization_code;
    }
    
    /**
     * sets the authorization code
     * @param type $vs_authorization_code the authorization code
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setAuthorizationCode( $vs_authorization_code ) {
        $this->is_authorization_code = $vs_authorization_code;
    }
    
    /**
     * returns the transaction aquirer reference number
     * @return the transaction aquirer reference number
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getTransactionAcquirerReferenceNumber() {
        return $this->is_transaction_acquirer_reference_number;
    }
    
    /**
     * sets the transaction aquirer reference number
     * @param type $vs_transaction_aquirer_reference_number the transaction aquirer reference number
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setTransactionAcquirerReferenceNumber( $vs_transaction_acquirer_reference_number ) {
        $this->is_transaction_acquirer_reference_number = $vs_transaction_acquirer_reference_number;
    }
    
    /**
     * returns the reason code
     * @return the reason code
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getReasonCode() {
        return $this->is_reason_code;
    }
    
    /**
     * sets the reason code
     * @param type $vs_reason_code the reason code
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setReasonCode( $vs_reason_code ) {
        $this->is_reason_code = $vs_reason_code;
    }
    
    /**
     * returns the status
     * @return the status
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getStatus() {
        return $this->is_status;
    }
    
    /**
     * sets the status
     * @param type $vs_status the status
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setStatus( $vs_status ) {
        $this->is_status = $vs_status;
    }
    
    /**
     * builds a Chargeback object from the passed in JSON object
     * @param type $o_data JSON representation of a Chargeback
     * @return Chargeback object
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    static function buildFromJSON( $o_data ) {
        
        $o_instance = new Chargeback();
        
        if( array_key_exists( 'chargeback_mid', $o_data) ) { $o_instance->setMid( $o_data['chargeback_mid'] ); }
        if( array_key_exists( 'chargeback_card_number', $o_data) ) { $o_instance->setCardNumber( $o_data['chargeback_card_number'] ); }
        if( array_key_exists( 'chargeback_transaction_amount', $o_data) ) { $o_instance->setTransactionAmount( $o_data['chargeback_transaction_amount'] ); }
        if( array_key_exists( 'chargeback_authorization_code', $o_data) ) { $o_instance->setAuthorizationCode( $o_data['chargeback_authorization_code'] ); }
        if( array_key_exists( 'chargeback_transaction_acquirer_reference_number', $o_data) ) { $o_instance->setTransactionAcquirerReferenceNumber( $o_data['chargeback_transaction_acquirer_reference_number'] ); }
        if( array_key_exists( 'chargeback_reason_code', $o_data) ) { $o_instance->setReasonCode( $o_data['chargeback_reason_code'] ); }
        if( array_key_exists( 'chargeback_status', $o_data) ) { $o_instance->setStatus( $o_data['chargeback_status'] ); }
        if( array_key_exists( 'chargeback_received_date', $o_data) ) { $o_instance->setReceivedDate( $o_data['chargeback_received_date'] ); }
        if( array_key_exists( 'chargeback_transaction_authorization_date', $o_data) ) { $o_instance->setTransactionAuthorizationDate( $o_data['chargeback_transaction_authorization_date'] ); }
        if( array_key_exists( 'chargeback_transaction_settlement_date', $o_data) ) { $o_instance->setTransactionSettlementDate( $o_data['chargeback_transaction_settlement_date'] ); }
        
        return $o_instance;        
        
    }
    
    /**
     * returns a JSON object represenation of Chargeback
     * @return a JSON object represenation of Chargeback
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getJSON() {
        
        $o_array = array();
        
        if( !is_null( $this->is_mid ) ) {
            $o_array['chargeback_mid'] = $this->is_mid;
        }
        if( !is_null( $this->is_card_number ) ) {
            $o_array['chargeback_card_number'] = $this->is_card_number;
        }
        if( !is_null( $this->id_transaction_amount ) ) {
            $o_array['chargeback_transaction_amount'] = $this->id_transaction_amount;
        }
        if( !is_null( $this->is_authorization_code ) ) {
            $o_array['chargeback_authorization_code'] = $this->is_authorization_code;
        }
        if( !is_null( $this->is_transaction_acquirer_reference_number ) ) {
            $o_array['chargeback_transaction_acquirer_reference_number'] = $this->is_transaction_acquirer_reference_number;
        }
        if( !is_null( $this->is_reason_code ) ) {
            $o_array['chargeback_reason_code'] = $this->is_reason_code;
        }
        if( !is_null( $this->is_status ) ) {
            $o_array['chargeback_status'] = $this->is_status;
        }
        if( !is_null( $this->io_date_received ) ) {
            $o_array['chargeback_received_date'] = $this->io_date_received;
        }
        if( !is_null( $this->io_transaction_authorization_date ) ) {
            $o_array['chargeback_transaction_authorization_date'] = $this->io_transaction_authorization_date;
        }
        if( !is_null( $this->io_transaction_settlement_date ) ) {
            $o_array['chargeback_transaction_settlement_date'] = $this->io_transaction_settlement_date;
        }
        
        return json_encode( $o_array );
        
    }
    
    
}
