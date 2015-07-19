<div class="page_title">
   <h1>
      Properties for <?php echo $manager['User']['company_name']; ?> &nbsp;&nbsp;<em>Manager:</em> <?php echo $manager['User']['first_name']; ?> <?php echo  $manager['User']['last_name']; ?>
   </h1>
   <br>
</div>
<div class="clear"></div>
   <?php if ($manager['User']['is_activated'] == 0) { echo "<span style=\"color: red;font-weight:bold;\">Not currently active</span>"; } ?>&nbsp;
    <i class="icon-user"></i> <?php echo $manager['User']['first_name'] .' '.$manager['User']['last_name']; ?> &nbsp;&nbsp;&nbsp;
		<i class="icon-envelope"></i> <a href="mailto:<?php echo $manager['User']['email']; ?>"><?php echo $manager['User']['email']; ?></a> &nbsp;&nbsp;&nbsp;
		<i class="icon-comment"></i> <?php $numbers = explode("\n", $manager['User']['phone']); 
  		foreach($numbers as $number)
      {
          print preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~', '($1) $2-$3', $number). "\n";
      }
		?><br><br>
<div class="clear"></div>
<div class="Admin index">	
	<div class="block_title messages_block_title">
  <span style="margin-right:20px;">Properties</span>
  </div>
<div class='table messages'>
	<table id="admin_property" class="main payment_tab table-striped  subheader" cellpadding="0" cellspacing="0">
	<tr>
           <th><?php echo $this->Paginator->sort('Property.name','Name');?></th>
           <th><?php echo $this->Paginator->sort('Property.legal_street','Address');?></th>
           <th><?php echo $this->Paginator->sort('Property.legal_city','City');?></th>
           <th><?php echo $this->Paginator->sort('State.full_name','State');?></th>
           <th><?php echo $this->Paginator->sort('Property.num_units','Units');?></th>
           <th><?php echo $this->Paginator->sort('Property.unit_count','Units Occupied?');?></th>
           <th>&nbsp;</th>
	</tr>
	<?php if(isset($properties) && count($properties) > 0):
	foreach ($properties as $property): ?>

	<tr> 
	   <td><?php echo $property['Property']['name']; ?>&nbsp;</td>
	   <td><?php echo $property['Property']['legal_street']; ?>&nbsp;</td>
	   <td><?php echo $property['Property']['legal_city']; ?>&nbsp;</td>
	   <td><?php echo $property['State']['full_name']; ?>&nbsp;</td>
	   <td><?php echo $property['Property']['num_units']; ?>&nbsp;</td>
	   <td><?php echo $property['Property']['unit_count']; ?>&nbsp;</td>
           <td>
              <?php 
              echo '<a id="propert_id_'.$property['Property']['id'].'" class="rs-button-delete ir rs-delete-free-rent" href="#property_delete_'.$property["Property"]["id"].'" role="button", data-toggle = "modal">Remove</a>';
              echo '</div>';
              ?>
           </td>
	</tr>
        <?php echo $this->element('property_delete',array('property_id'=>$property['Property']['id'], 'property_name'=>$property['Property']['name'],'manager_id'=>$manager['User']['id']));
        ?>
	<?php endforeach; 
  else:
		  echo '<tr><td colspan="7" class="no_rows">Currently no property to show.</td></tr>';
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
		jQuery('#admin_payments td').click(function() {
        var href = $(this).parent().attr("data-link");
        if(href) {
            window.location = href;
        }
    });
	});
</script>


