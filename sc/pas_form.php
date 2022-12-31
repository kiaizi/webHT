<style>
  /* Product and Service Form Page */
    #pas-form .ctm-width{
      max-width: 1200px;
      margin: auto;
    }

  /* Product and Service Form Page Banner & Title */
    #pas-form .title-bg{
      background-color: #F6F6F6;
    }

    #pas-form .title-bg h3{
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      padding: 10px 0px 5px 80px;
    }

    #pas-form span.square{
      border: 1px solid #D93A16;
      padding: 9px 4px;
      background-color: #D93A16;
      position: absolute;
      top: 9px;
      left: 75px;
    }


  /* Product and Service Form Page Content */
    #pas-form .container.pas-form-dl {
      max-width: 1095px;
      padding: 50px 25px;
      padding-bottom: 200px;
    }

    #pas-form .cpfd-text h4{
      font-size: 16px;
      color: #333;
      border-bottom: 1px solid #707070;
      padding-bottom: 5px;
    }

    #pas-form table.pf-content {
      margin-top: 50px;
    }

    #pas-form table.pf-content td {
      font-size: 14px;
      color: #333;
     padding-bottom: 10px;
    }

    #pas-form .pf-content td span {
      color: #D93A16;
      padding-left: 5px;
    }

    #pas-form .row.pas-forms {
      font-size: 14px;
      color: #333333;
      padding-top: 0px;
    }

    #pas-form .row.pas-forms p {
      padding-top: 10px;
    }

    #pas-form span.pas-form-text a {
      color: #D93A16;
      padding-right: 10px;
    }

    @media (min-width: 992px) {
      .col-lg-3 {
        flex: 26% !important;
        max-width: 26% !important;
        margin-top: 4%;
      }
    }


/*Mobile Page */
  @media only screen and (max-width: 767px){

    #pas-form .title-bg h3 {
    font-size: 18px;
    padding: 10px 0px 0px 25px;
    }

    #pas-form span.square {
      padding: 9px 4px;
      top: 10px;
      left: 20px;
    }

    #pas-form .cpfd-text h4 {
      font-size: 14px;
    }

    #pas-form .container.pas-form-dl {
      padding: 20px 20px;
      padding-bottom: 200px;
    }

    #pas-form .row.pas-forms {
      font-size: 12px;
      color: #333333;
      padding-top: 15px;
    }

    #pas-form .col-lg-3 {
      padding-bottom: 30px !important;
    }

    #pas-form .col-lg-3.col-6.m-div {
      padding: 0px 15px;
    }
  
  
  
    #pas-form #reg_ac_offline #myBtn {
      display: none;
      position: ;
      bottom: 20px;
      right: 20px;
      z-index: 99;
      font-size: 12px;
      border: none;
      outline: none;
      background-color: #eee;
      color: white;
      cursor: pointer;
      padding: 12px 10px;
      border-radius: 10px;
    }

    #myBtn:hover {
      background-color: #555;
    }
  
  
  }








    
    

</style>

<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>

<body id="pas-form">

    <?php include('global/header.php'); ?>
	
	
<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=10 ";
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


<!-- Product and Service Form Page -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>
  
  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>表单下载</h3></div>
    </div>
  </div>
  
  
  


<?php

	
			$sql = "select download.*, download_desc.name as name, download_desc.detail  from ".TB_DOWNLOAD." as download , ".TB_DOWNLOAD_DESC." as download_desc ";
			$sql .= " where ";
			$sql .= " download.id=download_desc.download_id ";
			$sql .= " and download_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and download.disabled='0' ";
			$sql .= " and id=1 ";
		 

		 
		 $sql .= "  order by  download.sort_order asc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$download_id = $data['id'];
					$download_date = formatDate($data['display_date']);
				
					$download_name =$data['name'];
	
					$download_detail = displayHTML($data['detail']);
					
			}
		}
					

				
?>
  
  
  
  

<!-- Product and Service Form Page Content -->
    <div class="container pas-form-dl content-wrapper">
      <div class="cpfd-text"><h4><?php echo $download_name; ?></h4></div>
      
      <div class="row pas-forms">
	  

   
       
	   
  <?php
	$sql = "select * from ".TB_DOWNLOAD_PHOTO;
	$sql .= " where download_id='".$download_id."' and disabled=0";
	$sql .= " order by sort_order asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
				$title_text = ($data2['title_'.CURRENT_LANG_DIR]);
				$title = nl2br($data2['title_'.CURRENT_LANG_DIR]);
				$img = DIR_PATH.$data2['img'];
				$file = DIR_PATH.$data2['img2'];
?>

        <div class="col-lg-3 col-6"><?php echo $title ?>
          <p><img src="<?php echo $img ; ?>" alt=""></p>
          <span class="pas-form-text"><a href="<?php echo $file ; ?>" download="<?php echo $title_text ; ?>" >点击此处下载</span><span><img src="../images/download.svg" alt=""></a></span>
        </div>

<?php
			}
	}
?>	
        

        
      </div>

      

      

    </div>




              
  
    
    


</body>

<?php include('global/footer.php'); ?>


<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

</html>




