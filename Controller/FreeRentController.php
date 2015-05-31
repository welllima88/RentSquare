<?php 

class FreeRent extends AppController{
  function beforeFilter(){
		parent::beforeFilter();

		$this->Auth->deny('*');
	}
}