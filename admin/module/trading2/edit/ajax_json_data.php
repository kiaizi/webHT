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

	$update_data['code2'] = getRequestVar('code2','');
	$update_data['decimal_position'] = getRequestVar('decimal_position','');
$update_data['currency'] = getRequestVar('currency','');



	
	$update_data['last_update_by'] = '';
	$update_data['create_by'] = '';
	$update_data['last_update_by'] = '';
	//////////////////////////////////////////////////////////
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');	
	$update_data_lang['detail'] = getRequestVar('detail','');
		$update_data_lang['detail1'] = getRequestVar('detail1','');
	
	
		$update_data_lang['detail2'] = getRequestVar('detail2','');
		$update_data_lang['detail3'] = getRequestVar('detail3','');
		$update_data_lang['detail4'] = getRequestVar('detail4','');
		$update_data_lang['detail5'] = getRequestVar('detail5','');
		$update_data_lang['detail6'] = getRequestVar('detail6','');
		$update_data_lang['detail7'] = getRequestVar('detail7','');
		$update_data_lang['detail8'] = getRequestVar('detail8','');
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
			$sql = "select trading2.* from ".TB_TRADING2." as trading2, ".TB_TRADING2_DESC." as trading2_desc ";
			$sql .= " where ";
			$sql .= " trading2_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and trading2_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and trading2_desc.trading2_id=trading2.id ";
			$sql .= " and trading2.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " trading2.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_TRADING2, $update_data); 
			$update_data_lang['trading2_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_TRADING2, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select trading2.* from ".TB_TRADING2." as trading2, ".TB_TRADING2_DESC." as trading2_desc ";
			$sql .= " where ";
			$sql .= " trading2_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and trading2_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and trading2_desc.trading2_id=trading2.id ";
			$sql .= " and trading2.id<>'".$update_data['id']."'  ";
			$sql .= " and trading2.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_TRADING2, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['trading2_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_TRADING2, $update_data_lang, "  trading2_id='".$update_data['id']."'   ");
		}
		
	}
	




	if($update_data['seo_url'] == ''){
		$G_DB_CONNECT->query("update ".TB_TRADING2." set seo_url='".$return_data['id']."'  where id='".$return_data['id']."' ");
	}



	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_TRADING2,$update_data['id'],true,'');
		
	}
	


	
	
	
	
	
	//////////////////////////////////////////////////////////
	
	
		
	
  
  
  
  
  
  
  	renewSortOrder(TB_TRADING2," id>0 ");

  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 