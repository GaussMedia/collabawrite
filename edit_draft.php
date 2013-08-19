<?php
//include('db.php');
include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id']; //$session id$.cookie('name', '', { expires: -1 });
$collection_id=$_POST['collection_id'];

//unset($_SESSION['last_ins']);
$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");
if(isset($_POST) and sizeof($_POST) and $_POST){
    
    $path = "webadmin/upload/posts/original/";
    $thumb_path = "webadmin/upload/posts/thumb//";
    include('resize-class.php');

    //$title = addslashes($_GET['title']);
    $title =strip_tags($_POST['title']);
    $sub_title = strip_tags(addslashes($_POST['subtitle']));
    $post = addslashes($_POST['post']);
    $name = $_FILES['fileUpload']['name'];
    $size = $_FILES['fileUpload']['size'];
    $image_type = $_POST['cover'];
    $post_id = $_POST['postid'];
    
    
 if(!empty($name) )
    {
     
      $actual_image_name=time().'-'.$name;
    list($txt, $ext) = explode(".", $name);
    if(in_array($ext,$valid_formats))
    {
    if($size<10485760)
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
                        $d = time();
                        $sql="UPDATE drafts SET image='$actual_image_name',image_type='$image_type',title='$title',sub_title='$sub_title',post='$post',updated_time='$d' WHERE collection_id='$collection_id' AND id='$post_id' AND author='$session_id'  ";
                        $res=mysql_query($sql)or die(mysql_error());
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
    else
    {
        $d = time();
         $sql="UPDATE drafts SET title='$title',sub_title='$sub_title',post='$post',updated_time='$d' WHERE collection_id='$collection_id' AND author='$session_id' AND id ='$post_id'  ";
        $res = mysql_query($sql)or die(mysql_error());
        //$sql_get = mysql_query("SELECT * FROM drafts WHERE id='$post_id' ");
        //$res_get = mysql_fetch_array($sql_get);
        //echo json_encode($res_get);
        //$ar[0]="success";
       // echo json_encode($ar);
    }
    
    
}
if(isset($_GET) and sizeof($_GET))
{
    $post_id = $_GET['postid'];
    $sql_get = mysql_query("SELECT * FROM drafts WHERE id='$post_id' ");
    $res_get = mysql_fetch_array($sql_get);
    echo json_encode($res_get);
}


?>
