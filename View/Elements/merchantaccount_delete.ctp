<!-- Modal To Delete Merchant Account -->
<div id="delete_merchantacct_modal_<?php echo $property['Property']['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteUnit" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete Merchant Account for <?php echo $property['Property']['name']; ?></h3>
  </div>
  <div class="modal-body">
    <p>
      Are you sure you want to delete the merchant account for <?php echo $property['Property']['name']; ?>?
    </p>
  </div>
  <div class="modal-footer">
    <?php echo $this->Form->create('Admin', array('id' => 'selected-unit-form', 'url' => array('controller' => 'Admin', 'action' => 'merchantaccount_delete')));
			echo $this->Form->input('Property.id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $property['Property']['id']));
			
		?>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger">Delete Unit</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
