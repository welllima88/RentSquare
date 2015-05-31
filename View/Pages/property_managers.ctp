<section class="pm_intro">
	<div class="wrapper animated fadeInDown">
		<h1>Custom Tools<br>
		Designed For Property Managers</h1>
	
		<p>RentSquare offers a complete property management solution that enables you to collect rent online, track payments, manage maintenance issues, and communicate with building residents. All of these features are combined into one simple and easy-to-use platform that is streamlined for property managers to work more efficiently then ever before.</p>

		<ul>
			<li class="click_nav pm_collect_rent"><a href="#collect_rent">Collect Rent<br>Online</a></li>
			<li class="click_nav pm_res_billing"><a href="#res_billing">Customize &amp; Manage<br>Resident Billing</a></li>
			<li class="click_nav pm_maint_req"><a href="#maint_req">Manage Maintenance<br>Requests</a></li>
			<li class="click_nav pm_comm_res"><a href="#comm_res">Communicate with<br>Building Residents</a></li>
			<li class="click_nav pm_get_pricing"><a href="#get_pricing">Get<br>Pricing</a></li>
		</ul>
	</div><!-- /.wrapper -->
</section><!-- pm_intro -->
<section id="collect_rent" class="clearfix">
	<div class="wrapper">
		<h2>Collect <span>Rent Online</span></h2>
		<div class="col-xs-12">
			
			<div class="rs_point res_portal">
				<h3>Resident Payment Portal</h3>
				<p>Residents can log in to their secure portal to check account balances and make payments from their computer or mobile device.</p>
			</div><!-- .rs_point -->
			
			<div class="rs_point auto_billing">
				<h3>Automated Billing</h3>
				<p>Customize the frequency that you collect the rent and residents are billed automatically when the rent is due.</p>
			</div><!-- /.rs_point -->

			<div class="rs_point cc_ach">
				<h3>Credit/Debit Card and Electronic Check (ACH) </h3>
				<p>Residents can make rent payments with any method they prefer. Cash or check payments can still be recorded in the system.</p>
			</div><!-- /.rs_point -->
			
			<div class="rs_point safe_secure">
				<h3>Safe and Secure</h3>
				<p>Transactions are kept safe and secure by using SSL encryption and staying in compliance with PCI Data Security Standards.</p>
			</div><!-- /.rs_point -->
			
		</div><!-- /.col-xs-24 col-sm-11 -->
		<div class="col-xs-12">
			<?php echo $this->Html->image('rentsquare-pm-image.jpg', array('alt' => 'RentSquare', 'align'=>'right','class'=>'rs_pm_img')); ?>
		</div><!-- /.col-xs-24 col-sm-12 col-sm-push-1 -->
	</div><!-- /.wrapper -->
	

</section><!--  .collect_rent -->
<section id="res_billing">
	<div class="wrapper">
		<h2>Customize &amp; Manage Resident Billing</h2>
		<div class="res_bill_img">
			<?php echo $this->Html->image('res_billing.png', array('alt' => 'Customize and Manage Resident Billing')); ?>
			<?php echo $this->Html->image('res_billing_popup.png', array('alt' => 'Resident Billing with RentSquare','class'=>'res_bill_popup animated')); ?>
		</div><!-- /.res_bill_img -->

		<ul class="res_billing_content">
			<li class="rs_trac_payments">
				<h3>Track<br>Payments</h3>
				<p>View who has paid their rent and who is late in real-time with the click of a button.</p>
			</li>
			<li class="rs_cust_billing">
				<h3>Customize Billing<br>Settings</h3>
				<p>Add recurring or one-time fees for base rent, security deposits, parking, storage, pets, or anything else. </p>
			</li>
			<li class="rs_rental_concessions">
				<h3>Add Rental Concessions</h3>
				<p>Add rental concessions to any billing periods you choose.</p>
			</li>
			<li class="rs_rent_reminder">
				<h3>Send Resident<br>Rent Reminders</h3>
				<p>Keep residents paying on time with custom rent reminders. Set up automatic rent reminders so you don’t have to lift a finger.</p>
			</li>
			<li class="rs_late_fee">
				<h3>Add Late Fees</h3>
				<p>Charge late fees on a case-by-case basis, or customize your settings to charge late fees automatically if rent is past due beyond the grace period that you choose.</p>
			</li>
		</ul><!-- /.res_billing_content -->
		
	</div><!-- /.wrapper -->
</section><!--  .res_billing -->
<section id="maint_messaging">
	<div class="row">
		<div class="col-xs-12 bkg_maint_req">
			<div id="maint_req">
				<h2>Manage<br>Maintenance Requests</h2>
				<h3>Receive Maintenance Notifications</h3>
				<p>Receive notifications when a residents requests maintenance on their unit so you can respond quickly and keep your residents happy.</p>


				<h3>Track Maintenance Requests</h3>
				<p>View all your unit maintenance requests and update the status to notify residents whether they are in process or complete.</p>


				<h3>Send to Vendors</h3>
				<p>Forward maintenance tickets to your vendors directly from within the portal. Your vendor will receive a summary of the issue complete with a description and photos.</p>

			</div><!-- #maint_req -->
		</div><!-- .col-xs-12 -->
		<div class="col-xs-12 bkg_comm_res">
			<div id="comm_res">
				<h2>Communicate with<br>Building Residents</h2>

				<h3>Send Personalized Messages</h3>
				<p>Send personalized messages to communicate directly with residents in your building.</p>


				<h3>Create Community Announcements</h3>
				<p>Create community-wide announcements to distribute messages to your residents quickly and easily.</p>

			</div><!-- #comm_res -->
		</div><!-- .col-xs-12 -->
	</div><!-- /.row -->
</section><!--  .maint_req -->
<section id="get_pricing">
	<div class="wrapper">
		<h2><span>Pricing</span><br>
		Everything You Need. One Low Monthly Fee</h2>

		<h3>RentSquare is available for a low monthly fee based on the number of units you manage (per building). All plans include technical support, automatic software upgrades, unlimited users, and many other great features. Enter the number of units you manage in a particular building below to see what the monthly fee will be for that building:</h3>
		<div class="price_meter">
        <h4>How many units do you manage?</h4>

        <div class="input-container">
            <input type="text" class="input-units" id="input-units" maxlength="6" value="25"><label class="units-placeholder" for="input-units">Units</label>
        </div>

        <div class="price-slider-wrapper clearfix">
        <a class="price-icon icon-left" href="#">
            <?php echo $this->Html->image('icon-house.png', array('alt' => 'RentSquare')); ?>
        </a>

        <div id="pricing-slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
        <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style=""></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style=""></a></div>
        <a class="price-icon icon-right" href="#">
            <?php echo $this->Html->image('icon-building.png', array('alt' => 'RentSquare Multi-Units')); ?>
        </a>
		</div><!-- price-slider-wrapper -->
        <div class="units-legend">
            <label class="label-1">0</label>
            <label class="label-2">25</label>
            <label class="label-3">50</label>
            <label class="label-4">75</label>
            <label class="label-5">100</label>
            <label class="label-6">150</label>
            <label class="label-7">200</label>
            <label class="label-8">250</label>
            <label class="label-9">300</label>
            <label class="label-10">350</label>
            <label class="label-11">400</label>
            
        </div>

        <p class="plan-cost"><strong>$<span id="monthlyPricing">25</span></strong> / month

        </p><p class="plan-units">up to <span id="unitCount">25</span> units
        </p>

        <p class="more-units" style="display: none;">More than 4,400 units? We’ve got you covered. <a href="/contact-us" id="contactUsLink">Contact
                us now for
                pricing.</a></p>

        <span class="plan-note">
                A one-time fee equal to one month of service is also charged to process your application and setup your account.
        </span>
		</div><!-- /.price_meter -->
	</div><!-- /.wrapper -->
	
</section><!--  .get_pricing -->
<section class="trans_fees">
	<div class="wrapper">
		<div class="row">
			<div class="col-xs-10">
				<div class="fee_intro">
					We charge a small transaction fee when<br>residents make electronic rent<br>payments with us online. 
				</div><!-- /.fee_desc -->
			</div><!-- /.col-xs-10 -->
			<div class="col-xs-7">
					<p class="transfee_amt">$3.95</p>
					<p class="transfee_desc">Per Electronic Check (ACH) Transaction</p>
					<?php echo $this->Html->image('ach_icon.png', array('alt' => 'RentSquare accepts ACH Trnasactions')); ?>
			</div><!-- /.col-xs-7 -->
			<div class="col-xs-7">
				<p class="transfee_amt">2.75%</p>
				<p class="transfee_desc">Per Credit or Debit Card Transaction</p>
				<?php echo $this->Html->image('credit_cards_accepted.png', array('alt' => 'RentSquare accepts Master Card, Visa, and Discover Card')); ?>
			</div><!-- /.col-xs-7 -->
		</div><!-- /.row -->
	</div><!-- /.wrapper -->
</section><!-- .trans_fees -->

<section class="flexible_pricing">
	<div class="wrapper">
		<div class="row">
			<div class="col-xs-8">
				<div class="fee_intro">
					<h2>Flexible Pricing Options</h2>
					<p>Choose a model that’s best for your business:</p>
				</div><!-- /.fee_desc -->
			</div><!-- /.col-xs-8 -->
			<div class="col-xs-8">
				<div class="price_option">
					<p class="po_title">Incurred Pricing Model</p>
					<p class="po_desc">If your goal is to maximize e-payments among your residents to save time and effort processing traditional forms of payment, you may choose to incur the cost of the processing fees on behalf of your residents. Incurring the transaction fee leads to higher usage rates as more residents are encouraged to use a service that is free.</p>
				</div><!-- /.price_otption -->
			</div><!-- /.col-xs-8 -->
			<div class="col-xs-8">
				<div class="price_option">
					<p class="po_title">Passed Pricing Model</p>
					<p class="po_desc">If your goal is to implement a virtually cost-free payment processing model for your business, you may choose to pass the processing fee on to your residents. Passing the processing fee on to your residents will allow you to implement an electronic payments program quickly with minimal costs.</p>
				</div><!-- /.price_otption -->	
			</div><!-- /.col-xs-8 -->
		</div><!-- /.row -->
	</div><!-- /.wrapper -->

</section><!-- .flexible_pricing -->