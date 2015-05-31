<h2>Edit Merchant Account For <?php echo $property['Property']['name']; ?></h2>

<!-- Add Delte Unit Form -->
<?php echo $this->element('merchantaccount_delete',array('property_id'=>$property['Property']['id'])); ?>

<?php echo $this->Form->create('Admin',array('action'=>'editmerchantacct')); ?>

<br>
<?php echo $this->Form->hidden('Property.id',array('value'=>$property['Property']['id'])); ?>
<?php echo $this->Form->input('Property.pp_user',array('type'=>'text','label'=>'Phoenix Payments Merchant User Name','class'=>'validate[required]','value'=>$property['Property']['pp_user'])); ?>   
<?php echo $this->Form->input('Property.pp_pass',array('type'=>'password','label'=>'Phoenix Payments Merchant Password','class'=>'validate[required]','value'=>'')); ?>      

<?php           
  echo $this->Form->button("Update", array('class' => 'btn btn-success','escape' => false )); 
  echo "<span style=\"margin-right: 20px;\">&nbsp;</span>";
  echo $this->Html->link('<i class="icon-trash icon-white"></i> Delete', '#delete_merchantacct_modal_'.$property['Property']['id'], array('class' => 'btn btn-danger', 'id' => '#delete_merchantacct_modal_'.$property['Property']['id'], 'role'=>'button', 'data-toggle' => 'modal', 'escape' => false)); 
  echo $this->Form->end();
 ?>

