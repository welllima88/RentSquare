<div id="side_nav">
	<ul>
		<li><?php echo $this->Html->link(h('About Us'), 
		                      array('controller' => 'pages', 'action' => 'about', 'full_base' => true),
		                      array('class'=>'active')
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
		                      array('class'=>'')
		                  );?></li>
		<li><?php echo $this->Html->link(h('Terms of Service'), 
		                      array('controller' => 'pages', 'action' => 'terms', 'full_base' => true),
		                      array('class'=>'')
		                  );?></li>
	</ul>
</div><!-- #side_nav -->
<div id="page_wrapper">
	<h1>About Rent Square</h1>
  <h2>RentSquare is the leading one-stop-shop for apartment living and property management. </h2>
  
  
  <div class="one_half">
  	<p>Our system streamlines the relationship between the property manager and the building’s residents so that everything just works easier. We’ve designed our products with the end user in mind. With a simple and eloquent interface, we’ve created an effortless ecosystem where the property manager can do everything from collect rent online, view property level reports, track payments, manage maintenance issues, and communicate with building residents. Each tool we offer is specifically designed to address the nuances that can often make property management a pain for all parties involved.</p>
  </div><!-- .one_half -->
  <div class="one_half last">
  	<?php echo $this->Html->image('about_rs_screenshot.png', array('alt' => 'Rent Square Screenshot')); ?>
  </div><!-- .one_half -->
  <div class="clear"></div>
  <div class="about_icons">
  	<div class="one_fifth">
    	  <?php echo $this->Html->image('pigbank.png', array('alt' => 'Collect Rent Online with RentSquare','align'=>'left')); ?> Collect Rent Online
    </div><!-- .one_fifth -->  
    <div class="one_fifth">
    	<?php echo $this->Html->image('propertyreports.png', array('alt' => 'View Property Level Reports with RentSquare','align'=>'left')); ?>View Property Level Reports
    </div><!-- .one_fifth -->
    <div class="one_fifth">
      <?php echo $this->Html->image('trackpayments.png', array('alt' => 'Track payments with RentSquare','align'=>'left')); ?>Track Payments
    </div><!-- .one_fifth -->
    <div class="one_fifth">
    	<?php echo $this->Html->image('managemaintenanceissues.png', array('alt' => 'Manage Maintenance Issues with RentSquare','align'=>'left')); ?>Manage Maintenance Issues
    </div><!-- .one_fifth -->
    <div class="one_fifth">
    	<?php echo $this->Html->image('communicatewithbuildingresidents.png', array('alt' => 'Communicate With Building Residents with RentSquare','align'=>'left')); ?>Communicate With Building Residents
    </div><!-- .one_fifth -->

  </div><!-- .about_icons -->
  
  <div class="clear"></div>
  <h2>For residents, we offer a variety of services that help improve and enhance the rental experience.</h2>
  <div class="one_half">
  	<?php echo $this->Html->image('maintenancescreen.png', array('alt' => 'RentSquare Screenshot')); ?>
  </div><!-- .one_half -->
  <div class="one_half last align-right">
  	<p>Our online and mobile services are tailored to meet the demands of the fast-paced, on-the-go lifestyle of today’s renter. The availability of our services are needed today more than ever. We allow residents to quickly and easily access their accounts from anywhere to pay their rent, request maintenance on their unit, and communicate with their property manager.  The results have been astounding, leading to happier residents and improved collections.</p>
 
  </div><!-- .one_half -->
  <div class="clear"></div>
  <div class="designedby">
  	<div class="one_half">
  		<h2>Designed by a team of real estate industry professionals</h2>

      <p>RentSquare is designed by a team of real estate industry professionals who have first-hand experience in managing multi-family properties. We’ve managed apartments ourselves, and know how painful it can be. That is why we set out to build the most dynamic and easy-to-use platform for our customers. We are dedicated to our craft and constantly working to perfect our product. We take pride in our work, and are pleased to bring you the best-in-class online property management service!</p>
  	</div><!-- .one_half -->
  	<div class="one_half last align-right">
  		<?php echo $this->Html->image('professionals.png', array('alt' => 'CakePHP')); ?>
  	</div><!-- .one_half -->
  </div><!-- .designedby -->
  <div class="clear"></div>
  <div class="get_started">
  	<h2>Life just got a whole lot easier!</h2>

      <p>With our practical and easy-to-use platform, RentSquare is simply the best solution to seamlessly integrate all of your property management needs into one place. Let us help make your life easier!
      <br><br>
      Say goodbye to the hassle of renting <?php echo $this->Html->link(h('Get Started'), 
                            array('controller' => 'users', 'action' => 'register', 'full_base' => true),
                            array('class'=>'blue_button')
                        );?>
      </p><br><br><br><br>
  </div><!-- .get_started -->
  </div><!-- .page_wrapper -->
<div class="clear"></div>