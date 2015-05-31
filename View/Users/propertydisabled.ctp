<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="last_step_modal" class="modal hide fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 1000px;margin-left: -500px; height:40%;">
  <div class="last_step">
<div class="last_step_wrapper">
  <br><br>
	<h1>We're Sorry!</h1>
	<br>
	<?php echo $this->Html->image('RentSquare-Logo.png', array('alt' => 'RentSquare')); ?>
	<br><br><br>
          <strong>Your building is no longer being managed using RentSquare.</strong>
	<br><br><br>
</div><!-- .last_step_wrapper -->
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
