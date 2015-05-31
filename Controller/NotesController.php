<?php
App::uses('AppController', 'Controller');
/**
 * Notes Controller
 *
 * @property Note $Note
 */
class NotesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Note->recursive = 0;
		$this->set('notes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
		$this->set('note', $this->Note->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Note->create();
			$data = $this->request->data;
			$data['Note']['creater_id'] = $this->Auth->user('id');
			if ($this->Note->save($data)) {
				$this->Session->setFlash(__('The note has been saved'),'flash_good');
				$this->redirect(array('controller'=>'users','action' => 'view',$data['Note']['user_id']));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'),'flash_bad');
			}
		}
		$users = $this->Note->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The note has been saved'),'flash_good');
				$this->redirect(array('controller'=>'users','action' => 'view',$this->request->data['Note']['user_id']));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
			$this->request->data = $this->Note->find('first', $options);
		}
		$users = $this->Note->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$user_id=null) {
		$this->Note->id = $id;
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('Invalid note'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Note->delete()) {
			$this->Session->setFlash(__('Note deleted!'),'flash_good');
			$this->redirect(array('controller'=>'users','action' => 'view',$user_id));
		}
		$this->Session->setFlash(__('Note was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}
}
