<?php include_once('global/global_header.php'); ?>

<style>
  
</style>

<?php $ho = $_GET['p']; $de = $_GET['date']; ?>


<?php if ($ho != 'h') { ?>

<!--

	<?php if ($de=='_'.'2020_11_2') { ?>

<span class="day_title_clr_1">富时A50指数(SCN) 2020-10</span>
<span class="day_title_clr_2">恒生指数选择权 (HSI) 2020-10</span>






<div class="for_more">more</div>
<?php } ?>


<?php if ($de=='_'.'2020_11_6') { ?>

<span class="day_title_clr_2">富时A50指数(SCN) 2020-10</span>
<span class="day_title_clr_2">恒生指数选择权 (HSI) 2020-10</span>
<span class="day_title_clr_2">恒生指数 (HSI) 2020-10</span>

<div class="for_more">more</div>
<?php } ?>

<?php if ($de=='_'.'2020_11_27') { ?>

<span class="day_title_clr_2">富时A50指数(SCN) 2020-11</span>
<span class="day_title_clr_2">恒生指数选择权 (HSI) 2020-11</span>
<span class="day_title_clr_2">恒生指数 (HSI) 2020-11</span>

<div class="for_more">more</div>
<?php } ?>
-->

<?php

	
			$sql = "select trading_future.*, trading_future_desc.name as name, trading_future_desc.detail  from ".TB_TRADING_FUTURE." as trading_future , ".TB_TRADING_FUTURE_DESC." as trading_future_desc ";
			$sql .= " where ";
			$sql .= " trading_future.id=trading_future_desc.trading_future_id ";
			$sql .= " and trading_future_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_future.disabled='0' ";

	 $sql .= "   group by display_date ";
		 
		 $sql .= "  order by  trading_future.display_date desc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			$k=0;
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$k++;
					$trading_future_id = $data3['id'];
				
					$trading_future_name =$data3['name'];
					$display_date =$data3['display_date'];
					$trading_future_date = formatDateOther($data3['display_date']);

				
?>

<?php if ($de=='_'.$trading_future_date) { ?>
<div class="pointer">

<?php

	
			$sql = "select trading_future.*, trading_future_desc.name as name, trading_future_desc.detail  from ".TB_TRADING_FUTURE." as trading_future , ".TB_TRADING_FUTURE_DESC." as trading_future_desc ";
			$sql .= " where ";
			$sql .= " trading_future.id=trading_future_desc.trading_future_id ";
			$sql .= " and trading_future_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_future.disabled='0' ";

	 $sql .= "  and display_date='$display_date' ";
		 
	$main_sql=	 $sql .= "  order by  trading_future.display_date desc  ";
			



		$rows4 = $G_DB_CONNECT->query($sql);

		$total_record = $G_DB_CONNECT->affected_rows;


		$main_sql = $main_sql." limit 0,5";
		$rows4 = $G_DB_CONNECT->query($main_sql);
		if($G_DB_CONNECT->affected_rows > 0){

			while($data4 = $G_DB_CONNECT->fetch_array($rows4)){

					$trading_future_id = $data4['id'];
				
					$trading_future_name =$data4['name'];
					
				
					$trading_future_category_id = $data4['trading_future_category_id'];
				
?>


	        <span class="day_title_clr_<?php echo $trading_future_category_id;?>"><?php echo $trading_future_name; ?></span><br><br>

	  <?php

	
			}
		}
	
?>	
	  
</div>
<?php
if($total_record > 5){
?>
<div class="for_more" style="cursor:pointer">more</div>
<?php
}
?>

<?php } ?>



	  
<?php

	
			}
		}
	
				
?>




<?php }else{ ?>

<!--
	<?php if ($de=='_'.'2020_11_11') { ?>
<div class="pointer">
      <span class="day_title_h">BMD棕榈油期货休市CME：</span> LC06合约<br><br>
      <span class="day_title_h">EUREX：</span>GBL、GBM、GBS、FGBX、FOAT、FBTP、FBON、FBTS06合约
</div>
<div class="for_more">more</div>
<?php } ?>

-->
	  
<?php

	
			$sql = "select trading_hoilday.*, trading_hoilday_desc.name as name, trading_hoilday_desc.detail  from ".TB_TRADING_HOILDAY." as trading_hoilday , ".TB_TRADING_HOILDAY_DESC." as trading_hoilday_desc ";
			$sql .= " where ";
			$sql .= " trading_hoilday.id=trading_hoilday_desc.trading_hoilday_id ";
			$sql .= " and trading_hoilday_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_hoilday.disabled='0' ";

	 $sql .= "   group by display_date ";
		 
		 $sql .= "  order by  trading_hoilday.display_date desc ";
			

		$rows3 = $G_DB_CONNECT->query($sql);
		$total_record = $G_DB_CONNECT->affected_rows;
		if($G_DB_CONNECT->affected_rows > 0){
			$k=0;
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$k++;
					$trading_hoilday_id = $data3['id'];
				
					$trading_hoilday_name =$data3['name'];
					$display_date =$data3['display_date'];
					$trading_hoilday_date = formatDateOther($data3['display_date']);

				
?>

<?php if ($de=='_'.$trading_hoilday_date) { ?>
<div class="pointer">

<?php

	
			$sql = "select trading_hoilday.*, trading_hoilday_desc.name as name, trading_hoilday_desc.detail  from ".TB_TRADING_HOILDAY." as trading_hoilday , ".TB_TRADING_HOILDAY_DESC." as trading_hoilday_desc ";
			$sql .= " where ";
			$sql .= " trading_hoilday.id=trading_hoilday_desc.trading_hoilday_id ";
			$sql .= " and trading_hoilday_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_hoilday.disabled='0' ";

	 $sql .= "  and display_date='$display_date' ";
		 
		$main_sql= $sql .= "  order by  trading_hoilday.display_date desc ";
			

		$rows4 = $G_DB_CONNECT->query($sql);

$total_record = $G_DB_CONNECT->affected_rows;

$main_sql= $main_sql. "  limit 0,5 ";
			

$rows4 = $G_DB_CONNECT->query($main_sql);

		if($G_DB_CONNECT->affected_rows > 0){

			while($data4 = $G_DB_CONNECT->fetch_array($rows4)){

					$trading_hoilday_id = $data4['id'];
				
					$trading_hoilday_name =$data4['name'];
					
				
				
?>

      <span class="day_title_h"><?php echo $trading_hoilday_name; ?></span><br><br>

	  <?php

	
			}
		}
	
?>	
	  
</div>
<?php
if($total_record > 5){
?>
<div class="for_more" style="cursor:pointer">more</div>
<?php
}
?>
<?php } ?>



	  
<?php

	
			}
		}
	
				
?>


	  
	  



<?php } ?>

