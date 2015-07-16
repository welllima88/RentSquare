<?php

require_once("PayMethodInterface.php");

App::build(array('Vendor' => array(APP . 'Vendor' . DS . 'BaseCommerce' . DS)));
App::uses('BaseCommerceClient', 'Vendor');
App::uses('Account', 'Vendor');
App::uses('MerchantApplication', 'Vendor');
App::uses('BankAccount', 'Vendor');
App::uses('BankCard', 'Vendor');
App::uses('Address', 'Vendor');
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
       if ($paymentmethod['bank_acct_type'] == "Savings" )
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

       $o_bcpc = new BaseCommerceClient( RENTSQUARE_MERCH_USER, RENTSQUARE_MERCH_PASS, RENTSQUARE_MERCH_KEY );
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

       //Setup variables to send to Phoenix Payments
       foreach( $data['Property'] as $property )
       {
          // Create client
          $o_bcpc = new BaseCommerceClient( RENTSQUARE_MERCH_USER, RENTSQUARE_MERCH_PASS, RENTSQUARE_MERCH_KEY );
          $o_bcpc->setSandbox( BC_SANDBOXVALUE );
   
          $o_account = new Account();
          $o_merch_app = new MerchantApplication();

          //set POST variables
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

          // Account & Address infno
          $o_account->setAccountName( $property['legal_name'] );
          $o_account->setAcceptACH( true );	
          $o_account->setAcceptBC( true );

          $o_legal_address = new Address( Address::$XS_ADDRESS_NAME_LEGAL );
          $o_legal_address->setLine1( $property['legal_street'] );
          $o_legal_address->setCity( $property['legal_city'] );
          $o_legal_address->setState( $legal_state );
          $o_legal_address->setZipcode( $property['legal_zip'] );
          $o_legal_address->setCountry( "USA" );

          $o_account->setLegalAddress( o_legal_address );
          $o_account->setAccountPhoneNumber( $property['legal_phone'] );
          $o_account->setReferralPartnerID( '' );					//*** REQUIRED - but don't know what it is
          $o_account->setCustomerServicePhoneNumber( $data['User']['phone'] );
          $o_account->setDBA( $property['legal_dba'] );

          $o_account->setEntityType( Account::$XS_ENTITY_TYPE_CORP );
          $o_account->setAssociationNumber( '' );					//*** REQUIRED - but don't know what it is
          $o_account->setCongaTemplateId( 'a0di00000008cuB' );
          $o_account->setEIN( $property['legal_ein'] );
          $o_account->setIpAddressOfAppSubmission( $_SERVER['REMOTE_ADDR'] );     //** or ?? $_SERVER['SERVER_ADDR']
          $o_account->setWebsite( 'http://rentsquare.com' );

          // Settlment Account Bank Info
          $o_account->setSettlmentAccountBankName( $property['bank_name']  );
          $o_account->setSettlmentAccountBankPhone( );				//** Required I think - need to add to form?
          $o_account->setSettlmentAccountName( 'Same As Legal Name' );
          $o_account->setSettlmentAccountNumber( $property['bank_account_num'] );
          $o_account->setSettlmentAccountRoutingNumber( $property['routing_number'] );
          $o_account->setSettlementSameAsFeeAccount( true );

          $o_merch_app->setAccount( o_account );

          $o_dba_address = new Address( Address::$XS_ADDRESS_NAME_DBA );
          $o_db_address->setLine1( $property['legal_street'] );
          $o_db_address->setCity( $property['legal_city'] );
          $o_db_address->setState( $stat_inc );					//** Should this be legal state??
          $o_db_address->setZipcode( $property['legal_zip'] );
          $o_db_address->setCountry( "USA" );

          $o_location = new Location();
          $o_location->setContactSameAsOwner( true );
          $o_location->setDescriptionOfProductsAndServices( "Property Management Services" ); 
          $o_location->setDBAAddress( $o_dba_address );
          $o_location->setIndustry( Location::$XS_Property_Management );
          $o_location->setDescription( Location::$XS_DESCRIPTION_CONSULTING );
  
 //         $o_cal = Calendar->getInstance();
 //         $o_cal->add( Calendar->YEAR, -2 );

 //         $o_year = $o_cal->getTime()
  
 //         $o_location->setEntityStartDate( $o_year );
          $o_location->setEntityState( $legal_state );					//** Should this be legal state??
          $o_location->setSalesAgentName( 'Sean Perlmutter' );				//** What should this be?
          $o_location->setProgramPricing( 'RentSquare' );					//** get field from operations
          $o_location->setProgramDetails( 'Program Details' );				//** get field from operations

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

 //         $o_cal = Calendar->getInstance();
 //         $o_cal.add( Calendar.YEAR, -60 );

 //         $o_bday = $o_cal->getTime();
 //         $o_contact->setBirthdate( $o_bday );			//** This should use $data['User']['dob'] in some way
          $o_contact->setAuthorizedUser( true );
          $o_contact->setAccountSigner( true );
          $o_contact->setOwnershipPercentage( 100 );
          $o_contact->setSSN( $data['User']['ssn'] );
          $o_contact->setIsPrimary( true );

          $o_location->addPrincipalContact( $o_contact );

          $o_bc_details = new BankCardDetails();
          $o_bc_details->setFeeOther( "ie Annual Fee collected in month 3" );	//** Not Sure If this is RIGHT
          $o_bc_details->setCurrentlyAcceptAmex( false );


/*
             //Patriot Act Requirements Field Names
             'Contact_FirstName'=>urlencode($data['User']['first_name']),
             'Contact_LastName'=>urlencode($data['User']['last_name']),
             'Contact_Title'=>urlencode('Property Manager'),
             'Contact_Email'=>urlencode($data['User']['email']),
             'Contact_Phone'=>urlencode($data['User']['phone']),
             'Contact_MobilePhone'=>urlencode($data['User']['phone']),
             'Contact_OtherStreet'=>urlencode($data['User']['street']),
             'Contact_OtherCity'=>urlencode($data['User']['city']),
             'Contact_OtherState'=>urlencode($home_state),
             'Contact_OtherPostalCode'=>urlencode($data['User']['zip']),
             'Contact_SSN__c'=>urlencode($data['User']['ssn']),
             'Contact_Birthdate'=>urlencode($data['User']['dob']),

             'Account_Website'=>urlencode('http://rentsquare.com'),
             'Account_DBA__c'=>urlencode($property['legal_dba']),
             'Contact_Phone'=>urlencode($property['legal_phone']),
             'Account_Customer_Service__c'=>urlencode($data['User']['phone']),
             'Account_ShippingStreet'=>urlencode("Same as Legal"),
             //Settlement Bank Information Field Name
             'Account_DDA_Account_Name__c'=>urlencode('Same As Legal Name'),
             'Account_DDA_Bank_Name__c'=>urlencode($property['bank_name']),
             'Account_DDA_Routing_Number__c'=>urlencode($property['routing_number']),
             'Account_DDA_Account_Number__c'=>urlencode($property['bank_acccount_num']),
          $fields = array(
             //Hidden Accont Control Field Names
             //'Account_Id'=>urlencode(''),
             'Account_Conga_Template_ID__c'=>urlencode('a0di00000008cuB'),
             'Account_Program_Pricing_c'=>urlencode('RentSquare'),

             //Bank Card Pricing Field Names (None Required)
             'Account_BC_Flat_Rate__c'=>urlencode('2.65'), //2.75 or 2.65

             //ACH Pricing Field Names (None Required)
             'Account_ACH_Transaction_Fee__c'=>urlencode('3.95'),

             //Legal Entity Information Field Names
             //'Account_Name'=>urlencode($property['legal_name'] . ' THIS IS A TEST'),
             'Account_Phone'=>urlencode($property['legal_phone']),
             'Account_Fax'=>urlencode($property['legal_fax']),
             'Account_Entity_Type__c'=>urlencode($ownership_type),
             'Account_Entity_State__c'=>urlencode($state_inc),
             'Account_Entity_Start_Date__c'=>urlencode('01/01/'.$property['business_started']),
             'Account_Entity_Length_of_Current_Ownership__c'=>urlencode($property['ownership_started']),
             'Account_EIN__c'=>urlencode($property['legal_ein']),
      

             //Merchant Location DBA Information Field Names
             //'Account_ShippingStreet'=>urlencode(),
             //'Account_ShippingCity'=>urlencode(),
             //'Account_ShippingState'=>urlencode(),
             //'Account_ShippingPostalCode'=>urlencode(),
             'Location_Contact__c'=>urlencode('true'),
  
             //Merchant Processing Profile Field Names
             'Account_Industry'=>urlencode('Property Management'),
             'Account_Return_Policy__c'=>urlencode('Full Refund'),
             'Return_Policy_Time_Period__c'=>urlencode('30'),
             'Account_Cardholder_Charged__c'=>urlencode('Purchase'),




             //Payment Acceptance Methods Field Names
             'Account_Accept_ACH__c'=>urlencode('true'),
             'Account_Accept_BC__c'=>urlencode('true'),
             'Account_Signature_Floor_Limit__c'=>urlencode('None'),
             'Account_Tip_Line__c'=>urlencode('false'),
             'Account_Batch_Time__c'=>urlencode('5:30 pm'),
             'Account_Auto_Batch_Time_Zone__c'=>urlencode('ET'),
             'Account_BC_Internet__c'=>urlencode('100'),
             'Account_Visa_MC_Signage__c'=>urlencode('true'),
             'Account_Prev_Term_as_a_Visa_MC_Merchant__c'=>urlencode('false'),

             //PCI Related Questions Field Names
             'Account_BC_Recurring__c'=>urlencode('true'),
             'Account_ACH_Recurring__c'=>urlencode('true'),
             'Account_Cardholder_Data_Stored_Locally__c'=>urlencode('false'),
             'Account_X3rd_Party_Access_to_Cardholder_Data__c'=>urlencode('false'),
             'Account_X3rd_Part_access_to_Cardholder_Data__c'=>urlencode('false'),

                   //Requested Brand & Processing Types Field Names
             'Bank_Card_Credit_Requested__c'=>urlencode('Visa Credit, MasterCard Credit, Discover Credit'),
             'Other_Brands_Requested__c'=>urlencode('none'),
             'Account_Accept_AMEX__c'=>urlencode('false'),
             //'Account_AMEX_Current_Number__c'=>urlencode(''),
             //'AMEX_Volume_Est__c'=>urlencode('false'),
             // 'AMEX_Cap_Number__c'=>urlencode(),

             //Visa, MasterCard, Discover Volume Estimates Field Names
             'Account_BC_Avg_Ticket__c'=>urlencode($property['average_rent']),
             'Account_BC_Max_Ticket__c'=>urlencode(floatval($property['average_rent'])*3),
             'Account_BC_Average_Monthly_Volume__c' => urlencode(floatval($property['num_units'])*floatval($property['average_rent'])),
             'Account_BC_Max_Volume__c'=> urlencode(floatval($property['num_units'])*floatval($property['average_rent'])*3),

             //ACH Processing Volume Estimates Field Names
             'Account_ACH_Average_Ticket_Amount__c'=>urlencode($property['average_rent']),
             'Account_ACH_Max_Single_TXN__c'=>urlencode(floatval($property['average_rent'])*3),
             'Account_ACH_Average_Monthly_Amount__c'=>urlencode(floatval($property['num_units'])*floatval($property['average_rent'])),
             'ACH_Max_Daily_Amount__c'=>urlencode(floatval($property['average_rent'])*$property['num_units']*3),

             //ACH Acceptance Methods Field Names
             'Account_ACH_Auth_Method_Online__c'=>urlencode('100'),

             //ACH Payment Entry Information Field Names
             'ACH_Company_Name__c'=>urlencode('Same_As_Legal'),
             'ACH_Descriptor__c'=>urlencode('RentSquare'),
             'ACH_Submission_Method__c'=>urlencode('Online'),
             'ACH_Merchant_Reports__c'=>urlencode('true'),
             'ACH_Pymt_URL__c'=>urlencode('http://rentsquare.com'),
             'ACH_Issue_Credits__c'=>urlencode('true'),
             'ACH_Issue_Debits__c'=>urlencode('true'),

             //POS Retail Terminal Questionnaire Field Names

             //Terminal Questionnaire Field Names

             //Internet Questionnaire Field Names
             'Fullfillment_Vendor_Utilized__c'=>urlencode('false'),
             'Percent_of_Sales_to_non_US_cardholders__c'=>urlencode('0'),
             //'Website_IP_Address__c'=>urlencode(),
             'Applicant_Owns_Web_Domain_and_Content__c'=>urlencode('1'),
             'Policies_Accessible_on_Website__c'=>urlencode('1'),
             //'Web_Host_Vendor_Name__c'=>urlencode(),
             //'SSL_Certificate_Issuer__c'=>urlencode(),
             //'SSL_Certificate_Number__c'=>urlencode(),
             //'SSL_Certificate_Type__c'=>urlencode(),
             //'Temp_Login_Credentials__c'=>urlencode(),

             //Fulfillment Vendor Questionnaire Field Names

             //Mail Order/ Telephone Order MOTO Questionnaire Field Names


           );

//debug($data);
//debug($fields);
//exit;

           //url-ify the data for the POST
           $fields_string = '';
           foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
           $fields_string = rtrim($fields_string,'&');
           //$fields_string = str_replace('-', '%2D', $fields_string);



           // parse_str($result);

           //$results[$i]['response'] = $response;
           //$results[$i]['message'] = $message;
           //$results[$i]['string'] = $fields_string;
*/
            
       } // end foreach

       return array( $status, $result, $approval_id );
    }
    
}
