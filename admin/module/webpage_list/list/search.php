<!-- search area (start) -->
<div id="search_area">
<p class="section_title"><?php echo TITLE_SEARCH; ?></p>
<table  border="0" cellspacing="0" cellpadding="0" id="table_search">

 
     
    
     <tr>
     <td>
<?php
		$arr_option_list = array(
					
						array(  
                    		TITLE_TITLE ,
							'name'
						)
						/*
						,
						array(  
                    		TITLE_PARENT_CATEGORY ,
							'parent_category_name'
						)
						*/
						
         );  

		 
		printCustomListFromArray("search_by",$arr_option_list,'',' class="resetable" ');
			 
?>
 
     </td>
      <td class="title"><input name="search" id="search" class="input_search resetable" value="<?php echo $_REQUEST['search']; ?>"/></td>
      
      
      
      
      
      
      
  <td class="title"></td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select webpage_position.*, webpage_position_desc.name as name from ".TB_WEBPAGE_POSITION." as webpage_position , ".TB_WEBPAGE_POSITION_DESC." as webpage_position_desc ";
	$sql .= " where ";
	$sql .= " webpage_position.id=webpage_position_desc.webpage_position_id ";
	$sql .= " and webpage_position_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by webpage_position.id  ";
	$sql .= " order by webpage_position.sort_order asc ";
				

	//printCustomMenu('search_webpage_position_id', $sql,'name','',$_REQUEST['search_webpage_position_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
      
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
      
            
      
  <td class="title"></td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select status_yesno.*, status_yesno_desc.name as name from ".TB_STATUS_YESNO." as status_yesno , ".TB_STATUS_YESNO_DESC." as status_yesno_desc ";
	$sql .= " where ";
	$sql .= " status_yesno.id=status_yesno_desc.status_yesno_id ";
	$sql .= " and status_yesno_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by status_yesno.id  ";
	$sql .= " order by status_yesno.sort_order asc ";
				

	//printCustomMenu('search_have_contact_form', $sql,'name','',$_REQUEST['search_have_contact_form'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
      
      
      
      
      
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