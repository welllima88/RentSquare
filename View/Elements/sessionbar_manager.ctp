<div id='session-bar' class='black-grad'>
	<div class='center'>
		<div style='height: 20px'><span class='left acct_title_pm'><?php echo $this->Html->image("bkg-man-small.png", array("alt" => "Property Manager")); ?><?php echo $user['first_name'] .' '.$user['last_name']; ?>:&nbsp;&nbsp;&nbsp;</span>
			<div id='properties-list' class='left'>
			<?php 
				echo "<div id='current-property'><span class='prop_name'>";
				if(isset($curProp['name']) && $curProp['name'] !='') echo $curProp['name']; else echo 'No Active Properties';
				echo "</span><span class='green-arrow right'></span></div>";
			
				$propertiesList = array();
				foreach($properties as $property){
				  if($property['Property']['active']){
  				  $item = $this->Html->link($property['Property']['name'], array('controller' => 'Properties', 'action' => 'select', $property['Property']['id']));
            array_push($propertiesList, $item);
				  }
				}
        
				$propertiesList['new'] = $this->Html->link('<i class="icon-plus-sign icon-white"></i> Add New', array('controller' => 'Properties', 'action' => 'select', 'new'),array('escape'=>false));

				echo $this->Html->nestedList($propertiesList);
			?>
			</div>
			 <div class='right'>
			 <?php
			 	echo $this->Html->link('My Account', array('controller' => 'Users', 'action' => 'myaccount'));
			 	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('Log Out', array('controller' => 'Users', 'action' => 'logout'));
			?>
			</div>
		</div>

	</div>
</div>