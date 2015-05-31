<style>
  #register_wrapper{ padding-top: 0px; }
</style>
<div class="register_form">
<div class="register_wrapper">
    <h1 class="reg_title no-margin-bottom">RentSquare Registration</h1>
<?php echo $this->Session->flash(); ?>
  <div id="register_pm">
  <?php
    echo $this->Html->link(
      $this->Html->image("prop_man.png", array("alt" => "Property Manager")) . "<br>Property Manager",
      array('controller' => 'Users', 'action' => 'propertymanager'),
      array('escape' => false,'class' => 'register_type'));
  ?>
  </div><!-- register_pm -->
  <div id="register_res">
  <?php
    echo $this->Html->link(
      $this->Html->image("resident.png", array("alt" => "Resident")) . "<br><div class='res_label'>Resident</div>",
      array('controller' => 'Users', 'action' => 'resident'),
      array('escape' => false,'class' => 'register_type'));
  ?>
  </div><!-- register_res -->
  <div class="clear"><br></div>
  <div class="register_login">
    Already a Member? <?php echo $this->Html->link('Login Now', array('controller' => 'Users', 'action' => 'login')); ?>
  </div><!-- register_login -->
</div><!-- #register_wrapper -->
</div><!-- #register_form -->