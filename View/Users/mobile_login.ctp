<div class="login_outer">
<div class="mobile_wrapper">
<div id='header-container'>
<div id='rs_logo'>
	<?php echo $this->Html->link($this->Html->image('rslogo.png', array('id' => 'logo')), '/', array('escape' => false)); ?>
		<div class="clear"></div>
	</div>
</div><!-- rslogo -->
<br>
<div class="register_form login_form">
<div class="register_wrapper">
<div class="login_wrapper">
    <?php echo $this->Session->flash(); ?>
    <?php
    	echo $this->Form->create('User', array('action' => 'login', 'autocomplete' => 'off'));
			echo $this->Form->input('username', array('label' => '', 'placeholder' => 'Email Address', 'class'=>'email_login'));
			echo $this->Form->input('password', array('label' => '', 'placeholder' => 'Password','class'=>'pass_login'));
			$options = array('label' => 'Sign In', 'name' => 'login', 'class' => 'login_button'
						);
			echo $this->Form->end($options);
    ?>
</div><!-- .login_wrapper -->
  <div class="clear"><br></div>

</div><!-- .register_wrapper -->
</div><!-- .register_form -->
</div><!-- .mobile_wrapper -->
</div><!-- login_outer -->
<script>
  jQuery(function(){
  	jQuery('.login_outer').delay(200).fadeIn(1800);
  });
</script>
