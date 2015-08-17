<?php

/*
 *  Interface to support different payment processing implementations
 */

interface Paymethodinterface {
    public function vault_add_bank_account( $paydata );
    public function vault_add_creditcard( $paydata );
    public function merchant_application( $merchantdata );
    public function process_rent_payment( $data );
    public function process_subscription_payment( $data );
}


?>
