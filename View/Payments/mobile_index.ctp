<div class="mobile-header">
<div class="mobile_wrapper">
		<?php echo $this->Html->link($this->Html->image('rslogo.png', array('id' => 'mobile_logo')), '/', array('escape' => false)); ?>
		<div class="full_site">
			<?php echo $this->Html->link(h('Full Site'),array('controller' => 'Users', 'action' => 'visitFullSite','full_base' => true),array('class'=>''));?>&nbsp; | &nbsp;
			<?php echo $this->Html->link(h('Logout'),array('controller' => 'Users', 'action' => 'logout','full_base' => true),array('class'=>''));?>
    
		</div><!-- .full_site -->
		
    
    <div class="clear"></div>
</div><!-- .mobile_wrapper -->
</div><!-- .mobile-header -->
<div class="mobile-body pay-rent-mobile">
	<div class="mobile_wrapper">
	  <?php 
      if($user['type'] == USER_TYPE_MANAGER): ?><br>
      
      
      <?php //Resident
      else: ?>
          <div id='flash-container'><?php echo $this->Session->flash(); ?></div>
          <strong>Tap to select the balance you wish to pay</strong><br>
          <?php //Find Current Balance
           foreach($Billings as $billingcycle): ?>
           
              
              <a href="/Payments/mobilerent/<?php echo $billingcycle['Billing']['id']; ?>" class="billing_cycle_mobile">
              	<em>Current balance</em>: <?php echo date('n/j/y',strtotime($billingcycle['Billing']['billing_end'])) . ' - ' .date('n/j/y',strtotime($billingcycle['Billing']['rent_period'])); ?>
              	<div class="clear"></div>
              	<div class="balance_block">
              		<div class="dollar_sign">
              			$
              		</div><!-- .dollar_sign -->
              		<div class="balance_text">
              			<?php
                      $balance_due =  floatval($billingcycle['Billing']['rent_due']);
                      foreach($billingcycle['Payment'] as $payment):
                        $balance_due = floatval($balance_due) - floatval($payment['amount']);
                      endforeach; 
                      echo ltrim($this->Number->currency($balance_due, 'USD', array('before'=>'')),'$');
                      
                      ?>
              		</div><!-- .balance_block -->
              	</div><!-- .balance_block -->
              	<div class="clear"></div>
              	<?php 
              	  if($billingcycle['Billing']['status'] == 'late'){
                	  echo '<div class="due_in late_mobile">'.$this->Html->image('bkg-flag.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'LATE</div>';
              	  } elseif($billingcycle['Billing']['status'] == 'due'){
                	  echo '<div class="due_in due_mobile">'.$this->Html->image('bkg-flag.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'DUE TODAY</div>';
              	  } else{
                    
                    $diff = abs(strtotime(date('Y/m/d')) - strtotime($billingcycle['Billing']['billing_end']));
                    
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                	  echo '<div class="due_in unpaid_mobile">'.$this->Html->image('bkg-flag.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'DUE IN '.$days;
                	  if($days>1)
                	    echo ' DAYS</div>';
                	  else
                	    echo ' DAY</div>';
              	  }
              	 ?>
              </a><!-- .billing_cycle_mobile -->
              <div class="clear"></div>
              
           <?php   
             endforeach;
           ?>
      <?php endif; ?>
	  
	</div><!-- .mobile_wrapper -->
</div><!-- .mobile-body -->

