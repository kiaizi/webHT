<?php 

include_once('global/global_header.php'); 
 




$SEO_HOME_TITLE1 = 	SEO_HOME_TITLE1;
$SEO_HOME_TITLE2 =  SEO_HOME_TITLE2;
$SEO_HOME_TITLE3 = 	SEO_HOME_TITLE3;

$SEO_HOME_DESC1 = 	SEO_HOME_DESC1;
$SEO_HOME_DESC2 = 	SEO_HOME_DESC2;
$SEO_HOME_DESC3 = 	SEO_HOME_DESC3;
$SEO_HOME_KEYWORD = 	SEO_HOME_KEYWORD;



///////////////////////////////////////////
	$global_meta_title = '';
	$fooer_msg = '';
	$header_msg = '';
	if(CURRENT_LANG == 1){
			$global_meta_title =  $SEO_HOME_TITLE1;
			
	}else if(CURRENT_LANG == 2){
			$global_meta_title =  $SEO_HOME_TITLE2;
	}else if(CURRENT_LANG == 3){
			$global_meta_title =  $SEO_HOME_TITLE3;
	}
	///////////////////////////////////////////

	
	if($arr_seo_info != ''){
		$meta_title = $arr_seo_info['meta_title'];
		$meta_desc = $arr_seo_info['meta_desc'];
		$meta_keyword = $arr_seo_info['meta_keyword'];
		$meta_h1 = $arr_seo_info['meta_h1'];
	}

	
	if($meta_title == ''){
		if(CURRENT_LANG == 1){
			$global_meta_title = $meta_title = $SEO_HOME_TITLE1;
		}else if(CURRENT_LANG == 2){
			$global_meta_title = $meta_title = $SEO_HOME_TITLE2;
		}else if(CURRENT_LANG == 3){
			$global_meta_title = $meta_title = $SEO_HOME_TITLE3;
		}
		$og_title = $meta_title;
	}
	if($meta_desc == ''){
		if(CURRENT_LANG == 1){
			$meta_desc = $SEO_HOME_DESC1;
		}else if(CURRENT_LANG == 2){
			$meta_desc = $SEO_HOME_DESC2;
		}else if(CURRENT_LANG == 3){
			$meta_desc = $SEO_HOME_DESC3;
		}
		$og_desc = $meta_desc;
	}
	if($meta_keyword == ''){
		
			$meta_keyword = $SEO_HOME_KEYWORD;
	
		
	}
	
	if($meta_h1 == ''){
		
			$meta_h1 = $SEO_HOME_H1;
	
		
	}
	
	if($og_image == ''){
		$og_image = OUR_SERVER."images/logo.jpg";
	}
	$og_image = OUR_SERVER."images/logo.jpg";
	
	$og_image = str_replace('/'.CURRENT_LANG_DIR.'/','/',$og_image );
	
	$meta_desc = formatSEOInfo($meta_desc);
	
	
	
	if(!(IN_HOME == '1')){
		if($meta_title != $global_meta_title){
			$meta_title = $meta_title . " | ".$global_meta_title;
			
		}else{
			$meta_title = $global_meta_title;
		}
		
	}
	
?>	
<head>
  

  <meta charset="utf-8">

<meta property="og:type" content="website">
<meta property="og:site_name" content="<?php echo COMPANY_NAME; ?>">
<meta property="og:url" content="<?php echo OUR_SERVER;?>">
<meta property="og:title" content="<?php echo $meta_title; ?>" />
<meta property="og:image" content="<?php echo $og_image; ?>" />
<meta property="og:description" content="<?php echo $meta_desc; ?>" />
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="<?php echo $og_image; ?>">
<meta name="twitter:title" content="<?php echo $meta_title; ?>">
<meta name="twitter:description"  content="<?php echo $meta_desc; ?>" >
<title><?php echo $meta_title; ?></title>
<link rel="icon" href="../favicon.ico" type="image/x-icon" />
<meta name="description" content="<?php echo $meta_desc; ?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />
<meta name="abstract" content="<?php echo $meta_keyword; ?>" />
<meta name="classification" content="<?php echo $meta_title; ?>" />
<meta name="distribution" content="Global" />
<meta name="rating" content="<?php echo $meta_desc; ?>" />
<meta name="copyright" content="Copyright <?php echo COMPANY_NAME; ?>. All Rights Reserved." />
<meta name="robots" content="index,follow" />
<meta http-equiv="Cache-control" content="public">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/bootstrap.min.css?v=2" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/custom.css?v=2">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css?v=2" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?v=2">
  
  <link rel="stylesheet" href="../owlcarousel/assets/owl.carousel.min.css?v=2">
<link rel="stylesheet" href="../owlcarousel/assets/owl.theme.default.min.css?v=2">



  <link rel="stylesheet" href="../css/custom_2.css?v=2">


      <?php

//Detect special conditions devices
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
?>
  
</head>