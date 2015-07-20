<?php

class Property extends AppModel {

    var $name = 'Property';
    var $actsAs = array('Containable');

    var $belongsTo = array(
        'Manager' => array(
            'className'  => 'User',
            'foreignKey' => 'manager_id'
        ),
        'State'
    );

    var $hasMany = array(
        'Unit',
        'Tenant'       => array(
            'className' => 'User'
        ),
        'QueuedTenant' => array(
            'className'  => 'User',
            'conditions' => array('unit_id' => null)
        )
    );

    var $virtualFields = array(
        'displayName' => 'COALESCE(name, address)'
    );

    function get($id, $uid = null)
    {
        $options['conditions']['Property.id'] = $id;
        if ( $uid )
            $options['conditions']['Property.manager_id'] = $uid;

        return $this->find('first', $options);
    }

    function getManaged($uid)
    {
        return $this->find('all', array('conditions' => array('Property.manager_id' => $uid, 'active' => 1)));
    }

}

;

?>