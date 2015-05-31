<div class="top_right_button add_unit">
  <?php echo $this->Html->link('<i class="icon-plus icon-white"></i> Add Unit', '#add_unit_modal', array('class' => 'btn btn-success', 'id' => '#add_unit_modal', 'role'=>'button', 'data-toggle' => 'modal','escape' => false)); ?>
</div>

<div class="page_title">
  <h1>Units Overview</h1>
</div>

<div class="clear"></div>
<div class="block_title messages_block_title">
  <?php if(isset($curProp['name']) && $curProp['name'] !='') echo $curProp['name']; else echo 'Units'; ?>
</div>

<div class="clear"></div>

<div class='table messages'>
<table class="units_list table-striped format subheader">
 <thead class="block_title">
    <tr class="table_header">
        <th class="first" width="12%">Unit</th>
        <th>&nbsp;</th>
        <th>Occupied?</th>
        <th>Rent Amount</th>
        <th>Lease Start</th>
        <th class="last">Lease End</th>
    </tr>
 </thead>
 <tbody>
    <?php if(isset($units) && count($units) > 0):
    foreach ($units as $unit): ?>
    <tr>
        <td class="unit_number">
        
            <div class="btn-group">
              <a class="btn btn-unit dropdown-toggle unit-link" data-toggle="dropdown" href="/Units/edit/<?php echo $unit['Unit']['id']; ?>"><i class="icon-home icon-blue"></i>&nbsp;&nbsp; <?php echo $unit['Unit']['number']; ?> &nbsp;&nbsp;<span class="caret caret_blue"></span></a>
              <ul class="dropdown-menu unit_listings">
                <li><a href="/Units/edit/<?php echo $unit['Unit']['id']; ?>"><i class="icon-pencil"></i> Edit Unit</a></li>
                <li><?php echo $this->Html->link('<i class="icon-trash"></i> Delete Unit', '#delete_unit_modal_'.$unit['Unit']['number'], array( 'id' => '#delete_unit_modal_'.$unit['Unit']['number'], 'role'=>'button', 'data-toggle' => 'modal', 'escape' => false)); ?></li>
                <li class="divider"></li>
                <li><a href="#"><?php echo $this->Html->link('<i class="i"></i> Add New Unit', '#add_unit_modal', array('id' => '#add_unit_modal', 'role'=>'button', 'data-toggle' => 'modal','escape' => false)); ?></li>
              </ul>
            </div>
            <?php echo $this->element('unit_delete',array('unit_number'=>$unit['Unit']['number'],'unit_id'=>$unit['Unit']['id'],'property_id'=>$unit['Unit']['property_id'])); ?>
        </td>
        <td>&nbsp;</td>
        <td><?php 
          if(strtolower($unit['Unit']['occupied']) == 'yes'){
            echo '<span class="occupied yes"><i class="icon-ok icon-white"></i> '.$unit['Unit']['occupied'].'</span>';
          } else {
            echo '<span class="occupied no"><i class="icon-remove icon-white"></i> '.$unit['Unit']['occupied'].'</span>';
          }
          ?></td>
        <td><?php if($unit['Unit']['rent'] ==0) echo 'N/A'; else echo $this->Number->currency( $unit['Unit']['rent'] ,'USD'); ?></td>
        <td><?php $lease_start = date('m/d/Y', strtotime($unit['Unit']['lease_start'])); if($lease_start == 
          '01/01/1753' || (strtotime($unit['Unit']['lease_start']) < strtotime('01/01/2000'))) echo 'N/A'; else echo $lease_start;
        ?></td>
        <td><?php $lease_end = date('m/d/Y', strtotime($unit['Unit']['lease_end'])); if($lease_end == 
          '01/01/1753' || (strtotime($unit['Unit']['lease_end']) < strtotime('01/01/2000'))) echo 'N/A'; else echo $lease_end; ?></td>
        <!--
        <td class="trans_fee_td"><div class="trans_fee_group btn-group" data-toggle="buttons-radio">
            <button id="unit_id_<?php //echo $unit['Unit']['id']; ?>" type="button" class="btn <?php //if($unit['Unit']['transaction_fee'] == 'Resident') //echo 'active'; ?>">Resident</button>
            <button id="unit_id_<?php echo $unit['Unit']['id']; ?>" type="button" class="btn <?php //if($unit['Unit']['transaction_fee'] == 'Property') //echo 'active'; ?>">Property</button>
          </div>
        </td>
        -->
    </tr>
    <?php 
    endforeach; 
    else:
		  echo '<tr><td colspan="6" class="no_rows"><a href="#add_unit_modal" data-toggle="modal">
		  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="80px" height="77.5px" viewBox="0 0 100 87.5" enable-background="new 0 0 100 87.5" xml:space="preserve">
        <polygon fill="#ddd" points="12.5,87.5 43.75,87.5 43.75,62.5 56.25,62.5 56.25,87.5 87.5,87.5 87.5,50 100,50 50,0 0,50 12.5,50 "></polygon>
        </svg><br><br>
        Click Here to add a Unit!</a></td></tr>';
		endif;
    unset($unit); ?>
  </tbody>
</table>
</div>
<!-- model windows for add unit and delete unit -->
<?php echo $this->element('unit_add'); ?>

<div class='clear'></div>

<?php echo $this->Js->writeBuffer(array('inline' => true)); ?>
<script type='text/javascript'>
	/*
    jQuery('.trans_fee_group button').click(function(e){
	  e.preventDefault();
  	jQuery.ajax({
      url: 'Units/updateTransactionFee/' + jQuery(this).attr('id').replace('unit_id_','') + '/' + jQuery(this).html(),
      failure: function(data) {
        alert('Update Failed. Please contact site admin.');
      }
    });
	});
  */  

	jQuery(function(){
		jQuery('.units_list td').not('.unit_number').click(function() {
        var href = $(this).parent().find("a.unit-link").attr("href");
        if(href) {
            window.location = href;
        }
    });
	});

</script>
