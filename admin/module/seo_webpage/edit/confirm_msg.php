<!-- confirm_msg (start) -->
<div id="confirm_msg">
<div id="confirm_msg_content">
<?php echo SUCCESS;?> <?php echo ACTION_NAME;?> <?php echo DATA_NAME;?>
</div>
<div id="confirm_msg_content_delete" style="display:none">
<?php echo SUCCESS;?> <?php echo ACTION_DELETE;?> <?php echo DATA_NAME;?>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" id="table_nopad">
  <tr>
    <td style="padding:0">
<div class="button_box" style="clear:none">
    <ul>
   	<li class="main hide_if_delete"><a href="#" class="btn_edit"><span><?php echo BTN_VIEW_OR_MODIFY;?></span></a></li>
    <li  style="display:none"><a href="#" id="btn_create"><span><?php echo BTN_CONTINUE_CREATE;?><?php echo DATA_NAME;?></span></a></li>
    <li  style="display:none"><a href="#" id="btn_back_to_list" class="btn_back_to_list"><span><?php echo BTN_BACK_TO_LIST;?></span></a></li>
    </ul>
	</div>
    
    </td>
  </tr>
</table>
</div>


<div class="confirm_msg_area_bottom"></div>
</div>
<!-- confirm_msg (end) -->
