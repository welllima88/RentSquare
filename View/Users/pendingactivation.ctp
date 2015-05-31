<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="last_step_modal" class="modal hide fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 1000px;margin-left: -500px; height:80%; overflow:scroll;">
  <div class="last_step">
<div class="last_step_wrapper">
  <br><br>
	<h1>One Last Step!</h1>
	<br>
	<?php echo $this->Html->image('rs_phoenix.jpg', array('alt' => 'RentSquare And Phoenix Payments')); ?>
	<br><br><br>
	Thank you for signing up with RentSquare! Our payments partner, Base Commerce has sent you an e-mail containing your merchant application to enable you to collect rent online. Please check your e-mail and follow the instructions to electronically sign the merchant application. Once you complete this step, we will notify you within 24-48 hours once your application has been approved so that you may log in to get started! If you have any questions, please contact our support team.
	<br><br><br>
</div><!-- .last_step_wrapper -->
<div class="pp_form">
		This is the form that you will receive in your inbox.<br>
    Sign it electronically and you’ll be ready to get started!
	</div><!-- .pp_form -->
</div><!-- .last_step -->
<br>
<div style="text-align:center;">
	<?php echo $this->Html->link(h('Logout'),array('controller' => 'users', 'action' => 'logout','full_base' => true),array('class'=>'btn'));?>
</div>
<br>
</div>








<script>
jQuery('.menu_item a,.right a').click(function(e){
	e.preventDefault();
	jQuery(this).attr('href','#');
});
jQuery(function(){
	jQuery('#last_step_modal').modal('show');
});
</script>