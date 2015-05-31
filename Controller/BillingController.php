<?php

App::uses('AppController', 'Controller');

class BillingController extends AppController {

   var $uses = array('Billing','Unit','Frequency','User','Property','Payment','FailedPayment');


/**
 * index method
 *
 * @return void
 */
	public function index($status = null) 
        {
            $this->Billing->Behaviors->attach('Containable');
	    $conditions = array('Billing.property_id'=>$this->propId);
	    if($status != null && $status != 'all')
            {
  	        $conditions['Billing.status'] = $status;
            }  
	    if($this->request->is('post') && $this->request->data)
            {
                // Clear Billing Session Dates
                $this->Session->delete('Billing');
	        if($this->request->data['Billing']['start_date'] != '')
                {
  	            $conditions['Billing.billing_end >='] = date("Y-m-d 00:00:00",strtotime($this->request->data['Billing']['start_date']));
                    $this->Session->write('Billing.start_date',$this->request->data['Billing']['start_date']);
  	            $this->set('start_filter', $this->request->data['Billing']['start_date']);
	        }
  	        if($this->request->data['Billing']['end_date'] != '')
                {
  	            $conditions['Billing.billing_end <='] = date("Y-m-d 23:59:59",strtotime($this->request->data['Billing']['end_date']));
                    $this->Session->write('Billing.end_date',$this->request->data['Billing']['end_date']);
  	            $this->set('end_filter', $this->request->data['Billing']['end_date']);
  	        }
	    }

            // Set dates from session
            $stdate = $this->Session->read('Billing.start_date');
            $endate = $this->Session->read('Billing.end_date');
            if (!empty($stdate) && !empty($endate))
            {                          
  	        $this->set('start_filter', $stdate);
  	        $this->set('end_filter', $endate);
                $conditions['Billing.billing_end >='] = date("Y-m-d 00:00:00",strtotime($stdate));
                $conditions['Billing.billing_end <=']   = date("Y-m-d 23:59:59",strtotime($endate));
            }
            else
            {
               // We have no dates, so lets choose this month
                $conditions['Billing.billing_end >='] = date("Y-m-01 00:00:00");
                $conditions['Billing.billing_end <=']   = date("Y-m-t 23:59:59");
            }
//debug($conditions);
	    $this->paginate = array( 'conditions' => $conditions,
                                     'contain' => array(
                                       'Payment'=>array('conditions'=>array('is_fee'=>0),
                                       'User'),
                                       'Unit'=>array('order' => array('CAST(Unit.number as UNSIGNED) ASC'),'Tenant','Frequency')
                                     ),
                                     'limit' => 15,
                                     'order' => array(
                                         'Billing.billing_end' => 'desc'
                                         )
                                 );
            $this->set('status', $status);
            $this->set('billingcycle', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Billing->id = $id;
		$this->Billing->Behaviors->attach('Containable');
		if (!$this->Billing->exists()) {
			throw new NotFoundException(__('Invalid billing cycle'));
		}
		$this->set('Billing', $this->Billing->find('first', array(
		  'contain' => array(
          'Payment'=>array('conditions'=>array('is_fee'=>0),
          'User'),
          'Unit'=>array('Tenant','FreeRent','UnitFee'),
          'BillingFee'
        ),
         'conditions' => array('Billing.id'=>$id),
		)
		));
	}

	public function indexTmpTable($status = null) 
        {
            $end_compare = "";
            $tmpModel = 'Tempbilling' . $this->Auth->user('id');
            $this->set('tblname', $tmpModel);
            $this->Billing->Behaviors->attach('Containable');
	    $conditions = array('Billing.property_id'=>$this->propId);
	    $conditions2 = array("$tmpModel.property_id"=>$this->propId);
	    if($status != null && $status != 'all')
            {
  	        //$conditions['Billing.status'] = $status;
  	        $conditions2["$tmpModel.status"] = $status;
            }  

            /*
             *  Step 1 of 2 - Get all exiting billing data for a property/date range into new db table
             */
	    if($this->request->is('post') && $this->request->data)
            {
                // Clear Billing Session Dates
                $this->Session->delete('Billing');
	        if($this->request->data['Billing']['start_date'] != '')
                {
  	            //$conditions['Billing.billing_start >='] = date("Y-m-d 00:00:00",strtotime($this->request->data['Billing']['start_date']));
  	            $conditions2["$tmpModel.billing_end >="] = date("Y-m-d 00:00:00",strtotime($this->request->data['Billing']['start_date']));
                    $this->Session->write('Billing.start_date',$this->request->data['Billing']['start_date']);
  	            $this->set('start_filter', $this->request->data['Billing']['start_date']);
	        }
  	        if($this->request->data['Billing']['end_date'] != '')
                {
  	            $conditions['Billing.billing_end <='] = date("Y-m-d 23:59:59",strtotime($this->request->data['Billing']['end_date']));
  	            $conditions2["$tmpModel.billing_end <="] = date("Y-m-d 23:59:59",strtotime($this->request->data['Billing']['end_date']));
                    $this->Session->write('Billing.end_date',$this->request->data['Billing']['end_date']);
  	            $end_filter = $this->request->data['Billing']['end_date'];
  	            $this->set(compact('end_filter'));
  	        }
	    }
            else
            {
                $conditions['Billing.billing_end >='] = date("Y-m-01 00:00:00");
                $conditions['Billing.billing_end <=']   = date("Y-m-t 23:59:59");
                $conditions2["$tmpModel.billing_end >="] = date("Y-m-01 00:00:00");
                $conditions2["$tmpModel.billing_end <="]   = date("Y-m-t 23:59:59");
                $end_filter = date("m/t/Y");
            }

            // Set dates from session
            $stdate = $this->Session->read('Billing.start_date');
            $endate = $this->Session->read('Billing.end_date');
            if (!empty($stdate) && !empty($endate))
            {                          
  	        $this->set('start_filter', $stdate);
  	        $end_filter = $endate;
  	        $this->set(compact('end_filter'));
                $conditions['Billing.billing_end >='] = date("Y-m-d 00:00:00",strtotime($stdate));
                $conditions['Billing.billing_end <=']   = date("Y-m-d 23:59:59",strtotime($endate));
                $conditions2["$tmpModel.billing_end >="] = date("Y-m-d 00:00:00",strtotime($stdate));
                $conditions2["$tmpModel.billing_end <="]   = date("Y-m-d 23:59:59",strtotime($endate));
            }

            /*
             * NOTE: 
             *     Pulling all data into new table can take 10 seconds or so
             *     The problem is the payment function calc for every unit...
             *     So, if the end date is the end of 'this' month, as it will be at login, just gonna
             *     pull in data up to end of this month to save on processing time (by using $condiitions)
             *     $conditions pulls in data (from billing table), $conditions2 used to display data from temp table
             *     Projected data created either through search end date or lease end date to accomodate this process
             *     If end date is changed to future date, we repull all data
             *     Got some tedious house-keeping to make it all work, as commented below
             */


             // If we already have gotten data for this property, then let's not do it again
             //  Unless we override by pulling all data due to month end date change
             $haveData = $this->Session->read('haveData');
             $thisProp = $this->Session->read('haveProp');
             $ignoreEnd = $this->Session->read('ignoreEnd');

             $endparts = explode("/",$end_filter); 
             $end_compare = $endparts['2'] . $endparts['0'] . $endparts['1'];

             if ($end_compare == date("Ymt"))
             {
                // Pull/create data up to end of this month 
                //  if not first time in and session stuff is set, it wont repull 
                // For projected data, set flag to force search end date use instead of lease end
                $forcesearchend = true;
               
                // If a property change, full data pull will be triggered regardless of ignoreEnd variable in elseif below
                // , but here, we need to override this limitations for existing data by modifying conditions, and
                //  for projected data pull to get everything 
                if ($thisProp != $this->propId)
                {
	           $conditions = array('Billing.property_id'=>$this->propId);
                   $forcesearchend = false;
                }
             }
             elseif ($end_compare > date("Ymt"))
             {
                // Pull/create all data for propID for future end date if we haven't done this before
                if ($ignoreEnd != 1)
                {
                   // redefine conditions to be only the property id (no dates)
	           $conditions = array('Billing.property_id'=>$this->propId);
                   $thisProp = "";		// Forces reload of data with new conditions
                   $forcesearchend = false;
                   $this->Session->write('ignoreEnd','1');
                }
             }
             else
             {
                // Do nothing - we've got what we need
                $forcesearchend = false;
             }

             $this->set('tmpModel',$tmpModel);

             // If we pulled data already for this property, just load model and paginate
             if ($haveData == $tmpModel && $thisProp == $this->propId)
             {
                App::import('Model', $tmpModel);
                $this->loadModel($tmpModel);
                $this->$tmpModel->cacheSources = false;
                $this->$tmpModel->schema();
             }
             else
             {
                $this->Session->write('haveData',$tmpModel);
                $this->Session->write('haveProp',$this->propId);

                // Copy existing data to tmp table
                $this->Billing->contain();
                $tmpdata = $this->Billing->find('all', array('conditions' => $conditions));
                $tmpTable = "DROP TABLE IF EXISTS " . Inflector::tableize($tmpModel)  .  ";
                             CREATE TABLE IF NOT EXISTS " . Inflector::tableize($tmpModel)  .  " (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `unit_id` int(11) NULL,
                            `property_id` int(11) NULL,
                            `rent_due` decimal(19,2) NULL,
                            `balance` decimal(19,2) NULL,
                            `status` varchar(100) NULL DEFAULT 'unpaid',
                            `billing_start` datetime NULL,
                            `billing_end` datetime NULL,
                            `rent_period` datetime DEFAULT NULL,
                            `type` varchar(15) DEFAULT 'Rent',
                            `auto_late_fee` tinyint(1) NULL DEFAULT '0',
                            `src` varchar(10) NULL DEFAULT NULL,
                            `created` datetime NULL,
                            `modified` datetime NULL,
                            PRIMARY KEY (`id`)
                          ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
                $this->Billing->query($tmpTable);
                App::import('Model', $tmpModel);
                $this->loadModel($tmpModel);
                $this->$tmpModel->cacheSources = false;
                $this->$tmpModel->schema();
               
                foreach($tmpdata as $nextrec)
                {
                   $nextrec['Billing']['src'] = "copied";
                   $this->$tmpModel->create();
                   $this->$tmpModel->save(array($tmpModel => $nextrec['Billing']));
                }
    
                // Find last id in temp table
                $lastRec = $this->$tmpModel->find('first',array('order' => array('id' => 'desc'),
                                                               'fields' => array('id')));
                $lastId = $lastRec[$tmpModel]['id'];
    
                /*
                 *  Step 2 of 2 - Project payments for all units in property/date range and append to table
                 */
    
	        //Find All Active Units for the property
                $this->Billing->recursive = 0;
                $units = $this->Billing->Unit->find('all',array('conditions'=>array('Unit.active'=>1,
                                                                                    'Unit.property_id'=>$this->propId)));
                //if unit has residents do some cipherin'
                $tomorrowtime = mktime (0,0,0,date("m"),date("d")+1,date("Y"));
                foreach($units as $unit)
                {
                   if($this->User->find('count', array('conditions' => array('User.unit_id' => $unit['Unit']['id']))) > 0)
                   {
                      // If lease end in the future, we want to create some temp billing records
                      if ($tomorrowtime < strtotime ($unit['Unit']['lease_end']))
                      {
                         // Use closer of 2 dates - lease end or search end
                         $searchendate = $this->Session->read('Billing.end_date');
                         if ((!empty($searchendate) && strtotime($searchendate) < strtotime($unit['Unit']['lease_end'])) || $forcesearchend)
                         {
                            $searchendate = strtotime($searchendate);
                         }
                         else
                         {
                            $searchendate = strtotime($unit['Unit']['lease_end']);
                         }
    
                         $lastPayTime = strtotime ($unit['Unit']['current_due_date']);
                         while($lastPayTime <= $searchendate)
                         {
                            $lpcnt++;
                            if ($lpcnt > 3000) { break; }     // Just a fail safe sanity check
                            //switch($unit['Frequency']['type'])
                            switch($unit['Frequency']['id'])
                            {
                               case '1':
                                  // Daily
                                  $nextPayDate = date('Y-m-d 00:00:00', strtotime('+1 day',$lastPayTime));
                                  break;
                               case '2':
                                  // Weekly
                                  $nextPayDate = date('Y-m-d 00:00:00', strtotime('+1 week',$lastPayTime));
                                  break;
                               case '3':
                                  // Twice a Month
                                  $dayofpay = date('d', $lastPayTime);
                                  if ($dayofpay == "01")
                                  {
                                     $nextPayDate = date('Y-m-15 00:00:00', $lastPayTime);
                                  }
                                  else
                                  {
                                     $nextPayDate = date('Y-m-01 00:00:00', strtotime('+1 month',$lastPayTime));
                                  }
                                  break;
                               case '4':
                                  // Monthly
                                  $nextPayDate = date('Y-m-d 00:00:00', strtotime('+1 month',$lastPayTime));
                                  break;
                               case '5':
                                  // Quarterly
                                  $nextPayDate = date('Y-m-d 00:00:00', strtotime('+3 month',$lastPayTime));
                                  break;
                               case '6':
                                  // Semi-Annually
                                  $nextPayDate = date('Y-m-d 00:00:00', strtotime('+6 month',$lastPayTime));
                                  break;
                               case '7':
                                  // Annually
                                  $nextPayDate = date('Y-m-d 00:00:00', strtotime('+1 year',$lastPayTime));
                                  break;
                            }
    
                            $billing_end = $this->Billing->Unit->set_billing_end_date($unit['Unit']['billing_frequency'],$nextPayDate,$unit['Unit']['monthly_day']);
                            $rent_period = $this->Billing->Unit->set_billing_end_date($unit['Unit']['billing_frequency'],$billing_end,$unit['Unit']['monthly_day']);
    
                            $total_fees =  $this->Billing->Unit->getRentTotal($unit['Unit']['id'],$nextPayDate,$billing_end);
                            //debug($total_fees);
    
                            // We know the next pay date, so figure out the pay amount and write a record to temp billing
                            $lastId++;
                            $billdata = array();
                            $billdata[$tmpModel]['id'] = $lastId;
                            $billdata[$tmpModel]['unit_id'] = $unit['Unit']['id'];
                            $billdata[$tmpModel]['property_id'] = $this->propId;
                            $billdata[$tmpModel]['rent_due'] = $total_fees['Rent']['Total'];
                            $billdata[$tmpModel]['balance'] = $total_fees['Rent']['Total'];
                            $billdata[$tmpModel]['billing_start'] = $nextPayDate;
                            $billdata[$tmpModel]['billing_end'] = $billing_end;
                            $billdata[$tmpModel]['rent_period'] = $rent_period;
                            $billdata[$tmpModel]['type'] = 'Rent';
                            $billdata[$tmpModel]['status'] = 'unpaid';
                            $billdata[$tmpModel]['src'] = 'projected';
                            $this->$tmpModel->create();
                            $this->$tmpModel->save($billdata);
    
                            $lastPayTime = strtotime($nextPayDate);
                         } 
                      } 
                   }
                }
            }

            $this->$tmpModel->bindModel( array('hasMany' => array('Payment' => array('className' => 'Payment',
                                                                                     'foreignKey' => 'billing_id'),
                                                                  'BillingFee' => array('className' => 'BillingFee',
                                                                                        'foreignKey' => 'billing_id'))));
            $this->$tmpModel->bindModel( array('belongsTo' => array('Unit' => array('className' => 'Unit',
                                                                                    'foreignKey' => 'unit_id'))));
            $this->$tmpModel->recursive = 2;
	    $this->paginate = array( 'conditions' => $conditions2,
                                     'contain' => array(
                                       'Payment'=>array('conditions'=>array('is_fee'=>0),
                                       'BillingFee',
                                       'User'),
                                       'Unit'=>array('order' => array('CAST(Unit.number as UNSIGNED) ASC'),'Tenant','Frequency')
                                     ),
                                     'limit' => 15,
                                     'order' => array(
                                         "$tmpModel.billing_end" => 'desc'
                                         )
                                 );


            $this->set('status', $status);
            $this->set('billingcycle', $this->paginate($tmpModel));
	}


/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function viewTmpTable($tmpModel, $id = null) {
                $this->loadModel($tmpModel);
                $this->$tmpModel->bindModel( array('hasMany' => array('Payment' => array('className' => 'Payment',
                                                                                         'foreignKey' => 'billing_id'),
                                                                      'BillingFee' => array('className' => 'BillingFee',
                                                                                            'foreignKey' => 'billing_id')
                                                                      )));
                $this->$tmpModel->bindModel( array('belongsTo' => array('Unit' => array('className' => 'Unit',
                                                                                        'foreignKey' => 'unit_id'))));
		$this->$tmpModel->id = $id;
                $this->$tmpModel->recursive = 2;
                $data = $this->$tmpModel->find('first', array(
                        'contain' => array(
                                       'Payment'=>array('conditions'=>array('is_fee'=>0),
                                       'User'),
                                       'Unit'=>array('Tenant','FreeRent','UnitFee'),
                                       'BillingFee'
                                    ),
                        'conditions' => array("$tmpModel.id"=>$id),
		       ));
		if (empty($data)) {
			throw new NotFoundException(__('Invalid billing cycle'));
		}
		$this->set('Billing', $data);
		$this->set('tmpModel', $tmpModel);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Billing->create();
		
			if ($this->Billing->save($this->request->data)) {
				$this->Session->setFlash(__('The billing cycle has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The billing cycle could not be saved. Please, try again.'));
			}

		}
		$units = $this->Billing->Unit->find('list',array('conditions'=>array('Unit.active'=>1)));
		$this->set(compact('units'));
	}

/*
 * latefee method
 *   //Get rent_due based on billing id
 *   //Add Late Fee to rent due
 *   //Save rent due
 *   //Add fee to Billing Fee Table
 */
 
 function latefee(){
    $this->managerCheck();
		$this->activePropertyCheck();
    if ($this->request->is('post')) {
      $data = $this->request->data;
      if(is_numeric($data['Billing']['amount'])){
          //Call Add Late Fee Function in Model
          if($this->Billing->addLateFee($data['Billing']['billing_id'],$data['Billing']['amount'])){
            $this->Session->setFlash(__('Late Fee Added Sucessfully!'),'flash_good');
            $this->Session->write('haveData','');  // Forces index to rebuild temp table so late fee will show
            $this->redirect(array('action' => 'index'));
          } else {
            $this->Session->setFlash(__('Late fee could not be saved. Please, try again.'),'flash_bad');
            $this->redirect(array('action' => 'index'));
          }
      }	
   }
 }
 
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Billing->id = $id;
		if (!$this->Billing->exists()) {
			throw new NotFoundException(__('Invalid billing cycle'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Billing->save($this->request->data)) {
				$this->Session->setFlash(__('The billing cycle has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The billing cycle could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Billing->read(null, $id);
		}
		$units = $this->Billing->Unit->find('list',array('conditions'=>array('Unit.active'=>1)));
		$this->set(compact('units'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Billing->id = $id;
		if (!$this->Billing->exists()) {
			throw new NotFoundException(__('Invalid billing cycle'));
		}
		if ($this->Billing->delete()) {
			$this->Session->setFlash(__('Billing cycle deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Billing cycle was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
