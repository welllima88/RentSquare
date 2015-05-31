<div class="register_form">
<div class="register_wrapper">
    <h1 class="reg_title no-margin-bottom no_bottom_border">Success!</h1>
<?php echo $this->Session->flash(); ?>
    <div class="success_text"><br><br>
      Thank you for registering for RentSquare!
      <br><br><br>      
      You will be receiving an e-mail with our online payment processing application. Once you have reviewed and signed the document, you may begin processing your rent payments online with us in no time.
      <br><br><br>
      We look forward to assisting you with all of your property management needs.
      <br><br><br>
      <?php echo $this->Html->link('Click here to login and begin adding units', array('controller' => 'Units', 'action' => 'index'),array('class'=>'btn btn-success add-units-btn')); ?><br><br>
      <?php echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'index')); ?>
    </div><!--  -->  
</div><!-- #register_wrapper -->
</div><!-- #register_form -->


