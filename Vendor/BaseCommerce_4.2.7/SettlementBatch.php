<?php

/**
 * Description of SettlementBatch
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class SettlementBatch {
    
    private $id_bat_credit_amount;
    private $in_bat_credit_count;
    private $id_bat_debit_amount;
    private $in_bat_debit_count;
    
    private $id_bct_sale_amount;
    private $in_bct_sale_count;
    private $id_bct_credit_amount;
    private $in_bct_credit_count;
    
    private $io_bat_ids;
    private $io_bct_ids;
    
    public function __construct() {
        $this->io_bat_ids = array();
        $this->io_bct_ids = array();
    }
    
    public function setBATCreditAmount( $vd_bat_credit_amount ) { $this->id_bat_credit_amount = $vd_bat_credit_amount; }    
    public function getBATCreditAmount() { return $this->id_bat_credit_amount; }
    
    public function setBATCreditCount( $vn_bat_credit_count ) { $this->in_bat_credit_count = $vn_bat_credit_count; }
    public function getBATCreditCount() { return $this->in_bat_credit_count; }
    
    public function setBATDebitAmount( $vd_bat_debit_amount ) { $this->id_bat_debit_amount = $vd_bat_debit_amount; }
    public function getBATDebitAmount() { return $this->id_bat_debit_amount; }
    
    public function setBATDebitCount( $vn_bat_debit_count ) { $this->in_bat_debit_count = $vn_bat_debit_count; }
    public function getBATDebitCount() { return $this->in_bat_debit_count; }
    
    public function setBCTSaleAmount( $vd_bct_sale_amount ) { $this->id_bct_sale_amount = $vd_bct_sale_amount; }
    public function getBCTSaleAmount() { return $this->id_bct_sale_amount; }
    
    public function setBCTSaleCount( $vn_bct_sale_count ) { $this->in_bct_sale_count = $vn_bct_sale_count; }
    public function getBCTSaleCount() { return $this->in_bct_sale_count; }
    
    public function setBCTCreditAmount( $vd_bct_credit_amount ) { $this->id_bct_credit_amount = $vd_bct_credit_amount; }
    public function getBCTCreditAmount() { return $this->id_bct_credit_amount; }
    
    public function setBCTCreditCount( $vn_bct_credit_count ) { $this->in_bct_credit_count = $vn_bct_credit_count; }
    public function getBCTCreditCount() { return $this->in_bct_credit_count; }
    
    public function addBankAccountTransactionID( $vn_id ) { array_push( $this->io_bat_ids, $vn_id ); }
    public function getBankAccountTransactionIDs() { return $this->io_bat_ids; }
    
    public function addBankCardTransactionID( $vn_id ) { array_push( $this->io_bct_ids, $vn_id ); }
    public function getBankCardTransactionIDs() { return $this->io_bct_ids; }
    
    
    public static function buildFromJSON( $vo_json ) {
        
        $o_settlement_batch = new SettlementBatch();
        
        if ( array_key_exists( "settlement_batch_bank_account_transaction_credit_amount", $vo_json ) ) { $o_settlement_batch->setBATCreditAmount( $vo_json[ "settlement_batch_bank_account_transaction_credit_amount" ] ); }
        if ( array_key_exists( "settlement_batch_bank_account_transaction_credit_count", $vo_json ) ) { $o_settlement_batch->setBATCreditCount( $vo_json[ "settlement_batch_bank_account_transaction_credit_count" ] ); }
        if ( array_key_exists( "settlement_batch_bank_account_transaction_debit_amount", $vo_json ) ) { $o_settlement_batch->setBATDebitAmount( $vo_json[ "settlement_batch_bank_account_transaction_debit_amount" ] ); }
        if ( array_key_exists( "settlement_batch_bank_account_transaction_debit_count", $vo_json ) ) { $o_settlement_batch->setBATDebitCount( $vo_json[ "settlement_batch_bank_account_transaction_debit_count" ] ); }
        if ( array_key_exists( "settlement_batch_bank_card_transaction_sale_amount", $vo_json ) ) { $o_settlement_batch->setBCTSaleAmount( $vo_json[ "settlement_batch_bank_card_transaction_sale_amount" ] ); }
        if ( array_key_exists( "settlement_batch_bank_card_transaction_sale_count", $vo_json ) ) { $o_settlement_batch->setBCTSaleCount( $vo_json[ "settlement_batch_bank_card_transaction_sale_count" ] ); }
        if ( array_key_exists( "settlement_batch_bank_card_transaction_credit_amount", $vo_json ) ) { $o_settlement_batch->setBCTCreditAmount( $vo_json[ "settlement_batch_bank_card_transaction_credit_amount" ] ); }
        if ( array_key_exists( "settlement_batch_bank_card_transaction_credit_count", $vo_json ) ) { $o_settlement_batch->setBCTCreditCount( $vo_json[ "settlement_batch_bank_card_transaction_credit_count" ] ); }
        
        if ( array_key_exists( "settlement_batch_bank_account_transaction_ids", $vo_json ) ) { 
            $o_temp_bat_array = array( $vo_json[ "settlement_batch_bank_account_transaction_ids" ] );
            foreach( $o_temp_bat_array as $vn_bat_id ) {
                $o_settlement_batch->addBankAccountTransactionID($vn_bat_id);
            }                        
        }
        if ( array_key_exists( "settlement_batch_bank_card_transaction_ids", $vo_json ) ) { 
            $o_temp_bct_array = array( $vo_json[ "settlement_batch_bank_card_transaction_ids" ] );
            foreach( $o_temp_bct_array as $vn_bct_id ) {
                $o_settlement_batch->addBankCardTransactionID($vn_bct_id);
            }            
        }
        
        return $o_settlement_batch;
    }
    
    public function getJSON() {
        
        $o_json = array();
        
        if( !is_null( $this->id_bat_credit_amount ) ) {
            $o_json[ "settlement_batch_bank_account_transaction_credit_amount" ] = $this->getBATCreditAmount();
        }
        if( !is_null( $this->in_bat_credit_count ) ) {
            $o_json[ "settlement_batch_bank_account_transaction_credit_count" ] = $this->getBATCreditCount();
        }
        if( !is_null( $this->id_bat_debit_amount ) ) {
            $o_json[ "settlement_batch_bank_account_transaction_debit_amount" ] = $this->getBATDebitAmount();
        }
        if( !is_null( $this->in_bat_debit_count ) ) {
            $o_json[ "settlement_batch_bank_account_transaction_debit_count" ] = $this->getBATDebitCount();
        }
        if( !is_null( $this->id_bct_sale_amount ) ) {
            $o_json[ "settlement_batch_bank_card_transaction_sale_amount" ] = $this->getBCTSaleAmount();
        }
        if( !is_null( $this->in_bct_sale_count ) ) {
            $o_json[ "settlement_batch_bank_card_transaction_sale_count" ] = $this->getBCTSaleCount();
        }
        if( !is_null( $this->id_bct_credit_amount ) ) {
            $o_json[ "settlement_batch_bank_card_transaction_credit_amount" ] = $this->getBCTCreditAmount();
        }
        if( !is_null( $this->in_bct_credit_count ) ) {
            $o_json[ "settlement_batch_bank_card_transaction_credit_count" ] = $this->getBCTCreditCount();
        }
        if( !is_null( $this->io_bat_ids ) ) {
            $o_json[ "settlement_batch_bank_account_transaction_ids" ] = $this->getBankAccountTransactionIDs();
        }
        if( !is_null( $this->io_bct_ids ) ) {
            $o_json[ "settlement_batch_bank_card_transaction_ids" ] = $this->getBankCardTransactionIDs();
        }
        return json_encode( $o_json );
    }
    
}
