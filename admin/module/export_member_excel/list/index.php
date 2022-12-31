<?php 
	



$Upload_Dir = "../../../files/";
//$Upload_Dir = '';
$outputFileName = $Upload_Dir."user.xls";
$displayFileName = "member_list_".date('Ymdhms').".xls";




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
	


$excel->writeCol("可登入");	
$excel->writeCol("編號");
$excel->writeCol("登入名稱");	
$excel->writeCol("電郵地址");
$excel->writeCol("姓氏");
$excel->writeCol("名字");
$excel->writeCol("手提電話");
$excel->writeCol("公司/住宅電話	");
$excel->writeCol("公司名稱");
$excel->writeCol("地址 1");
$excel->writeCol("地址 2");
$excel->writeCol("地區");


//$excel->writeCol("到期日");	

$excel->writeCol("建立日期");
$excel->writeCol("修改日期");


		
		
		
		
		
		
////////////////////////////////////////////////

		
	$sql = "select member.* from ".TB_MEMBER." as member ";
	$sql .= " where ";
	$sql .= " member.role_id='4' ";
	$sql .= " and member.disabled<>'2' order by create_date desc";
		
		$rows = $G_DB_CONNECT->query($sql);
		
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					
			
////////////////////////////////////////////////
		
		$excel->writeRow();
		




		
		
		
		









$excel->writeCol(getLangName(TB_STATUS_DISABLE,"name",$data['disabled'],2));		
$excel->writeCol($data['code']);
$excel->writeCol($data['username']);
$excel->writeCol($data['email']);
$excel->writeCol($data['surname_en']);
$excel->writeCol($data['givenname_en']);
$excel->writeCol($data['mobile_no']);
$excel->writeCol($data['home_no']);
$excel->writeCol($data['company_name']);

$excel->writeCol($data['address_1']);
$excel->writeCol($data['address_2']);
$excel->writeCol(getLangName(TB_COUNTRY,"name",$data['country'],2));		
//$excel->writeCol($data['expiry_date']);		

$excel->writeCol($data['create_date']);
$excel->writeCol($data['last_update_date']);

		
		






		
		
		
		
		
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
exit;



?>