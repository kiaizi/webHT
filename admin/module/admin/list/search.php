<!-- search area (start) -->
<div id="search_area">
<p class="section_title"><?php echo TITLE_SEARCH; ?></p>
<table  border="0" cellspacing="0" cellpadding="0" id="table_search">
  <tr>
   
     <td>
<?php
		$arr_option_list = array(
						array(  
                    		TITLE_CODE ,
							'code'
						)  ,
						array(  
                    		TITLE_USERNAME ,
							'username'
						) ,
						
					
						
						array(  
                    		'Name' ,
							'givenname_en' 
                     		
						)  
						
						
         );  

		 
		printCustomListFromArray("search_by",$arr_option_list,'',' class="resetable" ');
			 
?>
 
     </td>
      <td class="title"><input name="search" id="search" class="input_search resetable" value="<?php echo $_REQUEST['search']; ?>"/></td> <td class="title"><?php echo TITLE_USER_DISABLED; ?></td>
       <td class="title" colspan="3">
       
       
       
<?php
		
   $sql = "select status_allow.*, status_allow_desc.name as name from ".TB_STATUS_ALLOW." as status_allow , ".TB_STATUS_ALLOW_DESC." as status_allow_desc ";
	$sql .= " where ";
	$sql .= " status_allow.id=status_allow_desc.status_allow_id ";
	$sql .= " and status_allow_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_allow.id  ";
	$sql .= " order by status_allow.sort_order asc ";
				

	printCustomMenu('search_disabled', $sql,'name','',$_REQUEST['search_disabled'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
       
  </tr>

  
   <tr>
    <td colspan="6">
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