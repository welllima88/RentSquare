<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of POS
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class POS {
    
    static $XS_TYPE_GATEWAY = "Gateway";
    static $XS_TYPE_ENCRYPTION = "Encryption";
    static $XS_TYPE_SOFTWARE = "Software";
    
    private $is_vendor_name;
    private $is_make;
    private $is_model;
    private $is_vendor_contact_name;
    private $is_version;
    private $is_type;
    private $is_vendor_phone_number;

    public function getVendorName() {
        return $this->is_vendor_name;
    }

    public function setVendorName( $vs_vendor_name) {
        $this->is_vendor_name = $vs_vendor_name;
    }

    public function getMake() {
        return $this->is_make;
    }

    public function setMake( $vs_make) {
        $this->is_make = $vs_make;
    }

    public function getModel() {
        return $this->is_model;
    }

    public function setModel( $vs_model) {
        $this->is_model = $vs_model;
    }

    public function getVendorContactName() {
        return $this->is_vendor_contact_name;
    }

    public function setVendorContactName( $vs_vendor_contact_name) {
        $this->is_vendor_contact_name = $vs_vendor_contact_name;
    }

    public function getVersion() {
        return $this->is_version;
    }

    public function setVersion( $vs_version) {
        $this->is_version = $vs_version;
    }

    public function getType() {
        return $this->is_type;
    }

    public function setType( $vs_type) {
        $this->is_type = $vs_type;
    }

    public function getVendorPhoneNumber() {
        return $this->is_vendor_phone_number;
    }

    public function setVendorPhoneNumber( $vs_vendor_phone_number) {
        $this->is_vendor_phone_number = $vs_vendor_phone_number;
    }

    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->is_vendor_name ) ) { $o_json[ "pos_vendor_name" ] = $this->is_vendor_name; }
        if ( !is_null( $this->is_make ) ) { $o_json[ "pos_make" ] = $this->is_make; }
        if ( !is_null( $this->is_model ) ) { $o_json[ "pos_model" ] = $this->is_model; }
        if ( !is_null( $this->is_vendor_contact_name ) ) { $o_json[ "pos_vendor_contact_name" ] = $this->is_vendor_contact_name; }
        if ( !is_null( $this->is_version ) ) { $o_json[ "pos_version" ] = $this->is_version; }
        if ( !is_null( $this->is_type ) ) { $o_json[ "pos_type" ] = $this->is_type; }
        if ( !is_null( $this->is_vendor_phone_number ) ) { $o_json[ "pos_vendor_phone_number" ] = $this->is_vendor_phone_number; }
        
        return $o_json;
    }
    
    public static function buildFromJSON( $vo_json ) {
        
        $o_pos = new POS();
        
        if ( array_key_exists( "pos_vendor_name", $vo_json ) ) { $o_pos->setVendorName( $vo_json[ "pos_vendor_name" ] ); }
        if ( array_key_exists( "pos_make", $vo_json ) ) { $o_pos->setMake( $vo_json[ "pos_make" ] ); }
        if ( array_key_exists( "pos_model", $vo_json ) ) { $o_pos->setModel( $vo_json[ "pos_model" ] ); }
        if ( array_key_exists( "pos_vendor_contact_name", $vo_json ) ) { $o_pos->setVendorContactName( $vo_json[ "pos_vendor_contact_name" ] ); }
        if ( array_key_exists( "pos_version", $vo_json ) ) { $o_pos->setVersion( $vo_json[ "pos_version" ] ); }
        if ( array_key_exists( "pos_type", $vo_json ) ) { $o_pos->setType( $vo_json[ "pos_type" ] ); }
        if ( array_key_exists( "pos_vendor_phone_number", $vo_json ) ) { $o_pos->setVendorPhoneNumber( $vo_json[ "pos_vendor_phone_number" ] ); }
        
        return $o_pos;
    }
    
}

?>