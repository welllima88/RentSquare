<?php

require_once("PayMethodInterface.php");

App::build(array('Vendor' => array(APP . 'Vendor' . DS . 'BaseCommerce' . DS)));
App::uses('BaseCommerceClient', 'Vendor');
App::uses('Account', 'Vendor');
App::uses('MerchantApplication', 'Vendor');
App::uses('BankAccount', 'Vendor');
App::uses('BankCard', 'Vendor');
App::uses('BankCardTransaction', 'Vendor');
App::uses('BankAccountTransaction', 'Vendor');
App::uses('Address', 'Vendor');
App::uses('Location', 'Vendor');
App::uses('PrincipalContact', 'Vendor');
App::uses('BankCardDetails', 'Vendor');
App::uses('State', 'Model');

class Paymethodbasecommerce implements Paymethodinterface {
 
    public function vault_add_bank_account( $paydata )
    {
       $status = '';
       $result = '';
       $o_bank_account = new BankAccount();
       $o_bank_account->setName( $paydata['first_name'] . " " . $paydata['last_name'] );
       $o_bank_account->setAccountNumber( $paydata['account_number'] );
       $o_bank_account->setRoutingNumber( $paydata['routing_number'] );
       if ($paydata['bank_acct_type'] == "Savings" )
       {
          $o_bank_account->setAccountType(BankAccount::$XS_BA_TYPE_SAVINGS);
       }
       else
       {
          $o_bank_account->setAccountType(BankAccount::$XS_BA_TYPE_CHECKING);
       }

       $o_billing_address = new Address( Address::$XS_ADDRESS_NAME_BILLING );
       $o_billing_address->setLine1( $paydata['billing_address1'] );
       if( ! empty( $paydata['billing_address2'] ) ) { $o_billing_address->setLine2( $paydata['billing_address2'] ); }
       $o_billing_address->setCity( $paydata['billing_city'] );
       if( ! empty( $paydata['billing_state_id'] ) )
       {
          $States = new State();
          $billing_state = $States->findById($paydata['billing_state_id']);
          $billing_state = $billing_state['State']['abbr'];
       }
       $o_billing_address->setState( $billing_state );
       $o_billing_address->setZipcode( $property['billing_zip'] );
       $o_billing_address->setCountry( "USA" );
       $o_bank_account->setBillingAddress( $o_billing_address );

       if ( $paydata['usertype'] == 2 ) 
       {
           $o_bcpc = new BaseCommerceClient( RENTSQUARE_PARTNER_USER, RENTSQUARE_PARTNER_PASS, RENTSQUARE_PARTNER_KEY );
       }
       else
       {
           $o_bcpc = new BaseCommerceClient( RENTSQUARE_MERCH_USER, RENTSQUARE_MERCH_PASS, RENTSQUARE_MERCH_KEY );
       }
       $o_bcpc->setSandbox( BC_SANDBOXVALUE );
       $o_bank_account = $o_bcpc->addBankAccount( $o_bank_account );

       $status = $o_bank_account->getStatus();
       if( $status ==  BankAccount::$XS_BA_STATUS_FAILED )
       {
          // Fail
          $status = 0;
          $result = $o_bank_account->getMessages();
       }
       else if( $status ==  BankAccount::$XS_BA_STATUS_ACTIVE ) 
       {
          // Success
          $status = 1;
          $result = $o_bank_account->getToken();
       }

       return array( $status, $result );

    }

    public function vault_add_creditcard( $paydata )
    {
       $status = '';
       $result = '';
       $o_bcpc = new BaseCommerceClient( RENTSQUARE_MERCH_USER, RENTSQUARE_MERCH_PASS, RENTSQUARE_MERCH_KEY );
       $o_bcpc->setSandbox( BC_SANDBOXVALUE );
    
       $o_bc = new BankCard();
       $o_bc->setExpirationMonth( $paydata['expire_dt_month'] );
       $o_bc->setExpirationYear( $paydata['expire_dt_year'] );
       $o_bc->setName( $paydata['first_name'] . " " . $paydata['last_name'] );
       $o_bc->setNumber( $paydata['card_number'] );

       $o_billing_address = new Address( Address::$XS_ADDRESS_NAME_BILLING );
       $o_billing_address->setLine1( $paydata['billing_address1'] );
       if( ! empty( $paydata['billing_address2'] ) ) { $o_billing_address->setLine1( $paydata['billing_address2'] ); }
       $o_billing_address->setCity( $paydata['billing_city'] );
       if( ! empty( $paydata['billing_state_id'] ) )
       {
          $States = new State();
          $billing_state = $States->findById($paydata['billing_state_id']);
          $billing_state = $billing_state['State']['abbr'];
       }
       $o_billing_address->setState( $billing_state );
       $o_billing_address->setZipcode( $paydata['billing_zip'] );
       $o_billing_address->setCountry( "USA" );
       $o_bc->setBillingAddress( $o_billing_address );
/*
echo "<pre>";
print_r($o_bc);
echo "</pre>";
exit;
*/

       $o_bc = $o_bcpc->addBankCard( $o_bc );

       $status = $o_bc->getStatus();
       if( $status ==  BankCard::$XS_BC_STATUS_FAILED )
       {
          // Fail
          $status = 0;
          $result = $o_bc->getMessages();
       }
       else if( $status ==  BankCard::$XS_BC_STATUS_ACTIVE ) 
       {
          // Success
          $status = 1;
          $result = $o_bc->getToken();
       }

       return array( $status, $result );
    }

    public function merchant_application( $data )
    {
       $errors = array();
       $results = array();
       $i=0;

       // Instantiate State Model
       $States = new State();

       // Newest modification for Merchant Application submission

       foreach( $data['Property'] as $property )
       {
          // Create client
          $o_bcpc = new BaseCommerceClient( RENTSQUARE_PARTNER_USER, RENTSQUARE_PARTNER_PASS, RENTSQUARE_PARTNER_KEY );
          $o_bcpc->setSandbox( BC_SANDBOXVALUE );
   
          $o_merch_app = new MerchantApplication();
          $o_account = new Account();

          // Account & Address infno
          //$o_account->setAccountName( $property['legal_name'] );
          $o_account->setAccountName( "RentSquare LLC" );
          $o_account->setAcceptACH( true );	
          $o_account->setAcceptBC( true );

          // Legal Address
          $legal_state = $States->findById($property['legal_state_id']);
          $legal_state = $legal_state['State']['abbr'];
          $state_inc = $States->findById($property['state_inc']);
          $state_inc = $state_inc['State']['abbr'];
          $home_state = $States->findById($data['User']['state_id']);
          $home_state = $home_state['State']['abbr'];
          switch($property['ownership_type']){
            case 0:
              $ownership_type = 'Corporation';
              break;
            case 1:
              $ownership_type = 'LLC';
              break;
            case 2:
              $ownership_type = 'Partnership';
              $state_inc = 'N/A';
              break;
            case 3:
              $ownership_type = 'Sole Proprietor';
              $property['legal_ein'] = $data['User']['ssn'];
              $state_inc = 'N/A';
              break;
          }

          $o_legal_address = new Address( Address::$XS_ADDRESS_NAME_LEGAL );
          //$o_legal_address->setLine1( $property['legal_street'] );
          //$o_legal_address->setCity( $property['legal_city'] );
          //$o_legal_address->setState( $legal_state );
          //$o_legal_address->setZipcode( $property['legal_zip'] );
          $o_legal_address->setLine1( "218 S. Formosa Ave" );
          $o_legal_address->setCity( "Los Angeles" );
          $o_legal_address->setState( "CA" );
          $o_legal_address->setZipcode( "90036" );
          $o_legal_address->setCountry( "USA" );

          $o_account->setLegalAddress( $o_legal_address );

          //$o_account->setAccountPhoneNumber( $property['legal_phone'] );
          //$o_account->setCustomerServicePhoneNumber( $data['User']['phone'] );
          //$o_account->setEIN( $property['legal_ein'] );
          $o_account->setAccountPhoneNumber( "303-809-6116" );
          $o_account->setReferralPartnerID( "a0Fi0000005jNJ3" );			//*** Hardcoded at BC
          $o_account->setCongaTemplateId( "a0d310000006iKoi" );				//*** Hardcoded at BC
          $o_account->setCustomerServicePhoneNumber( "303-809-6116" );
          $o_account->setDBA( $property['legal_dba'] );
          $o_account->setEntityType( Account::$XS_ENTITY_TYPE_CORP );
          $o_account->setAssociationNumber( "268000" );
          $o_account->setEIN( "452501975" );
          $o_account->setIpAddressOfAppSubmission( "192.168.0.1" );     		//*** Hardcoded at BC
          $o_account->setWebsite( 'http://rentsquare.com' );

          // Settlement Account Bank Info
          $o_account->setSettlementAccountBankName( $property['bank_name']  );
          $o_account->setSettlementAccountBankPhone( '' );				//** TODO  Required I think - need to add to form?
          $o_account->setSettlementAccountName( $property['legal_name'] );
          $o_account->setSettlementAccountNumber( $property['bank_account_num'] );
          $o_account->setSettlementAccountRoutingNumber( $property['routing_number'] );
          $o_account->setSettlementSameAsFeeAccount( true );

          $o_merch_app->setAccount( $o_account );

          $o_dba_address = new Address( Address::$XS_ADDRESS_NAME_DBA );
          $o_dba_address->setLine1( $property['legal_street'] );
          $o_dba_address->setCity( $property['legal_city'] );
          $o_dba_address->setState( $state_inc );					//** Should this be legal state??
          $o_dba_address->setZipcode( $property['legal_zip'] );
          $o_dba_address->setCountry( "USA" );

          $o_location = new Location();
          $o_location->setContactSameAsOwner( true );
          $o_location->setDescriptionOfProductsAndServices( "Property Management Services" ); 

          $o_location->setDBAAddress( $o_dba_address );

          //$o_location->setDescription( Location::$XS_DESCRIPTION_CONSULTING );	// Dont see in Angela's document
  
          //$o_cal = Calendar->getInstance();						//*** Hardcoded at BC
          //$o_cal->add( Calendar->YEAR, -2 );						//*** Hardcoded at BC
          //$o_year = $o_cal->getTime();						//*** Hardcoded at BC
          //$o_location->setEntityStartDate( $o_year );					//*** Hardcoded at BC

          $o_location->setEntityState( $legal_state );					//** Should this be legal state??
          $o_location->setSalesAgentName( 'Sean Perlmutter' );				
          $o_location->setProgramPricing( 'RentSquare' );
          $o_location->setProgramDetails( 'Fees Billed to Partner' );

          $o_contact = new PrincipalContact();
          $o_contact->setLastName( $data['User']['last_name'] );
          $o_contact->setFirstName( $data['User']['first_name'] );

          $o_mailing = new Address( Address::$XS_ADDRESS_NAME_MAILING );
          $o_mailing->setLine1( $data['User']['street'] );
          $o_mailing->setCity( $data['User']['city'] );
          $o_mailing->setState( $home_state );
          $o_mailing->setZipcode( $data['User']['zip'] );
          $o_mailing->setCountry( "USA" );

          $o_contact->setMailingAddress( $o_mailing );
          $o_contact->setPhoneNumber( $data['User']['phone'] );
          $o_contact->setMobilePhoneNumber( $data['User']['phone'] );
          $o_contact->setEmail( $data['User']['email'] );
          $o_contact->setTitle( "Property Manager" );

          //  This 'new' call is not valid - causing fatal error - passing in DOB from applicaiton instead
          //$o_cal = new Calendar();
          //$o_cal->getInstance();
          //$o_cal->add( Calendar.YEAR, -60 );
          //$o_bday = $o_cal->getTime();
          $o_bday = $data['User']['dob'] . " 00:00:00";	
          $o_contact->setBirthdate( $o_bday );
          $o_contact->setAuthorizedUser( true );
          $o_contact->setAccountSigner( true );
          $o_contact->setOwnershipPercentage( 100 );
          $o_contact->setSSN( $data['User']['ssn'] );
          $o_contact->setIsPrimary( true );

          $o_location->addPrincipalContact( $o_contact );

          $o_bc_details = new BankCardDetails();
          $o_bc_details->setAcceptAmex( false );
          $o_bc_details->addDebitBrandsRequested( "Visa,MasterCard,Discover Network,Credit,Debit" );

          $o_bc_details->setFeeOther( "ie Annual Fee collected in month 3" );	//** Not Sure If this is RIGHT
          $o_bc_details->setAverageMonthlyVolume( urlencode(floatval($property['num_units'])*floatval($property['average_rent'])) );
          $o_bc_details->setMaxTicket( 150 );
          $o_bc_details->setMaxMonthlyVolume( 4000 );
          $o_bc_details->setPaymentUrl( "https://www.url.com/payment" );
          $o_bc_details->setRecurring( true );
          $o_bc_details->setRetrievalFee( 7.50 );
          $o_bc_details->setWirelessFee( 5 );
          $o_bc_details->setCardholderCharged( BankCardDetails::$XS_CARDHOLDER_CHARGED_PURCHASE  );
          $o_bc_details->setCardholderDataStoredLocally( false ); 
          $o_bc_details->setPreviouslyTerminatedAsVisaMastercardMerchant( false ); 
          $o_bc_details->setVisaMastercardSignage( true ); 
          $o_bc_details->set3rdPartyAccessToCardholderData( false ); 
          $o_bc_details->setMailOrderPercentage( 0 ); 
          $o_bc_details->setTelephoneOrderPercentage( 0 ); 
          $o_bc_details->setDuplicates( false ); 
          $o_bc_details->setUnpaidItemFee( 30 ); 

          $o_location->setBankCardDetails( $o_bc_details );

          $o_merch_app->addLocation( $o_location );

          $o_bc = $o_bcpc->submitApplication( $o_merch_app );

//          try {
              foreach( $o_bc as $merchAppObj) 
              {
                 $status   = $merchAppObj->getResponseCode();
                 $messages = $merchAppObj->getResponseMessages();
              }
/*
          } catch( e ) {
                 $status   = 0;
                 $messages = e->getMessage(); 
          }
*/

echo "<pre>";
echo "<br>Status = $status";
echo "<br>Msgs = ";
print_r($messages);
print_r($o_bc);
echo "</pre>";
exit;

/*
       $status = $o_bc->getStatus();
       if( $status ==  BankCard::$XS_BC_STATUS_FAILED )
       {
          // Fail
          $status = 0;
          $result = $o_bc->getMessages();
       }
       else if( $status ==  BankCard::$XS_BC_STATUS_ACTIVE ) 
       {
          // Success
          $status = 1;
          $result = $o_bc->getToken();
       }

       return array( $status, $result, $approval_id );
*/
          return $o_bc;
            
       } // end foreach

    }

    /*
     * @param $data  - array of applicaion data including user_id and payment type (ach  or cc)
     */
    public function process_rent_payment( $data )
    {
       if ( $data['pay_method'] == 'CC' )
       {
          $pay_rsl = $this->processCreditCardTransaction( $data );
       }
       else
       {
          $pay_rsl = $this->processBankAccountTransaction( $data );
       }

       echo "<pre>";
       print_r($pay_rsl);
       echo "</pre>";
exit;

       return $pay_rsl;
       
    }

    public function process_subscription_payment( $data )
    {
       if ( $data['pay_method'] == 'CC' )
       {
          $pay_rsl = $this->processCreditCardTransaction( $data );
       }
       else
       {
          $pay_rsl = $this->processBankAccountTransaction( $data );
       }
       return $pay_rsl;
    }

    protected function processBankAccountTransaction( $data )
    {
       $o_bat = new BankAccountTransaction();
       $o_bat->setType( BankAccountTransaction::$XS_BAT_TYPE_DEBIT );
       $o_bat->setMethod( BankAccountTransaction::$XS_BAT_METHOD_CCD );
       $o_bat->setEffectiveDate( date('m-d-Y H:i:s') );
       $o_bat->setToken( $data['payer_vault_id'] );
       $o_bat->setAmount( $data['total_amt'] );
       if ( isset($data['fee_amt']) && ! empty($data['fee_amt']) && isset($data['rsq_vault_id']) && ! empty($data['rsq_vault_id']) )
       {
          $o_bat->setCustomField10( $data['rsq_vault_id'], $data['fee_amt'] );
       }
       $o_bcpc = new BaseCommerceClient( RENTSQUARE_MERCH_USER, RENTSQUARE_MERCH_PASS, RENTSQUARE_MERCH_KEY );
       $o_bcpc->setSandbox( BC_SANDBOXVALUE );
       $o_bat = $o_bcpc->processBankAccountTransaction( $o_bat );
       if( $o_bat->isStatus( BankAccountTransaction::$XS_BAT_STATUS_FAILED ) )
       {
          //Transaction Failed
          return array( 'status' => '0', 'info' => $o_bat->getMessages() );
       } 
       else if( $o_bat->isStatus( BankAccountTransaction::$XS_BAT_STATUS_CREATED ) ) 
       { 
          //Transaction went through successfully
          return array( 'status' => '1', 'info' => $o_bat->getBankAccountTransactionId() );
       }
    }

    protected function processCreditCardTransaction( $data )
    {
       $o_bct = new BankCardTransaction();
       $o_bct->setToken( $data['payer_vault_id'] );
       $o_bct->setType(BankCardTransaction::$XS_BCT_TYPE_SALE);
       $o_bct->setAmount( $data['total_amt'] );
       if ( isset($data['fee_amt']) && ! empty($data['fee_amt']) && isset($data['rsq_vault_id']) && ! empty($data['rsq_vault_id']) )
       {
          $o_bct->setCustomField10( $data['rsq_vault_id'], $data['fee_amt'] );
       }
       $o_bcpc = new BaseCommerceClient( RENTSQUARE_MERCH_USER, RENTSQUARE_MERCH_PASS, RENTSQUARE_MERCH_KEY );
       $o_bcpc->setSandbox( BC_SANDBOXVALUE );
       $o_bct = $o_bcpc->processBankCardTransaction( $o_bct );
       if( $o_bct->isStatus( BankCardTransaction::$XS_BCT_STATUS_FAILED ) ) 
       {
          //Transaction Failed
          return array( 'status' => '0', 'info' => $o_bct->getMessages() );
       } 
       else if( $o_bct->isStatus( BankCardTransaction::$XS_BCT_STATUS_DECLINED ) ) 
       { 
          //Transaction Failed
          return array( 'status' => '0', 'info' => $o_bct->getMessages() );
       } 
       else if( $o_bct->isStatus(BankCardTransaction::$XS_BCT_STATUS_CAPTURED) ) 
       {
          //Transaction went through successfully
          return array( 'status' => '1', 'info' => $o_bct->getTransactionID() );
       }
    }
    
}
