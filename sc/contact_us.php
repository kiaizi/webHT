<!doctype html>
<html>

<style>
/* Contact Us Page Banner & Title */
  #contact-us .fct {
    max-width: 1600px;
    margin: auto;
  }

  #contact-us .title-bg{
    background-color:#F6F6F6;
    padding: 15px 0;
  }
  
  #contact-us .title-bg h3 {
    font-size: 18px;
    font-weight: bold;
    display: inline-block;
    margin: 0 180px;
    margin-right: 0px;
  }

  #contact-us span.square {
    border: 1px solid #D93A16;
    padding: 9px 4px;
    background-color: #D93A16;
    position: absolute;
    top: 0px;
    left: 175px;
  }

/* Contact Us Page Content */
  #contact-us .list-title {
    font-size: 18px;
    font-weight: bold;
    background-color: #f6F6F6;
    padding: 10px 15px 8px;
    line-height: 18px;
  }

  #contact-us tr {
    line-height: 35px;
}

  #contact-us td.tb-01 {
    font-size: 14px;
    color: #333333;
    padding-left: 15px;
  }

  #contact-us td.tb-02 {
    width: 55px;
  }

  #contact-us td.tb-03 {
    font-size: 14px;
    color: #333333;
  }

  #contact-us .container.mt-5.contact-wrappar-02 {
    padding-bottom: 100px;
  }

  #contact-us a.mail-to {
    color: #333333;
  }

  #contact-us .col-lg-6.col-12.report {
    display: none;
}


/* Mobile App */
@media only screen and (max-width: 767px) {
  /* Contact Us Page Banner & Title */
  #contact-us .title-bg {
    background-color: transparent;
    padding: 0px 0px;
  }

  #contact-us span.square {
    display: none;
  }

  #contact-us .title-bg h3 {
    font-size: 18px;
    font-weight: bold;
    color: #D93A16;
    margin: 0px;
    padding: 20px 0px; 
  }

  #contact-us .mt-5, .my-5 {
    margin-top: 0rem!important;
  }

  #contact-us .list-title {
    font-size: 14px;
    padding: 10px 10px 8px;
    line-height: 14px;
  }

  #contact-us td.tb-01 {
    font-size: 12px;
    width: 40px;
    padding-left: 10px;
    vertical-align: top;
  }

  #contact-us td.tb-02 {
    width: 45px;
  }

  #contact-us td.tb-03 {
    font-size: 12px;
    color: #333333;
  }

  #contact-us tr {
    line-height: 25px;
  }

  #contact-us table {
    border-collapse: collapse;
    margin-bottom: 35px;
  }

  #contact-us .container.mt-5.contact-wrappar-02 {
    padding-bottom: 25px;
  }


} 







</style>

<?php include('global/html_head.php'); ?>

<body id="contact-us">
<?php $a=6;?>
<?php include('global/header.php'); ?>




<?php
				
			$sql = "select webpage.*, webpage_desc.name as name, webpage_desc.detail , webpage_desc.address from ".TB_WEBPAGE." as webpage , ".TB_WEBPAGE_DESC." as webpage_desc ";
			$sql .= " where ";
			$sql .= " webpage.id=webpage_desc.webpage_id ";
			$sql .= " and webpage_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and webpage.disabled='0' ";
			$sql .= " and webpage.id=36 ";
		
		 	$sql .= "  order by  webpage.sort_order asc  ";

	
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($G_DB_CONNECT->affected_rows > 0){

			while($data = $G_DB_CONNECT->fetch_array($rows)){

					$webpage_id = $data['id'];
				
					$address = nl2br($data['address']);
					
					$tel = $data['tel'];
					
					$fax = $data['fax'];
				
					$email = $data['email'];
					
					
					$tel2 = $data['tel2'];
					$fax2 = $data['fax2'];
					$email2 = $data['email2'];
					
					$tel3 = $data['tel3'];
					$fax3 = $data['fax3'];
					$email3 = $data['email3'];
					
					$tel4 = $data['tel4'];
					$fax4 = $data['fax4'];
					$email4 = $data['email4'];

					
		
			}
		}

	
?>


<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=12 ";
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


<!-- Contact Us Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>联系我们</h3></div>
    </div>
  </div>


<!-- Contact Us Page Content -->
  <div class="container mt-5 contact-wrappar">
    <div class="row">
      <div class="col-lg-6 col-12">
        <h3 class="list-title">联系方式</h3>
          <table>
            <tbody>
			
						<?php
if($address != ''){
?>
        			
              <tr>
                <td class="tb-01">地址</td>
                <td class="tb-02"></td>
                <td class="tb-03"><?php echo $address; ?></td>
              </tr>
			<?php
}
?>
        
					<?php
if($tel != ''){
?>
        
              <tr>
                <td class="tb-01">电话</td>
                <td class="tb-02"></td>
                <td class="tb-03"><?php echo $tel; ?></td>
              </tr>

			<?php
}
?>
        
					<?php
if($fax != ''){
?>

              <tr>
                <td class="tb-01">传真</td>
                <td class="tb-02"></td>
                <td class="tb-03"><?php echo $fax; ?></td>
              </tr>
			  
					<?php
}
?>
        
	
			  
            </tbody>
          </table>
      </div>

      <div class="col-lg-6 col-12">
        <h3 class="list-title">交易热线（24小时服务）</h3>
          <table>
            <tbody>
			
			<?php
if($tel2 != ''){
?>
              <tr>
                <td class="tb-01">电话</td>
                <td class="tb-02"></td>
                <td class="tb-03"><?php echo $tel2; ?></td>
              </tr>
			<?php
}
?>  
			<?php
if($email2 != ''){
?>

              <tr>
                <td class="tb-01">电邮</td>
                <td class="tb-02"></td>
                <td class="tb-03"><a href="mailto:<?php echo $email2; ?>" class="mail-to"><?php echo $email2; ?></a></td>
              </tr>
					<?php
}
?>  	  
			  
            </tbody>
          </table>
      </div>

    </div>
  </div>


  <div class="container mt-5 contact-wrappar-02">
    <div class="row">
      <div class="col-lg-6 col-12">
        <h3 class="list-title">出入金及账户服务</h3>
          <table>
            <tbody>
			
			<?php
if($tel3 != ''){
?>
              <tr>
                <td class="tb-01">电话</td>
                <td class="tb-02"></td>
                <td class="tb-03"><?php echo $tel3; ?></td>
              </tr>
			<?php
}
?>
			<?php
if($email3 != ''){
?>
              <tr>
                <td class="tb-01">电邮</td>
                <td class="tb-02"></td>
                <td class="tb-03"><a href="mailto:<?php echo $email3; ?>" class="mail-to"><?php echo $email3; ?></a></td>
              </tr>
				<?php
}
?>		  
			  
            </tbody>
          </table>
      </div>

      <div class="col-lg-6 col-12 report">
       <!--<h3 class="list-title">投诉</h3>-->
          <table>
            <tbody>
			
			<?php
if($tel4 != ''){
?>
              <tr>
                <td class="tb-01">电话</td>
                <td class="tb-02"></td>
                <td class="tb-03"><?php echo $tel4; ?></td>
              </tr>
<?php
}
?>
<?php
if($email4 != ''){
?>
              <tr>
                <td class="tb-01">电邮</td>
                <td class="tb-02"></td>
                <td class="tb-03"><a href="mailto:<?php echo $email4; ?>" class="mail-to"><?php echo $email4; ?></a></td>
              </tr>
<?php
}
?>  
            </tbody>
          </table>
      </div>

    </div>
  </div>



    


  
</body>

<?php include('global/footer.php'); ?>

</html>