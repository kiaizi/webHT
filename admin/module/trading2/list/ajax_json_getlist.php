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
		
		$sql = " update ".TB_TRADING2;
		$sql .= " set ";
		$sql .= " sort_order = '".$_REQUEST['update_sort_order']."' ";
		$sql .= " where ";
		$sql .= " id = '".$_REQUEST['update_sort_order_data_id']."' ";
		$G_DB_CONNECT->query($sql);
		renewSortOrder(TB_TRADING2," id>0 ");
		
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
			$search_condition .= " and trading2.disabled = '".$_REQUEST['search_disabled']."' ";
		}

		
		
	}


	//////////////////////////////////////////////////////////
	// action
	//////////////////////////////////////////////////////////
	$record_id = getRequestVar('record_id','');
	if($_REQUEST['list_action_now'] != ''){
		if($_REQUEST['list_action_now'] == '1' ){
			updateFieldDataFromTable(TB_TRADING2,"disabled",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '2' ){
			updateFieldDataFromTable(TB_TRADING2,"disabled",$record_id,0);
		}

		if($_REQUEST['list_action_now'] == '3' ){
			
			 deleteGroup(TB_TRADING2,$record_id,true,'');
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
//$return_data['table_list_content'] .= ' <th width="100">&nbsp;</th>';
//$return_data['table_list_content'] .= ' <th width="100">&nbsp;</th>';
	//$return_data['table_list_content'] .= '<th width="100"><a href="#" class="orderby_title" orderby="display_date"><span>'.TITLE_DATE.'</span></a></th>';
  //  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="name"><span>'.TITLE_TITLE.'</span></a></th>';
	//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="tel"><span>'.TITLE_TEL.'</span></a></th>';
	//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="highlight"><span>在首頁顯示</span></a></th>';
	$return_data['table_list_content'] .= '<th width="100"><a href="#" class="orderby_title" orderby="sort_order"><span>'.TITLE_SORT_ORDER.'</span></a></th>';
    $return_data['table_list_content'] .= '<th width="100"><a href="#" class="orderby_title" orderby="disabled"><span>'.TITLE_DISABLED.'</span></a></th>';
	

	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="code"><span>交易所编码</span></a></th>';	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="code2"><span>品种编号</span></a></th>';	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="name"><span>品种</span></a></th>';	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="detail1"><span>货币</span></a></th>';	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="detail2"><span>初始保证金</span></a></th>';	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="detail7"><span>维持保证金</span></a></th>';	


	
	
	
    //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE_BRIEF.'</span></a> <a href="#" class="orderby_title" orderby="last_update_date"><span>'.TITLE_LAST_UPDATE_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th>&nbsp;</th>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////
	// table content
	//////////////////////////////////////////////////////////
	$sql = "select trading2.*,trading2_desc.name as name,trading2_desc.detail,trading2_desc.detail1,trading2_desc.detail2,trading2_desc.detail3,trading2_desc.detail4,trading2_desc.detail5,trading2_desc.detail6,trading2_desc.detail7,trading2_desc.detail8 from ".TB_TRADING2." as trading2, ".TB_TRADING2_DESC." as trading2_desc ";
	$sql .= " where ";
	$sql .= " trading2.id = trading2_desc.trading2_id ";
	$sql .= " and trading2.disabled <> '".DISABLED_DELETE."' ";
	$sql .= " and trading2_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= $search_condition;
	//$sql .= " group by trading2.id  ";

	
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
	


	//$return_data['table_list_content'] .= '<td>'.$data['tel'].'</td>';
   // $return_data['table_list_content'] .= '<td>'.displayYesNo($data['highlight']).'</td>';
	$return_data['table_list_content'] .= '<td>';
	

	$return_data['table_list_content'] .= printSortOrderInput($data['id'],$data['sort_order']);
	
	
	$return_data['table_list_content'] .= '</td>';
	
	
	
	
	
	
	

    $return_data['table_list_content'] .= '<td>'.displayDisabled($data['disabled']).'</td>';
	
	
	
	
	
	
	$return_data['table_list_content'] .= '<td>'.nl2br($data['code']).'</td>';
	$return_data['table_list_content'] .= '<td>'.nl2br($data['code2']).'</td>';
	$return_data['table_list_content'] .= '<td>'.nl2br($data['name']).'</td>';
	$return_data['table_list_content'] .= '<td>'.nl2br($data['detail1']).'</td>';
	$return_data['table_list_content'] .= '<td>'.nl2br($data['detail2']).'</td>';
	$return_data['table_list_content'] .= '<td>'.nl2br($data['detail7']).'</td>';


	
	
	
	
	
	
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