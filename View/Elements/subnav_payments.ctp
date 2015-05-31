<div class="pay_submenu">
    <ul>
    	 <li>
    	 <?php if(isset($make_payment) && $make_payment) $mp_class="pay_active"; else $mp_class=""; ?>
    	 <?php echo $this->Html->link(h('Make A Payment'), 
           array('controller' => 'Payments', 'action' => 'index', 'full_base' => true),
           array('class'=>$mp_class)
       );?>
       </li>
       <li>
       <?php if(isset($auto_payment) && $auto_payment) $ap_class="pay_active"; else $ap_class=""; ?>
    	 <?php echo $this->Html->link(h('Automatic Payments'), 
           array('controller' => 'Payments', 'action' => 'autopay', 'full_base' => true),
           array('class'=>$ap_class)
       );?>
       </li>
       <li>
       <?php if(isset($hist_payment) && $hist_payment) $his_class="pay_active"; else $his_class=""; ?>
    	 <?php echo $this->Html->link(h('Payment History'), 
           array('controller' => 'Payments', 'action' => 'history', 'full_base' => true),
           array('class'=>$his_class)
       );?>
       </li>
    </ul><!-- .submenu -->    	
</div><!-- .pay_submenu -->