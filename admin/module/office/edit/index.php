<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
	
	define(ID,$_REQUEST['id']);
	
	/*
	$sql = "select id  from ".TB_OFFICE." as office ";
	$sql .= " where ";
	$sql .= "  disabled <>'".DISABLED_DELETE."' ";
//echo '<br>';
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$office_id=$data ['id']; 
				echo $sql = "select office_id from ".TB_OFFICE_PHOTO." where office_id='".$office_id."'";
				echo '<br>';
				$rows2 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows == 1){
					echo $office_id;
					echo '<br>';
			$update_office_photo_data = array();
			$update_office_photo_data['img'] = 'upload/images/office/blank.png';
		
			$update_office_photo_data['sort_order'] = 2;
		
			$update_office_photo_data['office_id'] = $office_id;
			$update_office_photo_data['create_date'] = 'null';
			$update_office_photo_data['create_by'] = '';
			$update_office_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_OFFICE_PHOTO, $update_office_photo_data);
					
					
					
				}
				
			}
	}
	*/


	$sql = "select * from ".TB_OFFICE." as office ";
	$sql .= " where ";
	$sql .= " id='".ID."' ";
	$sql .= " and disabled <>'".DISABLED_DELETE."' ";
	$edit_data = $G_DB_CONNECT->query_first($sql);
	
	
	if(ID > 0 && $edit_data['id'] == ''){
		exit(WARN_ACCESS_DENIED);
	}









/////////////////////////////////////////////
// upload photo
/////////////////////////////////////////////

$arr_office_photo_office_color_id = getRequestVar("office_photo_office_color_id",'');
$arr_office_photo_sort_order = getRequestVar("office_photo_sort_order",'');
$arr_office_photo_disabled = getRequestVar("office_photo_disabled",'');
$arr_office_photo_img_old_path = getRequestVar("office_photo_img_old_path",'');
if($arr_office_photo_disabled != '' && ID > 0){

	$office_id = ID;
	$office_code = getDataName(TB_OFFICE,"code",$office_id);
	$sql = "delete from ".TB_OFFICE_PHOTO." where office_id='".$office_id."'";
	$G_DB_CONNECT->query($sql);

	for ($i=0; $i<count($arr_office_photo_disabled); $i++) {

		$office_photo_img_old_path = $arr_office_photo_img_old_path[$i];
		
		
		
		$dir = "upload/images/office/";
		$file_name = "office_photo_img";
		
		if($office_photo_img_old_path == ''){
			$office_photo_img_old_path = $dir . 'blank.jpg';
		}
	
		////////////////////////////////////////////////
		$tempFile = $_FILES[$file_name]['tmp_name'][$i];
		if($tempFile != ''){
			$targetPath = CURRENT_DOCUMENT_ROOT . $dir ;
			$ext = get_extension($_FILES[$file_name]['name'][$i]);
			$new_file_name = formatToSEOURL($office_code)."_".date("YmdHis")."_".getLastID(TB_OFFICE_PHOTO).$ext;
  			$targetFile =  str_replace('//','/',$targetPath) .$new_file_name ;
			move_uploaded_file($tempFile,$targetFile);
			$targetFile =$dir.$new_file_name;
			////////////////////////////////////////////////
			$update_office_photo_data = array();
			$update_office_photo_data['img'] = $targetFile;
			//$update_office_photo_data['office_color_id'] = $arr_office_photo_office_color_id[$i];
			$update_office_photo_data['sort_order'] = $arr_office_photo_sort_order[$i];
			$update_office_photo_data['disabled'] = $arr_office_photo_disabled[$i];
			$update_office_photo_data['office_id'] = $office_id;
			$update_office_photo_data['create_date'] = 'null';
			$update_office_photo_data['create_by'] = '';
			$update_office_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_OFFICE_PHOTO, $update_office_photo_data);
		////////////////////////////////////////////////

			smart_resize_image( "../".$targetFile,"img", 550,5000, true);
			smart_resize_image( "../".$targetFile,"thumb", 300, 5000, true);
			//smart_resize_image( "../".$targetFile,"thumb2", 78,78, true);
			//smart_resize_image( "../".$targetFile,"thumb3", 50,50, true);
		
		}else if($office_photo_img_old_path != ''){
			////////////////////////////////////////////////
			$update_office_photo_data = array();
			$update_office_photo_data['img'] = $office_photo_img_old_path;
		//	$update_office_photo_data['office_color_id'] = $arr_office_photo_office_color_id[$i];
			$update_office_photo_data['sort_order'] = $arr_office_photo_sort_order[$i];
			$update_office_photo_data['disabled'] = $arr_office_photo_disabled[$i];
			$update_office_photo_data['office_id'] = $office_id;
			$update_office_photo_data['create_date'] = 'null';
			$update_office_photo_data['create_by'] = '';
			$update_office_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_OFFICE_PHOTO, $update_office_photo_data);
			////////////////////////////////////////////////
	
		}
	
	}
}
renewSortOrder(TB_OFFICE_PHOTO,"office_id='".ID."'");
/////////////////////////////////////////////
	
	
	
	
	
	
	
	
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
echo $G_DB_CONNECT->query_update_lang_content(TB_OFFICE, $update_data_lang, "  office_id='".$update_data['id']."'   ");
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
		
   	printLangInputField(TITLE_SEO_TITLE,"seo_title",TB_OFFICE,$edit_data['id'],"seo_title",false,"input_seo_title","",false,'class="seo_row"');
			
			
?>
   
   
   

<?php 

printLangTextAreaNormal(TITLE_SEO_DESC,"seo_desc",TB_OFFICE,$edit_data['id'],false,300,450,'','class="seo_row"');
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


<tr style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
    <td class="title">地區</td>
    
    <td>
        

    
    
<?php
		
	$sql = "select office_category.parent_office_category_id,office_category.id as id ,office_category_desc.name as name "; 
	$sql .= ",(select name from ".TB_OFFICE_CATEGORY_DESC." where office_category_id=office_category.parent_office_category_id and language_id = '".ADMIN_LANG_ID."') as parent_category_name";
	$sql .= " from ".TB_OFFICE_CATEGORY." as office_category, ".TB_OFFICE_CATEGORY_DESC." as office_category_desc ";
	$sql .= " where ";
	$sql .= " office_category.parent_office_category_id >0 ";
	$sql .= " and office_category.id = office_category_desc.office_category_id ";
	$sql .= " and office_category_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and office_category.disabled<>'".DISABLED_DELETE."' ";
		$sql .= " order by office_category.parent_office_category_id asc,office_category.sort_order  asc ";
	
	
	
	
	
	printCustomMenuProductCategory('office_category_id', $sql,'name','0',$edit_data['office_category_id'],'','','','');
	
	//printCheckBoxGroup2Level($sql,'office_category_id',3,$edit_data['office_category_id'],'yes',TITLE_OFFICE_CATEGORY,1);
			
?>
   
    
    
    </td>
    
</tr>







<tr >
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_SORT_ORDER; ?></td>
    <td>
    
    
    <?php
		if(ACTION == '1'){
			$edit_data['sort_order'] = getNextSortOrder(TB_OFFICE,"");
		}
	?>
    
    <input name="sort_order" id="sort_order"  value="<?php echo $edit_data['sort_order'] ?>" label="<?php echo TITLE_SORT_ORDER; ?>" class="numeric input_middle" required="yes"/>
    
    
    </td>
  </tr>  



<tr style="display:none">
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title highlight">Google Map 坐標</td>
    <td>
    

    
    <input style="width:150px;" name="google_x" id="google_x"  value="<?php echo $edit_data['google_x'] ?>" label="" class="input_middle" />
    
     , <input style="width:150px;" name="google_y" id="google_y"  value="<?php echo $edit_data['google_y'] ?>" label="" class="input_middle" />
    
    </td>
  </tr>  
  
  
<tr style="display:none">
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title highlight">Baidu Map 坐標</td>
    <td>
    

    
    <input style="width:150px;" name="baidu_x" id="baidu_x"  value="<?php echo $edit_data['baidu_x'] ?>" label="" class="input_middle" />
    
     , <input style="width:150px;" name="baidu_y" id="baidu_y"  value="<?php echo $edit_data['baidu_y'] ?>" label="" class="input_middle" />
    
    </td>
  </tr>  

  
  
  
<?php 
	
	printLangInputField(TITLE_TITLE,"name",TB_OFFICE,$edit_data['id'],"name",true);

	
	
?>






   
<?php
printLangTextAreaNormal('地址',"detail",TB_OFFICE,$edit_data['id'],false,100,510,"");
	//printLangInputField('地址',"detail",TB_OFFICE,$edit_data['id'],"detail",false);
//printLangTextAreaNormal('服務時間',"detail2",TB_OFFICE,$edit_data['id'],false,150,510,"");
	
?>


<tr >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">Tel</td>
    <td>
    

    
    <input name="tel" id="tel"  value="<?php echo $edit_data['tel'] ?>" label="體驗熱線" class=" input_middle" />
    
    
    </td>
  </tr>  

  


<?php
	


printLangTextAreaNormal('營業時間',"open_hr",TB_OFFICE,$edit_data['id'],false,150,510,"");
//printLangInputField('營業時間',"open_hr",TB_OFFICE,$edit_data['id'],"open_hr",false);

//printLangInputField('地址 (footer)',"detail2",TB_OFFICE,$edit_data['id'],"detail2",false);
//printLangInputField('營業時間 (星期六) ',"open_hr2",TB_OFFICE,$edit_data['id'],"open_hr2",false);
//printLangInputField('營業時間 (星期日及公眾假期) ',"open_hr3",TB_OFFICE,$edit_data['id'],"open_hr3",false);


?>


<tr >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title highlight">Google Map </td>
    <td>
    

    
    <input  name="google_map" id="google_map"  value="<?php echo $edit_data['google_map'] ?>" label="" class="input_middle" />

    </td>
  </tr>  
  


















<tr >
	<td class="sign_must_enter"></td>
	<td class="title vtop"  style="padding-top:12px;"><?php echo TITLE_PHOTO; ?></td>
<td style="padding-top:0px;">



<table border="0" cellspacing="2" cellpadding="0"  id="table_text2">

  <tr>
  	 <td><?php echo TITLE_PHOTO ?> <?php echo NOTICE_BEST_VIEW_PART_1; ?><?php echo TITLE_WIDTH; ?> : 800, <?php echo TITLE_HEIGHT; ?> : 600<?php echo NOTICE_BEST_VIEW_PART_2; ?></td>
      
       <td style="display:none"><?php echo TITLE_OFFICE_COLOR ?></td>
       <td ><?php echo TITLE_SORT_ORDER ?></td>
       <td ><?php echo TITLE_DISABLED ?></td>
        <td>&nbsp;</td>
 </tr>

<?php
	$this_dynamic_area_id = "dynamic_office_photo";
?>

  <tr id="<?php echo $this_dynamic_area_id; ?>">
    <td>


<input name="office_photo_img" id="office_photo_img"  value="" label="<?php echo TITLE_PHOTO;?>" type="file" class="input_file img_upload"/>
<input name="office_photo_img_old_path"  id="office_photo_img_old_path" value="" type="hidden"/>
    </td>
   
    
    
    
 <td  style="display:none">


<?php 
$sql = "select office_color.id as id, office_color_desc.name as name from ".TB_OFFICE_COLOR." as office_color , ".TB_OFFICE_COLOR_DESC." as office_color_desc ";
	$sql .= " where ";
	$sql .= " office_color.id=office_color_desc.office_color_id ";
	$sql .= " and office_color_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and office_color.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " group by office_color.id  ";
	$sql .= " order by office_color.sort_order asc ";
				

	printCustomMenu('office_photo_office_color_id', $sql,'name','0','','','','','');
?>



    </td>
    
     <td><input name="office_photo_sort_order" id="office_photo_sort_order"  value="0" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
     <td >
     
     
<?php 
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				

	printCustomMenu('office_photo_disabled', $sql,'name','0','','','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  class="button btn_remove_office_photo"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  

  
  
  
  
  
<?php
	
	$photo_width = 200;
	$photo_height = 417;
	
	
	$i = 0;
  	$sql = "select * from ".TB_OFFICE_PHOTO." as office_photo  ";
	$sql .= " where office_id='".ID."' ";
	$sql .= " order by sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){

				$this_index = ++$i;
					
				$office_photo_img = "../".$data['img'];
				$arr_img_info = getImageInfo($office_photo_img,"img",$photo_width,$photo_height);
				$office_photo_img_thumb = $arr_img_info["src"];

					
?>
  
<tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>" class="<?php echo $this_dynamic_area_id; ?>">
    <td style="text-align:center; vertical-align:middle;background-color:#F9F9F9">
<div align="center">
<div style="width:<?php echo $photo_width; ?>px; vertical-align:middle">
<a href="<?php echo $office_photo_img; ?>" target="_blank"><img src="<?php echo $office_photo_img_thumb?>" width="<?php echo $arr_img_info["width"]?>" height="<?php echo $arr_img_info["height"]?>" style="margin-bottom:10px;" align="middle"/></a>
</div>
</div>
<br>
<input name="office_photo_img[]" id="office_photo_img[]"  value="" label="<?php echo TITLE_PHOTO;?>" type="file" class="input_file img_upload"/>
<input name="office_photo_img_old_path[]"  id="office_photo_img_old_path[]" value="<?php echo $data['img']; ?>" type="hidden"/>
    </td>
   
    
    
    
   
 <td style="display:none">


<?php 
$sql = "select office_color.id as id, office_color_desc.name as name from ".TB_OFFICE_COLOR." as office_color , ".TB_OFFICE_COLOR_DESC." as office_color_desc ";
	$sql .= " where ";
	$sql .= " office_color.id=office_color_desc.office_color_id ";
	$sql .= " and office_color_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and office_color.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " group by office_color.id  ";
	$sql .= " order by office_color.sort_order asc ";
				

	printCustomMenu('office_photo_office_color_id[]', $sql,'name','0',$data['office_color_id'],'','','','');
?>



    </td>
    
     <td><input name="office_photo_sort_order[]" id="office_photo_sort_order[]"  value="<?php echo $data['sort_order']; ?>" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
     <td>
     
     
<?php 
$sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				

	printCustomMenu('office_photo_disabled[]', $sql,'name','0',$data['disabled'],'','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#"  class="button btn_remove_office_photo"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  
<?php
	
	
		}
	}
					
?>
  
  
  
  
  
  

  <tr id="dynamic_office_photo_footer" style="display:none">
   <td colspan="5">&nbsp;</td>
  </tr>



</table>



<div style="float:left"><a href="#" id="btn_add_office_photo" class="button btn_add_office_photo"><span><?php echo BTN_ADD_PHOTO;?></span></a></div>

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
