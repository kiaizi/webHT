<?php include(DIR_COMMON."common_hidden_field.php");?>
<!-- header (start) -->
<div id="header">
  <div id="header_content_container">
	<div id="header_company_info"><?php echo COMPANY_NAME;?> <span class="highlight"><?php echo SYSTEM_NAME;?></span></div>
    <div id="header_nav_area">
	<?php
		if($_SESSION['already_login']){
?>
    <div id="topnav">
    	<ul>
    		<li><span class="date"><?php echo TODAY;?></span> <span class="highlight"><?php echo ADMIN_ROLE_NAME
?></span>  <span class="username"><?php echo ADMIN_USERNAME
?></span></li>
            <li><a href="../" target="_blank"><?php echo BTN_COMPANY_WEB;?></a></li>
    		<li><a href="change_password.php"><?php echo BTN_CHANGE_PWD;?></a></li>
            <li class="last"><a href="index.php?logout=1"><?php echo BTN_LOGOUT;?></a></li>
    	</ul>
    </div>
    <?php
		}
?>
    </div>
  </div>
</div>
<!-- header (end) -->
<?php
		if($_SESSION['already_login']){
?>



<!-- topmenu (start) -->
<div id="topmenu_container">
<div id="topmenu" class="ddsmoothmenu">
 <ul>
<?php
	$sql = "select section.id as id, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
	$sql .= " where ";
	$sql .= " section.id=section_desc.section_id  and section.disabled='0' ";
	$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and section.show_in_left_menu = '1' ";
	$sql .= " and section.parent_section_id = '0' ";
	
	//$sql .= " and (section.id in (".ALLOW_SECTION_ID_LIST.")  or   section.parent_section_id in (".ALLOW_SECTION_ID_LIST.")     )";
	$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
	
	
	
	
	
	$sql .= " group by section.id  ";
	$sql .= " order by parent_section_id asc,section.sort_order asc  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$this_id = $data['id'];
			$this_name = $data['name'];
			$class = '';
			if($this_id == P_SID || $this_id == SID ){
				$class = ' class="selected" ';
			}
?>
  	<li><a href="index.php?sid=<?php echo $this_id?>" <?php echo $class;?>><?php echo $this_name
?></a>
<?php
	$sql = "select section.id as id, section_desc.name as name from ".TB_SECTION." as section , ".TB_SECTION_DESC." as section_desc ";
	$sql .= " where ";
	$sql .= " section.id=section_desc.section_id  and section.disabled='0' ";
	$sql .= " and section_desc.language_id='".ADMIN_LANG_ID."' ";
	$sql .= " and section.show_in_left_menu = '1' ";
	$sql .= " and section.parent_section_id = '$this_id' ";
	
	//$sql .= " and (section.id in (".ALLOW_SECTION_ID_LIST.")  or   section.parent_section_id in (".ALLOW_SECTION_ID_LIST.")     )";
	$sql .= " and section.id in (".ALLOW_SECTION_ID_LIST.") ";
	$sql .= " group by section.id  ";
	$sql .= " order by parent_section_id asc, section.sort_order asc  ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
?>
<ul>
<?php
		
		while($data = $G_DB_CONNECT->fetch_array($rows2)){
			$this_id = $data['id'];
			$this_name = $data['name'];?><li><a href="index.php?sid=<?php echo $this_id?>"><?php echo $this_name
?></a></li>
<?php
	
	}//while
?>
</ul>
<?php	
	}//if
?>
</li>




<?php		
		}
	}
?>
</ul>
<div style="clear:both" /></div>
</div>
</div>
<!-- topmenu (end) -->
<?php
		}
?>
<!-- banner (start) -->
<div id="banner">
<img src="css/default/images/logo.png?v=<?php echo date('Ymdhis')?>" style="float:left;margin-left:20px;margin-top:35px;height:40px;">
<div id="banner_container"></div>
</div>
<!-- banner (start) -->