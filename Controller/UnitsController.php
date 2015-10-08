<?php
App::uses('CakeEmail', 'Network/Email');
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');

class UnitsController extends AppController {

    function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->deny('*');
    }

    function index()
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        $options['order'] = array('CAST(Unit.number as UNSIGNED) ASC', 'Unit.number ASC');
        $options['conditions'] = array('active' => 1);
        $this->set('units', $this->Unit->findAllForPropertyContain($this->propId, $options));
        $this->set('frequency', $this->Unit->Frequency->find('list', array(
            'fields' => array('Frequency.id', 'Frequency.type')
        )));
    }

    function add()
    {
        $this->managerCheck();
        $this->activePropertyCheck();
        $success = true;
        if ( !empty($this->request->data) )
        {
            $data = $this->request->data;
            $all_units = explode(",", $data['Unit']['number']);
            foreach ( $all_units as $single_unit ):
                $empty_date = date('m/d/Y', strtotime('1753-1-1'));
                if ( empty($data['Unit']['lease_start']) || $data['Unit']['lease_start'] == '' )
                {
                    $data['Unit']['lease_start'] = $empty_date;
                }
                if ( empty($data['Unit']['lease_end']) || $data['Unit']['lease_end'] == '' )
                {
                    $data['Unit']['lease_end'] = $empty_date;
                }
                if ( empty($data['Unit']['rent']) || $data['Unit']['rent'] == '' )
                {
                    $data['Unit']['rent'] = 0;
                }
                $data['Unit']['number'] = trim($single_unit);
                $data['Unit']['property_id'] = $this->propId;
                $data['Unit']['rent_start'] = $data['Unit']['lease_start'];
                $data['Unit']['current_due_date'] = $this->Unit->set_current_due_date($data);
                $data['Unit']['rent_start'] = $data['Unit']['current_due_date'];
                if ( $data['Unit']['current_due_date'] == null || $data['Unit']['current_due_date'] == "" )
                {
                    $data['Unit']['current_due_date'] = $data['Unit']['lease_start'];
                    $this->__email_developer(array('Error' => 'Current Due Date Is Empty', 'Unit' => $data['Unit']['id'], 'Lease Start' => $data['Unit']['lease_start']));
                }
                $i = 0;
                if ( array_key_exists('UnitFee', $data) )
                {
                    foreach ( $data['UnitFee'] as $unit_fee )
                    {
                        if ( $unit_fee['one_time_date'] != "" )
                            $data['UnitFee'][ $i ]['one_time_date'] = date('Y-m-d', strtotime($unit_fee['one_time_date']));
                        $i ++;
                    }
                }
                $this->Unit->create();
                if ( !$this->Unit->saveAssociated($data) )
                {
                    $success = false;
                }
            endforeach;
            if ( $success )
            {
                $this->Session->setFlash('Unit(s) added successfully', 'flash_good');
                $this->redirect(array('controller' => 'Units', 'action' => 'index'));
            } else
            {
                $this->Session->setFlash('Failed to add unit(s).  Please try again. If the problem persists, please contact support.', 'flash_bad');
                $this->redirect(array('controller' => 'Units', 'action' => 'index'));
            }
        }
    }

    //Delete a Unit and unassign any residents tied to that unit
    function delete()
    {
        $this->managerCheck();
        $this->activePropertyCheck();
        if ( !empty($this->request->data) )
        {
            $this->Unit->id = $this->request->data['Unit']['unit_id'];
            $this->Unit->saveField('active', 0);
            $this->loadModel('User');
            $this->User->unassignAllResidents($this->request->data['Unit']['property_id'], $this->request->data['Unit']['unit_id']);
            $this->Session->setFlash('Deleted Unit ' . $this->request->data['Unit']['number'] . '.', 'flash_good');
            $this->redirect(array('controller' => 'Units', 'action' => 'index'));
        }
    }

    function updateTransactionFee($id = null, $value = null)
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        $this->layout = 'ajax';

        if ( $id != null && $value != null )
        {
            $this->Unit->id = $id;
            $this->Unit->saveField('transaction_fee', $value);
            $this->Session->setFlash('Transaction Fee Updated successfully', 'flash_good');
        } else
            $this->Session->setFlash('Transaction Fee Update Error. Please contact site admin.', 'flash_bad');
    }

    function deleteUnitCharge($id = null)
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        if ( !empty($this->request->data) )
        {
            $this->loadModel('UnitFee');
            $this->UnitFee->delete($this->request->data['Unit']['fee_id']);
            $this->redirect($this->referer());
        } else
            $this->Session->setFlash('Error deleting Unit Charge. Please contact site admin.', 'flash_bad');
    }

    function deleteUnitFreeRents($unit_id = null)
    {
        $this->layout = "ajax";
        $this->managerCheck();
        $this->activePropertyCheck();

        $this->log("DEL UNIT FREE RENT: unit_id = $unit_id", 'debug');

        if ( !empty($unit_id) )
        {
            $today = date('Y-m-d 00:00:00');
            $this->loadModel('FreeRent');
            $this->FreeRent->deleteAll(array(
                'unit_id'        => $unit_id,
                'billing_end >=' => $today
            ), false, false);

            return 1;
        } else
        {
            return 0;
        }
    }

    function deleteFreeRent($id = null)
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        if ( !empty($this->request->data) )
        {
            $this->loadModel('FreeRent');
            $this->FreeRent->delete($this->request->data['Unit']['free_rent_id']);
            $this->redirect($this->referer());
        } else
            $this->Session->setFlash('Error deleting Free Rent. Please contact site admin.', 'flash_bad');

    }

    /* Function AddTenant
     * Lanlord approves Tenant
     * Update Tenant account with unit id and set tenant active
     */

    function addTenant()
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        if ( !empty($this->request->data) )
        {
            $this->loadModel('User');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['Unit']['tenant_id']), 'contain' => array('Property')));

            if ( $user['User']['property_id'] == $this->propId )
            {
                if ( $this->Unit->belongsToProperty($this->request->data['Unit']['id'], $this->propId) )
                {
                    $this->User->id = $user['User']['id'];
                    $this->User->saveField('unit_id', $this->request->data['Unit']['id']);
                    $this->User->saveField('timezone', $user['Property']['timezone']);
                    $this->Unit->id = $this->request->data['Unit']['id'];
                    $this->Unit->saveField('occupied', 'Yes');
                    if ( $this->User->saveField('is_activated', 1) )
                    {
                        //Send Email To User
                        $this->__NotifyTenantOfApproval($this->request->data['Unit']['user_email'], $this->request->data['Unit']['unit_number'], $this->request->data['Unit']['tenant_name'], $user['Property']['name']);
                    }

                    //set_current_due_date
                    $unit_data = $this->Unit->find('first', array('conditions' => array('Unit.id' => $this->request->data['Unit']['id'])));
                    $current_due_date = $this->Unit->set_current_due_date($unit_data);
                    $this->Unit->saveField('current_due_date', $current_due_date);
                }
            } else
                $this->Session->setFlash('That user is not a member of the currently active property');

        }

        $this->redirect($this->referer());
    }

    function addTenants()
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        if ( !empty($this->request->data) )
        {
            $this->layout = 'ajax';
            $this->view = 'addTenants_ajax';

            $this->loadModel('User');
            $this->Unit->contain();
            $unit = $this->Unit->findByNumber($this->request->data['Unit']['number'], $this->propId);

            if ( $unit )
            {
                foreach ( $this->request->data['Tenant']['id'] as $key => $val )
                {
                    if ( $key == $val )
                        $this->User->addToUnit($key, $this->propId, $unit['Unit']['id']);
                }

                $this->Session->setFlash('Tenants added successfully');
            } else
                $this->Session->setFlash('The unit you are trying to edit does not belong to the currently active property');
        }
    }

    function removeTenants()
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        $this->layout = 'ajax';
        if ( !empty($this->request->data) )
        {
            $this->loadModel('User');

            $nRemoved = 0;
            foreach ( $this->request->data['Tenant']['id'] as $key => $val )
            {
                if ( $key == $val )
                {
                    if ( $this->User->removeFromUnit($key, $this->propId) )
                        $nRemoved ++;
                }
            }

            $this->Session->setFlash($nRemoved . ' tenants removed successfully');
        }
    }

    function view($id = null)
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        $this->layout = 'ajax';

        if ( $id == null && !empty($this->request->data) )
        {
            $unit = $this->Unit->findByNumber($this->request->data['Unit']['number'], $this->propId);
            if ( $unit )
                $this->set('unit', $unit);
        } else if ( $id != null )
        {
            $unit = $this->Unit->get($id, $this->Auth->user('id'));
            if ( $unit )
                $this->set('unit', $unit);
        }
    }


    function edit($id = null)
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        //Save Data
        if ( !empty($this->request->data) && $id != null )
        {
            $data = $this->request->data;
            $data['Unit']['id'] = $id;
            $data['Unit']['property_id'] = $this->propId;
            $data['Unit']['rent_start'] = $data['Unit']['lease_start'];

            //If Lease Start Change or Billing Freq Change, Update Current Due Date
            if ( $data['Unit']['lease_start'] != $data['Unit']['prev_lease_start'] ||
                $data['Unit']['prev_billing_frequency'] != $data['Unit']['billing_frequency'] ||
                ($data['Unit']['billing_frequency'] == 4 && $data['Unit']['prev_monthly_day'] != $data['Unit']['monthly_day']) ||
                ($data['Unit']['billing_frequency'] == 2 && $data['Unit']['prev_weekly_day'] != $data['Unit']['weekly_day']) ||
                ($data['Unit']['billing_frequency'] == 5 && $data['Unit']['prev_yearly_date'] != $data['Unit']['yearly_date']) ||
                ($data['Unit']['billing_frequency'] == 6 && $data['Unit']['prev_yearly_date'] != $data['Unit']['yearly_date']) ||
                ($data['Unit']['billing_frequency'] == 7 && $data['Unit']['prev_yearly_date'] != $data['Unit']['yearly_date'])
            )
            {

                $data['Unit']['current_due_date'] = $this->Unit->set_current_due_date($data);
                $data['Unit']['rent_start'] = $data['Unit']['current_due_date'];
            }

            // If freeRents being added, we need to grab dates from Unit data
            if ( !empty($data['FreeRent']) )
            {
               foreach( $data['FreeRent'] as $idx => $frdata )
               {
                  $frdates = explode( '-', $data['Unit'][$idx]['free_rent'] );

                  $data['FreeRent'][$idx]['billing_start'] = preg_replace('/\s+/','',$frdates['0']);
                  $data['FreeRent'][$idx]['billing_end']   = preg_replace('/\s+/','',$frdates['1']);
               }
            }

            if ( $this->Unit->saveAll($data) )
            {
                $this->Session->setFlash('Saved.', 'flash_good');
                $this->redirect(array('controller' => 'Units', 'action' => 'edit', $data['Unit']['id']));
            } else
            {
                $this->Session->setFlash('Failed to edit unit.  Probably the result of trying to add a unit that already exists', 'flash_bad');
                $this->redirect(array('controller' => 'Units', 'action' => 'index'));
            }
        } else
        {
            //Get Data
            if ( $id == null && !empty($this->request->data) )
            {
                $unit = $this->Unit->findByNumber($this->request->data['Unit']['number'], $this->propId);
                if ( $unit )
                    $this->set('unit', $unit);
            } else if ( $id != null )
            {
                $unit = $this->Unit->get($id, $this->Auth->user('id'));
                if ( $unit )
                    $this->set('unit', $unit);
            }
            $unit['Unit']['prev_lease_start'] = $unit['Unit']['lease_start'];
            $unit['Unit']['prev_billing_frequency'] = $unit['Unit']['billing_frequency'];
            $unit['Unit']['prev_monthly_day'] = $unit['Unit']['monthly_day'];
            $unit['Unit']['prev_weekly_day'] = $unit['Unit']['weekly_day'];
            $unit['Unit']['prev_yearly_date'] = $unit['Unit']['yearly_date'];

            $this->request->data = $unit;
            $this->set('frequency', $this->Unit->Frequency->find('list', array(
                'fields' => array('Frequency.id', 'Frequency.type')
            )));
            $this->loadModel('User');

            $options['order'] = array('User.username ASC');
            $this->set('queuedTenants', $this->User->findQueuedForProperty($this->propId, $options));

        }

    }

    function listall()
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        $this->layout = 'ajax';

        $options['order'] = array('CAST(Unit.number as UNSIGNED) ASC', 'Unit.number ASC');
        if ( !empty($this->request->data) )
            $options['conditions'] = array('Unit.number LIKE' => '%' . $this->request->data['Unit']['search'] . '%');

        $this->set('units', $this->Unit->findAllForProperty($this->propId, $options));
    }

    function listqueued()
    {
        $this->managerCheck();
        $this->activePropertyCheck();

        $this->layout = 'ajax';
        $this->loadModel('User');

        $options['order'] = array('User.username ASC');
        if ( !empty($this->request->data) )
        {
            $options['conditions'] = array('User.username LIKE' => '%' . $this->request->data['Unit']['search'] . '%');
        }

        $this->set('queuedTenants', $this->User->findQueuedForProperty($this->propId, $options));
    }

    private function __NotifyTenantOfApproval($emailTo, $unit_num, $tenant_name, $property_name)
    {
        $from = Configure::read('RentSquare.supportemail');

        try
        {
            $email = new CakeEmail();
            $email->domain('rentsquaredev.com');
            $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
            $email->template('residentapproved', 'generic')
                ->emailFormat('html')
                ->from(array($from => 'RentSquare Support'))
                ->to($emailTo)
                ->subject('Welcome to RentSquare!')
                ->viewVars(array(
                    'tenant_name'   => $tenant_name,
                    'unit_num'      => $unit_num,
                    'property_name' => $property_name
                ))
                ->send();
        }
        catch ( Exception $e )
        {
            return false;
        }

        return true;

    }


}

;

?>
