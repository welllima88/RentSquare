<?php 

class State extends AppModel{
  
  public $name = 'State';
  
  public $hasMany = array(
        'Property',
        'User',
        //'Manager' => array(
        //  'foreignKey' => 'state_id'
        //),
    );

}