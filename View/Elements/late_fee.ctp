<!-- Modal To Assign a Late Fee -->
<div id="late_fee_modal_<?php echo $payment_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="manualPayment" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add a Late Fee</h3>
  </div>
  <div class="modal-body">
    <p>
      Assign a late fee below.  The fee will be automatically added to this invoice.
    </p><br>
      <?php 
      echo $this->Form->create('Billing', array('id' => 'manual-payment-form', 'url' => array('controller' => 'Billing', 'action' => 'latefee')));
      echo $this->Form->hidden('billing_id',array('value'=>$payment_id));
      echo '<div class="form_input">';
          	echo '<label for="BillingAmount">Late Fee Amount</label><div class="input-prepend"><span class="add-on" style="float:left;"><i class="icon">$</i></span>';
                $modalId = "PaymentAmount" . $payment_id;
          	echo $this->Form->input('amount',array('label'=>false,'type'=>'text','pattern'=>'[0-9]+([\,|\.][0-9]+)?','step'=>'0.01','id'=>$modalId)); 
          	echo '</div>';
        echo '</div><!-- .form_input -->';
 ?>
  <br><br><br>
  </div>
  <div class="modal-footer">
  
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-success">Add Late Fee</button>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
<script>

  jQuery('#BillingAmount'+ <?php echo $payment_id; ?>).on('change',function(){
           jQuery(this).val(jQuery(this).val().replace(/,/g,''));
           return true;
  });

</script>
