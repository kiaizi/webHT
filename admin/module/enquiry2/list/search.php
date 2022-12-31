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
			$edit_data['search_create_date_from'] = '2015-01-01';
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
   
     <td>
<?php
		$arr_option_list = array(
						
						
						
						array(  
                    		'姓名' ,
							'name'
						) ,
						array(  
                    		'聯絡電話' ,
							'mobile_no'
						) ,
						array(  
                    		'電郵' ,
							'email'
						) 
						,
						array(  
                    		'年齡' ,
							'age'
						) 
						
						
						,
						array(  
                    		'從何得知此優惠?' ,
							'where_hear_us'
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