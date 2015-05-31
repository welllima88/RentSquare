<?php  echo $this->Session->flash(); ?>

  <?php echo $this->Html->link('<i class="icon-edit icon-white"></i> Compose', array('controller'=>'Conversations','action'=>'send'), array('class' => 'btn btn-success', 'id' => 'compose_message','escape' => false)); ?>

<div class="page_title">
  <h1>Message Center</h1>
</div>
<div class="clear"></div>
<div class="block_title messages_block_title">
  <?php echo $this->Html->link('<i class="icon-inbox icon-white"></i> Inbox', array('controller' => 'Conversations', 'action' => 'inbox'), array('class' => 'inbox-nav','escape' => false)); ?>
  <?php echo $this->Html->link('<i class="icon-share-alt icon-white"></i> Sent', array('controller' => 'Conversations', 'action' => 'outbox'), array('class' => 'outbox-nav','escape' => false)); ?>
  <?php //echo $this->Html->link('<i class="icon-trash icon-white"></i> Trash', array('controller' => 'Conversations', 'action' => 'send'), array('escape' => false)); ?>
</div>

<script>
jQuery('.messages_block_title a').hover(function() {
  if(!jQuery(this).hasClass('active'))
    jQuery(this).find('i').removeClass('icon-white');
},function(){
  if(!jQuery(this).hasClass('active'))
    jQuery(this).find('i').addClass('icon-white');
});
jQuery(function(){
  jQuery('.<?php echo $this->request->action; ?>-nav').addClass('active').children('i').removeClass('icon-white');
});
</script>

