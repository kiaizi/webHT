<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
	
	define(ID,$_REQUEST['id']);
	

	$sql = "select * from ".TB_ABOUTFEATURE." as aboutfeature ";
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
$arr_aboutfeature_photo_language_id = getRequestVar("aboutfeature_photo_language_id",'');
$arr_aboutfeature_photo_sort_order = getRequestVar("aboutfeature_photo_sort_order",'');
$arr_aboutfeature_photo_caption = getRequestVar("aboutfeature_photo_caption",'');
$arr_aboutfeature_photo_disabled = getRequestVar("aboutfeature_photo_disabled",'');
$arr_aboutfeature_photo_img_old_path = getRequestVar("aboutfeature_photo_img_old_path",'');
$arr_aboutfeature_photo_thumb_old_path = getRequestVar("aboutfeature_photo_thumb_old_path",'');
if($arr_aboutfeature_photo_disabled != '' && ID > 0){

	$aboutfeature_id = ID;
	//$aboutfeature_code = getDataName(TB_ABOUTFEATURE,"code",$aboutfeature_id);
	$sql = "delete from ".TB_ABOUTFEATURE_PHOTO." where aboutfeature_id='".$aboutfeature_id."'";
	$G_DB_CONNECT->query($sql);

	for ($i=0; $i<count($arr_aboutfeature_photo_disabled); $i++) {




		$aboutfeature_photo_img_old_path = $arr_aboutfeature_photo_img_old_path[$i];
		$aboutfeature_photo_img = $aboutfeature_photo_img_old_path;

		$dir = "upload/images/clients/";
		$file_name = "aboutfeature_photo_img";
		////////////////////////////////////////////////
		$tempFile = $_FILES[$file_name]['tmp_name'][$i];
		if($tempFile != ''){
			$targetPath = CURRENT_DOCUMENT_ROOT . $dir ;
			$ext = get_extension($_FILES[$file_name]['name'][$i]);
			//$new_file_name = $aboutfeature_code."_".date("YmdHis")."_".getLastID(TB_ABOUTFEATURE_PHOTO).$ext;
			$new_file_name = date("YmdHis")."_".getLastID(TB_ABOUTFEATURE_PHOTO).$ext;
  			$targetFile =  str_replace('//','/',$targetPath) .$new_file_name ;
			move_uploaded_file($tempFile,$targetFile);
			$targetFile =$dir.$new_file_name;
			////////////////////////////////////////////////

			$aboutfeature_photo_img  = $targetFile;
			
			////////////////////////////////////////////////
			smart_resize_image( "../".$targetFile,"thumb", 600, 5000, true);
			smart_resize_image( "../".$targetFile,"img", 600, 5000, true);
			//smart_resize_image( "../".$targetFile,"", 740, 400, true);

		
		}
		
		
	
		
		if($aboutfeature_photo_img != '' ){
			////////////////////////////////////////////////
			$update_aboutfeature_photo_data = array();
			$update_aboutfeature_photo_data['language_id'] = $arr_aboutfeature_photo_language_id[$i];
			$update_aboutfeature_photo_data['img'] = $aboutfeature_photo_img;
			$update_aboutfeature_photo_data['thumb'] = $aboutfeature_photo_thumb;
			$update_aboutfeature_photo_data['caption'] = $arr_aboutfeature_photo_caption[$i];
			$update_aboutfeature_photo_data['sort_order'] = $arr_aboutfeature_photo_sort_order[$i];
			$update_aboutfeature_photo_data['disabled'] = $arr_aboutfeature_photo_disabled[$i];
			$update_aboutfeature_photo_data['aboutfeature_id'] = $aboutfeature_id;
			$update_aboutfeature_photo_data['create_date'] = 'null';
			$update_aboutfeature_photo_data['create_by'] = '';
			$update_aboutfeature_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_ABOUTFEATURE_PHOTO, $update_aboutfeature_photo_data);
			////////////////////////////////////////////////
	
		}
		
		
		
	}
}




/////////////////////////////////////////////
// upload file
/////////////////////////////////////////////
$arr_aboutfeature_photo02_title_tc = getRequestVar("aboutfeature_photo02_title_tc",'');
$arr_aboutfeature_photo02_detail_tc = getRequestVar("aboutfeature_photo02_detail_tc",'');

$arr_aboutfeature_photo02_language_id = getRequestVar("aboutfeature_photo02_language_id",'');
$arr_aboutfeature_photo02_sort_order = getRequestVar("aboutfeature_photo02_sort_order",'');
$arr_aboutfeature_photo02_caption = getRequestVar("aboutfeature_photo02_caption",'');
$arr_aboutfeature_photo02_disabled = getRequestVar("aboutfeature_photo02_disabled",'');
$arr_aboutfeature_photo02_img_old_path = getRequestVar("aboutfeature_photo02_img_old_path",'');
$arr_aboutfeature_photo02_thumb_old_path = getRequestVar("aboutfeature_photo02_thumb_old_path",'');
if($arr_aboutfeature_photo02_disabled != '' && ID > 0){

	$aboutfeature_id = ID;
	//$aboutfeature_code = getDataName(TB_ABOUTFEATURE,"code",$aboutfeature_id);
	$sql = "delete from ".TB_ABOUTFEATURE_PHOTO02." where aboutfeature_id='".$aboutfeature_id."'";
	$G_DB_CONNECT->query($sql);

	for ($i=0; $i<count($arr_aboutfeature_photo02_disabled); $i++) {




		$aboutfeature_photo02_img_old_path = $arr_aboutfeature_photo02_img_old_path[$i];
		$aboutfeature_photo02_img = $aboutfeature_photo02_img_old_path;

		$dir = "upload/images/aboutfeature/";
		$file_name = "aboutfeature_photo02_img";
		////////////////////////////////////////////////
		$tempFile = $_FILES[$file_name]['tmp_name'][$i];
		if($tempFile != ''){
			$targetPath = CURRENT_DOCUMENT_ROOT . $dir ;
			$ext = get_extension($_FILES[$file_name]['name'][$i]);
			//$new_file_name = $aboutfeature_code."_".date("YmdHis")."_".getLastID(TB_ABOUTFEATURE_PHOTO02).$ext;
			$new_file_name = date("YmdHis")."_".getLastID(TB_ABOUTFEATURE_PHOTO02).'_feature'.$ext;
  			$targetFile =  str_replace('//','/',$targetPath) .$new_file_name ;
			move_uploaded_file($tempFile,$targetFile);
			$targetFile =$dir.$new_file_name;
			////////////////////////////////////////////////

			$aboutfeature_photo02_img  = $targetFile;
			
			////////////////////////////////////////////////
			smart_resize_image( "../".$targetFile,"thumb", 600, 5000, true);
			smart_resize_image( "../".$targetFile,"img", 600, 5000, true);
			//smart_resize_image( "../".$targetFile,"", 740, 400, true);

		
		}
		
		
	
		
		if($aboutfeature_photo02_img != '' ){
			////////////////////////////////////////////////
			$update_aboutfeature_photo02_data = array();
			$update_aboutfeature_photo02_data['language_id'] = $arr_aboutfeature_photo02_language_id[$i];
			$update_aboutfeature_photo02_data['img'] = $aboutfeature_photo02_img;
		//	$update_aboutfeature_photo02_data['thumb'] = $aboutfeature_photo02_thumb;
			//$update_aboutfeature_photo02_data['caption'] = $arr_aboutfeature_photo02_caption[$i];
			$update_aboutfeature_photo02_data['title_tc'] = $arr_aboutfeature_photo02_title_tc[$i];
			$update_aboutfeature_photo02_data['detail_tc'] = $arr_aboutfeature_photo02_detail_tc[$i];
			$update_aboutfeature_photo02_data['sort_order'] = $arr_aboutfeature_photo02_sort_order[$i];
			$update_aboutfeature_photo02_data['disabled'] = $arr_aboutfeature_photo02_disabled[$i];
			$update_aboutfeature_photo02_data['aboutfeature_id'] = $aboutfeature_id;
			$update_aboutfeature_photo02_data['create_date'] = 'null';
			$update_aboutfeature_photo02_data['create_by'] = '';
			$update_aboutfeature_photo02_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_ABOUTFEATURE_PHOTO02, $update_aboutfeature_photo02_data);
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
<script type="text/javascript" src="<?php echo DIR_THIS_MODULE_ACTION;?>main.js?v=<?php echo date('Ymdhis')?>"></script>
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
echo $G_DB_CONNECT->query_update_lang_content(TB_ABOUTFEATURE, $update_data_lang, "  aboutfeature_id='".$update_data['id']."'   ");
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




<tr class="seo_row" style="display:none">
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
		
   	printLangInputField(TITLE_SEO_TITLE,"seo_title",TB_ABOUTFEATURE,$edit_data['id'],"seo_title",false,"input_seo_title","",false,'class="seo_row"');
			
			
?>
   
   
   

<?php 

printLangTextAreaNormal(TITLE_SEO_DESC,"seo_desc",TB_ABOUTFEATURE,$edit_data['id'],false,300,450,'','class="seo_row"');
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
	<td class="sign_must_enter"><div id="require"></div></td>
    <td class="title"><?php echo TITLE_DISABLED; ?></td>
    
    <td>
        

    
<?php 
		
   $sql = "select status_allow.*, status_allow_desc.name as name from ".TB_STATUS_ALLOW." as status_allow , ".TB_STATUS_ALLOW_DESC." as status_allow_desc ";
	$sql .= " where ";
	$sql .= " status_allow.id=status_allow_desc.status_allow_id ";
	$sql .= " and status_allow_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " order by status_allow.sort_order asc ";
				

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
			$edit_data['sort_order'] = getNextSortOrder(TB_ABOUTFEATURE,"");
		}
	?>
    
    <input name="sort_order" id="sort_order"  value="<?php echo $edit_data['sort_order'] ?>" label="<?php echo TITLE_SORT_ORDER; ?>" class="numeric input_middle" required="yes"/>
    
    
    </td>
  </tr>  





<tr style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_CODE;?></td>
    <td>
    <?php
		if(ACTION == '1'){
			//$edit_data['code'] = nextRecordcode(TB_ABOUTFEATURE,"","",4);
		}
	?>
    
    <input name="code" id="code"  value="<?php echo $edit_data['code'] ?>" label="<?php echo TITLE_CODE; ?>" class="input_middle"  />
    </td>
</tr>



	<tr style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
    <td class="title"><?php echo TITLE_DATE; ?></td>
    
    <td>
        
<?php
	if($edit_data['display_date']== ''){
		$edit_data['display_date'] = TODAY;
	}
?>
    
<input name="display_date" id="display_date" maxlength="10" class="input_middle"  required="yes" label="<?php echo TITLE_DATE; ?>"  value="<?php echo $edit_data['display_date']; ?>"/>
    
    
    </td>
    
</tr>



<?php 
		
   	printLangInputField(TITLE_TITLE,"name",TB_ABOUTFEATURE,$edit_data['id'],"name",false);
	printLangTextAreaNormal(TITLE_DESC,"detail3",TB_ABOUTFEATURE,$edit_data['id'],false,100,510,"");
	//printLangTextArea('Details',"detail",TB_ABOUTFEATURE,$edit_data['id'],true,500,680);
		//	printLangTextArea('Ingredients',"detail2",TB_ABOUTFEATURE,$edit_data['id'],true,500,680);	
?>


	<tr style="display:none">
	<td class="sign_must_enter"><div id="require2"></div></td>
    <td class="title">查看更多</td>
    
    <td>
        

    
<input name="website" id="website"  class="input_middle"   value="<?php echo $edit_data['website']; ?>"/>
    
    
    </td>
    
</tr>













        



 <?php //echo printLangTextArea(TITLE_CONTENT_IF_NO_LINK,"detail",TB_ABOUTFEATURE,$edit_data['id'],false,800); ?>  

   
<?php
// printLangTextAreaNormal(TITLE_TITLE,"name",TB_ABOUTFEATURE,$edit_data['id'],false,150,500,"");
?>


    




<?php
 //printLangTextAreaNormal(TITLE_ADDRESS,"address",TB_ABOUTFEATURE,$edit_data['id'],false,150,500,"");
?>




<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title vtop"><?php echo TITLE_REMARK; ?></td>
    <td><textarea  name="remark" id="remark"  label="<?php echo TITLE_REMARK; ?>"    class="input_middle"/><?php echo $edit_data['remark'] ?></textarea></td>
    
</tr>




























<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title vtop"  style="padding-top:12px;"><?php echo TITLE_IMG; ?></td>
<td style="padding-top:0px;">

<div class="notice_msg" style="display:none" ><?PHP echo NOTICE_SHOW_ONLY_FIRST_PHOTO; ?></div>

<table border="0" cellspacing="2" cellpadding="0"  id="table_text2">

  <tr>
  	
     
     <td style="vertical-align:top">Photo
     <br>
     <?php echo NOTICE_BEST_VIEW_PART_1; ?><?php echo TITLE_WIDTH; ?> : 305,<?php echo TITLE_HEIGHT; ?> : 170 <?php echo NOTICE_BEST_VIEW_PART_2; ?> 
     <br>
     <?php echo NOTICE_FILE_FORMAT; ?> jpg, png, gif</td>
     
      <td  style="vertical-align:top;display:none"><?php echo TITLE_LANG ?></td>
      <td style="vertical-align:top; display:none "><?php echo TITLE_SORT_ORDER ?></td>
       <td style="vertical-align:top;display:none   "><?php echo TITLE_DISABLED ?></td>
        <td style="vertical-align:top">&nbsp;</td>
 </tr>

<?php
	$this_dynamic_area_id = "dynamic_aboutfeature_photo";
?>

  <tr id="<?php echo $this_dynamic_area_id; ?>">
 
    
     <td>


<input name="aboutfeature_photo_img" id="aboutfeature_photo_img"  value="" label="<?php echo TITLE_IMG;?>" type="file" class="input_file file_upload"/>
<input name="aboutfeature_photo_img_old_path"  id="aboutfeature_photo_img_old_path" value="" type="hidden"/>
    </td>
    
    
 <td style="display:none">
    
<?php 
		
 	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('aboutfeature_photo_language_id', $sql,'name','0','','','','','');
?>
    
    </td>
    
<td  style="display:none"><input name="aboutfeature_photo_sort_order" id="aboutfeature_photo_sort_order"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    

    
    
<td  style="display:none">
     
     
<?php 
		
  $sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('aboutfeature_photo_disabled', $sql,'name','0','','','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  style="display:none"  class="button btn_remove_aboutfeature_photo"   ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  

  
  
  
  
  
<?php
	
	$photo_width = 70;
	$photo_height = 70;
	
	$i = 0;
  	$sql = "select * from ".TB_ABOUTFEATURE_PHOTO." as aboutfeature_photo  ";
	$sql .= " where aboutfeature_id='".ID."' ";
	$sql .= " order by sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){

				$this_index = ++$i;
					
				$aboutfeature_photo_img = "../".$data['img'];
				$arr_file_info = getImageInfo($aboutfeature_photo_img,"thumb",$photo_width,$photo_height);
				$aboutfeature_photo_img_thumb = $arr_file_info["src"];
				
				//$arr_file_info["width"]
				//$arr_file_info["height"]

					
?>
  
<tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>" class="<?php echo $this_dynamic_area_id; ?>">
   
   
<?php
	
	
	
	$photo_width = 70;
	$photo_height = 70;
					
				$aboutfeature_photo_img = "../".$data['thumb'];
				$arr_file_info = getImageInfo($aboutfeature_photo_img,"thumb",$photo_width,$photo_height);
				$aboutfeature_photo_img_thumb = $arr_file_info["src"];
				
				
					
?>
   
   
   
   
   
  
<?php
	
	$photo_width = 200;
	$photo_height = 500;
	
					
				$aboutfeature_photo_img = "../".$data['img'];
				$arr_file_info = getImageInfo($aboutfeature_photo_img,"thumb",$photo_width,$photo_height);
				$aboutfeature_photo_img_thumb = $arr_file_info["src"];
				
				
					
?>
   
   
    <td style="text-align:center; vertical-align:middle;background-color:#F9F9F9">
<div align="center">
<div style="width:<?php echo $photo_width; ?>px; vertical-align:middle">
<a href="<?php echo $aboutfeature_photo_img; ?>" target="_blank"><img src="<?php echo $aboutfeature_photo_img_thumb?>"  style="margin-bottom:10px;" align="middle" width="<?php echo $arr_file_info['width'] ?>" height="<?php echo $arr_file_info['height'] ?>"/></a>

</div>
</div>
<br>
<input name="aboutfeature_photo_img[]" id="aboutfeature_photo_img[]"  value="" label="<?php echo TITLE_PHOTO;?>" type="file" class="input_file img_upload"/>
<input name="aboutfeature_photo_img_old_path[]"  id="aboutfeature_photo_img_old_path[]" value="<?php echo $data['img']; ?>" type="hidden"/>
    </td>
    
    
 <td  style="display:none">
     
<?php 
		
 	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('aboutfeature_photo_language_id[]', $sql,'name','0',$data['language_id'],'','','','');
?>
     
     </td>
    
    
    
   <td  style="display:none"><input name="aboutfeature_photo_sort_order[]" id="aboutfeature_photo_sort_order[]"  value="<?php echo $data['sort_order']; ?>" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    
 
    
   <td  style="display:none">
     
<?php 
		
    $sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('aboutfeature_photo_disabled[]', $sql,'name','0',$data['disabled'],'','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  style="display:none"  class="button btn_remove_aboutfeature_photo"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  
<?php
	
	
		}
	}
					
?>
  
  
  
  
  
  

  <tr id="dynamic_aboutfeature_photo_footer" style="display:none">
   <td colspan="5">&nbsp;</td>
  </tr>



</table>



<div style="float:left;"><a  style="display:none" href="#" id="btn_add_aboutfeature_photo" class="button btn_add_aboutfeature_photo"  ><span><?php echo BTN_ADD_PHOTO;?></span></a></div>

</td>
</tr>







































<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title vtop"  style="padding-top:12px;">好處</td>
<td style="padding-top:0px;">

<div class="notice_msg" style="display:none" ><?PHP echo NOTICE_SHOW_ONLY_FIRST_PHOTO02; ?></div>

<table border="0" cellspacing="2" cellpadding="0"  id="table_text2">

  <tr>
  	
     
     <td style="vertical-align:top">Icon
     <br>
     <?php echo NOTICE_BEST_VIEW_PART_1; ?><?php echo TITLE_WIDTH; ?> : 200,<?php echo TITLE_HEIGHT; ?> : 200 <?php echo NOTICE_BEST_VIEW_PART_2; ?> 
     <br>
     <?php echo NOTICE_FILE_FORMAT; ?> jpg, png, gif</td>
     
      <td  style="vertical-align:top;display:none"><?php echo TITLE_LANG ?></td>
	  
	        <td style="vertical-align:top;  ">內容</td>
	  
      <td style="vertical-align:top;  "><?php echo TITLE_SORT_ORDER ?></td>
       <td style="vertical-align:top;   "><?php echo TITLE_DISABLED ?></td>
        <td style="vertical-align:top">&nbsp;</td>
 </tr>

<?php
	$this_dynamic_area_id = "dynamic_aboutfeature_photo02";
?>

  <tr id="<?php echo $this_dynamic_area_id; ?>">
 
    
     <td style="vertical-align:top">


<input name="aboutfeature_photo02_img" id="aboutfeature_photo02_img"  value="" label="<?php echo TITLE_IMG;?>" type="file" class="input_file file_upload"/>
<input name="aboutfeature_photo02_img_old_path"  id="aboutfeature_photo02_img_old_path" value="" type="hidden"/>
    </td>
    
	
	    
<td  style="vertical-align:top">



<textarea style="width:300px;height:50px;"  placeholder="標題" name="aboutfeature_photo02_title_tc" id="aboutfeature_photo02_title_tc"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short" ></textarea>

<div style="clear:both;padding-top:5px;"></div>
<textarea style="width:300px;height:100px;"   placeholder="描述" name="aboutfeature_photo02_detail_tc" id="aboutfeature_photo02_detail_tc"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short" ></textarea>

</td>
    
    
    
	
	
	
    
 <td style="display:none">
    
<?php 
		
 	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('aboutfeature_photo02_language_id', $sql,'name','0','','','','','');
?>
    
    </td>
    
<td  style="vertical-align:top"><input name="aboutfeature_photo02_sort_order" id="aboutfeature_photo02_sort_order"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    

    
    
<td  style="vertical-align:top" >
     
     
<?php 
		
  $sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('aboutfeature_photo02_disabled', $sql,'name','0','','','','','');
?>
    
     
     
     


     </td>
    <td style="width:250px;vertical-align:top"><a href="#"    class="button btn_remove_aboutfeature_photo02"   ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  

  
  
  
  
  
<?php
	
	$photo02_width = 100;
	$photo02_height = 100;
	
	$i = 0;
  	$sql = "select * from ".TB_ABOUTFEATURE_PHOTO02." as aboutfeature_photo02  ";
	$sql .= " where aboutfeature_id='".ID."' ";
	$sql .= " order by sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){

				$this_index = ++$i;
					
				$aboutfeature_photo02_img = "../".$data['img'];
				$arr_file_info = getImageInfo($aboutfeature_photo02_img,"",$photo02_width,$photo02_height);
				$aboutfeature_photo02_img_thumb = $arr_file_info["src"];
				
				//$arr_file_info["width"]
				//$arr_file_info["height"]

					
?>
  
<tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>" class="<?php echo $this_dynamic_area_id; ?>">
   
   
<?php
	
	
	
	$photo02_width = 70;
	$photo02_height = 70;
					
				$aboutfeature_photo02_img = "../".$data['thumb'];
				$arr_file_info = getImageInfo($aboutfeature_photo02_img,"",$photo02_width,$photo02_height);
				$aboutfeature_photo02_img_thumb = $arr_file_info["src"];
				
				
					
?>
   
   
   
   
   
  
<?php
	
	$photo02_width = 200;
	$photo02_height = 500;
	
					
				$aboutfeature_photo02_img = "../".$data['img'];
				$arr_file_info = getImageInfo($aboutfeature_photo02_img,"",$photo02_width,$photo02_height);
				$aboutfeature_photo02_img_thumb = $arr_file_info["src"];
				
				
					
?>
   
   
    <td style="text-align:center; vertical-align:top;background-color:#F9F9F9">
<div align="center">
<div style="width:<?php echo $photo02_width; ?>px; vertical-align:middle">
<a href="<?php echo $aboutfeature_photo02_img; ?>" target="_blank"><img src="<?php echo $aboutfeature_photo02_img_thumb?>"  style="margin-bottom:10px;" align="middle" width="<?php echo $arr_file_info['width'] ?>" height="<?php echo $arr_file_info['height'] ?>"/></a>

</div>
</div>
<br>
<input name="aboutfeature_photo02_img[]" id="aboutfeature_photo02_img[]"  value="" label="<?php echo TITLE_PHOTO02;?>" type="file" class="input_file img_upload"/>
<input name="aboutfeature_photo02_img_old_path[]"  id="aboutfeature_photo02_img_old_path[]" value="<?php echo $data['img']; ?>" type="hidden"/>
    </td>
    
    
 <td  style="display:none">
     
<?php 
		
 	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('aboutfeature_photo02_language_id[]', $sql,'name','0',$data['language_id'],'','','','');
?>
     
     </td>
    <td  style="vertical-align:top">



<textarea style="width:300px;height:50px;"  placeholder="標題" name="aboutfeature_photo02_title_tc[]" id="aboutfeature_photo02_title_tc[]"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short" ><?php echo $data['title_tc']; ?></textarea>

<div style="clear:both;padding-top:5px;"></div>
<textarea style="width:300px;height:100px;"   placeholder="描述" name="aboutfeature_photo02_detail_tc[]" id="aboutfeature_photo02_detail_tc[]"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short" ><?php echo $data['detail_tc']; ?></textarea>

</td>
    
    
    
    
   <td        style="vertical-align:top"><input name="aboutfeature_photo02_sort_order[]" id="aboutfeature_photo02_sort_order[]"  value="<?php echo $data['sort_order']; ?>" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    
 
    
   <td        style="vertical-align:top">
     
<?php 
		
    $sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('aboutfeature_photo02_disabled[]', $sql,'name','0',$data['disabled'],'','','','');
?>
    
     

     </td>
    <td style="width:250px;vertical-align:top"><a href="#"   class="button btn_remove_aboutfeature_photo"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  
<?php
	
	
		}
	}
					
?>
  
  
  
  
  
  

  <tr id="dynamic_aboutfeature_photo02_footer" style="display:none">
   <td colspan="5">&nbsp;</td>
  </tr>



</table>



<div style="float:left;"><a   href="#" id="btn_add_aboutfeature_photo02" class="button btn_add_aboutfeature_photo02"  ><span><?php echo BTN_ADD_PHOTO;?></span></a></div>

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
<!--  frm_reset -->
<form name="frm_reset"  id="frm_reset" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>"  target="_self" autocomplete="off">
<input name="id" id="id" value="<?php echo $_REQUEST['id']; ?>" type="hidden"/>
<input name="sid" id="sid" value="<?php echo SID; ?>" type="hidden"/>
<input name="action" id="action" value="<?php echo ACTION; ?>" type="hidden"/>
</form>
<!--  frm_reset (end) -->
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
    
    <li  class="main"><a href="#" id="btn_back_to_list" class="btn_back_to_list"><span><?php echo BTN_BACK_TO_LIST;?></span></a></li>
    
<?php
	if(ACTION == 2){
?>
     <li><a href="#" class="btn_delete"><span><?php echo BTN_DELETE;?></span></a></li>
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
