<?php

	ini_set("date.timezone", "Asia/Hong_Kong");






//database server
define('DB_SERVER', "localhost");
//database login name
define('DB_USER', "htfc");
//database login password
define('DB_PASS', "KBnXcGPh");
//database name
define('DB_DATABASE', "db_huatai");
define('REWRITE_BASE', "");
define('REWRITE_BASE2', "/madcradle/Huatai/");




define('REWRITE_FILE_EXT', "");
define('REAL_TABLE_PREFIX', "tb_huatai_");
define('SECOND_FOR_REFRESH', 5*60*1000);



define("COMPANY_NAME","华泰（香港）期货有限公司");



define('TODAY', date('Y-m-d'));

define('NOW', date('Y-m-d H:i:s'));

define('NOW_STRING', date('YmdHis'));

define('DATA_SEPARATOR', '###');

define('COLOR_SIGN', '#');

define('DISABLED_DELETE', '2');

define('TEXT_NEW_LINE', "\n");


define('COOKIE_EXPIRE_TIME', time()+3600*24*30);
define('COOKIE_NAME', 'HU');




?>
