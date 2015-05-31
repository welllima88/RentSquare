<div class="paymentHistory index">
  <!-- <div class="date_filter"> -->
		<?php 
		  /*
		  echo $this->Form->create('Payment',array('controller'=>'Payment','action'=>'history'));
  		echo $this->Form->button('Filter', array('class' => 'btn filter_button')); 
			echo $this->Form->input('Payment.end_date', array('type'=>'text', 'label' => false,'placeholder' => 'End Date', 'class' => 'datepicker','value'=>date('m/t/Y') ));
			echo '<span> To: </span>';
			echo $this->Form->input('Payment.start_date', array('type'=>'text', 'label' => false,'placeholder' => 'Start Date', 'class' => 'datepicker','value'=>date('m/01/Y') ));
			echo '<span> From: </span>';
      echo $this->Html->image('cal_icon.png', array('alt' => '','class'=>'cal_icon'));     
			echo $this->Form->end();
			*/
		?>
		<!-- </div> --><!-- .date_filter -->
	<div class="page_title">
		<h1><?php echo __('Payments History');?></h1>
	</div>
	<div class="clear"></div>
	<div class="block_title messages_block_title">
  <span style="margin-right:20px;">Payment History for <?php echo $user_name; ?></span>
  </div>
<div class='table messages'>
	<table class="main payment_tab table-striped  subheader" cellpadding="0" cellspacing="0">
	<tr>
			<th class="first"><?php echo $this->Paginator->sort('amount','Payment Amount');?></th>
			<th><?php echo $this->Paginator->sort('type','Type');?></th>
			<th><?php echo $this->Paginator->sort('created','Payment Date');?></th>
			<th><?php echo $this->Paginator->sort('status','Payment Status');?></th>
			<th><?php echo $this->Paginator->sort('pptransactionid','Transaction ID');?></th>
			<th class="last"><?php echo $this->Paginator->sort('billing_id','Billing Id');?></th>
			
	</tr>
	<?php if(isset($payments) && count($payments) > 0):

	foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo $this->Number->currency( $payment['Payment']['total_bill'] ,'USD',array('after'=>false)); ?>&nbsp;</td>
		<td><?php echo $payment['Payment']['type']; ?>&nbsp;</td>
		<td><?php echo date('M, d Y',strtotime($payment['Payment']['created'])); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['status']); ?>&nbsp;</td>
		<td><?php if($payment['Payment']['pptransactionid'] == "") echo 'N/A'; else echo $payment['Payment']['pptransactionid']; ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['billing_id']); ?>&nbsp;</td>
	</tr>
<?php endforeach; 
  else:
  
  echo '<tr><td colspan="6" class="no_rows">
		  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Camada_1" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
        <path fill="#ddd" d="M100,23.375C100,19.854,97.146,17,93.625,17H6.375C2.854,17,0,19.854,0,23.375v52.25C0,79.146,2.854,82,6.375,82h87.25  c3.521,0,6.375-2.854,6.375-6.375V23.375z M6.438,21h87.187C94.769,21,96,22.231,96,23.375V29H4v-5.625C4,22.231,5.295,21,6.438,21z   M93.625,77H6.438C5.295,77,4,76.284,4,75.141V44h92v31.141C96,76.284,94.769,77,93.625,77z"></path>
      </svg><br>
		  Currently no payments to show.
		  </td></tr>';
  endif;
?>	


      
      

</table>
  </div>
	<p class="page_counter">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>


<script>
  /*
jQuery('table.main tr td').not('.unit_number').click(function(){
    jQuery(this).parent().next().toggle();
    jQuery(this).parent().find('td.td_downarrow').toggleClass('arrow_open');
  });
  jQuery('.view_payment_details_click').click(function(e){
  	e.preventDefault();
  	jQuery(this).closest('.unit_number_tr').next().slideToggle();
  	jQuery(this).closest('.unit_number_tr').children('td.td_downarrow').toggleClass('arrow_open');
  });
*/
  jQuery(function(){
  	jQuery('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true
    });
  });
  
</script>
