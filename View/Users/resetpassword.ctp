<div class="register_form login_form">
<div class="register_wrapper">
<div class="request_reset_wrapper"  style="text-align:left;">
    <h1 class="reg_title no-margin-bottom">Reset Password</h1>
    <br><br>Please enter your new password:<br><br>
    <?php echo $this->Session->flash(); ?>
    
    <?php
    	echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'resetpassword'));
    	echo $this->Form->input('password', array('label' => 'New Password'));
    	echo $this->Form->input('confirm_password', array('label' => 'Confirm Password', 'type' => 'password'));
    	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $userid));
    	echo $this->Form->input('activation_key', array('type' => 'hidden', 'value' => $key));
    	$options = array('label' => 'Reset', 'name' => 'submit', 'class' => 'btn btn-success'
						);
			echo $this->Form->end($options);
    ?>

</div><!-- .login_wrapper -->
  <div class="clear"><br></div>
  <div class="register_register">
    Not a Member? <?php echo $this->Html->link('Register Now', array('controller' => 'Users', 'action' => 'register')); ?>
  </div><!-- register_login -->
</div><!-- #register_wrapper -->
</div><!-- #register_form -->



