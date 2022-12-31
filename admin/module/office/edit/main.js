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
	if($('#show_confirm_page').val() == '1'){
		//start_loading();
		$('#show_confirm_page').val('');
		show_confirm_page();
		//finish_loading();
	}

	
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

	//$('.btn_edit_seo').show();
	$("#dynamic_office_photo").dynamicForm("#dynamic_office_photo_footer", "#btn_add_office_photo", ".btn_remove_office_photo",'',true);
	//$("#dynamic_office_photo").dynamicForm("#dynamic_office_photo_footer", "#btn_add_office_photo", ".btn_remove_office_photo",'',true);
	//$("#dynamic_office_color_size_qty").dynamicForm("#dynamic_office_color_size_qty_footer", "#btn_add_office_color_size_qty", ".btn_remove_office_color_size_qty",'',true);
	//$("#dynamic_office_to_relate_office").dynamicForm("#dynamic_office_to_relate_office_footer", "#btn_add_office_to_relate_office", ".btn_remove_office_to_relate_office",'',true);
}); 





function validForm() {
	var err_msg = '';
	
	$(".my_fckeditor").each(function(i) { 	
        oEditor = FCKeditorAPI.GetInstance($(this).attr('id')) ;
		$(this).val(oEditor.GetXHTML( true ));
     });	
	
    $(":input[required=yes], :input[required=true], :input[required=required]").each(function(i) { 	
          if ((this.type == 'radio') || (this.type == 'checkbox')) {  
          } else {	
				if($(this).val() == '' ){
					err_msg += $(this).attr('label')+"<br>";
					

				}else{
					
				}
          }	
     });	
	
	/*
	if( $("input:checkbox[class='office_collection_id_group']:checked").length == 0    ){
			err_msg += $('.office_collection_id_group').attr('label')+"<br>";
	}
	*/
	/*
	if( $("input:checkbox[class='office_category_id_group']:checked").length == 0    ){
			err_msg += $('.office_category_id_group').attr('label')+"<br>";
	}
	
	*/
	
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
					if(json.success){
						$('#warn_msg').html('');
						//show_confirm_page();
						$('#fixed_action_button_area').hide();
						$('#id').val(json.id);
						$('#show_confirm_page').val('1');
						document.frm_this_page.submit();
						
					}else{
						finish_loading();
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