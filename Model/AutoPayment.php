<?php
App::uses('AppModel', 'Model');

/**
 * AutoPayment Model
 *
 * @property User $User
 * @property PaymentMethod $PaymentMethod
 */
class AutoPayment extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'user_id'           => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'payment_method_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'active'            => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'start_date'        => array(
            'datetime' => array(
                'rule' => array('datetime'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'end_date'          => array(
            'datetime' => array(
                'rule' => array('datetime'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className'  => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        )
    );

    public function afterFind($results, $primary = false)
    {
        foreach ( $results as $key => $val )
        {
            if ( isset($val['AutoPayment']['auto_start']) )
            {
                $results[ $key ]['AutoPayment']['auto_start'] = $this->dateFormatAfterFind($val['AutoPayment']['auto_start']);
            }
            if ( isset($val['AutoPayment']['auto_end']) )
            {
                $results[ $key ]['AutoPayment']['auto_end'] = $this->dateFormatAfterFind($val['AutoPayment']['auto_end']);
            }
        }

        return $results;
    }

    public function dateFormatAfterFind($dateString)
    {
        return date('m/d/Y', strtotime($dateString));
    }

    public function beforeSave($options = array())
    {
        if ( !empty($this->data['AutoPayment']['auto_start']) )
        {
            $this->data['AutoPayment']['auto_start'] = $this->dateFormatBeforeSave($this->data['AutoPayment']['auto_start']);
        }
        if ( !empty($this->data['AutoPayment']['auto_end']) )
        {
            $this->data['AutoPayment']['auto_end'] = $this->dateFormatBeforeSave($this->data['AutoPayment']['auto_end']);
        }

        return true;
    }

    public function dateFormatBeforeSave($dateString)
    {
        return date('Y-m-d', strtotime($dateString));
    }


}
