<div class="mobile_wrapper">
<div id='header-container'>
<div id='rs_logo'>
	<?php echo $this->Html->link($this->Html->image('rslogo.png', array('id' => 'success_logo')), '/', array('escape' => false)); ?>
		<div class="clear"></div>
	</div>
</div><!-- rslogo -->
<br>
<div class="success_mobile">
  <?php echo $this->Html->image('success_check.png', array('alt' => '','class'=>'success_image')); ?><br>
	<div class="large_text">Success!</div><br>
	You’ve made a payment of $<?php echo $amount ?> to <?php echo $unit['Property']['name']; ?>.<br><br>  

  Check your email for a receipt.<br><br>  
  <?php echo $this->Html->link(h('Home'),array('controller' => 'Payments', 'action' => 'index','full_base' => true),array('class'=>'green_text'));?>&nbsp; | &nbsp;
  <?php echo $this->Html->link(h('Full Site'),array('controller' => 'Users', 'action' => 'visitFullSite','full_base' => true),array('class'=>'green_text'));?>&nbsp; | &nbsp;
	<?php echo $this->Html->link(h('Logout'),array('controller' => 'Users', 'action' => 'logout','full_base' => true),array('class'=>'green_text'));?>
			
			
</div><!-- .success_mobile -->
</div><!-- .mobile_wrapper -->


