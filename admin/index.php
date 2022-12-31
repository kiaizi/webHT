<?php 
	//common header
	include_once("config.php"); 
	include_once(DIR_COMMON."global_header.php");
 
	

	if(!$_SESSION['already_login']){
		include("login.php");
 		exit();
	}
	
	/*
	$sql = "select * from ".TB_PRODUCT_COLOR_SIZE_QTY;
	
	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$product_id = $data['product_id'];
				$product_size_id= $data['product_size_id'];
				$price = $data['price'];
				$special_price = $data['special_price'];
				$final_price = $price;
				if($special_price > 0 ){
					$final_price = $special_price ;
				}
				$sql = "update ".TB_PRODUCT_COLOR_SIZE_QTY." set final_price='".$final_price."' where product_id='".$product_id."' and product_size_id='".$product_size_id."' ";
				$G_DB_CONNECT->query($sql);
			}
	}
	
	*/
	
	
	returnAllItemQtyForOnlinePayment();
	//updateClientDefaultPassword();
	//updateOldOrderCode();
	//createOrderFromOldOrderNo();
	//switch to module from sid
	include(DIR_THIS_MODULE."index.php");
	
	
	
	

	
	

?>