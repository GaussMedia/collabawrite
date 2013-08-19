<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$table="collections";
$obj=new KARAMJEET();
$edit_id = $_POST['editid'];
//print_r($_POST);
//print_r($_FILES);

$fetch_post=$obj->fetch_one('posts',"`id`='".$edit_id."'");

$session_id=$_SESSION['id']; //$session id
$path = "webadmin/upload/posts/original/";
$thumb_path = "webadmin/upload/posts/thumb//";
include('resize-class.php');



$valid_formats = array("jpg", "png", "jpeg", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$name = $_FILES['fileUpload']['name'];
$size = $_FILES['fileUpload']['size'];
$title = $_POST['title'];
$sub_title = $_POST['sub_title'];
$post =  addslashes($_POST['post']);
//print_r($_POST);

if(empty($name))
{
     $sql="UPDATE posts SET title='$title',sub_title='$sub_title',post='$post',image='$fetch_post[image]' WHERE id='$edit_id' ";
    
  $res=mysql_query($sql)or die(mysql_error());
       //echo 'Draft Published with existing image';
}
 else {
               list($txt, $ext) = explode(".", $name);
                if(in_array($ext,$valid_formats))
                {
                if($size<(1024*1024))
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

                       $sql="UPDATE posts SET title='$title',sub_title='$sub_title',post='$post',image='$actual_image_name'  WHERE id='$edit_id'";
                       
                       $res=mysql_query($sql)or die(mysql_error());
                        }
                            //echo 'Draft Published';
                                   // echo "<img style='width:100%; height:100%;' src='ajaximage/uploads/".$actual_image_name."'  class='preview'>";
                                    //echo '<meta http-equiv="refresh" content="30; ,URL=http://reportedly.pnf-sites.info/developer/profile.php">';
                            }
                    else
                            echo "failed";
                }
                else
                echo "Image file size max 1 MB";					
                }
                        else
                        echo "Invalid file format..";	  
                        
}
exit;
}
?>
