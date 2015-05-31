<br>
<div class="page_title res_det_title">
  <h1>Resident Details</h1>
  <?php echo $this->Html->link('<i class="icon-edit"></i> Message', array('controller'=>'Conversations','action'=>'send',$user_details['User']['id']), array('class' => 'btn', 'id' => 'compose_message','escape' => false)); ?>
  <?php echo $this->Html->link('<i class="icon-share-alt"></i> Move to Another Unit', '#moveUnitModal', array('class' => 'btn move_prop_btn','escape' => false,'role'=>'button','data-toggle'=>'modal')); ?>
  <?php echo $this->Html->link('<i class="icon-remove icon-white"></i> Remove From Property', 
        array('controller' => 'users', 'action' => 'deleteresident',$user_details['User']['id'],$user_details['User']['unit_id'], 'full_base' => true),
        array('class'=>'btn btn-danger remove_prop_btn floatRight','escape' => false,'onClick'=>'return confirm_res_delete("'.$user_details['User']['first_name'] .' ' .$user_details['User']['last_name'].'")')
    );?>
</div>
 
<!-- Select another Unit Modal -->
<div id="moveUnitModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Select a New Unit for this Resident</h3>
  </div>
  <?php echo $this->Form->create('User',array('controller'=>'User','action'=>'moveUnits')); ?>
  <div class="modal-body">
    
      <?php 
      echo $this->Form->input('User.new_unit_id',array('label'=>'Please select a new unit number or remove from this unit','type'=>'select','options'=>$units,'empty'=>'Remove From This Unit','multiple' => false)); 
      echo $this->Form->hidden('User.user_id',array('value'=>$user_details['User']['id'])); 
      echo $this->Form->hidden('User.old_unit_id',array('value'=>$user_details['User']['unit_id']));  
      ?>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <?php           
      echo $this->Form->button("Move Resident", array('class' => 'btn btn-success','escape' => false )); 
      ?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>

<div class="clear"><br></div>

<?php 
//Format Phone Number
$result="";
if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $user_details['User']['phone'],  $matches ) )
{
    $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
}
$phone = (($result!="")) ? $result : $user_details['User']['phone'];
 ?>
 
<div class="block_title">
  Resident Information
</div>
<div class="gray_block">
<?php 
  if($curProp['id'] == $user_details['User']['property_id']){ 
    ?>
    <div class="user_personal_info">
      <?php 
          echo '<h1>'.$user_details['User']['first_name'] . ' ' . $user_details['User']['last_name'].'</h1>'.
          '<ul class="personal_info">'.
          '<li><i class="icon-envelope"></i><a href="mailto:'.$user_details['User']['email'].'">' . $user_details['User']['email'] . '</a></li>' .
          '<li><i class="icon-cell"></i>' . $phone . '</li>' .
          '<li><i class="icon-home"></i>';
          if($user_details['User']['unit_id'] == 0){ echo 'User is unassigned to a unit'; } else {echo $user_details['Unit']['number'];}
          echo '</li></ul>';
      ?>
  </div><!-- .personal_info --> 
  <div class="user_notes">
  <h1>Notes</h1>
  <?php 
  if(count($user_details['Note'])>0):
    foreach($user_details['Note'] as $note):
      echo '<strong>'.$this->Time->format('M j, Y',$note['created']) . '</strong>';
      echo '<div style="float:right;">';
      echo $this->Html->link(__('<i class="icon-pencil"></i>'), array('controller'=>'notes','action' => 'edit', $note['id']),array('escape'=>false)); 
			echo $this->Form->postLink(__('<i class="icon-remove"></i>'), array('controller'=>'notes','action' => 'delete', $note['id'],$note['user_id']), array('escape'=>false), __('Are you sure you want to delete this note?')); 
      echo '</div><div class="clear"></div>';
      echo '' . $note['note'] . '<br><br><div class="clear"></div>'; 
    endforeach; 
  else:
    echo 'No notes yet!';
  endif;?>
    <br><br>
  <?php echo $this->Form->create('Note',array('controller'=>'Notes','action'=>'add')); ?>	
	<?php
		echo $this->Form->hidden('user_id',array('value'=>$user_details['User']['id']));
		echo $this->Form->input('note',array('label'=>'Add New Note:'));
	?>
<?php echo $this->Form->button("<i class='icon-plus icon-white'></i> Save Note", array('class' => 'btn btn-small btn-success save_unit_edit','escape' => false )); ?>
<?php echo $this->Form->end(); ?>
  </div><!-- .personal_info --> 
 <?php } else {
   echo 'Permission Denied';
 } ?>
 <div class="clear"></div>
</div><!-- .gray_block -->
<script>
function confirm_res_delete(tenant){
  	var r = confirm('Are you sure that you want to remove '+tenant+'?');
  	if(r ==true){
    	 return true;
  	} else {
    	return false;
  	}
}
</script>
