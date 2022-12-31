<?php
/**
 *	sample for using rc_paginator_Output
 *	
 *	creates some basic linknavigation for navigating through result sets
 */

// establish a db connection
// this is just a sample db connection, you should know how to do this ;)
$user = 'root';
$pass = 'twins317';
$host = 'localhost';
$dbname = 'caa';

$link = mysql_connect($host, $user, $pass);
mysql_select_db($dbname) or die ('cannot open db ' . $dbname . '. ' .mysql_error());

// MUST: get the number of rows of your result; you may do this in your preferred manner ;)
$numRows = mysql_result(mysql_query("SELECT COUNT(*) FROM student_adv"),0);

// name of url param that stores actual page-no
$strParamPage = 'page';
// set the actual page-no
$page = (isset($_GET[$strParamPage]) && !empty($_GET[$strParamPage])) ? $_GET[$strParamPage] : 1;

// include the class
include_once('rc_paginator_Output.class.php');
// create a new instance of the class
$objPaginate = new rc_paginator_Output($page, $numRows);

// optional: how many records per page should be displayed?
// class uses 10 per default
$objPaginate->setRecordsPerPage(10);

// optional: how many numbered links should be displayed before/after the actual page number?
// can also be set directly calling the respective method. see below.
$objPaginate->setCntNumberedLinks(2);

// optional: what should the names of the links be?
// default values are: first, last, prev, next, page
$objPaginate->setNames('start', 'end', '&lt;&lt;', '&gt;&gt;', 'page');

// optional: if needed, add some additional GET param/value pairs
$getParams = array('test' => 'value is this');
$objPaginate->setGetParams($getParams);









// now we need to get some useful values.. ;)

// total no. of pages
$pages_total = $objPaginate->getPagesTotal();
// MySQL LIMIT parameter 1
$limit1 = $objPaginate->getLimit1();
// MySQL LIMIT parameter 2
$limit2 = $objPaginate->getLimit2();
// previous page no.
$prev = $objPaginate->getPrev();
// next page no.
$next = $objPaginate->getNext();
// last page no.
$last = $objPaginate->getLast();
// first page no. - usually this is page 1 ;)
$first = 1;

// let's display those values



// now we have all needed values so we can create some output for navigation

echo '<h1>Here is your custom-made navigation</h1>';

// now run your sql query with the given LIMIT params
$sql = "SELECT * FROM student_adv LIMIT $limit1, $limit2";
// process in any way you prefer; fetch_object is just used as sample.. ;)
$res = mysql_query($sql, $link);
while ($objLine = mysql_fetch_object($res)) {
	// have some output of your field(s)
	echo $objLine->id . '<br />'; // where field is your db-fieldname
	echo $objLine->name . '<br />';
	echo '<br />';
}
// create the page links
$lnk = '<a href="' . $_SERVER["PHP_SELF"] . '?page=' . $prev . '">previous</a>';
$lnk .= ' | ';
$lnk .= '<a href="' . $_SERVER["PHP_SELF"] . '?page=' . $next . '">next</a>';










// ------- display some modified standard linksets

$objPaginate->setNames('First page', 'Last Page', 'Previous page', 'Next page', 'page');

echo '<p>';
echo $objPaginate->dispFull(' | ', 2);
echo '</p>';


?>