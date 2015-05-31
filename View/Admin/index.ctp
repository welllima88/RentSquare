<!--
<div class="floatRight" style="position:relative;">
	<?php //echo $this->Html->link(h('Activate a Property'),array('controller' => 'Admin', 'action' => 'activateproperty','full_base' => true),array('class'=>'btn btn-padding btn-small floatRight'));?>
  <div class="inactive_prop_count <?php //if($inactive_properties == 0) echo 'good'; ?>">
    <?php //echo $inactive_properties; ?>
	</div>
</div>
-->

<div class="page_title">
		<h1>Admin Portal</h1>
	</div>
<div class="clear"></div>
<div class="Admin index">	
	<div class="block_title messages_block_title">
  <span style="margin-right:20px;">All Properties</span>
  </div>
<div class='table messages'>
	<table id="admin_properties" class="main payment_tab table-striped  subheader" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name','Property Name');?></th>
			<th><?php echo $this->Paginator->sort('manager_id','Manager Name');?></th>
			<th><?php echo $this->Paginator->sort('address','Address');?></th>
			<th><?php echo $this->Paginator->sort('unit_count','# Units in System');?></th>
			<th><?php echo $this->Paginator->sort('num_units','# Units in Building');?></th>
			<th><?php echo $this->Paginator->sort('num_residents','# Residents');?></th>
			<th><?php echo $this->Paginator->sort('fee_due_day','Monthly Fee Day');?></th>
			<th><?php echo $this->Paginator->sort('active','Active');?></th>
			<th><?php echo $this->Paginator->sort('id','Property Id');?></th>
			<th><?php echo $this->Paginator->sort('created','Created');?></th>
	</tr>
	<?php if(isset($properties) && count($properties) > 0):
	foreach ($properties as $property): ?>

	<tr data-link="/Admin/payments/<?php echo $property['Property']['id']; ?>/<?php echo $property['Property']['name']; ?>">
	  <td><?php echo $property['Property']['name']; ?>&nbsp;</td>
	  <td><?php echo $property['Manager']['first_name'] . ' ' . $property['Manager']['last_name']; ?>&nbsp;</td>
	  <td><?php echo $property['Property']['address'] . '<br>' . $property['Property']['city'] .', '. $property['State']['full_name'] ; ?>&nbsp;</td>
	  <td><?php echo $property['Property']['unit_count']; ?>&nbsp;</td>
	  <td><?php echo $property['Property']['num_units']; ?>&nbsp;</td>
	  <td><?php echo count($property['Tenant']); ?></td>
	  <td><?php 
	        echo $property['Property']['fee_due_day']; 
	        echo date('S',strtotime('1/'.$property['Property']['fee_due_day'] .'/2014'));?>&nbsp;</td>
	  <td><?php echo $property['Property']['active']; ?>&nbsp;</td>
    <td><?php echo $property['Property']['id']; ?>&nbsp;</td>
    <td><?php echo date('m/d/Y',strtotime($property['Property']['created'])); ?>&nbsp;</td>

	</tr>
	<?php endforeach; 
  else:
		  echo '<tr><td colspan="7" class="no_rows">Currently no properties to show.</td></tr>';
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
		jQuery('#admin_properties td').click(function() {
        var href = $(this).parent().attr("data-link");
        if(href) {
            window.location = href;
        }
    });
	});
</script>


