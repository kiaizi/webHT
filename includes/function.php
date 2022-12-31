<?php


function jsEscape($str) {
	//https://portswigger.net/web-security/cross-site-scripting/preventing
	//https://shareurcodes.com/blog/easiest%20way%20to%20prevent%20xss%20attacks%20in%20php

//	$str=str_replace("'","&#39;",$str);


	$output = '';
	$str = str_split($str);
	for($i=0;$i<count($str);$i++) {
	 $chrNum = ord($str[$i]);
	 $chr = $str[$i];
	 if($chrNum === 226) {
	   if(isset($str[$i+1]) && ord($str[$i+1]) === 128) {
		 if(isset($str[$i+2]) && ord($str[$i+2]) === 168) {
		   $output .= '\u2028';
		   $i += 2;
		   continue;
		 }
		 if(isset($str[$i+2]) && ord($str[$i+2]) === 169) {
		   $output .= '\u2029';
		   $i += 2;
		   continue;
		 }
	   }
	 }



	 switch($chr) {
	   case "'":
	   case '"':
	   case "\n";
	   case "\r";
	   case "&";
	   case "\\";
	   case "<":
	   case ">":
		 $output .= sprintf("\\u%04x", $chrNum);
	   break;
	   default:
		 $output .= $str[$i];
	   break;
	  }
	}
	return $output;
  }


function xss_clean($data)
{

//https://stackoverflow.com/questions/1996122/how-to-prevent-xss-with-html-php
	//$data = htmlspecialchars($data, ENT_QUOTES,'UTF_8');
	$data = jsEscape($data);

// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);






do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}


function filter($data) {
	global $G_DB_CONNECT;
	if(  !(ADMIN_LANG_ID > 0) ){
	
	$data = xss_clean($data);
	}
if(  !(ADMIN_LANG_ID > 0) ){
$data = clear_text($data);
$data =cleanElements($data);

if(  !(ADMIN_LANG_ID > 0) ){
if(isEnglish($data)){
$data = trim(htmlentities(strip_tags($data)));
}else{
 $data = trim((strip_tags($data)));
}
}


if (get_magic_quotes_gpc()){

$data = stripslashes($data);
}







if(  !(ADMIN_LANG_ID > 0) ){


$data = str_replace("}else", '', $data);
$data = str_replace("if(", '', $data);
$data = str_replace("(", '', $data);
$data = str_replace(")", '', $data);
$data = str_replace("=", '', $data);
$data = str_replace("()", '', $data);
$data = str_replace(";", '', $data);
$data = str_replace("switch", '', $data);
$data = str_replace("password", '', $data);
$data = str_replace("username", '', $data);

$data = mysqli_real_escape_string($G_DB_CONNECT->conn,$data);

$data = str_replace("\\\\u000d\\\\u000a", '
', $data);


$data = str_replace("u0027", "'", $data);
$data = str_replace("\\", "", $data);





}




}

$data= preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $data);
$data= str_replace("alert", "", $data);
$data= str_replace("onerror", "", $data);
$data= str_replace("onchange", "", $data);
$data= str_replace("onmouseover", "", $data);
$data= str_replace("onclick", "", $data);
$data= str_replace("onmouseleave", "", $data);
$data= str_replace("oninput", "", $data);

return $data;

}


function cleanElements($html){

$search = array (
	 "'<script[^>]*?>.*?</script>'si",  //remove js
	  "'<style[^>]*?>.*?</style>'si", //remove css 

  "'<head[^>]*?>.*?</head>'si", //remove head
 "'<link[^>]*?>.*?</link>'si", //remove link
 "'<object[^>]*?>.*?</object>'si"
			  ); 
	$replace = array ( 
		  "",
							   "",
		  "",
		  "",
		  ""
				  );                 
return preg_replace ($search, $replace, $html);
}


function clear_text($s) {
$do = true;
while ($do) {
	$start = stripos($s,'<script');
	$stop = stripos($s,'</script>');
	if ((is_numeric($start))&&(is_numeric($stop))) {
		$s = substr($s,0,$start).substr($s,($stop+strlen('</script>')));
	} else {
		$do = false;
	}
}
return trim($s);
}


function isEnglish($string){
if (!preg_match('/[^A-Za-z0-9]/', $string)) // '/[^a-z\d]/i' should also work.
{
return true;
// string contains only english letters & digits
}
return false;
}


function cart_getBuyPriceDiscount(){
	global $G_DB_CONNECT;
	$product_price = cart_getTotalItemPriceNoDiscount()  ;
	$delivery_price = cart_getDeliveryPrice(shipping_country,'',DELIVERY_METHOD_ID);

	//$total_price = $product_price-cart_getBuyQTYDiscount();
		$total_price = $product_price;
	


	if($total_price >= BUY_MORE_THAN_PRICE && BUY_MORE_THAN_PRICE_DISCOUNT >0){
		
		
		$price=round_to($total_price*(BUY_MORE_THAN_PRICE_DISCOUNT/100));
	}
	
	if($total_price >= BUY_MORE_THAN_PRICE && BUY_MORE_THAN_PRICE2_DISCOUNT_PRICE >0){
		
		
		$price=round_to(BUY_MORE_THAN_PRICE2_DISCOUNT_PRICE);
	}
	
	
	
	return $price;
	
}



function cart_getBuyQTYDiscount(){
	
	/*
	global $G_DB_CONNECT;
	$product_price = cart_getTotalItemPrice();
	$cart_qty = cart_getTotalItem();
	$price = 0;
	

	if($cart_qty >= BUY_QTY){
		
		$price=round_to($product_price*(BUY_QTY_DISCOUNT/100));
	}
	return $price;
	*/
	return 0;
}


function setCookies($name='',$value=''){
	//header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"'); 
	ob_start();
	setcookie("graceful_".$name,$value,COOKIE_EXPIRE_TIME);
	ob_get_clean();
}

function getCookies($name){
	
	return	$_COOKIE['graceful_'.$name];
  
  
  
  
  
}



function clearMemberBonus() { 
	global $G_DB_CONNECT;
	
	$sql = "select id,coin,coin_expiry_date from ".TB_MEMBER." where coin_expiry_date < '".TODAY."' and coin>0 ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$member_id = $data['id'];
			$coin = $data['coin'];
			$expiry_date = $data['coin_expiry_date'];
			
			
	$update_data = array();
	$update_data['member_id'] = $member_id ;
	$update_data['coin'] = $coin ;
	$update_data['coin_expiry_date'] = $expiry_date ;
	
	
	
			$update_data['create_date'] = 'null';
			
		
			 $G_DB_CONNECT->query_insert(TB_MEMBER_TO_COIN, $update_data); 
	
	
		}
	}
	
	
	$sql = "update ".TB_MEMBER." set coin=0 where coin_expiry_date < '".TODAY."'";
	$G_DB_CONNECT->query($sql);
	
	
	
}


function cart_getTotalItemPriceNotCount($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	/*
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
	
	
	
	*/
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	$sql .= " and  freegift_id_list<>'' ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
  $sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id']);
			$price = $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			
			$product_id= $data['product_id'];
			if(!allowCountInFreeGift($product_id)){
				$total_price += $price*$qty;
			}
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	$sql .= " and  freegift_id_list='' ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
  $sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id']);
			$price = $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			
			$product_id= $data['product_id'];
			if(!allowCountInFreeGift($product_id)){
				$total_price += $price*$qty;
			}
			
		}
	}
	
	

	
	
	//$total_price = $total_price;

	return $total_price;
		
} 


function cart_getCoin($coin_to_price_id=''){
	global $G_DB_CONNECT;
	
	$price = 0;

	$local = 0;
	$sql = "select * from ".TB_COIN_TO_PRICE." as coin_to_price ";
	$sql .= " where ";
	$sql .= " id = '".$coin_to_price_id."' ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$price = $price = $data['coin'];
			
		}
	}	
	

	
	return priceWithCurrenyRatio($price);




}



function cart_getCoinPrice($coin_to_price_id=''){
	global $G_DB_CONNECT;
	
	$price = 0;

	$local = 0;
	$sql = "select * from ".TB_COIN_TO_PRICE." as coin_to_price ";
	$sql .= " where ";
	$sql .= " id = '".$coin_to_price_id."' ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$price = $price = $data['price'];
			
		}
	}	
	

	
	return priceWithCurrenyRatio($price);




}







function isLocalCountry($country){
	global $G_DB_CONNECT;
	
	$country_group_id = 0;
	
	$sql = "select country_group_id from ".TB_COUNTRY;
	$sql .= " where ";
	$sql .= " id = '".$country."' ";

	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$country_group_id = $data2['country_group_id'];
		}
	}
	$local = 0;
	
	$sql = "select local from ".TB_COUNTRY_GROUP;
	$sql .= " where ";
	$sql .= " id = '".$country_group_id."' ";

	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$local = $data2['local'];
		}
	}
	
	if($local  == '1'){
		return true;
	}
	
	
	return false;
	
}

function haveFreeGiftDisplay($total_price){
	global $G_DB_CONNECT;
	$have = false;



	//$total_product_price = cart_getTotalItemPrice4b();
	$total_product_price = $total_price;
	$total_product_price =   $_SESSION['final_total'];
	
	
	////////////////////////////////////////////////
	$discount_code = USING_DISCOUNT_CODE;
	////////////////////////////////////////////////////////////////////////////////
	$arr_data = getDiscountCodeInfo($discount_code);
	$return_data['warn_msg'] = $arr_data['warn_msg'];
	$return_data['discount_detail'] = $arr_data['discount_detail'];
	$return_data['discount'] = $arr_data['discount'];
	$return_data['discount_text'] = displayPriceOnly2(-1*$arr_data['discount']);
	$return_data['update_final_discount_price'] = $return_data['discount_text'];
	$return_data['discount_text2'] = $arr_data['discount_text2'];
	
	
	
	$discount = $return_data['discount'] ;

	////////////////////////////////////////////////
	$grand_total = $total_product_price  +$discount;
	$total_freegift_qty = 0;
		////////////////////////////////////////////////
	$sql = "select * from ".TB_CART;
	$sql .= " where ";
	$sql .= " session_id = '".SESSION_ID."'";
	$sql .= " and freegift_id_list<>'' ";

	$rows2 = $G_DB_CONNECT->query($sql);
	$total_freegift_buyover = 0;
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$freegift_list_id = $data2['freegift_id_list'];
			$freegift_qty = $data2['qty'];
			
			$total_freegift_qty+=$freegift_qty ;
			
			
		    $arr_freegift_list_id = explode(",",  $freegift_list_id);
			for ($i=0; $i<count($arr_freegift_list_id); $i++) { 
				
				$freegift_id = $arr_freegift_list_id[$i];
				
				$sql = "select buyover,price from ".TB_FREEGIFT;
				$sql .= " where ";
				$sql .= " id = '".$freegift_list_id."' ";
				//echo "<br>";
				$rows2a = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					
					
					
					
					
					while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
				
						$total_freegift_buyover += ($data2a['buyover']+$data2a['price'])*$freegift_qty;
					}
				}
				 
			}
		}
	}


	
$new_grand_total = $grand_total-$total_freegift_buyover;
	////////////////////////////////////////////////
/*
	echo $grand_total;
	echo "<br>";
	echo $total_freegift_buyover;
	echo "<br>";
	echo $new_grand_total;
	echo "<br>";
*/
	$sql = "select count(*) as total from ".TB_FREEGIFT;
	$sql .= " where ";
	 $sql .= " buyover <= '".$new_grand_total."' ";

							 
  $sql .= " and disabled=0 order by buyover asc,price asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			if($data2['total'] > 0){
				$have = true;
			}
		}
	}
	
	
	

	
	if($total_freegift_qty>=MAX_ALLOW_FREEGIFT_QTY){
		$have = false;
	}
	
	
	
	/*
	echo "test".$total_freegift_qty;
	
	if($total_freegift_qty>=MAX_ALLOW_FREEGIFT_QTY){
		return false;
	}
	
	
	*/
	
	return $have;
}

function getFreeGiftIDList($total_price){
	global $G_DB_CONNECT;
	$id_list = '';
	
	
	

	//	$total_product_price = cart_getTotalItemPrice4b();
	
		$total_product_price =   $_SESSION['final_total'];
	
	////////////////////////////////////////////////
	$discount_code = USING_DISCOUNT_CODE;
	////////////////////////////////////////////////////////////////////////////////
	$arr_data = getDiscountCodeInfo($discount_code);
	$return_data['warn_msg'] = $arr_data['warn_msg'];
	$return_data['discount_detail'] = $arr_data['discount_detail'];
	$return_data['discount'] = $arr_data['discount'];
	$return_data['discount_text'] = displayPriceOnly2(-1*$arr_data['discount']);
	$return_data['update_final_discount_price'] = $return_data['discount_text'];
	$return_data['discount_text2'] = $arr_data['discount_text2'];
	
	
	
	$discount = $return_data['discount'] ;

	////////////////////////////////////////////////
	$grand_total = $total_product_price  +$discount;
	
	
	///////////////////////////////////////////////
	$selected_freegift_id_list = '';
	$sql = "select freegift_id_list from ".TB_CART;
	$sql .= " where session_id='".SESSION_ID."' ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			if($data2['freegift_id_list'] != ''){
				if($selected_freegift_id_list != ''){
					$selected_freegift_id_list .= ",";
				}
				$selected_freegift_id_list .= $data2['freegift_id_list'];
			}
		}
	}
	///////////////////////////////////////////////
	$total_buyover = 0;
	if($selected_freegift_id_list != ''){
		$sql = "select sum(buyover) as total_buyover from ".TB_FREEGIFT;
		$sql .= " where ";
		$sql .= " id in (".$selected_freegift_id_list.") ";
		// $sql .= " and disabled=0 order by id asc ";
		//$sql .= " id in (select freegift_id from ".TB_FEEGIFT_TO_RELATE_PRODUCT." where qty>0) ";
		 $sql .= " and disabled=0  ";
		 $rows2 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
				$total_buyover = $data2['total_buyover'];
			}
		}
		
	}
	
	
	
		////////////////////////////////////////////////
	$sql = "select * from ".TB_CART;
	$sql .= " where ";
	$sql .= " session_id = '".SESSION_ID."'";
	$sql .= " and freegift_id_list<>'' ";

	$rows2 = $G_DB_CONNECT->query($sql);
	$total_freegift_buyover = 0;
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$freegift_list_id = $data2['freegift_id_list'];
			$freegift_qty = $data2['qty'];
		    $arr_freegift_list_id = explode(",",  $freegift_list_id);
			for ($i=0; $i<count($arr_freegift_list_id); $i++) { 
				
				$freegift_id = $arr_freegift_list_id[$i];
				
				$sql = "select buyover,price from ".TB_FREEGIFT;
				$sql .= " where ";
				$sql .= " id = '".$freegift_list_id."' ";
				$rows2a = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
				
						$total_freegift_buyover += ($data2a['buyover'] + $data2a['price'])*$freegift_qty;
					}
				}
				 
			}
		}
	}

	/*
	echo $grand_total;
	echo "<br>";
	echo $total_freegift_buyover;
	echo "<br>";
echo $new_grand_total = $grand_total-$total_freegift_buyover;
echo "<br>";*/
	////////////////////////////////////////////////

	
	$new_grand_total = $grand_total-$total_freegift_buyover;
	
	
	
	
	
	
	
	
	
	$sql = "select id from ".TB_FREEGIFT;
	$sql .= " where ";
	$sql .= " buyover <= '".$new_grand_total."' ";
	// $sql .= " and disabled=0 order by id asc ";
	 $sql .= " and disabled=0 order by buyover asc,price asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			if($id_list != ''){
				$id_list .=',';
			}
			$id_list .=$data2['id'];
		}
	}
	return $id_list;
}


function getFreeGiftIDList2(){
	global $G_DB_CONNECT;
	$id_list = '';
	
	
	

	$total_product_price = cart_getTotalItemPrice4();
	
	
	
	////////////////////////////////////////////////
	$discount_code = USING_DISCOUNT_CODE;
	////////////////////////////////////////////////////////////////////////////////
	$arr_data = getDiscountCodeInfo($discount_code);
	$return_data['warn_msg'] = $arr_data['warn_msg'];
	$return_data['discount_detail'] = $arr_data['discount_detail'];
	$return_data['discount'] = $arr_data['discount'];
	$return_data['discount_text'] = displayPriceOnly2(-1*$arr_data['discount']);
	$return_data['update_final_discount_price'] = $return_data['discount_text'];
	$return_data['discount_text2'] = $arr_data['discount_text2'];
	
	
	
	$discount = $return_data['discount'] ;

	////////////////////////////////////////////////
	$grand_total = $total_product_price  +$discount;
	
	
	///////////////////////////////////////////////
	$selected_freegift_id_list = '';
	$sql = "select freegift_id_list from ".TB_CART;
	$sql .= " where session_id='".SESSION_ID."' ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			if($data2['freegift_id_list'] != ''){
				if($selected_freegift_id_list != ''){
					$selected_freegift_id_list .= ",";
				}
				$selected_freegift_id_list .= $data2['freegift_id_list'];
			}
		}
	}
	///////////////////////////////////////////////
	$total_buyover = 0;
	if($selected_freegift_id_list != ''){
		$sql = "select sum(buyover) as total_buyover from ".TB_FREEGIFT;
		$sql .= " where ";
		$sql .= " id in (".$selected_freegift_id_list.") ";
		// $sql .= " and disabled=0 order by id asc ";
		 $sql .= " and disabled=0  ";
		 $rows2 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
				$total_buyover = $data2['total_buyover'];
			}
		}
	}
	
	
	
	
			
		////////////////////////////////////////////////
	$sql = "select * from ".TB_CART;
	$sql .= " where ";
	$sql .= " session_id = '".SESSION_ID."'";
	$sql .= " and freegift_id_list<>'' ";

	$rows2 = $G_DB_CONNECT->query($sql);
	$total_freegift_buyover = 0;
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$freegift_list_id = $data2['freegift_id_list'];
			$freegift_qty = $data2['qty'];
		    $arr_freegift_list_id = explode(",",  $freegift_list_id);
			for ($i=0; $i<count($arr_freegift_list_id); $i++) { 
				
				$freegift_id = $arr_freegift_list_id[$i];
				
				$sql = "select buyover from ".TB_FREEGIFT;
				$sql .= " where ";
				$sql .= " id = '".$freegift_list_id."' ";
				$rows2a = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
				
						$total_freegift_buyover += $data2a['buyover']*$freegift_qty;
					}
				}
				 
			}
		}
	}

	
	
$new_grand_total = $grand_total-$total_freegift_buyover;
	////////////////////////////////////////////////
	
	
	
	$sql = "select id from ".TB_FREEGIFT;
	$sql .= " where ";
	$sql .= " buyover  <= '".$new_grand_total."' ";
	// $sql .= " and disabled=0 order by id asc ";
	 $sql .= " and disabled=0 order by buyover asc,price asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			if($id_list != ''){
				$id_list .=',';
			}
			$id_list .=$data2['id'];
		}
	}
	return $id_list;
}


function getProductModelNo($product_id,$product_size_id){
	global $G_DB_CONNECT;
	
	$product_code2 = '';
	$sql = " select product_code2 from ".TB_PRODUCT_COLOR_SIZE_QTY;								  
	$sql .= " where product_id = '".$product_id."' and product_size_id = '".$product_size_id."' ";							  
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$product_code2 = $data['product_code2'];
			}
	}
	
	return $product_code2;
	
}




function add_to_cart_from_link($product_id,$product_color_id=0,$product_size_id=0){
		global $G_DB_CONNECT;
		$qty = 1;
		
		
		
if($product_color_id == 0){
		
	$sql = "select product_color_id from ".TB_PRODUCT_PHOTO;
	$sql .= " where  ";
	$sql .= " disabled='0' ";
	$sql .= " and product_id='".$product_id."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$product_color_id = $datap['product_color_id'];
			}
	}


		
		
		
	$sql = "select product_size.*, product_size_desc.name as name ";

	$sql .= " from ".TB_PRODUCT_SIZE." as product_size , ".TB_PRODUCT_SIZE_DESC." as product_size_desc ";
	
	
	$sql .= " where ";
	$sql .= " product_size.id=product_size_desc.product_size_id ";
	$sql .= " and product_size_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_size.disabled='0' ";
	
	$sql .= " and product_size.id in ( ";
	$sql .= " select product_size_id from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where ";
	$sql .= " product_id = '".$product_id."' ";
	$sql .= " and product_color_id = '".$product_color_id."' ";
	$sql .= " ) ";
	
	$sql .= " order by product_size.sort_order asc  limit 0,1";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		 while($data = $G_DB_CONNECT->fetch_array($rows)){
			 
			 $product_size_id = $data['id'];
		 }
	}
		

		
		$total_remain_qty = getAvailableProductQTY($product_id,$product_color_id,$product_size_id);

		
		
		
if( $product_size_id == 0  ||   $total_remain_qty == 0){	


	$sql = "select product_color.*, product_color_desc.name as name ";

	$sql .= " from ".TB_PRODUCT_COLOR." as product_color , ".TB_PRODUCT_COLOR_DESC." as product_color_desc ";
	
	
	$sql .= " where ";
	$sql .= " product_color.id=product_color_desc.product_color_id ";
	$sql .= " and product_color_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_color.disabled='0' ";
	
	$sql .= " and product_color.id in ( ";
	$sql .= " select product_color_id from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where ";
	$sql .= " product_id = '".$product_id."' ";
	$sql .= " ) ";
	
	 $sql .= " order by product_color.sort_order asc limit 0,1 ";
	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		 while($data = $G_DB_CONNECT->fetch_array($rows)){
			 
			 $product_color_id = $data['id'];
		 }
	}





		
		
			
	$sql = "select product_size.*, product_size_desc.name as name ";

	$sql .= " from ".TB_PRODUCT_SIZE." as product_size , ".TB_PRODUCT_SIZE_DESC." as product_size_desc ";
	
	
	$sql .= " where ";
	$sql .= " product_size.id=product_size_desc.product_size_id ";
	$sql .= " and product_size_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_size.disabled='0' ";
	
	$sql .= " and product_size.id in ( ";
	$sql .= " select product_size_id from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where ";
	$sql .= " product_id = '".$product_id."' ";
	$sql .= " and product_color_id = '".$product_color_id."' ";
	$sql .= " ) ";
	
	$sql .= " order by product_size.sort_order asc  limit 0,1";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		 while($data = $G_DB_CONNECT->fetch_array($rows)){
			 
			 $product_size_id = $data['id'];
		 }
	}
	
	
	
	
	
	
	
}
	
	
	
	
		
		
}
		
		
		
		
		
		
	
		
		
		
		
		
		
				$total_remain_qty = getAvailableProductQTY($product_id,$product_color_id,$product_size_id);
					
					
					if($total_remain_qty == 0){
						
					}else if($total_remain_qty >= $qty){
						cart_add_item($qty,$product_id,$product_color_id,$product_size_id);
						
					}else if($total_remain_qty < $qty){
						
						cart_add_item($qty,$product_id,$product_color_id,$product_size_id);
						
					}
		
	
}





function printSortOrderInput($id,$sort_order,$category_id=0){
	$out = '';
	

	
	
	$out .= '<div style="float:left"><input name="sort_order'.$id.'" id="sort_order'.$id.'"  value="'.$sort_order.'"  data_id="'.$id.'" class="numeric input_list_sort_order" maxlength="3" rel="btn_list_sort_order_save'.$id.'"/></div>';
	$out .= '<div style="float:left; margin-left:5px;width:70px"><a href="#" class="button btn_list_sort_order_save" id="btn_list_sort_order_save'.$id.'" data_id="'.$id.'" rel="sort_order'.$id.'" style="display:none;" category_id="'.$category_id.'"><span>'.BTN_SAVE.'</span></a></div>';
	
	return $out;
	
	
}

function generateEnquiryCode(){
	return 10000+nextRecordcode(TB_ENQUIRY,"",'',4);
}


function getCart2SQL($order_type = '1'){
	
	
	if($order_type == '1'){
		$order_by = "  cart.freegift asc,cart.last_update_date desc ";
	}else if($order_type == '2'){
		//$order_by = "   cart.last_update_date desc ";
		$order_by = "   product.sort_order asc ";
	}
	/*
	$sql = "select product_desc.name as product_name,product.seo_url as product_seo_url ,product.price,product.code as product_code,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT." as product,  ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and product_desc.product_id=product.id ";
	$sql .= " and product_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and cart.qty>0 ";
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
	$sql .= " order by $order_by ";
	*/
	$sql = "select product.weight,product_desc.name as product_name,product.seo_url as product_seo_url ,product.price,product.code as product_code,cart.* from ".TB_CART2." as cart,  ".TB_PRODUCT." as product,  ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and product_desc.product_id=product.id ";
	$sql .= " and product_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and cart.qty>0 ";
	//$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
	$sql .= " order by $order_by ";
	
	
	return $sql ; 
	
}


function cart2_getTotalItem() { 
global $G_DB_CONNECT;

	$total_item = 0;
	
	$sql = "select * from ".TB_CART2." as cart  ";
	$sql .= " where session_id='".SESSION_ID."' ";
	$sql .= " and qty>0 ";
	//$sql .= " group by product_id,product_color_id,product_size_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$total_item = $total_item + $qty;
		}
	}
	


	return $total_item;
		
} 



function cart2_add_item($qty,$product_id,$product_color_id=0,$product_size_id=0,$id=0,$gift_cert_msg='',$gift_cert_send_to='',$gift_cert_send_from='') { 
	global $G_DB_CONNECT;
	
	
	if($id > 0){
		$update_data = array();
	
		$update_data['qty'] = $qty;
		$G_DB_CONNECT->query_update(TB_CART2, $update_data, "id='".$id."'  and session_id='".SESSION_ID."' "); 
		return $update_data['qty'];

	}
	
	
	///////////////////////////////////////////////////////////////
	// if add from product detail
	///////////////////////////////////////////////////////////////
	$arr_data_cart = cart2_exist($qty,$product_id,$product_color_id,$product_size_id,$gift_cert_msg,$gift_cert_send_to,$gift_cert_send_from);
	$cart_id = $arr_data_cart['cart_id'];
	$old_qty = $arr_data_cart['qty'];
	if($cart_id == 0){
		$update_data = array();
		$update_data['qty'] = $qty;
		$update_data['product_id'] = $product_id;
		$update_data['product_color_id'] = $product_color_id;
		$update_data['product_size_id'] = $product_size_id;
		$update_data['session_id'] = SESSION_ID;
		$update_data['create_date'] = 'null';
		$update_data['member_id'] = $_SESSION['flogin_mid'];
		
		
	
		
		
		
		$cart_id = $G_DB_CONNECT->query_insert(TB_CART2, $update_data); 
		return $update_data['qty'];
	}else{
		$update_data = array();
		
		$new_qty = $qty+$old_qty;
		
		$update_data['qty'] = $new_qty;
		$update_data['product_id'] = $product_id;
		$update_data['product_color_id'] = $product_color_id;
		$update_data['product_size_id'] = $product_size_id;
		$update_data['member_id'] = $_SESSION['flogin_mid'];
	
		//$update_data['session_id'] = SESSION_ID;
		$G_DB_CONNECT->query_update(TB_CART2, $update_data, "id='".$cart_id."'   and session_id='".SESSION_ID."' "); 
		return $update_data['qty'];
	}
	///////////////////////////////////////////////////////////////
	
	
	
	
}


function cart2_exist($qty,$product_id,$product_color_id=0,$product_size_id=0,$gift_cert_msg='',$gift_cert_send_to='',$gift_cert_send_from='') { 
	global $G_DB_CONNECT;

	$arr_data = array();
	$arr_data['cart_id'] = 0;
	$arr_data['qty'] = 0;
	
	
	$sql = "select id,qty from ".TB_CART2." as cart  ";
	$sql .= " where product_id='".$product_id."' ";
	$sql .= " and session_id='".SESSION_ID."' ";
	
	$sql .= " and product_id in ( ";
	$sql .= " select id from ".TB_PRODUCT;	
	$sql .= " where disabled='0' ";	
	$sql .= " ) ";
	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$arr_data['cart_id'] = $data['id'];
			$arr_data['qty'] = $data['qty'];
		}
	}
	
			
	return $arr_data;
		
} 

function cart_add_item2($qty,$product_id,$product_color_id=0,$product_size_id=0,$id=0,$gift_cert_msg='',$gift_cert_send_to='',$gift_cert_send_from='',$freegift='',$free_price='') { 
	global $G_DB_CONNECT;
	
	
	///////////////////////////////////////////////////////////////
	// from cart page to update qty directly with new qty
	///////////////////////////////////////////////////////////////
	if($id > 0){
		$update_data = array();
		
		$update_data['qty'] = $qty;
		$G_DB_CONNECT->query_update(TB_CART2, $update_data, "id='".$id."'  and session_id='".SESSION_ID."' "); 
		return $update_data['qty'];

	}
	
	
	///////////////////////////////////////////////////////////////
	// if add from product detail
	///////////////////////////////////////////////////////////////
	$arr_data_cart = cart2_exist($qty,$product_id,$product_color_id,$product_size_id,$gift_cert_msg,$gift_cert_send_to,$gift_cert_send_from,$freegift,$free_price);
	$cart_id = $arr_data_cart['cart_id'];
	$old_qty = $arr_data_cart['qty'];
	if($cart_id == 0){
		$update_data = array();
		$update_data['qty'] = $qty;
		$update_data['product_id'] = $product_id;
		$update_data['product_color_id'] = $product_color_id;
		$update_data['product_size_id'] = $product_size_id;
		$update_data['session_id'] = SESSION_ID;
		$update_data['create_date'] = 'null';
		$update_data['member_id'] = $_SESSION['flogin_mid'];
		
	$update_data['freegift'] = $freegift;
	$update_data['free_price'] = $free_price;
	
		
		
		
		$cart_id = $G_DB_CONNECT->query_insert(TB_CART2, $update_data); 
		return $update_data['qty'];
	}else{
		$update_data = array();
		
		$new_qty = $qty+$old_qty;
		
		$update_data['qty'] = $new_qty ;
		$update_data['product_id'] = $product_id;
		$update_data['product_color_id'] = $product_color_id;
		$update_data['product_size_id'] = $product_size_id;
		$update_data['member_id'] = $_SESSION['flogin_mid'];
		
	$update_data['freegift'] = $freegift;
	$update_data['free_price'] = $free_price;
		
		//$update_data['session_id'] = SESSION_ID;
		$G_DB_CONNECT->query_update(TB_CART2, $update_data, "id='".$cart_id."'   and session_id='".SESSION_ID."' "); 
		return $update_data['qty'];
	}
	///////////////////////////////////////////////////////////////
	
	
	
	
}
function cart2_delete_item($id) { 
	global $G_DB_CONNECT;
	
	$G_DB_CONNECT->query("delete from ".TB_CART2." where id='".$id."'   and session_id='".SESSION_ID."' ");
	
}
function cart2_clear_all() { 
	global $G_DB_CONNECT;
	
	$G_DB_CONNECT->query("delete from ".TB_CART2." where  session_id='".SESSION_ID."' ");
	
	
	
	
}


function cart_haveFromEquoteItem() { 
	global $G_DB_CONNECT;

	$from_equote = 0;
	
	
	$sql = "select from_equote from ".TB_CART." as cart  ";
	$sql .= " where session_id='".SESSION_ID."' ";
	$sql .= " and qty>0 ";
	//$sql .= " and from_equote = '1' limit 0,1 ";
	//$sql .= " group by product_id,product_color_id,product_size_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		$from_equote = 1;
	}
	


	return $from_equote;
		
} 


function formatForFacebookDesc($facebook_description){
	
	$facebook_description = strip_tags($facebook_description);
	$facebook_description = str_replace("  ","",$facebook_description);
	$facebook_description = str_replace("\r\n","",$facebook_description);
	$facebook_description = str_replace("\n","",$facebook_description);
	
	$facebook_description = draftText2(30,$facebook_description);
	
	return $facebook_description;
}

function highlightSearchedText($search,$content){
	$content = str_ireplace($search,'<span class="search_highlight">'.$search.'</span>',$content);
	
	//$content = str_replace(strtoupper($search),'<span class="search_highlight">'.$search.'</span>',$content);
	//$content = str_replace(strtolower($search),'<span class="search_highlight">'.$search.'</span>',$content);
	return $content;
}
function draftSearchedDetail($search,$content){
	
	if(trim($content) == ''){
		return '';
	}else{
		
		return highlightSearchedText($search,DraftText2(50,removeHTMLTag($content)));
	}
	
	
}


function haveThisFlagInFlagTable($status_id = '0'){
	
	if($status_id > 0 ){
		return '1';
	}
	return '0';
	
}


function updateProductStatus($table,$id,$in_flag){
	global $G_DB_CONNECT;

		/////////////////////////////////////////////
		// new_product
		/////////////////////////////////////////////
if($in_flag == 1){
		$sql = "select * from ".$table;
		$sql .= " where product_id='".ID."' ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows == 0){
			$sort_order = 1;
			$sql = "select sort_order as last_sort_order from ".$table." order by sort_order desc limit 0,1  ";
			$rows2 = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$sort_order = $data2['last_sort_order'] + 1;
				}
			}
			
			
			$update_product_to_new_product_data = array();
			$update_product_to_new_product_data['product_id'] = $id;
			$update_product_to_new_product_data['sort_order'] = $sort_order;
	
			$G_DB_CONNECT->query_insert($table, $update_product_to_new_product_data);
		}
}else{
	$sql = "delete from ".$table;
	$sql .= " where product_id='".$id."' ";
	$G_DB_CONNECT->query($sql);
}
		
		/////////////////////////////////////////////

}


function updateFieldDataFromProductStatusTable($t1,$field_name,$selected_id,$disabled,$condition = ''){
		
		global $G_DB_CONNECT;
		if($condition != ''){
			$condition = " and ".$condition;
		}
		if($selected_id != ''){
			for ($i=0; $i<count($selected_id); $i++) {
         		
				$id = $selected_id[$i];
				$disabled = $disabled;
				$data[$field_name] = $disabled;
				
				//$G_DB_CONNECT->query_update($t1, $data, "   id='$id'   ".$condition ); 
				
				updateProductStatus($t1,$id,$disabled);
				
				
			}
		}
	
		
}



function changeToHTMLRelativeFilePath($content){


	

	$dirname = REWRITE_BASE;
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	
	

	
	$from = array('src="/');
	$to   = 'src="../../../../';
	$content = str_replace($from, $to, $content);
	
	$from = array('href="/');
	$to   = 'href="../../../../';
	$content = str_replace($from, $to, $content);
	
	$from = array('src="images/');
	$to   = 'src="../../../../images/';
	$content = str_replace($from, $to, $content);
	
	$from = array('src="../images/');
	$to   = 'src="../../../../images/';
	$content = str_replace($from, $to, $content);
	
	$from = array('src="userfiles/');
	$to   = 'src="../../../../userfiles/';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('src="upload/');
	$to   = 'src="../../../../upload/';
	$content = str_replace($from, $to, $content);
	
	$from = array('src="../upload/');
	$to   = 'src="../../../../upload/';
	$content = str_replace($from, $to, $content);
	
	$from = '<div class="sidebar-line">&nbsp;</div>';
	$to   = '<div class="sidebar-line"><span></span></div>';
	$content = str_replace($from, $to, $content);
	
	
	
	

	
	
	
	return $content;
}



function changeToHTMLRelativeFilePath2($content){



	$dirname = REWRITE_BASE;
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	
	


$from = '/youfind/chineseessencehc/';
	$to   = '../../../../';
	$content = str_replace($from, $to, $content);
	
	$from = '"upload/';
	$to   = '"../../../../upload/';
	$content = str_replace($from, $to, $content);

		$from = '"/upload/';
	$to   = '"../../../../upload/';
	$content = str_replace($from, $to, $content);

	
	
	return $content;
}


function removeHTMLTag($content){
	
	//$content = str_replace("</p><p>","\n",$content);
	
	
	
	return strip_tags($content);
}


function format2SimpleHTML($content){
	
	$content = removeHTMLTag($content);
	

	/*
	$from = array("\r\n","\r","\n");
	$to   = '</p><p>';
	$content = str_replace($from, $to, $content);
	
	$from = array("<p></p>");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	$content = "<p>".$content.'</p>';
	*/
	
	return $content;
}


/*
function formatToSEOURL($content){
	$content = trim(strtolower(($content)));
	
	$from = array("  ");
	$to   = ' ';
	$content = str_replace($from, $to, $content);
	
	
	
	$from = array(" ");
	$to   = '_';
	$content = str_replace($from, $to, $content);
	
	$from = array(",","'","\"","\'","?","!","@","%","#","&","(",")",")"," ",".","/","\\");
	$to   = '';
	$content = str_replace($from, $to, $content);
	return $content;
	
}
*/

function replaceSpecialCharacter($content){
	
//"È,É,Ê,Ë,Û,Ù,Ï,Î,À,Â,Ô,è,é,ê,ë,û,ù,ï,î,à,â,ô";
	
	
	$from = array('À','A','Â','Ä','à','â','ä');
	$to   = 'A';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('É','E','È','Ê','Ë','è','é','ê','ë');
	$to   = 'E';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('Ï','I','Î','ï','î');
	$to   = 'I';
	$content = str_replace($from, $to, $content);
	
	$from = array('Ô','O','Ö','ô','ö');
	$to   = 'O';
	$content = str_replace($from, $to, $content);
	
	$from = array('Ü','U','Ù','û','ù');
	$to   = 'U';
	$content = str_replace($from, $to, $content);
	
	return $content;
	
	
}
function clean_url($text)
{

$text = replaceSpecialCharacter($text);



$text=strtolower($text);
$code_entities_match = array( '&quot;' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,'' ,';' ,"'" ,',' ,'.' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,' ' ,'---' ,'--','--');
$code_entities_replace = array('' ,'-' ,'-' ,'' ,'' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'-' ,'-' ,'-','-');
$text = str_replace($code_entities_match, $code_entities_replace, $text);


	if($text[0] == '-'){
		$text = substr($text,1);
	}
	
	$text = str_replace("-39s","s",$text);

return $text;
}



function formatToSEOURL($title){
	/*
	$content = trim(strtolower(($content)));
	
	$from = array("  ");
	$to   = ' ';
	$content = str_replace($from, $to, $content);
	
	
	
	$from = array(" ");
	$to   = '-';
	$content = str_replace($from, $to, $content);
	
	$from = array(",","'","\"","\'","?","!","@","%","#","&","(",")",")"," ",".","/","\\");
	$to   = '';
	$content = str_replace($from, $to, $content);
	return $content;
	*/
	
	//$newtitle=string_limit_words($title, 6); // First 6 words
	/*
	$from = array(",","'","\"","\'","?","!","@","%","#","&","(",")",")"," ",".","/","\\");
	$to   = '';
	$title = str_replace($from, $to, $title);
	
	
	$title=mysqli_real_escape_string($G_DB_CONNECT->conn,$title);
	$title=htmlentities($title);
	
	
	$newtitle=$title; // First 6 words
	$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
	return $newurltitle=str_replace(" ","-",$newtitle);
	*/
	
	return clean_url($title);
	
	
	
	
	
}






function getLastSessionIDFromCart($member_id){
	global $G_DB_CONNECT;
	$session_id = 0;

	$sql = "select * from ".TB_CART." as cart ";
	$sql .= " where ";
	$sql .= " member_id='".$member_id."' and member_id > 0 ";
	$sql .= " order by create_date desc limit 0,1";



	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$session_id = $data['session_id'];
			
		}
	}
	
	return $session_id;
}



function generatePaymentCode(){
	//return nextRecordcode(TB_PAYMENT,"",date('Ymd'),4);
	//return nextRecordcode(TB_PAYMENT,"",date('Ymd'),4);
	return nextRecordcode(TB_PAYMENT,"","3000",3);
}


function printCheckBox($id,$value,$selected_value,$label='',$required=false,$other=''){
	$out = "";



	
	if($required){
		$required = ' required="yes" ';
	}else{
	}
	
	$checked = "";
	if($value == $selected_value){
		$checked = "checked";
	}

	
	
	$out = "<input name=\"".$id."\" id=\"".$id."\"  value=\"".$value."\"   label=\"".$label."\"  $other $required $checked  type=\"checkbox\" style=\"margin:0;padding:0;\"/>";
	return $out;
}

function getProductColorSQL($product_id,$other_condition = ""){
	
	if($other_condition != ''){
		$other_condition = " and ".$other_condition;
	}
	
	
	
	/*
	$sql = "select sum(product_color_size_qty.qty) as total_qty ,product_color.id as product_color_id,product_color.code as product_color,product_color_desc.name as product_color_name,product_size.id as product_size_id,product_size_desc.name as product_size from ".TB_PRODUCT_COLOR_SIZE_QTY." as product_color_size_qty, ".TB_PRODUCT_COLOR." as product_color, ".TB_PRODUCT_COLOR_DESC." as product_color_desc, ".TB_PRODUCT_SIZE." as product_size, ".TB_PRODUCT_SIZE_DESC." as product_size_desc ";
	$sql .= " where product_color_size_qty.product_id='".$product_id."' ";
	$sql .= " and product_color.id = product_color_desc.product_color_id ";
	$sql .= " and product_color_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_size.id = product_size_desc.product_size_id ";
	$sql .= " and product_size_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_color_size_qty.product_color_id = product_color.id ";
	$sql .= " and product_color_size_qty.product_size_id = product_size.id ";
	//$sql .= " and product_color_size_qty.qty>0 ";
	$sql .= " group by product_color_id ";
	$sql .= " order by product_color.sort_order asc ";
	*/
	$sql = "select sum(product_color_size_qty.qty) as total_qty ,product_color.id as product_color_id,product_color.code as product_color,product_color_desc.name as product_color_name,product_size.id as product_size_id,product_size_desc.name as product_size from ".TB_PRODUCT_COLOR_SIZE_QTY." as product_color_size_qty, ".TB_PRODUCT_COLOR." as product_color, ".TB_PRODUCT_COLOR_DESC." as product_color_desc, ".TB_PRODUCT_SIZE." as product_size, ".TB_PRODUCT_SIZE_DESC." as product_size_desc , ".TB_PRODUCT_PHOTO." as product_photo ";
	$sql .= " where product_color_size_qty.product_id='".$product_id."' ";
	$sql .= " and product_color.id = product_color_desc.product_color_id ";
	$sql .= " and product_color_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_size.id = product_size_desc.product_size_id ";
	$sql .= " and product_size_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_color_size_qty.product_color_id = product_color.id ";
	$sql .= " and product_color_size_qty.product_size_id = product_size.id ";
	//$sql .= " and product_color_size_qty.qty>0 ";
	$sql .= " and product_photo.product_id = product_color_size_qty.product_id ";
	$sql .= " and  product_color.id = product_photo.product_color_id   ";
	
	
	$sql .= $other_condition;
	
	$sql .= " group by product_color_id ";
	$sql .= " order by product_photo.sort_order asc ";
	
	
	
	
	
	
	return $sql;
}

function getProductSizeSQL($product_id){
	$sql = "select sum(product_color_size_qty.qty) as total_qty ,product_color.id as product_color_id,product_color.code as product_color,product_color_desc.name as product_color_name,product_size.id as product_size_id,product_size_desc.name as product_size from ".TB_PRODUCT_COLOR_SIZE_QTY." as product_color_size_qty, ".TB_PRODUCT_COLOR." as product_color, ".TB_PRODUCT_COLOR_DESC." as product_color_desc, ".TB_PRODUCT_SIZE." as product_size, ".TB_PRODUCT_SIZE_DESC." as product_size_desc ";
	$sql .= " where product_color_size_qty.product_id='".$product_id."' ";
	$sql .= " and product_color.id = product_color_desc.product_color_id ";
	$sql .= " and product_color_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_size.id = product_size_desc.product_size_id ";
	$sql .= " and product_size_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_color_size_qty.product_color_id = product_color.id ";
	$sql .= " and product_color_size_qty.product_size_id = product_size.id ";
	//$sql .= " and product_color_size_qty.qty>0 ";
	$sql .= " group by product_size_id ";
	$sql .= " order by product_size.sort_order asc ";
	
	return $sql;
}


function printStatusFromCondition($condition,$print){
	if($condition){ 
		echo $print;
	}
}

function printBlogComment($blog_msg_id){
	global $G_DB_CONNECT;
	$out = "";

	$sql = "select blog_msg.* from ".TB_BLOG_MSG." as blog_msg ";
	$sql .= " where ";
	$sql .= " id='".$blog_msg_id."' and disabled='0' ";
	$sql .= " order by create_date asc";


	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$k++;
			
 			$name = $data['name'];
 			$email  = $data['email'];
 			$website  = $data['website'];
 			$msg  = displayHTML(nl2br($data['msg']));
 			$create_date  =  $data['create_date'];
////////////////////////////////////////////////////////
$out .='<div class="comment_vspace"></div>';

$out .='<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_blog_comment">';
$out .='<tr>';
$out .='<td class="title">';
$out .= $name.' <span class="date">'.formatDate4($create_date).' | '.getDateTime($create_date);

	if($website != ''){
		//formatWebsite($website);

   

	}

$out .='</span>';
    
$out .='</td>';
$out .='</tr>';
$out .='<tr>';
$out .='<td class="content">';
$out .= $msg;
$out .='</td>';
$out .='</tr>';
$out .='</table>';
////////////////////////////////////////////////////////			
			
		}
	}
 
 
 return $out;
	
	
	

}



function formatWebsite($website){
	if($website == ""){
		return ;
	}else{
		$this_value = $website;
		if(strstr($this_value, "www.") != ''){ 
			$this_value = str_replace("www.","http://www.",$this_value);
			$this_value = str_replace("http://http://","http://",$this_value);
			$this_value = '<a href="'.$this_value.'"  target="_blank">'.$this_value.'</a>';
			return $this_value;
		
		}
	}
}


function getBlogCommentNum($blog_id){
	global $G_DB_CONNECT;
	$sql = "select blog_msg.* from ".TB_BLOG_MSG." as blog_msg ";
	$sql .= " where ";
	$sql .= " blog_id = '".$blog_id."' ";


	$rows = $G_DB_CONNECT->query($sql);
	return $G_DB_CONNECT->affected_rows ;
}



function formatDateMonth($inDate){
	//$Monthnames = array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
	//$Monthnames = array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'); = array('January','Feburary','March','April','May','June','July','August','September','October','November',	'December');
	$Monthnames= array('1','2','3','4','5','6','7','8','9','10','11','12');
	$newMonthnames = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	
	//$newMonthnames = array('January','Feburary','March','April','May','June','July','August','September','October','November',	'December');
	
	
	

	$temp = substr($inDate,5,2)+0;
	
	
	for ( $i = 0; $i < count($Monthnames); $i++) {
		
		//echo "<br>";
		//echo $Monthnames[$i];
		if($temp == $Monthnames[$i]){
			return $temp = strtoupper($newMonthnames[$i]);
			
		}
	}
	

	


}


function formatDateMonth3($inDate){
	//$Monthnames = array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
	//$Monthnames = array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'); = array('January','Feburary','March','April','May','June','July','August','September','October','November',	'December');
	$Monthnames= array('1','2','3','4','5','6','7','8','9','10','11','12');
	$newMonthnames = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	
	//$newMonthnames = array('January','Feburary','March','April','May','June','July','August','September','October','November',	'December');
	
	
	

	$temp = $inDate;
	
	
	for ( $i = 0; $i < count($Monthnames); $i++) {
		
		//echo "<br>";
		//echo $Monthnames[$i];
		if($temp == $Monthnames[$i]){
			return $temp = strtoupper($newMonthnames[$i]);
			
		}
	}
	

	


}


function formatJSDate($date){
	$day = substr($date,8,2) + 0;
	if($day < 10){
		$day = "0".$day;
	}
	
	$month = substr($date,5,2) + 0;
	//$date = $day." ".$month." ".substr($date,0,4);
	
	
		$month = formatDateMonth($date);
		$date = $day." ".$month." ".substr($date,0,4);
	
	
	return $date;
}



function getDateTime($date){
	$time = substr($date,11,5);
	
	
	return $time;
}

function formatDateOther($date){
	$day = substr($date,8,2) + 0;
	$month = substr($date,5,2) + 0;
	$year = substr($date,0,4) + 0;
	//$month = substr($date,5,2) + 0;
	//$date = $day." ".$month." ".substr($date,0,4);
	/*
	if(CURRENT_LANG == '2'){
		$date = substr($date,0,4)."年".$month."月".$day."日";
	}else {
		$month = formatDateMonth($date);
		$date = $day."  ".$month."  ".substr($date,0,4);
	}
	*/
	
	$date = $year."_".$month."_".$day;
	
	return $date;
}
function formatDate($date){
	$day = substr($date,8,2) + 0;
	if($day < 10){
		$day = "0".$day;
	}
	
	//$month = substr($date,5,2) + 0;
	//$date = $day." ".$month." ".substr($date,0,4);
	/*
	if(CURRENT_LANG == '2'){
		$date = substr($date,0,4)."年".$month."月".$day."日";
	}else {
		$month = formatDateMonth($date);
		$date = $day."  ".$month."  ".substr($date,0,4);
	}
	*/
	
	$date = str_replace('-','.',$date);
	
	return $date;
}

function formatDate2($date){
	$day = substr($date,8,2) + 0;
	if($day < 10){
		$day = "0".$day;
	}
	
	//$month = substr($date,5,2) + 0;
	//$date = $day." ".$month." ".substr($date,0,4);
	/*
	if(CURRENT_LANG == '2'){
		$date = substr($date,0,4)."年".$month."月".$day."日";
	}else {
		$month = formatDateMonth($date);
		$date = $day."  ".$month."  ".substr($date,0,4);
	}
	*/
	
	$date = str_replace('-',' ',$date);
	
	return $date;
}


function getWeekDay($in_date) {
	
	
	
// Assuming $date is in format DD-MM-YYYY


$date = substr($in_date,8,2)."-".substr($in_date,5,2)."-".substr($in_date,0,4);

list($day, $month, $year) = explode("-", $date);

// Get the weekday of the given date
$wkday = date('l',mktime('0','0','0', $month, $day, $year));

switch($wkday) {
case 'Monday': $numDaysToMon = 0; break;
case 'Tuesday': $numDaysToMon = 1; break;
case 'Wednesday': $numDaysToMon = 2; break;
case 'Thursday': $numDaysToMon = 3; break;
case 'Friday': $numDaysToMon = 4; break;
case 'Saturday': $numDaysToMon = 5; break;
case 'Sunday': $numDaysToMon = 6; break;
}



return formatWeekDay($numDaysToMon,2 );

}


function formatWeekDay($index,$type=1){
	
	
	$arr_data = array('Mon','Tues','Wed','Thurs','Fri','Sat','Sun');
	if($type == '2'){
		if(CURRENT_LANG == '2'){
				$arr_data = array('星期一','星期二','星期三','星期四','星期五','星期六','星期日');
		}else{
			$arr_data = array('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY');
		}
	}
	
	
	
	
	
	return $arr_data[$index];
	

	


}

/*

function formatDate2($date){
	$day = substr($date,8,2) + 0;
	if($day < 10){
		$day = "0".$day;
	}
	$month = formatDateMonth($date);
	$date = getDayNameOfThisWeek($date)." ".$day." ".$month." ".substr($date,0,4);
	
	return $date;
}
*/
function formatDate3($date){
	$day = substr($date,8,2) + 0;
	if($day < 10){
		$day = "0".$day;
	}
	$month = formatDateMonth($date);
	$date = $month." ".substr($date,0,4);
	
	return $date;
}

function formatDate4($date){
	$day = substr($date,8,2) + 0;
	if($day < 10){
		$day = "0".$day;
	}
	$month = substr($date,8,2);
	$date = $day.".".$month.".".substr($date,0,4);
	
	return $date;
}


function getMemberName($member_id){
	global $G_DB_CONNECT;
	$sql = "select * from ".TB_MEMBER." as m ";
	$sql .= " where m.id='".$member_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		
		$k = 0;
		while($data = $G_DB_CONNECT->fetch_array($rows)){
		
			$surname_en = $data['surname_en'];
			$givenname_en = $data['givenname_en'];
			///////////////////////////////////////////////////
			return $surname_en." ".$givenname_en;
			///////////////////////////////////////////////////
			
			
		}
	}
}
function getMemberName2($member_id){
	global $G_DB_CONNECT;
	$sql = "select * from ".TB_MEMBER." as m ";
	$sql .= " where m.id='".$member_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		
		$k = 0;
		while($data = $G_DB_CONNECT->fetch_array($rows)){
		
			$surname_en = $data['surname_en'];
			$givenname_en = $data['givenname_en'];
			///////////////////////////////////////////////////
			return $surname_en." ".$givenname_en."<br>".$data['username'];
			///////////////////////////////////////////////////
			
			
		}
	}
}


function getPaymentSQL($payment_id=0,$member_id = 0,$search_condition=''){
	if($search_condition !='' ){
		$search_condition = " and ".$search_condition;
	}
	
	$sql = "select * from ".TB_PAYMENT." as payment ";
	$sql .= " where id>0 ";

	if($payment_id > 0){
		$sql .= " and payment.id='".$payment_id."' ";
	}



	if($member_id > 0){
		$sql .= " and payment.member_id='".$member_id."' ";
	}
	
	$sql .= $search_condition;


	
	return $sql ; 
	
}


function getPaymentItemSQL($payment_id){
	
	$sql = "select * from ".TB_PAYMENT_ITEM." as payment_item ";
	$sql .= " where payment_id='".$payment_id."' ";
	
	return $sql ; 
	
}



function returnAllItemQty($payment_id){
	global $G_DB_CONNECT;

	$returned_qty = getDataName(TB_PAYMENT,'returned_qty',$payment_id);
	$sql = getPaymentItemSQL($payment_id);
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
	
		$k = 0;
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			if($returned_qty == 0){
		
				$qty = $data['qty'];
				$product_id = $data['product_id'];
				$product_color_id = $data['product_color_id'];
				$product_size_id = $data['product_size_id'];
				///////////////////////////////////////////////////
				$G_DB_CONNECT->query("update ".TB_PRODUCT_COLOR_SIZE_QTY." set qty=qty+".$qty." where product_id='".$product_id."' and  product_color_id='".$product_color_id."' and product_size_id='".$product_size_id."'  ");
				///////////////////////////////////////////////////
				
				//////////////////////////////////////////////////////////////
				$G_DB_CONNECT->query("update ".TB_PAYMENT." set returned_qty='1' where id='".$payment_id."'");
				//////////////////////////////////////////////////////////////
				
				//////////////////////////////////////////////////////////////
				$G_DB_CONNECT->query("update ".TB_PRODUCT." set count_view=count_view-'".$qty."' where id='".$product_id."'");
				$G_DB_CONNECT->query("update ".TB_PRODUCT." set count_view=0 where count_view<0");
				//////////////////////////////////////////////////////////////
				
				
			}
			
			
			
			
		}
		
	}
	
}



function reduceAllItemQty($payment_id){
	global $G_DB_CONNECT;

	$returned_qty = getDataName(TB_PAYMENT,'returned_qty',$payment_id);
	$sql = "select * from ".TB_PAYMENT_ITEM." as payment_item ";
	$sql .= " where payment_id = '".$payment_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			if($returned_qty == 1){
		
				$qty = $data['qty'];
				$product_id = $data['product_id'];
				$product_color_id = $data['product_color_id'];
				$product_size_id = $data['product_size_id'];
				///////////////////////////////////////////////////
				$G_DB_CONNECT->query("update ".TB_PRODUCT_COLOR_SIZE_QTY." set qty=qty-".$qty." where product_id='".$product_id."' and  product_color_id='".$product_color_id."' and product_size_id='".$product_size_id."'  ");
				///////////////////////////////////////////////////
				$G_DB_CONNECT->query("update ".TB_PAYMENT." set returned_qty='0' where id='".$payment_id."'");
					//////////////////////////////////////////////////////////////
				$G_DB_CONNECT->query("update ".TB_PRODUCT." set count_view=count_view+'".$qty."' where id='".$product_id."' and count_view>0  ");
				$G_DB_CONNECT->query("update ".TB_PRODUCT." set count_view=0 where count_view<0");
				//////////////////////////////////////////////////////////////
				
			}
		
		}
		
	}
	
}


function floor_dec($number,$precision,$separator)
{
    $numberpart=explode($separator,$number);
    $numberpart[1]=substr_replace($numberpart[1],$separator,$precision,0);
    if($numberpart[0]>=0)
    {$numberpart[1]=floor($numberpart[1]);}
    else
    {$numberpart[1]=ceil($numberpart[1]);}

     $ceil_number= array($numberpart[0],$numberpart[1]);
    return implode($separator,$ceil_number);
}
function round_to($number, $increments) {
	/*
	$pos = strrpos($number, ".");
	
	if($pos > 0){
		$dec_num = "0.".substr($number,$pos+1);
		$dec_num += 0;
		$real_num = substr($number,0,$pos);
	}else{
		$real_num = $number;
	}
	
	
	$real_num += 0;


if($dec_num > 0){
	
	if($dec_num > $increments){
		$dec_num = '';
		$real_num ++;
	}else{
		$dec_num = $increments;
		$real_num = $real_num+$dec_num;
	}
}

*/

	//$real_num = floor_dec($number,2,".");
	//return $number;
	$real_num = round($number,2);
	
	
	return $real_num;
	
}



function round_to_min($number, $increments) {
	
	/*
	$pos = strrpos($number, ".");
	
	if($pos > 0){
		$dec_num = "0.".substr($number,$pos+1);
		$dec_num += 0;
		$real_num = substr($number,0,$pos);
	}else{
		$real_num = $number;
	}
	
	
	$real_num += 0;


if($dec_num > 0){
	
	if($dec_num > $increments){
		
		$dec_num = $increments;
		$real_num = $real_num+$dec_num;
		
		
	}else{
		
	}
}
	*/
	
	$real_num = round($number,2);
	
	return $real_num;
	
}




function priceWithCurrenyRatio($price){
	 $ratio_price =  CURRENCY_RATIO*$price;
	//return round($ratio_price);
	
	return  round_to($ratio_price,0.5);
}


function priceWithCurrenyRatioFromScore($price){
	 $ratio_price =  CURRENCY_RATIO*$price;
	
	
	return  round_to_min($ratio_price,0.5);
}



function formatPrice($number){
	$number = $number + 0;
	if($number < 0){
		$number = 0;
	}
	
	/*
	if (is_float($number)) {
		$number = number_format($number, 2);
	}else{
		$number = number_format ($number, 2);
	}
	*/
	
	
	//$number = money_format('%i', $number);
	//$number = number_format ($number, 2);
	$number = number_format ($number, 0);
	return $number;
}

function displayPriceSign($price){
	//return CURRENCY_NAME." ".CURRENCY_SIGN."".formatPrice(priceWithCurrenyRatio($price));
	return '$'.formatPrice(priceWithCurrenyRatio($price));
}

function displayPrice($price){
	return CURRENCY_SIGN."".formatPrice(priceWithCurrenyRatio($price));
}


function displayPrice2($price){
	//return CURRENCY_NAME." ".CURRENCY_SIGN."".formatPrice(priceWithCurrenyRatio($price));
	return CURRENCY_NAME."".formatPrice(priceWithCurrenyRatio($price));
}


function displayPriceOnly($price){
	return CURRENCY_SIGN."".formatPrice($price);
}


function displayPriceOnly2($price){
	//return CURRENCY_NAME." ".CURRENCY_SIGN."".formatPrice($price);
	return CURRENCY_NAME."".formatPrice($price);
}


function displayOrderPriceOnly2($price,$currency_name,$currency_sign){
	//return $currency_name." ".$currency_sign."".formatPrice($price);
	return $currency_name."".formatPrice($price);
}
function displayOrderPriceOnly3($price,$currency_name,$currency_sign,$currency_ratio){
	//return $currency_name." ".$currency_sign."".formatPrice($price);
	
	 $ratio_price =  $price;
	//return round($ratio_price);
	
	// $price =   round_to($ratio_price,0.5);
	
	return $currency_name."".formatPrice($price);
}

function getDeliveryMethodSQL($search_condition=''){
	if($search_condition !='' ){
		$search_condition = " and ".$search_condition;
	}
	

	$sql = "select delivery_method.*,delivery_method_desc.name as name,delivery_method_desc.detail as detail from ".TB_DELIVERY_METHOD." as delivery_method, ".TB_DELIVERY_METHOD_DESC." as delivery_method_desc ";
	$sql .= " where ";
	$sql .= " delivery_method.id = delivery_method_desc.delivery_method_id ";
	$sql .= " and delivery_method_desc.language_id = '".CURRENT_LANG."'";
	$sql .= $search_condition;
	$sql .= " group by delivery_method.id  ";
	
	return $sql ; 
	
}






function getPaymentMethodSQL($search_condition=" disabled='0' "){
	if($search_condition !='' ){
		$search_condition = " and ".$search_condition;
	}
	

	$sql = "select payment_method.*,payment_method_desc.name as name,payment_method_desc.detail as detail from ".TB_PAYMENT_METHOD." as payment_method, ".TB_PAYMENT_METHOD_DESC." as payment_method_desc ";
	$sql .= " where ";
	$sql .= " payment_method.id = payment_method_desc.payment_method_id ";
	$sql .= " and payment_method_desc.language_id = '".CURRENT_LANG."'";
	$sql .= $search_condition;
	$sql .= " group by payment_method.id  ";
	$sql .= " order by payment_method.sort_order asc  ";
	
	return $sql ; 
	
}




function returnAllItemQtyForOnlinePayment(){

	global $G_DB_CONNECT;
	$sql = "select id from ".TB_PAYMENT." as payment ";
	$sql .= " where returned_qty ='0'  ";
	$sql .= " and (payment_method_id in (select id from ".TB_PAYMENT_METHOD." where online_payment = '1') )  ";
	$sql .= " and (payment_status_id in (select id from ".TB_PAYMENT_STATUS." where return_qty_type <> '2')  )";
	$sql .= " and TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP(),create_date)) >= ".(60*RETURN_QTY_AFTER_MINUTE);

	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			returnAllItemQty($data['id']);
		}
	}
	
	
	//returnAllItemQty($payment_id);
	
	
}



function getCartSQL($order_type = '1'){
	
	
	if($order_type == '1'){
		$order_by = "  cart.product_special_offer_id,cart.freegift asc,cart.last_update_date desc ";
	}else if($order_type == '2'){
		$order_by = " cart.product_special_offer_id,cart.freegift asc, cart.product_id asc,cart.product_color_id asc,cart.product_size_id asc ";
	}
	
	$sql = "select product_desc.name2 as product_name2,product_desc.name as product_name,product.seo_url as product_seo_url ,product.price,product.code as product_code,product.weight,sum(cart.qty) as qty,cart.id,cart.product_id,cart.product_color_id,cart.product_size_id,cart.freegift,cart.free_price,cart.product_special_offer_id from ".TB_CART." as cart,  ".TB_PRODUCT." as product,  ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and product_desc.product_id=product.id ";
	$sql .= " and product_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and cart.qty>0 ";
	$sql .= " and product.disabled='0'  ";
	
	
	$sql .= " and cart.product_id in (";
									  
	$sql .= " select product_id from ".TB_PRODUCT_COLOR_SIZE_QTY;								  
		//$sql .= " where final_price > 0";							  
	$sql .= " )";
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";
	 $sql .= " order by $order_by ";
	
	return $sql ; 
	
}


function cart_getTotalProductWeight($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_weight = 0;
	
	$sql = "select product.weight,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			
			$weight = $data['weight'];
			$total_weight += $weight*$qty;
		}
	}
	
	//$total_price = $total_price;

	return $total_weight;
		
} 

function getDeliveryWeightPrice($delivery_method_id,$weight){
	global $G_DB_CONNECT;
		$price = 0;
	
	if($weight > 0){
	
	
		$max_price = 0;
		/////////////////////////////////////////////////////////
		$sql = "select * from ".TB_DELIVERY_METHOD_WEIGHT_FEE." as delivery_method_weight_fee ";
		$sql .= " where ";
		$sql .= " delivery_method_id = '".$delivery_method_id."' ";
		$sql .= "  order by weight_less_than desc limit 0,1  ";

		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$max_price = $data['price'];
			//return priceWithCurrenyRatio($price);
			}
		}
		
		//////////////////////////////////////////////////////////
	
	
		$sql = "select * from ".TB_DELIVERY_METHOD_WEIGHT_FEE." as delivery_method_weight_fee ";
		$sql .= " where ";
		$sql .= " delivery_method_id = '".$delivery_method_id."' ";
		
		$sql .= " and weight_less_than >= '".$weight."'";
		
		$sql .= "  order by weight_less_than asc limit 0,1 ";

		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$price = $data['price'];
			//return priceWithCurrenyRatio($price);
			}
		}else{
			
			$price = $max_price;
			
			$sql = "select * from ".TB_DELIVERY_METHOD." as delivery_method ";
			$sql .= " where ";
			$sql .= " id = '".$delivery_method_id."' ";
			$sql .= " and weight_extra_weight_larger_than < '".$weight."' ";
	
			$rows = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				while($data = $G_DB_CONNECT->fetch_array($rows)){
					$weight_extra_weight_larger_than = $data['weight_extra_weight_larger_than'];
					$weight_extra_each_weight = $data['weight_extra_each_weight'];
					$weight_extra_price= $data['weight_extra_price'];
				}
				////////////////////////////////////
				$extra_weight = $weight - $weight_extra_weight_larger_than;
				$extra_price = ($extra_weight /$weight_extra_each_weight)*$weight_extra_price;
				$price += $extra_price;
				////////////////////////////////////
			}	
		}
	}
		return $price;
		
		
	
}

/*
function cart_getDeliveryPrice($country_id='',$shop_pick_up=false,$delivery_method_id=0){
	global $G_DB_CONNECT;
	//$arr_data = array();
	$price = 0;
	
	if(SHOP_PICK_UP == '1'){
		$shop_pick_up=false;
	}else{
		$shop_pick_up=true;
	}
	
	//$shop_pick_up = SHOP_PICK_UP;
	
	
	$product_total_weight = cart_getTotalProductWeight();
	//if($product_total_weight < MIN_TOTAL_PRODUCT_WEIGHT){
	//	return false;
	//}else{
		$delivery_price = 0;
		
		
		$sql = "select price from ".TB_COUNTRY;
		$sql .= " where ";
		$sql .= " id ='".$country_id."' ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$delivery_price = $data['price'];
			}
		}
		
		
				$sql = "select price from ".TB_DELIVERY_METHOD_FEE;
				$sql .= " where ";
				$sql .= " delivery_method_id = '".$delivery_method_id."' ";
				$sql .= " and country_id = '".$country_id."' limit 0,1";
				$rows3 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
						$delivery_price= $data3['price'];
					}
				}
		
		
		
		if($delivery_price > 0){
			$price = $delivery_price*$product_total_weight;
		}
		
		
		
		
		
//	}

	//$arr_data['price'] = $price;
	//if($shop_pick_up == '1' || cart_haveFromEquoteItem() == '1'){
		//$price = 0;
	//}
	
	

	
	
	return priceWithCurrenyRatio($price);




}


*/



/*
function cart_getPaymentMethodPrice($country_id,$delivery_method_id,$payment_method_id,$discount=0){
	global $G_DB_CONNECT;
	
	$extra_price_percent = 0;
	

			
			
	//////////////////////////////////////////////////////	
			
	$sql = "select * from ".TB_PAYMENT_METHOD." as payment_method ";
	$sql .= " where ";
	$sql .= " id = '".$payment_method_id."' ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$extra_price_percent = $data['extra_price_percent'];
			
			
			//return priceWithCurrenyRatio($price);
		}
	}		
			
	$subTotal = cart_getSubTotal($country_id,$delivery_method_id)+$discount;
	return round_to($subTotal*$extra_price_percent,0.5);
			




}

*/





function cart_getDeliveryPrice($country_id='',$pick_up='',$delivery_method_id='',$show=false){
	global $G_DB_CONNECT;
	
	$price = 0;
	$country_group_id = 1;
	$country_local = '1';
	$default_price = 0;
$local = 0;
/*
	//////////////////////////////////////////////////////	
	$sql = "select price from ".TB_COUNTRY." as country ";
	$sql .= " where ";
	$sql .= " id = '".$country_id."' ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$price = $data['price'];
			
			//return priceWithCurrenyRatio($price);
		}
	}		
	
	$country_group_id= getDataName(TB_COUNTRY,'country_group_id',$country_id);
	$local= getDataName(TB_COUNTRY_GROUP,'local',$country_group_id);
	
	*/
	
	//////////////////////////////////////////////////////	
			/*
	$sql = "select * from ".TB_DELIVERY_METHOD." as delivery_method ";
	$sql .= " where ";
	$sql .= " id = '".$delivery_method_id."' and country_group_id='".$country_group_id."' ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$default_price = $price = $data['price'];
			$discount_price = $data['discount_price'];
			$spend_more_than = $data['spend_more_than'];
			$country_group_id = $data['country_group_id'];
			
			//return priceWithCurrenyRatio($price);
		}
	}	*/	
	//////////////////////////////////////////////////////	
	//$total_weight = cart_getTotalProductWeight();
	//$total_weight_price = getDeliveryWeightPrice($delivery_method_id,$total_weight);
	//////////////////////////////////////////////////////
	//$totalItemPrice = cart_getTotalItemPrice();
	//if($totalItemPrice >= $spend_more_than &&  ($spend_more_than > 0 && $discount_price != '') ){
		//$price =  $discount_price;
		
	//}else if(){
	
	//}else{
		/*
		if($delivery_method_type_id == '1'){
			$price = $default_price;
		}else{
			$price = $total_weight_price;
		}
		*/
	//	$price = $total_weight_price + $default_price;
		
		
		
		/*
		$sql = "select * from ".TB_DELIVERY_METHOD_FEE." as delivery_method_fee ";
		$sql .= " where ";
		$sql .= " delivery_method_id = '".$delivery_method_id."' ";
		$sql .= " and country_id = '".$country_id."'";
	
	
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$price = $data['price'];
			//return priceWithCurrenyRatio($price);
			}
		}
		
		*/
		
		
		
		

	//}
	
	
	
	//cart_getTotalProductWeight()
	
	$local = 0;
	$sql = "select * from ".TB_DELIVERY_METHOD." as delivery_method ";
	$sql .= " where ";
	$sql .= " country_id = '".$country_id."' ";
	$sql .= " and id = '".$delivery_method_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$price = $price = $data['price'];
			$free_if_purchase_over = $data['free_if_purchase_over'];
			//$local= $data['is_local'];
			
			//return priceWithCurrenyRatio($price);
		}
	}	
	
	//$price = cart_getTotalItemPrice();
	
	
	$free_if_purchase_over = FREE_SHIPPING_IF_AMOUNT_OVER;
	//$price = DEFAULT_DELIVERY_PRICE;
	
	$total_product_price = cart_getTotalItemPrice();
	if($total_product_price >= $free_if_purchase_over){
		$price = 0;
	}
	
	if($total_product_price  == 0 && !$show ){
		
		$price = 0;
	}
	//$price = $free_if_purchase_over;
	
	
if(SHOP_PICK_UP == '1'){
		//$price = 0;
}
	
	
	
	return priceWithCurrenyRatio($price);




}


function cart_getPaymentMethodPrice($payment_method_id,$total_product_price,$total_delivery_price){
	global $G_DB_CONNECT;
	
	$extra_price_percent = 0;
	

			
			
	//////////////////////////////////////////////////////	
			
	$sql = "select extra_price_percent from ".TB_PAYMENT_METHOD." as payment_method ";
	$sql .= " where ";
	$sql .= " id = '".$payment_method_id."' ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$extra_price_percent = $data['extra_price_percent'];
			
			
			//return priceWithCurrenyRatio($price);
		}
	}		
			
	$price = ($total_product_price + $total_delivery_price)*$extra_price_percent;
			
	
	return priceWithCurrenyRatio($price);
			




}



function cart_get_shopping_bag_content_height() { 
	$total_item = cart_getTotalDifferentItem();
	$max_height = 280;
	
	$each_product_row_height = 70;
	$each_link_row_height = 10;

	$height = $total_item*$each_product_row_height+($total_item-1)*$each_link_row_height;
	if($height > $max_height){
		$height = $max_height;
	}
	return $height;
	
}


function cart_getItemListTable() { 
	global $G_DB_CONNECT;

	$out = "";
	
	$sql = getCartSQL();
	
	



	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		
		$k = 0;
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$k++;
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id']);
			$price = $arr_product_price_data['price'];
			$product_name = $data['product_name'];
			$product_id = $data['product_id'];
			$product_color_id = $data['product_color_id'];
			$color_name = getLangName(TB_PRODUCT_COLOR,"name",$data['product_color_id'],CURRENT_LANG);
			$size_name = getLangName(TB_PRODUCT_SIZE,"name",$data['product_size_id'],CURRENT_LANG);
			
			
			
//$this_link = getURLRewriteProduct('','','','','',$data['product_id'],$data['product_code']."/".$data['product_seo_url']);
$this_link = "product.php?pid=".$data['product_id'];

	if($k > 1){
		$out .= '<div id="shopping_bag_list_line"></div>';
	}

	$out .= '<table  cellspacing="0" cellpadding="0" id="shopping_bag_top_table" >';
  	$out .= '<tr>';
    $out .= '<td style="padding-top:8px"  class="shopping_bag_top_img">';
	 $out .= '<div id="shopping_bag_top_img">';
	
 $out .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
 $out .= '<tr>';
 $out .= '<td class="shopping_bag_top_img">';
 
 

	$sql = "select * from ".TB_PRODUCT_PHOTO;
	$sql .= " where id>0 ";
	$sql .= " and disabled='0' ";
	$sql .= " and product_id='".$product_id."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			
			
			$arr_data = getThumbPhotoPath($data2['img'],"thumb",50,50);
 
	
$out .= '<a href="'.$this_link.'"><img src="'. $arr_data['img_path'].'" width="'.$arr_data['width'].'" height="'.$arr_data['height'].'" /></a>';
		}
	}



	
 $out .= '</td>';
 $out .= '</tr>';
 $out .= '</table>';
	
	
	 $out .= '</div></td>';
    $out .= '<td class="shopping_bag_top_content"  style="padding-top:8px">';
   // $out .= '<div class="shopping_bag_top_item_name"><a href="product.php?pid='.$product_id.'">'.$product_name.'</a></div>';
   
   
   
	$out .= '<div class="shopping_bag_top_item_name"><a href="'.$this_link.'">'.$product_name.'</a></div>';
	$out .= '<div class="shopping_bag_top_detail">';
    //$out .= '<div class="shopping_bag_top_item_qty">'.$color_name.', '.$size_name.'</div>';
	 $out .= '<div class="shopping_bag_top_item_qty">'.$size_name.'</div>';
    $out .= '</div>';
    $out .= '<div class="shopping_bag_top_detail">';
    $out .= '<div class="shopping_bag_top_item_qty">'.TITLE_CART_QTY.': '.$qty.'</div>';
	
	if(MEMBER_ROLE != '5'){
   		$out .= '<div class="shopping_bag_top_item_separator"></div>';
   	 	$out .= '<div class="shopping_bag_top_item_price">'.displayPriceOnly2($price).'</div>';
	}
	
    $out .= '</div>';
    $out .= '</td>';
  	$out .= '</tr>';
	$out .= '</table>';






		}
		
	}
	


	return $out;
		
} 



function cart_exist($qty,$product_id,$product_color_id=0,$product_size_id=0,$freegift='',$free_price='',$product_special_offer_id='') { 
	global $G_DB_CONNECT;

	$arr_data = array();
	$arr_data['cart_id'] = 0;
	$arr_data['qty'] = 0;
	
	
	$sql = "select id,qty from ".TB_CART." as cart  ";
	$sql .= " where product_id='".$product_id."' ";
	$sql .= " and session_id='".SESSION_ID."' ";
	$sql .= " and product_size_id='".$product_size_id."' ";
	$sql .= " and product_color_id='".$product_color_id."' ";
	//$sql .= " and freegift='".$freegift."' ";
	//$sql .= " and free_price='".$free_price."' ";
	//$sql .= " and product_special_offer_id='".$product_special_offer_id."' ";
	


	
	//$sql .= " group by product_id,product_color_id,product_size_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$arr_data['cart_id'] = $data['id'];
			$arr_data['qty'] = $data['qty'];
		}
	}
	
			
	return $arr_data;
		
} 





function cart_add_item($qty,$product_id,$product_color_id=0,$product_size_id=0,$id=0,$freegift='',$free_price='',$freegift_id_list='',$product_special_offer_id=0) { 
	global $G_DB_CONNECT;
	
	$in_stock = getDataName(TB_PRODUCT,'in_stock',$product_id );
	if($in_stock == 0){
		return;
	}
	
	
	$total_qty_in_db = db_getProductQTY($product_id,$product_color_id,$product_size_id);
	$out_of_stock=false;
	if($total_qty_in_db <=0){
		$out_of_stock=true;
	}
	
	///////////////////////////////////////////////////////////////
	// from cart page to update qty directly with new qty
	///////////////////////////////////////////////////////////////
	if($id > 0){
		$update_data = array();
		
		if($qty > $total_qty_in_db){
			$qty = $total_qty_in_db;
		}
		
		$update_data['qty'] = $qty;
		
		
		$sql = "select * from ".TB_CART;
		$sql .= " where session_id='".SESSION_ID."' and id='".$id."' ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$this_product_color_id = $data['product_color_id'];
				$this_product_size_id = $data['product_size_id'];
				$this_product_special_offer_id = $data['product_special_offer_id'];
			}
		}
	
		if($this_product_color_id!=$product_color_id || $this_product_size_id!=$product_size_id || $this_product_special_offer_id!=$product_special_offer_id){
			$sql = "update  ".TB_CART;
			$sql .= " set product_color_id='".$product_color_id."',product_size_id='".$product_size_id."',qty='".$qty."'  ";
				$sql .= " where session_id='".SESSION_ID."' and id='".$id."' and freegift='".$freegift."' and free_price = '".$free_price."'  and product_special_offer_id = '".$product_special_offer_id."'  ";
			$G_DB_CONNECT->query($sql); 
		}else{
		
			$G_DB_CONNECT->query_update(TB_CART, $update_data, "id='".$id."'  and session_id='".SESSION_ID."' "); 
		}
		
		
		
		return $update_data['qty'];

	}
	
	
	///////////////////////////////////////////////////////////////
	// if add from product detail
	///////////////////////////////////////////////////////////////
	$arr_data_cart = cart_exist($qty,$product_id,$product_color_id,$product_size_id,$freegift,$free_price,$product_special_offer_id);
	$cart_id = $arr_data_cart['cart_id'];
	$old_qty = $arr_data_cart['qty'];
	if($cart_id == 0){
		$update_data = array();
		$update_data['qty'] = $qty;
		$update_data['product_id'] = $product_id;
		$update_data['product_color_id'] = $product_color_id;
		$update_data['product_size_id'] = $product_size_id;
		$update_data['session_id'] = SESSION_ID;
		$update_data['create_date'] = 'null';
		$update_data['member_id'] = $_SESSION['flogin_mid'];
		
		$update_data['freegift'] = $freegift;
		$update_data['free_price'] = $free_price;
		$update_data['freegift_id_list'] = $freegift_id_list;
	
		
		$update_data['product_special_offer_id'] = $product_special_offer_id;
		
		$cart_id = $G_DB_CONNECT->query_insert(TB_CART, $update_data); 
		return $update_data['qty'];
	}else{
		$update_data = array();
		
		$new_qty = $qty+$old_qty;
		
		if($new_qty > $total_qty_in_db){
				$new_qty = $total_qty_in_db;
		}
		
		$update_data['qty'] = $new_qty;
		$update_data['product_id'] = $product_id;
		$update_data['product_color_id'] = $product_color_id;
		$update_data['product_size_id'] = $product_size_id;
		$update_data['member_id'] = $_SESSION['flogin_mid'];
			$update_data['freegift'] = $freegift;
		$update_data['free_price'] = $free_price;
		$update_data['freegift_id_list'] = $freegift_id_list;
		$update_data['product_special_offer_id'] = $product_special_offer_id;
		//$update_data['session_id'] = SESSION_ID;
		$G_DB_CONNECT->query_update(TB_CART, $update_data, "id='".$cart_id."'   and session_id='".SESSION_ID."' "); 
		return $update_data['qty'];
	}
	///////////////////////////////////////////////////////////////
	
	
	
	
}






function cart_delete_item($id) { 
	global $G_DB_CONNECT;
	$product_special_offer_id = 0;
	$sql = " select product_special_offer_id from ".TB_CART;
	$sql .= " where id='".$id."'   and session_id='".SESSION_ID."'  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$product_special_offer_id = $data['product_special_offer_id'];
			
		}
	}
	if($product_special_offer_id > 0 ){
		$G_DB_CONNECT->query("update  ".TB_CART." set product_special_offer_id= '0' where product_special_offer_id='".$product_special_offer_id."'   and session_id='".SESSION_ID."' ");
	}
	
	
	
	
	
	
	$G_DB_CONNECT->query("delete from ".TB_CART." where id='".$id."'   and session_id='".SESSION_ID."' ");
	

	
	
}

function cart_clear_all() { 
	global $G_DB_CONNECT;
	
	$G_DB_CONNECT->query("delete from ".TB_CART." where  session_id='".SESSION_ID."' ");
	
	$_SESSION['prompt_msg'] = '';
	
	
}


function cart_getTotalDifferentItem() { 
	global $G_DB_CONNECT;

	$total_item = 0;
	
	$sql = "select * from ".TB_CART." as cart  ";
	$sql .= " where session_id='".SESSION_ID."' ";
	$sql .= " and qty>0 ";
	$sql .= " group by product_id,product_color_id,product_size_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			//$qty = $data['qty'];
			$total_item++;
		}
	}
	


	return $total_item;
		
} 


function cart_getTotalDiffItem() { 
	global $G_DB_CONNECT;

	$total_item = 0;
	
	$sql = "select count(*) as total_item from ".TB_CART." as cart  ";
	$sql .= " where session_id='".SESSION_ID."' ";
	$sql .= " and qty>0 ";
	//$sql .= " group by product_id,product_color_id,product_size_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$total_item = $data['total_item'];
			
		}
	}
	


	return $total_item;
		
} 





function cart_getTotalItem() { 
	global $G_DB_CONNECT;

	$total_item = 0;
	
	$sql = "select * from ".TB_CART." as cart  ";
	$sql .= " where session_id='".SESSION_ID."' ";
	$sql .= " and qty>0 ";
	//$sql .= " group by product_id,product_color_id,product_size_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$total_item = $total_item + $qty;
		}
	}
	


	return $total_item;
		
} 


function cart_getTotalItemPrice4($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	/*
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
	
	
	
	*/
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	$sql .= " and  freegift_id_list='' ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id']);
			$price = $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
		}
	}
	
	
	
	
	
	
	
	
	//$total_price = $total_price;

	return $total_price;
		
} 

function allowCountInFreeGift($product_id){
	
	global $G_DB_CONNECT;
	
	$product_category_id = getDataName(TB_PRODUCT,'product_category_id',$product_id);
	$parent_product_category_id = getDataName(TB_PRODUCT_CATEGORY,'parent_product_category_id',$product_category_id);
	$have_gift = 0;
	
	$sql = "select have_gift from ".TB_PRODUCT_CATEGORY." where id= '".$parent_product_category_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$have_gift = $data['have_gift'];
			
		}
	}
	if($have_gift == 1){
		return true;
	}
	return false;
}



function cart_getTotalItemPrice4b($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
/*
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	$sql .= " and  freegift_id_list='' ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			
			
			
			////////////////////////////////////////
			if(allowCountInFreeGift($data['product_id'])){
			
			
			////////////////////////////////////////
			
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id']);
			$price = $arr_product_price_data['price'];
			 $have_category_discount = $arr_product_price_data['have_category_discount'];
			 if($have_category_discount){
				 $price = 0;
			 }
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
			
			////////////////////////////////////////
			}
			
			
			////////////////////////////////////////
			
			
			
		}
	}
	
	
	
	*/
	
	
	
	
	//$total_price = $total_price;

	return $total_price;
		
} 



function cart_getTotalItemPrice($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	/*
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
	
	
	
	*/
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id'],false,$data['product_color_id'],$data['product_special_offer_id']);
			$price = $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
		}
	}
	
	//$total_price = $total_price;
	
	
	
	
	/*
	echo "<br>";
	echo $total_price;
	echo "<br>";
	echo $reduce_product_category_discount_price;
	*/
	
	//$total_price -= $reduce_product_category_discount_price;
	
	

	

	return $total_price;
		
} 




function cart_getTotalItemPriceNoDiscount($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	/*
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
	
	
	
	*/
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id'],false,$data['product_color_id'],$data['product_special_offer_id']);
			$price = $arr_product_price_data['price'];
			if(!$arr_product_price_data['have_special_price'] ){
	
				
				
				$total_price += $price*$qty;
			}
			
		}
	}
	
	//$total_price = $total_price;
	
	
	
	
	/*
	echo "<br>";
	echo $total_price;
	echo "<br>";
	echo $reduce_product_category_discount_price;
	*/
	
	//$total_price -= $reduce_product_category_discount_price;
	
	

	

	return $total_price;
		
} 


function cart_getTotalItemPriceOriginal($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id'],false,$data['product_color_id'],$data['product_special_offer_id_id']);
			$price = $arr_product_price_data['old_price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
		}
	}

	

	return $total_price;
		
} 



function cart_getSavedPrice($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id'],false,$data['product_color_id'],$data['product_special_offer_id']);
			$price = $arr_product_price_data['old_price'] - $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
		}
	}

	if($total_price == 0){
		
		$total_price ='';
		return $total_price;
	}else{
		
		
		return '(-'.displayPriceOnly2($total_price).')';
	}

	
		
} 

function cart_getSavedPricePercent($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	
$old_price = 0;
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id'],false,$data['product_color_id'],$data['product_special_offer_id']);
			$old_price +=$qty*$arr_product_price_data['old_price'] ;
			$price = $arr_product_price_data['old_price'] - $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
		}
	}

	if($total_price == 0){
		
		$total_price ='';
		return $total_price;
	}else{
		
		
		return ''.round(($total_price/$old_price)*100,2).'%';
	}

	
		
} 

function cart_getTotalItemPriceSaved($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id'],false,$data['product_color_id'],$data['product_special_offer_id']);
			$price = $arr_product_price_data['old_price'] - $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
		}
	}

	

	return $total_price;
		
} 



function cart_getTotalItemPrice2($cart_id = 0) { 
	global $G_DB_CONNECT;

	$total_price = 0;
	/*
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.id ";
	$sql .= " and cart.qty>0 ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
	
	
	
	*/
	
	$sql = "select product.price,cart.* from ".TB_CART." as cart,  ".TB_PRODUCT_COLOR_SIZE_QTY." as product ";
	$sql .= " where cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.product_id=product.product_id ";
	$sql .= " and cart.product_size_id=product.product_size_id ";
	$sql .= " and cart.qty>0 and freegift='0' ";
	if($cart_id > 0){
		$sql .= " and cart.id = '$cart_id' ";
	}
	
	
	$sql .= " group by cart.product_special_offer_id,cart.product_id,cart.product_color_id,cart.product_size_id,freegift,free_price ";

	
	

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$qty = $data['qty'];
			$arr_product_price_data =  getFinalProductPriceData($data['product_id'],$data['product_size_id'],$data['product_special_offer_id']);
			$price = $arr_product_price_data['price'];
			if($data['freegift'] == '1'){
				$price = $data['free_price'];
			}
			$total_price += $price*$qty;
		}
	}
	
	//$total_price = $total_price;

	return $total_price;
		
} 

function cart_getSubTotal($country_id,$delivery_method_id) { 

	$total_price = 0;
	$total_product_price = cart_getTotalItemPrice();
	$total_delivery_price = cart_getDeliveryPrice($country_id,$delivery_method_id);

	$total_price = $total_product_price+$total_delivery_price;

	return $total_price;
		
} 






function cart_getTotalPrice($country_id,$delivery_method_id,$payment_method_id=0,$discount=0) { 

	$total_price = 0;
	$total_product_price = cart_getTotalItemPrice();
	$total_delivery_price = cart_getDeliveryPrice($country_id,$delivery_method_id);
	
	$total_payment_price = cart_getPaymentMethodPrice($country_id,$delivery_method_id,$payment_method_id,$discount);

	$total_price = $total_product_price+$total_delivery_price+$total_payment_price+$discount;

	return $total_price;
		
} 





function cart_getSelectedProductQTY($product_id,$product_color_id,$product_size_id){
	global $G_DB_CONNECT;
	$total_qty = 0;
	$sql = "select sum(qty) as total_qty from ".TB_CART." as cart  ";
	$sql .= " where product_id='".$product_id."' ";
	$sql .= " and session_id='".SESSION_ID."' ";
	$sql .= " and product_size_id='".$product_size_id."' ";
	$sql .= " and product_color_id='".$product_color_id."' ";
	$sql .= " group by product_id,product_color_id,product_size_id ";
	//$return_data['sql'] = $sql;
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$total_qty = $data['total_qty'];
			}
	}
	return $total_qty;
	
}






function db_getProductQTY($product_id,$product_color_id,$product_size_id){
	global $G_DB_CONNECT;
	$total_qty_in_db = 0;
	/*
	$sql = "select sum(qty) as total_qty from ".TB_PRODUCT_COLOR_SIZE_QTY." as product_color_size_qty  ";
	$sql .= " where product_id='".$product_id."' ";
	$sql .= " and product_size_id='".$product_size_id."' ";
	$sql .= " and product_color_id='".$product_color_id."' ";
	 $sql .= " group by product_id,product_color_id,product_size_id ";
	 */
	 $sql = "select sum(qty) as total_qty from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where product_id='".$product_id."' ";
	//$sql .= " and product_size_id='".$product_size_id."' ";
	 $sql .= " group by product_id,product_color_id,product_size_id ";
	 
	
	//$sql = "select qty as total_qty from ".TB_PRODUCT;
	//$sql .= " where id='".$product_id."' ";

	
	
	//$return_data['sql'] = $sql;
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$total_qty_in_db = $data['total_qty'];
			}
	}
	
	$total_qty_in_db = 9999;
	return $total_qty_in_db;
	
}




function getAvailableProductQTY($product_id,$product_color_id,$product_size_id){
	global $G_DB_CONNECT;
	
	$total_qty_in_db = db_getProductQTY($product_id,$product_color_id,$product_size_id);
		
	
	$total_qty_selected_in_cart = cart_getSelectedProductQTY($product_id,$product_color_id,$product_size_id);
	
	$total_qty = (int) $total_qty_in_db - (int) $total_qty_selected_in_cart;
	if($total_qty < 0){
		$total_qty = 0;
	}
	
	
	
	return $total_qty;
	
}



function showProductStatus($new_product=0 , $qty ='',$type=1){

	
	if($qty == 0){
		if($type == 1){
			return "btn_sold_out";
		}else if($type == 2){
			return "btn_detail_sold_out";
		}
	}else if($new_product == '1'){
		if($type == 1){
			return "btn_new_product";
		}else if($type == 2){
			return "btn_detail_new_product";
		}
	}else{
		if($type == 1){
			return "btn_product";
		}else if($type == 2){
			return "btn_detail_product";
		}
	}
}

function deleteRecord($t1,$id,$have_lang=true,$arr_relative_table = ''){
		
		global $G_DB_CONNECT;
		$condition = '';
		if($condition != ''){
			$condition = " and ".$condition;
		}

         		
			
				$disabled = DISABLED_DELETE;
				$data["disabled"] = $disabled;
				
				$G_DB_CONNECT->query_update($t1, $data, "   id='$id'   ".$condition ); 
				
				
		
		
	
		
}

function deleteGroup($t1,$selected_id,$have_lang=true,$arr_relative_table = ''){
		
		updateFieldDataFromTable($t1,"disabled",$selected_id,DISABLED_DELETE);
	
		
}
function getLangRefFieldID($table){
	return str_replace(REAL_TABLE_PREFIX,'',$table)."_id";
}



function replaceVarFromString($content,$str_replace_from,$str_replace_to){
	
	$arr_replace_from = explode(",", $str_replace_from);
	$arr_replace_to = explode(",", $str_replace_to);
	for ($i=0; $i<count($arr_replace_from); $i++)   { 
		$replace_from = trim($arr_replace_from[$i]);
		$replace_to = trim($arr_replace_to[$i]);
	
		$content = str_replace($replace_from, $replace_to, $content);
		
	}
	
	return $content;

	
	
	
}





function sendEmailLIVE($email_from='',$email_from_name='',$email_to="",$email_to_name='',$email_title='',$html='',$path = "../",$img_path='',$img_id='',$img_path2='',$img_id2=''){
	
	if($email_from == ''){
		$email_from = $email_to;
	}
	
	
if($email_from != '' && $email_to != "" && $email_title != "" && $html !=""){
require_once($path."includes/classes/email/phpmailer/PHPMailerAutoload.php");
	$mail = new PHPMailer();
	
	
	
	/*
	$mail->isSMTP();
$mail->Debugoutput = 'html';
$mail->Host =  "mail.phillip-wain.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
$mail->SMTPSecure = '';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "postmaster@phillip-wain.com ";  
//Password to use for SMTP authentication
$mail->Password = "pM2007Pw";             
	*/

$mail->From = "info@phillip-wain.com";
$mail->FromName = "inskin";



	
	
	
	$arr_email_from = explode(",", $email_from);

	if($email_from != 'info@phillip-wain.com'){
		$mail->From  = $arr_email_from[0];
		$mail->FromName = $email_from_name;
	}
	
	
	
	$mail->Subject = $email_title;
	$mail->IsHTML(true);
	$mail->Body = $html;
	
	if($img_path != ''){
		$mail->AddEmbeddedImage($img_path, $img_id);

	}
	if($img_path2 != ''){
		$mail->AddEmbeddedImage($img_path2, $img_id2);

	}
	
	
	$arr_email_to = explode(",", $email_to);
	$arr_email_to_name = explode(",", $email_to_name);
	for ($i=0; $i<count($arr_email_to); $i++)   { 
		$to_email = trim($arr_email_to[$i]);
		$to_name = trim($arr_email_to_name[$i]);
		if($to_email != ''){
			$mail->AddAddress($to_email,$to_name);
		}
	}

					
				
	if ($mail->Send()){
		//echo "ok";
	}else{
		//echo "fail";	
	}
	
	
}
	
}




function sendEmail($email_from='',$email_from_name='',$email_to="",$email_to_name='',$email_title='',$html='',$path = "../",$img_path='',$img_id='',$img_path2='',$img_id2=''){
	
	if($email_from == ''){
		$email_from = $email_to;
	}
	
	
if($email_from != '' && $email_to != "" && $email_title != "" && $html !=""){
require_once($path."includes/classes/email/phpmailer/PHPMailerAutoload.php");
	$mail = new PHPMailer();
	

	
		$our_server = OUR_SERVER;
		$our_server = str_replace('/'.CURRENT_LANG_DIR.'/','/',$our_server);

$html = str_replace('../','/',$html);

		$html = str_replace('"upload/','"'.$our_server.'upload/',$html);
		
		
		$html = str_replace('"/upload/','"'.$our_server.'upload/',$html);
		


	//$mail->isSMTP();
	$mail->CharSet = 'UTF-8';    
	/*
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Debugoutput = 'html';
$mail->Host =  "mail.phillip-wain.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
$mail->SMTPSecure = '';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "postmaster@phillip-wain.com";  
//Password to use for SMTP authentication
$mail->Password = "pM2007Pw";             
	*/
$mail->From = "postmaster@phillip-wain.com";
$mail->FromName = "inskin";



	$arr_email_from = explode(",", $email_from);
	
	$mail->From = $arr_email_from[0];
	
	
	
	
	$mail->FromName = $email_from_name;

	
	
	
	$arr_email_from = explode(",", $email_from);
	
	//$mail->From = $arr_email_from[0];
	
	
	
	
	//$mail->FromName = $email_from_name;
	$mail->Subject = $email_title;
	$mail->IsHTML(true);
	$mail->Body = $html;
	
	if($img_path != ''){
		$mail->AddEmbeddedImage($img_path, $img_id);

	}
	if($img_path2 != ''){
		$mail->AddEmbeddedImage($img_path2, $img_id2);

	}
	
	
	$arr_email_to = explode(",", $email_to);
	$arr_email_to_name = explode(",", $email_to_name);
	for ($i=0; $i<count($arr_email_to); $i++)   { 
		$to_email = trim($arr_email_to[$i]);
		$to_name = trim($arr_email_to_name[$i]);
		if($to_email != ''){
			$mail->AddAddress($to_email,$to_name);
		}
	}

					
				
	if ($mail->Send()){
		//echo "ok";
	}else{
		//echo "fail";	
	}
	
	
}
	
}



function generateCode($length = 10){   
		$password="";   
		$chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ1234567890";   
		srand((double)microtime()*1000000);   
		for ($i=0; $i<$length; $i++)   {      
			$password = $password . substr ($chars, rand() % strlen($chars), 1);   
		}   
		return $password;
}

/*
function generateMemberCode(){
	return nextRecordcode(TB_MEMBER,"","M",6);
}
*/
function generateMemberCode(){
	
	return nextRecordcode(TB_MEMBER,"","MB",6);
}



function getFirstPhotoForFront($photo_table,$condition = "",$thumb_dir="thumb",$photo_width= 50,$photo_height= 50,$just_image_path=true){
	return getFirstPhoto($photo_table,$condition,$thumb_dir,$photo_width,$photo_height,"","",$just_image_path);
	
}



function getFirstPhoto($photo_table,$condition = "",$thumb_dir="thumb",$photo_width= 50,$photo_height= 50,$this_path="../",$this_script_path="../../../../",$just_image_path=false){


	global $G_DB_CONNECT;
	if($condition != ''){
		$condition = " and ".$condition;
	}
	
	$product_photo_img_thumb = "";
  	$sql = "select * from ".$photo_table;
	$sql .= " where id>0 and disabled='0' ".$condition;
	$sql .= " order by sort_order asc limit 0,1 ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
				$product_photo_img = $this_script_path.$data2['img'];
				$arr_img_info = getImageInfo($product_photo_img,$thumb_dir,$photo_width,$photo_height);
				$product_photo_img_thumb = $arr_img_info["src"];
			}
	}
	$img_data = "";
	if(file_exists($product_photo_img_thumb)){
		//$img_data = '<img src="'.$product_photo_img_thumb.'" width="'.$arr_img_info["width"].'" height="'.$arr_img_info["height"].'""/>';
		if($just_image_path){
			$img_data = str_replace($this_script_path,$this_path,$product_photo_img_thumb);
		}else{
			$img_data = '<img src="'.str_replace($this_script_path,$this_path,$product_photo_img_thumb).'"  width="'.$arr_img_info['width'].'"  height="'.$arr_img_info['height'].'"/>';
		}
	}
	
	return $img_data;

}



function getFirstLangPhoto($photo_table,$condition = "",$thumb_dir="thumb",$photo_width= 50,$photo_height= 50,$this_path="../",$this_script_path="../../../../",$just_image_path=false){


	global $G_DB_CONNECT;
	if($condition != ''){
		$condition = " and ".$condition;
	}
	
	$product_photo_img_thumb = "";
  	$sql = "select * from ".$photo_table;
	$sql .= " where id>0 and disabled='0' ".$condition;
	$sql .= " order by sort_order asc limit 0,1 ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
				$product_photo_img = $this_script_path.$data2['img'];
				$arr_img_info = getImageInfo($product_photo_img,$thumb_dir,$photo_width,$photo_height);
				$product_photo_img_thumb = $arr_img_info["src"];
			}
	}
	$img_data = "&nbsp;";
	if(file_exists($product_photo_img_thumb)){
		//$img_data = '<img src="'.$product_photo_img_thumb.'" width="'.$arr_img_info["width"].'" height="'.$arr_img_info["height"].'""/>';
		if($just_image_path){
			$img_data = str_replace($this_script_path,$this_path,$product_photo_img_thumb);
		}else{
			$img_data = '<img src="'.str_replace($this_script_path,$this_path,$product_photo_img_thumb).'"  width="'.$arr_img_info['width'].'"  height="'.$arr_img_info['height'].'"/>';
		}
	}
	
	return $img_data;

}




function getThumbPhotoPath($img,$thumb_dir="thumb",$photo_width= 50,$photo_height= 50,$this_path="",$this_script_path="",$just_image_path=true){


	
	$product_photo_img = $this_script_path.$img;
	$arr_img_info = getImageInfo($product_photo_img,$thumb_dir,$photo_width,$photo_height);
	$product_photo_img_thumb = $arr_img_info["src"];
			
	
	
	if(file_exists($product_photo_img_thumb)){
		//echo "have_photo";
		//$img_data = '<img src="'.$product_photo_img_thumb.'" width="'.$arr_img_info["width"].'" height="'.$arr_img_info["height"].'""/>';
		$img_path = str_replace($this_script_path,$this_path,$product_photo_img_thumb);
		//if($just_image_path){
			
			//$img_data = $img_path;
		//}else{
			
			$img_data = '<img src="'.$img_path.'" width="'.$arr_img_info['width'].'" height="'.$arr_img_info['height'].'"/>';
		//}
	}else{
		//echo " no photo";
	}
	$arr_data['img'] = $img_data;
	$arr_data['img_path'] = $img_path;
	$arr_data['width'] = floor($arr_img_info['width']);
	$arr_data['height'] = floor($arr_img_info['height']);
	
	return $arr_data;

}


function getThumbPhotoPath2($img,$thumb_dir="thumb",$photo_width= 50,$photo_height= 50,$this_path="",$this_script_path="",$just_image_path=true){


	
	$product_photo_img = $this_script_path.$img;
	$arr_img_info = getImageInfo($product_photo_img,$thumb_dir,$photo_width,$photo_height);
	$product_photo_img_thumb = $arr_img_info["src"];
			
	
	
	if(file_exists($product_photo_img_thumb)){
		//echo "have_photo";
		//$img_data = '<img src="'.$product_photo_img_thumb.'" width="'.$arr_img_info["width"].'" height="'.$arr_img_info["height"].'""/>';
		$img_path = str_replace($this_script_path,$this_path,$product_photo_img_thumb);
		//if($just_image_path){
			
			//$img_data = $img_path;
		//}else{
			
			$img_data = '<img src="'.$img_path.'" width="'.$arr_img_info['width'].'" height="'.$arr_img_info['height'].'"/>';
		//}
	}else{
		//echo " no photo";
	}
	$arr_data['img'] = $img_data;
	$arr_data['img_path'] = $img_path;
	$arr_data['width'] = $arr_img_info['width'];
	$arr_data['height'] = $arr_img_info['height'];
	
	return $img_path;
	
	//return $arr_data;

}


function resizeImageInfo($PhotoPath,$width_size,$height_size ){
		$image_file = $PhotoPath;
			
			

			
			
		
		
		
		if(file_exists($image_file)){
			$size = getimagesize($image_file);
		}
		
		
		
		
		 $max_ratio = $width_size/$height_size;
		//echo "<br>";
		 $img_ratio = $size[0] / $size[1];
		
		
		
		$width_max_size = $width_size;
		$height_max_size = $height_size;
		$noResize = true;
		
		
		
		if($max_ratio <  $img_ratio){
		
			$divisor = $size[0] / $width_max_size;
			$noResize = false;
		}else{
				$divisor = $size[1] / $height_max_size;
				$noResize = false;
			
		}
		
		/*
		
		if($size[0] > $width_max_size) {
  			$divisor = $size[0] / $width_max_size;
			$noResize = false;
		}else if($size[1] > $height_max_size){
			$divisor = $size[1] / $height_size;
			$noResize = false;
		} else {

			$noResize = true;
		}
		
		
		if($size[1] > $height_max_size) {
  			$divisor = $size[1] / $height_max_size;
			$noResize = false;
		}else if($size[1] > $height_max_size){
			$divisor = $size[0] / $width_size;
			$noResize = false;
		} else {

			$noResize = true;
		}
		
		if($size[0] > $width_max_size) {
  			$divisor = $size[0] / $width_max_size;
			$noResize = false;
		}else if($size[1] > $height_max_size){
			$divisor = $size[1] / $height_size;
			$noResize = false;
		} else {

			$noResize = true;
		}
		
		
*/
		
		
    	 // to get allways pictures of the same size, which ist
    	 // mostly wanted in imageviewers, look what ist larger:
		 // width or height
		if($noResize == false){
			$new_width = $size[0] / $divisor;
			$new_height = $size[1] / $divisor;
		}else{
			$new_width = $size[0];
			$new_height = $size[1];
		}
	
	
	/*
	
		if($new_height > $height_max_size) {
  			$divisor = $size[1] / $height_max_size;
		
		}else if($size[0] > $width_max_size){
			$divisor = $size[0] / $width_max_size;
			$noResize = false;
		} else {

			$noResize = true;
		}
	
	if($noResize == false){
			$new_width = $size[0] / $divisor;
			$new_height = $size[1] / $divisor;
		}else{
			$new_width = $size[0];
			$new_height = $size[1];
		}
	*/

//echo $size[0] .":". $width_size.":". $size[1].":".  $height_size ;
	if($size[0] <= $width_size&& $size[1] <= $height_size  ){
		$new_width = $size[0];
		$new_height= $size[1];
	}
	
		
		$Info["new_width"]=$new_width;
		$Info["new_height"]=$new_height;
		$Info["image_file"]=$image_file;
		
		return $Info;
	}


function getImageInfo($thumbImage,$thumbDirname,$maxThumbImageWidth='',$maxThumbImageHeight=''){
	

			
	
			if($thumbDirname != ''){

				$lastSlashPos =  strrpos($thumbImage,"/");
				$imageBase =  substr($thumbImage,0,$lastSlashPos );
				$imagename =  substr($thumbImage,$lastSlashPos + 1);
			
				$thumbImage = $imageBase."/".$thumbDirname."/".$imagename;
			}
			
	
		if(file_exists($thumbImage)){
			$thumbImageSize = getimagesize($thumbImage);
		
			
			
			$thumbImageWidth = $thumbImageSize[0];
			$thumbImageHeight = $thumbImageSize[1];
			
			$widthDiff = ($maxThumbImageWidth - $thumbImageWidth)/2;
			$heightDiff = ($maxThumbImageHeight - $thumbImageHeight)/2;
			
			//echo "test".$thumbImage;
			
			$arr_resized_image = resizeImageInfo($thumbImage,$maxThumbImageWidth,$maxThumbImageHeight );
			
			}
			
			
			$thumbImageInfo["widthDiff"] = $widthDiff;
			$thumbImageInfo["heightDiff"] = $heightDiff;
			$thumbImageInfo["width"] = $arr_resized_image['new_width'];
			$thumbImageInfo["height"] = $arr_resized_image['new_height'];
			$thumbImageInfo["src"] = $thumbImage;
			
		
			
			
			
			return $thumbImageInfo;

	}



function smart_resize_image( $file, $thumb_dir = '' , $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = false, $use_linux_commands = false )
  {
  
  
  		$lastSlashPos =  strrpos($file,"/");
		$imageBase =  substr($file,0,$lastSlashPos );
		$imageName =  substr($file,$lastSlashPos + 1);
  
  
    if ( $height <= 0 && $width <= 0 ) {
      return false;
    }





    $info = getimagesize($file);
	
	if($info[0] <= $width && $info[1] <= $height ){
		$width = $info[0];
		$height = $info[1];
	}
	
	
	
    $image = '';

    $final_width = 0;
    $final_height = 0;
    list($width_old, $height_old) = $info;

    if ($proportional) {
      if ($width == 0) $factor = $height/$height_old;
      elseif ($height == 0) $factor = $width/$width_old;
      else $factor = min ( $width / $width_old, $height / $height_old);  

      $final_width = round ($width_old * $factor);
      $final_height = round ($height_old * $factor);

    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
    }

    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        $image = imagecreatefromgif($file);
      break;
      case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($file);
      break;
      case IMAGETYPE_PNG:
        $image = imagecreatefrompng($file);
      break;
      default:
        return false;
    }
   
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
       
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $trnprt_indx = imagecolortransparent($image);
   
      // If we have a specific transparent color
      if ($trnprt_indx >= 0) {
   
        // Get the original image's transparent color's RGB values
        $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
   
        // Allocate the same color in the new image resource
        $trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
   
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $trnprt_indx);
   
        // Set the background color for new image to transparent
        imagecolortransparent($image_resized, $trnprt_indx);
   
     
      }
      // Always make a transparent background color for PNGs that don't have one allocated already
      elseif ($info[2] == IMAGETYPE_PNG) {
   
        // Turn off transparency blending (temporarily)
        imagealphablending($image_resized, false);
   
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
   
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $color);
   
        // Restore transparency blending
        imagesavealpha($image_resized, true);
      }
    }

    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
 
    if ( $delete_original ) {
      if ( $use_linux_commands )
        exec('rm '.$file);
      else
        @unlink($file);
    }
   
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
	  	if($thumb_dir != ''){
			$output = str_replace($imageName,$thumb_dir."/".$imageName,$file);
		}else{
			$output = $file;
		}
        
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }

    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        imagegif($image_resized, $output);
      break;
      case IMAGETYPE_JPEG:
        imagejpeg($image_resized, $output,100);
      break;
      case IMAGETYPE_PNG:
        imagepng($image_resized, $output);
      break;
      default:
        return false;
    }

    return true;
  }




function getLastID($table){
	global $G_DB_CONNECT;
	$last_id = 1;
	
	
	/*
$sql = " SHOW TABLE STATUS LIKE '".$table."'";
$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$last_id = $data['Auto_increment'];
				
		}
	}

*/

$sql = "select id from  ".$table." order by id desc limit 0,1 ";
$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$last_id = $data['id']+1;
				
		}
	}


return $last_id;
	
	
	

}

function get_extension($from_file) {
		$ext = strtolower(strrchr($from_file,"."));
		return $ext;
}


function renewSortOrder($table,$condition){
	global $G_DB_CONNECT;
	if($condition !=''){
		$condition = " and ".$condition;
	}
	
	

	
	$sql = " select * from ".$table;
	$sql .= " where id>0 $condition and disabled<>'".DISABLED_DELETE."' ";
	$sql .= " order by sort_order asc,last_update_date desc ";
	
	
	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		$k = 0;
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$k++;
			$update_data = array();
			$update_data['sort_order'] = $k;
			$G_DB_CONNECT->query_update($table, $update_data, "id='".$data['id']."'"); 
			
			
		}
	}
	return $sort_order;
	
	
}



function getNextSortOrder($table,$condition,$have_parent_id=false,$old_parent_id=0,$id=0,$parent_id_field='',$parent_id=0){
	global $G_DB_CONNECT;
	$sort_order  = 1;
	if($condition !=''){
		$condition = " and ".$condition;
	}
	
	

	
	$sql = " select * from ".$table;
	$sql .= " where id>0 $condition  and disabled<>'".DISABLED_DELETE."'";
	$sql .= " order by sort_order desc limit 0,1 ";
	
	$original_sort_order = getDataName($table,'sort_order',$id);
	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$this_id = $data['id'];
			if($have_parent_id ){
				if($data['parent_product_category_id'] == $old_parent_id){
					$sort_order  = getDataName(TB_PRODUCT_CATEGORY,'sort_order',$id);
				}else{
					//if($this_id <> $id){
						$sort_order  = $data['sort_order'] + 1;
					//}
				}
			}else{
				if($this_id <> $id){
					if($data[$parent_id_field] <> $parent_id || $id == 0){
						$sort_order  = $data['sort_order']+1 ;
					}else {
						$sort_order  = $original_sort_order ;
					}
					
					
				}else{
					$sort_order  = $data['sort_order'] ;
				}
			}
		}
	}
	return $sort_order;
	
	
}


function webpageContent2($id,$lang = DEFAULT_FRONT_LANG_ID,$field = "detail"){

		return displayHTML(getLangName(TB_WEBPAGE,$field,$id,$lang ));
		
}

function webpageContent($id,$lang = DEFAULT_FRONT_LANG_ID,$field = "detail"){

		echo displayHTML(getLangName(TB_WEBPAGE,$field,$id,$lang ));
		
}


function displayHTML($incontent){
	$content = $incontent; 
	
/*
	$dirname = "newsite/";
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	*/
	
	
	$dirname = REWRITE_BASE2;
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	
	
	//$dirname = REWRITE_BASE2;
	
	
/*
		$from = array('winghinghtml');
		$to   = '../';
		$content = str_replace($from, $to, $content);
	
	
	*/
	
	
	$content = str_replace('&nbsp;', '##SPACE##', $content);

	//$content = html_entity_decode($content);
	
	$content = str_replace('##SPACE##', '&nbsp;', $content);
	
	
	$from = array("../");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	


	
	
	


	$from = array("&eacute;");
	$to   = '&#232;';
	$content = str_replace($from, $to, $content);
	


	
	$from = array("&gt;");
	$to   = '>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array("&lt;");
	$to   = '<';
	$content = str_replace($from, $to, $content);
	
	$from = array("../");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	
	$from = array("&#39;");
	$to   = "'";
	$content = str_replace($from, $to, $content);
	
	/*
	
	$content = str_replace('<p>', '', $content);
	$content = str_replace('</p>', '<br><br>', $content);
	*/
	

	
	
	


	/*
	
	$from = array("<p>&nbsp;</p>");
	$to   = '<br /><br />';
	$content = str_replace($from, $to, $content);
	
*/
	
	$from = array('<p class="content" aram');
	$to   = '<param';
	$content = str_replace($from, $to, $content);
	

	

	$from = array('\r\n','\r','\n');
	$to   = '';
	$content = str_replace($from, $to, $content);
	

	
	/*
	$from = array('"images/');
	$to   = '"../../images/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"files/');
	$to   = '"../../files/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"media/');
	$to   = '"../../media/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"flash/');
	$to   = '"../../flash/';
	$content = str_replace($from, $to, $content);
	
	*/
	
	$content = str_replace('""', '"', $content);
	
	

	/*
	$from = array("& amp;");
	$to   = " ";
	$content = str_replace($from, $to, $content);
	
	*/
	
	
	//$content = str_replace('src="images', 'src="../images', $content);
	
	
	$content = str_replace('&#34;', '"', $content);
	
	/*
	$from = 'src="images';
	$to   = 'src="../images';
	$content = str_replace($from, $to, $content);
	
$from = 'href="images';
	$to   = 'href="../images';
	$content = str_replace($from, $to, $content);
	*/
	$from = array('"images/');
	$to   = '"../images/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"files/');
	$to   = '"../files/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"media/');
	$to   = '"../media/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"flash/');
	$to   = '"../flash/';
	$content = str_replace($from, $to, $content);
	
	
	
	$from = '<div class="sidebar-line">&nbsp;</div>';
	$to   = '<div class="sidebar-line"><span></span></div>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('"..images/');
	$to   = '"../images/';
	$content = str_replace($from, $to, $content);
	
	
	
	$content = str_replace('""', '"', $content);
	
	
	
	
	$content = str_replace('alt=" ', '', $content);
	$content = str_replace('health_n_living/html/', '', $content);
	$content = str_replace('&quot;', '"', $content);
	
	
	
if(!(ADMIN_ID > 0)){
	
	$content = str_replace('src="/userfiles', 'src="userfiles', $content);
	$content = str_replace('src="upload', 'src="../upload', $content);
	$content = str_replace('src="upload', 'src="../upload', $content);
	$content = str_replace('src="userfiles', 'src="userfiles', $content);
}else{
	$content = str_replace('src="/userfiles', 'src="../../../../userfiles', $content);
	$content = str_replace('src="upload', 'src="../../../../upload', $content);
	$content = str_replace('src="upload', 'src="../../../../upload', $content);
	$content = str_replace('src="userfiles', 'src="../../../../userfiles', $content);
	
	
}
	
	
	return $content;
}


function displayHTML5($incontent){
	$content = $incontent; 
	
/*
	$dirname = "newsite/";
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	*/
	
	
	$dirname = REWRITE_BASE2;
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	
	
	//$dirname = REWRITE_BASE2;
	
	
/*
		$from = array('winghinghtml');
		$to   = '../';
		$content = str_replace($from, $to, $content);
	
	
	*/
	
	
	$content = str_replace('&nbsp;', '##SPACE##', $content);

	//$content = html_entity_decode($content);
	
	$content = str_replace('##SPACE##', '&nbsp;', $content);
	
	
	$from = array("../");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	


	
	
	


	$from = array("&eacute;");
	$to   = '&#232;';
	$content = str_replace($from, $to, $content);
	


	
	$from = array("&gt;");
	$to   = '>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array("&lt;");
	$to   = '<';
	$content = str_replace($from, $to, $content);
	
	$from = array("../");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	
	$from = array("&#39;");
	$to   = "'";
	$content = str_replace($from, $to, $content);
	
	/*
	
	$content = str_replace('<p>', '', $content);
	$content = str_replace('</p>', '<br><br>', $content);
	
	

	*/
	
	


	
	/*
	$from = array("<p>&nbsp;</p>");
	$to   = '<br /><br />';
	$content = str_replace($from, $to, $content);
	
*/
	
	$from = array('<p class="content" aram');
	$to   = '<param';
	$content = str_replace($from, $to, $content);
	

	

	$from = array('\r\n','\r','\n');
	$to   = '';
	$content = str_replace($from, $to, $content);
	

	

	
	$content = str_replace('""', '"', $content);
	
	

	/*
	$from = array("& amp;");
	$to   = " ";
	$content = str_replace($from, $to, $content);
	
	*/
	
	
	//$content = str_replace('src="images', 'src="../images', $content);
	
	
	$content = str_replace('&#34;', '"', $content);
	
	/*
	$from = 'src="images';
	$to   = 'src="../images';
	$content = str_replace($from, $to, $content);
	
$from = 'href="images';
	$to   = 'href="../images';
	$content = str_replace($from, $to, $content);
	*/
	$from = array('"images/');
	$to   = '"../images/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"files/');
	$to   = '"../files/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"media/');
	$to   = '"../media/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"flash/');
	$to   = '"../flash/';
	$content = str_replace($from, $to, $content);
	
	
	
	$from = '<div class="sidebar-line">&nbsp;</div>';
	$to   = '<div class="sidebar-line"><span></span></div>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('"..images/');
	$to   = '"../images/';
	$content = str_replace($from, $to, $content);
	
	
	
	$content = str_replace('""', '"', $content);
	
	
	
	
	$content = str_replace('alt=" ', '', $content);
	$content = str_replace('&quot;', '"', $content);
	
	
	
if(!(ADMIN_ID > 0)){
	
	$content = str_replace('src="/userfiles', 'src="../userfiles', $content);
	$content = str_replace('src="upload', 'src="../upload', $content);
	$content = str_replace('src="upload', 'src="../upload', $content);
	$content = str_replace('src="userfiles', 'src="../userfiles', $content);
}else{
	$content = str_replace('src="/userfiles', 'src="../../../../userfiles', $content);
	$content = str_replace('src="upload', 'src="../../../../upload', $content);
	$content = str_replace('src="upload', 'src="../../../../upload', $content);
	$content = str_replace('src="userfiles', 'src="../../../../userfiles', $content);
	
	
}
	
	
	return $content;
}


function displayHTMLm($incontent){
	$content = $incontent; 
	
/*
	$dirname = "newsite/";
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	*/
	
	
	$dirname = REWRITE_BASE2;
	
	
	if($dirname != '/'){
		$from = array($dirname);
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	
	
	//$dirname = REWRITE_BASE2;
	
	
/*
		$from = array('winghinghtml');
		$to   = '../';
		$content = str_replace($from, $to, $content);
	
	
	*/
	
	
	$content = str_replace('&nbsp;', '##SPACE##', $content);

	//$content = html_entity_decode($content);
	
	$content = str_replace('##SPACE##', '&nbsp;', $content);
	
	
	$from = array("../");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	


	
	
	


	$from = array("&eacute;");
	$to   = '&#232;';
	$content = str_replace($from, $to, $content);
	


	
	$from = array("&gt;");
	$to   = '>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array("&lt;");
	$to   = '<';
	$content = str_replace($from, $to, $content);
	
	$from = array("../");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	
	$from = array("&#39;");
	$to   = "'";
	$content = str_replace($from, $to, $content);
	
	
	
	$content = str_replace('<p>', '', $content);
	$content = str_replace('</p>', '<br><br>', $content);
	
	

	
	
	


	
	
	$from = array("<p>&nbsp;</p>");
	$to   = '<br /><br />';
	$content = str_replace($from, $to, $content);
	

	
	$from = array('<p class="content" aram');
	$to   = '<param';
	$content = str_replace($from, $to, $content);
	

	

	$from = array('\r\n','\r','\n');
	$to   = '';
	$content = str_replace($from, $to, $content);
	

	
	/*
	$from = array('"images/');
	$to   = '"../../images/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"files/');
	$to   = '"../../files/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"media/');
	$to   = '"../../media/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"flash/');
	$to   = '"../../flash/';
	$content = str_replace($from, $to, $content);
	
	*/
	
	$content = str_replace('""', '"', $content);
	
	

	/*
	$from = array("& amp;");
	$to   = " ";
	$content = str_replace($from, $to, $content);
	
	*/
	
	
	//$content = str_replace('src="images', 'src="../images', $content);
	
	
	$content = str_replace('&#34;', '"', $content);
	
	/*
	$from = 'src="images';
	$to   = 'src="../images';
	$content = str_replace($from, $to, $content);
	
$from = 'href="images';
	$to   = 'href="../images';
	$content = str_replace($from, $to, $content);
	*/
	$from = array('"images/');
	$to   = '"../images/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"files/');
	$to   = '"../files/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"media/');
	$to   = '"../media/';
	$content = str_replace($from, $to, $content);
	
	$from = array('"flash/');
	$to   = '"../flash/';
	$content = str_replace($from, $to, $content);
	
	
	
	
	
	$from = array('"..images/');
	$to   = '"../images/';
	$content = str_replace($from, $to, $content);
	
	
	
	$content = str_replace('""', '"', $content);
	
	
	
	
	$content = str_replace('alt=" ', '', $content);
	
	
	$content = preg_replace( '/(width|height)=("|\')\d*(|px)("|\')\s/', "", $content );
  
	
	return $content;
}


function printLangTextAreaOneRow($title,$input_name,$table,$id,$required=false,$height=800,$width="100%",$other=""){
global $G_DB_CONNECT;

	$out = '';
		
   	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " for_front_page = '1' ";
	$sql .= " order by default_front_lang desc, sort_order asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$this_lang_name = $data2['name'];
			$this_lang_id = $data2['id'];
			$this_default_front_lang = $data2['default_front_lang'];
			$label_lang = "";
			if($total_record > 1){
				$label_lang = "(".$this_lang_name.")";
			}
			
			
			$required_label = "";
			$required_val = "";
			if($this_default_front_lang == '1'){
					if($required){
						$required_val = "yes";
						$required_label = '<div id="require"></div>';
					}
			}
			
			$this_title = $title.' '.$label_lang;
			
			
			
			$this_field_name = $input_name."_".$this_lang_id;
			
			
   




$out .= '<tr>';
$out .= '<td class="title" style="padding:0">'.$this_title.'<br><br></td>';
$out .= '</tr>';

			
$out .= '<tr>';
$out .= '<td style="padding:0">';
	



$out .= '<textarea name="'.$this_field_name.'" id="'.$this_field_name.'" rows="10" cols="80" class="my_fckeditor">'.changeToHTMLRelativeFilePath2(getLangName($table,$input_name,$id,$this_lang_id)).'</textarea><br><br>';	

$out .= '<script type="text/javascript">';

$out .= "var sBasePath = '".DIR_PATH."includes/js/fckeditor/' ;";
$out .= "var oFCKeditor".$this_field_name." = new FCKeditor( '".$this_field_name."' ) ;";
$out .= "oFCKeditor".$this_field_name.".BasePath	= sBasePath ;";
$out .= "oFCKeditor".$this_field_name.".Config['AutoDetectLanguage'] = false ;";
$out .= "oFCKeditor".$this_field_name.".Config['DefaultLanguage']    = 'en' ;";
$out .= "oFCKeditor".$this_field_name.".Width	= '".$width."' ;";
$out .= "oFCKeditor".$this_field_name.".Height	= '".$height."' ;";
$out .= "oFCKeditor".$this_field_name.".ReplaceTextarea() ;";

$out .= '</script>';		
			
            		
					
					
$out .= '</td>';
$out .= '</tr>';




        

		}
		
   }

   
echo $out ;



}










function printLangTextArea($title,$input_name,$table,$id,$required=false,$height=300,$width="700",$other=""){
global $G_DB_CONNECT;

	$out = '';
		
   	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " for_front_page = '1' ";
	$sql .= " order by default_front_lang desc, sort_order asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$this_lang_name = $data2['name'];
			$this_lang_id = $data2['id'];
			$this_default_front_lang = $data2['default_front_lang'];
			$label_lang = "";
			if($total_record > 1){
				$label_lang = "(".$this_lang_name.")";
			}
			
			
			$required_label = "";
			$required_val = "no";
			if($this_default_front_lang == '1'){
					if($required){
						$required_val = "yes";
						$required_label = '<div id="require"></div>';
					}
			}
			
			$this_title = $title.' '.$label_lang;
			
			
			
			$this_field_name = $input_name."_".$this_lang_id;
			
			
   




$out .= '<tr>';

$out .= '<td class="sign_must_enter"  style="vertical-align:top"></td>';
$out .= '<td class="title" style="vertical-align:top">'.$this_title.'</td>';
//$out .= '</tr>';

			
//$out .= '<tr>';
$out .= '<td>';
	



$out .= '<textarea name="'.$this_field_name.'" id="'.$this_field_name.'" rows="10" cols="80" class="my_fckeditor">'.changeToHTMLRelativeFilePath2(getLangName($table,$input_name,$id,$this_lang_id)).'</textarea>	';	

$out .= '<script type="text/javascript">';

$out .= "var sBasePath = '".DIR_PATH."includes/js/fckeditor/' ;";
$out .= "var oFCKeditor".$this_field_name." = new FCKeditor( '".$this_field_name."' ) ;";
$out .= "oFCKeditor".$this_field_name.".BasePath	= sBasePath ;";
$out .= "oFCKeditor".$this_field_name.".Config['AutoDetectLanguage'] = false ;";
$out .= "oFCKeditor".$this_field_name.".Config['DefaultLanguage']    = 'en' ;";
$out .= "oFCKeditor".$this_field_name.".Width	= '".$width."' ;";
$out .= "oFCKeditor".$this_field_name.".Height	= '".$height."' ;";
$out .= "oFCKeditor".$this_field_name.".ReplaceTextarea() ;";

$out .= '</script>';		
			
            		
					
					
$out .= '</td>';
$out .= '</tr>';




        

		}
		
   }

   
echo $out ;



}









function printLangTextAreaNormal($title,$input_name,$table,$id,$required=false,$height="300",$width="700",$other="",$row_class=""){
global $G_DB_CONNECT;

	$out = '';
		
   	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " for_front_page = '1' ";
	$sql .= " order by default_front_lang desc, sort_order asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$this_lang_name = $data2['name'];
			$this_lang_id = $data2['id'];
			$this_default_front_lang = $data2['default_front_lang'];
			$label_lang = "";
			if($total_record > 1){
				$label_lang = "(".$this_lang_name.")";
			}
			
			
			$required_label = "";
			$required_val = "";
			if($this_default_front_lang == '1'){
					if($required){
						$required_val = ' required="yes" ';
						$required_label = '<div id="require"></div>';
					}
			}
			
			$this_title = $title.' '.$label_lang;
			
			
			
			$this_field_name = $input_name."_".$this_lang_id;
			
			
   




$out .= '<tr '.$row_class.'>';

$out .= '<td class="sign_must_enter"  style="vertical-align:top">'.$required_label.'</td>';
$out .= '<td class="title" style="vertical-align:top">'.$this_title.'</td>';
//$out .= '</tr>';

			
//$out .= '<tr>';
$out .= '<td>';
	



$out .= '<textarea name="'.$this_field_name.'" id="'.$this_field_name.'"   class="input_long" style="width:'.$width.'px;height:'.$height.'px" '.$required.' label="'.$title.'">'.removeHTMLTag(getLangName($table,$input_name,$id,$this_lang_id)).'</textarea>	';	
/*
$out .= '<script type="text/javascript">';

$out .= "var sBasePath = '".DIR_PATH."includes/js/fckeditor/' ;";
$out .= "var oFCKeditor".$this_field_name." = new FCKeditor( '".$this_field_name."' ) ;";
$out .= "oFCKeditor".$this_field_name.".BasePath	= sBasePath ;";
$out .= "oFCKeditor".$this_field_name.".Config['AutoDetectLanguage'] = false ;";
$out .= "oFCKeditor".$this_field_name.".Config['DefaultLanguage']    = 'en' ;";
$out .= "oFCKeditor".$this_field_name.".Width	= '".$width."' ;";
$out .= "oFCKeditor".$this_field_name.".Height	= '".$height."' ;";
$out .= "oFCKeditor".$this_field_name.".ReplaceTextarea() ;";

$out .= '</script>';		
			
           */ 		
					
					
$out .= '</td>';
$out .= '</tr>';




        

		}
		
   }

   
echo $out ;



}






function printLangTextAreaNormalNoLang($title,$input_name,$required=false,$height="300",$width="700",$other="",$this_value=""){
global $G_DB_CONNECT;

	$out = '';
		
   	
		
			
			$required_label = "";
			$required_val = "";
			
			if($required){
				$required_val = ' required="yes" ';
				$required_label = '<div id="require"></div>';
			}
			
			
			$this_title = $title;
			
			
			
			$this_field_name = $input_name;
			
			
   




$out .= '<tr>';

$out .= '<td class="sign_must_enter"  style="vertical-align:top; padding-top:10px;">'.$required_label.'</td>';
$out .= '<td class="title" style="vertical-align:top; padding-top:10px;">'.$this_title.'</td>';
//$out .= '</tr>';

			
//$out .= '<tr>';
$out .= '<td>';
	



$out .= '<textarea name="'.$this_field_name.'" id="'.$this_field_name.'"   class="input_long my_fckeditor" style="width:'.$width.'px;height:'.$height.'px" '.$required_val.' label="'.$title.'">'.$this_value.'</textarea>	';	
/*
$out .= '<script type="text/javascript">';

$out .= "var sBasePath = '".DIR_PATH."includes/js/fckeditor/' ;";
$out .= "var oFCKeditor".$this_field_name." = new FCKeditor( '".$this_field_name."' ) ;";
$out .= "oFCKeditor".$this_field_name.".BasePath	= sBasePath ;";
$out .= "oFCKeditor".$this_field_name.".Config['AutoDetectLanguage'] = false ;";
$out .= "oFCKeditor".$this_field_name.".Config['DefaultLanguage']    = 'en' ;";
$out .= "oFCKeditor".$this_field_name.".Width	= '".$width."' ;";
$out .= "oFCKeditor".$this_field_name.".Height	= '".$height."' ;";
$out .= "oFCKeditor".$this_field_name.".ReplaceTextarea() ;";

$out .= '</script>';		
			
           */ 		
		   
$out .= '<script type="text/javascript">';

$out .= "var sBasePath = '".DIR_PATH."includes/js/fckeditor/' ;";
$out .= "var oFCKeditor".$this_field_name." = new FCKeditor( '".$this_field_name."' ) ;";
$out .= "oFCKeditor".$this_field_name.".BasePath	= sBasePath ;";
$out .= "oFCKeditor".$this_field_name.".Config['AutoDetectLanguage'] = false ;";
$out .= "oFCKeditor".$this_field_name.".Config['DefaultLanguage']    = 'en' ;";
$out .= "oFCKeditor".$this_field_name.".Width	= '".$width."' ;";
$out .= "oFCKeditor".$this_field_name.".Height	= '".$height."' ;";
$out .= "oFCKeditor".$this_field_name.".ReplaceTextarea() ;";

$out .= '</script>';		
					
					
$out .= '</td>';
$out .= '</tr>';




        


   
echo $out ;



}








function updateClientDefaultPassword(){
	global $G_DB_CONNECT;
	$sql = "select m.* from ".TB_MEMBER." as m ";
	$sql .= " where ";
	$sql .= " m.role_id='4' ";
	$sql .= " group by m.id  ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$update_data['password'] = md5($data['home_no']);
					$G_DB_CONNECT->query_update(TB_MEMBER, $update_data, "id='".$data['id']."'"); 
			}
	}
	
}

function updateOldOrderCode(){
global $G_DB_CONNECT;
	
	
	$sql = "select order_temp.* from ".TB_ORDER_TEMP." as order_temp  where id>2892 order by code asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				
					$code  = $data['code'];
					$id  = $data['id'];
					$update_data['member_id'] = getMIDFromOrderNo($code);
					$update_data['recieve_order_date'] = '2010-11-17';
					$update_data['recieve_order_date_time'] = '1';
					$update_data['due_date'] = '2010-11-17';
					$update_data['due_date_time'] = '2';
					$update_data['order_status'] = 4;
					if($update_data['member_id'] > 0){
						$G_DB_CONNECT->query_update(TB_ORDER_TEMP, $update_data, "id='".$id ."'"); 
					}else{
						echo $code."<br>";
					}
					
					
			}
	}
	
	
}




function installOldOrderToTempTable($order_list,$recieve_order_date,$recieve_order_date_time,$due_date,$due_date_time){
	global $G_DB_CONNECT;
	
	/*
	$sql = "select order_temp.* from ".TB_ORDER_TEMP." as order_temp  where id>2892 order by code asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
	*/
	$arr_order =  explode("\r\n", $order_list);
	for ($i=0; $i<count($arr_order); $i++) {
					
					$code  = trim($arr_order[$i]);
					//echo "<br>";
			if($code != ''){
					//$id  = $data['id'];
					$update_data['code'] = $code;
					$update_data['member_id'] = getMIDFromOrderNo($code);
					$update_data['recieve_order_date'] = $recieve_order_date;
					$update_data['recieve_order_date_time'] = $recieve_order_date_time;
					$update_data['due_date'] = $due_date;
					$update_data['due_date_time'] = $due_date_time;
					$update_data['order_status'] = 4;
					if($update_data['member_id'] > 0){
						$sql = "select order_temp.* from ".TB_ORDER_TEMP." as order_temp  where code  = '$code' limit 0,1 ";
						$rows2 = $G_DB_CONNECT->query($sql);
						if($G_DB_CONNECT->affected_rows > 0){
							$G_DB_CONNECT->query_update(TB_ORDER_TEMP, $update_data, "code='".$code."'"); 
						}else{
							$G_DB_CONNECT->query_insert(TB_ORDER_TEMP, $update_data); 
						}
						//$G_DB_CONNECT->query_update(TB_ORDER_TEMP, $update_data, "id='".$id ."'"); 
					}else{
						echo "Member not exist : ".$code."<br>";
					}
			}
	}
					
	/*
			}
	}
	*/
	
	
}






function createOrderFromOldOrderNo(){
	global $G_DB_CONNECT;

	
	
	$sql = "select order_temp.* from ".TB_ORDER_TEMP."  as order_temp where member_id > 0  and id>=4000 order by recieve_order_date asc, recieve_order_date_time asc";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$code  = $data['code'];
					$update_data['member_id']  = $data['member_id'];

					////////////////////////////////////////////////////////////
					$update_data['recieve_order_date'] = $data['recieve_order_date'];
					$update_data['recieve_order_date_time'] = $data['recieve_order_date_time'];
					$update_data['due_date'] = $data['due_date'];
					$update_data['due_date_time'] = $data['due_date_time'];
					$update_data['order_status'] = $data['order_status'];
					////////////////////////////////////////////////////////////
			
					
					$sql = "select * from ".TB_ORDER."  ";
					$sql .= " where ";
				echo	$sql .= " code = '$code' limit 0,1";
				echo "<br>";
					$rows2 = $G_DB_CONNECT->query($sql);
					if($G_DB_CONNECT->affected_rows > 0){
						
							$G_DB_CONNECT->query_update(TB_ORDER, $update_data, "  code = '$code'   "); 
					}else{
						
						createSpecialOrder($code,$update_data['member_id'],$update_data['recieve_order_date'],$update_data['recieve_order_date_time'],$update_data['due_date'],$update_data['due_date_time'],$update_data['order_status']);
					}
					
					
					
					
			}
	}
	
	
	
	
	
	
	
	
}



function getMIDFromOrderNo($code){
	global $G_DB_CONNECT;
	$sql = "select m.* from ".TB_MEMBER." as m where SUBSTRING(code,1,4)=SUBSTRING('$code',1,4)  ";
	$rows = $G_DB_CONNECT->query($sql);
	$member_id = 0;
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					 $member_id = $data['id'];
			}
	}
	return $member_id;
	
}

function getDayOfThisWeek($in_date){

$date = getdate(strtotime($in_date));

return $date['wday'];

}


function getAllowSectionIDList($role_id){
	$section_list = '';
	$parent_section_list= '';
	global $G_DB_CONNECT;
	
	
if($role_id == '1'){
	
	$sql = " select id as section_id,parent_section_id from ".TB_SECTION." as section  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			if($section_list != ''){
				$section_list .= ",";
			}
			$section_list .= $data['section_id'];
			
			if($data['parent_section_id'] > 0  ){
				if($parent_section_list != ''){
					$parent_section_list .= ",";
				}
				$parent_section_list .= $data['parent_section_id'];
			}
		}
	}

	
	
	
}else{
	
	$sql = " select access_right.section_id,section.parent_section_id from ".TB_ACCESS_RIGHT." as access_right ,  ".TB_SECTION." as section  ";
	$sql.= " where access_right.section_id=section.id ";
	$sql.= " and role_id='$role_id' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			if($section_list != ''){
				$section_list .= ",";
			}
			$section_list .= $data['section_id'];

			if($data['parent_section_id'] > 0  ){
				if($parent_section_list != ''){
					$parent_section_list .= ",";
				}
				$parent_section_list .= $data['parent_section_id'];
				
			}
		}
	}
	
	
	
		
	$sql = " select id as section_id,parent_section_id from ".TB_SECTION." as section where show_in_left_menu='0'  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			if($section_list != ''){
				$section_list .= ",";
			}
			$section_list .= $data['section_id'];
			
			if($data['parent_section_id'] > 0  ){
				if($parent_section_list != ''){
					$parent_section_list .= ",";
				}
				$parent_section_list .= $data['parent_section_id'];
			}
		}
	}
	
	

}

	$arr_data['section_list'] = $section_list;
	$arr_data['parent_section_list'] = $parent_section_list;
	
	$out = $section_list;
	if($out != ''){
		$out .= ",".$parent_section_list;
	}
	
	
	$out = $out.",,";
	$out = str_replace(",,,","",$out);
	$out = str_replace(",,","",$out);
	
	
	
	return $out;
	
	
}



function getRequestVarList($field_name){
	
	$arr_other_price_desc = getRequestVar($field_name,'');
	$other_price_desc = '';
	if($arr_other_price_desc  != ''){
			for ($i=0; $i<count($arr_other_price_desc); $i++) {
				if($other_price_desc != ''){
					$other_price_desc .= DATA_SEPARATOR;
				}
				$other_price_desc .= $arr_other_price_desc[$i];
				
				
			}
			//$update_data['other_price_desc'] = $other_price_desc;

	}
	return $other_price_desc;
}


function sumPriceList($price_list){
	
		$total = 0;
		$arr_other_price_desc =  explode(DATA_SEPARATOR, $price_list);
		for ($i=0; $i<count($arr_other_price_desc); $i++) {
				
				$total  += $arr_other_price_desc[$i];
				
				
		}
			//$update_data['other_price_desc'] = $other_price_desc;

	
	return $total;
}


function addDate($in_date,$add_date='+1 day'){
	
	$date_to_time = strtotime($in_date);
 	$date = strtotime($add_date,$date_to_time);
	return date('Y-m-d', $date);
}




function getStartDateOfThisMonth($date){

	

	return  substr($date,0,8).'01';


}
	


function getEndDateOfThisMonth($date){

	$next_month_date = addDate(getStartDateOfThisMonth($date),'+1 month');

	return  $end_month_date = addDate($next_month_date,'-1 day');


}
	

/*
function printCheckBoxGroup($sql,$field_id,$store_record_id,$store_record_table_id,$store_record_table,$store_record_table_field_id,$num_col = 2){
global $G_DB_CONNECT;
	$out = '';
    $out .='<table border="0" cellspacing="0" cellpadding="0" id="table_text">';
    


	
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
			$c = 0;

			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			
			$c++;
				$this_id = $data2['id'];
					
				
				$checked = "";
				if( haveRecord($store_record_table," ".$store_record_table_field_id." ='$this_id' and ".$store_record_table_id."='".$store_record_id."'") > 0     ){
					$checked = "checked";
				}



	if($c%$num_col == 1){

 $out .='<tr>';


	}


$out .='<td><input name="'.$field_id.'[]" id="'.$field_id.'[]" value="'.$this_id.'" '.$checked.' type="checkbox" class="'.$field_id.'"/></td>';

 $out .='<td style="padding:0px 20px 0px 10px;">'.$data2['name'].'</td>';

	if($c%$num_col == 0 || $c == $total_record){

$out .='</tr>';

	}





		}
	 }
 

$out .='</table>';




echo $out;

}
*/






function printLangInputField($title,$input_name,$table,$id,$field,$required=false,$class="input_middle",$other="",$hide=false,$row_class=""){
global $G_DB_CONNECT;

	$out = '';
		
   	$sql = "select language.* from ".TB_LANGUAGE." as language ";
	$sql .= " where ";
	$sql .= " for_front_page = '1' ";
	$sql .= " order by default_front_lang desc, sort_order asc ";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows ;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$this_lang_name = $data2['name'];
			$this_lang_id = $data2['id'];
			$this_default_front_lang = $data2['default_front_lang'];
			$label_lang = "";
			if($total_record > 1){
				$label_lang = "(".$this_lang_name.")";
			}
			
			
			$required_label = "";
			$required_val = "";
			if($this_default_front_lang == '1'){
					if($required){
						$required_val = ' required="yes" ';
						$required_label = '<div id="require"></div>';
					}
			}
			
			$this_title = $title.' '.$label_lang;
   
   
if($hide){
	

	$required_label = '';
	
	$out .= '<tr '.$row_class.'>';
$out .= '<td class="sign_must_enter">'.$required_label.'</td>';
$out .= '<td class="title">'.$this_title.'</td>';
$out .= '<td><input  name="'.$input_name.'_'.$this_lang_id.'" id="'.$input_name.'_'.$this_lang_id.'"  value="'.getLangName($table,$field,$id,$this_lang_id).'" label="'.$this_title.'"  class="'.$class.'" '.$required_val.' '.$other.' type="hidden"/>'.getLangName($table,$field,$id,$this_lang_id).'</td>';
$out .='</tr>';
	
	
	
	
}else{
   
$out .= '<tr '.$row_class.'>';
$out .= '<td class="sign_must_enter">'.$required_label.'</td>';
$out .= '<td class="title">'.$this_title.'</td>';
$out .= '<td><input  name="'.$input_name.'_'.$this_lang_id.'" id="'.$input_name.'_'.$this_lang_id.'"  value="'.getLangName($table,$field,$id,$this_lang_id).'" label="'.$this_title.'"  class="'.$class.'" '.$required_val.' '.$other.'/></td>';
$out .='</tr>';
}

		}
		
   }

   
echo $out ;



}




function printCustomListFromArray($field_id,$arr_option_list,$default_value = '', $other = ''){

		if($_REQUEST[$field_id] == ''){
			$_REQUEST[$field_id] = $default_value;
		}


		$out = '<select id="'.$field_id.'" name="'.$field_id.'" '.$other.' >';
	
       foreach ($arr_option_list  as $key => $value ) {
			$k = 0;
			$this_name = "";
			$this_value = "";
		   	foreach ($value as $key2 => $value2 ) { 
		   		$k++;
		   		//$out .= '<br>'; 
                //$out .= $key2.'  :  ' . $value2; 
				if($k == 1){
					$this_name = $value2;
				}else if($k == 2){
					$this_value = $value2;
				}
		   
		   }
		   
		   $selected = "";
		   if($_REQUEST[$field_id] == $this_value){
		   		 $selected = "selected";
		   }
		  
		   
		   $out .= '<option value="'.$this_value.'"  '. $selected.'>';
		   $out .= $this_name;
		   $out .= "</option>";
		
       }  
	   
	   
	$out .= "</select>";
	
	echo $out;

	
	
	
}


	
function defineTableName($print=false){
global $G_DB_CONNECT;

define('DEFINED_TABLE_PREFIX', "TB_");
$sql = "SHOW TABLE STATUS";
$rows = $G_DB_CONNECT->query($sql);
if($G_DB_CONNECT->affected_rows > 0){
	while($data = $G_DB_CONNECT->fetch_array($rows)){
		$table = $data['Name'];
		$no_prefix_table = str_replace(REAL_TABLE_PREFIX, "", $table);

		if($print){
			$out .= "define('".DEFINED_TABLE_PREFIX.strtoupper($no_prefix_table)."','".$table."');"."<br>";
		}
		$key = DEFINED_TABLE_PREFIX.strtoupper($no_prefix_table);
		//$_POST[$key] = $table;
		${define($key,$table)} ;
	}
}
	$out;
	if($print){
			echo $out;
	}
}


function defineSystemConfig($print=false){
	global $G_DB_CONNECT;
	
	$sql = "select * from ".TB_CONFIG;

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					define($data["constant_name"],$data["constant_value"]);
			}
		
	}

}




function getTableName($table_name_with_no_prefix){
	return REAL_TABLE_PREFIX.$table_name_with_no_prefix;
}


function login($username,$password){
	global $G_DB_CONNECT;
	$_SESSION['already_login'] = false;
	$username = mysqli_real_escape_string($G_DB_CONNECT->conn,$username);
	$password = mysqli_real_escape_string($G_DB_CONNECT->conn,$password);
	
	$sql = "select m.*,role.right_level from ".TB_MEMBER." as m, ".TB_ROLE." as role ";
	$sql .= " where ";
	$sql .= " m.role_id=role.id ";
	//$sql .= " m.id='".$_SESSION['login_mid']."'";
	$sql .= " and m.username='$username' and m.password='".md5($password)."' ";
	$sql .= " and m.expiry_date >'".TODAY."' and m.disabled='0' and role.allow_login_admin='1' ";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$_SESSION['login_mid'] = $data['id'];
					$_SESSION['already_login'] = true;
					$update_data['last_login_date'] = NOW;
					$G_DB_CONNECT->query_update(TB_MEMBER, $update_data, "id='".$_SESSION['login_mid']."'" ); 
					log_login($data['id']);
			}
			return true;
			
	}
	return false;
}



function log_login($member_id){
	global $G_DB_CONNECT;
	$update_data = array();
	$update_data['member_id'] = $member_id;
	$update_data['ip'] = getRealIpAddr();
	$update_data['create_date'] = 'null';
	$G_DB_CONNECT->query_insert(TB_LOG_LOGIN, $update_data);
		
}



function log_product_qty($member_id,$shop_id,$product_id,$qty,$old_qty,$add_qty = 0,$reduce_qty = 0){
	global $G_DB_CONNECT;
	if(($qty+$add_qty-$reduce_qty+0) != $old_qty){
		$update_data = array();
		$update_data['member_id'] = $member_id;
		$update_data['ip'] = getRealIpAddr();
		$update_data['create_date'] = 'null';
		$update_data['shop_id'] = $shop_id;
		$update_data['product_id'] = $product_id;
		$update_data['qty'] = $qty+$add_qty-$reduce_qty+0;
		$update_data['add_qty'] = $add_qty;
		$update_data['old_qty'] = $old_qty;
		$update_data['reduce_qty'] = $reduce_qty;
		$G_DB_CONNECT->query_insert(TB_LOG_PRODUCT_QTY, $update_data);
	}
		
}


function getRealIpAddr()  {  

	if (!empty($_SERVER['HTTP_CLIENT_IP']))    {  
		//check ip from share internet 
       $ip=$_SERVER['HTTP_CLIENT_IP'];  
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    {  
		//to check ip is pass from proxy
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];  
    } else  {  
       $ip=$_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
	
}  


function member_login($username,$password){
	global $G_DB_CONNECT;
	$_SESSION['falready_login'] = false;
	$username = mysqli_real_escape_string($G_DB_CONNECT->conn,$username);
	$password = mysqli_real_escape_string($G_DB_CONNECT->conn,$password);
	
	$sql = "select m.*,role.right_level from ".TB_MEMBER." as m, ".TB_ROLE." as role ";
	$sql .= " where ";
	$sql .= " m.role_id=role.id ";
	//$sql .= " m.id='".$_SESSION['login_mid']."'";
	$sql .= " and m.username='$username' and m.password='".md5($password)."' ";
	$sql .= " and m.expiry_date >'".TODAY."' and m.disabled='0'  and role.allow_login_front='1' ";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$_SESSION['flogin_mid'] = $data['id'];
					$_SESSION['falready_login'] = true;
					$update_data['last_login_date'] = NOW;
					$G_DB_CONNECT->query_update(TB_MEMBER, $update_data, "id='".$_SESSION['flogin_mid']."'" ); 
					
					
					$G_DB_CONNECT->query("update ".TB_CART." set member_id='".$_SESSION['flogin_mid']."' where session_id='".SESSION_ID."' "); 
					
			}
			return true;
	}
	return false;
}





function changePassword($old_password,$password){
	global $G_DB_CONNECT;
	$member_id = $_SESSION['login_mid'];
	$password = mysqli_real_escape_string($G_DB_CONNECT->conn,$password);
	
	$sql = "select m.*,role.right_level from ".TB_MEMBER." as m, ".TB_ROLE." as role ";
	$sql .= " where ";
	$sql .= " m.role_id=role.id ";
	//$sql .= " m.id='".$_SESSION['login_mid']."'";
	$sql .= " and m.id='$member_id' and m.password='".md5($old_password)."' ";
	$sql .= " and m.expiry_date >'".TODAY."' and m.disabled='0' and role.allow_login_admin='1' ";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			//while($data = $G_DB_CONNECT->fetch_array($rows)){
					$data['password'] = md5($password);
					$G_DB_CONNECT->query_update(TB_MEMBER, $data, "id='$member_id'" ); 
			//}
			return true;
	}
	return false;
}


function changePasswordf($old_password,$password){
	global $G_DB_CONNECT;
	$member_id = $_SESSION['flogin_mid'];
	$password = mysqli_real_escape_string($G_DB_CONNECT->conn,$password);
	
	$sql = "select m.*,role.right_level from ".TB_MEMBER." as m, ".TB_ROLE." as role ";
	$sql .= " where ";
	$sql .= " m.role_id=role.id ";
	//$sql .= " m.id='".$_SESSION['login_mid']."'";
	$sql .= " and m.id='$member_id' and m.password='".md5($old_password)."' ";
	$sql .= " and m.expiry_date >'".TODAY."' and m.disabled='0' and role.allow_login_front='1' ";
	//$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			//while($data = $G_DB_CONNECT->fetch_array($rows)){
					$data['password'] = md5($password);
					$G_DB_CONNECT->query_update(TB_MEMBER, $data, "id='$member_id'" ); 
			//}
			return true;
	}
	return false;
}



function getRequestVarArray($string) {
    if (is_string($string)) {
      return trim(stripslashes($string));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = getRequestVarArray($value);
      }
      return $string;
    } else {
      return $string;
    }
}




function getRequestVar($Var,$default =''){   
		
	
		if(   isset($_REQUEST[$Var])  && $_REQUEST[$Var] != ''  ){
			return formatStringForSQL(getRequestVarArray($_REQUEST[$Var]));
		}else{
			return formatStringForSQL($default);
		}
		
}

function getCreateUpdateInfo($create_date,$create_by,$last_update_date,$last_update_by){
	global $G_DB_CONNECT;
	
	
	/////////////////////////////////////////////////////////////
	$sql = "select m.* from ".TB_MEMBER." as m ";
	$sql .= " where ";
	$sql .= " m.id='$create_by' ";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$create_by_member = $data['username'];
			}
	}
	/////////////////////////////////////////////////////////////
	
	/////////////////////////////////////////////////////////////
	$sql = "select m.* from ".TB_MEMBER." as m ";
	$sql .= " where ";
	$sql .= " m.id='$last_update_by' ";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$last_update_by_member = $data['username'];
			}
	}
	/////////////////////////////////////////////////////////////
	
	
	$out = "";
	
	/*
	$out .= $create_date."<br>";
	$out .= BY." ".$create_by_m." ".CREATE."<br>";
	$out .= $last_update_date."<br>";
	$out .= BY." ".$last_update_by_m." ".MODIFY;
	*/
	$out .= $create_date."<br>";
	$out .= CREATE." ".BY." ".$create_by_m."<br>";
	$out .= $last_update_date."<br>";
	$out .= MODIFY." ".BY." ".$last_update_by_member;
	
	return $out;
}
  
  
function getCreateInfo($create_date,$create_by){
	global $G_DB_CONNECT;
	
	
	/////////////////////////////////////////////////////////////
	$sql = "select m.* from ".TB_MEMBER." as m ";
	$sql .= " where ";
	$sql .= " m.id='$create_by' ";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$create_by_member = $data['username'];
			}
	}
	/////////////////////////////////////////////////////////////
	


	
	$out = "";
	
	
	$out .= $create_date;
	//$out .= " ".BY." ".$create_by_m." ".CREATE;
	$out .= BY." ".$create_by_member;

	
	return $out;
}
  
  
  
  
  
  
  
function getUpdateInfo($last_update_date,$last_update_by){
	global $G_DB_CONNECT;
	
	
	
	
	/////////////////////////////////////////////////////////////
	$sql = "select m.* from ".TB_MEMBER." as m ";
	$sql .= " where ";
	$sql .= " m.id='$last_update_by' ";
	$sql .= " group by m.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$last_update_by_member = $data['username'];
			}
	}
	/////////////////////////////////////////////////////////////
	
	
	$out = "";
	
	

	$out .= $last_update_date;
	//$out .= " ".BY." ".$last_update_by_m." ".MODIFY;
	$out .= BY." ".$last_update_by_member;
	
	return $out;
}
  
  
  
  
  
  
function getLangName($table,$getfield,$id,$language_id=ADMIN_LANG_ID){
	global $G_DB_CONNECT;
	
	
	/////////////////////////////////////////////////////////////
	$sql = "select tb_desc.".$getfield." as name from ".$table." as tb , ".$table."_desc as tb_desc ";
	$sql .= " where ";
	$sql .= " tb.id=tb_desc.".str_replace(REAL_TABLE_PREFIX,'',$table)."_id ";
	
	$sql .= " and tb.id='$id' and tb_desc.language_id='$language_id' ";
	
	$sql .= " group by tb.id  ";
	$sql .= " order by tb.sort_order asc limit 0,1  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					return  displayHTML($data['name']);
			}
	}
	/////////////////////////////////////////////////////////////

}
  
  
  
function getDataName($table,$getfield,$id,$other_condition = ''){
	global $G_DB_CONNECT;
	if($other_condition != ''){
		$other_condition = "  ".$other_condition;
	}
	
	
	/////////////////////////////////////////////////////////////
	$sql = "select tb.".$getfield." as name from ".$table." as tb ";
	$sql .= " where ";
	//$sql .= "  tb.id > 0  ";
	
	if($other_condition == ''){
		$sql .= "    tb.id='$id'  ";
	}else{
		$sql .= $other_condition;
	}
	
	if($other_condition == ''){
		$sql .= " group by tb.id  ";
	}
	 $sql .= " limit 0,1  ";
	

	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					return  $data['name'];
			}
	}
	/////////////////////////////////////////////////////////////

}



function formatStringForSQL($instrong){
	$originalSizeString = $instrong;
	
	$ReplaceFrom = array("'",'"');
	$ReplaceTo  = array("&#39;","&#34;");

	$newSizeString = str_replace($ReplaceFrom, $ReplaceTo, $originalSizeString);
	return $newSizeString;
}












//////////////////////////////////////
	// For Generate menu in form
	//////////////////////////////////////
	function printCustomMenu($Menuidname, $sql,$needField,$defaultid, $selectedid='',$events='',$NoneLabel='',$NoneValue='',$need="no",$other_list=""){
	global $G_DB_CONNECT;
	
	$required= '';
	if($need=="yes"){
		$required= ' required="yes"';
		
	}
	

		echo "<select id=\"$Menuidname\"  name=\"$Menuidname\"  $events $required >";
			
			
		if(!($NoneLabel == '' && $NoneValue == '')){
			echo "<option value=\"".$NoneValue. "\"  " ;
			
			if($selectedid == ''){
				echo "selected";
			}
			
			echo "  >";
			echo $NoneLabel;
			echo "</option>";
		}
			
			
			
			
		 $haveSelected = false;
		 

//$result = mysqli_query($sql);
		//while ( $data = mysqli_fetch_array($result)) {
			
						
	$rows = $G_DB_CONNECT->query($sql);
	//if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$id = $data['id'];
			$local = $data['local'];
			//echo $selectedid." : " .$id;
			echo '<option value="'.$id. '" local="'.$local.'" ' ;
			if($selectedid != ''){
				if($selectedid == $id && !$haveSelected){
					echo "selected";
					$haveSelected = true;
				}
			}else if ($defaultid == $id  && !$haveSelected){
			
				echo "selected";
				$haveSelected = true;
			}
			
			echo "  >";

			

			//echo $data['name'];
			echo $data[$needField];
			echo "</option>";
			
		}
		
		
		if($other_list != ''){
		
			
			$out = "";
		
			if($_REQUEST[$field_id] == ''){
				$_REQUEST[$field_id] = $default_value;
			}
		
		
			foreach ($other_list  as $key => $value ) {
			$k = 0;
			$this_name = "";
			$this_value = "";
		   	foreach ($value as $key2 => $value2 ) { 
		   		$k++;
		   		//$out .= '<br>'; 
                //$out .= $key2.'  :  ' . $value2; 
				if($k == 1){
					$this_name = $value2;
				}else if($k == 2){
					$this_value = $value2;
				}
		   
		   }
		   
		   $selected = "";
		   if($_REQUEST[$field_id] == $this_value){
		   		 $selected = "selected";
		   }
		  
		   
		   $out .= '<option value="'.$this_value.'"  '. $selected.'>';
		   $out .= $this_name;
		   $out .= "</option>";
		   echo $out;
		
       }  
		
		
		
		
		
		}



	
	 	echo  "</select>";
	}



function printCustomMenuProduct($Menuidname, $sql,$needField,$defaultid, $selectedid='',$events='',$NoneLabel='',$NoneValue='',$need="no",$other_list=""){
	global $G_DB_CONNECT;
	
	$required= '';
	if($need=="yes"){
		$required= ' required="yes"';
		
	}
	

		echo "<select id=\"$Menuidname\"  name=\"$Menuidname\"  $events $required >";
			
			
		if(!($NoneLabel == '' && $NoneValue == '')){
			echo "<option value=\"".$NoneValue. "\"  " ;
			
			if($selectedid == ''){
				echo "selected";
			}
			
			echo "  >";
			echo $NoneLabel;
			echo "</option>";
		}
			
			
			
			
		 $haveSelected = false;
		 


//$result = mysqli_query($sql);
		//while ( $data = mysqli_fetch_array($result)) {
			
						
	$rows = $G_DB_CONNECT->query($sql);
	//if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$id = $data['id'];
			$local = $data['local'];
			//echo $selectedid." : " .$id;
			
			
			$arr_product_price_data =  getFinalProductPriceData($id);
			$price = $arr_product_price_data['old_price'];
			$special_price = $arr_product_price_data['price'];
			$final_price = $price;
			if($special_price > 0 && $special_price<$price){
				$final_price = $special_price;
			}
		if($final_price == 0){
			continue;
		}
			
			echo '<option value="'.$id. '" local="'.$local.'"     price="'.$price.'"   special_price="'.$special_price.'"   final_price="'.$final_price.'"          ' ;
			if($selectedid != ''){
				if($selectedid == $id && !$haveSelected){
					echo "selected";
					$haveSelected = true;
				}
			}else if ($defaultid == $id  && !$haveSelected){
			
				echo "selected";
				$haveSelected = true;
			}
			
			echo "  >";

			

			//echo $data['name'];
			echo $data[$needField]. " HKD".formatPrice($final_price);
			echo "</option>";
			
		}
		
		
		if($other_list != ''){
		
			
			$out = "";
		
			if($_REQUEST[$field_id] == ''){
				$_REQUEST[$field_id] = $default_value;
			}
		
		
			foreach ($other_list  as $key => $value ) {
			$k = 0;
			$this_name = "";
			$this_value = "";
		   	foreach ($value as $key2 => $value2 ) { 
		   		$k++;
		   		//$out .= '<br>'; 
                //$out .= $key2.'  :  ' . $value2; 
				if($k == 1){
					$this_name = $value2;
				}else if($k == 2){
					$this_value = $value2;
				}
		   
		   }
		   
		   $selected = "";
		   if($_REQUEST[$field_id] == $this_value){
		   		 $selected = "selected";
		   }
		  
		   
		   $out .= '<option value="'.$this_value.'"  '. $selected.'>';
		   $out .= $this_name;
		   $out .= "</option>";
		   echo $out;
		
       }  
		
		
		
		
		
		}



	
	 	echo  "</select>";
	}


//////////////////////////////////////
	// For Generate menu in form
	//////////////////////////////////////
	function returnCustomMenu($Menuidname, $sql,$needField,$defaultid, $selectedid='',$events='',$NoneLabel='',$NoneValue='',$need="no",$other_list=""){
global $G_DB_CONNECT;
		$out = '';
		$out .= "<select id=\"$Menuidname\"  name=\"$Menuidname\"  $events required='$need'>";
			
			
		if(!($NoneLabel == '' && $NoneValue == '')){
			$out .= "<option value=\"".$NoneValue. "\"  " ;
			
			if($selectedid == ''){
				$out .= "selected";
			}
			
			$out .= "  >";
			$out .= $NoneLabel;
			$out .= "</option>";
		}
			
			
			
			
		 $haveSelected = false;
		 

//$result = mysqli_query($sql);
		//while ( $data = mysqli_fetch_array($result)) {
			
						
	$rows = $G_DB_CONNECT->query($sql);
	//if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$id = $data['id'];
			//echo $selectedid." : " .$id;
			$out .= "<option value=\"".$id. "\" " ;
			if($selectedid != ''){
				if($selectedid == $id && !$haveSelected){
					$out .= "selected";
					$haveSelected = true;
				}
			}else if ($defaultid == $id  && !$haveSelected){
			
				$out .= "selected";
				$haveSelected = true;
			}
			
			$out .= "  >";

			

			//echo $data['name'];
			$out .= $data[$needField];
			$out .= "</option>";
			
		}
		
		
		if($other_list != ''){
		
			
			$out2 = "";
		
			if($_REQUEST[$field_id] == ''){
				$_REQUEST[$field_id] = $default_value;
			}
		
		
			foreach ($other_list  as $key => $value ) {
			$k = 0;
			$this_name = "";
			$this_value = "";
		   	foreach ($value as $key2 => $value2 ) { 
		   		$k++;
		   		//$out .= '<br>'; 
                //$out .= $key2.'  :  ' . $value2; 
				if($k == 1){
					$this_name = $value2;
				}else if($k == 2){
					$this_value = $value2;
				}
		   
		   }
		   
		   $selected = "";
		   if($_REQUEST[$field_id] == $this_value){
		   		 $selected = "selected";
		   }
		  
		   
		   $out2 .= '<option value="'.$this_value.'"  '. $selected.'>';
		   $out2 .= $this_name;
		   $out2 .= "</option>";
		   $out .= $out2;
		
       }  
		
		
		
		
		
		}



	
	 	$out .=  "</select>";
		
		return $out;
	}





function updateAllDisable($t1,$selected_id,$arr_disabled,$condition = ''){
	global $G_DB_CONNECT;
		if($condition != ''){
			$condition = " and ".$condition;
		}
		if($selected_id != ''){
			for ($i=0; $i<count($selected_id); $i++) {
         		$id = $selected_id[$i];
				$disabled = $arr_disabled[$i];
				$data['disabled'] = $disabled;
				$G_DB_CONNECT->query_update($t1, $data, "   id='$id'   ".$condition ); 
				
			}
		}
}





function updateFieldDataFromTable($t1,$field_name,$selected_id,$disabled,$condition = ''){
		
		global $G_DB_CONNECT;
		if($condition != ''){
			$condition = " and ".$condition;
		}
		if($selected_id != ''){
			for ($i=0; $i<count($selected_id); $i++) {
         		
				$id = $selected_id[$i];
				$disabled = $disabled;
				$data[$field_name] = $disabled;
				
				$G_DB_CONNECT->query_update($t1, $data, "   id='$id'   ".$condition ); 
				
				
			}
		}
	
		
}


function handlePaymentStatus($payment_id,$new_payment_status_id){
	global $G_DB_CONNECT;
	
	$old_payment_status_id = 0;
	$returned_qty = 0;
	//////////////////////////////////////////////
	$sql = "SELECT payment_status_id,returned_qty  FROM ".TB_PAYMENT." as payment ";
	$sql .= " where ";
	$sql .= " id = '".$payment_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$old_payment_status_id = $data['payment_status_id'];
				$returned_qty = $data['returned_qty'];
			}
	}
	//////////////////////////////////////////////
	$old_return_qty_type = getDataName(TB_PAYMENT_STATUS,"return_qty_type",$old_payment_status_id);
	$new_return_qty_type = getDataName(TB_PAYMENT_STATUS,"return_qty_type",$new_payment_status_id);
	//////////////////////////////////////////////
	// 1 mean return
	// 2 mean reduce
	
	if($old_return_qty_type != $new_return_qty_type){
		if(  !($old_return_qty_type == 0 || $new_return_qty_type  == 0  )  ){
			switch($new_return_qty_type){
				case '2':
					reduceAllItemQty($payment_id);
				break;
				case '1':
					returnAllItemQty($payment_id);
				break;
				default:
				break;
			}
		}else if ($old_return_qty_type == 0){
			switch($new_return_qty_type){
				case '2':
					reduceAllItemQty($payment_id);
				break;
				case '1':
					returnAllItemQty($payment_id);
				break;
				default:
				break;
			}
			
		}else if ($new_return_qty_type == 0){
			switch($old_return_qty_type){
				case '2':
					reduceAllItemQty($payment_id);	
				break;
				case '1':
					reduceAllItemQty($payment_id);	
				break;
				default:
				break;
			}
			
			
		}
		
			
	}
	
	//////////////////////////////////////////////
	
}

function updatePaymentStatusGroup($selected_id,$new_payment_status_id){
		global $G_DB_CONNECT;

		if($selected_id != ''){
			for ($i=0; $i<count($selected_id); $i++) {
				$payment_id = $selected_id[$i];
				handlePaymentStatus($payment_id,$new_payment_status_id);
				$data = array();
				$data['payment_status_id'] = $new_payment_status_id;
				$G_DB_CONNECT->query_update(TB_PAYMENT, $data, "   id='".$payment_id."'   " ); 
				
				
			}
		}
	
		
}

function updateCoursePaymentStatusGroup($selected_id,$new_payment_status_id){
		global $G_DB_CONNECT;

		if($selected_id != ''){
			for ($i=0; $i<count($selected_id); $i++) {
				$payment_id = $selected_id[$i];
				handlePaymentStatus($payment_id,$new_payment_status_id);
				$data = array();
				$data['payment_status_id'] = $new_payment_status_id;
				$G_DB_CONNECT->query_update(TB_COURSE_PAYMENT, $data, "   id='".$payment_id."'   " ); 
				reduceCourseQTY($payment_id);
				
			}
		}
	
		
}

function updateConstant(){
		
		
	$update_data = array();
	$update_data['constant_id'] = getRequestVar('constant_id','');	
	$selected_id = $update_data['constant_id'];
		
		
		global $G_DB_CONNECT;

		if($selected_id != ''){
			for ($i=0; $i<count($selected_id); $i++) {
         		
				$id = $selected_id[$i];
				$data['constant_value'] = $_REQUEST['constant_value'.$id];
				
				$G_DB_CONNECT->query_update(TB_CONFIG, $data, "   id='$id'   "); 
				
				
			}
		}
	
		
}







function nextRecordcode($table,$condition,$codeFirstCharacter,$LenOfNum){
global $G_DB_CONNECT;
		if($condition != ''){
			$condition = " and ".$condition;
		}
		$sql = "SELECT count(*) as total  FROM $table where id > 0 and disabled<>'".DISABLED_DELETE."'  $condition order by id DESC limit 0,1";
		/*
		$restemp = mysql_query($sql);
		$nextcode_Num = 1;
		while ($datatemp = mysql_fetch_array($restemp)){
			$nextcode_Num = $datatemp['id'] + 1;
			break;
		}
		*/
		$nextcode_Num = 1;
		////////////////////////////////
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				//$nextcode_Num = $data['id'] + 1;
				$nextcode_Num = $data['total'] + 1;
				break;
				
			}
		}
		
		////////////////////////////////
		$code = generateRecordcode($codeFirstCharacter,$LenOfNum,$nextcode_Num);
		//////////////////////////////////
		$num_records = 0;
		$count = 0;
		do{	
			$count++;
			if($count > 1){
				$nextcode_Num++;
				$code = generateRecordcode($codeFirstCharacter,$LenOfNum,$nextcode_Num);
			}
		
		
			$num_records = getNumOfThisRecord($table," code ='$code'  $condition");
		}while($num_records != 0);
		
		
		
		
		
		
		return $code;
	}
	
	

function generateProductCode($product_brand_code=''){
	
	return nextRecordcode2(TB_PRODUCT," code like '".$product_brand_code."%' and disabled <> '".DISABLED_DELETE."'  ",$product_brand_code,6);
}
	
	
function nextRecordcode2($table,$condition,$codeFirstCharacter,$LenOfNum){
global $G_DB_CONNECT;


		if($condition != ''){
			$condition = " and ".$condition;
		}
		$sql = "SELECT  code   FROM $table where id > 0  $condition order by id DESC limit 0,1 ";
		/*
		$restemp = mysql_query($sql);
		$nextcode_Num = 1;
		while ($datatemp = mysql_fetch_array($restemp)){
			$nextcode_Num = $datatemp['id'] + 1;
			break;
		}
		*/
		$nextcode_Num = 1;
		////////////////////////////////
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				//$nextcode_Num = $data['id'] + 1;
				$temp = str_replace($codeFirstCharacter,"",$data['code']);
				
				//$temp = substr($data['code'],);
				
				$nextcode_Num = intval($temp) + 1;
			}
		}
		 
		
		
		//echo "nextcode_Num".$nextcode_Num;
		
		////////////////////////////////
		
		$code = generateRecordcode($codeFirstCharacter,$LenOfNum,$nextcode_Num);
		//////////////////////////////////
		/*
		$condition = $condition." and code = '".$code."' ";
		$sql = "SELECT code  FROM $table where id > 0  $condition   ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			
			$code = nextRecordcode2($table,$condition,$codeFirstCharacter,$LenOfNum,$code);
			
		}
		*/
		$num_records = 0;
		$count = 0;
		do{	
			$count++;
			if($count > 1){
				$nextcode_Num++;
				$code = generateRecordcode($codeFirstCharacter,$LenOfNum,$nextcode_Num);
			}
		
		
			$num_records = getNumOfThisRecord($table," code ='$code'  $condition");
		}while($num_records != 0);
		
		
		
		
		
		return $code;
	}
	
	
	
function generateRecordcode($FirstLetter,$NumberLen,$insort_order){
		
		$newNumLen = strlen($insort_order);
		$NumZero = $NumberLen - $newNumLen;
		$strZero = '';
		
		for ($i=1; $i<=$NumZero; $i++){
			$strZero .= "0";
		}
	
		$newcode = $FirstLetter.$strZero.$insort_order;
		
		return $newcode;
		
	}







function getNumOfThisRecord($table,$condition){
global $G_DB_CONNECT;
		if($condition != ''){
			$condition = " and ".$condition;
		}
$num_records = 0;
		$sql = "SELECT count(*) as total  FROM $table where id>0  $condition  ";
	
	//	$rows = $G_DB_CONNECT->query($sql);
		//$num_records = $G_DB_CONNECT->affected_rows;
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$num_records = $data['total'] ;
			}
		}
		
	
	

		
		
		
		
		
		return $num_records;
	}
	
	
	
function haveRecord($table,$condition){
global $G_DB_CONNECT;
		

	$sql = "SELECT *  FROM $table where  $condition  ";
	
		$rows = $G_DB_CONNECT->query($sql);
		$num_records = $G_DB_CONNECT->affected_rows;
	
	

		
		
		
		
		
		return $num_records;
	}
	




function my_json_encode($phparr,$path=''){
global $G_DB_CONNECT;

    if(function_exists("json_encode"))
    {
      return json_encode($phparr);
    }
    else
    {
      require_once($path.DIR_LIB.'classes/json/JSON.php');
      $json = new Services_JSON;
      return $json->encode($phparr);
    }
}
















function getClientInfo($id){
	global $G_DB_CONNECT;
	$price = 0;
	$out = "";
	/////////////////////////////////////////////////////////////
	$sql = "select * from ".TB_MEMBER." as m ";

	
	$sql .= "  where id='".$id."' ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$out .= $data['code'];
					$out .= " ".$data['company_name'];
			}
	}
	/////////////////////////////////////////////////////////////
	return $out ;
	
}



function getClientInfo2($id){
	global $G_DB_CONNECT;
	$price = 0;
	$out = "";
	/////////////////////////////////////////////////////////////
	$sql = "select * from ".TB_MEMBER." as m ";

	
	$sql .= "  where id='".$id."' ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					
					$out .= $data['company_name'];
			}
	}
	/////////////////////////////////////////////////////////////
	return $out ;
	
}



function getMemberInfo($id){
	global $G_DB_CONNECT;
	$price = 0;
	$out = "";
	/////////////////////////////////////////////////////////////
	 $sql = "select m.id as id,  CONCAT(m.username)  name from ".TB_MEMBER." as m ";

	
	$sql .= "  where id='".$id."' ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					//$out .= $data['code'];
					$out = $data['name'];
			}
	}
	/////////////////////////////////////////////////////////////
	return $out ;
	
}



function nextOrderCode($table,$condition,$codeFirstCharacter,$LenOfNum){
global $G_DB_CONNECT;
		if($condition != ''){
			$condition = " and ".$condition;
		}
		$sql = "SELECT *  FROM $table where id > 0  $condition order by id DESC limit 0,1 ";
		/*
		$restemp = mysql_query($sql);
		$nextcode_Num = 1;
		while ($datatemp = mysql_fetch_array($restemp)){
			$nextcode_Num = $datatemp['id'] + 1;
			break;
		}
		*/
		$nextcode_Num = 1;
		////////////////////////////////
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$nextcode_Num = substr($data['code'],strlen($codeFirstCharacter)+1,$LenOfNum) + 1;
			}
		}
		
		////////////////////////////////
		$code = generateRecordcode($codeFirstCharacter,$LenOfNum,$nextcode_Num);
		//////////////////////////////////
		$num_records = 0;
		$count = 0;
		do{	
			$count++;
			if($count > 1){
				$nextcode_Num++;
				$code = generateRecordcode($codeFirstCharacter,$LenOfNum,$nextcode_Num);
			}
		
		
			$num_records = getNumOfThisRecord($table," code ='$code'  $condition ");
		}while($num_records != 0);
		
		
		
		
		
		
		return $code;
	}
	
	



function createOrderCode($member_id){
	$code = '';
	if($member_id > 0){
		$member_code = getDataName(TB_MEMBER,"code",$member_id);
		$code = nextOrderCode(TB_ORDER," member_id='$member_id'  ",$member_code,6);
	}else{
		$code = nextOrderCode(TB_ORDER,"",'',10);
	}
	
	return $code;
}




function nextPaymentcode($member_id=''){
	//nextPaymentcode('payment',"   Date(create_date)='$today'    ",$today );
	global $G_DB_CONNECT;
	$table = TB_INVOICE;
	$today = date('Y-m-d');
	$condition = "   Date(create_date)='$today'    ";
	$this_date = $today;
	
	
		if($condition != ''){
			$condition = " and ".$condition;
		}
		$sql = "SELECT *  FROM $table where id > 0  $condition  order by id DESC limit 0,1 ";
		$rows = $G_DB_CONNECT->query($sql);
		$nextcode_Num = 1;
if($G_DB_CONNECT->affected_rows > 0){
	while($datatemp = $G_DB_CONNECT->fetch_array($rows)){
			//$nextcode_Num = $datatemp['id'] + 1;
			$nextcode_Num = substr($datatemp['code'],8,3)+ 1;
			break;
	}
}
		
		////////////////////////////////
		/////////////////////////////////////
				//$today = substr($this_date,0,4).substr($this_date,5,2).substr($this_date,8,2);
				$today = substr($this_date,0,4).substr($this_date,5,2).substr($this_date,8,2);
				//echo "today :".$today;
				$code = generateRecordcode($today,3,$nextcode_Num);
				/////////////////////////////////////
		//////////////////////////////////
		$num_records = 0;
		$count = 0;
		do{	
			$count++;
			if($count > 1){
				$nextcode_Num++;
				/////////////////////////////////////
				//$today = $this_date;
				
				$code = generateRecordcode($today,3,$nextcode_Num);
				/////////////////////////////////////
				//$code = generateRecordcode($codeFirstCharacter,$LenOfNum,$nextcode_Num);
			}
		
		
			$num_records = getNumOfThisRecord($table," code ='$code'  $condition");
		}while($num_records != 0);
		
		
		
		
		
		
		return $code;
	}






function getCurrentTimePeriod(){
	if(date('H')+0 <= 12){
		return 1;
	}else{
		return 2;
	}
}




function printHiddenInputField($id,$value){
	$out = "";



	$out = "<input name=\"".$id."\" id=\"".$id."\"  value=\"".$value."\"  type=\"hidden\" />";
	return $out;
}




function printInputField($id,$value,$label='',$class='',$default='',$required=false,$other='',$maxlength = 30,$class_group_for_jquery='form_input_group'){
	$out = "";

	//if($class != ''){
		$class= ' class="'.$class.' '.$class_group_for_jquery.'" ';
	//}

	if($default != ''){
		$default= ' default="'.$default.'" ';
	}
	
	if($required){
		$required = ' required="yes" ';
	}else{
	}
	
	
	if($maxlength > 0){
		$maxlength = ' maxlength="'.$maxlength.'" ';
	}
	
	$out = "<input name=\"".$id."\" id=\"".$id."\"  value=\"".$value."\"   label=\"".$label."\" $class $default $other $required $maxlength />";
	return $out;
}









function printCheckBoxGroup($sql,$field_id,$num_col=4,$selected_id_group='',$required='no',$label='',$atleast_check_num = 1){
	global $G_DB_CONNECT;
	$out = "";
	$arr_selected_id_group = explode(",", $selected_id_group);
	
	$class_checkbox = $field_id;
	$class_checkbox_all = $field_id."_all";
	$class_handle_checkbox_group = "class_handle_checkbox_group";
	$this_field_name_all = $field_id."_all";

	
	$out .= '<table width="0" border="0" cellspacing="0" cellpadding="0" id="table_text">';
 


	
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
			//$num_col = 4;
			$k = 0;
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$k++;
					$this_id = $data['id'];
					$this_name = $data['name'];
					$this_field_name = $field_id."[]";
					
					
					$checked = "";
					if($selected_id_group != ''){
						if (in_array($this_id , $arr_selected_id_group)) {
							$checked = "checked";
							
						}
					}
				
				
				if($required == 'yes'){
						$required = ' required="yes" ';
					}


	if($k == 1){
		$out .= '<tr>';
		  $out .= '<td><input name="'.$this_field_name_all.'" id="'.$this_field_name_all.'" value="'.$this_id.'"  type="checkbox" class="'.$class_handle_checkbox_group.'"   class_checkbox_group="'.$class_checkbox.'" atleast_check_num="'.$atleast_check_num.'" label="'.$label.MSG_AT_LEAST_P1.$atleast_check_num.MSG_AT_LEAST_P2.'"  '.$required.'/></td>';
  		 $out .= '<td style="padding-left:10px;padding-right:30px; padding-top:2px;" colspan="'.($num_col-1).'"><span class="highlight">'.TITLE_CHECK_ALL.'</span></td>';
		$out .= '</tr>';
	}


	if($k % $num_col == 1){

 		$out .= '<tr>';

	}

 
   $out .= '<td><input name="'.$this_field_name.'" id="'.$this_field_name.'" value="'.$this_id.'"  type="checkbox" '.$checked.'  class="'.$class_checkbox.'"/></td>';
   $out .= '<td style="padding-left:10px;padding-right:30px; padding-top:2px;">'.$this_name.'</td>';
  
  
  

	if($k % $num_col == 0){

		$out .= '</tr>';

	}




	}
}








	$out .= '</table>';
	echo $out;



}











function printCheckBoxGroup2Level($sql,$field_id,$num_col=4,$selected_id_group='',$required='no',$label='',$atleast_check_num = 1){
	global $G_DB_CONNECT;
	$out = "";
	$arr_selected_id_group = explode(",", $selected_id_group);
	
	$class_checkbox = $field_id;
	$class_checkbox_all = $field_id."_all";
	$class_handle_checkbox_group = "class_handle_checkbox_group";
	$this_field_name_all = $field_id."_all";

	
	$out .= '<table width="0" border="0" cellspacing="0" cellpadding="0" id="table_text">';
 


	
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
			//$num_col = 4;
			$k = 0;
			while($data = $G_DB_CONNECT->fetch_array($rows)){
					$k++;
					$this_id = $data['id'];
					$this_name = $data['parent_category_name']. " &gt; ".$data['name'];
					$this_field_name = $field_id."[]";
					
					
					$checked = "";
					if($selected_id_group != ''){
						if (in_array($this_id , $arr_selected_id_group)) {
							$checked = "checked";
							
						}
					}
					
					
					if($required == 'yes'){
						$required = ' required="yes" ';
					}
				


	if($k == 1){
		$out .= '<tr>';
		  $out .= '<td><input name="'.$this_field_name_all.'" id="'.$this_field_name_all.'" value="'.$this_id.'"  type="checkbox" class="'.$class_handle_checkbox_group.'"   class_checkbox_group="'.$class_checkbox.'" atleast_check_num="'.$atleast_check_num.'" label="'.$label.MSG_AT_LEAST_P1.$atleast_check_num.MSG_AT_LEAST_P2.'"  '.$required.'/></td>';
  		 $out .= '<td style="padding-left:10px;padding-right:30px; padding-top:2px;" colspan="'.($num_col-1).'"><span class="highlight">'.TITLE_CHECK_ALL.'</span></td>';
		$out .= '</tr>';
	}


	if($k % $num_col == 1){

 		$out .= '<tr>';

	}

 
   $out .= '<td><input name="'.$this_field_name.'" id="'.$this_field_name.'" value="'.$this_id.'"  type="checkbox" '.$checked.'  class="'.$class_checkbox.'"/></td>';
   $out .= '<td style="padding-left:10px;padding-right:30px; padding-top:2px;">'.$this_name.'</td>';
  
  
  

	if($k % $num_col == 0){

		$out .= '</tr>';

	}




	}
}








	$out .= '</table>';
	echo $out;



}



function convert2StringGroup($group_id){
	if($group_id != ''){
		$str_group_id = implode(",", $group_id);
	}
	return $str_group_id;
}





function getCategoryID($cid='',$pid=''){
	
	global $G_DB_CONNECT;

//$arr_data = array();
	
if($cid != ''){
	 $sql = "select product_category.id as id,product_category.parent_product_category_id as parent_product_category_id, product_category_desc.name as name from ".TB_PRODUCT_CATEGORY." as product_category , ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	$sql .= " product_category.id=product_category_desc.product_category_id ";
	$sql .= " and product_category_desc.language_id='".CURRENT_LANG."' ";
	//$sql .= " and product_category.parent_product_category_id = '0' ";
	$sql .= " and product_category.disabled='0' ";
	$sql .= " and product_category.id='$cid' ";
	$sql .= " group by product_category.id  ";
	$sql .= " order by parent_product_category_id asc,product_category.sort_order asc limit 0,1 ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$parent_product_category_id = $data['parent_product_category_id'];
				$product_category_id = $data['id'];
				if($parent_product_category_id == 0 ){
						 $sql = "select product_category.id as id,product_category.parent_product_category_id as parent_product_category_id, product_category_desc.name as name from ".TB_PRODUCT_CATEGORY." as product_category , ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	$sql .= " product_category.id=product_category_desc.product_category_id ";
	$sql .= " and product_category_desc.language_id='".CURRENT_LANG."' ";
	//$sql .= " and product_category.parent_product_category_id = '0' ";
	$sql .= " and product_category.disabled='0' ";
	$sql .= " and product_category.parent_product_category_id='$product_category_id' ";
	$sql .= " group by product_category.id  ";
	$sql .= " order by parent_product_category_id asc,product_category.sort_order asc limit 0,1 ";
						$rows2 = $G_DB_CONNECT->query($sql);
						if($G_DB_CONNECT->affected_rows > 0){
							while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
								$parent_product_category_id = $data2['parent_product_category_id'];
								$product_category_id = $data2['id'];
							}
						}
					
				}
			}
	}
	
}
	
	
	
	
//////////////////////////////////////////////////////////////////////////////////////
if($pid != ''){
	
	$sql = "select product.product_category_id,product.id as id, product_desc.name as name from ".TB_PRODUCT." as product , ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.id=product_desc.product_id ";
	$sql .= " and product_desc.language_id='".CURRENT_LANG."' ";
	//$sql .= " and product_category.parent_product_category_id = '0' ";
	$sql .= " and product.disabled='0' ";
	$sql .= " and product.id='$pid' ";
	$sql .= " group by product.id  ";
	$sql .= " limit 0,1 ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$product_category_id = $data['product_category_id'];
				$arr_data_category = getCategoryID($product_category_id);
				$parent_product_category_id = $arr_data_category['parent_product_category_id'];
			}
	}
}
	
	
	
//////////////////////////////////////////////////////////////////////////////////////	
	
	$arr_data['parent_product_category_id'] = $parent_product_category_id;
	$arr_data['product_category_id'] = $product_category_id;
	return $arr_data;
	
}





function getProductSQL($cid='',$pid='',$condition = ''){
	
	/*
	$sql = "select product.*,product_desc.name as name,product_desc.detail as detail  ";
	
	//$sql .= ",CONCAT( (select name from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id=product_category.parent_product_category_id), '<br> ',product_category_desc.name) as category ";
	$sql .= ",product_category_desc.name as category ";
	
	//$sql .= ",(select sum(qty) from ".TB_PRODUCT_COLOR_SIZE_QTY." where product_id=product.id group by product_id) as qty ";
	
	$sql .= " from ".TB_PRODUCT." as product, ".TB_PRODUCT_DESC." as product_desc, ".TB_PRODUCT_CATEGORY." as product_category, ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	$sql .= " product.id = product_desc.product_id ";
	$sql .= " and product_category.id = product_category_desc.product_category_id ";
	$sql .= " and product_category.id = product.product_category_id ";
	$sql .= " and product_category_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and product_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and product.disabled = '0' ";
	
	*/
	
	
	$sql = "select product.*,product_desc.seo_title as seo_title,product_desc.seo_desc as seo_desc,product_desc.name as name,product_desc.detail as detail,product_desc.composition as composition,product_desc.otherinfo as otherinfo,product_desc.size_and_fit as size_and_fit from ".TB_PRODUCT." as product, ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.id = product_desc.product_id ";
	//$sql .= " and CONCAT(',',product.product_category_id,',')  like  '%,".$this_id.",%' ";
	//$sql .= " and product.new_product = '1' ";
	$sql .= " and product.disabled = '0' ";
	$sql .= " and product_desc.language_id = '".CURRENT_LANG."'";
	//$sql .= " order by product.sort_order asc limit 0,1  ";
	
	
	
	
	
if($cid != ''){
	//$sql .= " and product.product_category_id = '".$cid."' ";
	$sql .= " and CONCAT(',',product.product_category_id,',')  like  '%,".$cid.",%' ";
}
if($pid != ''){
	$sql .= " and product.id = '".$pid."' ";
}

if($condition != ''){
	$sql .= " and $condition ";
}

	
	$sql .= " group by product.id  ";
	
	return $sql;
	
	
	
	
}






function getLangFile($table,$lang,$condition){
	global $G_DB_CONNECT;
	
	if($condition != ''){
		$condition = " and ".$condition;
	}
	
	$arr_data = array();
	$arr_data['file'] = '';
	$arr_data['id'] = '';
	
	$sql = "select * from ".$table." as tb_file  ";
	$sql .= " where ";
	$sql .= " language_id='".$lang."' ";
	$sql .= $condition;
	$sql .= " and disabled = '0' ";
	$sql .= " order by sort_order asc ";
	$sql .= " limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$arr_data['file'] =  $data2['file'];
					$arr_data['id'] =  $data2['id'];
			}
	}
	
	return $arr_data;
}








function displayUserDisabled($disabled){
	$out = "";
	$text  = getLangName(TB_STATUS_ALLOW,"name",$disabled);
	if($disabled == '1'){
		$style = "color:#CCCCCC;";
	}else {
		$style = "";
	}
	
	$out = '<span style="'.$style.'">'.$text.'</span>';
	return $out;
	
}




function displayDisabled($disabled,$other_text = "",$have_status_text_too = true){
	$out = "";
	$text  = getLangName(TB_STATUS_DISABLE,"name",$disabled);
	if($disabled == '1'){
		$style = "color:#CCCCCC;";
	}else {
		$style = "color:#d93a16;font-weight:bold";
		//$style = "color:#333333;font-weight:bold";
	}
	
	if(!$have_status_text_too){
		$text = "";
	}
	
	$out = '<span style="'.$style.'">'.$other_text.$text.'</span>';
	return $out;
	
}

function displayYesNo($disabled,$other_text = "",$have_status_text_too = true){
	$out = "";
	$text  = getLangName(TB_STATUS_YESNO,"name",$disabled);
	if($disabled == '1'){
		$style = "color:#d93a16;font-weight:bold";
		//$style = "color:#333333;font-weight:bold";
	}else {
		$style = "color:#CCCCCC;";
		
	}
	
	if(!$have_status_text_too){
		$text = "";
	}
	
	$out = '<span style="'.$style.'">'.$other_text.$text.'</span>';
	return $out;
	
}






function getDefaultCurrency($lang=ADMIN_LANG_ID){

	global $G_DB_CONNECT;
	
	$arr_data = array();

	
	$sql = "select currency.*,currency_desc.name as name from ".TB_CURRENCY." as currency, ".TB_CURRENCY_DESC." as currency_desc ";
	$sql .= " where ";
	$sql .= " currency.id = currency_desc.currency_id ";
	$sql .= " and currency_desc.language_id = '".$lang."'";
	$sql .= " and currency.default_ratio='1' ";
	$sql .= " group by currency.id  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$arr_data['id'] = $data['id']; 
			$arr_data['sign'] = $data['sign']; 
			$arr_data['symbol'] = $data['symbol']; 
			$arr_data['ratio'] = $data['ratio']; 
			$arr_data['name'] = $data['name']; 
		}
	}
	
	
	return $arr_data;
	
	
}





function printColorBox($color="000000",$width=20,$height=20){
	
	if(strstr($this_request_var_name, "#") == ''){
		$color = "#".$color;
	}
	
	
	$out = "";

	$out .= '<div style="background-color:'.$color.';padding:0;margin-right:10px;border:1px #999999 solid;width:'.$width.'px;height:'.$height.'px;"></div>';

	
	return $out;
	
}

function setUpperFirstChar($str){
	return ucfirst(strtolower($str));
}





/*
function getFinalProductPriceData($pid){
	global $G_DB_CONNECT;
	
	$price = 0;
	$special_price = 0;
	$price_desc = '';
	$price_desc_detail = '';
	
	
	
	$sql = "select product.*,product_desc.name as name  ";
	
	//$sql .= ",CONCAT( (select name from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id=product_category.parent_product_category_id), '<br> ',product_category_desc.name) as category ";
	
	
	$sql .= ",(select sum(qty) from ".TB_PRODUCT_COLOR_SIZE_QTY." where product_id=product.id group by product_id) as qty ";
	
	$sql .= " from ".TB_PRODUCT." as product, ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.id = product_desc.product_id ";
	//$sql .= " and product_category.id = product_category_desc.product_category_id ";
	//$sql .= " and product_category.id = product.product_category_id ";
	//$sql .= " and product_category_desc.language_id = '".CURRENT_LANG."'";
	//$sql .= " and product_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and product.disabled = '0' ";
	$sql .= " and product.id = '".$pid."' ";
	$sql .= $search_condition;
	$sql .= " group by product.id  ";
	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				
				$product_price = priceWithCurrenyRatio($data['price']);
				$product_special_price = priceWithCurrenyRatio($data['special_price']);
			
			}
	}
	
	////////////////////////////////////////
	if($product_special_price > 0){
		$price = $product_special_price;
		$price_desc = '<span class="special_price">'.displayPriceOnly2($product_special_price).'</span> (was '.displayPriceOnly2($product_price).')';
	}else{
		$price = $product_price;
		$price_desc = displayPriceOnly2($product_price);
	}
	////////////////////////////////////////
	$price_desc_detail = displayPriceOnly2($price);
	$arr_data['price'] = $price;
	$arr_data['price_desc'] = $price_desc;
	$arr_data['price_desc_detail'] = $price_desc_detail;
	return $arr_data;

	
	
}

*/





function getProductPriceOtherList($product_id,$before_other_list_price){
	/*
	$out = '';
	$buy_qty = '';
	$each_price = '';
	$cart_qty = '';
	$arr_data= array();
	$arr_data["have_other_qty_price"] = false;
	$arr_data["price"] = 0;;
	
	
	global $G_DB_CONNECT;
	///////////////////////////////////////////////////////////////
	$sql = "select sum(qty) as qty  from ".TB_CART;
	$sql .= " where product_id='".$product_id."'";
	$sql .= " and session_id='".SESSION_ID."'";
	$sql .= " group by product_id ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$cart_qty = $data['qty'];
		}
	}
	///////////////////////////////////////////////////////////////
	

if($cart_qty > 0){
	///////////////////////////////////////////////////////////////
	$temp_price = 0;
	$remaining_qty = $cart_qty;
	
	
do{
	$sql = "select * from ".TB_PRODUCT_PRICE_OTHERLIST;
	$sql .= " where product_id='".$product_id."'";
	$sql .= " and buy_qty <= '".$remaining_qty."'";
	$sql .= " order by buy_qty desc limit 0,1 ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$buy_qty = $data['buy_qty'];
			$each_price= priceWithCurrenyRatio($data['each_price']);
			///////////////////////////////////////////////////////////////
			
			$total_other_price_qty = floor($remaining_qty/$buy_qty);
			$temp_price += $total_other_price_qty*$buy_qty*$each_price+0;
			$remaining_qty = $remaining_qty - $total_other_price_qty*$buy_qty;
			
			
		}
		
		
	
		
	}
	///////////////////////////////////////////////////////////////
	
	///////////////////////////////////////////////////////////////
	$sql = "select * from ".TB_PRODUCT_PRICE_OTHERLIST;
	$sql .= " where product_id='".$product_id."'";
	$sql .= " and buy_qty <= '".$remaining_qty."'";
	$sql .= " order by buy_qty desc limit 0,1 ";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	
	
	
	
	///////////////////////////////////////////////////////////////
}while($total_record > 0);
//cho $temp_price . " : " .$remaining_qty;
if($temp_price > 0){
	$temp_price = $temp_price + $remaining_qty*$before_other_list_price;

	$arr_data["price"] = $temp_price/$cart_qty;
	$arr_data["have_other_qty_price"] = true;
}






}

	
	
	
		
	*/
	
	
	
	
	return $arr_data;
	
	
	
	
	
}



function getFinalProductPriceData($pid,$product_size_id=0,$normal=false,$product_color_id=0,$product_special_offer_id=0){
	global $G_DB_CONNECT;
	$product_id=$pid;
	$price = 0;
	$special_price = 0;
	$price_desc = '';
	$price_desc_detail = '';
	$old_price = 0;
	$final_price = 0;
	$in_stock = 0;
	
	$low_price = 0;
	$product_id=$pid;

	
	/*
	$sql = "select product.*,product_desc.name as name  ";
	
	//$sql .= ",CONCAT( (select name from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id=product_category.parent_product_category_id), '<br> ',product_category_desc.name) as category ";
	
	
	$sql .= ",(select sum(qty) from ".TB_PRODUCT_COLOR_SIZE_QTY." where product_id=product.id group by product_id) as qty ";
	
	$sql .= " from ".TB_PRODUCT." as product, ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.id = product_desc.product_id ";
	//$sql .= " and product_category.id = product_category_desc.product_category_id ";
	//$sql .= " and product_category.id = product.product_category_id ";
	//$sql .= " and product_category_desc.language_id = '".CURRENT_LANG."'";
	//$sql .= " and product_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and product.disabled = '0' ";
	$sql .= " and product.id = '".$pid."' ";
	$sql .= $search_condition;
	$sql .= " group by product.id  ";
	
	*/
	
	/*
	$sql = "select * ";
	
	//$sql .= ",CONCAT( (select name from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id=product_category.parent_product_category_id), '<br> ',product_category_desc.name) as category ";
	

	$sql .= " from ".TB_PRODUCT." as product";
	$sql .= " where ";
	//$sql .= " product.id = product_desc.product_id ";
	//$sql .= " and product_category.id = product_category_desc.product_category_id ";
	//$sql .= " and product_category.id = product.product_category_id ";
	//$sql .= " and product_category_desc.language_id = '".CURRENT_LANG."'";
	//$sql .= " and product_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " product.disabled = '0' ";
	$sql .= " and product.id = '".$pid."' ";
	$sql .= $search_condition;
	//$sql .= " group by product.id  ";
	*/
	
	/*
	$sql .= " from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where ";

	$sql .= "  product_id = '".$pid."' ";

	if($product_size_id > 0){
		$sql .= " and product_size_id= '".$product_size_id."' ";
	}
	$sql .= $search_condition;
	//$sql .= " group by product.id  ";
	
	$sql .= " order by final_price asc limit 0,1 ";
	
	
	*/
	
	
	
	
		$sql = "select * ";
	
	//$sql .= ",CONCAT( (select name from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id=product_category.parent_product_category_id), '<br> ',product_category_desc.name) as category ";
	

	$sql .= " from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where ";
	//$sql .= " product.id = product_desc.product_id ";
	//$sql .= " and product_category.id = product_category_desc.product_category_id ";
	//$sql .= " and product_category.id = product.product_category_id ";
	//$sql .= " and product_category_desc.language_id = '".CURRENT_LANG."'";
	//$sql .= " and product_desc.language_id = '".CURRENT_LANG."'";
	//$sql .= " product.disabled = '0' ";
	$sql .= "  product_id = '".$pid."' ";
	
	
	if($product_size_id > 0){
		$sql .= " and product_size_id= '".$product_size_id."' ";
		
	}
	
	if($product_color_id > 0){
		$sql .= " and product_color_id= '".$product_color_id."' ";
		
	}
	
	
	$sql .= $search_condition;
	//$sql .= " group by product.id  ";
	

	if($product_size_id > 0 ){
		$sql .= " order by final_price asc limit 0,1 ";
	}else{
		$sql .= " order by normal_price desc,final_price asc limit 0,1 ";
	}
	$other_hint = '';
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$product_have_discount = $data['have_discount'];
				$product_have_discount = false;
				
				$product_start_date = $data['start_date'];
				$product_end_date = $data['end_date'];
				
				
				$product_special_price = $data['special_price'];
				//$product_special_price = $data['normal_price'];
				
				
				
				/*
				if(MEMBER_CATEGORY_ID == 2){
					
					$product_special_price = $data['vip1_price'];
					$other_hint = 'VIP 1 Price';
				}else if(MEMBER_CATEGORY_ID == 3){
					$product_special_price = $data['vip2_price'];
					$other_hint = 'VIP 2 Price';
				}
				*/
				/*
				if($product_special_offer_id > 0){
					$product_special_price = getSpecialOfferPrice($product_special_offer_id,$pid,$product_size_id,$product_color_id);
			
					$other_hint = getLangName(TB_PRODUCT_SPECIAL_OFFER,"name",$product_special_offer_id,CURRENT_LANG);
				}
				*/
				
				
				$product_remark = $data['remark'];
				$product_member_price = $data['member_price'];
				$in_stock  = $data['in_stock'];
				
				
				if(!($product_start_date  <= TODAY && $product_end_date  >= TODAY )){
				//	$product_special_price = 0;
				}
				
				$old_price = $data['price'];
				if($data['price'] + 0 > 0){
					//$product_price = priceWithCurrenyRatio($data['price']);
					$product_price = $data['price'];
				}else{
					$product_price = $data['price'];
					
				}
				
				
				
			
				if($product_special_price >0 && $product_special_price < $product_price){
					$product_have_discount = true;
				}
				
				
				$old_price = $product_price;
				$final_price = $product_price;
				
				
				/*
				if($data['special_price'] + 0 > 0){
					$product_special_price = priceWithCurrenyRatio($data['special_price']);
				}else{
					$product_price = $data['special_price'];
				}
				*/
			
			}
	}
	

	/*
	
	if($_SESSION['falready_login']  ){
		
				$sql = "select * from ".TB_PRODUCT_TO_MEMBER_CATEGORY_PRICE;
				$sql .= " where ";
				$sql .= " product_id='".$pid."' and member_category_id='".MEMBER_CATEGORY_ID."' and price>0";
				$rows3 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
						while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
							$product_price  = priceWithCurrenyRatio( $data3['price']);
							$product_remark  = $data3['remark'];
						}
				}
		
		
	}
	
	
	*/
	
	if($_SESSION['falready_login']  ){
		if($product_member_price > 0){
			//$final_price =$old_price = $product_price  = $product_member_price;
		
		}
	}
	
	
	/*

	$sql = "select buy_qty_discount,buy_qty from ".TB_PRODUCT;
$sql .= " where id='$product_id' ";
	$rows6 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data6 = $G_DB_CONNECT->fetch_array($rows6)){
				$buy_qty_discount = $data6['buy_qty_discount'];
				$buy_qty = $data6['buy_qty'];
				
				
	$total_qty_in_cart = 0;
	
	$sql = " select sum(qty) as qty from ".TB_CART." as cart ";
	$sql .= " where  ";
	$sql .= " cart.session_id='".SESSION_ID."' ";
	$sql .= " and product_id='$product_id' ";
	 $sql .= " group by cart.product_id ";
	$rows4 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data4 = $G_DB_CONNECT->fetch_array($rows4)){
				$total_qty_in_cart = $data4['qty'];
			}
	}			
				
				
				if($buy_qty > 0 && $total_qty_in_cart >= $buy_qty ){
					 $count_full = floor($total_qty_in_cart/$buy_qty);
					//echo  '<br>';
					$count_remain = $total_qty_in_cart%$buy_qty;
				//	echo  '<br>';
				//echo 'sss'.$product_price.':'.($count_full*$buy_qty*$product_price*(100-$buy_qty_discount)/100);
				
				//echo  '<br>';
				//echo 'aaa'.($product_special_price*$count_remain);
					$product_special_price2 = ($count_full*$buy_qty*$product_price*(100-$buy_qty_discount)/100 + $product_special_price*$count_remain)/$total_qty_in_cart;
					//echo  '<br>';
					 $product_special_price=$product_special_price2;
					
				}
				
			}
	}

	
	*/
	
	
	
	
	
	

	
	$discount_category1_id=1;
	
	$total_discount_product_in_cart = 0;
	$sql = "select sum(qty) as total_qty from ".TB_CART;
	$sql .= " where session_id='".SESSION_ID."' ";
	$sql .= " and product_id in ( select product_id from ".TB_DISCOUNT_CATEGORY1_PRODUCT." where discount_category1_id = '".$discount_category1_id."')  ";

		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$total_discount_product_in_cart = $data['total_qty'];
				
				
			}
		}
	
	
	
	
		$this_product_in_discount_list = false;
		$sql = "select product_id from ".TB_DISCOUNT_CATEGORY1_PRODUCT." where discount_category1_id = '".$discount_category1_id."' and product_id = '".$product_id."'";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			$this_product_in_discount_list = true;
		}
		

	
	if($total_discount_product_in_cart > 0 && $this_product_in_discount_list  ){
		
		$total_qty_for_this_product = $total_discount_product_in_cart;
		/*
		$sql = "select sum(qty) as total_qty from ".TB_CART;
		$sql .= " where session_id = '".SESSION_ID."' and product_id='".$product_id."' group by product_id ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$total_qty_for_this_product = $data['total_qty'];
				
			}
		}
		*/
		
	
	
		
		
		
		$sql = "select * from ".TB_DISCOUNT_CATEGORY1_PRICE;
		$sql .= " where discount_category1_id = '".$discount_category1_id."' and target_buy_qty<=$total_qty_for_this_product order by target_buy_qty desc limit 0,1  ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$target_buy_qty = $data['target_buy_qty'];
				$final_discount = $data['final_discount'];
				$final_discount_price = $data['final_discount_price'];

				//echo $target_buy_qty.":".$final_discount;
				
				
				if($final_discount > 0 ){
					$product_special_price  = round($old_price*(100-$final_discount)/100,2);
				
				}else if($final_discount_price > 0 ){
					$product_special_price  = $old_price-$final_discount_price;
					if($product_special_price < 0 ){
						$product_special_price=0;
					}
				
				}
				
			}
		}
	
		
	
	
		
		
		
	}
	



	////////////////////////////////////////
	
	if($product_special_price > 0 && $product_special_price< $product_price){
		
		$price = $product_special_price;
		$final_price = $product_special_price;
		$price_desc = '<span class="oldPrice " style="text-decoration: line-through;">'.displayPrice2($product_price).'</span> <span class="final_price offerPrice" style="color:#ff0000">'.displayPrice2($product_special_price).'</span> ';
	
		$price_desc2 = '<span class="oldPrice " style="text-decoration: line-through;">'.displayPrice2($product_price).'</span> <span class="final_price offerPrice" style="color:#ff0000">'.displayPrice2($product_special_price).'<br>'.$other_hint.'</span>';
		$price_desc3 = displayPrice2($product_special_price);
	
	
	}else{
		$price = $product_price;
		if($product_price + 0 > 0){
			$price_desc = displayPrice2($product_price);
			$price_desc2  = '<span class="oldPrice " style="text-decoration: none;">'.displayPrice2($product_price).'</span>';
		}else{
			$price_desc = displayPrice2($product_price);
			$price_desc2  ='<span class="oldPrice " style="text-decoration: none;">'. displayPrice2($product_price).'</span>';
		}
		
			$price_desc3  = displayPrice2($product_price);
	
	}
	
	
	if($product_remark != ''){
		
		$price_desc = $price_desc.'<br><span style="font-weight:normal;font-size:10px;color:#ff0000">'.$product_remark.'</span>';
	}
	
	
	////////////////////////////////////////
	$price_desc_detail = displayPrice2($price);
	$arr_data['price'] = priceWithCurrenyRatio($price);
	$arr_data['price_desc'] = $price_desc;
	$arr_data['price_desc2'] = $price_desc2;
	$arr_data['price_desc3'] = $price_desc3;
	$old_price_desc2  = displayPriceSign($old_price);
	$old_price_desc  = displayPrice2($old_price);
	if($final_price == $old_price){
			$old_price_desc = '';
			$old_price_desc2='';
	}
	
	$arr_data['old_price_desc'] = 	$old_price_desc;
	$arr_data['old_price'] = 	$old_price;
	$arr_data['old_price_desc2'] = 	$old_price_desc2;
	
	$final_price_desc = displayPrice2($final_price);
	$final_price_desc = $final_price_desc ;
	$arr_data['final_price_desc'] = $final_price_desc ;
	
	$arr_data['final_price_desc2'] = displayPriceSign($final_price);
	
	$in_stock_desc = '<div class="left outstock">Out of Stock</div>';
	$in_stock_desc2 = '<div class="left" style="padding-top:10px;"><img src="images/product/out-of-stock-icon.jpg" width="89" height="22" /></div>';
	if($in_stock == '1'){
		$in_stock_desc = '<div class="left instock">In Stock</div>';
		$in_stock_desc2 = '<div class="left" style="padding-top:10px;"><img src="images/product/in-stock-icon.png" width="89" height="22" /></div>';
	}
	$arr_data['in_stock_desc'] = $in_stock_desc ;
	$arr_data['in_stock_desc2'] = $in_stock_desc2 ;

	$arr_data['price_desc_detail'] = $price_desc_detail;
	
	$have_special_price = false;
	

	
	if($product_special_price > 0 && $product_special_price< $product_price){

		$have_special_price = true;
	}

	
	$arr_data['have_special_price'] = $have_special_price;
	
	$arr_data['have_category_discount'] = $have_category_discount;
	
	$arr_data['have_discount'] = $product_have_discount;
	return $arr_data;

	
	
}









function getFinalCoursePriceData($pid){
	global $G_DB_CONNECT;
	
	$price = 0;
	$special_price = 0;
	$price_desc = '';
	$price_desc_detail = '';
	
	
	
	$sql = "select course.price,course.special_price,course.discount  ";
	
	//$sql .= ",CONCAT( (select name from ".TB_COURSE_CATEGORY_DESC." where course_category_id=course_category.parent_course_category_id), '<br> ',course_category_desc.name) as category ";
	
	
	$sql .= "  from ".TB_COURSE." as course where ";
	
	
	
	$sql .= " course.disabled = '0' ";
	$sql .= " and course.id = '".$pid."' ";
	$sql .= $search_condition;
	//$sql .= " group by course.id  ";
	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$course_discount = $data['discount'];
				$course_price = priceWithCurrenyRatio($data['price']);
				if($course_discount > 0){
					$course_special_price = priceWithCurrenyRatio($data['price']*((100-$course_discount)/100));
				}
				
			
			}
	}
	
	////////////////////////////////////////
	if($course_special_price > 0){
		$price = $course_special_price;
		$price_desc = '<span class="special_price">'.displayPriceOnly2($course_special_price).'</span><br><span class="old_price">('.TITLE_OLD_COURSE_PRICE.' '.displayPriceOnly2($course_price).')</span>';
	}else{
		$price = $course_price;
		$price_desc = displayPriceOnly2($course_price);
	}
	////////////////////////////////////////
	$price_desc_detail = displayPriceOnly2($price);
	$arr_data['price'] = $price;
	$arr_data['price_desc'] = $price_desc;
	$arr_data['price_desc2'] = $price_desc;
	$arr_data['price_desc_detail'] = $price_desc_detail;
	return $arr_data;

	
	
}



function DraftText($allowStrLen,$title,$sign=" ..."){
		
		
		
				
	/*
		$len = 0;
		$index = 0;
		$Desc =  explode(" ", $title );
		for ($j=0; $j<count($Desc); $j++){
				$index = $j;
				if($j != 0){
					$len++;
				}
				$len += strlen($Desc[$j]);
				if($len >= $allowStrLen){
					$index--;
					if($index<0){
						$index = 0;
					}
					
					break;
				}
		}
		//////////////////////////////////
		$output = '';
		//echo "ss".$index."ff";
		//echo $Desc[2];
		for ($j=0; $j<=$index; $j++){
			
				if($j != 0){
					$output .= " ";
				}
				$output .= $Desc[$j];
				
		}
		
												
		if($index < count($Desc)-1){
			$output = $output.$sign;
		}
		
		
		*/
		
		
	$title = format2SimpleHTML($title);
	//$title=filterBadLang($title);
	$in_title = $title;
	
	$output =$title=mb_substr($title,0,$allowStrLen,'UTF-8');
	
		$len = strlen($title);
		if(strlen($in_title)>strlen($output)){
			//$output =substr($title,0,$allowStrLen). '...';
			$output .= ' ...';
		}else{
			$output =$title;
		}
		
		
		return  $output;
		
		
		
		
		
	}
	
	


function DraftText2($allowStrLen,$text,$sign=" ..."){
	
	
	
	$text = strip_tags($text);
	$text = str_replace(array("\r", "\n"), array(' ', ' '), $text);
	$text = str_replace("
", " ", $text);
	/*
	$out = "";
	 $ls=0;//was it a whitespace?
        $cc33=0;//counter
        for($i=0;$i<strlen($text);$i++){
                $spstat=false; //is it a number or a letter?
                $ot=ord($text[$i]);
                if( (($ot>=48) && ($ot<=57)) ||  (($ot>=97) && ($ot<=122)) || (($ot>=65) && ($ot<=90)) || ($ot==170) ||
                (($ot>=192) && ($ot<=214)) || (($ot>=216) && ($ot<=246)) || (($ot>=248) && ($ot<=254))  )$spstat=true;
                if(($ls==0)&&($spstat)){
                        $ls=1;
                        $cc33++;
						if($cc33 >= $allowStrLen){
							break;
						}
                }
                if(!$spstat)$ls=0;
				$out .= $text[$i];
        }

	   if( $allowStrLen < countwords($text) ){
	   		$out .= $sign;
	   }
*/
$title=$text;
$len = strlen($title);
$output =$title=mb_substr($title,0,$allowStrLen,'UTF-8');
		
		
		if($len >$allowStrLen){
			//$output =substr($title,0,$allowStrLen). '...';
			$output .= ' ...';
		}else{
			$output =$title;
		}

		return  $output;


		


	
	
	
	
	
	//return $text;
	
}
	
function countwords($text){
        $ls=0;//was it a whitespace?
        $cc33=0;//counter
        for($i=0;$i<strlen($text);$i++){
                $spstat=false; //is it a number or a letter?
                $ot=ord($text[$i]);
                if( (($ot>=48) && ($ot<=57)) ||  (($ot>=97) && ($ot<=122)) || (($ot>=65) && ($ot<=90)) || ($ot==170) ||
                (($ot>=192) && ($ot<=214)) || (($ot>=216) && ($ot<=246)) || (($ot>=248) && ($ot<=254))  )$spstat=true;
                if(($ls==0)&&($spstat)){
                        $ls=1;
                        $cc33++;
                }
                if(!$spstat)$ls=0;
        }
        return $cc33;
}









function getSQLFindInSet($group_id,$find_in_set_field_name){
	
	$arr_group_id = explode(",", $group_id);
	
	$out = '';
	for ($i=0; $i<count($arr_group_id); $i++)   { 
		$id= $arr_group_id[$i];
		if($out != ''){
			$out .= " or ";
		}
		$out .= " FIND_IN_SET('".$id."',".$find_in_set_field_name.") ";
	
	}
	
	
	if($out != ''){
		$out = " and (".$out.")";
	}
	
	
	return $out;
	
	
	
	
	
	
	
	
}










//////////////////////////////////////
	// For Generate menu in form
	//////////////////////////////////////
	function printCustomMenuProductCategory($Menuidname, $sql,$needField,$defaultid, $selectedid,$events,$NoneLabel,$NoneValue,$need="no",$other_list=""){
	global $G_DB_CONNECT;

		echo "<select id=\"$Menuidname\"  name=\"$Menuidname\"  $events required='$need'>";
			
			
		if(!($NoneLabel == '' && $NoneValue == '')){
			echo "<option value=\"".$NoneValue. "\"  " ;
			
			if($selectedid == ''){
				echo "selected";
			}
			
			echo "  >";
			echo $NoneLabel;
			echo "</option>";
		}
			
			
		 $haveSelected = false;
		 



//$result = mysqli_query($sql);
		//while ( $data = mysqli_fetch_array($result)) {
			
						
	$rows = $G_DB_CONNECT->query($sql);
	//if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$id = $data['id'];
			echo "<option value=\"".$id. "\" " ;
			if($selectedid != ''){
				if($selectedid == $id && !$haveSelected){
					echo "selected";
					$haveSelected = true;
				}
			}else if ($defaultid == $id  && !$haveSelected){
				echo "selected";
				$haveSelected = true;
			}
			
			echo "  >";

			

			//echo $data['name'];
			echo $data['parent_category_name']." &gt; ".$data[$needField];
			//echo $data[$needField];
			echo "</option>";
			
		}
		
		
		if($other_list != ''){
		
			
			$out = "";
		
			if($_REQUEST[$field_id] == ''){
				$_REQUEST[$field_id] = $default_value;
			}
		
		
			foreach ($other_list  as $key => $value ) {
			$k = 0;
			$this_name = "";
			$this_value = "";
		   	foreach ($value as $key2 => $value2 ) { 
		   		$k++;
		   		//$out .= '<br>'; 
                //$out .= $key2.'  :  ' . $value2; 
				if($k == 1){
					$this_name = $value2;
				}else if($k == 2){
					$this_value = $value2;
				}
		   
		   }
		   
		   $selected = "";
		   if($_REQUEST[$field_id] == $this_value){
		   		 $selected = "selected";
		   }
		  
		   
		   $out .= '<option value="'.$this_value.'"  '. $selected.'>';
		   $out .= $this_name;
		   $out .= "</option>";
		   echo $out;
		
       }  
		
		
		
		
		
		}



	
	 	echo  "</select>";
	}






//////////////////////////////////////
	// For Generate menu in form
	//////////////////////////////////////
	function printCustomMenuProductCategory3($Menuidname, $sql,$needField,$defaultid, $selectedid,$events,$NoneLabel,$NoneValue,$need="no",$other_list=""){
global $G_DB_CONNECT;

		echo "<select id=\"$Menuidname\"  name=\"$Menuidname\"  $events required='$need'>";
			
			
		if(!($NoneLabel == '' && $NoneValue == '')){
			echo "<option value=\"".$NoneValue. "\"  " ;
			
			if($selectedid == ''){
				echo "selected";
			}
			
			echo "  >";
			echo $NoneLabel;
			echo "</option>";
		}
			
			
		 $haveSelected = false;
		 


//$result = mysqli_query($sql);
		//while ( $data = mysqli_fetch_array($result)) {
			
						
	$rows = $G_DB_CONNECT->query($sql);
	//if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$id = $data['id'];
			echo "<option value=\"".$id. "\" " ;
			if($selectedid != ''){
				if($selectedid == $id && !$haveSelected){
					echo "selected";
					$haveSelected = true;
				}
			}else if ($defaultid == $id  && !$haveSelected){
				echo "selected";
				$haveSelected = true;
			}
			
			echo "  >";

			

			//echo $data['name'];
			echo $data['parent_category_name']."".$data[$needField];
			//echo $data[$needField];
			echo "</option>";
			
		}
		
		
		if($other_list != ''){
		
			
			$out = "";
		
			if($_REQUEST[$field_id] == ''){
				$_REQUEST[$field_id] = $default_value;
			}
		
		
			foreach ($other_list  as $key => $value ) {
			$k = 0;
			$this_name = "";
			$this_value = "";
		   	foreach ($value as $key2 => $value2 ) { 
		   		$k++;
		   		//$out .= '<br>'; 
                //$out .= $key2.'  :  ' . $value2; 
				if($k == 1){
					$this_name = $value2;
				}else if($k == 2){
					$this_value = $value2;
				}
		   
		   }
		   
		   $selected = "";
		   if($_REQUEST[$field_id] == $this_value){
		   		 $selected = "selected";
		   }
		  
		   
		   $out .= '<option value="'.$this_value.'"  '. $selected.'>';
		   $out .= $this_name;
		   $out .= "</option>";
		   echo $out;
		
       }  
		
		
		
		
		
		}



	
	 	echo  "</select>";
	}

function setCookieProduct($product_id){
	setcookie("hc_product_viewed[".$product_id."]",$product_id,COOKIE_EXPIRE_TIME);
}
function setCookieClicked($name){
	//setcookie("health_p[$name]",true,COOKIE_EXPIRE_TIME);
	$_SESSION[$name] = true;
	
}

function getCookieClicked($name){
	//return $_COOKIE["health_p"][$name];
  
  return $_SESSION[$name];
  
  
  
}

function getCookieProduct(){
	$arr_data = array();
	
	if (isset($_COOKIE["hc_product_viewed"])){
  		foreach ($_COOKIE["hc_product_viewed"] as $name => $value){
			array_push($arr_data, $name);
    	}
  	}
	return	$arr_data;
  
  
  
  
  
  
}




//////////////////////////////////////
	// For Generate menu in form
	//////////////////////////////////////
	function printNumber( $Numberid,$NumberStart,$add,$steps,$defaultNumber,$selectedNumber,$event=''){


	
		//echo " Number ";
		echo "<select id=\"$Numberid\"  name=\"$Numberid\" $event  >";
			
		 $haveSelected = false;
		for ($i=1; $i<=$steps; $i++){
			
			echo "<option value=\"".$NumberStart. "\" " ;
			if(!$haveSelected){
				if(($defaultNumber == $i && $selectedNumber=='') || ($selectedNumber==$NumberStart) ){
					echo "selected";
					$haveSelected = true;
				}
			}
			echo "  >";
			echo $NumberStart;
			echo "</option>";
			$NumberStart += $add;
		}

	 	echo  "</select>";
		///////////////////////////////////////////////////////


		
		
	}

function printMonth( $Numberid,$defaultNumber,$selectedNumber,$event=''){
	$defaultNumber = $defaultNumber +0;
	$selectedNumber = $selectedNumber + 0;

$arr_month = array("Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sep","Oct","Nov","Dec");
	
		//echo " Number ";
		echo "<select id=\"$Numberid\"  name=\"$Numberid\" $event  >";
			
		 $haveSelected = false;
		for ($i=1; $i<=count($arr_month); $i++){
			$NumberStart = $i;
			echo "<option value=\"".$NumberStart. "\" " ;
			if(!$haveSelected){
				if(($defaultNumber == $i && $selectedNumber=='') || ($selectedNumber==$NumberStart) ){
					echo "selected";
					$haveSelected = true;
				}
			}
			echo "  >";
			echo $arr_month[$i-1];
			echo "</option>";
			
		}

	 	echo  "</select>";
		///////////////////////////////////////////////////////


		
		
	}
	
	
function getEmailTemplateInfo($id){
	global $G_DB_CONNECT;
	$arr_data= array();
	
	$sql = "select email_template.*, email_template_desc.name as name, email_template_desc.detail, email_template_desc.name2, email_template_desc.detail2  from ".TB_EMAIL_TEMPLATE." as email_template , ".TB_EMAIL_TEMPLATE_DESC." as email_template_desc ";
			$sql .= " where ";
			$sql .= " email_template.id=email_template_desc.email_template_id ";
			$sql .= " and email_template_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and email_template.disabled='0' ";
			
		
			$sql .= " and id='".$id."' ";
			
			
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($G_DB_CONNECT->affected_rows > 0){
		

				while($data = $G_DB_CONNECT->fetch_array($rows)){
				
					$arr_data['title'] = $data['name2'];
					$arr_data['content'] = displayHTML($data['detail']);
					$arr_data['content2'] = displayHTML($data['detail2']);
					$arr_data['email_to_name'] = $data['email_to_name'];
					$arr_data['email_to'] = $data['email_to'];
				}
			}
			 	
	return $arr_data;
	
}


?>