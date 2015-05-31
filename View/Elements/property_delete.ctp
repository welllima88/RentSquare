<!-- Modal To Delete Property -->
<div id="property_delete_<?php echo $property_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteProperty" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
    <h3 id="myModalLabel">Delete Property <?php echo $property_name; ?></h3>
  </div>
  <div class="modal-body">
    <p>
      Are you sure you want to delete this property: <?php echo $property_name; ?>?
    </p>
  </div>
  <div class="modal-footer">
    <?php 
       echo $this->Form->create('Admin', array('id' => 'selected-unit-form', 'url' => array('controller' => 'Admin', 'action' => 'deactivateproperty', $property_id, $manager_id)));
       echo $this->Form->input('Property.id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $property_id));
			
    ?>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger">Delete Property</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
