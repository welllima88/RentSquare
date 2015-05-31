  <div id="res_property" class="res_step step select_unit">
      <div class="register_form">
       <div class="register_wrapper">  
         <h1 class="reg_title no_bottom_border">
           <?php echo $property['Property']['name']; ?>
         </h1>
           <div class="sub_address"> <?php echo $property['Property']['address'] .', '.  $property['Property']['city'] . ', '.
            $states[$property['Property']['state_id']] . ' ' .  $property['Property']['zip']; ?></div>
         <br>
          <?php  echo $this->Session->flash(); ?>
          <br>
          
          <?php 
          
          echo $this->Form->create('User', array('action' => 'selectunit','url' => $this->request->here, 'inputDefaults' => array('label' => false,'div' => false)));
          echo $this->Form->hidden('User.user_id',array( 'value' => $user_id ));
          echo '<div class="unit_select">';
          echo $this->Form->input('User.requested_unit',array('type'=>'select','options'=>$unit_list,'empty' => 'Please select a Unit', 'label' => '', 'class'=>'chzn-select', 'id'=>'select_box_unit'));
          echo '<span class="manual">or enter a unit manually</span>';
          echo $this->Form->input('User.manual_unit',array('label'=>'','placeholder'=>'Enter unit manually','id'=>'manual_unit'));
          echo '</div><!-- .unit_select -->';
          echo $this->Form->button("Submit", array('class' => 'btn btn-success','escape' => false, 'id'=>'submit_button' )); 
          echo $this->Form->end(); ?>
      
      </div><!-- .register_wrapper -->
      <br><br>
      </div><!-- .register_form -->
      <div class="clear"><br></div>
  </div><!-- #res_property -->
  <div class="clear"><br></div>
  <script>
  jQuery(function(){
    jQuery(".chzn-select").chosen();
    jQuery('#manual_unit').keypress(function(){ jQuery('#select_box_unit').val('').trigger("liszt:updated"); })
    jQuery('#select_box_unit').chosen().change( function() { jQuery('#manual_unit').val(''); } );
    jQuery('#submit_button').click(function(){
      $man_unit = jQuery('#manual_unit').val();
      if($man_unit != '' && $man_unit != null){
        jQuery('#select_box_unit').append('<option value="0|'+$man_unit+'">'+$man_unit+'</option>');
        jQuery('#select_box_unit').val('0|'+$man_unit).attr('selected', 'selected').trigger("liszt:updated");
      }
    });

  });  
  </script>
  <style>
  form{ overflow: visible; min-height: 127px; clear: both;}
  #res_property input[type="text"] {
    width: 100%;
    margin: 0%;
    padding: 4px;
    }
  .register_form, .step{
    overflow: visible;
  }
  #select_box_unit_chzn{
    text-align: left;
  }
  </style>