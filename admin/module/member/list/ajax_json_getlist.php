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
	if($_REQUEST['searching'] == '1'){
		$search = $_REQUEST['search'];
		$search_by = $_REQUEST['search_by'];
		if($search != ''){
			$search_condition .= " and member.".$search_by." like '%$search%' ";
		}
		if($_REQUEST['search_disabled'] != '-1'){
			$search_condition .= " and member.disabled = '".$_REQUEST['search_disabled']."' ";
		}
		if($_REQUEST['search_gender'] != '-1'){
			//$search_condition .= " and member.gender = '".$_REQUEST['search_gender']."' ";
		}
		if($_REQUEST['search_country'] != '-1'){
			$search_condition .= " and member.country = '".$_REQUEST['search_country']."' ";
		}
		if($_REQUEST['search_member_category_id'] != '-1'){
			$search_condition .= " and member.member_category_id = '".$_REQUEST['search_member_category_id']."' ";
		}
		
	}


	//////////////////////////////////////////////////////////
	// action
	//////////////////////////////////////////////////////////
	$record_id = getRequestVar('record_id','');
	if($_REQUEST['list_action_now'] != ''){
		if($_REQUEST['list_action_now'] == '1' ){
			updateFieldDataFromTable(TB_MEMBER,"disabled",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '2' ){
			updateFieldDataFromTable(TB_MEMBER,"disabled",$record_id,0);
		}
		if($_REQUEST['list_action_now'] == '3' ){
			
			 deleteGroup(TB_MEMBER,$record_id,false,'');
		}
		generateHTACCESS();
	}









	
	
	//////////////////////////////////////////////////////////
	// table header
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_list">';
    $return_data['table_list_content'] .= '<tr>';
  	$return_data['table_list_content'] .= '<th style="width:30px;"><input name="check_all"  id="check_all" type="checkbox" value="" /></th>';
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="code"><span>'.TITLE_MEMBER.'</span></a></th>';

	
	  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="username"><span>'.TITLE_USERNAME.'</span></a></th>';
		
	    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="surname_en"><span>'.TITLE_SURNAME_EN.'</span></a></th>';
			
	    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="givenname_en"><span>'.TITLE_GIVENNAME_EN.'</span></a></th>';
	
	
	
	  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="email"><span>'.TITLE_EMAIL.'</span></a></th>';
	
	  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="mobile_no"><span>'.TITLE_MOBILE_NO.'</span></a></th>';
	
	

//	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="coin"><span>Bonus points</span></a></th>';
	 // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="username"><span>'.TITLE_USERNAME.'</span></a></th>';
   	//$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="username"><span>'.TITLE_EMAIL.'</span></a></th>';
  // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="surname_en"><span>'.TITLE_SURNAME_EN.'</span></a></th>';
  //  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="givenname_en"><span>'.TITLE_GIVENNAME_EN.'</span></a></th>';
	 //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="gender"><span>'.TITLE_GENDER.'</span></a></th>';
	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="country"><span>'.TITLE_COUNTRY.'</span></a></th>';
	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="home_no"><span>'.TITLE_HOME_NO.'</span></a></th>';
	//  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="coin"><span>'.TITLE_COIN.'</span></a></th>';
	  // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="coin_end_date"><span>'.TITLE_COIN_END_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="disabled"><span>'.TITLE_USER_DISABLED.'</span></a></th>';
	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="last_login_date"><span>'.TITLE_LAST_LOGIN_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE_BRIEF.'</span></a> <a href="#" class="orderby_title" orderby="last_update_date"><span>'.TITLE_LAST_UPDATE_DATE.'</span></a></th>';
    $return_data['table_list_content'] .= '<th>&nbsp;</th>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////
	// table content
	//////////////////////////////////////////////////////////
	$sql = "select member.* from ".TB_MEMBER." as member ";
	$sql .= " where ";
	$sql .= " member.role_id='4' ";
	$sql .= " and member.disabled<>'".DISABLED_DELETE."' ";
	$sql .= $search_condition;
	//$sql .= " group by member.id  ";

	
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
    $return_data['table_list_content'] .= '<td><span class="highlight">'.$data['code'].'</span>';
	
	$return_data['table_list_content'] .= '</td>';
	

	
	$return_data['table_list_content'] .= ' <td>'.$data['username'].'</td>';
		$return_data['table_list_content'] .= ' <td>'.$data['surname_en'].'</td>';
			$return_data['table_list_content'] .= ' <td>'.$data['givenname_en'].'</td>';
	$return_data['table_list_content'] .= ' <td>'.$data['email'].'</td>';
	$return_data['table_list_content'] .= ' <td>'.$data['mobile_no'].'</td>';
	
	
//$return_data['table_list_content'] .= ' <td>'.$data['coin'].'</td>';




	//$return_data['table_list_content'] .= '<td>'.getLangName(TB_GENDER,"name",$data['gender']).'</td>';
	//$return_data['table_list_content'] .= '<td>'.getLangName(TB_COUNTRY,"name",$data['country']).'</td>';
   // $return_data['table_list_content'] .= '<td>'.$data['home_no'].'&nbsp;</td>';
 //  $return_data['table_list_content'] .= ' <td>'.$data['coin'].'<br><span class="highlight">Expiry Date : '.$data['coin_end_date'].'</span></td>';
    // $return_data['table_list_content'] .= ' <td>'.$data['coin_end_date'].'</td>';
    $return_data['table_list_content'] .= '<td>'.displayUserDisabled($data['disabled']).'</td>';
	//$return_data['table_list_content'] .= '<td>'.str_replace(" ", "<br>", $data['last_login_date']).'&nbsp;</td>';
    $return_data['table_list_content'] .= '<td>'.getCreateUpdateInfo($data['create_date'],$data['create_by'],$data['last_update_date'],$data['last_update_by']).'</td>';
    $return_data['table_list_content'] .= '<td><a href="#" class="button btn_edit" id="'.$data['id'].'"><span>'.BTN_MODIFY.'</span></a></td>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////			
			}
			
	}
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '</table>';
	//////////////////////////////////////////////////////////
	$return_data['success'] = true;
		
	
  
  
  
  
  
  
  
  
  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	


$G_DB_CONNECT->close();




?> 