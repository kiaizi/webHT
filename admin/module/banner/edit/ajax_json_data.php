<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = true;
	$return_data['warn_msg'] = '';
	$return_data['sql'] = '';
	
	
	define(ACTION,getRequestVar('action','1'));
	//////////////////////////////////////////////////////////
	$update_data = array();
	$return_data['id'] = $update_data['id'] = getRequestVar('id','');	
	$update_data['sort_order'] = getRequestVar('sort_order','');
	$update_data['code'] = strtoupper(getRequestVar('code',''));
	$update_data['url_target'] = getRequestVar('url_target','');

	$update_data['remark'] = getRequestVar('remark','');
	$update_data['disabled'] = getRequestVar('disabled','');

	$update_data['seo_url'] = formatToSEOURL(getRequestVar('seo_url',''));	
	$update_data['seo_keyword'] = getRequestVar('seo_keyword','');	

	$update_data['color1'] = getRequestVar('color1','');	

//$update_data['code2'] = strtoupper(getRequestVar('code2',''));
	//$update_data['show_button'] = getRequestVar('show_button','');
	
	$update_data['last_update_by'] = '';
	$update_data['create_by'] = '';
	$update_data['last_update_by'] = '';
	//////////////////////////////////////////////////////////
	$update_data_lang = array();
	
	$update_data_lang['name2'] = getRequestVar('name2','');	


	
	$update_data_lang['name'] = getRequestVar('name','');	
	$update_data_lang['detail'] = getRequestVar('detail','');

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
			$sql = "select banner.* from ".TB_BANNER." as banner, ".TB_BANNER_DESC." as banner_desc ";
			$sql .= " where ";
			$sql .= " banner_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and banner_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and banner_desc.banner_id=banner.id ";
			$sql .= " and banner.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " banner.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_BANNER, $update_data); 
			$update_data_lang['banner_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_BANNER, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select banner.* from ".TB_BANNER." as banner, ".TB_BANNER_DESC." as banner_desc ";
			$sql .= " where ";
			$sql .= " banner_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and banner_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and banner_desc.banner_id=banner.id ";
			$sql .= " and banner.id<>'".$update_data['id']."'  ";
			$sql .= " and banner.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_BANNER, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['banner_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_BANNER, $update_data_lang, "  banner_id='".$update_data['id']."'   ");
		}
		
	}
	


	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_BANNER,$update_data['id'],true,'');
		
	}
	


	
	
	
	
	
	//////////////////////////////////////////////////////////
	
	
		
	
  
  
  
  
  
  
  	renewSortOrder(TB_BANNER," id>0 ");

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 