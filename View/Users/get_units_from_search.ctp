<?php
	$unitList = array();
	if(empty($s_properties)){
  	  array_push($unitList, 'Sorry, no properties found. Try searching just by zip code.');
	} else {
    	foreach($s_properties as $s_property){
    	  $prop_state_id = $s_property['Property']['state_id'];
    		//$item = $this->Js->link($unit['Unit']['number'], array('controller' => 'Units', 'action' => 'view', $unit['Unit']['id']), array('update' => '#current-unit', 'class' => 'unit-item'));
    		$item = '<div class="prop_info"><h1 class="prop_name">'.$s_property['Property']['name'] . '</h1>'. $s_property['Property']['address'] . ', ' . $s_property['Property']['city'] . ', ' . $states[$prop_state_id] . ' ' . $s_property['Property']['zip'] .'</div><div class="select_property">' .
    		      $this->Html->link($this->Html->image("arrow_button.png", array("alt" => "Click Here to select Property")) . '<br>Select this <br>Property', array('controller' => 'Users','action' => 'residentsearch',  
    		      Security::cipher($user_id, 'R1ysi!84$0938sbe'),
    		      Security::cipher($s_property['Property']['id'], 'R1ysi!84$0938sbe')
    		      ), array('class'=>'select_prop','escape' => false));
    		array_push($unitList, $item);
    	}
	}

	echo '<br><br><div class="result_title"><span>Property Search Results</span><br>Click on your property to create a login</div>';
	echo $this->Html->nestedList($unitList, array('id' => 'unit_search', 'class' => 'radioList'), array('odd' => 'odd', 'even' => 'even'));
	echo $this->Js->writeBuffer();
?>
