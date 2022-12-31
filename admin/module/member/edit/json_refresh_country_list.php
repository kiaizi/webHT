<?php
if(count($_POST) > 0){
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");

	
	
	
	//$arr_country_group_id= getRequestVar("country_group_id",'');

	


	
	

	$i=0;
	//$country_group_id = $arr_country_group_id[$i];
	
	$country_group_id= getRequestVar("country_group_id",'');
	//$country_group_id = getDataName(TB_COUNTRY_GROUP,'id',''," country_group_id='".$country_group_id."' ");


				
	
	
	
	
	

	////////////////////////////////////////////////////////////////////////////////
	$arr_country_id = '';
	$arr_country_name = '-- Please Select --';
////////////////////////////////////////////////////////////////////////////////
	/*
			if($arr_country_name  != ''){
				$arr_country_id .= ',';
				$arr_country_name .= ',';
			}
	
			$arr_country_name .= 'All';
			$arr_country_id .= '-1';


*/

	
	$sql = "select country.*, country_desc.name as name ";

	$sql .= " from ".TB_COUNTRY." as country , ".TB_COUNTRY_DESC." as country_desc ";
	
	
	$sql .= " where ";
	$sql .= " country.id=country_desc.country_id ";
	$sql .= " and country_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and country.disabled<>'".DISABLED_DELETE."' ";
	
	//$sql .= " and country.country_group_id='".$country_group_id."' ";
	
	$sql .= " and country.country_group_id ='".$country_group_id."' ";
	

	$sql .= " order by country_desc.name asc ";
	
	
	
	
	$rows = $G_DB_CONNECT->query($sql);
	$k=0;
	if($G_DB_CONNECT->affected_rows > 0){
		 while($data = $G_DB_CONNECT->fetch_array($rows)){
			$k++;
			$country_id = $data['id'];
	 		
			//$arr_country_id[$k] =  $country_id;
			//$arr_country_name[$k] = $data['name'].' - '.$total_qty.' in stock';
			
			if($arr_country_name  != ''){
				$arr_country_id .= ',';
				$arr_country_name .= ',';
			}
			

			
			$arr_country_name .= $data['name'];
		
		
			
			$arr_country_id .= $country_id;
			
		 }		
	}
	/////////////////////////////////////////////////////////////////////////////// 
	
	
	
	

	
	////////////////////////////////////////////////////////////////////////////////
	$return_data['success'] = true;
	$return_data['out'] = $out; 
	$return_data['arr_country_id'] = $arr_country_id; 
	$return_data['arr_country_name'] = $arr_country_name; 
  	////////////////////////////////////////////////////////////////////////////////
  

	
  
  
  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
$G_DB_CONNECT->close();

}
	

?> 