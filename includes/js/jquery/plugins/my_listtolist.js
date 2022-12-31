(function($){
	jQuery.fn.listtolist = function (in_unselected_list_id,in_selected_list_id,in_btn_to_right_id,in_btn_to_left_id,in_btn_all_to_right_id,in_btn_all_to_left_id){
				//var source = jQuery(this),
				
				var unselected_list_id = in_unselected_list_id,
				selected_list_id = in_selected_list_id,
				btn_to_right_id = in_btn_to_right_id,
				btn_to_left_id = in_btn_to_left_id,
				btn_all_to_right_id = in_btn_all_to_right_id,
				btn_all_to_left_id = in_btn_all_to_left_id;
				

				
			
				
	$("#"+btn_to_right_id).click(function(e){	
	   		e.preventDefault();
			$("."+unselected_list_id+" option:selected").each(function() {    
                $("<option></option>")    
                .val($(this).val())    
                .text($(this).text())    
                .appendTo($("."+selected_list_id+":not(:has(option[value="+$(this).val()+"]))"));    
			});
			$("."+unselected_list_id+" option:selected").remove();
			
				

	});
	$("#"+btn_to_left_id).click(function(e){	
	   		e.preventDefault();
			$("."+selected_list_id+" option:selected").each(function() {    
                $("<option></option>")    
                .val($(this).val())    
                .text($(this).text())    
                .appendTo($("."+unselected_list_id+":not(:has(option[value="+$(this).val()+"]))"));    
			});
			$("."+selected_list_id+" option:selected").remove();
				

	});
	$("#"+btn_all_to_right_id).click(function(e){	
	   		e.preventDefault();
			$("."+unselected_list_id+"  option").each(function() {    
                $("<option></option>")    
                .val($(this).val())    
                .text($(this).text())    
                .appendTo($("."+selected_list_id+":not(:has(option[value="+$(this).val()+"]))"));    
            });  
			$("."+unselected_list_id+"  option").remove();  
				

	});
	$("#"+btn_all_to_left_id).click(function(e){	
	   		e.preventDefault();
			$("."+selected_list_id+"  option").each(function() {    
                $("<option></option>")    
                .val($(this).val())    
                .text($(this).text())    
                .appendTo($("."+unselected_list_id+":not(:has(option[value="+$(this).val()+"]))"));    
            });  
			$("."+selected_list_id+"  option").remove();  
				

	});

			
			
		  
	}
})(jQuery);