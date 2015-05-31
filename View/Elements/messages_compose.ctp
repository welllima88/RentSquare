<!-- Modal To Send Message -->
<div id="compose_message_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="compose" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Compose Message</h3>
  </div>
 
  <?php 		
  echo $this->Form->create('Message', array('url' => array('controller' => 'Conversations', 'action' => 'send'),'inputDefaults' => array(
        'label' => false,
        'div' => false
    ))); ?>
  
  <div class="modal-body compose-message-modal row-fluid">
    <div class="span6">
        <?php
      		echo $this->Form->input('to', array('value' => (isset($email_add) ? $email_add : ''), 'label' => 'To:'));
      		echo $this->Form->input('title', array('label' => 'Subject:'));
      		echo $this->Form->input('content', array('type' => 'textarea', 'label' => 'Message:'));
      	?>
    </div>
    <div class="span5">
        <label>Address Book:</label>
      	<table class="subheader small">
      		<?php echo $this->Html->tableHeaders(array('Name', 'Unit')); ?>
      	<?php
      		if(isset($propManager))
      			array_push($userList, $propManager['username'] . '(Manager)');
      
      		$userList = array();
      		foreach($tenants as $tenant){
      			$number = '';
      			if(isset($tenant['Unit']['number']))
      				$number = $tenant['Unit']['number'];
      			else
      				$number = '(Unassigned)';
      
      			array_push($userList, array($tenant['User']['username'], $number));
      		}
      
      		echo $this->Html->tableCells($userList, array('class' => 'odd'), array('class' => 'even'));
      	?>
      	</table>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-success">Send</button>
  </div>
  <?php echo $this->Form->end(); ?>
</div>