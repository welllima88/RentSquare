<h3>Current Tenants &nbsp;&nbsp; Unit: <?php echo @$unit['Unit']['number']; ?></h3>

<?php
	if(isset($unit)){
		echo $this->Form->create('Units');
		$tenantList = array();
		foreach($unit['Tenant'] as $tenant){
			$item = $this->Form->input('Tenant.id.' . $tenant['id'], array('type' => 'checkbox', 'value' => $tenant['id'], 'label' => $tenant['username']));
			array_push($tenantList, $item);
		}

		echo $this->Form->input('Unit.id', array('type' => 'hidden', 'value' => $unit['Unit']['id']));
		echo $this->Html->nestedList($tenantList, array('class' => 'checkList'), array('odd' => 'odd', 'even' => 'even'));

		echo $this->Js->submit('Remove Tenants', array('url' => array('controller' => 'Units', 'action' => 'removeTenants'), 'class' => 'green-grad button', 'complete' => 'refreshQueued(); refreshTenants();'));
		echo $this->Js->submit('Delete Tenants', array('url' => array('controller' => 'Property', 'action' => 'deleteTenants'), 'class' => 'green-grad button'));
		echo $this->Form->end(); 
	}
?>

<script type='text/javascript'>
	Cufon.refresh();
</script>