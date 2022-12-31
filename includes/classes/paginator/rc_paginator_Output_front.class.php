<?php
/**
 *	rc_paginator_Output
 *	
 *	@description		object for creating page links
 *	@package			rc_paginator
 *	@author				Rudi Bieller - contact@reducedcomplexity.com
 */

require_once('rc_paginator_front.class.php');

class rc_paginator_Output extends rc_paginator
{
	/**
	 *	name for link 'first page'
	 *	@access private
	 *	@var String
	 */
	var $first;
	/**
	 *	name for link 'last page'
	 *	@access private
	 *	@var String
	 */
	var $last;
	/**
	 *	name for link 'previous page'
	 *	@access private
	 *	@var String
	 */
	var $prev;
	/**
	 *	name for link 'next page'
	 *	@access private
	 *	@var String
	 */
	var $next;
	/**
	 *	name for link title/GET-parameter 'page'
	 *	@access private
	 *	@var String
	 */
	var $page;
	/**
	 *	additional GET params to be used when generating the pages-links
	 *	@access private
	 *	@var Array
	 */
	var $getParams;
	/**
	 *	HTML string template for displayed links, do not edit!
	 *	@access private
	 *	@var String
	 */
	var $linkTmpl = '<li  class="CURRENT"><a href="HREF" class="paging_link" title="TITLE" page="PAGE"><span>DESCRIBE</span></a></li>';
	
	
	/**
	 *	constructor
	 *	sets actual page, num_rows, names for links, default no. of records/page
	 *	@return void
	 */
	function rc_paginator_Output($actualPage, $numRows)
	{
		// parent::__construct();
		$page = (int) $actualPage;
		if ($page < 1) $page = 1;
		if ($page > $numRows) $page = 1;
		$this->actual = $page;
		$this->recordsTotal = (int) $numRows;
		$this->recordsPerPage = 10;
		$this->setNames();
		$this->_setPagesTotal();
		$this->getPagesTotal();
	}
	
	/**
	 *	resets template string for links
	 *	@access public
	 *	@return void
	 */
	function resetLinkTmpl()
	{
		$this->linkTmpl = '<li class="CURRENT"><a href="HREF" class="paging_link" title="TITLE" page="PAGE"><span>DESCRIBE</span></a></li>';
	}
	
	/**
	 *	adds additional GET params to url get string
	 *	@access public
	 *	@param Array $params - must be onedimensional assoc. array, 
	 *							e.g. array('param' => 'value');
	 *	@return void
	 */
	function setGetParams($params)
	{
		if (is_array($params)) {
			foreach ($params as $para => $val) {
				$this->getParams[$para] = $val;
			}
		}
	}
	
	/**
	 *	displays linkset 'prev - next'
	 *	@access public
	 *	@param String $seperator
	 *	@return String
	 */
	function dispPevNext($seperator=' - ')
	{
		$url_next = $this->getLinkNext();
		$url_prev = $this->getLinkPrev();
		$strSep = $seperator;
		$url = $url_prev . $strSep . $url_next;
		return $url;
	}
	/**
	 *	displays linkset 'start - prev - next - end'
	 *	@access public
	 *	@param String $seperator
	 *	@return String
	 */
	function dispPrevNextFirstLast($seperator=' - ')
	{
		$url_next = $this->getLinkNext();
		$url_prev = $this->getLinkPrev();
		$url_first = $this->getLinkFirst();
		$url_last = $this->getLinkLast();
		$strSep = $seperator;
		$url = $url_first . $strSep . $url_prev . $strSep . $url_next . 
				$strSep . $url_last;
		return $url;
	}
	/**
	 *	displays linkset 'prev - 1 - 2 - 3 - next'
	 *	@access public
	 *	@param String $seperator
	 *	@param int $cntLinks - number of page-links to be displayed
	 *	@return String
	 */
	function dispPrevNextNumbers($seperator=' - ', $cntLinks=2)
	{
		$url_numbers = $this->getLinkNumberedLinks($seperator, $cntLinks);
		$url_next = $this->getLinkNext();
		$url_prev = $this->getLinkPrev();
		$strSep = $seperator;
		$url = $url_prev . $strSep . $url_numbers . $strSep . $url_next;
		return $url;
	}
	/**
	 *	displays linkset 'start - 1 - 2 - 3 - end'
	 *	@access public
	 *	@param String $seperator
	 *	@param int $cntLinks - number of page-links to be displayed
	 *	@return String
	 */
	function dispFirstLastNumbers($seperator=' - ', $cntLinks=2)
	{
		$url_numbers = $this->getLinkNumberedLinks($seperator, $cntLinks);
		$url_first = $this->getLinkFirst();
		$url_last = $this->getLinkLast();
		$strSep = $seperator;
		$url = $url_first . $strSep . $url_numbers . $strSep . $url_last;
		return $url;
	}
	
	
	////////////////////////////////////////////////////////////
	function getLinkPrevMore()
	{
	
		//////////////////////////////////////////////
		$reminder = ($this->actual)%($this->cntNumberedLinks);
		$globalReminder = ($this->pagesTotal)%($this->cntNumberedLinks);
		if($reminder == 0 ){
			 $start = $this->actual - $this->cntNumberedLinks+1;
			 
			 //$end = $this->actual;
		}else if($this->actual < $this->cntNumberedLinks){
			 $start = 1;
			
			if($this->cntNumberedLinks < $this->pagesTotal ){
				//$end =  $this->cntNumberedLinks ;
				
			}else{
				
				//$end =  $this->pagesTotal;
			}
			 
			
		}else {
			 $start = $this->actual - $reminder +1;
			
			
			if($this->actual + $this->cntNumberedLinks-$reminder <= $this->pagesTotal ){
				//$end =  $this->actual + $this->cntNumberedLinks-$reminder  ;
			}else{
				//$end =  $this->actual + $globalReminder-$reminder  ;
			}
			
			 
		}
		//////////////////////////////////////////////
		
		
		if ($start != 1) {
			$next = $start - 1;
			$this->getParams[$this->page] = $next;
			$url = $this->_http_query_build($this->getParams, $_SERVER['PHP_SELF']);
			$url_next = $this->_createURL($url, $next, "...");
		} else {
			$url_next = '';
		}
		
		return $url_next;
	}
	
	
	////////////////////////////////////////////////////////////
	function getLinkNextMore()
	{
	
		
		//////////////////////////////////////
		
		$reminder = ($this->actual)%($this->cntNumberedLinks);
		$globalReminder = ($this->pagesTotal)%($this->cntNumberedLinks);
		if($reminder == 0 ){
			
			 $end = $this->actual;
		}else if($this->actual < $this->cntNumberedLinks){
			 
			if($this->cntNumberedLinks < $this->pagesTotal ){
				$end =  $this->cntNumberedLinks ;
				
			}else{
				
				$end =  $this->pagesTotal;
			}
			 
			
		}else {
			 
			
			
			if($this->actual + $this->cntNumberedLinks-$reminder <= $this->pagesTotal ){
				$end =  $this->actual + $this->cntNumberedLinks-$reminder  ;
			}else{
				$end =  $this->actual + $globalReminder-$reminder  ;
			}
			
			 
		}
		//////////////////////////////////////
		
		
		if ($end < $this->pagesTotal) {
			$next = $end + 1;
			$this->getParams[$this->page] = $next;
			$url = $this->_http_query_build($this->getParams, $_SERVER['PHP_SELF']);
			$url_next = $this->_createURL($url, $next, "...");
		} else {
			$url_next = '';
		}
		
		return $url_next;
	}
	/**
	 *	displays linkset 'start - prev - 1 - 2 - 3 - next - end'
	 *	@access public
	 *	@param String $seperator
	 *	@param int $cntLinks - number of page-links to be displayed
	 *	@return String
	 */
	function dispFull($seperator=' - ', $cntLinks=2)
	{
		$url_numbers = $this->getLinkNumberedLinks($seperator, $cntLinks);
		$url_first = $this->getLinkFirst();
		$url_last = $this->getLinkLast();
		$url_next = $this->getLinkNext();
		$url_prev = $this->getLinkPrev();
		
		$url_next_more = $this->getLinkNextMore();
		$url_prev_more = $this->getLinkPrevMore();
		
		$strSep = $seperator;
		$url = $url_first . $strSep . $url_prev .
				$strSep . $url_prev_more . 
				$strSep . $url_numbers.
				$strSep . $url_next_more.
				$strSep . $url_next . $strSep . $url_last;
				
					$url = $url_prev .
				$strSep . $url_prev_more . 
				$strSep . $url_numbers.
				$strSep . $url_next_more.
				$strSep . $url_next ;	
				
				
				
		///////////////////////////////////
		$ReplaceFrom = array("<li></li>");
		$ReplaceTo  = array("");
		$url = str_replace($ReplaceFrom, $ReplaceTo, $url);
		///////////////////////////////////
		
		return $url;
	}
	
	/**
	 *	sets the names for displayed links and GET param for 'page'
	 *	can be used to make links language specific or for individual purposes
	 *	@access public
	 *	@param String $first
	 *	@param String $last
	 *	@param String $prev
	 *	@param String $next
	 *	@param String $page
	 *	@return void
	 */
	function setNames($first='first', $last='last', $prev='prev', $next='next', $page='page')
	{
		$this->first = trim($first);
		$this->last = trim($last);
		$this->prev = trim($prev);
		$this->next = trim($next);
		$this->page = trim($page);
	}
	
	/**
	 *	gets link for previous page
	 *	@access public
	 *	@return String
	 */
	function getLinkPrev()
	{
		if ($this->hasPrev()) {
			$prev = $this->getPrev();
			$this->getParams[$this->page] = $prev;
			$url = $this->_http_query_build($this->getParams, $_SERVER['PHP_SELF']);
			$url_prev = $this->_createURL($url, $prev, $this->prev);
		} else {
			//$url_prev = $this->prev;
			$url_prev = "";
		}
		
		//if($this->pagesTotal){
		//echo $_REQUEST['page'];
		if( $this->pagesTotal == 1 || $_REQUEST['page'] == 1 || $_REQUEST['page'] == ''){
			return $url_prev;
		}else{
			return $url_prev;
		}
		
		//return $url_prev;
	}
	/**
	 *	gets link for next page
	 *	@access public
	 *	@return String
	 */
	function getLinkNext()
	{
		if ($this->hasNext()) {
			$next = $this->getNext();
			$this->getParams[$this->page] = $next;
			$url = $this->_http_query_build($this->getParams, $_SERVER['PHP_SELF']);
			$url_next = $this->_createURL($url, $next, $this->next);
		} else {
			//$url_next = $this->next;
		}
		
		
		//if($this->pagesTotal){
	//	echo $this->pagesTotal;
		//echo $this->getParams[$this->page];
		if($this->pagesTotal == 1 || $_REQUEST['page'] == $this->pagesTotal){
		}else{
			return $url_next;
		}
		
		
		
		
	}
	/**
	 *	gets link for page numbers
	 *	@param String $seperator
	 *	@param int $cntLinks - number of page-links to be displayed
	 *	@access public
	 *	@return String
	 */
	function getLinkNumberedLinks($seperator=' - ', $cntLinks=2)
	{
		$cntLinks = (int) $cntLinks;
		$this->setCntNumberedLinks($cntLinks);
		$numbers = $this->getArrNumberedLinks();
		$url_numbers = '';
		$get_params = $this->getParams;
		if ((count($numbers) == 1) && ($numbers[0] == $this->actual)) {
			//$url_numbers = $numbers[0];
			$url_numbers = $this->_createURL($url, $no, $no,"active");
			//$url_numbers = $numbers[0];
		}else {
			$cnt = 1;
			foreach ($numbers as $no) {
				
				
				$this->resetLinkTmpl();
				$get_params[$this->page] = $no;
				$url = $this->_http_query_build($get_params, $_SERVER['PHP_SELF']);
				$tmp = '';
				if ($this->actual != $no) {
					$tmp = $this->_createURL($url, $no, $no);
					
				} else {
					//$tmp = $no;
					$tmp  = $this->_createURL($url, $no, $no,"active");
				}
				if ($cnt < count($numbers)) {
					$tmp .= $seperator;
				}
				$url_numbers .= $tmp;
				unset($tmp);
				$cnt++;
			}	
		}
		
		
		if( $this->pagesTotal == 1 && ($_REQUEST['page'] == 1 || $_REQUEST['page'] == '')){
			return "";
		}else{
			return $url_numbers;
		}
		
		
		
	}
	/**
	 *	gets link for first page
	 *	@access public
	 *	@return String
	 */
	function getLinkFirst()
	{
		if ($this->hasPrev()) {
			$start = 1;
			$this->getParams[$this->page] = $start;
			$url = $this->_http_query_build($this->getParams, $_SERVER['PHP_SELF']);
			$url_start = $this->_createURL($url, $start, $this->first);
		} else {
			//$url_start = $this->first;	
		}
		return $url_start;
	}
	/**
	 *	gets link for last page
	 *	@access public
	 *	@return String
	 */
	function getLinkLast()
	{
		if ($this->hasNext()) {
			$end = $this->pagesTotal;
			$this->getParams[$this->page] = $end;
			$url = $this->_http_query_build($this->getParams, $_SERVER['PHP_SELF']);
			$url_end = $this->_createURL($url, $end, $this->last);
		} else {
			//$url_end = $this->last;	
		}
		return $url_end;
	}
	
	/**
	 *	creates a full url with GET params or GET querystring only (urlencoded)
	 *	@access private
	 *	@param Array $params - one-dimensional assoc. array, array('param' => 'value');
	 *	@param String $filename - name/rel. current document to be linked to
	 *	@return String
	 */
	function _http_query_build($params, $filename="")
	{
		$str_get = "";
		
		if (!empty($filename))
		{
			$str_get .= $filename;
		}
		
		$str_get .= "?";
		
		$i = 0;
		foreach ($params as $param => $value)
		{
			// urlencode the values
			$value = urlencode($value);
			if ($i > 0) $str_get .= "&amp;" . $param . "=" . $value;
			else $str_get .= $param . "=" . $value;
			$i++;
		}
		
		return strval($str_get);
	}
	
	/**
	 *	creates the desired HTML link from link template
	 *	@access private
	 *	@param String $href
	 *	@param String $title
	 *	@param String $desc
	 *	@return String
	 */
	function _createURL($href, $title, $desc,$current='')
	{
	
		if($title == ''){
			$href = "#";
			$desc = $this->page = $title = $this->getPagesTotal();
		}
	
		$url = str_replace('HREF', $href, $this->linkTmpl);
		$url = str_replace('TITLE', $this->page . ' ' . $title, $url);
		$url = str_replace('DESCRIBE', $desc, $url);
		$url = str_replace('PAGE', $title, $url);
		$url = str_replace('CURRENT', $current, $url);
		
		
		return $url;
	}
	
	
	
	
	
	
	
	

	
	
	
	
	
}
?>