<h1 class="subject">
Re: <?php echo $conv['Conversation']['title']; ?>
</h1>
<h2 class="participants">
To:
	<?php
		$userList = array();
		foreach($conv['ConversationsUser'] as $convUser){
			if($convUser['User']['type'] == USER_TYPE_MANAGER){
  			$unit = '(Manager)';
			} elseif($convUser['User']['unit_id'] == 0){
  		  	$unit = '(Unassigned)';
			}else {
  			$unit = '(Unit: '.$convUser['User']['Unit']['number'] .')';
			}
                        //if ($convUser['user_id'] != $conv['Conversation']['sender_id'])
                        //{
			   array_push($userList, '<strong>'.$convUser['User']['first_name']. ' '.$convUser['User']['last_name'] . '</strong> '. $unit);
                        //}
		}
		echo implode(', ', $userList);

	?>
</h2>
<br>
<ul id='msg-list'>
<?php
	$nMsgs = count($conv['Message']);
	foreach($conv['Message'] as $idx => $msg){
		//echo array_search($msg["Sender"]['username'], $userList);
    if($msg['Sender']['type'] == USER_TYPE_MANAGER){
  			$unit = '(Manager)';
			} elseif($msg['Sender']['unit_id'] == 0){
  		  	$unit = '(Unassigned)';
			} else {
  			$unit = '(Unit: '.$msg['Sender']['Unit']['number'] .')';
			}
			?>

			<li class='widget msg-box <?php echo $idx == 0 ? 'uncollapsed' : 'collapsed'; ?>'>
				<h4>
					<span class='msg-from <?php echo array_search($msg["Sender"]["username"], $userList);?>'>From: <strong><?php echo $msg['Sender']['first_name'] . ' ' . $msg['Sender']['last_name'] . ' ' . $unit . '</strong>'; ?></span>
					<span class='msg-date'>
					
					<?php echo $this->Html->image('msg_cal_icon.png', array('alt' => '','class'=>'msg_cal_icon')); 
					echo '<strong>'.
					$this->Time2->messageTime($this->Time->convert(strtotime($msg['created']), $user_timezone))
					.'</strong>'; 
					?> 
					(<?php echo $this->Time2->timeAgoInWords($msg['created'],array('format' => 'F jS, Y', 'end' => '+1 year','userOffset' => $user_timezone)); ?>)
					</span>
					<br>
					
				  <span class="msg-excerpt"><?php echo $this->Html->image('email_quote.png', array('alt' => '','class'=>'email_quote')); if(strlen($msg['content']) > 70) echo substr($msg['content'],0, 70) . '...'; else echo $msg['content']; ?></span>

				</h4>
				
				<div class='msg-content'><pre><?php echo $msg['content']; ?></pre></div>
			</li>
			<?php
	}
?>
</ul>

<div class="widget msg-box msg-list-reply">
	<div class="reply_title">
		<?php echo $this->Html->link(h('Edit Recipients'), 
              array('controller' => 'Conversations', 'action' => 'send', '0',$conv['Conversation']['id'],$conv['Conversation']['title'], 'full_base' => true),
              array('class'=>'edit_recipients')
          );?>
          <h4>Reply</h4>
	</div><!-- .reply_title -->
	
<?php
	echo $this->Form->create('Message', array('url' => array('controller' => 'Conversations', 'action' => 'send')));
	echo $this->Form->input('conversation_id', array('type' => 'hidden', 'value' => $conv['Conversation']['id']));
	echo $this->Form->input('title', array('type' => 'hidden', 'value' => $conv['Conversation']['title']));
	echo $this->Form->input('content', array('type' => 'textarea', 'label' => '','placeholder'=>'Click here to reply...'));
	echo $this->Form->button("Send", array('class' => 'btn btn-success send_msg_btn','escape' => false ));
  echo $this->Form->end(); 
?>
<div class='clear'></div>
</div>
<script>
//Makes links clickable in Messages
if(!String.linkify) {
    String.prototype.linkify = function() {

        // http://, https://, ftp://
        var urlPattern = /\b(?:https?|ftp):\/\/[a-z0-9-+&@#\/%?=~_|!:,.;]*[a-z0-9-+&@#\/%=~_|]/gim;

        // www. sans http:// or https://
        var pseudoUrlPattern = /(^|[^\/])(www\.[\S]+(\b|$))/gim;

        // Email addresses
        var emailAddressPattern = /\w+@[a-zA-Z_]+?(?:\.[a-zA-Z]{2,6})+/gim;

        return this
            .replace(urlPattern, '<a target="blank" href="$&">$&</a>')
            .replace(pseudoUrlPattern, '$1<a target="blank" href="http://$2">$2</a>')
            .replace(emailAddressPattern, '<a target="blank" href="mailto:$&">$&</a>');
    };
}
jQuery('.msg-content pre').each( function(){
    jQuery(this).html(jQuery(this).html().linkify());
});
</script>
