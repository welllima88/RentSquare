<div id="side_nav">
	<ul>
		<li><?php echo $this->Html->link(h('About Us'), 
		                      array('controller' => 'pages', 'action' => 'about', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Contact'), 
		                      array('controller' => 'pages', 'action' => 'contact', 'full_base' => true),
		                      array('class'=>'active')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Privacy'), 
		                      array('controller' => 'pages', 'action' => 'privacy', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Security'), 
		                      array('controller' => 'pages', 'action' => 'security', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Terms of Service'), 
		                      array('controller' => 'pages', 'action' => 'terms', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
	</ul>
</div><!-- #side_nav -->
<div id="page_wrapper">
  <div class="two_thirds">
  	  <h1>Contact Rent Square</h1>
      Whether you want to know more about our services, or have a question about your personal RentSquare account, we would love to hear from you!  You can call us at 1-800-555-5555 or <a href="mailto:customersupport@rentsquare.com">email our customer support team</a> and we will promptly get back to you.
  </div><!-- .two_thirds -->
  <div class="one_third">
  	 <?php echo $this->Html->image('contact-image.png', array('alt' => 'Contact RentSquare','align'=>'right','class'=>'contact_image')); ?>
  </div><!-- .one_third -->
 	<div class="clear"></div>
    
  <div class="contact-section">
  <br><br><br>        
          <div class="one_third">
           	 <h4>Give us a call:</h4>
                <strong>1-800-555-5555</strong><br>
                Monday-Friday, 8am-11pm, EST<br>
                Saturday, 9am-6pm, EST<br>
           </div><!-- .one_half -->
           <div class="one_third">
           	   <h4>Email us:</h4>
                <a href="mailto:customersupport@rentsquare.com">customersupport@rentsquare.com</a><br>
                A customer care representative will respond to you within 24 hours
           </div><!-- .one_half -->
           <div class="one_third">
           	<h4>Reach Us Immediately</h4>
           </div><!-- .one_third -->          
          	
     </div><!-- .contact-section -->
     
</div><!-- .page_wrapper -->
<div class="clear"><br><br><br><br></div>