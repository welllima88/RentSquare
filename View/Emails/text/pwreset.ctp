Hello <?php echo $name; ?>,

Someone recently requested a password reset on your RentSquare account.  If this was you and you would like to reset your password, please follow the link below to reset your password:<br />
<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'resetpassword',  $userid, $key), true); ?>