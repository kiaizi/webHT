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
			$search_condition .= " and enquiry.".$search_by." like '%$search%' ";
		}
		if($_REQUEST['search_disabled'] != '-1'){
			//$search_condition .= " and enquiry.disabled = '".$_REQUEST['search_disabled']."' ";
		}
		if($_REQUEST['search_gender'] != '-1'){
			//$search_condition .= " and enquiry.gender = '".$_REQUEST['search_gender']."' ";
		}
		if($_REQUEST['search_country'] != '-1'){
			//$search_condition .= " and enquiry.country = '".$_REQUEST['search_country']."' ";
		}
		
		if($_REQUEST['search_payment_status_id'] != '-1'){
			$search_condition .= " and enquiry.payment_status_id = '".$_REQUEST['search_payment_status_id']."' ";
		}
		
		
		
		if($_REQUEST['search_payment_method_id'] != '-1'){
			$search_condition .= " and enquiry.payment_method_id = '".$_REQUEST['search_payment_method_id']."' ";
		}
		
		$search_condition .= " and DATE(create_date) >= '".$_REQUEST['search_create_date_from']."' and DATE(create_date)<='".$_REQUEST['search_create_date_to']."' ";
			
		
	}


	//////////////////////////////////////////////////////////
	// action
	//////////////////////////////////////////////////////////
	$record_id = getRequestVar('record_id','');
	if($_REQUEST['list_action_now'] != ''){
		if($_REQUEST['list_action_now'] == '1' ){
			updateFieldDataFromTable(TB_ENQUIRY,"disabled",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '2' ){
			updateFieldDataFromTable(TB_ENQUIRY,"disabled",$record_id,0);
		}
		/*
		if($_REQUEST['list_action_now'] == '3' ){
			
			 deleteGroup(TB_ENQUIRY,$record_id,false,'');
		}
		
		*/
		 for ($k=0; $k<count($record_id); $k++) {
         		
				$id = $record_id[$k];
				$sqltest="delete from ".TB_ENQUIRY." where   id='$id'  ";
				$G_DB_CONNECT->query("delete from ".TB_ENQUIRY." where   id='$id'   " ); 
				
				
			}
			 
		
		
		generateHTACCESS();
	}









	
	
	//////////////////////////////////////////////////////////
	// table header
	//////////////////////////////////////////////////////////
	$return_data['table_list_content'] .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_list">';
    $return_data['table_list_content'] .= '<tr>';
  	$return_data['table_list_content'] .= '<th style="width:30px;"><input name="check_all"  id="check_all" type="checkbox" value="" /></th>';
 // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="name"><span>'.TITLE_NAME.'</span></a></th>';
	
		
			
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="code"><span>參考號碼</span></a></th>';

	
	
	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="name"><span>姓名</span></a></th>';


		$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="age"><span>年齡</span></a></th>';
  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="gender"><span>性別</span></a></th>';
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="mobile_no"><span>聯絡電話</span></a></th>';
  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="email"><span>電郵地址</span></a></th>';
  
  
  	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="form_option1_id"><span>現有皮膚問題</span></a></th>';
  	$return_data['table_list_content'] .= '<th width="150"><a href="#" class="orderby_title" orderby="form_option2_id"><span>療程</span></a></th>';
  	$return_data['table_list_content'] .= '<th width="150"><a href="#" class="orderby_title" orderby="form_option3_id"><span>療程地點</span></a></th>';
    
	  	$return_data['table_list_content'] .= '<th width="150"><a href="#" class="orderby_title" orderby="msg"><span>訊息</span></a></th>';
    
	
	
	
		    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="payment_method_id"><span>付款方法</span></a></th>';
    	$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="paypal_refno"><span>PayPal收據號碼</span></a></th>';

	    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="payment_status_id"><span>付款狀態</span></a></th>';
  
  
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="newsletter"><span>接收推廣資訊</span></a></th>';
  
  
	
	
	
   $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE.'</span></a></th>';
   // $return_data['table_list_content'] .= '<th>&nbsp;</th>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////
	// table content
	//////////////////////////////////////////////////////////
	$sql = "select enquiry.* from ".TB_ENQUIRY." as enquiry ";
$sql .= " where id > 0 ";
	$sql .= $search_condition;
	//$sql .= " group by enquiry.id  ";

	
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
	// $return_data['table_list_content'] .= '<td style="padding-left:25px;">'.$data['name'].'</td>';
   // $return_data['table_list_content'] .= '<td  >'.$data['title'].'</td>';
  
          $return_data['table_list_content'] .= '<td>'.$data['code'].'</td>';
  $return_data['table_list_content'] .= '<td>'.$data['name'].'</td>';
  $return_data['table_list_content'] .= '<td>'.$data['age'].'</td>';
	  $return_data['table_list_content'] .= '<td>'.$data['gender'].'</td>';
	  $return_data['table_list_content'] .= '<td>'.$data['mobile_no'].'</td>';
	  $return_data['table_list_content'] .= '<td>'.$data['email'].'</td>';


		$return_data['table_list_content'] .= '<td>'.getLangName(TB_FORM_OPTION1,"name",$data['form_option1_id']).'</td>';
	
	$return_data['table_list_content'] .= '<td>'.getLangName(TB_FORM_OPTION2,"name",$data['form_option2_id']).'</td>';
	$return_data['table_list_content'] .= '<td>'.getLangName(TB_FORM_OPTION3,"name",$data['form_option3_id']).'</td>';
	
	   $return_data['table_list_content'] .= '<td>'.$data['msg'].'</td>';
	   
	   	   		$return_data['table_list_content'] .= '<td>'.getLangName(TB_PAYMENT_METHOD,"name",$data['payment_method_id']).'</td>';
		    $return_data['table_list_content'] .= '<td>'.$data['paypal_refno'].'</td>';
  
	   
	   		$return_data['table_list_content'] .= '<td>'.getLangName(TB_PAYMENT_STATUS,"name",$data['payment_status_id']).'</td>';
	
	   
	  
	  if($data['newsletter'] == 1){
		  $return_data['table_list_content'] .= '<td>是</td>';
	  }else{
		  
		  $return_data['table_list_content'] .= '<td>否</td>';
	  }
	  
	  
	
	//$return_data['table_list_content'] .= ' <td>'.$data['givenname_en'].'</td>';
	//$return_data['table_list_content'] .= '<td>'.getLangName(TB_GENDER,"name",$data['gender']).'</td>';
	//$return_data['table_list_content'] .= '<td>'.getLangName(TB_COUNTRY,"name",$data['country']).'</td>';
   // $return_data['table_list_content'] .= '<td>'.$data['home_no'].'&nbsp;</td>';
   // $return_data['table_list_content'] .= '<td>'.displayUserDisabled($data['disabled']).'</td>';
	//$return_data['table_list_content'] .= '<td>'.str_replace(" ", "<br>", $data['last_login_date']).'&nbsp;</td>';
  //  $return_data['table_list_content'] .= '<td>'.getCreateUpdateInfo($data['create_date'],$data['create_by'],$data['last_update_date'],$data['last_update_by']).'</td>';
   // $return_data['table_list_content'] .= '<td><a href="#" class="button btn_edit" id="'.$data['id'].'"><span>'.BTN_MODIFY.'</span></a></td>';
   $return_data['table_list_content'] .= '<td>'.$data['create_date'].'</td>';
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