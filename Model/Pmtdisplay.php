<?php

class Pmtdisplay extends AppModel {

    public $name = 'Pmtdisplay';
    public $useTable = false;
    //public $actsAs = array('Containable');
    //public $displayField = 'id';
    public $cacheQueries = true;
    public $_schema = array( 'id' =>array('type'=>'int', 'length'=>11), 
                             'unit_id' =>array('type'=>'int', 'length'=>11), 
                             'property_id' =>array('type'=>'int', 'length'=>11),
                             'rent_due' =>array('type'=>'float', 'length'=>'19,2','default'=>0.00),
                             'balance' =>array('type'=>'float', 'length'=>'19,2','default'=>0.00),
                             'status' =>array('type'=>'string', 'length'=>100),
                             'billing_start' =>array('type'=>'datetime', 'length'=>null),
                             'billing_end' =>array('type'=>'datetime', 'length'=>null),
                             'rent_period' =>array('type'=>'datetime', 'length'=>null),
                             'type' =>array('type'=>'string', 'length'=>15,'default'=>'Rent'),
                             'auto_late_fee' =>array('type'=>'tinyint', 'length'=>1,'default'=>0),
                             'created' =>array('type'=>'datetime', 'length'=>null),
                             'modified' =>array('type'=>'datetime', 'length'=>null)
                           );

}

?>
