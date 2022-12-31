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
	$update_data = array();
	$return_data['id'] = $update_data['id'] = getRequestVar('id','');	
	$update_data['sort_order'] = getRequestVar('sort_order','');
	$update_data['code'] = getRequestVar('code','');
	$update_data['url_target'] = getRequestVar('url_target','');

	$update_data['remark'] = getRequestVar('remark','');
	$update_data['disabled'] = getRequestVar('disabled','');

	$update_data['seo_url'] = formatToSEOURL(getRequestVar('seo_url',''));	
	$update_data['seo_keyword'] = getRequestVar('seo_keyword','');	

	$update_data['start_date'] = getRequestVar('start_date','');
	$update_data['end_date'] = getRequestVar('end_date','');
	$update_data['display_date'] = getRequestVar('display_date','');

	$update_data['highlight'] = getRequestVar('highlight','');



	
	$update_data['last_update_by'] = '';
	$update_data['create_by'] = '';
	$update_data['last_update_by'] = '';
	//////////////////////////////////////////////////////////
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');	
	$update_data_lang['detail'] = getRequestVar('detail','');
		$update_data_lang['detail2'] = getRequestVar('detail2','');
	$update_data_lang['url'] = getRequestVar('url','');
$update_data_lang['detail2'] = getRequestVar('detail2','');
//////////////////////////////////////////////////////////
	$update_data_lang['seo_title'] = getRequestVar('seo_title','');
	$update_data_lang['seo_desc'] = getRequestVar('seo_desc','');
	/*
	if($update_data['seo_url'] == ''){
		//$update_data['seo_url'] = formatToSEOURL(getRequestVar('name_1',''));	
		$update_data['seo_url'] = formatToSEOURL(getRequestVar('name_1',''));	
	}*/
	
		$update_data_lang['seo_h1'] = getRequestVar('seo_h1','');
		
		
	///////////////////////////////////////////////////////////
	$sql = "select language.id from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " for_front_page='1'";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$this_language_id = $data['id'];
					if(getRequestVar('seo_h1_'.$this_language_id,'') == ''){
						$_REQUEST['seo_h1_'.$this_language_id] = getRequestVar('seo_title_'.$this_language_id,'');	
					}
			}
	}
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////


	//////////////////////////////////////////////////////////
	if(ACTION == '1'){
		/*
			$sql = "select trading_future_category.* from ".TB_TRADING_FUTURE_CATEGORY." as trading_future_category, ".TB_TRADING_FUTURE_CATEGORY_DESC." as trading_future_category_desc ";
			$sql .= " where ";
			$sql .= " trading_future_category_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and trading_future_category_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and trading_future_category_desc.trading_future_category_id=trading_future_category.id ";
			$sql .= " and trading_future_category.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " trading_future_category.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_TRADING_FUTURE_CATEGORY, $update_data); 
			$update_data_lang['trading_future_category_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_TRADING_FUTURE_CATEGORY, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select trading_future_category.* from ".TB_TRADING_FUTURE_CATEGORY." as trading_future_category, ".TB_TRADING_FUTURE_CATEGORY_DESC." as trading_future_category_desc ";
			$sql .= " where ";
			$sql .= " trading_future_category_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and trading_future_category_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and trading_future_category_desc.trading_future_category_id=trading_future_category.id ";
			$sql .= " and trading_future_category.id<>'".$update_data['id']."'  ";
			$sql .= " and trading_future_category.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_TRADING_FUTURE_CATEGORY, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['trading_future_category_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_TRADING_FUTURE_CATEGORY, $update_data_lang, "  trading_future_category_id='".$update_data['id']."'   ");
		}
		
	}
	




	if($update_data['seo_url'] == ''){
		$G_DB_CONNECT->query("update ".TB_TRADING_FUTURE_CATEGORY." set seo_url='".$return_data['id']."'  where id='".$return_data['id']."' ");
	}



	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_TRADING_FUTURE_CATEGORY,$update_data['id'],true,'');
		
	}
	


	
	
	
	
	
	//////////////////////////////////////////////////////////
	
	
		
	
  
  
  
  
  
  
  	renewSortOrder(TB_TRADING_FUTURE_CATEGORY," id>0 ");

  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 