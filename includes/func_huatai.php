<?php

function displayTopSubMenu($id){
		global $G_DB_CONNECT;
		
		$sql = "select id from ".TB_TOPSUBMENU;
			$sql .= " where id= '".$id."' ";
			$sql .= " and disabled=0 ";
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($G_DB_CONNECT->affected_rows > 0){
				while($data = $G_DB_CONNECT->fetch_array($rows)){
					 return true;
				}
			}
			return false;
	
}
	function formatShareOgImagePath($path){
	$path = str_replace("../","",$path);
	$path = str_replace("/".CURRENT_LANG_DIR."/","/",$path);
	return $path;
	
}


function getSpecialOfferPrice($product_special_offer_id,$product_id,$product_size_id,$product_color_id){
	global $G_DB_CONNECT;
	$price = 0 ;
			$product_code2 = '';
			$sql = "select product_code2 from ".TB_PRODUCT_COLOR_SIZE_QTY;
			$sql .= " where product_id= '".$product_id."' ";
			$sql .= " and product_size_id= '".$product_size_id."' ";
			$sql .= " and product_color_id= '".$product_color_id."' ";
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($G_DB_CONNECT->affected_rows > 0){
				while($data = $G_DB_CONNECT->fetch_array($rows)){
					$product_code2 = $data['product_code2'];
				}
			}
			
			
			$sql = "select product_special_offer.*, product_special_offer_desc.name as name, product_special_offer_desc.detail from ".TB_PRODUCT_SPECIAL_OFFER." as product_special_offer , ".TB_PRODUCT_SPECIAL_OFFER_DESC." as product_special_offer_desc ";
			$sql .= " where ";
			$sql .= " product_special_offer.id=product_special_offer_desc.product_special_offer_id ";
			$sql .= " and product_special_offer_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and product_special_offer.disabled='0' ";
			$sql .= " and product_special_offer.id='$product_special_offer_id'";
			
			$sql .= " and (";
			
			
				$sql .= " product_special_offer.product1_code='".$product_code2."' ";
				$sql .= " or product_special_offer.product2_code='".$product_code2."' ";
				$sql .= " or product_special_offer.product3_code='".$product_code2."' ";
			
			
			$sql .= " )";
			
			
			$sql .= " order by  sort_order asc ";
	
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($G_DB_CONNECT->affected_rows > 0){
				
				while($data = $G_DB_CONNECT->fetch_array($rows)){
					$product_special_offer_id = $data['id'];
					
					$product1_code = $data['product1_code'];
					$product2_code = $data['product2_code'];
					$product3_code = $data['product3_code'];
					
					$product1_price = $data['product1_price'];
					$product2_price = $data['product2_price'];
					$product3_price = $data['product3_price'];
					
					
					
					if($product1_code == $product_code2){
						
						$price = $product1_price ;
					}else if($product2_code == $product_code2){
						
						$price = $product2_price ;
					}else if($product3_code == $product_code2){
						
						$price = $product3_price ;
					}
					
					
					
				}
				
				
				
				
				
			}
			
			
			return $price ;
	
}

function addToCartSpecialOffer($product_special_offer_id){
	global $G_DB_CONNECT;
	$sql = "select product_special_offer.*, product_special_offer_desc.name as name, product_special_offer_desc.detail from ".TB_PRODUCT_SPECIAL_OFFER." as product_special_offer , ".TB_PRODUCT_SPECIAL_OFFER_DESC." as product_special_offer_desc ";
	$sql .= " where ";
	$sql .= " product_special_offer.id=product_special_offer_desc.product_special_offer_id ";
	$sql .= " and product_special_offer_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product_special_offer.disabled='0' ";
	$sql .= " and product_special_offer.id='$product_special_offer_id' ";
	$sql .= " order by  sort_order asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
					$product_special_offer_id = $data['id'];
					
					$product1_code = $data['product1_code'];
					$product2_code = $data['product2_code'];
					$product3_code = $data['product3_code'];
					
					$product1_price = $data['product1_price'];
					$product2_price = $data['product2_price'];
					$product3_price = $data['product3_price'];
					
					$qty = 1;
				////////////////////////
				$product1_id = 0;
				$product1_color_id = 0;
				$product1_size_id = 0;
				$sql = "select * from ".TB_PRODUCT_COLOR_SIZE_QTY;
				$sql .= " where trim(lower(product_code2))= trim(lower('".$product1_code ."')) ";
				$rows2 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
						$product1_id = $data2['product_id'];
						$product1_color_id =  $data2['product_color_id'];
						$product1_size_id = $data2['product_size_id'];
						
					}
				}
			
				cart_add_item($qty,$product1_id,$product1_color_id,$product1_size_id,'','','','',$product_special_offer_id);
	
				////////////////////////
				$product2_id = 0;
				$product2_color_id = 0;
				$product2_size_id = 0;
				$sql = "select * from ".TB_PRODUCT_COLOR_SIZE_QTY;
				$sql .= " where trim(lower(product_code2))= trim(lower('".$product2_code ."')) ";
				$rows2 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
						$product2_id = $data2['product_id'];
						$product2_color_id =  $data2['product_color_id'];
						$product2_size_id = $data2['product_size_id'];
						
					}
				}
				
				cart_add_item($qty,$product2_id,$product2_color_id,$product2_size_id,'','','','',$product_special_offer_id);
	
					
				////////////////////////
				$product3_id = 0;
				$product3_color_id = 0;
				$product3_size_id = 0;
				$sql = "select * from ".TB_PRODUCT_COLOR_SIZE_QTY;
				$sql .= " where trim(lower(product_code2))= trim(lower('".$product3_code ."')) ";
				$rows2 = $G_DB_CONNECT->query($sql);
				if($G_DB_CONNECT->affected_rows > 0){
					while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
						$product3_id = $data2['product_id'];
						$product3_color_id =  $data2['product_color_id'];
						$product3_size_id = $data2['product_size_id'];
						
					}
				}
					
				cart_add_item($qty,$product3_id,$product3_color_id,$product3_size_id,'','','','',$product_special_offer_id);
	
					
					
		}
		
	}
	
	
	
	
}



function cart_getMemberDiscount(){
	global $G_DB_CONNECT;
	$total_product_price = cart_getTotalItemPrice();
	$discount = 0;
	if(MEMBER_CATEGORY_ID == 2){
		
		$discount = $total_product_price*M1_ORDER_DISCOUNT/100;
		
	}else if(MEMBER_CATEGORY_ID == 3){
		
		$discount = $total_product_price*M2_ORDER_DISCOUNT/100;
		
	}
	
	$discount = 0;
	
	return round($discount,1);
	
}



function haveMoreColor($product_id){
	global $G_DB_CONNECT;
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
	
	
	
	$sql .= " order by product_color.sort_order asc ";
	
	$rowsp = $G_DB_CONNECT->query($sql);
	$total_color = $G_DB_CONNECT->affected_rows;	
	
	$display = ' style="display:none"';
	if($total_color > 1){
		return true;
	}
	
	return false;
	
	
}

function updateProductCountView(){
	global $G_DB_CONNECT;
		$sql = "select product_id,sum(qty) as total_qty from  ".TB_PAYMENT_ITEM;
	$sql .= " where payment_id in ( ";
	$sql .= " select id from ".TB_PAYMENT." where payment_status_id=2 and DATE(create_date) >= '".TODAY."' ";
	$sql .= " ) group by product_id";
	$rows = $G_DB_CONNECT->query($sql);
	
	if($G_DB_CONNECT->affected_rows > 0){
			
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$sql = "update ".TB_PRODUCT." set count_view='".$data['total_qty']."' where id='".$data['product_id']."'";
				$G_DB_CONNECT->query($sql);
			
			}
			
			
	}
	
	
}

function get_user_browser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = '';
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = "ie";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $ub = "firefox";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $ub = "safari";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $ub = "chrome";
    }
    elseif(preg_match('/Flock/i',$u_agent))
    {
        $ub = "flock";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $ub = "opera";
    }

    return $ub;
}


function getPriceToCoin($total_product_price,$currency_ratio=CURRENCY_RATIO){
	
	
	$coin = round($total_product_price*(EARN_COIN_TO_COIN*$currency_ratio));
	if($coin <=0){
		$coin = 0;
	}
	
	return $coin;
}


function check_order_qty_email($path=""){
	
	
	
	global $G_DB_CONNECT;
	
	
	

			$sql = "select product_category.*,product_category_desc.name as name, product_category_desc.detail from ".TB_PRODUCT_CATEGORY." as product_category , ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc  ";
			$sql .= " where ";
			$sql .= " product_category.id=product_category_desc.product_category_id ";
			$sql .= " and product_category_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and product_category.disabled='0' ";
			$sql .= " and product_category.parent_product_category_id='0' ";
			$sql .= " order by product_category.sort_order asc";


			$rows2 = $G_DB_CONNECT->query($sql);
			$c=0;
			if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$c++;
					$parent_product_category_id = $data2['id'];
					$parent_product_category_name = DraftText(50,$data2['name']);

			
		

			$sql = "select product_category.*,product_category_desc.name as name, product_category_desc.detail from ".TB_PRODUCT_CATEGORY." as product_category , ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc  ";
			$sql .= " where ";
			$sql .= " product_category.id=product_category_desc.product_category_id ";
			$sql .= " and product_category_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and product_category.disabled='0' ";
			$sql .= " and product_category.parent_product_category_id='".$parent_product_category_id."' ";
			$sql .= " order by product_category.sort_order asc";


			$rows2a = $G_DB_CONNECT->query($sql);
			
			if($G_DB_CONNECT->affected_rows > 0){

			while($data2a = $G_DB_CONNECT->fetch_array($rows2a)){
					
				$product_category_id = $data2a['id'];
				$product_category_name = $data2a['name'];
				
				
				
				
			$sql = "select product.*,product.code, product_desc.name as name, product_desc.detail from ".TB_PRODUCT." as product , ".TB_PRODUCT_DESC." as product_desc ";
			$sql .= " where ";
			$sql .= " product.id=product_desc.product_id ";
			$sql .= " and product_desc.language_id='".CURRENT_LANG."' ";
			$sql .= " and product.disabled='0' ";
			$sql .= " and product.product_category_id='".$product_category_id."' ";
			$rowst = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			
				while($datat = $G_DB_CONNECT->fetch_array($rowst)){
					$product_id = $datat['id'];
					
					
					////////////////////////////////////////
					
					
	$sql = "select * from ".TB_PRODUCT_COLOR_SIZE_QTY." as product_color_size_qty  ";
	$sql .= " where  ";
    $sql .= " qty <= '".EMAIL_IF_QTY_LESS_THAN."' ";
	  $sql .= " and product_id in ( ";
	$sql .= " select id from ".TB_PRODUCT;	
	$sql .= " where disabled='0' and id='".$product_id."' ";	
	  $sql .= " ) ";
	
	 $sql .= " order by product_id, product_color_id,product_size_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		
		

		
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				
				
				$product_id = $data['product_id'];
				$product_code = getDataName(TB_PRODUCT,'code',$product_id );

				
				
				$product_name = getLangName(TB_PRODUCT,"name",$product_id,CURRENT_LANG);
				$color_name = getLangName(TB_PRODUCT_COLOR,"name",$data['product_color_id'],CURRENT_LANG);
				$size_name = getLangName(TB_PRODUCT_SIZE,"name",$data['product_size_id'],CURRENT_LANG);
				//category
				
				//orderby category and then by product name
				
				$html .= $parent_product_category_name."  > ".$product_category_name." : ".$product_code . " ".$product_name;
				$html .= ' : ';
				$html .= $size_name.', QTY '.$data['qty'];
				$html .= '<br><br>';
				
				
				
					
				
				
				
			}
			
			
	}
	
					
					
					
					
					////////////////////////////////////////
					
				}
			}
		
		

				
				
				
				
				
				
				}
			}
			
			
	
	
		}
	}
	
	
	

	
	
	
	
	if($html != ''){
		
	
			$html = "The inventory of the following items are <= '".EMAIL_IF_QTY_LESS_THAN."' now : <br><br>".$html;
		
		
	
	//echo EMAIL_COMPANY_EMAIL_TO.EMAIL_COMPANY_EMAIL_TO_NAME.QTY_NOTICE_EMAIL_TO.QTY_NOTICE_EMAIL_TO.$html ;
			$email_title = 'Notification of lack of stock will be sent to admin while the inventory reach '.EMAIL_IF_QTY_LESS_THAN;
			//echo $html;
			sendEmail(EMAIL_COMPANY_EMAIL_TO,EMAIL_COMPANY_EMAIL_TO_NAME,QTY_NOTICE_EMAIL_TO,QTY_NOTICE_EMAIL_TO,$email_title,$html);
	}
		
		
}



function print_social_link($url='',$title='',$description=''){
	
	$out='';
	$title = format2SimpleHTML($title);
	$description = format2SimpleHTML($description);
	/*
$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'"> 
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
</div>';
*/

/*
$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'"> 
 <a class="addthis_button_facebook"></a>
                <a class="addthis_button_twitter"></a>
                <a class="addthis_button_google_plusone_share"></a> 
			
				<a class="addthis_button_pinterest_share"></a> 
              
                <a class="addthis_button_expanded"></a>
</div>';
*/


/*

$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'"> 
 <a class="addthis_button_facebook"></a>
                <a class="addthis_button_twitter"></a>
                <a class="addthis_button_google_plusone_share"></a> 
			
				<a class="addthis_button_pinterest_share"></a> 
              
                <a class="addthis_button_expanded"></a>
</div>';

*/


$out='<div class="addthis_toolbox addthis_default_style "  addthis:url="'.$url.'"> 
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a> 
<a class="addthis_button_sinaweibo_like"></a> 
<a class="addthis_counter addthis_pill_style"></a>
</div>';





/*

$out='<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox  addthis_counter_style" addthis:url="'.$url.'"> 
<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
<a class="addthis_button_tweet" tw:count="vertical"></a>
<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
<a class="addthis_counter"></a>
</div>
<!-- AddThis Button END -->';
*/

/*
$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'" addthis:title="'.$title.'" addthis:description="'. $description.'"> 
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
</div>';
*/
echo $out;


	
	
}





function print_social_link2($url='',$title='',$description=''){
	
	$out='';
	$title = format2SimpleHTML($title);
	$description = format2SimpleHTML($description);
	/*
$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'"> 
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
</div>';
*/

/*
$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'"> 
 <a class="addthis_button_facebook"></a>
                <a class="addthis_button_twitter"></a>
                <a class="addthis_button_google_plusone_share"></a> 
			
				<a class="addthis_button_pinterest_share"></a> 
              
                <a class="addthis_button_expanded"></a>
</div>';
*/


/*

$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'"> 
 <a class="addthis_button_facebook"></a>
                <a class="addthis_button_twitter"></a>
                <a class="addthis_button_google_plusone_share"></a> 
			
				<a class="addthis_button_pinterest_share"></a> 
              
                <a class="addthis_button_expanded"></a>
</div>';

*/


$out='<div class="addthis_toolbox addthis_default_style "  addthis:url="'.$url.'"> 
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
</div>';


$out.='<div style="clear:both; padding-top:10px;"></div>';

$out.='<div class="addthis_toolbox addthis_default_style "  addthis:url="'.$url.'"> 
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a> 
<a class="addthis_button_sinaweibo_like"></a> 

</div>';


$out.='<div style="clear:both; padding-top:10px;"></div>';
$out.='<div class="addthis_toolbox addthis_default_style "  addthis:url="'.$url.'"> 
<a class="addthis_counter addthis_pill_style"></a>
</div>';

/*

$out='<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox  addthis_counter_style" addthis:url="'.$url.'"> 
<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
<a class="addthis_button_tweet" tw:count="vertical"></a>
<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
<a class="addthis_counter"></a>
</div>
<!-- AddThis Button END -->';
*/

/*
$out='<div class="addthis_toolbox addthis_default_style"  addthis:url="'.$url.'" addthis:title="'.$title.'" addthis:description="'. $description.'"> 
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
</div>';
*/
echo $out;


	
	
}






function handleAddToCartButton($product_id){
	
	global $G_DB_CONNECT;
	
	$total_qty = 0;
	
	$sql = " select sum(qty) as total_qty from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where ";
	$sql .= " product_id = '".$product_id."' ";
	$rowsp = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){	
		while($datap = $G_DB_CONNECT->fetch_array($rowsp)){
				$total_qty = $datap['total_qty'];
				
		}
	}
	
	if($total_qty  > 0){
		//echo '<a href="cart.php?action=add&id='.$product_id.'"><img src="images/main/btn_AddToCart.jpg" width="103" height="22"></a>';
		
		echo '<a href="products_details.php?id='.$product_id.'"><img src="images/main/btn_AddToCart.jpg" width="103" height="22"></a>';
		
	}else{
		echo '<img src="images/main/bt_outofstock.jpg" width="103" height="22">';
		
	}
	
	
}


function getCoin2Money($coin){
	//$price = $coin*(COIN_TO_MONEY/COIN_FROM_COIN)*CURRENCY_RATIO;

	$price = $coin*(COIN_TO_MONEY/COIN_FROM_COIN)*CURRENCY_RATIO;
	
	
	return displayPriceOnly2($price);
}



function getCoin2Money2($coin){
	$price = $coin*(COIN_TO_MONEY/COIN_FROM_COIN)*CURRENCY_RATIO;
	return $price;
}


function updateLowestProductPrice($product_id){
	global $G_DB_CONNECT;
	
	$price = 0;
	$special_price =0;
	
	$price2 = 0;

	$sql = "select * from ".TB_PRODUCT_COLOR_SIZE_QTY;
	$sql .= " where ";
	$sql .= "  product_id = '".$product_id."' ";
	
	
	
	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$price = $data['price'];
				$special_price = $data['special_price'];
				
				/*
				$member_price = $data['member_price'];
				
				
				$product_start_date = $data['start_date'];
				$product_end_date = $data['end_date'];
				if(!($product_start_date  <= TODAY && $product_end_date  >= TODAY )){
					$special_price = 0;
				}
				
				*/
				
				
				
			}
	}
	
	$price2 = $price;
	if($special_price > 0 && $special_price< $price){
		$price2 = $special_price;
	}
	
	$sql = " update ".TB_PRODUCT;
	$sql .= " set ";
	$sql .= " final_price = '".$price2."' ";
	$sql .= " where ";
	$sql .= " id = '".$product_id."' ";
	$G_DB_CONNECT->query($sql);
	
	
	
	
	
	$price3 = $price;
	if($member_price > 0 && $member_price> $special_price){
		$price3 = $special_price;
	}else if($member_price > 0 && $member_price< $price){
		$price3 = $member_price;
	}
	
	$sql = " update ".TB_PRODUCT;
	$sql .= " set ";
	$sql .= " final_price2 = '".$price3."' ";
	$sql .= " where ";
	$sql .= " id = '".$product_id."' ";
	$G_DB_CONNECT->query($sql);
	
	
	
	
	
	
}




function getRecordStatus($table,$id){
	global $G_DB_CONNECT;
	
	$ref_field_id = getLangRefFieldID($table);
	
	$sql = "select tb.color as color,tb_desc.name as name  ";
	$sql .= " from ".$table." as tb, ".$table."_desc as tb_desc ";
	$sql .= " where tb_desc.language_id = '1'";
	$sql .= " and tb_desc.".$ref_field_id."=  tb.id ";
	$sql .= " and tb.id =  '".$id."' ";

	
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$color = $data['color'];
			$name = $data['name'];
		}
	}
	
	if($name != ''){
		return '<span style="color:#'.$color.';font-weight:bold">'.$name.'</span>';
	}
	
	
}



function formatWeight($product_weight=0){
	
	if($product_weight > 0){
		return $product_weight. ' '.UNIT_PRODUCT_WEIGHT;
	}else{
		return $product_weight. ' '.UNIT_PRODUCT_WEIGHT;
	}
	
	/*
	if($product_weight != ''){
		return $product_weight;
	}else{
		return '&nbsp;';
	}
	*/
	
	
}
function sendSMS($phone,$msg){
	$accountno = SMS_ACCOUNT_NO;
	$pwd = SMS_ACCOUNT_PW;
	$language = 2;
	$phone = '852'.$phone;
	$msg = unicode_get(convert($language, $msg));
	$url = "http://api.accessyou.com/sms/sendsms.php?msg=".$msg."&phone=".$phone."&pwd=".$pwd."&accountno=".$accountno;
	//header("Location: http://".$url);
	return $url;


}

function reduceCourseQTY($course_payment_id){
	global $G_DB_CONNECT;
	
	$payment_status_id= 0;
	$reduced_qty = 0;
	$sql = "select * from ".TB_COURSE_PAYMENT;
	$sql .= " where  ";
	$sql .= " id='".$course_payment_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$payment_status_id = $data['payment_status_id'];
			$reduced_qty = $data['reduced_qty'];
			
			$member_id = $data['member_id'];
			$surname_en = $data['surname_en'];
			$givenname_en = $data['givenname_en'];
			$home_no= $data['home_no'];
			$email = $data['email'];
			$gender = $data['gender'];

			
			
			
			
		}
	}
	
	



	
	$sql = "select course_id from ".TB_COURSE_PAYMENT_ITEM;
	$sql .= " where  ";
	$sql .= " course_payment_id='".$course_payment_id."'  ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$course_id = $data['course_id'];
			/////////////////////////////////////////////
			
			

			
			if($reduced_qty == '1' && ($payment_status_id == '5'  || $payment_status_id == '6' )){
				
				
				$sql = "update ".TB_COURSE_PAYMENT;
				$sql .= "  set reduced_qty ='0' ";
				$sql .= " where  ";
				$sql .= "  id='".$course_payment_id."' ";
				$G_DB_CONNECT->query($sql);
				
				
				$sql = "delete from ".TB_COURSE_MEMBER." where course_id='".$course_id."'  and member_id='".$member_id."' and course_payment_id='$course_payment_id' ";
				$G_DB_CONNECT->query($sql);
				
				
				
			}else if($reduced_qty == '0' && ($payment_status_id == '1'  || $payment_status_id == '2'  || $payment_status_id == '3'  || $payment_status_id == '4' )){
				
			
				
				
				$sql = "update ".TB_COURSE_PAYMENT;
				$sql .= "  set reduced_qty ='1' ";
				$sql .= " where  ";
				$sql .= "  id='".$course_payment_id."' ";
				$G_DB_CONNECT->query($sql);
				
				
				
				$sql = "delete from ".TB_COURSE_MEMBER." where course_id='".$course_id."'  and member_id='".$member_id."'  and course_payment_id='$course_payment_id' ";
				$G_DB_CONNECT->query($sql);
				
				$update_course_member_data = array();
				$update_course_member_data['surname_en'] = $surname_en;
				$update_course_member_data['home_no'] = $home_no;
				$update_course_member_data['email'] = $email;
				$update_course_member_data['gender'] = $gender;
				$update_course_member_data['member_id'] = $member_id;
				$update_course_member_data['course_id'] = $course_id ;
				$update_course_member_data['course_payment_id'] = $course_payment_id;
				
				
				$G_DB_CONNECT->query_insert(TB_COURSE_MEMBER, $update_course_member_data);
				
				
				
			}

			/*
			
			
			$sql = "update ".TB_COURSE;
			$sql .= "  set qty ='".$qty."' ";
			$sql .= " where  ";
			$sql .= "  id='".$course_id."' ";
			$G_DB_CONNECT->query($sql);
			*/
			

			
			
			
			
			/////////////////////////////////////////////
		}
	}
	
}



function getUsedScore($member_score_money){
	return round_to((($member_score_money/SCORE_TO_MONEY_RATIO_MONEY)*SCORE_TO_MONEY_RATIO_SCORE)/CURRENCY_RATIO);
}

function getMemberScoreInfo($member_id){

	global $G_DB_CONNECT;
	
	$arr_data = array();
	
	$score_desc = '';
	$score = 0;
	$money_desc = '';
	$money = 0;
	$enough_to_use = false;
	$min_score = 0;
	$max_score = 0;
	$min_score = SCORE_TO_MONEY_RATIO_SCORE/SCORE_TO_MONEY_RATIO_MONEY;
	
	
	$sql = "select score from ".TB_MEMBER;
	$sql .= " where disabled='0' ";
	$sql .= " and id='".$member_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$score = $data['score'];
			
		}
	}
	
	
	if($score > 0){
		$money = getFinalScoreMoney($score);
	}
	$score_desc = $score."".TITLE_MEMBER_SCORE_UNIT;
	$money_desc = displayPriceOnly2($money);
	
	
	//echo $money;
	/*
	if($money > 0){
		$enough_to_use = true;
	}
	*/
	

	if($score >= $min_score){
		$enough_to_use = true;
	}
	

	
	$max_score = $score;
	$arr_data['score_desc'] = $score_desc;
	$arr_data['score'] = $score;
	$arr_data['money_desc'] = $money_desc;
	$arr_data['money'] = $money;
	$arr_data['enough_to_use'] = $enough_to_use;
	$arr_data['min_score'] = $min_score;
	$arr_data['max_score'] = $max_score;
	
	return $arr_data;
	
	
}

function getFinalScoreMoney($score){
	return priceWithCurrenyRatioFromScore(($score/SCORE_TO_MONEY_RATIO_SCORE)*SCORE_TO_MONEY_RATIO_MONEY);
}


function getFinalMemberScoreInfo($member_id,$use_score = 0,$max_use_money=0){

	global $G_DB_CONNECT;
	

	
	$arr_data = getMemberScoreInfo($member_id);
	$arr_data['final_use_member_score'] = 0;
	$arr_data['final_use_member_score_money'] = 0;
	
if($arr_data['enough_to_use'] && $use_score > 0){
	
	if($use_score > $arr_data['max_score']){
		$use_score = $arr_data['max_score'];
	}
	if($use_score >= $arr_data['min_score'] && $use_score <= $arr_data['max_score']){
		
		$max_member_score_money = getFinalScoreMoney($use_score);

		if($max_member_score_money > 0){
			if($max_member_score_money >= $max_use_money){
				$member_score_money = $max_use_money;
				$use_score = getUsedScore($member_score_money );
			}else {
				$member_score_money = $max_member_score_money;
			}
		}
		
	}
}
	
	

	
	$arr_data['final_use_member_score_money']  = $member_score_money;
	$arr_data['final_use_member_score']  = $use_score;
	
	
	
	return $arr_data;
	
	
	
	
	
}



function getDeliveryAreaInfo($delivery_method_id){

	global $G_DB_CONNECT;
	
	$sql = "select delivery_method.id,delivery_method.country_id,delivery_method_desc.name from ".TB_DELIVERY_METHOD." as delivery_method, ".TB_DELIVERY_METHOD_DESC." as delivery_method_desc ";
	$sql .= " where disabled='0' ";
	$sql .= " and delivery_method.id=delivery_method_desc.delivery_method_id ";
	$sql .= " and delivery_method_desc.language_id = '".CURRENT_LANG."' ";
	$sql .= " and id='".$delivery_method_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$country_id = $data['country_id'];
			$name = $data['name'];
		}
	}
	$sql = "select country.id,country_desc.name from ".TB_COUNTRY." as country, ".TB_COUNTRY_DESC." as country_desc ";
	$sql .= " where disabled='0' ";
	$sql .= " and country.id=country_desc.country_id ";
	$sql .= " and country_desc.language_id = '".CURRENT_LANG."' ";
	$sql .= " and id='".$country_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){

			$country_name = $data['name'];
		}
	}
	
	
	return $country_name." : ".$name;
	
	
}

function cart_getDeliveryMethodPrice($delivery_method_id){

	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['price_desc'] = '';
	$arr_data['price_desc_normal'] = '';
	$arr_data['price'] = 0;
	$price = 0;
	

	$total_weight = cart_getTotalWeight();
	
	
	
	$sql = "select price,weight_extra_weight_larger_than,weight_extra_each_weight,weight_extra_price from ".TB_DELIVERY_METHOD;
	$sql .= " where id='".$delivery_method_id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$price = $data['price'];
			
			$weight_extra_weight_larger_than = $data['weight_extra_weight_larger_than'];
			$weight_extra_each_weight = $data['weight_extra_each_weight'];
			$weight_extra_price = $data['weight_extra_price'];
			
		}
	}
	/////////////////////////////////////////
	$sql = "select price  from ".TB_DELIVERY_METHOD_WEIGHT_FEE;
	$sql .= " where delivery_method_id='".$delivery_method_id."' ";
	$sql .= " and weight_less_than>='".$total_weight."' ";
	$sql .= " order by weight_less_than asc limit 0,1 ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$price += $data['price'];
		}
	}else{
		
		$sql = "select weight_less_than,price  from ".TB_DELIVERY_METHOD_WEIGHT_FEE;
		$sql .= " where delivery_method_id='".$delivery_method_id."' ";
		$sql .= " order by weight_less_than asc limit 0,1 ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$min_price = $data['price'];
				$weight_less_than = $data['weight_less_than'];
			}
		}
		
		
		$sql = "select weight_less_than,price  from ".TB_DELIVERY_METHOD_WEIGHT_FEE;
		$sql .= " where delivery_method_id='".$delivery_method_id."' ";
		$sql .= " order by weight_less_than desc limit 0,1 ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$max_price = $data['price'];
				$weight_less_than = $data['weight_less_than'];
			}
		}
		
		if($total_weight <= $weight_less_than ){
			$price += $min_price;
		}else if($total_weight >= $weight_less_than ){
			$price += $max_price;
		}
		
		
		
	}
	

	/////////////////////////////////////////
	
	/////////////////////////////////////////
	if($weight_extra_weight_larger_than > 0 && $total_weight > $weight_extra_weight_larger_than){
		$other_price =  (($total_weight - $weight_extra_weight_larger_than)/$weight_extra_each_weight)*$weight_extra_price;
		
		$price += $other_price;
	}	
	
	
	
	$price = priceWithCurrenyRatio($price);
	
	$price_desc = displayPriceOnly2($price);
	
	$arr_data['price_desc'] = '<br><span class="highlight">'.$price_desc.'</span>';
	$arr_data['price'] = $price;
	$arr_data['price_desc_normal'] = $price_desc;
	
	return $arr_data;
	
	
	
	
}

function cart_getTotalWeight(){
	global $G_DB_CONNECT;
	$total_weight = 0;
	
	$sql = "select product_id,sum(qty) as qty from ".TB_CART." as cart  ";
	$sql .= " where session_id='".SESSION_ID."' ";
	$sql .= " and qty>0 ";
	$sql .= " group by product_id ";

	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$product_id = $data['product_id'];
			$qty = $data['qty'];
			/////////////////////////////////////////
			$sql = "select weight from ".TB_PRODUCT;
			$sql .= " where id='".$product_id."' ";
			$rows2 = $G_DB_CONNECT->query($sql);
			if($G_DB_CONNECT->affected_rows > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$weight = $data2['weight'];
					$total_weight += $weight*$qty;
				}
			}
			
			/////////////////////////////////////////
			
		}
	}
	
	return $total_weight;
	
}


function getProductDiscountDesc($product_id){
	
	$out = '';
	
	global $G_DB_CONNECT;
	$sql = "select * from ".TB_PRODUCT_PRICE_OTHERLIST;
	$sql .= " where product_id='".$product_id."'";
	$sql .= " order by buy_qty asc, each_price asc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$buy_qty = $data['buy_qty'];
			$each_price= $data['each_price'];
			$temp = MSG_PRICE_OTHER_LIST;
			$temp = str_replace('#DATA1#',$buy_qty,$temp );
			$temp = str_replace('#DATA2#',displayPriceOnly2(priceWithCurrenyRatio($each_price)),$temp );
			if($out != ''){
				$out .= "<br>";
			}
			$out .= $temp;
		}
	}
	
	if($out != ''){
		$out = '<div style="clear:both;padding-top:5px;">'.$out.'</div>';
	}
	
	return $out;
	
}

function formatMsgCartID($product_id,$product_color_id){
	return "msg_cart_".$product_id."_".$product_color_id;
}

function printCommonFormDiv(){
	$out = '';
	$out .= HTML_MSG_LOADING;

	$out .='<div class="confirm_msg_info"></div>';
	
	echo $out;
}


function getCourseQTYInfo($course_id){
	
	
	global $G_DB_CONNECT;
	
	$arr_data = array();
	$arr_data["expired"] = true;
	$arr_data["have_qty"] = true;
	
	
	$sql = "select course.id , course.qty, course_desc.name as name from ".TB_COURSE." as course , ".TB_COURSE_DESC." as course_desc ";
	$sql .= " where ";
	$sql .= " course.id=course_desc.course_id ";
	$sql .= " and course_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and course.disabled='0' ";

	$sql .= " and course_id = '".$course_id."' ";
	$sql .= " and course.end_date>='".TODAY."' ";
	
	$sql .= " order by course.end_date desc ";
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$course_id = $data['id'];
			$course_name = $data['name'];
		
			$course_qty = $data['qty'];
			$arr_data["expired"] = false;
			
		}
	}
	
	
	
	
	
	//////////////////////////////////////////////////////
	
	$sql = "select count(*) as total_qty from ".TB_COURSE_MEMBER;
	$sql .= " where ";
	$sql .= " course_id = '".$course_id."' ";
	$rowsc = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($datac = $G_DB_CONNECT->fetch_array($rowsc)){
				$total_qty = $datac['total_qty'];
				if($total_qty >= $course_qty){
					$arr_data["qty_info"] =  $course_qty.TITLE_COURSE_QTY_UNIT." ".TITLE_COURSE_QTY_FULL;
					$arr_data["have_qty"] = false;
				}else if($total_qty > 0 && $total_qty < $course_qty){
					$arr_data["qty_info"] =  $course_qty.TITLE_COURSE_QTY_UNIT." ".str_replace('#DATA1#',$course_qty-$total_qty,TITLE_COURSE_QTY_REMAIN);
					
				}else if($total_qty == 0){
					$arr_data["qty_info"] =  $course_qty.TITLE_COURSE_QTY_UNIT;
					
				}
			}
	}
	return $arr_data;
	
	
	
}



function displayHTML2($incontent,$remove_br=false){
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
	
	
	
	
	
	
	
	$content = str_replace('&nbsp;', '##SPACE##', $content);

	$content = html_entity_decode($content);
	
	$content = str_replace('##SPACE##', '&nbsp;', $content);
	
	
	$from = array("../");
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	
	$from = array("<tbody>", "</tbody>");
	$to   = "";
	$content = str_replace($from, $to, $content);
	
	

$content = str_replace('&#34;', '"', $content);
	


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
	
	
	

	
	

	
	
	


	
	
	$from = array("<p>&nbsp;</p>");
	$to   = '<br />';
	$content = str_replace($from, $to, $content);
	

	
	$from = array('<p class="content" aram');
	$to   = '<param';
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
	
	
	$from = array('& amp;');
	$to   = '&';
	$content = str_replace($from, $to, $content);
	
	/*
	$from = array('<br />');
	$to   = '';
	$content = str_replace($from, $to, $content);
	*/
	
	if($remove_br){
		$from = array('<br />');
		$to   = '';
		$content = str_replace($from, $to, $content);
	}
	
	$from = array('& amp;lt;br /> ');
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	$from = array('& lt;');
	$to   = '<';
	$content = str_replace($from, $to, $content);
	
	$from = array('& gt;');
	$to   = '>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('< /');
	$to   = '</';
	$content = str_replace($from, $to, $content);
	
	
	
	
	
	
	
	$from = array('< br />');
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />');
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">');
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	$from = array('<link href="css/css.css" type="text/css" rel="stylesheet" />');
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	$from = array('</meta>');
	$to   = '';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('<strong>');
	$to   = '<b>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('</strong>');
	$to   = '</b>';
	$content = str_replace($from, $to, $content);
	
	
	$from = array('alt=" ');
	$to   = 'alt=""';
	$content = str_replace($from, $to, $content);
	
	

	
	return $content;
}







function productStockStatus($product_id){
	global $G_DB_CONNECT;
	
	$out = '';
	
	
	$sql = "select product.in_stock from ".TB_PRODUCT." as product , ".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.id=product_desc.product_id ";
	$sql .= " and product_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and product.disabled='0' ";
	$sql .= " and product.id='".$product_id."' ";
	$sql .= " order by  product.sort_order asc ";
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				$product_in_stock = $data['in_stock'];
				if($product_in_stock == 1){
					$out = TITLE_PRODUCT_IN_STOCK;
				}else{
					$out = TITLE_PRODUCT_OUT_STOCK;
				}

			}
	}
	
	
	return $out;
}

function updateMemberEmailListGroup(){
	global $G_DB_CONNECT;
	
	$sql = "select email,surname_en from ".TB_MEMBER;
	$sql .= " where role_id = '4' ";
	$sql .= " and email not in ( ";
								
	$sql .= "select email from ".TB_EMAIL_LIST;
	
	 $sql .= " ) ";							
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		 $update_data = array();
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			  $update_data['group_name'] = 'Handcrafter';
			 $update_data['email'] = $data['email'];
			 $update_data['name'] = $data['surname_en'];
			$G_DB_CONNECT->query_insert(TB_EMAIL_LIST, $update_data); 
		}
	}
	
	
}


function getProductCategory($product_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['name_group'] = '';
	$arr_data['id_group'] = '';
	
	
	
		
	$sql = "select product_category.id as id ,product_category_desc.name as name "; 
	$sql .= ",(select name from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id=product_category.parent_product_category_id and language_id = '".ADMIN_LANG_ID."') as parent_category_name";
	$sql .= " from ".TB_PRODUCT_CATEGORY." as product_category, ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	//$sql .= " product_category.parent_product_category_id > 0 ";
	
	$sql .= "  product_category.id = product_category_desc.product_category_id ";
	$sql .= " and product_category_desc.language_id = '".ADMIN_LANG_ID."'";
	$sql .= " and product_category.disabled<>'".DISABLED_DELETE."' ";
	
	
	$sql .= " and product_category.id in ( ";
	$sql .= " select product_category_id from ".TB_PRODUCT_TO_PRODUCT_CATEGORY; 
	$sql .= " where product_id = '".$product_id."'"; 
										   
	$sql .= " ) ";
	
	
	
	
	
	
	$sql .= " order by parent_category_name asc,sort_order asc ";
	
	

	

	
	

	
	//echo $sql;
	$rows2 = $G_DB_CONNECT->query($sql);
	$c = 0;
	if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
				$c++;
				if($c == 1){
					//$return_data['table_list_content'] .= "<br><br>";
				}else{
					$arr_data['name_group'] .= "<br>";
					$arr_data['id_group'] .= ",";
				}
				//$arr_data['name_group'] .=  $data2['parent_category_name']." &gt; ".$data2['name'];
				$arr_data['name_group'] .=  $data2['name'];
				$arr_data['id_group'] .=  $data2['id'];
			}
		
		
		//$return_data['table_list_content'] .= "<br>";
	}
	
	
	
	return $arr_data;
	
	
	
	
}












function checkDiscountCodeExist($discount_code){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	
	$sql = "select discount.*,discount_desc.name as name from ".TB_DISCOUNT." as discount, ".TB_DISCOUNT_DESC." as discount_desc ";
	$sql .= " where ";
	$sql .= " discount.id = discount_desc.discount_id ";
	$sql .= " and discount_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and discount.disabled='0' ";
	//////////////////////////////////////////////////////////////////////////////
	$sql .= " and TRIM(LOWER(discount.code)) = TRIM(LOWER('".$discount_code."')) ";
	//////////////////////////////////////////////////////////////////////////////
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record == 0){
		$arr_data['warn_msg'] = WARN_DISCOUNT_CODE_NOT_EXIST;
	}else{
		$arr_data['success'] = true;
	}
	
	
	$discount_member_type_id = 1;
	
	$rows = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$discount_member_type_id = $data['discount_member_type_id'];
		}
	}
	
	if($discount_member_type_id == 2){
		if(!$_SESSION['falready_login']  ){
			$arr_data['success'] = false;
			$arr_data['warn_msg'] = 'Invalid Promotion Code';
		}
	}
	
	
	
	
	return $arr_data;
}

function checkDiscountCodeNotExpired($discount_code){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	
	$sql = "select discount.*,discount_desc.name as name,discount_desc.detail as detail from ".TB_DISCOUNT." as discount, ".TB_DISCOUNT_DESC." as discount_desc ";
	$sql .= " where ";
	$sql .= " discount.id = discount_desc.discount_id ";
	$sql .= " and discount_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and discount.disabled='0' ";
	//////////////////////////////////////////////////////////////////////////////
	$sql .= " and TRIM(LOWER(discount.code)) = TRIM(LOWER('".$discount_code."')) ";
	$sql .= " and discount.start_date <='".TODAY."' and discount.end_date >= '".TODAY."' ";
	//////////////////////////////////////////////////////////////////////////////
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record == 0){
		$arr_data['warn_msg'] = WARN_DISCOUNT_CODE_IS_EXPIRED;
	}else{
		$arr_data['success'] = true;
	}
	
	return $arr_data;
}

function checkDiscountCodeStartEffectiveLater($discount_code){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	
	$sql = "select discount.*,discount_desc.name as name,discount_desc.detail as detail from ".TB_DISCOUNT." as discount, ".TB_DISCOUNT_DESC." as discount_desc ";
	$sql .= " where ";
	$sql .= " discount.id = discount_desc.discount_id ";
	$sql .= " and discount_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and discount.disabled='0' ";
	//////////////////////////////////////////////////////////////////////////////
	$sql .= " and TRIM(LOWER(discount.code)) = TRIM(LOWER('".$discount_code."')) ";
	$sql .= " and discount.start_date >'".TODAY."'  ";
	//////////////////////////////////////////////////////////////////////////////
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record == 0){
		
	}else{
		$arr_data['success'] = true;
		$arr_data['warn_msg'] = WARN_DISCOUNT_CODE_NOT_EFFECTIVE_YET;
	}
	
	return $arr_data;
}


function getDiscountInfo($discount_code,$country_id,$delivery_method_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['warn_msg'] = WARN_DISCOUNT_CODE_NOT_EFFECTIVE_IN_SELECTED_ITEM;
	$arr_data['discount_id'] = 0;
	$arr_data['discount_name'] = '';
	$arr_data['discount_detail'] = '';
	$arr_data['discount_type_id'] = '';
	$arr_data['discount_value'] = '';
	$arr_data['discount_percent'] = '';
	$arr_data['discount_value_type_id'] = '';
	$arr_data['purchase_over'] = '';
	$arr_data['discount_condition_id'] = '';
	$arr_data['sql'] = '';

	
	$sql = "select discount.*,discount_desc.name as name,discount_desc.detail as detail from ".TB_DISCOUNT." as discount, ".TB_DISCOUNT_DESC." as discount_desc ";
	$sql .= " where ";
	$sql .= " discount.id = discount_desc.discount_id ";
	$sql .= " and discount_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and discount.disabled='0' ";
	//////////////////////////////////////////////////////////////////////////////
	$sql .= " and TRIM(LOWER(discount.code)) = TRIM(LOWER('".$discount_code."')) ";
	$sql .= " and discount.start_date <='".TODAY."' and discount.end_date >= '".TODAY."' limit 0,1";
	//////////////////////////////////////////////////////////////////////////////
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				//$arr_data['success'] = true;
				$arr_data['discount_id'] = $data['id'];
				$arr_data['discount_name'] = $data['name'];
				$arr_data['discount_detail'] = displayHTML($data['detail']);
				
				$arr_data['discount_type_id'] = $data['discount_type_id'];
				$arr_data['discount_value'] = $data['discount_value'];
				$arr_data['discount_percent'] = $data['discount_percent'];
				$arr_data['discount_value_type_id'] = $data['discount_value_type_id'];
				$arr_data['purchase_over'] = $data['purchase_over'];
				$arr_data['discount_condition_id'] = $data['discount_condition_id'];
		}
		
		
	}
	

	////////////////////////////////////////////////////////////////////////////
	$arr_data_discount = array();
	if($total_record > 0){
		switch($arr_data['discount_type_id']){
			case '1':
				$arr_data_discount = getDiscountProductBrand($arr_data['discount_id'],$arr_data['discount_value'],$arr_data['discount_percent'],$arr_data['discount_value_type_id'],$arr_data['discount_condition_id']);
				break;
			case '2':
				$arr_data_discount = getDiscountProduct($arr_data['discount_id'],$arr_data['discount_value'],$arr_data['discount_percent'],$arr_data['discount_value_type_id'],$arr_data['discount_condition_id']);
				break;
			case '3':
				$arr_data_discount = getDiscountProductCategory($arr_data['discount_id'],$arr_data['discount_value'],$arr_data['discount_percent'],$arr_data['discount_value_type_id'],$arr_data['discount_condition_id']);
				break;
			case '4':
				$arr_data_discount = getDiscountMember($arr_data['discount_id'],$arr_data['discount_value'],$arr_data['discount_percent'],$arr_data['discount_value_type_id'],$arr_data['discount_condition_id']);
				break;
			case '5':
				$arr_data_discount = getDiscountOrder($arr_data['discount_id'],$arr_data['discount_value'],$arr_data['discount_percent'],$arr_data['discount_value_type_id'],$arr_data['discount_condition_id']);
				break;
			case '6':
				$arr_data_discount = getDiscountPurchaseOver($arr_data['discount_id'],$arr_data['discount_value'],$arr_data['discount_percent'],$arr_data['discount_value_type_id'],$arr_data['discount_condition_id'],$arr_data['purchase_over']);
				break;
			case '7':
				$arr_data_discount = getDiscountDeliveryMethod($arr_data['discount_id'],$arr_data['discount_value'],$arr_data['discount_percent'],$arr_data['discount_value_type_id'],$arr_data['discount_condition_id'],$country_id,$delivery_method_id);
				if($country_id == '' || $delivery_method_id == ''){
					if($arr_data['discount_detail'] != ''){
						$arr_data['discount_detail'] .= "<br>";
					}
					$arr_data['discount_detail'] .= WARN_DISCOUNT_CODE_USE_AFTER_SELECT_DELIVERY_METHOD;
				}
				break;
			default:
				break;
			
		}

		
	}
	$arr_data['success'] = $arr_data_discount['success'];
	$arr_data['sql'] = $arr_data_discount['sql'];
	$arr_data['discount'] = $arr_data_discount['discount'];
	//$arr_data['sql'] = $arr_data_discount['sql'];
	if($arr_data['success']){
		$arr_data['warn_msg'] = '';
	}
	//$arr_data['warn_msg'] = $arr_data_discount['sql'];
	////////////////////////////////////////////////////////////////////////////
	
	
	
	

	
	
	
	return $arr_data;
}



function getDiscountProductBrand($discount_id,$discount_value,$discount_percent,$discount_value_type_id,$discount_condition_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
	///////////////////////////////////////////////////
	

	
	
	
	
	$sql = "select product_brand.id from ".TB_PRODUCT_BRAND." as product_brand ";
	$sql .= " where ";
	$sql .= " product_brand.disabled = '0' ";
	////////////////////////////////////////////////////////
	$sql .= " and product_brand.id  in (";
										
	$sql .= " select product.product_brand_id from ".TB_PRODUCT." as product ";	
	$sql .= " where  ";
	$sql .= " product.disabled = '0' ";
	////////////////////////////////////////////////////////
	$sql .= " and product.id  in (";		
	$sql .= " select cart.product_id from ".TB_CART." as cart ";
	$sql .= " where  ";
	$sql .= " cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.qty>0 ";
	$sql .= " group by cart.product_id ";
	$sql .= " ) ";
	////////////////////////////////////////////////////////
	$sql .= " ) ";
	////////////////////////////////////////////////////////
	$sql .= " group by product_brand.id  ";
	$sql .= " order by product_brand.id asc ";
	
	//$arr_data['sql'] .= $sql;
	
	
	
	$arr_cart_product_brand_id = array();
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				array_push($arr_cart_product_brand_id, $data['id']);
		}
	}


	
	////////////////////////////////////////////////////////
	$arr_discount_product_brand_id = array();
	$count_total_match = 0;
	$sql = " select product_brand_id from ".TB_DISCOUNT_PRODUCT_BRAND." as discount_product_brand ";
	$sql .= " where  ";
	$sql .= " discount_id='".$discount_id."' ";
	$sql .= " order by product_brand_id asc ";
	//$arr_data['sql'] .= $sql;
	$rows = $G_DB_CONNECT->query($sql);
	$total_product_brand_for_discount = $G_DB_CONNECT->affected_rows;
	if($total_product_brand_for_discount > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				array_push($arr_discount_product_brand_id,$data['product_brand_id']);
				if (in_array($data['product_brand_id'], $arr_cart_product_brand_id)) {
					$count_total_match++;
				}
		}
	}
	////////////////////////////////////////////////////////
	if($count_total_match > 0){
		
		$total_product_price = 0;
		
		
		
			////////////////////////////////////////////////////////
			// get total product brand price
			////////////////////////////////////////////////////////
			$sql = "select product.id as product_id,product.price as product_price,product.special_price as special_price,cart.qty as product_qty from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
			$sql .= " where cart.session_id='".SESSION_ID."' ";
			$sql .= " and cart.product_id=product.id ";
			$sql .= " and product.disabled= '0' ";
			$sql .= " and cart.qty>0 ";
			////////////////////////////////////////////////
			$sql .= " and product.product_brand_id in (";
			$sql .= convert2StringGroup($arr_discount_product_brand_id);
			$sql .= " )";
			////////////////////////////////////////////////
			$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
			$sql .= " order by product.id asc ";
			////////////////////////////////////////////////
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data = $G_DB_CONNECT->fetch_array($rows)){
					$special_price = $data['special_price'];
					$product_price = $data['product_price'];
					if($special_price > 0 ){
						$product_price = $special_price;
					}
					$total_product_price += $product_price*$data['product_qty'];
					//echo $data['product_price']*$data['product_qty']." : ".$data['product_price']." : ".$data['product_qty'];
					//echo "<br>";
				}
			}
			
			////////////////////////////////////////////////////////
		
		
		
		//echo $total_product_price." : ".$discount_percent;
		
		if($discount_condition_id == '1'){
			$discount = 0;
			if($discount_value_type_id == '1'){
				$discount = calDiscountPercent($total_product_price,$discount_percent);
			}else if($discount_value_type_id == '2'){
				$discount = calDiscountValue($discount_value);
			}
			$arr_data['discount'] = $discount;
			$arr_data['success'] = true;

		}else if($discount_condition_id == '2'){
			if($count_total_match == $total_product_brand_for_discount){
				$discount = 0;
				if($discount_value_type_id == '1'){
					$discount = calDiscountPercent($total_product_price,$discount_percent);
				}else if($discount_value_type_id == '2'){
					$discount = calDiscountValue($discount_value);
				}
				$arr_data['discount'] = $discount;
				$arr_data['success'] = true;
				
			}
		}
		
	}
	
	//$arr_data['discount'] = $arr_data['sql'];
	//$arr_data['sql'] .= "######".$count_total_match." : ######".$total_product_brand_for_discount;
	
	
	
	
	///////////////////////////////////////////////////
	
	
	
	return $arr_data;
	
}









function getDiscountProductCategory($discount_id,$discount_value,$discount_percent,$discount_value_type_id,$discount_condition_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
	///////////////////////////////////////////////////
	

	
	
	
	
	$sql = "select product_category.id from ".TB_PRODUCT_CATEGORY." as product_category ";
	$sql .= " where ";
	$sql .= " product_category.disabled = '0' ";
	////////////////////////////////////////////////////////
	$sql .= " and product_category.id  in (";
						
	
	////////////////////////////////////////////////////////
	$sql2 = '';
	$sql2 .= " select product.product_category_id from ".TB_PRODUCT." as product ";	
	$sql2 .= " where  ";
	$sql2 .= " product.disabled = '0' ";
	$sql2 .= " and product.id  in (";		
	$sql2 .= " select cart.product_id from ".TB_CART." as cart ";
	$sql2 .= " where  ";
	$sql2 .= " cart.session_id='".SESSION_ID."' ";
	$sql2 .= " and cart.qty>0 ";
	$sql2 .= " group by cart.product_id ";
	$sql2 .= " ) ";
	$product_category_group = '';
	$rows = $G_DB_CONNECT->query($sql2);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				if($product_category_group != ''){
					$product_category_group .= ",";
				}
				$product_category_group .= $data['product_category_id'];
		}
	}
	$sql .=  $product_category_group ;
	////////////////////////////////////////////////////////


	$sql .= " ) ";
	////////////////////////////////////////////////////////
	$sql .= " group by product_category.id  ";
	$sql .= " order by product_category.id asc ";
	
	
	//$arr_data['sql'] .= $sql;
	
	
	
	$arr_cart_product_category_id = array();
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				array_push($arr_cart_product_category_id, $data['id']);
		}
	}


	
	////////////////////////////////////////////////////////
	$arr_discount_product_category_id = array();
	$count_total_match = 0;
	$sql = " select product_category_id from ".TB_DISCOUNT_PRODUCT_CATEGORY." as discount_product_category ";
	$sql .= " where  ";
	$sql .= " discount_id='".$discount_id."' ";
	$sql .= " order by product_category_id asc ";
	//$arr_data['sql'] .= $sql;
	$rows = $G_DB_CONNECT->query($sql);
	$total_product_category_for_discount = $G_DB_CONNECT->affected_rows;
	if($total_product_category_for_discount > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				array_push($arr_discount_product_category_id,$data['product_category_id']);
				if (in_array($data['product_category_id'], $arr_cart_product_category_id)) {
					$count_total_match++;
				}
		}
	}
	////////////////////////////////////////////////////////
	if($count_total_match > 0){
		
		$total_product_price = 0;
		
		
		
			////////////////////////////////////////////////////////
			// get total product brand price
			////////////////////////////////////////////////////////
			$sql = "select product.id as product_id,product.price as product_price,product.special_price as special_price,cart.qty as product_qty from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
			$sql .= " where cart.session_id='".SESSION_ID."' ";
			$sql .= " and cart.product_id=product.id ";
			$sql .= " and product.disabled= '0' ";
			$sql .= " and cart.qty>0 ";
			////////////////////////////////////////////////
			$sql .= " and product.product_category_id in (";
			$sql .= convert2StringGroup($arr_discount_product_category_id);
			$sql .= " )";
			////////////////////////////////////////////////
			$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
			$sql .= " order by product.id asc ";
			////////////////////////////////////////////////
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data = $G_DB_CONNECT->fetch_array($rows)){
					$special_price = $data['special_price'];
					$product_price = $data['product_price'];
					if($special_price > 0 ){
						$product_price = $special_price;
					}
					$total_product_price += $product_price*$data['product_qty'];
					//$total_product_price += $data['product_price']*$data['product_qty'];
				}
			}
			
			////////////////////////////////////////////////////////
		
		
		
		
		
		if($discount_condition_id == '1'){
			$discount = 0;
			if($discount_value_type_id == '1'){
				$discount = calDiscountPercent($total_product_price,$discount_percent);
			}else if($discount_value_type_id == '2'){
				$discount = calDiscountValue($discount_value);
			}
			$arr_data['discount'] = $discount;
			$arr_data['success'] = true;

		}else if($discount_condition_id == '2'){
			if($count_total_match == $total_product_category_for_discount){
				$discount = 0;
				if($discount_value_type_id == '1'){
					$discount = calDiscountPercent($total_product_price,$discount_percent);
				}else if($discount_value_type_id == '2'){
					$discount = calDiscountValue($discount_value);
				}
				$arr_data['discount'] = $discount;
				$arr_data['success'] = true;
				
			}
		}
		
	}
	
	//$arr_data['discount'] = 44;
	//$arr_data['sql'] .= "######".$count_total_match." : ######".$total_product_category_for_discount;
	
	
	
	
	///////////////////////////////////////////////////
	
	
	
	return $arr_data;
	
}












function getDiscountProduct($discount_id,$discount_value,$discount_percent,$discount_value_type_id,$discount_condition_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
	///////////////////////////////////////////////////
	

	
	
	
	
	$sql = "select product.id from ".TB_PRODUCT." as product ";
	$sql .= " where ";
	$sql .= " product.disabled = '0' ";
	////////////////////////////////////////////////////////
	$sql .= " and product.id  in (";
										
	$sql .= " select product.id from ".TB_PRODUCT." as product ";	
	$sql .= " where  ";
	$sql .= " product.disabled = '0' ";
	////////////////////////////////////////////////////////
	$sql .= " and product.id  in (";		
	$sql .= " select cart.product_id from ".TB_CART." as cart ";
	$sql .= " where  ";
	$sql .= " cart.session_id='".SESSION_ID."' ";
	$sql .= " and cart.qty>0 ";
	$sql .= " group by cart.product_id ";
	$sql .= " ) ";
	////////////////////////////////////////////////////////
	$sql .= " ) ";
	////////////////////////////////////////////////////////
	$sql .= " group by product.id  ";
	$sql .= " order by product.id asc ";
	
	//$arr_data['sql'] .= $sql;
	
	
	
	$arr_cart_product_id = array();
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				array_push($arr_cart_product_id, $data['id']);
		}
	}


	
	////////////////////////////////////////////////////////
	$arr_discount_product_id = array();
	$count_total_match = 0;
	$sql = " select product_id from ".TB_DISCOUNT_PRODUCT." as discount_product ";
	$sql .= " where  ";
	$sql .= " discount_id='".$discount_id."' ";
	$sql .= " order by product_id asc ";
	//$arr_data['sql'] .= $sql;
	$rows = $G_DB_CONNECT->query($sql);
	$total_product_for_discount = $G_DB_CONNECT->affected_rows;
	if($total_product_for_discount > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
				array_push($arr_discount_product_id,$data['product_id']);
				if (in_array($data['product_id'], $arr_cart_product_id)) {
					$count_total_match++;
				}
		}
	}
	////////////////////////////////////////////////////////
	if($count_total_match > 0){
		
		$total_product_price = 0;
		
		
		
			////////////////////////////////////////////////////////
			// get total product brand price
			////////////////////////////////////////////////////////
			$sql = "select product.id as product_id,product.price as product_price,product.special_price as special_price,cart.qty as product_qty from ".TB_CART." as cart,  ".TB_PRODUCT." as product ";
			$sql .= " where cart.session_id='".SESSION_ID."' ";
			$sql .= " and cart.product_id=product.id ";
			$sql .= " and product.disabled= '0' ";
			$sql .= " and cart.qty>0 ";
			////////////////////////////////////////////////
			$sql .= " and product.id in (";
			$sql .= convert2StringGroup($arr_discount_product_id);
			$sql .= " )";
			////////////////////////////////////////////////
			$sql .= " group by cart.product_id,cart.product_color_id,cart.product_size_id ";
			$sql .= " order by product.id asc ";
			////////////////////////////////////////////////
			$rows = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data = $G_DB_CONNECT->fetch_array($rows)){
					$special_price = $data['special_price'];
					$product_price = $data['product_price'];
					if($special_price > 0 ){
						$product_price = $special_price;
					}
					$total_product_price += $product_price*$data['product_qty'];
					//$total_product_price += $data['product_price']*$data['product_qty'];
				}
			}
			
			////////////////////////////////////////////////////////
		
		
		
		
		
		if($discount_condition_id == '1'){
			$discount = 0;
			if($discount_value_type_id == '1'){
				$discount = calDiscountPercent($total_product_price,$discount_percent);
			}else if($discount_value_type_id == '2'){
				$discount = calDiscountValue($discount_value);
			}
			$arr_data['discount'] = $discount;
			$arr_data['success'] = true;

		}else if($discount_condition_id == '2'){
			if($count_total_match == $total_product_for_discount){
				$discount = 0;
				if($discount_value_type_id == '1'){
					$discount = calDiscountPercent($total_product_price,$discount_percent);
				}else if($discount_value_type_id == '2'){
					$discount = calDiscountValue($discount_value);
				}
				$arr_data['discount'] = $discount;
				$arr_data['success'] = true;
				
			}
		}
		
	}
	
	//$arr_data['discount'] = 44;
	//$arr_data['sql'] .= "######".$count_total_match." : ######".$total_product_for_discount;
	
	
	
	
	///////////////////////////////////////////////////
	
	
	
	return $arr_data;
	
}




function getDiscountMember($discount_id,$discount_value,$discount_percent,$discount_value_type_id,$discount_condition_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
	///////////////////////////////////////////////////
	

	
	$sql = "select m.id from ".TB_MEMBER." as m ";
	$sql .= " where ";
	$sql .= " m.role_id='4' ";
	$sql .= " and m.disabled='0' ";
	$sql .= " and m.id='".MEMBER_ID."' ";
	////////////////////////////////////////////////////////
	$sql .= " and m.id  in (";
	$sql .= " select member_id from ".TB_DISCOUNT_MEMBER." as discount_member ";
	$sql .= " where discount_id='".$discount_id."' ";
	$sql .= " ) ";
	////////////////////////////////////////////////////////
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;

	
	if($total_record > 0){
		
		$total_product_price = cart_getTotalItemPrice();
		

		$discount = 0;
		if($discount_value_type_id == '1'){
			$discount = calDiscountPercent($total_product_price,$discount_percent,false);
		}else if($discount_value_type_id == '2'){
			$discount = calDiscountValue($discount_value);
		}
		$arr_data['discount'] = $discount;
		$arr_data['success'] = true;

		
		
	}
	
	//$arr_data['discount'] = 44;
	//$arr_data['sql'] .= "######".$count_total_match." : ######".$total_product_brand_for_discount;
	
	
	
	
	///////////////////////////////////////////////////
	
	
	
	return $arr_data;
	
}








function getDiscountOrder($discount_id,$discount_value,$discount_percent,$discount_value_type_id,$discount_condition_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
	///////////////////////////////////////////////////
	

		
		$total_product_price = cart_getTotalItemPrice()-cart_getMemberDiscount();
		

		$discount = 0;
		if($discount_value_type_id == '1'){
			$discount = calDiscountPercent($total_product_price,$discount_percent,false);
		}else if($discount_value_type_id == '2'){
			$discount = calDiscountValue($discount_value);
		}
		$arr_data['discount'] = $discount;
		$arr_data['success'] = true;

		
		
	
	
	//$arr_data['discount'] = 44;
	//$arr_data['sql'] .= "######".$count_total_match." : ######".$total_product_brand_for_discount;
	
	
	
	
	///////////////////////////////////////////////////
	
	
	
	return $arr_data;
	
}




function getDiscountPurchaseOver($discount_id,$discount_value,$discount_percent,$discount_value_type_id,$discount_condition_id,$purchase_over){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
	///////////////////////////////////////////////////
	

		
	$total_product_price = cart_getTotalItemPrice();
		
	if($total_product_price >= (CURRENCY_RATIO*$purchase_over)){

		$discount = 0;
		if($discount_value_type_id == '1'){
			$discount = calDiscountPercent($total_product_price,$discount_percent,false);
		}else if($discount_value_type_id == '2'){
			$discount = calDiscountValue($discount_value);
		}
		$arr_data['discount'] = $discount;
		$arr_data['success'] = true;
	}

		
		
	
	
	//$arr_data['discount'] = 44;
	//$arr_data['sql'] .= "######".$count_total_match." : ######".$total_product_brand_for_discount;
	
	
	
	
	///////////////////////////////////////////////////
	
	
	
	return $arr_data;
	
}



function getDiscountDeliveryMethod($discount_id,$discount_value,$discount_percent,$discount_value_type_id,$discount_condition_id,$country_id,$delivery_method_id){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
	///////////////////////////////////////////////////
	

		
	$total_product_price = cart_getDeliveryPrice($country_id,$delivery_method_id);
	//$total_product_price = cart_getDeliveryPrice(1,2);
		
	
	if($total_product_price > 0){
		$discount = 0;
		if($discount_value_type_id == '1'){
			$discount = calDiscountPercent($total_product_price,$discount_percent,false);
		}else if($discount_value_type_id == '2'){
			$discount = calDiscountValue($discount_value);
		}
		//////////////////////////////////////////////
		if(-1*$discount > $total_product_price){
			$discount = -1*$total_product_price;
		}
		//////////////////////////////////////////////
		$arr_data['discount'] = $discount;
		$arr_data['success'] = true;
	}
	
	if($country_id == '' || $delivery_method_id == ''){
		$arr_data['success'] = true;
		$arr_data['discount'] = 0;
	}
	

		
		
	
	//$arr_data['discount'] = 44;
	//$arr_data['sql'] .= "######".$count_total_match." : ######".$total_product_brand_for_discount;
	
	
	
	
	///////////////////////////////////////////////////
	
	
	
	return $arr_data;
	
}


function calDiscountPercent($price,$discount_percent,$with_currency_ratio=true){
	$discount_price = $price*(100-$discount_percent)/100;
	$discount_value = $price - $discount_price;
	
	return calDiscountValue($discount_value,$with_currency_ratio);
}
function calDiscountValue($discount_value,$with_currency_ratio=true){
	if($with_currency_ratio){
		return -1*priceWithCurrenyRatio($discount_value);
	}
	
	return -1*$discount_value;
}


function getDiscountCodeInfo($discount_code,$country_id='',$delivery_method_id=''){
	global $G_DB_CONNECT;
	$arr_data = array();
	$arr_data['success'] = false;
	$arr_data['warn_msg'] = '';
	$arr_data['discount_id'] = 0;
	$arr_data['discount_name'] = '';
	$arr_data['discount_detail'] = '';
	$arr_data['discount_type_id'] = '';
	$arr_data['discount_value'] = '';
	$arr_data['discount_percent'] = '';
	$arr_data['discount_value_type_id'] = '';
	$arr_data['purchase_over'] = '';
	$arr_data['discount_condition_id'] = '';
	$arr_data['discount'] = 0;
	$arr_data['sql'] = '';
$arr_data['discount_text2'] = '';
	
	$arr_data_code_exist = checkDiscountCodeExist($discount_code);
	if($arr_data_code_exist['success']){
		$arr_data_code_not_expired = checkDiscountCodeNotExpired($discount_code);
		if($arr_data_code_not_expired['success']){
			//get discount value
			$arr_data_discount = getDiscountInfo($discount_code,$country_id,$delivery_method_id);
			$arr_data['discount_detail'] = $arr_data_discount['discount_detail'];
			$arr_data['success'] = $arr_data_discount['success'];
			$arr_data['warn_msg'] = $arr_data_discount['warn_msg'];
			$arr_data['discount'] = $arr_data_discount['discount'];
			$arr_data['sql'] = $arr_data_discount['sql'];
		}else{
			//$arr_data['warn_msg'] = $arr_data_code_not_expired['warn_msg'];
			$arr_data_code_starteffectivelater = checkDiscountCodeStartEffectiveLater($discount_code);
			if($arr_data_code_starteffectivelater['success']){
				$arr_data['warn_msg'] = $arr_data_code_starteffectivelater['warn_msg'];
			}else{
				$arr_data['warn_msg'] = $arr_data_code_not_expired['warn_msg'];
			}	
			
			
			
			
		}
	}else{
		$arr_data['warn_msg'] = $arr_data_code_exist['warn_msg'];
	}
	
	

		



	//////////////////////////////////////////
		
	if($arr_data['success']){
		$_SESSION['USING_DISCOUNT_CODE'] = $discount_code;
		if($arr_data['discount_detail'] != ''){
			$arr_data['discount_detail'] = WARN_DISCOUNT_CODE_EXIST."<br>".$arr_data['discount_detail'];
		}else{
			$arr_data['discount_detail'] = WARN_DISCOUNT_CODE_EXIST;
		}
		
		$arr_data['discount_text2'] = '-'.(displayPriceOnly2(-1*$arr_data['discount']));
		
	}else{
		$_SESSION['USING_DISCOUNT_CODE'] = '';
	}
	
	$arr_data['discount'] = round_to($arr_data['discount'],0.5);
	
	//$arr_data['discount_detail'] .= " Discount : ".$arr_data['discount'];
	
	
	
	
	
	return $arr_data;
	
}


function installProductDataExcel($file){
	
	importProductDataExcel($file);
	installProductData();
	
}

function importProductDataExcel($file){
	global $G_DB_CONNECT;
	$G_DB_CONNECT->query("delete from ".TB_IMPORT_PRODUCT." ");
	
	

include_once('../includes/classes/excel/read/reader.php');

/////////////////////////
// 		Setting
/////////////////////////
$excelReader = new Spreadsheet_Excel_Reader();
$excelReader->setUTFEncoder('iconv');
$excelReader->setOutputEncoding('UTF-8');

/////////////////////////
// 		Open file
/////////////////////////
$excelReader->read($file);

//error_reporting(E_ALL ^ E_NOTICE);
$update_data = array();
for ($row = 1; $row <= $excelReader->sheets[0]['numRows']; $row++) {
	

for ($i = 1; $i <= 20; $i++) {
	$update_data['col_'.$i] = '';
}


	
if($row > 1){
	if(  trim($excelReader->sheets[0]['cells'][$row][1])  == ''){
			continue;
	}else{
		
			
		for ($column = 1; $column <= $excelReader->sheets[0]['numCols']; $column++) {
		//echo	"$column "."$cell[$column]<br>";
			$cellData = formatStringForSQL(trim($excelReader->sheets[0]['cells'][$row][$column]));
			
			
			if($column == 1 && $cellData == ''){
					break;	
			}
			switch($column){
				case '1':
					$update_data['col_1'] = $cellData;
				break;
				case '2':
					$update_data['col_2'] = $cellData;
				break;
				case '3':
					$update_data['col_3'] = $cellData;
				break;
				case '4':
					$update_data['col_4'] = $cellData;
				break;
				case '5':
					$update_data['col_5'] = $cellData;
				break;
				case '6':
					$update_data['col_6'] = $cellData;
				break;
				case '7':
					$update_data['col_7'] = $cellData;
				break;
				case '8':
					$update_data['col_8'] = $cellData;
				break;
				case '9':
					$update_data['col_9'] = $cellData;
				break;
				case '10':
					$update_data['col_10'] = $cellData;
				break;
				case '11':
					$update_data['col_11'] = $cellData;
				break;
				case '12':
					$update_data['col_12'] = $cellData;
				break;
				case '13':
					$update_data['col_13'] = $cellData;
				break;
				case '14':
					$update_data['col_14'] = $cellData;
				break;
				case '15':
					$update_data['col_15'] = $cellData;
				break;
				case '16':
					$update_data['col_16'] = $cellData;
				break;
				case '17':
					$update_data['col_17'] = $cellData;
				break;
				case '18':
					$update_data['col_18'] = $cellData;
				break;
				case '19':
					$update_data['col_19'] = $cellData;
				break;
				case '20':
					$update_data['col_20'] = $cellData;
				break;
				
			}
			
	}
			$G_DB_CONNECT->query_insert(TB_IMPORT_PRODUCT, $update_data );
			/*
			echo $row." : ".$column;
			echo $cellData;
			echo "<br>";
			*/
}
		/////////////////////////////////
		
		/////////////////////////////////
		
		
		
	}
	//echo "<br>";
	
}



	
	
}








function installProductData(){
	
	
	global $G_DB_CONNECT;
	$long_lang_sign= '##';
	
	
	$sql = "select * "; 
	$sql .= " from ".TB_IMPORT_PRODUCT." as import_product ";
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	$product_sort_order = 0;
	if($total_record > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$product_sort_order++;
			$product_brand_name = $data['col_1'];
			$parent_product_category_name = $data['col_2'];
			$product_category_name = $data['col_3'];
			$product_code = $data['col_4'];
			$product_name = $data['col_5'];
			$product_weight = $data['col_6'];
			$product_price = $data['col_7'];
			$product_special_price = $data['col_8'];
			$product_new = $data['col_9'];
			$product_disabled = $data['col_10'];
			$product_qty = $data['col_11'];
			$product_detail = $data['col_12'];
			$product_composition = $data['col_13'];
			$product_otherinfo = $data['col_14'];
			$product_size_and_fit = $data['col_15'];
			
			$product_seo_keyword = $data['col_16'];
			
			$product_seo_title = $data['col_17'];
			$product_seo_desc = $data['col_18'];
			
			////////////////////////////////////////
			//$arr_product_qty = explode("\n", $product_qty);
			////////////////////////////////////////
			$arr_product_brand_name = explode("\n", $product_brand_name);
			
			$product_brand_name = $arr_product_brand_name[0];
			$update_data = array();
			//$update_data['sort_order'] = 1;
			$update_data['code'] = strtoupper(substr($product_code,0,1));
			$update_data['seo_url'] = formatToSEOURL($product_brand_name);
			$sql = "select * ";
			$sql .= " from ".TB_PRODUCT_BRAND_DESC." as product_brand_desc ";
			$sql .= " where  ";
			$sql .= " TRIM(LOWER(product_brand_desc.name))=LOWER('".$product_brand_name."')  ";
			$sql .= " and language_id = '1'  ";
			$rows2 = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$product_brand_id = $data2['product_brand_id'];
				}

				$G_DB_CONNECT->query_update(TB_PRODUCT_BRAND, $update_data, "id='".$product_brand_id."'"); 
				//echo "update ".$update_data['code'];
				//echo "<br>";
			}else{
				//echo  "insert ".$update_data['code'];
				//echo "<br>";
				//$update_data['create_date'] = 'null';
				
				$product_brand_id = $G_DB_CONNECT->query_insert(TB_PRODUCT_BRAND, $update_data); 
				//////////////////////////////////////////////////////////////
				$update_data_lang = array();
				$update_data_lang['product_brand_id'] = $product_brand_id;
				$update_data_lang['language_id'] = 1;
				$update_data_lang['name'] = $arr_product_brand_name[0];
				$G_DB_CONNECT->query_insert(TB_PRODUCT_BRAND_DESC, $update_data_lang);
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 2;
				$update_data_lang['name'] = $arr_product_brand_name[1];
				$G_DB_CONNECT->query_insert(TB_PRODUCT_BRAND_DESC, $update_data_lang);
				
			}
	

			
			
			////////////////////////////////////////

			
			
			/*
			for ($i=0; $i<count($arr_brand_name); $i++)   {
				//echo $arr_brand_name[$i];
				//echo "<br>";
			}
			*/
			////////////////////////////////////////
			$arr_parent_product_category_name = explode("\n", $parent_product_category_name);
			
			$parent_product_category_name = $arr_parent_product_category_name[0];
			$update_data = array();
			//$update_data['sort_order'] = 1;
			$update_data['seo_url'] = formatToSEOURL($parent_product_category_name);
			$sql = "select * ";
			$sql .= " from ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
			$sql .= " where  ";
			$sql .= " TRIM(LOWER(product_category_desc.name))=LOWER('".$parent_product_category_name."')  ";
			$sql .= " and language_id = '1'  ";
			$rows2 = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$product_category_id = $data2['product_category_id'];
				}
				
				$G_DB_CONNECT->query_update(TB_PRODUCT_CATEGORY, $update_data, "id='".$product_category_id."'"); 
				//echo "update ".$update_data['code'];
				//echo "<br>";
			}else{
				//echo  "insert ".$update_data['code'];
				//echo "<br>";
				//$update_data['create_date'] = 'null';
				
				$product_category_id = $G_DB_CONNECT->query_insert(TB_PRODUCT_CATEGORY, $update_data); 
				$update_data_lang = array();
				$update_data_lang['product_category_id'] = $product_category_id;
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 1;
				$update_data_lang['name'] = $arr_parent_product_category_name[0];
				$G_DB_CONNECT->query_insert(TB_PRODUCT_CATEGORY_DESC, $update_data_lang);
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 2;
				$update_data_lang['name'] =  $arr_parent_product_category_name[1];
				$G_DB_CONNECT->query_insert(TB_PRODUCT_CATEGORY_DESC, $update_data_lang);
				
			}
			////////////////////////////////////////
			//$G_DB_CONNECT->query("delete from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id='".$product_category_id."'");
			
			
			$parent_product_category_id = $product_category_id;
			//echo "<br>";
			/*
			for ($i=0; $i<count($arr_parent_category_name); $i++)   {
				//echo $arr_parent_category_name[$i];
				//echo "<br>";
			}
			*/
			////////////////////////////////////////
			$arr_product_category_name = explode("\n", $product_category_name);
			
			$product_category_name = $arr_product_category_name[0];
			$update_data = array();
			//$update_data['sort_order'] = 1;
			$update_data['parent_product_category_id'] = $parent_product_category_id;
			$update_data['seo_url'] = formatToSEOURL($product_category_name);
			$sql = "select * ";
			$sql .= " from ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
			$sql .= " where  ";
			$sql .= " TRIM(LOWER(product_category_desc.name))=LOWER('".$product_category_name."')  ";
			$sql .= " and language_id = '1'  ";
			$rows2 = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$product_category_id = $data2['product_category_id'];
				
				}
				
				$G_DB_CONNECT->query_update(TB_PRODUCT_CATEGORY, $update_data, "id='".$product_category_id."'"); 
				//echo "update ".$update_data['code'];
				//echo "<br>";
			}else{
				//echo  "insert ".$update_data['code'];
				//echo "<br>";
				//$update_data['create_date'] = 'null';
				
				$product_category_id = $G_DB_CONNECT->query_insert(TB_PRODUCT_CATEGORY, $update_data); 
				$update_data_lang = array();
				$update_data_lang['product_category_id'] = $product_category_id;
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 1;
				$update_data_lang['name'] = $arr_product_category_name[0];
				$G_DB_CONNECT->query_insert(TB_PRODUCT_CATEGORY_DESC, $update_data_lang);
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 2;
				$update_data_lang['name'] = $arr_product_category_name[1];
				$G_DB_CONNECT->query_insert(TB_PRODUCT_CATEGORY_DESC, $update_data_lang);
				
			}
			////////////////////////////////////////
			//$G_DB_CONNECT->query("delete from ".TB_PRODUCT_CATEGORY_DESC." where product_category_id='".$product_category_id."'");
			
			
			
			/*
			for ($i=0; $i<count($arr_category_name); $i++)   {
				//echo $arr_category_name[$i];
				//echo "<br>";
			}
			*/
			////////////////////////////////////////
			$arr_product_name = explode("\n", $product_name);
			$arr_product_seo_title  = explode("\n", $product_seo_title);
			$arr_product_seo_desc  = explode("\n", $product_seo_desc);
			/*
			for ($i=0; $i<count($arr_product_name); $i++)   {
				//echo $arr_product_name[$i];
				//echo "<br>";
			}
			*/
			////////////////////////////////////////
			$arr_product_detail = explode($long_lang_sign, $product_detail);
			
			for ($i=0; $i<count($arr_product_detail); $i++)   {
				$arr_product_detail[$i] = "<p>".str_replace("\n","</p><p>",$arr_product_detail[$i])."</p>";
				$arr_product_detail[$i] = str_replace("<p></p>","",$arr_product_detail[$i]);
				//echo $arr_product_detail[$i];
				//echo "<br>";
			}
			
			////////////////////////////////////////
			$arr_product_composition = explode($long_lang_sign, $product_composition);
			
			for ($i=0; $i<count($arr_product_composition); $i++)   {
				$arr_product_composition[$i] = "<p>".str_replace("\n","</p><p>",$arr_product_composition[$i])."</p>";
				$arr_product_composition[$i] = str_replace("<p></p>","",$arr_product_composition[$i]);
				//echo $arr_product_composition[$i];
				//echo "<br>";
			}
			
			////////////////////////////////////////
			$arr_product_size_and_fit = explode($long_lang_sign, $product_size_and_fit);
			
			for ($i=0; $i<count($arr_product_size_and_fit); $i++)   {
				$arr_product_size_and_fit[$i] = "<p>".str_replace("\n","</p><p>",$arr_product_size_and_fit[$i])."</p>";
				$arr_product_size_and_fit[$i] = str_replace("<p></p>","",$arr_product_size_and_fit[$i]);
				//echo $arr_product_size_and_fit[$i];
				//echo "<br>";
			}
			
			////////////////////////////////////////
			$arr_product_otherinfo = explode($long_lang_sign, $product_otherinfo);
			
			for ($i=0; $i<count($arr_product_otherinfo); $i++)   {
				$arr_product_otherinfo[$i] = "<p>".str_replace("\n","</p><p>",$arr_product_otherinfo[$i])."</p>";
				$arr_product_otherinfo[$i] = str_replace("<p></p>","",$arr_product_otherinfo[$i]);
				//echo $arr_product_otherinfo[$i];
				//echo "<br>";
			}
			
			////////////////////////////////////////
			
			
			if(strtolower($product_new) == 'yes'){
				$product_new = '1';
			}else{
				$product_new = '0';
			}
			////////////////////////////////////////
			if(strtolower($product_disabled) == 'yes'){
				$product_disabled = '0';
			}else{
				$product_disabled = '1';
			}
			
			////////////////////////////////////////
			$update_data = array();
			$update_data['code'] = strtoupper($product_code);
			$update_data['product_category_id'] = $product_category_id;
			$update_data['price'] = $product_price;
			$update_data['special_price'] = $product_special_price;
			//$update_data['discount'] = '';
			$update_data['new_product'] = $product_new;
			$update_data['sort_order'] = $product_sort_order;
			$update_data['product_brand_id'] = $product_brand_id;
	
			$update_data['weight'] = $product_weight;

			//$update_data['remark'] = getRequestVar('remark','');
			$update_data['disabled'] = $product_disabled;
			$update_data['last_update_by'] = '';
			$update_data['create_by'] = '';
			$update_data['last_update_by'] = '';
			$update_data['seo_keyword'] = $product_seo_keyword;
			$update_data['seo_url'] = formatToSEOURL($arr_product_name[0]);
			
			
			////////////////////////////////////////
			
			
			////////////////////////////////////////
			$sql = "select * ";
			$sql .= " from ".TB_PRODUCT." as product ";
			$sql .= " where  ";
			$sql .= " TRIM(LOWER(product.code))=LOWER('".$product_code."')  ";
			$sql .= " and product.disabled<>'".DISABLED_DELETE."' ";
			$rows2 = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$product_id = $data2['id'];
				}
				
				$G_DB_CONNECT->query_update(TB_PRODUCT, $update_data, "id='".$product_id."'"); 
				//echo "update ".$update_data['code'];
				//echo "<br>";
			}else{
				//echo  "insert ".$update_data['code'];
				//echo "<br>";
				$update_data['create_date'] = 'null';
				$product_id = $G_DB_CONNECT->query_insert(TB_PRODUCT, $update_data); 
				
			}
			////////////////////////////////////////
			$G_DB_CONNECT->query("delete from ".TB_PRODUCT_DESC." where product_id='".$product_id."'");
			$update_data_lang = array();
			$update_data_lang['product_id'] = $product_id;
			//////////////////////////////////////////////////////////////
			$update_data_lang['language_id'] = 1;
			$update_data_lang['name'] = $arr_product_name[0];
			$update_data_lang['seo_title'] = $arr_product_seo_title[0];
			$update_data_lang['seo_desc'] = $arr_product_seo_desc[0];
			$update_data_lang['detail'] = $arr_product_detail[1];
			$update_data_lang['size_and_fit'] = $arr_product_size_and_fit[1];
			$update_data_lang['composition'] = $arr_product_composition[1];
			$update_data_lang['otherinfo'] = $arr_product_otherinfo[1];
			$G_DB_CONNECT->query_insert(TB_PRODUCT_DESC, $update_data_lang);
			//////////////////////////////////////////////////////////////
			
			$update_data_lang['language_id'] = 2;
			$update_data_lang['name'] = $arr_product_name[1];
			$update_data_lang['seo_title'] = $arr_product_seo_title[1];
			$update_data_lang['seo_desc'] = $arr_product_seo_desc[1];
			$update_data_lang['detail'] = $arr_product_detail[2];
			$update_data_lang['size_and_fit'] = $arr_product_size_and_fit[2];
			$update_data_lang['composition'] = $arr_product_composition[2];
			$update_data_lang['otherinfo'] = $arr_product_otherinfo[2];
			$G_DB_CONNECT->query_insert(TB_PRODUCT_DESC, $update_data_lang);
			
			
			////////////////////////////////////////
			
			
			
			
			
			
			
			$arr_product_qty = explode("\n", $product_qty);
			////////////////////////////////////////
			
	//$product_size_sort_order = 0  ;
	$G_DB_CONNECT->query("delete from ".TB_PRODUCT_COLOR_SIZE_QTY." where product_id='".$product_id."'");
	for ($i=0; $i<count($arr_product_qty); $i++)   {
			if($arr_product_qty[$i] == ''){
				continue;
			}
			$arr_product_qty_data = explode(",", $arr_product_qty[$i]);
		
			////////////////////////////////////////
			//$product_size_sort_order++;
			$product_size_name = $arr_product_qty_data[0];
			$update_data = array();
			//$update_data['sort_order'] = $product_size_sort_order;
			$sql = "select * ";
			$sql .= " from ".TB_PRODUCT_SIZE_DESC." as product_size_desc ";
			$sql .= " where  ";
			$sql .= " TRIM(LOWER(product_size_desc.name))=TRIM(LOWER('".$product_size_name."'))  ";
			$sql .= " and language_id = '1'  ";
			$rows2 = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$product_size_id = $data2['product_size_id'];
				}
				
				$G_DB_CONNECT->query_update(TB_PRODUCT_SIZE, $update_data, "id='".$product_size_id."'"); 
				//echo "update ".$update_data['code'];
				//echo "<br>";
			}else{
				//echo  "insert ".$update_data['code'];
				//echo "<br>";
				//$update_data['create_date'] = 'null';
				
				$product_size_id = $G_DB_CONNECT->query_insert(TB_PRODUCT_SIZE, $update_data); 
				
			}
			////////////////////////////////////////
			if($total_record == 0){
				$G_DB_CONNECT->query("delete from ".TB_PRODUCT_SIZE_DESC." where product_size_id='".$product_size_id."'");
				$update_data_lang = array();
				$update_data_lang['product_size_id'] = $product_size_id;
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 1;
				$update_data_lang['name'] = $product_size_name;
				$G_DB_CONNECT->query_insert(TB_PRODUCT_SIZE_DESC, $update_data_lang);
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 2;
				$update_data_lang['name'] = $product_size_name;
				$G_DB_CONNECT->query_insert(TB_PRODUCT_SIZE_DESC, $update_data_lang);
			}
			
			////////////////////////////////////////
			
			
			
			
			////////////////////////////////////////
			
			
			
			
			
			
			
			
			
			
			
			
			$product_color_name = $arr_product_qty_data[1];
			$update_data = array();
			//$update_data['sort_order'] = 1;
			$sql = "select * ";
			$sql .= " from ".TB_PRODUCT_COLOR_DESC." as product_color_desc ";
			$sql .= " where  ";
			$sql .= " TRIM(LOWER(product_color_desc.name))=TRIM(LOWER('".$product_color_name."'))  ";
			$sql .= " and language_id = '1'  ";
			$rows2 = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$product_color_id = $data2['product_color_id'];
				}
				
				$G_DB_CONNECT->query_update(TB_PRODUCT_COLOR, $update_data, "id='".$product_color_id."'"); 
				//echo "update ".$update_data['code'];
				//echo "<br>";
			}else{
				//echo  "insert ".$update_data['code'];
				//echo "<br>";
				//$update_data['create_date'] = 'null';
				
				$product_color_id = $G_DB_CONNECT->query_insert(TB_PRODUCT_COLOR, $update_data); 
				
			}
			////////////////////////////////////////
			if($total_record == 0){
				$G_DB_CONNECT->query("delete from ".TB_PRODUCT_COLOR_DESC." where product_color_id='".$product_color_id."'");
				$update_data_lang = array();
				$update_data_lang['product_color_id'] = $product_color_id;
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 1;
				$update_data_lang['name'] = $product_color_name;
				$G_DB_CONNECT->query_insert(TB_PRODUCT_COLOR_DESC, $update_data_lang);
				//////////////////////////////////////////////////////////////
				$update_data_lang['language_id'] = 2;
				$update_data_lang['name'] = $product_color_name;
				$G_DB_CONNECT->query_insert(TB_PRODUCT_COLOR_DESC, $update_data_lang);
			
			
				////////////////////////////////////////
			}
			
			
			
			
			//////////////////////////////////////////////
			$product_qty = $arr_product_qty_data[2];
			$update_data = array();
			$update_data['qty'] = $product_qty ;
			$update_data['product_color_id'] = $product_color_id ;
			$update_data['product_size_id'] = $product_size_id ;
			$update_data['product_id'] = $product_id ;
			$G_DB_CONNECT->query_insert(TB_PRODUCT_COLOR_SIZE_QTY, $update_data);
			/////////////////////////////////////////////
			
			
			
	}
			
			
			//////////////////////////////////////////////////
			installProductSizeAndFit($product_id,$arr_product_size_and_fit[1],$arr_product_size_and_fit[2]);

			//installProductPhoto($product_id,$product_code,$product_color_id);
			//////////////////////////////////////////////////








			
		}
	}
	
	
	
	
	
	
	
	
}




function installProductPhoto($product_id,$product_code,$product_color_id){
	global $G_DB_CONNECT;
	$dirFiles = array();
// opens images folder
$dir = '../images/product/'.$product_code;
if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {

        // strips files extensions      
        $crap   = array(".jpg", ".jpeg", ".JPG", ".JPEG", ".png", ".PNG", ".gif", ".GIF", ".bmp", ".BMP", "_", "-");    

        $newstring = str_replace($crap, " ", $file );   

        //asort($file, SORT_NUMERIC); - doesnt work :(

        // hides folders, writes out ul of images and thumbnails from two folders

        if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails") {
                $dirFiles[] = $dir."/".$file;
        }
    }
    closedir($handle);
}

if(count($dirFiles) > 0){
	$G_DB_CONNECT->query( "delete from ".TB_PRODUCT_PHOTO." where product_id='".$product_id."'");
}


sort($dirFiles);
$count = 0;
foreach($dirFiles as $file)
{
    //echo $file."<br>";
	////////////////////////////////////////////////
			
			
			$fromFile = $file;

			
			$ext = strtolower(get_extension($fromFile));
		if($ext == '.jpg' || $ext == '.jpeg' || $ext == '.png' || $ext == '.gif' || $ext == '.bmp'){
			$count++;
			$new_file_name = $product_code."_".date("YmdHis")."_".getLastID(TB_PRODUCT_PHOTO).$ext;
  			$targetFile =  str_replace('//','/','../images/product/') .$new_file_name ;
			
			copy($fromFile,$targetFile);
			$update_product_photo_data = array();
			$update_product_photo_data['img'] = str_replace("../","",$targetFile);
			$update_product_photo_data['product_color_id'] = $product_color_id;
			$update_product_photo_data['sort_order'] = $count;
			$update_product_photo_data['disabled'] = 0;
			$update_product_photo_data['product_id'] = $product_id;
			$update_product_photo_data['create_date'] = 'null';
			$update_product_photo_data['create_by'] = '';
			$update_product_photo_data['last_update_by'] = '';
			$G_DB_CONNECT->query_insert(TB_PRODUCT_PHOTO, $update_product_photo_data);
		////////////////////////////////////////////////

			smart_resize_image( $targetFile,"img", 350,350, true);
			smart_resize_image( $targetFile,"thumb", 210, 210, true);
			smart_resize_image( $targetFile,"thumb2", 78,78, true);
			smart_resize_image( $targetFile,"thumb3", 50,50, true);
		}
	
	
	
}

	
	
}







function installProductSizeAndFit($product_id,$product_size_and_fit_1,$product_size_and_fit_2){
	
	global $G_DB_CONNECT;

			$sql = "select * ";
			$sql .= " from ".TB_PRODUCT." as product ";
			$sql .= " where  ";
			$sql .= " id='".$product_id."'  ";
			$rows2 = $G_DB_CONNECT->query($sql);
			$total_record = $G_DB_CONNECT->affected_rows;
			if($total_record > 0){
				while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
					$product_code = $data2['code'];
					//////////////////////////////////////
					///////////////////////////////////////
				}
			
			}
			
			
			
			
$out_1 = "";
$out_2 = "";

			
			
if($product_code != ''){

			
			
include_once('../includes/classes/excel/read/reader.php');

/////////////////////////
// 		Setting
/////////////////////////
$excelReader = new Spreadsheet_Excel_Reader();
$excelReader->setUTFEncoder('iconv');
$excelReader->setOutputEncoding('UTF-8');

$file = "../files/size_and_fit/".$product_code.".xls";
if(!file_exists($file)){
	return;
}

/////////////////////////
// 		Open file
/////////////////////////
$excelReader->read($file);


//error_reporting(E_ALL ^ E_NOTICE);

$update_data = array();
$count = 0;

if(strstr(trim($excelReader->sheets[0]['cells'][1][1]) , "#") != '' ){
	$count = 1;	
}

for ($row = 1; $row <= $excelReader->sheets[0]['numRows']; $row++) {
	

for ($i = 1; $i <= 20; $i++) {
	$update_data['col_'.$i] = '';
}



	
//if($row > 1){
	if(  trim($excelReader->sheets[0]['cells'][$row][1])  == ''){
			continue;
	}else{
		
		$count++;
		$class = 'class="odd"';
		if($count % 2 == 0){
			$class = 'class="even"';
		}
		
		
		
		$out_1 .= "<tr ".$class.">";
		$out_2 .= "<tr ".$class.">";
		for ($column = 1; $column <= $excelReader->sheets[0]['numCols']; $column++) {
		//echo	"$column "."$cell[$column]<br>";
			$cellData = trim($excelReader->sheets[0]['cells'][$row][$column]);
			
			
			if($column == 1 && $cellData == ''){
					break;	
			}
			switch($column){
				case '1':
					$update_data['col_1'] = $cellData;
				break;
				case '2':
					$update_data['col_2'] = $cellData;
				break;
				case '3':
					$update_data['col_3'] = $cellData;
				break;
				case '4':
					$update_data['col_4'] = $cellData;
				break;
				case '5':
					$update_data['col_5'] = $cellData;
				break;
				case '6':
					$update_data['col_6'] = $cellData;
				break;
				case '7':
					$update_data['col_7'] = $cellData;
				break;
				case '8':
					$update_data['col_8'] = $cellData;
				break;
				case '9':
					$update_data['col_9'] = $cellData;
				break;
				case '10':
					$update_data['col_10'] = $cellData;
				break;
				case '11':
					$update_data['col_11'] = $cellData;
				break;
				case '12':
					$update_data['col_12'] = $cellData;
				break;
				case '13':
					$update_data['col_13'] = $cellData;
				break;
				case '14':
					$update_data['col_14'] = $cellData;
				break;
				case '15':
					$update_data['col_15'] = $cellData;
				break;
				case '16':
					$update_data['col_16'] = $cellData;
				break;
				case '17':
					$update_data['col_17'] = $cellData;
				break;
				case '18':
					$update_data['col_18'] = $cellData;
				break;
				case '19':
					$update_data['col_19'] = $cellData;
				break;
				case '20':
					$update_data['col_20'] = $cellData;
				break;
				
			}
			
			if($row == 1){
				$cellData = str_replace("#","&nbsp;",$cellData);
			}
			
			
			
			$lang_data = explode("\n", $cellData);
			
			
			$out_1 .= "<td>";
			$out_1 .= $lang_data[0];
			$out_1 .= "</td>";
			
			
			if($lang_data[1] == ''){
				$lang_data[1] = $lang_data[0];
			}
			
			$out_2 .= "<td>";
			$out_2 .= $lang_data[1];
			$out_2 .= "</td>";
			
			
		}
		$out_1 .= "</tr>";
		$out_2 .= "</tr>";
			//$G_DB_CONNECT->query_insert(TB_IMPORT_PRODUCT, $update_data );
			
			//echo $row." : ".$column;
			//echo $cellData;
			//echo "<br>";
			
			
			
	}
		/////////////////////////////////
		
		/////////////////////////////////
		
		
		
//}else{
	//echo "row 1";
	//echo "<br>";
//}
			//echo "<br>";
			
	//$out .= "</tr>";		
}
			
		}	
		
		
		
		
		
		
		
		
		
if($out_1 != ''){
	$out_1 = '<table width="100%" cellspacing="0" cellpadding="0" border="0" id="table_product_size_and_fit">'.$out_1.'</table>';

	
	//echo $out;
	//echo $product_size_and_fit_1.$out;
	$update_data = array();
	$update_data['size_and_fit'] = $product_size_and_fit_1.$out_1;
	$G_DB_CONNECT->query_update(TB_PRODUCT_DESC, $update_data, "product_id='".$product_id."' and language_id='1'"); 
	
	
}else{
	//echo $product_size_and_fit_1;
}



		
if($out_2 != ''){
	$out_2 = '<table width="100%" cellspacing="0" cellpadding="0" border="0" id="table_product_size_and_fit">'.$out_2.'</table>';

	
	//echo $out;
	//echo $product_size_and_fit_1.$out;
	$update_data = array();
	$update_data['size_and_fit'] = $product_size_and_fit_2.$out_2;
	$G_DB_CONNECT->query_update(TB_PRODUCT_DESC, $update_data, "product_id='".$product_id."' and language_id='2'"); 
	
	
}else{
	//echo $product_size_and_fit_1;
}
		
			
	
	
}











function installEmailListDataCSV($file){
	global $G_DB_CONNECT;
	
	/*
$row = 1;
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
*/
//error_reporting(E_ALL ^ E_NOTICE);



$sql = "delete from ".TB_EMAIL_LIST;
$G_DB_CONNECT->query($sql); 

$excel_data = array();
$row = 1;
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
        $num = count($data);
       // echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
	



$update_data = array();


if($row > 2){
	if(  trim($data[0])  == ''){
			continue;
	}else{
		
		$column = 0;
		for ($c=0; $c < $num; $c++) {
		//echo	$c." : ".$data[$c]."<br>";
			$column = $c + 1;
			//$cellData = formatStringForSQL(trim($data[$c]));
			$cellData = trim($data[$c]);
			
			if($column == 1 && $cellData == ''){
					break;	
			}
			switch($column){
				case '1':
					$update_data['group_name'] = $cellData;
				break;
				case '2':
					$update_data['email'] = $cellData;
				break;
				case '3':
					$update_data['name'] = $cellData;
				break;
				case '4':
					$update_data['home_no'] = $cellData;
				break;
				
			}
			
			//echo $row . " : " .$update_data['name'];
			//echo "<br>";
			
			//////////////////////////////////////////////////////////////
			//echo $row." : ".$column;
			//echo $cellData;
			//echo "<br>";
			
	}
	
	
if($update_data['group_name'] == ''){
	//break;
}




$G_DB_CONNECT->query_insert(TB_EMAIL_LIST, $update_data); 
		



//////////////////////////////////////////////////////////////
	
	
	
	//////////////////////////////////////////////////////////////
			
			//$G_DB_CONNECT->query_insert(TB_IMPORT_PRODUCT, $update_data );
			/////////////////////////////////////////////////////////////////
			
			/////////////////////////////////////////////////////////////////
			
			
			
}
		/////////////////////////////////
		
		/////////////////////////////////
		
		
		
	}
	//echo "<br>";
	
    }
    fclose($handle);
}



	
	
}







function getSQLProductCategory($condition = ''){
	if($condition != ''){
		$condition = " and ".$condition;
	}
	
	
	$sql = "select product_category.*,product_category_desc.name as name "; 
	$sql .= " from ".TB_PRODUCT_CATEGORY." as product_category, ".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	$sql .= " product_category.id = product_category_desc.product_category_id ";
	//$sql .= " and product_category.parent_product_category_id ='0' ";
	$sql .= " and product_category_desc.language_id = '".CURRENT_LANG."'";
	$sql .= " and product_category.disabled='0' ";
	$sql .= $condition;
	
	
	$sql .= " order by product_category.sort_order asc ";
	
	return $sql;
}
		
		
		
function printProductCategoryTitle($this_id){
	global $G_DB_CONNECT;
	
	
	
	
	
	$sql = "select * from ".TB_PRODUCT_CATEGORY_PHOTO;
	$sql .= " where id>0 ";
	$sql .= " and disabled='0' ";
	$sql .= " and product_category_id='".$this_id."' ";
	$sql .= " and language_id = '".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$arr_data = getThumbPhotoPath($data2['img'],"",800,43);
			echo '<img src="'.$arr_data['img_path'].'"  />';
		}
	}else{
		
		$this_name = getLangName(TB_PRODUCT_CATEGORY,"name",$this_id,CURRENT_LANG);
		echo '<div id="title_section_text">'.$this_name.'</div>';
	}
	//$this_name = getLangName(TB_PRODUCT_CATEGORY,"name",$this_id,CURRENT_LANG);
		//echo '<div id="title_section_text">'.$this_name.'</div>';
	
}



function printMagazineCategoryTitle($this_id){
	global $G_DB_CONNECT;
	
	

	
	$sql = "select * from ".TB_MAGAZINE_CATEGORY_PHOTO;
	$sql .= " where id>0 ";
	$sql .= " and disabled='0' ";
	$sql .= " and magazine_category_id='".$this_id."' ";
	$sql .= " and language_id = '".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$arr_data = getThumbPhotoPath($data2['img'],"",800,43);
			echo '<img src="'.$arr_data['img_path'].'"  />';
		}
	}else{
		
		$this_name = getLangName(TB_MAGAZINE_CATEGORY,"name",$this_id,CURRENT_LANG);
		echo '<div id="title_section_text2">'.strtoupper($this_name).'</div>';
	}
	//$this_name = getLangName(TB_MAGAZINE_CATEGORY,"name",$this_id,CURRENT_LANG);
		//echo '<div id="title_section_text">'.$this_name.'</div>';
	
}




function printMagazineTitle($this_id){
	global $G_DB_CONNECT;
	
	

	
	$sql = "select * from ".TB_MAGAZINE_PHOTO;
	$sql .= " where id>0 ";
	$sql .= " and disabled='0' ";
	$sql .= " and magazine_id='".$this_id."' ";
	$sql .= " and language_id = '".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$arr_data = getThumbPhotoPath($data2['img'],"",800,43);
			echo '<img src="'.$arr_data['img_path'].'"  />';
		}
	}else{
		
		$this_name = getLangName(TB_MAGAZINE,"name",$this_id,CURRENT_LANG);
		echo '<div id="title_section_text2">'.strtoupper($this_name).'</div>';
	}
	//$this_name = getLangName(TB_MAGAZINE_CATEGORY,"name",$this_id,CURRENT_LANG);
		//echo '<div id="title_section_text">'.$this_name.'</div>';
	
}



function printPressCategoryTitle($this_id){
	global $G_DB_CONNECT;
	
	

	
	$sql = "select * from ".TB_PRESS_CATEGORY_PHOTO;
	$sql .= " where id>0 ";
	$sql .= " and disabled='0' ";
	$sql .= " and press_category_id='".$this_id."' ";
	$sql .= " and language_id = '".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$arr_data = getThumbPhotoPath($data2['img'],"",800,43);
			echo '<img src="'.$arr_data['img_path'].'"  />';
		}
	}else{
		
		$this_name = getLangName(TB_PRESS_CATEGORY,"name",$this_id,CURRENT_LANG);
		echo '<div id="title_section_text2">'.strtoupper($this_name).'</div>';
	}
	//$this_name = getLangName(TB_PRESS_CATEGORY,"name",$this_id,CURRENT_LANG);
		//echo '<div id="title_section_text">'.$this_name.'</div>';
	
}



function printPressTitle($this_id){
	global $G_DB_CONNECT;
	
	

	
	$sql = "select * from ".TB_PRESS_PHOTO;
	$sql .= " where id>0 ";
	$sql .= " and disabled='0' ";
	$sql .= " and press_id='".$this_id."' ";
	$sql .= " and language_id = '".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$arr_data = getThumbPhotoPath($data2['img'],"",800,43);
			echo '<img src="'.$arr_data['img_path'].'"  />';
		}
	}else{
		
		$this_name = getLangName(TB_PRESS,"name",$this_id,CURRENT_LANG);
		echo '<div id="title_section_text2">'.strtoupper($this_name).'</div>';
	}
	//$this_name = getLangName(TB_PRESS_CATEGORY,"name",$this_id,CURRENT_LANG);
		//echo '<div id="title_section_text">'.$this_name.'</div>';
	
}



		
function printProductBrandTitle($this_id){
	global $G_DB_CONNECT;
	
	
	
	
	
	$sql = "select * from ".TB_PRODUCT_BRAND_PHOTO;
	$sql .= " where id>0 ";
	$sql .= " and disabled='0' ";
	$sql .= " and product_brand_id='".$this_id."' ";
	$sql .= " and language_id = '".CURRENT_LANG."' ";
	$sql .= " order by sort_order asc limit 0,1";
	$rows2 = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data2 = $G_DB_CONNECT->fetch_array($rows2)){
			$arr_data = getThumbPhotoPath($data2['img'],"",800,43);
			return '<img src="'.$arr_data['img_path'].'"  />';
		}
	}else{
		
		$this_name = getLangName(TB_PRODUCT_BRAND,"name",$this_id,CURRENT_LANG);
		return '<div id="title_section_text">'.$this_name.'</div>';
	}
	//$this_name = getLangName(TB_PRODUCT_BRAND,"name",$this_id,CURRENT_LANG);
		//echo '<div id="title_section_text">'.$this_name.'</div>';
	
}














function getWebpageSEOInfo($id){
	global $G_DB_CONNECT;
	$arr_data = array();
/*
	/////////////////////////////////////////////////////////////////
	$sql = "select webpage.seo_keyword as seo_keyword,webpage_desc.name as seo_title,webpage_desc.seo_desc as seo_desc from ".TB_WEBPAGE." as webpage,".TB_WEBPAGE_DESC." as webpage_desc";
	$sql .= " where ";
	$sql .= " webpage.id=webpage_desc.webpage_id ";
	$sql .= " and webpage.disabled='0' ";
	$sql .= " and webpage_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and webpage.id='".$id."' ";
	$rows = $G_DB_CONNECT->query($sql);
	$total_record = $G_DB_CONNECT->affected_rows;
	if($total_record > 0){
		while($data = $G_DB_CONNECT->fetch_array($rows)){
			$arr_data["meta_title"] = $data['seo_title'];
			$arr_data["meta_desc"] = $data['seo_desc'];
			$arr_data["meta_keyword"] = $data['seo_keyword'];
		}
	}
	/////////////////////////////////////////////////////////////////
	
	*/
	
	
	
	$webpage_id = $id;
	
	$sql = "select webpage.id as id,webpage_desc.name as name,webpage_desc.detail as detail,webpage_desc.seo_title,webpage_desc.seo_desc,webpage.seo_keyword,webpage_desc.seo_h1 from ".TB_WEBPAGE." as webpage , ".TB_WEBPAGE_DESC." as webpage_desc ";
	$sql .= " where ";
	$sql .= " webpage.id=webpage_desc.webpage_id ";
	$sql .= " and webpage_desc.language_id='".CURRENT_LANG."' ";
	$sql .= " and webpage.disabled='0' ";
	$sql .= " and webpage.id='".$webpage_id."' ";
	$sql .= " order by webpage.sort_order asc limit 0 ,1 ";
	$rows2 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
			while($data2 = $G_DB_CONNECT->fetch_array($rows2)){	
				$webpage_name = $data2['name'];
					
				 $webpage_name = $data2['name'];
				$webpage_detail = displayHTML($data2['detail']);
				
				$meta_title = $data2['seo_title'];
				$meta_desc = formatSEOInfo($data2['seo_desc']);
				$meta_keyword = $data2['seo_keyword'];
				$meta_h1 = $data2['seo_h1'];
				
				if($meta_title == ''){
					$meta_title = $webpage_name;
				}
				if($meta_desc == ''){
					$meta_desc = formatSEOInfo($webpage_detail);
				}
			}
	}

	
	
	
	$arr_data["meta_title"] = $meta_title;
	$arr_data["meta_desc"] = $meta_desc;
	$arr_data["meta_keyword"] = $meta_keyword;
	$arr_data["meta_h1"] = $meta_h1;
	
	
	
	return $arr_data;
	
}





function formatSEOInfo($content){
	/*
	$original_content = $content;
	$content = strip_tags($content);
	$content = trim($content);
	//$content = str_replace("</p><p>","\n",$content);
	$content = str_replace(array("\r", "\n"), array(' ', ' '), $content);
	$content = str_replace(" 
", " ", $content);




	//$content = strip_tags($content);
    $content = trim($content);
	$content = substr($content, 0, 247);
	if($content != '' && strlen($content) < strlen($original_content)){
		$content = $content."...";
	}
	
	*/;
	$content = draftText2(500,$content);
	return $content;
}






function generateHTACCESS($path=""){
/*
	$myFile = $path.DIR_FRONT_END.".htaccess";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = generateHTACCESSContent();

	fwrite($fh, $stringData);
	fclose($fh);

*/
	
	
}



function createRewriteRule($to,$from,$need_same= true){
	global $G_DB_CONNECT;

	$out = "";
	
	if($need_same){
		//$out .= "RewriteRule ^".$to."$ ".$from.TEXT_NEW_LINE;
		
		$out .= "RewriteRule ^".$to."$ ".$from.TEXT_NEW_LINE;
		
		$sql = "select language.id,language.directory  from ".TB_LANGUAGE." as language ";
		$sql .= " where ";
		$sql .= " for_front_page ='1' order by sort_order asc ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				//$out .= createRewriteRule($data['directory']."/".$final_url,$original_url."?lang=".$data['id']);
				$temp_from = '';
				if(strstr($from, "?") != '' ){
				//	$temp_from = $data['directory']."/".$from."&lang=".$data['id'];
					//$temp_from = $from."&lang=".$data['id'];
					if($data['id'] == 1){
						$temp_to = $to."?&l=en-us";
						$temp_from = $from."&lang=1";
					}else if($data['id'] == 2){
						$temp_to = $to."?&l=zh-tw";
						$temp_from = $from."&lang=2";
					}
					
					
				}else{
				//	$temp_from = $from."?lang=".$data['id'];
					if($data['id'] == 1){
						$temp_to = $to."?&l=en-us";
						$temp_from = $from."?lang=1";
					}else if($data['id'] == 2){
						$temp_to = $to."?&l=zh-tw";
						$temp_from = $from."?lang=2";
					}
					
					
					//$temp_from =$data['directory']."/". $from."?lang=".$data['id'];
				}
				/*
				$temp_to = "";
				$temp_to = $data['directory']."/".$to;
					$temp_to = $to;
				*/
				$out .= "RewriteRule ^".$temp_to."$ ".$temp_from.TEXT_NEW_LINE;
				
				
				
				
				
					if($data['id'] == 1){
						$temp_to = $to."?&l=en-us";
						$temp_from = $from."&lang=1";
					}else if($data['id'] == 2){
						$temp_to = $to."?&l=zh-tw";
						$temp_from = $from."&lang=2";
					}
				
				$out .= "RewriteRule ^".$temp_to."$ ".$temp_from.TEXT_NEW_LINE;
				
				
				
				//$out .= "RewriteRule ^".$temp_to."$ ".$temp_from.TEXT_NEW_LINE;
			//	$out .= "RewriteRule ^".$temp_to."$ ".$temp_from.TEXT_NEW_LINE;
				
				
				
			}
		}

	
		
		
		
	}else{
		
		$out .= "RewriteRule ".$to." ".$from.TEXT_NEW_LINE;
		
		$out .= createRewriteRule($final_url,$original_url);
		$sql = "select language.id,language.directory  from ".TB_LANGUAGE." as language ";
		$sql .= " where ";
		$sql .= " for_front_page ='1' order by sort_order asc ";
		$rows = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data = $G_DB_CONNECT->fetch_array($rows)){
				//$out .= createRewriteRule($data['directory']."/".$final_url,$original_url."?lang=".$data['id']);
				$temp_from = '';
				if(strstr($from, "&") != '' ){
					$temp_from = $from."&lang=".$data['id'];
				}else{
					$temp_from = $from."?lang=".$data['id'];
				}
				
				$temp_to = "";
				$temp_to = $data['directory']."/".$to;
				
				$out .= "RewriteRule ".$temp_to." ".$temp_from.TEXT_NEW_LINE;
				
			}
		}
		
		
		
		
		
		//$out .= "RewriteRule ".$to." ".$from.TEXT_NEW_LINE;
	}
	
	
	
	return $out;
	
}


function getLangURL($link){

	global $G_DB_CONNECT;
	return CURRENT_LANG_DIR."/".$link;
	
}


function getOtherLangURL($link,$this_lang_dir){

	$info = pathinfo($_SERVER['PHP_SELF']);
	$this_dir = str_replace("//","/","/".$info['dirname']."/");


	

	if(strstr("/".$link,$this_dir.CURRENT_LANG_DIR."/") != '' ){
		$out = str_replace("/".CURRENT_LANG_DIR."/","/".$this_lang_dir."/","/".$link);
		return substr($out,1);
	}else{
		return "";
	}
	
}






function generateHTACCESSContent(){
	global $G_DB_CONNECT;

	//////////////////////////////////////////////////////////
	//EXAMPLE
	//////////////////////////////////////////////////////////
	//http://corz.org/serv/tricks/htaccess2.php
	//$out .= "RewriteRule ^([^.]+)\.html?$ $1.php [NC] ".REWRITE_BASE.TEXT_NEW_LINE;
	//$out .= "RewriteRule ^(.*)\$ $1 [NC] ".REWRITE_BASE.TEXT_NEW_LINE;
	
	//http://mysite/files/games/hoopy.zip
 	 //http://mysite/download.php?section=games&file=hoopy	
	// RewriteRule ^blog/([0-9]+)-([a-z]+) http://corz.org/blog/index.php?archive=$1-$2 [NC]
	
	//http://mysite/grab?file=my.zip
	//http://mysite/public/files/download/download.php?file=my.zip
	//RewriteRule ^grab /public/files/download/download.php
	//RewriteCond %{HTTP_HOST} ^www\.(.*) [NC]
	

	
	$out = "";
	//$out .= "Options +FollowSymLinks".TEXT_NEW_LINE;
	$out .= "RewriteEngine On".TEXT_NEW_LINE;
	$out .= "RewriteBase ".REWRITE_BASE.TEXT_NEW_LINE;
	$out .= "RewriteCond %{HTTP_HOST} ^www\.(.*) [NC]".TEXT_NEW_LINE;
	$out .= "RewriteRule ^([^.]+)\?$ $1.php [NC] ".TEXT_NEW_LINE;
	$out .= "ErrorDocument 404 ".REWRITE_BASE."page-not-found.php".TEXT_NEW_LINE;
	
	
	/*
$temp_to = '360/IMG_0003%20Panorama_1.html';
$temp_from = 'facilities-view.php?id=1';
$out .=  "RewriteRule ^".$temp_to."$ ".$temp_from.TEXT_NEW_LINE;
	
	
$temp_to = '360/IMG_0031%20Panorama_1.html';
$temp_from = 'facilities-view.php?id=2';
$out .=  "RewriteRule ^".$temp_to."$ ".$temp_from.TEXT_NEW_LINE;
	
	
	
	$temp_to = '360/IMG_0016%20Panorama_1.html';
$temp_from = 'facilities-view.php?id=3';
$out .=  "RewriteRule ^".$temp_to."$ ".$temp_from.TEXT_NEW_LINE;
	
	*/
	
			$out .= createRewriteRuleSharing();
		
		$out .= createRewriteRuleActivities();
		
		$out .= createRewriteRuleProspects();
			$out .= createRewriteRuleNews();
		$out .= createRewriteRuleNews2();
		
			$out .=createRewriteRuleFacilities();
	
$out .= createRewriteRule(formatSEOExt("index"),"index.php");

	$out .= createRewriteRule(formatSEOExt("about"),"about.php");
	$out .= createRewriteRule(formatSEOExt("philosophy"),"philosophy.php");
		$out .= createRewriteRule(formatSEOExt("about"),"philosophy.php");
	
	$out .= createRewriteRule(formatSEOExt("awards"),"awards.php");
	
	$out .= createRewriteRule(formatSEOExt("facilities"),"facilities.php");
	$out .= createRewriteRule(formatSEOExt("staff"),"staff.php");
	$out .= createRewriteRule(formatSEOExt("partners"),"partners.php");
		$out .= createRewriteRule(formatSEOExt("career"),"career.php");
	$out .= createRewriteRule(formatSEOExt("sitemap"),"sitemap.php");
	
	$out .= createRewriteRule(formatSEOExt("course"),"course.php");
	$out .= createRewriteRule(formatSEOExt("courselist"),"courselist.php");
		$out .= createRewriteRule(formatSEOExt("courselist2"),"courselist2.php");
	$out .= createRewriteRule(formatSEOExt("download"),"download.php");
		$out .= createRewriteRule(formatSEOExt("study"),"study.php");
	$out .= createRewriteRule(formatSEOExt("courselist"),"courselist.php");
	$out .= createRewriteRule(formatSEOExt("enquiry"),"enquiry.php");
	
		$out .= createRewriteRule(formatSEOExt("admission"),"admission.php");
		$out .= createRewriteRule(formatSEOExt("procedures"),"procedures.php");
		$out .= createRewriteRule(formatSEOExt("enquiry"),"enquiry.php");
		
			$out .= createRewriteRule(formatSEOExt("student"),"student.php");
			$out .= createRewriteRule(formatSEOExt("activities"),"activities.php");
			$out .= createRewriteRule(formatSEOExt("weather"),"weather.php");
			
			$out .= createRewriteRule(formatSEOExt("media"),"media.php");
		
			$out .= createRewriteRule(formatSEOExt("contact"),"contact.php");
		
			$out .= createRewriteRule(formatSEOExt("scholarships"),"scholarships.php");
			
			$out .= createRewriteRule(formatSEOExt("enls"),"enls.php");
			$out .= createRewriteRule(formatSEOExt("newsletter"),"newsletter.php");
			$out .= createRewriteRule(formatSEOExt("prospect"),"prospect.php");
			
			$out .= createRewriteRule(formatSEOExt("talks"),"talks.php");
			
	$out .= createRewriteRule(formatSEOExt("exchange"),"exchange.php");
		$out .= createRewriteRule(formatSEOExt("events"),"events.php");
			$out .= createRewriteRule(formatSEOExt("campaign"),"campaign.php");

				$out .= createRewriteRule(formatSEOExt("privacy"),"privacy.php");
	$out .= createRewriteRule(formatSEOExt("refund"),"refund.php");
	$out .= createRewriteRule(formatSEOExt("charges"),"charges.php");

		$out .= createRewriteRuleTeam();
			$out .= createRewriteRuleCareer();
				$out .= createRewriteRuleCourseFullTime();
				$out .= createRewriteRuleCoursePartTime();

				
		
	//$out .= "RewriteRule ^([^.]+)\.html?$ $1.php [NC] ".TEXT_NEW_LINE;
	
	
	//$out .= createRewriteRule(formatSEOExt("login"),"login.php");


	/*

	$out .= "RewriteRule ^([^.]+)\?$ $1.php [NC] ".TEXT_NEW_LINE;
*/
/*
	$out .= "RewriteRule ^en/$  index.php?lang=1".TEXT_NEW_LINE;
	$out .= "RewriteRule ^tc/$  index.php?lang=2".TEXT_NEW_LINE;



	$out .= "RewriteCond %{QUERY_STRING} ^id=(.*)$ ".TEXT_NEW_LINE;
	$out .= "RewriteRule ^en/(.*)$ $1.php?id=%1&lang=1 [L]".TEXT_NEW_LINE;

	$out .= "RewriteCond %{QUERY_STRING} ^id=(.*)$ ".TEXT_NEW_LINE;
	$out .= "RewriteRule ^tc/(.*)$ $1.php?id=%1&lang=2 [L]".TEXT_NEW_LINE;
	*/
	//$out .= "RewriteCond %{QUERY_STRING} ^id=(.*)&logout=(.*)&cid=(.*)&pgid=(.*)&t=(.*)&pid=(.*)$ ".TEXT_NEW_LINE;
	//$out .= "RewriteRule ^en/(.*)$ $1.php?id=%1&cid=%2&pgid=%3&t=%4&pid=%5&lang=1 [L]".TEXT_NEW_LINE;










	
	
	//$out .= createRewriteRule(formatSEOExt(SEO_HOME_URL),"index.php");
	////////////////////////////////////////////////////////////////////////
	//$out .= createRewriteRule(formatSEOExt("news"),"blog.php");

	////////////////////////////////////////////////////////////////////////
	/*
	$out .= createRewriteRuleWebpage();
	$out .= createRewriteRuleNews();
	$out .= createRewriteRuleProductCollection();
	$out .= createRewriteRuleProductCategory();
	$out .= createRewriteRuleHomeBanner();
	//$out .= createRewriteRule(formatSEOExt("product-list"),"product-list.php");
	$out .= createRewriteRule(formatSEOExt("product/small-order-zone"),"product-list.php?t=2");

*/

	//$out .= createRewriteRule("products/new","category.php?type=new");


//	$out .= createRewriteRuleProduct();
	
	return $out;
	
}


function getURLRewriteNormalPageOther($seo_url1,$return_original_url=false){
	
	$seo_url = '';
	$original_url = "index.php";
	if(!$return_original_url){
		$seo_url = getLangURL($seo_url1);
	}else{
		$seo_url = $original_url;
	}
	return $seo_url;
}





function formatSEOExt($url){
	return $url.REWRITE_FILE_EXT;
}

function getURLRewriteNormalPage($original_url='',$return_original_url=false){
	
	$seo_url = '';
	if(!$return_original_url){
		if($original_url == 'product-list.php'){
			$original_url = 'product/all';
		}
		if($original_url == 'small-order-zone'){
			$original_url = 'product/small-order-zone';
		}
		if($original_url == 'product-list.php?t=2.php'){
			$original_url = 'product/small-order-zone';
		}
		
		
		
		$seo_url = getLangURL(str_replace(".php",REWRITE_FILE_EXT,$original_url));
	}else{
		$seo_url = $original_url;
	}
	return $seo_url;
}


function getURLRewriteWebpage($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url,original_url from ".TB_WEBPAGE;
		$sql .= " where ";
		$sql .= " disabled='0' ";
		$sql .= " and original_url <> '' ";
		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}


function createRewriteRuleWebpage(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select id,seo_url,original_url from ".TB_WEBPAGE;
	$sql .= " where ";
	$sql .= " disabled='0' ";
	$sql .= " and original_url <> '' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$seo_url = formatSEOExt(clean_url($data3['seo_url']));
			$original_url = $data3['original_url'];
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	return $out;
	
	
}

function getURLRewriteNormalPageHome($return_original_url=false){
	
	$seo_url = '';
	$original_url = "index.php";
	if(!$return_original_url){
		$seo_url = getLangURL('');
	}else{
		$seo_url = $original_url;
	}
	return $seo_url;
}






function getURLRewriteHomeBanner($id,$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';




	if(!$return_original_url){
		
		$sql = "select home_banner.id,home_banner.seo_url as seo_url  from ".TB_HOME_BANNER." as home_banner,".TB_HOME_BANNER_DESC." as home_banner_desc ";
		$sql .= " where ";
		$sql .= " home_banner.disabled='0' ";
		$sql .= " and home_banner.id = home_banner_desc.home_banner_id ";
		$sql .= " and home_banner_desc.language_id='1' ";
		$sql .= " and home_banner.id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$code = $data3['code'];
				$seo_url = getLangURL("promotion/".formatSEOExt(clean_url($data3['seo_url'])));
			}
		}
		
		
	
	}else{
		$seo_url = "promotion-detail.php?id=".$id;
	}
	
	
	return $seo_url;
	
}


function createRewriteRuleHomeBanner(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select home_banner.id,home_banner.seo_url as seo_url  from ".TB_HOME_BANNER." as home_banner,".TB_HOME_BANNER_DESC." as home_banner_desc ";
	$sql .= " where ";
	$sql .= " home_banner.disabled='0' ";
	$sql .= " and home_banner.id = home_banner_desc.home_banner_id ";
	$sql .= " and home_banner_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = "promotion/".formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "promotion.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	return $out;
	
	
}




function createRewriteRuleProductCollection(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select product_collection.id,product_collection.seo_url as seo_url  from ".TB_PRODUCT_COLLECTION." as product_collection,".TB_PRODUCT_COLLECTION_DESC." as product_collection_desc ";
	$sql .= " where ";
	$sql .= " product_collection.disabled='0' ";
	$sql .= " and product_collection.id = product_collection_desc.product_collection_id ";
	$sql .= " and product_collection_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'product/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "product-list.php?pgid=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
			
			
			
			
			
			
			
			
			
			
			
			
			
				/////////////////////////////////////////
			
	$sql = "select product_category.id,product_category.seo_url as seo_url  from ".TB_PRODUCT_CATEGORY." as product_category,".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	$sql .= " product_category.disabled='0' ";
	$sql .= " and product_category.id = product_category_desc.product_category_id ";
	$sql .= " and product_category_desc.language_id='1' ";
	$rows3a = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3a = $G_DB_CONNECT->fetch_array($rows3a)){
			$id2 = $data3a['id'];
			
			$seo_url2 = $seo_url."/".formatSEOExt(clean_url($data3a['seo_url']));
			$original_url = "product-list.php?cid=".$id2."&pgid=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url2,$original_url);	
			/////////////////////////////////////////
			
			
			
			
////////////////////////////////////////////////////////
				/////////////////////////////////////////
			
	$sql = "select product.id,product.seo_url as seo_url  from ".TB_PRODUCT." as product,".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.disabled='0' ";
	$sql .= " and product.id = product_desc.product_id ";
	$sql .= " and product_desc.language_id='1' ";
	$rows4a = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data4a = $G_DB_CONNECT->fetch_array($rows4a)){
			$id3 = $data4a['id'];
			
			$seo_url3 = "product/".formatSEOExt(clean_url($data4a['seo_url']));
			$original_url = "product.php?pid=".$id3;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url3,$original_url);	
			/////////////////////////////////////////
			
			
			$seo_url3 = $seo_url2."/".formatSEOExt(clean_url($data4a['seo_url']));
			$original_url = "product.php?cid=".$id2."&pid=".$id3."&pgid=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url3,$original_url);	
			/////////////////////////////////////////
			
			
			
			$seo_url3 = $seo_url."/".formatSEOExt(clean_url($data4a['seo_url']));
			$original_url = "product.php?pid=".$id3."&pgid=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url3,$original_url);	
			/////////////////////////////////////////
			
			
			
			$seo_url3 = "product/small-order-zone/".formatSEOExt(clean_url($data4a['seo_url']));
			$original_url = "product.php?pid=".$id3."&t=2";
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url3,$original_url);	
			/////////////////////////////////////////
			
			
			$seo_url3 = "product/small-order-zone/".formatSEOExt(clean_url($data3a['seo_url']))."/".formatSEOExt(clean_url($data4a['seo_url']));
			$original_url = "product.php?pid=".$id3."&t=2&cid=".$id2;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url3,$original_url);	
			/////////////////////////////////////////
			
			
		}
	}
			
				/////////////////////////////////////////
///////////////////////////////////////////////////////
			
			
			
			
			
			$seo_url2 = "product/small-order-zone/".formatSEOExt(clean_url($data3a['seo_url']));
			$original_url = "product-list.php?cid=".$id2."&t=2";
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url2,$original_url);	
			/////////////////////////////////////////
			
			
		}
	}
			
				/////////////////////////////////////////
			
			
			
			
			
			
			
			
			
		}
	}
	
	return $out;
	
	
}




function getURLRewriteProductCollection($id,$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';




	if(!$return_original_url){
		
		$sql = "select product_collection.id,product_collection.seo_url as seo_url  from ".TB_PRODUCT_COLLECTION." as product_collection,".TB_PRODUCT_COLLECTION_DESC." as product_collection_desc ";
		$sql .= " where ";
		$sql .= " product_collection.disabled='0' ";
		$sql .= " and product_collection.id = product_collection_desc.product_collection_id ";
		$sql .= " and product_collection_desc.language_id='1' ";
		$sql .= " and product_collection.id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$code = $data3['code'];
				$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3['seo_url'])));
				
				$arr_temp = explode("-",$seo_url);
				$seo_url  = '';
				for($c=0;$c<count($arr_temp );$c++){
					$temp = $arr_temp[$c];
					if(strpos($temp,"wh0")){
						continue;
					}
					
					if($seo_url != ''){
						$seo_url .= '-';
					}
					$seo_url  .= $temp;
				}
				
				
				$seo_url = str_replace('-'.strtolower($code),'',$seo_url);
				
			}
		}
		
		
	
	}else{
		$seo_url = "product.php?pgid=".$id;
	}
	
	
	return $seo_url;
	
}



function getURLRewriteProductCategory($id,$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';




	if(!$return_original_url){
		
		$sql = "select product_category.id,product_category.seo_url as seo_url  from ".TB_PRODUCT_CATEGORY." as product_category,".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
		$sql .= " where ";
		$sql .= " product_category.disabled='0' ";
		$sql .= " and product_category.id = product_category_desc.product_category_id ";
		$sql .= " and product_category_desc.language_id='1' ";
		$sql .= " and product_category.id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$code = $data3['code'];
				$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3['seo_url'])));
			}
		}
		
		
	
	}else{
		$seo_url = "product.php?cid=".$id;
	}
	
	
	return $seo_url;
	
}



function getURLRewriteProductCategory2($id,$product_collection_id,$t=1){
	global $G_DB_CONNECT;
	
	$seo_url = '';




	if(!$return_original_url){
		
		$sql = "select product_category.id,product_category.seo_url as seo_url  from ".TB_PRODUCT_CATEGORY." as product_category,".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
		$sql .= " where ";
		$sql .= " product_category.disabled='0' ";
		$sql .= " and product_category.id = product_category_desc.product_category_id ";
		$sql .= " and product_category_desc.language_id='1' ";
		$sql .= " and product_category.id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$code = $data3['code'];
				$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3['seo_url'])));
				
				
				
				
				
		$sql = "select product_collection.id,product_collection.seo_url as seo_url  from ".TB_PRODUCT_COLLECTION." as product_collection,".TB_PRODUCT_COLLECTION_DESC." as product_collection_desc ";
		$sql .= " where ";
		$sql .= " product_collection.disabled='0' ";
		$sql .= " and product_collection.id = product_collection_desc.product_collection_id ";
		$sql .= " and product_collection_desc.language_id='1' ";
		$sql .= " and product_collection.id = '".$product_collection_id."' ";
		$rows3a = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3a = $G_DB_CONNECT->fetch_array($rows3a)){
		
				
				if($t==1){
					$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3a['seo_url'])).'/'.formatSEOExt(clean_url($data3['seo_url'])));
				}
			}
		}
				
				
				
				
				if($t==2){
					$seo_url = getLangURL("product/small-order-zone/".formatSEOExt(clean_url($data3['seo_url'])));
				}
				
				
				
			}
		}
		
		
	
	}else{
		$seo_url = "product.php?cid=".$id;
	}
	
	
	return $seo_url;
	
}






function createRewriteRuleProductCategory(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select product_category.id,product_category.seo_url as seo_url  from ".TB_PRODUCT_CATEGORY." as product_category,".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
	$sql .= " where ";
	$sql .= " product_category.disabled='0' ";
	$sql .= " and product_category.id = product_category_desc.product_category_id ";
	$sql .= " and product_category_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = "product/".formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "product-list.php?cid=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
			
		
		
		
		
					
////////////////////////////////////////////////////////
				/////////////////////////////////////////
			
	$sql = "select product.id,product.seo_url as seo_url  from ".TB_PRODUCT." as product,".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.disabled='0' ";
	$sql .= " and product.id = product_desc.product_id ";
	$sql .= " and product_desc.language_id='1' ";
	$rows4a = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data4a = $G_DB_CONNECT->fetch_array($rows4a)){
			$id3 = $data4a['id'];
			

			
			
			$seo_url3 = $seo_url."/".formatSEOExt(clean_url($data4a['seo_url']));
			$original_url = "product.php?cid=".$id."&pid=".$id3;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url3,$original_url);	
			/////////////////////////////////////////
			
			
			
			
		}
	}

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			
			
		}
	}
	
	return $out;
	
	
}




function getURLRewriteProduct($id){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select * from ".TB_PRODUCT;
		$sql .= " where ";
		$sql .= " disabled='0' ";
		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				//$seo_url = getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
				//$seo_url = 'news-press/'.formatSEOExt(clean_url($data3['seo_url'])).'.html';
				
				//$seo_url =  getLangURL("our-products-brand-list/".clean_url(getLangName(TB_PRODUCT_BRAND,"name",$data3['product_brand_id'],1))."/".formatSEOExt(clean_url(getLangName(TB_PRODUCT,"name",$data3['id'],1))).'.html');
				
				$product_category_id = $data3['product_category_id'];
			$parent_product_category_id =getDataName(TB_PRODUCT_CATEGORY,'parent_product_category_id',$product_category_id  );
			
			
			$code = $data3['code'];
			
			$seo_url = "../".CURRENT_LANG_DIR."/products/".clean_url(getLangName(TB_PRODUCT_CATEGORY,"name",$parent_product_category_id,1))."/".clean_url(getLangName(TB_PRODUCT_CATEGORY,"name",$product_category_id,1))."/".formatSEOExt(clean_url($data3['seo_url']));
			
/*

	$arr_temp = explode("-",$seo_url);
				$seo_url  = '';
				for($c=0;$c<count($arr_temp );$c++){
					$temp = $arr_temp[$c];
					if(strpos($temp,"wh0") > 0){
						continue;
					}
					
					if($seo_url != ''){
						$seo_url .= '-';
					}
					$seo_url  .= $temp;
				}
				*/
				
				$seo_url = str_replace('-'.strtolower($code),'',$seo_url);



			//$original_url = "our-products-product-detail.php?pid=".$id;
				
			//	$seo_url = "product-detail.php?pid=".$id;
			
			}
		}


	
	
	return $seo_url;
	
}







function getURLRewriteProduct2($id,$product_category_id=0,$product_collection_id=0,$t=1){
	global $G_DB_CONNECT;
	
	$seo_url = '';




	if(!$return_original_url){
		
		$sql = "select product_category.id,product_category.seo_url as seo_url  from ".TB_PRODUCT_CATEGORY." as product_category,".TB_PRODUCT_CATEGORY_DESC." as product_category_desc ";
		$sql .= " where ";
		$sql .= " product_category.disabled='0' ";
		$sql .= " and product_category.id = product_category_desc.product_category_id ";
		$sql .= " and product_category_desc.language_id='1' ";
		$sql .= " and product_category.id = '".$product_category_id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$code = $data3['code'];
				//$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3['seo_url'])));
				
				
				
				
				
		$sql = "select product_collection.id,product_collection.seo_url as seo_url  from ".TB_PRODUCT_COLLECTION." as product_collection,".TB_PRODUCT_COLLECTION_DESC." as product_collection_desc ";
		$sql .= " where ";
		$sql .= " product_collection.disabled='0' ";
		$sql .= " and product_collection.id = product_collection_desc.product_collection_id ";
		$sql .= " and product_collection_desc.language_id='1' ";
 	$sql .= " and product_collection.id = '".$product_collection_id."' ";
		$rows3a = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3a = $G_DB_CONNECT->fetch_array($rows3a)){
		
				
		$sql = "select product.id,product.seo_url as seo_url  from ".TB_PRODUCT." as product,".TB_PRODUCT_DESC." as product_desc ";
		$sql .= " where ";
		$sql .= " product.disabled='0' ";
		$sql .= " and product.id = product_desc.product_id ";
		$sql .= " and product_desc.language_id='1' ";
		 $sql .= " and product.id = '".$id."' ";
		$rows3a2 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3a2 = $G_DB_CONNECT->fetch_array($rows3a2)){
		
				
				if($t==1){
					$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3a['seo_url'])).'/'.formatSEOExt(clean_url($data3['seo_url'])).'/'.formatSEOExt(clean_url($data3a2['seo_url'])));
			
					
					
				}
			}
		}
			
			
			

			
			
			
			}
		}else{
			
			
			
			
			
$sql = "select product.id,product.seo_url as seo_url  from ".TB_PRODUCT." as product,".TB_PRODUCT_DESC." as product_desc ";
		$sql .= " where ";
		$sql .= " product.disabled='0' ";
		$sql .= " and product.id = product_desc.product_id ";
		$sql .= " and product_desc.language_id='1' ";
		 $sql .= " and product.id = '".$id."' ";
		$rows3a2 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3a2 = $G_DB_CONNECT->fetch_array($rows3a2)){
		
				
				if($t==1){
					$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3['seo_url'])).'/'.formatSEOExt(clean_url($data3a2['seo_url'])));
			
					
					
				}
				
				
			if($t==2){
					$seo_url = getLangURL("product/small-order-zone/".formatSEOExt(clean_url($data3['seo_url'])).'/'.formatSEOExt(clean_url($data3a2['seo_url'])));
				}
				
			
				
				
				
			}
		}
			
			
			
			
			
		}
				
				
				
				
			
				
				
				
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
if($product_category_id == 0){		
$sql = "select product_collection.id,product_collection.seo_url as seo_url  from ".TB_PRODUCT_COLLECTION." as product_collection,".TB_PRODUCT_COLLECTION_DESC." as product_collection_desc ";
		$sql .= " where ";
		$sql .= " product_collection.disabled='0' ";
		$sql .= " and product_collection.id = product_collection_desc.product_collection_id ";
		$sql .= " and product_collection_desc.language_id='1' ";
 	$sql .= " and product_collection.id = '".$product_collection_id."' ";
		$rows3a = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3a = $G_DB_CONNECT->fetch_array($rows3a)){
		
				
		$sql = "select product.id,product.seo_url as seo_url  from ".TB_PRODUCT." as product,".TB_PRODUCT_DESC." as product_desc ";
		$sql .= " where ";
		$sql .= " product.disabled='0' ";
		$sql .= " and product.id = product_desc.product_id ";
		$sql .= " and product_desc.language_id='1' ";
		 $sql .= " and product.id = '".$id."' ";
		$rows3a2 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3a2 = $G_DB_CONNECT->fetch_array($rows3a2)){
		
				
				if($t==1){
					$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3a['seo_url'])).'/'.formatSEOExt(clean_url($data3a2['seo_url'])));
			
					
					
				}
			}
		}
	}
	}else{
		
		
		
		
		
		
		
	}
		
		
}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	if($product_collection_id == 0 && $product_category_id == 0){		
$sql = "select product.id,product.seo_url as seo_url  from ".TB_PRODUCT." as product,".TB_PRODUCT_DESC." as product_desc ";
		$sql .= " where ";
		$sql .= " product.disabled='0' ";
		$sql .= " and product.id = product_desc.product_id ";
		$sql .= " and product_desc.language_id='1' ";
		 $sql .= " and product.id = '".$id."' ";
		$rows3a2 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3a2 = $G_DB_CONNECT->fetch_array($rows3a2)){
		
			
				
			if($t==2){
					$seo_url = getLangURL("product/small-order-zone/".formatSEOExt(clean_url($data3a2['seo_url'])));
				}
				
			if($t==1){
					$seo_url = getLangURL("product/".formatSEOExt(clean_url($data3a2['seo_url'])));
				}
				
				
				
			}
		}
			
		
		
		
		
	}
		
		
		
		
		
		
		
	
	}else{
		$seo_url = "product.php?cid=".$id;
	}
	
	
	return $seo_url;
	
}







function createRewriteRuleProduct(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select product.*,product.seo_url as seo_url ,product_desc.name  from ".TB_PRODUCT." as product,".TB_PRODUCT_DESC." as product_desc ";
	$sql .= " where ";
	$sql .= " product.disabled='0' ";
	$sql .= " and product.id = product_desc.product_id ";
	$sql .= " and product_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			/*
			$data3['seo_url'] = $data3['name'];
			$seo_url = "our-products-brand-list/".clean_url(getLangName(TB_PRODUCT_BRAND,"name",$data3['product_brand_id'],1))."/".formatSEOExt(clean_url($data3['seo_url']));
			*/
			$product_category_id = $data3['product_category_id'];
			$parent_product_category_id =getDataName(TB_PRODUCT_CATEGORY,'parent_product_category_id',$product_category_id  );
			$seo_url = "products/".clean_url(getLangName(TB_PRODUCT_CATEGORY,"name",$parent_product_category_id,1))."/".clean_url(getLangName(TB_PRODUCT_CATEGORY,"name",$product_category_id,1))."/".formatSEOExt(clean_url($data3['seo_url']));
			
			$seo_url = str_replace('-'.strtolower($code),'',$seo_url);
			
			
			$original_url = "product-detail.php?pid=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	
	
	
	
	
	return $out;
	
	
}



function getURLRewriteCourse($id,$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';




	if(!$return_original_url){
		
		$sql = "select course.id,course.seo_url as seo_url  from ".TB_COURSE." as course,".TB_COURSE_DESC." as course_desc ";
		$sql .= " where ";
		$sql .= " course.disabled='0' ";
		$sql .= " and course.id = course_desc.course_id ";
		$sql .= " and course_desc.language_id='1' ";
		$sql .= " and course.id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$code = $data3['code'];
				$seo_url = getLangURL("course/".formatSEOExt(clean_url($data3['seo_url'])));
			}
		}
		
		
	
	}else{
		$seo_url = "course-detail.php?id=".$id;
	}
	
	
	return $seo_url;
	
}


function createRewriteRuleCourse(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select course.id,course.seo_url as seo_url  from ".TB_COURSE." as course,".TB_COURSE_DESC." as course_desc ";
	$sql .= " where ";
	$sql .= " course.disabled='0' ";
	$sql .= " and course.id = course_desc.course_id ";
	$sql .= " and course_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = "course/".formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "course-detail.php?id=".$id;
			$out .= createRewriteRule($seo_url,$original_url);	
			
			$seo_url = "course/".formatSEOExt(clean_url($data3['seo_url']))."/apply";
			$original_url = "course-apply.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	return $out;
	
	
}



function getURLRewriteCourseApply($id,$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';




	if(!$return_original_url){
		
		$sql = "select course.id,course.seo_url as seo_url  from ".TB_COURSE." as course,".TB_COURSE_DESC." as course_desc ";
		$sql .= " where ";
		$sql .= " course.disabled='0' ";
		$sql .= " and course.id = course_desc.course_id ";
		$sql .= " and course_desc.language_id='1' ";
		$sql .= " and course.id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$code = $data3['code'];
				$seo_url = getLangURL("course/".formatSEOExt(clean_url($data3['seo_url']))."/apply");
			}
		}
		
		
	
	}else{
		$seo_url = "course-apply.php?id=".$id;
	}
	
	
	return $seo_url;
	
}




function createRewriteRuleTeam(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select team.id,team.seo_url as seo_url  from ".TB_TEAM." as team,".TB_TEAM_DESC." as team_desc ";
	$sql .= " where ";
	$sql .= " team.disabled='0' ";
	$sql .= " and team.id = team_desc.team_id ";
	$sql .= " and team_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'staffdetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "staff-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteTeam($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_TEAM;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'staffdetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'staffdetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}




function createRewriteRuleCareer(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select career.id,career.seo_url as seo_url  from ".TB_CAREER." as career,".TB_CAREER_DESC." as career_desc ";
	$sql .= " where ";
	$sql .= " career.disabled='0' ";
	$sql .= " and career.id = career_desc.career_id ";
	$sql .= " and career_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'careerdetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "career-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteCareer($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_CAREER;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'careerdetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'careerdetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}




function createRewriteRuleCourseFullTime(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select course_fulltime.id,course_fulltime.seo_url as seo_url  from ".TB_COURSE_FULLTIME." as course_fulltime,".TB_COURSE_FULLTIME_DESC." as course_fulltime_desc ";
	$sql .= " where ";
	$sql .= " course_fulltime.disabled='0' ";
	$sql .= " and course_fulltime.id = course_fulltime_desc.course_fulltime_id ";
	$sql .= " and course_fulltime_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'coursedetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "course-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteCourseFullTime($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_COURSE_FULLTIME;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'coursedetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'coursedetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}


function createRewriteRuleCoursePartTime(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select course_parttime.id,course_parttime.seo_url as seo_url  from ".TB_COURSE_PARTTIME." as course_parttime,".TB_COURSE_PARTTIME_DESC." as course_parttime_desc ";
	$sql .= " where ";
	$sql .= " course_parttime.disabled='0' ";
	$sql .= " and course_parttime.id = course_parttime_desc.course_parttime_id ";
	$sql .= " and course_parttime_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'coursedetail2/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "course2-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteCoursePartTime($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_COURSE_PARTTIME;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'coursedetail2/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'coursedetail2/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}


function createRewriteRuleSharing(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select sharing.id,sharing.seo_url as seo_url  from ".TB_SHARING." as sharing,".TB_SHARING_DESC." as sharing_desc ";
	$sql .= " where ";
	$sql .= " sharing.disabled='0' ";
	$sql .= " and sharing.id = sharing_desc.sharing_id ";
	$sql .= " and sharing_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'sharing/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "other-sharing-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteSharing($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_SHARING;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'sharing/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'sharing/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}


function getURLRewriteFacilities($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_FACILITIES;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'facilitiesdetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'facilitiesdetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}






function createRewriteRuleActivities(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select activities.id,activities.seo_url as seo_url  from ".TB_ACTIVITIES." as activities,".TB_ACTIVITIES_DESC." as activities_desc ";
	$sql .= " where ";
	$sql .= " activities.disabled='0' ";
	$sql .= " and activities.id = activities_desc.activities_id ";
	$sql .= " and activities_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'newsletterdetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "newsletter-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteActivities($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_ACTIVITIES;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'newsletterdetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'newsletterdetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}









function createRewriteRuleProspects(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select prospects.id,prospects.seo_url as seo_url  from ".TB_PROSPECTS." as prospects,".TB_PROSPECTS_DESC." as prospects_desc ";
	$sql .= " where ";
	$sql .= " prospects.disabled='0' ";
	$sql .= " and prospects.id = prospects_desc.prospects_id ";
	$sql .= " and prospects_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'prospectdetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "prospect-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteProspects($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_PROSPECTS;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'prospectdetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'prospectdetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}







function createRewriteRuleNews(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select news.id,news.seo_url as seo_url  from ".TB_NEWS." as news,".TB_NEWS_DESC." as news_desc ";
	$sql .= " where ";
	$sql .= " news.disabled='0' ";
	$sql .= " and news.id = news_desc.news_id ";
	$sql .= " and news_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'talksdetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "talks-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteNews($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_NEWS;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'talksdetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'talksdetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}







function createRewriteRuleNews2(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select news2.id,news2.seo_url as seo_url  from ".TB_NEWS2." as news2,".TB_NEWS2_DESC." as news2_desc ";
	$sql .= " where ";
	$sql .= " news2.disabled='0' ";
	$sql .= " and news2.id = news2_desc.news2_id ";
	$sql .= " and news2_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'mediadetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "media-detail.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}


function getURLRewriteNews2($id,$original_url='',$return_original_url=false){
	global $G_DB_CONNECT;
	
	$seo_url = '';


		$sql = "select id,seo_url from ".TB_NEWS2;
		$sql .= " where ";
		$sql .= " disabled='0' ";

		$sql .= " and id = '".$id."' ";
		$rows3 = $G_DB_CONNECT->query($sql);
		if($G_DB_CONNECT->affected_rows > 0){
			while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
				$seo_url = 'mediadetail/'.getLangURL(formatSEOExt(clean_url($data3['seo_url'])));
					$seo_url = 'mediadetail/'.clean_url($data3['seo_url']);
				$original_url = $data3['original_url'];
			
			}
		}


	if(!$return_original_url){
		
	
	}else{
		$seo_url = $original_url;
	}
	
	
	return $seo_url;
	
}


function createRewriteRuleFacilities(){
	global $G_DB_CONNECT;
	$out = '';
	
	
	$sql = "select facilities.id,facilities.seo_url as seo_url  from ".TB_FACILITIES." as facilities,".TB_FACILITIES_DESC." as facilities_desc ";
	$sql .= " where ";
	$sql .= " facilities.disabled='0' ";
	$sql .= " and facilities.id = facilities_desc.facilities_id ";
	$sql .= " and facilities_desc.language_id='1' ";
	$rows3 = $G_DB_CONNECT->query($sql);
	if($G_DB_CONNECT->affected_rows > 0){
		while($data3 = $G_DB_CONNECT->fetch_array($rows3)){
			$id = $data3['id'];
			$code = $data3['code'];
			$seo_url = 'facilitiesdetail/'.formatSEOExt(clean_url($data3['seo_url']));
			$original_url = "facilities-view.php?id=".$id;
			/////////////////////////////////////////
			$out .= createRewriteRule($seo_url,$original_url);	
			/////////////////////////////////////////
		}
	}
	
	
	
	

	
	
	
	
	
	return $out;
	
	
}




?>