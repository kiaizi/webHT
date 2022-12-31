<?php 

	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
 $return_data['success'] = false;
	$return_data['warn_msg'] = '';
  


	
	$old_password = $_POST['old_password'];
	$password = $_POST['password'];
	
	
	if(changePassword($old_password,$password)){
		$return_data['success'] = true;
	}else{
		$return_data['warn_msg'] = WARN_CHANGE_PASSWORD_FAILURE;
	}
  
  
  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	


$G_DB_CONNECT->close();




?> 