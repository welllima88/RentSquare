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
<!DOCTYPE> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		RentSquare
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('reset');
		echo $this->Html->css('chosen');
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('front');
		echo $this->Html->css('register');
		echo $this->Html->css('validationEngine.jquery');
		
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js');
		echo $this->Html->script('chosen.jquery.min.js');
		echo $this->Html->script('jquery.validationEngine.js');
		
		
	?>
	<!--[if IE 7]>
		<?php echo $this->Html->css('ie7'); ?>
	<![endif]-->
</head>
<body>
<div class="reg_wrapper">
<?php echo $this->Html->image('bkg-Reg-RentSquare.jpg',array('class'=>'bg')); ?>
	<div id="container">
		<div id='header-container'>
  		<div id='rs_logo'>
				<?php echo $this->Html->link($this->Html->image('rslogo.png', array('id' => 'logo')), '/', array('escape' => false)); ?>
      		<div class="process_steps">
        		<div class="step_1 step_item"><div class="steps_circle">1</div></div>
        		<div class="step_2 step_item"><div class="steps_circle">2</div></div>
        		<div class="step_3 step_item"><div class="steps_circle">3</div></div>
      		</div><!-- .process_steps -->
      		<div class="clear"></div>
    		</div>
      </div><!-- rslogo -->
	
		<div id="content">
			
			<?php echo $content_for_layout; ?>

		</div>
		
		<div id="push"></div>
</div><!-- #container -->
<div class="regpush"></div>		
</div><!-- reg_wrapper -->
<div class="regfooter">
  <?php echo $this->element('footer'); ?>

</div><!-- regfooter -->

	<?php
		echo $this->Html->script('less-1.2.2.min.js');		
		echo $this->Html->script('cufon-yui.js');
		echo $this->Html->script('Garamond_Premiere_Pro_400.font.js');
		echo $this->Html->script('HelveticaThin_250.font.js');
		//echo '<script type="text/javascript" src="http://fast.fonts.com/jsapi/a0be6cc6-5c18-4b6a-bb78-d79f604f986f.js"></script>';
		echo $this->Html->script('bootstrap.min.js');
		echo $this->Html->script('front.js');
		echo $this->Html->script('register.js');
		//echo $scripts_for_layout;
	?>
	<script type='text/javascript'>
	$(function(){
		$('input[placeholder]').placeholder();
	});
	</script>
	<?php //echo $this->element('sql_dump'); ?>
	<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
