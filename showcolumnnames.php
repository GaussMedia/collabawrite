<?php
include('Twitter_Login/config/dbconfig.php');
$sql = "SELECT column_name
FROM information_schema.columns
WHERE table_name = 'twitter_users'";
$re = mysql_query($sql)or die(mysql_error());
while($fet = mysql_fetch_array($re)){
echo '<pre>';
print_r($fet);
}
?>
