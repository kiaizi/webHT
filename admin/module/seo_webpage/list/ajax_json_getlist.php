<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = false;
	$return_data['warn_msg'] = '';
    $return_data['sql'] = '';
	$return_data['table_list_content'] = '';
	

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
	$having_condition = "";
	if($_REQUEST['searching'] == '1'){
		$search = $_REQUEST['search'];
		$search_by = $_REQUEST['search_by'];
		if($search != ''){
			//if($search_by == 'parent_category_name'){
				//$having_condition  .= " having ".$search_by." like '%$search%' ";
			//}else{
			$search_condition .= " and ".$search_by." like '%$search%' ";
			//}

			
		}
		
		if($_REQUEST['search_disabled'] != '-1'){
			$search_condition .= " and webpage.disabled = '".$_REQUEST['search_disabled']."' ";
		}
		
		if($_REQUEST['search_webpage_position_id'] != '-1'){
			//$search_condition .= " and webpage.webpage_position_id = '".$_REQUEST['search_webpage_position_id']."' ";
		}
		
		if($_REQUEST['search_have_contact_form'] != '-1'){
			//$search_condition .= " and webpage.have_contact_form = '".$_REQUEST['search_have_contact_form']."' ";
		}
		
		$search_parent_webpage_id = $_REQUEST['search_parent_webpage_id'];
		if($search_parent_webpage_id > 0 ){
				//$search_condition .= " and webpage.parent_webpage_id = '".$search_parent_webpage_id."'  ";
		}
		
	}


	//////////////////////////////////////////////////////////
	// action
	//////////////////////////////////////////////////////////
	$record_id = getRequestVar('record_id','');
	if($_REQUEST['list_action_now'] != ''){
		if($_REQUEST['list_action_now'] == '1' ){
			updateFieldDataFromTable(TB_WEBPAGE,"disabled",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '2' ){
			updateFieldDataFromTable(TB_WEBPAGE,"disabled",$record_id,0);
		}
		

		if($_REQUEST['list_action_now'] == '3' ){
			
			 deleteGroup(TB_WEBPAGE,$record_id,true,'');
			// $arr_data_delete = deleteGroupWithCategoryChildren($record_id,TB_WEBPAGE,"webpage_id",WARN_WEBPAGE_SUBCATEGORY_EXIST);
			 
			// $return_data['warn_msg'] = $arr_data_delete["warn_msg"];
		}
		
		if($_REQUEST['list_action_now'] == '4' ){
			updateFieldDataFromTable(TB_WEBPAGE,"have_contact_form",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '5' ){
			updateFieldDataFromTable(TB_WEBPAGE,"have_contact_form",$record_id,2);
		}
		
		
		generateHTACCESS();
	}









	
	
	//////////////////////////////////////////////////////////
	// table header
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_list">';
    $return_data['table_list_content'] .= '<tr>';
  //	$return_data['table_list_content'] .= '<th style="width:30px;"><input name="check_all"  id="check_all" type="checkbox" value="" /></th>';
	//$return_data['table_list_content'] .= ' <th width="200">&nbsp;</th>';
	//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="parent_category_name"><span>'.TITLE_PARENT_CATEGORY.'</span></a></th>';
	
		$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="id"><span>ID</span></a></th>';
   	$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="nav_link"><span>'.TITLE_WEBPAGE.'</span></a></th>';
   //	$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="nav_link_sort_order"><span>'.TITLE_SORT_ORDER.'</span></a></th>';
	
	//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="webpage_position_id"><span>'.TITLE_WEBPAGE_POSITION.'</span></a></th>';
		//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="have_contact_form"><span>'.TITLE_HAVE_CONTACT_FORM.'</span></a></th>';
  //  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="disabled"><span>'.TITLE_DISABLED.'</span></a></th>';
    //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE_BRIEF.'</span></a> <a href="#" class="orderby_title" orderby="last_update_date"><span>'.TITLE_LAST_UPDATE_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th>&nbsp;</th>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////
	// table content
	//////////////////////////////////////////////////////////
	/*
	$sql = "select webpage.*,webpage_desc.name as name "; 
	$sql .= ",(select name from ".TB_WEBPAGE_DESC." where webpage_id=webpage.parent_webpage_id and language_id = '".ADMIN_LANG_ID."') as parent_category_name";
	$sql .= " from ".TB_WEBPAGE." as webpage, ".TB_WEBPAGE_DESC." as webpage_desc ";
	$sql .= " where ";
	$sql .= " webpage.id = webpage_desc.webpage_id ";
	$sql .= " and webpage_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and webpage.disabled<>'".DISABLED_DELETE."' ";
	$sql .= $search_condition;
	
	
	$sql .= " group by webpage.id  ";
	$sql .= $having_condition;
	
	*/
	
	
 $sql = "select webpage.*,webpage_desc.name as name from ".TB_WEBPAGE." as webpage , ".TB_WEBPAGE_DESC." as webpage_desc ";
	$sql .= " where ";
	$sql .= " webpage.id=webpage_desc.webpage_id ";
	$sql .= " and webpage_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and webpage.disabled<>'".DISABLED_DELETE."' and have_seo=1";
	////////////////////////////////////////////////////////////
	
	$sql .= $search_condition;

//	$sql .= " and webpage.parent_webpage_id='".P_SID."' ";
	////////////////////////////////////////////////////////////
	//$sql .= " order by webpage.nav_link_sort_order asc ";
	
	
	
	

	
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
	
	
	

		//	$return_data['table_list_content'] .= '<td><input name="record_id[]"  id="record_id[]" type="checkbox" class="checkGroup" value="'.$data['id'].'"  disabled/></td>';

   
   
   
   
   	//////////////////////////////////////////////////////////
		/*
    $return_data['table_list_content'] .= '<td style="text-align:center; vertical-align:middle;width:200px">';
	$return_data['table_list_content'] .= getFirstPhoto(TB_WEBPAGE_PHOTO," webpage_id='".$data['id']."' ","thumb",200,62);
	$return_data['table_list_content'] .= '</td>';
	*/
	//////////////////////////////////////////////////////////
	//$arr_data = getCategoryNav($data['id'],TB_WEBPAGE,"webpage_id",false,0," &gt;<br>",false);
    //$return_data['table_list_content'] .= '<td>'.$arr_data["out"].'</td>';
	
	 	$return_data['table_list_content'] .= '<td style="padding-left:25px;">'.$data['id'].'</td>';
 	$return_data['table_list_content'] .= '<td style="padding-left:25px;">'.$data['name'].'</td>';
	/*
	$return_data['table_list_content'] .= '<td>';
	if($data['parent_webpage_id'] > 0){
		$return_data['table_list_content'] .= $data['sort_order'];
	}else{
		$return_data['table_list_content'] .= "&nbsp;";
	}
	$return_data['table_list_content'] .= '</td>';
	*/
	
	//$return_data['table_list_content'] .= '<td>'.getLangName(TB_WEBPAGE_POSITION,"name",$data['webpage_position_id'],ADMIN_LANG_ID).'</td>';
	
	
	// $return_data['table_list_content'] .= '<td>'.displayYesNo($data['have_contact_form']).'</td>';
	
   // $return_data['table_list_content'] .= '<td>'.displayDisabled($data['disabled']).'</td>';
	
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