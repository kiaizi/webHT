<style>
  /* Reg AC - Online Page Backgound */
    #reg_ac_online .ctm-width{
      max-width: 1300px;
      margin: auto;
    }

  /* Reg AC - Online Page Banner & Title */
    #reg_ac_online .title-bg{
      background-color: #F6F6F6;
      padding: 10px 0;
    }

    #reg_ac_online .title-bg h3{
      font-size: 18px;
      display: inline-block;
      padding: 0px 80px;
    }

    #reg_ac_online span.square{
      border: 1px solid #D93A16;
      padding: 9px 4px;
      background-color: #D93A16;
      position: absolute;
      top: 0px;
      left: 75px;
    }

  /* Reg AC - Online Page Content */
    #reg_ac_online .container.account-online {
      max-width: 1300px;
      margin: auto;
      margin-bottom: 150px;
    }

    #reg_ac_online .col-lg-12.online-content {
      padding: 30px 70px;
    }

    #reg_ac_online .back-to-page {
      font-size: 12px;
      color: #797979;
      margin-bottom: 30px;
    }

    #reg_ac_online .back-to-page a:link, #reg_ac_online .back-to-page a:visited, 
    #reg_ac_online .back-to-page a:hover, #reg_ac_online .back-to-page a:active{
      color: #797979;
      text-decoration: none;
    }

    #reg_ac_online .online-content h4 {
      font-size: 16px;
      font-weight: bold;
      color: #333333;
      border-bottom: 1px solid #707070;
      padding-bottom: 10px;
    }

    #reg_ac_online .online-content p {
      font-size: 14px;
      color: #797979;
      padding-top: 5px;
    }

    #reg_ac_online .online-qr-code {
      margin: 40px 0px;
      font-size: 14px;
      color: #333;
    }

    #reg_ac_online img.oqc-img {
      padding-top: 10px;
    }

    #reg_ac_online .online-manual {
      margin: 40px 0px;
      font-size: 14px;
      color: #333333;
    }
    
    #reg_ac_online img.om-img {
      padding-top: 10px;
    }

    #reg_ac_online span.manual-text {
      font-size: 14px;
      color: #D93A16;
      padding-right: 10px;
    }

    #reg_ac_online .ao-page-faq{
      position: absolute;
      bottom: 130;
      right: 0;
    }

    #reg_ac_online img.faq-icon {
      z-index: 9999;
    position: fixed;
    right: 1%;
    top: 81%;
}

/* Mobile ---- Reg_ac Online Page */
  @media only screen and (max-width: 767px){
    #reg_ac_online .container.account-online {
      max-width: 1600px;
      margin: auto;
      margin-bottom: 10px;
    }

    #reg_ac_online .title-bg h3 {
      font-size: 18px;
      font-weight: bold;
      padding: 0 10px;
    }
    
    #reg_ac_online span.square {
    border: 1px solid #D93A16;
    padding: 8px 3px;
    background-color: #D93A16;
    position: absolute;
    top: 1px;
    left: 10;
  }

    #reg_ac_online .col-lg-12.online-content {
      padding: 20px 10px;
    }

    #reg_ac_online .back-to-page {
      font-size: 12px;
      margin-bottom: 25px;
    }

    #reg_ac_online .online-content h4 {
      font-size: 14px;
      padding-bottom: 6px;
    }

    #reg_ac_online .online-content p {
      font-size: 12px;
    }

    #reg_ac_online .online-qr-code {
      margin: 25px 0px;
      font-size: 12px
    }

    #reg_ac_online .online-manual {
      margin: 25px 0px;
      font-size: 12px;
    }

    #reg_ac_online img.faq-icon {
      z-index: 9999;
    position: fixed;
    bottom: 0%;
    right: 5%;
    width: 70px;
    height: auto;
    top: 60%;
}

  }

    
</style>

<!doctype html>
  <html>
    <?php 
	
	include('global/html_head.php'); 
	
	define('ID',1);
	
	?>

<body id="reg_ac_online">
  <?php $a=5;?>
    <?php include('global/header.php'); ?>



<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=7 ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$banner = DIR_PATH.$datap['img'];
							$arr_data = getThumbPhotoPath($img,"img",200,200);
$thumb = $arr_data['img_path'];
			}
	}
    
?>


  
<?php

	
			$sql = "select openaccount.*, openaccount_desc.name as name, openaccount_desc.detail  from ".TB_OPENACCOUNT." as openaccount , ".TB_OPENACCOUNT_DESC." as openaccount_desc ";
			$sql .= " where ";
			$sql .= " openaccount.id=openaccount_desc.openaccount_id ";
			$sql .= " and openaccount_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and openaccount.disabled='0' ";
			$sql .= " and id=".ID." ";
		 

		 
		 $sql .= "  order by  openaccount.sort_order asc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$openaccount_id = $data['id'];
					$openaccount_date = formatDate($data['display_date']);
				
					$openaccount_name =$data['name'];
	
					$openaccount_detail = displayHTML($data['detail']);
					
}
}
				
?>



<!-- AC Online Page Top -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>
  
<!-- AC Online Page Title -->
  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>Account Opening</h3></div>
    </div>
  </div>

<!-- FAQ Icon -->
<a href="pas_faq.php"><img src="../images/faq_en.png" alt="" class="faq-icon"></a>





<!-- AC Online Page Content -->
  <div class="container account-online">
    <div class="row">

        <div class="col-lg-12 online-content">
          <div class="back-to-page"><a href="../en/pas_reg_ac.php">Back to Previous</a></div>
            <h4><?php echo $openaccount_name; ?></h4>
              <?php echo $openaccount_detail; ?>


<?php
	$sql = "select * from ".TB_OPENACCOUNT_PHOTO02;
	$sql .= " where openaccount_id='".ID."' and disabled=0";
	$sql .= " order by sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$title = nl2br($data['title_'.CURRENT_LANG_DIR]);
				$img = DIR_PATH.$data['img'];
?>
            <div class="online-qr-code"><?php echo $title; ?>
              <p><img src="<?php echo $img; ?>" alt="" class="oqc-img"></p>
            </div>
<?php
			}
	}
?>	
			

<?php
	$sql = "select * from ".TB_OPENACCOUNT_PHOTO;
	$sql .= " where openaccount_id='".ID."' and disabled=0";
	$sql .= " order by sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$title_text = ($data['title_'.CURRENT_LANG_DIR]);
				$title = nl2br($data['title_'.CURRENT_LANG_DIR]);
				$img = DIR_PATH.$data['img'];
				$file = DIR_PATH.$data['img2'];
?>
            <div class="online-manual"><?php echo $title ; ?>
              <p>
                <img src="<?php echo $img ; ?>" alt="" class="om-img" style="max-height:80px;"><br>
                <span class="manual-text">Click to Download</span>
                <a href="<?php echo $file ; ?>"  download="<?php echo $title_text ; ?>" class="form-img-text"><img src="../images/download.svg" download></a>
              </p>
            </div>
			
			
<?php
			}
	}
?>		
          
          </div>
        </div>
    </div>
  </div>
    
  
    
    


</body>

<?php include('global/footer.php'); ?>


<script>

var tabTr = document.querySelectorAll('.nlp-table tr >td');


//console.log(tabTr);



for (var i = 0 ; i < tabTr.length ; i++){

  tabTr[i].onclick = function(){


   //console.log('click');

 
   
  tabTr[i].style.fontWeight ="900";
}


}









</script>

</html>




