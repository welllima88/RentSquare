
<div class="page_title">
  <h1>Maintenance Requests</h1>
</div>
<div class="clear"></div>
<div class="block_title">
	<?php 
        $imgcnt = "0";
	$unitNum = '(Unassigned)';
		if(isset($ticket['Tenant']['Unit']['number']))
			$unitNum = $ticket['Tenant']['Unit']['number'];
			echo $ticket['Tenant']['first_name'] . ' '  . $ticket['Tenant']['last_name']; ?>
	 <?php echo $unitNum ?> &nbsp;&nbsp;&nbsp;&nbsp;<div class="maint-date">
	 <?php 
	 echo $this->Time2->messageTime($this->Time->convert(strtotime($ticket['MaintenanceTicket']['created']), $curProp['timezone'])); ?> 
	 (<?php 
	 echo $this->Time2->timeAgoInWords($ticket['MaintenanceTicket']['created'],array('format' => 'F jS, Y', 'end' => '+1 year','userOffset' => $curProp['timezone'])); ?>) </div>
	</div><!-- .block_title -->
	

  <div class="block_content">
	<div class='left two_thirds maintenance'>
		<h4>Request</h4>
		<?php echo $ticket['MaintenanceTicket']['title']; ?>
		<br><br>
		<ul class="location_nature_enter">
    		<li><h4>Location</h4></li>
    		<li><h4>Nature</h4></li>
    		<li><h4>Can Enter?</h4></li>
		</ul>
		<ul class="location_nature_enter">
		  <li><?php echo $ticket['MaintenanceTicket']['location']; ?></li>
		  <li><?php echo $ticket['MaintenanceTicket']['nature']; ?></li>
		  <li><?php echo $ticket['MaintenanceTicket']['can_enter'] ? 'No' : 'Yes'; ?></li>
		</ul>
		<div class="clear"></div>
    <br>
		<h4>Description</h4>
		<?php echo $ticket['MaintenanceTicket']['description']; ?>
   	<br><br>
    	<h4>Photos</h4>
    	<?php $any_photos = "no"; ?>
      <?php if($ticket['MaintenanceTicket']['image_url'] != ""): ?>
      <button type="button" id="carbtn0" data-toggle="modal" data-target="#myModal" data-local="#myCarousel">
         <img width="102" height="102" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url']; ?>" border="0" alt=""/>
      </button>
      <div id="photoModal_1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-body" style="text-align:center;">
            <p>Photo 1<br><br><a href="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url']; ?>"><img style="max-width:100%;" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url']; ?>" border="0" alt=""/></a><br><br></p>
        </div><!-- modal-body -->
      </div><!-- modal -->
      <?php $any_photos = "yes"; $imgcnt++; endif; ?>
      
      <?php if($ticket['MaintenanceTicket']['image_url_2'] != ""): ?>
        <button type="button" id="carbtn1" data-toggle="modal" data-target="#myModal" data-local="#myCarousel">
           <img width="102" height="102" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_2']; ?>" border="0" alt=""/>        </button>
        <div id="photoModal_2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-body" style="text-align:center;">
              <p>Photo 2<br><br><a href="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_2']; ?>"><img style="max-width:100%;" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_2']; ?>" border="0" alt=""/></a><br><br></p>
          </div><!-- modal-body -->
        </div><!-- modal -->
      <?php $any_photos = "yes"; $imgcnt++; endif; ?>
      
      <?php if($ticket['MaintenanceTicket']['image_url_3'] != ""): ?>
        <button type="button" id="carbtn2" data-toggle="modal" data-target="#myModal" data-local="#myCarousel">
           <img width="102" height="102" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_3']; ?>" border="0" alt=""/>        </button>
        <div id="photoModal_3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-body" style="text-align:center;">
              <p>Photo 3<br><br><a href="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_3']; ?>"><img style="max-width:100%;" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_3']; ?>" border="0" alt=""/></a><br><br></p>
          </div><!-- modal-body -->
        </div><!-- modal -->
      <?php $any_photos = "yes"; $imgcnt++; endif; ?>
      
      <?php if($ticket['MaintenanceTicket']['image_url_4'] != ""): ?>
        <button type="button" id="carbtn3" data-toggle="modal" data-target="#myModal" data-local="#myCarousel">
           <img width="102" height="102" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_4']; ?>" border="0" alt=""/>
        </button>
        <div id="photoModal_4" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-body" style="text-align:center;">
              <p>Photo 4<br><br><a href="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_4']; ?>"><img style="max-width:100%;" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']['image_url_4']; ?>" border="0" alt=""/></a><br><br></p>
          </div><!-- modal-body -->
        </div><!-- modal -->
      <?php $any_photos = "yes"; $imgcnt++; endif; ?>
      <?php if($any_photos == "no"){ echo 'No Photos'; } ?>
      <div class="clear"></div>
      <br><br>
      <br><br>

      <div class="modal fade modal-fullscreen force-fullscreen" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Maintenance Images</h4>
            </div>
            <div class="modal-body">
                  <div id="myCarousel" class="carousel slide carousel-fit" data-ride="carousel">
      
                     <ol class="carousel-indicators">
                        <?php 
                        for($q=0; $q < $imgcnt; $q++)
                        {
                        ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $q; ?>" class=""></li>
                        <?php 
                        }
                        ?>
                     </ol>
      
                     <div class="carousel-inner">
                     <?php
                        //$ttl = count($ticket['MaintenanceTicket']);
                        $imgactive = "active";
                        for($i=0; $i < $imgcnt; $i++)
                        {
                           // Due to inconsistent field names for images, got to jump through some hoops here
                           if ($i > 0) { $imgactive = ""; }
                           $plus1 =  $i+1;
                           $plussub = "_" . $plus1;
                           if ($plus1 == "1") { $plussub = ""; }
                     ?>
                           <div class="item <?php echo $imgactive; ?>">
                              <a href="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']["image_url$plussub"]; ?>" target="_new"><p style="text-align: center;">Photo <?php echo $plus1; ?><br><br><img style="max-width:100%;" src="<?php echo Router::url('/',true); ?>files/<?php echo $ticket['MaintenanceTicket']["image_url$plussub"]; ?>" alt=""/><br><br></p></a>
                           </div>
                     <?php
                        }
                     ?>
                     </div>
      
                     <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                     <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
      
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


		<?php
			//echo $this->Form->create('MaintenanceTicket', array('url' => array('controller' => 'MaintenanceTickets', 'action' => 'update'), 'id' => 'ticket-form'));
			//echo '<h4>Update Status</h4>';
			//echo $this->Form->input('status', array('type' => 'select', 'options' => Configure::read('MaintenanceTickets.status'), 'label' => false, 'id' => 'ticket-status', 'value' => $ticket['MaintenanceTicket']['status']));
			//echo $this->Form->input('id', array('type' => 'hidden', 'value' => $ticket['MaintenanceTicket']['id']));
			//echo $this->Form->end();
		?>
	</div>
	<div class='right one_third main_requested_by'>
		<h4>Requested By</h4>
		<i class="icon-user"></i> <?php echo $ticket['Tenant']['first_name'] . ' ' . $ticket['Tenant']['last_name']; ?><br />
		<i class="icon-envelope"></i> <?php echo $ticket['Tenant']['email']; ?><br />
		<i class="icon-cell"></i> <?php 
		  $result = "";
		  if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $ticket['Tenant']['phone'],  $matches ) )
      {
          $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
      }
      echo (($result!="")) ? $result : $ticket['Tenant']['phone'];
       ?><br />
		<i class="icon-home"></i> Unit: <?php echo $unitNum; ?><br />
		<br>
		<h4>Requested On</h4>
		<?php echo $this->Time2->messageTime($this->Time->convert(strtotime($ticket['MaintenanceTicket']['created']), $curProp['timezone']));
		?><br />
		<br><br>
		<?php //echo $this->Html->link('Send Message', array('controller' => 'Conversations', 'action' => 'send', $ticket['Tenant']['id'], '0',str_replace(':','',str_replace(' ','_',$ticket['MaintenanceTicket']['title']))), array('class' => 'right btn ')); ?>
	</div>
	<div style="clear:both"></div>
</div><!-- .block_content -->

<script type='text/javascript'>
<?php
	echo $this->Js->get('#ticket-status')->event('change', $this->Js->request(array('controller' => 'MaintenanceTickets', 'action' => 'update'), array('data' => $this->Js->get('#ticket-form')->serializeForm(array('isForm' => true, 'inline' => true)), 'update' => '#flash-container', 'dataExpression' => true, 'method' => 'post')));
?>
</script>
