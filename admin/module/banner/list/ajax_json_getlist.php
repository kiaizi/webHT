<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = false;
	$return_data['warn_msg'] = '';
    $return_data['sql'] = '';
	$return_data['table_list_content'] = '';
	
	
	
	//////////////////////////////////////////////////////////
	// update sort order
	//////////////////////////////////////////////////////////
	
	if($_REQUEST['update_sort_order'] > 0 && $_REQUEST['update_sort_order_data_id'] > 0){
		
		$sql = " update ".TB_BANNER;
		$sql .= " set ";
		$sql .= " sort_order = '".$_REQUEST['update_sort_order']."' ";
		$sql .= " where ";
		$sql .= " id = '".$_REQUEST['update_sort_order_data_id']."' ";
		$G_DB_CONNECT->query($sql);
		renewSortOrder(TB_BANNER," id>0 ");
		
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
			$search_condition .= " and banner.disabled = '".$_REQUEST['search_disabled']."' ";
		}

		
		
	}


	//////////////////////////////////////////////////////////
	// action
	//////////////////////////////////////////////////////////
	$record_id = getRequestVar('record_id','');
	if($_REQUEST['list_action_now'] != ''){
		if($_REQUEST['list_action_now'] == '1' ){
			updateFieldDataFromTable(TB_BANNER,"disabled",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '2' ){
			updateFieldDataFromTable(TB_BANNER,"disabled",$record_id,0);
		}

		if($_REQUEST['list_action_now'] == '3' ){
			
			 deleteGroup(TB_BANNER,$record_id,true,'');
		}
		generateHTACCESS();
	}









	
	
	//////////////////////////////////////////////////////////
	// table header
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_list">';
    $return_data['table_list_content'] .= '<tr>';
  	$return_data['table_list_content'] .= '<th class="th_check_all"><input name="check_all"  id="check_all" type="checkbox" value="" /></th>';
	$return_data['table_list_content'] .= ' <th width="200">&nbsp;</th>';
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="name"><span>網頁</span></a></th>';
	  //  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="color1"><span>Background Color</span></a></th>';
	
	//	$return_data['table_list_content'] .= ' <th >&nbsp;</th>';
	
	//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="tel"><span>'.TITLE_TEL.'</span></a></th>';
	// $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="sort_order"><span>'.TITLE_SORT_ORDER.'</span></a></th>';
 //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="disabled"><span>'.TITLE_DISABLED.'</span></a></th>';
    //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE_BRIEF.'</span></a> <a href="#" class="orderby_title" orderby="last_update_date"><span>'.TITLE_LAST_UPDATE_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th>&nbsp;</th>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////
	// table content
	//////////////////////////////////////////////////////////
	$sql = "select banner.*,banner_desc.name as name,banner_desc.brief from ".TB_BANNER." as banner, ".TB_BANNER_DESC." as banner_desc ";
	$sql .= " where ";
	$sql .= " banner.id = banner_desc.banner_id ";
	$sql .= " and banner.disabled <> '".DISABLED_DELETE."' ";
	$sql .= " and banner_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= $search_condition;
	$sql .= " group by banner.id  ";

	
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
   	$return_data['table_list_content'] .= '<td><input name="record_id[]"  id="record_id[]" type="checkbox" class="checkGroup" value="'.$data['id'].'"  disabled/></td>';
	
//////////////////////////////////////////////////////////
    $return_data['table_list_content'] .= '<td style="text-align:center; vertical-align:middle;">';
	$return_data['table_list_content'] .= '<table width="200"  border="0" cellspacing="0" cellpadding="0" id="table_text" style="border:none;background-color:#FFFFFF;margin:0;padding:0;">';
	$return_data['table_list_content'] .= '<tr>';
	$return_data['table_list_content'] .= '<td style="border:none;text-align:center; vertical-align:middle;background-color:#FFFFFF">';
	$return_data['table_list_content'] .= getFirstPhoto(TB_BANNER_PHOTO," banner_id='".$data['id']."' ","thumb",200,1000);
	$return_data['table_list_content'] .= '</td>';
	$return_data['table_list_content'] .= '</tr>';
	$return_data['table_list_content'] .= '</table>';
	$return_data['table_list_content'] .= '</td>';
	//////////////////////////////////////////////////////////
	    $return_data['table_list_content'] .= '<td>';
	
	 $return_data['table_list_content'] .= '<span class="highlight">'.nl2br($data['name']).'</span>';
	 if($data['brief'] != ''){
	  $return_data['table_list_content'] .= '<br>'.nl2br($data['brief']);
	 }
	 
	  $return_data['table_list_content'] .= '</td>';
	
		//	$return_data['table_list_content'] .= '<td>#'.$data['color1'].'</td>';
	
	//$return_data['table_list_content'] .= '<td><div style="float:left;border:1px solid #000000;width:20px;height:20px;background-color:#'.$data['color1'].'"></div></td>';
	
	
	

	
	//$return_data['table_list_content'] .= '<td>'.$data['tel'].'</td>';
	/*
		$return_data['table_list_content'] .= '<td>';
	

	$return_data['table_list_content'] .= printSortOrderInput($data['id'],$data['sort_order']);
	
	
	$return_data['table_list_content'] .= '</td>';
	
	*/
	
 //$return_data['table_list_content'] .= '<td>'.displayDisabled($data['disabled']).'</td>';
    //$return_data['table_list_content'] .= '<td>'.getCreateUpdateInfo($data['create_date'],$data['create_by'],$data['last_update_date'],$data['last_update_by']).'</td>';
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
	


$G_DB_CONNECT->close();




?> 