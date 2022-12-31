<?php 
if(count($_POST) > 0  ){
	$this_dir_path = "../../../";

	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = true;
	$return_data['warn_msg'] = '';
	$return_data['sql'] = '';
if( $_SESSION['already_login']){
	
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

	$update_data['disabled'] = getRequestVar('disabled','');
	$update_data['start_date'] = getRequestVar('start_date','');
	$update_data['end_date'] = getRequestVar('end_date','');
	$update_data['display_date'] = getRequestVar('display_date','');
	
		$update_data['url_target'] = getRequestVar('url_target','');
	
	
	
	
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');
	$update_data_lang['name2'] = getRequestVar('name2','');
	$update_data_lang['detail'] = getRequestVar('detail','');
	$update_data_lang['detail2'] = getRequestVar('detail2','');
$update_data_lang['map'] = getRequestVar('map','');
		$update_data_lang['url'] = getRequestVar('url','');
	
//////////////////////////////////////////////////////////
	$update_data_lang['seo_desc'] = getRequestVar('seo_desc','');
	$update_data_lang['seo_title'] = getRequestVar('seo_title','');
	
	
	
	
	
	if($update_data['seo_url'] == ''){
		$update_data['seo_url'] = formatToSEOURL(getRequestVar('name_1',''));	
	}
	
	///////////////////////////////////////////////////////////
	$sql = "select language.id from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " for_front_page='1'";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$this_language_id = $data['id'];
					if(getRequestVar('seo_title_'.$this_language_id,'') == ''){
						$_REQUEST['seo_title_'.$this_language_id] = getRequestVar('name_'.$this_language_id,'');	
					}
			}
	}
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
	
		
	
  
  
  
  
  
  updateConstant();
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 