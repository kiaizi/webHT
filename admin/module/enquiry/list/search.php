<!-- search area (start) -->
<div id="search_area">
<p class="section_title"><?php echo TITLE_SEARCH; ?></p>
<table  border="0" cellspacing="0" cellpadding="0" id="table_search">



 <tr>
  <td class="title"><?php echo TITLE_FROM; ?></td>
  <td>
<table border="0" cellspacing="0" cellpadding="0" id="table_text">
  <tr>
    <td style="padding-bottom:0px;">
    
<?php
		if($edit_data['search_create_date_from'] == ''){
			//$edit_data['search_create_date_from'] = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
			$edit_data['search_create_date_from'] = '2017-01-01';
		}
?>
<input class="input_date" name="search_create_date_from" id="search_create_date_from" value="<?php echo $edit_data['search_create_date_from']; ?>">

   
   <td class="title"><?php echo TITLE_TO; ?></td>
   <td>
   
   
   
    
<?php
		if($edit_data['search_create_date_to'] == ''){
			$edit_data['search_create_date_to'] = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
			//$edit_data['search_create_date_to'] = '9999-12-31';
		}
?>
<input class="input_date" name="search_create_date_to" id="search_create_date_to" value="<?php echo $edit_data['search_create_date_to']; ?>">

    
    </td>
 

</tr>
</table>
   
   
   
   
   
   </td>
  </tr>
  
  
  <tr>

 <td class="title">付款方法</td>
     <td>
<?php
		
   $sql = "select payment_method.*, payment_method_desc.name as name from ".TB_PAYMENT_METHOD." as payment_method , ".TB_PAYMENT_METHOD_DESC." as payment_method_desc ";
	$sql .= " where ";
	$sql .= " payment_method.id=payment_method_desc.payment_method_id ";
	$sql .= " and payment_method_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and disabled='0' ";
	$sql .= " order by payment_method.sort_order asc ";
				

	printCustomMenu('search_payment_method_id', $sql,'name','0',$_REQUEST['search_payment_method_id'],'',TITLE_ALL,'-1','');
?>
    
 
     </td>
	      </tr>
  
  
  <tr>

 <td class="title">付款狀態</td>
     <td>
<?php
		
   $sql = "select payment_status.*, payment_status_desc.name as name from ".TB_PAYMENT_STATUS." as payment_status , ".TB_PAYMENT_STATUS_DESC." as payment_status_desc ";
	$sql .= " where ";
	$sql .= " payment_status.id=payment_status_desc.payment_status_id ";
	$sql .= " and payment_status_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and disabled='0' ";
	$sql .= " order by payment_status.sort_order asc ";
				

	printCustomMenu('search_payment_status_id', $sql,'name','0',$_REQUEST['search_payment_status_id'],'',TITLE_ALL,'-1','');
?>
    
 
     </td>
	      </tr>


  <tr>
   
     <td>
<?php
		$arr_option_list = array(
						
						
						
						
							array(  
                    		'參考號碼' ,
							'code'
						) 
						,
							array(  
                    		'PayPal收據號碼' ,
							'paypal_refno'
						) 
						,
						
						
						array(  
                    		'姓名' ,
							'name'
						) 
						,
						array(  
                    		'性別' ,
							'gender'
						) 
						,
						array(  
                    		'電郵地址' ,
							'email'
						) 
						,
						array(  
                    		'聯絡電話' ,
							'mobile_no'
						)
						
						
						
						
         );  

		 
		printCustomListFromArray("search_by",$arr_option_list,'',' class="resetable" ');
			 
?>
 
     </td>
      <td class="title"><input name="search" id="search" class="input_search resetable" value="<?php echo $_REQUEST['search']; ?>"/></td>
    
       
  </tr>
  
  
 
  
   <tr>
    <td colspan="2">
    <div class="button_box">
    <ul>
    <li class="main"><a href="#" id="btn_hide_search_area"><span><?php echo BTN_HIDE; ?></span></a></li>
    
    <li><a href="#" id="btn_search"><span><?php echo BTN_SEARCH; ?></span></a></li>
    </ul>
    </div>
    </td>
  </tr>
</table>   
</div>
<!-- search area (end) -->