<title><?php echo COMPANY_NAME; ?> : <?php echo SYSTEM_NAME; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<link href="<?php echo DIR_CSS?>styles.css?v=3<?php echo date('Ymdhis')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/jquery.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/plugins/pngFix/jquery.pngFix.pack.js"></script>  
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/plugins/form_default/jquery.form-defaults.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/plugins/scrollto/jquery.scrollTo.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/plugins/scrollto/jquery.localScroll.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/plugins/validate/jquery.numeric.js"></script>


<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/plugins/my_dynamic_form.js"></script>

<link type="text/css" href="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/themes/ui-lightness/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.resizable.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/jquery/ui/development-bundle/ui/jquery.ui.datepicker.js"></script>





<SCRIPT>
var libDir = "<?php echo DIR_PATH; ?>includes/js/datepicker/";
</SCRIPT>
<SCRIPT src="<?php echo DIR_PATH; ?>includes/js/datepicker/calendarDateInput_tc.js" type=text/javascript></SCRIPT>



<?php
	if($in_lytebox != true){
?>
<script type="text/javascript" language="javascript" src="<?php echo DIR_PATH; ?>includes/js/lytebox/lytebox.js"></script>
<link rel="stylesheet" href="<?php echo DIR_PATH; ?>includes/js/lytebox/lytebox.css" type="text/css" media="screen" />
<?php
	}
?>

<script type="text/javascript" src="js/common.js?v=<?php echo date('Ymdhis')?>"></script>




<?php
		if($_SESSION['already_login']){
?>
<?php
	if($in_lytebox != true){
?>
<link rel="stylesheet" type="text/css" href="<?php echo DIR_PATH; ?>includes/js/ddsmoothmenu/ddsmoothmenu.css?v=<?php echo date('Ymdhis')?>" />
<script type="text/javascript" src="<?php echo DIR_PATH; ?>includes/js/ddsmoothmenu/ddsmoothmenu.js"></script>
<script type="text/javascript">
ddsmoothmenu.init({
	mainmenuid: "topmenu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})


</script>


<script type="text/javascript">
$(document).ready(function(){ 
  		

}); 
</script>
<?php
	}

?>
<?php
	}

?>