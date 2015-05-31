<!-- Modal -->
<div id="add_unit_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add Unit</h3>
  </div>
  <div class="modal-body">
    <p>
      <?php
      	echo $this->Form->create('Unit', array('controller' => 'Units', 'action' => 'add'));
      	echo $this->Form->input('number', array('label' => '','placeholder' => 'Number/Letter'));
      	echo $this->Form->input('rent', array('label' => '','placeholder' => 'Rent'));
      ?>
    </p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-success">Add Unit</button>
    <?php $this->Form->end(); ?>
  </div>
</div>