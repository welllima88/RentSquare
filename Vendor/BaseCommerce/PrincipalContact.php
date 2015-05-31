<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrincipalContact
 *
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 */
class PrincipalContact {
    
    static $XS_CONTACT_TYPE_OWNER = "Owner";
    static $XS_CONTACT_TYPE_Officer = "Officer";
    
    private $is_contact_id;
    private $is_account_id;
    private $is_last_name;
    private $is_first_name;
    private $io_mailing_address;
    private $is_phone_number;
    private $is_fax;
    private $is_mobile_phone_number;
    private $is_email;
    private $is_title;
    private $io_birthdate;
    private $ib_authorized_user;
    private $ib_account_signer;
    private $id_ownership_percentage;
    private $is_contact_type;
    private $is_driver_license;
    private $is_license_state;
    private $is_ssn;
    private $ib_is_primary;

    public function __construct() {
        date_default_timezone_set( "UTC" );
    }
    
    public function getContactId() {
        return $this->is_contact_id;
    }

    public function setContactId( $vs_contact_id) {
        $this->is_contact_id = $vs_contact_id;
    }

    public function getAccountId() {
        return $this->is_account_id;
    }

    public function setAccountId( $vs_account_id) {
        $this->is_account_id = $vs_account_id;
    }

    public function getLastName() {
        return $this->is_last_name;
    }

    public function setLastName( $vs_last_name) {
        $this->is_last_name = $vs_last_name;
    }

    public function getFirstName() {
        return $this->is_first_name;
    }

    public function setFirstName( $vs_first_name) {
        $this->is_first_name = $vs_first_name;
    }

    public function getMailingAddress() {
        return $this->io_mailing_address;
    }

    public function setMailingAddress( Address $vo_mailing_address ) {
        $this->io_mailing_address = $vo_mailing_address;
    }

    public function getPhoneNumber() {
        return $this->is_phone_number;
    }

    public function setPhoneNumber( $vs_phone_number) {
        $this->is_phone_number = $vs_phone_number;
    }

    public function getFax() {
        return $this->is_fax;
    }

    public function setFax( $vs_fax) {
        $this->is_fax = $vs_fax;
    }

    public function getMobilePhoneNumber() {
        return $this->is_mobile_phone_number;
    }

    public function setMobilePhoneNumber( $vs_mobile_phone_number) {
        $this->is_mobile_phone_number = $vs_mobile_phone_number;
    }

    public function getEmail() {
        return $this->is_email;
    }

    public function setEmail( $vs_email) {
        $this->is_email = $vs_email;
    }

    public function getTitle() {
        return $this->is_title;
    }

    public function setTitle( $vs_title) {
        $this->is_title = $vs_title;
    }

    public function getBirthdate() {
        return $this->io_birthdate;
    }

    /**
     * sets the birth day
     * @param type $vo_birthdate the birthdate
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setBirthdate( $vo_birthdate) {
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( strpos($vo_birthdate, '/') !== FALSE ) {
            $this->io_birthdate = DateTime::createFromFormat('m/d/Y H:i:s', $vo_birthdate )->format('m/d/Y H:i:s');
        } else {
            $this->io_birthdate = DateTime::createFromFormat('m-d-Y H:i:s', $vo_birthdate )->format('m/d/Y H:i:s');
        }
    }

    public function isAuthorizedUser() {
        return $this->ib_authorized_user;
    }

    public function setAuthorizedUser( $vb_authorized_user) {
        $this->ib_authorized_user = $vb_authorized_user;
    }

    public function isAccountSigner() {
        return $this->ib_account_signer;
    }

    public function setAccountSigner( $vb_account_signer) {
        $this->ib_account_signer = $vb_account_signer;
    }

    public function getOwnershipPercentage() {
        return $this->id_ownership_percentage;
    }

    public function setOwnershipPercentage( $vd_ownership_percentage) {
        $this->id_ownership_percentage = $vd_ownership_percentage;
    }

    public function getContactType() {
        return $this->is_contact_type;
    }

    public function setContactType( $vs_contact_type) {
        $this->is_contact_type = $vs_contact_type;
    }

    public function getDriverLicenseId() {
        return $this->is_driver_license;
    }

    public function setDriverLicenseId( $vs_driver_license) {
        $this->is_driver_license = $vs_driver_license;
    }

    public function getLicenseState() {
        return $this->is_license_state;
    }

    public function setLicenseState( $vs_license_state) {
        $this->is_license_state = $vs_license_state;
    }

    public function getSSN() {
        return $this->is_ssn;
    }

    public function setSSN( $vs_ssn) {
        $this->is_ssn = $vs_ssn;
    }
    
    public function isPrimary() {
        return $this->ib_is_primary;
    }
    
    public function setIsPrimary(  $vb_is_primary ) {
        $this->ib_is_primary = $vb_is_primary;
    }
    
    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->is_contact_id ) ) { $o_json[ "principal_contact_id" ] = $this->is_contact_id; }
        if ( !is_null( $this->is_account_id ) ) { $o_json[ "principal_contact_account_id" ] = $this->is_account_id; }
        if ( !is_null( $this->is_last_name ) ) { $o_json[ "principal_contact_last_name" ] = $this->is_last_name; }
        if ( !is_null( $this->is_first_name ) ) { $o_json[ "principal_contact_first_name" ] = $this->is_first_name; }
        if ( !is_null( $this->io_mailing_address ) ) { $o_json[ "principal_contact_mailing_address" ] = $this->io_mailing_address->getJSON(); }
        if ( !is_null( $this->is_phone_number ) ) { $o_json[ "principal_contact_phone_number" ] = $this->is_phone_number; }
        if ( !is_null( $this->is_fax ) ) { $o_json[ "principal_contact_fax" ] = $this->is_fax; }
        if ( !is_null( $this->is_mobile_phone_number ) ) { $o_json[ "principal_contact_mobile_phone_number" ] = $this->is_mobile_phone_number; }
        if ( !is_null( $this->is_email ) ) { $o_json[ "principal_contact_email" ] = $this->is_email; }
        if ( !is_null( $this->is_title ) ) { $o_json[ "principal_contact_title" ] = $this->is_title; }
        if ( !is_null( $this->io_birthdate ) ) { 
            $o_json[ "principal_contact_birthdate" ] = date( "m/d/Y H:i:s", strtotime( $this->io_birthdate ) ); 
            
        }
        if ( !is_null( $this->ib_authorized_user ) ) { $o_json[ "principal_contact_authorized_user" ] = $this->ib_authorized_user; }
        if ( !is_null( $this->ib_account_signer ) ) { $o_json[ "principal_contact_account_signer" ] = $this->ib_account_signer; }
        if ( !is_null( $this->id_ownership_percentage ) ) { $o_json[ "principal_contact_ownership_percentage" ] = $this->id_ownership_percentage; }
        if ( !is_null( $this->is_contact_type ) ) { $o_json[ "principal_contact_contact_type" ] = $this->is_contact_type; }
        if ( !is_null( $this->is_driver_license ) ) { $o_json[ "principal_contact_driver_license" ] = $this->is_driver_license; }
        if ( !is_null( $this->is_license_state ) ) { $o_json[ "principal_contact_license_state" ] = $this->is_license_state; }
        if ( !is_null( $this->is_ssn ) ) { $o_json[ "principal_contact_ssn" ] = $this->is_ssn; }
        if ( !is_null( $this->ib_is_primary ) ) { $o_json[ "principal_contact_is_primary" ] = $this->ib_is_primary; }
        
        return $o_json;
    }
    
    public static function buildFromJSON( $vo_json ) {
        
        $o_principal_contact = new PrincipalContact();
        
        if ( array_key_exists( "principal_contact_id", $vo_json ) ) { $o_principal_contact->setContactId( $vo_json[ "principal_contact_id" ] ); }
        if ( array_key_exists( "principal_contact_account_id", $vo_json ) ) { $o_principal_contact->setAccountId( $vo_json[ "principal_contact_account_id" ] ); }
        if ( array_key_exists( "principal_contact_last_name", $vo_json ) ) { $o_principal_contact->setLastName( $vo_json[ "principal_contact_last_name" ] ); }
        if ( array_key_exists( "principal_contact_first_name", $vo_json ) ) { $o_principal_contact->setFirstName( $vo_json[ "principal_contact_first_name" ] ); }
        if( array_key_exists( "principal_contact_mailing_address", $vo_json ) ) {
            $o_principal_contact->setMailingAddress( Address::buildFromJSON( $vo_json[ "principal_contact_mailing_address" ] ) );
        }
        if ( array_key_exists( "principal_contact_phone_number", $vo_json ) ) { $o_principal_contact->setPhoneNumber( $vo_json[ "principal_contact_phone_number" ] ); }
        if ( array_key_exists( "principal_contact_fax", $vo_json ) ) { $o_principal_contact->setFax( $vo_json[ "principal_contact_fax" ] ); }
        if ( array_key_exists( "principal_contact_mobile_phone_number", $vo_json ) ) { $o_principal_contact->setMobilePhoneNumber( $vo_json[ "principal_contact_mobile_phone_number" ] ); }
        if ( array_key_exists( "principal_contact_email", $vo_json ) ) { $o_principal_contact->setEmail( $vo_json[ "principal_contact_email" ] ); }
        if ( array_key_exists( "principal_contact_title", $vo_json ) ) { $o_principal_contact->setTitle( $vo_json[ "principal_contact_title" ] ); }
        if ( array_key_exists( "principal_contact_birthdate", $vo_json ) ) { $o_principal_contact->setBirthdate( date( "m/d/Y H:i:s", strtotime( $vo_json[ "principal_contact_birthdate" ] ) ) ); }
        if ( array_key_exists( "principal_contact_authorized_user", $vo_json ) ) { $o_principal_contact->setAuthorizedUser( $vo_json[ "principal_contact_authorized_user" ] ); }
        if ( array_key_exists( "principal_contact_account_signer", $vo_json ) ) { $o_principal_contact->setAccountSigner( $vo_json[ "principal_contact_account_signer" ] ); }
        if ( array_key_exists( "principal_contact_ownership_percentage", $vo_json ) ) { $o_principal_contact->setOwnershipPercentage( $vo_json[ "principal_contact_ownership_percentage" ] ); }
        if ( array_key_exists( "principal_contact_contact_type", $vo_json ) ) { $o_principal_contact->setContactType( $vo_json[ "principal_contact_contact_type" ] ); }
        if ( array_key_exists( "principal_contact_driver_license", $vo_json ) ) { $o_principal_contact->setDriverLicenseId( $vo_json[ "principal_contact_driver_license" ] ); }
        if ( array_key_exists( "principal_contact_license_state", $vo_json ) ) { $o_principal_contact->setLicenseState( $vo_json[ "principal_contact_license_state" ] ); }
        if ( array_key_exists( "principal_contact_ssn", $vo_json ) ) { $o_principal_contact->setSSN( $vo_json[ "principal_contact_ssn" ] ); }
        if ( array_key_exists( "principal_contact_is_primary", $vo_json ) ) { $o_principal_contact->setIsPrimary( $vo_json[ "principal_contact_is_primary" ] ); }
        
        return $o_principal_contact;
    }
    
}

?>