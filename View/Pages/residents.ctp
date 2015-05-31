<section class="res_intro">
	<div class="wrapper animated fadeInDown">
		<h1>Improve Your<br>Residential Living Experience</h1>
	
		<p>RentSquare offers apartment residents a custom portal to pay rent online, submit maintenance requests, and communicate with building managers. Fully optimized to keep up with the fast-paced, on-the-go lifestyle of today’s renter, RentSquare allows residents to quickly and easily access their accounts from anywhere using a computer or mobile device.</p>

		<?php echo $this->Html->Link("Try RentSquare", array('controller' => 'Users', 'action' => 'register'), array('class' => 'btn btn-success home-cta', 'escape' => false));  ?> <a href="#more" id="res_learn_more">or learn more <span class="glyphicon glyphicon-chevron-down"></span></a>
	</div><!-- /.wrapper -->
</section><!-- res_intro -->

<section id="res_description" class="clearfix">
	<div class="wrapper">
		<h2>Rent Payments <span>Made Easy</span></h2>
		<p class="rent_online">You can pay almost any bill online, so why can’t you pay the rent online too?<br>
			Writing paper checks is a thing of the past. </p>
		<ul class="rent_pay_items">
			<li>
				<div class="image_wrap"><?php echo $this->Html->image('pay_rent_online.png', array('alt' => 'Pay Rent Online')); ?></div>
				<h3>Pay Rent<br>Online</h3>
				<p>Pay your rent conveniently online with just the click of a button. You can pay with any method of choice including credit card, debit card, or bank account (ACH).</p>
			</li>
			<li>
				<div class="image_wrap"><?php echo $this->Html->image('auto_payments.png', array('alt' => 'Automatic Rent Payments')); ?></div>
				<h3>Setup Automatic Rent Payments</h3>
				<p>Set up automatic rent payments and forget about the rest. We’ll make your payments for you automatically when the rent is due. </p>
			</li>
			<li>
				<div class="image_wrap"><?php echo $this->Html->image('split_with_roomate.png', array('alt' => 'Split Rent With Roommates')); ?></div>
				<h3>Split Rent With Roommates</h3>
				<p>You can split the rent with your roommates however you prefer. Your property manager will be able to see a detailed breakdown of who paid what.</p>
			</li>
			<li>
				<div class="image_wrap"><?php echo $this->Html->image('Safe-and-Secure.png', array('alt' => 'Safe and Secure')); ?></div>
				<h3>Safe and <br>Secure</h3>
				<p>Transactions are kept safe and secure by using SSL encryption and staying in compliance with PCI Data Security Standards.</p>
			</li>
			<li>
				<div class="image_wrap"><?php echo $this->Html->image('mobile_payments.png', array('alt' => 'Mobile Payments')); ?></div>
				<h3>Make Mobile<br>Payments</h3>
				<p>Our mobile optimized website enables you to check your account balance and make payments on-the-go from anywhere in the world. <br><?php echo $this->Html->link(h('Learn More About Mobile'),array('controller' => 'Pages', 'action' => 'mobile','full_base' => true),array('class'=>''));?></p>
			</li>
			<li>
				<div class="image_wrap"><?php echo $this->Html->image('rent_reminders.png', array('alt' => 'Rent Reminders')); ?></div>
				<h3>Get Reminded When Rent is Due</h3>
				<p>Never forget to pay the rent again. We’ll send you e-mail reminders automatically when your rent is due.</p>
			</li>
			<li>
				<div class="image_wrap"><?php echo $this->Html->image('payment_history.png', array('alt' => 'Payment History')); ?></div>
				<h3>View Payment <br>History</h3>
				<p>We’ll send you confirmations and keep a payment history so you can rest assured knowing your payment was received.</p>
			</li>
		</ul><!-- /.rent_pay_items -->
	</div><!-- /.wrapper -->
	
</section><!-- res_description -->
<section class="better_tools clearfix">
	<div class="wrapper">
		<div class="row">
			<div class="col-xs-7">
				<div class="better_tools_intro">
					<h2>Better Tools at Your Fingertips</h2>
					<p>RentSquare offers a selection of tools designed to make your life easier.</p>
				</div><!-- /.better_tools_intro -->
			</div><!-- /.col-xs-5 -->
			<div class="col-xs-8 col-xs-offset-1">
				<div class="tool-desc">
					<h3>Submit Maintenance Requests</h3>
					<p>Request maintenance on your unit easily through the resident portal. Your property manager can update the status of your request to keep you informed in real-time.</p>
					<?php echo $this->Html->image('submit_maint_req.png', array('alt' => 'Submit Maintenance Request')); ?>
				</div><!-- /.tool-desc -->
			</div><!-- /.col-xs-8 -->
			<div class="col-xs-8">
				<div class="tool-desc">
					<h3>Communicate With Your Property Manager</h3>
					<p>Communicate easily with building management. Simply login to the resident portal to send messages directly to your property manager about anything.</p>
					<?php echo $this->Html->image('message_property_manager.png', array('alt' => 'Message Property Manager')); ?>
				</div><!-- /.tool-desc -->				

			</div><!-- /.col-xs-8 -->
		</div><!-- /.row -->
	</div><!-- /.wrapper -->
</section><!-- .better_tools -->
