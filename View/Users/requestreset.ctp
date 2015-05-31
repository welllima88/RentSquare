<div class="register_form login_form">
<div class="register_wrapper">
<div class="request_reset_wrapper">
    <?php echo $this->Session->flash(); ?>
    <h1 class="reg_title no-margin-bottom">Forgot Your Password? </h1>
    <br><br>Please enter your email address:
    
    <?php
    	echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'requestreset'));
    	echo $this->Form->input('username', array('label' => '','placeholder' => 'Username or Email'));
    	$options = array('label' => 'Submit', 'name' => 'submit', 'class' => 'btn btn-success'
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


