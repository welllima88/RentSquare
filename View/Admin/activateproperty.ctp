<h2>Activate Property</h2>

<?php echo $this->Form->create('Admin',array('action'=>'activateproperty')); ?>
      
<?php echo $this->Form->input('Property.id',array('type'=>'select','options'=>$property,'empty'=>'Select Property','multiple' => false,'label'=>'Select property to actiave:','class'=>'validate[required]')); ?>
<?php echo $this->Form->input('Property.pp_user',array('type'=>'text','label'=>'Phoenix Payments Merchant User Name','class'=>'validate[required]')); ?>   
<?php echo $this->Form->input('Property.pp_pass',array('type'=>'text','label'=>'Phoenix Payments Merchant Password','class'=>'validate[required]')); ?>      
<?php echo $this->Form->input('Property.no_one_time_fee', array('label'=>'Check to wave one time signup fee','type'=>'checkbox')); ?>


<?php           
  echo $this->Form->button("Activate", array('class' => 'btn btn-success','escape' => false )); 
  echo "<span style=\"margin-right: 20px;\">&nbsp;</span>";
  echo $this->Form->button("<i class=\"icon-trash icon-white\"></i>&nbsp;Remove", array('class' => 'btn btn-danger','escape' => false )); 
  echo $this->Form->end();
 ?>

<script>

jQuery(document).ready( 
    function () { 

        $('.btn-danger').click(function(){
           // ajax call to remove from database
           if (confirm("Are you sure you want to delete this property?")) {
               var propid = $('#PropertyId').val();
               window.location = "/admin/deleteproperty/" + propid;
           }
           return false;
        });

});

</script>
