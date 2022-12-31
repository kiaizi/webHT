<?php 
			
		foreach($HTTP_POST_VARS as $key => $value){
  
    		//$_POST[$key] = $value;
			$this_request_var_name = $key;
			$this_request_var_value = $_POST[$key];
			
			
			
				if(strstr($this_request_var_name, "search") != ''  || $this_request_var_name == 'orderby' || $this_request_var_name == 'order'  || $this_request_var_name == 'page'  || $this_request_var_name == 'show_search'   || $this_request_var_name == 'searching'    ){
?>			

<?php
	if(strstr($this_request_var_name, "search_group") != ''){
?>
<input name="<?php echo $this_request_var_name?>" id="<?php echo $this_request_var_name?>" value="<?php echo convert2StringGroup(getRequestVar($this_request_var_name,'')) ; ?>"  type="hidden"/>
<?php
	}else{
?>
<input name="<?php echo $this_request_var_name?>" id="<?php echo $this_request_var_name?>" value="<?php echo $this_request_var_value ; ?>"  type="hidden"/>
<?php
	}
?>



<?php
				}
				
			}
			
?>