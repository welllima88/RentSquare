<?php

class Unit extends AppModel {

    public $name = 'Unit';

    public $validate = array();

    public $actsAs = array('Containable');

    public $virtualFields = array('id_number' => 'CONCAT(Unit.id, "|", Unit.number)');

    public $belongsTo = array(
        'Property'  => array(
            'counterCache' => true
        ),
        'Frequency' => array(
            'foreignKey' => 'billing_frequency'
        )
    );
    public $hasMany = array(
        'Tenant'   => array(
            'className'  => 'User',
            'foreignKey' => 'unit_id'
        ),
        'UnitFee'  => array(
            'dependent'  => true,
            'foreignKey' => 'unit_id'
        ),
        'FreeRent' => array(
            'dependent'  => true,
            'foreignKey' => 'unit_id'
        ),
        'Billing',
        'FailedPayment'
        //'Payment'
    );

    function get($id, $uid)
    {
        $this->contain('Property', 'Tenant', 'UnitFee', 'FreeRent');
        $unit = $this->find('first', array('conditions' => array('Unit.id' => $id)));
        if ( isset($unit['Property']) && $unit['Property']['manager_id'] == $uid )
            return $unit;

        return false;
    }

    function belongsToProperty($id, $propId)
    {
        $this->id = $id;

        return $this->field('property_id') == $propId;
    }

    function findByNumber($number, $propId)
    {
        return $this->find('first', array('conditions' => array('Unit.number' => $number, 'Unit.property_id' => $propId)));
    }

    function findAllForProperty($propId, $options = array())
    {
        if ( !isset($options['conditions']) || !is_array($options['conditions']) )
            $options['conditions'] = array();

        $options['conditions']['Unit.property_id'] = $propId;

        return $this->find('all', $options);
    }

    function findAllForPropertyContain($propId, $options = array())
    {
        if ( !isset($options['conditions']) || !is_array($options['conditions']) )
            $options['conditions'] = array();

        $options['conditions']['Unit.property_id'] = $propId;
        $this->recursive = - 1;

        return $this->find('all', $options);
    }

    /*
function delete($id, $cascade = false){
        parent::delete($id, $cascade);
         $id_int = intval($id);
        ClassRegistry::init('User')->updateAll(array('unit_id' => 0), array('unit_id' => $id_int));
    }
*/

    public function afterFind($results, $primary = false)
    {
        if ( !empty($results) )
        {
            foreach ( $results as $key => $val )
            {
                if ( is_array($val) )
                {
                    if ( isset($val['Unit']['lease_start']) )
                    {
                        $results[ $key ]['Unit']['lease_start'] = $this->dateFormatAfterFind($val['Unit']['lease_start']);
                    }
                    if ( isset($val['Unit']['prev_lease_start']) )
                    {
                        $results[ $key ]['Unit']['prev_lease_start'] = $this->dateFormatAfterFind($val['Unit']['prev_lease_start']);
                    }
                    if ( isset($val['Unit']['lease_end']) )
                    {
                        $results[ $key ]['Unit']['lease_end'] = $this->dateFormatAfterFind($val['Unit']['lease_end']);
                    }
                    if ( isset($val['Unit']['rent_start']) )
                    {
                        $results[ $key ]['Unit']['rent_start'] = $this->dateFormatAfterFind($val['Unit']['rent_start']);
                    }
                    if ( isset($val['Unit']['yearly_date']) )
                    {
                        $results[ $key ]['Unit']['yearly_date'] = $this->dateFormatAfterFind($val['Unit']['yearly_date']);
                    }
                    if ( isset($val['Unit']['current_due_date']) )
                    {
                        $results[ $key ]['Unit']['current_due_date'] = $this->dateFormatAfterFind($val['Unit']['current_due_date']);
                    }
                    if ( isset($val['Unit']['yearly_date']) )
                    {
                        $results[ $key ]['Unit']['yearly_date'] = $this->dateFormatAfterFind($val['Unit']['yearly_date']);
                    }
                }
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
        if ( !empty($this->data['Unit']['lease_start']) )
        {
            $this->data['Unit']['lease_start'] = $this->dateFormatBeforeSave($this->data['Unit']['lease_start']);
        }
        if ( !empty($this->data['Unit']['prev_lease_start']) )
        {
            $this->data['Unit']['prev_lease_start'] = $this->dateFormatBeforeSave($this->data['Unit']['prev_lease_start']);
        }
        if ( !empty($this->data['Unit']['lease_end']) )
        {
            $this->data['Unit']['lease_end'] = $this->dateFormatBeforeSave($this->data['Unit']['lease_end']);
        }
        if ( !empty($this->data['Unit']['rent_start']) )
        {
            $this->data['Unit']['rent_start'] = $this->dateFormatBeforeSave($this->data['Unit']['rent_start']);
        }
        if ( !empty($this->data['Unit']['yearly_date']) )
        {
            $this->data['Unit']['yearly_date'] = $this->dateFormatBeforeSave($this->data['Unit']['yearly_date']);
        }
        if ( !empty($this->data['Unit']['current_due_date']) )
        {
            $this->data['Unit']['current_due_date'] = $this->dateFormatBeforeSave($this->data['Unit']['current_due_date']);
        }
        if ( !empty($this->data['Unit']['yearly_date']) )
        {
            $this->data['Unit']['yearly_date'] = $this->dateFormatBeforeSave($this->data['Unit']['yearly_date']);
        }

        return true;
    }

    public function dateFormatBeforeSave($dateString)
    {
        return date('Y-m-d', strtotime($dateString));
    }


    /* Function: set_current_due_date
     *
     * Set the next rent due date
     * Passes in Unit Data and returns date value of next rent due
     */

    public function set_current_due_date($data)
    {
        switch ( $data['Unit']['billing_frequency'] )
        {
            case '1':
                //daily
                //set current due date equal to today plus one if lease start day is in past
                if ( strtotime($data['Unit']['lease_start']) < time() )
                    return date('Y-m-d', strtotime("+1 day"));

                //set current due date equal to lease start if lease start is greater than today
                return $data['Unit']['lease_start'];
                break;
            case '2':
                //weekly
                if ( strtotime($data['Unit']['lease_start']) < time() )
                    $lease_start = time();
                else
                    $lease_start = strtotime($data['Unit']['lease_start']);

                $day_of_week = date('w', $lease_start);
                if ( $day_of_week == $data['Unit']['weekly_day'] )
                    return date('Y-m-d', $lease_start);

                //set current due date equal to first occurance of next weekday
                switch ( $data['Unit']['weekly_day'] )
                {
                    case '1':
                        //Monday
                        return date("Y-m-d H:i:s", strtotime('next Monday', $lease_start));
                        break;
                    case '2':
                        //Tuesday
                        return date("Y-m-d H:i:s", strtotime('next Tuesday', $lease_start));
                        break;
                    case '3':
                        //Wednesday
                        return date("Y-m-d H:i:s", strtotime('next Wednesday', $lease_start));
                        break;
                    case '4':
                        //Thursday
                        return date("Y-m-d H:i:s", strtotime('next Thursday', $lease_start));
                        break;
                    case '5':
                        //Friday
                        return date("Y-m-d H:i:s", strtotime('next Friday', $lease_start));
                        break;
                    case '6':
                        //Saturday
                        return date("Y-m-d H:i:s", strtotime('next Saturday', $lease_start));
                        break;
                    case '0':
                        //Sunday
                        return date("Y-m-d H:i:s", strtotime('next Sunday', $lease_start));
                        break;
                }
                break;
            case '3':
                //twice a month
                if ( strtotime($data['Unit']['lease_start']) < time() )
                    $lease_start = time();
                else
                    $lease_start = strtotime($data['Unit']['lease_start']);
                $date_of_month = date('d', $lease_start);

                if ( (int) $date_of_month == 1 || (int) $date_of_month == 15 )
                {
                    //If day is first of month, return that day
                    return date("Y-m-d", $lease_start);
                } else if ( (int) $date_of_month > 14 )
                {
                    //If day of month is >14 then set to first of next month
                    return date("Y-m-01", mktime(0, 0, 0, date("m", $lease_start) + 1, 1, date("Y", $lease_start)));
                } else
                {
                    //If day of month is <14 then set to first of this month
                    return date("Y-m-15", $lease_start);
                }

                break;
            case '4':
                //monthly
                if ( strtotime($data['Unit']['lease_start']) < time() )
                    $lease_start = time();
                else
                    $lease_start = strtotime($data['Unit']['lease_start']);
                $date_of_lease_start = date('j', $lease_start);

                $day_of_rent_due = $data['Unit']['monthly_day'] + 1;

                if ( $day_of_rent_due == '29' )
                {
                    return date("Y-m-d", mktime(0, 0, 0, date("m", $lease_start), date("t", $lease_start), date("Y", $lease_start)));
                } else if ( (int) $date_of_lease_start == (int) $day_of_rent_due )
                {
                    return date("Y-m-d", $lease_start);
                } else if ( $day_of_rent_due < $date_of_lease_start )
                {
                    //if day rent due < lease start
                    //rent due next month on day_rent_due
                    return date("Y-m-d", mktime(0, 0, 0, date("m", $lease_start) + 1, $day_of_rent_due, date("Y", $lease_start)));
                } else
                {
                    //if day rent due >= lease start
                    //rent due day_rent_due
                    return date("Y-m-d", mktime(0, 0, 0, date("m", $lease_start), $day_of_rent_due, date("Y", $lease_start)));
                }
                break;
            case '5':
                //quarterly (every 3 months)
                return $data['Unit']['yearly_date'];

                break;
            case '6':
                //semi-annually (every 6 months)
                return $data['Unit']['yearly_date'];

                break;
            case '7':
                //anually
                return $data['Unit']['yearly_date'];

                break;
            default:
                //do nothing
                break;

        }
    }

    public function getRentTotal($unit_id, $billing_start, $billing_end)
    {
        //Calculate Rent Due = Rent Total + Recurring Fee - Free Rent
        //		ACH => Rent Total + recurring fee - free rent + fee $3.95 (fee only if tenant paying fees)
        //		CC/Debit - Rent Total + recurring fee - free rent + fee  2.75% (fee only if tenant percent)
        $allFees = array();
        $unit = $this->find('first', array('conditions' => array('Unit.id' => $unit_id)));
        $base_rent = floatval($unit['Unit']['rent']);

        //Setup return Array
        //  - ['Rent']['Total']
        //  - ['BillingFee']
        $allFees['BillingFee'][0]['name'] = 'Base Rent';
        $allFees['BillingFee'][0]['amount'] = $base_rent;
        $i = 1;
        //Loop through each Unit Fee
        foreach ( $unit['UnitFee'] as $unitfee ):
            if ( $unitfee['one_time'] == 0 )
            {
                $base_rent = $base_rent + floatval($unitfee['amount']);
                $allFees['BillingFee'][ $i ]['name'] = 'Recurring Fee - ' . $unitfee['name'];
                $allFees['BillingFee'][ $i ]['amount'] = floatval($unitfee['amount']);
            }
            $i ++;
        endforeach;
        //Free Rent
        foreach ( $unit['FreeRent'] as $free_rent ):
            if ( date("Y-m-d", strtotime($free_rent['billing_start'])) ==
                date("Y-m-d", strtotime($billing_start)) &&
                date("Y-m-d", strtotime($free_rent['billing_end'])) ==
                date("Y-m-d", strtotime($billing_end))
            )
            {
                $base_rent = $base_rent - floatval($free_rent['amount']);
                $allFees['BillingFee'][ $i ]['name'] = 'Free Rent';
                $allFees['BillingFee'][ $i ]['amount'] = floatval($free_rent['amount']);
                $i ++;
            }
        endforeach;
        $allFees['Rent']['Total'] = $base_rent;

        return $allFees;
    }

    /* function: set_billing_end_date
     *
     * Set the billing end date when input is unit array with billing frequency
     * and current start billing date
     */
    public function set_billing_end_date($billing_frequency, $current_due_date, $monthly_day)
    {
        switch ( $billing_frequency )
        {
            case '1':
                //daily
                //set billing end to next day
                return date("Y-m-d H:i:s", strtotime($current_due_date . ' + 1 day'));
                break;
            case '2':
                //weekly
                return date("Y-m-d H:i:s", strtotime($current_due_date . ' + 7 day'));
                break;
            case '3':
                //twice a month
                $current_due_dt = strtotime($current_due_date);
                $date_of_month = date('d', $current_due_dt);

                if ( (int) $date_of_month == 1 )
                {
                    return date("Y-m-15", $current_due_dt);
                }
                if ( (int) $date_of_month == 15 )
                {
                    return date("Y-m-01", mktime(0, 0, 0, date("m", $current_due_dt) + 1, 1, date("Y", $current_due_dt)));
                }

                break;
            case '4':
                //monthly
                $current_due_dt = strtotime($current_due_date);
                $day_of_rent_due = $monthly_day + 1;

                return date("Y-m-d", mktime(0, 0, 0, date("m", $current_due_dt) + 1, $day_of_rent_due, date("Y", $current_due_dt)));
                break;
            case '5':
                //quarterly (every 3 months)
                $current_due_dt = strtotime($current_due_date);

                return date("Y-m-d", mktime(0, 0, 0, date("m", $current_due_dt) + 3, date('j', $current_due_dt), date("Y", $current_due_dt)));

                break;
            case '6':
                //semi-annually (every 6 months)
                $current_due_dt = strtotime($current_due_date);

                return date("Y-m-d", mktime(0, 0, 0, date("m", $current_due_dt) + 6, date('j', $current_due_dt), date("Y", $current_due_dt)));

                break;
            case '7':
                //anually
                $current_due_dt = strtotime($current_due_date);

                return date("Y-m-d", mktime(0, 0, 0, date("m", $current_due_dt), date('j', $current_due_dt), date("Y", $current_due_dt) + 1));

                break;
            default:
                //do nothing
                break;

        }
    }

    /* Adds a credit to Unit if resident paid over amount due */
    public function creditUnit($unit_id, $amount)
    {
        $this->id = $unit_id;
        if ( $this->updateAll(
            array('Unit.rent_credit' => 'Unit.rent_credit + ' . $amount),
            array('Unit.id' => $unit_id)
        )
        )
            return true;
        else
            return false;
    }


}

;