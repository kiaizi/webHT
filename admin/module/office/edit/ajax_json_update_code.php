<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = true;
	$return_data['warn_msg'] = '';
	$return_data['sql'] = '';
	
	
	
	

	
$office_brand_id = $_REQUEST['office_brand_id'];
$id = $_REQUEST['id'];
	
//////////////////////////////////////////////////////////
$office_brand_code = getDataName(TB_OFFICE_BRAND,'code',$office_brand_id);
$office_brand_code = "HC";
$return_data['code'] = generateProductCode($office_brand_code);
//nextRecordcode2(TB_OFFICE,"",$office_brand_code,4);


	//////////////////////////////////////////////////////////
	
  
  
  
  
  
  
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 