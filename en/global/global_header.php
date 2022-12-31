<?php
error_reporting(E_ERROR | E_PARSE); 


// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);


session_set_cookie_params(0, '/', null, true, true); 

		//header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
//header( 'Set-Cookie: name=value; HttpOnly' );
	 if(!isset($_SESSION)) 
    { 
        	session_start();
    } 
	header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
	
	setlocale(LC_ALL, 'en_US.UTF-8');
	
	
	if(isset($_REQUEST['logout'])){
		session_destroy();
		$_SESSION['falready_login'] = false;
		$_SESSION['prompt_msg'] = '';
	}
	
	
	
define('GLOBAL_MAX_QTY', 10);

	
	
	//Display error
	//error_reporting(E_ALL);
	//ini_set('display_errors',TRUE);
	
	//Disable warning and error
	//error_reporting(E_ERROR | E_PARSE); 
	error_reporting(E_ERROR | E_PARSE); 
	
	
define('OUR_DOMAIN', "https://".$_SERVER['HTTP_HOST']);
$info = pathinfo($_SERVER['PHP_SELF']);
//define('OUR_SERVER', "http://".$_SERVER['HTTP_HOST']."/".$info['dirname']."/");
define('OUR_SERVER', "https://".str_replace("//","/",$_SERVER['HTTP_HOST'].$info['dirname']."/"));
//define('OUR_SERVER', "http://".$_SERVER['HTTP_HOST']."/");
	


	if (!defined('THIS_DIR')){
		define('THIS_DIR', '');
	}

	define("DIR_PATH","../");
	define("DIR_LIB",DIR_PATH."includes/");





	////////////////////////////////////////////////////////
	//connect database
	////////////////////////////////////////////////////////
	include_once(DIR_LIB."config_db.php"); 
	require_once(DIR_LIB."classes/database/db.class.php"); 
	$G_DB_CONNECT = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$G_DB_CONNECT->connect(true); 
	include_once(DIR_LIB."function.php"); 
	include_once(DIR_LIB."func_huatai.php"); 
	
	defineTableName(false);
	defineSystemConfig(false);

	

	

foreach($_POST as $key => $value) {
if(!is_array($value)){
	 $_POST[$key] = filter($value);
}
 
 

}

foreach($_GET as $key => $value) {
if(!is_array($value)){
  $_GET[$key] = filter($value);
}
}

foreach($_REQUEST as $key => $value) {
if(!is_array($value)){
  $_REQUEST[$key] = filter($value);
}
}


	
	
	////////////////////////////////////////////////////////
	// FRONT LANG
	////////////////////////////////////////////////////////
	$sql = "select language.id from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " default_front_lang ='1' order by sort_order asc limit 0,1";
	$data = $G_DB_CONNECT->query_first($sql);
	define('DEFAULT_LANG',  3);
	////////////////////////////////////////////////////////
$_SESSION['lang'] = 1;
	if(!isset($_SESSION['lang'])){
		$_SESSION['lang'] = DEFAULT_LANG;
	}
	if(isset($_REQUEST['lang'])){
		$_SESSION['lang'] = $_REQUEST['lang'];
	}
	

	
	
	define('CURRENT_LANG',$_SESSION['lang']);
	define('ADMIN_LANG_ID',$_SESSION['lang']);
	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " id='".CURRENT_LANG."'";
	$data = $G_DB_CONNECT->query_first($sql);
	define('CURRENT_LANG_DIR',  $data['directory']);
//	include(CURRENT_LANG_DIR."/lang.php");
	////////////////////////////////////////////////////////
	



		
	if($_REQUEST['type'] != ''){
		$_REQUEST['type'] = intval($_REQUEST['type']);
	}
	if($_REQUEST['cid'] != ''){
		$_REQUEST['cid'] = intval($_REQUEST['cid']);
	}
	if($_REQUEST['id'] != ''){
		$_REQUEST['id'] = intval($_REQUEST['id']);
	}
	
	if($_REQUEST['link'] != ''){
		$_REQUEST['link'] = intval($_REQUEST['link']);
	}
	


	$query_string =  urldecode($_SERVER['QUERY_STRING']);

$findme   = '<script>';
$pos = strpos($query_string, $findme);
if ($pos === false) {

} else {
header("location:/"); 
exit();
}


$findme   = 'mouseover';
$pos = strpos($query_string, $findme);
if ($pos === false) {

} else {
header("location:/"); 
exit();
}





?>