<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
	
	define(ID,$_REQUEST['id']);
	

	$sql = "select * from ".TB_EMAIL_LIST." as email_list ";
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
<tr>
	<td class="sign_must_enter"></td> <td class="title"><?php echo TITLE_USER_DISABLED; ?></td>
    
    <td>
        

    
<?php
$sql = "select status_allow.*, status_allow_desc.name as name from ".TB_STATUS_ALLOW." as status_allow , ".TB_STATUS_ALLOW_DESC." as status_allow_desc ";
	$sql .= " where ";
	$sql .= " status_allow.id=status_allow_desc.status_allow_id ";
	$sql .= " and status_allow_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_allow.id  ";
	$sql .= " order by status_allow.sort_order asc ";
				

	printCustomMenu('disabled', $sql,'name','0',$edit_data['disabled'],'','','','');
	
?>
    
    
    </td>
    
</tr>


<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_NEWSLETTER; ?></td>
    
    <td>
        
<?php
$sql = "select status_yesno.*, status_yesno_desc.name as name from ".TB_STATUS_YESNO." as status_yesno , ".TB_STATUS_YESNO_DESC." as status_yesno_desc ";
	$sql .= " where ";
	$sql .= " status_yesno.id=status_yesno_desc.status_yesno_id ";
	$sql .= " and status_yesno_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_yesno.id  ";
	$sql .= " order by status_yesno.sort_order asc ";
				
    

	printCustomMenu('newsletter', $sql,'name','1',$edit_data['newsletter'],'','','','');
?>
    
    </td>
    
</tr>









<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_CODE;?></td>
    <td>
    <?php
		if(ACTION == '1'){
			$edit_data['code'] = generateMemberCode();
		}
	?>
    
    <input name="code" id="code"  value="<?php echo $edit_data['code'] ?>" label="<?php echo TITLE_CODE; ?>" class="input_middle" required="yes"/>
    </td>
</tr>
<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_EMAIL; ?></td>
    <td><input  name="username" id="username"  value="<?php echo $edit_data['username'] ?>" label="<?php echo TITLE_EMAIL; ?>"  class="input_middle" required="yes"    warn_msg="<?php echo WARN_EMAIL;?>"/> </td>
</tr>
<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_PASSWORD; ?></td>
    <td><input  name="password" id="password"  value="" label="<?php echo TITLE_PASSWORD; ?>"  class="input_middle" type="password"   warn_msg="<?php echo WARN_NEW_PASSWORD_LEN;?>" <?php echo NOTICE_PASSWORD; ?>  <?php if(ACTION == '1'){ echo 'required="yes" '; } ?>/>
<?php
		if(ACTION == '2'){
			 echo  NOTICE_EMPTY_MEAN_NOT_CHANGE; 
		}else{
			 echo  NOTICE_PASSWORD;
		}
?>

    </td>
</tr>



<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_TITLE; ?></td>
    <td><input  name="title" id="title"  value="<?php echo $edit_data['title'] ?>" label="<?php echo TITLE_TITLE; ?>"  class="input_middle" /></td>
    
</tr>


<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_SURNAME_EN; ?></td>
    <td><input  name="surname_en" id="surname_en"  value="<?php echo $edit_data['surname_en'] ?>" label="<?php echo TITLE_SURNAME_EN; ?>"  class="input_middle" required="yes"/></td>
    
</tr>

<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_GIVENNAME_EN; ?></td>
    <td><input  name="givenname_en" id="givenname_en"  value="<?php echo $edit_data['givenname_en'] ?>" label="<?php echo TITLE_GIVENNAME_EN; ?>"  class="input_middle" required="yes"/></td>
    
</tr>




<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_BIRTH;?></td>
    <td style="vertical-align:middle">

<table border="0" cellspacing="0" cellpadding="0" id="table_text">
  <tr>
    <td style="padding-bottom:0px;">
    
<?php
if($edit_data['birth'] == ''){
		
			
	$edit_data['birth'] = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
	//$edit_data['birth'] = '9999-12-31';


	
	
			
}
		
		
	
		
		
		
		
?>
<?php
echo "<SCRIPT>";?>
					
					DateInput('birth', true, 'YYYY-MM-DD','<?php
echo $edit_data['birth']; ?>')

<?php
echo "</SCRIPT>"; ?>	
    
    </td>
 
  </tr>
</table>




    



    
    </td>
</tr>

<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_HOME_NO; ?></td>
    <td><input  name="home_no" id="home_no"  value="<?php echo $edit_data['home_no'] ?>" label="<?php echo TITLE_HOME_NO; ?>"  class="input_middle"  /></td>
    
</tr>

<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_MOBILE_NO; ?></td>
    <td><input  name="mobile_no" id="mobile_no"  value="<?php echo $edit_data['mobile_no'] ?>" label="<?php echo TITLE_MOBILE_NO; ?>"  class="input_middle"  /></td>
    
</tr>



<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_GENDER; ?></td>
    
    <td>
        
<?php
$sql = "select gender.*, gender_desc.name as name from ".TB_GENDER." as gender , ".TB_GENDER_DESC." as gender_desc ";
	$sql .= " where ";
	$sql .= " gender.id=gender_desc.gender_id ";
	$sql .= " and gender_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by gender.id  ";
	$sql .= " order by gender.sort_order asc ";
				

	printCustomMenu('gender', $sql,'name','',$edit_data['gender'],'','','','');
?>
    
    </td>
    
</tr>





<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_ADDRESS_1; ?></td>
    <td><input  name="address_1" id="address_1"  value="<?php echo $edit_data['address_1'] ?>" label="<?php echo TITLE_ADDRESS_1; ?>"  class="input_middle" /></td>
    
</tr>

<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_ADDRESS_2; ?></td>
    <td><input  name="address_2" id="address_2"  value="<?php echo $edit_data['address_2'] ?>" label="<?php echo TITLE_ADDRESS_1; ?>"  class="input_middle" /></td>
    
</tr>


<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_AREA; ?></td>
    <td><input  name="area" id="area"  value="<?php echo $edit_data['area'] ?>" label=""  class="input_middle" /></td>
    
</tr>



<tr class="sender_info">
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_COUNTRY; ?></td>
    <td>
    
    
<?php
$sql = "select country.*, country_desc.name as name from ".TB_COUNTRY." as country , ".TB_COUNTRY_DESC." as country_desc ";
	$sql .= " where ";
	$sql .= " country.id=country_desc.country_id ";
	$sql .= " and country_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by country.id  ";
	$sql .= " order by country_desc.name asc ";
				

	printCustomMenu('country', $sql,'name','1',$edit_data['country'],'','','','');
?>

</td>
</tr>





<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_PROVINCE; ?></td>
    <td><input  name="province" id="province"  value="<?php echo $edit_data['province'] ?>" label=""  class="input_middle" /></td>
    
</tr>



<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_POST_CODE; ?></td>
    <td><input  name="post_code" id="post_code"  value="<?php echo $edit_data['post_code'] ?>" label=""  class="input_middle" /></td>
    
</tr>



<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_FAX; ?></td>
    <td><input  name="fax" id="fax"  value="<?php echo $edit_data['fax'] ?>" label="<?php echo TITLE_FAX; ?>"  class="input_middle" /></td>
    
</tr>








<tr>
	<td class="sign_must_enter"></td>
	<td class="title vtop"><?php echo TITLE_REMARK; ?></td>
    <td><textarea  name="remark" id="remark"  label="<?php echo TITLE_REMARK; ?>"    class="input_middle"/><?php echo $edit_data['remark'] ?></textarea></td>
    
</tr>


<tr>
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_EXPIRY_DATE;?></td>
    <td style="vertical-align:middle">

<table border="0" cellspacing="0" cellpadding="0" id="table_text">
  <tr>
    <td style="padding-bottom:0px;">
    
<?php
if($edit_data['expiry_date'] == ''){
		
			
	//$edit_data['expiry_date'] = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
	$edit_data['expiry_date'] = '9999-12-31';


	
	
			
}
		
		
	
		
		
		
		
?>
<?php
echo "<SCRIPT>";?>
					
					DateInput('expiry_date', true, 'YYYY-MM-DD','<?php
echo $edit_data['expiry_date']; ?>')

<?php
echo "</SCRIPT>"; ?>	
    
    </td>
 
  </tr>
</table>




    



    
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
<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title"><?php echo TITLE_LAST_LOGIN_DATE; ?></td>
     <td><?php echo $edit_data['last_login_date']; ?></td>
     
</tr>
<?php
	}
?>







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
