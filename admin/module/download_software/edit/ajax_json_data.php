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
	$update_data['other_link'] = getRequestVar('other_link','');

	$update_data['youtube_id'] = getRequestVar('youtube_id','');

	$update_data['download_software_category_id'] = getRequestVar('download_software_category_id','');

	$download_software_category_id = $update_data['download_software_category_id'] = 1;
	

	
	$update_data['last_update_by'] = '';
	$update_data['create_by'] = '';
	$update_data['last_update_by'] = '';
	//////////////////////////////////////////////////////////
	$update_data_lang = array();
	$update_data_lang['name'] = getRequestVar('name','');	
	$update_data_lang['detail'] = getRequestVar('detail','');
	$update_data_lang['url'] = getRequestVar('url','');
$update_data_lang['detail2'] = getRequestVar('detail2','');
//////////////////////////////////////////////////////////
	$update_data_lang['seo_h1'] = getRequestVar('seo_h1','');
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
			$sql = "select download_software.* from ".TB_DOWNLOAD_SOFTWARE." as download_software, ".TB_DOWNLOAD_SOFTWARE_DESC." as download_software_desc ";
			$sql .= " where ";
			$sql .= " download_software_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and download_software_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and download_software_desc.download_software_id=download_software.id ";
			$sql .= " and download_software.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " download_software.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_DOWNLOAD_SOFTWARE, $update_data); 
			$update_data_lang['download_software_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_DOWNLOAD_SOFTWARE, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select download_software.* from ".TB_DOWNLOAD_SOFTWARE." as download_software, ".TB_DOWNLOAD_SOFTWARE_DESC." as download_software_desc ";
			$sql .= " where ";
			$sql .= " download_software_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and download_software_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and download_software_desc.download_software_id=download_software.id ";
			$sql .= " and download_software.id<>'".$update_data['id']."'  ";
			$sql .= " and download_software.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_DOWNLOAD_SOFTWARE, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['download_software_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_DOWNLOAD_SOFTWARE, $update_data_lang, "  download_software_id='".$update_data['id']."'   ");
		}
		
	}
	


	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_DOWNLOAD_SOFTWARE,$update_data['id'],true,'');
		
	}
	


	
		if($return_data['success']){
			
			
	$G_DB_CONNECT->query("delete from ".TB_DOWNLOAD_SOFTWARE_TO_PRODUCT." where download_software_id = '".$update_data['id']."'"); 
			$arr_product_id = getRequestVar('product_id','');
			
			if(count($arr_product_id) > 0 && is_array($arr_product_id)  && $arr_product_id[0] != ''){
				for($i=0;$i<count($arr_product_id);$i++){
					$update_data_product_to_product = array();
					$update_data_product_to_product['download_software_id'] = $update_data['id'];
					$update_data_product_to_product['product_id'] = $arr_product_id[$i];
					$G_DB_CONNECT->query_insert(TB_DOWNLOAD_SOFTWARE_TO_PRODUCT, $update_data_product_to_product);
				}
			}
			
			
				$G_DB_CONNECT->query("delete from ".TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_TYPE." where download_software_id = '".$update_data['id']."'"); 
			$arr_product_type_id = getRequestVar('product_type_id','');
			
			if(count($arr_product_type_id) > 0 && is_array($arr_product_type_id)  && $arr_product_type_id[0] != ''){
				for($i=0;$i<count($arr_product_type_id);$i++){
					$update_data_product_type_to_product_type = array();
					$update_data_product_type_to_product_type['download_software_id'] = $update_data['id'];
					$update_data_product_type_to_product_type['product_type_id'] = $arr_product_type_id[$i];
					$G_DB_CONNECT->query_insert(TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_TYPE, $update_data_product_type_to_product_type);
				}
			}
			
			
				$G_DB_CONNECT->query("delete from ".TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_CATEGORY." where download_software_id = '".$update_data['id']."'"); 
			$arr_product_category_id = getRequestVar('product_category_id','');
			
			if(count($arr_product_category_id) > 0 && is_array($arr_product_category_id)  && $arr_product_category_id[0] != ''){
				for($i=0;$i<count($arr_product_category_id);$i++){
					$update_data_product_category_to_product_category = array();
					$update_data_product_category_to_product_category['download_software_id'] = $update_data['id'];
					$update_data_product_category_to_product_category['product_category_id'] = $arr_product_category_id[$i];
					$G_DB_CONNECT->query_insert(TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_CATEGORY, $update_data_product_category_to_product_category);
				}
			}
			
			
			
				$G_DB_CONNECT->query("delete from ".TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_CATEGORY2." where download_software_id = '".$update_data['id']."'"); 
			$arr_product_category2_id = getRequestVar('product_category2_id','');
			
			if(count($arr_product_category2_id) > 0 && is_array($arr_product_category2_id)  && $arr_product_category2_id[0] != ''){
				for($i=0;$i<count($arr_product_category2_id);$i++){
					$update_data_product_category2_to_product_category2 = array();
					$update_data_product_category2_to_product_category2['download_software_id'] = $update_data['id'];
					$update_data_product_category2_to_product_category2['product_category2_id'] = $arr_product_category2_id[$i];
					$G_DB_CONNECT->query_insert(TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_CATEGORY2, $update_data_product_category2_to_product_category2);
				}
			}
			
				$G_DB_CONNECT->query("delete from ".TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_CATEGORY3." where download_software_id = '".$update_data['id']."'"); 
			$arr_product_category3_id = getRequestVar('product_category3_id','');
			
			if(count($arr_product_category3_id) > 0 && is_array($arr_product_category3_id)  && $arr_product_category3_id[0] != ''){
				for($i=0;$i<count($arr_product_category3_id);$i++){
					$update_data_product_category3_to_product_category3 = array();
					$update_data_product_category3_to_product_category3['download_software_id'] = $update_data['id'];
					$update_data_product_category3_to_product_category3['product_category3_id'] = $arr_product_category3_id[$i];
					$G_DB_CONNECT->query_insert(TB_DOWNLOAD_SOFTWARE_TO_PRODUCT_CATEGORY3, $update_data_product_category3_to_product_category3);
				}
			}
			
			
		}
	
	
	
	
	
	//////////////////////////////////////////////////////////
	
	
		
	
  
  
  
  
  
  
  	renewSortOrder(TB_DOWNLOAD_SOFTWARE," id>0 and download_software_category_id='$download_software_category_id' ");

  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 