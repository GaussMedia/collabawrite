<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'c2_reportedly');
define('DB_PASSWORD', '123456');
define('DB_DATABASE', 'c2_reportedly');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
