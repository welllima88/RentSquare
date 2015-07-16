<?php

include_once 'Terminal.php';
include_once 'PrincipalContact.php';
include_once 'BankCardDetails.php';
include_once 'ACHDetails.php';
include_once 'MOTO.php';
include_once 'Internet.php';
include_once 'POS.php';

/**
 * Description of Location
 *
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 */
class Location {
    
    static $XS_INDUSTRY_AGRICULTURE = "Agriculture";
    static $XS_INDUSTRY_APPAREL = "Apparel";
    static $XS_INDUSTRY_BANKING = "Banking";
    static $XS_INDUSTRY_BIOTECHNOLOGY = "Biotechnology";
    static $XS_INDUSTRY_CHEMICALS = "Chemicals";
    static $XS_INDUSTRY_COMMUNICATIONS = "Communications";
    static $XS_INDUSTRY_CONSTRUCTION = "Construction";
    static $XS_INDUSTRY_CONSULTING = "Consulting";
    static $XS_INDUSTRY_EDUCATION = "Education";
    static $XS_INDUSTRY_ELECTRONICS = "Electronics";
    static $XS_INDUSTRY_ENERGY = "Energy";
    static $XS_INDUSTRY_ENGINEERING = "Engineering";
    static $XS_INDUSTRY_ENTERTAINMENT = "Entertainment";
    static $XS_INDUSTRY_ENVIRONMENT = "Environment";
    static $XS_INDUSTRY_FINANCE = "Finance";
    static $XS_INDUSTRY_FOOD_AND_BEVERAGE = "Food & Beverage";
    static $XS_INDUSTRY_GOVERNMENT = "Government";
    static $XS_INDUSTRY_HEALTHCARE = "Healthcare";
    static $XS_INDUSTRY_HOSPITALITY = "Hospitality";
    static $XS_INDUSTRY_INSURANCE = "Insurance";
    static $XS_INDUSTRY_MACHINERY = "Machinery";
    static $XS_INDUSTRY_MANUFACTURING = "Manufacturing";
    static $XS_INDUSTRY_MEDIA = "Media";
    static $XS_INDUSTRY_RECREATION = "Recreation";
    static $XS_INDUSTRY_RETAIL = "Retail";
    static $XS_INDUSTRY_SHIPPING = "Shipping";
    static $XS_INDUSTRY_TECHNOLOGY = "Technology";
    static $XS_INDUSTRY_TELECOMMUNICATIONS = "Telecommunications";
    static $XS_INDUSTRY_TRANSPORTATION = "Transportation";
    static $XS_INDUSTRY_UTILITIES = "Utilities";
    static $XS_INDUSTRY_OTHER = "Other";
    
    static $XS_OWNERSHIP_PUBLIC = "Public";
    static $XS_OWNERSHIP_PRIVATE = "Private";
    static $XS_OWNERSHIP_SUBSIDIARY = "Subsidiary";
    static $XS_OWNERSHIP_OTHER = "Other";
    
    static $XS_LEAD_SOURCE_3RD_PARTY = "3rd Party";
    static $XS_LEAD_SOURCE_OUTBOUND_MARKETING = "Outbound Marketing";
    static $XS_LEAD_SOURCE_MERCHANT_REFERRAL = "Merchant Referral";
    static $XS_LEAD_SOURCE_RESELLER_PARTNERS = "Reseller Partners";
    static $XS_LEAD_SOURCE_ONLINE = "Online";
    static $XS_LEAD_SOURCE_OTHER = "Other";
    static $XS_LEAD_SOURCE_REFERRAL_PARTNER = "Referral Partner";
    
    static $XS_POLICIES_ON_WEBSITE_PRIVACY_POLICY = "Privacy Policy";
    static $XS_POLICIES_ON_WEBSITE_RETURN_AND_REFUND_POLICY = "Return and Refund Policy";
    static $XS_POLICIES_ON_WEBSITE_TERMS_OF_CONDITIONS_OF_SALE = "Terms of Condition of Sale";
    
    static $XS_DESCRIPTION_ACCOUNTING = "Accounting";
    static $XS_DESCRIPTION_APPAREL = "Apparel";
    static $XS_DESCRIPTION_ART_PHOTO_FILM = "Art / Photo / Film";
    static $XS_DESCRIPTION_BARBER_HAIR_SALON = "Barber / Hair Salon";
    static $XS_DESCRIPTION_CATERING = "Catering";
    static $XS_DESCRIPTION_CLEANING_SERVICES = "Cleaning Services";
    static $XS_DESCRIPTION_COMPUTER_SERVICES = "Computer Services";
    static $XS_DESCRIPTION_CONSULTING = "Consulting";
    static $XS_DESCRIPTION_CONSTRUCTION = "Construction";
    static $XS_DESCRIPTION_DENTISTRY = "Dentistry";
    static $XS_DESCRIPTION_FOOD_GROCERY ="Food / Grocery";
    static $XS_DESCRIPTION_HEALTH_CARE = "Health Care";
    static $XS_DESCRIPTION_LANDSCAPING = "Landscaping";
    static $XS_DESCRIPTION_LEGAL_SERVICES = "Legal Services";
    static $XS_DESCRIPTION_MEMBERSHIP_ORGANIZATION = "Membership Organization";
    static $XS_DESCRIPTION_OTHER = "OTHER";
    static $XS_DESCRIPTION_PERSONAL_SERVICES = "Personal Services";
    static $XS_DESCRIPTION_REAL_ESTATE = "Real Estate";
    static $XS_DESCRIPTION_REPAIR_SERVICS = "Repair Services";
    static $XS_DESCRIPTION_RESTAURANT_BAR = "Restaurant / Bar";
    static $XS_DESCRIPTION_RETAIL = "Retail";
    static $XS_DESCRIPTION_SHIPPING = "Shipping";
    static $XS_DESCRIPTION_TAXI_LIMO = "Taxi / Limo";
    static $XS_DESCRIPTION_TRADE_CONTRACTOR = "Trade Contractor";
    static $XS_DESCRIPTION_VETERINARY = "Veterinary";
    static $XS_DESCRIPTION_WEB_DESIGN_DEVELOPMENT = "Web Design / Development";
    
    static $XS_NEW_VISA_UTILITY_ACCEPTOR_YES = "Yes";
    static $XS_NEW_VISA_UTILITY_ACCEPTOR_NO = "No";
    static $XS_NEW_VISA_UTILITY_ACCEPTOR_NOT_APPLICABLE = "Not Applicable";
    
    static $XS_UTILITY_OWNERSHIP_PUBLIC = "Public";
    static $XS_UTILITY_OWNERSHIP_PRIVATE = "Private";
    
    private $in_annual_revenue;
    private $is_contact_name;
    private $is_contact_email;
    private $is_e_fax;
    private $is_contact_mobile;
    private $is_contact_title;
    private $ib_contact_same_as_owner;
    private $is_fax;
    private $is_industry;
    private $is_ownership;
    private $is_description;
    private $id_years_in_business;
    private $is_organization_mission; 
    private $io_entity_start_date;
    private $is_entity_state;
    private $is_alternative_fax; 
    private $is_year_incorporated;
    private $is_description_of_products_and_services;
    private $is_length_of_current_ownership;
    private $in_quantity_of_locations;       
    private $is_waive_pg;
    private $is_partner_biller_id;
    private $is_partner_reseller_id;
    private $is_partner_sub_account_id;
    private $is_program_pricing;
    private $is_program_details;
    private $io_lead_sources;
    private $is_sales_agent_name;
    private $is_parent_id;
    private $is_additional_description;
//    private $is_description;
    private $is_new_visa_utility_acceptor;
    private $ib_tax_exempt;
    private $in_total_customers; 
    private $is_utility_ownership;
    private $io_terminals;
    private $io_principal_contacts;
    private $io_bank_card_details;
    private $io_ach_details;
    private $io_moto;
    private $io_internet;
    private $io_pos;
    private $io_dba_address;
    private $is_chargeback_fax;
    
    function __construct() {
        $this->io_lead_sources = array();
        $this->io_policies_accessible_on_websites = array();
        $this->io_terminals = array();
        $this->io_principal_contacts = array();
    }
    
    public function getAnnualRevenue() {
        return $this->in_annual_revenue;
    }

    public function setAnnualRevenue( $vn_annual_revenue ) {
        $this->in_annual_revenue = $vn_annual_revenue;
    }
    
    public function getContactName() {
        return $this->is_contact_name;
    }

    public function setContactName($vs_contact_name) {
        $this->is_contact_name = $vs_contact_name;
    }

    public function getContactEmail() {
        return $this->is_contact_email;
    }

    public function setContactEmail($vs_contact_email) {
        $this->is_contact_email = $vs_contact_email;
    }

    public function getEFax() {
        return $this->is_e_fax;
    }

    public function setEFax($vs_e_fax) {
        $this->is_e_fax = $vs_e_fax;
    }

    public function getContactMobile() {
        return $this->is_contact_mobile;
    }

    public function setContactMobile($vs_contact_mobile) {
        $this->is_contact_mobile = $vs_contact_mobile;
    }

    public function getContactTitle() {
        return $this->is_contact_title;
    }

    public function setContactTitle($vs_contact_title) {
        $this->is_contact_title = $vs_contact_title;
    }

    public function getContactSameAsOwner() {
        return $this->ib_contact_same_as_owner;
    }

    public function setContactSameAsOwner($vb_contact_same_as_owner) {
        $this->ib_contact_same_as_owner = $vb_contact_same_as_owner;
    }

    public function getFax() {
        return $this->is_fax;
    }

    public function setFax($vs_fax) {
        $this->is_fax = $vs_fax;
    }

    public function getIndustry() {
        return $this->is_industry;
    }

    public function setIndustry($vs_industry) {
        $this->is_industry = $vs_industry;
    }

    public function getOwnership() {
        return $this->is_ownership;
    }

    public function setOwnership($vs_ownership) {
        $this->is_ownership = $vs_ownership;
    }

    public function getDescription() {
        return $this->is_description;
    }

    public function setDescription($vs_description) {
        $this->is_description = $vs_description;
    }

    public function getYearsInBusiness() {
        return $this->id_years_in_business;
    }

    public function setYearsInBusiness( $vd_years_in_business ) {
        $this->id_years_in_business = $vd_years_in_business;
    }

    public function getOrganizationMission() {
        return $this->is_organization_mission;
    }

    public function setOrganizationMission($vs_org_mission) {
        $this->is_organization_mission = $vs_org_mission;
    }

    public function getEntityStartDate() {
        return $this->io_entity_start_date;
    }

    /**
     * sets the entity start date
     * @param type $vo_entity_start_date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setEntityStartDate($vo_entity_start_date) {
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( strpos($vo_entity_start_date, '/') !== FALSE ) {
            $this->io_entity_start_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_entity_start_date )->format('m/d/Y H:i:s');
        } else {
            $this->io_entity_start_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_entity_start_date )->format('m/d/Y H:i:s');
        }
    }

    public function getEntityState() {
        return $this->is_entity_state;
    }

    public function setEntityState($vs_entity_state) {
        $this->is_entity_state = $vs_entity_state;
    }

    public function getAlternativeFax() {
        return $this->is_alternative_fax;
    }

    public function setAlternativeFax($vs_alt_fax) {
        $this->is_alternative_fax = $vs_alt_fax;
    }

    public function getYearIncorporated() {
        return $this->is_year_incorporated;
    }

    public function setYearIncorporated($vs_year_incorporated) {
        $this->is_year_incorporated = $vs_year_incorporated;
    }

    public function getDescriptionOfProductsAndServices() {
        return $this->is_description_of_products_and_services;
    }

    public function setDescriptionOfProductsAndServices($vs_description_of_products_and_services) {
        $this->is_description_of_products_and_services = $vs_description_of_products_and_services;
    }

    public function getLengthOfCurrentOwnership() {
        return $this->is_length_of_current_ownership;
    }

    public function setLengthOfCurrentOwnership($vs_length_of_current_ownership) {
        $this->is_length_of_current_ownership = $vs_length_of_current_ownership;
    }

    public function getQuantityOfLocations() {
        return $this->in_quantity_of_locations;
    }

    public function setQuantityOfLocation($vn_quantity_of_locations) {
        $this->in_quantity_of_locations = $vn_quantity_of_locations;
    }

    public function getWaivePg() {
        return $this->is_waive_pg;
    }

    public function setWaivePg($vs_waive_pg) {
        $this->is_waive_pg = $vs_waive_pg;
    }

    public function getPartnerBillerId() {
        return $this->is_partner_biller_id;
    }

    public function setPartnerBillerId($vs_partner_biller_id) {
        $this->is_partner_biller_id = $vs_partner_biller_id;
    }

    public function getPartnerResellerId() {
        return $this->is_partner_reseller_id;
    }

    public function setPartnerResellerId($vs_partner_reseller_id) {
        $this->is_partner_reseller_id = $vs_partner_reseller_id;
    }

    public function getPartnerSubAccountId() {
        return $this->is_partner_sub_account_id;
    }

    public function setPartnerSubAccountId($vs_partner_sub_account_id) {
        $this->is_partner_sub_account_id = $vs_partner_sub_account_id;
    }

    public function getProgramPricing() {
        return $this->is_program_pricing;
    }

    public function setProgramPricing($vs_program_pricing) {
        $this->is_program_pricing = $vs_program_pricing;
    }

    public function getProgramDetails() {
        return $this->is_program_details;
    }

    public function setProgramDetails($vs_program_details) {
        $this->is_program_details = $vs_program_details;
    }

    public function getLeadSources() {
        return $this->io_lead_sources;
    }

    public function addLeadSource($vs_lead_source) {
        array_push( $this->io_lead_sources, $vs_lead_source );
    }

    public function getSalesAgentName() {
        return $this->is_sales_agent_name;
    }

    public function setSalesAgentName($vs_sales_agent_name) {
        $this->is_sales_agent_name = $vs_sales_agent_name;
    }

    public function getParentId() {
        return $this->is_parent_id;
    }

    public function setParentId($vs_parent_id) {
        $this->is_parent_id = $vs_parent_id;
    }

    public function getAdditionalDescription() {
        return $this->is_additional_description;
    }

    public function setAdditionalDescription($vs_additional_description) {
        $this->is_additional_description = $vs_additional_description;
    }

    public function getNewVisaUtilityAcceptor() {
        return $this->is_new_visa_utility_acceptor;
    }

    public function setNewVisaUtilityAcceptor($vs_new_visa_utility_acceptor) {
        $this->is_new_visa_utility_acceptor = $vs_new_visa_utility_acceptor;
    }

    public function isTaxExempt() {
        return $this->ib_tax_exempt;
    }

    public function setTaxExempt($vb_tax_exempt) {
        $this->ib_tax_exempt = $vb_tax_exempt;
    }

    public function getTotalCustomers() {
        return $this->in_total_customers;
    }

    public function setTotalCustomers($vn_total_customers) {
        $this->in_total_customers = $vn_total_customers;
    }

    public function getUtilityOwnership() {
        return $this->is_utility_ownership;
    }

    public function setUtilityOwnership($vs_utility_ownership) {
        $this->is_utility_ownership = $vs_utility_ownership;
    }

    public function getTerminals() {
        return $this->io_terminals;
    }

    public function addTerminal( $vo_terminal) {
        array_push( $this->io_terminals, $vo_terminal );
    }

    public function getPrincipalContacts() {
        return $this->io_principal_contacts;
    }

    public function addPrincipalContact( $vo_principal_contact ) {
        array_push( $this->io_principal_contacts, $vo_principal_contact );
    }

    public function getBankCardDetails() {
        return $this->io_bank_card_details;
    }

    public function setBankCardDetails($vo_bank_card_details) {
        $this->io_bank_card_details = $vo_bank_card_details;
    }

    public function getAchDetails() {
        return $this->io_ach_details;
    }

    public function setAchDetails($vo_ach_details) {
        $this->io_ach_details = $vo_ach_details;
    }

    public function getMoto() {
        return $this->io_moto;
    }

    public function setMoto($vo_moto) {
        $this->io_moto = $vo_moto;
    }

    public function getInternet() {
        return $this->io_internet;
    }

    public function setInternet($vo_internet) {
        $this->io_internet = $vo_internet;
    }

    public function getPos() {
        return $this->io_pos;
    }

    public function setPos($vo_pos) {
        $this->io_pos = $vo_pos;
    }

    public function getDBAAddress() {
        return $this->io_dba_address;
    }

    public function setDBAAddress( Address $vo_dba_address ) {
        $this->io_dba_address = $vo_dba_address;
    }
    
    /**
     * sets the chargeback fax number
     * @param type $vs_chargeback_fax the chargeback fax number
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setChargebackFax( $vs_chargeback_fax ) {
        $this->is_chargeback_fax = $vs_chargeback_fax;
    }
    
    /**
     * returns the chargeback fax number
     * @return type string of the chargeback fax number
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getChargebackFax() {
        return $this->is_chargeback_fax;
    }
    
    /**
     * returns a JSON representation of the location class
     * @return type json array of the location class
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->in_annual_revenue ) ) { $o_json[ "location_annual_revenue"] = $this->in_annual_revenue; }
        if ( !is_null( $this->is_contact_name ) ) { $o_json[ "location_contact_name"] = $this->is_contact_name; }
        if ( !is_null( $this->is_contact_email ) ) { $o_json[ "location_contact_email"] = $this->is_contact_email; }
        if ( !is_null( $this->is_e_fax ) ) { $o_json[ "location_efax"] = $this->is_e_fax; }
        if ( !is_null( $this->is_contact_mobile ) ) { $o_json[ "location_contact_mobile"] = $this->is_contact_mobile; }
        if ( !is_null( $this->is_contact_title ) ) { $o_json[ "location_contact_title"] = $this->is_contact_title; }
        if ( !is_null( $this->ib_contact_same_as_owner ) ) { $o_json[ "location_contact_same_as_owner"] = $this->ib_contact_same_as_owner; }
        if ( !is_null( $this->is_fax ) ) { $o_json[ "location_fax"] = $this->is_fax; }
        if ( !is_null( $this->is_industry ) ) { $o_json[ "location_industry"] = $this->is_industry; }
        if ( !is_null( $this->is_ownership ) ) { $o_json[ "location_ownership"] = $this->is_ownership; }
        if ( !is_null( $this->id_years_in_business ) ) { $o_json[ "location_years_in_business"] = $this->id_years_in_business; }
        if ( !is_null( $this->is_organization_mission ) ) { $o_json[ "location_organization_mission"] = $this->is_organization_mission; }
        if ( !is_null( $this->io_entity_start_date ) ) { 
            $o_json[ "location_entity_start_date"] = date( "m/d/Y H:i:s", strtotime( $this->io_entity_start_date ) ); 
            
        } 
        if ( !is_null( $this->is_entity_state ) ) { $o_json[ "location_entity_state"] = $this->is_entity_state; }
        if ( !is_null( $this->is_alternative_fax ) ) { $o_json[ "location_alternative_fax"] = $this->is_alternative_fax; }
        if ( !is_null( $this->is_year_incorporated ) ) { $o_json[ "location_year_incorporated"] = $this->is_year_incorporated; }
        if ( !is_null( $this->is_description_of_products_and_services ) ) { $o_json[ "location_description_of_products_and_services"] = $this->is_description_of_products_and_services; }
        if ( !is_null( $this->is_length_of_current_ownership ) ) { $o_json[ "location_length_of_current_ownership"] = $this->is_length_of_current_ownership; }
        if ( !is_null( $this->in_quantity_of_locations ) ) { $o_json[ "location_quantity_of_locations"] = $this->in_quantity_of_locations; }
        if ( !is_null( $this->is_waive_pg ) ) { $o_json[ "location_waive_pg"] = $this->is_waive_pg; }
        if ( !is_null( $this->is_partner_biller_id ) ) { $o_json[ "location_partner_biller_id"] = $this->is_partner_biller_id; }
        if ( !is_null( $this->is_partner_reseller_id ) ) { $o_json[ "location_partner_reseller_id"] = $this->is_partner_reseller_id; }
        if ( !is_null( $this->is_partner_sub_account_id ) ) { $o_json[ "location_partner_sub_account_id"] = $this->is_partner_sub_account_id; }
        if ( !is_null( $this->is_program_pricing ) ) { $o_json[ "location_program_pricing"] = $this->is_program_pricing; }
        if ( !is_null( $this->is_program_details ) ) { $o_json[ "location_program_details"] = $this->is_program_details; }

        $o_lead_sources = array();
        for ( $n_index = 0, $n_size = count( $this->io_lead_sources ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_lead_sources, $this->io_lead_sources[$n_index] );
        }
        $o_json[ "location_lead_sources" ] = $o_lead_sources;
        
        if ( !is_null( $this->is_sales_agent_name ) ) { $o_json[ "location_sales_agent_name"] = $this->is_sales_agent_name; }
        if ( !is_null( $this->is_parent_id ) ) { $o_json[ "location_parent_id"] = $this->is_parent_id; }
        if ( !is_null( $this->is_additional_description ) ) { $o_json[ "location_additional_description"] = $this->is_additional_description; }
        if ( !is_null( $this->is_description ) ) { $o_json[ "location_description"] = $this->is_description; }
        if ( !is_null( $this->is_new_visa_utility_acceptor ) ) { $o_json[ "location_new_visa_utility_acceptor"] = $this->is_new_visa_utility_acceptor; }
        if ( !is_null( $this->ib_tax_exempt ) ) { $o_json[ "location_tax_exempt"] = $this->ib_tax_exempt; }
        if ( !is_null( $this->in_total_customers ) ) { $o_json[ "location_total_customers"] = $this->in_total_customers; }
        if ( !is_null( $this->is_utility_ownership ) ) { $o_json[ "location_utility_ownership"] = $this->is_utility_ownership; }

        $o_terminals = array();
        for ( $n_index = 0, $n_size = count( $this->io_terminals ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_terminals, $this->io_terminals[$n_index]->getJSON() );
        }
        $o_json[ "location_terminals"] = $o_terminals;

        $o_contacts = array();
        for ( $n_index = 0, $n_size = count( $this->io_principal_contacts ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_contacts, $this->io_principal_contacts[$n_index]->getJSON() );
        }
        $o_json[ "location_principal_contacts"] = $o_contacts;

        if ( !is_null( $this->io_bank_card_details ) ) { $o_json[ "location_bc_details"] = $this->io_bank_card_details->getJSON(); }
        if ( !is_null( $this->io_ach_details ) ) { $o_json[ "location_ach_details"] = $this->io_ach_details->getJSON(); }
        if ( !is_null( $this->io_moto ) ) { $o_json[ "location_moto"] = $this->io_moto->getJSON(); }
        if ( !is_null( $this->io_internet ) ) { $o_json[ "location_internet"] = $this->io_internet->getJSON(); }
        if ( !is_null( $this->io_pos ) ) { $o_json[ "location_pos"] = $this->io_pos->getJSON(); }
        if ( !is_null( $this->io_dba_address ) ) { $o_json[ "location_dba_address" ] = $this->io_dba_address->getJSON(); }
        if ( !is_null( $this->is_chargeback_fax ) ) { $o_json[ "location_chargeback_fax" ] = $this->is_chargeback_fax; }
        
        return $o_json;
    }
    
    /**
     * builds a location object from JSON object
     * @param type $vo_json JSON representation of the location object
     * @return Location the location object 
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    static function buildFromJSON( $vo_json ) {
        
        $o_location = new Location();
        
        if ( array_key_exists( "location_annual_revenue", $vo_json ) ) { $o_location->setAnnualRevenue( $vo_json[ "location_annual_revenue" ] ); }
        if ( array_key_exists( "location_contact_name", $vo_json ) ) { $o_location->setContactName( $vo_json[ "location_contact_name" ] ); }
        if ( array_key_exists( "location_contact_email", $vo_json ) ) { $o_location->setContactEmail( $vo_json[ "location_contact_email" ] ); }
        if ( array_key_exists( "location_efax", $vo_json ) ) { $o_location->setEFax( $vo_json[ "location_efax" ] ); }
        if ( array_key_exists( "location_contact_mobile", $vo_json ) ) { $o_location->setContactMobile( $vo_json[ "location_contact_mobile" ] ); }
        if ( array_key_exists( "location_contact_title", $vo_json ) ) { $o_location->setContactTitle( $vo_json[ "location_contact_title" ] ); }
        if ( array_key_exists( "location_contact_same_as_owner", $vo_json ) ) { $o_location->setContactSameAsOwner( $vo_json[ "location_contact_same_as_owner" ] ); }
        if ( array_key_exists( "location_fax", $vo_json ) ) { $o_location->setFax( $vo_json[ "location_fax" ] ); }
        if ( array_key_exists( "location_industry", $vo_json ) ) { $o_location->setIndustry( $vo_json[ "location_industry" ] ); }
        if ( array_key_exists( "location_ownership", $vo_json ) ) { $o_location->setOwnership( $vo_json[ "location_ownership" ] ); }
        if ( array_key_exists( "location_years_in_business", $vo_json ) ) { $o_location->setYearsInBusiness( $vo_json[ "location_years_in_business" ] ); }
        if ( array_key_exists( "location_organization_mission", $vo_json ) ) { $o_location->setOrganizationMission($vo_json[ "location_organization_mission" ] ); }
        if ( array_key_exists( "location_entity_start_date", $vo_json ) ) { 
            $o_location->setEntityStartDate( date( "m/d/Y H:i:s", strtotime( $vo_json[ "location_entity_start_date" ] ) ) ); 
            
        }
        if ( array_key_exists( "location_entity_state", $vo_json ) ) { $o_location->setEntityState( $vo_json[ "location_entity_state" ] ); }
        if ( array_key_exists( "location_alternative_fax", $vo_json ) ) { $o_location->setAlternativeFax( $vo_json[ "location_alternative_fax" ] ); }
        if ( array_key_exists( "location_year_incorporated", $vo_json ) ) { $o_location->setYearIncorporated( $vo_json[ "location_year_incorporated" ] ); }
        if ( array_key_exists( "location_description_of_products_and_services", $vo_json ) ) { $o_location->setDescriptionOfProductsAndServices( $vo_json[ "location_description_of_products_and_services" ] ); }
        if ( array_key_exists( "location_length_of_current_ownership", $vo_json ) ) { $o_location->setLengthOfCurrentOwnership( $vo_json[ "location_length_of_current_ownership" ] ); }
        if ( array_key_exists( "location_quantity_of_locations", $vo_json ) ) { $o_location->setQuantityOfLocation( $vo_json[ "location_quantity_of_locations" ] ); }
        if ( array_key_exists( "location_waive_pg", $vo_json ) ) { $o_location->setWaivePg( $vo_json[ "location_waive_pg" ] ); }
        if ( array_key_exists( "location_partner_biller_id", $vo_json ) ) { $o_location->setPartnerBillerId( $vo_json[ "location_partner_biller_id" ] ); }
        if ( array_key_exists( "location_partner_reseller_id", $vo_json ) ) { $o_location->setPartnerResellerId( $vo_json[ "location_partner_reseller_id" ] ); }
        if ( array_key_exists( "location_partner_sub_account_id", $vo_json ) ) { $o_location->setPartnerSubAccountId( $vo_json[ "location_partner_sub_account_id" ] ); }
        if ( array_key_exists( "location_program_pricing", $vo_json ) ) { $o_location->setProgramPricing( $vo_json[ "location_program_pricing" ] ); }
        if ( array_key_exists( "location_program_details", $vo_json ) ) { $o_location->setProgramDetails( $vo_json[ "location_program_details" ] ); }
        if ( array_key_exists( "location_lead_sources", $vo_json ) ) {
            $o_lead_sources = $vo_json[ "location_lead_sources" ];
            for ( $n_index = 0, $n_size = count( $o_lead_sources ); $n_index < $n_size; $n_index++ ) {
                $o_location->addLeadSource( $o_lead_sources[ $n_index ] );
            }
        }
        if ( array_key_exists( "location_sales_agent_name", $vo_json ) ) { $o_location->setSalesAgentName( $vo_json[ "location_sales_agent_name" ] ); }
        if ( array_key_exists( "location_parent_id", $vo_json ) ) { $o_location->setParentId( $vo_json[ "location_parent_id" ] ); }
        if ( array_key_exists( "location_additional_description", $vo_json ) ) { $o_location->setAdditionalDescription( $vo_json[ "location_additional_description" ] ); }
        if ( array_key_exists( "location_description", $vo_json ) ) { $o_location->setDescription( $vo_json[ "location_description" ] ); }
        if ( array_key_exists( "location_new_visa_utility_acceptor", $vo_json ) ) { $o_location->setNewVisaUtilityAcceptor( $vo_json[ "location_new_visa_utility_acceptor" ] ); }
        if ( array_key_exists( "location_tax_exempt", $vo_json ) ) { $o_location->setTaxExempt( $vo_json[ "location_tax_exempt" ] ); }
        if ( array_key_exists( "location_total_customers", $vo_json ) ) { $o_location->setTotalCustomers( $vo_json[ "location_total_customers" ] ); }
        if ( array_key_exists( "location_utility_ownership", $vo_json ) ) { $o_location->setUtilityOwnership( $vo_json[ "location_utility_ownership" ] ); }
        if ( array_key_exists( "location_terminals", $vo_json ) ) {
            $o_terminals = $vo_json[ "location_terminals" ];
            for ( $n_index = 0, $n_size = count( $o_terminals ); $n_index < $n_size; $n_index++ ) {
                $o_location->addTerminal( $o_terminals[ $n_index ] );
            }
        }
        if ( array_key_exists( "location_principal_contacts", $vo_json ) ) {
            $o_contacts = $vo_json[ "location_principal_contacts" ];
            for ( $n_index = 0, $n_size = count( $o_contacts ); $n_index < $n_size; $n_index++ ) {
                
                $o_contact = PrincipalContact::buildFromJSON($o_contacts[ $n_index ]);
                $o_location->addPrincipalContact( $o_contact );
            }
        }
        if ( array_key_exists( "location_bc_details", $vo_json ) && $vo_json["location_bc_details"] != null) { $o_location->setBankCardDetails( BankCardDetails::buildFromJSON( $vo_json[ "location_bc_details" ] ) ); }
        if ( array_key_exists( "location_ach_details", $vo_json ) && $vo_json["location_ach_details"] != null) { $o_location->setAchDetails( ACHDetails::buildFromJSON( $vo_json[ "location_ach_details" ] ) ); }
        if ( array_key_exists( "location_moto", $vo_json ) && $vo_json["location_moto"] != null) { $o_location->setMoto( MOTO::buildFromJSON( $vo_json[ "location_moto" ] ) ); }
        if ( array_key_exists( "location_internet", $vo_json ) && $vo_json["location_internet"] != null) { $o_location->setInternet( Internet::buildFromJSON( $vo_json[ "location_internet" ] ) ); }
        if ( array_key_exists( "location_pos", $vo_json ) && $vo_json["location_pos"] != null) { $o_location->setPos( POS::buildFromJSON( $vo_json[ "location_pos" ] ) ); }
        
        if( array_key_exists( "location_dba_address", $vo_json ) ) {
            $o_dba_address = Address::buildFromJSON( $vo_json[ "location_dba_address" ] );
            $o_location->setDBAAddress( $o_dba_address );
        }
        if ( array_key_exists( "location_chargeback_fax", $vo_json ) ) { $o_location->setChargebackFax( $vo_json["location_chargeback_fax"] ); }
        
        return $o_location;
    }
}

?>