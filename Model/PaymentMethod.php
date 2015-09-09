<?php
App::uses('AppModel', 'Model');

/**
 * PaymentMethod Model
 *
 * @property BillingState $BillingState
 * @property User $User
 * @property user $User
 */
class PaymentMethod extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'type';
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'id'               => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'type'             => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
/*
        'first_name'       => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'last_name'        => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
*/
        'card_number'      => array(
            'cc'       => array(
                'rule'    => array('cc'),
                'message' => 'Please enter a valid Credit Card number',
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'expire_dt_month'  => array(
            'numeric'  => array(
                'rule' => array('numeric'),
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'expire_dt_day'    => array(
            'numeric'  => array(
                'rule' => array('numeric'),
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'security_code'    => array(
            'numeric'  => array(
                'rule' => array('numeric'),
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'billing_address1' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'billing_city'     => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'billing_state_id' => array(
            'numeric'  => array(
                'rule' => array('numeric'),
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'billing_zip'      => array(
            'numeric'  => array(
                'rule' => array('numeric'),
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'bank_name'        => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'account_number'   => array(
            'numeric'  => array(
                'rule' => array('numeric'),
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'routing_number'   => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'bank_acct_type'   => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'default_method'   => array(
            'boolean' => array(
                'rule' => array('boolean'),
            ),
        ),
        'recurring'        => array(
            'boolean' => array(
                'rule' => array('boolean'),
            ),
        ),
        'user_id'          => array(
            'numeric'  => array(
                'rule' => array('numeric'),
            ),
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     */


    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'States' => array(
            'className'  => 'States',
            'foreignKey' => 'billing_state_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        ),
        'User'   => array(
            'className'  => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        )
    );

    /*
    * getRsqVaultId
    * function to get BaseCommerce vault_id for RentSquare admin user  - only 1 user of type 2
    * returns array with status, and vault_id (if successful)
    */
    function getRsqVaultId()
    {
        $pm = $this->find('first', array( 'conditions' => array( 'PaymentMethod.default_method' => '1', 'User.type' => '2')));
 
        if ( ! isset( $pm['PaymentMethod']['vault_id'] ) || empty( $pm['PaymentMethod']['vault_id'] ) ) 
        {
           $return_values['status'] = 0; 
           $return_values['vault_id'] = 0;
        }
        else
        {
           $return_values['status'] = 1; 
           $return_values['vault_id'] = $pm['PaymentMethod']['vault_id'];
        }

        return $return_values;
    }
}
