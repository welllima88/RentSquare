<?php

class User extends AppModel {

    var $name = 'User';
    var $primaryKey = 'id';

    var $actsAs = array('Containable');

    var $hasMany = array(
        'Property' => array(
            'foreignKey' => 'manager_id'
        ),
        'ConversationsUser',
        'PaymentMethod',
        'Payment',
        'FailedPayment',
        'Note',
        'AutoPayment'
        //'PaymentDetails'
    );

    var $belongsTo = array('Unit', 'Property', 'State');
    //var $hasAndBelongsToMany = array('Conversation');

    var $validate = array(
        'first_name'     => array(
            'alphaNumeric' => array(
                'rule'       => 'alphaNumeric',
                'message'    => 'Please enter your First Name',
                'required'   => true,
                'allowEmpty' => false
            )
        ),
        'last_name'      => array(
            'alphaNumeric' => array(
                'rule'       => 'alphaNumeric',
                'message'    => 'Please enter your Last Name',
                'required'   => true,
                'allowEmpty' => false
            )
        ),
        'email'          => array(
            'isUnique' => array(
                'rule'    => 'isUnique',
                'message' => 'Sorry, this email already exists',
                'on'      => 'create'
            ),
            'notEmpty' => array(
                'rule'       => 'notEmpty',
                'required'   => true,
                'allowEmpty' => false,
                'message'    => 'Please enter a valid email address'
            )
        ),
        //'confirm_email' => array(
        //	'rule' => 'confirmEmail',
        //	'message' => 'Your email addresses do not match'
        //	),
        'password_orig'  => array(
            'length' => array(
                'rule'    => array('minLength', 7),
                'message' => 'Must be at least 7 characters long'
            )//,
            //'confirm_check' => array(
            //	'rule' => 'confirmPassword',
            //	'message' => 'Your passwords do not match'
            //	)
        ),
        'street'         => array(
            'rule'    => 'notEmpty',
            'message' => 'Please enter a Home Address'
        ),
        'city'           => array(
            'rule'    => 'notEmpty',
            'message' => 'Please enter a City'
        ),
        'state'          => array(
            'rule'    => 'notEmpty',
            'message' => 'Please enter a State'
        ),
        'zip'            => array(
            'numeric' => array(
                'rule'    => 'numeric',
                'message' => 'Zip code can contain only numeric values'
            ),
            'length'  => array(
                'rule'    => array('between', 5, 5),
                'message' => 'Zip code must be 5 digits long'
            )
        ),
        'company_name'   => array(
            'noEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Please enter your Company Name'
            ),
            'length'  => array(
                'rule'    => array('minLength', 3),
                'message' => 'Must be at least 3 characters long'
            )
        ),
        'phone'          => array(
            'noEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Please enter a Phone Number'
            ),
            'length'  => array(
                'rule'    => array('between', 10, 25),
                'message' => 'Phone number must be at least 10 digits long (Max 25)'
            ),
            'phone'   => array(
                'rule'    => array('phone', null, 'us'),
                'message' => 'Please enter a valid phone number'
            )
        ),
        'requested_unit' => array(
            'noEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => ''
            )
        )
    );


    function addToUnit($id, $propId, $unitId)
    {
        $user = $this->find('first', array('conditions' => array('User.id' => $id, 'User.property_id' => $propId)));
        $user['User']['unit_id'] = $unitId;
        if ( $this->save($user) )
            return true;

        return false;
    }

    function removeFromUnit($id, $propId)
    {
        $user = $this->find('first', array('conditions' => array('User.id' => $id, 'User.property_id' => $propId)));
        $user['User']['unit_id'] = null;
        if ( $this->save($user) )
            return true;

        return false;
    }

    function updateUnitOccupied($unit_id = null)
    {
        if ( $unit_id )
        {
            $resident_count = $this->find('count', array(
                'conditions' => array('User.unit_id' => $unit_id)
            ));
            $this->Unit->id = $unit_id;
            if ( $resident_count == 0 )
            {
                $this->Unit->saveField('occupied', 'No');
            } else
            {
                $this->Unit->saveField('occupied', 'Yes');
            }
        }
    }

    function unassignAllResidents($property_id, $unit_id)
    {
        $this->updateAll(array(
            'User.property_id' => 0,
            'User.unit_id'     => 0
        ), array(
            'User.property_id' => $property_id,
            'User.unit_id'     => $unit_id
        ));
    }


    function get($id)
    {
        return $this->find('first', array('conditions' => array('User.id' => $id)));
    }

    function findByUsername($name)
    {
        return $this->find('first', array('conditions' => array('User.username' => $name)));
    }

    function findQueuedForProperty($propId, $options = array())
    {
        if ( !isset($options['conditions']) || !is_array($options['conditions']) )
            $options['conditions'] = array();

        $options['conditions']['User.property_id'] = $propId;
        $options['conditions']['User.unit_id'] = 0;

        return $this->find('all', $options);
    }

    function hashPassword($pass)
    {
        return AuthComponent::password($pass);
    }

    function confirmEmail()
    {
        return ($this->data['User']['email'] == $this->data['User']['confirm_email']);
    }

    function confirmPassword()
    {
        return ($this->data['User']['confirm_password'] == $this->data['User']['password_orig']);
        //return ($this->hashPassword($this->data['User']['confirm_password']) == $this->data['User']['password']);
    }

    function genActivationHash()
    {
        return Security::hash(Configure::read('Security.salt') . time());
    }

    function submitPPApplication($data)
    {
        $errors = array();
        $results = array();
        $i = 0;

        //Setup variables to send to Phoenix Payments
        foreach ( $data['Property'] as $property ):
            //set POST variables
            $legal_state = $this->State->findById($property['legal_state_id']);
            $legal_state = $legal_state['State']['abbr'];
            $state_inc = $this->State->findById($property['state_inc']);
            $state_inc = $state_inc['State']['abbr'];
            $home_state = $this->State->findById($data['User']['state_id']);
            $home_state = $home_state['State']['abbr'];
            switch ( $property['ownership_type'] )
            {
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


            $url = 'https://api.phoenixpayments.com/pcms/?f=submitApplication';
            $fields = array(

                //'apikey' => urlencode('4502c3cef05dbf1dd8d017664646d6c6'),
                'key'                                             => urlencode('4502c3cef05dbf1dd8d017664646d6c6'),

                //Hidden Accont Control Field Names
                //'Account_Id'=>urlencode(''),
                'Account_Conga_Template_ID__c'                    => urlencode('a0di00000008cuB'),
                'Account_Program_Pricing_c'                       => urlencode('RentSquare'),

                //Bank Card Pricing Field Names (None Required)
                'Account_BC_Flat_Rate__c'                         => urlencode('2.65'), //2.75 or 2.65

                //ACH Pricing Field Names (None Required)
                'Account_ACH_Transaction_Fee__c'                  => urlencode('3.95'),

                //Legal Entity Information Field Names
                //'Account_Name'=>urlencode($property['legal_name'] . ' THIS IS A TEST'),
                'Account_Name'                                    => urlencode($property['legal_name']),
                'Account_BillingStreet'                           => urlencode($property['legal_street']),
                'Account_BillingCity'                             => urlencode($property['legal_city']),
                'Account_BillingState'                            => urlencode($legal_state),
                'Account_BillingPostalCode'                       => urlencode($property['legal_zip']),
                'Account_Phone'                                   => urlencode($property['legal_phone']),
                'Account_Fax'                                     => urlencode($property['legal_fax']),
                'Account_Entity_Type__c'                          => urlencode($ownership_type),
                'Account_Entity_State__c'                         => urlencode($state_inc),
                'Account_Entity_Start_Date__c'                    => urlencode('01/01/' . $property['business_started']),
                'Account_Entity_Length_of_Current_Ownership__c'   => urlencode($property['ownership_started']),
                'Account_EIN__c'                                  => urlencode($property['legal_ein']),

                //Patriot Act Requirements Field Names
                'Contact_FirstName'                               => urlencode($data['User']['first_name']),
                'Contact_LastName'                                => urlencode($data['User']['last_name']),
                'Contact_Title'                                   => urlencode('Property Manager'),
                'Contact_Email'                                   => urlencode($data['User']['email']),
                'Contact_Phone'                                   => urlencode($data['User']['phone']),
                'Contact_MobilePhone'                             => urlencode($data['User']['phone']),
                'Contact_OtherStreet'                             => urlencode($data['User']['street']),
                'Contact_OtherCity'                               => urlencode($data['User']['city']),
                'Contact_OtherState'                              => urlencode($home_state),
                'Contact_OtherPostalCode'                         => urlencode($data['User']['zip']),
                'Contact_SSN__c'                                  => urlencode($data['User']['ssn']),
                'Contact_Birthdate'                               => urlencode($data['User']['dob']),

                //Merchant Location DBA Information Field Names
                'Account_Website'                                 => urlencode('http://rentsquare.com'),
                'Account_DBA__c'                                  => urlencode($property['legal_dba']),
                'Contact_Phone'                                   => urlencode($property['legal_phone']),
                'Account_Customer_Service__c'                     => urlencode($data['User']['phone']),
                'Account_ShippingStreet'                          => urlencode("Same as Legal"),
                /*
                'Account_ShippingStreet'=>urlencode(),
                'Account_ShippingCity'=>urlencode(),
                'Account_ShippingState'=>urlencode(),
                'Account_ShippingPostalCode'=>urlencode(),
                */
                'Location_Contact__c'                             => urlencode('true'),


                //Merchant Processing Profile Field Names
                'Account_Industry'                                => urlencode('Property Management'),
                'Account_Return_Policy__c'                        => urlencode('Full Refund'),
                'Return_Policy_Time_Period__c'                    => urlencode('30'),
                'Account_Cardholder_Charged__c'                   => urlencode('Purchase'),


                //Settlement Bank Information Field Name
                'Account_DDA_Account_Name__c'                     => urlencode('Same As Legal Name'),
                'Account_DDA_Bank_Name__c'                        => urlencode($property['bank_name']),
                'Account_DDA_Routing_Number__c'                   => urlencode($property['routing_number']),
                'Account_DDA_Account_Number__c'                   => urlencode($property['bank_acccount_num']),


                //Payment Acceptance Methods Field Names
                'Account_Accept_ACH__c'                           => urlencode('true'),
                'Account_Accept_BC__c'                            => urlencode('true'),
                'Account_Signature_Floor_Limit__c'                => urlencode('None'),
                'Account_Tip_Line__c'                             => urlencode('false'),
                'Account_Batch_Time__c'                           => urlencode('5:30 pm'),
                'Account_Auto_Batch_Time_Zone__c'                 => urlencode('ET'),
                'Account_BC_Internet__c'                          => urlencode('100'),
                'Account_Visa_MC_Signage__c'                      => urlencode('true'),
                'Account_Prev_Term_as_a_Visa_MC_Merchant__c'      => urlencode('false'),

                //PCI Related Questions Field Names
                'Account_BC_Recurring__c'                         => urlencode('true'),
                'Account_ACH_Recurring__c'                        => urlencode('true'),
                'Account_Cardholder_Data_Stored_Locally__c'       => urlencode('false'),
                'Account_X3rd_Party_Access_to_Cardholder_Data__c' => urlencode('false'),
                'Account_X3rd_Part_access_to_Cardholder_Data__c'  => urlencode('false'),

                //Requested Brand & Processing Types Field Names
                'Bank_Card_Credit_Requested__c'                   => urlencode('Visa Credit, MasterCard Credit, Discover Credit'),
                'Other_Brands_Requested__c'                       => urlencode('none'),
                'Account_Accept_AMEX__c'                          => urlencode('false'),
                //'Account_AMEX_Current_Number__c'=>urlencode(''),
                //'AMEX_Volume_Est__c'=>urlencode('false'),
                // 'AMEX_Cap_Number__c'=>urlencode(),

                //Visa, MasterCard, Discover Volume Estimates Field Names
                'Account_BC_Avg_Ticket__c'                        => urlencode($property['average_rent']),
                'Account_BC_Max_Ticket__c'                        => urlencode(floatval($property['average_rent']) * 3),
                'Account_BC_Average_Monthly_Volume__c'            => urlencode(floatval($property['num_units']) * floatval($property['average_rent'])),
                'Account_BC_Max_Volume__c'                        => urlencode(floatval($property['num_units']) * floatval($property['average_rent']) * 3),

                //ACH Processing Volume Estimates Field Names
                'Account_ACH_Average_Ticket_Amount__c'            => urlencode($property['average_rent']),
                'Account_ACH_Max_Single_TXN__c'                   => urlencode(floatval($property['average_rent']) * 3),
                'Account_ACH_Average_Monthly_Amount__c'           => urlencode(floatval($property['num_units']) * floatval($property['average_rent'])),
                'ACH_Max_Daily_Amount__c'                         => urlencode(floatval($property['average_rent']) * $property['num_units'] * 3),

                //ACH Acceptance Methods Field Names
                'Account_ACH_Auth_Method_Online__c'               => urlencode('100'),

                //ACH Payment Entry Information Field Names
                'ACH_Company_Name__c'                             => urlencode('Same_As_Legal'),
                'ACH_Descriptor__c'                               => urlencode('RentSquare'),
                'ACH_Submission_Method__c'                        => urlencode('Online'),
                'ACH_Merchant_Reports__c'                         => urlencode('true'),
                'ACH_Pymt_URL__c'                                 => urlencode('http://rentsquare.com'),
                'ACH_Issue_Credits__c'                            => urlencode('true'),
                'ACH_Issue_Debits__c'                             => urlencode('true'),

                //POS Retail Terminal Questionnaire Field Names

                //Terminal Questionnaire Field Names

                //Internet Questionnaire Field Names
                'Fullfillment_Vendor_Utilized__c'                 => urlencode('false'),
                'Percent_of_Sales_to_non_US_cardholders__c'       => urlencode('0'),
                /*'Website_IP_Address__c'=>urlencode(),*/
                'Applicant_Owns_Web_Domain_and_Content__c'        => urlencode('1'),
                'Policies_Accessible_on_Website__c'               => urlencode('1'),
                /*'Web_Host_Vendor_Name__c'=>urlencode(),
                'SSL_Certificate_Issuer__c'=>urlencode(),
                'SSL_Certificate_Number__c'=>urlencode(),
                'SSL_Certificate_Type__c'=>urlencode(),
                'Temp_Login_Credentials__c'=>urlencode(),*/

                //Fulfillment Vendor Questionnaire Field Names

                //Mail Order/ Telephone Order MOTO Questionnaire Field Names


            );

//debug($data);
//debug($fields);
//exit;

            //url-ify the data for the POST
            $fields_string = '';
            foreach ( $fields as $key => $value )
            {
                $fields_string .= $key . '=' . $value . '&';
            }
            $fields_string = rtrim($fields_string, '&');
            //$fields_string = str_replace('-', '%2D', $fields_string);

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


            //execute post
            $result = curl_exec($ch);

            parse_str($result);

            $results[ $i ]['response'] = $response;
            $results[ $i ]['message'] = $message;
            $results[ $i ]['string'] = $fields_string;

            if ( curl_errno($ch) )
                $errors[ $i ] = curl_error($ch);

            curl_close($ch);

            $i ++;
            //$this->set('pp_error', '<div style="background:#fff; padding: 30px;">url: '.$url.'<br><br>result: '.$result.'<br><br>fields: '.$fields_string.'</div>');
        endforeach;

        //debug($errors);

        return $results;
    }


}
