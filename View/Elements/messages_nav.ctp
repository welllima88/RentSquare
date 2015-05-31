<h2 id='messages-nav' class='sub-menu'>
<?php
	echo $this->ExHtml->link('Inbox', array('controller' => 'Conversations', 'action' => 'inbox'));
	echo ' <span style="color: #fff">|</span> ';
	echo $this->ExHtml->link('Outbox', array('controller' => 'Conversations', 'action' => 'outbox'));
	echo ' <span style="color: #fff">|</span> ';
	echo $this->ExHtml->link('Compose', array('controller' => 'Conversations', 'action' => 'send'));
?>
</h2>