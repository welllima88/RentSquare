<?php
App::uses('AppController', 'Controller');
/**
 * AutoPayments Controller
 *
 * @property AutoPayment $AutoPayment
 */
class AutoPaymentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AutoPayment->recursive = 0;
		$this->set('autoPayments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AutoPayment->exists($id)) {
			throw new NotFoundException(__('Invalid auto payment'));
		}
		$options = array('conditions' => array('AutoPayment.' . $this->AutoPayment->primaryKey => $id));
		$this->set('autoPayment', $this->AutoPayment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
		  $data = $this->request->data;
		  if(!isset($data['AutoPayment']['id']))
  			$this->AutoPayment->create();		
			$data['AutoPayment']['user_id'] = $this->Auth->user('id');
			$data['AutoPayment']['active']=1; 
      if ($this->AutoPayment->save($data)) {
				$this->Session->setFlash(__('The auto payment has been saved'),'flash_good');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The auto payment could not be saved. Please, try again.'),'flash_bad');
			}

		}
		
	}
	
	function toggleActivation($id = null){
    if ($id != null) {
      $this->AutoPayment->recursive = -1;
  	  $this->AutoPayment->id = $id;
  	  $this->AutoPayment->updateAll(array('active' => "1 - AutoPayment.active"),array('AutoPayment.id'=>$id,'AutoPayment.user_id'=>$this->Auth->user('id')));
  	}
  	$this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AutoPayment->exists($id)) {
			throw new NotFoundException(__('Invalid auto payment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AutoPayment->save($this->request->data)) {
				$this->Session->setFlash(__('The auto payment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auto payment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AutoPayment.' . $this->AutoPayment->primaryKey => $id));
			$this->request->data = $this->AutoPayment->find('first', $options);
		}
		$users = $this->AutoPayment->User->find('list');
		$paymentMethods = $this->AutoPayment->PaymentMethod->find('list');
		$this->set(compact('users', 'paymentMethods'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AutoPayment->id = $id;
		if (!$this->AutoPayment->exists()) {
			throw new NotFoundException(__('Invalid auto payment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AutoPayment->delete()) {
			$this->Session->setFlash(__('Auto payment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Auto payment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
