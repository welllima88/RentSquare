<?php echo $this->element('messages_header'); ?>

<div id='outbox' class='messages'>

	<table class="subheader table-striped format messages_inbox">
	
      <tr class="no_click">
  			<th width="22%"><?php echo $this->Paginator->sort('Conversation.sender_id','To');?> <span class="caret"></span></th>
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
			$toList = array();
			$properties_list = array();
			foreach($msg['Conversation']['ConversationsUser'] as $convUser){
				//Display First Name Last Name (Unit Number)
				if(isset($convUser['User']['id']) && $convUser['User']['id'] != $user['id']){
				  if($convUser['User']['type'] == USER_TYPE_MANAGER){
  				  $unit='(Manager)';
				  }else{
				    if(isset($convUser['User']['Unit']['number'])) $unit_num = $convUser['User']['Unit']['number'];
				    else $unit_num = 'Unassigned';
				    if($unit_num==0) $unit_num = 'Unassigned';
  				  $unit='(Unit: '. $unit_num . ')';
  				  if( $unit_num==0){$unit='(Unassigned)';}
				  }
  				array_push($toList, $convUser['User']['first_name'] . ' ' . $convUser['User']['last_name'] .' '. $unit);
  				//Collect Property Names
  				if(isset($convUser['User']['Property']['name']) && $convUser['User']["type"] == USER_TYPE_TENANT){
      				if(!in_array($convUser['User']['Property']['name'], $properties_list)){
        				array_push($properties_list, $convUser['User']['Property']['name']);
      				}
				  }
				}	
			}
			$property_print = '';
			foreach($properties_list as $property_list){
  			$property_print .= $property_list . ', ';
			}
			$property_print = rtrim(trim($property_print), ',');
			
			$to = wordwrap(implode(', ', $toList), 30, "\n<br />", true);
			if(strlen($to) > 60)
				$to = substr($to, 0, 57) . '...';
		  
		  $title = $msg['Message']['title'];
		  if(strlen($title) > 120)
				$title = substr($title, 0, 117) . '...';
		  
			if($user_type == !USER_TYPE_TENANT): 
  			echo $this->Html->tableCells(array(
  				$to,
  				$property_print,
  				$this->Html->link($title, array('controller' => 'Conversations', 'action' => 'view', $msg['Message']['conversation_id']), array('class' => 'msg-link')),
  				//$this->Time2->timeAgoInWords($msg['Message']['created'])
  				$this->Time2->messageTime($this->Time->convert(strtotime($msg['Message']['created']), $user_timezone)),
  				'Sent'
  				), array('class' => 'odd'), array('class' => 'even')
  			);
			else:
			  echo $this->Html->tableCells(array(
  				$to,
  				$this->Html->link($title, array('controller' => 'Conversations', 'action' => 'view', $msg['Message']['conversation_id']), array('class' => 'msg-link')),
  				//$this->Time2->timeAgoInWords($msg['Message']['created'])
  				$this->Time2->messageTime($this->Time->convert(strtotime($msg['Message']['created']), $user_timezone)),
  				'Sent'
  				), array('class' => 'odd'), array('class' => 'even')
  			);
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
      Your outbox is empty!</td></tr>';
		endif;
	?>	
	
	</table>
</div>
<div class="clear"></div>
	<div class='right' style="margin-top:10px;"><?php echo $this->element('paging'); ?></div>
	
	<style>
	table td{
	  height: 53px;
  } 
	</style>