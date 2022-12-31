$(document).ready(function(){ 
						   
						   
	$("#dialog").dialog("destroy");
	
		$("#dialog-modal").dialog({
			autoOpen: false,
			width: 450,
			resizable: false,
			modal: true,
			buttons: {
				'Confirm': function() {
					$(this).dialog('close');
				}
			}

			
		
		});
		$("#dialog-confirm").dialog({
			autoOpen: false,
			width: 450,
			resizable: false,
			modal: true

		
		});
		
		$("#dialog_confirm_scan_order").dialog({
			autoOpen: false,

			width: 450,

			resizable: false,
			modal: true

		
		});			   
						   
						   
						   
						   
						   
						   
       // $(document).pngFix(); 
		
		/*
		$.datepick.setDefaults($.datepick.regional['zh-TW']);
	
		$('.input_date').datepick({ 
    		autoSize: true, showTrigger: '#calImg'}
		);
		*/
		//minDate: '1900-01-01', maxDate: '+2y', 
		
		//$('.numeric').numeric();
		//$('.floatnumber').numeric();

		
		$(".numeric").live("click", handle_numeric);
		$(".floatnumber").live("click", handle_numeric);

	
		$('#btn_reset').click(function(e){	
	   			e.preventDefault();
				//document.frm_this_page.reset();
				$("form").each(function() {
      	 			this.reset();
    			});

		});
		
		
		
		$('#btn_confirm').click(function(e){	
	   			e.preventDefault();
				validForm();
		});
		
		

		
		
		
		$('#btn_print_uncomplete_order_list').click(function(e){	
	   			e.preventDefault();
				document.frm_print_uncomplete_order_list.submit();
		});
		
		
		

		
		 $(".class_handle_checkbox_group").each(function(i) { 	
			var checkbox_group_all_id = $(this).attr('id');								 
         	var class_checkbox_group = $(this).attr('class_checkbox_group');
			// handle_checkbox_all(class_checkbox_group,this); 
			$(this).click(function(e){	
				 handle_checkbox_all(class_checkbox_group,this); 
				
			});
			
			 $("."+class_checkbox_group).each(function(j) { 
				
				$(this).click(function(e){	
					handle_checkbox_list(class_checkbox_group,checkbox_group_all_id);
				});
			 });
			 handle_checkbox_list(class_checkbox_group,checkbox_group_all_id);
			 					
    	 });	
		
		
		
		/*
	$(".input_date").datepicker({
			showOn: 'button',
			buttonImage: 'images/calendar.jpg',
			buttonImageOnly: true,
			alignment: 'topRight',
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true


			
			
	});
	*/
	$('.btn_edit_seo').hide();	
		$('.btn_edit_seo').click(function(e){	
			$('.table_seo').show();
			$('.btn_edit_seo').hide();
				
	});
		
		
		$( ".input_date" ).datepicker({
          
            changeMonth: true,
            numberOfMonths: 1,
			dateFormat:"yy-mm-dd"
        });
	
	
	
		$( "#display_date" ).datepicker({
          
            changeMonth: true,
            numberOfMonths: 1,
			dateFormat:"yy-mm-dd"
        });
	
		
		$( "#start_date" ).datepicker({
          
            changeMonth: true,
            numberOfMonths: 1,
			dateFormat:"yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#end_date" ).datepicker({
           
            changeMonth: true,
            numberOfMonths: 1,
			dateFormat:"yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
            }
        });

		
		
}); 

function switchTo(object_id){

	$(window)._scrollable();
	$.scrollTo( $(object_id), {speed:500} );

}

function switchToMainContent(){

	//switchTo('#inside_content');
	

}


function openDialog(title,msg){
	
	//j('#dialog-modal').attr("title",title);
	$('#dialog-modal').dialog( "option", "title", title );
	$('#dialog-modal_msg').html(msg);
	$('#dialog-modal').dialog('open');
}


function openDialogConfirm(title,msg){
	
	//j('#dialog-modal').attr("title",title);
	$('#dialog-confirm').dialog( "option", "title", title );
	$('#dialog-confirm_msg').html(msg);
	$('#dialog-confirm').dialog('open');
}



function validEmail(str) {
 var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[a-z]{2,6})+$/i;
 return reg.test(str);
}


function start_loading(){
	$('#loading').fadeIn('normal');
	$('#main_content_area').hide();
}

function finish_loading(){
	$('#loading').hide();
	$('#main_content_area').fadeIn('normal');
	
}

function show_confirm_page(){
	$('#main_content_area').hide();
	$('#confirm_msg').fadeIn('normal');
	$('#fixed_action_button_area').hide();
}


function redirect() {
    setTimeout("go_to_index()",0);
}

function go_to_index() {
    window.location.href = "index.php";
}


function handle_checkbox_all(class_group_name,this_checkbox_all){
	//e.preventDefault();		
	

	$("input:checkbox[class='"+class_group_name+"']").attr("checked",$(this_checkbox_all).attr("checked"));
	
	

	
	
}
function handle_checkbox_list(class_group_name,checkbox_group_all_id){
	
			//e.preventDefault();		
			var totalCheckboxes = $("input:checkbox[class='"+class_group_name+"']").length;
        	var checkedCheckboxes = $("input:checkbox[class='"+class_group_name+"']:checked").length;
			//alert(totalCheckboxes + " : "+ checkedCheckboxes + " : "+ class_group_name+" : "+checkbox_group_all_id);

        	if ( totalCheckboxes === checkedCheckboxes ){
            	$('#'+checkbox_group_all_id).attr("checked" , true );
			}else{
           	 	$('#'+checkbox_group_all_id).attr("checked" , false );
        	}
			
}


/////////////////////////////////////////////////
// handle sorting
/////////////////////////////////////////////////
function handle_numeric(e){
	//e.preventDefault();		
	$(this).numeric();


}

function openLyteframe(url){
	$('#global_lyteframe').attr("href",url);
	$('#global_lyteframe').click();
}