<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MOTO
 *
 * @author Ryan Murphy <ryanm@kafer.com>
 */
class MOTO {
    
    static $XS_PROCESSING_METHOD_KEY_ENTERED_TERMINAL = "Key Entered Terminal";
    static $XS_PROCESSING_METHOD_VIRTUAL_TERMINAL_GATEWAY = "Virtual Terminal / Gateway";
    
    static $XS_ORDER_FORMS_DESTROYED = "Destroyed";
    static $XS_ORDER_FORMS_RETAINED = "Retained";
    
    static $XS_OUTBOUND_MARKETING_CATALOG = "Catalog";
    static $XS_OUTBOUND_MARKETING_ENVELOPE = "Envelope";
    static $XS_OUTBOUND_MARKETING_POST_CARD = "Post Card";
    static $XS_OUTBOUND_MARKETING_PRINT_AD = "Print Ad";
    static $XS_OUTBOUND_MARKETING_OTHER = "Other";
    
    private $io_processing_method;
    private $is_order_forms;
    private $is_software_retain;
    private $io_outbound_marketing;
    private $ib_outbound_telemarketing_is_conducted;
    
    function __construct() {
        $this->io_processing_method = array();
        $this->io_outbound_marketing = array();
    }

    public function getProcessingMethods() {
        return $this->io_processing_method;
    }

    public function addProcessingMethod( $vs_processing_method) {
        array_push( $this->io_processing_method, $vs_processing_method );
    }

    public function getOrderForms() {
        return $this->is_order_forms;
    }

    public function setOrderForms( $vs_order_forms) {
        $this->is_order_forms = $vs_order_forms;
    }

    public function getSoftwareRetain() {
        return $this->is_software_retain;
    }

    public function setSoftwareRetain( $vs_software_retain) {
        $this->is_software_retain = $vs_software_retain;
    }

    public function getOutboundMarketing() {
        return $this->io_outbound_marketing;
    }

    public function addOutboundMarketing( $vs_outbound_marketing) {
        array_push( $this->io_outbound_marketing, $vs_outbound_marketing );
    }

    public function isOutboundTelemarketingIsConducted() {
        return $this->ib_outbound_telemarketing_is_conducted;
    }

    public function setOutboundTelemarketingIsConducted( $vb_outbound_telemarketing_is_conducted) {
        $this->ib_outbound_telemarketing_is_conducted = $vb_outbound_telemarketing_is_conducted;
    }
    
    public function getJSON() {
        
        $o_json = array();
        
        $o_processing_methods = array();
        for ( $n_index = 0, $n_size = count( $this->io_processing_method ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_processing_methods, $this->io_processing_method[$n_index] );
        }
        $o_json[ "moto_processing_methods"] = $o_processing_methods;
        
        if ( !is_null( $this->is_order_forms ) ) { $o_json[ "moto_order_forms" ] = $this->is_order_forms; }
        if ( !is_null( $this->is_software_retain ) ) { $o_json[ "moto_software_retain" ] = $this->is_software_retain; }
        
        $o_outbound_marketing = array();
        for ( $n_index = 0, $n_size = count( $this->io_outbound_marketing ); $n_index < $n_size; $n_index++ ) {
            array_push( $o_outbound_marketing, $this->io_outbound_marketing[$n_index] );
        }
        $o_json[ "moto_outbound_marketing"] = $o_outbound_marketing;
        
        if ( !is_null( $this->ib_outbound_telemarketing_is_conducted ) ) { $o_json[ "moto_outbound_telemarketing_is_conducted" ] =  $this->ib_outbound_telemarketing_is_conducted; }
        
        return $o_json;
    }
    
    public static function buildFromJSON( $vo_json ) {
        
        $o_moto = new MOTO();
        if ( array_key_exists( "moto_processing_methods", $vo_json ) ) {
            $o_processing_methods = $vo_json[ "moto_processing_methods" ];
            for ( $n_index = 0, $n_size = count( $o_processing_methods ); $n_index < $n_size; $n_index++ ) {
                $o_moto->addProcessingMethod( $o_processing_methods[ $n_index ] );
            }
        }
        if ( array_key_exists( "moto_order_forms", $vo_json ) ) { $o_moto->setOrderForms( $vo_json[ "moto_order_forms" ] ); }
        if ( array_key_exists( "moto_software_retain", $vo_json ) ) { $o_moto->setSoftwareRetain( $vo_json[ "moto_software_retain" ] ); }
        if ( array_key_exists( "moto_outbound_marketing", $vo_json ) ) {
            $o_outbound_marketing = $vo_json[ "moto_outbound_marketing" ];
            for ( $n_index = 0, $n_size = count( $o_outbound_marketing ); $n_index < $n_size; $n_index++ ) {
                $o_moto->addOutboundMarketing( $o_outbound_marketing[ $n_index ] );
            }
        }
        if ( array_key_exists( "moto_outbound_telemarketing_is_conducted", $vo_json ) ) { $o_moto->setOutboundTelemarketingIsConducted( $vo_json[ "moto_outbound_telemarketing_is_conducted" ] ); }
        
        return $o_moto;
    }
    
}

?>