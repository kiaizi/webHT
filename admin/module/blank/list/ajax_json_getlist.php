<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = false;

	


  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	


$G_DB_CONNECT->close();




?> 