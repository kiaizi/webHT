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
			$search_condition .= " and enquiry_contact.".$search_by." like '%$search%' ";
		}
		if($_REQUEST['search_disabled'] != '-1'){
			//$search_condition .= " and enquiry_contact.disabled = '".$_REQUEST['search_disabled']."' ";
		}
		if($_REQUEST['search_gender'] != '-1'){
			//$search_condition .= " and enquiry_contact.gender = '".$_REQUEST['search_gender']."' ";
		}
	if($_REQUEST['search_form_option1_id'] != '-1'){
			$search_condition .= " and (enquiry_contact.form_option1_id = '".$_REQUEST['search_form_option1_id']."'  or enquiry_contact.form_option1_id like '%".$_REQUEST['search_form_option1_id'].",%' or enquiry_contact.form_option1_id like '%,".$_REQUEST['search_form_option1_id']."%'  )";
		}
		
		$search_condition .= " and DATE(create_date) >= '".$_REQUEST['search_create_date_from']."' and DATE(create_date)<='".$_REQUEST['search_create_date_to']."' ";
			
		
	}


	//////////////////////////////////////////////////////////
	// action
	//////////////////////////////////////////////////////////
	$record_id = getRequestVar('record_id','');
	if($_REQUEST['list_action_now'] != ''){
		if($_REQUEST['list_action_now'] == '1' ){
			updateFieldDataFromTable(TB_ENQUIRY_CONTACT,"disabled",$record_id,1);
		}
		if($_REQUEST['list_action_now'] == '2' ){
			updateFieldDataFromTable(TB_ENQUIRY_CONTACT,"disabled",$record_id,0);
		}
		/*
		if($_REQUEST['list_action_now'] == '3' ){
			
			 deleteGroup(TB_ENQUIRY_CONTACT,$record_id,false,'');
		}
		
		*/
		 for ($k=0; $k<count($record_id); $k++) {
         		
				$id = $record_id[$k];
				$sqltest="delete from ".TB_ENQUIRY_CONTACT." where   id='$id'  ";
				$G_DB_CONNECT->query("delete from ".TB_ENQUIRY_CONTACT." where   id='$id'   " ); 
				
				
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
	
	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="title"><span>??????</span></a></th>';
  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="name"><span>??????</span></a></th>';

  $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="email"><span>????????????</span></a></th>';
  
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="mobile_no"><span>????????????</span></a></th>';


  
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="company_name"><span>????????????</span></a></th>';
  
  
      $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="position"><span>????????????</span></a></th>';
      $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="form_option2_id"><span>??????????????????</span></a></th>';
      $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="form_option3_id"><span>????????????</span></a></th>';
  
  
    
    $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="form_option1_id"><span>??????????????????</span></a></th>';
  
  
	
	
	
  	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="gender"><span>??????</span></a></th>';
  
  
  	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="age"><span>??????</span></a></th>';
  

  //$return_data['table_list_content'] .= ' <th><a href="#" class="orderby_title" orderby="username"><span>'.TITLE_EMAIL.'</span></a></th>';
  // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="surname_en"><span>'.TITLE_SURNAME_EN.'</span></a></th>';
    //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="givenname_en"><span>'.TITLE_GIVENNAME_EN.'</span></a></th>';
	 //$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="gender"><span>'.TITLE_GENDER.'</span></a></th>';
	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="country"><span>'.TITLE_COUNTRY.'</span></a></th>';
	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="home_no"><span>'.TITLE_HOME_NO.'</span></a></th>';
   // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="disabled"><span>'.TITLE_USER_DISABLED.'</span></a></th>';
	//$return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="last_login_date"><span>'.TITLE_LAST_LOGIN_DATE.'</span></a></th>';
   // $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE_BRIEF.'</span></a> <a href="#" class="orderby_title" orderby="last_update_date"><span>'.TITLE_LAST_UPDATE_DATE.'</span></a></th>';
   $return_data['table_list_content'] .= '<th><a href="#" class="orderby_title" orderby="create_date"><span>'.TITLE_CREATE_DATE.'</span></a></th>';
   // $return_data['table_list_content'] .= '<th>&nbsp;</th>';
  	$return_data['table_list_content'] .= '</tr>';
	//////////////////////////////////////////////////////////
	// table content
	//////////////////////////////////////////////////////////
	$sql = "select enquiry_contact.* from ".TB_ENQUIRY_CONTACT." as enquiry_contact ";
$sql .= " where email <> ''";
$mainsql=	$sql .= $search_condition;
	//$sql .= " group by enquiry_contact.id  ";

	
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
   /*
   $return_data['table_list_content'] .= '<td  >';
   
	 $return_data['table_list_content'] .= 'Name  : '.$data['name'];
	   $return_data['table_list_content'] .= '<br>Nationality  : '.$data['nationality'];
	 
 $return_data['table_list_content'] .= '<br>Gender  : '.$data['gender'];
	 
	 
	 

	 $return_data['table_list_content'] .= '<br>Email : '.$data['email'];
	 
	 $return_data['table_list_content'] .= '<br> Phone Number : '.$data['mobile_no'];
	 
	$return_data['table_list_content'] .= '<br> Which language? : '. getLangName(TB_COUNTRY,"name",$data['country_id']);
	 
	 	$return_data['table_list_content'] .= '<br> Which Type? : '. getLangName(TB_PRODUCT_TYPE,"name",$data['product_type_id']);
	 $return_data['table_list_content'] .= '<br>How frequent per week ? : '. getLangName(TB_PRODUCT_TYPE2,"name",$data['product_type2_id']);
	 
	 $return_data['table_list_content'] .= '<br>Prefer the class taken at? : '. getLangName(TB_PRODUCT_TYPE3,"name",$data['product_type3_id']);
	 
	 $return_data['table_list_content'] .= '<br>What time to start? : '.$data['start_day']."/". $data['start_month']."/".$data['start_year'];
	 
	 
	 if($data['msg'] != ''){
	 $return_data['table_list_content'] .= '<br>Please enter any comments : ';
	$return_data['table_list_content'] .= '<br>'.nl2br($data['msg']);
	 }
	 
	 
	 
	   $return_data['table_list_content'] .= '</td>';
	   */
	   

  
  $return_data['table_list_content'] .= '<td>'.$data['name'].'</td>';

	  $return_data['table_list_content'] .= '<td>'.$data['email'].'</td>';
	  $return_data['table_list_content'] .= '<td>'.$data['mobile_no'].'</td>';

  $return_data['table_list_content'] .= '<td>'.$data['company_name'].'</td>';


  $return_data['table_list_content'] .= '<td>'.$data['position'].'</td>';

  $return_data['table_list_content'] .= '<td>'.getLangName(TB_FORM_OPTION2,"name",$data['form_option2_id']).'</td>';
  $return_data['table_list_content'] .= '<td>'.getLangName(TB_FORM_OPTION3,"name",$data['form_option3_id']).'</td>';



$out = '';

$arr_form_option1_id = explode(',',$data['form_option1_id']);
for($i=0;$i<count($arr_form_option1_id);$i++){
	if($out != ''){
		$out .='<br>';
}
$out .= getLangName(TB_FORM_OPTION1,"name",$arr_form_option1_id[$i]);

}

  $return_data['table_list_content'] .= '<td>'.$out.'</td>';





	
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