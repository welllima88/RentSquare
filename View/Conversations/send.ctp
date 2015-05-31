<script type="text/javascript">
<!--
/* http://www.alistapart.com/articles/zebratables/ */
function removeClassName (elem, className) {
	elem.className = elem.className.replace(className, "").trim();
}

function addCSSClass (elem, className) {
	removeClassName (elem, className);
	elem.className = (elem.className + " " + className).trim();
}

String.prototype.trim = function() {
	return this.replace( /^\s+|\s+$/, "" );
}

function stripedTable() {
	if (document.getElementById && document.getElementsByTagName) {  
		var allTables = document.getElementsByTagName('table');
		if (!allTables) { return; }

		for (var i = 0; i < allTables.length; i++) {
			if (allTables[i].className.match(/[\w\s ]*scrollTable[\w\s ]*/)) {
				var trs = allTables[i].getElementsByTagName("tr");
				for (var j = 0; j < trs.length; j++) {
					removeClassName(trs[j], 'alternateRow');
					addCSSClass(trs[j], 'normalRow');
				}
				for (var k = 0; k < trs.length; k += 2) {
					removeClassName(trs[k], 'normalRow');
					addCSSClass(trs[k], 'alternateRow');
				}
			}
		}
	}
}

/* onload state is fired, append onclick action to the table's DIV */
/* container. This allows the HTML document to validate correctly. */
/* addIEonScroll added on 2005-01-28                               */
/* Terence Ordona, portal[AT]imaputz[DOT]com                       */
function addIEonScroll() {
	var thisContainer = document.getElementById('tableContainer');
	if (!thisContainer) { return; }

	var onClickAction = 'toggleSelectBoxes();';
	thisContainer.onscroll = new Function(onClickAction);
}

/* Only WinIE will fire this function. All other browsers scroll the TBODY element and not the DIV */
/* This is to hide the SELECT elements from scrolling over the fixed Header. WinIE only.           */
/* toggleSelectBoxes added on 2005-01-28 */
/* Terence Ordona, portal[AT]imaputz[DOT]com         */
function toggleSelectBoxes() {
	var thisContainer = document.getElementById('tableContainer');
	var thisHeader = document.getElementById('fixedHeader');
	if (!thisContainer || !thisHeader) { return; }

	var selectBoxes = thisContainer.getElementsByTagName('select');
	if (!selectBoxes) { return; }

	for (var i = 0; i < selectBoxes.length; i++) {
		if (thisContainer.scrollTop >= eval(selectBoxes[i].parentNode.offsetTop - thisHeader.offsetHeight)) {
			selectBoxes[i].style.visibility = 'hidden';
		} else {
			selectBoxes[i].style.visibility = 'visible';
		}
	}
} 

window.onload = function() { stripedTable(); addIEonScroll(); }
-->
</script>
<style type="text/css">
<!--
/* Terence Ordona, portal[AT]imaputz[DOT]com         */
/* http://creativecommons.org/licenses/by-sa/2.0/    */



/* define height and width of scrollable area. Add 16px to width for scrollbar          */
/* allow WinIE to scale 100% width of browser by not defining a width                   */
/* WARNING: applying a background here may cause problems with scrolling in WinIE 5.x   */
div.tableContainer {
	clear: both;
	height: 285px;
	overflow: auto;
	width: 28%;
}

/* WinIE 6.x needs to re-account for it's scrollbar. Give it some padding */
\html div.tableContainer/* */ {
	padding: 0 16px 0 0;
	width: 740px;
}

/* clean up for allowing display Opera 5.x/6.x and MacIE 5.x */
html>body div.tableContainer {
	height: auto;
	padding: 0;
}

/* Reset overflow value to hidden for all non-IE browsers. */
/* Filter out Opera 5.x/6.x and MacIE 5.x                  */
head:first-child+body div[class].tableContainer {
	height: 285px;
	overflow: hidden;
	width: 28%;
	clear: none;
}

/* define width of table. IE browsers only                 */
/* if width is set to 100%, you can remove the width       */
/* property from div.tableContainer and have the div scale */
div.tableContainer table {
	float: left;
	width: 100%
}

/* WinIE 6.x needs to re-account for padding. Give it a negative margin */
\html div.tableContainer table/* */ {
	margin: 0 -16px 0 0
}

/* define width of table. Opera 5.x/6.x and MacIE 5.x */
html>body div.tableContainer table {
	float: none;
	margin: 0;
	width: 740px
}

/* define width of table. Add 16px to width for scrollbar.           */
/* All other non-IE browsers. Filter out Opera 5.x/6.x and MacIE 5.x */
head:first-child+body div[class].tableContainer table {
	width: 100%
}

/* set table header to a fixed position. WinIE 6.x only                                       */
/* In WinIE 6.x, any element with a position property set to relative and is a child of       */
/* an element that has an overflow property set, the relative value translates into fixed.    */
/* Ex: parent element DIV with a class of tableContainer has an overflow property set to auto */
thead.fixedHeader tr {
	position: relative;
	/* expression is for WinIE 5.x only. Remove to validate and for pure CSS solution      */
	top: expression(document.getElementById("tableContainer").scrollTop);
}

/* set THEAD element to have block level attributes. All other non-IE browsers            */
/* this enables overflow to work on TBODY element. All other non-IE, non-Mozilla browsers */
/* Filter out Opera 5.x/6.x and MacIE 5.x                                                 */
head:first-child+body thead[class].fixedHeader tr {
	display: block;
}

/* make the TH elements pretty */
thead.fixedHeader th {
}

/* make the A elements pretty. makes for nice clickable headers                */
thead.fixedHeader a, thead.fixedHeader a:link, thead.fixedHeader a:visited {
	color: #FFF;
	display: block;
	text-decoration: none;
	width: 100%
}

/* make the A elements pretty. makes for nice clickable headers                */
/* WARNING: swapping the background on hover may cause problems in WinIE 6.x   */
thead.fixedHeader a:hover {
	color: #FFF;
	display: block;
	text-decoration: underline;
	width: 100%
}

/* define the table content to be scrollable                                              */
/* set TBODY element to have block level attributes. All other non-IE browsers            */
/* this enables overflow to work on TBODY element. All other non-IE, non-Mozilla browsers */
/* induced side effect is that child TDs no longer accept width: auto                     */
/* Filter out Opera 5.x/6.x and MacIE 5.x                                                 */
head:first-child+body tbody[class].scrollContent {
	display: block;
	height: 234px;
	overflow: auto;
	width: 100%
}

/* make TD elements pretty. Provide alternating classes for striping the table */
/* http://www.alistapart.com/articles/zebratables/                             */
tbody.scrollContent td, tbody.scrollContent tr.normalRow td {
}

tbody.scrollContent tr.alternateRow td {

}

/* define width of TH elements: 1st, 2nd, and 3rd respectively.      */
/* All other non-IE browsers. Filter out Opera 5.x/6.x and MacIE 5.x */
/* Add 16px to last TH for scrollbar padding                         */
/* http://www.w3.org/TR/REC-CSS2/selector.html#adjacent-selectors    */
head:first-child+body thead[class].fixedHeader th {
	width: 20%;
	padding-left: 20px;
}

head:first-child+body thead[class].fixedHeader th + th {
	width: 40%
}

head:first-child+body thead[class].fixedHeader th + th + th {
	border-right: none;
	padding: 4px 4px 4px 3px;
	width: 316px
}

/* define width of TH elements: 1st, 2nd, and 3rd respectively.      */
/* All other non-IE browsers. Filter out Opera 5.x/6.x and MacIE 5.x */
/* Add 16px to last TH for scrollbar padding                         */
/* http://www.w3.org/TR/REC-CSS2/selector.html#adjacent-selectors    */
head:first-child+body tbody[class].scrollContent td {
	width: 20%;
	padding-left: 25px;
}

head:first-child+body tbody[class].scrollContent td + td {
	width: 41%
}

head:first-child+body tbody[class].scrollContent td + td + td {
	border-right: none;
	padding: 2px 4px 2px 3px;
	width: 300px
}

-->
</style>
<br>
<?php echo $this->Html->link('<i class="icon-inbox"></i> Back To Inbox', array('controller'=>'Conversations','action'=>'inbox'), array('class' => 'btn', 'id' => 'back_inbox','escape' => false)); ?>  
<div class="page_title">
  <h1>Compose Message</h1>
</div>
<div class="clear"><br><br></div>
<?php  echo $this->Session->flash(); ?>


<div id='compose' class='left two_thirds'>
<?php 
if(isset($tenant_email) && isset($manager))
      $tenant_email[$manager['Manager']['username']] = $manager['Manager']['first_name'].' ' .$manager['Manager']['last_name'] . ' (Manager)';

		echo $this->Form->create('Message', array('url' => array('controller' => 'Conversations', 'action' => 'send')));
		
		if(isset($recipients)){
		  $prevRecipents = array();
		  foreach($recipients as $recipient){
		    array_push($prevRecipents, $recipient['User']['username']);
		  }
  		echo $this->Form->input('to', array('value' => $prevRecipents, 'label' => 'To:','type'=>'select','multiple'=>true, 'data-placeholder'=>'Enter one or more users','options'=>$tenant_email, 'class'=>'chzn-select', 'id'=>'select_box_email', 'format'=>array('before', 'error', 'label', 'between', 'input', 'after')));
		} else {
  		echo $this->Form->input('to', array('value' => (isset($toPrefill) ? $toPrefill['User']['username'] : ''), 'label' => 'To:','type'=>'select','multiple'=>true, 'data-placeholder'=>'Enter one or more users','options'=>$tenant_email, 'class'=>'chzn-select', 'id'=>'select_box_email', 'format'=>array('before', 'error', 'label', 'between', 'input', 'after')));
    }
  		echo $this->Form->input('title', array('value' => (isset($convTitle) ? 'RE: '.str_replace('_',' ',$convTitle) : ''),'label' => 'Subject:','class'=>'subject','format'=>array('before', 'error', 'label', 'between', 'input', 'after')));
		
		echo $this->Form->input('content', array('type' => 'textarea', 'label' => '','format'=>array('before', 'error', 'label', 'between', 'input', 'after'),'placeholder'=>'Enter message...'));
		echo $this->Form->button("<i class='icon-share-alt icon-white'></i> Send", array('class' => 'btn btn-success send_message','escape' => false ));
		echo $this->Form->end(); ?>

	<div style='clear: both'></div>
</div>

<div class='table right one_third end tableContainer' id="tableContainer">
	<table class="table-striped format scrollTable alignCenter" id="address_table" width="100%">
	<thead class="fixedHeader" id="fixedHeader">
		<tr><th class="first" width="30%">
                       <?php echo $this->Html->link('Unit', array('controller'=>'Conversations','action'=>'send','sortbyunit'), array('class' => '', 'id' => 'sortbyunit','escape' => false)); ?>  
                    </th>
                    <th class="last" width="70%">
                       <?php echo $this->Html->link('Resident Name', array('controller'=>'Conversations','action'=>'send','sortbyname'), array('class' => '', 'id' => 'sortbyname','escape' => false)); ?>  
                    </th>
                </tr>
        </thead>
	<tbody class="scrollContent">
	  <tr class="selectall"><td>ALL</td><td>Select All Users</td></tr>
          <?php echo $this->Html->tableCells($userList, array('class' => 'odd'), array('class' => 'even')); ?>
	</tbody>
	</table>
</div>
<div style='clear: both'></div>
<script>
  jQuery(function(){
    jQuery(".chzn-select").chosen();
  });
  jQuery('#address_table tbody tr').not('selectall').click(function(e){
   e.preventDefault();
   updateTagChecked(jQuery(this).children('td').children('a').attr('class'));
  });
  jQuery('#address_table tbody tr.selectall').click(function(e){
   e.preventDefault();
   var userType = $(this).attr('id');
   jQuery('#address_table tbody tr').each(function(){
      //alert(JSON.stringify($(this).children('td').children('a').attr('id'), null, 4));
      if($(this).children('td').children('a').attr('id') != "excludeEmail")
      {
         updateTagChecked(jQuery(this).children('td').children('a').attr('class'));
      }
   });
  });
  function updateTagChecked($new_email) {
    var list_tag_selected = []; 
    list_tag_selected.push($new_email); // first pull values from multiselect
    jQuery('#select_box_email option:selected').each(function() {
        list_tag_selected.push(jQuery(this).val());       // then from other checkboxes
    });
    list_tag_selected = list_tag_selected.filter(function(elem, pos) {
    return list_tag_selected.indexOf(elem) == pos;
    });
    //Append this list to hidden field
    jQuery('#select_box_email').val(list_tag_selected);
    jQuery(".chzn-select").trigger("liszt:updated");
  }
</script>
