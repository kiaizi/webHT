<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = true;
	$return_data['warn_msg'] = '';
	$return_data['sql'] = '';
	
	
	define(ACTION,getRequestVar('action','1'));
	//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
	//$update_data = array();
	//$update_data['constant_id'] = getRequestVar('constant_id','');	

//////////////////////////////////////////////////////////
	
	
	
	$update_data = array();
	$return_data['id'] = $update_data['id'] = getRequestVar('id','');	
	$update_data['seo_url'] = formatToSEOURL(getRequestVar('seo_url',''));	
	$update_data['seo_keyword'] = getRequestVar('seo_keyword','');	


	
	
		$update_data['mobile_no'] = getRequestVar('mobile_no','');	
		$update_data['fax'] = getRequestVar('fax','');	

	$update_data['email'] = getRequestVar('email','');	

	$update_data['tel'] = getRequestVar('tel','');	


			$update_data['email2'] = getRequestVar('email2','');	

	$update_data['tel2'] = getRequestVar('tel2','');	

	$update_data['email3'] = getRequestVar('email3','');	

	$update_data['tel3'] = getRequestVar('tel3','');	


	$update_data['email4'] = getRequestVar('email4','');	

	$update_data['tel4'] = getRequestVar('tel4','');	



	
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');

	$update_data_lang['address'] = getRequestVar('address','');




			
	//////////////////////////////////////////////////////////
	if(ACTION == '1'){
		
			/*
			$sql = "select order_holdon_reason_status.* from ".TB_ORDER_HOLDON_REASON_STATUS." as order_holdon_reason_status ";
			$sql .= " where ";
			$sql .= " order_holdon_reason_status.code='$code'  ";
			$sql .= " group by order_holdon_reason_status.id  ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = WARN_CODE_EXIST;
				$return_data['success'] = false;
			}
			*/
		
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			/*
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_ORDER_HOLDON_REASON_STATUS, $update_data); 
			$update_data_lang['order_holdon_reason_status_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_ORDER_HOLDON_REASON_STATUS, $update_data_lang);
			*/
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
			/*
			$sql = "select order_holdon_reason_status.* from ".TB_ORDER_HOLDON_REASON_STATUS." as order_holdon_reason_status ";
			$sql .= " where ";
			$sql .= " order_holdon_reason_status.code='$code'  and order_holdon_reason_status.id <> '".$update_data['id']."' ";
			$sql .= " group by order_holdon_reason_status.id  ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = WARN_CODE_EXIST;
				$return_data['success'] = false;
			}
			*/
		

		//////////////////////////////////////////////////////////
		if($return_data['success']){
		
					
			
			
	
		
			$G_DB_CONNECT->query_update(TB_WEBPAGE, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['webpage_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_WEBPAGE, $update_data_lang, "  webpage_id='".$update_data['id']."'   ");
		
		
			//updateConstant();
			//$G_DB_CONNECT->query_update(TB_ORDER_HOLDON_REASON_STATUS, $update_data, "id='".$update_data['id']."'"); 
			//$update_data_lang['order_holdon_reason_status_id'] = $return_data['id'];
			//$G_DB_CONNECT->query_update_lang_content(TB_ORDER_HOLDON_REASON_STATUS, $update_data_lang, "  order_holdon_reason_status_id='".$update_data['id']."'   ");
		}
		
	}
	


	
	
	
	
	
	//////////////////////////////////////////////////////////
	
		
	
  
  
  
  
  
  		if($return_data['success']){
		
			updateConstant();
			//$G_DB_CONNECT->query_update(TB_ORDER_HOLDON_REASON_STATUS, $update_data, "id='".$update_data['id']."'"); 
			//$update_data_lang['order_holdon_reason_status_id'] = $return_data['id'];
			//$G_DB_CONNECT->query_update_lang_content(TB_ORDER_HOLDON_REASON_STATUS, $update_data_lang, "  order_holdon_reason_status_id='".$update_data['id']."'   ");
		}
		
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
$G_DB_CONNECT->close();




?> 