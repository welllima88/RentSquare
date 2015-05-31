<section class="contact_header">
  <div class="wrapper animated fadeInDown">
    <h1>Contact RentSquare</h1>
  </div><!-- /.wrapper -->
</section><!-- /.contact_header -->

<section class="contact_desc clearfix">
  <div class="wrapper">
      Whether you want to know more about our services, or have a question about your personal RentSquare account, we would love to hear from you! You can call us at <a href="tel:18005555555">1-800-555-5555</a> or <a href="mailto:support@rentsquare.co">email our customer support team</a> and we will promptly get back to you.
  </div><!-- /.wrapper -->
</section><!-- .contact_desc -->

<section class="contact_info clearfix">
  <div class="wrapper">
    <div class="row">
        <div class="col-xs-8">
        <h4>Reach Us Immediately</h4>
        <?php 
            if(isset($emailsent) && $emailsent){
              echo 'Thank you for contacting RentSquare! We will get in touch with you shortly.';
            }else{
              echo '<div id="error_message" style="color: red; display:none;">Please enter all required fields<br></div>';
              echo $this->Form->create('pages', array('action' => 'contact'));
              echo $this->Form->input('name', array('label' => 'Name <span style="display:none;">*</span>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'escape'=>false));
              echo $this->Form->input('email', array('label' => 'Email Address <span style="display:none;">*</span>','format'=>array('before', 'label', 'error', 'between', 'input', 'after')));
              echo $this->Form->input('phone', array('label' => 'Phone <span style="display:none;">*</span>','format'=>array('before', 'label', 'error', 'between', 'input', 'after')));
              echo $this->Form->input('message', array('label' => 'Questions or Comments <span style="display:none;">*</span>','type'=>'textarea','format'=>array('before', 'label', 'error', 'between', 'input', 'after')));    
              echo $this->Form->submit("Submit", array('class' => 'btn btn-success','escape' => false,'onclick'=>'return validate_form();' ));      
              echo $this->Form->end();
            }
         ?>
      </div><!-- /.col-xs-8 -->
      <div class="col-xs-9 col-xs-offset-6">
          <h4>Give Us a Call</h4>
          <p class="rs-number">1-800-555-5555</p>
          <p>
            Monday-Friday, 8am-11pm, EST<br>
            Saturday, 9am-6pm, EST<br>
          </p>
          <br>
          <h4 class="email_lab">Email us:</h4>
          <a class="rs_cont_email" href="mailto:support@rentsquare.co">support@rentsquare.co</a>
          <p class="rs_cont_dsc">A customer care representative will respond to you within 24 hours</p>
      </div><!-- /.col-xs-9 col-xs-offset-6 -->
    </div><!-- /.row -->
  </div><!-- /.wrapper -->
</section><!-- .contact_info -->
<script>
  function validate_form(){
          jQuery('.input label').find('span').hide();
          err_msg = false;
        	name = jQuery('#pagesName').val();
        	if((name==null)||(name.length)==0){
          	err_msg = true;
          	jQuery('#pagesName').prev().find('span').fadeIn();
        	}
        	input_value = jQuery('#pagesEmail').val();
        	if((input_value==null)||(input_value.length)==0){
          	err_msg = true;
          	jQuery('#pagesEmail').prev().find('span').fadeIn();
        	}
        	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if(!re.test(input_value)){
            err_msg = true;
          	jQuery('#pagesEmail').prev().find('span').fadeIn();
          }
        	input_value = jQuery('#pagesPhone').val();
        	if((input_value==null)||(input_value.length)==0){
          	err_msg = true;
          	jQuery('#pagesPhone').prev().find('span').fadeIn();
        	}
        	input_value = jQuery('#pagesMessage').val();
        	if((input_value==null)||(input_value.length)==0){
          	err_msg = true;
          	jQuery('#pagesMessage').prev().find('span').fadeIn();
        	}
        	if(err_msg){
          	jQuery("#error_message").fadeIn('slow');
          	jQuery('html,body').animate({scrollTop: jQuery("#error_message").offset().top - 150 }, 700, "swing");
          	return false;
        	}
        	return true;

  }
  function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
</script>
