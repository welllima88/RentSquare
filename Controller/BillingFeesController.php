<?php
App::uses('AppController', 'Controller');
/**
 * BillingFees Controller
 *
 * @property BillingFee $BillingFee
 */
class BillingFeesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BillingFee->recursive = 0;
		$this->set('billingFees', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BillingFee->exists($id)) {
			throw new NotFoundException(__('Invalid billing fee'));
		}
		$options = array('conditions' => array('BillingFee.' . $this->BillingFee->primaryKey => $id));
		$this->set('billingFee', $this->BillingFee->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BillingFee->create();
			if ($this->BillingFee->save($this->request->data)) {
				$this->Session->setFlash(__('The billing fee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The billing fee could not be saved. Please, try again.'));
			}
		}
		$Billings = $this->BillingFee->Billing->find('list');
		$this->set(compact('Billings'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BillingFee->exists($id)) {
			throw new NotFoundException(__('Invalid billing fee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BillingFee->save($this->request->data)) {
				$this->Session->setFlash(__('The billing fee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The billing fee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BillingFee.' . $this->BillingFee->primaryKey => $id));
			$this->request->data = $this->BillingFee->find('first', $options);
		}
		$Billings = $this->BillingFee->Billing->find('list');
		$this->set(compact('Billings'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BillingFee->id = $id;
		if (!$this->BillingFee->exists()) {
			throw new NotFoundException(__('Invalid billing fee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BillingFee->delete()) {
			$this->Session->setFlash(__('Billing fee deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Billing fee was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
