<style>
/* News PDF Testing Page Banner & Title */
  #news-pdf .ctm-width {
    max-width: 1180px;
    margin: auto;
  }

  #news-pdf .title-bg {
    background-color: #F6F6F6;
  }

  #news-pdf .col-lg-12.ctm-width h3 {
    display: inline-block;
    font-size: 18px;
    font-weight: bold;
    color: #333333;
    padding: 10px 75px;
    padding-bottom: 3px;
  }

  #news-pdf span.square {
    border: 1px solid #D93A16;
    background-color: #D93A16;
    padding: 9px 5px;
    position: absolute;
    top: 9px;
    left: 70px;
  }

  /* News PDF Testing Page Content */
  #news-pdf .container.news-pdf {
    max-width: 1025px;
    margin: 80px auto 100px auto;
    }

  /* News PDF Testing Page - Left Side */
    /* ~~~~~ Card Head ~~~~~ */
      #news-pdf .card-header {
        padding: 0px;
        background-color: transparent;
        border: none;
      }

      #news-pdf ul.left-side-link {
        font-size: 18px;
        color: #333;
        padding: 0px 0px;
        border-bottom: 1px solid #D93A16;
        padding-bottom: 3px;
      }

      /* #news-pdf i.card-header-icon.fa.fa-plus-circle {
        font-size: 22px;
        color: #D93A16;
        float: right;
      }

      #news_pdf ul.left-side-link::before {
        float: right;
        font-family: FontAwesome;
        content: "\f056";
        font-size: 18px;
        color: #D93A16;
      }

      #news_pdf ul.left-side-link.collapsed::before {
        float: right !important;
        content:"\f055";
      }

    /* ~~~~~ Card Body ~~~~~ */
      #news-pdf .card-body {
        padding: 0px;
      }

      #news-pdf .list-group {
        border: 1px solid transparent;
        margin-top: -5px;
      }

      #news-pdf .list-group-item {
      position: relative;
      display: block;
      border: none;
      color: #797979;
      font-size: 14px;
      padding: 3px 15px;
      }

      #news-pdf .list-group-item.active::before {
        content: "";
        border: 1px solid #D93A16;
        background-color: #D93A16;
        padding: 0px 4px;
        margin-right: 5px;
      }

      #news-pdf .list-group-item.active {
        z-index: 2;
        background-color: transparent;
        color: #D93a16;
        font-size: 14px;
        padding: 3px 0px 3px 0px;
      }
    
  /* News PDF Testing Page - Right Side */
      #news-pdf .col-lg-10.col-12.right-side-list {
        padding: 70px 0px 0px 150px;
      }

      #news-pdf .list-content {
        list-style: none;
        text-decoration: none;
        padding-bottom: 15px;
        padding-right: 15px;
      }

      #news-pdf .list-c-text {
        border-bottom: 1px solid #707070;
        padding-bottom: 15px;
      }
      
      #news-pdf span.rsl-text {
        font-size: 14px;
        color: #797979;
      }

      #news-pdf span.rsl-red-text {
        font-size: 14px;
        color: #D93A16;
        float: right;
      }
      
      #news-pdf img.rsl-img {
        padding-left: 10px;
        padding-right: 0px;
      }

  /* News PDF Testing Page - Overflow Scroll */
    #news-pdf .tab-pane {
      overflow-y: scroll;
      height: 600px;
      border-radius: 20px;
    }

    /* ~~~~~ Overflow Scroll - Scrollbar ~~~~~ */
      #news-pdf .tab-pane::-webkit-scrollbar {
        width: 5px;
      }
    
    /* ~~~~~ Overflow Scroll - Track ~~~~~ */
      #news-pdf .tab-pane::-webkit-scrollbar-track {
        border: 1px solid #707070;
        background-clip: content-box;
        border-radius: 20px;
        background-color: #707070;
      }
    
    /* ~~~~~ Overflow Scroll - Track ~~~~~ */
    #news-pdf .tab-pane::-webkit-scrollbar-thumb {
        background: #D93A16; 
        border-radius: 20px;
      }


/* News PDF Page - Mobile */
  @media only screen and (max-width: 767px){
    /* News PDF Testing Page Banner & Title */
      #news-pdf .title-bg {
        background-color: transparent;
      }

      #news-pdf span.square {
        display: none;
      }

      #news-pdf .col-lg-12.ctm-width h3 {
        display: inline-block;
        font-size: 18px;
        font-weight: bold;
        color: #D93A16;
        padding: 20px 0px;
      }
    
     /* News PDF Testing Page Content */
      #news-pdf .container.news-pdf {
        margin: 0px;
      }

      #news-pdf ul.left-side-link {
        font-size: 16px;
      }

      #news-pdf .list-group-item.active {
        color: #D93a16;
        font-size: 14px;
      }
      
      #news-pdf .list-group-item {
      font-size: 14px;

      }

      #news-pdf .col-lg-10.col-12.right-side-list {
        padding: 20px 5px 50px 10px;
      }

      #news-pdf span.rsl-text {
        font-size: 12px;
      }

      #news-pdf span.rsl-red-text {
        font-size: 12px;
      }

      #news-pdf .tab-pane {
        overflow-y: unset;
        height: auto;
      }

  }
















      







  


          
</style>

<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>

<body id="news-pdf">

    <?php include('global/header.php'); ?>


<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=2 ";
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


<!-- News PDF Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>????????????</h3></div>
    </div>
  </div>


<!-- News PDF Page Content -->
<div class="container news-pdf">
  <div class="row">

    <!-- News PDF Page Content - Left Side -->
        <div class="col-lg-2 col-12 left-side-list">
          <div class="card-header">
            <ul class="left-side-link">
            ????????????<!--<i class="card-header-icon fa fa-plus-circle" aria-hidden="true"></i>-->
            </ul>
          </div>

          <div class="card-body">
          <div class="list-group" id="list-tab" role="tablist">
         
		 


<?php

	
			$sql = "select important_notice_category.*, important_notice_category_desc.name as name, important_notice_category_desc.detail  from ".TB_IMPORTANT_NOTICE_CATEGORY." as important_notice_category , ".TB_IMPORTANT_NOTICE_CATEGORY_DESC." as important_notice_category_desc ";
			$sql .= " where ";
			$sql .= " important_notice_category.id=important_notice_category_desc.important_notice_category_id ";
			$sql .= " and important_notice_category_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and important_notice_category.disabled='0' ";


		 
		 $sql .= "  order by  important_notice_category.sort_order asc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			$k=0;
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$k++;
					$important_notice_category_id = $data3['id'];
				
					$important_notice_category_name =$data3['name'];
	
				
?>
  


	        <a class="list-group-item list-group-item-action <?php if($k == 1){ echo 'active';} ?>" id="list-product-list<?php echo $important_notice_category_id; ?>" data-toggle="list" href="#list-product<?php echo $important_notice_category_id; ?>" role="tab" aria-controls="product"><span><?php echo $important_notice_category_name; ?></span></a>
           
	  
	  
<?php

	
			}
			}
	
				
?>



			   </div>
          </div>

        </div>

    <!-- News PDF Page Content - Right Side -->
      <div class="col-lg-10 col-12 right-side-list">
        <div class="tab-content" id="nav-tabContent">





	  
<?php

	
			$sql = "select important_notice_category.*, important_notice_category_desc.name as name, important_notice_category_desc.detail  from ".TB_IMPORTANT_NOTICE_CATEGORY." as important_notice_category , ".TB_IMPORTANT_NOTICE_CATEGORY_DESC." as important_notice_category_desc ";
			$sql .= " where ";
			$sql .= " important_notice_category.id=important_notice_category_desc.important_notice_category_id ";
			$sql .= " and important_notice_category_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and important_notice_category.disabled='0' ";


		 
		 $sql .= "  order by  important_notice_category.sort_order asc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			$k=0;
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$k++;
					$important_notice_category_id = $data3['id'];
				
					$important_notice_category_name =$data3['name'];
	
				
?>
        <!-- News PDF Page Content - Left Side - Column 1 ~ ??????????????? -->
          <div class="tab-pane fade show <?php if($k == 1){ echo 'active';} ?>" id="list-product<?php echo $important_notice_category_id; ?>" role="tabpanel" aria-labelledby="list-product-list<?php echo $important_notice_category_id; ?>">
        <?php

	
			$sql = "select important_notice.*, important_notice_desc.name as name, important_notice_desc.detail  from ".TB_IMPORTANT_NOTICE." as important_notice , ".TB_IMPORTANT_NOTICE_DESC." as important_notice_desc ";
			$sql .= " where ";
			$sql .= " important_notice.id=important_notice_desc.important_notice_id ";
			$sql .= " and important_notice_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and important_notice.disabled='0' ";
			$sql .= " and important_notice_category_id='$important_notice_category_id' ";
		 

		 
		 $sql .= "  order by  important_notice.display_date desc,create_date desc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$important_notice_id = $data['id'];
					$important_notice_date = formatDate($data['display_date']);
				
					$important_notice_name =$data['name'];
	
					$important_notice_detail = displayHTML($data['detail']);
					





				
?> 

<?php
	$file = '';
	$sql = "select img from ".TB_IMPORTANT_NOTICE_PDF;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and important_notice_id='".$important_notice_id."' ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$file = DIR_PATH.$datap['img'];
			
			}
	}
?>
			<div class="list-content">
              <div class="list-c-text">
                <li><a href="<?php echo $file ?>" download="<?php echo $important_notice_name ?>" ><span class="rsl-text"><?php echo $important_notice_name ?></span><span class="rsl-red-text">??????????????????<img src="../images/download.svg" alt="" class="rsl-img"></span></a></li>
              </div>
            </div>

<?php

	}
	}
	
				
?>
          </div>
    <!-- END OF !!!!!!!! News PDF Page Content - Left Side - Column 1 ~ ??????????????? --> 




	  
<?php

	}
	}
	
				
?>
      </div>
    </div>

<!-- END OF !!!!!!!!  News PDF Page Content -->
  </div>
</div>





</body>

<?php include('global/footer.php'); ?>


<script>

</script>

</html>




