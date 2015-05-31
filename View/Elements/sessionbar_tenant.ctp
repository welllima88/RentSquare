	<div id='session-bar' class='black-grad'>
		<div class='center'>
			<div style="height: 20px">
			<div class='left acct_title_res'><?php echo $this->Html->image("bkg-res-small.png", array("alt" => "Resident")); ?><?php echo $user['first_name'] .' '.$user['last_name']; ?></div>
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