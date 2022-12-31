$(document).ready(function(){ 
  	switchToMainContent();
	
	/////////////////////////////////////////////////
	// handle delete
	/////////////////////////////////////////////////
	var dialog_confirm_buttons = {};
    dialog_confirm_buttons[$('#DIALOG_CONFIRM_BTN_CONFIRM').val()] = function(){ 
		deleteRecord("frm_this_page"); 
		$(this).dialog('close');
	}

    dialog_confirm_buttons[$('#DIALOG_CONFIRM_BTN_CANCEL').val()] = function(){ 
		$(this).dialog('close');
	 }
	$("#dialog-confirm").dialog({
						autoOpen: false,
						resizable: false,
						width: 450,
						modal: true,
						buttons: dialog_confirm_buttons
	});
		
	$('.btn_delete').click(function(e){	
	   			e.preventDefault();
				openDialogConfirm($('#DIALOG_CONFIRM_TITLE').val(),'');
				
	});
	//////////////////////////////////////////////////
	$(".btn_edit").click(function(e){	
	   			e.preventDefault();
				$('#frm_this_page #action').val('2');
				document.frm_this_page.submit();

	});
	$('.btn_back_to_list').click(function(e){	
	   			e.preventDefault();
				$('#frm_this_page #action').val('');
				$('#frm_this_page #id').val('');
				document.frm_this_page.submit();

	});
	
	
	
	
	$("#btn_create").click(function(e){	
	   			e.preventDefault();
				$('#frm_this_page #action').val('1');
				$('#frm_this_page #id').val('');
				document.frm_this_page.submit();

	});
	

	/*
	$("#country_group_id").change(function(e){	
		
			refresh_country_list();


    });	
	*/

}); 



function refresh_country_list(){
		
		
		var current_country_id = $('#country').val();
		$('#country option').remove();
		$('#country').append('<option value="" >Refreshing ...</option>');
		
		
	
		var ajax_json_path = $('#frm_this_page #ajax_json_path2').val();
		var params=$('#frm_this_page').serialize(); 

     		$.ajax({
       		url:ajax_json_path, 
       		type:'post',         
       		dataType:'json',    
      		data:params,        
       		success: function(json){  
					success = json.success;
					
					
					
					
					
					if(success){
						
						
						
						
			
						$('#country option').remove();
						
						var country_id_list=json.arr_country_id;
						var country_name_list=json.arr_country_name;
						
						
						
						var arr_country_id = country_id_list.split(",");
						var arr_country_name = country_name_list.split(",");
						
						
						
					
						
						for (i=0;i<arr_country_id.length;i++){
							
							
							
							var selected = '';
							if(current_country_id == arr_country_id[i]){
								selected = 'selected';
							}
						
							$('#country').append('<option value="'+arr_country_id[i]+'"  '+selected+' >'+arr_country_name[i]+'</option>');
							if(i==0){
								$('#country span').html(arr_country_name[i]);
							}

						}
						
						
						
						
						
						
						
	
					}else{
						
						
					}
				
					
					
   
 				}  ,  
			  error: function(json){  
			  		
				} 
     		});	
	
	
	return false;
	
	
}





function validForm() {
	var err_msg = '';
    $(":input[required=yes], :input[required=true]").each(function(i) { 	
          if ((this.type == 'radio') || (this.type == 'checkbox')) {  
          } else {	
				if($(this).val() == '' ){
					err_msg += $(this).attr('label')+"<br>";
					

				}else{
					
				}
          }	
     });	
	if($('#email').val() != '' &&  !validEmail($('#email').val()) ){
		err_msg += $('#email').attr('warn_msg')+"<br>";
	}
	if($('#password').val() != '' && $('#password').val().length < 6){
		err_msg += $('#password').attr('warn_msg')+"<br>";
	}


	///////////////////////////////////////////////////// 
	
	if ( err_msg != "" ){
	  	 openDialog($('#DIALOG_TITLE').val(),err_msg);
	     return;
	}else{	
		 submitForm("frm_this_page");     
	}
	/////////////////////////////////////////////////////	  
}	




function submitForm(this_form){
	// When the form is submitted
	//$("#frm_this_page").submit(function(){  
		start_loading();
		// -- Start AJAX Call --	
		var ajax_json_path = $('#frm_this_page #ajax_json_path').val();
		var params= $("#"+this_form).serialize(); 
		//alert( params);
     		
			$.ajax({
       		url:ajax_json_path, 
       		type:'post',         
       		dataType:'json',     
      		data:params,         
       		success: function(json){
					finish_loading();  		
					if(json.success){
						$('#warn_msg').html('');
						show_confirm_page();
						$('#fixed_action_button_area').hide();
						$('#id').val(json.id);
						
					}else{
						$('#warn_msg').html(json.warn_msg);
						
					}
 				}  ,  
			  error: function(json){  
			  		//alert('error');
				} 
     		});	
		// -- End AJAX Call --
		return false;
	//});
}





function deleteRecord(this_form){
	// When the form is submitted
	//$("#frm_this_page").submit(function(){  
		$('#frm_this_page #action').val('3');
		start_loading();
		// -- Start AJAX Call --	
		var ajax_json_path = $('#frm_this_page #ajax_json_path').val();
		var params= $("#"+this_form).serialize(); 
		//alert( params);
     		
			$.ajax({
       		url:ajax_json_path, 
       		type:'post',         
       		dataType:'json',     
      		data:params,         
       		success: function(json){
					finish_loading();  		
					if(json.success){
						$('#confirm_msg_content').hide();
						$('#confirm_msg_content_delete').show();
						$('.hide_if_delete').hide();
						show_confirm_page();
						$('#fixed_action_button_area').hide();
						$('#id').val(json.id);
						
					}else{
						$('#warn_msg').html(json.warn_msg);
						
					}
 				}  ,  
			  error: function(json){  
			  		alert('error');
					
				} 
     		});	
		// -- End AJAX Call --
		return false;
	//});
}

