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
/*
	$update_data['start_date'] = getRequestVar('start_date','');
	$update_data['end_date'] = getRequestVar('end_date','');
	$update_data['display_date'] = getRequestVar('display_date','');

*/
	$update_data['trading_market_category_id'] = getRequestVar('trading_market_category_id','');

	$trading_market_category_id = $update_data['trading_market_category_id'] = 2;
		$update_data['highlight'] = getRequestVar('highlight','');



	
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

$update_data_lang['other2_name'] = getRequestVar('other2_name','');
$update_data_lang['other2_name2'] = getRequestVar('other2_name2','');
$update_data_lang['other2_detail'] = getRequestVar('other2_detail','');

$update_data_lang['other3_name'] = getRequestVar('other3_name','');
$update_data_lang['other3_name2'] = getRequestVar('other3_name2','');
$update_data_lang['other3_name3'] = getRequestVar('other3_name3','');
$update_data_lang['other3_name4'] = getRequestVar('other3_name4','');
$update_data_lang['other3_name5'] = getRequestVar('other3_name5','');
$update_data_lang['other3_name6'] = getRequestVar('other3_name6','');
$update_data_lang['other3_name7'] = getRequestVar('other3_name7','');
$update_data_lang['other3_name8'] = getRequestVar('other3_name8','');
$update_data_lang['other3_detail'] = getRequestVar('other3_detail','');




$update_data_lang['other_name1'] = getRequestVar('other_name1','');
$update_data_lang['other_name2'] = getRequestVar('other_name2','');
$update_data_lang['other_name3'] = getRequestVar('other_name3','');
$update_data_lang['other_name4'] = getRequestVar('other_name4','');
$update_data_lang['other_name5'] = getRequestVar('other_name5','');

$update_data_lang['other_detail1'] = getRequestVar('other_detail1','');
$update_data_lang['other_detail2'] = getRequestVar('other_detail2','');
$update_data_lang['other_detail3'] = getRequestVar('other_detail3','');
$update_data_lang['other_detail4'] = getRequestVar('other_detail4','');
$update_data_lang['other_detail5'] = getRequestVar('other_detail5','');

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
			$sql = "select trading_market.* from ".TB_TRADING_MARKET." as trading_market, ".TB_TRADING_MARKET_DESC." as trading_market_desc ";
			$sql .= " where ";
			$sql .= " trading_market_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and trading_market_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and trading_market_desc.trading_market_id=trading_market.id ";
			$sql .= " and trading_market.disabled <> '".DISABLED_DELETE."' ";
			//$sql .= " trading_market.id<>'".$update_data['id']."'  ";
			
		
		
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST;
				$return_data['success'] = false;
			}
			
		*/
	
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_TRADING_MARKET, $update_data); 
			$update_data_lang['trading_market_id'] = $return_data['id'];
			$G_DB_CONNECT->query_insert_lang_content(TB_TRADING_MARKET, $update_data_lang);
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
/*
			$sql = "select trading_market.* from ".TB_TRADING_MARKET." as trading_market, ".TB_TRADING_MARKET_DESC." as trading_market_desc ";
			$sql .= " where ";
			$sql .= " trading_market_desc.name='".getRequestVar('name_'.DEFAULT_FRONT_LANG_ID,'')."'  ";
			$sql .= " and trading_market_desc.language_id='".DEFAULT_FRONT_LANG_ID."'  ";
			$sql .= " and trading_market_desc.trading_market_id=trading_market.id ";
			$sql .= " and trading_market.id<>'".$update_data['id']."'  ";
			$sql .= " and trading_market.disabled <> '".DISABLED_DELETE."' ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = TITLE_TITLE.WARN_EXIST ;
				$return_data['success'] = false;
			}
			
		*/

		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_TRADING_MARKET, $update_data, "id='".$update_data['id']."'"); 
			$update_data_lang['trading_market_id'] = $return_data['id'];
			$G_DB_CONNECT->query_update_lang_content(TB_TRADING_MARKET, $update_data_lang, "  trading_market_id='".$update_data['id']."'   ");
		}
		
	}
	


	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_TRADING_MARKET,$update_data['id'],true,'');
		
	}
	


	
		if($return_data['success']){
			
			
	$G_DB_CONNECT->query("delete from ".TB_TRADING_MARKET_TO_PRODUCT." where trading_market_id = '".$update_data['id']."'"); 
			$arr_product_id = getRequestVar('product_id','');
			
			if(count($arr_product_id) > 0 && is_array($arr_product_id)  && $arr_product_id[0] != ''){
				for($i=0;$i<count($arr_product_id);$i++){
					$update_data_product_to_product = array();
					$update_data_product_to_product['trading_market_id'] = $update_data['id'];
					$update_data_product_to_product['product_id'] = $arr_product_id[$i];
					$G_DB_CONNECT->query_insert(TB_TRADING_MARKET_TO_PRODUCT, $update_data_product_to_product);
				}
			}
			
			
				$G_DB_CONNECT->query("delete from ".TB_TRADING_MARKET_TO_PRODUCT_TYPE." where trading_market_id = '".$update_data['id']."'"); 
			$arr_product_type_id = getRequestVar('product_type_id','');
			
			if(count($arr_product_type_id) > 0 && is_array($arr_product_type_id)  && $arr_product_type_id[0] != ''){
				for($i=0;$i<count($arr_product_type_id);$i++){
					$update_data_product_type_to_product_type = array();
					$update_data_product_type_to_product_type['trading_market_id'] = $update_data['id'];
					$update_data_product_type_to_product_type['product_type_id'] = $arr_product_type_id[$i];
					$G_DB_CONNECT->query_insert(TB_TRADING_MARKET_TO_PRODUCT_TYPE, $update_data_product_type_to_product_type);
				}
			}
			
			
				$G_DB_CONNECT->query("delete from ".TB_TRADING_MARKET_TO_PRODUCT_CATEGORY." where trading_market_id = '".$update_data['id']."'"); 
			$arr_product_category_id = getRequestVar('product_category_id','');
			
			if(count($arr_product_category_id) > 0 && is_array($arr_product_category_id)  && $arr_product_category_id[0] != ''){
				for($i=0;$i<count($arr_product_category_id);$i++){
					$update_data_product_category_to_product_category = array();
					$update_data_product_category_to_product_category['trading_market_id'] = $update_data['id'];
					$update_data_product_category_to_product_category['product_category_id'] = $arr_product_category_id[$i];
					$G_DB_CONNECT->query_insert(TB_TRADING_MARKET_TO_PRODUCT_CATEGORY, $update_data_product_category_to_product_category);
				}
			}
			
			
			
				$G_DB_CONNECT->query("delete from ".TB_TRADING_MARKET_TO_PRODUCT_CATEGORY2." where trading_market_id = '".$update_data['id']."'"); 
			$arr_product_category2_id = getRequestVar('product_category2_id','');
			
			if(count($arr_product_category2_id) > 0 && is_array($arr_product_category2_id)  && $arr_product_category2_id[0] != ''){
				for($i=0;$i<count($arr_product_category2_id);$i++){
					$update_data_product_category2_to_product_category2 = array();
					$update_data_product_category2_to_product_category2['trading_market_id'] = $update_data['id'];
					$update_data_product_category2_to_product_category2['product_category2_id'] = $arr_product_category2_id[$i];
					$G_DB_CONNECT->query_insert(TB_TRADING_MARKET_TO_PRODUCT_CATEGORY2, $update_data_product_category2_to_product_category2);
				}
			}
			
				$G_DB_CONNECT->query("delete from ".TB_TRADING_MARKET_TO_PRODUCT_CATEGORY3." where trading_market_id = '".$update_data['id']."'"); 
			$arr_product_category3_id = getRequestVar('product_category3_id','');
			
			if(count($arr_product_category3_id) > 0 && is_array($arr_product_category3_id)  && $arr_product_category3_id[0] != ''){
				for($i=0;$i<count($arr_product_category3_id);$i++){
					$update_data_product_category3_to_product_category3 = array();
					$update_data_product_category3_to_product_category3['trading_market_id'] = $update_data['id'];
					$update_data_product_category3_to_product_category3['product_category3_id'] = $arr_product_category3_id[$i];
					$G_DB_CONNECT->query_insert(TB_TRADING_MARKET_TO_PRODUCT_CATEGORY3, $update_data_product_category3_to_product_category3);
				}
			}
			
			
		}
	
	
	
	
	
	//////////////////////////////////////////////////////////
	
	
		
	
  
  
  
  
  
  
  	renewSortOrder(TB_TRADING_MARKET," id>0 and trading_market_category_id='$trading_market_category_id' ");

  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 