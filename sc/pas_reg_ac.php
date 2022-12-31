<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>

<style>
  /* Reg AC Page Width*/
    #reg_ac .ctm-width{
      max-width: 1200px;
      margin: auto;
    }

  /* Reg AC Page Banner & Title */
    #reg_ac .title-bg {
      background-color: #F6F6F6;
      padding: 15px 0;
    }

    #reg_ac .title-bg h3 {
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      margin: 0 80px;
      margin-right: 0px;
    }

    #reg_ac span.square {
      border: 1px solid #D93A16;
      padding: 9px 4px;
      background-color: #D93A16;
      position: absolute;
      top: 0px;
      left: 75px;
    }

  /* Reg AC Page Content */
    #reg_ac .container.reg_ac_content{
      max-width: 1200px;
      margin: auto;
      margin-bottom: 150px;
    }
  
    #reg_ac .reg_ac_content .col-lg-12 {
      padding: 50px 70px;
    }

      /* Reg AC Page Content -- Icon */
        #reg_ac ion-icon[name="add-circle"] {
          color: #D93A16;
          padding-right: 15px;
          vertical-align: text-bottom;
        }

      /* Reg AC Page Content -- Text */
        #reg_ac .reg_ac_content a {
          font-size: 14px;
          color: #797979;
          text-decoration: none;
        }

        #reg_ac .personal, #reg_ac .organization{
          border-bottom: 1px solid #707070;
          padding: 10px 0;
        }


/* Mobile ---- Reg_ac Page */
  @media only screen and (max-width: 767px){
    #reg_ac .container.reg_ac_content {
      margin-bottom: 50px;
    }

    #reg_ac .title-bg h3 {
      font-size: 18px;
      margin: 0 15px;
      font-weight: bold;
    }
    
    #reg_ac span.square {
      border: 1px solid #D93A16;
      padding: 8px 3px;
      background-color: #D93A16;
      position: absolute;
      top: 2px;
      left: 15px;
    }

    #reg_ac .reg_ac_content .col-lg-12 {
      padding: 20px 15px;
    }

    #reg_ac .reg_ac_content a {
      font-size: 14px;
      color: #797979;
      text-decoration: none;
    }

  }

</style>



<body id="reg_ac">
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


<!-- Reg_AC Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>账户开立</h3></div>
    </div>
  </div>

<!-- Reg_AC Page Content -->
  <div class="container reg_ac_content">
    <div class="row">
       <div class="col-lg-12">
          <div class="personal"><ion-icon name="add-circle"></ion-icon><span><a href="../sc/pas_reg_ac_online.php">个人客户网上开户</a></span></div>
          <div class="organization"><ion-icon name="add-circle"></ion-icon><span><a href="../sc/pas_reg_ac_offline.php">机构及个人线下开户</a></span></div>
          <div class="organization"><ion-icon name="add-circle"></ion-icon><span><a href="../sc/pas_reg_ac_openacc.php">内盘开户附加申请文件</a></span></div>
       </div>
    </div>
  </div>

</body>

<?php include('global/footer.php'); ?>


<script>





</script>

</html>




