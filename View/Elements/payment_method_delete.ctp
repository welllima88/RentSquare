<!-- Modal To Delete Unit -->
<div id="delete_pm_modal_<?php echo $payment_method_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteUnit" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="myModalLabel">Delete Payment Method</h3>
  </div>
  <div class="modal-body">
    <p>
      <?php if($type == 'CC'): ?>
      Are you sure you want to delete Card ending in <?php echo $acc_number; ?>?
      <?php else: ?>
      Are you sure you want to delete Bank Account #<?php echo $acc_number; ?>?
      <?php endif; ?>
    </p>
  </div>
  <div class="modal-footer">
    <?php echo $this->Form->create('PaymentMethod', array('url' => array('controller' => 'PaymentMethods','action' => 'delete')));
			echo $this->Form->input('PaymentMethod.id', array('type' => 'hidden', 'value' => $payment_method_id));			
		?>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger">Delete Payment Method</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>