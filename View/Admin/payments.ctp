<?php //echo $this->Html->link(h('Edit Merchant Account'),array('controller' => 'Admin', 'action' => 'editmerchantacct',$property_id ,'full_base' => true),array('class'=>'btn btn-padding btn-small floatRight'));?>
<div class="date_filter">
   <?php echo $this->Form->create('Admin',array('controller'=>'Admin','action'=>'payments'));
   if(isset($end_filter) && $end_filter != ''){
      echo $this->Form->input('Admin.end_date', array('type'=>'text', 'label' => false,'placeholder' => 'End Date', 'class' => 'datepicker', 'id' => 'endate', 'value'=>$end_filter));
   } else {
      echo $this->Form->input('Admin.end_date', array('type'=>'text', 'label' => false,'placeholder' => 'End Date', 'class' => 'datepicker', 'id' => 'endate', 'value'=>date('m/t/Y')));
   }
      echo '<span> To: </span>';
   if(isset($start_filter) && $start_filter != ''){
      echo $this->Form->input('Admin.start_date', array('type'=>'text', 'label' => false,'placeholder' => 'Start Date', 'class' => 'datepicker','value'=>$start_filter));
   } else {
      echo $this->Form->input('Admin.start_date', array('type'=>'text', 'label' => false,'placeholder' => 'Start Date', 'class' => 'datepicker','value'=>date('m/01/Y')));
   }
      echo '<span> From: </span>';
      echo $this->Html->image('cal_icon.png', array('alt' => '','class'=>'cal_icon'));
      echo $this->Form->end();
   ?>
</div><!-- .date_filter -->

<div class="page_title">
   <h1>Payments for <?php echo $prop_name; ?></h1><br>
</div>
<div class="clear"></div>
<i class="icon-user"></i> <?php echo $manager[0]['Manager']['first_name'] .' '.$manager[0]['Manager']['last_name']; ?> &nbsp;&nbsp;&nbsp;
<i class="icon-envelope"></i> <a href="mailto:<?php echo $manager[0]['Manager']['email']; ?>"><?php echo $manager[0]['Manager']['email']; ?></a> &nbsp;&nbsp;&nbsp;
<i class="icon-comment"></i> 
<?php $numbers = explode("\n", $manager[0]['Manager']['phone']); 
foreach($numbers as $number)
{
    print preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~', '($1) $2-$3', $number). "\n";
}
?><br><br>
<div class="clear"></div>
<div class="Admin index">	
   <div class="block_title messages_block_title">
      <span style="margin-right:20px;">Payments</span>
   </div>
   <div class='table messages'>
      <table id="admin_payments" class="main payment_tab table-striped  subheader" cellpadding="0" cellspacing="0">
         <tr>
            <th><?php echo $this->Paginator->sort('Unit.number','Unit');?></th>
            <th><?php echo $this->Paginator->sort('User.first_name','Resident');?></th>
            <th><?php echo $this->Paginator->sort('Payment.amt_processed','Total');?></th>
            <th><?php echo $this->Paginator->sort('Payment.amount','Toward Rent');?></th>
            <th><?php echo $this->Paginator->sort('Payment.amt_fee','Fee Amt');?></th>
            <th><?php echo $this->Paginator->sort('Payment.created','Date');?></th>
            <th><?php echo $this->Paginator->sort('Payment.status','Status');?></th>
            <th><?php echo $this->Paginator->sort('Payment.type','Type');?></th>
            <th><?php echo $this->Paginator->sort('Payment.pptransactionid','Transaction Id');?></th>
            <th><?php echo $this->Paginator->sort('Payment.billing_id','Billing Id');?></th>
         </tr>
         <?php if(isset($payments) && count($payments) > 0):
         foreach ($payments as $payment): ?>
         <tr data-link="/Admin/billing/<?php echo $payment['Payment']['billing_id']; ?>">
            <td><?php echo $payment['Unit']['number']; ?>&nbsp;</td>
            <td><?php echo $payment['User']['first_name'] . ' ' . $payment['User']['last_name']; ?>&nbsp;</td>
            <td><?php echo $this->Number->currency( $payment['Payment']['amt_processed'] ,'USD'); ?>&nbsp;</td>
            <td><?php echo $this->Number->currency( $payment['Payment']['amount'],'USD'); ?>&nbsp;</td>
            <td><?php echo $this->Number->currency( $payment['Payment']['amt_fee'],'USD'); ?>&nbsp;</td>
            <td><?php echo date('m/d/Y',strtotime($payment['Payment']['created'])); ?>&nbsp;</td>
            <td><?php echo $payment['Payment']['status']; ?>&nbsp;</td>
            <td><?php echo $payment['Payment']['type']; ?>&nbsp;</td>
            <td><?php if($payment['Payment']['pptransactionid'] != '') echo $payment['Payment']['pptransactionid']; else echo 'N/A';?>&nbsp;</td>
            <td><?php echo $payment['Payment']['billing_id']; ?>&nbsp;</td>
         </tr>
         <?php endforeach; 
         else:
         echo '<tr><td colspan="7" class="no_rows">Currently no payment to show.</td></tr>';
         endif;
         ?>
      </table>
   </div>
   <p class="page_counter">
   <?php
      echo $this->Paginator->counter(array( 'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total')));
   ?>
   </p>

   <div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
   </div>
</div>
<script>
jQuery(function(){
	jQuery('#admin_payments td').click(function() {
        var href = $(this).parent().attr("data-link");
        if(href) {
            window.location = href;
        }
    });
});
jQuery(function(){
      jQuery('.datepicker').datepicker({
      changeMonth: true,
      changeYear: true,
      onSelect: function(date) {
          $.blockUI({message: '<h2><?php echo $this->Html->image("busy.gif"); ?> &nbsp; Just a moment please.</h2>'});
          jQuery('#AdminPaymentsForm').attr('action', window.location.href).submit();
      }
  });
});
/*
function getQsArgs()
{
   var a = window.location.pathname;
   var parts = a.split("/");
   var j = 0;
   var qstring = '';
   if ( parts.length > 2 )
   {
      for ( i=3; i < parts.length; i++ )
      {
         qstring = qstring + "/" + parts[i];      
      }
   }
   
   return qstring;
}
*/
</script>


