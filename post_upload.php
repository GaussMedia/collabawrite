<?php
//include('db.php');
include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id']; //$session id$.cookie('name', '', { expires: -1 });

//unset($_SESSION['last_ins']);
$ip = $_SERVER['REMOTE_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//    echo '<pre>';
//    print_r($ip_data);
//    die;
$addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;

$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");

if(isset($_POST) and sizeof($_POST) and $_POST){
    $path = "webadmin/upload/posts/original/";
    $thumb_path = "webadmin/upload/posts/thumb/";
    include('webadmin/k.php');
    include('resize-class.php');

    $collection_id=$_POST['collection_id'];
 //$title = addslashes($_GET['title']);
$title =strip_tags($_POST['title']);
$sub_title = strip_tags(addslashes($_POST['subtitle']));
 $post = addslashes($_POST['post']).'<br>';
//echo count($post).'<br>';
//echo mb_strlen($post).'<br>';
//echo strlen($post).'<br>';
//die;
$name = strtolower($_FILES['fileUpload']['name']);
$size = $_FILES['fileUpload']['size'];
$image_type = $_POST['cover'];
    if(isset($_COOKIE['myDraftId']) and $_COOKIE['myDraftId']!='' and $_COOKIE['myDraftId']!='""'){
        
        $post_id =  $_COOKIE['myDraftId'];
        
        if(!empty($name))
        {
          $actual_image_name=time().'-'.$name;
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
        if($size < 10485760)
           {
                //echo $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;exit;
                $actual_image_name=str_replace(' ','-',$actual_image_name); 
                $tmp = $_FILES['fileUpload']['tmp_name'];
                if(move_uploaded_file($tmp, $path.$actual_image_name))
                        {
                    $d=time();
                    $resizeObj = new resize($path.$actual_image_name);
                    $thumb_path_146x109 = $thumb_path;
                    $resizeObj->resizeImage(434,180,'exact');
                    $t=$resizeObj->saveImage($thumb_path_146x109.$actual_image_name,100);
                        if($t == '1')
                        {
                            $d =time();
                            $sql="UPDATE drafts SET  image='$actual_image_name',image_type='$image_type',title='$title',sub_title='$sub_title',post='$post',updated_time='$d' WHERE collection_id='$collection_id' AND id='$post_id' AND author='$session_id' ";
                             $res=mysql_query($sql)or die(mysql_error());
                             $draft_id = $post_id;
                        }
                        }
                else
                                        echo "failed";
                        }
                        else
                        echo "Image file size max 10 MB";					
                        }
                        else
                        echo "Invalid file format..";	
        }
        else
        {
            $d = time();
           $sql="UPDATE drafts SET title='$title',sub_title='$sub_title',post='$post',updated_time='$d'  WHERE collection_id='$collection_id' AND author='$session_id' AND id ='$post_id'  ";
            $res = mysql_query($sql)or die(mysql_error());
            $draft_id = $post_id;
        }
    
        
        
    }
    else{
        
    if(!empty($name))
    {
     $actual_image_name=time().'-'.$name;
    list($txt, $ext) = explode(".", $name);
    if(in_array($ext,$valid_formats))
    {
    if($size<(2048*2048))
       {
            $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
            $tmp = $_FILES['fileUpload']['tmp_name'];
            if(move_uploaded_file($tmp, $path.$actual_image_name))
                    {
                $d=time();
                $resizeObj = new resize($path.$actual_image_name);
                    $thumb_path_146x109 = $thumb_path;
                    $resizeObj->resizeImage(434,180,'exact');
                    $t=$resizeObj->saveImage($thumb_path_146x109.$actual_image_name,100);
                        if($t == '1')
                        {

                $sql="INSERT INTO drafts(location,collection_id,title,image,image_type,sub_title,post,author,creation_date,updated_time) VALUES('$addrress','$collection_id','$title','$actual_image_name','$image_type','$sub_title','$post','$session_id','$d','$d')";
               $res=mysql_query($sql)or die(mysql_error());
               
               $draft_id = mysql_insert_id();
               setcookie("myDraftId", $draft_id, time()+3600);
                        }
            }
            else
            echo "failed";
            }
            else
            echo "Image file size max 3 MB";					
            }
            else
            echo "Invalid file format..";	
    }
    else{
         $d=time();
    $sql="INSERT INTO drafts(location,collection_id,title,sub_title,post,author,creation_date,updated_time) VALUES('$addrress','$collection_id','$title','$sub_title','$post','$session_id','$d','$d')";
    $res = mysql_query($sql)or die(mysql_error());
    $draft_id = mysql_insert_id();
    //setcookie("myDraftId", $drafat_id, time()-3600);
    setcookie("myDraftId", $draft_id, time()+3600);
    
    }
//        $draft_id = $_POST['postid'];  
//        $sql_get = mysql_query("SELECT * FROM drafts WHERE id='$draft_id' ");
//        $res_get = mysql_fetch_array($sql_get);
//        echo json_encode($res_get);      
    }
    
}

if(isset($_GET['saveD']) and $_GET['saveD']=="save"){
    setcookie("myDraftId", "", time()-3600);
}

if(isset($_GET) and sizeof($_GET) and isset($_COOKIE['myDraftId'])){
    $draft_id = $_COOKIE['myDraftId'];
    $sql_get = mysql_query("SELECT * FROM drafts WHERE id='$draft_id' ");
    $res_get = mysql_fetch_array($sql_get);
    echo json_encode($res_get);
}
?>