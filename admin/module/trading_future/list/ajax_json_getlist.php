<?php 
if(count($_POST) > 0  ){
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = false;
	$return_data['warn_msg'] = '';
    $return_data['sql'] = '';
if( $_SESSION['already_login']){
	$return_data['table_list_content'] = '';
	
	
	
	
	
	
	//////////////////////////////////////////////////////////
	// update sort order
	//////////////////////////////////////////////////////////
	
	if($_REQUEST['update_sort_order'] > 0 && $_REQUEST['update_sort_order_data_id'] > 0){
		
		$sql = " update ".TB_TRADING_FUTURE;
		$sql .= " set ";
		$sql .= " sort_order = '".$_REQUEST['update_sort_order']."' ";
		$sql .= " where ";
		$sql .= " id = '".$_REQUEST['update_sort_order_data_id']."' ";
		$G_DB_CONNECT->query($sql);
		renewSortOrder(TB_TRADING_FUTURE," id>0 ");
		
	}
	

	//////////////////////////////////////////////////////////
	// orderby
	//////////////////////////////////////////////////////////
	$orderby_condition = "";
	if($_REQUEST['orderby'] != ''){
		$orderby= $_REQUEST['orderby'];
		$order = $_REQUEST['order'];
		$orderby_condition .= " order by $orderby $order ";

		
	}


	
	//////////////////////////////////////////////////////////
	// search
	//////////////////////////////////////////////////////////
	$search_condition = "";
	if($_REQUEST['searching'] == '1'){
		$search = $_REQUEST['search'];
		$search_by = $_REQUEST['search_by'];
		if($search != ''){
			$search_condition .= " and ".$search_by." like '%$search%' ";
		}
		if($_REQUEST['search_disabled'] != '-1'){
			$search_condition .= " and trading_future.disabled = '".$_REQUEST['search_disabled']."' ";
		}


		if($_REQUEST['search_trading_future_category_id'] != '-1'){
			$search_condition .= " and trading_future.trading_future_category_id = '".$_REQUEST['search_trading_future_category_id']."' ";
		}

/*
				if($_REQUEST['search_product_id'] != '-1'){
			
			$search_condition .= " and trading_future.id in (select trading_future_id from ".TB_TRADING_FUTURE_TO_PRODUCT." where product_id='".$_REQUEST['search_product_id']."' )";
		}
		if($_REQUEST['search_product_type_id'] != '-1'){
			
			$search_condition .= " and trading_future.id in (select trading_future_id from ".TB_TRADING_FUTURE_TO_PRODUCT_TYPE." where product_type_id='".$_REQUEST['search_product_type_id']."' )";
		}
		
				if($_REQUEST['search_product_category_id'] != '-1'){
			
			$search_condition .= " and trading_future.id in (select trading_future_id from ".TB_TRADING_FUTURE_TO_PRODUCT_CATEGORY." where product_category_id='".$_REQUEST['search_product_category_id']."' )";
		}
		
				if($_REQUEST['search_product_category2_id'] != '-1'){
			
			$search_condition .= " and trading_future.id in (select trading_future_id from ".TB_TRADING_FUTURE_TO_PRODUCT_CATEGORY2." where product_category2_id='".$_REQUEST['search_product_category2_id']."' )";
		}
				if($_REQUEST['search_product_category3_id'] != '-1'){
			
			$search_condition .= " and trading_future.id in (select trading_future_id from ".TB_TRADING_FUTURE_TO_PRODUCT_CATEGORY3." where product_category3_id='".$_REQUEST['search_product_category3_id']."' )";
		}
		*/
	}


	//////////////////////////////////////////////////////////
	// action
	//////////////////////////////////////////////////////////
	$record_id = getRequestVar('record_id','');
	if($_REQUEST['list_action_now'] != ''){
		if($_REQUEST['list_action_now'] == '1' ){
			updateFieldDataFromTable(TB_TRADING_FUTURE,"disabled",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '2' ){
			updateFieldDataFromTable(TB_TRADING_FUTURE,"disabled",$record_id,0);
		}

		if($_REQUEST['list_action_now'] == '3' ){
			
			 deleteGroup(TB_TRADING_FUTURE,$record_id,true,'');
		}
		generateHTACCESS();
	}









	
	
	//////////////////////////////////////////////////////////
	// table header
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_list">';
    $return_data['table_list_content'] .= '<tr>';
  	$return_data['table_list_content'] .= '<th class="th_check_all"><input name="check_all"  id="check_all" type="checkbox" value="" /></th>';
	//$return_data['table_list_content'] .= ' <th width="100">&nbsp;</th>';
	$return_data['table_list_content'] .= '<th width="150"><a href="#" class="orderby_title" orderby="display_date"><span>'.TITLE_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="name"><span>'.TITLE_TITLE.'</span></a></th>';
	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="trading_future_category_id"><span>交易日</span></a></th>';
	
	
	//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="tel"><span>'.TITLE_TEL.'</span></a></th>';
//	 $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="sort_order"><span>'.TITLE_SORT_ORDER.'</span></a></th>';
    // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="disabled"><span>相關資料</span></a></th>';
   


  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="disabled"><span>'.TITLE_DISABLED.'</span></a></th>';
   

   //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE_BRIEF.'</span></a> <a href="#" class="orderby_title" orderby="last_update_date"><span>'.TITLE_LAST_UPDATE_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th>&nbsp;</th>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////
	// table content
	//////////////////////////////////////////////////////////
	$sql = "select trading_future.*,trading_future_desc.name as name from ".TB_TRADING_FUTURE." as trading_future, ".TB_TRADING_FUTURE_DESC." as trading_future_desc ";
	$sql .= " where ";
	$sql .= " trading_future.id = trading_future_desc.trading_future_id ";
	$sql .= " and trading_future.disabled <> '".DISABLED_DELETE."' ";
	$sql .= " and trading_future_desc.language_id = '".ADMIN_LANG_ID."'";
	
	//$sql .= " and trading_future.trading_future_category_id = 1 ";
	
	$sql .= $search_condition;
	//$sql .= " group by trading_future.id  ";

	
	//////////////////////////////////////////////////////////
	// paging
	//////////////////////////////////////////////////////////
	define('RECORDS_PER_PAGE',$_REQUEST['record_per_page']);
	define('THIS_PAGING_DIR', '../../../'.ROOT_INCLUDE_DIR);
	define('PAGING_SQL',$sql);
	require($this_dir_path.DIR_COMMON."paging_top.php");
	$sql .= $orderby_condition;
	$sql .= " limit $limit1, $limit2";
	
	require($this_dir_path.DIR_COMMON."paging_bottom.php");
	$return_data['paging_content'] = print_paging_content($currentPageInfo,$totalRecordInfo, $gpageLinkInfo);
	//////////////////////////////////////////////////////////
	//$return_data['sql'] = $sql;
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '<tr class="list_row">';
   	$return_data['table_list_content'] .= '<td><input  name="record_id[]"  id="record_id[]" type="checkbox" class="checkGroup" value="'.$data['id'].'"  disabled/></td>';
	
//////////////////////////////////////////////////////////
/*
    $return_data['table_list_content'] .= '<td style="text-align:center; vertical-align:middle;">';
	/*
	if($data['youtube_id'] != ''){
		$return_data['table_list_content'] .= '<img src="http://img.youtube.com/vi/'.$data['youtube_id'].'/0.jpg" width="100">';
	}else{
	
	
	$return_data['table_list_content'] .= '<table width="100"  border="0" cellspacing="0" cellpadding="0" id="table_text" style="border:none;background-color:#FFFFFF;margin:0;padding:0;">';
	$return_data['table_list_content'] .= '<tr>';
	$return_data['table_list_content'] .= '<td style="border:none;text-align:center; vertical-align:middle;background-color:#FFFFFF">';
	$return_data['table_list_content'] .= getFirstPhoto(TB_TRADING_FUTURE_PHOTO," trading_future_id='".$data['id']."' ","thumb",100,500);
	$return_data['table_list_content'] .= '</td>';
	$return_data['table_list_content'] .= '</tr>';
	$return_data['table_list_content'] .= '</table>';
	
	}
	
	$return_data['table_list_content'] .= '</td>';*/
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '<td>'.$data['display_date'].'</td>';
	
    $return_data['table_list_content'] .= '<td>';
	
	
	
	
		$return_data['table_list_content'] .= nl2br($data['name']);
	
	
	if($data['youtube_id'] != ''){
		$return_data['table_list_content'] .= '<br>http://www.youtube.com/embed/'.$data['youtube_id'];
	}
	
	
	$return_data['table_list_content'] .= '</td>';
	
		$return_data['table_list_content'] .= '<td>';
	
	$return_data['table_list_content'] .=  getLangName(TB_TRADING_FUTURE_CATEGORY,"name",$data['trading_future_category_id'],CURRENT_LANG);
		$return_data['table_list_content'] .= '</td>';

	
	
	//$return_data['table_list_content'] .= '<td>'.$data['tel'].'</td>';
/*
	$return_data['table_list_content'] .= '<td>';
	

	$return_data['table_list_content'] .= printSortOrderInput($data['id'],$data['sort_order']);
	
	
	$return_data['table_list_content'] .= '</td>';
	
	*/
	
	

	
	/*
  	$return_data['table_list_content'] .= '<td>';
	
		$product_type_name_list = '';
	$sql = "select product_type.id as id ,product_type_desc.name as name "; 
	$sql .= " from ".TB_PRODUCT_TYPE." as product_type, ".TB_PRODUCT_TYPE_DESC." as product_type_desc ";
	$sql .= " where ";

	$sql .= "  product_type.id = product_type_desc.product_type_id ";
	$sql .= " and product_type_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and product_type.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by product_type.sort_order asc ";
	$rows2a = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($G_DB_CONNECT->affected_rows > 0){
		$k=0;
		$num_col = 4;
		
		while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
			$k++;
			$this_name = $data2a['name'];
			$this_id = $data2a['id'];
			
			/////////////////////////////////////////////////////////////
			$sql = "select product_type_id "; 
			$sql .= " from ".TB_TRADING_FUTURE_TO_PRODUCT_TYPE;
			$sql .= " where ";
			$sql .= " trading_future_id = '".$data['id']."' ";
			$sql .= " and product_type_id = '".$this_id."' ";
			$rows3 = $G_DB_CONNECT->query($sql);
			$checked = '';
			if($G_DB_CONNECT->affected_rows > 0){
				if($product_type_name_list != ''){
					$product_type_name_list .='<br>';
				}
			
				$product_type_name_list .= '-'. $this_name;
			}
			
		}
}

if($product_type_name_list != ''){
		$return_data['table_list_content'] .= '<b>'.TITLE_PRODUCT_TYPE.'</b><br>';
	
		$return_data['table_list_content'] .= $product_type_name_list;
		
			$return_data['table_list_content'] .= '<br>';
}
			
		 
	
	$product_name_list = '';
	$sql = "select product.id as id ,product_desc.name as name "; 
	$sql .= " from ".TB_PRODUCT." as product, ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";

	$sql .= "  product.id = product_desc.product_id ";
	$sql .= " and product_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and product.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by product.sort_order asc ";
	$rows2a = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($G_DB_CONNECT->affected_rows > 0){
		$k=0;
		$num_col = 4;
		
		while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
			$k++;
			$this_name = $data2a['name'];
			$this_id = $data2a['id'];
			
			/////////////////////////////////////////////////////////////
			$sql = "select product_id "; 
			$sql .= " from ".TB_TRADING_FUTURE_TO_PRODUCT;
			$sql .= " where ";
			$sql .= " trading_future_id = '".$data['id']."' ";
			$sql .= " and product_id = '".$this_id."' ";
			$rows3 = $G_DB_CONNECT->query($sql);
			$checked = '';
			if($G_DB_CONNECT->affected_rows > 0){
				if($product_name_list != ''){
					$product_name_list .='<br>';
				}
			
				$product_name_list .= '-'. $this_name;
			}
			
		}
}

if($product_name_list != ''){
		$return_data['table_list_content'] .= '<b>'.TITLE_PRODUCT.'</b><br>';
	
		$return_data['table_list_content'] .= $product_name_list;
		
			$return_data['table_list_content'] .= '<br>';
}
			
		
		
			
			$product_category_name_list = '';
	$sql = "select product_category.id as id ,product_category_desc.name as name "; 
	$sql .= " from ".TB_PRODUCT_CATEGORY." as product_category, ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";

	$sql .= "  product_category.id = product_category_desc.product_category_id ";
	$sql .= " and product_category_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and product_category.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by product_category.sort_order asc ";
	$rows2a = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($G_DB_CONNECT->affected_rows > 0){
		$k=0;
		$num_col = 4;
		
		while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
			$k++;
			$this_name = $data2a['name'];
			$this_id = $data2a['id'];
			
			/////////////////////////////////////////////////////////////
			$sql = "select product_category_id "; 
			$sql .= " from ".TB_TRADING_FUTURE_TO_PRODUCT_CATEGORY;
			$sql .= " where ";
			$sql .= " trading_future_id = '".$data['id']."' ";
			$sql .= " and product_category_id = '".$this_id."' ";
			$rows3 = $G_DB_CONNECT->query($sql);
			$checked = '';
			if($G_DB_CONNECT->affected_rows > 0){
				if($product_category_name_list != ''){
					$product_category_name_list .='<br>';
				}
			
				$product_category_name_list .= '-'. $this_name;
			}
			
		}
}

if($product_category_name_list != ''){
		$return_data['table_list_content'] .= '<b>'.TITLE_PRODUCT_CATEGORY.'</b><br>';
	
		$return_data['table_list_content'] .= $product_category_name_list;
		
			$return_data['table_list_content'] .= '<br>';
}
			
		 

		 	$product_category2_name_list = '';
	$sql = "select product_category2.id as id ,product_category2_desc.name as name "; 
	$sql .= " from ".TB_PRODUCT_CATEGORY2." as product_category2, ".TB_PRODUCT_CATEGORY2_DESC." as product_category2_desc ";
	$sql .= " where ";

	$sql .= "  product_category2.id = product_category2_desc.product_category2_id ";
	$sql .= " and product_category2_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and product_category2.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by product_category2.sort_order asc ";
	$rows2a = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($G_DB_CONNECT->affected_rows > 0){
		$k=0;
		$num_col = 4;
		
		while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
			$k++;
			$this_name = $data2a['name'];
			$this_id = $data2a['id'];
			
			/////////////////////////////////////////////////////////////
			$sql = "select product_category2_id "; 
			$sql .= " from ".TB_TRADING_FUTURE_TO_PRODUCT_CATEGORY2;
			$sql .= " where ";
			$sql .= " trading_future_id = '".$data['id']."' ";
			$sql .= " and product_category2_id = '".$this_id."' ";
			$rows3 = $G_DB_CONNECT->query($sql);
			$checked = '';
			if($G_DB_CONNECT->affected_rows > 0){
				if($product_category2_name_list != ''){
					$product_category2_name_list .='<br>';
				}
			
				$product_category2_name_list .= '-'. $this_name;
			}
			
		}
}

if($product_category2_name_list != ''){
		$return_data['table_list_content'] .= '<b>'.TITLE_PRODUCT_CATEGORY2.'</b><br>';
	
		$return_data['table_list_content'] .= $product_category2_name_list;
		
			$return_data['table_list_content'] .= '<br>';
}
			
		 
		 	$product_category3_name_list = '';
	$sql = "select product_category3.id as id ,product_category3_desc.name as name "; 
	$sql .= " from ".TB_PRODUCT_CATEGORY3." as product_category3, ".TB_PRODUCT_CATEGORY3_DESC." as product_category3_desc ";
	$sql .= " where ";

	$sql .= "  product_category3.id = product_category3_desc.product_category3_id ";
	$sql .= " and product_category3_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and product_category3.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by product_category3.sort_order asc ";
	$rows2a = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($G_DB_CONNECT->affected_rows > 0){
		$k=0;
		$num_col = 4;
		
		while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
			$k++;
			$this_name = $data2a['name'];
			$this_id = $data2a['id'];
			
			/////////////////////////////////////////////////////////////
			$sql = "select product_category3_id "; 
			$sql .= " from ".TB_TRADING_FUTURE_TO_PRODUCT_CATEGORY3;
			$sql .= " where ";
			$sql .= " trading_future_id = '".$data['id']."' ";
			$sql .= " and product_category3_id = '".$this_id."' ";
			$rows3 = $G_DB_CONNECT->query($sql);
			$checked = '';
			if($G_DB_CONNECT->affected_rows > 0){
				if($product_category3_name_list != ''){
					$product_category3_name_list .='<br>';
				}
			
				$product_category3_name_list .= '-'. $this_name;
			}
			
		}
}

if($product_category3_name_list != ''){
		$return_data['table_list_content'] .= '<b>'.TITLE_PRODUCT_CATEGORY3.'</b><br>';
	
		$return_data['table_list_content'] .= $product_category3_name_list;
		
			$return_data['table_list_content'] .= '<br>';
}
			
		 
		 
		 
		 
			
	
					
					$return_data['table_list_content'] .= '</td>';

					
	
	
	*/
	
    $return_data['table_list_content'] .= '<td>'.displayDisabled($data['disabled']).'</td>';
    // $return_data['table_list_content'] .= '<td>'.getCreateUpdateInfo($data['create_date'],$data['create_by'],$data['last_update_date'],$data['last_update_by']).'</td>';
    $return_data['table_list_content'] .= '<td><a href="#" class="button btn_edit" id="'.$data['id'].'"><span>'.BTN_MODIFY.'</span></a></td>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////			
			}
			
	}
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '</table>';
	//////////////////////////////////////////////////////////
	$return_data['success'] = true;
	$return_data['sql'] = $sql;
		
	
  
  
  
  
  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();
	}
	$G_DB_CONNECT->close();



}

?> 