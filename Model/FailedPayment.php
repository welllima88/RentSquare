<?php
App::uses('AppModel', 'Model');

/**
 * FailedPayment Model
 *
 * @property Billing $Billing
 * @property Unit $Unit
 * @property User $User
 */
class FailedPayment extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Billing' => array(
            'className'  => 'Billing',
            'foreignKey' => 'billing_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        ),
        'Unit'    => array(
            'className'  => 'Unit',
            'foreignKey' => 'unit_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        ),
        'User'    => array(
            'className'  => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        )
    );
}
