<!doctype html>
  <html>
    <?php include('global/html_head.php'); ?>


<style>
  /* News List Page Wrapper */
    #news_list .ctm-width{
      max-width: 1200px;
      margin: auto;
    }

  /* News List Page Banner & Tittle */
    #news_list .title-bg{
      background-color: #F6F6F6;
    }

    #news_list .title-bg h3 {
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      padding: 10px 0px 2px 85px;
    }

    #news_list span.square {
      border: 1px solid #D93A16;
      padding: 9px 4px;
      background-color: #D93A16;
      position: absolute;
      top: 10px;
      left: 80px;
    }

  /* News List Page Content */
    #news_list .news-list-content {
      max-width: 1147px;
      margin: auto;
      padding: 80px 75px;
    }

  /* News List Page Content - Left Page */
    #news_list h4.nlp-clp-title{
      font-size: 18px;
      color: #333;
      border-bottom: 1px solid #D93A16;
      padding-bottom: 10px;
    }

    #news_list .list-group-item {
      border: transparent !important;
      font-size: 14px;
      color: #797979 !important;
      padding: 3px 0px;
    }

    #news_list .list-group-item.active {
      color: #D93A16 !important;
      background-color: transparent !important;
      border-color: transparent !important;
    }

    #news_list .list-group-item.active::before{
      content: "";
      border: 1px solid #D93A16;
      padding: 0px 4px;
      background: #D93A15;
      margin-right: 5px;
    }

    #news_list .list-group-item.active span{
      margin-left: 0px;
    }

    #news_list .list-group-item span{
      margin-left: 15px;
    }
  
  /* News List Page Content - Right Page */
    #news_list .tab-pane {
      padding: 70px 80px;
      padding-right: 0px;
    } 

    #news_list ul.nlp-table {
      list-style-type: none;
      font-size: 14px;
      padding-left: 0px;
      padding-bottom: 10px;
    }

    #news_list ul.nlp-table li {
      border-bottom: 1px solid #707070;
      padding-bottom: 10px;
    }

    #news_list span.date {
      color: #D93A16;
      padding-left: 0px;
      padding-right: 10px;
    }

    #news_list spna.area {
      color: #D93A15;
      padding-left: 0px;
      padding-right: 10px;
    }

    #news_list span.info {
      color: #333;
      padding-left: 20px;
    }

    #news_list span.li-img {
      float: right;
    }

    #news_list ul.nlp-table a:hover {
      font-weight: 600;
    }


/* Mobile Page */
  @media only screen and (max-width: 767px){
    #news_list .title-bg {
      background-color: transparent;
      padding: 10px 0;
    }

    #news_list span.square {
      display: none;
    }

    #news_list .title-bg h3 {
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      padding: 10px 0px;
      color: #D93A16;
    }

    #news_list .news-list-content {
      margin: auto;
      padding: 0px 13px;
    }

    #news_list h4.nlp-clp-title {
      font-size: 16px;
      color: #333;
      border-bottom: 1px solid #D93A16;
      padding-bottom: 10px;
    }

    #news_list .list-group-item {
      border: transparent !important;
      font-size: 14px;
      color: #797979 !important;
      padding: 3px 0px;
      background-color: transparent;
    }

    #news_list .tab-pane {
      padding: 20px 0px;
      padding-right: 0px;
      padding-bottom: 50px;
    }

    #news_list ul.nlp-table {
      font-size: 12px; 
    }

    #news_list span.date {
      display: block;
    }

    #news_list spna.area {
      display: block;
    }

    #news_list span.info {
      padding-left: 0px;
      padding-right: 20px;
      display: block;
    }

    #news_list ul.nlp-table li {
    padding-bottom: 25px;
}




  }



 
    

</style>



<body id="news_list">

    <?php include('global/header.php'); ?>

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
    
?>
<!-- News List Page Background and Title -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>
  
  <div class="contaniner-fluid">
    <div class="title-bg">
      <div class="col-lg-12 ctm-width"><span class="square"></span><h3>华泰新闻</h3></div>
    </div>
  </div>

<!-- News List Page Content -->
  <div class="container news-list-content">
    <div class="row">

      <div class="col-lg-2 col-12 nlp-left-page">
      <h4 class="nlp-clp-title">新闻类别</h4>
        <div class="list-group" id="list-tab" role="tablist">

<?php

	
			$sql = "select news_category.*, news_category_desc.name as name, news_category_desc.detail  from ".TB_NEWS_CATEGORY." as news_category , ".TB_NEWS_CATEGORY_DESC." as news_category_desc ";
			$sql .= " where ";
			$sql .= " news_category.id=news_category_desc.news_category_id ";
			$sql .= " and news_category_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and news_category.disabled='0' ";


		 
		 $sql .= "  order by  news_category.sort_order asc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			$k=0;
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$k++;
					$news_category_id = $data3['id'];
				
					$news_category_name =$data3['name'];
	
				
?>
  
		
          <a class="list-group-item list-group-item-action <?php if($k == 1){ echo 'active';} ?>" id="list-cn-list<?php echo $news_category_id; ?>" data-toggle="list" href="#list-cn<?php echo $news_category_id; ?>" role="tab" aria-controls="cn"><span><?php echo $news_category_name; ?></span></a>
      
<?php

	
			}
			}
	
				
?>
   </div>
      </div>

    <div class="col-lg-10 col-12 nlp-right-page">
      <div class="tab-content" id="nav-tabContent">
	  
	  
	  
<?php

	
			$sql = "select news_category.*, news_category_desc.name as name, news_category_desc.detail  from ".TB_NEWS_CATEGORY." as news_category , ".TB_NEWS_CATEGORY_DESC." as news_category_desc ";
			$sql .= " where ";
			$sql .= " news_category.id=news_category_desc.news_category_id ";
			$sql .= " and news_category_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and news_category.disabled='0' ";


		 
		 $sql .= "  order by  news_category.sort_order asc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			$k=0;
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$k++;
					$news_category_id = $data3['id'];
				
					$news_category_name =$data3['name'];
	
				
?>
        <div class="tab-pane fade show <?php if($k == 1){ echo 'active';} ?>" id="list-cn<?php echo $news_category_id; ?>" role="tabpanel" aria-labelledby="list-cn-list<?php echo $news_category_id; ?>">
          
		  
		 	  
<?php

	
			$sql = "select news.*, news_desc.name as name, news_desc.detail  from ".TB_NEWS." as news , ".TB_NEWS_DESC." as news_desc ";
			$sql .= " where ";
			$sql .= " news.id=news_desc.news_id ";
			$sql .= " and news_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and news.disabled='0' ";
			$sql .= " and news_category_id='$news_category_id' ";
		 

		 
		 $sql .= "  order by  news.display_date desc,create_date desc ";
			

		$rows = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
			
					$news_id = $data['id'];
					$news_date = formatDate($data['display_date']);
				
					$news_name =$data['name'];
	
					$news_detail = displayHTML($data['detail']);
					
$link = 'news_detail.php?id='.$news_id;



				
?> 
		  
		  <ul class="nlp-table">
            <li>
              <a href="<?php echo $link; ?>"><span class="date"><?php echo $news_date; ?></span><spna class="area"><?php echo $news_category_name; ?></spna><span class="info"><?php echo $news_name; ?></span></a>
                <span class="li-img"><img src="../images/news_list_path.svg" alt=""></span>
            </li>
          </ul>
<?php

	
			}
		}
	
				
?>

        </div>



<?php

	
			}
		}
	
				
?>


      </div>

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

 
   
  tabTr.style.fontWeight ="900";
}


}




</script>

</html>




