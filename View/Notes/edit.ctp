<br><div class="block_title">
  Edit Note
</div>
<div class="gray_block">

<div class="notes form">
<?php echo $this->Form->create('Note'); ?>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->hidden('user_id');
		echo $this->Form->hidden('creater_id');
		echo $this->Form->input('note');
	?>
	<?php echo $this->Form->button("Save", array('class' => 'btn  btn-success','escape' => false )); ?>
  <?php echo $this->Form->end(); ?>
</div>
 <div class="clear"></div>
</div><!-- .gray_block -->