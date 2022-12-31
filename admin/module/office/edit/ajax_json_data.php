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


	$update_data['remark'] = getRequestVar('remark','');
	$update_data['disabled'] = getRequestVar('disabled','');

	$update_data['seo_url'] = formatToSEOURL(getRequestVar('seo_url',''));	
	$update_data['seo_keyword'] = getRequestVar('seo_keyword','');	

$update_data['tel'] = getRequestVar('tel','');
$update_data['office_category_id'] = getRequestVar('office_category_id','');
$update_data['fax'] = getRequestVar('fax','');
$update_data['email'] = getRequestVar('email','');

$update_data['google_x'] = getRequestVar('google_x','');
$update_data['google_y'] = getRequestVar('google_y','');
$update_data['baidu_x'] = getRequestVar('baidu_x','');
$update_data['baidu_y'] = getRequestVar('baidu_y','');
$update_data['google_map'] = getRequestVar('google_map','');






	$update_data['last_update_by'] = '';
	$update_data['create_by'] = '';
	$update_data['last_update_by'] = '';
	//////////////////////////////////////////////////////////
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');	

	$update_data_lang['detail'] = getRequestVar('detail','');
$update_data_lang['open_hr'] = getRequestVar('open_hr','');
$update_data_lang['open_hr2'] = getRequestVar('open_hr2','');
$update_data_lang['open_hr3'] = getRequestVar('open_hr3','');
$update_data_lang['address'] = getRequestVar('address','');

$update_data_lang['contact_ppl'] = getRequestVar('contact_ppl','');

$update_data_lang['detail2'] = getRequestVar('detail2','');


//////////////////////////////////////////////////////////
	$update_data_lang['seo_title'] = getRequestVar('seo_title','');
	$update_data_lang['seo_desc'] = getRequestVar('seo_desc','');
	if($update_data['seo_url'] == ''){
		//$update_data['seo_url'] = formatToSEOURL(getRequestVar('name_2',''));	
		$update_data['seo_url'] = formatToSEOURL(getRequestVar('name_2',''));	
	}
	//////////////////////////////////////////////////////////


	//////////////////////////////////////////////////////////
	if(ACTION == '1'){
		/*
			$sql = "select office.* from ".TB_OFFICE." as office, ".TB_OFFICE_DESC." as office_desc ";
			$sql .= " where ";
			$sql .= " office_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and office_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and office_desc.office_id=office.id ";
			$sql .= " and office.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " office.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_OFFICE, $update_data); 
			$update_data_lang['office_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_OFFICE, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select office.* from ".TB_OFFICE." as office, ".TB_OFFICE_DESC." as office_desc ";
			$sql .= " where ";
			$sql .= " office_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and office_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and office_desc.office_id=office.id ";
			$sql .= " and office.id<>'".$update_data['id']."'  ";
			$sql .= " and office.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_OFFICE, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['office_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_OFFICE, $update_data_lang, "  office_id='".$update_data['id']."'   ");
		}
		
	}
	


	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_OFFICE,$update_data['id'],true,'');
		
	}
	


	
	
	
	
	
	
	

  
  	renewSortOrder(TB_OFFICE," id>0  and office_category_id='".$update_data['office_category_id']."' ");

  	//renewSortOrder(TB_OFFICE," id>0 ");

  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 