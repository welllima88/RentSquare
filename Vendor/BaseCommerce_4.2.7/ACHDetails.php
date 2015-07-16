<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ACHDetails
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class ACHDetails {
    //put your code here
    
    static $XS_PAYMENT_TO_FROM_CONSUMER_INDIVIDUALS = "Consumer / Individuals";
    static $XS_PAYMENT_TO_FROM_BUSINESSES_ORGANIZATIONS = "Businesses / Organizations";
    
    static $XS_SUBMISSION_METHOD_MANUALLY_VIA_VIRTUAL_TERMINAL = "Manually via Virtual Terminal";
    static $XS_SUBMISSION_METHOD_VIA_A_GATEWAY = "Via a Gateway";
    static $XS_SUBMISSION_METHOD_THROUGH_WEB_SERVICES = "Through Web Services";
    static $XS_SUBMISSION_METHOD_BY_BATCH_SUBMISSION = "By Batch Submission";
    static $XS_SUBMISSION_METHOD_USING_COMPATIBLE_SOFTWARE = "Using Compatible Software";
    
    static $XS_FEES_CLIENT_REQUESTS_AUTO_RE_PRESENTMENT_OF_NSF_ITEMS = "Auto Re-Presentment of NSF Items";
    static $XS_FEES_CLIENT_REQUESTS_PAYER_AUTHENTICATION = "Payer Authentication";
    static $XS_FEES_CLIENT_REQUESTS_ACCOUNT_VERIFICATION = "Account Verification";
    static $XS_FEES_CLIENT_REQUESTS_AUTOMATED_RECURRING_BILLING_SYSTEM = "Automated Recurring Billing System";
    
    private $id_auth_method_conversion_percentage;
    private $id_auth_method_online_percentage;
    private $id_auth_method_verbal_percentage;
    private $id_average_monthly_amount;
    private $id_average_ticket_amount;
    private $id_chargeback_fee;
    private $id_collections_service_fee;
    private $is_company_name_descriptor;
    private $is_descriptor;
    private $id_discount_rate;
    private $ib_issue_credits;
    private $ib_issue_debits;
    private $id_max_daily_amount;
    private $id_max_daily_transactions;
    private $id_max_monthly_amount;
    private $id_max_monthly_transactions;
    private $id_max_single_transaction_amount;
    private $id_monthly_fee;
    private $id_monthly_minimum_fee;
    private $id_payer_auth;
    private $id_proof_of_auth_fee;
    private $io_payment_to_from;
    private $is_payment_url; 
    private $ib_recurring;
    private $id_return_fee;
    private $io_submission_method;
    private $id_termination_fee;
    private $id_transaction_fee;
    private $id_unauth_return;
    private $io_fees_client_requests;
    private $ib_merchant_reports;
    private $is_payment_url_2;
    private $is_url_passwords;
    private $ib_has_current_processor;
    private $is_username;
    private $is_password;
    private $id_in_person_signature_percentage;   
    private $ib_duplicates;
    private $is_current_processor;
    private $id_represent_fee;
    private $id_auth_method_written_in_person_percentage;
    private $id_auth_method_written_faxed_percentage;
    private $is_fee_other;
    private $is_payment_url_3;
    private $is_url_passwords_2;
    private $is_url_passwords_3;
    private $is_merchant_rep_email;

    
    /**
     * Constructor for ACHDetails
     */
    function __construct() {
        $this->io_submission_method = array();
        $this->io_fees_client_requests = array();
        $this->io_payment_to_from = array();
    }
    
    public function getAuthMethodConversionPercentage() {
        return $this->id_auth_method_conversion_percentage;
    }

    public function setAuthMethodConversionPercentage( $vd_auth_method_conversion_percentage) {
        $this->id_auth_method_conversion_percentage = $vd_auth_method_conversion_percentage;
    }

    public function getAuthMethodOnlinePercentage() {
        return $this->id_auth_method_online_percentage;
    }

    public function setAuthMethodOnlinePercentage( $vd_auth_method_online_percentage) {
        $this->id_auth_method_online_percentage = $vd_auth_method_online_percentage;
    }

    public function getAuthMethodVerbalPercentage() {
        return $this->id_auth_method_verbal_percentage;
    }

    public function setAuthMethodVerbalPercentage( $vd_auth_method_verbal_percentage) {
        $this->id_auth_method_verbal_percentage = $vd_auth_method_verbal_percentage;
    }

    public function getAverageMonthlyAmount() {
        return $this->id_average_monthly_amount;
    }

    public function setAverageMonthlyAmount( $vd_average_monthly_amount) {
        $this->id_average_monthly_amount = $vd_average_monthly_amount;
    }

    public function getAverageTicketAmount() {
        return $this->id_average_ticket_amount;
    }

    public function setAverageTicketAmount( $vd_average_ticket_amount) {
        $this->id_average_ticket_amount = $vd_average_ticket_amount;
    }

    public function getChargebackFee() {
        return $this->id_chargeback_fee;
    }

    public function setChargebackFee( $vd_chargeback_fee) {
        $this->id_chargeback_fee = $vd_chargeback_fee;
    }

    public function getCollectionsServiceFee() {
        return $this->id_collections_service_fee;
    }

    public function setCollectionsServiceFee( $vd_collections_service_fee) {
        $this->id_collections_service_fee = $vd_collections_service_fee;
    }

    public function getCompanyNameDescriptor() {
        return $this->is_company_name_descriptor;
    }

    public function setCompanyNameDescriptor( $vs_company_name_descriptor ) {
        $this->is_company_name_descriptor = $vs_company_name_descriptor;
    }

    public function getDescriptor() {
        return $this->is_descriptor;
    }

    public function setDescriptor( $vs_descriptor) {
        $this->is_descriptor = $vs_descriptor;
    }

    public function getDiscountRate() {
        return $this->id_discount_rate;
    }

    public function setDiscountRate( $vd_discount_rate) {
        $this->id_discount_rate = $vd_discount_rate;
    }

    public function isIssueCredits() {
        return $this->ib_issue_credits;
    }

    public function setIssueCredits( $vb_issue_credits) {
        $this->ib_issue_credits = $vb_issue_credits;
    }

    public function isIssueDebits() {
        return $this->ib_issue_debits;
    }

    public function setIssueDebits( $vb_issue_debits) {
        $this->ib_issue_debits = $vb_issue_debits;
    }

    public function getMaxDailyAmount() {
        return $this->id_max_daily_amount;
    }

    public function setMaxDailyAmount( $vd_max_daily_amount) {
        $this->id_max_daily_amount = $vd_max_daily_amount;
    }

    public function getMaxDailyTransactions() {
        return $this->id_max_daily_transactions;
    }

    public function setMaxDailyTransactions( $vd_max_daily_transactions) {
        $this->id_max_daily_transactions = $vd_max_daily_transactions;
    }

    public function getMaxMonthlyAmount() {
        return $this->id_max_monthly_amount;
    }

    public function setMaxMonthlyAmount( $vd_max_monthly_amount) {
        $this->id_max_monthly_amount = $vd_max_monthly_amount;
    }

    public function getMaxMonthlyTransactions() {
        return $this->id_max_monthly_transactions;
    }

    public function setMaxMonthlyTransactions( $vd_max_monthly_transactions) {
        $this->id_max_monthly_transactions = $vd_max_monthly_transactions;
    }

    public function getMaxSingleTransactionAmount() {
        return $this->id_max_single_transaction_amount;
    }

    public function setMaxSingleTransactionAmount( $vd_max_single_transaction_amount) {
        $this->id_max_single_transaction_amount = $vd_max_single_transaction_amount;
    }

    public function getMonthlyFee() {
        return $this->id_monthly_fee;
    }

    public function setMonthlyFee( $vd_monthly_fee) {
        $this->id_monthly_fee = $vd_monthly_fee;
    }

    public function getMonthlyMinimumFee() {
        return $this->id_monthly_minimum_fee;
    }

    public function setMonthlyMinimumFee( $vd_monthly_minimum_fee ) {
        $this->id_monthly_minimum_fee = $vd_monthly_minimum_fee;
    }

    public function getPayerAuth() {
        return $this->id_payer_auth;
    }

    public function setPayerAuth( $vd_payer_auth) {
        $this->id_payer_auth = $vd_payer_auth;
    }

    public function getProofOfAuthFee() {
        return $this->id_proof_of_auth_fee;
    }

    public function setProofOfAuthFee( $vd_proof_of_auth_fee) {
        $this->id_proof_of_auth_fee = $vd_proof_of_auth_fee;
    }

    public function getPaymentToFrom() {
        return $this->io_payment_to_from;
    }

    public function addPaymentToFrom( $vo_payment_to_form) {
        array_push($this->io_payment_to_from, $vo_payment_to_form);
    }

    public function getPaymentUrl() {
        return $this->is_payment_url;
    }

    public function setPaymentUrl( $vs_payment_url) {
        $this->is_payment_url = $vs_payment_url;
    }

    public function isRecurring() {
        return $this->ib_recurring;
    }

    public function setRecurring( $vb_recurring) {
        $this->ib_recurring = $vb_recurring;
    }

    public function getReturnFee() {
        return $this->id_return_fee;
    }

    public function setReturnFee( $vd_return_fee) {
        $this->id_return_fee = $vd_return_fee;
    }

    public function getSubmissionMethod() {
        return $this->io_submission_method;
    }

    public function addSubmissionMethod( $vs_submission_method) {
        array_push( $this->io_submission_method, $vs_submission_method );
    }

    public function getTerminationFee() {
        return $this->id_termination_fee;
    }

    public function setTerminationFee( $vd_termination_fee) {
        $this->id_termination_fee = $vd_termination_fee;
    }

    public function getTransactionFee() {
        return $this->id_transaction_fee;
    }

    public function setTransactionFee( $vd_transaction_fee) {
        $this->id_transaction_fee = $vd_transaction_fee;
    }

    public function getUnauthReturn() {
        return $this->id_unauth_return;
    }

    public function setUnauthReturn( $vd_unauth_return) {
        $this->id_unauth_return = $vd_unauth_return;
    }

    public function getFeesClientRequests() {
        return $this->io_fees_client_requests;
    }

    public function addFeesClientRequests( $vs_fees_client_requests) {
        array_push( $this->io_fees_client_requests, $vs_fees_client_requests );
    }

    public function isMerchantReports() {
        return $this->ib_merchant_reports;
    }

    public function setMerchantReports( $vb_merchant_reports) {
        $this->ib_merchant_reports = $vb_merchant_reports;
    }

    public function getPaymentUrl2() {
        return $this->is_payment_url_2;
    }

    public function setPaymentUrl2( $vs_payment_url_2) {
        $this->is_payment_url_2 = $vs_payment_url_2;
    }

    public function getUrlPasswords() {
        return $this->is_url_passwords;
    }

    public function setUrlPasswords( $vs_url_passwords) {
        $this->is_url_passwords = $vs_url_passwords;
    }

    public function hasCurrentProcessor() {
        return $this->ib_has_current_processor;
    }

    public function setHasCurrentProcessor( $vb_has_current_processor) {
        $this->ib_has_current_processor = $vb_has_current_processor;
    }

    public function getUsername() {
        return $this->is_username;
    }

    public function setUsername( $vs_username) {
        $this->is_username = $vs_username;
    }

    public function getPassword() {
        return $this->is_password;
    }

    public function setPassword( $vs_password) {
        $this->is_password = $vs_password;
    }

    public function getInPersonSignaturePercentage() {
        return $this->id_in_person_signature_percentage;
    }

    public function setInPersonSignaturePercentage( $vd_in_person_signature_percentage) {
        $this->id_in_person_signature_percentage = $vd_in_person_signature_percentage;
    }

    public function isDuplicates() {
        return $this->ib_duplicates;
    }

    public function setDuplicates( $vb_duplicates) {
        $this->ib_duplicates = $vb_duplicates;
    }

    public function getCurrentProcessor() {
        return $this->is_current_processor;
    }

    public function setCurrentProcessor( $vs_current_processor) {
        $this->is_current_processor = $vs_current_processor;
    }

    public function getRepresentFee() {
        return $this->id_represent_fee;
    }

    public function setRepresentFee( $vd_represent_fee) {
        $this->id_represent_fee = $vd_represent_fee;
    }

    public function getAuthMethodWrittenInPersonPercentage() {
        return $this->id_auth_method_written_in_person_percentage;
    }

    public function setAuthMethodWrittenInPersonPercentage( $vd_auth_method_written_in_person_percentage) {
        $this->id_auth_method_written_in_person_percentage = $vd_auth_method_written_in_person_percentage;
    }

    public function getAuthMethodWrittenFaxedPercentage() {
        return $this->id_auth_method_written_faxed_percentage;
    }

    public function setAuthMethodWrittenFaxedPercentage( $vd_auth_method_written_faxed_percentage) {
        $this->id_auth_method_written_faxed_percentage = $vd_auth_method_written_faxed_percentage;
    }

    public function getFeeOther() {
        return $this->is_fee_other;
    }

    public function setFeeOther( $vs_fee_other) {
        $this->is_fee_other = $vs_fee_other;
    }

    public function getPaymentUrl3() {
        return $this->is_payment_url_3;
    }

    public function setPaymentUrl3( $vs_payment_url_3) {
        $this->is_payment_url_3 = $vs_payment_url_3;
    }

    public function getUrlPasswords2() {
        return $this->is_url_passwords_2;
    }

    public function setUrlPasswords2( $vs_url_passwords_2) {
        $this->is_url_passwords_2 = $vs_url_passwords_2;
    }

    public function getUrlPasswords3() {
        return $this->is_url_passwords_3;
    }

    public function setUrlPasswords3( $vs_url_passwords_3) {
        $this->is_url_passwords_3 = $vs_url_passwords_3;
    }

    public function getMerchantRepEmail() {
        return $this->is_merchant_rep_email;
    }

    public function setMerchantRepEmail( $vs_merchant_rep_email) {
        $this->is_merchant_rep_email = $vs_merchant_rep_email;
    }
    
    public function getJSON() {
        
        $o_array = array();
        
        if ( !is_null( $this->id_auth_method_conversion_percentage ) ) { $o_array[ "ach_details_auth_method_conversion_percentage" ] = $this->id_auth_method_conversion_percentage; }
        if ( !is_null( $this->id_auth_method_online_percentage ) ) { $o_array[ "ach_details_auth_method_online_percentage" ] = $this->id_auth_method_online_percentage; }
        if ( !is_null( $this->id_auth_method_verbal_percentage ) ) { $o_array[ "ach_details_auth_method_verbal_percentage" ] = $this->id_auth_method_verbal_percentage; }
        if ( !is_null( $this->id_average_monthly_amount ) ) { $o_array[ "ach_details_average_monthly_amount" ] = $this->id_average_monthly_amount; }
        if ( !is_null( $this->id_average_ticket_amount ) ) { $o_array[ "ach_details_average_ticket_amount" ] = $this->id_average_ticket_amount; }
        if ( !is_null( $this->id_chargeback_fee ) ) { $o_array[ "ach_details_chargeback_fee" ] = $this->id_chargeback_fee; }
        if ( !is_null( $this->id_collections_service_fee ) ) { $o_array[ "ach_details_collections_service_fee" ] = $this->id_collections_service_fee; }
        if ( !is_null( $this->is_company_name_descriptor ) ) { $o_array[ "ach_details_company_name_descriptor" ] = $this->is_company_name_descriptor; }
        if ( !is_null( $this->is_descriptor ) ) { $o_array[ "ach_details_descriptor" ] = $this->is_descriptor; }
        if ( !is_null( $this->id_discount_rate ) ) { $o_array[ "ach_details_discount_rate" ] = $this->id_discount_rate; }
        if ( !is_null( $this->ib_issue_credits ) ) { $o_array[ "ach_details_issue_credits" ] = $this->ib_issue_credits; }
        if ( !is_null( $this->ib_issue_debits ) ) { $o_array[ "ach_details_issue_debits" ] = $this->ib_issue_debits; }
        if ( !is_null( $this->id_max_daily_amount ) ) { $o_array[ "ach_details_max_daily_amount" ] = $this->id_max_daily_amount; }
        if ( !is_null( $this->id_max_daily_transactions ) ) { $o_array[ "ach_details_max_daily_transactions" ] = $this->id_max_daily_transactions; }
        if ( !is_null( $this->id_max_monthly_amount ) ) { $o_array[ "ach_details_max_monthly_amount" ] = $this->id_max_monthly_amount; }
        if ( !is_null( $this->id_max_monthly_transactions ) ) { $o_array[ "ach_details_max_monthly_transactions" ] = $this->id_max_monthly_transactions; }
        if ( !is_null( $this->id_max_single_transaction_amount ) ) { $o_array[ "ach_details_max_single_transaction_amount" ] = $this->id_max_single_transaction_amount; }
        if ( !is_null( $this->id_monthly_fee ) ) { $o_array[ "ach_details_monthly_fee" ] = $this->id_monthly_fee; }
        if ( !is_null( $this->id_monthly_minimum_fee ) ) { $o_array[ "ach_details_monthly_minimum_fee" ] = $this->id_monthly_minimum_fee; }
        if ( !is_null( $this->id_payer_auth ) ) { $o_array[ "ach_details_payer_auth" ] = $this->id_payer_auth; }
        if ( !is_null( $this->id_proof_of_auth_fee ) ) { $o_array[ "ach_details_proof_of_auth_fee" ] = $this->id_proof_of_auth_fee; }
        if ( !is_null( $this->io_payment_to_from ) ) { $o_array[ "ach_details_payment_to_from" ] = $this->io_payment_to_from; }
        
        $o_payment_to_from = array();
        for ( $n_index = 0, $n_size = count( $this->io_payment_to_from ); $n_index < $n_size; $n_index++ ) {
        	array_push( $o_payment_to_from, $this->io_payment_to_from[ $n_index ] );
        }
        $o_array[ "ach_details_payment_to_from"] = $o_payment_to_from;
        
        if ( !is_null( $this->is_payment_url ) ) { $o_array[ "ach_details_payment_url" ] = $this->is_payment_url; }
        if ( !is_null( $this->ib_recurring ) ) { $o_array[ "ach_details_recurring" ] = $this->ib_recurring; }
        if ( !is_null( $this->id_return_fee ) ) { $o_array[ "ach_details_return_fee" ] = $this->id_return_fee; }
        
        $o_submission_methods = array();
        for ( $n_index = 0, $n_size = count( $this->io_submission_method ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_submission_methods, $this->io_submission_method[ $n_index ] );
        } 
        $o_array[ "ach_details_submission_methods"] = $o_submission_methods;
        
        if ( !is_null( $this->id_termination_fee ) ) { $o_array[ "ach_details_termination_fee" ] = $this->id_termination_fee; }
        if ( !is_null( $this->id_transaction_fee ) ) { $o_array[ "ach_details_transaction_fee" ] = $this->id_transaction_fee; }
        if ( !is_null( $this->id_unauth_return ) ) { $o_array[ "ach_details_unauth_return" ] = $this->id_unauth_return; }
        
        $o_fees_client_requests = array();
        for ( $n_index = 0, $n_size = count( $this->io_fees_client_requests ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_fees_client_requests, $this->io_fees_client_requests[ $n_index ] );
        } 
        $o_array[ "ach_details_fees_client_requests"] = $o_fees_client_requests;
        
        if ( !is_null( $this->ib_merchant_reports ) ) { $o_array[ "ach_details_merchant_reports" ] = $this->ib_merchant_reports; }
        if ( !is_null( $this->is_payment_url_2 ) ) { $o_array[ "ach_details_payment_url_2" ] = $this->is_payment_url_2; }
        if ( !is_null( $this->is_url_passwords ) ) { $o_array[ "ach_details_url_passwords" ] = $this->is_url_passwords; }
        if ( !is_null( $this->ib_has_current_processor ) ) { $o_array[ "ach_details_has_current_processor" ] = $this->ib_has_current_processor; }
        if ( !is_null( $this->is_username ) ) { $o_array[ "ach_details_username" ] = $this->is_username; }
        if ( !is_null( $this->is_password ) ) { $o_array[ "ach_details_password" ] = $this->is_password; }
        if ( !is_null( $this->id_in_person_signature_percentage ) ) { $o_array[ "ach_details_in_person_signature" ] = $this->id_in_person_signature_percentage; }
        if ( !is_null( $this->ib_duplicates ) ) { $o_array[ "ach_details_duplicates" ] = $this->ib_duplicates; }
        if ( !is_null( $this->is_current_processor ) ) { $o_array[ "ach_details_current_processor" ] = $this->is_current_processor; }
        if ( !is_null( $this->id_represent_fee ) ) { $o_array[ "ach_details_represent_fee" ] = $this->id_represent_fee; }
        if ( !is_null( $this->id_auth_method_written_in_person_percentage ) ) { $o_array[ "ach_details_auth_method_written_in_person_percentage" ] = $this->id_auth_method_written_in_person_percentage; }
        if ( !is_null( $this->id_auth_method_written_faxed_percentage ) ) { $o_array[ "ach_details_auth_method_written_in_faxed_percentage" ] = $this->id_auth_method_written_faxed_percentage; }
        if ( !is_null( $this->is_fee_other ) ) { $o_array[ "ach_details_fee_other" ] = $this->is_fee_other; }
        if ( !is_null( $this->is_payment_url_3 ) ) { $o_array[ "ach_details_payment_url_3" ] = $this->is_payment_url_3; }
        if ( !is_null( $this->is_url_passwords_2 ) ) { $o_array[ "ach_details_url_passwords_2" ] = $this->is_url_passwords_2; }
        if ( !is_null( $this->is_url_passwords_3 ) ) { $o_array[ "ach_details_url_passwords_3" ] = $this->is_url_passwords_3; }
        if ( !is_null( $this->is_merchant_rep_email ) ) { $o_array[ "ach_details_merchant_rep_email" ] = $this->is_merchant_rep_email; }
        
        return $o_array;
    }
    
    static function buildFromJSON( $vo_json ) {
        
        $o_ach_details = new ACHDetails();
        
        if ( array_key_exists( "ach_details_auth_method_conversion_percentage", $vo_json ) ) { $o_ach_details->setAuthMethodConversionPercentage( $vo_json[ "ach_details_auth_method_conversion_percentage" ]  ); }
        if ( array_key_exists( "ach_details_auth_method_online_percentage", $vo_json ) ) { $o_ach_details->setAuthMethodOnlinePercentage( $vo_json[ "ach_details_auth_method_online_percentage" ]  ); }
        if ( array_key_exists( "ach_details_auth_method_verbal_percentage", $vo_json ) ) { $o_ach_details->setAuthMethodVerbalPercentage( $vo_json[ "ach_details_auth_method_verbal_percentage" ]  ); }
        if ( array_key_exists( "ach_details_average_monthly_amount", $vo_json ) ) { $o_ach_details->setAverageMonthlyAmount( $vo_json[ "ach_details_average_monthly_amount" ]  ); }
        if ( array_key_exists( "ach_details_average_ticket_amount", $vo_json ) ) { $o_ach_details->setAverageTicketAmount( $vo_json[ "ach_details_average_ticket_amount" ]  ); }
        if ( array_key_exists( "ach_details_chargeback_fee", $vo_json ) ) { $o_ach_details->setChargebackFee( $vo_json[ "ach_details_chargeback_fee" ]  ); }
        if ( array_key_exists( "ach_details_collections_service_fee", $vo_json ) ) { $o_ach_details->setCollectionsServiceFee( $vo_json[ "ach_details_collections_service_fee" ]  ); }
        if ( array_key_exists( "ach_details_company_name_descriptor", $vo_json ) ) { $o_ach_details->setCompanyNameDescriptor( $vo_json[ "ach_details_company_name_descriptor" ]  ); }
        if ( array_key_exists( "ach_details_descriptor", $vo_json ) ) { $o_ach_details->setDescriptor( $vo_json[ "ach_details_descriptor" ]  ); }
        if ( array_key_exists( "ach_details_discount_rate", $vo_json ) ) { $o_ach_details->setDiscountRate( $vo_json[ "ach_details_discount_rate" ]  ); }
        if ( array_key_exists( "ach_details_issue_credits", $vo_json ) ) { $o_ach_details->setIssueCredits( $vo_json[ "ach_details_issue_credits" ]  ); }
        if ( array_key_exists( "ach_details_issue_debits", $vo_json ) ) { $o_ach_details->setIssueDebits( $vo_json[ "ach_details_issue_debits" ]  ); }
        if ( array_key_exists( "ach_details_max_daily_amount", $vo_json ) ) { $o_ach_details->setMaxDailyAmount( $vo_json[ "ach_details_max_daily_amount" ]  ); }
        if ( array_key_exists( "ach_details_max_daily_transactions", $vo_json ) ) { $o_ach_details->setMaxDailyTransactions( $vo_json[ "ach_details_max_daily_transactions" ]  ); }
        if ( array_key_exists( "ach_details_max_monthly_amount", $vo_json ) ) { $o_ach_details->setMaxMonthlyAmount( $vo_json[ "ach_details_max_monthly_amount" ]  ); }
        if ( array_key_exists( "ach_details_max_monthly_transactions", $vo_json ) ) { $o_ach_details->setMaxMonthlyTransactions( $vo_json[ "ach_details_max_monthly_transactions" ]  ); }
        if ( array_key_exists( "ach_details_max_single_transaction_amount", $vo_json ) ) { $o_ach_details->setMaxSingleTransactionAmount( $vo_json[ "ach_details_max_single_transaction_amount" ]  ); }
        if ( array_key_exists( "ach_details_monthly_fee", $vo_json ) ) { $o_ach_details->setMonthlyFee( $vo_json[ "ach_details_monthly_fee" ]  ); }
        if ( array_key_exists( "ach_details_monthly_minimum_fee", $vo_json ) ) { $o_ach_details->setMonthlyMinimumFee( $vo_json[ "ach_details_monthly_minimum_fee" ]  ); }
        if ( array_key_exists( "ach_details_payer_auth", $vo_json ) ) { $o_ach_details->setPayerAuth( $vo_json[ "ach_details_payer_auth" ]  ); }
        if ( array_key_exists( "ach_details_proof_of_auth_fee", $vo_json ) ) { $o_ach_details->setProofOfAuthFee( $vo_json[ "ach_details_proof_of_auth_fee" ]  ); }
        
        if ( array_key_exists( "ach_details_payment_to_from", $vo_json ) ) {
        	$o_payment_to_from = $vo_json[ "ach_details_payment_to_from" ];
        	for ($n_index = 0, $n_size = count( $o_payment_to_from ); $n_index < $n_size; $n_index++ ) {
        		$o_ach_details->addPaymentToFrom( $o_payment_to_from[ $n_index ] );
        	}
        }
        
        if ( array_key_exists( "ach_details_payment_url", $vo_json ) ) { $o_ach_details->setPaymentUrl( $vo_json[ "ach_details_payment_url" ]  ); }
        if ( array_key_exists( "ach_details_recurring", $vo_json ) ) { $o_ach_details->setRecurring( $vo_json[ "ach_details_recurring" ]  ); }
        if ( array_key_exists( "ach_details_return_fee", $vo_json ) ) { $o_ach_details->setReturnFee( $vo_json[ "ach_details_return_fee" ]  ); }
        
        if ( array_key_exists( "ach_details_submission_methods", $vo_json ) ) {
            $o_submission_methods = $vo_json[ "ach_details_submission_methods" ];
            for ( $n_index = 0, $n_size = count( $o_submission_methods ); $n_index < $n_size; $n_index++ ) {
                $o_ach_details->addSubmissionMethod( $o_submission_methods[ $n_index ] );
            }
        }
        
        if ( array_key_exists( "ach_details_termination_fee", $vo_json ) ) { $o_ach_details->setTerminationFee( $vo_json[ "ach_details_termination_fee" ]  ); }
        if ( array_key_exists( "ach_details_transaction_fee", $vo_json ) ) { $o_ach_details->setTransactionFee( $vo_json[ "ach_details_transaction_fee" ]  ); }
        if ( array_key_exists( "ach_details_unauth_return", $vo_json ) ) { $o_ach_details->setUnauthReturn( $vo_json[ "ach_details_unauth_return" ]  ); }

        if ( array_key_exists( "ach_details_submission_methods", $vo_json ) ) {
            $o_fees_client_requests = $vo_json[ "ach_details_fees_client_requests" ];
            for ( $n_index = 0, $n_size = count( $o_fees_client_requests ); $n_index < $n_size; $n_index++ ) {
                $o_ach_details->addFeesClientRequests( $o_fees_client_requests[ $n_index ] );
            }
        }
        
        if ( array_key_exists( "ach_details_merchant_reports", $vo_json ) ) { $o_ach_details->setMerchantReports( $vo_json[ "ach_details_merchant_reports" ]  ); }
        if ( array_key_exists( "ach_details_payment_url_2", $vo_json ) ) { $o_ach_details->setPaymentUrl2( $vo_json[ "ach_details_payment_url_2" ]  ); }
        if ( array_key_exists( "ach_details_url_passwords", $vo_json ) ) { $o_ach_details->setUrlPasswords( $vo_json[ "ach_details_url_passwords" ]  ); }
        if ( array_key_exists( "ach_details_has_current_processor", $vo_json ) ) { $o_ach_details->setHasCurrentProcessor( $vo_json[ "ach_details_has_current_processor" ]  ); }
        if ( array_key_exists( "ach_details_username", $vo_json ) ) { $o_ach_details->setUsername( $vo_json[ "ach_details_username" ]  ); }
        if ( array_key_exists( "ach_details_password", $vo_json ) ) { $o_ach_details->setPassword( $vo_json[ "ach_details_password" ]  ); }
        if ( array_key_exists( "ach_details_in_person_signature", $vo_json ) ) { $o_ach_details->setInPersonSignaturePercentage( $vo_json[ "ach_details_in_person_signature" ]  ); }
        if ( array_key_exists( "ach_details_duplicates", $vo_json ) ) { $o_ach_details->setDuplicates( $vo_json[ "ach_details_duplicates" ]  ); }
        if ( array_key_exists( "ach_details_current_processor", $vo_json ) ) { $o_ach_details->setCurrentProcessor( $vo_json[ "ach_details_current_processor" ]  ); }
        if ( array_key_exists( "ach_details_represent_fee", $vo_json ) ) { $o_ach_details->setRepresentFee( $vo_json[ "ach_details_represent_fee" ]  ); }
        if ( array_key_exists( "ach_details_auth_method_written_in_person_percentage", $vo_json ) ) { $o_ach_details->setAuthMethodWrittenInPersonPercentage( $vo_json[ "ach_details_auth_method_written_in_person_percentage" ]  ); }
        if ( array_key_exists( "ach_details_auth_method_written_in_faxed_percentage", $vo_json ) ) { $o_ach_details->setAuthMethodWrittenFaxedPercentage( $vo_json[ "ach_details_auth_method_written_in_faxed_percentage" ]  ); }
        if ( array_key_exists( "ach_details_fee_other", $vo_json ) ) { $o_ach_details->setFeeOther( $vo_json[ "ach_details_fee_other" ]  ); }
        if ( array_key_exists( "ach_details_payment_url_3", $vo_json ) ) { $o_ach_details->setPaymentUrl3( $vo_json[ "ach_details_payment_url_3" ]  ); }
        if ( array_key_exists( "ach_details_url_passwords_2", $vo_json ) ) { $o_ach_details->setUrlPasswords2( $vo_json[ "ach_details_url_passwords_2" ]  ); }
        if ( array_key_exists( "ach_details_url_passwords_3", $vo_json ) ) { $o_ach_details->setUrlPasswords3( $vo_json[ "ach_details_url_passwords_3" ]  ); }
        if ( array_key_exists( "ach_details_merchant_rep_email", $vo_json ) ) { $o_ach_details->setMerchantRepEmail( $vo_json[ "ach_details_merchant_rep_email" ]  ); }
                
        
        return $o_ach_details;
    } 
}

?>