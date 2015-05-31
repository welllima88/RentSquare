<?php $unit_number = $unit['Unit']['number']; ?>
<!-- Modal To Delete Unit -->
<div id="add_resident_modal_<?php echo $unit_number; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addResLabel_<?php echo $unit_number; ?>" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="addResLabel_<?php echo $unit_number; ?>">Add Resident to Unit <?php echo $unit_number; ?></h3>
  </div><!-- .modal-header -->
  <div class="modal-body add_res_body">
   <div class="row-fluid">
   	
        <div class="span5 margin_right">
          <h1>Add Existing Resident</h1>
          <br>
          <?php if(empty($queuedTenants)):
            echo 'No unassigned tenants found';
          else:
          foreach($queuedTenants as $queued):
            echo '<div class="queued_ten" id="user_'.$queued['User']['id'] . '">'.
            '<a href="#" rel="clickover" class="confirm_popover" data-original-title="Confirm Resident<span>x</span>" data-content="">'.
             '<h2><i class="icon-user"></i> '.$queued['User']['first_name'] . ' ' . $queued['User']['last_name'] .'</h2>'.
             $queued['User']['email'] . ' <div class="floatRight">' . $queued['User']['phone'] . '</div>';
             if($queued['User']['requested_unit'] != 0){ echo '<br>Requested Unit: ' . $queued['User']['requested_unit']; }
             echo '<div class="add_confirm" style="display:none;">';
                echo $this->Form->create('Unit', array('controller' => 'Units', 'action' => 'addTenant','inputDefaults' => array(
                  'label' => false,
                  'div' => false
                  )));
              	echo $this->Form->hidden('tenant_id', array('value' => $queued['User']['id']));
              	echo $this->Form->hidden('id', array('value' => $unit['Unit']['id']));
              	echo $this->Form->hidden('unit_number', array('value' => $unit_number));
              	echo $this->Form->hidden('tenant_name', array('value' => $queued['User']['first_name']));
              	echo $this->Form->hidden('user_email', array('value' => $queued['User']['email']));
              	echo '<span class="fs_normal">Please confirm that you want to add '.$queued['User']['first_name'] . ' ' . $queued['User']['last_name'] .' to unit ' .$unit_number .'?</span><br><br>';
                echo $this->Form->button("<i class='icon-thumbs-up icon-white'></i> Add To Unit", array('class' => 'btn btn-success btn-small','escape' => false ));
                //echo '<button class="btn floatRight" data-dismiss="clickover">Close</button>';
                echo '<br>';
                echo $this->Form->end();
                //Remove from queue
                echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'removeFromRequestedUnit','inputDefaults' => array(
                  'label' => false,
                  'div' => false
                  )));
                echo $this->Form->hidden('tenant_id', array('value' => $queued['User']['id']));
                echo $this->Form->hidden('unit_id', array('value' => $unit['Unit']['id']));
                echo $this->Form->button("<i class='icon-remove icon-white'></i> Remove from Queue", array('class' => 'btn btn-mini btn-danger','escape' => false ));
                echo $this->Form->end();
                                
             echo '</div><!-- .add_confirm -->'.
             '</a></div><!-- .queued_ten -->';
    
          endforeach; endif; ?>
        </div><!-- .span5 -->
        <div class="span6 border_left">
            <h1>Invite New Resident</h1><br>
            <?php echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'addByInvite','inputDefaults' => array(
                'label' => false,
                'div' => false
            )));
              echo $this->Form->hidden('property_id', array('value' => $unit['Unit']['property_id']));
              echo $this->Form->hidden('unit_id', array('value' => $unit['Unit']['id']));
              echo $this->Form->hidden('unit_number', array('value' => $unit_number));
            	echo $this->Form->input('first_name', array('placeholder' => 'First Name'));
            	echo $this->Form->input('last_name', array('placeholder' => 'Last Name'));
              echo $this->Form->input('email', array('placeholder' => 'Email'));
              echo $this->Form->button("<i class='icon-envelope icon-white'></i> Send Invite", array('class' => 'btn btn-success','escape' => false )); 
              echo $this->Form->end(); ?>
        </div><!-- .span6 -->
     </div><!-- .row-fluid -->
  </div><!-- .modal-body -->
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div><!-- .modal-footer -->
</div>
<script>
  jQuery(function(){
    jQuery('a.confirm_popover').clickover({
        html : true,
        placement:'right',
        animation: true,
        onShown: function() {
          jQuery('.popover-title span').html('<a href="#" class="floatRight" data-dismiss="clickover">X</a>');
        }
    });
    
  });
  jQuery('a.confirm_popover').attr('data-content', function(i, val) {
    return jQuery(this).children('.add_confirm').html()
  });
 
</script>