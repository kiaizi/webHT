<?php include_once('global/global_header.php'); ?>


<?php $ho = $_GET['p']; $de = $_GET['date']; ?>

<?php if ($ho != 'h') { ?>




<!--
<?php if ($de=='_'.'2020_11_2') { ?>
<div class="date_pop_div">
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_1"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_1">洲际交易所-美国ICE-US-第一通知日-202011-期货-冻橘汁 (OJ)</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_3"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_3">台湾期交所TAIFEX-结算日-202012-期货-布兰特原油期货(BRF)</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_1"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_1">洲际交易所-美国ICE-US-第一通知日-202011-期货-冻橘汁 (OJ)</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_3"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_3">台湾期交所TAIFEX-结算日-202012-期货-布兰特原油期货(BRF)</td>
  </tr>
</table>
</div>
<?php } ?>
<?php if ($de=='_'.'2020_11_6') { ?>
<div class="date_pop_div">
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_2"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_2">芝商所CME-最后交易日-202011-选择权-小SP指选W1</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_2"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_2">芝商所CME-最后交易日-202011-选择权-澳币(AD)</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_2"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_2">芝商所CME-最后交易日-202011-选择权-英镑 (BP)</td>
  </tr>
</table>
</div>
<?php } ?>
<?php if ($de=='_'.'2020_11_9') { ?>
<div class="date_pop_div">
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_2"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_2">洲际交易所-美国ICE-US-最后交易日-202011-期货-冻橘汁 (OJ)</td>
  </tr>
</table>
</div>
<?php } ?>
<?php if ($de=='_'.'2020_11_27') { ?>
<div class="date_pop_div">
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_1"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_1">洲际交易所-英国ICE-UK-第一通知日-202012-期货-英国长债(FLG)</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_2"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_2">新加坡期货交易所SGX-最后交易日-202011-期货-新加坡指数(SSG)</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_2"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_2">新加坡期货交易所SGX-最后交易日-202011-期货-新加坡指数(SSG)</td>
  </tr>
</table>
</div>
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
  

  <div class="date_pop_div">
<table cellspacing="0" cellpadding="0" border="0">
<?php

	
			$sql = "select trading_future.*, trading_future_desc.name as name, trading_future_desc.detail  from ".TB_TRADING_FUTURE." as trading_future , ".TB_TRADING_FUTURE_DESC." as trading_future_desc ";
			$sql .= " where ";
			$sql .= " trading_future.id=trading_future_desc.trading_future_id ";
			$sql .= " and trading_future_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_future.disabled='0' ";

	 $sql .= "  and display_date='$display_date' ";
		 
	 $sql .= "   order by  trading_future.display_date asc  ";
			




	
		$rows4 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){

			while($data4 = $G_DB_CONNECT->fetch_array($rows4)){

					$trading_future_id = $data4['id'];
				
					$trading_future_name =$data4['name'];
					
				
					$trading_future_category_id = $data4['trading_future_category_id'];
				
?>



<tr>
    <td width="10" align="center" valign="middle"><div class="pop_title_clrbox_<?php echo $trading_future_category_id;?>"></div></td>
    <td width="5"></td>
    <td align="left" valign="top" class="pop_title_<?php echo $trading_future_category_id;?>"><?php echo $trading_future_name;?></td>
  </tr>

 <?php

	
			}
		}
	
?>	
	  
    </table>
</div>


<?php } ?>



	  
<?php

	
			}
		}
	
				
?>


















<?php }else{ ?>


<!--
<?php if ($de=='_'.'2020_11_11') { ?>
<div class="date_pop_div">
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="left" valign="top">
        <span class="day_title_h">BMD棕榈油期货休市CME：</span> LC06合约<br>
        <span class="day_title_h">EUREX：</span>GBL、GBM、GBS、FGBX、FOAT、FBTP、FBON、FBTS06合约
    </td>
  </tr>
</table>
</div>
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
  <div class="date_pop_div">
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="left" valign="top">

<?php

	
			$sql = "select trading_hoilday.*, trading_hoilday_desc.name as name, trading_hoilday_desc.detail  from ".TB_TRADING_HOILDAY." as trading_hoilday , ".TB_TRADING_HOILDAY_DESC." as trading_hoilday_desc ";
			$sql .= " where ";
			$sql .= " trading_hoilday.id=trading_hoilday_desc.trading_hoilday_id ";
			$sql .= " and trading_hoilday_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and trading_hoilday.disabled='0' ";

	 $sql .= "  and display_date='$display_date' ";
		 
		 $sql .= "  order by  trading_hoilday.display_date desc ";
			
$k=0;
		$rows4 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){

			while($data4 = $G_DB_CONNECT->fetch_array($rows4)){
        $k++;

					$trading_hoilday_id = $data4['id'];
				
					$trading_hoilday_name =$data4['name'];
					
				if($k > 1){
echo '<br>';
        }
				
?>


<span class="day_title_h"><?php echo $trading_hoilday_name; ?>：</span>

	  <?php

	
			}
		}
	
?>	
	      </td>
  </tr>
</table>
</div>

<?php } ?>



	  
<?php

	
			}
		}
	
				
?>






<?php } ?>




