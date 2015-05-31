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
    
    protected $is_type;
    private $io_settlement_batch;
    private $io_bank_account_transaciton;
    
    public function getBankAccountTransaction() {
        return $this->io_bank_account_transaciton;
    }
    
    public function setBankAccountTransaction( BankAccountTransaction $vo_bat ) {
        $this->io_bank_account_transaciton = $vo_bat;
        $this->is_type = PushNotification::$XS_ACH_CHANGE;
    }
    
    public function getSettlementBatch() {
        return $this->io_settlement_batch;
    }
    
    public function setSettlementBatch( SettlementBatch $vo_settlement_batch ) {
        $this->io_settlement_batch = $vo_settlement_batch;
        $this->is_type = PushNotification::$XS_SETTLEMENT_BATCH_CHANGE;
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
        $this->is_type = $this::$XS_PN_TYPE_PING;
    }
    
    public function getJSON() {
        
        $o_return = array();
        
        if ( !is_null( $this->is_type ) ) { $o_return[ "push_notification_type" ] = $this->is_type; }
        if ( !is_null( $this->io_settlement_batch ) ) { $o_return[ "push_notification_settlement_batch" ] = $this->io_settlement_batch.getJSON(); }
        if ( !is_null( $this->io_bank_account_transaciton ) ) { $o_return[ "push_notification_bank_account_transaction" ] = $this->io_bank_account_transaciton.getJSON(); }
        
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
        if ( array_key_exists( "push_notification_settlement_batch", $vo_json ) ) { $o_return->setSettlementBatch( SettlementBatch::buildFromJSON( $vo_json[ "push_notification_settlement_batch" ] ) ); }
        if ( array_key_exists( "push_notification_bank_account_transaction", $vo_json ) ) { $o_return->setBankAccountTransaction( BankAccountTransaction::buildFromJSON( $vo_json[ "push_notification_bank_account_transaction" ] ) ); }
        
        return $o_return;
    }
}
