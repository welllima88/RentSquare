<style>
.error-message {
      font-size: 12px;
      font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
      position: absolute;
      z-index: 9000;
      background: rgb(0, 0, 0) transparent;
      background: rgba(0, 0, 0, 0.6);
      filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
      -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
      color: white;
      padding: 5px;
      margin-top: -28px;
      margin-left: 81px;
  }
</style>
<div id="form_wrapper">
	
	<!-- *****************************************************************
	      Owner Personal Info Form 
	     ***************************************************************** -->
	
	<div id="res_personal" class="res_step step">
	  <div class="register_form">
        <div class="register_wrapper">
         <h1 class="reg_title">Resident Signup - Personal Information</h1>
          <?php echo $this->Session->flash(); 

          echo '<div id="signup_message"></div>';
          echo $this->Form->create('User', array('action' => 'resident'));
        	echo $this->Form->input('first_name', array('label' => 'First Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'half_width'),'class'=>'validate[required]'));
        	echo $this->Form->input('last_name', array('label' => 'Last Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'half_width'),'class'=>'validate[required]'));
        	echo '<div class="clear"></div>';
        	echo $this->Form->input('email', array('label' => 'Email<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'half_width'),'class'=>'validate[required,custom[email]]'));
        	//echo $this->Form->input('confirm_email', array('label' => 'Confirm Email<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'half_width')));
        	//echo '<div class="clear"></div>';
        	echo $this->Form->input('password_orig', array('label' => 'Password<br>', 'type' => 'password', 'id' => 'signup_password','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'half_width'),'class'=>'validate[required,minSize[6]]'));
        	//echo $this->Form->input('confirm_password', array('label' => 'Confirm Password<br>', 'type' => 'password', 'value' => '','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'half_width')));
        	
        	echo $this->Form->hidden('unit_id', array('value'=>0));
        	echo $this->Form->hidden('property_id', array('value'=>0));
        	echo '<div class="clear"></div>';
        	echo $this->Form->input('phone', array('label' => 'Phone<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'half_width'),'class'=>'validate[required,minSize[10]]'));
        	echo '<div class="clear"><br></div>';
          echo $this->Form->button("Next <i class='icon-forward icon-white'></i>", array('class' => 'btn btn-success','escape' => false )); 
          echo $this->Form->end();
 
          ?>
      </div><!-- .register_wrapper -->
      </div><!-- .register_form -->
	</div><!-- #res_personal -->

  <div class="clear"></div>
</div><!-- #form_wrapper -->
<div class="clear"></div>
<script>
jQuery(function(){
	jQuery('#UserPhone').change(function(e){
		jQuery(this).val(jQuery(this).val().replace(/\D/g,''));
	});
});
</script>