<!-- search area (start) -->
<div id="search_area">
<p class="section_title"><?php echo TITLE_SEARCH; ?></p>
<table  border="0" cellspacing="0" cellpadding="0" id="table_search">
 <tr>
 <td class="title"><?php echo TITLE_DISABLED; ?></td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select status_disable.*, status_disable_desc.name as name from ".TB_STATUS_DISABLE." as status_disable , ".TB_STATUS_DISABLE_DESC." as status_disable_desc ";
	$sql .= " where ";
	$sql .= " status_disable.id=status_disable_desc.status_disable_id ";
	$sql .= " and status_disable_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_disable.id  ";
	$sql .= " order by status_disable.sort_order asc ";
				

	printCustomMenu('search_disabled', $sql,'name','',$_REQUEST['search_disabled'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
 </tr>

 
  
  
  
  
 <tr style="display:none">
   

 <td class="title">地區</td>
       <td class="title" >
       
       

    
<?php 
		
	$sql = "select office_category.parent_office_category_id,office_category.id as id ,office_category_desc.name as name "; 
	$sql .= ",(select name from ".TB_OFFICE_CATEGORY_DESC." where office_category_id=office_category.parent_office_category_id and language_id = '".ADMIN_LANG_ID."') as parent_category_name";
	$sql .= " from ".TB_OFFICE_CATEGORY." as office_category, ".TB_OFFICE_CATEGORY_DESC." as office_category_desc ";
	$sql .= " where ";
	$sql .= " office_category.parent_office_category_id >0 ";
	$sql .= " and office_category.id = office_category_desc.office_category_id ";
	$sql .= " and office_category_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and office_category.disabled<>'".DISABLED_DELETE."' ";
		$sql .= " order by office_category.parent_office_category_id asc,office_category.sort_order  asc ";
	
	
	
	

	printCustomMenuProductCategory('search_office_category_id', $sql,'name','',$_REQUEST['search_office_category_id'],'',TITLE_ALL,'-1','');
	

	
	/*
		$sql = "select office_category.id as id ,office_category_desc.name as name "; 
	$sql .= ",(select name from ".TB_OFFICE_CATEGORY_DESC." where office_category_id=office_category.parent_office_category_id and language_id = '".ADMIN_LANG_ID."') as parent_category_name";
	$sql .= " from ".TB_OFFICE_CATEGORY." as office_category, ".TB_OFFICE_CATEGORY_DESC." as office_category_desc ";
	$sql .= " where ";
	$sql .= " office_category.parent_office_category_id>0 ";
	$sql .= " and office_category.id = office_category_desc.office_category_id ";
	$sql .= " and office_category_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and office_category.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by office_category.parent_office_category_id asc,office_category.sort_order  asc ";
	
	
	
	
	
	printCustomMenuProductCategory('search_office_category_id', $sql,'name','',$_REQUEST['search_office_category_id'],'',TITLE_ALL,'-1','');
	*/
	
	
?>
    
       
       
       </td>
      
  </tr>

  
  
  
  
  

   
     <td>
<?php
		$arr_option_list = array(
						
						array(  
                    		TITLE_TITLE ,
							'name'
						) 
						
						
						
         );  

		 
		printCustomListFromArray("search_by",$arr_option_list,'',' class="resetable" ');
			 
?>
 
     </td>
      <td class="title"><input name="search" id="search" class="input_search resetable" value="<?php echo $_REQUEST['search']; ?>"/></td>
      

  </tr>
   <tr>
    <td colspan="4">
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