<?php
include('../../Twitter_Login/config/dbconfig.php');
session_start();
    $path = "/var/www/clients/client2/web211/web/webadmin/upload/posts/original/";
    $thumb_path = "/var/www/clients/client2/web211/web/webadmin/upload/posts/thumb/";
    //$cover_path = "/var/www/clients/client2/web211/web/webadmin/upload/usercover/posts/";
   //$cover_thumb_path = "webadmin/upload/userprofile/thumb/";
  include('../../resize-class.php');
 $session_id=$_GET['userid']; //$session id
$name = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
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

                   $sql="UPDATE drafts SET  image='$actual_image_name',image_type='$image_type',title='$title',sub_title='$sub_title',post='$post' WHERE collection_id='$collection_id' AND id='$post_id' AND author='$session_id' ";
                    $res=mysql_query($sql)or die(mysql_error());
                    $draft_id = $post_id;
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
?>
