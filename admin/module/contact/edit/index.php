<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
	
	//define(ID,$_REQUEST['id']);
	$_REQUEST['id'] = SID;
	define(ID,$_REQUEST['id']);
	

	$sql = "select * from ".TB_WEBPAGE." as webpage ";
	$sql .= " where ";
	$sql .= " id='".ID."' ";
	$edit_data = $G_DB_CONNECT->query_first($sql);






/////////////////////////////////////////////
// upload file
/////////////////////////////////////////////
$arr_webpage_photo_language_id = getRequestVar("webpage_photo_language_id",'');
$arr_webpage_photo_sort_order = getRequestVar("webpage_photo_sort_order",'');
$arr_webpage_photo_disabled = getRequestVar("webpage_photo_disabled",'');
$arr_webpage_photo_img_old_path = getRequestVar("webpage_photo_img_old_path",'');
if($arr_webpage_photo_disabled != '' && ID > 0){

	$webpage_id = ID;
	//$webpage_code = getDataName(TB_WEBPAGE,"code",$webpage_id);
	$sql = "delete from ".TB_WEBPAGE_PHOTO." where webpage_id='".$webpage_id."'";
	$G_DB_CONNECT->query($sql);

	for ($i=0; $i<count($arr_webpage_photo_disabled); $i++) {

		$webpage_photo_img_old_path = $arr_webpage_photo_img_old_path[$i];

		$dir = "upload/images/banner/";
		$file_name = "webpage_photo_img";
		////////////////////////////////////////////////
		$tempFile = $_FILES[$file_name]['tmp_name'][$i];
		if($tempFile != ''){
			$targetPath = CURRENT_DOCUMENT_ROOT . $dir ;
			$ext = get_extension($_FILES[$file_name]['name'][$i]);
			//$new_file_name = $webpage_code."_".date("YmdHis")."_".getLastID(TB_WEBPAGE_PHOTO).$ext;
			$new_file_name = date("YmdHis")."_".getLastID(TB_WEBPAGE_PHOTO).$ext;
  			$targetFile =  str_replace('//','/',$targetPath) .$new_file_name ;
			move_uploaded_file($tempFile,$targetFile);
			$targetFile =$dir.$new_file_name;
			////////////////////////////////////////////////
			$update_webpage_photo_data = array();
			$update_webpage_photo_data['language_id'] = $arr_webpage_photo_language_id[$i];
			$update_webpage_photo_data['img'] = $targetFile;
			$update_webpage_photo_data['sort_order'] = $arr_webpage_photo_sort_order[$i];
			$update_webpage_photo_data['disabled'] = $arr_webpage_photo_disabled[$i];
			$update_webpage_photo_data['webpage_id'] = $webpage_id;
			$update_webpage_photo_data['create_date'] = 'null';
			$update_webpage_photo_data['create_by'] = '';
			$update_webpage_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_WEBPAGE_PHOTO, $update_webpage_photo_data);
		////////////////////////////////////////////////
			smart_resize_image( "../".$targetFile,"thumb", 1000, 5000, true);
			smart_resize_image( "../".$targetFile,"img", 1000, 8000, true);

		
		}else if($webpage_photo_img_old_path != ''){
			////////////////////////////////////////////////
			$update_webpage_photo_data = array();
			$update_webpage_photo_data['language_id'] = $arr_webpage_photo_language_id[$i];
			$update_webpage_photo_data['img'] = $webpage_photo_img_old_path;
			//$update_webpage_photo_data['webpage_color_id'] = $arr_webpage_photo_webpage_color_id[$i];
			$update_webpage_photo_data['sort_order'] = $arr_webpage_photo_sort_order[$i];
			$update_webpage_photo_data['disabled'] = $arr_webpage_photo_disabled[$i];
			$update_webpage_photo_data['webpage_id'] = $webpage_id;
			$update_webpage_photo_data['create_date'] = 'null';
			$update_webpage_photo_data['create_by'] = '';
			$update_webpage_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_WEBPAGE_PHOTO, $update_webpage_photo_data);
			////////////////////////////////////////////////
	
		}
	
	}
}

//renewSortOrder(TB_WEBPAGE_PHOTO,"webpage_id='".ID."'");


	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(DIR_COMMON."meta_header.php");?>
<script type="text/javascript" src="<?php echo DIR_THIS_MODULE_ACTION;?>main.js"></script>
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
echo $G_DB_CONNECT->query_update_lang_content(TB_ORDER_HOLDON_REASON_STATUS, $update_data_lang, "  order_holdon_reason_status_id='".$update_data['id']."'   ");
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
	<td class="sign_must_enter"><div id="require"></div></td>
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
		
   	printLangInputField(TITLE_SEO_TITLE,"seo_title",TB_WEBPAGE,$edit_data['id'],"seo_title",false,"input_seo_title","",false,'class="seo_row"');
			
			
?>
   
   
   

<?php

printLangTextAreaNormal(TITLE_SEO_DESC,"seo_desc",TB_WEBPAGE,$edit_data['id'],false,300,450,'','class="seo_row"');
?>



</table>  





<div style="clear:both; padding-top:20px;"></div>
<a href="#" class="button btn_edit_seo"><span><?php echo BTN_EDIT_SEO;?></span></a>
<div style="clear:both; padding-top:20px;"></div>



<table border="0" cellspacing="0" cellpadding="0" id="table_form" >

        

<?php
	$other_title = "";

?>



<tr>
	<td class="sign_must_enter" style="background-color:#F5F5F5; "><div id="require2"></div></td>
<td colspan="2" class="title" style="background-color:#F5F5F5; color:#333; font-weight:bold; ">联系方式</td>

</tr>


<tr>
	<td class="sign_must_enter" ><div id="require2"></div></td>
<td colspan="2" class="title" >&nbsp;</td>

</tr>




<?php

//printLangTextAreaNormal('服務時間',"office_hr_normal",TB_WEBPAGE,$edit_data['id'],false,100,510);
	
printLangTextAreaNormal('地址',"address",TB_WEBPAGE,$edit_data['id'],false,50,510);
	

?>
   
<tr  >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电话	</td>
    <td>

    <input name="tel" id="tel"  value="<?php echo $edit_data['tel']; ?>" class="input_middle"   /> 
    </td>
</tr>
<tr  >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">传真		</td>
    <td>

    <input name="fax" id="fax"  value="<?php echo $edit_data['fax']; ?>" class="input_middle"   /> 
    </td>
</tr>

<tr  style="display:none">
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电邮	</td>
    <td>

    <input name="email" id="email"  value="<?php echo $edit_data['email']; ?>" class="input_middle"   /> 
    </td>
</tr>

<tr>
	<td class="sign_must_enter" ><div id="require2"></div></td>
<td colspan="2" class="title" >&nbsp;</td>

</tr>


<tr>
	<td class="sign_must_enter" style="background-color:#F5F5F5; "><div id="require2"></div></td>
<td colspan="2" class="title" style="background-color:#F5F5F5; color:#333; font-weight:bold; ">交易热线（24小时服务）</td>

</tr>

<tr>
	<td class="sign_must_enter" ><div id="require2"></div></td>
<td colspan="2" class="title" >&nbsp;</td>

</tr>



   
<tr  >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电话	</td>
    <td>

    <input name="tel2" id="tel2"  value="<?php echo $edit_data['tel2']; ?>" class="input_middle"   /> 
    </td>
</tr>


<tr>
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电邮	</td>
    <td>

    <input name="email2" id="email2"  value="<?php echo $edit_data['email2']; ?>" class="input_middle"   /> 
    </td>
</tr>
<tr>
	<td class="sign_must_enter" ><div id="require2"></div></td>
<td colspan="2" class="title" >&nbsp;</td>

</tr>

<tr>
	<td class="sign_must_enter" style="background-color:#F5F5F5; "><div id="require2"></div></td>
<td colspan="2" class="title" style="background-color:#F5F5F5; color:#333; font-weight:bold; ">出入金及账户服务</td>

</tr>


<tr>
	<td class="sign_must_enter" ><div id="require2"></div></td>
<td colspan="2" class="title" >&nbsp;</td>

</tr>



   
<tr  >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电话	</td>
    <td>

    <input name="tel3" id="tel3"  value="<?php echo $edit_data['tel3']; ?>" class="input_middle"   /> 
    </td>
</tr>


<tr>
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电邮	</td>
    <td>

    <input name="email3" id="email3"  value="<?php echo $edit_data['email3']; ?>" class="input_middle"   /> 
    </td>
</tr>
<tr>
	<td class="sign_must_enter" ><div id="require2"></div></td>
<td colspan="2" class="title" >&nbsp;</td>

</tr>

<tr>
	<td class="sign_must_enter" style="background-color:#F5F5F5; "><div id="require2"></div></td>
<td colspan="2" class="title" style="background-color:#F5F5F5; color:#333; font-weight:bold; ">投诉</td>

</tr>

<tr>
	<td class="sign_must_enter" ><div id="require2"></div></td>
<td colspan="2" class="title" >&nbsp;</td>

</tr>




   
<tr  >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电话	</td>
    <td>

    <input name="tel4" id="tel4"  value="<?php echo $edit_data['tel4']; ?>" class="input_middle"   /> 
    </td>
</tr>


<tr>
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">电邮	</td>
    <td>

    <input name="email4" id="email4"  value="<?php echo $edit_data['email4']; ?>" class="input_middle"   /> 
    </td>
</tr>



<?php

//	printLangTextAreaNormal("Banner (Text)","name2",TB_WEBPAGE,$edit_data['id'],false,100,490);

?>

<tr  style="display:none">
	<td colspan="3" >&nbsp;</td>

</tr>

<tr  style="display:none">
	<td colspan="3" style="background-color:#F5F5F5; color:#333; font-weight:bold; padding:5px;">Contact Us Email</td>

</tr>



<tr  style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title">Name</td>
    <td>
	<?php
		$this_constant_id = 26;
		//getDataName(TB_CONFIG,"constant_value",$this_constant_id); 
	?>
    <input name="constant_id[]" id="constant_id[]"  value="<?php echo $this_constant_id; ?>" type="checkbox" checked="checked" style="display:none"/>
    <input name="constant_value<?php echo $this_constant_id; ?>" id="constant_value<?php echo $this_constant_id; ?>"  value="<?php echo getDataName(TB_CONFIG,"constant_value",$this_constant_id); ?>" label="<?php echo TITLE_CONTACT_FORM_EMAIL_TO_NAME; ?>" class="input_long"  required="yes" /> 
    </td>
</tr>



   
<tr  style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title">Email</td>
    <td>
	<?php
		$this_constant_id = 27;
		//getDataName(TB_CONFIG,"constant_value",$this_constant_id); 
	?>
    <input name="constant_id[]" id="constant_id[]"  value="<?php echo $this_constant_id; ?>" type="checkbox" checked="checked" style="display:none"/>
    <input name="constant_value<?php echo $this_constant_id; ?>" id="constant_value<?php echo $this_constant_id; ?>"  value="<?php echo getDataName(TB_CONFIG,"constant_value",$this_constant_id); ?>" label="<?php echo TITLE_CONTACT_FORM_EMAIL_TO; ?>" class="input_long"  required="yes" /> 
    </td>
</tr>


</table>  





<?php
	if(ID == 9999){
?>
<p ><b>Left Image</b></p>


<table border="0" cellspacing="0" cellpadding="0" id="table_form" width="100%" >






<tr>

	
<td style="padding-top:0px;">

<div class="notice_msg" style="display:none" ><?PHP echo NOTICE_SHOW_ONLY_FIRST_PHOTO; ?></div>

<table border="0" cellspacing="2" cellpadding="0"  id="table_text2">

  <tr>
  	 <td style="vertical-align:top">Photo
     <br>
     <?php echo NOTICE_BEST_VIEW_PART_1; ?><?php echo TITLE_WIDTH; ?> : 1000, <?php echo TITLE_HEIGHT; ?> : 1000 <?php echo NOTICE_BEST_VIEW_PART_2; ?>
     <br><?php echo NOTICE_FILE_FORMAT; ?> jpg, png, gif</td>
      <td  style="vertical-align:top; display:none"><?php echo TITLE_LANG ?></td>
      <td style="vertical-align:top;display:none  "><?php echo TITLE_SORT_ORDER ?></td>
       <td style="vertical-align:top;display:none "><?php echo TITLE_DISABLED ?></td>
        <td style="vertical-align:top">&nbsp;</td>
 </tr>

<?php
	$this_dynamic_area_id = "dynamic_webpage_photo";
?>

  <tr id="<?php echo $this_dynamic_area_id; ?>">
    <td>


<input name="webpage_photo_img" id="webpage_photo_img"  value="" label="<?php echo TITLE_IMG;?>" type="file" class="input_file file_upload"/>
<input name="webpage_photo_img_old_path"  id="webpage_photo_img_old_path" value="" type="hidden"/>
    </td>
    
    
 <td style="display:none">
    
<?php
		
 	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('webpage_photo_language_id', $sql,'name','0','','','','','');
?>
    
    </td>
    
 <td style="display:none"><input name="webpage_photo_sort_order" id="webpage_photo_sort_order"  value="" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    

    
 <td style="display:none">
     
     
<?php
		
  $sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('webpage_photo_disabled', $sql,'name','0','','','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#" style="display:none" class="button btn_remove_webpage_photo"  ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  

  
  
  
  
  
<?php
	
	$photo_width = 600;
	$photo_height = 5000;
	
	$i = 0;
  	$sql = "select * from ".TB_WEBPAGE_PHOTO." as webpage_photo  ";
	$sql .= " where webpage_id='".ID."' ";
	$sql .= " order by language_id asc,sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){

				$this_index = ++$i;
					
				$webpage_photo_img = "../".$data['img'];
				$arr_file_info = getImageInfo($webpage_photo_img,"thumb",$photo_width,$photo_height);
				$webpage_photo_img_thumb = $arr_file_info["src"];
				
				//$arr_file_info["width"]
				//$arr_file_info["height"]

					
?>
  
<tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>" class="<?php echo $this_dynamic_area_id; ?>">
   
    <td style="text-align:center; vertical-align:middle;background-color:#F9F9F9">
<div align="center">
<div style="width:<?php echo $photo_width; ?>px; vertical-align:middle">
<a href="<?php echo $webpage_photo_img; ?>" target="_blank"><img src="<?php echo $webpage_photo_img_thumb?>"  style="margin-bottom:10px;" align="middle" width="<?php echo $arr_file_info['width'] ?>" height="<?php echo $arr_file_info['height'] ?>"/></a>
</div>
</div>
<br>
<input name="webpage_photo_img[]" id="webpage_photo_img[]"  value="" label="<?php echo TITLE_PHOTO;?>" type="file" class="input_file img_upload"/>
<input name="webpage_photo_img_old_path[]"  id="webpage_photo_img_old_path[]" value="<?php echo $data['img']; ?>" type="hidden"/>
    </td>
    
    <td style="display:none">
     
<?php
		
 	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= "for_front_page='1' order by sort_order";
				

	printCustomMenu('webpage_photo_language_id[]', $sql,'name','0',$data['language_id'],'','','','');
?>
     
     </td>
    
    
    
   <td  style="display:none"><input name="webpage_photo_sort_order[]" id="webpage_photo_sort_order[]"  value="<?php echo $data['sort_order']; ?>" label="<?php echo TITLE_SORT_ORDER;?>" class="input_short sort_order"   maxlength="5"/></td>
    
    
    
 
    
    <td style="display:none">
     
<?php
		
    $sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				
				

	printCustomMenu('webpage_photo_disabled[]', $sql,'name','0',$data['disabled'],'','','','');
?>
    
     
     
     
     
     </td>
    <td style="width:250px;"><a href="#" style="display:none"  class="button btn_remove_webpage_photo"   ><span><?php echo BTN_REMOVE;?></span></a></td>
  </tr>
  
  
<?php
	
	
		}
	}
					
?>
  
  
  
  
  
  

  <tr id="dynamic_webpage_photo_footer" style="display:none">
   <td colspan="5">&nbsp;</td>
  </tr>



</table>



<div style="float:left;"><a href="#" style="display:none" id="btn_add_webpage_photo" class="button btn_add_webpage_photo" ><span><?php echo BTN_ADD_PHOTO;?></span></a></div>

</td>
</tr>










</table>  



<?php
	} //if($_REQUEST['show_confirm_page'] != '1'){
?>





<div id="table_form_bottom"></div>
<?php
	} //if($_REQUEST['show_confirm_page'] != '1'){
?>
<?php include(DIR_COMMON."print_list_search.php"); ?>
</form>
<?php include(DIR_COMMON."print_list_search.php"); ?>
</form>
<form name="frm_reset"  id="frm_reset" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>"  target="_self" autocomplete="off">
<input name="id" id="id" value="<?php echo $_REQUEST['id']; ?>" type="hidden"/>
<input name="sid" id="sid" value="<?php echo SID; ?>" type="hidden"/>
<input name="action" id="action" value="<?php echo ACTION; ?>" type="hidden"/>
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
    

    
    <li><a href="#" id="btn_reset2"><span><?php echo BTN_RESET;?></span></a></li>
    
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
