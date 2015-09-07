<div class="page_title">
		<h1>Admin Portal</h1>
	</div>
<div class="clear"></div>
<div class="Admin index">	
	<div class="block_title messages_block_title">
  <span style="margin-right:20px;">Active Property Managers</span>
  </div>
<div class='table messages'>
	<table id="property_managers" class="main payment_tab table-striped  subheader" cellpadding="0" cellspacing="0">
	<tr>
		        <th><?php echo $this->Paginator->sort('company_name','Company Name');?></th>
			<th><?php echo $this->Paginator->sort('last_name','Last Name');?></th>
			<th><?php echo $this->Paginator->sort('first_name','First Name');?></th>
			<th><?php echo $this->Paginator->sort('state_id','State');?></th>
			<th><?php echo $this->Paginator->sort('city','City');?></th>
			<th><?php echo $this->Paginator->sort('zip','Zip');?></th>
			<th><?php echo $this->Paginator->sort('dob','Birth Date');?></th>
			<th><?php echo $this->Paginator->sort('email','Email');?></th>
			<th><?php echo $this->Paginator->sort('created','Created');?></th>
	</tr>
	<?php if(isset($pms) && count($pms) > 0):
	foreach ($pms as $pm): ?>
	<tr data-link="/Admin/properties/<?php echo $pm['User']['id']; ?>">
	  <td><?php echo $pm['User']['company_name']; ?>&nbsp;</td>
	  <td><?php echo $pm['User']['last_name']; ?>&nbsp;</td>
	  <td><?php echo $pm['User']['first_name']; ?>&nbsp;</td>
	  <td><?php echo $pm['State']['full_name']; ?>&nbsp;</td>
	  <td><?php echo $pm['User']['city']; ?>&nbsp;</td>
	  <td><?php echo $pm['User']['zip']; ?>&nbsp;</td>
	  <td><?php echo $pm['User']['dob']; ?>&nbsp;</td>
	  <td><?php echo $pm['User']['email']; ?>&nbsp;</td>
          <td><?php echo date('m/d/Y',strtotime($pm['User']['created'])); ?>&nbsp;</td>

	</tr>
	<?php endforeach; 
  else:
		  echo '<tr><td colspan="7" class="no_rows">Currently no property managers to show.</td></tr>';
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
jQuery(function(){
		jQuery('#property_managers td').click(function() {
        var href = $(this).parent().attr("data-link");
        if(href) {
            window.location = href;
        }
    });
	});
</script>


