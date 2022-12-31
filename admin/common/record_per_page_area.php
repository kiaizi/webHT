  <div id="record_per_page_area">
    	
<table  border="0" cellspacing="0" cellpadding="0" id="table_normal">
  <tr>
   <td><?php echo TITLE_RECORD_PER_PAGE; ?></td>
    <td>
    
<?php
		
   $sql = "select paging.num_per_page as id ,paging.num_per_page as name from ".TB_PAGING." as paging";
	$sql .= " where ";
	$sql .= " paging.disabled='0' ";
	$sql .= " order by paging.sort_order asc ";
				

	printCustomMenu('record_per_page', $sql,'name',50,getRequestVar('record_per_page',$_SESSION['RECORDS_PER_PAGE']),'','','','');
?>
    
    </td>
    <td><?php echo TITLE_NUM_OF_RECORD; ?></td>
  </tr>
</table>    
        
    </div>