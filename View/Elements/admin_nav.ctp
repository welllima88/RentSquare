<?php
  if($unreadMsgs != 0){ $msgCount = ' <span class="unread_count">'. $unreadMsgs . '</span>'; } else { $msgCount = ''; }
  ?>
  
  
  <div class="menu_item">
	    <?php echo $this->ExHtml->link('
	      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  x="0px" y="0px" width="100px" height="87.5px" viewBox="0 0 100 87.5" enable-background="new 0 0 100 87.5" xml:space="preserve">
        <polygon class="svg_initial" points="12.5,87.5 43.75,87.5 43.75,62.5 56.25,62.5 56.25,87.5 87.5,87.5 87.5,50 100,50 50,0 0,50 12.5,50 "/>
        </svg>
        All Properties', array('controller' => 'Admin', 'action' => 'index'),array('escape'=>false));?>
	</div><!-- .menu_item -->
  
  <!--
<div class="menu_item">
	    <?php echo $this->ExHtml->link('
	    <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        	 width="80.633px" height="100px" viewBox="0 0 80.633 100" enable-background="new 0 0 80.633 100" xml:space="preserve">
        <rect class="svg_initial" x="16.771" y="16.969" class="svg_initial" width="35.127" height="1.482"/>
        <polygon class="svg_initial" points="5.696,6.889 64.027,6.889 64.027,21.909 69.725,21.909 69.725,0 0,0 0,75.789 8.607,75.789 
        	8.607,70.096 5.697,70.096 "/>
        <path class="svg_initial" d="M10.909,24.21V100h60.862c4.537,0,8.861-5.357,8.861-11.355V24.21H10.909z M71.771,93.111H16.605V31.099
        	h58.333v57.547h0.002C74.939,90.432,73.669,93.111,71.771,93.111z"/>
        <rect x="27.68" y="41.179" class="svg_initial" width="35.126" height="4.468"/>
        <rect x="44.348" y="53.046" class="svg_initial" width="22.465" height="25.902"/>
        <rect x="25.675" y="53.046" class="svg_initial" width="13.397" height="2.295"/>
        <rect x="25.675" y="67.846" class="svg_initial" width="13.397" height="2.297"/>
        <rect x="25.675" y="82.137" class="svg_initial" width="13.397" height="2.299"/>
        <rect x="25.675" y="60.572" class="svg_initial" width="13.397" height="2.297"/>
        <rect x="25.675" y="74.865" class="svg_initial" width="13.397" height="2.297"/>
        </svg>
        Reports', array('controller' => 'Reports', 'action' => 'index'),array('escape'=>false));?>
	</div><!-- .menu_item -->
  <div class="menu_item">
	    <?php echo $this->ExHtml->link($msgCount.'
	    <svg class="mail" version="1.0"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
      	 width="100px" height="75.422px" viewBox="0 0 100 75.422" enable-background="new 0 0 100 75.422" xml:space="preserve">
      <path class="svg_initial" d="M100,75.422H0V0h100V75.422L100,75.422z M11.833,68.445h76.333L63.048,42.73l-4.756,4.787
      	c-2.059,2.058-5.007,3.236-8.105,3.236c-0.017,0-0.035-0.003-0.052-0.003c-3.11-0.013-6.067-1.216-8.115-3.304l-4.835-4.895
      	L11.833,68.445L11.833,68.445z M6.977,11.973v51.461L32.282,37.59L6.977,11.973L6.977,11.973z M67.964,37.78l25.059,25.651V12.551
      	L67.964,37.78L67.964,37.78z M11.849,6.979l35.143,35.573c0.761,0.774,1.916,1.218,3.174,1.221c0.008,0,0.014,0,0.021,0
      	c1.24,0,2.421-0.438,3.161-1.182L88.722,6.979H11.849L11.849,6.979z"/>
      </svg>
      Messages', array('controller' => 'Conversations', 'action' => 'inbox'), array('escape' => false));?>
  </div><!-- .menu_item -->
