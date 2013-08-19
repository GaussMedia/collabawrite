<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$table="drafts";
$post = $_POST['post'];
$collection = $_POST['collection'];
$session_id = $_SESSION['id'];
$obj=new KARAMJEET();


$sql = "SELECT * FROM posts WHERE collection_id='$collection' AND author='$session_id'";
//die;
$res = mysql_query($sql)or die(mysql_error());
$fetch = mysql_fetch_array($res);
//print_r($fetch);
if(empty($fetch)){
        $fetch_coll=$obj->fetch_one($table,"`id`='".$post."'");
        $fetch_collpo=$obj->fetch_one('collections',"`id`='".$collection."'");
        $d=time();
        $sql="INSERT INTO posts(collection_id,title,image,image_type,sub_title,post,author,creation_date) VALUES('$collection','$fetch_coll[title]','$fetch_coll[image]','$fetch_coll[image_type]','$fetch_coll[sub_title]','$fetch_coll[post]','$session_id','$d')";
        $res=mysql_query($sql)or die(mysql_error());

        $draft_id = mysql_insert_id();
        $fetch_coll1=$obj->fetch_one('posts',"`id`='".$draft_id."'");
        //echo json_encode($fetch_coll1);
        $arr[] = 'Post has successfully added to collection  "'.$fetch_collpo['collection_name'].'"';
        echo json_encode($arr[0]);
}
else{
//echo json_encode($fetch_coll);

$arr[] = 'You have already added this post';
    echo json_encode($arr[0]); 
}
?>
