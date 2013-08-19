<?php
include('Twitter_Login/config/dbconfig.php');
session_start();
 $session_id = $_SESSION['id'];
 $post_id = $_POST['postid'];
 $image_type = $_POST['cover'];
 $title =strip_tags($_POST['title']);
 $sub_title = strip_tags(addslashes($_POST['subtitle']));
 $post = stripslashes(addslashes($_POST['post']));
 $img_name =  $_POST['hidimagename'];
 $sql="UPDATE drafts 
      SET 
      image='$img_name',
      image_type='$image_type',
      title='$title',
      sub_title='$sub_title',
      post='$post' 
      WHERE
     id='$post_id' AND author='$session_id' ";
 $res=mysql_query($sql)or die(mysql_error());
?>
