<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BankAccount
 *
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Steven Wright <steven.wright@basecommerce.com>
 */
class BankAccount {
    
    static $XS_BA_TYPE_CHECKING = "CHECKING";
    static $XS_BA_TYPE_SAVINGS = "SAVINGS";
    
    static $XS_BA_ENTITY_INDIVIDUAL = "INDIVIDUAL";
    static $XS_BA_ENTITY_ORGANIZATION = "ORGANIZATION";
       
    static $XS_BA_STATUS_ACTIVE = "ACTIVE";
    static $XS_BA_STATUS_DELETED = "DELETED";
    static $XS_BA_STATUS_FAILED = "FAILED";
    
    private $is_name;
    private $is_alias;
    private $is_account_number;
    private $is_routing_number;
    private $is_token;
    private $is_status;
    private $is_account_type;
    private $io_address;
    
    private $io_messages;
    
    /**
     * 
     * Default Constructor.
     */
    function __construct() {
        $this->io_messages = array();
    }        
    
    public function setName( $vs_name ) {
        $this->is_name = $vs_name;
    }
    
    public function getName() {
        return $this->is_name;
    }
    
    public function setAlias( $vs_alias ) {
        $this->is_alias = $vs_alias;
    }
    
    public function getAlias() {
        return $this->is_alias;
    }
    
    public function setAccountNumber( $vs_account_number ) {
        $this->is_account_number = $vs_account_number;
    }
    
    public function getAccountNumber() {
        return $this->is_account_number;
    }
    
    public function setRoutingNumber( $vs_routing_number ) {
        $this->is_routing_number = $vs_routing_number;
    }
    
    public function getRoutingNumber() {
        return $this->is_routing_number;
    }

    public function setToken( $vs_token ) {
        $this->is_token = $vs_token;
    }

    public function getToken() {
        return $this->is_token;
    }
    
    public function setStatus( $vs_status ) {
        $this->is_status = $vs_status;
    }

    public function getStatus() {
        return $this->is_status;
    } 
    
    public function isStatus( $vs_status ) {
        return $this->is_status == $vs_status;
    }
    
    public function setAccountType( $vs_account_type ) {
        $this->is_account_type = $vs_account_type;
    }
    public function getAccountType() {
        return $this->is_account_type;
    }
    public function isAccountType( $vs_account_type ) {        
        return $this->is_account_type.equals(vs_account_type);        
    }
    
    /**
     * Sets the billing address on this BankAccount 
     * @param $vo_address - The address to be set
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    public function setBillingAddress( $vo_address ) {
        $this->io_address = $vo_address;
    }
    
    /**
     * Gets the billing address from this BankAccount
     * @return  -  This BankAccount's billing address
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    public function getBillingAddress(){
        return $this->io_address;
    }
    
    public function getMessages() {
        return $this->io_messages;
    }
    
    public function addMessage( $vs_message ) {
        array_push( $this->io_messages, $vs_message );
    }
    
    /**
     * Builds a BankAccount PHP object from the passed in json object.
     * 
     * @param  $vo_json - The json representation of the object to be built.
     * @return A BankAccount object with fields based on the input json object.
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    static function buildFromJSON( $vo_json ) {
        
        $o_bank_account = new BankAccount();
                
        if ( array_key_exists( "bank_account_name", $vo_json ) ) { $o_bank_account->setName( $vo_json[ "bank_account_name" ] ); }
        if ( array_key_exists( "bank_account_alias", $vo_json ) ) { $o_bank_account->setAlias( $vo_json[ "bank_account_alias" ] ); }
        if ( array_key_exists( "bank_account_account_number", $vo_json ) ) { $o_bank_account->setAccountNumber( $vo_json[ "bank_account_account_number" ] ); }
        if ( array_key_exists( "bank_account_routing_number", $vo_json ) ) { $o_bank_account->setRoutingNumber( $vo_json[ "bank_account_routing_number" ] ); }
        if ( array_key_exists( "bank_account_token", $vo_json ) ) { $o_bank_account->setToken( $vo_json[ "bank_account_token" ] ); }
        
        if ( array_key_exists( "bank_account_billing_address", $vo_json ) ){ $o_bank_account->setBillingAddress(Address::buildFromJSON( $vo_json["bank_account_billing_address"] ) ); }
        
        if ( array_key_exists( 'bank_account_status', $vo_json ) ) {
            
            if( gettype( $vo_json[ 'bank_account_status' ] ) === "array " ){
                
                $o_status = (array) $vo_json[ 'bank_account_status' ];
            
                if (array_key_exists( 'bank_account_status_name', $o_status ) ) {

                    $o_bank_account->setStatus( $o_status[ 'bank_account_status_name' ] );
                }
                
            } else{
                
                $o_bank_account->setStatus( $vo_json[ 'bank_account_status' ] );
            }
        
        }
        
        if ( array_key_exists( 'bank_account_type', $vo_json ) ) {
            
            if( gettype( $vo_json[ 'bank_account_type' ] ) === "array" ){
                
                $o_type = (array) $vo_json[ 'bank_account_type' ];
            
                if (array_key_exists( 'bank_account_type_name', $o_type ) ) {
                
                    $o_bank_account->setAccountType( $o_type[ 'bank_account_type_name' ] );
                }

            }
            else {
                
                $o_bank_account->setAccountType( $vo_json[ 'bank_account_type' ] );
            }
        }
        
        return $o_bank_account;   
        
    }
        
    /**
     * Returns the JSON representation of the bank card transaction.
     * 
     * @return associated array : the json representation
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->is_name ) ) {
            $o_json[ "bank_account_name"  ] = $this->is_name; 
        }
        if ( !is_null( $this->is_alias ) ) {
            $o_json[ "bank_account_alias"  ] = $this->is_alias; 
        }
        if ( !is_null( $this->is_account_number ) ) {
            $o_json[ "bank_account_account_number"  ] = $this->is_account_number; 
        }
        if ( !is_null( $this->is_routing_number ) ) {
            $o_json[ "bank_account_routing_number"  ] = $this->is_routing_number;
        }
        if ( !is_null( $this->is_token ) ) {
            $o_json[ "bank_account_token"  ] = $this->is_token;
        }
        if( !is_null($this->is_status ) ) {
            $o_json[ "bank_account_status" ] = $this->getStatus();
        }
        if( !is_null($this->is_account_type ) ) {
            $o_json[ "bank_account_type" ] = $this->getAccountType();
        }
        if( !is_null($this->io_address ) ){
            $o_json[ "bank_account_billing_address" ] = $this->getBillingAddress()->getJSON();
        }           
        if( !is_null( $this->io_messages ) ){
            
            $o_json["messages"] =  $this->io_messages;         
        }
                 
        return json_encode($o_json);
        
    }
    
}

?>