/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function(factory){if(typeof define==='function'&&define.amd){define(['jquery'],factory);}else if(typeof exports==='object'){factory(require('jquery'));}else{factory(jQuery);}}(function($){var pluses=/\+/g;function encode(s){return config.raw?s:encodeURIComponent(s);}
function decode(s){return config.raw?s:decodeURIComponent(s);}
function stringifyCookieValue(value){return encode(config.json?JSON.stringify(value):String(value));}
function parseCookieValue(s){if(s.indexOf('"')===0){s=s.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,'\\');}
try{s=decodeURIComponent(s.replace(pluses,' '));return config.json?JSON.parse(s):s;}catch(e){}}
function read(s,converter){var value=config.raw?s:parseCookieValue(s);return $.isFunction(converter)?converter(value):value;}
var config=$.cookie=function(key,value,options){if(value!==undefined&&!$.isFunction(value)){options=$.extend({},config.defaults,options);if(typeof options.expires==='number'){var days=options.expires,t=options.expires=new Date();t.setTime(+t+days*864e+5);}
return(document.cookie=[encode(key),'=',stringifyCookieValue(value),options.expires?'; expires='+options.expires.toUTCString():'',options.path?'; path='+options.path:'',options.domain?'; domain='+options.domain:'',options.secure?'; secure':''].join(''));}
var result=key?undefined:{};var cookies=document.cookie?document.cookie.split('; '):[];for(var i=0,l=cookies.length;i<l;i++){var parts=cookies[i].split('=');var name=decode(parts.shift());var cookie=parts.join('=');if(key&&key===name){result=read(cookie,value);break;}
if(!key&&(cookie=read(cookie))!==undefined){result[name]=cookie;}}
return result;};config.defaults={};$.removeCookie=function(key,options){if($.cookie(key)===undefined){return false;}
$.cookie(key,'',$.extend({},options,{expires:-1}));return!$.cookie(key);};}));

$(function(){

  //Set up form Validation
	jQuery("form").validationEngine({
	   'promptPosition' : "topRight:-93", scroll: false,
	   'custom_error_messages' : {
  	     '.pass_equal':{
    	     'equals':{
      	     'message' : '* Passwords do not match'
    	     }
  	     },
	   }
  }); 

	$('#inbox tr, #outbox tr, #maintenance-overview tr').not('.no_click').click(function(e){
		window.location = $(this).find('.msg-link').attr('href');
	});

	$('#msg-list .widget h4').click(function(){
			$(this).parent().toggleClass('collapsed', 100);
	});

	var open = false;

	$('#current-property').click(function(e){
		if(open)
			$(document).unbind('click', propDrop);
		e.stopPropagation();
		$('#properties-list ul').slideToggle(150);
		open = !open;

		if(open)
			$(document).bind('click', propDrop);
			
		
	});

	function propDrop(){
		$('#properties-list ul').slideToggle(150);
		$(this).unbind('click', propDrop);
		open = false;
	}
	
	// fadeout flash messages on click
	$('.cancel').click(function(){
		$(this).parent().fadeOut();
	return false;
	});

	// fade out good flash messages after 3 seconds
	$('.flash_good').animate({opacity: 1.0}, 3000).slideUp();
	
	jQuery('#my_account_links li a').click(function(e){
		e.preventDefault();
		jQuery(this).parent().siblings().removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('.my_account_content').hide();
		jQuery('.'+jQuery(this).attr('id')+'_content').fadeIn();
	});
	
	autoLateFee = jQuery('#PropertyAutoLateFee');
	if(parseInt(autoLateFee.length)){
  	autoLateFee.change(function(){
    	autoLateFeeCheck();
  	});
  	
  	autoLateFeeCheck();
  	
  }
  function autoLateFeeCheck() {
    	if(autoLateFee.is(':checked')){
      	jQuery('#PropertyAutoLateFeeAmt').prop('disabled', false);
      	jQuery('#PropertyDayRentLate').prop('disabled', false);
      	jQuery('.disable-text').css({'color':'#444444'});
    	} else {
      	jQuery('#PropertyAutoLateFeeAmt').prop('disabled', true);
      	jQuery('#PropertyDayRentLate').prop('disabled', true);
      	jQuery('.disable-text').css({'color':'#bdbdbd'});
    	}
  }
	
	
});
	
