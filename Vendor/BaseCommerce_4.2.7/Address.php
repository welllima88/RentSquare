<?php

/**
 * Description of Address
 * Address is a simple re-usable entity class that defines attributes of a postal Address.
 *
 * © Base Commerce
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class Address {
    //put your code here
    /**
     * Represents a home address.
     */
    static $XS_ADDRESS_NAME_HOME = 'HOME';
    
    /**
     * Represents a work address.
     */
    static $XS_ADDRESS_NAME_WORK = 'WORK';
    
    /**
     * Represents a mailing address.
     */
    static $XS_ADDRESS_NAME_MAILING = 'MAILING';
    
    /**
     * Represents a shipping address.
     */
    static $XS_ADDRESS_NAME_SHIPPING = 'SHIPPING';
    
    /**
     * Represents a billing address.
     */
    static $XS_ADDRESS_NAME_BILLING = 'BILLING';
    
    /**
     * Represents a dba address.
     */
    static $XS_ADDRESS_NAME_DBA = 'DBA';
    
    /**
     * Represents a legal address.
     */
    static $XS_ADDRESS_NAME_LEGAL = 'LEGAL';
    
    private $is_name;
    private $is_line1;
    private $is_line2;
    private $is_city;
    private $is_state;
    private $is_zipcode;
    private $is_country;
    
     /**
     * 
     * Constructor for Address.
     */
    function __construct() {
    }
    
    /**
     * 
     * Returns the name of the Address. Default is an empty String.
     * 
     * @return the name of the Address
     */
    public function getName() {
        return $this->is_name;
    }

    /**
     * 
     * Sets the name. Use one of the static Strings from this class to populate this field.
     * 
     * @param vs_name   The type of Address this object refers to.
     */
    public function setName($vs_name) {
        $this->is_name = $vs_name;
    }
    
    /** 
     * 
     * Returns the first line of the street address. Default is an empty String.
     * 
     * @return  the first line of the street address
     */
    public function getLine1() {
        return $this->is_line1;
    }
    
    /**
     * 
     * Sets the first line of the street address.
     * 
     * @param vs_line1  First line of the street address
     */
    public function setLine1( $vs_line1 ) {
        $this->is_line1 = $vs_line1;
    }
    
    /**
     * 
     * Returns the second line of the street address. Default is an empty String.
     * 
     * @return  the second line of the street address
     */
    public function getLine2() {
        return $this->is_line2;
    }
    
    /**
     * 
     * Sets the second line of the street address.
     * 
     * @param vs_line2  the second line of the street address
     */
    public function setLine2( $vs_line2 ) {
        $this->is_line2 = $vs_line2;
    }
    
    /**
     * 
     * Returns the city of the address. Default is empty String.
     * 
     * @return  the city
     */
    public function getCity() {
        return $this->is_city;
    }
    
    /**
     * 
     * Sets the city of the address.
     * 
     * @param   vs_city the city
     */
    public function setCity( $vs_city ) {
        $this->is_city = $vs_city;
    }
    
    /**
     * 
     * Returns the state of the address. Default is empty String.
     * 
     * @return  the state
     */
    public function getState() {
        return $this->is_state;
    }
    
    /**
     * 
     * Sets the state of the address.
     * 
     * @param vs_state  the state
     */
    public function setState( $vs_state ) {
        $this->is_state = $vs_state;
    }
    
    /**
     * 
     * Returns the zipcode of the address. Default is empty String.
     * 
     * @return  the zipcode
     */
    public function geZipcode() {
        return $this->is_zipcode;
    }
    
    /**
     * 
     * Sets the zipcode of the address.
     * 
     * @param vs_zipcode    the zipcode
     */
    public function setZipcode( $vs_zipcode ) {
        $this->is_zipcode = $vs_zipcode;
    }
    
    /**
     * 
     * Returns the country of the address. Default is empty String.
     * 
     * @return  the country
     */
    public function getCountry() {
        return $this->is_country;
    }
    
    /**
     * 
     * Sets the country of the address.
     * 
     * @param vs_country    the country
     */
    public function setCountry( $vs_country ) {
        $this->is_country = $vs_country;
    }
    
    /**
     * 
     * Builds and Returns an Address object based off of the JSON input.
     * 
     * @param vo_json   JSON representation of an address
     * @return  the Address
     * @throws JSONException  if the json is not properly formatted
     */
    static function buildFromJSON( $o_data ) {
        
        $o_instance = new Address();
        if($o_data != NULL) {
            if ( array_key_exists( "address_name", $o_data ) ) { $o_instance->setName( $o_data['address_name']); }
            if ( array_key_exists( "address_line1", $o_data ) ) { $o_instance->setLine1( $o_data['address_line1'] ); }
            if ( array_key_exists( "address_line2", $o_data ) ) { $o_instance->setLine2( $o_data['address_line2'] ); }
            if ( array_key_exists( "address_city", $o_data ) ) { $o_instance->setCity( $o_data['address_city'] ); }
            if ( array_key_exists( "address_state", $o_data ) ) { $o_instance->setState( $o_data['address_state'] ); }
            if ( array_key_exists( "address_zipcode", $o_data ) ) { $o_instance->setZipcode( $o_data['address_zipcode'] ); }
            if ( array_key_exists( "address_country", $o_data ) ) { $o_instance->setCountry( $o_data['address_country'] ); }
        }
        return $o_instance;
    }
    
     /**
     * 
     * Returns a JSON representation of the Address
     * 
     * @return  the JSON representation
     * @throws JSONException    if the json is not properly formatted
     */
    function getJSON() {
        
        $o_array = array( 'address_name' => $this->is_name, 'address_line1' => $this->is_line1, 'address_line2' => $this->is_line2, 'address_city' => $this->is_city, 'address_state' => $this->is_state, 'address_zipcode' => $this->is_zipcode, 'address_country' => $this->is_country );
        return $o_array ;
    }
}

?>
