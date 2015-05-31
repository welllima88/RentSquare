<div id='home-intro'>
	<div class="wrapper animated fadeInDown">
		<h1 class="">Better Tools for<br>
		Apartment Managers &amp; Residents</h1>
		<br>
		<?php echo $this->Html->Link("Try RentSquare", array('controller' => 'Users', 'action' => 'register'), array('class' => 'btn btn-success home-cta', 'escape' => false));  ?> <a href="#more" id="learn_more">or learn more <span class="glyphicon glyphicon-chevron-down"></span></a>
	</div><!-- /.wrapper -->
</div><!-- #home-intro -->

<div id="rs_description" class="wrapper">
	<div class="row">
		<div class="col-xs-24 col-sm-12 pull-right">
			<div class="online_pay_img">
				<?php echo $this->Html->image('Rentsquare-Online-Payment.png', array('alt' => 'Online Rent Payment with RentSquare','class'=>'space-right')); ?>
				<?php echo $this->Html->image('paynow-popup.png', array('alt' => 'PayNow','class' => 'pay-now-popup animated')); ?>
			</div><!-- /.online_pay_img -->
			
		</div><!-- /.col-xs-24 col-sm-12 -->
		<div class="col-xs-24 col-sm-12 pull-left">
			<h2>Online <span>Rent Payment</span></h2>

			We offer a complete online rent payment solution that allows residents to login anytime from their computer or mobile device to check their balance and make rent payments with credit card or electronic check (ACH). 
			<br><br>
			Our transactions are kept safe and secure by using SSL encryption and staying in compliance with PCI Data Security Standards.
		</div><!-- /.col-xs-24 col-sm-12 -->
	</div><!-- /.row -->
	<br><br><br><br><br>
	<div class="row">
		<div class="col-xs-24 col-sm-12 pull-left">
			<?php echo $this->Html->image('Rentsquare-Unit-Billing-Management.png', array('alt' => 'Online Rent Payment with RentSquare','class'=>'space-left')); ?>
		</div><!-- /.col-xs-24 col-sm-12 -->
		<div class="col-xs-24 col-sm-11 pull-right">
			<h2>Unit <span>Billing &amp; Management</span></h2>

			Property Managers have the ultimate flexibility to customize their billing settings for each unit. Property Managers can add custom charges (for parking, storage, etc.), choose their desired billing frequency, and apply rental concessions to any specific billing period. 
			<br><br>
			With the click of a button, Property Managers can track their payments and easily view if there are any delinquencies.
		</div><!-- /.col-xs-24 col-sm-12 -->
	</div><!-- /.row -->
</div><!-- /.rs_description -->
<section class="points_slider">
	
	<!-- empty element for pager links -->
	<div id="per-slide-template" class="center external"></div>
	<div class="cycle-slideshow points_slideshow" 
	    data-cycle-slides="div.point_slide" 
     	data-cycle-log="false"
	    data-cycle-pager="#per-slide-template"
	    data-cycle-pause-on-hover="true" 
	    data-cycle-fx="scrollHorz"
	    data-cycle-update-view="1" 
	    data-cycle-timeout="8000"
	    >
	    <div class="point_slide maintenance_slide" data-cycle-pager-template="<a href='#' class='first'>Maintenance</a>">
	    	<div class="wrapper">
	    		<div class="row">
	    			<div class="col-xs-12">
	    				<h2>Maintenance Requests</h2>

						<p>Residents can submit maintenance requests for their units online. Property Managers can track these requests and keep the residents informed by updating the status.
						<br><br><br><br>
						<?php echo $this->Html->image('maintenance-req-icons.png', array('alt' => 'Manage maintenance request with RentSquare')); ?>
						</p>
	    			</div><!-- /.col-xs-10 -->
	    			<div class="col-xs-11 col-xs-push-1">
	    				<?php echo $this->Html->image('maint_screenshot.png', array('alt' => 'Manage Maintenance Requests easily with RentSquare')); ?>
	    			</div><!-- /.col-xs-10 -->
	    		</div><!-- /.row -->
	    	</div><!-- /.wrapper -->
	    	
	    </div><!-- /.point_slide -->
		<div class="point_slide messaging_slide" data-cycle-pager-template="<a href='#' class='middle'>Messaging</a>">
	    	<div class="wrapper">
				<h2>Resident Messaging</h2>

				<p>Property Managers can communicate more efficiently and effectively with residents in the their buildings by sending messages directly to individual users or creating community-wide announcements.
				<br><br>
				<?php echo $this->Html->image('rentsquare-messaging.png', array('alt' => 'RentSquare Messaging')); ?>
				</p>
	    	</div><!-- /.wrapper -->
	    </div><!-- /.point_slide -->
	    <div class="point_slide mobile_point_slide" data-cycle-pager-template="<a href='#' class='last'>Mobile</a>">
	    	<div class="wrapper">
	    		<div class="row">
	    			<div class="col-xs-7 col-xs-push-1 mobile_slide_image">
	    				<?php echo $this->Html->image('RentSquare-On-Mobile-Phone.png', array('alt' => 'RentSquare On Mobile Phone')); ?>
	    			</div><!-- /.col-xs-8 -->
	    			<div class="col-xs-12 col-xs-push-3">
	    				<h2>Mobile Connectivity</h2>

						<p>RentSquare Mobile gives residents the convenience to check their balance and make payments  on-the-go from anywhere in the world.

						<br><br><br>
						<?php echo $this->Html->image('mobile-icons-slider.png', array('alt' => 'RentSquare is mobile friendly')); ?>
						</p>
	    			</div><!-- /.col-xs-16 -->
	    		</div><!-- /.row -->
	    	</div><!-- /.wrapper -->
	    </div><!-- /.point_slide -->
	    <div class="cycle-prev"><?php echo $this->Html->image('left-slider.png', array('alt' => 'Previous Slide')); ?></div>
    	<div class="cycle-next"><?php echo $this->Html->image('right-slider.png', array('alt' => 'Next Slide')); ?></div>
	</div>
		
</section><!-- .points_slider -->
<section class="rs_benefits">
	<div class="wrapper">
		<h2>RentSquare is loaded with amazing features</h2>
		<span class="benefit_heading">A Few Reasons Why You’ll Love RentSquare</span>
		<ul class="first_row">
			<li class="benefit_save_time">
				<h3>Save Time</h3>
				<p>We allow you to spend less time on mundane tasks and focus on executing your business plan.</p>
			</li>
			<li class="benefit_decrease_cost">
				<h3>Decrease Costs</h3>
				<p>We reduce the workload so you can staff your projects more efficiently.</p>
			</li>
			<li class="benefit_reduce_workload">
				<h3>Reduce Workload</h3>
				<p>The RentSquare system allows you to do more with less. Get more free time!</p>
			</li>
			<li class="benefit_go_green">
				<h3>Go Green</h3>
				<p>Our paperless system helps you reduce your carbon footprint.</p>
			</li>
			<li class="benefit_improve_coll">
				<h3>Improve Collections</h3>
				<p>Rent reminders, late fees, and payment options keep residents paying on time improving cash flow.</p>
			</li>
		</ul>
		<ul>
			<li class="benefit_building_amenity">
				<h3>Building Amenity</h3>
				<p>Our resident portal helps set your property apart from the competition.</p>
			</li>
			<li class="benefit_retain_residents">
				<h3>Retain Residents</h3>
				<p>Keeping residents happy improves lease retention and reduces unit turnover.</p>
			</li>
			<li class="benefit_comm_better">
				<h3>Communicate Better</h3>
				<p>Good communication is  the key to keeping your residents happy.</p>
			</li>
			<li class="benefit_happier_res">
				<h3>Happier Residents</h3>
				<p>Everyone’s job is easier when the residents are happy and stay happy.</p>
			</li>
		</ul>
	</div><!-- /.wrapper -->
</section><!-- .rs_benefits -->
	
