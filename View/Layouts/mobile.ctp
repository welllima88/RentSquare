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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('reset');
		echo $this->Html->css('chosen');
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('mobile');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');		
		
	?>
	<!--[if IE 7]>
		<?php echo $this->Html->css('ie7'); ?>
	<![endif]-->
</head>
<body>
<div class="reg_wrapper">
	<div id="container">
	
		<div id="content">
			
			<?php echo $content_for_layout; ?>

		</div>
		
		<div id="push"></div>
</div><!-- #container -->
<div class="regpush"></div>		
</div><!-- reg_wrapper -->

	<?php
		echo $this->Html->script('less-1.2.2.min.js');		
		echo $this->Html->script('bootstrap.min.js');
    echo $this->Html->script('cufon-yui.js');
		echo $this->Html->script('Garamond_Premiere_Pro_400.font.js');
		echo $this->Html->script('HelveticaThin_250.font.js');
		echo $this->Html->script('front.js');
		//echo $scripts_for_layout;
	?>
	<script type='text/javascript'>
	$(function(){
		$('input[placeholder]').placeholder();
	});
	</script>
	<?php //echo $this->element('sql_dump'); ?>
	<?php //echo $this->Js->writeBuffer(); ?>
</body>
</html>