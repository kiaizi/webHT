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
		
			updateConstant();
			//$G_DB_CONNECT->query_update(TB_ORDER_HOLDON_REASON_STATUS, $update_data, "id='".$update_data['id']."'"); 
			//$update_data_lang['order_holdon_reason_status_id'] = $return_data['id'];
			//$G_DB_CONNECT->query_update_lang_content(TB_ORDER_HOLDON_REASON_STATUS, $update_data_lang, "  order_holdon_reason_status_id='".$update_data['id']."'   ");
			
			$delivery_price1 = getRequestVar('delivery_price1','');
			$sql = " update ".TB_DELIVERY_METHOD." set price='$delivery_price1' where id=1 ";
			$G_DB_CONNECT->query($sql);
		}
		
	}
	


	
	
	
	
	
	//////////////////////////////////////////////////////////
	
		
	
  
  
  
  
  
  
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 