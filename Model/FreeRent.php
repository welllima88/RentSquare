<?php 

class FreeRent extends AppModel{
  
  public $name = 'FreeRent';
    	  
  public $validate = array();
  
  public $belongsTo = array(
        'UnitFreeRent' => array(
            'className'    => 'Unit',
            'foreignKey'   => 'unit_id'
        )
  );
  
  public function beforeSave($options = array()) {      
      if(!empty($this->data['FreeRent']['billing_start'])){
          $this->data['FreeRent']['billing_start'] = $this->dateFormatBeforeSaveFreeRent($this->data['FreeRent']['billing_start']);
      }
      if(!empty($this->data['FreeRent']['billing_end'])){
          $this->data['FreeRent']['billing_end'] = $this->dateFormatBeforeSaveFreeRent($this->data['FreeRent']['billing_end']);
      }

      return true;
  }
  
  public function afterFind($results, $primary = false) {
    foreach ($results as $key => $val) {
        if (isset($val['FreeRent']['billing_start'])) {
            $results[$key]['FreeRent']['billing_start'] = $this->dateFormatAfterFindFreeRent($val['FreeRent']['billing_start']);
        }
        if (isset($val['FreeRent']['billing_end'])) {
            $results[$key]['FreeRent']['billing_end'] = $this->dateFormatAfterFindFreeRent($val['FreeRent']['billing_end']);
        }
    }

    return $results;
  }


  private function dateFormatBeforeSaveFreeRent($dateString) {
    return date('Y-m-d', strtotime($dateString));
  }
  public function dateFormatAfterFindFreeRent($dateString) {
      return date('m/d/Y', strtotime($dateString));
  }

}