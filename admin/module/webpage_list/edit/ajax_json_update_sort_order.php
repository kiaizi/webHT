<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = true;
	$return_data['warn_msg'] = '';
	$return_data['sql'] = '';
	
	
	
	

	
$parent_webpage_id = $_REQUEST['parent_webpage_id'];
$id = $_REQUEST['id'];
	
//////////////////////////////////////////////////////////

$return_data['sort_order'] = getNextSortOrder(TB_WEBPAGE," parent_webpage_id='$parent_webpage_id' and disabled <> '".DISABLED_DELETE."'",true,getDataName(TB_WEBPAGE,'parent_webpage_id',$id),$id);

	//////////////////////////////////////////////////////////
	
  
  
  
  
  
  
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 