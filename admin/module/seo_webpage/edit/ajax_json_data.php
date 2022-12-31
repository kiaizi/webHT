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
	$update_data = array();
	$return_data['id'] = $update_data['id'] = getRequestVar('id','');	
	//$update_data['name'] = getRequestVar('name','');
	//$code = $update_data['code'] = getRequestVar('code','');
	$update_data['sort_order'] = getRequestVar('sort_order','0');
	//$update_data['parent_webpage_id'] = getRequestVar('parent_webpage_id','0');
	//$update_data['code'] = strtoupper(getRequestVar('code',''));
	//$update_data['webpage_position_id'] = getRequestVar('webpage_position_id','0');

	$update_data['remark'] = getRequestVar('remark','');
	$update_data['disabled'] = getRequestVar('disabled','');
	//$update_data['have_contact_form'] = getRequestVar('have_contact_form','');
	
	$update_data['seo_url'] = getRequestVar('seo_url','');	
	$update_data['seo_keyword'] = getRequestVar('seo_keyword','');	
	
	$update_data['parent_webpage_id'] = getRequestVar('parent_webpage_id','');	
	
$update_data['have_seo'] =1;	
	
	$update_data['original_url'] = getRequestVar('original_url','');	
	
	


	
	
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');
	$update_data_lang['detail'] = getRequestVar('detail','');
	
//////////////////////////////////////////////////////////
	$update_data_lang['seo_desc'] = getRequestVar('seo_desc','');
	$update_data_lang['seo_title'] = getRequestVar('seo_title','');
	if($update_data['seo_url'] == ''){
		$update_data['seo_url'] = formatToSEOURL(getRequestVar('name_2',''));	
	}
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
		if($update_data['parent_webpage_id'] == 0){
			$sql = "select webpage_desc.* from ".TB_WEBPAGE_DESC." as webpage_desc ,".TB_WEBPAGE." as webpage ";
			$sql .= " where ";
			$sql .= " LOWER(webpage_desc.name)=LOWER('".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."')  ";
			$sql .= " and webpage_desc.webpage_id<>'".$return_data['id']."'  and webpage.parent_webpage_id = '0' ";
			
			$sql .= " and webpage.id=webpage_desc.webpage_id ";
			$sql .= " and webpage.disabled<>'".DISABLED_DELETE."' ";
			
			
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] =  WARN_PARENT_CATEGORY_EXIST;
				$return_data['success'] = false;
			}
		}
		*/
			
		
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_WEBPAGE, $update_data); 
			$update_data_lang['webpage_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_WEBPAGE, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
		if($update_data['parent_webpage_id'] == 0){
			$sql = "select webpage_desc.* from ".TB_WEBPAGE_DESC." as webpage_desc ,".TB_WEBPAGE." as webpage ";
			$sql .= " where ";
			$sql .= " LOWER(webpage_desc.name)=LOWER('".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."')  ";
			$sql .= " and webpage_desc.webpage_id<>'".$return_data['id']."'   and webpage.parent_webpage_id = '0' ";
			
			$sql .= " and webpage.id=webpage_desc.webpage_id ";
			$sql .= " and webpage.disabled<>'".DISABLED_DELETE."' ";
			
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = WARN_PARENT_CATEGORY_EXIST;
				$return_data['success'] = false;
			}
		}
			*/
		

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_WEBPAGE, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['webpage_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_WEBPAGE, $update_data_lang, "  webpage_id='".$update_data['id']."'   ");
		}
		
	}
	
//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_WEBPAGE,$update_data['id'],true,'');
		
		
	}
	
	
	if($return_data['success']){
		//////////////////////////////////////////////////////////
		
		
	
		if($update_data['parent_webpage_id'] == 0){
			//renewSortOrder(TB_WEBPAGE," parent_webpage_id='".$update_data['parent_webpage_id']."' ");
		}else{
		//	renewSortOrder(TB_WEBPAGE," parent_webpage_id='".$update_data['parent_webpage_id']."'");
		}
		//renewSortOrder(TB_WEBPAGE," parent_webpage_id='".$update_data['parent_webpage_id']."' and webpage_position_id= '".$update_data['webpage_position_id']."'");
		
		
		

		//////////////////////////////////////////////////////////
		//updateCategoryNavLink($update_data['id'],TB_WEBPAGE,"webpage_id");
		//updateCategoryChildrenNavLink($update_data['id']);
		//////////////////////////////////////////////////////////
		
		
		
		
	}
	
	//$return_data['sql'] = $sql;
	
	//////////////////////////////////////////////////////////
	
		
	
  
  
  
  
  
  
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 