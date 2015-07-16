<?php

class Paymethodutils {

    protected $payer;

    public function __construct(Paymethodinterface $payer)
    {
        $this->payer = $payer;
    }

    /*
     * @var array
     *
     * @return array
     */
    public function addCardToVault( $paydata )
    {
        list( $status, $result ) =  $this->payer->vault_add_creditcard( $paydata );

        return array( $status, $result );
    }

    public function addBankToVault( $paydata )
    {
        list( $status, $result ) =  $this->payer->vault_add_bank_account( $paydata );

        return array( $status, $result );
    }

    public function submitMerchantApp( $merchantdata )
    {
        list( $status, $result, $approval_id ) = $this->payer->merchant_application( $merchantdata );      
    }
 
}
