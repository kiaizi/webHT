(function($){
	jQuery.fn.dynamicForm = function (in_source_footer_id,in_btn_add,in_btn_remove,call_function,multi_file){
				var source = jQuery(this),
				footer = jQuery(in_source_footer_id),
				btn_add = jQuery(in_btn_add),
				btn_remove_class_name = in_btn_remove,
				btn_remove = jQuery(in_btn_remove),
				this_class = this.attr("id"),
				source_id = this.attr("id"),
				formFields = "input, checkbox, select, textarea",
				remove_clone_id_attr_name = 'remove_clone_id';
				total_clone = parseInt(jQuery("."+source_id).size()),
				fieldId = parseInt(jQuery("."+source_id).size())+1,
				call_a_function = call_function;
				
			//alert(source_id +":"+ parseInt(jQuery("."+source_id).size())+":"+fieldId);
				
				source.hide();
				//btn_add.click(clickOnAdd);
				btn_add.live("click", clickOnAdd2);
				//btn_remove.click(clickOnRemove);
				btn_remove.live("click", clickOnRemove);
				
	
			////////////////////////////////////////////////////////
			jQuery('#'+source_id).attr("total_clone",total_clone);
			jQuery('#'+source_id).attr("fieldId",fieldId);
			////////////////////////////////////////////////////////
			
			
			
			
			////////////////////////////////////////////////////////
			// normalize already exist data 
			////////////////////////////////////////////////////////
			
			jQuery("."+source_id).each(function(k){ 
				
				
				elmnt = jQuery(this);
				elmnt.find(formFields).each(function(){ 
					/*
						 var nameAttr = jQuery(this).attr("name")
						 , idAttr = jQuery(this).attr("id");
						

						jQuery(this).attr("name", nameAttr +"[]");
						jQuery(this).attr("id", idAttr +"[]");
						//jQuery(this).attr("value", idAttr + fieldId);
						
					*/
					
				 });
				
				elmnt.find(btn_remove_class_name).each(function(i){ 
						jQuery(this).attr(remove_clone_id_attr_name, this_class + (parseInt(k)+1));
						
						//alert(jQuery(this).attr(remove_clone_id_attr_name));		
				});	
				
				
			});
			if(multi_file == false){
				if(parseInt(jQuery('#'+source_id).attr("total_clone")) == 0){
					btn_add.click();
				}
			}
			////////////////////////////////////////////////////////
			function clickOnAdd2(event){
				//event.stopImmediatePropagation();

				event.preventDefault();
				total_clone = parseInt(jQuery('#'+source_id).attr("total_clone") );
				total_clone++;
				//alert(total_clone);
				cloneObject = source.clone(true);
				
				
				cloneObject.insertBefore(footer);
                cloneObject.attr("style", "display: ''");
                cloneObject.addClass(this_class);       
              	cloneObject.attr("id",source_id+jQuery('#'+source_id).attr("fieldId"));   

				//alert(source_id+fieldId);
				cloneObject.find("input[type='text']:first").focus();
				normalizeElmnt(cloneObject);
				//alert(source_id +":"+ total_clone+":"+fieldId);
				
				jQuery('#'+source_id).attr("total_clone",total_clone);
				return false;
				
				
			}
			
				
				
				
				
				
			function clickOnAdd(event){
				event.preventDefault();
				
				total_clone = parseInt(jQuery('#'+source_id).attr("total_clone") );
				total_clone++;
				
				cloneObject = source.clone(true);
				
				
				cloneObject.insertBefore(footer);
                cloneObject.attr("style", "display: ''");
                cloneObject.addClass(this_class);       
              	cloneObject.attr("id",source_id+jQuery('#'+source_id).attr("fieldId"));   
				cloneObject.find("input[type='text']:first").focus();
				normalizeElmnt(cloneObject);
				jQuery('#'+source_id).attr("total_clone",total_clone);
	
				
			}
			
			
			
			function clickOnRemove(event){
				event.preventDefault();
				total_clone = parseInt(jQuery('#'+source_id).attr("total_clone") );
				total_clone--;
				remove_clone_object_id = '#'+jQuery(this).attr(remove_clone_id_attr_name);
				//alert(remove_clone_object_id);
				jQuery(remove_clone_object_id).remove();
				if(call_a_function != ''){
					eval(call_a_function);
					//new Function(call_a_function);
				}
				jQuery('#'+source_id).attr("total_clone",total_clone);
				
				
				
			}
		  
		  
		  
		  	function normalizeElmnt(elmnt){
				elmnt.find(formFields).each(function(){ 
						 var nameAttr = jQuery(this).attr("name")
						 , idAttr = jQuery(this).attr("id");
						

						jQuery(this).attr("name", nameAttr +"[]");
						jQuery(this).attr("id", idAttr +"[]");
						//jQuery(this).attr("value", idAttr + fieldId);
						if(jQuery(this).hasClass('sort_order')){
							jQuery(this).attr("value", jQuery('#'+source_id).attr("fieldId"));
						}

					
				 });
				elmnt.find(btn_remove_class_name).each(function(){ 
						jQuery(this).attr(remove_clone_id_attr_name, this_class + jQuery('#'+source_id).attr("fieldId"));
						//alert(jQuery(this).attr(remove_clone_id_attr_name));		
				 });
				fieldId = parseInt(jQuery('#'+source_id).attr("fieldId") );
				fieldId++;
				jQuery('#'+source_id).attr("fieldId",fieldId);
				
			};
			
			
			
			/*
			var strFun = "someFunction";
var strParam = "this is the parameter";

//Create the function call from function name and parameter.
var funcCall = strFun + "('" + strParam + "');";

//Call the function
var ret = eval(funcCall);
*/

			
			
		  
	}
})(jQuery);