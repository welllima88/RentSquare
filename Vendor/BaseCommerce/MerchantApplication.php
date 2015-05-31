<?php
include_once 'Account.php';
include_once 'Location.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MerchantApplication
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class MerchantApplication {
    
    private $io_account;
    private $io_locations;
    private $io_response_messages;
    private $in_response_code;
    private $is_api_version;
    private $is_key;
    private $in_id;
    private $is_code;
    private $is_salesforce_id;

    function __construct() {
        $this->io_locations = array();
        $this->io_response_messages = array();
    }
    
    public function getAccount() {
        return $this->io_account;
    }

    public function setAccount( $vo_account ) {
        $this->io_account = $vo_account;
    }

    public function getLocations() {
        return $this->io_locations;
    }

    public function addLocation( $vo_location ) {
        array_push( $this->io_locations, $vo_location );
    }
    
    public function getResponseMessages() {
        return $this->io_response_messages;
    }
    
    public function addResponseMessage( $vs_field, $vs_response_message ) {
        $this->io_response_messages[$vs_field] = $vs_response_message;
    }

    public function getResponseCode() {
        return $this->in_response_code;
    }
    
    public function setResponseCode( $vn_response_code ) {
        $this->in_response_code = $vn_response_code;
    }
    
    public function getApiVersion() {
        return $this->is_api_version;
    }

    public function setApiVersion( $vs_api_version ) {
        $this->is_api_version = $vs_api_version;
    }
    
    public function getKey() {
        return $this->is_key;
    }
    
    public function setKey( $vs_key ) {
        $this->is_key = $vs_key;
    }

    public function getId() {
        return $this->in_id;
    }
    
    public function setId( $vn_id ) {
        $this->in_id = $vn_id;
    }

    public function getCode() {
        return $this->is_code;
    }
    
    public function setCode( $vs_code ) {
        $this->is_code = $vs_code;
    }
    
    public function setSalesforceID( $vs_salesforce_id) {
        $this->is_salesforce_id = $vs_salesforce_id;
    }

    public function getSalesforceID() {
        return $this->is_salesforce_id;
    }
    
    public function getJSON() {
        
        $o_json = array();

        if ( !is_null( $this->is_salesforce_id ) ) { $o_json[ "merchant_application_salesforce_id" ] = $this->is_salesforce_id; }
        
        if ( !is_null( $this->io_account ) ) { $o_json[ "merchant_application_account" ] = $this->io_account->getJSON(); }

        $o_locations = array();
        for ( $n_index = 0, $n_size = count( $this->io_locations ); $n_index < $n_size; $n_index++ ) {
            $o_location = $this->io_locations[$n_index];
            array_push( $o_locations, $o_location->getJSON() );
        }
        $o_json[ "merchant_application_locations"] = $o_locations;
        
        if (count( $this->io_response_messages) > 0) {
            $o_json[ "merchant_application_response_messages"] = $this->io_response_messages;
        }
        
        if ( !is_null( $this->in_response_code ) ) { $o_json[ "merchant_application_response_code" ] = $this->in_response_code; }
        
        if ( !is_null( $this->is_api_version ) ) { $o_json[ "merchant_application_api_version" ] = $this->is_api_version; }
        if ( !is_null( $this->is_key ) ) { $o_json[ "merchant_application_key" ] = $this->is_key; }
        if ( !is_null( $this->in_id ) ) { $o_json[ "merchant_application_id" ] = $this->in_id; }
        if ( !is_null( $this->is_code ) ) { $o_json[ "merchant_application_code" ] = $this->is_code; }
        
        return json_encode( $o_json );
    }
    
    public static function buildFromJSON( $vo_json ) {
        
        $o_merch_app = new MerchantApplication();
        
        if ( array_key_exists( "merchant_application_salesforce_id", $vo_json ) ) { $o_merch_app->setSalesforceID( $vo_json[ "merchant_application_salesforce_id" ] ); }
        
        if ( array_key_exists( "merchant_application_account", $vo_json ) ) {
//        if ( array_key_exists( "merchant_application_account", $vo_json ) ) { 
//        if
//            var_dump( $vo_json[ "merchant_application_account" ] );
            $o_merch_app->setAccount( Account::buildFromJSON( $vo_json[ "merchant_application_account" ] ) );
        } else {
            //var_dump( "welp, this sucks" );
            //var_dump( $vo_json["merchant_application_accounts"] );
        }
        if ( array_key_exists( "merchant_application_locations", $vo_json ) ) {
            $o_locations = $vo_json[ "merchant_application_locations" ];
            for ( $n_index = 0, $n_size = count( $o_locations ); $n_index < $n_size; $n_index++ ) {
                //var_dump( $o_locations[ $n_index ] );
                $o_location = Location::buildFromJSON( $o_locations[ $n_index ] );
                $o_merch_app->addLocation( $o_location );
            }
        }
        
        if ( array_key_exists( "merchant_application_response_messages", $vo_json ) ) {
            foreach($vo_json[ "merchant_application_response_messages" ] as $key => $val) {
                $o_merch_app->addResponseMessage($key, $val);
            
            }
//            $o_response_messages = $vo_json[ "merchant_application_response_messages" ];
//            for ( $n_index = 0, $n_size = count( $o_response_messages ); $n_index < $n_size; $n_index++ ) {
//                $o_merch_app->addResponseMessage( $o_response_messages[ $n_index ] );
//            }
        }
        
        if ( array_key_exists( "merchant_application_response_code", $vo_json ) ) { $o_merch_app->setResponseCode( $vo_json[ "merchant_application_response_code" ] ); }
        if ( array_key_exists( "merchant_application_api_version", $vo_json ) )  { $o_merch_app->setApiVersion( $vo_json[ "merchant_application_api_version" ] ); }
        if ( array_key_exists( "merchant_application_key", $vo_json ) ) { $o_merch_app->setKey( $vo_json[ "merchant_application_key" ] ); }
        if ( array_key_exists( "merchant_application_id", $vo_json ) ) { $o_merch_app->setId( $vo_json[ "merchant_application_id" ] ); }
        if ( array_key_exists( "merchant_application_code", $vo_json ) ) { $o_merch_app->setCode( $vo_json[ "merchant_application_code" ] ); }
        
        return $o_merch_app;
    }
    
}

?>