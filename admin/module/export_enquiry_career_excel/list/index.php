<?php 
	


	
error_reporting(E_ERROR | E_PARSE );
		date_default_timezone_set("Asia/Hong_Kong");


$Upload_Dir = "../../../files/";
// $Upload_Dir = '';
$outputFileName = $Upload_Dir."user.xls";
$outputFileName = $Upload_Dir."temp".NOW_STRING.".xls";
$displayFileName = "career_list_".date('YmdHis').".xls";







header('HTTP/1.1 200 OK');
header('Status: 200 OK');
header('Accept-Ranges: bytes');
header('Content-Transfer-Encoding: Binary');
header('Content-Type: application/force-download');
header("Content-Disposition: attachment; filename=\"" . basename($displayFileName) . "\"");



	
	//
	
	$this_dir_path = "../../../";
	
	if (!defined('THIS_DIR')){
		define('THIS_DIR', '');
	}

	define("DIR_PATH",$this_dir_path."../");

	define("DIR_COMMON","common/");
	define("DIR_LANG","language/");
	define("DIR_MODULE","module/");
	define("DIR_CSS","css/default/");
	define("DIR_LIB",DIR_PATH."includes/");

	define('TODAY', date('Y-m-d'));
	define('NOW', date('Y-m-d h:m:s'));
	define('DATA_SEPARATOR', '###');
	
	


	

	//global
	global $G_DB_CONNECT;

	
	//connect database
	include_once(DIR_LIB."config_db.php"); 
	require_once(DIR_LIB."classes/database/db.class.php"); 
	
	$G_DB_CONNECT = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$G_DB_CONNECT->connect(true); 
		
	include_once(DIR_LIB."function.php"); 
	defineTableName(false);
	defineSystemConfig(false);
	
	
	
	
	//include_once("config.php"); 
	//include_once(DIR_COMMON."global_header.php");

	require_once(DIR_LIB."classes/excel/writer/excelwriter.inc.php");
	
	
	//$outputFileName = "memberInfo.xls";
	
	$excel=new ExcelWriter($outputFileName);
	
	if($excel==false)	{
		echo $excel->error;
	}else{
		
		
		$excel->writeRow();
	
		//$excel->writeCol("Name");


	
		


		$excel->writeCol("姓名")	;	

		$excel->writeCol("聯絡電話")	;	
		$excel->writeCol("申請職位")	;	

		
		$excel->writeCol("履歷表")	;	
		$excel->writeCol("建立日期")	;
		
			define('OUR_SERVER', "http://".$_SERVER['HTTP_HOST']."/");
	
		$our_server = OUR_SERVER;
$our_server = str_replace("/admin/module/export_enquiry_career_excel/list/","",$our_server);			
$our_server = $our_server.REWRITE_BASE."/";
		
		
////////////////////////////////////////////////

$search_condition = "";

		$search = $_REQUEST['search'];
		$search_by = $_REQUEST['search_by'];
		if($search != ''){
			$search_condition .= " and ".$search_by." like '%$search%' ";
		}
	
		
		$search_condition .= " and DATE(create_date) >= '".$_REQUEST['search_create_date_from']."' and DATE(create_date)<='".$_REQUEST['search_create_date_to']."' ";
			
		

		
	$sql = "select * from ".TB_ENQUIRY_CAREER." ";

	$sql .= " where id>0 ";

	
	$sql .= $search_condition;
	
	
	

	
	
	$sql .= " order by id desc";
		
		$rows = $G_DB_CONNECT->query($sql);
		
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					
			
////////////////////////////////////////////////
		
		$excel->writeRow();
		

		


		
		
$excel->writeCol($data['name']);	

$excel->writeCol($data['mobile_no']);	





$excel->writeCol(getLangName(TB_CAREER,"name",$data['career_id'],2));	


$excel->writeCol($our_server.$data['submit_file1']);
		
$excel->writeCol($data['create_date']);
		
		
		
////////////////////////////////////////////////



			}//while
		}//if
















	
	}
	
	///////////////////////////////////////////////////////////////
	
	$excel->close();
	

////////////////////////////////////
// output the excel for download
////////////////////////////////////


readfile($outputFileName);
unlink($outputFileName);
exit;


?>