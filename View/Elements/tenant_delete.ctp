<!-- Modal To Delete Tenant -->
<div id="tenantDelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteTenant" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
    <h3 id="myModalLabel"><?php echo $first_name; ?>'s Account Deletion</h3>
  </div>
  <div class="modal-body">
    <p>
      Are you sure you want to delete your account <?php echo $first_name; ?>?
    </p>
  </div>
  <div class="modal-footer">
    <?php 
       echo $this->Form->create('Admin', array('id' => 'delete-tenant-form', 'url' => array('controller' => 'Admin', 'action' => 'deactivatetenant', $tenant_id, $unit_id)));
       //echo $this->Form->input('User.id', array('type' => 'hidden', 'class' => 'unit-number', 'value' => $tenant_id));
			
    ?>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger">Delete Account</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
