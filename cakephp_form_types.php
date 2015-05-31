Image Upload Usage
------------------
<?php

  $results = $this->uploadphoto($data['Restaurant']['logo_file']);
          
  //If Upload was sucess (not an error)
  if(!isset($results['error'])):
    //Sucessfull Upload
  else:
    //echo error message
  endif;

?>


Create Form
-------------
  
    <?php echo $this->Form->create('RestaurantContact',array('controller'=>'RestaurantContact','action'=>'add')); ?>
      
        //Add Inputs
        //Order Id
      

    <?php echo $this->Form->end(__('Submit')); ?>

Submit Button:
<?php           
  echo $this->Form->button("Remind Me", array('class' => 'btn btn-success','escape' => false )); 
  echo $this->Form->end();
 ?>

Ajax Submit
<?php 
  echo $this->Js->submit(__('Add Menu Hour'), array('update'=>'#menu_hours', 'url'=>array('controller'=>'MenuHours','action'=>'add')));
  echo $this->Form->end(); ?>
     
     
Ajax in Controller
-------------------------------
<?php if($this->request->is('ajax'))  ?>

Custom Submit Button On Form
--------------------------------

 <?php echo $this->Form->create('RestaurantContact',array('controller'=>'RestaurantContact','action'=>'add')); ?>
      
        //Add Inputs
        //Order Id
      
  <?php echo $this->Form->submit(
      __('Send'), 
      array('class' => 'custom-class', 'title' => 'Custom Title')
  ); ?>
 <?php echo $this->Form->end(); ?>

                     
                          

Input Types:

Radio Button
--------------
<?php
echo $this->Form->input('Property.0.ownership_type', array('type'=>'radio','options'=>array('Corporation','LLC','Partnership','Sole Proprietor'),'legend'=>false,'separator'=>'</li><li>','div'=>false,'class'=>'ownership_type validate[required]'));
?>



Check Box
-------------
<?php echo $this->Form->input('Property.agreeTerms', array('label'=>'','type'=>'checkbox','class'=>'validate[required]')); ?>



Select
-------------
<?php echo $this->Form->input('MenuHour.day',array('type'=>'select','options'=>array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'),'empty'=>'Select Day','multiple' => false)); ?>


Saving
--------------
<?php

// Create a New Row: id isn't set or is null
$this->Recipe->create();
$this->Recipe->save($this->request->data);

// Update existing Row: id is set to a numerical value
$this->Recipe->id = 2;
$this->Recipe->save($this->request->data);

?>