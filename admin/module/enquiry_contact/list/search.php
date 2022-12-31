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
			$edit_data['search_create_date_from'] = '2020-08-01';
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
  
   <td class="title">感興趣之服務</td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select form_option1.*, form_option1_desc.name as name from ".TB_FORM_OPTION1." as form_option1 , ".TB_FORM_OPTION1_DESC." as form_option1_desc ";
	$sql .= " where ";
	$sql .= " form_option1.id=form_option1_desc.form_option1_id ";
	$sql .= " and form_option1_desc.language_id='".ADMIN_LANG_ID."' and disabled<>'".DISABLED_DELETE."' ";
	$sql .= " group by form_option1.id  ";
	$sql .= " order by form_option1.sort_order asc ";
				

	printCustomMenu('search_form_option1_id', $sql,'name','',$_REQUEST['search_form_option1_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       </td>
      
  </tr>


  <tr>
   
     <td>
<?php
		$arr_option_list = array(
						
						
						
						array(  
                    		'姓名' ,
							'name'
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
						,
						array(  
                    		'公司名稱' ,
							'company_name'
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