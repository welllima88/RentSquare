<div class="property_submenu">
    <ul>
<?php
 /*
       <li>
            <div class="floatRight" style="position:relative;">
               <?php echo $this->Html->link(h('Activate a Property'),array('controller' => 'Admin', 'action' => 'activateproperty','full_base' => true),array('class'=>'btn btn-padding btn-small floatRight'));?>
               <div class="inactive_prop_count <?php if($inactive_properties == 0) echo 'good'; ?>">
                   <?php echo $inactive_properties; ?>
               </div><!-- .inactive_count -->
            </div><!-- .floatRight -->
       </li>
*/
?>
       <li>
    	 <?php echo $this->Html->link(h('Deactivate A Property'), 
           array('controller' => 'Users', 'action' => 'pmlist', 'full_base' => true),
           array('class'=>'')); ?>
       </li>
    </ul><!-- .submenu -->    	
</div><!-- .property_submenu -->
