<div class="wrapper">
	<div id='footer-nav'>
		<?php
			echo $this->Html->image('rs-logo-footer.png', array('alt' => 'RentSquare Logo'));
			echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'index'), array('class' => 'main-nav-item'));
			echo $this->Html->link('About', array('controller' => 'Pages', 'action' => 'about'), array('class' => 'main-nav-item'));
			echo $this->Html->link('Property Managers', array('controller' => 'Pages', 'action' => 'property_managers'), array('class' => 'main-nav-item'));
			echo $this->Html->link('Residents', array('controller' => 'Pages', 'action' => 'residents'), array('class' => 'main-nav-item'));
			echo $this->Html->link('Mobile', array('controller' => 'Pages', 'action' => 'mobile'), array('class' => 'main-nav-item main-nav-item-last'));
			echo $this->Html->link('Contact', array('controller' => 'pages', 'action' => 'contact'), array('class' => 'footer-nav-item'));
		?>
		<a target="_blank" href="#" class="footer_social"><span class="genericon genericon-facebook-alt"></span></a>
		<a target="_blank" href="https://twitter.com/RentSquare" class="footer_social"><span class="genericon genericon-twitter"></span></a>
		<a target="_blank" href="#" class="footer_social"><span class="genericon genericon-linkedin"></span></a>
		<a target="_blank" href="http://instagram.com/rentsquare" class="footer_social"><span class="genericon genericon-instagram"></span></a> 
                <?php
                   //echo $this->Html->link($this->Html->image('instagram-icon.png', array('alt' => 'Instagram Logo')),'http://instagram.com/rentsquare',array('class' => 'footer_social', 'target' => '_blank', 'escape' => false));
                ?>
		<div class="clear"></div>
		<div class="footer_credits">
			<?php 
				echo $this->Html->link('Privacy Policy', array('controller' => 'pages', 'action' => 'privacy'), array('class' => 'footer-nav-item'));
				echo $this->Html->link('Terms of Service', array('controller' => 'pages', 'action' => 'terms'), array('class' => 'footer-nav-item last'));
			 ?>
			<span style="margin-right: 17px">&nbsp;</span> &copy; RentSquare, LLC.  All Rights Reserved.
		</div><!-- /.footer_credits -->
	</div><!-- #footer-nav -->
</div><!-- /.wrapper -->
