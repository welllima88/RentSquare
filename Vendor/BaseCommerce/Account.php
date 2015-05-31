<?php
include_once 'Address.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class Account {
    
    static $XS_ENTITY_TYPE_CORP = "Corporation";
    static $XS_ENTITY_TYPE_GOV = "Government";
    static $XS_ENTITY_TYPE_LLC = "LLC";
    static $XS_ENTITY_TYPE_NON_PROFIT = "Non-Profit";
    static $XS_ENTITY_TYPE_NON_PROFIT_501C = "Non-Profit 501(c)";
    static $XS_ENTITY_TYPE_PARTNERSHIP = "Partnership";
    static $XS_ENTITY_TYPE_PRIVATE_UTILITY = "Private Utility";
    static $XS_ENTITY_TYPE_PUBLIC_UTILITY = "Public Utility";
    static $XS_ENTITY_TYPE_SOLE_PROPRIETOR = "Sole Proprietor";
    
    private $is_account_name;
    private $io_legal_address;
    private $is_account_phone_number;
    private $is_referral_partner_id;
    private $is_customer_service_phone_number;
    private $is_dba;
    private $is_dda_account_name;
    private $is_dda_account_number;
    private $is_dda_bank_name;
    private $is_dda_routing_number;
    private $is_entity_type;
    private $is_association_number;
    private $is_conga_template_id;
    private $is_ein;
    private $is_ip_address_of_app_submission;
    private $is_website;
    private $ib_test_account;
    private $ib_accept_ach;
    private $ib_accept_bc;
    private $is_settlement_account_bank_name;
    private $is_settlement_account_name;
    private $is_settlement_account_number;
    private $is_settlement_account_bank_phone;
    private $is_settlement_account_routing_number;
    private $ib_settlement_same_as_fee_account;
    private $is_fee_account_bank_name;
    private $is_fee_account_name;
    private $is_fee_account_number;
    private $is_fee_account_routing_number;
    private $is_fee_account_bank_phone;

    function __construct() {
//        $this->io_legal_address = new Address( Address::$XS_LEGAL );
//        $this->io_dba_address = new Address( Address::$XS_DBA );
		$this->ib_settlement_same_as_fee_account = True;
    }
    
    public function getAccountName() {
        return $this->is_account_name;
    }

    public function setAccountName( $vs_account_name) {
        $this->is_account_name = $vs_account_name;
    }

    public function getLegalAddress() {
        return $this->io_legal_address;
    }

    public function setLegalAddress( Address $vo_legal_address ) {
        $this->io_legal_address = $vo_legal_address;
    }

    public function getAccountPhoneNumber() {
        return $this->is_account_phone_number;
    }

    public function setAccountPhoneNumber( $vs_account_phone_number) {
        $this->is_account_phone_number = $vs_account_phone_number;
    }

    public function getReferralPartnerID() {
        return $this->is_referral_partner_id;
    }

    public function setReferralPartnerID( $vs_referral_partner_id) {
        $this->is_referral_partner_id = $vs_referral_partner_id;
    }

    public function getCustomerServicePhoneNumber() {
        return $this->is_customer_service_phone_number;
    }

    public function setCustomerServicePhoneNumber( $vs_customer_service_phone_number) {
        $this->is_customer_service_phone_number = $vs_customer_service_phone_number;
    }

    public function getDBA() {
        return $this->is_dba;
    }

    public function setDBA( $vs_dba) {
        $this->is_dba = $vs_dba;
    }
    
    public function getDdaAccountName() {
        return $this->is_dda_account_name;
    }
    
    public function setDdaAccountName( $vs_dda_account_name ) {
        $this->is_dda_account_name = $vs_dda_account_name;
    }
    
    public function getDdaAccountNumber() {
        return $this->is_dda_account_number;
    }
    
    public function setDdaAccountNumber( $vs_dda_account_number ) {
        $this->is_dda_account_number = $vs_dda_account_number;
    }
    
    public function getDdaBanktName() {
        return $this->is_dda_bank_name;
    }
    
    public function setDdaBankName( $vs_dda_bank_name ) {
        $this->is_dda_bank_name = $vs_dda_bank_name;
    }
    
    public function getDdaRoutingNumber() {
        return $this->is_dda_routing_number;
    }
    
    public function setDdaRoutingNumber( $vs_dda_routing_number ) {
        $this->is_dda_routing_number = $vs_dda_routing_number;
    }

    public function getEntityType() {
        return $this->is_entity_type;
    }

    public function setEntityType( $vs_entity_type) {
        $this->is_entity_type = $vs_entity_type;
    }

    public function getAssociationNumber() {
        return $this->is_association_number;
    }

    public function setAssociationNumber( $vs_association_number) {
        $this->is_association_number = $vs_association_number;
    }

    public function getCongaTemplateId() {
        return $this->is_conga_template_id;
    }

    public function setCongaTemplateId( $vs_conga_template_id) {
        $this->is_conga_template_id = $vs_conga_template_id;
    }

    public function getEIN() {
        return $this->is_ein;
    }

    public function setEIN( $vs_ein) {
        $this->is_ein = $vs_ein;
    }

    public function getIpAddressofAppSubmission() {
        return $this->is_ip_address_of_app_submission;
    }

    public function setIpAddressOfAppSubmission( $vs_ip_address) {
        $this->is_ip_address_of_app_submission = $vs_ip_address;
    }

    public function getWebsite() {
        return $this->is_website;
    }

    public function setWebsite( $vs_website) {
        $this->is_website = $vs_website;
    }
   
    public function isTestAccount() {
        return $this->ib_test_account;
    }
    
    public function setTestAccount( $vb_test_account ) {
        $this->ib_test_account = $vb_test_account;
    }
    
    public function isAcceptACH() {
        return $this->ib_accept_ach;
    }
    
    public function setAcceptACH ( $vb_accept_ach ) {
        $this->ib_accept_ach = $vb_accept_ach;
    }
    
    public function isAcceptBC() {
        return $this->ib_accept_bc;
    }
    
    public function setAcceptBC( $vb_accept_bc ) {
        $this->ib_accept_bc = $vb_accept_bc;
    }
    
    public function getSettlementAccountBankName() {
        return $this->is_settlement_account_bank_name;
    }

    public function setSettlementAccountBankName( $vs_settlement_account_bank_name ) {
        $this->is_settlement_account_bank_name = $vs_settlement_account_bank_name;
    }

    public function getSettlementAccountName() {
        return $this->is_settlement_account_name;
    }

    public function setSettlementAccountName( $vs_settlement_account_name ) {
        $this->is_settlement_account_name = $vs_settlement_account_name;
    }

    public function getSettlementAccountNumber() {
        return $this->is_settlement_account_number;
    }

    public function setSettlementAccountNumber( $vs_settlement_account_number ) {
        $this->is_settlement_account_number = $vs_settlement_account_number;
    }

    public function getSettlementAccountBankPhone() {
        return $this->is_settlement_account_bank_phone;
    }

    public function setSettlementAccountBankPhone( $vs_settlement_account_bank_phone ) {
        $this->is_settlement_account_bank_phone = $vs_settlement_account_bank_phone;
    }

    public function getSettlementAccountRoutingNumber() {
        return $this->is_settlement_account_routing_number;
    }

    public function setSettlementAccountRoutingNumber( $vs_settlement_account_routing_number ) {
        $this->is_settlement_account_routing_number = $vs_settlement_account_routing_number;
    }

    public function isSettlementSameAsFeeAccount() {
        return $this->ib_settlement_same_as_fee_account;
    }

    public function setSettlementSameAsFeeAccount( $vb_settlement_same_as_fee_account ) {
        $this->ib_settlement_same_as_fee_account = $vb_settlement_same_as_fee_account;
    }

    public function getFeeAccountBankName() {
        return $this->is_fee_account_bank_name;
    }

    public function setFeeAccountBankName( $vs_fee_account_bank_name ) {
        $this->is_fee_account_bank_name = $vs_fee_account_bank_name;
    }

    public function getFeeAccountName() {
        return $this->is_fee_account_name;
    }

    public function setFeeAccountName( $vs_fee_account_name ) {
        $this->is_fee_account_name = $vs_fee_account_name;
    }

    public function getFeeAccountNumber() {
        return $this->is_fee_account_number;
    }

    public function setFeeAccountNumber( $vs_fee_account_number ) {
        $this->is_fee_account_number = $vs_fee_account_number;
    }

    public function getFeeAccountRoutingNumber() {
        return $this->is_fee_account_routing_number;
    }

    public function setFeeAccountRoutingNumber( $vs_fee_account_routing_number ) {
        $this->is_fee_account_routing_number = $vs_fee_account_routing_number;
    }

    public function getFeeAccountBankPhone() {
        return $this->is_fee_account_bank_phone;
    }

    public function setFeeAccountBankPhone( $vs_fee_bank_phone ) {
        $this->is_fee_account_bank_phone = $vs_fee_bank_phone;
    }
    
    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->is_account_name ) ) { $o_json[ "account_name" ] = $this->is_account_name; }
        if ( !is_null( $this->io_legal_address ) ) { $o_json[ "account_legal_address" ] = $this->io_legal_address->getJSON(); }
        if ( !is_null( $this->is_account_phone_number ) ) { $o_json[ "account_phone_number" ] = $this->is_account_phone_number; }
        if ( !is_null( $this->is_referral_partner_id ) ) { $o_json[ "account_referral_partner_id" ] = $this->is_referral_partner_id; }
        if ( !is_null( $this->is_customer_service_phone_number ) ) { $o_json[ "account_customer_service_phone_number" ] = $this->is_customer_service_phone_number; }
        if ( !is_null( $this->is_dba ) ) { $o_json[ "account_dba" ] = $this->is_dba; }
        if ( !is_null( $this->is_dda_account_name ) ) { $o_json[ "account_dda_account_name" ] =  $this->is_dda_account_name; }
        if ( !is_null( $this->is_dda_account_number ) ) { $o_json[ "account_dda_account_number" ] = $this->is_dda_account_number; }
        if ( !is_null( $this->is_dda_bank_name ) ) { $o_json[ "account_dda_bank_name" ] = $this->is_dda_bank_name; }
        if ( !is_null( $this->is_dda_routing_number ) ) { $o_json[ "account_dda_routing_number" ] = $this->is_dda_routing_number; }
        if ( !is_null( $this->is_entity_type ) ) { $o_json[ "account_entity_type" ] = $this->is_entity_type; }
        if ( !is_null( $this->is_association_number ) ) { $o_json[ "account_association_number" ] = $this->is_association_number; }
        if ( !is_null( $this->is_conga_template_id ) ) { $o_json[ "account_conga_template_id" ] = $this->is_conga_template_id; }
        if ( !is_null( $this->is_ein ) ) { $o_json[ "account_ein" ] = $this->is_ein; }
        if ( !is_null( $this->is_ip_address_of_app_submission ) ) { $o_json[ "account_ip_address" ] = $this->is_ip_address_of_app_submission; }
        if ( !is_null( $this->is_website ) ) { $o_json[ "account_website" ] = $this->is_website; }
        if ( !is_null( $this->ib_test_account ) ) { $o_json[ "account_test_account" ] = $this->ib_test_account; }
        if ( !is_null( $this->ib_accept_ach ) ) { $o_json[ "account_accept_ach" ] = $this->ib_accept_ach; }
        if ( !is_null( $this->ib_accept_bc ) ) { $o_json[ "account_accept_bc" ] = $this->ib_accept_bc; }
        if ( !is_null( $this->is_settlement_account_bank_name ) ) { $o_json[ "account_settlement_account_bank_name" ] = $this->is_settlement_account_bank_name; }
        if ( !is_null( $this->is_settlement_account_name ) ) { $o_json[ "account_settlement_account_name" ] = $this->is_settlement_account_name; }
        if ( !is_null( $this->is_settlement_account_number ) ) { $o_json[ "account_settlement_account_number" ] = $this->is_settlement_account_number; }
        if ( !is_null( $this->is_settlement_account_bank_phone ) ) { $o_json[ "account_settlement_account_bank_phone" ] = $this->is_settlement_account_bank_phone; }
        if ( !is_null( $this->is_settlement_account_routing_number ) ) { $o_json[ "account_settlement_account_routing_number" ] = $this->is_settlement_account_routing_number; }
        if ( !is_null( $this->ib_settlement_same_as_fee_account ) ) { $o_json[ "account_settlement_same_as_fee_account" ] = $this->ib_settlement_same_as_fee_account; }
        if ( !is_null( $this->is_fee_account_bank_name ) ) { $o_json[ "account_fee_account_bank_name" ] = $this->is_fee_account_bank_name; }
        if ( !is_null( $this->is_fee_account_name ) ) { $o_json[ "account_fee_account_name" ] = $this->is_fee_account_name; }
        if ( !is_null( $this->is_fee_account_number ) ) { $o_json[ "account_fee_account_number" ] = $this->is_fee_account_number; }
        if ( !is_null( $this->is_fee_account_routing_number ) ) { $o_json[ "account_fee_account_routing_number" ] = $this->is_fee_account_routing_number; }
        if ( !is_null( $this->is_fee_account_bank_phone ) ) { $o_json[ "account_fee_bank_phone" ] = $this->is_fee_account_bank_phone; }
        
        return $o_json;
    }
    
    static function buildFromJSON( $vo_json ) {
        
        $o_account = new Account();
        
        if ( array_key_exists( "account_name", $vo_json ) ) { $o_account->setAccountName( $vo_json[ "account_name" ] ); }
        
        if( array_key_exists( "account_legal_address", $vo_json ) ) {
            
            $o_legal_address = Address::buildFromJSON( $vo_json[ "account_legal_address" ] );
            $o_account->setLegalAddress( $o_legal_address );
        }
        if ( array_key_exists( "account_phone_number", $vo_json ) ) { $o_account->setAccountPhoneNumber( $vo_json[ "account_phone_number" ] ); }
        if ( array_key_exists( "account_referral_partner_id", $vo_json ) ) { $o_account->setReferralPartnerID( $vo_json[ "account_referral_partner_id" ] ); }
        if ( array_key_exists( "account_customer_service_phone_number", $vo_json ) ) { $o_account->setCustomerServicePhoneNumber( $vo_json[ "account_customer_service_phone_number" ] ); }
        if ( array_key_exists( "account_dba", $vo_json ) ) { $o_account->setDBA( $vo_json[ "account_dba" ] ); }
        if ( array_key_exists( "account_dda_account_name", $vo_json ) ) { $o_account->setDdaAccountName( $vo_json [ "account_dda_account_name" ] ) ; }
        if ( array_key_exists( "account_dda_account_number", $vo_json ) ) { $o_account->setDdaAccountNumber( $vo_json [ "account_dda_account_number" ] ) ; }
        if ( array_key_exists( "account_dda_bank_name", $vo_json ) ) { $o_account->setDdaBankName( $vo_json [ "account_dda_bank_name" ] ) ; }
        if ( array_key_exists( "account_dda_routing_number", $vo_json ) ) { $o_account->setDdaRoutingName( $vo_json [ "account_dda_routing_number" ] ) ; }
        if ( array_key_exists( "account_entity_type", $vo_json ) ) { $o_account->setEntityType( $vo_json[ "account_entity_type" ] ); }
        if ( array_key_exists( "account_association_number", $vo_json ) ) { $o_account->setAssociationNumber( $vo_json[ "account_association_number" ] ); }
        if ( array_key_exists( "account_conga_template_id", $vo_json ) ) { $o_account->setCongaTemplateId( $vo_json[ "account_conga_template_id" ] ); }
        if ( array_key_exists( "account_ein", $vo_json ) ) { $o_account->setEIN( $vo_json[ "account_ein" ] ); }
        if ( array_key_exists( "account_ip_address", $vo_json ) ) { $o_account->setIpAddressOfAppSubmission( $vo_json[ "account_ip_address" ] ); }
        if ( array_key_exists( "account_website", $vo_json ) ) { $o_account->setWebsite( $vo_json[ "account_website" ] ); }
        if ( array_key_exists( "account_test_account", $vo_json ) ) { $o_account->setTestAccount( $vo_json[ "account_test_account" ] ); }
        if ( array_key_exists( "account_accept_ach", $vo_json ) ) { $o_account->setAcceptACH( $vo_json[ "account_accept_ach" ] ); }
        if ( array_key_exists( "account_accept_bc", $vo_json ) ) { $o_account->setAcceptBC( $vo_json[ "account_accept_bc" ] ); }
        
        if ( array_key_exists( "account_settlement_account_bank_name", $vo_json ) ) { $o_account->setSettlementAccountBankName( $vo_json[ "account_settlement_account_bank_name" ] ); }
        if ( array_key_exists( "account_settlement_account_name", $vo_json ) ) { $o_account->setSettlementAccountName( $vo_json[ "account_settlement_account_name" ] ); }
        if ( array_key_exists( "account_settlement_account_number", $vo_json ) ) { $o_account->setSettlementAccountNumber( $vo_json[ "account_settlement_account_number" ] ); }
        if ( array_key_exists( "account_settlement_account_bank_phone", $vo_json ) ) { $o_account->setSettlementAccountBankPhone( $vo_json[ "account_settlement_account_bank_phone" ] ); }
        if ( array_key_exists( "account_settlement_account_routing_number", $vo_json ) ) { $o_account->setSettlementAccountRoutingNumber( $vo_json[ "account_settlement_account_routing_number" ] ); }
        if ( array_key_exists( "account_settlement_same_as_fee_account", $vo_json ) ) { $o_account->setSettlementSameAsFeeAccount( $vo_json[ "account_settlement_same_as_fee_account" ] ); }
        if ( array_key_exists( "account_fee_account_bank_name", $vo_json ) ) { $o_account->setFeeAccountBankName( $vo_json[ "account_fee_account_bank_name" ] ); }
        if ( array_key_exists( "account_fee_account_name", $vo_json ) ) { $o_account->setFeeAccountName( $vo_json[ "account_fee_account_name" ] ); }
        if ( array_key_exists( "account_fee_account_number", $vo_json ) ) { $o_account->setFeeAccountNumber( $vo_json[ "account_fee_account_number" ] ); }
        if ( array_key_exists( "account_fee_account_routing_number", $vo_json ) ) { $o_account->setFeeAccountRoutingNumber( $vo_json[ "account_fee_account_routing_number" ] ); }
        if ( array_key_exists( "account_fee_account_bank_phone", $vo_json ) ) { $o_account->setFeeAccountBankPhone( $vo_json[ "account_fee_account_bank_phone" ] ); }
        
        return $o_account;
    }
}

?>