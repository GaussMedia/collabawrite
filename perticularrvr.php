<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$session_id = $_SESSION['id'];
$post_id  = $_GET['post_id'];
?>

<?php

    $sql_view ="SELECT * FROM views WHERE view_post = '$post_id'  ";
    $res_view = mysql_query($sql_view);
    $count_views =  mysql_num_rows($res_view);
    if(empty($count_views)){
        $views = 0;
    }else{
        $views = $count_views;
    }
    
    $sql_recs ="SELECT * FROM recommends WHERE recommend_post = '$post_id'  ";
    $res_recs = mysql_query($sql_recs);
    $count_recs =  mysql_num_rows($res_recs);
    if(empty($count_recs)){
        $recs = 0;
    }else{
        $recs = $count_recs;
    }
    echo json_encode(array('Views'=>$views,'Recommends'=>$recs));
?>
