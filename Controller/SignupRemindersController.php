<?php 

class SignupRemindersController extends AppController{
  function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->deny('*');
	}
	public function index(){
	
	}
}