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
	$username = $update_data['username'] = $update_data['email'] =getRequestVar('username','');
	if(getRequestVar('password','') != ''){
		$update_data['password'] = md5(getRequestVar('password',''));
	}
	$code = $update_data['code'] = getRequestVar('code','');
	$update_data['role_id'] = 4;
	$update_data['givenname_en'] = getRequestVar('givenname_en','');
	$update_data['surname_en'] = getRequestVar('surname_en','');
	$update_data['home_no'] = getRequestVar('home_no','');
	
	$update_data['fax'] = getRequestVar('fax','');
	//$update_data['email'] = getRequestVar('email','');
	$update_data['birth'] = getRequestVar('birth','');
	$update_data['address_en'] = getRequestVar('address_en','');
	$update_data['address_chi'] = getRequestVar('address_chi','');
	$update_data['remark'] = getRequestVar('remark','');
	$update_data['disabled'] = getRequestVar('disabled','');
	$update_data['expiry_date'] = getRequestVar('expiry_date','9999-12-31');
	$update_data['gender'] = getRequestVar('gender','');

$update_data['email'] = getRequestVar('email','');

$update_data['givenname'] = getRequestVar('givenname','');
$update_data['surname'] = getRequestVar('surname','');
$update_data['mobile_no'] = getRequestVar('mobile_no','');
$update_data['company_name'] = getRequestVar('company_name','');
$update_data['address_1'] = getRequestVar('address_1','');
$update_data['address_2'] = getRequestVar('address_2','');
$update_data['country'] = getRequestVar('country','');
$update_data['city'] = getRequestVar('city','');
$update_data['province'] = getRequestVar('province','');
$update_data['area'] = getRequestVar('area','');
$update_data['post_code'] = getRequestVar('post_code','');



$update_data['shipping_givenname'] = getRequestVar('shipping_givenname','');
$update_data['shipping_surname'] = getRequestVar('shipping_surname','');
$update_data['shipping_mobile_no'] = getRequestVar('shipping_mobile_no','');
$update_data['shipping_company_name'] = getRequestVar('shipping_company_name','');
$update_data['shipping_address_1'] = getRequestVar('shipping_address_1','');
$update_data['shipping_address_2'] = getRequestVar('shipping_address_2','');
$update_data['shipping_country'] = getRequestVar('shipping_country','');
$update_data['shipping_city'] = getRequestVar('shipping_city','');
$update_data['shipping_province'] = getRequestVar('shipping_province','');
$update_data['shipping_area'] = getRequestVar('shipping_area','');
$update_data['shipping_post_code'] = getRequestVar('shipping_post_code','');


$update_data['coin'] = getRequestVar('coin','');
$update_data['coin_end_date'] = getRequestVar('coin_end_date','');
$update_data['title'] = getRequestVar('title','');

$update_data['coin_expiry_date'] =getRequestVar('coin_expiry_date','');
$update_data['last_update_by'] = '';
$update_data['create_by'] = '';
$update_data['last_update_by'] = '';


$update_data['address_3'] = getRequestVar('address_3','');
$update_data['newsletter'] = getRequestVar('newsletter','');


$update_data['where_hear_us_other'] = getRequestVar('where_hear_us_other','');

$arr_where_hear_us_id = getRequestVar('where_hear_us_id','');
$where_hear_us_id  = '';
for($i=0;$i<count($arr_where_hear_us_id);$i++){
	if($where_hear_us_id  != ''){
		$where_hear_us_id  .=',';
	}
	$where_hear_us_id  .= $arr_where_hear_us_id[$i];
}


$update_data['where_hear_us_id'] = $where_hear_us_id;

$update_data['member_category_id'] = getRequestVar('member_category_id','');


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
			$update_data['coin_expiry_date'] =addDate(TODAY,'+1 year');
			$return_data['id'] = $update_data['id'] = $G_DB_CONNECT->query_insert(TB_MEMBER, $update_data); 
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
	
		
	
  
  
  
  
  
  
  

  clearMemberBonus();
  
  
  	$myjson = my_json_encode($return_data);
  	echo $myjson;
	
generateHTACCESS();

$G_DB_CONNECT->close();




?> 