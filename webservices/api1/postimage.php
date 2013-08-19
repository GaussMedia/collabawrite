<?php
//include('db.php');
include('../../Twitter_Login/config/dbconfig.php');
session_start();
include('webadmin/k.php');
include('../../resize-class.php');
$session_id=$_GET['id']; //$session id

$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");

$profile_name = strtolower($_FILES['userfile']['name']);
$profile_size = $_FILES['userfile']['size'];

         list($profile_txt, $profile_ext) = explode(".", $profile_name);
         if(in_array($profile_ext,$valid_formats))
         {
         if($profile_size<(2048*2048))
                 {
                         $actual_image_profile=time().'-'.$profile_name;
                         $actual_image_profile = str_replace(' ','-',$actual_image_profile);
                         $tmp_profile = $_FILES['userfile']['tmp_name'];
                         if(move_uploaded_file($tmp_profile, '/var/www/clients/client2/web211/web/webadmin/upload/posts/original/'.$actual_image_profile))
                            {
                             $d=time();
                             $resizeObj = new resize($profile_path.$actual_image_profile);
                             $thumb_path_146x109 = '/var/www/clients/client2/web211/web/webadmin/upload/posts/thumb/';
                             $resizeObj->resizeImage(50,50,'exact');
                             $t=$resizeObj->saveImage($thumb_path_146x109.$actual_image_profile,100);
                                 if($t == '1')
                                 {
                                 $sql="UPDATE drafts SET image='$actual_image_profile' , image_type='fit'  WHERE id='$session_id'";
                                 $res=mysql_query($sql)or die(mysql_error());
                                  //$sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
                                 //$data = mysql_fetch_array($sql_sel);
                                  echo json_encode(array('Message'=>'true','UpdatedId'=>$session_id));
                                 }
                              }
                         else{
                                 echo  json_encode(array('Message'=>'false','status'=>'failed'));
                         }
                 }
                 else
                 {
                 echo json_encode(array('Message'=>'false','status'=>'This image size unable to upload for profile image.Size allowded 4 mb . '));
                 }
                 }
                 else{
                echo json_encode(array('Message'=>'false','status'=>'Invalid file format..!'));
                 }

?>