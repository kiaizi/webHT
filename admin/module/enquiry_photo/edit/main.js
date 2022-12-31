$(document).ready(function(){ 
  	switchToMainContent();
	
	
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
	$("#btn_reset2").click(function(e){	
	   			e.preventDefault();
				document.frm_reset.submit();

	});
	
	//////////////////////////////////////////////////
	if($('#show_confirm_page').val() == '1'){
		//start_loading();
		$('#show_confirm_page').val('');
		show_confirm_page();
		//finish_loading();
	}
	$("#dynamic_webpage_photo").dynamicForm("#dynamic_webpage_photo_footer", "#btn_add_webpage_photo", ".btn_remove_webpage_photo",'',true);
	








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
					//finish_loading();  		
					if(json.success){
						
						$('#warn_msg').html('');
						//show_confirm_page();
						$('#fixed_action_button_area').hide();
						$('#id').val(json.id);
						$('#show_confirm_page').val('1');
						document.frm_this_page.submit();
						
						
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