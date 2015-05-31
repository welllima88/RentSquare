<div id='footer-nav'>
		<?php
			echo $this->Html->link('About Us', array('controller' => 'pages', 'action' => 'about'), array('class' => 'footer-nav-item'));
			echo $this->Html->link('Contact', array('controller' => 'pages', 'action' => 'contact'), array('class' => 'footer-nav-item'));
			echo $this->Html->link('Privacy', array('controller' => 'pages', 'action' => 'privacy'), array('class' => 'footer-nav-item'));
			echo $this->Html->link('Security', array('controller' => 'pages', 'action' => 'security'), array('class' => 'footer-nav-item'));
			echo $this->Html->link('Terms of Service', array('controller' => 'pages', 'action' => 'terms'), array('class' => 'footer-nav-item last'));
		?>
		<p class='right copy'>&copy; RentSquare, LLC.  All Rights Reserved.</p>
	</div><!-- #footer-nav -->