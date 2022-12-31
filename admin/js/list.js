$(document).ready(function(){ 

$(".btn_view").live("click", handle_view);
		/////////////////////////////////////////////////
		// handle list action dialog
		/////////////////////////////////////////////////
		var dialog_confirm_buttons = {};
    	dialog_confirm_buttons[$('#DIALOG_CONFIRM_BTN_CONFIRM').val()] = function(){ 
			$('#list_action_now').val($('#list_action').val());
			$("input:checkbox[class='checkGroup']").attr("disabled",false);
			$('#special_action_now').val('');
			refresh_this_page();
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

		$('#btn_list_action').click(function(e){	
	   			e.preventDefault();
				var checkedCheckboxes = $("input:checkbox[class='checkGroup']:not('#check_all'):checked").length;
				if(checkedCheckboxes > 0){
					$('#notice_search_result').html('');
					openDialogConfirm($('#DIALOG_CONFIRM_TITLE').val(),'');
				}else{
					openDialog('',$('#DIALOG_CONFIRM_EMPTY_MSG').val());
				}
		});



		/////////////////////////////////////////////////
		// handle search
		/////////////////////////////////////////////////
		updateSearchPanelStatus(true);
		$('#btn_show_search_area').click(function(e){	
	   			e.preventDefault();
				$('#show_search').val('1');
				updateSearchPanelStatus(false);

		});
		$('#btn_hide_search_area').click(function(e){	
	   			e.preventDefault();
				$('#show_search').val('');
				updateSearchPanelStatus(false);
		});
		$('#btn_search').click(function(e){	
	   			e.preventDefault();
				$('#search_data_id').val('');
				handle_normal_search();
		});
		///////////////////////////////////////////
		$('#btn_refresh').click(function(e){
	   			e.preventDefault();
				$('#search_data_id').val('');
				resetPaging();
				refresh_this_page();
		});
		$('#btn_show_all').click(function(e){
	   			e.preventDefault();
				$('#search_data_id').val('');
				resetPaging();
				$('#searching').val('');
				updateSearchPanelStatus(false);
				refresh_this_page();
		});
		/////////////////////////////////////////////////
		// handle paging
		/////////////////////////////////////////////////
		$("a.paging_link").live("click", load_page);
		$('#record_per_page').change(function(e){	
	   			e.preventDefault();
				resetPaging();
				refresh_this_page();
		});
		

		/////////////////////////////////////////////////
		// handle check record for selected action
		/////////////////////////////////////////////////
		$("#check_all").live("click", handle_click_all);
		$("input:checkbox[class='checkGroup']:not('#check_all')").live("click", handle_click_list);
		$(".list_row").live("mouseover", handle_list_row_mouseover);
		$(".list_row").live("mouseout", handle_list_row_mouseout);
		$(".list_row").live("click", handle_list_row_click);
		/////////////////////////////////////////////////
		// handle sorting
		/////////////////////////////////////////////////
		$(".orderby_title").live("click", handle_orderby);




		/////////////////////////////////////////////////
		// handle normal list edit/create action
		/////////////////////////////////////////////////
		$(".btn_edit").live("click", handle_edit);
		$('#btn_add').click(function(e){	
	   			e.preventDefault();
				$('#frm_this_page #action').val('1');
				$('#frm_this_page #id').val('');
				document.frm_this_page.submit();

		});
		//////////////////////////////////////////////



	 $("#frm_this_page #search").keypress(function (e) {  
			
         if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {  
		 	e.preventDefault();		
            handle_normal_search();
			
         } else {  
             
         }  
		 
  	});  
	 	//////////////////////////////////////////////
		
		
			$(".btn_list_sort_order_save").live("click", function hnog(e){
		e.preventDefault();		
	
		var data_id = $(this).attr("data_id");
		var category_id = $(this).attr("category_id");
		var rel = $(this).attr("rel");
		var new_sort_order = $('#'+rel).val();
		if(new_sort_order == '' || new_sort_order == 0){
			new_sort_order = 1;
			$('#'+rel).val('1');
			
		}
		$("#update_sort_order_data_id").val(data_id);
		$("#update_sort_order").val(new_sort_order);
		$("#update_sort_order_category_id").val(category_id);
		
		
		$(this).hide();
		refresh_this_page();
		
		

		
	});		
	$("input.input_list_sort_order").live("focus", function(e){
		//e.preventDefault();		
		

		
			
			$("input:checkbox[class='checkGroup']").parent().parent("tr").removeClass('selected_row');
			$("input:checkbox[class='checkGroup']").removeAttr("checked");
	
	
			//$(this).select();
			
			
		
	
		

		
		
	});		
	$("input.input_list_sort_order").live("mouseup", function(e){
		//e.preventDefault();		
		
	});		
	$("input.input_list_sort_order").live("keyup", function(e){
		//e.preventDefault();	
		var rel = $(this).attr("rel");
		$('#'+rel).show();
		
		$("input.input_list_sort_order").attr("disabled","disabled");
		$(this).removeAttr("disabled");
		
		
		
	});		
		
		
		
		
		
		
		refresh_this_page();

}); 


function handle_normal_search(){
				$('#special_action_now').val('');
				resetPaging();
				$('#searching').val('1');
				$('#search_this_month_invoice').val('');
				$('#search_this_month_report').val('');
				$('#search_this_year_report').val('');
				$('#search_today_order').val('');
				updateSearchPanelStatus(false);
				refresh_this_page();
}



function updateSearchPanelStatus(first_load){
	
		if($('#show_search').val() == '1'){
			if(first_load){
				$('#search_area').show();
			}else{
				$('#search_area').fadeIn('normal');
			}
			$('#btn_show_search_area').hide();
			
		}else{
			if(first_load){
				$('#search_area').hide();
			}else{
				$('#search_area').fadeOut('normal');
			}
			$('#btn_show_search_area').show();
		}
		
		/////////////////////////////
		if($('#searching').val() == '1'){
			$('#notice_search_result').html($('#NOTICE_SEARCH_RESULT').val());
		}else{
			$('#notice_search_result').html('');
		}		
	
}

function resetPaging(){
	$('#page').val('1');
}





/////////////////////////////////////////////////
// handle check record for selected action
/////////////////////////////////////////////////
function handle_list_row_mouseover(e){
	e.preventDefault();	

	if( $(this).find("td:first input").is(":checked")){
		
	}else{
		 $(this).addClass('mouseover_row');
	}
	
}



function handle_list_row_mouseout(e){
	e.preventDefault();	
	$(this).removeClass('mouseover_row');
	
	if( $(this).find("td:first input").is(":checked")){
		
	}else{
		$(this).removeClass('selected_row');
	}
 
}

//http://www.learningjquery.com/2008/12/quick-tip-click-table-row-to-trigger-a-checkbox-click
function handle_list_row_click(e){
	e.preventDefault();	

	

		if( $(this).find("td:first input").is(":checked")){
			$(this).find("td:first input").removeAttr("checked");
		 	$(this).removeClass('selected_row');
		}else{
			$(this).find("td:first input").attr("checked","checked");
			$(this).removeClass('mouseover_row');
		 	$(this).addClass('selected_row');
		}
	
	
	
	handle_click_list(e);
 
}

function handle_click_all(e){
	//e.preventDefault();		
	
	$("input:checkbox[class='checkGroup']").attr("checked",$(this).attr("checked"));
	
	
	if($(this).attr("checked") == "checked"){
		
		$("input:checkbox[class='checkGroup']").parent().parent("tr").addClass('selected_row');
		$("input:checkbox[class='checkGroup']").attr("checked","checked");
	}else{
		$("input:checkbox[class='checkGroup']").parent().parent("tr").removeClass('selected_row');
		$("input:checkbox[class='checkGroup']").removeAttr("checked");
	}
	
	
	
	
	
}
function handle_click_list(e){
	
			//e.preventDefault();		
		
			
				//e.preventDefault();		
			var totalCheckboxes = $("input:checkbox[class='checkGroup']:not('#check_all')").length;
        	var checkedCheckboxes = $("input:checkbox[class='checkGroup']:not('#check_all'):checked").length;

        	if ( totalCheckboxes === checkedCheckboxes ){
            	$("#check_all").attr("checked" , true );
			}else{
           	 	$("#check_all").attr("checked" , false );
        	}
			
			
			
}


/////////////////////////////////////////////////
// handle sorting
/////////////////////////////////////////////////
function handle_orderby(e){
	e.preventDefault();	
	
		
	var orderby = $(this).attr("orderby");
	$("#orderby").attr("value",orderby);
	
	///////////////////////////////////////
	var order = $('#order').val();
	if(order == 'asc'){
		order = 'desc';
	}else{
		order = 'asc';
	}
						
	$("#order").attr("value",order);
	////////////////////////////////////
	refresh_this_page();

}

/////////////////////////////////////////////////
// handle normal edit/create
/////////////////////////////////////////////////
function handle_edit(e){
	e.preventDefault();	
	$('#frm_this_page #action').val('2');
	$('#frm_this_page #id').val($(this).attr("id"));
	document.frm_this_page.submit();

}
function handle_view(e){
	e.preventDefault();	

	$('#frm_view').attr('action',$(this).attr("href"));
	document.frm_view.submit();

}



function load_page(e){
	e.preventDefault();		
	$('#page').val($(this).attr("page"));
	refresh_this_page();
	

}


function refresh_this_page(){
	


		switchToMainContent();
		

	
		this_form = "frm_this_page";
	// When the form is submitted
	//$("#frm_this_page").submit(function(){  
		start_loading();
		// -- Start AJAX Call --	
		var ajax_json_path = $('#frm_this_page #ajax_json_path').val();
		var params= $("#"+this_form).serialize(); 
		
     		
			$.ajax({
       		url:ajax_json_path, 
       		type:'post',         
       		dataType:'json',     
      		data:params,         
       		success: function(json){  	
					finish_loading();	

					if(json.success){
						$('#list_action_now').val('');
						
						
						
						
						$('#special_action_now').val('');
						$('#table_list_content').html(json.table_list_content);
						$('.paging_content').html(json.paging_content);
						//alert(json.sql);
						
		
						if(json.warn_msg  != 'undefined'  && json.warn_msg != ''){
							$('#notice_search_result').html(json.warn_msg);
						}
						
						
						if(typeof json.search_group != 'undefined'){
							$('#search_group').val(json.search_group);
							$('#remove_code').val('');
							$('#search2').val('');
						}

						
						if(typeof json.print_id_list != 'undefined'  && json.print_id_list != ''){

								//window.open('index.php?sid=20&print='+json.print_id_list,'_blank');
								$('#frm_print_order #print').val(json.print_id_list);
								document.frm_print_order.submit();

						}
						
						if(typeof json.this_month_order_num != 'undefined'  && json.this_month_order_num != ''){

								$('#update_this_month_order_num').html(json.this_month_order_num);

						}
						if(typeof json.this_month_free_order_max != 'undefined'  && json.this_month_free_order_max != ''){

								$('#update_this_month_free_order_max').html(json.this_month_free_order_max);

						}
						
						
						
						if(typeof json.total_record != 'undefined'  && json.total_record != ''){

								if(json.total_record > 0){
									$('#btn_add').hide();
								}

						}
						
					
						$("#update_sort_order_data_id").val('');
						$("#update_sort_order").val('');
						$("#update_sort_order_category_id").val('');
				
						
						
						
						
					}else{
						
						finish_loading();	
						
					}
 				}  ,  
			  error: function(json){  
			  		finish_loading();	
			  		//alert('error');
				} 
     		});	
		// -- End AJAX Call --
		return false;
	//});
}










