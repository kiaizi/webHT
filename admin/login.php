<?php 
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(DIR_COMMON."meta_header.php");?>

<script language="javascript">
$(document).ready(function(){
  $('#login_username').focus();
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
					
					if(json.success){
						//show_confirm_page();	
						//window.location.href = "index.php";
						document.frm_this_page.submit();
					}else{
						finish_loading();	
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




<?php 
if($_SESSION['already_login']){
 $onload ='onLoad="redirect()"';
}
?>
</head>
<body <?php echo $onload; ?>
<?php 
if($_SESSION['already_login']){
 exit();
}
?>

<div id="container">
<?php include(DIR_COMMON."header.php");?>
<div id="main_content_container">
<div id="inside_content">
<!-- table_layout (start) -->


<!-- main_content_area (start) -->
<div id="main_content_area">


<?php
		$previous_link = $_SERVER['PHP_SELF']; 
		if($_SERVER["QUERY_STRING"] != ''){
			$previous_link = $_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"]; 
		}
		$previous_link = str_replace("logout=1","",$previous_link);
?>




<form name="frm_this_page"  id="frm_this_page" method="POST" enctype="multipart/form-data" action="<?php echo $previous_link; ?>"  target="_self" autocomplete="off">
<input name="WARN_LOGIN_FAILURE" id="WARN_LOGIN_FAILURE" value="<?php echo WARN_LOGIN_FAILURE;?>" type="hidden"/>
<input name="ajax_json_path" id="ajax_json_path" value="<?php echo "ajax_json_login.php"; ?>" type="hidden"/>
<table  border="0" cellspacing="0" cellpadding="0" id="table_login">
  <tr>
    <td colspan="2" id="warn_msg">&nbsp;</td>
  </tr>
  <tr>
    <td class="title"><?php echo TITLE_LOGIN_USERNAME;?></td>
    <td><input name="login_username" id="login_username" class="input_login" label="<?php echo TITLE_LOGIN_USERNAME;?>" required="yes" maxlength="30"/></td>
  </tr>
    <tr>
    <td class="title"><?php echo TITLE_LOGIN_PASSWORD;?></td>
    <td><input name="login_password" id="login_password" class="input_login" type="password" label="<?php echo TITLE_LOGIN_PASSWORD;?>"  required="yes" maxlength="30"/></td>
  </tr>
   <tr>
    <td colspan="2">
    <div class="button_box">
    <ul>
    <li class="main"><a href="#" id="btn_reset" ><span><?php echo BTN_RESET;?></span></a></li>
    
    <li><a href="#"  id="btn_confirm"><span><?php echo BTN_LOGIN;?></span></a></li>
    </ul>
    </div>
    </td>
  </tr>
</table>   
</form>
</div>
<!-- main_content_area (end) -->
<div id="confirm_msg">
</div>


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
