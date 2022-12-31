<!doctype html>
<html>
<style>
.container.sm-text-col-01 {
    margin: 10px 0px;
    font-size: 16px;
}

.col-lg-12.col-1g.smtc-01 {
    padding: 0px 10px;
}

.backToTopBtn-mcc {
    position: absolute;
    right: 130px;
    top: 23740px;
}

.market_table_width {
    width: 100%;
    word-break: break-all;
    word-wrap: break-word;
}

@media only screen and (max-width: 1700px) {
  .market_table_div_en {
    overflow-x: scroll !important;
}
}


@media only screen and (max-width: 464px){
	.container.sm-text-col-01 {
    font-size: 14px;
}

.backToTopBtn-mcc {
    position: absolute;
    right: 20px;
    top: 17050px;
}
}


</style>

<?php include('global/html_head.php'); ?>

<body id="contact-us">
<?php include('global/header.php'); ?>
  
<!-- image-section -->

<?php
	$banner = '';
	$sql = "select img from ".TB_BANNER_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and banner_id=14 ";
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
  
<img src="<?php echo $banner; ?>" width="100%" class="bottom_red_line">
  
  <div class="container pt-3 pb-3" style="max-width: 1200px;">
    <div class="row">
      <div class="col-12 mt-2 mb-2">
        <span class="head_sction_link">Product Information > <a href="../en/pas_reg_pnb.php" style="color:#212529;">Contract Spec & Margin</a> > <span style="border-bottom: 2px solid #D93A16;">Contract Specs</span></span>
      </div>
      <div class="col-12 mt-2 mb-2">
	  <form name="frm_search"  id="frm_search" method="GET" enctype="multipart/form-data" action=""  target="_self" autocomplete="off" >

        <div class="row">
		



		
              <div class="col-lg-2 col-4 pr-1 pb-1">
        <div class="market_table_search1">
          <select name="sortby" id="sortby">
            <option  value="">Ordering</option>
            <option value="1" <?php if($_REQUEST['sortby'] == 1){ echo 'selected';} ?>>A-Z</option>
            <option value="2" <?php if($_REQUEST['sortby'] == 2){ echo 'selected';} ?>>Z-A</option>
          </select>
        </div>
                </div>
              <div class="col-lg-2 col-4 pl-1 pr-1 pb-1">
        <div class="market_table_search1">
               <select name="code2" id="code2">
            <option  value="">Code</option>
			

<?php

	
			$sql = "select trading.*, trading_desc.name as name, trading_desc.detail, trading_desc.detail1, trading_desc.detail2, trading_desc.detail3, trading_desc.detail4, trading_desc.detail5, trading_desc.detail6, trading_desc.detail7, trading_desc.detail8  from ".TB_TRADING." as trading , ".TB_TRADING_DESC." as trading_desc ";
			$sql .= " where ";
			$sql .= " trading.id=trading_desc.trading_id ";
			$sql .= " and trading_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading.disabled='0' ";


		 	 $sql .= " group by code2 ";
			
		 $sql .= "  order by  trading.code2 asc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
	
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
		
					$code = nl2br($data3['code']);
						$code2 = nl2br($data3['code2']);
?>	
            <option <?php if($_REQUEST['code2'] == $code2){ echo 'selected';} ?>><?php echo $code2; ?></option>


<?php

	
			}
		}
?>	

          </select>
        </div>
                </div>
              <div class="col-lg-2 col-4 pl-1 pb-1">
        <div class="market_table_search1">
   <select name="code" id="code">
            <option value="">Exchange</option>

<?php

	
			$sql = "select trading.*, trading_desc.name as name, trading_desc.detail, trading_desc.detail1, trading_desc.detail2, trading_desc.detail3, trading_desc.detail4, trading_desc.detail5, trading_desc.detail6, trading_desc.detail7, trading_desc.detail8  from ".TB_TRADING." as trading , ".TB_TRADING_DESC." as trading_desc ";
			$sql .= " where ";
			$sql .= " trading.id=trading_desc.trading_id ";
			$sql .= " and trading_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading.disabled='0' ";


		 	 $sql .= " group by code ";
			
		 $sql .= "  order by  trading.code asc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
	
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
		
					$code = nl2br($data3['code']);
						$code2 = nl2br($data3['code2']);
?>	
            <option <?php if($_REQUEST['code'] == $code){ echo 'selected';} ?>><?php echo $code; ?></option>


<?php

	
			}
		}
?>	

          </select>
        </div>
                </div>
                <div class="col-lg-3 col-7 pb-1 pr-1">
                  <div class="market_table_search1">
                    <div class="input-group">
                      <input type="text" name="s" id="s" value="<?php echo $_REQUEST['s'];?>" class="form-control searchbar_input" placeholder="Exchange/ Code" aria-label="Exchange/ Code" aria-describedby="button-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn_search" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
				
				
				
<?php
$download_name= getLangName(TB_WEBPAGE,"name",43,CURRENT_LANG);

	$img = '';
	$sql = "select img from ".TB_WEBPAGE_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and webpage_id=43 ";
	//$sql .= " and language_id='".CURRENT_LANG."' ";
	 $sql .= " order by sort_order asc  limit 0,1 ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
			
				$img = DIR_PATH.$datap['img'];
			
			}
	}
    if($img != ''){
?>
          
                <div class="col-lg-3 col-5 pb-1 pl-1">
                  <a href="<?php echo $img; ?>" target="_blank">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td align="center" valign="top" class="market_table_dl_list"><?php echo $download_name;?></td>
                          <td width="5"></td>
                          <td align="left" valign="middle" width="30"><img src="../images/download.svg" width="30"></td>
                        </tr>
                      </table>
                    </a>
                  </div>
				  
				  
<?php
	}
?>	  
				  
				  
				  
            </div>
			</form>
      </div>
      
      <div class="market_table_div_en">
      <table class="market_table_width" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <th style="width: 140px;">Exchange</th>
          <th style="width: 70px;">Code</th>
          <th style="width: 120px;">Product</th>
          <th style="width: 120px;">Contract Size</th>
          <th style="width: 170px;">Tick Size</th>
          <th style="width: 120px;">Settlement Currency</th>
          <th style="width: 190px;">Minimum Price Fluctuation</th>
          <th style="width: 200px;">Price Limit/ Circuit</th>
          <th style="width: 200px;">Trading Hours</th>
          <th style="width: 120px;">Listed Contracts</th>
          <th style="width: 120px;">Settlement Methods</th>
        </tr>
		

	  
<?php

	
$search_condition = '';
$s = trim(strtolower($_REQUEST['s']));
if( $_REQUEST['s'] != ''){
	$getParams['s'] = $_REQUEST['s'];
	
	
				
			 $search_condition .= " and ( ";

	$search_condition .= " ((trading_desc.name)) like (('%$s%')) ";


	$search_condition .= " or trim(lower(trading.code)) like trim(lower('%$s%')) ";



	$search_condition .= " ) ";
	
}


if( $_REQUEST['code'] != ''){
		$search_condition .= " and trim(lower(trading.code)) = trim(lower('".$_REQUEST['code']."')) ";

}
if( $_REQUEST['code2'] != ''){
		$search_condition .= " and trim(lower(trading.code2)) = trim(lower('".$_REQUEST['code2']."')) ";

}
	
			$sql = "select trading.*, trading_desc.name as name, trading_desc.detail, trading_desc.detail1, trading_desc.detail2, trading_desc.detail3, trading_desc.detail4, trading_desc.detail5, trading_desc.detail6, trading_desc.detail7, trading_desc.detail8  from ".TB_TRADING." as trading , ".TB_TRADING_DESC." as trading_desc ";
			$sql .= " where ";
			$sql .= " trading.id=trading_desc.trading_id ";
			$sql .= " and trading_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading.disabled='0' ";
$sql .= $search_condition;

if($_REQUEST['sortby'] == 1){
	$sql .= "  order by code asc ";
}else if($_REQUEST['sortby'] == 2){
$sql .= "  order by code desc ";
}else{
	$sql .= "  order by  trading.sort_order asc ";
}
		 
		 


		 
		 
		 
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			$k=0;
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$k++;
					$trading_id = $data3['id'];
				
					$trading_name =$data3['name'];
					
					$code = nl2br($data3['code']);
						$code2 = nl2br($data3['code2']);
						
						
					$trading_name =nl2br($data3['name']);
					$trading_detail1 =nl2br($data3['detail1']);
				$trading_detail2 =nl2br($data3['detail2']);
				$trading_detail7 =nl2br($data3['detail7']);
				$trading_detail8 =nl2br($data3['detail8']);
				$trading_detail3 =nl2br($data3['detail3']);
				$trading_detail4 =nl2br($data3['detail4']);
				$trading_detail5 =nl2br($data3['detail5']);
				$trading_detail6 =nl2br($data3['detail6']);
					
						
	
				
?>
		
		
        <tr>
          <td><?php echo $code; ?></td>
          <td><?php echo $code2; ?></td>
          <td><?php echo $trading_name; ?></td>
          <td><?php echo $trading_detail1; ?></td>
          <td><?php echo $trading_detail2; ?></td>
          <td><?php echo $trading_detail7; ?></td>
           <td><?php echo $trading_detail8; ?></td>
         <td><?php echo $trading_detail3; ?></td>
          <td><?php echo $trading_detail4; ?></td>
           <td><?php echo $trading_detail5; ?></td>
           <td><?php echo $trading_detail6; ?></td>
        </tr>

	  
<?php

			}
		}
	
				
?>
      </table>
      </div>
      
      <div class="container sm-text-col-01">
			<div class="row">
				<div class="col-lg-12 col-1g smtc-01">
				<div class="mcm-page-sm-text">
				

				<?php echo webpageContent(51,CURRENT_LANG); ?>
				
				
				
				
									</div>
				</div>
			</div>
		</div>
      

      
    </div>

	
    
  </div>
  
  
  
<?php include('global/footer.php'); ?>
  
  <script>
  $('#frm_search select').change(function(e) {
     document.frm_search.submit();

		
 });
   $('#frm_search .btn_search').click(function(e) {
	      e.preventDefault();
     document.frm_search.submit();

		
 });
  </script>
  

</body>

</html>