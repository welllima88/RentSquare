<?php


/**
 * Description of PushNotification
 *
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 */
class PushNotification {
    
    static $XS_PN_ACH_CHANGE = "ACH CHANGE";
    static $XS_PN_SETTLEMENT_BATCH_CHANGE = "SETTLEMENT BATCH CHANGE";
    static $XS_PN_TYPE_PING = "PING";
    static $XS_PN_TYPE_JSON = "JSON";
    static $XS_PN_TYPE_CHARGEBACK = "INCOMING CHARGEBACK";
    
    protected $is_type;
    private $io_settlement_batch;
    private $io_bank_account_transaciton;
    private $in_id;
    private $io_incoming_chargeback;
    
    public function getBankAccountTransaction() {
        return $this->io_bank_account_transaciton;
    }
    
    public function setBankAccountTransaction( BankAccountTransaction $vo_bat ) {
        $this->io_bank_account_transaciton = $vo_bat;
        $this->is_type = PushNotification::$XS_PN_ACH_CHANGE;
    }
    
    public function getSettlementBatch() {
        return $this->io_settlement_batch;
    }
    
    public function setSettlementBatch( SettlementBatch $vo_settlement_batch ) {
        $this->io_settlement_batch = $vo_settlement_batch;
        $this->is_type = PushNotification::$XS_PN_SETTLEMENT_BATCH_CHANGE;
    }
    
    public function getNotificationType() {
        return $this->is_type;
    }
    
    public function isNotificationType( $vs_type ) {
        return $this->is_type === $vs_type;
    }

    /**
     * Sets the type to ping
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setPING() {
       $this->is_type = self::$XS_PN_TYPE_PING;
    }
    
    /**
     * Returns the PushNotification ID
     * 
     * @return the PushNotification ID
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getID() {
        return $this->in_id;
    }
    
    /**
     * Sets the PushNotification ID
     * 
     * @param vn_id the PushNotification ID
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setID( $vn_id ) {
        $this->in_id = $vn_id;
    }
    
    /**
     * returns the incoming chargeback
     * @return the incoming chargeback
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getIncomingChargeback() {
        return $this->io_incoming_chargeback;
    }
    
    /**
     * sets the incoming chargeback
     * @param type $vo_incoming_chargeback the incoming chargeback
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setIncomingChargeback( $vo_incoming_chargeback ) {
        $this->io_incoming_chargeback = $vo_incoming_chargeback;
        $this->is_type = PushNotification::$XS_PN_TYPE_CHARGEBACK;
    }
    
    /**
     * returns a json array of the push notification data
     * 
     * @return json array with push notification data
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getJSON() {
        
        $o_return = array();
        
        if ( !is_null( $this->is_type ) ) { $o_return[ "push_notification_type" ] = $this->is_type; }
        if ( !is_null( $this->io_settlement_batch ) ) { $o_return[ "push_notification_settlement_batch" ] = $this->io_settlement_batch.getJSON(); }
        if ( !is_null( $this->io_bank_account_transaciton ) ) { $o_return[ "push_notification_bank_account_transaction" ] = $this->io_bank_account_transaciton.getJSON(); }
        if ( !is_null( $this->in_id ) ) { $o_return[ "push_notification_id" ] = $this->in_id; }
        if ( !is_null( $this->io_incoming_chargeback ) ) { $o_return[ "push_notification_chargeback" ] = $this->io_incoming_chargeback->getJSON(); }
        
        return $o_return;
    }
    
    /**
     * Builds a PushNotification object from the given JSON object
     * @param type $vo_json the JSON representation of the PushNotification
     * @return PushNotification a push notification object
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public static function buildFromJSON( $vo_json ) {
        
        $o_return = new PushNotification();
        
        if ( array_key_exists( "push_notification_type", $vo_json ) && $vo_json[ "push_notification_type" ] == "PING" ) { $o_return->setPING(); }
        if ( array_key_exists( "push_notification_type", $vo_json ) && $vo_json[ "push_notification_type" ] == "INCOMING CHARGEBACK" ) {
            if ( array_key_exists( "push_notification_chargeback", $vo_json ) ) {
                $o_return->setIncomingChargeback( Chargeback::buildFromJSON( $vo_json[ "push_notification_chargeback" ] ) );
            }
            
        }
        if ( array_key_exists( "push_notification_settlement_batch", $vo_json ) ) { $o_return->setSettlementBatch( SettlementBatch::buildFromJSON( $vo_json[ "push_notification_settlement_batch" ] ) ); }
        if ( array_key_exists( "push_notification_bank_account_transaction", $vo_json ) ) { $o_return->setBankAccountTransaction( BankAccountTransaction::buildFromJSON( $vo_json[ "push_notification_bank_account_transaction" ] ) ); }
        if ( array_key_exists( "push_notification_id", $vo_json ) ) { $o_return->setID( $vo_json[ "push_notification_id" ] ); }
        
        return $o_return;
    }
}
