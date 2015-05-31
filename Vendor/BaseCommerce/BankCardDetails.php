<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BankCardDetails
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class BankCardDetails {
    
    static $XS_CARDHOLDER_CHARGED_PURCHASE = "Purchase";
    static $XS_CARDHOLDER_CHARGED_SHIPMENT = "Shipment";
    
    static $XS_DEBIT_SIGNATURE_CARDS_REQUESTED_VISA = "Visa Signature Debit";
    static $XS_DEBIT_SIGNATURE_CARDS_REQUESTED_MASTERCARD = "Mastercard Signature Debit";
    static $XS_DEBIT_SIGNATURE_CARDS_REQUESTED_DISCOVER = "Discover Signature Debit";
    
    static $XS_OTHER_BRANDS_REQUESTED_AMERICAN_EXPRESS = "American Express";
    static $XS_OTHER_BRANDS_REQUESTED_PIN_DEBIT = "Pin Debit";
    static $XS_OTHER_BRANDS_REQUESTED_EBT = "EBT";
    
    static $XS_DEBIT_BRANDS_REQUESTED_VISA = "Visa Debit";
    static $XS_DEBIT_BRANDS_REQUESTED_MASTERCARD = "MasterCard Debit";
    static $XS_DEBIT_BRANDS_REQUESTED_DISCOVER = "Discover Debit";
    
    static $XS_CREDIT_SIGNATURE_CARDS_REQUESTED_VISA_CREDIT = "Visa Credit";
    static $XS_CREDIT_SIGNATURE_CARDS_REQUESTED_DISCOVER_NETWORK_CREDIT = "Discover Network Credit";
    static $XS_CREDIT_SIGNATURE_CARDS_REQUESTED_DISCOVER_NETWORK_DEBIT = "Discover Network Debit";
    
    static $XS_CREDIT_REQUESTED_VISA_CREDIT = "Visa Credit";
    static $XS_CREDIT_REQUESTED_MASTERCARD_CREDIT = "Mastercard Credit";
    static $XS_CREDIT_REQUESTED_DISCOVER_CREDIT = "Discover Credit";
    
    static $XS_AMEX_VOLUME_ESTIMATE_SAME_AS_VISA = "Same as Visa";
    static $XS_AMEX_VOLUME_ESTIMATE_OTHER = "Other";

    private $is_fee_other;
    private $ib_accept_amex;
    private $id_amex_average_monthly_volume;
    private $id_amex_average_ticket_amount;
    private $is_amex_cap_number;
    private $is_amex_current_number;
    private $id_amex_max_high_ticket_amount;
    private $id_amex_max_monthly_volume;
    private $id_amex_transaction_fee;
    private $is_amex_auth_fee;
    private $is_auth_fee;
    private $id_avs;
    private $id_average_monthly_volume;
    private $id_average_ticket;
    private $id_batch_settlement;
    private $id_card_present_percentage;
    private $id_chargeback_fee;
    private $id_flat_rate;
    private $id_gateway_access;
    private $id_gateway_transaction;
    private $id_internet_percentage;
    private $id_max_ticket;
    private $id_max_monthly_volume;
    private $id_mid_qual_rate;
    private $id_minimum_discount;
    private $id_monthly_fee;
    private $id_non_qual_rate;
    private $id_online_stmt_fee;
    private $id_pci_compliance_monthly;
    private $id_pass_through_plus;
    private $id_pin_debit_atm_transaction;
    private $is_payment_url;
    private $id_qual_rate;
    private $ib_recurring;
    private $id_transaction_fee;
    private $id_wireless_fee;
    private $is_cardholder_charged;
    private $ib_cardholder_data_stored_locally;
    private $io_debit_signature_cards_requested;
    private $ib_previously_terminated_as_visa_mastercard_merchant;
    private $ib_visa_mastercard_signage;
    private $ib_3rd_party_access_to_cardholder_data;
    private $io_other_brands_requested;
    private $id_mail_order_percentage;
    private $id_telephone_order_percentage;
    private $ib_duplicates;
    private $io_debit_brands_requested;
    private $io_credit_signature_cards_requested;
    private $io_credit_requested;
    private $id_unpaid_item_fee;
    private $in_retrieval_fee;

    function __construct() {
        $this->io_debit_signature_cards_requested = array();
        $this->io_other_brands_requested = array();
        $this->io_debit_brands_requested = array();
        $this->io_credit_signature_cards_requested = array();
        $this->io_credit_requested = array();
    }
    
    public function getFeeOther() {
        return $this->is_fee_other;
    }

    public function setFeeOther( $vs_fee_other) {
        $this->is_fee_other = $vs_fee_other;
    }

    public function isAcceptAmex() {
        return $this->ib_accept_amex;
    }

    public function setAcceptAmex( $vb_accept_amex) {
        $this->ib_accept_amex = $vb_accept_amex;
    }

    public function getAmexAverageMonthlyVolume() {
        return $this->id_amex_average_monthly_volume;
    }

    public function setAmexAverageMonthlyVolume( $vd_amex_average_monthly_volume) {
        $this->id_amex_average_monthly_volume = $vd_amex_average_monthly_volume;
    }

    public function getAmexAverageTicketAmount() {
        return $this->id_amex_average_ticket_amount;
    }

    public function setAmexAverageTicketAmount( $vd_amex_average_ticket_amount) {
        $this->id_amex_average_ticket_amount = $vd_amex_average_ticket_amount;
    }

    public function getAmexCapNumber() {
        return $this->is_amex_cap_number;
    }

    public function setAmexCapNumber( $vs_amex_cap_number) {
        $this->is_amex_cap_number = $vs_amex_cap_number;
    }

    public function getAmexCurrentNumber() {
        return $this->is_amex_current_number;
    }

    public function setAmexCurrentNumber( $vs_amex_current_number) {
        $this->is_amex_current_number = $vs_amex_current_number;
    }

    public function getAmexMaxHighTicketAmount() {
        return $this->id_amex_max_high_ticket_amount;
    }

    public function setAmexMaxHighTicketAmount( $vd_amex_max_high_ticket_amount) {
        $this->id_amex_max_high_ticket_amount = $vd_amex_max_high_ticket_amount;
    }

    public function getAmexMaxMonthlyVolume() {
        return $this->id_amex_max_monthly_volume;
    }

    public function setAmexMaxMonthlyVolume( $vd_amex_max_monthly_volume) {
        $this->id_amex_max_monthly_volume = $vd_amex_max_monthly_volume;
    }

    public function getAmexTransactionFee() {
        return $this->id_amex_transaction_fee;
    }

    public function setAmexTransactionFee( $vd_amex_transaction_fee) {
        $this->id_amex_transaction_fee = $vd_amex_transaction_fee;
    }

    public function setAmexAuthorizationFee( $vs_amex_auth_fee) {
    	$this->is_amex_auth_fee = $vs_amex_auth_fee;
    }
    
    public function getAmexAuthorizationFee() {
    	return $this->is_amex_auth_fee;
    }
    
    public function setAuthorizationFee( $vs_auth_fee) {
    	$this->is_auth_fee = $vs_auth_fee;
    }
    
    public function getAuthorizationFee() {
    	return $this->is_auth_fee;
    }

    public function getAvs() {
        return $this->id_avs;
    }

    public function setAvs( $vd_avs) {
        $this->id_avs = $vd_avs;
    }

    public function getAverageMonthlyVolume() {
        return $this->id_average_monthly_volume;
    }

    public function setAverageMonthlyVolume( $vd_average_monthly_volume) {
        $this->id_average_monthly_volume = $vd_average_monthly_volume;
    }

    public function getAverageTicket() {
        return $this->id_average_ticket;
    }

    public function setAverageTicket( $vd_average_ticket) {
        $this->id_average_ticket = $vd_average_ticket;
    }

    public function getBatchSettlement() {
        return $this->id_batch_settlement;
    }

    public function setBatchSettlement( $vd_batch_settlement) {
        $this->id_batch_settlement = $vd_batch_settlement;
    }

    public function getCardPresentPercentage() {
        return $this->id_card_present_percentage;
    }

    public function setCardPresentPercentage( $vd_card_present_percentage) {
        $this->id_card_present_percentage = $vd_card_present_percentage;
    }

    public function getChargebackFee() {
        return $this->id_chargeback_fee;
    }

    public function setChargebackFee( $vd_chargeback_fee) {
        $this->id_chargeback_fee = $vd_chargeback_fee;
    }

    public function getFlatRate() {
        return $this->id_flat_rate;
    }

    public function setFlatRate( $vd_flat_rate) {
        $this->id_flat_rate = $vd_flat_rate;
    }

    public function getGatewayAccess() {
        return $this->id_gateway_access;
    }

    public function setGatewayAccess( $vd_gateway_access) {
        $this->id_gateway_access = $vd_gateway_access;
    }

    public function getGatewayTransaction() {
        return $this->id_gateway_transaction;
    }

    public function setGatewayTransaction( $vd_gateway_transaction) {
        $this->id_gateway_transaction = $vd_gateway_transaction;
    }

    public function getInternetPercentage() {
        return $this->id_internet_percentage;
    }

    public function setInternetPercentage( $vd_internet_percentage) {
        $this->id_internet_percentage = $vd_internet_percentage;
    }

    public function getMaxTicket() {
        return $this->id_max_ticket;
    }

    public function setMaxTicket( $vd_max_ticket) {
        $this->id_max_ticket = $vd_max_ticket;
    }

    public function getMaxMonthlyVolume() {
        return $this->id_max_monthly_volume;
    }

    public function setMaxMonthlyVolume( $vd_max_monthly_volume) {
        $this->id_max_monthly_volume = $vd_max_monthly_volume;
    }

    public function getMidQualRate() {
        return $this->id_mid_qual_rate;
    }

    public function setMidQualRate( $vd_mid_qual_rate) {
        $this->id_mid_qual_rate = $vd_mid_qual_rate;
    }

    public function getMinimumDiscount() {
        return $this->id_minimum_discount;
    }

    public function setMinimumDiscount( $vd_minimum_discount) {
        $this->id_minimum_discount = $vd_minimum_discount;
    }

    public function getMonthlyFee() {
        return $this->id_monthly_fee;
    }

    public function setMonthlyFee( $vd_monthly_fee) {
        $this->id_monthly_fee = $vd_monthly_fee;
    }

    public function getNonQualRate() {
        return $this->id_non_qual_rate;
    }

    public function setNonQualRate( $vd_non_qual_rate) {
        $this->id_non_qual_rate = $vd_non_qual_rate;
    }

    public function getOnlineStmtFee() {
        return $this->id_online_stmt_fee;
    }

    public function setOnlineStmtFee( $vd_online_stmt_fee) {
        $this->id_online_stmt_fee = $vd_online_stmt_fee;
    }

    public function getPciComplianceMonthly() {
        return $this->id_pci_compliance_monthly;
    }

    public function setPciComplianceMonthly( $vd_pci_compliance_monthly) {
        $this->id_pci_compliance_monthly = $vd_pci_compliance_monthly;
    }

    public function getPassThroughPlus() {
        return $this->id_pass_through_plus;
    }

    public function setPassThroughPlus( $vd_pass_through_plus) {
        $this->id_pass_through_plus = $vd_pass_through_plus;
    }

    public function getPinDebitAtmTransaction() {
        return $this->id_pin_debit_atm_transaction;
    }

    public function setPinDebitAtmTransaction( $vd_pin_debit_atm_transaction) {
        $this->id_pin_debit_atm_transaction = $vd_pin_debit_atm_transaction;
    }

    public function getPaymentUrl() {
        return $this->is_payment_url;
    }

    public function setPaymentUrl( $vs_payment_url) {
        $this->is_payment_url = $vs_payment_url;
    }

    public function getQualRate() {
        return $this->id_qual_rate;
    }

    public function setQualRate( $vd_qual_rate) {
        $this->id_qual_rate = $vd_qual_rate;
    }

    public function isRecurring() {
        return $this->ib_recurring;
    }

    public function setRecurring( $vb_recurring) {
        $this->ib_recurring = $vb_recurring;
    }

    public function getTransactionFee() {
        return $this->id_transaction_fee;
    }

    public function setTransactionFee( $vd_transaction_fee) {
        $this->id_transaction_fee = $vd_transaction_fee;
    }

    public function getWirelessFee() {
        return $this->id_wireless_fee;
    }

    public function setWirelessFee( $vd_wireless_fee) {
        $this->id_wireless_fee = $vd_wireless_fee;
    }

    public function getCardholderCharged() {
        return $this->is_cardholder_charged;
    }

    public function setCardholderCharged( $vs_cardholder_charged) {
        $this->is_cardholder_charged = $vs_cardholder_charged;
    }

    public function isCardholderDataStoredLocally() {
        return $this->ib_cardholder_data_stored_locally;
    }

    public function setCardholderDataStoredLocally( $vb_cardholder_data_stored_locally) {
        $this->ib_cardholder_data_stored_locally = $vb_cardholder_data_stored_locally;
    }

    public function getDebitSignatureCardsRequested() {
        return $this->io_debit_signature_cards_requested;
    }

    public function addDebitSignatureCardsRequested( $vs_debit_signature_cards_requested) {
        array_push( $this->io_debit_signature_cards_requested, $vs_debit_signature_cards_requested );
    }

    public function isPreviouslyTerminatedAsVisaMastercardMerchant() {
        return $this->ib_previously_terminated_as_visa_mastercard_merchant;
    }

    public function setPreviouslyTerminatedAsVisaMastercardMerchant( $vb_previously_terminated_as_visa_mastercard_merchant) {
        $this->ib_previously_terminated_as_visa_mastercard_merchant = $vb_previously_terminated_as_visa_mastercard_merchant;
    }

    public function isVisaMastercardSignage() {
        return $this->ib_visa_mastercard_signage;
    }

    public function setVisaMastercardSignage( $vb_visa_mastercard_signage) {
        $this->ib_visa_mastercard_signage = $vb_visa_mastercard_signage;
    }

    public function is3rdPartyAccessToCardholderData() {
        return $this->ib_3rd_party_access_to_cardholder_data;
    }

    public function set3rdPartyAccessToCardholderData( $vb_3rd_party_access_to_cardholder_data) {
        $this->ib_3rd_party_access_to_cardholder_data = $vb_3rd_party_access_to_cardholder_data;
    }

    public function getOtherBrandsRequested() {
        return $this->io_other_brands_requested;
    }

    public function addOtherBrandsRequested( $vs_other_brands_requested) {
        array_push( $this->io_other_brands_requested, $vs_other_brands_requested );
    }

    public function getMailOrderPercentage() {
        return $this->id_mail_order_percentage;
    }

    public function setMailOrderPercentage( $vd_mail_order_percentage) {
        $this->id_mail_order_percentage = $vd_mail_order_percentage;
    }

    public function getTelephoneOrderPercentage() {
        return $this->id_telephone_order_percentage;
    }

    public function setTelephoneOrderPercentage( $vd_telephone_order_percentage) {
        $this->id_telephone_order_percentage = $vd_telephone_order_percentage;
    }

    public function isDuplicates() {
        return $this->ib_duplicates;
    }

    public function setDuplicates( $vb_duplicates) {
        $this->ib_duplicates = $vb_duplicates;
    }

    public function getDebitBrandsRequested() {
        return $this->io_debit_brands_requested;
    }

    public function addDebitBrandsRequested( $vs_bank_card_debit_brands_requested) {
        array_push( $this->io_debit_brands_requested, $vs_bank_card_debit_brands_requested );
    }

    public function getCreditSignatureCardsRequested() {
        return $this->io_credit_signature_cards_requested;
    }

    public function addCreditSignatureCardsRequested( $vs_credit_signature_cards_requested) {
        array_push( $this->io_credit_signature_cards_requested, $vs_credit_signature_cards_requested );
    }

    public function getCreditRequested() {
        return $this->io_credit_requested;
    }

    public function addCreditRequested( $vs_bank_card_credit_requested) {
        array_push( $this->io_credit_requested, $vs_bank_card_credit_requested );
    }

    public function getUnpaidItemFee() {
        return $this->id_unpaid_item_fee;
    }

    public function setUnpaidItemFee( $vd_unpaid_item_fee ) {
        $this->id_unpaid_item_fee = $vd_unpaid_item_fee;
    }
    
    public function getRetrievalFee() {
    	return $this->in_retrieval_fee();
    }
    
    public function setRetrievalFee( $vn_retrieval_fee ) {
    	$this->in_retrieval_fee = $vn_retrieval_fee;
    }
    
    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->is_fee_other ) ) { $o_json[ "bank_card_details_fee_other" ] = $this->is_fee_other; }
        if ( !is_null( $this->ib_accept_amex ) ) { $o_json[ "bank_card_details_accept_amex" ] = $this->ib_accept_amex; }
        if ( !is_null( $this->id_amex_average_monthly_volume ) ) { $o_json[ "bank_card_details_amex_average_monthly_volume" ] = $this->id_amex_average_monthly_volume; }
        if ( !is_null( $this->id_amex_average_ticket_amount ) ) { $o_json[ "bank_card_details_amex_average_ticket_amount" ] = $this->id_amex_average_ticket_amount; }
        if ( !is_null( $this->is_amex_cap_number ) ) { $o_json[ "bank_card_details_amex_cap_number" ] = $this->is_amex_cap_number; }
        if ( !is_null( $this->is_amex_current_number ) ) { $o_json[ "bank_card_details_amex_current_number" ] = $this->is_amex_current_number; }
        if ( !is_null( $this->id_amex_max_high_ticket_amount ) ) { $o_json[ "bank_card_details_amex_max_high_ticket_amount" ] = $this->id_amex_max_high_ticket_amount; }
        if ( !is_null( $this->id_amex_max_monthly_volume ) ) { $o_json[ "bank_card_details_amex_max_monthly_volume" ] = $this->id_amex_max_monthly_volume; }
        if ( !is_null( $this->id_amex_transaction_fee ) ) { $o_json[ "bank_card_details_amex_transaction_fee" ] = $this->id_amex_transaction_fee; }
        if ( !is_null( $this->is_amex_auth_fee ) ) { $o_json[ "bank_card_details_amex_authorization_fee" ] = $this->is_amex_auth_fee; }
        if ( !is_null( $this->is_auth_fee ) ) { $o_json[ "bank_card_details_authorization_fee" ] = $this->is_auth_fee; }
        if ( !is_null( $this->id_avs ) ) { $o_json[ "bank_card_details_avs" ] = $this->id_avs; }
        if ( !is_null( $this->id_average_monthly_volume ) ) { $o_json[ "bank_card_details_average_monthly_volume" ] = $this->id_average_monthly_volume; }
        if ( !is_null( $this->id_average_ticket ) ) { $o_json[ "bank_card_details_average_ticket_amount" ] = $this->id_average_ticket; }
        if ( !is_null( $this->id_batch_settlement ) ) { $o_json[ "bank_card_details_batch_settlement" ] = $this->id_batch_settlement; }
        if ( !is_null( $this->id_card_present_percentage ) ) { $o_json[ "bank_card_details_card_present_percentage" ] = $this->id_card_present_percentage; }
        if ( !is_null( $this->id_chargeback_fee ) ) { $o_json[ "bank_card_details_chargeback_fee" ] = $this->id_chargeback_fee; }
        if ( !is_null( $this->id_flat_rate ) ) { $o_json[ "bank_card_details_flat_rate" ] = $this->id_flat_rate; }
        if ( !is_null( $this->id_gateway_access ) ) { $o_json[ "bank_card_details_gateway_access" ] = $this->id_gateway_access; }
        if ( !is_null( $this->id_gateway_transaction ) ) { $o_json[ "bank_card_details_gateway_transaction" ] = $this->id_gateway_transaction; }
        if ( !is_null( $this->id_internet_percentage ) ) { $o_json[ "bank_card_details_internet_percentage" ] = $this->id_internet_percentage; }
        if ( !is_null( $this->id_max_ticket ) ) { $o_json[ "bank_card_details_max_ticket" ] = $this->id_max_ticket; }
        if ( !is_null( $this->id_max_monthly_volume ) ) { $o_json[ "bank_card_details_max_monthly_volume" ] = $this->id_max_monthly_volume; }
        if ( !is_null( $this->id_mid_qual_rate ) ) { $o_json[ "bank_card_details_mid_qual_rate" ] = $this->id_mid_qual_rate; }
        if ( !is_null( $this->id_minimum_discount ) ) { $o_json[ "bank_card_details_minimum_discount" ] = $this->id_minimum_discount; }
        if ( !is_null( $this->id_monthly_fee ) ) { $o_json[ "bank_card_details_monthly_fee" ] = $this->id_monthly_fee; }
        if ( !is_null( $this->id_non_qual_rate ) ) { $o_json[ "bank_card_details_non_qual_rate" ] = $this->id_non_qual_rate; }
        if ( !is_null( $this->id_online_stmt_fee ) ) { $o_json[ "bank_card_details_online_statement_fee" ] = $this->id_online_stmt_fee; }
        if ( !is_null( $this->id_pci_compliance_monthly ) ) { $o_json[ "bank_card_details_pci_compliance_monthly" ] = $this->id_pci_compliance_monthly; }
        if ( !is_null( $this->id_pass_through_plus ) ) { $o_json[ "bank_card_details_pass_through_plus" ] = $this->id_pass_through_plus; }
        if ( !is_null( $this->id_pin_debit_atm_transaction ) ) { $o_json[ "bank_card_details_pin_debit_atm_transaction" ] = $this->id_pin_debit_atm_transaction; }
        if ( !is_null( $this->is_payment_url ) ) { $o_json[ "bank_card_details_payment_url" ] = $this->is_payment_url; }
        if ( !is_null( $this->id_qual_rate ) ) { $o_json[ "bank_card_details_qual_rate" ] = $this->id_qual_rate; }
        if ( !is_null( $this->ib_recurring ) ) { $o_json[ "bank_card_details_recurring" ] = $this->ib_recurring; }
        if ( !is_null( $this->id_transaction_fee ) ) { $o_json[ "bank_card_details_transaction_fee" ] = $this->id_transaction_fee; }
        if ( !is_null( $this->id_wireless_fee ) ) { $o_json[ "bank_card_details_wireless_fee" ] = $this->id_wireless_fee; }
        if ( !is_null( $this->is_cardholder_charged ) ) { $o_json[ "bank_card_details_cardholder_charged" ] = $this->is_cardholder_charged; }
        if ( !is_null( $this->ib_cardholder_data_stored_locally ) ) { $o_json[ "bank_card_details_cardholder_data_stored_locally" ] = $this->ib_cardholder_data_stored_locally; }
        
        $o_debit_signature_cards_requested = array();
        for ( $n_index = 0, $n_size = count( $this->io_debit_signature_cards_requested ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_debit_signature_cards_requested, $this->io_debit_signature_cards_requested[ $n_index ] );
        } 
        $o_json[ "bank_card_details_debit_signature_cards_requested" ] = $o_debit_signature_cards_requested;
        
        if ( !is_null( $this->ib_previously_terminated_as_visa_mastercard_merchant ) ) { $o_json[ "bank_card_details_prev_term_as_a_visa_mc_merchant" ] = $this->ib_previously_terminated_as_visa_mastercard_merchant; }
        if ( !is_null( $this->ib_visa_mastercard_signage ) ) { $o_json[ "bank_card_details_visa_mc_signage" ] = $this->ib_visa_mastercard_signage; }
        if ( !is_null( $this->ib_3rd_party_access_to_cardholder_data ) ) { $o_json[ "bank_card_details_3rd_party_access_to_cardholder_data" ] = $this->ib_3rd_party_access_to_cardholder_data; }
        
        $o_other_brands_requested = array();
        for ( $n_index = 0, $n_size = count( $this->io_other_brands_requested ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_other_brands_requested, $this->io_other_brands_requested[ $n_index ] );
        }
        $o_json[ "bank_card_details_other_brands_requested" ] = $o_other_brands_requested;
        
        if ( !is_null( $this->id_mail_order_percentage ) ) { $o_json[ "bank_card_details_mail_order_percentage" ] = $this->id_mail_order_percentage; }
        if ( !is_null( $this->id_telephone_order_percentage ) ) { $o_json[ "bank_card_details_telephone_order_percentage" ] = $this->id_telephone_order_percentage; }
        if ( !is_null( $this->ib_duplicates ) ) { $o_json[ "bank_card_details_duplicates" ] = $this->ib_duplicates; }
        
        $o_debit_brands_requested = array();
        for ( $n_index = 0, $n_size = count( $this->io_debit_brands_requested ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_debit_brands_requested, $this->io_debit_brands_requested[ $n_index ] );
        }
        $o_json[ "bank_card_details_debit_brands_requested" ] = $o_debit_brands_requested;
        
        $o_credit_signature_cards_requested = array();
        for ( $n_index = 0, $n_size = count( $this->io_credit_signature_cards_requested ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_credit_signature_cards_requested, $this->io_credit_signature_cards_requested[ $n_index ] );
        }
        $o_json[ "bank_card_details_credit_signature_cards_requested" ] = $o_credit_signature_cards_requested;
        
        $o_credit_requested = array();
        for ( $n_index = 0, $n_size = count( $this->io_credit_requested ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_credit_requested, $this->io_credit_requested[ $n_index ] );
        }
        $o_json[ "bank_card_details_credit_requested" ] = $o_credit_requested;
        
        if ( !is_null( $this->id_unpaid_item_fee ) ) { $o_json[ "bank_card_details_unpaid_item_fee" ] = $this->id_unpaid_item_fee; }
        if ( !is_null( $this->id_unpaid_item_fee ) ) { $o_json[ "bank_card_details_retrieval_fee" ] = $this->in_retrieval_fee; }
        
        return $o_json;
    }
    
    static function buildFromJSON( $vo_json ) {
        
        $o_bc_details = new BankCardDetails();
        
        if ( array_key_exists( "bank_card_details_fee_other", $vo_json ) ) { $o_bc_details->setFeeOther( $vo_json[ "bank_card_details_fee_other" ] ) ; }
        if ( array_key_exists( "bank_card_details_accept_amex", $vo_json ) ) { $o_bc_details->setAcceptAmex( $vo_json[ "bank_card_details_accept_amex" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_average_monthly_volume", $vo_json ) ) { $o_bc_details->setAmexAverageMonthlyVolume( $vo_json[ "bank_card_details_amex_average_monthly_volume" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_average_ticket_amount", $vo_json ) ) { $o_bc_details->setAmexAverageTicketAmount( $vo_json[ "bank_card_details_amex_average_ticket_amount" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_cap_number", $vo_json ) ) { $o_bc_details->setAmexCapNumber($vo_json[ "bank_card_details_amex_cap_number" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_current_number", $vo_json ) ) { $o_bc_details->setAmexCurrentNumber( $vo_json[ "bank_card_details_amex_current_number" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_max_high_ticket_amount", $vo_json ) ) { $o_bc_details->setAmexMaxHighTicketAmount( $vo_json[ "bank_card_details_amex_max_high_ticket_amount" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_max_monthly_volume", $vo_json ) ) { $o_bc_details->setAmexMaxMonthlyVolume( $vo_json[ "bank_card_details_amex_max_monthly_volume" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_transaction_fee", $vo_json ) ) { $o_bc_details->setAmexTransactionFee( $vo_json[ "bank_card_details_amex_transaction_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_amex_auth_fee", $vo_json ) ) { $o_bc_details->setAmexAuthFee($vo_json[ "bank_card_details_amex_authorization_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_auth_fee", $vo_json ) ) { $o_bc_details->setAuthFee($vo_json[ "bank_card_details_authorization_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_avs", $vo_json ) ) { $o_bc_details->setAvs( $vo_json[ "bank_card_details_avs" ] ) ; }
        if ( array_key_exists( "bank_card_details_average_monthly_voume", $vo_json ) ) { $o_bc_details->setAverageMonthlyVolume( $vo_json[ "bank_card_details_average_monthly_voume" ] ) ; }
        if ( array_key_exists( "bank_card_details_average_ticket_amount", $vo_json ) ) { $o_bc_details->setAverageTicket( $vo_json[ "bank_card_details_average_ticket_amount" ] ) ; }
        if ( array_key_exists( "bank_card_details_batch_settlement", $vo_json ) ) { $o_bc_details->setBatchSettlement( $vo_json[ "bank_card_details_batch_settlement" ] ) ; }
        if ( array_key_exists( "bank_card_details_card_present_percentage", $vo_json ) ) { $o_bc_details->setCardPresentPercentage( $vo_json[ "bank_card_details_card_present_percentage" ] ) ; }
        if ( array_key_exists( "bank_card_details_chargeback_fee", $vo_json ) ) { $o_bc_details->setChargebackFee( $vo_json[ "bank_card_details_chargeback_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_flat_rate", $vo_json ) ) { $o_bc_details->setFlatRate( $vo_json[ "bank_card_details_flat_rate" ] ) ; }
        if ( array_key_exists( "bank_card_details_gateway_access", $vo_json ) ) { $o_bc_details->setGatewayAccess( $vo_json[ "bank_card_details_gateway_access" ] ) ; }
        if ( array_key_exists( "bank_card_details_gateway_transaction", $vo_json ) ) { $o_bc_details->setGatewayTransaction( $vo_json[ "bank_card_details_gateway_transaction" ] ) ; }
        if ( array_key_exists( "bank_card_details_internet_percentage", $vo_json ) ) { $o_bc_details->setInternetPercentage( $vo_json[ "bank_card_details_internet_percentage" ] ) ; }
        if ( array_key_exists( "bank_card_details_max_ticket", $vo_json ) ) { $o_bc_details->setMaxTicket( $vo_json[ "bank_card_details_max_ticket" ] ) ; }
        if ( array_key_exists( "bank_card_details_max_monthly_volume", $vo_json ) ) { $o_bc_details->setMaxMonthlyVolume( $vo_json[ "bank_card_details_max_monthly_volume" ] ) ; }
        if ( array_key_exists( "bank_card_details_mid_qual_rate", $vo_json ) ) { $o_bc_details->setMidQualRate( $vo_json[ "bank_card_details_mid_qual_rate" ] ) ; }
        if ( array_key_exists( "bank_card_details_minimum_discount", $vo_json ) ) { $o_bc_details->setMinimumDiscount( $vo_json[ "bank_card_details_minimum_discount" ] ) ; }
        if ( array_key_exists( "bank_card_details_monthly_fee", $vo_json ) ) { $o_bc_details->setMonthlyFee( $vo_json[ "bank_card_details_monthly_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_non_qual_rate", $vo_json ) ) { $o_bc_details->setNonQualRate( $vo_json[ "bank_card_details_non_qual_rate" ] ) ; }
        if ( array_key_exists( "bank_card_details_online_statement_fee", $vo_json ) ) { $o_bc_details->setOnlineStmtFee( $vo_json[ "bank_card_details_online_statement_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_pci_compliance_monthly", $vo_json ) ) { $o_bc_details->setPciComplianceMonthly( $vo_json[ "bank_card_details_pci_compliance_monthly" ] ) ; }
        if ( array_key_exists( "bank_card_details_pass_through_plus", $vo_json ) ) { $o_bc_details->setPassThroughPlus( $vo_json[ "bank_card_details_pass_through_plus" ] ) ; }
        if ( array_key_exists( "bank_card_details_pin_debit_atm_transaction", $vo_json ) ) { $o_bc_details->setPinDebitAtmTransaction( $vo_json[ "bank_card_details_pin_debit_atm_transaction" ] ) ; }
        if ( array_key_exists( "bank_card_details_payment_url", $vo_json ) ) { $o_bc_details->setPaymentUrl( $vo_json[ "bank_card_details_payment_url" ] ) ; }
        if ( array_key_exists( "bank_card_details_qual_rate", $vo_json ) ) { $o_bc_details->setQualRate( $vo_json[ "bank_card_details_qual_rate" ] ) ; }
        if ( array_key_exists( "bank_card_details_recurring", $vo_json ) ) { $o_bc_details->setRecurring( $vo_json[ "bank_card_details_recurring" ] ) ; }
        if ( array_key_exists( "bank_card_details_transaction_fee", $vo_json ) ) { $o_bc_details->setTransactionFee( $vo_json[ "bank_card_details_transaction_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_wireless_fee", $vo_json ) ) { $o_bc_details->setWirelessFee( $vo_json[ "bank_card_details_wireless_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_cardholder_charged", $vo_json ) ) { $o_bc_details->setCardholderCharged( $vo_json[ "bank_card_details_cardholder_charged" ] ) ; }
        if ( array_key_exists( "bank_card_details_cardholder_data_stored_locally", $vo_json ) ) { $o_bc_details->setCardholderDataStoredLocally( $vo_json[ "bank_card_details_cardholder_data_stored_locally" ] ) ; }
        if ( array_key_exists( "bank_card_details_debit_signature_cards_requested", $vo_json ) ) {
            $o_debit_signature_cards = $vo_json[ "bank_card_details_debit_signature_cards_requested" ];
            for ( $n_index = 0, $n_size = count( $o_debit_signature_cards ); $n_index < $n_size; $n_index++ ) {
                $o_bc_details->addDebitSignatureCardsRequested( $o_debit_signature_cards[ $n_index ] );
            }
        }
        if ( array_key_exists( "bank_card_details_prev_term_as_a_visa_mc_merchant", $vo_json ) ) { $o_bc_details->setPreviouslyTerminatedAsVisaMastercardMerchant( $vo_json[ "bank_card_details_prev_term_as_a_visa_mc_merchant" ] ) ; }
        if ( array_key_exists( "bank_card_details_visa_mc_signage", $vo_json ) ) { $o_bc_details->setVisaMastercardSignage( $vo_json[ "bank_card_details_visa_mc_signage" ] ) ; }
        if ( array_key_exists( "bank_card_details_3rd_party_access_to_cardholder_data", $vo_json ) ) { $o_bc_details->set3rdPartyAccessToCardholderData( $vo_json[ "bank_card_details_3rd_party_access_to_cardholder_data" ] ) ; }
        if ( array_key_exists( "bank_card_details_other_brands_requested", $vo_json ) ) {
            $o_other_brands = $vo_json[ "bank_card_details_other_brands_requested" ];
            for ( $n_index = 0, $n_size = count( $o_other_brands ); $n_index < $n_size; $n_index++ ) {
                $o_bc_details->addOtherBrandsRequested( $o_other_brands[ $n_index ] );
            }
        }
        if ( array_key_exists( "bank_card_details_mail_order_percentage", $vo_json ) ) { $o_bc_details->setMailOrderPercentage( $vo_json[ "bank_card_details_mail_order_percentage" ] ) ; }
        if ( array_key_exists( "bank_card_details_telephone_order_percentage", $vo_json ) ) { $o_bc_details->setTelephoneOrderPercentage( $vo_json[ "bank_card_details_telephone_order_percentage" ] ) ; }
        if ( array_key_exists( "bank_card_details_duplicates", $vo_json ) ) { $o_bc_details->setDuplicates( $vo_json[ "bank_card_details_duplicates" ] ) ; }
        if ( array_key_exists( "bank_card_details_debit_brands_requested", $vo_json ) ) {
            $o_debit_brands = $vo_json[ "bank_card_details_debit_brands_requested" ];
            for ( $n_index = 0, $n_size = count( $o_debit_brands ); $n_index < $n_size; $n_index++ ) {
                $o_bc_details->addDebitBrandsRequested( $o_debit_brands[ $n_index ] );
            }
        }
        if ( array_key_exists( "bank_card_details_credit_signature_cards_requested", $vo_json ) ) {
            $o_credit_signature_cards_requested = $vo_json[ "bank_card_details_credit_signature_cards_requested" ];
            for ( $n_index = 0, $n_size = count( $o_credit_signature_cards_requested ); $n_index < $n_size; $n_index++ ) {
                $o_bc_details->addCreditSignatureCardsRequested( $o_credit_signature_cards_requested[ $n_index ] );
            }
        }
        if ( array_key_exists( "bank_card_details_credit_requested", $vo_json ) ) {
            $o_credit = $vo_json[ "bank_card_details_credit_requested" ];
            for ( $n_index = 0, $n_size = count( $o_credit ); $n_index < $n_size; $n_index++ ) {
                $o_bc_details->addCreditRequested( $o_credit[ $n_index ] );
            }
        }
        if ( array_key_exists( "bank_card_details_unpaid_item_fee", $vo_json ) ) { $o_bc_details->setUnpaidItemFee( $vo_json[ "bank_card_details_unpaid_item_fee" ] ) ; }
        if ( array_key_exists( "bank_card_details_retrieval_fee", $vo_json ) ) { $o_bc_details->setRetrievalFee( $vo_json[ "bank_card_details_retrieval_fee" ] ) ; }
        
        return $o_bc_details;
    }
    
}

?>