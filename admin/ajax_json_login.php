<?php 

	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
 $return_data['success'] = false;
	$return_data['warn_msg'] = '';
  


	$username = $_POST['login_username'];
	$password = $_POST['login_password'];
	
	
	if(login($username ,$password)){
		$return_data['success'] = true;
	}else{
		$return_data['warn_msg'] = WARN_LOGIN_FAILURE;
	}
  
  
  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	


$G_DB_CONNECT->close();




?> 