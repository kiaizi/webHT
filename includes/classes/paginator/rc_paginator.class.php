<?php
/**
 *	rc_paginator
 *	
 *	@description		object for dividing (slq) queries into several pages
 *	@package			rc_paginator
 *	@author				Rudi Bieller - contact@reducedcomplexity.com
 */
class rc_paginator
{
	/**
	 *	number of records to displayed per page
	 *	@access protected
	 *	@var int
	 */
	var $recordsPerPage;
	/**
	 *	number of records total (num_rows)
	 *	@access protected
	 *	@var int
	 */
	var $recordsTotal;
	/**
	 *	number of pages total
	 *	@access protected
	 *	@var int
	 */
	var $pagesTotal;
	/**
	 *	current page number
	 *	@access protected
	 *	@var int
	 */
	var $actual;
	/**
	 *	previous page number
	 *	@access private
	 *	@var int
	 */
	var $prev;
	/**
	 *	next page number
	 *	@access private
	 *	@var int
	 */
	var $next;
	/**
	 *	number of pages to be displayed before/after current page
	 *	used for display of numbered links
	 *	@access private
	 *	@var int
	 */
	var $cntNumberedLinks;
	/**
	 *	param1 used for slq LIMIT (starting point)
	 *	@access private
	 *	@var int
	 */
	var $limit1;
	/**
	 *	param2 used for slq LIMIT (number of records)
	 *	@access private
	 *	@var int
	 */
	var $limit2;
	
	
	
	/**
	 *	constructor
	 *	sets start page and number of rows, also sets records per page to 10.
	 *	@return void
	 */
	function rc_paginator($actualPage, $numRows)
	{
		$page = (int) $actualPage;
		if ($page < 1) $page = 1;
		if ($page > $numRows) $page = 1;
		$this->actual = $page;
		$this->recordsTotal = (int) $numRows;
		$this->recordsPerPage = 10;
		$this->_setPagesTotal();
	}
	
	/**
	 *	returns an array with all page numbers for a given range
	 *	e.g. current page is 5 and $this->cntNumberedLinks is 3: 2 3 4 5 6 7 8
	 *	@access public
	 *	@return Array
	 */
	function getArrNumberedLinks()
	{
		if (empty($this->cntNumberedLinks)) {
			$this->cntNumberedLinks = 1;
		}
		
		$arrPages = array();
		
		// links before actual page
		if ($this->hasPrev() && ($this->actual <= $this->cntNumberedLinks)) {
			// there are less pages than cntNumberedLinks available before
			$start = 1;
		}
		elseif ($this->hasPrev() && ($this->actual > $this->cntNumberedLinks)) {
			// there are enough pages before actual page
			$start = $this->actual - $this->cntNumberedLinks;
			
		}
		else {
			// it's page 1
			$start = 1;
		}
		$end = $this->actual;
		
		
		
		
		/*
		while ($start < $end) {
			$arrPages[] = $start;
			$start++;
		}
		*/
		
		// actual page
		$arrPages[] = $this->actual;
		
		// links after actual page
		if ($this->hasNext()) {
			if ($this->actual > ($this->pagesTotal - $this->cntNumberedLinks)) {
				// there are not enough pages after
				$start = ($this->actual + 1);
				$end = $this->pagesTotal;
			} else {
				// there are enough pages after
				$start = ($this->actual + 1);
				$end = ($this->actual + $this->cntNumberedLinks);
				
				
			}
			
			/*
			while ($start <= $end) {
				$arrPages[] = $start;
				$start++;
			}
			*/
		}
		
		
		
		/////////////////////////////////////////////////////////
		//////////////////////////////////////
		$arrPages = array();
		$reminder = ($this->actual)%($this->cntNumberedLinks);
		$globalReminder = ($this->pagesTotal)%($this->cntNumberedLinks);
		if($reminder == 0 ){
			 $start = $this->actual - $this->cntNumberedLinks+1;
			 
			 $end = $this->actual;
		}else if($this->actual < $this->cntNumberedLinks){
			 $start = 1;
			
			if($this->cntNumberedLinks < $this->pagesTotal ){
				$end =  $this->cntNumberedLinks ;
				
			}else{
				
				$end =  $this->pagesTotal;
			}
			 
			
		}else {
			 $start = $this->actual - $reminder +1;
			
			
			if($this->actual + $this->cntNumberedLinks-$reminder <= $this->pagesTotal ){
				$end =  $this->actual + $this->cntNumberedLinks-$reminder  ;
			}else{
				$end =  $this->actual + $globalReminder-$reminder  ;
			}
			
			 
		}
		/*
		else{
			 $start = $this->actual;
			
			 $end = $this->actual;
		}
		*/
		////////////////////////////////////////
		while ($start <= $end) {
				
				$arrPages[] = $start;
				$start++;
		}
		
		/////////////////////////////////////////////////////////
		return $arrPages;
	}
	
	/**
	 *	sets the number of links to be displayed before/after current page
	 *	e.g. current page is 5 and number is 3: 2 3 4 5 6 7 8
	 *	@access public
	 *	@param int $number
	 *	@return void
	 */
	function setCntNumberedLinks($number)
	{
		$cnt = (int) $number;
		if ($cnt < 1) {
			$this->cntNumberedLinks = 1;
		} else {
			$this->cntNumberedLinks = $cnt;
		}
	}
	
	/**
	 *	gets the previous page number.
	 *	if there is only one page or actual page is 1, will return 1
	 *	@access public
	 *	@return int
	 */
	function getPrev()
	{
		$prev = 1;
		if (!$this->hasPrev()) {
			return $prev;
		}
		$prev = ($this->actual - 1);
		return $prev;
	}
	/**
	 *	gets the next page number.
	 *	if actual page is last page, will return value for last page
	 *	@access public
	 *	@return int
	 */
	function getNext()
	{
		$next = $this->actual;
		if (!$this->hasNext()) {
			return $next;
		}
		$next = ($this->actual + 1);
		return $next;
	}
	/**
	 *	gets the last page number.
	 *	if actual page is last page, will return value for last page
	 *	@access public
	 *	@return int
	 */
	function getLast()
	{
		return $this->pagesTotal;
	}
	
	/**
	 *	checks if there is a previous page available.
	 *	@access public
	 *	@return Bool
	 */
	function hasPrev()
	{
		if ($this->pagesTotal == 1) {
			return false;
		}
		if ($this->actual == 1) {
			return false;
		}
		return true;
	}
	/**
	 *	checks if there is a next page available.
	 *	@access public
	 *	@return Bool
	 */
	function hasNext()
	{
		if ($this->pagesTotal == 1) {
			return false;
		}
		if ($this->actual >= $this->pagesTotal) {
			return false;
		}
		return true;
	}
	
	/**
	 *	gets the value for sql LIMIT starting point.
	 *	@access public
	 *	@return int
	 */
	function getLimit1()
	{
		$lim = ($this->actual * $this->recordsPerPage) - $this->recordsPerPage;
		return $lim;
	}
	/**
	 *	gets the value for sql LIMIT offset.
	 *	@access public
	 *	@return int
	 */
	function getLimit2()
	{
		$lim = $this->recordsPerPage;
		return $lim;
	}
	
	/**
	 *	gets the number of pages for given num_rows.
	 *	@access public
	 *	@return int
	 */
	function getPagesTotal()
	{
		if ($this->recordsPerPage > $this->recordsTotal) {
			return $this->pagesTotal = 1;
		}
		$this->pagesTotal = ceil($this->recordsTotal / $this->recordsPerPage);
		return $this->pagesTotal;
	}
	
	/**
	 *	sets the number of records to be displayed per page
	 *	@access public
	 *	@param int $number
	 *	@return void
	 */
	function setRecordsPerPage($number)
	{
		$this->recordsPerPage = (int) $number;
		$this->_setPagesTotal(); // must be recalculated
	}
	
	/**
	 *	sets the number of total amount of all pages
	 *	@access private
	 *	@return void
	 */
	function _setPagesTotal()
	{
		$this->pagesTotal = ceil($this->recordsTotal / $this->recordsPerPage);
	}
}
?>