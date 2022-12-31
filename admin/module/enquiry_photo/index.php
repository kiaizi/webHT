<?php 

	define(ACTION,getRequestVar('action',2)); 
	define('DATA_NAME',SECTION_NAME);

	switch(ACTION){
		 case '2':
		 define(ACTION_NAME,ACTION_EDIT);
		 define(DIR_ACTION,"edit/");
		 break; 
		 case '1':
		 define(ACTION_NAME,ACTION_ADD);
		 define(DIR_ACTION,"edit/");
		 break; 
		 case '0':
		 default:
		 define(DIR_ACTION,"edit/"); 
	}

	
	
	
	define(DIR_THIS_MODULE_ACTION,DIR_THIS_MODULE.DIR_ACTION); 
    include(DIR_THIS_MODULE_ACTION."index.php"); 
	
	
	

?>