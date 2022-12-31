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

$update_data['email_to'] = getRequestVar('email_to','');
$update_data['email_to_name'] = getRequestVar('email_to_name','');
	
	$update_data['last_update_by'] = '';
	$update_data['create_by'] = '';
	$update_data['last_update_by'] = '';
	//////////////////////////////////////////////////////////
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');	
	$update_data_lang['name2'] = getRequestVar('name2','');
	$update_data_lang['detail'] = getRequestVar('detail','');
	$update_data_lang['url'] = getRequestVar('url','');
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
			$sql = "select email_template.* from ".TB_EMAIL_TEMPLATE." as email_template, ".TB_EMAIL_TEMPLATE_DESC." as email_template_desc ";
			$sql .= " where ";
			$sql .= " email_template_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and email_template_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and email_template_desc.email_template_id=email_template.id ";
			$sql .= " and email_template.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " email_template.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_EMAIL_TEMPLATE, $update_data); 
			$update_data_lang['email_template_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_EMAIL_TEMPLATE, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select email_template.* from ".TB_EMAIL_TEMPLATE." as email_template, ".TB_EMAIL_TEMPLATE_DESC." as email_template_desc ";
			$sql .= " where ";
			$sql .= " email_template_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and email_template_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and email_template_desc.email_template_id=email_template.id ";
			$sql .= " and email_template.id<>'".$update_data['id']."'  ";
			$sql .= " and email_template.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_EMAIL_TEMPLATE, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['email_template_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_EMAIL_TEMPLATE, $update_data_lang, "  email_template_id='".$update_data['id']."'   ");
		}
		
	}
	


	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_EMAIL_TEMPLATE,$update_data['id'],true,'');
		
	}
	


	
	
	
	
	
	//////////////////////////////////////////////////////////
	
	
		
	
  
  
  
  
  
  
  	renewSortOrder(TB_EMAIL_TEMPLATE," id>0 ");

  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 