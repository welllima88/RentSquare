<?php

class UnitFee extends AppModel {

    public $name = 'UnitFee';

    public $validate = array();

    public $belongsTo = array(
        'Unit' => array(
            'className'  => 'Unit',
            'foreignKey' => 'unit_id'
        )
    );


    public function beforeSave($options = array())
    {
        if ( !empty($this->data['UnitFee']['one_time_date']) )
        {
            $this->data['UnitFee']['one_time_date'] = $this->dateFormatBeforeSaveUnitFee($this->data['UnitFee']['one_time_date']);
        }

        return true;
    }

    public function dateFormatBeforeSaveUnitFee($dateString)
    {
        return date('Y-m-d', strtotime($dateString));
    }


    public function afterFind($results, $primary = false)
    {
        foreach ( $results as $key => $val )
        {
            if ( isset($val['UnitFee']['one_time_date']) )
            {
                $results[ $key ]['UnitFee']['one_time_date'] = $this->dateFormatAfterFind($val['UnitFee']['one_time_date']);
            }
        }

        return $results;
    }

    public function dateFormatAfterFind($dateString)
    {
        return date('m/d/Y', strtotime($dateString));
    }

}