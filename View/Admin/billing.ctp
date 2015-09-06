<?php
?>
<div class="Payments view">
<div class="page_title">
  <h1>Payments Overview</h1>
</div>
<div class="clear"></div>
<?php $total_paid = 0;
  	    foreach($Billing['Payment'] as $payment):
        $total_paid = $total_paid + floatval($payment['amount']);
        endforeach; 
?>

<div class="payment_details">
   <div class="pd_header">
	
      <div class="pdh_block unit_number">
         <span>Unit Number</span>
	    <?php echo $this->Html->link($Billing['Unit']['number'], array('controller' => 'units', 'action' => 'edit', $Billing['Unit']['id'])); ?>
      </div><!-- .pdh_block -->
	  
      <div class="pdh_block">
         <span>Billing Period</span>
         <?php if($Billing['Billing']['type'] == 'Rent'): ?>
         <?php echo h($this->Time->format('M j, Y', $Billing['Billing']['billing_end'])); ?> - <br>
         <?php echo h($this->Time->format('M j, Y', $Billing['Billing']['rent_period'])); ?>
         <?php else: ?>
         <?php echo h($this->Time->format('M j, Y', $Billing['Billing']['billing_end'])); ?>
         <?php endif; ?>
       </div><!-- .pdh_block -->
		
       <div class="pdh_block">
          <span>Amount Due</span>
          <?php echo $this->Number->currency( $Billing['Billing']['rent_due'] ,'USD');?><br>
          <div class="blance_small">
             Amount Paid: <div class="green_rent"><?php echo $this->Number->currency( $total_paid ,'USD'); ?></div><br>
             Outstanding Balance: <?php 
             if(floatval($Billing['Billing']['rent_due'] - $total_paid < 0))
                echo '<div class="green_rent">$0.00</div>';
             else
                echo '<div class="red_rent">'.$this->Number->currency( floatval($Billing['Billing']['rent_due'] - $total_paid) ,'USD').'</div>';
          ?>
          </div><!-- .blance_small -->
       </div><!-- .pdh_block -->
	
       <div class="pdh_block">
          <span>Payment Status</span>
          <?php if($Billing['Billing']['status'] == 'late'):
                   echo '<div class="red_rent">'.ucfirst($Billing['Billing']['status']) .'</div>'; 
                else:
                if($Billing['Billing']['status'] == 'due')
                   echo '<div class="">'.ucfirst($Billing['Billing']['status']) .' Today</div>'; 
                elseif ($Billing['Billing']['status'] == 'paid')
                   echo '<div class="green_rent">'.ucfirst($Billing['Billing']['status']) .'</div>';
                else
                   echo '<div class="">'.ucfirst($Billing['Billing']['status']) .'</div>';
                endif;  
          ?>
       </div><!-- .pdh_block -->
		
       <div class="pdh_block last_block">
          <span>Billing Id</span>
          <?php echo h($Billing['Billing']['id']); ?>
       </div><!-- .pdh_block -->
    </div><!-- .pd_header -->
	
    <div class="ph_body">
       <div class="pd_rent_bkd pd_section">
          <h2>Rent Breakdown</h2>
    <table>
    	<tr>
    	  <th>Fee Name</th>
    	  <th>Amount</th>
    	  <th width="20%">&nbsp;</th>
    	  <th width="20%">&nbsp;</th>
    	</tr>
	    <?php 
	    $rent_total = 0;
       foreach($Billing['BillingFee'] as $unitfee):
    	    echo '<tr>';
    	      echo '<td>'. $unitfee['name'].'</td>';
    	      echo '<td>'. $this->Number->currency( $unitfee['amount'] ,'USD') .'</td>';
    	      $rent_total = $rent_total + floatval($unitfee['amount']);
    	      echo '<td>&nbsp;</td>';
    	      echo '<td>&nbsp;</td>';
    	    echo '</tr>';
      endforeach;
	   	    
      echo '<tr class="totals">';
    	      echo '<td><strong>Total</strong></td>';
    	      echo '<td><strong>'. $this->Number->currency( $rent_total ,'USD') .'</strong></td>';
    	      echo '<td>&nbsp;</td>';
    	      echo '<td>&nbsp;</td>';
    	    echo '</tr>';

      ?>
  </table>
  <div class="pd_section_border"></div><!-- .pd_section_border -->
	</div><!-- .pd_rent_bkd -->
	<div class="pd_payment_list pd_section">
		<h2>Completed payments</h2>
    <table>
	    	<tr>
	    	  <th>From</th>
	    	  <th>Amount</th>
	    	  <th>Type</th>
	    	  <th>Date</th>
	    	  <th>Status</th>
	    	  <th>Payment Id</th>
	    	</tr>
  	    <?php $total_paid = 0;
  	    foreach($Billing['Payment'] as $payment):
  	    echo '<tr>';
  	      echo '<td>'. $payment['User']['first_name'] .' ' . $payment['User']['last_name'] . '</td>';
  	      echo '<td class="good_payment">' . $this->Number->currency( $payment['amount'] ,'USD') . '</td>';
  	      echo '<td>'.$payment['type'].'</td>';
  	      echo '<td>' . $this->Time->format('M j, Y', $payment['created']) . '</td>';
  	      echo '<td>' . $payment['status'] . '</td>';
  	      echo '<td>#'.$payment['id'].'</td>';
  	    echo '</tr>';
  	    $total_paid = $total_paid + floatval($payment['amount']);
        endforeach; 
        if($total_paid == 0):
          echo '<tr><td colspan="6" style="text-align:center; color:#aaa; border-bottom: 1px solid #e1e1e1; border-top: 1px solid #e1e1e1;"><br><br>No Payments<br><br><br></td></tr>';
        else:	    
            echo '<tr class="totals">';
    	      echo '<td><strong>Total</strong></td>';
    	      echo '<td><strong>'. $this->Number->currency( $total_paid ,'USD') .'</strong></td>';
    	      echo '<td>&nbsp;</td>';
    	      echo '<td>&nbsp;</td>';
    	      echo '<td>&nbsp;</td>';
    	       echo '<td>&nbsp;</td>';
    	    echo '</tr>';
        endif;
        ?>
	  </table>
  <div class="pd_section_border"></div><!-- .pd_section_border -->
	</div><!-- .pd_payment_list -->
	<div class="pd_resident_list pd_section">
		<h2>Unit Residents</h2>
    <table>
	    	<tr>
	    	  <th>Name</th>
	    	  <th>Email</th>
	    	  <th>Phone</th>
	    	</tr>
  	    <?php 
  	    foreach($Billing['Unit']['Tenant'] as $resident):
  	    echo '<tr>';
  	      echo '<td>'.$resident['first_name'].' ' . $resident['last_name'] . '</td>';
  	      echo '<td>'. $resident['email']. '</td>';
  	      echo '<td>' . $resident['phone'] . '</td>';
  	    echo '</tr>';
  	    endforeach;
        ?>
	  </table>
	  <div class="pd_section_border"></div><!-- .pd_section_border -->
	</div><!-- .pd_resident_list -->
	</div><!-- .ph_body -->
</div><!-- .payment_details -->
</div><!-- .Payments -->
