<!-- Modal To Delete Unit -->
<div id="delete_unit_modal_<?php echo $unit_number; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteUnit" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete Unit <?php echo $unit_number; ?></h3>
  </div>
  <div class="modal-body">
    <p>
      Are you sure you want to delete unit <?php echo $unit_number; ?>?
    </p>
  </div>
  <div class="modal-footer">
    <?php echo $this->Form->create('Unit', array('id' => 'selected-unit-form', 'url' => array('controller' => 'Units', 'action' => 'delete')));
			echo $this->Form->input('Unit.number', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $unit_number));
			echo $this->Form->input('Unit.property_id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $property_id));
			echo $this->Form->input('Unit.unit_id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $unit_id));
			
		?>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger">Delete Unit</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>