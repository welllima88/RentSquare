<!-- Modal To Send Rent Reminder -->
<div id="rent_reminder_modal_<?php echo $payment_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="rentReminder" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">A Friendly Reminder</h3>
  </div>
  <div class="modal-body">
    <p>
      Send an email to the residents of Unit <?php echo $unit_number; ?>:  
      <?php 
        $emails="";
        $names="";
        $display="";
        foreach($tenants as $tenant):
           $emails .= $tenant['email'] . ', ';
           $names .= $tenant['first_name'] . ', ';
           $display .= $tenant['first_name'] . ' ' . $tenant['last_name'] . ' (' . $tenant['email'] .'), ';
        endforeach;
        $emails =  rtrim(trim($emails),',');
        $names =  rtrim(trim($names),',');
        $display =  rtrim(trim($display),',');
        echo $display;
       ?>
    </p>
      <?php 
      echo $this->Form->create('Payment', array('id' => 'rent-reminder-form', 'url' => array('controller' => 'Payments', 'action' => 'rentreminder')));

      echo $this->Form->hidden('payment_id',array('value'=>$payment_id)); 
      echo $this->Form->hidden('emails',array('value'=>$emails)); 
      echo $this->Form->hidden('unit_number',array('value'=>$unit_number)); 
      echo $this->Form->hidden('rent_due',array('value'=>$rent_due));   
      echo $this->Form->hidden('first_names',array('value'=>$names));   
      echo $this->Form->hidden('billing_start',array('value'=>$billing_start));
      echo $this->Form->hidden('billing_end',array('value'=>$billing_end)); 
      echo $this->Form->hidden('rent_period',array('value'=>$rent_period)); 
      echo $this->Form->input('message',array('type'=>'textarea','style'=>'width:100%;'));
      
 ?>
  
  </div>
  <div class="modal-footer">
  
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-success">Send Reminder</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>