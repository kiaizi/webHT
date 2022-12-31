<?php 

$objPaginate->setNames(PAGING_FIRST, PAGING_LAST, PAGING_PREV, PAGING_NEXT, $pageParamName);



$PageTotal = $objPaginate->getPagesTotal();


$CurrentPageNo = $objPaginate->actual;


$NextPageNo = $objPaginate->getNext();


$PreviousPageNo = $objPaginate->getPrev();



$gpageLinkInfo = $objPaginate->dispFull('', $noOfNumberedLinks);

$currentPageInfo = TITLE_CURRENT_PAGE_1." ".$objPaginate->actual." / ".$objPaginate->getPagesTotal()." ".TITLE_CURRENT_PAGE_2;


$totalRecordInfo = TITLE_TOTAL_RECORD." ".$objPaginate->recordsTotal." ".TITLE_NUM_OF_RECORD;


function print_paging_content($currentPageInfo,$totalRecordInfo, $gpageLinkInfo){
	$out = '';
	$out .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"  id="table_section">';
  	$out .= '<tr>';
    $out .= '<td>';
	$out .= '<div id="infonav">';
	$out .= '<ul>';
	$out .= '<li>'.$totalRecordInfo.'</li>';
	$out .= '<li>'.$currentPageInfo.'</li>';
 	$out .= '</ul>';
	$out .= '</div>';
    $out .= '</td>';
    $out .= '<td>';
 	$out .= '<div id="paging">';
	$out .= '<ul>';
	$out .= $gpageLinkInfo;
 	$out .= '</ul>';
	$out .= '</div>';
	$out .= '</td>';
  	$out .= '</tr>';
	$out .= '</table>';

	return $out;

}



?>