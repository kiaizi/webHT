<?php 
	$_REQUEST['sid'] = -1;
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
 if(!$_SESSION['already_login']){
 		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(DIR_COMMON."meta_header.php");?>


<script language="javascript">
$(document).ready(function(){
  $('#old_password').focus();
  $("form input").keypress(function (e) {  
         if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {  
             $('#btn_confirm').click();  
             return false;  
         } else {  
             return true;  
         }  
  });  
}); 
function validForm() {
	var err_msg = '';
    $(":input[required=yes], :input[required=true], :input[required=required]").each(function(i) { 	
          if ((this.type == 'radio') || (this.type == 'checkbox')) {  
          } else {	
				if($(this).val() == '' ){
					err_msg += $(this).attr('label')+"<br>";

				}else{
					///////////////////////////////////////////////////// 
					if($(this).attr('name') == 'password' && $(this).val().length < 6){
						err_msg += $(this).attr('warn_msg')+"<br>";
					}
					///////////////////////////////////////////////////// 
					if($(this).attr('name') == 'confirm_password' && $(this).val() !=  $('#password').val()   ){
						err_msg += $(this).attr('warn_msg')+"<br>";
					}
					///////////////////////////////////////////////////// 
				}
          }	
     });	
	///////////////////////////////////////////////////// 
	if ( err_msg != "" ){
	  	 openDialog($('#DIALOG_TITLE').val(),err_msg);
	     return;
	}else{	
		 submitForm("frm_this_page");     
	}
	/////////////////////////////////////////////////////	  
}	
function submitForm(this_form){
	// When the form is submitted
	//$("#frm_this_page").submit(function(){  
		start_loading();
		// -- Start AJAX Call --	
		var ajax_json_path = $('#frm_this_page #ajax_json_path').val();
		var params= $("#"+this_form).serialize(); 
		//alert( params);
     		
			$.ajax({
       		url:ajax_json_path, 
       		type:'post',         
       		dataType:'json',     
      		data:params,         
       		success: function(json){
					finish_loading();  		
					if(json.success){
						show_confirm_page();
					}else{
						$('#warn_msg').html(json.warn_msg);
						
					}
 				}  ,  
			  error: function(json){  
			  		//alert('error');
				} 
     		});	
		// -- End AJAX Call --
		return false;
	//});
}
</script>


</head>
<body>
<div id="container">
<?php include(DIR_COMMON."header.php");?>
<div id="main_content_container">
<div id="inside_content">
<!-- table_layout (start) -->

<p class="section_leftmenu_title"><?php echo TITLE_CHANGE_PASSWORD;?></p>






<!-- main_content_area (start) -->
<div id="main_content_area">
<form name="frm_this_page"  id="frm_this_page" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>"  target="_self" autocomplete="off">
<input name="ajax_json_path" id="ajax_json_path" value="<?php echo "ajax_json_change_password.php"; ?>" type="hidden"/>
<input name="WARN_CHANGE_PASSWORD_FAILURE" id="WARN_CHANGE_PASSWORD_FAILURE" value="<?php echo WARN_CHANGE_PASSWORD_FAILURE;?>" type="hidden"/>
<table  border="0" cellspacing="0" cellpadding="0" id="table_change_password">
  <tr>
    <td colspan="2" id="warn_msg">&nbsp;</td>
  </tr>
  <tr>
    <td class="title"><?php echo TITLE_OLD_PASSWORD;?></td>
    <td><input name="old_password" id="old_password" class="input_login" type="password" label="<?php echo TITLE_OLD_PASSWORD;?>" required="yes" maxlength="30"/></td>
  </tr>
    <tr>
    <td class="title"><?php echo TITLE_NEW_PASSWORD;?></td>
    <td><input name="password" id="password" class="input_login" type="password"  label="<?php echo TITLE_NEW_PASSWORD;?>" required="yes" maxlength="30"   warn_msg="<?php echo WARN_NEW_PASSWORD_LEN;?>"/></td>
  </tr>
   <tr>
    <td class="title"><?php echo TITLE_CONFIRM_NEW_PASSWORD;?></td>
    <td><input name="confirm_password" id="confirm_password" class="input_login"  label="<?php echo TITLE_CONFIRM_NEW_PASSWORD;?>" type="password" required="yes" maxlength="30"      warn_msg="<?php echo WARN_CONFIRM_NEW_PASSWORD;?>"/></td>
  </tr>
   <tr>
    <td colspan="2">
    <div class="button_box">
    <ul>
   <li class="main"><a href="#" id="btn_reset" ><span><?php echo BTN_RESET;?></span></a></li>
    
    <li><a href="#"  id="btn_confirm"><span><?php echo BTN_CONFIRM;?></span></a></li>
    </ul>
    </div>
    </td>
  </tr>
</table>   
</form>
</div>
<!-- main_content_area (end) -->






<!-- confirm_msg (start) -->
<div id="confirm_msg">
<div id="confirm_msg_content">
<?php echo MSG_CONFIRM_CHANGE_PASSWORD;?>
</div>
<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <div class="button_box">
    <ul>
   	<li><a href="<?php echo $_SERVER['PHP_SELF'];?>" ><span><?php echo BTN_CHANGE_PASSWORD_AGAIN;?></span></a></li>
    </ul>
	</div>
    </td>
  </tr>
</table>
</div>
</div>
<!-- confirm_msg (end) -->


<?php include(DIR_COMMON."loading.php");?>



<!-- table_layout (end) -->
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
