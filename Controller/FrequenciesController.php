<?php 

class FrequenciesController extends AppController{
  function beforeFilter(){
		parent::beforeFilter();

		$this->Auth->deny('*');
	}
}