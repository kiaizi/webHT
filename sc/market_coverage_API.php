<!doctype html>
  <html>
    <?php 
	
	
	define("IN_API", 1);
	
	include_once('global/global_header.php'); 
	
	
define("ID", getRequestVar('id',0));
	$sql = "select trading_support.*, trading_support_desc.name as name, trading_support_desc.detail from ".TB_TRADING_SUPPORT." as trading_support , ".TB_TRADING_SUPPORT_DESC." as trading_support_desc ";
	$sql .= " where ";
	$sql .= " trading_support.id=trading_support_desc.trading_support_id ";
	$sql .= " and trading_support_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and trading_support.disabled='0' ";
			
	$sql .= " and trading_support.id='".ID."' ";

	define('THIS_PAGE_SQL',$sql);
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$trading_support_id = $data['id'];
				$trading_support_name = $data['name'];
					$trading_support_category_id = $data['trading_support_category_id'];
				$trading_support_detail = displayHTML($data['detail']);
				$_REQUEST['date'] =  $data['display_date'];
				
				//if($meta_title == ''){
					$meta_title = $trading_support_name;
					$arr_seo_info['meta_title'] = $meta_title;
				//}

				//if($meta_desc == ''){
					$meta_desc = formatSEOInfo($trading_support_detail);
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
	
define('CID',$trading_support_category_id);
	
	$img = '';
	$sql = "select img from ".TB_TRADING_SUPPORT_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and trading_support_id='".ID."' ";
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
    
    <?php $a=3; $b=11; ?>
<body id="market-coverage-api">

    <?php include('global/header.php'); ?>


<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=3 ";
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






<!-- Market Coverage API Page Banner -->
  <div class="container-fluid contactus-container" style="padding: 0;">
    <img src="<?php echo $banner; ?>" class="img-fluid" style="width: 100%;">
  </div>

<!-- Market Coverage API Page Content -->
<div class="container mc-api-content">
  <div class="row">

    <!-- Market Coverage API Page Content - Left Side -->
    <?php include('side_menu_market_coverage.php'); ?>
<?php



	$rows = $G_DB_CONNECT->query(THIS_PAGE_SQL);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$trading_support_id = $data['id'];
				$trading_support_name = $data['name'];
						$trading_support_date = formatDate($data['display_date']);
				
				$trading_support_detail =  nl2br(displayHTML($data['detail']));
				$trading_support_category_id = $data['trading_support_category_id'];
				$trading_support_category_name = getLangName(TB_TRADING_SUPPORT_CATEGORY,"name",$trading_support_category_id,CURRENT_LANG);
				
			}
	}
?>
    <!-- Market Coverage API Page Content - Right Side -->
      <div class="col-lg-9 col-12 pt-lg-3 pl-lg-5">
        <div class="col-12 mt-2 mb-2">
          <span class="head_sction_link">业务覆盖 > 量化及程序化交易支持 > <span style="border-bottom: 2px solid #D93A16;"><?php echo $trading_support_name; ?></span></span>
        </div>
        <div class="col-12 pb-3">
            <div class="market_title_1"><?php echo $trading_support_name; ?></div>
            <div class="box_st_line"></div>
          
<?php echo $trading_support_detail; ?>
        </div>
        
        
        
        
        
        
      </div>
    
      </div>
        


    

<!-- News PDF Page Content End -->
  </div>
</div>





</body>

<?php include('global/footer.php'); ?>




</html>




