<div class="register_form">
<div class="register_wrapper">
    <h1 class="reg_title no-margin-bottom no_bottom_border">Success!</h1>
<?php echo $this->Session->flash(); ?>
    <div class="success_text"><br><br>
      Thank you for registering for RentSquare. <br><br>
      We will notify you via email when your property manager accepts your application to use the system. <br><br><br>
      <?php echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'index')); ?>
    </div><!--  -->  
</div><!-- #register_wrapper -->
</div><!-- #register_form -->