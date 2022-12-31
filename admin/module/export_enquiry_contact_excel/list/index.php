<?php 
	


	
error_reporting(E_ERROR | E_PARSE );
		date_default_timezone_set("Asia/Hong_Kong");


$Upload_Dir = "../../../files/";
// $Upload_Dir = '';
$outputFileName = $Upload_Dir."user.xls";
$outputFileName = $Upload_Dir."temp".NOW_STRING.".xls";
$displayFileName = "enquiry_list_".date('YmdHis').".xls";







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


	
		


	
		$excel->writeCol("建立日期")	;
		$excel->writeCol("姓名")	;	
		$excel->writeCol("電郵地址")	;	
		$excel->writeCol("聯絡電話")	;	
		$excel->writeCol("公司名稱")	;	
				$excel->writeCol("公司職位")	;	
		
				$excel->writeCol("目標推廣地區")	;	
		
				$excel->writeCol("公司背景")	;	
		
		
		
		$excel->writeCol("感興趣之服務")	;	
		
		
		
////////////////////////////////////////////////

$search_condition = "";

		$search = $_REQUEST['search'];
		$search_by = $_REQUEST['search_by'];
		if($search != ''){
			$search_condition .= " and ".$search_by." like '%$search%' ";
		}
	
	if($_REQUEST['search_form_option1_id'] != '-1'){
			$search_condition .= " and (form_option1_id = '".$_REQUEST['search_form_option1_id']."'  or form_option1_id like '%".$_REQUEST['search_form_option1_id'].",%' or form_option1_id like '%,".$_REQUEST['search_form_option1_id']."%'  )";
		}
		
		
		$search_condition .= " and DATE(create_date) >= '".$_REQUEST['search_create_date_from']."' and DATE(create_date)<='".$_REQUEST['search_create_date_to']."' ";
			
		

		
	$sql = "select * from ".TB_ENQUIRY_CONTACT." ";

	$sql .= " where id>0 ";

	
	$sql .= $search_condition;
	
	
	

	
	
	$sql .= " order by id desc";
		
		$rows = $G_DB_CONNECT->query($sql);
		
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					
			
////////////////////////////////////////////////
		
		$excel->writeRow();
		

		

		


		
			$excel->writeCol($data['create_date']);
	$excel->writeCol($data['name']);
$excel->writeCol($data['email']);	
$excel->writeCol($data['mobile_no']);	
	$excel->writeCol($data['company_name']);		
		$excel->writeCol($data['position']);		
				$excel->writeCol(getLangName(TB_FORM_OPTION2,"name",$data['form_option2_id'],2));		
		
			$excel->writeCol(getLangName(TB_FORM_OPTION3,"name",$data['form_option3_id'],2));		
		
	
$arr_form_option1_id = explode(',',$data['form_option1_id']);
for($i=0;$i<count($arr_form_option1_id);$i++){


	$excel->writeCol( getLangName(TB_FORM_OPTION1,"name",$arr_form_option1_id[$i],2))	;	
}
	
	
	
		
		
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