<a href="#" rel="lyteframe" title="" rev="width: 800px; height: 700px; scrolling: auto;" id="global_lyteframe"  >&nbsp;</a>



<form name="frm_view"  id="frm_view" method="GET" enctype="multipart/form-data" action=""  target="_blank" autocomplete="off">
<input name="s" id="s" value="" type="hidden">
</form>





<form name="frm_print_order"  id="frm_print_order" method="GET" enctype="multipart/form-data" action="index.php"  target="_blank" autocomplete="off">
<input name="sid" id="sid" value="20" type="hidden">
<input name="print" id="print" value="" type="hidden">
</form>


<form name="frm_print_uncomplete_order_list"  id="frm_print_uncomplete_order_list" method="GET" enctype="multipart/form-data" action="index.php"  target="_blank" autocomplete="off">
<input name="sid" id="sid" value="33" type="hidden">
<input name="print" id="print" value="" type="hidden">
</form>


<form name="frm_print_blank_invoice"  id="frm_print_blank_invoice" method="GET" enctype="multipart/form-data" action="index.php"  target="_blank" autocomplete="off">
<input name="sid" id="sid" value="34" type="hidden">
<input name="mid" id="mid" value="" type="hidden">
</form>

<form name="frm_print_blank_receipt"  id="frm_print_blank_receipt" method="GET" enctype="multipart/form-data" action="index.php"  target="_blank" autocomplete="off">
<input name="sid" id="sid" value="35" type="hidden">
<input name="mid" id="mid" value="" type="hidden">
</form>

<div id="footer">
<div id="footer_content_container">
<div class="copyright" style="float:left">Best viewed with Firefox, Chrome, Safari</div>

<?php
	if($_SESSION['already_login']){
?>
<div id="btn_top"><a href="#top">top</a></div>
<?php
	}
?>

<div class="copyright"><?php echo COPYRIGHT; ?> &copy; <?php echo date('Y');?> <?php echo COMPANY_NAME; ?></div>    
</div>
</div>
<?php
	

$G_DB_CONNECT->close();

?>
