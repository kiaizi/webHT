<?php include_once('global/global_header.php'); ?>


<?php $ho = $_GET['p']; $de = $_GET['date'];



$arr_de = explode('_',$de);
$year = $arr_de[1];
$month = $arr_de[2];
$day = $arr_de[3];

if($month < 10){
	$month = '0'.$month;
}


if($day < 10){
	$day = '0'.$day;
}

$final_date = $year."-".$month."-".$day;





?>

<?php if ($ho != 'h') { ?>


<!--

<?php if ($de=='_'.'2020_11_2') { ?>
            <div class="color_box_1"></div>
            <div class="color_box_3"></div>
<?php } ?>
<?php if ($de=='_'.'2020_11_6') { ?>
            <div class="color_box_2"></div>
<?php } ?>
<?php if ($de=='_'.'2020_11_9') { ?>
            <div class="color_box_2"></div>
<?php } ?>
<?php if ($de=='_'.'2020_11_27') { ?>
            <div class="color_box_1"></div>
            <div class="color_box_2"></div>
            <div class="color_box_3"></div>
<?php } ?>



<?php if ($de=='_'.'2021_3_31') { ?>
            <div class="color_box_1"></div>
            <div class="color_box_3"></div>
<?php } ?>

-->







<?php

	
			$sql = "select trading_future.*, trading_future_desc.name as name, trading_future_desc.detail  from ".TB_TRADING_FUTURE." as trading_future , ".TB_TRADING_FUTURE_DESC." as trading_future_desc ";
			$sql .= " where ";
			$sql .= " trading_future.id=trading_future_desc.trading_future_id ";
			$sql .= " and trading_future_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_future.disabled='0' ";
			$sql .= " and display_date='$final_date' ";


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
  
  
<?php

	
			$sql = "select trading_future.*, trading_future_desc.name as name, trading_future_desc.detail  from ".TB_TRADING_FUTURE." as trading_future , ".TB_TRADING_FUTURE_DESC." as trading_future_desc ";
			$sql .= " where ";
			$sql .= " trading_future.id=trading_future_desc.trading_future_id ";
			$sql .= " and trading_future_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_future.disabled='0' ";

	 $sql .= "  and display_date='$display_date' ";
		 
	 $sql .= "  group by trading_future_category_id order by  trading_future.trading_future_category_id asc  ";
			




	
		$rows4 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){

			while($data4 = $G_DB_CONNECT->fetch_array($rows4)){

					$trading_future_id = $data4['id'];
				
					$trading_future_name =$data4['name'];
					
				
					$trading_future_category_id = $data4['trading_future_category_id'];
				
?>

<div class="color_box_<?php echo $trading_future_category_id;?>"></div>

	  <?php

	
			}
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
            <div class="color_box_4"></div>
<?php } ?>

-->





	  
<?php

	
			$sql = "select trading_hoilday.*, trading_hoilday_desc.name as name, trading_hoilday_desc.detail  from ".TB_TRADING_HOILDAY." as trading_hoilday , ".TB_TRADING_HOILDAY_DESC." as trading_hoilday_desc ";
			$sql .= " where ";
			$sql .= " trading_hoilday.id=trading_hoilday_desc.trading_hoilday_id ";
			$sql .= " and trading_hoilday_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_hoilday.disabled='0' ";
			$sql .= " and display_date='$final_date' ";


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


<?php

	
			$sql = "select trading_hoilday.*, trading_hoilday_desc.name as name, trading_hoilday_desc.detail  from ".TB_TRADING_HOILDAY." as trading_hoilday , ".TB_TRADING_HOILDAY_DESC." as trading_hoilday_desc ";
			$sql .= " where ";
			$sql .= " trading_hoilday.id=trading_hoilday_desc.trading_hoilday_id ";
			$sql .= " and trading_hoilday_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_hoilday.disabled='0' ";

	 $sql .= "  and display_date='$display_date' ";
		 
		 $sql .= "  order by  trading_hoilday.display_date desc limit 0,1 ";
			

		$rows4 = $G_DB_CONNECT->query($sql);
		$c=0;
		if($G_DB_CONNECT->affected_rows > 0){

			while($data4 = $G_DB_CONNECT->fetch_array($rows4)){
$c++;
					$trading_hoilday_id = $data4['id'];
				
					$trading_hoilday_name =$data4['name'];
					
	
				
?>

<div class="color_box_4"></div>

	  <?php

	
			}
		}
	
?>	
	  

<?php } ?>



	  
<?php

	
			}
		}
	
				
?>


	  





<?php } ?>




