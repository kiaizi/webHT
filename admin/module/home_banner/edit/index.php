<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");

	define(ID,$_REQUEST['id']);
	

	$sql = "select * from ".TB_HOME_BANNER." as home_banner ";
	$sql .= " where ";
	$sql .= " id='".ID."' ";
	$sql .= " and disabled <>'".DISABLED_DELETE."' ";
	$edit_data = $G_DB_CONNECT->query_first($sql);
	
	
	if(ID > 0 && $edit_data['id'] == ''){
		exit(WARN_ACCESS_DENIED);
	}



/////////////////////////////////////////////
// upload file
/////////////////////////////////////////////
$arr_home_banner_photo_language_id = getRequestVar("home_banner_photo_language_id",'');
$arr_home_banner_photo_sort_order = getRequestVar("home_banner_photo_sort_order",'');
$arr_home_banner_photo_disabled = getRequestVar("home_banner_photo_disabled",'');
$arr_home_banner_photo_img_old_path = getRequestVar("home_banner_photo_img_old_path",'');
$arr_home_banner_photo_img_m_old_path = getRequestVar("home_banner_photo_img_m_old_path",'');
$arr_home_banner_photo_img2_old_path = getRequestVar("home_banner_photo_img2_old_path",'');
$arr_home_banner_photo_img3_old_path = getRequestVar("home_banner_photo_img3_old_path",'');
if($arr_home_banner_photo_disabled != '' && ID > 0){

	$home_banner_id = ID;
	//$home_banner_code = getDataName(TB_HOME_BANNER,"code",$home_banner_id);
	$sql = "delete from ".TB_HOME_BANNER_PHOTO." where home_banner_id='".$home_banner_id."'";
	$G_DB_CONNECT->query($sql);

	for ($i=0; $i<count($arr_home_banner_photo_disabled); $i++) {

		$home_banner_photo_img_old_path = $arr_home_banner_photo_img_old_path[$i];

		$dir = "upload/images/home_banner/";
		$file_name = "home_banner_photo_img";
		////////////////////////////////////////////////
		$tempFile = $_FILES[$file_name]['tmp_name'][$i];
		if($tempFile != ''){
			$targetPath = CURRENT_DOCUMENT_ROOT . $dir ;
			$ext = get_extension($_FILES[$file_name]['name'][$i]);
			//$new_file_name = $home_banner_code."_".date("YmdHis")."_".getLastID(TB_HOME_BANNER_PHOTO).$ext;
			$new_file_name = date("YmdHis")."_".getLastID(TB_HOME_BANNER_PHOTO).$ext;
  			$targetFile =  str_replace('//','/',$targetPath) .$new_file_name ;
			move_uploaded_file($tempFile,$targetFile);
			$targetFile =$dir.$new_file_name;
			////////////////////////////////////////////////
			
			$home_banner_photo_img_old_path = $targetFile;
		
			smart_resize_image( "../".$targetFile,"thumb", 5000, 950, true);
			smart_resize_image( "../".$targetFile,"img", 5000, 950, true);

		
		}
		
		
		
		
		if($home_banner_photo_img_old_path != ''){
			////////////////////////////////////////////////
			$update_home_banner_photo_data = array();
			$update_home_banner_photo_data['language_id'] = $arr_home_banner_photo_language_id[$i];
			$update_home_banner_photo_data['img'] = $home_banner_photo_img_old_path;
	
			//$update_home_banner_photo_data['home_banner_color_id'] = $arr_home_banner_photo_home_banner_color_id[$i];
			$update_home_banner_photo_data['sort_order'] = $arr_home_banner_photo_sort_order[$i];
			$update_home_banner_photo_data['disabled'] = $arr_home_banner_photo_disabled[$i];
			$update_home_banner_photo_data['home_banner_id'] = $home_banner_id;
			$update_home_banner_photo_data['create_date'] = 'null';
			$update_home_banner_photo_data['create_by'] = '';
			$update_home_banner_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_HOME_BANNER_PHOTO, $update_home_banner_photo_data);
			////////////////////////////////////////////////
	
		}
	
	}
}



//renewSortOrder(TB_HOME_BANNER_PHOTO,"home_banner_id='".ID."'");
/////////////////////////////////////////////
	
	
	
	
	
	
	
	
	/////////////////////////////////////////////
// upload file
/////////////////////////////////////////////
$arr_home_banner_photo02_language_id = getRequestVar("home_banner_photo02_language_id",'');
$arr_home_banner_photo02_sort_order = getRequestVar("home_banner_photo02_sort_order",'');
$arr_home_banner_photo02_disabled = getRequestVar("home_banner_photo02_disabled",'');
$arr_home_banner_photo02_img_old_path = getRequestVar("home_banner_photo02_img_old_path",'');
$arr_home_banner_photo02_img_m_old_path = getRequestVar("home_banner_photo02_img_m_old_path",'');
$arr_home_banner_photo02_img2_old_path = getRequestVar("home_banner_photo02_img2_old_path",'');
$arr_home_banner_photo02_img3_old_path = getRequestVar("home_banner_photo02_img3_old_path",'');
if($arr_home_banner_photo02_disabled != '' && ID > 0){

	$home_banner_id = ID;
	//$home_banner_code = getDataName(TB_HOME_BANNER,"code",$home_banner_id);
	$sql = "delete from ".TB_HOME_BANNER_PHOTO02." where home_banner_id='".$home_banner_id."'";
	$G_DB_CONNECT->query($sql);

	for ($i=0; $i<count($arr_home_banner_photo02_disabled); $i++) {

		$home_banner_photo02_img_old_path = $arr_home_banner_photo02_img_old_path[$i];

		$dir = "upload/images/home_banner/";
		$file_name = "home_banner_photo02_img";
		////////////////////////////////////////////////
		$tempFile = $_FILES[$file_name]['tmp_name'][$i];
		if($tempFile != ''){
			$targetPath = CURRENT_DOCUMENT_ROOT . $dir ;
			$ext = get_extension($_FILES[$file_name]['name'][$i]);
			//$new_file_name = $home_banner_code."_".date("YmdHis")."_".getLastID(TB_HOME_BANNER_PHOTO02).$ext;
			$new_file_name = date("YmdHis")."_".getLastID(TB_HOME_BANNER_PHOTO02).'_img'.$ext;
  			$targetFile =  str_replace('//','/',$targetPath) .$new_file_name ;
			move_uploaded_file($tempFile,$targetFile);
			$targetFile =$dir.$new_file_name;
			////////////////////////////////////////////////
			
			$home_banner_photo02_img_old_path = $targetFile;
		
			smart_resize_image( "../".$targetFile,"thumb", 5000, 1000, true);
			smart_resize_image( "../".$targetFile,"img", 5000, 1000, true);

		
		}
		
		
		
		if($home_banner_photo02_img_old_path != ''){
			////////////////////////////////////////////////
			$update_home_banner_photo02_data = array();
			$update_home_banner_photo02_data['language_id'] = $arr_home_banner_photo02_language_id[$i];
			$update_home_banner_photo02_data['img'] = $home_banner_photo02_img_old_path;
	
			//$update_home_banner_photo02_data['home_banner_color_id'] = $arr_home_banner_photo02_home_banner_color_id[$i];
			$update_home_banner_photo02_data['sort_order'] = $arr_home_banner_photo02_sort_order[$i];
			$update_home_banner_photo02_data['disabled'] = $arr_home_banner_photo02_disabled[$i];
			$update_home_banner_photo02_data['home_banner_id'] = $home_banner_id;
			$update_home_banner_photo02_data['create_date'] = 'null';
			$update_home_banner_photo02_data['create_by'] = '';
			$update_home_banner_photo02_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_HOME_BANNER_PHOTO02, $update_home_banner_photo02_data);
			////////////////////////////////////////////////
	
		}
	
	}
}





//renewSortOrder(TB_HOME_BANNER_PHOTO02,"home_banner_id='".ID."'");
/////////////////////////////////////////////
		/////////////////////////////////////////////
// upload file
/////////////////////////////////////////////
$arr_home_banner_photo03_language_id = getRequestVar("home_banner_photo03_language_id",'');
$arr_home_banner_photo03_sort_order = getRequestVar("home_banner_photo03_sort_order",'');
$arr_home_banner_photo03_disabled = getRequestVar("home_banner_photo03_disabled",'');
$arr_home_banner_photo03_img_old_path = getRequestVar("home_banner_photo03_img_old_path",'');
$arr_home_banner_photo03_img_m_old_path = getRequestVar("home_banner_photo03_img_m_old_path",'');
$arr_home_banner_photo03_img2_old_path = getRequestVar("home_banner_photo03_img2_old_path",'');
$arr_home_banner_photo03_img3_old_path = getRequestVar("home_banner_photo03_img3_old_path",'');
if($arr_home_banner_photo03_disabled != '' && ID > 0){

	$home_banner_id = ID;
	//$home_banner_code = getDataName(TB_HOME_BANNER,"code",$home_banner_id);
	$sql = "delete from ".TB_HOME_BANNER_PHOTO03." where home_banner_id='".$home_banner_id."'";
	$G_DB_CONNECT->query($sql);

	for ($i=0; $i<count($arr_home_banner_photo03_disabled); $i++) {

		$home_banner_photo03_img_old_path = $arr_home_banner_photo03_img_old_path[$i];

		$dir = "upload/files/home_banner/";
		$file_name = "home_banner_photo03_img";
		////////////////////////////////////////////////
		$tempFile = $_FILES[$file_name]['tmp_name'][$i];
		if($tempFile != ''){
			$targetPath = CURRENT_DOCUMENT_ROOT . $dir ;
			$ext = get_extension($_FILES[$file_name]['name'][$i]);
			//$new_file_name = $home_banner_code."_".date("YmdHis")."_".getLastID(TB_HOME_BANNER_PHOTO03).$ext;
			$new_file_name = date("YmdHis")."_".getLastID(TB_HOME_BANNER_PHOTO03).'_img'.$ext;
  			$targetFile =  str_replace('//','/',$targetPath) .$new_file_name ;
			move_uploaded_file($tempFile,$targetFile);
			$targetFile =$dir.$new_file_name;
			////////////////////////////////////////////////
			
			$home_banner_photo03_img_old_path = $targetFile;
		
			//smart_resize_image( "../".$targetFile,"thumb", 5000, 1000, true);
			//smart_resize_image( "../".$targetFile,"img", 5000, 1000, true);

		
		}
		
		
		
		if($home_banner_photo03_img_old_path != ''){
			////////////////////////////////////////////////
			$update_home_banner_photo03_data = array();
			$update_home_banner_photo03_data['language_id'] = $arr_home_banner_photo03_language_id[$i];
			$update_home_banner_photo03_data['img'] = $home_banner_photo03_img_old_path;
	
			//$update_home_banner_photo03_data['home_banner_color_id'] = $arr_home_banner_photo03_home_banner_color_id[$i];
			$update_home_banner_photo03_data['sort_order'] = $arr_home_banner_photo03_sort_order[$i];
			$update_home_banner_photo03_data['disabled'] = $arr_home_banner_photo03_disabled[$i];
			$update_home_banner_photo03_data['home_banner_id'] = $home_banner_id;
			$update_home_banner_photo03_data['create_date'] = 'null';
			$update_home_banner_photo03_data['create_by'] = '';
			$update_home_banner_photo03_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_HOME_BANNER_PHOTO03, $update_home_banner_photo03_data);
			////////////////////////////////////////////////
	
		}
	
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(DIR_COMMON."meta_header.php");?>
<script type="text/javascript" src="<?php echo DIR_THIS_MODULE_ACTION;?>main.js?v=22"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/fckeditor/fckeditor.js?v=<?php echo date('Ymdhis')?>"></script>
</head>
<body>
<div id="container">
<?php include(DIR_COMMON."header.php");?>
<div id="main_content_container">
<div id="inside_content">
<!-- table_layout (start) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_layout">
  <tr>
    <td id="panel_left_menu"><?php include(DIR_COMMON."leftmenu.php");?></td>   
	<td  id="panel_content">
	
    
    
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_section" >
<tr>
<td><?php include(DIR_COMMON."mainnav.php");?></td>
<td>&nbsp;</td>
</tr>
</table>







<!-- edit table (start) -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_edit">
  <tr>
  	<th><?php echo ACTION_NAME; ?> <?php echo DATA_NAME; ?></th>
   </tr>
   <tr>
   <td  id="warn_msg">&nbsp;</td>
   </tr>
   <tr>
   <td>
   
<?php

/*
$_REQUEST["name_2"] = "aaaaaa";

$update_data['id'] = 1;
$update_data_lang['name'] = 'a';	
$update_data_lang['detail'] = 'b';	
echo $G_DB_CONNECT->query_update_lang_content(TB_HOME_BANNER, $update_data_lang, "  home_banner_id='".$update_data['id']."'   ");
*/


?>




<?php include(DIR_COMMON."loading.php");?>
<!-- main_content_area (start) -->
<div id="main_content_area">
<form name="frm_this_page"  id="frm_this_page" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>"  target="_self" autocomplete="off">
<input name="id" id="id" value="<?php echo $_REQUEST['id']; ?>" type="hidden"/>
<input name="sid" id="sid" value="<?php echo SID; ?>" type="hidden"/>
<input name="action" id="action" value="<?php echo ACTION; ?>" type="hidden"/>


<input name="ajax_json_path" id="ajax_json_path" value="<?php echo DIR_THIS_MODULE_ACTION."ajax_json_data.php"; ?>" type="hidden"/>
<input name="WARN_CHANGE_PASSWORD_FAILURE" id="WARN_CHANGE_PASSWORD_FAILURE" value="<?php echo WARN_CHANGE_PASSWORD_FAILURE;?>" type="hidden"/>

<input name="show_confirm_page" id="show_confirm_page" value="<?php echo $_REQUEST['show_confirm_page'] ;?>" type="hidden"/>
<?php
	if($_REQUEST['show_confirm_page'] == ''){
		
?>








<table border="0" cellspacing="0" cellpadding="0" id="table_form" class="table_seo">







<tr class="seo_row">
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_SEO_URL;?></td>
    <td>
    <input name="seo_url" id="seo_url"  value="<?php echo $edit_data['seo_url'] ?>" label="<?php echo TITLE_SEO_URL; ?>" class="input_seo_url" />
    <?php echo TITLE_SEO_URL_HINT; ?>
    </td>
</tr>

<tr class="seo_row">
	<td class="sign_must_enter"></td>
	<td class="title" style="vertical-align:top"><?php echo TITLE_SEO_KEYWORD;?></td>
    <td style="vertical-align:top;">

<textarea  name="seo_keyword" id="seo_keyword"  label="<?php echo TITLE_SEO_KEYWORD; ?>"    class="seo_keyword"/><?php echo $edit_data['seo_keyword'] ?></textarea>

<?php echo TITLE_SEO_KEYWORD_HINT; ?>

    </td>
</tr>





<?php
printLangInputField(TITLE_SEO_TITLE,"seo_title",TB_HOME_BANNER,$edit_data['id'],"seo_title",false,"input_seo_title","",false,'class="seo_row"');
			
			
?>
   
   
   

<?php
printLangTextAreaNormal(TITLE_SEO_DESC,"seo_desc",TB_HOME_BANNER,$edit_data['id'],false,300,450,'','class="seo_row"');
?>



</table>  





<div style="clear:both"></div>




<table border="0" cellspacing="0" cellpadding="0" id="table_form">






	<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title"></td>
    
    <td><a href="#" class="button btn_edit_seo"><span><?php echo BTN_EDIT_SEO;?></span></a></td>
    </tr>


	<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title"></td>
    
    <td></td>
    </tr>







<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_DISABLED; ?></td>
    
    <td>
        
<?php
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				

	printCustomMenu('disabled', $sql,'name','0',$edit_data['disabled'],'','','','');
?>
    
    </td>
    
</tr>












	<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_SORT_ORDER; ?></td>
    <td>
    
    
    <?php
		if(ACTION == '1'){
			$edit_data['sort_order'] = getNextSortOrder(TB_HOME_BANNER,"");
		}
	?>
    
    <input name="sort_order" id="sort_order"  value="<?php echo $edit_data['sort_order'] ?>" label="<?php echo TITLE_SORT_ORDER; ?>" class="numeric input_middle" required="yes"/>
    
    
    </td>
    
</tr>








<?php
//printLangInputField(TITLE_TITLE,"name",TB_HOME_BANNER,$edit_data['id'],"name",true);
	//printLangInputField(TITLE_SUBTITLE,"brief",TB_HOME_BANNER,$edit_data['id'],"brief",false);
			
?>











        



 <?php //echo printLangTextArea(TITLE_CONTENT_IF_NO_LINK,"detail",TB_HOME_BANNER,$edit_data['id'],false,1000,630); ?>  

   
<?php
 printLangTextAreaNormal(TITLE_TITLE,"name",TB_HOME_BANNER,$edit_data['id'],false,50,510,"");
 
printLangTextAreaNormal(TITLE_DESC,"detail",TB_HOME_BANNER,$edit_data['id'],false,50,510,"");
 
 
?>


    <?php
printLangInputField('了解更多連結',"url",TB_HOME_BANNER,$edit_data['id'],"url",false);
			
			
?> 
<tr>
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">了解更多連結<?php echo TITLE_URL_TARGET; ?></td>
    
    <td>
        
<?php
$sql = "select url_target.*, url_target_desc.name as name from ".TB_URL_TARGET." as url_target , ".TB_URL_TARGET_DESC." as url_target_desc ";
	$sql .= " where ";
	$sql .= " url_target.id=url_target_desc.url_target_id ";
	$sql .= " and url_target_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by url_target.id  ";
	$sql .= " order by url_target.sort_order asc ";
				

	printCustomMenu('url_target', $sql,'name','1',$edit_data['url_target'],'','','','');
?>
    
    </td>
    
</tr>



    <?php
printLangInputField('網上開戶連結',"url2",TB_HOME_BANNER,$edit_data['id'],"url2",false);
			
			
?> 
<tr>
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">網上開戶連結<?php echo TITLE_URL_TARGET; ?></td>
    
    <td>
        
<?php
$sql = "select url_target.*, url_target_desc.name as name from ".TB_URL_TARGET." as url_target , ".TB_URL_TARGET_DESC." as url_target_desc ";
	$sql .= " where ";
	$sql .= " url_target.id=url_target_desc.url_target_id ";
	$sql .= " and url_target_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by url_target.id  ";
	$sql .= " order by url_target.sort_order asc ";
				

	printCustomMenu('url_target2', $sql,'name','1',$edit_data['url_target2'],'','','','');
?>
    
    </td>
    
</tr>






<?php
 //printLangTextAreaNormal(TITLE_ADDRESS,"address",TB_HOME_BANNER,$edit_data['id'],false,150,500,"");
?>




<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title vtop"><?php echo TITLE_REMARK; ?></td>
    <td><textarea  name="remark" id="remark"  label="<?php echo TITLE_REMARK; ?>"    class="input_middle"/><?php echo $edit_data['remark'] ?></textarea></td>
    
</tr>





























<tr>
	<td class="sign_must_enter"></td>
	<td class="title vtop"  style="padding-top:12px;"><?php echo TITLE_IMG;?> (Desktop)</td>
<td style="padding-top:0px;">

<div class="notice_msg"   style="display:none" ><?PHP echo NOTICE_SHOW_ONLY_FIRST_PHOTO; ?></div>

<table border="0" cellspacing="2" cellpadding="0"  id="table_text2">

  <tr>
  	 <td style="vertical-align:top"><?php echo TITLE_IMG ?> 
     <br>
     <?php echo NOTICE_BEST_VIEW_PART_1; ?><?php echo TITLE_WIDTH; ?> : 1920, <?php echo TITLE_HEIGHT; ?> : 900<?php echo NOTICE_BEST_VIEW_PART_2; ?> 
     <br><?php echo NOTICE_FILE_FORMAT; ?> jpg, png, gif</td>
	 
	 
	 
      <td  style="vertical-align:top;display:none"><?php echo TITLE_LANG ?></td>
      <td style="vertical-align:top;display:none"><?php echo TITLE_SORT_ORDER ?></td>
       <td style="vertical-align:top;display:none "><?php echo TITLE_DISABLED ?></td>
        <td style="vertical-align:top">&nbsp;</td>
 </tr>

<?php
	$this_dynamic_area_id = "dynamic_home_banner_photo";
?>

  <tr id="<?php echo $this_dynamic_area_id; ?>">
    <td>


<input name="home_banner_photo_img" id="home_banner_photo_img"  value="" label="<?php echo TITLE_IMG;?>" type="file" class="input_file file_upload"/>
<input name="home_banner_photo_img_old_path"  id="home_banner_photo_img_old_path" value="" type="hidden"/>
    </td>
    
	   
    
 <td  style="display:none">
    
<?php
$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('home_banner_photo_language_id', $sql,'name','0','','','','','');
?>
    
    </td>
    
  <td  style="display:none" ><input name="home_banner_photo_sort_order" id="home_banner_photo_sort_order"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    

    
    
 <td  style="display:none">
     
     
<?php
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('home_banner_photo_disabled', $sql,'name','0','','','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#" style="display:none"   class="button btn_remove_home_banner_photo"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  

  
  
  
  
  
<?php
	
	$photo_width = 200;
	$photo_height = 5000;
	
	$i = 0;
  	$sql = "select * from ".TB_HOME_BANNER_PHOTO." as home_banner_photo  ";
	$sql .= " where home_banner_id='".ID."' ";
	$sql .= " order by language_id asc,sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){

				$this_index = ++$i;
					
				
				
				
				//$arr_file_info["width"]
				//$arr_file_info["height"]

					
?>
  
<tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>" class="<?php echo $this_dynamic_area_id; ?>">
<?php

$home_banner_photo_img = "../".$data['img'];
				$arr_file_info = getImageInfo($home_banner_photo_img,"thumb",$photo_width,$photo_height);
				$home_banner_photo_img_thumb = $arr_file_info["src"];
?>
   
   
    <td style="text-align:center; vertical-align:middle;background-color:#F9F9F9">
<div align="center">
<div style="width:<?php echo $photo_width; ?>px; vertical-align:middle">
<a href="<?php echo $home_banner_photo_img; ?>" target="_blank"><img src="<?php echo $home_banner_photo_img_thumb?>"  style="margin-bottom:10px;" align="middle" width="<?php echo $arr_file_info['width'] ?>" height="<?php echo $arr_file_info['height'] ?>"/></a>
</div>
</div>
<br>
<input name="home_banner_photo_img[]" id="home_banner_photo_img[]"  value="" label="<?php echo TITLE_PHOTO;?>" type="file" class="input_file img_upload"/>
<input name="home_banner_photo_img_old_path[]"  id="home_banner_photo_img_old_path[]" value="<?php echo $data['img']; ?>" type="hidden"/>
    </td>
    
	
	
	
	
    
    
    
     <td   style="display:none">
     
<?php
$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('home_banner_photo_language_id[]', $sql,'name','0',$data['language_id'],'disabled','','','');
?>
     
     </td>
    
    
    
 <td  style="display:none"  ><input name="home_banner_photo_sort_order[]" id="home_banner_photo_sort_order[]"  value="<?php echo $data['sort_order']; ?>" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    
 
    
 <td  style="display:none">
     
     
<?php
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('home_banner_photo_disabled[]', $sql,'name','0',$data['disabled'],'','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"    style="display:none"    class="button btn_remove_home_banner_photo"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  
<?php
	
	
		}
	}
					
?>
  
  
  
  
  
  

  <tr id="dynamic_home_banner_photo_footer" style="display:none">
   <td colspan="5">&nbsp;</td>
  </tr>



</table>



<div style="float:left;"><a href="#"   style="display:none"   id="btn_add_home_banner_photo"   class="button btn_add_home_banner_photo"  ><span><?php echo BTN_ADD_PHOTO;?></span></a></div>

</td>
</tr>

















<tr >
	<td class="sign_must_enter"></td>
	<td class="title vtop"  style="padding-top:12px;"><?php echo TITLE_IMG; ?> (Mobile)</td>
<td style="padding-top:0px;">

<div class="notice_msg"  style="display:none" ><?PHP echo NOTICE_SHOW_ONLY_FIRST_PHOTO; ?></div>

<table border="0" cellspacing="2" cellpadding="0"  id="table_text2">

  <tr>
  	 <td style="vertical-align:top"><?php echo TITLE_IMG ?> 
     <br>
     <?php echo NOTICE_BEST_VIEW_PART_1; ?><?php echo TITLE_WIDTH; ?> : 750, <?php echo TITLE_HEIGHT; ?> : 880<?php echo NOTICE_BEST_VIEW_PART_2; ?> 
     <br><?php echo NOTICE_FILE_FORMAT; ?> jpg, png, gif</td>
	 
	 
	 
      <td  style="vertical-align:top;display:none"><?php echo TITLE_LANG ?></td>
      <td style="vertical-align:top;display:none "><?php echo TITLE_SORT_ORDER ?></td>
       <td style="vertical-align:top;display:none "><?php echo TITLE_DISABLED ?></td>
        <td style="vertical-align:top;display:none">&nbsp;</td>
 </tr>

<?php
	$this_dynamic_area_id = "dynamic_home_banner_photo02";
?>

  <tr id="<?php echo $this_dynamic_area_id; ?>">
    <td>


<input name="home_banner_photo02_img" id="home_banner_photo02_img"  value="" label="<?php echo TITLE_IMG;?>" type="file" class="input_file file_upload"/>
<input name="home_banner_photo02_img_old_path"  id="home_banner_photo02_img_old_path" value="" type="hidden"/>
    </td>
    
	   
    
 <td  style="display:none">
    
<?php
$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('home_banner_photo02_language_id', $sql,'name','0','','','','','');
?>
    
    </td>
    
  <td   style="display:none" ><input name="home_banner_photo02_sort_order" id="home_banner_photo02_sort_order"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    

    
    
 <td   style="display:none">
     
     
<?php
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('home_banner_photo02_disabled', $sql,'name','0','','','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  style="display:none"   class="button btn_remove_home_banner_photo02"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  

  
  
  
  
  
<?php
	
	$photo02_width = 200;
	$photo02_height = 5000;
	
	$i = 0;
  	$sql = "select * from ".TB_HOME_BANNER_PHOTO02." as home_banner_photo02  ";
	$sql .= " where home_banner_id='".ID."' ";
	$sql .= " order by language_id asc,sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){

				$this_index = ++$i;
					
				
				
				
				//$arr_file_info["width"]
				//$arr_file_info["height"]

					
?>
  
<tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>" class="<?php echo $this_dynamic_area_id; ?>">
<?php

$home_banner_photo02_img = "../".$data['img'];
				$arr_file_info = getImageInfo($home_banner_photo02_img,"thumb",$photo02_width,$photo02_height);
				$home_banner_photo02_img_thumb = $arr_file_info["src"];
?>
   
   
    <td style="text-align:center; vertical-align:middle;background-color:#F9F9F9">
<div align="center">
<div style="width:<?php echo $photo02_width; ?>px; vertical-align:middle">
<a href="<?php echo $home_banner_photo02_img; ?>" target="_blank"><img src="<?php echo $home_banner_photo02_img_thumb?>"  style="margin-bottom:10px;" align="middle" width="<?php echo $arr_file_info['width'] ?>" height="<?php echo $arr_file_info['height'] ?>"/></a>
</div>
</div>
<br>
<input name="home_banner_photo02_img[]" id="home_banner_photo02_img[]"  value="" label="<?php echo TITLE_PHOTO02;?>" type="file" class="input_file img_upload"/>
<input name="home_banner_photo02_img_old_path[]"  id="home_banner_photo02_img_old_path[]" value="<?php echo $data['img']; ?>" type="hidden"/>
    </td>
    
	
	
	
	
    
    
    
     <td  style="display:none">
     
<?php
$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('home_banner_photo02_language_id[]', $sql,'name','0',$data['language_id'],'disabled','','','');
?>
     
     </td>
    
    
    
 <td   style="display:none" ><input name="home_banner_photo02_sort_order[]" id="home_banner_photo02_sort_order[]"  value="<?php echo $data['sort_order']; ?>" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    
 
    
 <td  style="display:none">
     
     
<?php
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('home_banner_photo02_disabled[]', $sql,'name','0',$data['disabled'],'','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  style="display:none"    class="button btn_remove_home_banner_photo02"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  
<?php
	
	
		}
	}
					
?>
  
  
  
  
  
  

  <tr id="dynamic_home_banner_photo02_footer" style="display:none">
   <td colspan="5">&nbsp;</td>
  </tr>



</table>



<div style="float:left;"><a href="#"  style="display:none"  id="btn_add_home_banner_photo02"   class="button btn_add_home_banner_photo02"  ><span><?php echo BTN_ADD_PHOTO;?></span></a></div>

</td>
</tr>
















<tr >
	<td class="sign_must_enter"></td>
	<td class="title vtop"  style="padding-top:12px;">下载宣传手册</td>
<td style="padding-top:0px;">

<div class="notice_msg"  style="display:none" ><?PHP echo NOTICE_SHOW_ONLY_FIRST_PHOTO; ?></div>

<table border="0" cellspacing="2" cellpadding="0"  id="table_text2">

  <tr>
  	 <td style="vertical-align:top">File</td>
	 
	 
	 
      <td  style="vertical-align:top;display:none"><?php echo TITLE_LANG ?></td>
      <td style="vertical-align:top;display:none "><?php echo TITLE_SORT_ORDER ?></td>
       <td style="vertical-align:top; "><?php echo TITLE_DISABLED ?></td>
        <td style="vertical-align:top;display:none">&nbsp;</td>
 </tr>

<?php
	$this_dynamic_area_id = "dynamic_home_banner_photo03";
?>

  <tr id="<?php echo $this_dynamic_area_id; ?>">
    <td>


<input name="home_banner_photo03_img" id="home_banner_photo03_img"  value="" label="<?php echo TITLE_IMG;?>" type="file" class="input_file file_upload"/>
<input name="home_banner_photo03_img_old_path"  id="home_banner_photo03_img_old_path" value="" type="hidden"/>
    </td>
    
	   
    
 <td  style="display:none">
    
<?php
$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('home_banner_photo03_language_id', $sql,'name','0','','','','','');
?>
    
    </td>
    
  <td   style="display:none" ><input name="home_banner_photo03_sort_order" id="home_banner_photo03_sort_order"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    

    
    
 <td   >
     
     
<?php
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('home_banner_photo03_disabled', $sql,'name','0','','','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  style="display:none"   class="button btn_remove_home_banner_photo03"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  

  
  
  
  
  
<?php
	
	$photo03_width = 200;
	$photo03_height = 5000;
	
	$i = 0;
  	$sql = "select * from ".TB_HOME_BANNER_PHOTO03." as home_banner_photo03  ";
	$sql .= " where home_banner_id='".ID."' ";
	$sql .= " order by language_id asc,sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){

				$this_index = ++$i;
					
				
				
				
				//$arr_file_info["width"]
				//$arr_file_info["height"]

					
?>
  
<tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>" class="<?php echo $this_dynamic_area_id; ?>">
<?php

$home_banner_photo03_img = "../".$data['img'];
				$arr_file_info = getImageInfo($home_banner_photo03_img,"thumb",$photo03_width,$photo03_height);
				$home_banner_photo03_img_thumb = $arr_file_info["src"];
?>
   
   
    <td style="text-align:center; vertical-align:middle;background-color:#F9F9F9">
<div align="center">
<div style="width:<?php echo $photo03_width; ?>px; vertical-align:middle">
<a href="<?php echo $home_banner_photo03_img; ?>" target="_blank">查看已上载的档案</a>
</div>
</div>
<br>
<input name="home_banner_photo03_img[]" id="home_banner_photo03_img[]"  value="" label="<?php echo TITLE_PHOTO03;?>" type="file" class="input_file img_upload"/>
<input name="home_banner_photo03_img_old_path[]"  id="home_banner_photo03_img_old_path[]" value="<?php echo $data['img']; ?>" type="hidden"/>
    </td>
    
	
	
	
	
    
    
    
     <td  style="display:none">
     
<?php
$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('home_banner_photo03_language_id[]', $sql,'name','0',$data['language_id'],'disabled','','','');
?>
     
     </td>
    
    
    
 <td   style="display:none" ><input name="home_banner_photo03_sort_order[]" id="home_banner_photo03_sort_order[]"  value="<?php echo $data['sort_order']; ?>" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    
 
    
 <td>
     
     
<?php
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('home_banner_photo03_disabled[]', $sql,'name','0',$data['disabled'],'','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  style="display:none"    class="button btn_remove_home_banner_photo03"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  
<?php
	
	
		}
	}
					
?>
  
  
  
  
  
  

  <tr id="dynamic_home_banner_photo03_footer" style="display:none">
   <td colspan="5">&nbsp;</td>
  </tr>



</table>



<div style="float:left;"><a href="#"  style="display:none"  id="btn_add_home_banner_photo03"   class="button btn_add_home_banner_photo03"  ><span><?php echo BTN_ADD_PHOTO;?></span></a></div>

</td>
</tr>

















<?php
	if(ACTION == 2){
?>

<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_CREATE_DATE; ?></td>
    <td><?php echo getCreateInfo($edit_data['create_date'],$edit_data['create_by']) ?></td>
    
</tr>
<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_LAST_UPDATE_DATE; ?></td>
    <td><?php echo getUpdateInfo($edit_data['last_update_date'],$edit_data['last_update_by']) ?></td>
    
</tr>

<?php
	}
?>
</table>  










<div id="table_form_bottom"></div>
<?php
	} //if($_REQUEST['show_confirm_page'] != '1'){
?>
<?php include(DIR_COMMON."print_list_search.php"); ?>
</form>
</div>
<!-- main_content_area (end) -->
<?php include(DIR_THIS_MODULE_ACTION."confirm_msg.php"); ?>
   </td>
   </tr>
</table>
<!-- edit record table (end) -->

    </td>
  </tr>
</table>
<!-- table_layout (end) -->








<!-- fixed_action_button_area (start) -->
<div id="fixed_action_button_area">
<div id="fixed_action_button_area_container">
 <div class="button_box">
    <ul>
    
    <li  class="main" ><a href="#" id="btn_back_to_list" class="btn_back_to_list"><span><?php echo BTN_BACK_TO_LIST;?></span></a></li>
    
<?php
	if(ACTION == 2){
?>
     <li ><a href="#" class="btn_delete"><span><?php echo BTN_DELETE;?></span></a></li>
<?php
	}
?> 
    <li><a href="#" id="btn_reset"><span><?php echo BTN_RESET;?></span></a></li>
    
    <li><a href="#"  id="btn_confirm"><span><?php echo BTN_CONFIRM;?></span></a></li>
    </ul>
    </div>
    <div style="clear:both"></div> 
   </div>
   <div style="clear:both"></div> 
</div>
<!-- fixed_action_button_area (end) -->















<div style="clear:both"></div> 
</div>
<div style="clear:both"></div> 
</div> 
<!-- main_content_container, inside_content (end) -->
<div style="clear:both"></div> 
</div>
<!-- container  (end) -->
<?php include(DIR_COMMON."footer.php");?>
</body>
</html>
