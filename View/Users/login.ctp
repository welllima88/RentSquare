<div class="register_form login_form">
<div class="register_wrapper">
<div class="login_wrapper">
    <?php echo $this->Session->flash(); ?>
    <h1 class="login_title">RentSquare Login</h1>
    <?php
    	echo $this->Form->create('User', array('action' => 'login', 'autocomplete' => 'off'));
			echo $this->Form->input('username', array('label' => '', 'placeholder' => 'Email Address','class'=>'email_login'));
			echo $this->Form->input('password', array('label' => '', 'placeholder'=>'Password','class'=>'pass_login'));
			//if (Configure::read('AutoLogin.active')) {
          echo $this->Form->input('auto_login', array('type'=>'checkbox', 'label'=>'Remember me'));
      //}
			echo $this->Html->link('Forgot your password?', array('controller' => 'Users', 'action' => 'requestreset'), array('id' => 'pwReset'));
			$options = array('label' => 'Login', 'name' => 'login', 'class' => 'login_button'
						);
			echo $this->Form->end($options);
    ?>
</div><!-- .login_wrapper -->
  <div class="clear"><br></div>
  <div class="register_register">
    Not a Member? <?php echo $this->Html->link('Register Now', array('controller' => 'Users', 'action' => 'register')); ?>
  </div><!-- register_login -->
</div><!-- .register_wrapper -->
</div><!-- .register_form -->
<div class="post_data" style="width: 100%; background-color:#fff;overflow:hidden;">
</div><!-- .post_data -->
