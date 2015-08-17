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

    public function submitMerchApp( $merchantdata )
    {
        $appResult  = $this->payer->merchant_application( $merchantdata );      

        return json_encode($appResult);
    }

    public function rentPayment( $data )
    {
        $appResult  = $this->payer->process_rent_payment( $data );      

        return json_encode($appResult);
    }

    public function subscriberPayment( $merchantdata )
    {
        $appResult  = $this->payer->process_subscription_payment( $data );      

        return json_encode($appResult);
    }
 
}
