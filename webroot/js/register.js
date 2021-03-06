var propertyCount = 0; 

//Close all Properties on Property Manager Signup step 2
function close_all_open_property(){
  jQuery('.property_inside').hide();
  jQuery('.close_property').html("Edit");
}
//Open all Properties on Property Manager Signup step 2
function open_all_open_property(){
  jQuery('.property_inside').show();
  jQuery('.close_property').html("Close");
}

//Custom validate function for Previous Bank
function validatePrevBank(field, rules, i, options){
  console.log(field.val());
  if(field.val() == 'blank'){
    rules.push('required');
    return options.allrules.validate2fields.alertText;
  }
}
    
//valPrevOwnershipCheck

jQuery(function(){
	
	//Set up form Validation
	jQuery("#UserPropertymanagerForm").validationEngine({
	   'promptPosition' : "topRight:-93", scroll: true,
	   'custom_error_messages' : {
  	     '.pass_equal':{
    	     'equals':{
      	     'message' : '* Passwords do not match'
    	     }
  	     },
  	     '.email_equal':{
    	     'equals':{
      	     'message' : '* Emails do not match'
    	     }
  	     },
  	     '.bank_acc_equal':{
    	     'equals':{
      	     'message' : '* Bank Accounts do not match'
    	     }
  	     },
  	     '.bank_rout_equal':{
    	     'equals':{
      	     'message' : '* Routing Numbers do not match'
    	     }
  	     },
  	     '.rs_number':{
    	     'custom[integer]':{
      	     'message' : '* Please enter a valid number'
    	     }
  	     },
	   }
  }); 
	
	//Resident Validation
	jQuery("#UserResidentForm").validationEngine({
	   'promptPosition' : "topRight:-93", scroll: true,
	   'custom_error_messages' : {
  	     '.pass_equal':{
    	     'equals':{
      	     'message' : '* Passwords do not match'
    	     }
  	     },
  	     '.email_equal':{
    	     'equals':{
      	     'message' : '* Emails do not match'
    	     }
  	     },
  	     '.bank_acc_equal':{
    	     'equals':{
      	     'message' : '* Bank Accounts do not match'
    	     }
  	     },
  	     '.bank_rout_equal':{
    	     'equals':{
      	     'message' : '* Routing Numbers do not match'
    	     }
  	     },
	   }
  }); 
	
  //Property Manager Signup - Define action for Next Button
  jQuery('.btn-success.next').click(function(e) {
    e.preventDefault();
    $this_step = $(this).parents('.step');
    var isValid = true;
    open_all_open_property();
    //If validation passes allow user to slide to next page
    $this_step.find(':input').each(function (i, item) {
      if (jQuery(item).validationEngine('validate')){
        isValid = false;
      }       
    });
    if(jQuery('#UserEmail').length != 0){
      jQuery('#UserEmail').after('<div class="UserEmailExistformError parentFormUserPropertymanagerForm formError email_exists" style="opacity: 0.87; position: absolute; top: 508px; left: 171px; margin-top: -50px;"><div class="formErrorContent">* Validating Email please wait ...<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
      $.ajax({
        url:"/users/checkuniqueemail/"+jQuery('#UserEmail').val(),
        success:function(result){
          if(result == 'exists'){
            isValid = false;
            jQuery('.UserEmailExistformError .formErrorContent').html('* Email address already exists'); 
          } else {
            jQuery('.UserEmailExistformError').hide();
          }
          
      }}).done(function(){
        if(jQuery('.prevBankSel').length != 0){
          jQuery('.prevBankSel').each(function(){
            if(!jQuery(this).parent().prev().is(':checked') && !jQuery(this).parent().prev().siblings('.new_bank_check').is(':checked')){
                jQuery(this).parent().after('<div class="formError prevbankcheckreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* Please check one<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
                  isValid = false;
                  jQuery(this).parent().find('.prevbankreqired').remove();
            } else {
              jQuery(this).parent().parent().find('.prevbankcheckreqired').remove();
              if(jQuery(this).parent().prev().is(':checked') && jQuery(this).val() == 'blank'){
                jQuery(this).parent().parent().find('.prevcompcheckreqired').remove();
                jQuery(this).after('<div class="formError prevbankreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* This field is required<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
                isValid = false;
              } else {
                jQuery(this).parent().find('.prevbankreqired').remove();
              } 
            }
          });
        }
        //Add If Previous Company
        if(jQuery('.prevCompSel').length != 0){
        //console.log(1);
          jQuery('.prevCompSel').each(function(){
            if(!jQuery(this).parent().prev().is(':checked') && !jQuery(this).parent().prev().siblings('.new_ownership_check').is(':checked')){
            //console.log(2);
                jQuery(this).parent().after('<div class="formError prevcompcheckreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* Please check one<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
                  isValid = false;
                  jQuery(this).parent().find('.prevcompreqired').remove();
            } else{
            //console.log(3);
                jQuery(this).parent().parent().find('.prevcompcheckreqired').remove();
                //if prev company is selected require them to select company
                if(jQuery(this).parent().prev().is(':checked') && jQuery(this).val() == 'blank'){
                //console.log(4);
                  jQuery(this).after('<div class="formError prevcompreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* This field is required<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
                  isValid = false;
                } else {
                //console.log(5);
                  jQuery(this).parent().find('.prevcompreqired').remove();
                } 
            }
          });
        }
        if(isValid){
          $this_step.animate({'opacity':'0'},400);
          $this_step.next().animate({'opacity':'1'},100);
          jQuery('#form_wrapper').animate({'margin-left':'-=869'},900,'easeOutQuart');
          jQuery('html,body').animate({scrollTop: jQuery(".step").offset().top }, 400, "swing");
          jQuery('.step_item.current').removeClass('current').next().addClass('current');
        } 
      });
    } 
       
  });
  
  //Property Manager Signup - Define action for Back Button
  jQuery('.btn-inverse.back').click(function(e) {
    e.preventDefault();
    $this_step = $(this).parents('.step');
    $this_step.animate({'opacity':'0'},400);
    $this_step.prev().animate({'opacity':'1'},100);
    jQuery('#form_wrapper').animate({'margin-left':'+=869'},900,'easeOutQuart');
    jQuery('html,body').animate({scrollTop: jQuery(".step").offset().top }, 400, "swing");
    jQuery('.step_item.current').removeClass('current').prev().addClass('current');
  });
  
  //Property Manager Signup - step_1
  jQuery('.step_1').addClass('current');
  
  //Property Manager Signup - Close existing Property
  function close_open_property(property){
    property.parent().next().slideToggle(function(){
      jQuery("#UserPropertymanagerForm").validationEngine("updatePromptsPosition");
    });
    if(property.html() == "Close"){
      property.html("Edit");
    } else {
      property.html("Close");
    }
  }
  jQuery('.close_property').click(function(){
    close_open_property(jQuery(this));
  });
  
  //Property Manager Signup - Property Name Update on typing
  function update_property_name(property){
    if(property.val() != ""){  
      property.closest('.property_inside').siblings('.add_property_header').children('.property_name_left').children('.property_name').html(property.val());
      }
  }
  jQuery('.property_name_input').keyup(function(){
    update_property_name(jQuery(this));
  });
  setTimeout(function() {
    update_property_name(jQuery('.property_name_input'));
  }, 300);
  
  //Property Manager Signup - Property Address Update on typing
  function update_property_address(property){
    if(property.val() != ""){ 
    property.closest('.property_inside').siblings('.add_property_header').children('.property_name_left').children('.property_address').html(property.val());
    }
  }
  jQuery('.property_address_input').keyup(function(){
    update_property_address(jQuery(this));
  });
  
  setTimeout(function() {
    update_property_address(jQuery('.property_address_input'));
  }, 300);
  
  function propertyTypeChange(){
      if ($("#Property0OwnershipType0").attr("checked")) { 
        //Corporation
        jQuery('#Property0StateInc').show().parent().show();
        jQuery('#Property0LegalEin').show().parent().show();
      }
      if ($("#Property0OwnershipType1").attr("checked")) { 
        //LLC
        jQuery('#Property0StateInc').show().parent().show();
        jQuery('#Property0LegalEin').show().parent().show();
      }
      if ($("#Property0OwnershipType2").attr("checked")) { 
        //Partnership
        jQuery('#Property0StateInc').hide().parent().hide();
        jQuery('#Property0LegalEin').show().parent().show();
      }
      if ($("#Property0OwnershipType3").attr("checked")) { 
        //Sole Proprietor
        jQuery('#Property0StateInc').hide().parent().hide();
        jQuery('#Property0LegalEin').hide().parent().hide();
      }
  }
  propertyTypeChange();
  //Property Manager Signup - Ownership Type Radio Button
  jQuery('.ownership_type').change(function(){
      propertyTypeChange();
  });

  //Property Manager Signup - Add Additional Property Button
  var template = jQuery('#add_properties .add_property:first').clone();
  propertyCount = 1;
        
  jQuery('.btn.add_prop').click(function(e) {
    e.preventDefault();

    /* Repeatd code from .btn-success.next */
    //Validate all inputs shown
    var isValid = true;
    $this_step.find(':input').each(function (i, item) {
       if (jQuery(item).validationEngine('validate')){
          isValid = false;
       }
    });

    // Handle previous bank and previous ownership checkbox events and validations
    if(jQuery('.prevBankSel').length != 0){
       jQuery('.prevBankSel').each(function(){
          if(!jQuery(this).parent().prev().is(':checked') && !jQuery(this).parent().prev().siblings('.new_bank_check').is(':checked')){
             jQuery(this).parent().after('<div class="formError prevbankcheckreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* Please check one<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
             isValid = false;
             jQuery(this).parent().find('.prevbankreqired').remove();
          } else {
             jQuery(this).parent().parent().find('.prevbankcheckreqired').remove();
             if(jQuery(this).parent().prev().is(':checked') && jQuery(this).val() == 'blank'){
               jQuery(this).parent().parent().find('.prevcompcheckreqired').remove();
               jQuery(this).after('<div class="formError prevbankreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* This field is required<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
               isValid = false;
             } else {
                jQuery(this).parent().find('.prevbankreqired').remove();
             } 
          }
       });
    }
    //Add If Previous Company
    if(jQuery('.prevCompSel').length != 0){
       //console.log(1);
       jQuery('.prevCompSel').each(function(){
          if(!jQuery(this).parent().prev().is(':checked') && !jQuery(this).parent().prev().siblings('.new_ownership_check').is(':checked')){
             //console.log(2);
             jQuery(this).parent().after('<div class="formError prevcompcheckreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* Please check one<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
                isValid = false;
                jQuery(this).parent().find('.prevcompreqired').remove();
          } else{
          //console.log(3);
             jQuery(this).parent().parent().find('.prevcompcheckreqired').remove();
             //if prev company is selected require them to select company
             if(jQuery(this).parent().prev().is(':checked') && jQuery(this).val() == 'blank'){
                //console.log(4);
                jQuery(this).after('<div class="formError prevcompreqired" style="opacity: 0.87; position: absolute; top: 8px; left: 71px; margin-top: -50px;"><div class="formErrorContent">* This field is required<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
                isValid = false;
             } else {
                //console.log(5);
                jQuery(this).parent().find('.prevcompreqired').remove();
             } 
          }
       });
    }
    /* END Repeatd code from .btn-success.next */

    // Only add new property section if validation passes
    if(isValid){

    close_all_open_property();
    var property = template.clone().find(':input').each(function(){
      jQuery(this).attr('name',jQuery(this).attr('name').replace(/\[0\]/g,'['+ propertyCount + ']'));
      jQuery(this).attr('id',jQuery(this).attr('id').replace(/Property0/g,'Property'+ propertyCount));
      $theclass = jQuery(this).attr('class');
      if(typeof($theclass) !== 'undefined' && $theclass !== false)  jQuery(this).attr('class',$theclass.replace(/Property0/g,'Property'+ propertyCount));
      jQuery(this).next('label').attr('for',jQuery(this).attr('id').replace(/Property0/g,'Property'+ propertyCount));
      jQuery(this).prev('label').attr('for',jQuery(this).attr('id').replace(/Property0/g,'Property'+ propertyCount));
      jQuery(this).val('');
    }).end() // back to .property
    .attr('id', 'property_' + propertyCount) // update property id
    .appendTo('#add_properties'); // add to container
    jQuery('#add_properties .add_property:last').children('.property_inside').children('.remove_prop').show();
    //Previous Ownership Company Select Box
    $prev_ownership = '<select name="data[Property]['+ propertyCount + '][prev_ownership]" id="Property'+ propertyCount + 'PrevOwnership" style="width:150px;" class="validate[condRequired[Property0PreviousOwnership]] prevCompSel"><option value="blank">Select Company</option>';
    for(i=0; i<propertyCount; i++){
        $val = jQuery('#Property'+i+'LegalName').val();
        if($val != "" && $val != null){
          $prev_ownership = $prev_ownership + '<option value="'+i+'">'+$val+'</option>';
        }
    }
    $prev_ownership = $prev_ownership + '</select>';
    //Add Previous Ownership Select Box to DOM
    jQuery('#property_' + propertyCount + ' .prev_ownership').show().children('.ownership_select').html($prev_ownership).parent().next('.new_ownership').hide();
    //Set on change for new ownership select box
    jQuery('#Property' + propertyCount + 'NewOwnership').change(function(){
      if(jQuery(this).is(':checked')){
        //if user just checked new ownership
        jQuery(this).parent().siblings('.new_ownership').slideToggle();
        jQuery(this).prev().children().val('blank').parent().prev().prop('checked', false).val('');
        jQuery(this).val('add_new_ownership');
      } else {
        //if user just unchecked new ownership
        jQuery(this).parent().siblings('.new_ownership').slideUp();
        jQuery(this).parent().siblings('.new_ownership').children('.legal_name_div').children().first().children('.comp_legal_name').val('');
        jQuery(this).val('');
      }
    });
    //Set On Change for Leagal Phone and Fax
    jQuery('#Property' + propertyCount + 'LegalPhone,#Property' + propertyCount + 'LegalFax').on('change',function(e){
  		jQuery(this).val(jQuery(this).val().replace(/\D/g,''));
  		return true;
  	});    
    //If Previous Ownership is changed
    jQuery('#Property' + propertyCount + 'PreviousOwnership').change(function(){
        if(jQuery(this).is(':checked')){
          jQuery(this).val('use_previous_ownership');
          //if existing ownership is checked and New Ownership is Checked
          if(jQuery(this).siblings('.new_ownership_check').is(':checked'))
              jQuery(this).siblings('.new_ownership_check').click();
        } else {
          jQuery(this).val('');
        }
    });
    //Previous Bank Account
    $prev_bank = '<select name="data[Property]['+ propertyCount + '][prev_bank]" id="Property'+ propertyCount + 'PrevBank" style="width:150px;" class="prevBankSel"><option value="blank">Select Bank</option>';
    for(i=0; i<propertyCount; i++){
        $val = jQuery('#Property'+i+'BankName').val();
        if($val != "" && $val != null){
          $prev_bank = $prev_bank + '<option value="'+i+'">'+$val+ ' - ' + jQuery('#Property'+i+'BankAcccountNum').val()+'</option>';
        }
    }
    $prev_bank = $prev_bank + '</select>';
    jQuery('#property_' + propertyCount + ' .prev_bank').show().children('.bank_select').html($prev_bank).parent().next('.new_bank').hide();
    //if New Bank Account Button Changes
    jQuery('#Property' + propertyCount + 'NewBank').change(function(){
      if(jQuery(this).is(':checked')){
        //if user just clicked Add New Bank Account
        jQuery(this).parent().siblings('.new_bank').slideToggle();
        jQuery(this).prev().children().val('blank').parent().prev().prop('checked', false).val('');
        jQuery(this).val('add_new_bank')
      } else {
        //if user just unclicked Add New Bank Account
        jQuery(this).parent().siblings('.new_bank').slideUp();
        jQuery(this).parent().siblings('.new_bank').children('.bank_name_div').children().first().children().first().children('.the_bank_name').val('');
        jQuery(this).val('');
      }
    });
    //if User Prev Bank Account Changes
    jQuery('#Property' + propertyCount + 'PreviousBank').change(function(){
        if(jQuery(this).is(':checked')){
          jQuery(this).val('use_prev_bank');
          //if existing bank is checked and New Bank is Checked
          if(jQuery(this).siblings('.new_bank_check').is(':checked'))
              jQuery(this).siblings('.new_bank_check').click();
        } else {
          jQuery(this).val('');
        }
    });
      
    propertyCount++;
    
    jQuery('.close_property').unbind('click').click(function(){
      close_open_property(jQuery(this));
    });
    jQuery('.property_name_input').unbind('keyup').keyup(function(){
      update_property_name(jQuery(this));
    });
    jQuery('.property_address_input').keyup(function(){
      update_property_address(jQuery(this));
    });
    jQuery('.pm_tooltip').tooltip('destroy').tooltip();
    
    //Property Manager Signup - Remove Property Link
    jQuery('.remove_prop').click(function(e){
      e.preventDefault();
      //Remove bank option from any other properties
      
      //Get value of this bank
      $remove_value = $remove_value = jQuery(this).parent().parent().attr('id').replace('property_','');
      jQuery('.bank_select').each(function(){
         if(jQuery(this).find('select').val() == $remove_value){
           //Remove and set to blank
           jQuery(this).find('select option[value="'+$remove_value+'"]').remove();
           jQuery(this).find('select').val('blank');
         } else {
           //Remove from dropdown
           jQuery(this).find('select option[value="4"]').remove();
         }
      });
      //Remove html
      jQuery(this).parent().parent('.add_property').remove();
    });

    }

  });
  
  //Property Manager Signup - Add tooltips 
  jQuery('.pm_tooltip').tooltip();
  
  //Property Manager Signup - Summary Page
  jQuery('.start_summary').click(function(){
    $prop_sum = "";
    $unit_total = 0;
    $month_total = 0;
    for(i=0; i<propertyCount; i++){
        $prop_name = jQuery('#Property'+i+'Name').val();
        $num_units = jQuery('#Property'+i+'NumUnits').val();
        if(jQuery('#Property'+i+'PreviousBank').is(':checked')){
            $prev_val = jQuery('#Property'+i+'PrevBank').val();
            $bank_acct = jQuery('#Property'+$prev_val+'BankAcccountNum').val();
            $bank_name = jQuery('#Property'+$prev_val+'BankName').val();
        } else {
            $bank_acct = jQuery('#Property'+i+'BankAcccountNum').val();
            $bank_name = jQuery('#Property'+i+'BankName').val();
        }
        if($prop_name != "" && $prop_name != null && $num_units !="" && $num_units!=0 && $num_units!=null){
          $month_fee = get_monthly_fee($num_units);
          $month_total = $month_total + $month_fee;
          $unit_total = $unit_total + parseInt($num_units);
          $prop_sum = $prop_sum + '<li class="prop_'+i+'"><div class="prop_sum"><h1 class="prop_title">'+$prop_name+ '</h1><!-- .prop_title -->'+
              '<span class="prop_address">'+jQuery('#Property'+i+'Address').val()+'</span>'+
              '<span class="bank_nm">'+$bank_name+'</span><span class="acc_num">Acct# '+$bank_acct+'</span>'+
            '</div><!-- .prop_sum -->'+
            '<div class="num_units">';
            if(isNaN($num_units)){
              $prop_sum = $prop_sum + 'Err';
            }else{
              $prop_sum = $prop_sum + $num_units;
            }
            	
            $prop_sum = $prop_sum + '</div><!-- .num_units -->'+
            '<div class="setup_fee">'+
            	'$'+ ($month_fee * 1)+
            '</div><!-- .setup_fee -->'+
            '<div class="month_fee">'+
            	'$'+$month_fee+
            '</div><!-- .month_fee -->'+
            '<div class="clear"></div>'+
          '</li>';
        }
    }
    jQuery('#sum_total_units').html($unit_total);
    jQuery('#sum_one_time_fee').html('$'+($month_total*1));
    jQuery('#sum_month_fee,#sum_monthly_fee').html('$'+$month_total);
    //var now = new Date();
    //current = new Date(now.getFullYear(), now.getMonth()+1, 1);
    
    jQuery('ul.property_review li').remove();
    jQuery('ul.property_review').append($prop_sum);
  });
  
  //Resident Signup - Property Search 
	jQuery('#search_property').keypress(function(e) {
      if(e.which == 13) {
          e.preventDefault();
          jQuery('.search_prop').click();
      }
  });
  jQuery('#UserSsn').on('change',function(e){
  		jQuery(this).val(jQuery(this).val().replace(/\D/g,''));
  		return true;
  	});    

  // fade out good flash messages after 3 seconds
  $('.flash_good').animate({opacity: 1.0}, 6000).slideUp();

  
});
