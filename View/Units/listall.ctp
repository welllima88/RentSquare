<?php
	$unitList = array();
	foreach($units as $unit){
		$item = $this->Js->link($unit['Unit']['number'], array('controller' => 'Units', 'action' => 'view', $unit['Unit']['id']), array('update' => '#current-unit', 'class' => 'unit-item'));
		array_push($unitList, $item);
	}

	$this->Js->get('.unit-item')->event('click', "$('.unit-number').val($(this).html());");
	$this->Js->get('#unit-list-container li')->event('click', '$(this).find(".unit-item").click().click(radioList($(this)));');
	echo $this->Html->nestedList($unitList, array('id' => 'unit-list', 'class' => 'radioList'), array('odd' => 'odd', 'even' => 'even'));
	echo $this->Js->writeBuffer();
?>
