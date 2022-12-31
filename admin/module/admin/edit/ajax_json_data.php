<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = true;
	$return_data['warn_msg'] = '';
	$return_data['sql'] = '';
	
	
	define(ACTION,getRequestVar('action','1'));
$our_server = OUR_SERVER;
$our_server = str_replace("/module/investor/edit/","",$our_server);			
$our_server = $our_server;





//////////////////////////////////////////////////////////
	$return_data['id'] = $update_data['id'] = getRequestVar('id','');	
	
	$sql = "select * from ".TB_MEMBER;
$sql .= " where id='".$return_data['id']."' ";
$edit_data = $G_DB_CONNECT->query_first($sql);	
	


	
	
	
$email =	$username = $update_data['username'] = $update_data['email'] =getRequestVar('username','');
	if(getRequestVar('password','') != ''){
		$update_data['password'] = md5(getRequestVar('password',''));
		$edit_data['bk_pwd'] =$update_data['bk_pwd'] = getRequestVar('password','');
	}
	
	
	
	
	$code = $update_data['code'] = getRequestVar('code','');
	$update_data['role_id'] = getRequestVar('role_id','');
	$update_data['givenname_en'] = getRequestVar('givenname_en','');
	$update_data['surname_en'] = getRequestVar('surname_en','');
	$update_data['home_no'] = getRequestVar('home_no','');
	
	$update_data['fax'] = getRequestVar('fax','');
	//$update_data['email'] = getRequestVar('email','');
	$update_data['birth'] = getRequestVar('birth','');

	$update_data['remark'] = getRequestVar('remark','');
	$update_data['disabled'] = getRequestVar('disabled','');
	$update_data['expiry_date'] = getRequestVar('expiry_date','9999-12-31');
	$update_data['gender'] = getRequestVar('gender','');






$email = $update_data['username'] ;
$name = $update_data['givenname_en']." ".$update_data['surname_en'];



$update_data['create_by'] = '';
$update_data['last_update_by'] = '';

//////////////////////////////////////////////////////////
	if(ACTION == '1'){
		$sql = "select member.* from ".TB_MEMBER." as member ";
		$sql .= " where ";
		$sql .= "  member.username='$username'  ";
		$sql .= " and member.disabled<>'".DISABLED_DELETE."' ";
		$sql .= " group by member.id  ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			$return_data['warn_msg'] = WARN_USERNAME_EXIST;
			$return_data['success'] = false;
		}else{
			$sql = "select member.* from ".TB_MEMBER." as member ";
			$sql .= " where ";
			$sql .= " member.code='$code'  ";
			$sql .= " and member.disabled<>'".DISABLED_DELETE."' ";
			$sql .= " group by member.id  ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = WARN_CODE_EXIST;
				$return_data['success'] = false;
			}
			
		
		}
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			
			
$activation_code = $update_data['activation_code'] = generateCode();


			
			
		$member_id=	$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_MEMBER, $update_data); 
			
			

			
			
			
//////////////////////////////////////////////////////////			
			
			
			
			
			
			
			
			
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
		$sql = "select member.* from ".TB_MEMBER." as member ";
		$sql .= " where ";
		$sql .= "  member.username='$username'  and member.id <> '".$update_data['id']."' ";
		$sql .= " and member.disabled<>'".DISABLED_DELETE."' ";
		$sql .= " group by member.id  ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			$return_data['warn_msg'] = WARN_USERNAME_EXIST;
			$return_data['success'] = false;
		}else{
			$sql = "select member.* from ".TB_MEMBER." as member ";
			$sql .= " where ";
			$sql .= " member.code='$code'  and member.id <> '".$update_data['id']."' ";
			$sql .= " and member.disabled<>'".DISABLED_DELETE."' ";
			$sql .= " group by member.id  ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = WARN_CODE_EXIST;
				$return_data['success'] = false;
			}
			
		
		}
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_MEMBER, $update_data, "id='".$update_data['id']."'"); 
		}
		
	}
	
	
	
	
	
	



	
	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_MEMBER,$update_data['id'],true,'');
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//////////////////////////////////////////////////////////
	


	
	if(ACTION == '1'){
		if($return_data['success']  ){
		
		$name = $update_data['contact_person'];
		$email_title = 'Your account info for Haitian Logistics';
		$link = $our_server.'/admin';
		

		
		//sendEmail(ENQUIRY_FORM_EMAIL_TO,ENQUIRY_FORM_EMAIL_TO_NAME,$email,$name,$email_title,$html,'../../../../');
		//$return_data['success'] = false;
		//$return_data['warn_msg'] = $html;
		}
	}
	
	
	//////////////////////////////////////////////////////////
	
		
	
  
  
  
  
  
  
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 