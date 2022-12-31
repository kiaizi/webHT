<!doctype html>
<html>
<?php include('global/html_head.php'); ?>


<?php $a = 0;?>
<body id="contact-us">
<?php include('global/header.php'); ?>
<?php /*if( $iPod || $iPhone || $Android || $iPad){  ?>
<style>
  .index_content_3 {
    bottom: 0;
    opacity: 0.8;
  }
</style>
<?php }*/ ?>




<?php

		
			$sql = "select home_banner.*, home_banner_desc.name as name, home_banner_desc.detail, home_banner_desc.url  from ".TB_HOME_BANNER." as home_banner , ".TB_HOME_BANNER_DESC." as home_banner_desc ";
			$sql .= " where ";
			$sql .= " home_banner.id=home_banner_desc.home_banner_id ";
			$sql .= " and home_banner_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and home_banner.disabled='0' ";
			
		  	$sql .= "  order by  home_banner.sort_order asc";
			
			
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
		
		
		if($total_record > 0 ){
?>






<!-- image-section -->
<div id="carouselExampleCaptions" class="carousel slide bottom_red_line" data-ride="carousel">
  <ol class="carousel-indicators">
  

<?php

		
			$sql = "select home_banner.*, home_banner_desc.name as name, home_banner_desc.detail, home_banner_desc.url  from ".TB_HOME_BANNER." as home_banner , ".TB_HOME_BANNER_DESC." as home_banner_desc ";
			$sql .= " where ";
			$sql .= " home_banner.id=home_banner_desc.home_banner_id ";
			$sql .= " and home_banner_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and home_banner.disabled='0' ";
			
		  	$sql .= "  order by  home_banner.sort_order asc";
			
			
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
		
		
	if($G_DB_CONNECT->affected_rows > 0){
		$k=0;
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
		
?>


    <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $k; ?>" <?php if($k==0){  echo 'class="active"'; }  ?>></li>


<?php
				$k++;
			}
		}
?>


  </ol>
  <div class="carousel-inner">
  
  
  
	<?php

		
			$sql = "select home_banner.*, home_banner_desc.name as name, home_banner_desc.detail, home_banner_desc.url, home_banner_desc.url2  from ".TB_HOME_BANNER." as home_banner , ".TB_HOME_BANNER_DESC." as home_banner_desc ";
			$sql .= " where ";
			$sql .= " home_banner.id=home_banner_desc.home_banner_id ";
			$sql .= " and home_banner_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and home_banner.disabled='0' ";
			
		  	$sql .= "  order by  home_banner.sort_order asc";
			
			
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($G_DB_CONNECT->affected_rows > 0){
?>
  
  

<?php
$k=0;
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
		$k++;
		
					$home_banner_id = $data['id'];
					$home_banner_name = nl2br($data['name']);
			
					$home_banner_detail = nl2br($data['detail']);
				
					$home_banner_url = $data['url'];
					$home_banner_url_target = $data['url_target'];
					$home_banner_url_target = getDataName(TB_URL_TARGET,'remark',$home_banner_url_target);
					
					
						$home_banner_url2 = $data['url2'];
					$home_banner_url_target2 = $data['url_target2'];
					$home_banner_url_target2 = getDataName(TB_URL_TARGET,'remark',$home_banner_url_target2);
					
		
?>


<?php
	$img = '';
	$sql = "select img from ".TB_HOME_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and home_banner_id='".$home_banner_id."' ";
//	$sql .= " and language_id='".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$img = DIR_PATH.$datap['img'];
			}
	}
	
	$img2 = '';
	$sql = "select img from ".TB_HOME_BANNER_PHOTO02;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and home_banner_id='".$home_banner_id."' ";
//	$sql .= " and language_id='".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$img2 = DIR_PATH.$datap['img'];
			}
	}
	
	if($img2 == ''){
		
		$img2 = $img;
	}
	$img3 = '';
	$sql = "select img from ".TB_HOME_BANNER_PHOTO03;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and home_banner_id='".$home_banner_id."' ";
//	$sql .= " and language_id='".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$img3 = DIR_PATH.$datap['img'];
			}
	}
	
?>
  
    <div class="carousel-item <?php if($k==1){  echo 'active'; }  ?>">
      <?php if( $iPod || $iPhone || $Android ){  ?>
        <img src="<?php echo $img2; ?>" class="d-block w-100" alt="...">
      <?php }else{ ?>
        <img src="<?php echo $img; ?>" class="d-block w-100" alt="...">
      <?php } ?>
      <div class="carousel-caption">
        <h5><?php echo $home_banner_name; ?><br><span><?php echo $home_banner_detail; ?></span></h5>
        <div class="row m-0">
		
<?php
	if($img3 != ''){
?>
          <a href="<?php echo $img3; ?>" target="_blank"><div class="know_more_btn_1 m-2">下载宣传手册</div></a>
		  <?php
	}
?> 
        </div>
      </div>
    </div>
			<?php

			}
?>
		<?php

			}
?>


  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<?php

		}
?>










 
<div class="container pt-5 pb-lg-5 con_mt"  style="max-width: 90%;">
  <div class="row">
  <div class="col-lg-3 col-12 text-lg-left text-center pb-3 news_head_title">
    <span class="title_1_rline">华泰新闻</span>
    <br><?php echo webpageContent(6,CURRENT_LANG); ?>
  </div>
  
  <div class="col-lg-9 col-12 text-left pb-lg-5">
  



<?php

	
			$sql = "select news.*, news_desc.name as name, news_desc.detail from ".TB_NEWS." as news , ".TB_NEWS_DESC." as news_desc ";
			$sql .= " where ";
			$sql .= " news.id=news_desc.news_id ";
			$sql .= " and news_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and news.disabled='0' ";
			//$sql .= " and news_category_id=1 ";
		 
					$sql .= " and highlight=1 ";
		 
		$sql .= "  order by  news.display_date desc,news.create_date desc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
?>

  
  <div class="owl-carousel owl-theme" id="index_slider_news">
    

<?php
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$news_id = $data['id'];
					$news_date = formatDate($data['display_date']);
				$news_category_id = $data['news_category_id'];
				$news_category_name = getLangName(TB_NEWS_CATEGORY,"name",$news_category_id,CURRENT_LANG);
				
					$news_name =$data['name'];
					$news_detail = displayHTML($data['detail']);
					$news_detail = draftText2(200,$data['detail']);
					$link  = 'news_detail.php?id='.$news_id;
				
?>

<?php
	$img = '';
	$sql = "select img from ".TB_NEWS_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and news_id='".$news_id."' ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$img = DIR_PATH.$datap['img'];
							$arr_data = getThumbPhotoPath($img,"img",200,200);
$thumb = $arr_data['img_path'];
			}
	}
?>
    <div class="item">
      
      <div class="idx_news_box_1 pb-3 mb-5"><a href=""><img src="<?php echo $img; ?>" width="100%"></a><div class="idx_news_title_1"><?php echo $news_category_name ; ?></div><div class="idx_news_content_1"><?php echo $news_name; ?>
      <br><br>
    <div class="know_more_btn_2 m-0 btn_link" href="">了解更多&nbsp;&nbsp;<img src="../images/index/kw_more_arr.svg" height="15" class="img_mb_5"></div>
        
        </div>
    </div>
      
    </div>
   
  
<?php
		}
?>


  
  
</div>





<?php
		}
?>






  </div>
  </div>
</div>
  
  
  

<?php

				$sql = "select home_promotion.*, home_promotion_desc.name as name, home_promotion_desc.detail, home_promotion_desc.url  from ".TB_HOME_PROMOTION." as home_promotion , ".TB_HOME_PROMOTION_DESC." as home_promotion_desc ";
			$sql .= " where ";
			$sql .= " home_promotion.id=home_promotion_desc.home_promotion_id ";
			$sql .= " and home_promotion_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and home_promotion.disabled='0' ";
			
			$sql .= "  order by  home_promotion.sort_order asc";
			

		$rows2 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
?>
<?php
			$k=0;
			while($data = $G_DB_CONNECT->fetch_array($rows2)){
			$k++;
							$home_promotion_id = $data['id'];
					$home_promotion_name = nl2br($data['name']);
					$home_promotion_detail= nl2br($data['detail']);
			
					$home_promotion_url = $data['url'];
					$home_promotion_url_target = $data['url_target'];
					$home_promotion_url_target = getDataName(TB_URL_TARGET,'remark',$home_promotion_url_target);

	
				
				
?>


<?php
	$img = '';
	$sql = "select img from ".TB_HOME_PROMOTION_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and home_promotion_id='".$home_promotion_id."' ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$img = DIR_PATH.$datap['img'];
				$arr_data = getThumbPhotoPath($img,"img",370,370);
			}
	}
	
	
?>



<div class="index_bg_2 d-md-block d-none" style="background-image:url(<?php echo $img; ?>)">
  <div class="index_content_2">
    <span class="title_1_rline"><?php echo $home_promotion_name; ?></span>
    <br><?php echo $home_promotion_detail; ?>
  </div>
</div>


<?php
	$img = '';
	$sql = "select img from ".TB_HOME_PROMOTION_PHOTO02;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and home_promotion_id='".$home_promotion_id."' ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$img = DIR_PATH.$datap['img'];
				$arr_data = getThumbPhotoPath($img,"img",370,370);
			}
	}
	
	
?>



<div class="index_bg_2 d-lg-none d-block" style="background-image:url(<?php echo $img; ?>)">
  <div class="index_content_2">
    <span class="title_1_rline"><?php echo $home_promotion_name; ?></span>
    <br><?php echo $home_promotion_detail; ?>
  </div>
</div>


<?php
		}
?>


<?php
		}
?>

  
  
  
  
<?php

	
			$sql = "select trading_market.*, trading_market_desc.name as name, trading_market_desc.detail, trading_market_desc.name3 from ".TB_TRADING_MARKET." as trading_market , ".TB_TRADING_MARKET_DESC." as trading_market_desc ";
			$sql .= " where ";
			$sql .= " trading_market.id=trading_market_desc.trading_market_id ";
			$sql .= " and trading_market_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_market.disabled='0' ";
		//	$sql .= " and trading_market_category_id=1 ";
		 
	$sql .= " and trading_market.highlight='1' ";
		 
		 $sql .= "  order by  trading_market.sort_order asc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
?>

  
<div class="container pt-5 pb-5"  style="max-width: 100%;">
  <div class="row">
  <div class="col-12 text-center pb-lg-5 pb-3">
    <span class="title_1_rline">中国及亚太市场覆盖</span>
  </div>
  </div>
  
  
  
  <div class="owl-carousel owl-theme" id="index_slider_3">
  
  
<?php
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$trading_market_id = $data['id'];
					$trading_market_date = formatDate($data['display_date']);
				
					$trading_market_name =$data['name'];
					$trading_market_name3 = nl2br($data['name3']);
					$trading_market_detail = displayHTML($data['detail']);
					$trading_market_detail = draftText2(200,$data['detail']);
					$link  = 'market_coverage_detail.php?id='.$trading_market_id;
				
?>

<?php
	$img = '';
	$sql = "select img from ".TB_TRADING_MARKET_PHOTO02;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and trading_market_id='".$trading_market_id."' ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$img = DIR_PATH.$datap['img'];
							$arr_data = getThumbPhotoPath($img,"img",200,200);
$thumb = $arr_data['img_path'];
			}
	}
?>
    <div class="item btn_link" href="">
	
	
      <img src="<?php echo $img ?>" width="100%">
      <div class="index_content_3">
        <span class="title_2_rline"><?php echo $trading_market_name ?></span><br><?php echo $trading_market_name3 ?>
      </div>
    </div>
  
<?php

	
		}
?>


  
</div>
  
  
</div>


<?php

	
		}
?>







  
  
<?php

	
			$sql = "select home_promotion2.*, home_promotion2_desc.name as name, home_promotion2_desc.detail, home_promotion2_desc.url from ".TB_HOME_PROMOTION2." as home_promotion2 , ".TB_HOME_PROMOTION2_DESC." as home_promotion2_desc ";
			$sql .= " where ";
			$sql .= " home_promotion2.id=home_promotion2_desc.home_promotion2_id ";
			$sql .= " and home_promotion2_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and home_promotion2.disabled='0' ";


		 
		 $sql .= "  order by  home_promotion2.sort_order asc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
?>



<?php
	$bg = '';
	$sql = "select img from ".TB_WEBPAGE_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and webpage_id=5 ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$bg = DIR_PATH.$datap['img'];
					
					
			}
	}
	
	$other_link = getLangName(TB_WEBPAGE,"url",5,CURRENT_LANG);
	$other_link_target =  getDataName(TB_WEBPAGE,'url_target',5 );
	$other_link_target = getDataName(TB_URL_TARGET,'remark',$other_link_target);
					
	
?>



<div class="index_bg_1" style="background-image:url(<?php echo $bg ; ?>)">
<div class="container" style="max-width: 90%;">
  <div class="row">
  <div class="col-12 text-center pt-lg-5 pb-lg-5 pt-3 pb-3">
    <span class="title_1_rline" style="color: white;">软件下载</span>
  </div>
  </div>
  <div class="row">
    <div class="col-12 pb-5 mb-lg-5">
      <div class="row">
	  

  
<?php
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$home_promotion2_id = $data['id'];
					$home_promotion2_date = formatDate($data['display_date']);
				
					$home_promotion2_name =$data['name'];
					$home_promotion2_detail= nl2br($data['detail']);
	
				$home_promotion2_url = $data['url'];
					$home_promotion2_url_target = $data['url_target'];
					$home_promotion2_url_target = getDataName(TB_URL_TARGET,'remark',$home_promotion2_url_target);
					
				
?>

<?php
	$img = '';
	$sql = "select img from ".TB_HOME_PROMOTION2_PHOTO02;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and home_promotion2_id='".$home_promotion2_id."' ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$img = DIR_PATH.$datap['img'];
							$arr_data = getThumbPhotoPath($img,"img",200,200);
$thumb = $arr_data['img_path'];
			}
	}
?>
        <div class="col-lg-3 col-6 p-lg-2 p-1">
          <a href="" target="">
          <div class="software_box_1">
            <div class="text_middle">
              <span class="software_title_1"><?php echo $home_promotion2_name;?></span><br><?php echo $home_promotion2_detail;?>
            </div>
          </div>
          </a>
        </div>
    <?php

		}
?>
  
  
	
      </div>
    </div>
    <div class="col-12 text-center pb-5">
      <div class="know_more_btn_2 btn_link" href="" target="">了解更多&nbsp;&nbsp;<img src="../images/index/kw_more_arr.svg" height="15" class="img_mb_5"></div>
    </div>
  </div>
</div>
  
  
</div>
  
  
  
  
<?php

		}
?>
  
  
  
  
  
  
<?php include('global/footer.php'); ?>
  <script>
    $('#index_slider_3').owlCarousel({
    stagePadding: 100,
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            stagePadding: 40,
        },
        600:{
            items:2,
            stagePadding: 100,
        }
    }
})
    $('#index_slider_news').owlCarousel({
    loop:true,
    nav:false,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1,
            margin:10,
        },
        600:{
            items:2,
            margin:20,
        },
        1000:{
            items:3,
            margin:30,
        }
    }
})
  </script>
</body>

</html>