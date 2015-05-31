<h2>Tenants</h2>

<div class='widget two_thirds tenant-widget'>
	<h3>Manage Units and Tenants</h3>

	<div class='left half'>
		<h4>Units</h4>
		<?php
			echo $this->Form->create('Unit', array('url' => array('controller' => 'Units', 'action' => 'search'), 'id' => 'units-search-form', 'default' => false));
			echo $this->Form->input('search', array('label' => '', 'id' => 'units-search', 'autocomplete' => 'off'));
			echo $this->Form->end();
		?>
		<div id='unit-list-container'></div>
		<?php 
			echo $this->Html->link('Add Units', array('controller' => 'Units', 'action' => 'add'), array('class' => 'button green-grad left'));
			echo $this->Form->create('Unit', array('id' => 'selected-unit-form', 'url' => array('controller' => 'Units', 'action' => 'delete')));
			echo $this->Form->input('Unit.number', array('type' => 'hidden', 'class' => 'unit-number'));
			echo $this->Js->submit('Delete Unit', array('class' => 'green-grad button left last', 'complete' => 'refreshUnitsAjax();', 'url' => array('controller' => 'Units', 'action' => 'delete')));
			echo $this->Form->end();
		?>
	</div>
	<div class='right half'>
		<h4>Queued Tenants</h4>
		<?php
			echo $this->Form->create('Unit', array('url' => array('controller' => 'Units', 'action' => 'listqueued'), 'id' => 'queued-tenants-form', 'default' => false));
			echo $this->Form->input('search', array('label' => '', 'id' => 'tenants-search', 'autocomplete' => 'off'));
			echo $this->Form->end();
		?>
		<?php 
			echo $this->Form->create('Unit', array('action' => 'addTenants'));
		?>
		<div id='queued-list-container'></div>
		<?php
			echo $this->Form->input('Unit.number', array('type' => 'hidden', 'class' => 'unit-number', 'value' => 'null'));
			echo $this->Js->submit('Add to Unit', array('url' => array('controller' => 'Units', 'action' => 'addTenants'), 'class' => 'button green-grad', 'complete' => 'refreshQueued(); refreshTenants();'));
			echo $this->Js->submit('Delete Tenants', array('url' => array('controller' => 'Property', 'action' => 'deleteTenants'), 'class' => 'button green-grad last'));
			echo $this->Form->end();
		?>
	</div>
</div>

<div id='current-unit' class='widget one_third end'>
</div>
<div class='clear'></div>

<?php echo $this->Js->writeBuffer(array('inline' => true)); ?>
<script type='text/javascript'>
	function refreshUnits(){
		<?php echo $this->Js->request(array('controller' => 'Units', 'action' => 'listall'), array('update' => '#unit-list-container', 'evalScripts' => true, 'data' => $this->Js->get('#units-search-form')->serializeForm(array('isForm' => true, 'inline' => true)), 'dataExpression' => true, 'method' => 'post')); ?>
	}
	function refreshQueued(){
		<?php echo $this->Js->request(array('controller' => 'Units', 'action' => 'listqueued'), array('update' => '#queued-list-container', 'evalScripts' => true, 'data' => $this->Js->get('#queued-tenants-form')->serializeForm(array('isForm' => true, 'inline' => true)), 'dataExpression' => true, 'method' => 'post')); ?>
	}
	function refreshTenants(){
		<?php echo $this->Js->request(array('controller' => 'Units', 'action' => 'view'), array('data' => $this->Js->get('#selected-unit-form')->serializeForm(array('isForm' => true, 'inline' => true)), 'dataExpression' => true, 'update' => '#current-unit', 'method' => 'post')); ?>
	}

	function refreshAll(){
		refreshUnits();
		refreshQueued();
		refreshTenants();
	}

	refreshAll();

	$('#tenants-search').keyup(refreshQueued);
	$('#units-search').keyup(refreshUnits);
</script>