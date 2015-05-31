<?php 

class UnitFeesController extends AppController{
  function beforeFilter(){
		parent::beforeFilter();

		$this->Auth->deny('*');
	}
}