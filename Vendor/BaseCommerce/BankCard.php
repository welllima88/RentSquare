<?php

include_once 'Address.php';
/**
 * Description of BankCard
 *
 * © Base Commerce
 * @author Ryan Murphy <ryan.murphy@basecommerce.com>
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 * @author Steven Wright <steven.wright@basecommerce.com>
 */
class BankCard {
    
    static $XS_BC_STATUS_ACTIVE = "ACTIVE";
    static $XS_BC_STATUS_DELETED = "DELETED";
    static $XS_BC_STATUS_FAILED = "FAILED";
    
    private $is_name;
    private $is_number;
    private $is_alias;

    private $is_expiration_month;
    private $is_expiration_year;
    private $is_status;
    
    private $io_billing_address;

    private $is_token;
    
    private $io_creation_date;
    private $io_last_used_date;
    
    private $io_messages;
    /**
     * 
     * Default Constructor.
     */
    function __construct() {
        $this->io_billing_address = new Address();
        $this->io_messages = array();
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
    
    public function getToken() {
        return $this->is_token;
    }

    public function setToken( $vs_token ) {
        $this->is_token = $vs_token;
    }
    
    public function getName() {
        return $this->is_name;
    }

    public function setName( $vs_name ) {
        $this->is_name = $vs_name;
    }
    
    public function getNumber() {
        return $this->is_number;
    }

    public function setNumber( $vs_number ) {
        $this->is_number = $vs_number;
    }
    
    public function getExpirationMonth() {
        return $this->is_expiration_month;
    }

    public function setExpirationMonth( $vs_expiration_month ) {
        $this->is_expiration_month = $vs_expiration_month;
    }
    
    public function getExpirationYear() {
        return $this->is_expiration_year;
    }

    public function setExpirationYear( $vs_expiration_year ) {
        $this->is_expiration_year = $vs_expiration_year;
    }
    
    public function getBillingAddress() {
        return $this->io_billing_address;
    }

    public function setBillingAddress(Address $vo_billing_address) {
        $this->io_billing_address = $vo_billing_address;
    }
    
    public function getCreationDate() {
        return $this->io_creation_date;
    }

    /**
     * sets the creation date
     * @param type $vo_creation_date the creation date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setCreationDate( $vo_creation_date ) {
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( strpos($vo_creation_date, '/') !== FALSE ) {
            $this->io_creation_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_creation_date )->format('m/d/Y H:i:s');
        } else {
            $this->io_creation_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_creation_date )->format('m/d/Y H:i:s');
        }
    }
    
    public function getLastUsedDate() {
        return $this->io_last_used_date;
    }

    /**
     * sets the last used date
     * @param type $vo_last_used_date the last used date
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function setLastUsedDate( $vo_last_used_date) {
        //if the string passed in is in format m/d/Y H:i:s else assuming its in format m-d-Y H:i:s
        if( strpos($vo_last_used_date, '/') !== FALSE ) {
            $this->io_last_used_date = DateTime::createFromFormat('m/d/Y H:i:s', $vo_last_used_date )->format('m/d/Y H:i:s');
        } else {
            $this->io_last_used_date = DateTime::createFromFormat('m-d-Y H:i:s', $vo_last_used_date )->format('m/d/Y H:i:s');
        }
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
    
    public function getAlias() {
        return $this->is_alias;
    }

    public function setAlias( $vs_alias ) {
        $this->is_alias = $vs_alias;
    }
    
    public function getMessages() {
        return $this->io_messages;
    }
    
    public function addMessage( $vs_message ) {
        array_push( $this->io_messages, $vs_message );
    }
    
    /**
     * Creates a BankCard PHP object from the passed in JSON Object
     * 
     * @param type $o_data  The json representation of the object to be built.
     * @return A BankCard object with fields based on the input json object.
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    static function buildFromJSON( $o_data ) {
        
        $o_instance = new BankCard();
        
        if (array_key_exists( 'bank_card_name', $o_data) ) { $o_instance->setName( $o_data['bank_card_name'] ); }
        if (array_key_exists( 'bank_card_number', $o_data) ) { $o_instance->setNumber( $o_data['bank_card_number'] ); }
        if (array_key_exists( 'bank_card_token', $o_data) ) { $o_instance->setToken( $o_data['bank_card_token'] ); }
        if (array_key_exists( 'bank_card_expiration_month', $o_data) ) { $o_instance->setExpirationMonth( $o_data['bank_card_expiration_month'] ); }
        if (array_key_exists( 'bank_card_expiration_year', $o_data) ) { $o_instance->setExpirationYear( $o_data['bank_card_expiration_year'] ); }
        if (array_key_exists( 'bank_card_billing_address', $o_data) ) { $o_instance->setBillingAddress( Address::buildFromJSON( $o_data['bank_card_billing_address'] ) ); }
        if (array_key_exists( 'bank_card_creation_date', $o_data) ) { $o_instance->setCreationDate( date("m/d/Y H:i:s", strtotime( $o_data[ "bank_card_creation_date" ] ) ) ); }
        if (array_key_exists( 'bank_card_last_used_date', $o_data) ) { $o_instance->setLastUsedDate( date("m/d/Y H:i:s", strtotime( $o_data[ "bank_card_last_used_date" ] ) ) ); }
        
        if (array_key_exists( 'bank_card_status', $o_data ) ) {
            
            if( gettype( $o_data[ 'bank_card_status' ] ) === "array" ){
                
                $o_status = (array) $o_data[ 'bank_card_status' ];
                
                if ( array_key_exists( 'bank_card_status_name', $o_status ) ) {
                    
                    $o_instance->setStatus( $o_status[ 'bank_card_status_name' ] );
                }
                
            } else {
                
                $o_instance->setStatus( $o_data[ 'bank_card_status' ] );
            }
        }
        
        if (array_key_exists( 'bank_card_alias', $o_data) ) { $o_instance->setAlias( $o_data['bank_card_alias'] ); }
        
        return $o_instance;
    }
    
    /**
     * 
     * Returns the JSON representation of the bank card.
     * 
     * @return associated array : the json representation
     * @author Ryan Murphy <ryan.murphy@basecommerce.com>
     * @author Steven Wright <steven.wright@basecommerce.com>
     */
    function getJSON() {
        $o_array = array();
        if( !is_null($this->is_name ) ) {
            $o_array['bank_card_name'] = $this->is_name;
        }
        if( !is_null($this->is_number ) ) {
            $o_array['bank_card_number'] = $this->is_number;
        }
        if( !is_null($this->is_token ) ) {
          $o_array['bank_card_token'] = $this->is_token;
        }
        if( !is_null($this->is_expiration_month ) ) {
            $o_array['bank_card_expiration_month'] = $this->is_expiration_month;
        }
        if( !is_null($this->is_expiration_year ) ) {
            $o_array['bank_card_expiration_year'] = $this->is_expiration_year;
        }
        if( !is_null($this->io_creation_date ) ) {
            $o_array['bank_card_creation_date'] = $this->io_creation_date;
        }
        if( !is_null($this->io_last_used_date ) ) {
            $o_array['bank_card_last_used_date'] = $this->io_last_used_date;
        }
        if( !is_null($this->io_billing_address) ) {
            $o_array['bank_card_billing_address'] = $this->getBillingAddress()->getJSON();
        }
        if( !is_null($this->is_alias ) ) {
            $o_array['bank_card_alias'] = $this->is_alias;
        }
        if( !is_null($this->is_status ) ) {
            $o_array['bank_card_status'] = $this->is_status;
        }
        
        if( !is_null( $this->io_messages ) ){
            
            $o_array['messages'] =  $this->io_messages;         
        }
           

        return json_encode( $o_array );
    }
    
}

?>
