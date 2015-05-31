<!-- Modal To Delete Unit Fee -->
<div id="unit_delete_free_rent_<?php echo $free_rent_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteUnit" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete Free Rent</h3>
  </div>
  <div class="modal-body">
    <p>
      Are you sure you want to delete free rent from billing cycle <?php echo $fr_start . ' - ' . $fr_end; ?> for $<?php echo $fr_amount; ?>?
    </p>
  </div>
  <div class="modal-footer">
    <?php echo $this->Form->create('Unit', array('url' => array('controller' => 'Units', 'action' => 'deleteFreeRent')));
			echo $this->Form->input('Unit.free_rent_id', array('type' => 'hidden', 'class' => 'free-rent-id', 'value' => $free_rent_id));
			//echo $this->Form->input('Unit.property_id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $property_id));
			//echo $this->Form->input('Unit.unit_id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $unit_id));
			
		?>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger">Delete Free Rent</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>