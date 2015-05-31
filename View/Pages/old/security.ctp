<div id="side_nav">
	<ul>
		<li><?php echo $this->Html->link(h('About Us'), 
		                      array('controller' => 'pages', 'action' => 'about', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Contact'), 
		                      array('controller' => 'pages', 'action' => 'contact', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Privacy'), 
		                      array('controller' => 'pages', 'action' => 'privacy', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Security'), 
		                      array('controller' => 'pages', 'action' => 'security', 'full_base' => true),
		                      array('class'=>'active')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Terms of Service'), 
		                      array('controller' => 'pages', 'action' => 'terms', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
	</ul>
</div><!-- #side_nav -->
<div id="page_wrapper">
<div class="two_thirds">
	<h1>We Take <span>Security</span> Seriously</h1>
  <p>Protecting your security is extremely important to us. Your trust is a privilege that is our first priority. That is why we've put in place some of the strongest technology and practices to protect your information.</p>
</div><!-- .two_thirds -->
<div class="one_third align-center">
	<?php echo $this->Html->image('lock.png', array('alt' => 'lock','class'=>'lock_image')); ?>
</div><!-- .one_third -->
<div class="clear"></div><br><br>
<div class="one_half">
	<h2 class="h2_security">PCI compliant</h2>

  <p>The PCI DSS certification process is designed to protect your sensitive data. WePay is a certified Level 1 PCI Compliant Service Provider (the highest level), which requires an annual independent security audit of our processes and systems. We test our system daily (manually and automatically) to ensure security.</p>
</div><!-- .one_half -->
<div class="one_half last">
	
</div><!-- .one_half -->
</div><!-- .page_wrapper -->
<div class="clear"><br><br><br><br></div>