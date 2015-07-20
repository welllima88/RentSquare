<?php
App::uses('AppController', 'Controller');

/**
 * FailedPayments Controller
 *
 * @property FailedPayment $FailedPayment
 */
class FailedPaymentsController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->FailedPayment->recursive = 0;
        $this->set('failedPayments', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if ( !$this->FailedPayment->exists($id) )
        {
            throw new NotFoundException(__('Invalid failed payment'));
        }
        $options = array('conditions' => array('FailedPayment.' . $this->FailedPayment->primaryKey => $id));
        $this->set('failedPayment', $this->FailedPayment->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ( $this->request->is('post') )
        {
            $this->FailedPayment->create();
            if ( $this->FailedPayment->save($this->request->data) )
            {
                $this->Session->setFlash(__('The failed payment has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The failed payment could not be saved. Please, try again.'));
            }
        }
        $billing = $this->FailedPayment->Billing->find('list');
        $units = $this->FailedPayment->Unit->find('list');
        $users = $this->FailedPayment->User->find('list');
        $this->set(compact('billing', 'units', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if ( !$this->FailedPayment->exists($id) )
        {
            throw new NotFoundException(__('Invalid failed payment'));
        }
        if ( $this->request->is('post') || $this->request->is('put') )
        {
            if ( $this->FailedPayment->save($this->request->data) )
            {
                $this->Session->setFlash(__('The failed payment has been saved'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The failed payment could not be saved. Please, try again.'));
            }
        } else
        {
            $options = array('conditions' => array('FailedPayment.' . $this->FailedPayment->primaryKey => $id));
            $this->request->data = $this->FailedPayment->find('first', $options);
        }
        $billing = $this->FailedPayment->Billing->find('list');
        $units = $this->FailedPayment->Unit->find('list');
        $users = $this->FailedPayment->User->find('list');
        $this->set(compact('billing', 'units', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->FailedPayment->id = $id;
        if ( !$this->FailedPayment->exists() )
        {
            throw new NotFoundException(__('Invalid failed payment'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ( $this->FailedPayment->delete() )
        {
            $this->Session->setFlash(__('Failed payment deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Failed payment was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
