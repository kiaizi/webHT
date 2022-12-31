<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(DIR_COMMON."meta_header.php");?>
<script type="text/javascript" src="js/list.js"></script>
<script type="text/javascript" src="<?php echo DIR_THIS_MODULE_ACTION;?>main.js"></script>
</head>
<body>
<div id="container">
<?php include(DIR_COMMON."header.php");?>
<div id="main_content_container">
<div id="inside_content"><a href="#anchor_inside_content"></a>
<form name="frm_this_page"  id="frm_this_page" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>"  target="_self" autocomplete="off">
<input name="id" id="id" value="" type="hidden"/>
<input name="sid" id="sid" value="<?php echo SID; ?>" type="hidden"/>
<input name="action" id="action" value="<?php echo ACTION; ?>" type="hidden"/>


<input name="orderby" id="orderby" value="<?php echo getRequestVar('orderby','code'); ?>" type="hidden"/>
<input name="order" id="order" value="<?php echo getRequestVar('order','desc'); ?>" type="hidden"/>
<input name="ajax_json_path" id="ajax_json_path" value="<?php echo DIR_THIS_MODULE_ACTION."ajax_json_getlist.php"; ?>" type="hidden"/>
<input name="show_search" id="show_search" value="<?php echo getRequestVar('show_search','1'); ?>" type="hidden"/>
<input name="page" id="page" value="<?php echo $_REQUEST['page']; ?>" type="hidden"/>
<input name="list_action_now" id="list_action_now" value="<?php echo $_REQUEST['list_action']; ?>" type="hidden"/>
<input name="searching" id="searching" value="<?php echo $_REQUEST['searching']; ?>" type="hidden"/>
<input name="NOTICE_SEARCH_RESULT" id="NOTICE_SEARCH_RESULT" value="<?php echo NOTICE_SEARCH_RESULT; ?>" type="hidden"/>


<input name="WARN_ARE_YOU_CONFIRM" id="WARN_ARE_YOU_CONFIRM" value="<?php echo WARN_ARE_YOU_CONFIRM; ?>" type="hidden"/>
<input name="DIALOG_CONFIRM_BTN_CONFIRM" id="DIALOG_CONFIRM_BTN_CONFIRM" value="<?php echo DIALOG_CONFIRM_BTN_CONFIRM; ?>" type="hidden"/>
<input name="DIALOG_CONFIRM_BTN_CANCEL" id="DIALOG_CONFIRM_BTN_CANCEL" value="<?php echo DIALOG_CONFIRM_BTN_CANCEL; ?>" type="hidden"/>
<div style="display:none">
<a class="button" id="btn_print_order_form" href="index.php?sid=19&member_id=1" rel="lyteframe" title="" rev="width: 800px; height: 250px; scrolling: auto;" ><span><?php echo BTN_PRINT_ORDER_FORM; ?></span></a></div>
<!-- table_layout (start) -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_layout">
  <tr>
    <td id="panel_left_menu"><?php include(DIR_COMMON."leftmenu.php");?></td>   
	<td  id="panel_content">

    
    




<div style="padding:200px;" align="center">
<?php echo WARN_UNDER_CONSTRUCTION; ?>
</div>


















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
