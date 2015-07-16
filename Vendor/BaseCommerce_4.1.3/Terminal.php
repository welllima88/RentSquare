<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Terminal
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class Terminal {
    
    static $XS_SIGNATURE_FLOOR_LIMIT_25 = "$25";
    static $XS_SIGNATURE_FLOOR_LIMIT_50 = "$50";
    static $XS_SIGNATURE_FLOOR_LIMIT_NONE = "None";
    
    static $XS_MODEL_TYPE_IWL250_RETAIL = "IWL250 Retail";
    static $XS_MODEL_TYPE_IWL220_RETAIL = "IWL220 Retail";
    static $XS_MODEL_TYPE_IWL250_RESTAURANT = "IWL250 Restaurant";
    static $XS_MODEL_TYPE_IWL220_RESTAURANT = "IWL220 Restaurant";
    static $XS_MODEL_TYPE_ICT250_RESTAURANT = "ICT250 Restaurant";
    static $XS_MODEL_TYPE_ICT220_RESTAURANT = "ICT220 Restaurant";
    static $XS_MODEL_TYPE_ICT250_RETAIL = "ICT250 Retail";
    static $XS_MODEL_TYPE_ICT220_RETAIL = "ICT220 Retail";
    static $XS_MODEL_TYPE_T4220_RESTAURANT = "T4220 Restaurant";
    static $XS_MODEL_TYPE_T4210_RESTAURANT = "T4210 Restaurant";
    static $XS_MODEL_TYPE_T4205_RESTAURANT = "T4205 Restaurant";
    static $XS_MODEL_TYPE_T4220_RETAIL = "T4220 Retail";
    static $XS_MODEL_TYPE_T4210_RETAIL = "T4210 Retail";
    static $XS_MODEL_TYPE_T4205_RETAIL = "T4205 Retail";
    static $XS_MODEL_TYPE_NURIT_8400_RESTAURANT = "NURIT 8400 Restaurant";
    static $XS_MODEL_TYPE_NURIT_8400L_RESTAURANT = "NURIT 8400L Restaurant";
    static $XS_MODEL_TYPE_NURIT_8320_RESTAURANT = "NURIT 8320 Restaurant";
    static $XS_MODEL_TYPE_NURIT_8100_RESTAURANT = "NURIT 8100 Restaurant";
    static $XS_MODEL_TYPE_NURIT_8020_RESTAURANT = "NURIT 8020 Restaurant";
    static $XS_MODEL_TYPE_NURIT_8000_SECURE_RESTAURANT = "NURIT 8000Secure Restaurant";
    static $XS_MODEL_TYPE_NURIT_8000_RESTAURANT = "NURIT 8000 Restaurant";
    static $XS_MODEL_TYPE_NURIT_3020_RESTAURANT = "NURIT 3020 Restaurant";
    static $XS_MODEL_TYPE_NURIT_3010_RESTAURANT = "NURIT 3010 Restaurant";
    static $XS_MODEL_TYPE_NURIT_2085_PLUS_RETAURANT = "NURIT 2085+ Restaurant";
    static $XS_MODEL_TYPE_NURIT_2085_RESTAURANT = "NURIT 2085 Restaurant";
    static $XS_MODEL_TYPE_NURIT_8400_RETAIL = "NURIT 8400 Retail";
    static $XS_MODEL_TYPE_NURIT_8400L_RETAIL = "NURIT 8400L Retail";
    static $XS_MODEL_TYPE_NURIT_8320_RETAIL = "NURIT 8320 Retail";
    static $XS_MODEL_TYPE_NURIT_8100_RETAIL = "NURIT 8100 Retail";
    static $XS_MODEL_TYPE_NURIT_8020_RETAIL = "NURIT 8020 Retail";
    static $XS_MODEL_TYPE_NURIT_8000_SECURE_RETAIL = "NURIT 8000Secure Retail";
    static $XS_MODEL_TYPE_NURIT_8000_RETAIL = "NURIT 8000 Retail";
    static $XS_MODEL_TYPE_NURIT_3020_RETAIL = "NURIT 3020 Retail";
    static $XS_MODEL_TYPE_NURIT_3010_RETAIL = "NURIT 3010 Retail";
    static $XS_MODEL_TYPE_NURIT_2085_PLUS_RETAIL = "NURIT 2085+ Retail";
    static $XS_MODEL_TYPE_NURIT_2085_RETAIL = "NURIT 2085 Retail";
    static $XS_MODEL_TYPE_TRANZ_460_RESTAURANT = "TRANZ 460 Restaurant";
    static $XS_MODEL_TYPE_TRANZ_380_RESTAURANT = "TRANZ 380 Restaurant";
    static $XS_MODEL_TYPE_TRANZ_330_TRACK2_RESTAURANT = "TRANZ 330 (Track 2) Restaurant";
    static $XS_MODEL_TYPE_TRANZ_460_RETAIL = "TRANZ 460 Retail";
    static $XS_MODEL_TYPE_TRANZ_380_RETAIL = "TRANZ 380 Retail";
    static $XS_MODEL_TYPE_TRANZ_330_TRACK2_RETAIL = "TRANZ 330 (Track 2) Retail";
    static $XS_MODEL_TYPE_VX570_RESTAURANT = "Vx570 Restaurant";
    static $XS_MODEL_TYPE_VX670_GPRS_RESTAURANT = "Vx670 GPRS Restaurant";
    static $XS_MODEL_TYPE_VX610_GPRS_RESTAURANT = "Vx610 GPRS Restaurant";
    static $XS_MODEL_TYPE_VX670_WIFI_RESTAURANT = "Vx670 Wifi Restaurant";
    static $XS_MODEL_TYPE_VX610_WIFI_RESTAURANT = "Vx610 Wifi Restaurant";
    static $XS_MODEL_TYPE_VX510_DC_RESTAURANT = "Vx510 DC Restaurant";
    static $XS_MODEL_TYPE_VX510_GPRS_RESTAURANT = "Vx510 GPRS Restaurant";
    static $XS_MODEL_TYPE_VX510_RESTAURANT = "Vx510 Restaurant";
    static $XS_MODEL_TYPE_VX510_LE_RESTAURANT = "Vx510LE Restaurant";
    static $XS_MODEL_TYPE_OMNI_3730_RESTAURANT = "Omni 3730 Restaurant";
    static $XS_MODEL_TYPE_OMNI_3730_LE_RESTAURANT = "OMNI 3730LE Restaurant";
    static $XS_MODEL_TYPE_OMNI_3750_RESTAURANT = "OMNI 3750 Restaurant";
    static $XS_MODEL_TYPE_OMNI_3740_RESTAURANT = "Omni 3740 Restaurant";
    static $XS_MODEL_TYPE_VX570_RETAIL = "Vx570 Retail";
    static $XS_MODEL_TYPE_VX670_GPRS_RETAIL = "Vx670 GPRS Retail";
    static $XS_MODEL_TYPE_VX610_GPRS_RETAIL = "Vx610 GPRS Retail";
    static $XS_MODEL_TYPE_VX670_WIFI_RETAIL = "Vx670 Wifi Retail";
    static $XS_MODEL_TYPE_VX610_WIFI_RETAIL = "Vx610 Wifi Retail";
    static $XS_MODEL_TYPE_VX510_DC_RETAIL = "Vx510 DC Retail";
    static $XS_MODEL_TYPE_VX510_GPRS_RETAIL = "Vx510 GPRS Retail";
    static $XS_MODEL_TYPE_VX510_RETAIL = "Vx510 Retail";
    static $XS_MODEL_TYPE_VX510_LE_RETAIL = "Vx510LE Retail";
    static $XS_MODEL_TYPE_OMNI_3730_RETAIL = "Omni 3730";
    static $XS_MODEL_TYPE_OMNI_3730_LE_RETAIL = "OMNI 3730LE Retail";
    static $XS_MODEL_TYPE_OMNI_3750_RETAIL = "OMNI 3750 Retail";
    static $XS_MODEL_TYPE_OMNI_3740_RETAIL = "Omni 3740 Retail";
    static $XS_MODEL_TYPE_T7E_RESTAURANT = "T7E Restaurant";
    static $XS_MODEL_TYPE_T8_RESTAURANT = "T8 Restaurant";
    static $XS_MODEL_TYPE_T7_PLUS_RESTAURANT = "T7Plus Restaurant";
    static $XS_MODEL_TYPE_T77_RESTAURANT = "T77 Restaurant";
    static $XS_MODEL_TYPE_T7P_RESTAURANT = "T7P Restaurant";
    static $XS_MODEL_TYPE_T8_RETAIL = "T8 Retail";
    static $XS_MODEL_TYPE_T7E_RETAIL = "T7E Retail";
    static $XS_MODEL_TYPE_T7_PLUS_RETAIL = "T7Plus Retail";
    static $XS_MODEL_TYPE_T77_RETAIL = "T77 Retail";
    static $XS_MODEL_TYPE_T7P_RETAIL = "T7P Retail";
    static $XS_MODEL_TYPE_M4240_RESTAURANT = "M4240 Restaurant";
    static $XS_MODEL_TYPE_M4230_RESTAURANT = "M4230 Restaurant";
    static $XS_MODEL_TYPE_T4230_RESTAURANT = "T4230 Restaurant";
    static $XS_MODEL_TYPE_M4240_RETAIL = "M4240 Retail";
    static $XS_MODEL_TYPE_M4230_RETAIL = "M4230 Retail";
    static $XS_MODEL_TYPE_T4230_RETAIL = "T4230 Retail";
    static $XS_MODEL_TYPE_OMNI_3210_SE_RESTAURANT = "Omni 3210SE Restaurant";
    static $XS_MODEL_TYPE_OMNI_3210_RESTAURANT = "Omni 3210 Restaurant";
    static $XS_MODEL_TYPE_OMNI_3200_SE_RESTAURANT = "Omni 3200SE Restaurant";
    static $XS_MODEL_TYPE_OMNI_3200_RESTAURANT = "Omni 3200 Restaurant";
    static $XS_MODEL_TYPE_OMNI_396_RESTAURANT = "Omni 396 Restaurant";
    static $XS_MODEL_TYPE_OMNI_3210_SE_RETAIL = "Omni 3210SE Retail";
    static $XS_MODEL_TYPE_OMNI_3210_RETAIL = "Omni 3210 Retail";
    static $XS_MODEL_TYPE_OMNI_3200_SE_RETAIL = "Omni 3200SE Retail";
    static $XS_MODEL_TYPE_OMNI_3200_RETAIL = "Omni 3200 Retail";
    static $XS_MODEL_TYPE_OMNI_396_RETAIL = "Omni 396 Retail";
    static $XS_MODEL_TYPE_TRANZ_380_128K_RESTAURANT = "TRANZ 380 128K Restaurant";
    static $XS_MODEL_TYPE_TRANZ_380_64K_RESTAURANT = "TRANZ 380 64K Restaurant";
    static $XS_MODEL_TYPE_TRANZ_380_128K_RETAIL = "TRANZ 380 128K Retail";
    static $XS_MODEL_TYPE_TRANZ_380_64K_RETAIL = "TRANZ 380 64K Retail";
    static $XS_MODEL_TYPE_TRANZ_330_TRACK1_RETAIL = "TRANZ 330 (Track 1) Retail";
    static $XS_MODEL_TYPE_TRANZ_330_RESTAURANT = "TRANZ 330 Restaurant";
    static $XS_MODEL_TYPE_TRANZ_330_RETAIL = "TRANZ 330 Retail";
    static $XS_MODEL_TYPE_ID_TECH_SHUTTLE = "ID Tech Shuttle";
    static $XS_MODEL_TYPE_MINI_MICR = "Mini MICR";
    static $XS_MODEL_TYPE_PIN_PAD = "Pin Pad";
    static $XS_MODEL_TYPE_PC = "PC";
    
    static $XS_CONNECTION_TYPE_DIAL = "Dial";
    static $XS_CONNECTION_TYPE_DUAL = "Dual";
    static $XS_CONNECTION_TYPE_ETHERNET = "Ethernet";
    static $XS_CONNECTION_TYPE_GPRS = "GPRS";
    
    static $XS_IMPLEMENTATION_NEW_BC = "New (BC)";
    static $XS_IMPLEMENTATION_NEW_AGENT = "New (Agent)";
    static $XS_IMPLEMENTATION_REPROGRAM = "Reprogram";
    
    static $XS_BiLLING_AGENT = "Agent";
    static $XS_BiLLING_AZURA = "Azura";
    static $XS_BiLLING_MERCHANT = "Merchant";
    static $XS_BiLLING_RENT = "Rent";
    static $XS_BiLLING_LEASE = "Lease";
    
    static $XS_AUTO_BATCH_TIME_3_PM = "3 pm";
    static $XS_AUTO_BATCH_TIME_3_30_PM = "3:30 pm";
    static $XS_AUTO_BATCH_TIME_4_PM = "4 pm";
    static $XS_AUTO_BATCH_TIME_4_30_PM = "4:30 pm";
    static $XS_AUTO_BATCH_TIME_5_PM = "5 pm";
    static $XS_AUTO_BATCH_TIME_5_30_PM = "5:30 pm";
    static $XS_AUTO_BATCH_TIME_6_PM = "6 pm";
    static $XS_AUTO_BATCH_TIME_6_30_PM = "6:30 pm";
    static $XS_AUTO_BATCH_TIME_7_PM = "7 pm";
    static $XS_AUTO_BATCH_TIME_7_30_PM = "7:30 pm";
    static $XS_AUTO_BATCH_TIME_8_PM = "8 pm";
    static $XS_AUTO_BATCH_TIME_8_30_PM = "8:30 pm";
    static $XS_AUTO_BATCH_TIME_9_PM = "9 pm";
    static $XS_AUTO_BATCH_TIME_9_30_PM = "9:30 pm";
    static $XS_AUTO_BATCH_TIME_10_PM = "10 pm";
    static $XS_AUTO_BATCH_TIME_10_30_PM = "10:30 pm";
    static $XS_AUTO_BATCH_TIME_11_PM = "11 pm";
    static $XS_AUTO_BATCH_TIME_11_30_PM = "11:30 pm";
    static $XS_AUTO_BATCH_TIME_12_AM = "12 am";
    static $XS_AUTO_BATCH_TIME_12_30_AM = "12:30 am";
    
    static $XS_AUTO_BATCH_TIME_ZONE_PT = "PT";
    static $XS_AUTO_BATCH_TIME_ZONE_MT = "MT";
    static $XS_AUTO_BATCH_TIME_ZONE_CT = "CT";
    static $XS_AUTO_BATCH_TIME_ZONE_ET = "ET";
    
    static $XS_MANUFACTURER_VERIFONE = "VeriFone";
    static $XS_MANUFACTURER_HYPERCOM = "Hypercom";
    static $XS_MANUFACTURER_INGENICO = "Ingenico";
    
    private $ib_tip_line;
    private $is_signature_floor_limit;
    private $is_model_type;
    private $in_quantity;
    private $is_connection_type;
    private $is_implementation;
    private $is_billing;
    private $io_shipping_address;
    private $ib_auto_batch_terminal = False;
    private $is_auto_batch_time;
    private $is_auto_batch_time_zone;
    private $is_descriptor;
    private $is_manufacturer;
    private $is_software;
    private $is_ach_processor_id;
    private $is_bc_processor_id;
    private $is_company_name_descriptor;
    private $in_number_of_units;

    public function isTipLine() {
        return $this->ib_tip_line;
    }

    public function setTipLine( $vb_tip_line) {
        $this->ib_tip_line = $vb_tip_line;
    }

    public function getSignatureFloorLimit() {
        return $this->is_signature_floor_limit;
    }

    public function setSignatureFloorLimit( $vs_signature_floor_limit) {
        $this->is_signature_floor_limit = $vs_signature_floor_limit;
    }
    
    public function getModelType() {
        return $this->is_model_type;
    }

    public function setModelType( $vs_model_type) {
        $this->is_model_type = $vs_model_type;
    }

    public function getQuantity() {
        return $this->in_quantity;
    }

    public function setQuantity( $vn_quantity) {
        $this->in_quantity = $vn_quantity;
    }

    public function getConnectionType() {
        return $this->is_connection_type;
    }

    public function setConnectionType( $vs_connection_type) {
        $this->is_connection_type = $vs_connection_type;
    }

    public function getImplementation() {
        return $this->is_implementation;
    }

    public function setImplementation( $vs_implementation) {
        $this->is_implementation = $vs_implementation;
    }

    public function getBilling() {
        return $this->is_billing;
    }

    public function setBilling( $vs_billing) {
        $this->is_billing = $vs_billing;
    }

    public function getShippingAddress() {
        return $this->io_shipping_address;
    }

    public function setShippingAddress( Address $vo_shipping_address ) {
        $this->io_shipping_address = $vo_shipping_address;
    }
    
    public function isAutoBatchTerminal() {
    	return $this->ib_auto_batch_terminal;
    }
    
    public function setAutoBatchTerminal( $vb_auto_batch_terminal ) {
    	$this->ib_auto_batch_terminal = $vb_auto_batch_terminal;
    }

    public function getAutoBatchTime() {
        return $this->is_auto_batch_time;
    }
    
    public function setAutoBatchTime( $vs_auto_batch_time ) {
        $this->is_auto_batch_time = $vs_auto_batch_time;
    }
    
    public function getAutoBatchTimeZone() {
        return $this->is_auto_batch_time_zone;
    }

    public function setAutoBatchTimeZone( $vs_auto_batch_time_zone) {
        $this->is_auto_batch_time_zone = $vs_auto_batch_time_zone;
    }

    public function getDescriptor() {
        return $this->is_descriptor;
    }

    public function setDescriptor( $vs_descriptor) {
        $this->is_descriptor = $vs_descriptor;
    }

    public function getManufacturer() {
        return $this->is_manufacturer;
    }

    public function setManufacturer( $vs_manufacturer) {
        $this->is_manufacturer = $vs_manufacturer;
    }

    public function getSoftware() {
        return $this->is_software;
    }

    public function setSoftware( $vs_software) {
        $this->is_software = $vs_software;
    }

    public function getAchProcessorId() {
        return $this->is_ach_processor_id;
    }

    public function setAchProcessorId( $vs_ach_processor_id) {
        $this->is_ach_processor_id = $vs_ach_processor_id;
    }

    public function getBankCardProcessorId() {
        return $this->is_bc_processor_id;
    }

    public function setBankCardProcessorId( $vs_bc_processor_id) {
        $this->is_bc_processor_id = $vs_bc_processor_id;
    }
    
    public function getCompanyNameDescriptor() {
        return $this->is_company_name_descriptor;
    }
    
    public function setCompanyNameDescriptor( $vs_company_name_descriptor ) {
        $this->is_company_name_descriptor = $vs_company_name_descriptor;
    }
    
    public function getNumberOfUnits() {
    	return $this->in_number_of_units;
    }
    
    public function setNumberofUnits( $vn_number_of_units ) {
		$this->in_number_of_units = $vn_number_of_units;
    }
    
    public function getJSON() {
        
        $o_json = array();
        
        if ( !is_null( $this->ib_tip_line ) ) { $o_json[ "terminal_tip_line" ] = $this->ib_tip_line; }
        if ( !is_null( $this->is_signature_floor_limit ) ) { $o_json[ "terminal_signature_floor_limit" ] = $this->is_signature_floor_limit; }
        if ( !is_null( $this->is_model_type ) ) { $o_json[ "terminal_model_type" ] = $this->is_model_type; }
        if ( !is_null( $this->in_quantity ) ) { $o_json[ "terminal_quantity" ] = $this->in_quantity; }
        if ( !is_null( $this->is_connection_type ) ) { $o_json[ "terminal_connection_type" ] = $this->is_connection_type; }
        if ( !is_null( $this->is_implementation ) ) { $o_json[ "terminal_implementation" ] = $this->is_implementation; }
        if ( !is_null( $this->is_billing ) ) { $o_json[ "temrinal_billing" ] = $this->is_billing; }
        if ( !is_null( $this->io_shipping_address ) ) { $o_json[ "terminal_shipping_address" ] = $this->io_shipping_address->getJSON(); }
        if ( !is_null( $this->ib_auto_batch_terminal ) ) { $o_json[ "terminal_auto_batch_terminal" ] = $this->ib_auto_batch_terminal; }
        if ( !is_null( $this->is_auto_batch_time ) ) { $o_json[ "terminal_auto_batch_time" ] = $this->is_auto_batch_time; }
        if ( !is_null( $this->is_auto_batch_time_zone ) ) { $o_json[ "terminal_auto_batch_time_zone" ] = $this->is_auto_batch_time_zone; }
        if ( !is_null( $this->is_descriptor ) ) { $o_json[ "terminal_descriptor" ] = $this->is_descriptor; }
        if ( !is_null( $this->is_manufacturer ) ) { $o_json[ "terminal_manufacturer" ] = $this->is_manufacturer; }
        if ( !is_null( $this->is_software ) ) { $o_json[ "terminal_software" ] = $this->is_software; }
        if ( !is_null( $this->is_ach_processor_id ) ) { $o_json[ "terminal_ach_processor_id" ] = $this->is_ach_processor_id; }
        if ( !is_null( $this->is_bc_processor_id ) ) { $o_json[ "terminal_bc_processor_id" ] = $this->is_bc_processor_id; }
        if ( !is_null( $this->is_company_name_descriptor ) ) { $o_json[ "terminal_company_name_descriptor" ] = $this->is_company_name_descriptor; }
        if ( !is_null( $this->in_number_of_units ) ) { $o_json[ "terminal_number_of_units" ] = $this->in_number_of_units; }
        
        return $o_json;
    }
    
    public static function buildFromJSON( $vo_json ) {
        
        $o_terminal = new Terminal();
        
        if ( array_key_exists( "terminal_tip_line", $vo_json ) ) { $o_terminal->setTipLine( $vo_json[ "terminal_tip_line" ] ); }
        if ( array_key_exists( "terminal_signature_floor_limit", $vo_json ) ) { $o_terminal->setSignatureFloorLimit( $vo_json[ "terminal_signature_floor_limit" ] ); }
        if ( array_key_exists( "terminal_model_type", $vo_json ) ) { $o_terminal->setModelType( $vo_json[ "terminal_model_type" ] ); }
        if ( array_key_exists( "terminal_quantity", $vo_json ) ) { $o_terminal->setQuantity( $vo_json["terminal_quantity" ] ); }
        if ( array_key_exists( "terminal_connection_type", $vo_json ) ) { $o_terminal->setConnectionType( $vo_json[ "terminal_connection_type" ] ); }
        if ( array_key_exists( "terminal_implementation", $vo_json ) ) { $o_terminal->setImplementation( $vo_json[ "terminal_implementation" ] ); }
        if ( array_key_exists( "temrinal_billing", $vo_json ) ) { $o_terminal->setBilling( $vo_json[ "temrinal_billing" ] ); }
        if ( array_key_exists( "terminal_shipping_address", $vo_json ) ) { $o_terminal->setShippingAddress( Address::buildFromJSON( $vo_json[ "terminal_shipping_address" ] ) ); }
        if ( array_key_exists( "terminal_auto_batch_terminal", $vo_json ) ) { $o_terminal->setAutoBatchTerminal( $vo_json[ "terminal_auto_batch_terminal" ] ); }
        if ( array_key_exists( "terminal_auto_batch_time", $vo_json ) ) { $o_terminal->setAutoBatchTime( $vo_json[ "terminal_auto_batch_time" ] ); }
        if ( array_key_exists( "terminal_auto_batch_time_zone", $vo_json ) ) { $o_terminal->setAutoBatchTimeZone( $vo_json[ "terminal_auto_batch_time_zone" ] ); }
        if ( array_key_exists( "terminal_descriptor", $vo_json ) ) { $o_terminal->setDescriptor( $vo_json[ "terminal_descriptor" ] ); }
        if ( array_key_exists( "terminal_manufacturer", $vo_json ) ) { $o_terminal->setManufacturer( $vo_json[ "terminal_manufacturer" ] ); }
        if ( array_key_exists( "terminal_software", $vo_json ) ) { $o_terminal->setSoftware( $vo_json[ "terminal_software" ] ); }
        if ( array_key_exists( "terminal_ach_processor_id", $vo_json ) ) { $o_terminal->setAchProcessorId( $vo_json[ "terminal_ach_processor_id" ] ); }
        if ( array_key_exists( "terminal_bc_processor_id", $vo_json ) ) { $o_terminal->setBankCardProcessorId( $vo_json[ "terminal_bc_processor_id" ] ); }
        if ( array_key_exists( "terminal_company_name_descriptor", $vo_json ) ) { $o_terminal->setCompanyNameDescriptor( $vo_json[ "terminal_company_name_descriptor" ] ); }
        if ( array_key_exists( "terminal_number_of_units", $vo_json ) ) {$o_terminal->setNumberOfUnits( $vo_json[ "terminal_number_of_units" ] ); }
        
        return $o_terminal;
    }
    
}

?>