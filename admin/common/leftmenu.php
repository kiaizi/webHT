<p class="section_leftmenu_title"><?php echo P_SECTION_NAME; ?></p>
    
    

<?php
	$sql = "select section.id as id, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
	$sql .= " where ";
	$sql .= " section.id=section_desc.section_id ";
	$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and section.show_in_left_menu = '1' ";
	$sql .= " and section.parent_section_id = '".P_SID."' ";
	$sql .= " and section.disabled = '0' ";
	$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
	
	$sql .= " group by section.id  ";
	$sql .= " order by section.sort_order asc  ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
?>
<div id="leftmenu">
<ul>
<?php
		
		while($data = $G_DB_CONNECT->fetch_array($rows2)){
			$this_id = $data['id'];
			$this_name = $data['name'];
			$class = '';
			if($this_id == P_SID || $this_id == SID ){
				$class = ' class="current" ';
			}
?>
   	<li><a href="index.php?sid=<?php echo $this_id?>" <?php echo $class;?>><?php echo $this_name ?></a></li>
<?php
	
	}//while
?>
</ul>
<div style="clear:both"></div>
</div>
<?php	
	}//if
?>