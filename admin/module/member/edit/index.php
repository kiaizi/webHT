<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
	
	define(ID,$_REQUEST['id']);
	

	$sql = "select * from ".TB_MEMBER." as member ";
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

<input name="ajax_json_path2" id="ajax_json_path2" value="<?php echo DIR_THIS_MODULE_ACTION."json_refresh_country_list.php"; ?>" type="hidden"/>


<?php
	if(ACTION == 2){
?>
 <div class="button_box" style="float:left; margin-left:20px">
    <ul>
    
 <li ><a href="index.php?sid=12&show_search=1&searching=1&search_by=member_username&mid=<?php echo ID;?>"  target="_blank"><span>訂單紀錄</span></a></li>
 <li style="display:none" ><a href="index.php?sid=10&show_search=1&searching=1&search_by=member_username&mid=<?php echo ID;?>"  target="_blank"><span>Member Expired Coin Record</span></a></li>
 
</ul>
</div>
  <div style="clear:both; padding-top:20px"></div>

<?php
	}
?>



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



<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title highlight">Bonus Points</td>
    <td>
    <?php
		if(ACTION == '1'){
			$edit_data['coin'] = DEFAULT_MEMBER_COIN;
		}
	?>
    
    <input  name="coin" id="coin"  value="<?php echo $edit_data['coin'] ?>"  class="input_middle" /></td>
    
</tr>







<tr style="display:none">
	<td class="sign_must_enter"></td>
	<td class="title highlight">Bonus Points Expiry Date</td>
    <td style="vertical-align:middle">

<table border="0" cellspacing="0" cellpadding="0" id="table_text">
  <tr>
    <td style="padding-bottom:0px;">
    
<?php
if($edit_data['coin_expiry_date'] == ''){
		
			
	$edit_data['expiry_date'] = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d"), date("Y")+1));
	//$edit_data['coin_expiry_date'] = '9999-12-31';


	
	
			
}
		
		
	
		
		
		
		
?>


<input  name="coin_expiry_date" id="coin_expiry_date"  value="<?php echo $edit_data['coin_expiry_date'] ?>" label="Bonus Points Expiry Date"  class="input_middle input_date" />
    
    </td>
 
  </tr>
</table>




    



    
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
	<td class="title"><?php echo TITLE_USERNAME; ?></td>
    <td><input  name="username" id="username"  value="<?php echo $edit_data['username'] ?>" label="<?php echo TITLE_USERNAME; ?>"  class="input_middle" required="yes"    warn_msg="<?php echo WARN_EMAIL;?>"/> </td>
</tr>
<tr>
	<td class="sign_must_enter" style="vertical-align:top; padding-top:7px;"><div id="require"></div></td>
	<td class="title" style="vertical-align:top"><?php echo TITLE_PASSWORD; ?></td>
    <td><input  name="password" id="password"  value="" label="<?php echo TITLE_PASSWORD; ?>"  class="input_middle" type="password"   warn_msg="<?php echo WARN_NEW_PASSWORD_LEN;?>" <?php echo NOTICE_PASSWORD; ?>  <?php if(ACTION == '1'){ echo 'required="yes" '; } ?>/>
    <div style="clear:both; padding-top:5px;"></div>
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
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_EMAIL; ?></td>
    <td><input  name="email" id="email"  value="<?php echo $edit_data['email'] ?>" label="<?php echo TITLE_EMAIL; ?>"  class="input_middle" required="yes"    warn_msg="<?php echo WARN_EMAIL;?>"/> </td>
</tr>


<tr style="display:none">
	<td class="sign_must_enter"><div id="require"></div></td>
     <td class="title"><?php echo TITLE_MEMBER_TITLE; ?></td>
    
    <td>
        

    
<?php
		
   $sql = "select title.*, title_desc.name as name from ".TB_TITLE." as title , ".TB_TITLE_DESC." as title_desc ";
	$sql .= " where ";
	$sql .= " title.id=title_desc.title_id ";
	$sql .= " and title_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " order by title.sort_order asc ";
				

	printCustomMenu('title', $sql,'name','0',$edit_data['title'],'','','','');
	
?>
    
    
    </td>
    
</tr>






<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_SURNAME_EN; ?></td>
    <td><input  name="surname_en" id="surname_en" required="yes" value="<?php echo $edit_data['surname_en'] ?>" label="<?php echo TITLE_SURNAME_EN; ?>"  class="input_middle" /></td>
    
</tr>

<tr >
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_GIVENNAME_EN; ?></td>
    <td><input  name="givenname_en" id="givenname_en" required="yes"  value="<?php echo $edit_data['givenname_en'] ?>" label="<?php echo TITLE_GIVENNAME_EN; ?>"  class="input_middle" /></td>
    
</tr>


<tr>
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title"><?php echo TITLE_MOBILE_NO; ?></td>
    <td><input  name="mobile_no" id="mobile_no"  value="<?php echo $edit_data['mobile_no'] ?>" label="<?php echo TITLE_MOBILE_NO; ?>"  class="input_middle" /></td>
    
</tr>


<tr>
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title"><?php echo TITLE_HOME_NO; ?></td>
    <td><input  name="home_no" id="home_no"  value="<?php echo $edit_data['home_no'] ?>" label="<?php echo TITLE_HOME_NO; ?>"  class="input_middle" /></td>
    
</tr>

<tr >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title">公司名稱</td>
    <td><input  name="company_name" id="company_name"  value="<?php echo $edit_data['company_name'] ?>" label="<?php echo TITLE_HOME_NO; ?>"  class="input_middle" /></td>
    
</tr>






<tr>
	<td class="sign_must_enter"><div id="require"></div></td>
	<td class="title"><?php echo TITLE_ADDRESS; ?> 1</td>
    <td><input  name="address_1" id="address_1" required="yes" value="<?php echo $edit_data['address_1'] ?>" label="<?php echo TITLE_ADDRESS; ?>"  class="input_middle" /></td>
    
</tr>
<tr >
	<td class="sign_must_enter"><div id="require2"></div></td>
	<td class="title"><?php echo TITLE_ADDRESS; ?> 2</td>
    <td><input  name="address_2" id="address_2"  value="<?php echo $edit_data['address_2'] ?>" label="<?php echo TITLE_ADDRESS; ?>"  class="input_middle" /></td>
    
</tr>


<tr>
	<td class="sign_must_enter"></td> <td class="title">地區</td>
    
    <td>
        

    
<?php
		
   $sql = "select country.*, country_desc.name as name from ".TB_COUNTRY." as country , ".TB_COUNTRY_DESC." as country_desc ";
	$sql .= " where ";
	$sql .= " country.id=country_desc.country_id ";
	$sql .= " and country_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and country.disabled=0 ";
	$sql .= " order by country.sort_order asc ";
				

	printCustomMenu('country', $sql,'name','0',$edit_data['country'],'',' ','','');
	
?>
    
    
    </td>
    
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


<input  name="expiry_date" id="expiry_date"  value="<?php echo $edit_data['expiry_date'] ?>" label="<?php echo TITLE_EXPIRY_DATE; ?>"  class="input_middle input_date" />
    
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
