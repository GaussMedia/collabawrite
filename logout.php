<?php
session_start();
session_unset();
mysql_close();
header("location: http://reportedly.pnf-sites.info/");
?>
