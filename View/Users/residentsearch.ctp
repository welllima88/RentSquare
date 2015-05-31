<script type='text/javascript'>
	function getUnitsBySearch(){
		<?php echo $this->Js->request(array('controller' => 'Users', 'action' => 'getUnitsFromSearch', $user_id), array('update' => '#unit_search_results', 'evalScripts' => true, 'data' => $this->Js->get('#search_property')->serializeForm(array('isForm' => false, 'inline' => true)), 'dataExpression' => true, 'method' => 'post')); ?>
	}
</script>

  <?php //echo $user_id; ?>
     
  <div id="res_property" class="res_step step ">
      <div class="register_form">
       <div class="register_wrapper">
       <?php 
         echo $this->Form->create('User', array('action' => 'residentsearch'));

         echo $this->Session->flash(); ?>
         
         <h1 class="reg_title">Find Your Property</h1>
         
          <?php 

          echo $this->Form->input('search', array('label' => '','placeholder' => 'Search by property name, address, zip, or phone number','id' => 'search_property'));
        	echo $this->Html->link(
              "<i class='icon-search icon-white'></i> Search",
              "#",
              array('escape' => false,'class' => 'btn btn-success search_prop','onclick'=> 'getUnitsBySearch()','id'=>'click_search' ));
          echo '<div class="clear"><br></div>'; 
          ?>
          <div id="unit_search_results"></div>
          
          <?php echo $this->Form->end(); ?>
                    
      </div><!-- .register_wrapper -->
      </div><!-- .register_form -->
      <div class="clear"><br></div>
  </div><!-- #res_property -->
  <div class="clear"><br></div>
  <script>
    jQuery(function(){
    	jQuery('#search_property').autocomplete({ source: [ 
    	<?php foreach($prop_names as $p_name){
      	echo '"' . $p_name['Property']['name']. '" ,';
    	} echo '""';?>
    	] });
    	$('#search_property').keypress(function (e) {
        if (e.which == 13) {
          $('#click_search').click();
        }
      });
    });
  </script>
  
  