<!-- Modal To Delete Unit -->
<div id="manual_payment_modal_<?php echo $payment_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="manualPayment" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Manually Record a Payment</h3>
  </div>
  <div class="modal-body">
    <p>
      Use this function to record a cash or check payment that was not processed through the system.
    </p>
      <?php 
      echo $this->Form->create('Payment', array('id' => 'manual-payment-form', 'url' => array('controller' => 'Payments', 'action' => 'manualpayment')));
      echo $this->Form->hidden('billing_id',array('value'=>$payment_id));
      echo $this->Form->hidden('unit_id',array('value'=>$unit_id));
      
      echo '<div class="form_input">';
          	echo '<label for="PaymentAmount">Amount</label><div class="input-prepend"><span class="add-on" style="float:left;"><i class="icon">$</i></span>';
                $modalId = "PaymentAmount" . $payment_id;
          	echo $this->Form->input('amount',array('label'=>false,'type'=>'text','pattern'=>'[0-9]+([\,|\.][0-9]+)?','step'=>'0.01','id'=>$modalId)); 
          	echo '</div>';
        echo '</div><!-- .form_input -->';
        
      echo $this->Form->input('type',array('type'=>'select','options'=>array('Cash'=>'Cash','Check'=>'Check','Other'=>'Other'),'label'=>'Payment Type'));
      $options = array();   
      foreach($tenants as $tenant):
         $options[$tenant['id']] = $tenant['first_name'] . ' ' . $tenant['last_name'];
      endforeach;
      echo $this->Form->input('user_id',array('type'=>'select','options'=>$options,'label'=>'Resident Name'));
      //echo $this->Form->input('notes');
 ?>
  
  </div>
  <div class="modal-footer">
  
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-success">Save Payment</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>

<script>
  jQuery('#PaymentAmount' + <?php echo $payment_id; ?>).on('change',function(){
           jQuery(this).val(jQuery(this).val().replace(/,/g,''));
           return true;
  });
</script>
