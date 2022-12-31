<?php 
	$this_dir_path = "../../../";

	include_once($this_dir_path."config.php"); 
	include_once($this_dir_path.DIR_COMMON."global_header.php");
 	$return_data['success'] = true;
	$return_data['warn_msg'] = '';
	$return_data['sql'] = '';
	
	
	define(ACTION,getRequestVar('action','1'));


//////////////////////////////////////////////////////////
	$return_data['id'] = $update_data['id'] = getRequestVar('id','');	
	$username = $update_data['username'] = getRequestVar('username','');
	if(getRequestVar('password','') != ''){
		$update_data['password'] = md5(getRequestVar('password',''));
	}
	$code = $update_data['code'] = getRequestVar('code','');
	$update_data['role_id'] = 4;
	$update_data['givenname_en'] = getRequestVar('givenname_en','');
	$update_data['surname_en'] = getRequestVar('surname_en','');
	$update_data['home_no'] = getRequestVar('home_no','');
	$update_data['mobile_no'] = getRequestVar('mobile_no','');
	$update_data['fax'] = getRequestVar('fax','');
	$update_data['email'] = getRequestVar('email','');
	$update_data['birth'] = getRequestVar('birth','');
	$update_data['address_en'] = getRequestVar('address_en','');
	$update_data['address_chi'] = getRequestVar('address_chi','');
	$update_data['remark'] = getRequestVar('remark','');
	$update_data['disabled'] = getRequestVar('disabled','');
	$update_data['expiry_date'] = getRequestVar('expiry_date','9999-12-31');
	$update_data['gender'] = getRequestVar('gender','');

$update_data['country'] = getRequestVar('country','');
$update_data['city'] = getRequestVar('city','');
$update_data['province'] = getRequestVar('province','');
$update_data['area'] = getRequestVar('area','');
$update_data['post_code'] = getRequestVar('post_code','');
$update_data['title'] = getRequestVar('title','');


$update_data['last_update_by'] = '';
$update_data['create_by'] = '';
$update_data['last_update_by'] = '';

$update_data['address_1'] = getRequestVar('address_1','');
$update_data['address_2'] = getRequestVar('address_2','');
$update_data['address_3'] = getRequestVar('address_3','');
$update_data['newsletter'] = getRequestVar('newsletter','');
//////////////////////////////////////////////////////////
	if(ACTION == '1'){
		$sql = "select enquiry_member.* from ".TB_ENQUIRY_MEMBER." as enquiry_member ";
		$sql .= " where ";
		$sql .= "  enquiry_member.username='$username'  ";
		$sql .= " and enquiry_member.disabled<>'".DISABLED_DELETE."' ";
		$sql .= " group by enquiry_member.id  ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			$return_data['warn_msg'] = WARN_USERNAME_EXIST;
			$return_data['success'] = false;
		}else{
			$sql = "select enquiry_member.* from ".TB_ENQUIRY_MEMBER." as enquiry_member ";
			$sql .= " where ";
			$sql .= " enquiry_member.code='$code'  ";
			$sql .= " and enquiry_member.disabled<>'".DISABLED_DELETE."' ";
			$sql .= " group by enquiry_member.id  ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = WARN_CODE_EXIST;
				$return_data['success'] = false;
			}
			
		
		}
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$update_data['create_date'] = 'null';
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_ENQUIRY_MEMBER, $update_data); 
		}
		
	}
	//////////////////////////////////////////////////////////
	if(ACTION == '2'){
		$sql = "select enquiry_member.* from ".TB_ENQUIRY_MEMBER." as enquiry_member ";
		$sql .= " where ";
		$sql .= "  enquiry_member.username='$username'  and enquiry_member.id <> '".$update_data['id']."' ";
		$sql .= " and enquiry_member.disabled<>'".DISABLED_DELETE."' ";
		$sql .= " group by enquiry_member.id  ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			$return_data['warn_msg'] = WARN_USERNAME_EXIST;
			$return_data['success'] = false;
		}else{
			$sql = "select enquiry_member.* from ".TB_ENQUIRY_MEMBER." as enquiry_member ";
			$sql .= " where ";
			$sql .= " enquiry_member.code='$code'  and enquiry_member.id <> '".$update_data['id']."' ";
			$sql .= " and enquiry_member.disabled<>'".DISABLED_DELETE."' ";
			$sql .= " group by enquiry_member.id  ";
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				$return_data['warn_msg'] = WARN_CODE_EXIST;
				$return_data['success'] = false;
			}
			
		
		}
		//////////////////////////////////////////////////////////
		if($return_data['success']){
			$G_DB_CONNECT->query_update(TB_ENQUIRY_MEMBER, $update_data, "id='".$update_data['id']."'"); 
		}
		
	}
	


	
	
	//////////////////////////////////////////////////////////
	if(ACTION == '3'){
			deleteRecord(TB_ENQUIRY_MEMBER,$update_data['id'],true,'');
		
	}
	
	
	
	//////////////////////////////////////////////////////////
	
		
	
  
  
  
  
  
  
  

  
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 