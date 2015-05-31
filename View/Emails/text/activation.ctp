Welcome <?php echo $name; ?>,

Thank you for registering with RentSquare.  Your account is almost setup, we just need you to activate your account by following the link below:
<?php echo $this->Html->link('Activate your account', $this->Html->url(array('controller' => 'Users', 'action' => 'activate', 'id' => $userid, 'key' => $key), true)); ?>