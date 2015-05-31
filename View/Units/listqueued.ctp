<?php
	$tenantList = array();
	foreach($queuedTenants as $tenant){
		$item = $this->Form->input('Tenant.id.' . $tenant['User']['id'], array('label' => $tenant['User']['username'], 'type' => 'checkbox', 'value' => $tenant['User']['id']/*, 'style' => 'visibility: hidden; width: 0;'*/));
		array_push($tenantList, $item);
	}

	echo $this->Html->nestedList($tenantList, array('class' => 'checkList'), array('odd' => 'odd', 'even' => 'even'));
?>