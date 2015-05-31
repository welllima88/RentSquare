<div id='session-bar' class='black-grad'>
	<div class='center'>
		<div style='height: 20px'><span class='left acct_title_pm'><?php echo $this->Html->image("bkg-man-small.png", array("alt" => "Property Manager")); ?><?php echo $user['first_name'] .' '.$user['last_name']; ?></span>
			
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