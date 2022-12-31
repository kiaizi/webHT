<?php 
	
error_reporting(E_ERROR | E_PARSE );
		date_default_timezone_set("Asia/Hong_Kong");


	
error_reporting(E_ERROR | E_PARSE );
		date_default_timezone_set("Asia/Hong_Kong");


$Upload_Dir = "../../../files/";
// $Upload_Dir = '';
$outputFileName = $Upload_Dir."user.xls";
$outputFileName = $Upload_Dir."temp".NOW_STRING.".xls";
$displayFileName = "enquiry_treatment_list_".date('YmdHis').".xls";




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


		
		$excel->writeCol("參考號碼")	;	
		
	

		$excel->writeCol("姓名")	;	
		$excel->writeCol("年齡")	;	
		$excel->writeCol("性別")	;	
		$excel->writeCol("聯絡電話")	;	
		$excel->writeCol("電郵地址")	;	
		$excel->writeCol("現有皮膚問題")	;	
		$excel->writeCol("療程")	;	
		
		$excel->writeCol("療程地點")	;	
		$excel->writeCol("訊息")	;	
		$excel->writeCol("付款方法")	;	
				$excel->writeCol("PayPal收據號碼")	;	
		$excel->writeCol("付款狀態")	;	
		$excel->writeCol("接收推廣資訊")	;	
		$excel->writeCol("建立日期")	;
		
		
		
		
		
////////////////////////////////////////////////

$search_condition = "";

		$search = $_REQUEST['search'];
		$search_by = $_REQUEST['search_by'];
		if($search != ''){
			$search_condition .= " and ".$search_by." like '%$search%' ";
		}
			if($_REQUEST['search_payment_status_id'] != '-1'){
			$search_condition .= " and payment_status_id = '".$_REQUEST['search_payment_status_id']."' ";
		}
		
		$search_condition .= " and DATE(create_date) >= '".$_REQUEST['search_create_date_from']."' and DATE(create_date)<='".$_REQUEST['search_create_date_to']."' ";
			
		

		
	$sql = "select * from ".TB_ENQUIRY." ";

	$sql .= " where id>0 ";

	
	$sql .= $search_condition;
	
	
	

	
	
	$sql .= " order by id desc";
		
		$rows = $G_DB_CONNECT->query($sql);
		
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					
			
////////////////////////////////////////////////
		
		$excel->writeRow();
		

		

		
				

	$excel->writeCol($data['code']);	


	
$newsletter = '否';
if($data['newsletter'] == 1){
		
$newsletter = '是';
}
		
		
$excel->writeCol($data['name']);	
$excel->writeCol($data['age']);

$excel->writeCol($data['gender']);	
$excel->writeCol($data['mobile_no']);	
$excel->writeCol($data['email']);	

$excel->writeCol(getLangName(TB_FORM_OPTION1,"name",$data['form_option1_id'],2));	
$excel->writeCol(getLangName(TB_FORM_OPTION2,"name",$data['form_option2_id'],2));	
$excel->writeCol(getLangName(TB_FORM_OPTION3,"name",$data['form_option3_id'],2));	
$excel->writeCol($data['msg']);
$excel->writeCol(getLangName(TB_PAYMENT_METHOD,"name",$data['payment_method_id'],2));	
		$excel->writeCol($data['paypal_refno']);	
$excel->writeCol(getLangName(TB_PAYMENT_STATUS,"name",$data['payment_status_id'],2));	
$excel->writeCol($newsletter);	
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