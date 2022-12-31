<?php
//https://www.w3schools.com/php/php_ref_mysqli.asp
class Database {


var $server   = ""; //database server
var $user     = ""; //database login name
var $pass     = ""; //database login password
var $database = ""; //database name
var $pre      = ""; //table prefix


#######################
//internal info
var $error = "";
var $errno = 0;

//number of rows affected by SQL query
var $affected_rows = 0;

var $link_id = 0;
var $query_id = 0;


#-#############################################
# desc: constructor
function Database($server, $user, $pass, $database, $pre=''){
	$this->server=$server;
	$this->user=$user;
	$this->pass=$pass;
	$this->database=$database;
	$this->pre=$pre;
}#-#constructor()


#-#############################################
# desc: connect and select database using vars above
# Param: $new_link can force connect() to open a new link, even if mysqli_connect() was called before with the same parameters
function connect($new_link=false) {
	

	$conn=new mysqli($this->server,$this->user,$this->pass,$this->database);
	
	// Check connection
if ($conn->connect_error) {
    $connected = false;
	$err_msg = "Could not connect to server: <b>$this->server</b>.";
	$this->oops($err_msg);
}else{
	$connected = true;
}
	


	$conn->query("SET NAMES 'utf8'"); 
	$conn->query("SET CHARACTER_SET_CLIENT=utf8"); 
	$conn->query("SET CHARACTER_SET_RESULTS=utf8"); 
	$conn->query("SET CHARACTER_SET_RESULTS=utf8"); 
	$conn->query("SET sql_mode = ''");

	
	 $this->link_id = 	$conn;
	 $this->conn = 	$conn;
	
	if(!$connected){
		exit($err_msg);
		
	}

	// unset the data so it can't be dumped
	$this->server='';
	$this->user='';
	$this->pass='';
	$this->database='';
}#-#connect()


#-#############################################
# desc: close the connection
function close() {
	if(!@mysqli_close($this->link_id)){
		$this->oops("Connection close failed.");
	}
}#-#close()


#-#############################################
# Desc: escapes characters to be mysql ready
# Param: string
# returns: string
function escape($string) {
	
	$from = array('"');
	$to   = '&#34;';
	$string = str_replace($from, $to, $string);


	$from = array("'");
	$to   = "&#39;";
	$string = str_replace($from, $to, $string);
	
	
	if(get_magic_quotes_runtime()) {

		$string = stripslashes($string);
	}
	//return $string;
	$string =  mysqli_real_escape_string($this->conn,$string);
	
	

	
	return $string;
	
	
	
	
}#-#escape()


#-#############################################
# Desc: executes SQL query to an open connection
# Param: (MySQL query) to execute
# returns: (query_id) for fetching results etc
function query($sql) {
	
	// do query
	//$this->query_id = @mysqli_query($sql, $this->link_id);
	//$this->query_id = mysqli_query($sql);
	$this->query_id = mysqli_query( $this->conn,$sql);

/*
	if (!$this->query_id) {
		$this->oops("<b>MySQL Query fail:</b> $sql");
		return true;
	}
	*/

	$this->affected_rows = @mysqli_affected_rows($this->conn);

	return $this->query_id;
}#-#query()


#-#############################################
# desc: fetches and returns results one line at a time
# param: query_id for mysql run. if none specified, last used
# return: (array) fetched record(s)
function fetch_array($query_id=-1) {
	// retrieve row
	if ($query_id!=-1) {
		$this->query_id=$query_id;
	}

	if (isset($this->query_id)) {
		$record = @mysqli_fetch_assoc($this->query_id);
	}else{
		$this->oops("Invalid query_id: <b>$this->query_id</b>. Records could not be fetched.");
	}

	return $record;
}#-#fetch_array()


#-#############################################
# desc: returns all the results (not one row)
# param: (MySQL query) the query to run on server
# returns: assoc array of ALL fetched results
function fetch_all_array($sql) {
	//$query_id = $this->query($sql);
	/*
	$out = array();

	while ($row = $this->fetch_array($query_id, $sql)){
		echo $out[] = $row;
	}

	$this->free_result($query_id);
	return $out;
	*/
}#-#fetch_all_array()


#-#############################################
# desc: frees the resultset
# param: query_id for mysql run. if none specified, last used
function free_result($query_id=-1) {
	
	/*
	if ($query_id!=-1) {
		$this->query_id=$query_id;
	}
	if($this->query_id!=0 && !@mysqli_free_result($this->query_id)) {
		$this->oops("Result ID: <b>$this->query_id</b> could not be freed.");
	}
	
	*/

	 @mysqli_free_result($result);

}#-#free_result()


#-#############################################
# desc: does a query, fetches the first row only, frees resultset
# param: (MySQL query) the query to run on server
# returns: array of fetched results
function query_first($query_string) {

	$query_id = $this->query($query_string);

	$out = $this->fetch_array($query_id);

	$this->free_result($query_id);

	return $out;
}#-#query_first()


#-#############################################
# desc: does an update query with an array
# param: table (no prefix), assoc array with data (doesn't need escaped), where condition
# returns: (query_id) for fetching results etc
function query_update($table, $data, $where='1') {
	$q="UPDATE ".$table." SET ";

	foreach($data as $key=>$val) {
		
		
		if($key == 'last_update_date' || $key == 'create_date' || $key == 'create_by'){
			
		}else{
		
			if($key == 'last_update_by'){
				$q.= " $key='".ADMIN_ID."', ";
			}else{
				$q.= " $key='".$this->escape($val)."', ";
			}
		
		}
		
		
		
		
	}

	 $q = rtrim($q, ', ') . ' WHERE '.$where.';';
	//return $q;
	$this->query($q);
	//return $this->query($q);
}#-#query_update()














#-#############################################
# desc: does an update query with an array
# param: table (no prefix), assoc array with data (doesn't need escaped), where condition
# returns: (query_id) for fetching results etc
function query_update_lang_content($table, $data, $where='1') {
	
	
	
	
	
	
	$table = $table."_desc";
	$sql = "delete from $table where $where ";
	$this->query($sql);
	
	//$this->query_insert_lang_content($table, $data);

	

$default_language_id = 0 ;
$t = TB_LANGUAGE;
////////////////////////////////////////////////////////////////////////////////
$sql = "select id from $t ";
$sql .= " where ";
$sql .= " for_front_page='1' and default_front_lang = '1' ";
$rows2 = $this->query($sql);
$num_record = $this->affected_rows;
if($num_record >0){
	while($data2 = $this->fetch_array($rows2)){
			$default_language_id = $data2['id'];
	}
}

	

	

//$table = $table."_desc";
////////////////////////////////////////////////////////////////////////////////
// define table for sql
////////////////////////////////////////////////////////////////////////////////
$t = TB_LANGUAGE;
////////////////////////////////////////////////////////////////////////////////
$sql = "select * from $t ";
$sql .= " where ";
$sql .= " for_front_page='1' ";
$sql .= "  order by sort_order asc  ";
$rows2 = $this->query($sql);
$num_record = $this->affected_rows;
if($num_record >0){
	$k = 0;
	while($data2 = $this->fetch_array($rows2)){
			$k++;
			$language_name = $data2['name'];
			$language_id = $data2['id'];

	

	//$q="INSERT INTO '".$this->pre.$table."' ";
	$q="INSERT INTO ".$table." ";
	$v=''; 
	$n='';

	foreach($data as $key=>$val) {
		
	 
		$n.=" $key, ";
		//$test = strpos($key, $lang_end_text);
		
		/*
		$lang_end_text = '_'.$language_id;
		if(strpos($key, $lang_end_text) == ''){
			$lang_data = $val;
		}else{
			//////////////////////////////
			$lang_data = $_REQUEST[$key.$lang_end_text];
			//////////////////////////////
		}
		*/
		
	
		$lang_end_text = '_'.$language_id;
		if($_REQUEST[$key.$lang_end_text] == '' ){
			$lang_data = $val;
			
			//$lang_data =  $_REQUEST[$key.'_'.$default_language_id];
			//$lang_data = $key.'_'.$default_language_id;
		}else{
			//////////////////////////////
			$lang_data = $_REQUEST[$key.$lang_end_text];
			//////////////////////////////
		}
		
		
		if(trim($lang_data) == ''){
			$lang_data =  $_REQUEST[$key.'_'.$default_language_id];
			//$lang_data =  $key.'_'.$default_language_id;
		}

		
		$v.= "'".formatStringForSQL($lang_data)."', ";
		
	
	
	}
	
	
	
	

	$q .= "(language_id,". rtrim($n, ', ') .") VALUES ('$language_id' ,    ". rtrim($v, ', ') .")";
	$this->query($q);
	//if( $this->query($q)){
		//$this->free_result();
		//return mysqli_insert_id();
		//return $this_id;
	//}
	//else return false;
	//return $q;
	
////////////////////////////////////////////////////////////////////////////////
	
	}
}
////////////////////////////////////////////////////////////////////////////////	
	

	
	
	
	
}#-#query_update()








#-#############################################
# desc: does an insert query with an array
# param: table (no prefix), assoc array with data
# returns: id of inserted record, false if error
function query_insert($table, $data) {
	
	$create_date = $last_update_date = date("Y-m-d H:i:s");
	
	
	
	//$q="INSERT INTO '".$this->pre.$table."' ";
	$q="INSERT INTO ".$table." ";
	$v=''; 
	$n='';

	foreach($data as $key=>$val) {
		
	  //if($key != 'last_update_date'){
		$n.=" $key, ";
		
		/*
		if(strtolower($val)=='null') $v.="NULL, ";
		elseif(strtolower($val)=='now()') $v.="NOW(), ";
		else $v.= "'".$this->escape($val)."', ";
		*/
		
		
		
		
		if($key == 'create_date' || $key == 'last_update_date'){
			$v.= "'".$create_date."', ";
		}else if($key == 'create_by'){
			$v.= "'".ADMIN_ID."', ";
		}else if($key == 'last_update_by'){
			
			$v.= "'".ADMIN_ID."', ";
		}else{
		
			if(strtolower($val)=='') $v.="'', ";
			else $v.= "'".$this->escape($val)."', ";
		}
	 // 
	 //}
	}

 $q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .")";

	if( $this->query($q)){
		//$this->free_result();
		
		return mysqli_insert_id($this->conn);
		//return $this_id;
	}
	else return false;
//return $q;
	

}#-#query_insert()














#-#############################################
# desc: does an insert query with an array
# param: table (no prefix), assoc array with data
# returns: id of inserted record, false if error
function query_insert_lang_content($table, $data) {
	
	
	
	
$default_language_id = 0 ;
$t = TB_LANGUAGE;
////////////////////////////////////////////////////////////////////////////////
$sql = "select id from $t ";
$sql .= " where ";
$sql .= " for_front_page='1' and default_front_lang = '1' ";
$rows2 = $this->query($sql);
$num_record = $this->affected_rows;
if($num_record >0){
	while($data2 = $this->fetch_array($rows2)){
			
			$default_language_id = $data2['id'];
	}
}

	
	
	
	
	
	

$table = $table."_desc";
////////////////////////////////////////////////////////////////////////////////
// define table for sql
////////////////////////////////////////////////////////////////////////////////
$t = TB_LANGUAGE;
////////////////////////////////////////////////////////////////////////////////
$sql = "select * from $t ";
$sql .= " where ";
$sql .= " for_front_page='1' ";
$sql .= "  order by sort_order asc  ";
$rows2 = $this->query($sql);
$num_record = $this->affected_rows;
if($num_record >0){
	$k = 0;
	while($data2 = $this->fetch_array($rows2)){
			$k++;
			$language_name = $data2['name'];
			$language_id = $data2['id'];

	

	//$q="INSERT INTO '".$this->pre.$table."' ";
	$q="INSERT INTO ".$table." ";
	$v=''; 
	$n='';

	foreach($data as $key=>$val) {
		
	 
		$n.=" $key, ";
		//$test = strpos($key, $lang_end_text);
		
		/*
		$lang_end_text = '_'.$language_id;
		if(strpos($key, $lang_end_text) == ''){
			$lang_data = $val;
		}else{
			//////////////////////////////
			$lang_data = $_REQUEST[$key.$lang_end_text];
			//////////////////////////////
		}
		*/
		
	
		$lang_end_text = '_'.$language_id;
		if($_REQUEST[$key.$lang_end_text] == '' ){
			$lang_data = $val;
			
			//$lang_data =  $_REQUEST[$key.'_'.$default_language_id];
			
		}else{
			//////////////////////////////
			$lang_data = $_REQUEST[$key.$lang_end_text];
			//////////////////////////////
		}
		
		
		if(trim($lang_data) == ''){
			$lang_data =  $_REQUEST[$key.'_'.$default_language_id];
			//$lang_data =  $key.'_'.$default_language_id;
		}
		
		$v.= "'".formatStringForSQL($lang_data)."', ";
		
	
	
	}
	
	
	
	

	$q .= "(language_id,". rtrim($n, ', ') .") VALUES ('$language_id' ,    ". rtrim($v, ', ') .")";
	$this->query($q);
	//if( $this->query($q)){
		//$this->free_result();
		//return mysqli_insert_id();
		//return $this_id;
	//}
	//else return false;
	//return $q;
	
////////////////////////////////////////////////////////////////////////////////
	
	}
}
////////////////////////////////////////////////////////////////////////////////	
	

//	return $q;
	
	

}#-#query_insert_lang_content()











#-#############################################
# desc: throw an error message
# param: [optional] any custom error to display
function oops($msg='') {
	
	$out = '';
	if($this->link_id>0){
		$this->error=mysqli_error($this->link_id);
		$this->errno=mysqli_errno($this->link_id);
	}
	else{
		$this->error=mysqli_error();
		$this->errno=mysqli_errno();
	}

		$out .= '<table align="center" border="1" cellspacing="0" style="background:white;color:black;width:80%;">';
		$out .= '<tr><th colspan=2>Database Error</th></tr>';
		$out .= '<tr><td align="right" valign="top">Message:</td><td><?php echo $msg; ?></td></tr>';
		
		if(strlen($this->error)>0) {
			$out .= '<tr><td align="right" valign="top" nowrap>MySQL Error:</td><td>'.$this->error.'</td></tr>';
		
        
		
		
			$out .= '<tr><td align="right">Date:</td><td>'.date("l, F j, Y \a\\t g:i:s A").'</td></tr>';
			$out .= '<tr><td align="right">Script:</td><td><a href="'.$_SERVER['REQUEST_URI'].'">'.@$_SERVER['REQUEST_URI'].'</a></td></tr>';
		
		}
		if(strlen(@$_SERVER['HTTP_REFERER'])>0) {
		
			$out .= '<tr><td align="right">Referer:</td><td><a href="'.@$_SERVER['HTTP_REFERER'].'">'.@$_SERVER['HTTP_REFERER'].'</a></td></tr>';
		
		}
		
		$out .= '</table>';

	
}#-#oops()


}//CLASS Database
###################################################################################################

?>