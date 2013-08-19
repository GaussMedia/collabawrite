<?php
session_start();
include('Twitter_Login/config/dbconfig.php');

$reply_author = $_SESSION['id'];
$postid = $_POST['postid'];
$noteid = $_POST['noteid'];
$replycontent = $_POST['replycontent'];
$d = time();
$sql = "INSERT INTO `replyonnotes` (`reply_author`,`post_id`,`note_id`,`content`,`creation_date`) VALUES('$reply_author','$postid','$noteid','$replycontent','$d')";
$res = mysql_query($sql) or die(mysql_error());
$last_id = mysql_insert_id();
$sel = "SELECT * FROM `replyonnotes` WHERE id = '$last_id'";
$SEL_res = mysql_query($sel)or die(mysql_error());
if($fetch = mysql_fetch_array($SEL_res)){
    echo json_encode($fetch);
}
?>
