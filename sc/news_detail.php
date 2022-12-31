<style>
  /* News Detail Page Banner & Title */
    #news-detail .col-lg-12.ctm-width {
      max-width: 1000px;
      margin: auto;
    }

    #news-detail .title-bg{
      background-color: #F6F6F6;
    }

    #news-detail .title-bg h3{
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      padding: 10px 0px 5px 5px;
    }

    #news-detail span.square{
      border: 1px solid #D93A16;
      padding: 9px 5px;
      background-color: #D93A16;
      position: absolute;
      top: 10px;
      left: 0px;
    }

  /* News Detail Page Content */
    #news-detail .container.news-detail {
      max-width: 1025px;
    }

    #news-detail .back-to-page {
      margin-top: 20px;
      font-size: 12px;
      color: #797979;
      margin-bottom: 40px;
    }

    #news-detail a.back-01 {
    font-size: 12px;
    color: #797979;
}

    #news-detail span.btp-02 {
      display: none;
    }

    #news-detail span.btp-05 {
      display: none;
    }

    #news-detail .left-side {
      font-size: 18px;
      color: #D93A16;
    }

    #news-detail p.blk-text {
      font-size: 14px;
      color: #333333;
    }

    #news-detail p.blk-text-2 {
    font-size: 14px;
    color: #333333;
    }
    
    /*Button */
    #news-detail .news-list-btn {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin-top: 50px;
      margin-bottom: 100px;
    }

    #news-detail .news-list-btn-01 a {
      display: block;
      width: 154px;
      height: 51px;
      line-height: 51px;
      font-size: 22px;
      text-decoration: none;
      color: #D93A16;
      border: 2px solid #D93A16;
      letter-spacing: 2px;
      text-align: center;
      position: relative;
      transform: skew(-20deg);
      transition: all .35s;
    }

    #news-detail .news-list-btn-01 a span {
      position: relative;
      z-index: 2;
      display: inline-block;
      transform: skew(20deg);
    }

    #news-detail .news-list-btn-01 a:after {
      position: absolute;
      content: "";
      top: 0;
      left: 0;
      width: 0;
      height: 100%;
      background-color: #D93A16;
      transition: all .35s;
      color: #fff;
      z-index: -99;
    }

    #news-detail .news-list-btn-01 a:hover {
      color: #fff;
      text-decoration: none;
      border: 1px solid;
    }

    #news-detail .news-list-btn-01 a:hover:after {
      width: 100%;
    }

    #news-detail .hydrated {
      vertical-align: text-top;
    }

    #news-detail .news-list-btn-02 a {
      display: block;
      width: 154px;
      height: 51px;
      line-height: 51px;
      font-size: 22px;
      text-decoration: none;
      color: #D93A16;
      border: 2px solid #D93A16;
      letter-spacing: 2px;
      text-align: center;
      position: relative;
      transform: skew(-20deg);
      transition: all .35s;
    }

    #news-detail .news-list-btn-02 a span {
      position: relative;
      z-index: 2;
      display: inline-block;
      transform: skew(20deg);
    }

    #news-detail .news-list-btn-02 a:after {
      position: absolute;
      content: "";
      top: 0;
      left: 0;
      width: 0;
      height: 100%;
      background-color: #D93A16;
      transition: all .35s;
      color: #fff;
      z-index: -99;
    }

    #news-detail .news-list-btn-02 :hover {
      color: #fff;
      text-decoration: none;
      border: 1px solid;
    }

    #news-detail .news-list-btn-02 a:hover:after {
      width: 100%;
    }

    #news-detail .hydrated{
      vertical-align: text-top;
    }

    #news-detail ion-icon.md.hydrated {
    transform: skew(20deg);
    padding-top: 5px;
}

/* Mobile App */
@media only screen and (max-width: 767px){
  #news-detail .title-bg {
    display: none;
  }

  #news-detail .back-to-page {
    margin-bottom: 20px;
  }

  #news-detail a.back-01 {
    font-size: 12px;
    color: #797979;
  }
  
  
  #news-detail span.btp-01 {
    font-size: 12px;
  }

  #news-detail span.btp-02, .news-detail span.btp-03 {
    display: none;
  }

  #news-detail span.btp-04 {
    display: block;
    position: relative;
    font-size: 12px;
    color: #D93A16;
    line-height: 25px;
  }

  #news-detail span.btp-05 {
    display: block;
    position: absolute;
    top: 40px;
    left: 85px;
    font-size: 12px;
    color: #D93A16;
    line-height: 20px;
  }

  #news-detail .left-side {
    font-size: 18px;
    padding-bottom: 15px;
  }

  #news-detail p.blk-text {
    font-size: 14px;
  }

  #news-detail p.blk-text-2 {
    font-size: 14px;
  }

  #news-detail .news-list-btn-01 a {
    width: 90px;
    height: 35px;
    line-height: 30px;
    font-size: 12px;
  }

#news-detail .news-list-btn-02 a {
    width: 90px;
    height: 35px;
    line-height: 30px;
    font-size: 12px;
  }

  #news-detail .news-list-btn {
    justify-content: space-around;
    margin-bottom: 60px;
  }

  #news-detail .news-list-btn-02 {
      padding-left: 0px;
    }

    #news-detail ion-icon.md.hydrated {
    transform: skew(20deg);
    padding-top: 3px;
  }




}
   


    

</style>

<!doctype html>
  <html>
  
  
  
    <?php 
	
	
	
	include_once('global/global_header.php');

define("ID", getRequestVar('id',0));
	$sql = "select news.*, news_desc.name as name, news_desc.detail from ".TB_NEWS." as news , ".TB_NEWS_DESC." as news_desc ";
	$sql .= " where ";
	$sql .= " news.id=news_desc.news_id ";
	$sql .= " and news_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and news.disabled='0' ";
			
	$sql .= " and news.id='".ID."' ";

	define('THIS_PAGE_SQL',$sql);
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$news_id = $data['id'];
				$news_name = $data['name'];
					$news_category_id = $data['news_category_id'];
				$news_detail = displayHTML($data['detail']);
				$_REQUEST['date'] =  $data['display_date'];
				
				//if($meta_title == ''){
					$meta_title = $news_name;
					$arr_seo_info['meta_title'] = $meta_title;
				//}

				//if($meta_desc == ''){
					$meta_desc = formatSEOInfo($news_detail);
					$arr_seo_info['meta_desc'] = $meta_desc ;
					
					
					$seo_keyword =$data['seo_keyword']; ;
					if($seo_keyword != ''){
						$arr_seo_info['meta_keyword'] = $seo_keyword ;
					}
				//}

			}
	}else{
		include("index.php");
		exit();
	}
	
define('CID',$news_category_id);
	
	$img = '';
	$sql = "select img from ".TB_NEWS_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and news_id='".ID."' ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1  ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
		while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$img = $datap['img'];
					$arr_data = getThumbPhotoPath($img,"thumb",250,250);

				$og_image = OUR_SERVER.$arr_data['img_path'];
		}
	}



	include_once('global/html_head.php');



	?>

<body id="news-detail">

    <?php include('global/header.php'); ?>



<?php



	$rows = $G_DB_CONNECT->query(THIS_PAGE_SQL);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$news_id = $data['id'];
				$news_name = $data['name'];
						$news_date = formatDate($data['display_date']);
				
				$news_detail =  nl2br(displayHTML($data['detail']));
				$news_category_id = $data['news_category_id'];
				$news_category_name = getLangName(TB_NEWS_CATEGORY,"name",$news_category_id,CURRENT_LANG);
				
			}
	}
?>

<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=1 ";
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
    
	
		$sql = "select img from ".TB_NEWS_PHOTO02;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and news_id='".ID."' ";
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


<!-- News Detail Page Banner & Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3><?php echo $news_category_name; ?></h3></div>
    </div>
  </div>

<!-- News Detail Page Content -->
<div class="container news-detail">
  <div class="row">
    <div class="col-lg-12 col-12 first-col">
      <div class="back-to-page"><span class="btp-01"><a href="../sc/news_list.php" class="back-01">返回</a></span><span class="btp-02">上一頁</span><span class="btp-03"> | </span><span class="btp-04"><?php echo $news_date; ?></span><span class="btp-05"><?php echo $news_category_name; ?></span></div>
    </div>

    <div class="col-lg-2 col-12">
      <div class="left-side">
        <?php echo $news_name; ?>
      </div>
    </div>

    <div class="col-lg-2 col-12"></div>

    <div class="col-lg-8 col-12">
      <div class="right-side">


		   <?php echo $news_detail; ?>
		 
      </div>
    </div>

    <div class="col-lg-3 col-12"></div>



<?php


	$prev_news_id = ID;
	$next_news_id = ID;
	
	$sql = "select news.id  from ".TB_NEWS." as news , ".TB_NEWS_DESC." as news_desc ";
	$sql .= " where ";
	$sql .= " news.id=news_desc.news_id ";
	$sql .= " and news_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and news.disabled='0' ";
$sql .= " and news.news_category_id='".CID."' ";
		
		//$sql .= " and concat(news.start_date,' ',news.start_time)     <='".NOW."' ";
	
		//$sql .= " and concat(news.end_date,' ',news.end_time)>='".NOW."' ";
	
	
	
	$sql .= "  order by ";
	$sql .=  " news.display_date desc ";
			
	
	
	
	
	
	
	$arr_news_id = array();
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$news_id = $data['id'];
				array_push($arr_news_id,$news_id);
			}
	}
	
	for($i=0;$i<count($arr_news_id);$i++){
		if($arr_news_id[$i] == ID){
			$prev_news_id = $arr_news_id[$i-1] ;
			$next_news_id =  $arr_news_id[$i+1] ;
		}
	}
	
	

	


?>

	  




    <div class="col-lg-6 col-12">
      <div class="news-list-btn">
	  
	  			<?php
	if($prev_news_id > 0){

		
?>		  	

		  
        <div class="news-list-btn-01">
          <a href="news_detail.php?id=<?php echo $prev_news_id;?>">
            <ion-icon name="chevron-back-outline"></ion-icon>
            <span>上一则</span>
          </a>
        </div>
		
				<?php
	}

		
?>		  	

		  	
				<?php
	if($next_news_id > 0){

		
?>		  	

		  	

        <div class="news-list-btn-02">
                <a href="news_detail.php?id=<?php echo $next_news_id;?>">
            <span>下一则</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </a>
        </div>
		
						<?php
	}

		
?>		
		
		
    </div>

    <div class="col-lg-3 col-12"></div>
    
    
    </div>

    





  </div>
</div>











</body>

<?php include('global/footer.php'); ?>

</html>