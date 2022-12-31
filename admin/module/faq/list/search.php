<!-- search area (start) -->
<div id="search_area">
<p class="section_title"><?php echo TITLE_SEARCH; ?></p>
<table  border="0" cellspacing="0" cellpadding="0" id="table_search">

<tr >

 <td class="title">类别</td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select faq_category.*, faq_category_desc.name as name from ".TB_FAQ_CATEGORY." as faq_category , ".TB_FAQ_CATEGORY_DESC." as faq_category_desc ";
	$sql .= " where ";
	$sql .= " faq_category.id=faq_category_desc.faq_category_id ";
	$sql .= " and faq_category_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by faq_category.id  ";
	$sql .= " order by faq_category.sort_order asc ";
				

	printCustomMenu('search_faq_category_id', $sql,'name','',$_REQUEST['search_faq_category_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
</tr>

<tr style="display:none">

 <td class="title"><?php echo TITLE_PRODUCT; ?></td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select product.*, product_desc.name as name from ".TB_PRODUCT." as product , ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.id=product_desc.product_id ";
	$sql .= " and product_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by product.id  ";
	$sql .= " order by product.sort_order asc ";
				

	printCustomMenu('search_product_id', $sql,'name','',$_REQUEST['search_product_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
</tr>





<tr style="display:none">

 <td class="title"><?php echo TITLE_PRODUCT_CATEGORY; ?></td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select product_category.*, product_category_desc.name as name from ".TB_PRODUCT_CATEGORY." as product_category , ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	$sql .= " product_category.id=product_category_desc.product_category_id ";
	$sql .= " and product_category_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by product_category.id  ";
	$sql .= " order by product_category.sort_order asc ";
				

	printCustomMenu('search_product_category_id', $sql,'name','',$_REQUEST['search_product_category_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
</tr>




<tr style="display:none">

 <td class="title"><?php echo TITLE_PRODUCT_CATEGORY2; ?></td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select product_category2.*, product_category2_desc.name as name from ".TB_PRODUCT_CATEGORY2." as product_category2 , ".TB_PRODUCT_CATEGORY2_DESC." as product_category2_desc ";
	$sql .= " where ";
	$sql .= " product_category2.id=product_category2_desc.product_category2_id ";
	$sql .= " and product_category2_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by product_category2.id  ";
	$sql .= " order by product_category2.sort_order asc ";
				

	printCustomMenu('search_product_category2_id', $sql,'name','',$_REQUEST['search_product_category2_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
</tr>



<tr style="display:none">

 <td class="title"><?php echo TITLE_PRODUCT_CATEGORY3; ?></td>
       <td class="title" >
       
       
       
<?php 
		
   $sql = "select product_category3.*, product_category3_desc.name as name from ".TB_PRODUCT_CATEGORY3." as product_category3 , ".TB_PRODUCT_CATEGORY3_DESC." as product_category3_desc ";
	$sql .= " where ";
	$sql .= " product_category3.id=product_category3_desc.product_category3_id ";
	$sql .= " and product_category3_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " group by product_category3.id  ";
	$sql .= " order by product_category3.sort_order asc ";
				

	printCustomMenu('search_product_category3_id', $sql,'name','',$_REQUEST['search_product_category3_id'],'',TITLE_ALL,'-1','');
	
?>
    
       
       
       
       </td>
      
</tr>


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



  <tr>
   
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