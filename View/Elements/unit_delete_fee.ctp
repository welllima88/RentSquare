<!-- Modal To Delete Unit Fee -->
<div id="unit_delete_fee_<?php echo $fee_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteUnit" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete Unit Fee: <?php echo $fee_name; ?></h3>
  </div>
  <div class="modal-body">
    <p>
      Are you sure you want to delete unit fee <?php echo $fee_name; ?> for $<?php echo $fee_amt; ?>?
    </p>
  </div>
  <div class="modal-footer">
    <?php echo $this->Form->create('Unit', array('id' => 'selected-unit-form', 'url' => array('controller' => 'Units', 'action' => 'deleteUnitCharge')));
			echo $this->Form->input('Unit.fee_id', array('type' => 'hidden', 'class' => 'fee-id', 'value' => $fee_id));
			//echo $this->Form->input('Unit.property_id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $property_id));
			//echo $this->Form->input('Unit.unit_id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $unit_id));
			
		?>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger">Delete Fee</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>