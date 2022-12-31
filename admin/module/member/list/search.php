<!-- search area (start) -->
<div id="search_area">
<p class="section_title"><?php echo TITLE_SEARCH; ?></p>
<table  border="0" cellspacing="0" cellpadding="0" id="table_search">


<tr style="display:none">
	  
	  
	  
	  
	  <td class="title">Country</td>
       <td class="title">
       
       
       
<?php
		
  		
   $sql = "select delivery_method.id, delivery_method_desc.name as name from ".TB_DELIVERY_METHOD." as delivery_method , ".TB_DELIVERY_METHOD_DESC." as delivery_method_desc ";
	$sql .= " where ";
	$sql .= " delivery_method.id=delivery_method_desc.delivery_method_id ";
	$sql .= " and delivery_method_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and delivery_method.disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by delivery_method_desc.name asc ";
				


	printCustomMenu('search_country', $sql,'name','',$_REQUEST['search_country'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
       
  </tr>


<tr style="display:none">
	  
	  
	  
	  
	  <td class="title">Grade</td>
       <td class="title">
       
       
       
<?php
		
  		
 $sql = "select member_category.*, member_category_desc.name as name from ".TB_MEMBER_CATEGORY." as member_category , ".TB_MEMBER_CATEGORY_DESC." as member_category_desc ";
	$sql .= " where ";
	$sql .= " member_category.id=member_category_desc.member_category_id ";
	$sql .= " and member_category_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " order by member_category.sort_order asc ";
				


	printCustomMenu('search_member_category_id', $sql,'name','',$_REQUEST['search_member_category_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
       
  </tr>


<tr>
	  
	  
	  
	  
	  <td class="title"><?php echo TITLE_USER_DISABLED; ?></td>
       <td class="title" >
       
       
       
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
                    		TITLE_EMAIL ,
							'email'
						) ,
						array(  
                    		TITLE_MOBILE_NO ,
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