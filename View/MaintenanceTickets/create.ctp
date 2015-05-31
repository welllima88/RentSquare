<div class="block_title">
New Maintenance Request
</div><!-- .block_title -->
<div class="block_content">
	<div id='MaintenanceTicketDescription' class=''>
	Please fill in the fields below: <br><br>
	<div class='widget-pad'>
	<?php
		echo $this->Form->create('MaintenanceTicket', array('controller' => 'MaintenanceTickets', 'action' => 'create','enctype' => 'multipart/form-data'));

		echo $this->Form->input('title', array('label' => 'Subject'));
		echo $this->Form->input('location', array('label' => 'Location', 'type' => 'select', 'options' => Configure::read('RS.Tickets.Locations')));
		echo $this->Form->input('nature', array('label' => 'Nature', 'type' => 'select', 'options' => Configure::read('RS.Tickets.Nature')));
		echo $this->Form->input('can_enter', array('label' => 'Can Enter', 'type' => 'select', 'options' => array('Yes', 'No')));
		echo $this->Form->input('description', array('label' => 'Description', 'type' => 'textarea'));
    echo '<input type="hidden" name="MAX_FILE_SIZE" value="32000000" />';
		echo $this->Form->input('image_file',array('type' => 'file','label'=>'Upload a Photo')); 
		echo $this->Form->input('image_file_2',array('type' => 'file','label'=>'Photo 2')); 
		echo $this->Form->input('image_file_3',array('type' => 'file','label'=>'Photo 3')); 
		echo $this->Form->input('image_file_4',array('type' => 'file','label'=>'Photo 4'));  
		echo $this->Form->button("Submit", array('class' => 'btn btn-success right','escape' => false )); 
		echo $this->Form->end();
	?>
	<div class='clear'></div>
	</div>
</div>
</div><!-- .block_content -->

