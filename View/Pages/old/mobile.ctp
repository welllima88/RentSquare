</div> <!-- close content div with 960 wrapper -->

<div class="mobile_promo">
  <div class="content_wrapper">
  		<?php echo $this->Html->image('mobile-hand.png', array('alt' => '','class'=>'mobile_hand')); ?>
  		<div class="promo_content">
  			<h2>Pay Rent<br>
          On The Go.</h2>

          Anytime. Anywhere. All from the<br>
          convenience of your smart phone.<br><br><br>
          <?php echo $this->Html->link(h('Try RentSquare'),array('controller' => 'users', 'action' => 'register','full_base' => true),array('class'=>'white_button'));?> <a href="#learn_more" class="learn_more_mobile" id="learn_more"> or learn more &#x25BE;</a>
  		</div><!-- .promo_content -->
  </div><!-- .content_wrapper -->
</div><!-- .mobile_promo -->
<div class="mobile_slider">
  <div class="content_wrapper cycle-slideshow"
     data-cycle-slides="div.mobile_slide" 
     data-cycle-log="false">
	
	<div class="mobile_slide">
		<div class="slide_text">
			<h2>Simple and Elegant</h2>
      We designed RentSquare mobile to make your life easier, offering a new way to pay your rent in one beautiful interface. Writing paper checks is a thing of the past.
		</div><!-- .slide_text -->
		<div class="slide_img">
		  <?php echo $this->Html->image('simpleandelegant.jpg', array('alt' => 'RentSquare is simple to use!','class'=>'m_slide_img')); ?>
		</div><!-- .slide_img -->
	</div><!-- .mobile_slide -->
	
	<div class="mobile_slide">
		<div class="slide_text">
			<h2>Never forget to pay<br>rent again.</h2>
      RentSquare mobile will notify you automatically when your rent is due, and allows you to make a payment directly from your mobile device.
		</div><!-- .slide_text -->
		<div class="slide_img">
		  <?php echo $this->Html->image('dontforgetrent.jpg', array('alt' => 'Never Forget your rent','class'=>'m_slide_img')); ?>
		</div><!-- .slide_img -->
	</div><!-- .mobile_slide -->
	
	<div class="mobile_slide">
		<div class="slide_text">
			<h2>We’ve Got You Covered</h2>
      A new tool at your fingertips made to keep up with your fast-paced lifestyle.
		</div><!-- .slide_text -->
		<div class="slide_img">
		  <?php echo $this->Html->image('confirmpayment.jpg', array('alt' => 'RentSquare is simple to use!','class'=>'m_slide_img')); ?>
		</div><!-- .slide_img -->
	</div><!-- .mobile_slide -->
	
	</div>
</div><!-- .mobile_slider -->
<div class="m_features">
	<div class="content_wrapper">
		<div class="m_feature">
		  <?php echo $this->Html->image('mobile_check.png', array('alt' => '','class'=>'m_feature_img')); ?><br>
			Get confirmation when<br>your payments are <br>received.
		</div><!-- .m_feature -->
		<div class="m_feature">
		<?php echo $this->Html->image('mobile_bell.png', array('alt' => '','class'=>'m_feature_img')); ?><br>
			Get reminders when the rent<br>is due so that you’re<br>never late.
		</div><!-- .m_feature -->
		<div class="m_feature">
		  <?php echo $this->Html->image('mobile_arrow.png', array('alt' => '','class'=>'m_feature_img')); ?><br>
			Sign up for recurring<br>payments and forget about<br>the rest.
		</div><!-- .m_feature -->
	</div><!-- .content_wrapper -->
</div><!-- .m_features -->

<div> <!-- open content div with 960 wrapper -->