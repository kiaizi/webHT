<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
	
	define(ID,$_REQUEST['id']);
	

	$sql = "select * from ".TB_WEBPAGE." as webpage ";
	$sql .= " where ";
	$sql .= " id='".ID."' ";
	$sql .= " and disabled <>'".DISABLED_DELETE."' ";
	$edit_data = $G_DB_CONNECT->query_first($sql);


	if(ID > 0 && $edit_data['id'] == ''){
		exit(WARN_ACCESS_DENIED);
	}
	
	
	
	

	
	
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
echo $G_DB_CONNECT->query_update_lang_content(TB_WEBPAGE, $update_data_lang, "  webpage_id='".$update_data['id']."'   ");
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
<input name="ajax_json_path_update_sort_order" id="ajax_json_path_update_sort_order" value="<?php echo DIR_THIS_MODULE_ACTION."ajax_json_update_sort_order.php"; ?>" type="hidden"/>
<input name="WARN_CHANGE_PASSWORD_FAILURE" id="WARN_CHANGE_PASSWORD_FAILURE" value="<?php echo WARN_CHANGE_PASSWORD_FAILURE;?>" type="hidden"/>

<input name="show_confirm_page" id="show_confirm_page" value="<?php echo $_REQUEST['show_confirm_page'] ;?>" type="hidden"/>
<input name="parent_webpage_id" id="parent_webpage_id" value="" type="hidden"/>
<?php
	if($_REQUEST['show_confirm_page'] == ''){
?>


   <table border="0" cellspacing="0" cellpadding="0" id="table_form" >
    <tr > 
    <td>
<?php
		
  	printLangInputField(TITLE_TITLE,"name",TB_WEBPAGE,$edit_data['id'],"name",true,"input_middle","",true);
	//printLangInputField(TITLE_TITLE,"name",TB_WEBPAGE,$edit_data['id'],"name",true);
			
			
?>
</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" id="table_form">

<tr>
<td class="highlight" style="padding-left:25px;">
<?php echo getLangName(TB_WEBPAGE,"name",$edit_data['id'],ADMIN_LANG_ID); ?>
</td>
</tr>
  </table> 



<table border="0" cellspacing="0" cellpadding="0" id="table_form" class="table_seo" >




<tr class="seo_row" style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_SEO_URL;?></td>
    <td>
    <input name="seo_url" id="seo_url"  value="<?php echo $edit_data['seo_url'] ?>" label="<?php echo TITLE_SEO_URL; ?>" class="input_seo_url"  />
    <?php echo TITLE_SEO_URL_HINT; ?>
    </td>
</tr>




<?php 
		
   	printLangInputField(TITLE_SEO_TITLE,"seo_title",TB_WEBPAGE,$edit_data['id'],"seo_title",false,"input_seo_title","",false,'class="seo_row"');
			
			
?>
   
   
   

<?php 

printLangTextAreaNormal(TITLE_SEO_DESC,"seo_desc",TB_WEBPAGE,$edit_data['id'],false,300,450,'','class="seo_row"');
?>

   <input type="hidden" name="original_url" id="original_url"  value="<?php echo $edit_data['original_url'] ?>" label="" class=" input_middle"/>
    
    
<tr class="seo_row">
	<td class="sign_must_enter"></td>
	<td class="title" style="vertical-align:top"><?php echo TITLE_SEO_KEYWORD;?></td>
    <td style="vertical-align:top;">

<textarea  name="seo_keyword" id="seo_keyword"  label="<?php echo TITLE_SEO_KEYWORD; ?>"    class="seo_keyword"/><?php echo $edit_data['seo_keyword'] ?></textarea>

<?php echo TITLE_SEO_KEYWORD_HINT; ?>

    </td>
</tr>



<?php 
		
   	printLangInputField(TITLE_H1,"seo_h1",TB_WEBPAGE,$edit_data['id'],"seo_h1",false,"input_seo_title","",false,'class="seo_row"');
			
			
?>


   
</table>  



<table border="0" cellspacing="0" cellpadding="0" id="table_form">







<tr style="display:none">
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




<tr  style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_SORT_ORDER; ?></td>
    <td>
    
    
    <?php
		if(ACTION == '1'){
			$edit_data['sort_order'] = getNextSortOrder(TB_WEBPAGE,"  id>0  ");
		}
		
		
	?>
    
    <input name="sort_order" id="sort_order"  value="<?php echo $edit_data['sort_order'] ?>" label="<?php echo TITLE_SORT_ORDER; ?>" class="numeric input_middle" required="yes"/>
    
    
    </td>
    
</tr>










   




























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
    
    <li  class="main" style="display:none"><a href="#" id="btn_back_to_list" class="btn_back_to_list"><span><?php echo BTN_BACK_TO_LIST;?></span></a></li>
    
<?php
	if(ACTION == 2){
?>
<?php
	if( !($edit_data['id'] == 10 || $edit_data['id'] == 14 || $edit_data['id'] == 13)){
?>

     <li style="display:none"><a href="#" class="btn_delete"><span><?php echo BTN_DELETE;?></span></a></li>
<?php
	}
?>
     
     
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
