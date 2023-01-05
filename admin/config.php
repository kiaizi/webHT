<?php

	session_start();
	ini_set('max_execution_time', 60*60); //300 seconds = 5 minutes
	setlocale(LC_ALL, 'en_US.UTF-8');
	
	if(isset($_REQUEST['logout'])){
		session_destroy();
		$_SESSION['already_login'] = false;
	}
	
	//Display error
	//error_reporting(E_ALL);
	//ini_set('display_errors',TRUE);
	
	//Disable warning and error
	error_reporting(E_ERROR | E_PARSE );
	
	//error_reporting("E_ALL") ;
	
	//error_reporting(E_ALL);
	
	//error_reporting(E_ALL ^ E_DEPRECATED); 


	if (!defined('THIS_DIR')){
		define('THIS_DIR', '');
	}

	define("DIR_PATH",$this_dir_path."../");

	define("DIR_COMMON","common/");
	define("DIR_LANG","lang/");
	define("DIR_MODULE","module/");
	define("DIR_CSS","css/default/");
	define("DIR_LIB",DIR_PATH."includes/");
	define("DIR_FRONT_END",DIR_PATH);

	define('TODAY', date('Y-m-d'));
	define('NOW', date('Y-m-d h:m:s'));
	define('DATA_SEPARATOR', '###');
	
	

	define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
	$info = pathinfo($_SERVER['PHP_SELF']);
	//define('CURRENT_DOCUMENT_ROOT', DOCUMENT_ROOT.str_replace("admin","",$info['dirname'])."/");
	
	define('CURRENT_DOCUMENT_ROOT', "../");
	
	define('OUR_DOMAIN', "http://".$_SERVER['HTTP_HOST']);
	$info = pathinfo($_SERVER['PHP_SELF']);
	define('OUR_SERVER', "http://".$_SERVER['HTTP_HOST']."/");
	
	
		
	//global
	global $G_DB_CONNECT;

	
	//connect database
	include_once(DIR_LIB."config_db.php"); 
	require_once(DIR_LIB."classes/database/db.class.php"); 
	$G_DB_CONNECT = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$G_DB_CONNECT->connect(true); 
	//include_once(DIR_LIB."sms_convert_func.php"); 
	include_once(DIR_LIB."function.php"); 
	include_once(DIR_LIB."func_huatai.php"); 
	
	defineTableName(false);
	defineSystemConfig(false);
	
	
	
	////////////////////////////////////////////////////////
	// FRONT LANG
	////////////////////////////////////////////////////////
	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " default_front_lang ='1' order by sort_order asc limit 0,1";
	$data = $G_DB_CONNECT->query_first($sql);
	define('DEFAULT_FRONT_LANG_ID',  $data['id']);
	////////////////////////////////////////////////////////
	
	
	////////////////////////////////////////////////////////
	// ADMIN LANG
	////////////////////////////////////////////////////////
	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_admin_page='1'";
	$data = $G_DB_CONNECT->query_first($sql);
	define('ADMIN_LANG_ID', $data['id']);
	define('ADMIN_LANG_DIR', $data['directory']);
	define(DIR_ADMIN_LANG,DIR_LANG.ADMIN_LANG_DIR."/");
	define('CURRENT_LANG', ADMIN_LANG_ID);
	include(DIR_ADMIN_LANG."index.php");
	////////////////////////////////////////////////////////
	
	
	
	
	
	
	////////////////////////////////////////////////////////
	// get login user info
	////////////////////////////////////////////////////////
	$sql = "select m.*,role.right_level,role_desc.name as role_name from ".TB_MEMBER." as m, ".TB_ROLE." as role , ".TB_ROLE_DESC." as role_desc ";
	$sql .= " where ";
	$sql .= " m.role_id=role.id ";
	$sql .= " and role.id=role_desc.role_id ";
	$sql .= " and role_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and m.id='".$_SESSION['login_mid']."'";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					define('ADMIN_SHOP_ID', $data['shop_id']);
					define('ADMIN_ID', $data['id']);
					define('ADMIN_RIGHT_LEVEL', $data['right_level']);
					define('ADMIN_ROLE', $data['role_id']);
					define('ADMIN_ROLE_NAME', $data['role_name']);
					define('ADMIN_USERNAME', $data['username']);
			}
	}
	/*
	$username = "admin";
	$password = "mamaworld";
	loginBackEnd($username,$password);
	*/
	////////////////////////////////////////////////////////
	
	
//	echo("<script>console.warn('".ADMIN_RIGHT_LEVEL."')</script>");
	define('ALLOW_SECTION_ID_LIST', getAllowSectionIDList(ADMIN_RIGHT_LEVEL));
	
	
	
	
	
	
	
	
	
	
	
	////////////////////////////////////////////////////////
	// section
	////////////////////////////////////////////////////////
if($_REQUEST['sid'] == '-1'){
	define('P_SID', '');
	define('SID', '');
}else{
////////////////////////////////////////////////////////
	$sql = "select section.*, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
	$sql .= " where ";
	$sql .= " section.id=section_desc.section_id and section.disabled='0' ";
	$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
	
	
	
	
	if($_REQUEST['sid'] != ''){
		$sql .= " and section.id = '".$_REQUEST['sid']."' ";
	}else{
		$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
		$sql .= " and section.show_in_left_menu='1' ";
	}
	
	
	$sql .= " group by section.id  ";
	$sql .= " order by parent_section_id asc,section.sort_order asc  limit 0,1  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$this_parent_section_id = $data['parent_section_id'];
			$this_section_id = $data['id'];
			if($this_parent_section_id > 0){
				define('P_SID', $data['parent_section_id']);
				define('SID', $data['id']);
			}else{
				/////////////////////////////
				$sql = "select section.*, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
				$sql .= " where ";
				$sql .= " section.id=section_desc.section_id  and section.disabled='0' ";
				$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
				$sql .= " and section.parent_section_id = '".$this_section_id."' ";

				$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
				//$sql .= " and section.show_in_left_menu='1' ";

				$sql .= " group by section.id  ";
				$sql .= " order by section.sort_order asc limit 0,1  ";
				$rows2 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data = $G_DB_CONNECT->fetch_array($rows2)){
						
						define('P_SID', $this_section_id);
						define('SID', $data['id']);	
		
					}
				}else{
					define('P_SID', $this_section_id);
					define('SID', $this_section_id);
					
				}
				/////////////////////////////
			}
		}
	}
	
////////////////////////////////////////////////////////
				$sql = "select section.*, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
				$sql .= " where ";
				$sql .= " section.id=section_desc.section_id  and section.disabled='0' ";
				$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
				$sql .= " and section.id = '".P_SID."' ";

				$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
				//$sql .= " and section.show_in_left_menu='1' ";


				$sql .= " group by section.id  ";
				$sql .= " order by section.sort_order asc limit 0,1  ";
				$rows = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data = $G_DB_CONNECT->fetch_array($rows)){
						define('P_SECTION_NAME', $data['name']);
					}
				}
////////////////////////////////////////////////////////
				$sql = "select section.*, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
				$sql .= " where ";
				$sql .= " section.id=section_desc.section_id  and section.disabled='0' ";
				$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
				$sql .= " and section.id = '".SID."' ";


				//$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
				//$sql .= " and section.show_in_left_menu='1' ";

				$sql .= " group by section.id  ";
				$sql .= " order by section.sort_order asc limit 0,1  ";
				$rows = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data = $G_DB_CONNECT->fetch_array($rows)){
						define('SECTION_NAME', $data['name']);
					}
				}
		
////////////////////////////////////////////////////////
if($_SESSION['already_login']){
	if ( !in_array(SID, explode(",", ALLOW_SECTION_ID_LIST))   ) {
		exit("Access Denied");
	}

	}
}
	
	////////////////////////////////////////////////////////







	




	
				/////////////////////////////
				$sql = "select section.*, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
				$sql .= " where ";
				$sql .= " section.id=section_desc.section_id ";
				$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
				$sql .= " and section.id = '".SID."' ";

				//$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
				//$sql .= " and section.show_in_left_menu='1' ";

				$sql .= " group by section.id  ";
				$sql .= " order by section.sort_order asc limit 0,1  ";
				$rows2 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data = $G_DB_CONNECT->fetch_array($rows2)){
						
						define(MODULE_DIR, $data['module_dir']);
				
					}
				}else{
					
					
				}
				/////////////////////////////


//////////////////////////////////////////////////////////\
// currency
//////////////////////////////////////////////////////////
$arr_data_currency = getDefaultCurrency();

define('DEFAULT_CURRENY_ID',$arr_data_currency['id']);
define('DEFAULT_CURRENY_NAME',$arr_data_currency['name']);
//define('DEFAULT_CURRENY_SIGN',$arr_data_currency['sign']);
define('DEFAULT_CURRENY_SIGN',$arr_data_currency['name']);
define('DEFAULT_CURRENY_RATIO',$arr_data_currency['ratio']);
define('DEFAULT_CURRENY_SYMBOL',$arr_data_currency['symbol']);
//////////////////////////////////////////////////////////	





////////////////////////////////////////////////////////
	// CURRENCY
	////////////////////////////////////////////////////////
	$sql = "select currency.id,currency_desc.name as name from ".TB_CURRENCY." as currency,".TB_CURRENCY_DESC." as currency_desc ";
	$sql .= " where ";
	$sql .= " currency.id=currency_desc.currency_id ";
	$sql .= " and currency_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and currency.default_ratio='1' ";
	//$sql .= " and currency.default_ratio<>'1' LIMIT 0,1";
	$data = $G_DB_CONNECT->query_first($sql);
	define('DEFAULT_CURRENCY',  1);
	//define('DEFAULT_CURRENCY',  $data['id']);
	////////////////////////////////////////////////////////
	$_SESSION['currency'] = 1;
	if(!isset($_SESSION['currency'])){
		$_SESSION['currency'] = DEFAULT_CURRENCY;
	}
	if(isset($_REQUEST['currency'])){
		$_SESSION['currency'] = $_REQUEST['currency'];
	}
	//$_SESSION['currency'] = 1;
	define('CURRENCY',$_SESSION['currency']);
	$sql = "select currency.*,currency_desc.name as name from ".TB_CURRENCY." as currency,".TB_CURRENCY_DESC." as currency_desc ";
	$sql .= " where ";
	$sql .= " currency.id=currency_desc.currency_id ";
	$sql .= " and currency_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and currency.id='".CURRENCY."' ";
	$data = $G_DB_CONNECT->query_first($sql);
	define('CURRENCY_RATIO',  $data['ratio']);
	define('CURRENCY_SIGN',  $data['sign']);
	define('CURRENCY_SYMBOL',  $data['symbol']);
	define('CURRENCY_NAME', $data['sign']);
	//define('CURRENCY_NAME',  $data['name']);
	define('CURRENCY_PAYDOLLAR_CURRCODE',  $data['paydollar_currcode']);
	define('CURRENCY_PAYPAL_SYMBOL',  $data['symbol']);
	////////////////////////////////////////////////////////






	//switch to module from sid
	if(  is_dir(DIR_MODULE.MODULE_DIR."/")  ){
		define(DIR_THIS_MODULE,DIR_MODULE.MODULE_DIR."/");
	}else{
		define(DIR_THIS_MODULE,DIR_MODULE."blank/");
	}
/*
updateProductCountView();
returnAllItemQtyForOnlinePayment();
*/
?>
