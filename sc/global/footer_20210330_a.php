<style>
/* footer.php Page */
  .footer-container{
    border-top: 10px solid #D93A16;
    background-color: #333;
    padding-bottom: 40px;
  }

  .container.footer-content{
    max-width: 1720px;
  }

  .footer-content h4{
    font-size: 14px;
    color: #fff;
    padding: 30px 0px;
    padding-bottom: 15px;
  }

  .footer-content h4 span{
    display: inline;
    border-bottom: 1px solid #FFFFFF; 
    padding-bottom: 2px;
  }

  .footer-content li, .footer-copyright li{
    list-style-type: none;
  }

  .formfooter{
    font-size: 14px;
    color: #fff;
  }

  .fft{
    margin-bottom: 10px;
    font-size: 14px;
    color: #fff;
    position: relative;
  }

  span.fft a {
    color: #fff;
    text-decoration: none;
}

  .footer-content .fft{
    display: inline;
    border-bottom: 1px solid #FFFFFF; 
    padding-bottom: 2px;
  }

  span.triangle {
    border-color: transparent #D93A16 transparent transparent;
    border-style: solid solid solid solid;
    border-width: 6px;
    transform: rotate(135deg);
    position: absolute;
    left: 80px;
}

 .footer-content .col-lg-5{
    margin-bottom: 30px;
  }

  .col-lg-2.wechat-list{
    display: flex;
    flex-direction: column;
    text-align: right;
  }

  .footer-copyright {
    border-top: 1px solid #ADADAD;
    background-color: #333;
    text-align: center;
    padding: 40px 0px;
}

  .footer-copyright .cr-text{
    font-size: 14px;
    color: #ADADAD;
  }

  .footer-copyright .cr-text.crs-text{
    display: inline;
    border-bottom: 1px solid #ADADAD;
    padding-bottom: 2px;
  }

  a.mailto {
    color: #fff;
}

button.footer.btn.btn-primary {
    background-color: transparent;
    border: none;
}

.btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show>.btn-primary.dropdown-toggle:focus {
    box-shadow: none;
}

.btn-primary.focus, .btn-primary:focus {
    box-shadow: none;
}

.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: transparent;
    border-color: transparent;
    padding: 0px;
}

.modal-content {
    width: 70%;
    position: absolute;
    right: 70px;
    top: 150px;
}

button.footer.btn.btn-primary {
    background-color: transparent;
    border: none;
    text-align: right;
}

/* Footer (Mobile Page) */
@media only screen and (max-width: 767px){
  .footer-container{
    padding-bottom: 20px;
  }

  .footer-content h4 {
    font-size: 10px;
    color: #fff;
    padding: 10px 0px;
    padding-bottom: 5px;
    font-weight: 600;
}

.formfooter {
    font-size: 10px;
    color: #fff;
    line-height: 15px;
}

.footer-content li, .footer-copyright li {
    list-style-type: none;
    line-height: 12px;
}

.footer-content .fft {
    display: inline;
    border-bottom: 1px solid #FFFFFF;
    padding-bottom: 0px;
}

.footer-page.col-lg-6 {
    padding-top: 15px;
}

.fft {
    margin-bottom: 7px;
    font-size: 10px;
    color: #fff;
    position: relative;
    line-height: 15px;
}

span.triangle {
    border-color: transparent #D93A16 transparent transparent;
    border-style: solid solid solid solid;
    border-width: 6px;
    transform: rotate(135deg);
    position: absolute;
    left: 60px;
}

.col-lg-2.wechat-list{
  padding-top: 15px;
    display: flex;
    flex-direction: column;
    text-align: left;
  }

.footer-copyright .cr-text {
  font-size: 10px;
  line-height: 15px;
}

.footer-copyright {
    text-align: left;
    padding: 25px 10px;
}

.footer-copyright .cr-text.crs-text {
    padding-bottom: 1px;
}

.footer-container {
    border-top: 5px solid #D93A16;
}

.modal-content {
    width: 60%;
    position: absolute;
    left: 80px;
    top: 150px;
}

button.footer.btn.btn-primary {
    background-color: transparent;
    border: none;
    padding: 0px;
    text-align: left;
    width: 40%;
}


}



</style>


<!-- Footer Page -->
<div class="continer-fuild footer-container">
  <div class="container footer-content">
    <div class="row">

      <div class="footer-page col-lg-4 formfooter">
        <h4><span>联系我们</span></h4>

		
		  <?php echo webpageContent(40,CURRENT_LANG,'detail'); ?>
  
		
      </div>

      <div class="footer-page col-lg-6">
        <h4><span>友情链接</span></h4>
		<div class="footer_link">

        	  <?php echo webpageContent(40,CURRENT_LANG,'detail3'); ?>
    </div>
        
      </div>

      <div class="footer-page col-lg-2 wechat-list">
        <h4><span>关注我们</span></h4>
        <!-- Small modal -->
        <li>
          <button class="footer btn btn-primary" data-toggle="modal" data-target="#exampleModal"><img src="../images/wechaticon.png" alt="" class="wechat-icon-image" width="30%"></button>
        </li>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><img src="../images/close-btn.svg" alt="" class="close-btn"></span>
        </button>

        <div class="modal-body"><img src="../images/wechat-qr-code.svg" alt="" class="wechat-qr-code" width="100%"></div>
      </div>
    </div>

      

        
      
    </div>
  </div>
</div>

      


    </div>
  </div>
</div>

<!-- Copyright -->
<div class="footer-copyright cr-text">


  <?php echo webpageContent(40,CURRENT_LANG,'detail2'); ?>
  
</div>

   
   

<!--
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js?V=2" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
-->
<script src="../js/jquery-3.4.1.min.js"></script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js?V=2/1.12.9/umd/popper.min.js?V=2" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js?V=2" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="../owlcarousel/owl.carousel.min.js?V=2"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js?V=2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js?V=2"></script>
<!-- for icon -->
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js?V=2"></script>





<!-- <script src="../js/custom.js?V=2"></script>  -->

		

<script type="text/javascript">
	
  jQuery(document).ready(function(){ 
  
  
  
    jQuery('.btn_lang').click(function(e){	
          e.preventDefault();
    
        //	jQuery('#frm_global #lang').val(jQuery(this).attr('data-lang'));
          //document.frm_global.submit();
          switchLang(jQuery(this).attr('from'),jQuery(this).attr('to'));
        
          
      });
  
  
    
  });
    

  function switchLang(from,to) {
    
  
  
    
    
      var currentStr = window.location.href;
    
      currentStr = currentStr.replace('/'+from+'/', '/'+to+'/');
  
    /*
    var str = currentStr.replace("<?php echo OUR_SERVER;?>", "");
  
    var n = str.search("/");
    
  
    var find = currentStr.indexOf(to);
    var find2 = currentStr.indexOf('.php');
    if(find == -1){
      currentStr = currentStr + '?&' +to;
    }
  if(n > 0 ){
     currentStr = currentStr.replace('?', '');
  }
    
  */
      
      window.location.href = currentStr;
    
  
  } 


  </script>
<script>
$('.btn_link').click(function(e) {
        e.preventDefault();
		
	
		
       var href = jQuery(this).attr('href');
        var target = jQuery(this).attr('target');

		   
		 if ($(this).attr('target') == '_blank') {
            window.open($(this).attr('href'), '_blank');
        } else {
            top.location.href = $(this).attr('href');
        }
		   

		
 });
</script>
<style>
.cr-text{
	color:#ffffff;
	
}
.cr-text a:link,.cr-text a:visited{
	color:#ffffff;
	text-decoration:underline;
	
}
.cr-text a:hover{
	color:#ffffff;
	
}
.footer_link ul{
	margin-left:0px;
	padding-left:0px;
}

  #normal_table {
  margin-bottom:20px;
  }
#normal_table td {
    padding: 5px 10px;
    border: 1px solid #ADADAD;
  }
  
#normal_table td {
    font-size: 12px;
  }
  
</style>
</footer>
