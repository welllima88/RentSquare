<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Internet
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class Internet {
    
    static $XS_DELIVERY_CONFIRMATION_CARRIER_SIGNATURE_TRACKING = "Carrier Signature Tracking";
    static $XS_DELIVERY_CONFIRMATION_MERCHANT_TELEPHONE_CONFIRMATION = "Merchant Telephone Confirmation";
    static $XS_DELIVERY_CONFIRMATION_OTHER = "Other";
    static $XS_DELIVERY_CONFIRMATION_NONE = "None";
    
    static $XS_RETURN_POLICY_FULL_REFUND = "Full Refund";
    static $XS_RETURN_POLICY_STORE_CREDIT = "Store Credit";
    static $XS_RETURN_POLICY_NO_REFUNDS = "No Refunds";
    
    static $XS_SHIPPED_GOODS_FEDEX = "FedEx";
    static $XS_SHIPPED_GOODS_UPS = "UPS";
    static $XS_SHIPPED_GOODS_USPS = "USPS";
    static $XS_SHIPPED_GOODS_COMMON_FREIGHT = "Common Freight";
    static $XS_SHIPPED_GOODS_ELECTRONIC_DELIVERY_DOWNLOAD = "Electronic Delivery / Download";
    static $XS_SHIPPED_GOODS_NOT_APPLICABLE = "Not Applicable";
    static $XS_SHIPPED_GOODS_OTHER = "Other";
    
    static $XS_POLICIES_AVAILABLE_ON_WEBSITE_PRIVACY_POLICY = "Privacy Policy";
    static $XS_POLICIES_AVAILABLE_ON_WEBSITE_RETURN_AND_REFUND_POLICY = "Return and Refund Policy";
    static $XS_POLICIES_AVAILABLE_ON_WEBSITE_TERMS_OF_CONDITION_OF_SALE = "Terms of Condition of Sale";
    
    static $XS_SSL_CERTIFICATE_TYPE_INDIVIDUAL = "Individual";
    static $XS_SSL_CERTIFICATE_TYPE_SHARED = "Shared";
    
    static $XS_INVENTORY_OWNER_MERCHANT = "Merchant";
    static $XS_INVENTORY_OWNER_VENDOR = "Vendor";
    
    private $id_days_between_order_and_shipping;
    private $io_delivery_confirmation;
    private $id_deposit;
    private $ib_deposit_required;
    private $ib_delivery_of_goods;
    private $id_return_policy_time_period;
    private $io_return_policy;
    private $io_shipped_goods;
    private $ib_fulfillment_vendor_utilized;
    private $id_percent_of_sales_to_non_us_card_holders;
    private $is_website_ip_address;
    private $ib_applicant_owns_web_domain_and_content;
    private $io_policies_accessible_on_website;
    private $is_web_host_vendor_name;
    private $is_ssl_certificate_issuer;
    private $is_ssl_certificate_number;
    private $is_ssl_certificate_type;
    private $is_gateway_software_name;
    private $is_gateway_software_version;
    private $is_gateway_software_vendor;
    private $is_temp_login_credentials;
    private $is_inventory_owner;
    private $is_fulfillment_vendor;
    private $is_fulfillment_vendor_phone_number;

    function __construct() {
        $this->io_delivery_confirmation = array();
        $this->io_return_policy = array();
        $this->io_shipped_goods = array();
        $this->io_policies_accessible_on_website = array();
    }
    
    public function getDaysBetweenOrderAndShipping() {
        return $this->id_days_between_order_and_shipping;
    }

    public function setDaysBetweenOrderAndShipping( $vd_days_between_order_and_shipping ) {
        $this->id_days_between_order_and_shipping = $vd_days_between_order_and_shipping;
    }

    public function getDeliveryConfirmation() {
        return $this->io_delivery_confirmation;
    }

    public function addDeliveryConfirmation($vs_delivery_confirmation) {
        array_push( $this->io_delivery_confirmation, $vs_delivery_confirmation );
    }

    public function getDeposit() {
        return $this->id_deposit;
    }

    public function setDeposit($vd_deposit) {
        $this->id_deposit = $vd_deposit;
    }

    public function isDepositRequired() {
        return $this->ib_deposit_required;
    }

    public function setDepositRequired($vb_deposit_required) {
        $this->ib_deposit_required = $vb_deposit_required;
    }

    public function isDeliveryOfGoods() {
        return $this->ib_delivery_of_goods;
    }

    public function setDeliveryOfGoods($vb_delivery_of_goods) {
        $this->ib_delivery_of_goods = $vb_delivery_of_goods;
    }

    public function getReturnPolicyTimePeriod() {
        return $this->id_return_policy_time_period;
    }

    public function setReturnPolicyTimePeriod( $vd_return_policy_time_period ) {
        $this->id_return_policy_time_period = $vd_return_policy_time_period;
    }

    public function getReturnPolicy() {
        return $this->io_return_policy;
    }

    public function addReturnPolicy($vs_return_policy) {
        $this->io_return_policy.add( $vs_return_policy );
    }

    public function getShippedGoods() {
        return $this->io_shipped_goods;
    }
    
    public function addShippedGoods( $vs_shipped_good ) {
        array_push( $this->io_shipped_goods, $vs_shipped_good );
    }
    
    public function isFulfillmentVendorUtilized() {
        return $this->ib_fulfillment_vendor_utilized;
    }

    public function setFulfillmentVendorUtilized($vb_fulfillment_vendor_utilized) {
        $this->ib_fulfillment_vendor_utilized = $vb_fulfillment_vendor_utilized;
    }

    public function getPercentOfSalesToNonUsCardHolders() {
        return $this->id_percent_of_sales_to_non_us_card_holders;
    }

    public function setPercentOfSalesToNonUsCardHolders($vd_percent_of_sales_to_non_us_card_holders) {
        $this->id_percent_of_sales_to_non_us_card_holders = $vd_percent_of_sales_to_non_us_card_holders;
    }

    public function getWebsiteIpAddress() {
        return $this->is_website_ip_address;
    }

    public function setWebsiteIpAddress($vs_website_ip_address) {
        $this->is_website_ip_address = $vs_website_ip_address;
    }

    public function isApplicantOwnsWebDomainAndContent() {
        return $this->ib_applicant_owns_web_domain_and_content;
    }

    public function setApplicantOwnsWebDomainAndContent($vs_applicant_owns_web_domain_and_content) {
        $this->ib_applicant_owns_web_domain_and_content = $vs_applicant_owns_web_domain_and_content;
    }

    public function getPoliciesAccessibleOnWebsite() {
        return $this->io_policies_accessible_on_website;
    }

    public function addPoliciesAccessibleOnWebsite($vs_policies_accessible_on_website) {
        array_push( $this->io_policies_accessible_on_website, $vs_policies_accessible_on_website );
    }

    public function getWebHostVendorName() {
        return $this->is_web_host_vendor_name;
    }

    public function setWebHostVendorName($vs_web_host_vendor_name) {
        $this->is_web_host_vendor_name = $vs_web_host_vendor_name;
    }

    public function getSslCertificateIssuer() {
        return $this->is_ssl_certificate_issuer;
    }

    public function setSslCertificateIssuer($vs_ssl_certificate_issuer) {
        $this->is_ssl_certificate_issuer = $vs_ssl_certificate_issuer;
    }

    public function getSslCertificateNumber() {
        return $this->is_ssl_certificate_number;
    }

    public function setSslCertificateNumber($vs_ssl_certificate_number) {
        $this->is_ssl_certificate_number = $vs_ssl_certificate_number;
    }

    public function getSslCertificateType() {
        return $this->is_ssl_certificate_type;
    }

    public function setSslCertificateType($vs_ssl_certificate_type) {
        $this->is_ssl_certificate_type = $vs_ssl_certificate_type;
    }
    
    public function getGatewaySoftwareName() {
    	return $this->is_gateway_software_name;
    }
    
    public function setGatewaySoftwareName($vs_gateway_software_name) {
    	$this->is_gateway_software_name = $vs_gateway_software_name;
    }
    
    public function getGatewaySoftwareVersion() {
    	return $this->is_gateway_software_version;
    }
    
    public function setGatewaySoftwareVersion($vs_gateway_software_version) {
    	$this->is_gateway_software_version = $vs_gateway_software_version;
    }

    public function getGatewaySoftwareVendor() {
        return $this->is_gateway_software_vendor;
    }

    public function setGatewaySoftwareVendor($vs_gateway_software_vendor) {
        $this->is_gateway_software_vendor = $vs_gateway_software_vendor;
    }

    public function getTempLoginCredentials() {
        return $this->is_temp_login_credentials;
    }

    public function setTempLoginCredentials($vs_temp_login_credentials) {
        $this->is_temp_login_credentials = $vs_temp_login_credentials;
    }

    public function getInventoryOwner() {
        return $this->is_inventory_owner;
    }

    public function setInventoryOwner($vs_inventory_owner) {
        $this->is_inventory_owner = $vs_inventory_owner;
    }

    public function getFulfillmentVendor() {
        return $this->is_fulfillment_vendor;
    }

    public function setFulfillmentVendor($vs_fulfillment_vendor) {
        $this->is_fulfillment_vendor = $vs_fulfillment_vendor;
    }

    public function getFulfillmentVendorPhoneNumber() {
        return $this->is_fulfillment_vendor_phone_number;
    }

    public function setFulfillmentVendorPhoneNumber($vs_fulfillment_vendor_phone_number) {
        $this->is_fulfillment_vendor_phone_number = $vs_fulfillment_vendor_phone_number;
    }
    
    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->id_days_between_order_and_shipping ) ) { $o_json[ "internet_days_between_order_and_shipping" ] = $this->id_days_between_order_and_shipping; }
       
        $o_delivery_confirmation = array();
        for ( $n_index = 0, $n_size = count( $this->io_delivery_confirmation ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_delivery_confirmation, $this->io_delivery_confirmation[$n_index] );
        }
        $o_json[ "internet_delivery_confimation" ] = $o_delivery_confirmation;
        
        if ( !is_null( $this->id_deposit ) ) { $o_json[ "internet_deposit" ] = $this->id_deposit; }
        if ( !is_null( $this->ib_deposit_required ) ) { $o_json[ "internet_deposit_required" ] = $this->ib_deposit_required; }
        if ( !is_null( $this->ib_delivery_of_goods ) ) { $o_json[ "internet_delivery_of_goods" ] = $this->ib_delivery_of_goods; }
        if ( !is_null( $this->id_return_policy_time_period ) ) { $o_json[ "internet_return_policy_time_period" ] = $this->id_return_policy_time_period; }
        
        $o_return_policy = array();
        for ( $n_index = 0, $n_size = count( $this->io_return_policy ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_return_policy, $this->io_return_policy[$n_index] );
        }
        $o_json[ "internet_return_policy" ] = $o_return_policy;
        
        $o_shipped_goods = array();
        for ( $n_index = 0, $n_size = count( $this->io_shipped_goods ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_shipped_goods, $this->io_shipped_goods[$n_index] );
        }
        $o_json[ "internet_shipped_goods" ] = $o_shipped_goods;
        
        if ( !is_null( $this->ib_fulfillment_vendor_utilized ) ) { $o_json[ "internet_fulfillment_vendor_utilized" ] = $this->ib_fulfillment_vendor_utilized; }
        if ( !is_null( $this->id_percent_of_sales_to_non_us_card_holders ) ) { $o_json[ "internet_percent_of_sales_to_non_us_cardholders" ] = $this->id_percent_of_sales_to_non_us_card_holders; }
        if ( !is_null( $this->is_website_ip_address ) ) { $o_json[ "internet_website_ip" ] = $this->is_website_ip_address; }
        if ( !is_null( $this->ib_applicant_owns_web_domain_and_content ) ) { $o_json[ "internet_applicant_owns_web_domain_and_content" ] = $this->ib_applicant_owns_web_domain_and_content; }
        
        $o_policies_accessible_on_website = array();
        for ( $n_index = 0, $n_size = count( $this->io_policies_accessible_on_website ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_policies_accessible_on_website, $this->io_policies_accessible_on_website[$n_index] );
        }
        $o_json[ "internet_policies_accessible_on_website" ] = $o_policies_accessible_on_website;
        
        if ( !is_null( $this->is_web_host_vendor_name ) ) { $o_json[ "internet_web_host_vendor_name" ] = $this->is_web_host_vendor_name; }
        if ( !is_null( $this->is_ssl_certificate_issuer ) ) { $o_json[ "internet_ssl_certificate_issuer" ] = $this->is_ssl_certificate_issuer; }
        if ( !is_null( $this->is_ssl_certificate_number ) ) { $o_json[ "internet_ssl_certificate_number" ] = $this->is_ssl_certificate_number; }
        if ( !is_null( $this->is_ssl_certificate_type ) ) { $o_json[ "internet_ssl_certificate_type" ] = $this->is_ssl_certificate_type; }
        if ( !is_null( $this->is_gateway_software_name ) ) { $o_json[ "internet_gateway_software_name" ] = $this->is_gateway_software_name; }
        if ( !is_null( $this->is_gateway_software_version ) ) { $o_json[ "internet_gateway_software_version" ] = $this->is_gateway_software_version; }
        if ( !is_null( $this->is_gateway_software_vendor ) ) { $o_json[ "internet_gateway_software_vendor" ] = $this->is_gateway_software_vendor; }
        if ( !is_null( $this->is_temp_login_credentials ) ) { $o_json[ "internet_temp_login_credentials" ] = $this->is_temp_login_credentials; }
        if ( !is_null( $this->is_inventory_owner ) ) { $o_json[ "internet_inventory_owner" ] = $this->is_inventory_owner; }
        if ( !is_null( $this->is_fulfillment_vendor ) ) { $o_json[ "internet_fulfillment_vendor" ] = $this->is_fulfillment_vendor; }
        if ( !is_null( $this->is_fulfillment_vendor_phone_number ) ) { $o_json[ "internet_fulfillment_vendor_phone_number" ] = $this->is_fulfillment_vendor_phone_number; }
        
        return $o_json;
    }
    
    static function buildFromJSON( $vo_json ) {
        //var_dump( $vo_json );
        $o_internet = new Internet();
        
        if ( array_key_exists( "internet_days_between_order_and_shipping", $vo_json ) ) { $o_internet->setDaysBetweenOrderAndShipping( $vo_json[ "internet_days_between_order_and_shipping" ] ); }
        
        if ( array_key_exists( "internet_delivery_confimation", $vo_json ) ) {
            $o_delivery_confirmation = $vo_json[ "internet_delivery_confimation" ];
            for ( $n_index = 0, $n_size = count( $o_delivery_confirmation ); $n_index < $n_size; $n_index++ ) {
                $o_internet->addDeliveryConfirmation( $o_delivery_confirmation[ $n_index ] );
            }
        }
        
        if ( array_key_exists( "internet_deposit", $vo_json ) ) { $o_internet->setDeposit( $vo_json[ "internet_deposit" ] ); }
        if ( array_key_exists( "internet_deposit_required", $vo_json ) ) { $o_internet->setDepositRequired( $vo_json[ "internet_deposit_required" ] ); }
        if ( array_key_exists( "internet_delivery_of_goods", $vo_json ) ) { $o_internet->setDeliveryOfGoods( $vo_json[ "internet_delivery_of_goods" ] ); }
        if ( array_key_exists( "internet_return_policy_time_period", $vo_json ) ) { $o_internet->setReturnPolicyTimePeriod( $vo_json[ "internet_return_policy_time_period" ] ); }
        
        if ( array_key_exists( "internet_return_policy", $vo_json ) ) {
            $o_return_policy = $vo_json[ "internet_return_policy" ];
            for ( $n_index = 0, $n_size = count( $o_return_policy ); $n_index < $n_size; $n_index++ ) {
                $o_internet->addReturnPolicy( $o_return_policy[ $n_index ] );
            }
        }
        
        if ( array_key_exists( "internet_shipped_goods", $vo_json ) ) {
            $o_shipped_goods = $vo_json[ "internet_shipped_goods" ];
            for ( $n_index = 0, $n_size = count( $o_shipped_goods ); $n_index < $n_size; $n_index++ ) {
                $o_internet->addShippedGoods( $o_shipped_goods[ $n_index ] );
            }
        }
        
        if ( array_key_exists( "internet_fulfillment_vendor_utilized", $vo_json ) ) { $o_internet->setFulfillmentVendorUtilized( $vo_json[ "internet_fulfillment_vendor_utilized" ] ); }
        if ( array_key_exists( "internet_percent_of_sales_to_non_us_cardholders", $vo_json ) ) { $o_internet->setPercentOfSalesToNonUsCardHolders( $vo_json[ "internet_percent_of_sales_to_non_us_cardholders" ] ); }
        if ( array_key_exists( "internet_website_ip", $vo_json ) ) { $o_internet->setWebsiteIpAddress( $vo_json[ "internet_website_ip" ] ); }
        if ( array_key_exists( "internet_applicant_owns_web_domain_and_content", $vo_json ) ) { $o_internet->setApplicantOwnsWebDomainAndContent( $vo_json[ "internet_applicant_owns_web_domain_and_content" ] ); }
        
        if ( array_key_exists( "internet_policies_accessible_on_website", $vo_json ) ) {
            $o_policies = $vo_json[ "internet_policies_accessible_on_website" ];
            for ( $n_index = 0, $n_size = count( $o_policies ); $n_index < $n_size; $n_index++ ) {
                $o_internet->addPoliciesAccessibleOnWebsite( $o_policies[ $n_index ] );
            }
        }
        
        if ( array_key_exists( "internet_web_host_vendor_name", $vo_json ) ) { $o_internet->setWebHostVendorName( $vo_json[ "internet_web_host_vendor_name" ] ); }
        if ( array_key_exists( "internet_ssl_certificate_issuer", $vo_json ) ) { $o_internet->setSslCertificateIssuer( $vo_json[ "internet_ssl_certificate_issuer" ] ); }
        if ( array_key_exists( "internet_ssl_certificate_number", $vo_json ) ) { $o_internet->setSslCertificateNumber( $vo_json[ "internet_ssl_certificate_number" ] ); }
        if ( array_key_exists( "internet_ssl_certificate_type", $vo_json ) ) { $o_internet->setSslCertificateType($vo_json[ "internet_ssl_certificate_type" ] ); }
        if ( array_key_exists( "internet_gateway_software_name", $vo_json ) ) { $o_internet->setGatewaySoftwareName( $vo_json[ "internet_gateway_software_name" ] ); }
        if ( array_key_exists( "internet_gateway_software_version", $vo_json ) ) { $o_internet->setGatewaySoftwareVersion( $vo_json[ "internet_gateway_software_version" ] ); }
        if ( array_key_exists( "internet_gateway_software_vendor", $vo_json ) ) { $o_internet->setGatewaySoftwareVendor( $vo_json[ "internet_gateway_software_vendor" ] ); }
        if ( array_key_exists( "internet_temp_login_credentials", $vo_json ) ) { $o_internet->setTempLoginCredentials( $vo_json[ "internet_temp_login_credentials" ] ); }
        if ( array_key_exists( "internet_inventory_owner", $vo_json ) ) { $o_internet->setInventoryOwner( $vo_json[ "internet_inventory_owner" ] ); }
        if ( array_key_exists( "internet_fulfillment_vendor", $vo_json ) ) { $o_internet->setFulfillmentVendor( $vo_json[ "internet_fulfillment_vendor" ] ); }
        if ( array_key_exists( "internet_fulfillment_vendor_phone_number", $vo_json ) ) { $o_internet->setFulfillmentVendorPhoneNumber( $vo_json[ "internet_fulfillment_vendor_phone_number" ] ); }
        
        return $o_internet;
    }
}

?>