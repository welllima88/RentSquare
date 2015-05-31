
<?php 
   if ($unassigned && $user_type == USER_TYPE_TENANT)
   {
      echo "<div class=\"simple_square\">";
      echo $this->element('tenant_unassigned');
      echo "</div>";
   } 
   else
   {
?>

<?php echo $this->element('messages_header'); ?>

<div id='inbox' class='messages'>

	<table class="subheader table-striped format messages_inbox">
	<tr class="no_click">
			<th width="22%"><?php echo $this->Paginator->sort('Conversation.sender_id','From');?> <span class="caret"></span></th>
      <?php if($user_type == !USER_TYPE_TENANT): ?>
			<th width="15%"><?php echo $this->Paginator->sort('Property.name','Property');?> <span class="caret"></span></th>
			<?php endif; ?>
		  <th width="37%"><?php echo $this->Paginator->sort('Conversation.title','Subject');?> <span class="caret"></span></th>
			<th width="11%"><?php echo $this->Paginator->sort('ConversationsUser.last_msg_time','Date');?> <span class="caret"></span></th>
			<th width="11%"><?php echo $this->Paginator->sort('ConversationsUser.status','Status');?> <span class="caret"></span></th>
	</tr>
	<?php
	$properties_list = array();
    if(isset($msgs) && count($msgs) > 0):
		foreach($msgs as $msg){
			switch($msg['ConversationsUser']['status'])
			{
				case MSG_STATUS_UNREAD:
					$status = 'Unread';
					break;
				case MSG_STATUS_READ:
					$status = 'Read';
					break;
				default:
					$status = 'Unread';
					break;
			}
			$unit = isset($msg['Conversation']['Sender']['Unit']['number']) ? $msg['Conversation']['Sender']['Unit']['number'] : 'Unassigned';
			if($msg['Conversation']['Sender']['type'] == USER_TYPE_MANAGER){
				$unit = '(Manager)';
		  } else{
		    $unit = '(Unit: '.$unit .')';
		    if( isset($msg['Conversation']['Sender']['Unit']['number']) and $msg['Conversation']['Sender']['Unit']['number']==0){$unit='(Unassigned)';}
		  }

debug($msg);

      // Prop name code seems obsolete - i.e. not used
      if(isset($msg['Conversation']['Sender']['Property']['name'])) 
      {
         $prop_name = $msg['Conversation']['Sender']['Property']['name'];
      }
      else 
      {
         $prop_name =  ' ';
      }

      if(isset($msg['Conversation']['Sender']['Property']['name']))
      {
         if(!in_array($msg['Conversation']['Sender']['Property']['name'], $properties_list))
         {
            array_push($properties_list, $msg['Conversation']['Sender']['Property']['name']);
         }
      }

      $property_print = '';
      foreach($properties_list as $property_list)
      {
         $property_print .= $property_list . ', ';
      }
      $property_print = rtrim(trim($property_print), ',');
    
      /*
       *  Was attempting to assign a class and setup a jquery function, on docready, call
       *   conversations getPropName from conversation id... pretty convoluted but only way
       *   to find it per conversation.... UNTIL, I realized all conversations must be for the
       *   current property when a PM is logged in as PM can only look at data for 1 prop at a time
       */ 
      if (!empty($property_print))
      {
         //$property_print = "<span class=\"getPropName\" id=\"" . $msg['Conversation']['id'] . "\"></span>";
         //$property_print = $curProp['name'];
      }

			
      $title = $msg['Conversation']['title'];
      if(strlen($title) > 120)
	$title = substr($title, 0, 117) . '...';
				
      if($user_type == !USER_TYPE_TENANT):
         echo $this->Html->tableCells(array(
            $msg['Conversation']['Sender']['first_name'] . ' ' . $msg['Conversation']['Sender']['last_name'] . ' '.$unit,
            $property_print,
            $this->Html->link($title, array('controller' => 'Conversations', 'action' => 'view', $msg['Conversation']['id']), array('class' => 'msg-link')),
            $this->Time2->messageTime($this->Time->convert(strtotime($msg['ConversationsUser']['last_msg_time']), $user_timezone)),
            array($status, array('class' => 'status'))), array('class' => 'odd ' . strtolower($status)), array('class' => 'even ' . strtolower($status)));
      else:
         echo $this->Html->tableCells(array(
            $msg['Conversation']['Sender']['first_name'] . ' ' . $msg['Conversation']['Sender']['last_name'] . ' '.$unit,
            $this->Html->link($title, array('controller' => 'Conversations', 'action' => 'view', $msg['Conversation']['id']), array('class' => 'msg-link')),
            $this->Time2->messageTime($this->Time->convert(strtotime($msg['ConversationsUser']['last_msg_time']), $user_timezone)), array($status, array('class' => 'status'))), array('class' => 'odd ' . strtolower($status)), array('class' => 'even ' . strtolower($status)));
      endif;
			
      }
    else:
		  echo '<tr class="no_click"><td colspan="5" class="no_rows">
		  <svg class="mail" version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="75.422px" viewBox="0 0 100 75.422" enable-background="new 0 0 100 75.422" xml:space="preserve">
      <path fill="#ddd" d="M100,75.422H0V0h100V75.422L100,75.422z M11.833,68.445h76.333L63.048,42.73l-4.756,4.787
      	c-2.059,2.058-5.007,3.236-8.105,3.236c-0.017,0-0.035-0.003-0.052-0.003c-3.11-0.013-6.067-1.216-8.115-3.304l-4.835-4.895
      	L11.833,68.445L11.833,68.445z M6.977,11.973v51.461L32.282,37.59L6.977,11.973L6.977,11.973z M67.964,37.78l25.059,25.651V12.551
      	L67.964,37.78L67.964,37.78z M11.849,6.979l35.143,35.573c0.761,0.774,1.916,1.218,3.174,1.221c0.008,0,0.014,0,0.021,0
      	c1.24,0,2.421-0.438,3.161-1.182L88.722,6.979H11.849L11.849,6.979z"></path>
      </svg><br><br>
      Your inbox is empty!</td></tr>';
		endif;
	?>
	</table>
</div>
<div class="clear"></div>
	<div class='right' style="margin-top:10px;"><?php echo $this->element('paging'); ?></div>

<?php
  }
?>
