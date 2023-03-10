jQuery.fn.DefaultValue = function(text){
    return this.each(function(){
		//Make sure we're dealing with text-based form fields
		if(this.type != 'text' && this.type != 'password' && this.type != 'textarea')
			return;
		
		//Store field reference
		var fld_current=this;
		
		this.previous_default_value = text;
		
		//Set value initially if none are specified
        if(this.value=='') {
			//this.value=text;
			this.value= this.previous_default_value;
		} else {
			//Other value exists - ignore
			//return;
			
		}
		
		//Remove values on focus
		$(this).focus(function() {
			if(this.value==this.previous_default_value || this.value==''){
				this.value='';
			}
		});
		
		//Place values back on blur
		$(this).blur(function() {
			if(this.value==this.previous_default_value || this.value==''){
				this.value=this.previous_default_value;
			}
		});
		
		//Capture parent form submission
		//Remove field values that are still default
		$(this).parents("form").each(function() {
			//Bind parent form submit
			$(this).submit(function() {
				if(fld_current.value==this.previous_default_value) {
					fld_current.value='';
				}
			});
		});
    });
};