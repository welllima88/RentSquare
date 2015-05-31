<?php
	class ConversationsUsersController extends AppController{
		public $paginate = array(
			'limit' => 3, 
			'order' => array('ConversationsUser.last_msg_time' => 'DESC'),
			'contain' => array('')
		); 
	};
?>