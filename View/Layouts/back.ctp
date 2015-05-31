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
	<title>RentSquare</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('reset');
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('jquery-ui-1.8.16.custom.css');
		echo $this->Html->css('chosen');
		echo $this->Html->css('back');
		echo $this->Html->css('validationEngine.jquery');
                //echo $this->Html->css('bootstrap-modal-carousel.css');
		
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		echo $this->Html->script('chosen.jquery.min.js');
		echo $this->Html->script('jquery.validationEngine.js');
		
	?>

        <script type="text/javascript">
           $( document ).ready(function() {
              $('.carousel').carousel({
                  interval: 18000
              })
           });
        </script>

	<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
</head>
<body>
	<?php if($user['type'] == USER_TYPE_MANAGER):
	        echo $this->element('sessionbar_manager');
	       elseif ($user['type'] == USER_TYPE_ADMIN):
	        echo $this->element('sessionbar_admin');
	       else:
	        echo $this->element('sessionbar_tenant'); 
	       endif;
	       ?>
	<div id="container">
		<div id='header'>
			<div class='center'>
				<?php echo $this->Html->link($this->Html->image('rslogo.png', array('id' => 'logo')), array('controller' => 'Users'), array('escape' => false)); ?>
				<div id='main-nav'>
			 		<?php 
			 		if($user['type'] == USER_TYPE_MANAGER):
	            echo $this->element('manager_nav');
          elseif ($user['type'] == USER_TYPE_ADMIN):
	            echo $this->element('admin_nav');
          else:
	            echo $this->element('tenant_nav'); 
          endif;
			 		
			 		?>
			 	</div><!-- .main-nav -->
		 	</div><!-- .center -->
		</div><!-- .header -->
		<div id='sub-header'>
			<?php
				if(isset($subheader)){
					echo $this->element($subheader);
				}
			?>
		</div>
	<div id="content_wrapper">
		<div id="content">
		<div id='content-header'>
				<?php
					if(isset($contentheader)){
						echo $this->element($contentheader);
					}
				?>
			</div>
			<div id='flash-container'><?php echo $this->Session->flash(); ?></div>
			<?php echo $content_for_layout; ?>

		</div>
		
		<div class='clear'><br><br><br></div>
		
	</div><!-- #content_wrapper -->
		<div id="footer">
    	<?php echo $this->element('footer'); ?>
    </div><!-- #footer -->
	
	</div>
	<?php
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
		echo $this->Html->script('less-1.2.2.min.js');		
		echo $this->Html->script('bootstrap.min.js');
		echo $this->Html->script('cufon-yui.js');
		echo $this->Html->script('Garamond_Premiere_Pro_400.font.js');
		echo $this->Html->script('HelveticaThin_250.font.js');
		echo $this->Html->script('back.js');
                echo $this->Html->script('jquery.blockUI.js');
		//echo $scripts_for_layout;
	?>
	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
