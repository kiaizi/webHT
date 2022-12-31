<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
	
	define(ID,$_REQUEST['id']);
	

/*
	$sql = "select * from ".TB_ORDER_HOLDON_REASON_STATUS." as order_holdon_reason_status ";
	$sql .= " where ";
	$sql .= " id='".ID."' ";
	$edit_data = $G_DB_CONNECT->query_first($sql);

*/
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(DIR_COMMON."meta_header.php");?>
<script type="text/javascript" src="<?php echo DIR_THIS_MODULE_ACTION;?>main.js?v=2"></script>
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

 
 
 <table border="0" cellspacing="0" cellpadding="0" id="table_form">

 
 




<tr >
	<td colspan="3" style="background-color:#F5F5F5; color:#333; font-weight:bold; padding:5px;"><?php echo TITLE_PAYPAL ;?></td>

</tr>

   

   







   

<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_PAYPAL_ACCOUNT_TEST;?></td>
    <td>
	<?php
		$this_constant_id = 1;
		//getDataName(TB_CONFIG,"constant_value",$this_constant_id); 
	?>
    <input name="constant_id[]" id="constant_id[]"  value="<?php echo $this_constant_id; ?>" type="checkbox" checked="checked" style="display:none"/>
    <input name="constant_value<?php echo $this_constant_id; ?>" id="constant_value<?php echo $this_constant_id; ?>"  value="<?php echo getDataName(TB_CONFIG,"constant_value",$this_constant_id); ?>" label="<?php echo TITLE_PAYPAL_ACCOUNT_TEST; ?>" class="input_long" required="yes"  type="hidden"/>
    <?php echo getDataName(TB_CONFIG,"constant_value",$this_constant_id); ?>
    </td>
</tr>





<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_PAYPAL_ACCOUNT_REAL;?></td>
    <td>
	<?php
		$this_constant_id = 2;
	?>
    <input name="constant_id[]" id="constant_id[]"  value="<?php echo $this_constant_id; ?>" type="checkbox" checked="checked" style="display:none"/>
    <input name="constant_value<?php echo $this_constant_id; ?>" id="constant_value<?php echo $this_constant_id; ?>"  value="<?php echo getDataName(TB_CONFIG,"constant_value",$this_constant_id); ?>" label="<?php echo TITLE_PAYPAL_ACCOUNT_REAL; ?>" class="input_long" required="yes" /> 
    </td>
</tr>




<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_PAYPAL_LIVE_MODE;?></td>
    <td>
	<?php
		$this_constant_id = 3;
	?>
    <input name="constant_id[]" id="constant_id[]"  value="<?php echo $this_constant_id; ?>" type="checkbox" checked="checked" style="display:none"/>
   
    
    
            
<?php
		
   $sql = "select status_yesno.*, status_yesno_desc.name as name from ".TB_STATUS_YESNO." as status_yesno , ".TB_STATUS_YESNO_DESC." as status_yesno_desc ";
	$sql .= " where ";
	$sql .= " status_yesno.id=status_yesno_desc.status_yesno_id ";
	$sql .= " and status_yesno_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_yesno.id  ";
	$sql .= " order by status_yesno.sort_order asc ";
				

	printCustomMenu('constant_value'.$this_constant_id, $sql,'name','0',getDataName(TB_CONFIG,"constant_value",$this_constant_id),'','','','');
?>
        
    </td>
</tr>






<tr class="other_payment_paypal" >
	<td class="sign_must_enter"></td>
	<td class="title">&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr class="other_payment_paypal"  >
	<td class="sign_must_enter"></td>
	<td class="title">&nbsp;</td>
    <td style="background-color:#F5F5F5">


<p style="padding-left:0px;"><b><u>Please use the following testing account to test in testing environment :</u></b></p>


     <b>Login : hontin317@gmail.com<br>
      Password: demodemo2013</b>
      
     
	 
        
    </td>
</tr>









</table>  






<div id="table_form_bottom"></div>
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
