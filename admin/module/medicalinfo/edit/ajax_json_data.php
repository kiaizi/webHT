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


$update_data['medicalinfo_category_id'] = getRequestVar('medicalinfo_category_id','');
	
	$update_data['last_update_by'] = '';
	$update_data['create_by'] = '';
	$update_data['last_update_by'] = '';
	//////////////////////////////////////////////////////////
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');	
	$update_data_lang['name2'] = getRequestVar('name2','');	
	$update_data_lang['name3'] = getRequestVar('name3','');	
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
			$sql = "select medicalinfo.* from ".TB_MEDICALINFO." as medicalinfo, ".TB_MEDICALINFO_DESC." as medicalinfo_desc ";
			$sql .= " where ";
			$sql .= " medicalinfo_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and medicalinfo_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and medicalinfo_desc.medicalinfo_id=medicalinfo.id ";
			$sql .= " and medicalinfo.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " medicalinfo.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_MEDICALINFO, $update_data); 
			$update_data_lang['medicalinfo_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_MEDICALINFO, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select medicalinfo.* from ".TB_MEDICALINFO." as medicalinfo, ".TB_MEDICALINFO_DESC." as medicalinfo_desc ";
			$sql .= " where ";
			$sql .= " medicalinfo_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and medicalinfo_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and medicalinfo_desc.medicalinfo_id=medicalinfo.id ";
			$sql .= " and medicalinfo.id<>'".$update_data['id']."'  ";
			$sql .= " and medicalinfo.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_MEDICALINFO, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['medicalinfo_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_MEDICALINFO, $update_data_lang, "  medicalinfo_id='".$update_data['id']."'   ");
		}
		
	}
	




	if($update_data['seo_url'] == ''){
		$G_DB_CONNECT->query("update ".TB_MEDICALINFO." set seo_url='".$return_data['id']."'  where id='".$return_data['id']."' ");
	}



	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_MEDICALINFO,$update_data['id'],true,'');
		
	}else{
		if($return_data['success']){
				
	$medicalinfo_id=$return_data['id'];
			
			$G_DB_CONNECT->query("delete from ".TB_MEDICALINFO_TO_SERVICE." where medicalinfo_id = '".$medicalinfo_id."'"); 
			$arr_medicalinfo_to_service_id = getRequestVar('medicalinfo_to_service_id','');
			$arr_medicalinfo_to_service_sort_order = getRequestVar('medicalinfo_to_service_sort_order','');
			$arr_medicalinfo_to_service_disabled = getRequestVar('medicalinfo_to_service_disabled','');
			
			if(count($arr_medicalinfo_to_service_id) > 0 && is_array($arr_medicalinfo_to_service_id)  && $arr_medicalinfo_to_service_id[0] != ''){
				for($i=0;$i<count($arr_medicalinfo_to_service_id);$i++){
					$update_data_medicalinfo_to_service = array();
					$update_data_medicalinfo_to_service['medicalinfo_id'] = $medicalinfo_id;
					$update_data_medicalinfo_to_service['service_id'] = $arr_medicalinfo_to_service_id[$i];
					$update_data_medicalinfo_to_service['sort_order'] = $arr_medicalinfo_to_service_sort_order[$i];
					$update_data_medicalinfo_to_service['disabled'] = $arr_medicalinfo_to_service_disabled[$i];
					$G_DB_CONNECT->query_insert(TB_MEDICALINFO_TO_SERVICE, $update_data_medicalinfo_to_service);
				}
			}

			
		}
		
		
	}
	


	
	
	
	
	
	
	
	//////////////////////////////////////////////////////////
	
	
		
	
  
  
  
  
  
  
  	//renewSortOrder(TB_MEDICALINFO," id>0 ");

  
  
  
  
  
  	renewSortOrder(TB_MEDICALINFO," id>0 and medicalinfo_category_id='".$update_data['medicalinfo_category_id']."' ");

  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 