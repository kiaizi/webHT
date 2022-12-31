<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(DIR_COMMON."meta_header.php");?>
<script type="text/javascript" src="js/list.js?v=<?php echo date('Ymdhis')?>"></script>
<script type="text/javascript" src="<?php echo DIR_THIS_MODULE_ACTION;?>main.js?v=<?php echo date('Ymdhis')?>"></script>
</head>
<body style="width:1900px;">
<div id="container">
<?php include(DIR_COMMON."header.php");?>
<div id="main_content_container">
<div id="inside_content"><a href="#anchor_inside_content"></a>
<form name="frm_this_page"  id="frm_this_page" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>"  target="_self" autocomplete="off">
<input name="id" id="id" value="" type="hidden"/>
<input name="sid" id="sid" value="<?php echo SID; ?>" type="hidden"/>
<input name="action" id="action" value="<?php echo ACTION; ?>" type="hidden"/>


<input name="orderby" id="orderby" value="<?php echo getRequestVar('orderby','sort_order'); ?>" type="hidden" />
<input name="order" id="order" value="<?php echo getRequestVar('order','asc'); ?>" type="hidden"/>
<input name="ajax_json_path" id="ajax_json_path" value="<?php echo DIR_THIS_MODULE_ACTION."ajax_json_getlist.php"; ?>" type="hidden"/>
<input name="show_search" id="show_search" value="<?php echo $_REQUEST['show_search']; ?>" type="hidden"/>
<input name="page" id="page" value="<?php echo $_REQUEST['page']; ?>" type="hidden"/>
<input name="list_action_now" id="list_action_now" value="<?php echo $_REQUEST['list_action']; ?>" type="hidden"/>
<input name="searching" id="searching" value="<?php echo $_REQUEST['searching']; ?>" type="hidden"/>
<input name="NOTICE_SEARCH_RESULT" id="NOTICE_SEARCH_RESULT" value="<?php echo NOTICE_SEARCH_RESULT; ?>" type="hidden"/>


<input name="WARN_ARE_YOU_CONFIRM" id="WARN_ARE_YOU_CONFIRM" value="<?php echo WARN_ARE_YOU_CONFIRM; ?>" type="hidden"/>
<input name="DIALOG_CONFIRM_BTN_CONFIRM" id="DIALOG_CONFIRM_BTN_CONFIRM" value="<?php echo DIALOG_CONFIRM_BTN_CONFIRM; ?>" type="hidden"/>
<input name="DIALOG_CONFIRM_BTN_CANCEL" id="DIALOG_CONFIRM_BTN_CANCEL" value="<?php echo DIALOG_CONFIRM_BTN_CANCEL; ?>" type="hidden"/>

<input name="update_sort_order_data_id" id="update_sort_order_data_id" value="" type="hidden"/>
<input name="update_sort_order" id="update_sort_order" value="" type="hidden"/>

<!-- table_layout (start) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_layout">
  <tr>
    <td id="panel_left_menu" style="display:none"><?php include(DIR_COMMON."leftmenu.php");?></td>   
	<td  id="panel_content" style="padding-left:20px;">

    
    


<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_section" >
<tr>
<td><?php include(DIR_COMMON."mainnav.php");?></td>
<td><?php include(DIR_COMMON."record_per_page_area.php");?></td>
</tr>
</table>












<?php
	include(DIR_THIS_MODULE_ACTION."search.php");
?>













<!-- action area (start) -->
<div id="action_area">
<table width="100%" border="0" cellspacing="0" cellpadding="0"   id="table_section">
  <tr>
    <td>
    
<table  border="0" cellspacing="0" cellpadding="0" id="table_search" >
  <tr>
    <td>
<?php
		$arr_option_list = array(
						array(  
                    		LIST_ACTION_DISABLE ,
							'1'
						),
						array(  
                    		LIST_ACTION_ENABLE ,
							'2'
						) 
						
						,
						array(  
                    		LIST_ACTION_DELETE ,
							'3'
						) 
						
         );  

		 
		printCustomListFromArray("list_action",$arr_option_list,'','');
			 
?>

    </td>
    <td><a href="#" class="button" id="btn_list_action"><span><?php echo BTN_CONFIRM ?></span></a></td>
  </tr>
</table>
 
    </td>
    <td id="notice_search_result" class="warm_msg">&nbsp; </td>
    <td>
    
 <div class="button_box">
    <ul>
    <li class="main"><a href="#" id="btn_add"><span><?php echo BTN_ADD; ?></span></a></li>
    <li><a href="#" id="btn_show_all"><span><?php echo BTN_SHOW_ALL; ?></span></a></li>
    <li><a href="#" id="btn_show_search_area"><span><?php echo BTN_SEARCH; ?></span></a></li>
    </ul>
    </div>
    </td>
  </tr>
</table>
</div>
<!-- action area (end) -->







<!-- main_content_area (start) -->
<div id="main_content_area">
<!-- list record table (start) -->
<div class="paging_content"></div>
<div id="table_list_content">
</div>
<div class="paging_content"></div>
<!-- list record table (end) -->
</div>
<!-- main_content_area (end) -->
<div id="confirm_msg">
</div>

<?php include(DIR_COMMON."loading.php");?>










    
    </td>
  </tr>
</table>
<!-- table_layout (end) -->
</form>
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
