<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		RentSquare
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset');
	?>
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<?php
		echo $this->Html->css('bootstrap3.min.css');
		
		echo $this->Html->css('front');

		echo $scripts_for_layout;
		
	?>
</head>
<body class="preload">
	<div id="fixed-menu" class="animated">
		<div class="wrapper">
			<?php echo $this->Html->link($this->Html->image('Rentsquare-Small-Logo.png', array('class' => 'small_logo','alt'=>'Pay Rent Online with RentSquare')), '/', array('escape' => false)); ?>
			<?php 
				echo $this->Html->link('HOME', array('controller' => 'Pages', 'action' => 'index'), array('class' => 'main-nav-item'));
				echo $this->Html->link('ABOUT', array('controller' => 'Pages', 'action' => 'about'), array('class' => 'main-nav-item'));
				echo $this->Html->link('PROPERTY MANAGERS', array('controller' => 'Pages', 'action' => 'property_managers'), array('class' => 'main-nav-item'));
				echo $this->Html->link('RESIDENTS', array('controller' => 'Pages', 'action' => 'residents'), array('class' => 'main-nav-item'));
				echo $this->Html->link('MOBILE', array('controller' => 'Pages', 'action' => 'mobile'), array('class' => 'main-nav-item'));
				echo $this->Html->link('CONTACT', array('controller' => 'Pages', 'action' => 'contact'), array('class' => 'main-nav-item main-nav-item-last'));
				echo $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login'), array('class' => 'btn btn-primary signup_btn'));
				echo $this->Html->link('Sign Up', array('controller' => 'Users', 'action' => 'register'), array('class' => 'btn btn-success signup_btn'));
			?>
						
			</div><!-- #header -->
	</div><!-- /.fixed-menu -->
		<div id='header-container'>
			<div id='header' class="wrapper">
				<div class="row">
					<div class="col-xs-8">
						<?php echo $this->Html->link($this->Html->image('RentSquare-Logo.png', array('id' => 'logo','alt'=>'Pay Rent Online with RentSquare')), '/', array('escape' => false)); ?>
					</div><!-- /.col-xs-8 -->
					<div class="col-xs-16">
						<div id='login-signup'>
							<?php
								echo $this->Form->create('User', array('action' => 'login', 'autocomplete' => 'off'));
								echo $this->Form->input('username', array('label' => '', 'placeholder' => 'Email'));
								echo $this->Form->input('password', array('label' => '', 'placeholder' => 'Password'));
								
								$options = array('label' => 'Login', 'name' => 'login', 'class' => 'btn btn-primary');
								echo $this->Form->end($options);

								echo $this->Html->link('Sign Up', array('controller' => 'Users', 'action' => 'register'), array('class' => 'btn btn-success signup_btn'));
								//echo "<div class='clear'></div>";
								//echo $this->Html->link('Forgot your password?', array('controller' => 'Users', 'action' => 'requestreset'), array('id' => 'pwReset'));
							?>
						</div>
						<div class='clear'></div>
						<div id='main-nav'>
							<?php 
								echo $this->Html->link('HOME', array('controller' => 'Pages', 'action' => 'index'), array('class' => 'main-nav-item'));
								echo $this->Html->link('ABOUT', array('controller' => 'Pages', 'action' => 'about'), array('class' => 'main-nav-item'));
								echo $this->Html->link('PROPERTY MANAGERS', array('controller' => 'Pages', 'action' => 'property_managers'), array('class' => 'main-nav-item'));
								echo $this->Html->link('RESIDENTS', array('controller' => 'Pages', 'action' => 'residents'), array('class' => 'main-nav-item'));
								echo $this->Html->link('MOBILE', array('controller' => 'Pages', 'action' => 'mobile'), array('class' => 'main-nav-item'));
								echo $this->Html->link('CONTACT', array('controller' => 'Pages', 'action' => 'contact'), array('class' => 'main-nav-item main-nav-item-last'));
							?>
						</div>
						<div class='clear'></div>					
					</div><!-- /.col-xs-16 -->				
				</div><!-- /.row -->
			</div><!-- #header -->
		</div><!-- #header-container -->
	
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			
			<?php echo $content_for_layout; ?>

		</div><!-- #content -->
		
		

<div id="footer">
	<?php echo $this->element('footer-front'); ?>
</div><!-- #footer -->
	
	

	<?php
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js');
		echo $this->Html->script('bootstrap3.min.js');
		echo $this->Html->script('front.js');
	?>

	<?php //echo $this->element('sql_dump'); ?>
	<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
