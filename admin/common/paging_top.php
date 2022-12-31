<?php





$pageParamName = 'page';
$_SESSION['RECORDS_PER_PAGE'] = $recordsPerPage = RECORDS_PER_PAGE;
//$_SESSION['RECORDS_PER_PAGE'] = $recordsPerPage = 2;
/*
if($recordsPerPage == ''){
	$recordsPerPage  = $_SESSION['RECORDS_PER_PAGE'];
}else{
	$_SESSION['RECORDS_PER_PAGE'] = $recordsPerPage;
}
*/
$noOfNumberedLinks = 5;
////////////////////////////////////
// 	How many records ?
////////////////////////////////////
//no of record in this gpage
/*
$res_gpage = mysql_query(PAGING_SQL);
$numRows = mysql_num_rows($res_gpage);
*/

$res_gpage = $G_DB_CONNECT->query(PAGING_SQL);
$numRows =$G_DB_CONNECT->affected_rows;



////////////////////////////////////
// 		Paginator setting
////////////////////////////////////
// name of url param that stores actual gpage-no
$strParamPage = $pageParamName;
// set the actual gpage-no
$page = (isset($_REQUEST[$strParamPage]) && !empty($_REQUEST[$strParamPage])) ? $_REQUEST[$strParamPage] : 1;


// include the class
include_once(DIR_LIB.'classes/paginator/rc_paginator_Output.class.php');
// create a new instance of the class
$objPaginate = new rc_paginator_Output($page, $numRows);

// optional: how many records per gpage should be displayed?
// class uses 10 per default
$objPaginate->setRecordsPerPage($recordsPerPage);

// optional: how many numbered myLinks should be displayed before/after the actual gpage number?
// can also be set directly calling the respective method. see below.
$objPaginate->setCntNumberedLinks($noOfNumberedLinks);

// optional: what should the names of the myLinks be?
// default values are: first, last, prev, next, gpage
$objPaginate->setnames('start', 'end', '&lt;&lt;', '&gt;&gt;', $strParamPage);

// optional: if needed, add some additional REQUEST param/value pairs
if(!isset($gArrCommonPostGetVar)){
	$gArrCommonPostGetVar = array();
}

$getParams =array();
//$getParams = array(	'sid' => CURRENT_SECTION_ID);
//$getParams = array_merge($getGlobalParams, $getParams);
$objPaginate->setGetParams($getParams);



// now we need to get some useful values.. ;)

// total no. of gpages
$gpages_total = $objPaginate->getPagesTotal();
// MySQL LIMIT parameter 1
$limit1 = $objPaginate->getLimit1();
// MySQL LIMIT parameter 2
$limit2 = $objPaginate->getLimit2();
// previous gpage no.
$prev = $objPaginate->getPrev();
// next gpage no.
$next = $objPaginate->getNext();
// last gpage no.
$last = $objPaginate->getLast();
// first gpage no. - usually this is gpage 1 ;)
$first = 1;

// let's display those values







//$out .= $gpageLinkInfo;
		
        




?>