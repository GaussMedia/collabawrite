<?php
//include('db.php');
include('../../Twitter_Login/config/dbconfig.php');
session_start();
    $profile_path = "/var/www/clients/client2/web211/web/webadmin/upload/userprofile/original/";
    $profile_thumb_path = "/var/www/clients/client2/web211/web/webadmin/upload/userprofile/thumb/";
    //$cover_path = "/var/www/clients/client2/web211/web/webadmin/upload/usercover/original/";
   //$cover_thumb_path = "webadmin/upload/userprofile/thumb/";
    include('webadmin/k.php');
    include('../../resize-class.php');
    $session_id=$_GET['id']; //$session id
// print_r($_FILES);
// exit;
$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");
//if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
//{
//$cover_name = strtolower($_FILES['usercover']['name']);
//$cover_size = $_FILES['usercover']['size'];

$profile_name = strtolower($_FILES['userfile']['name']);
$profile_size = $_FILES['userfile']['size'];
//die;
//echo "<pre>";
//print_r($_FILES);
//exit;
//$profileName = $_POST['profileName'];
//$profileLoc    =  $_POST['profileLoc'];
//$profileDesc = $_POST['profileDesc'];


//if(strlen($cover_name))
       // {
//                list($cover_txt, $cover_ext) = explode(".", $cover_name);
//                if(in_array($cover_ext,$valid_formats) )
//                {
//                if($cover_size<(10485760) )
//                        {
//                                $actual_image_cover=time().'-'.$cover_name;
//                                $actual_image_cover  = str_replace(' ','-',$actual_image_cover);
//                                $tmp_cover = $_FILES['photoimg']['tmp_name'];
//                                if((move_uploaded_file($tmp_cover, $cover_path.$actual_image_cover)) )
//                                   {
//                                    $d=time();
//                                      $sql="UPDATE twitter_users SET profile_cover='$actual_image_cover' WHERE id='$session_id'";
//                                        $res=mysql_query($sql)or die(mysql_error());
//                                        $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
//                                        $data = mysql_fetch_array($sql_sel);
//                                     }
//                                else{
//                                echo  json_encode(array('Message'=>'false','status'=>'failed'));
//                                }
//                        }
//                        else{
//                       echo json_encode(array('Message'=>'false','status'=>'This image size unable to upload for cover.Size allowded 10 mb. '));
//                }
//                        }
//                        else{
//                        echo json_encode(array('Message'=>'false','status'=>'Invalid file format..'));
//                        }
     //   }
// else{
//                $sql="UPDATE twitter_users SET fullname='$profileName',location='$profileLoc',description ='$profileDesc' WHERE id='$session_id'";
//               $res=mysql_query($sql)or die(mysql_error());
//                $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
//                $data = mysql_fetch_array($sql_sel);
//                        }
            
                        
//if(strlen($profile_name))
    // {
         list($profile_txt, $profile_ext) = explode(".", $profile_name);
         if(in_array($profile_ext,$valid_formats))
         {
         if($profile_size<(2048*2048))
                 {
                         $actual_image_profile=time().'-'.$profile_name;
                         $actual_image_profile = str_replace(' ','-',$actual_image_profile);
                         $tmp_profile = $_FILES['userfile']['tmp_name'];
                         if(move_uploaded_file($tmp_profile, '/var/www/clients/client2/web211/web/webadmin/upload/userprofile/original/'.$actual_image_profile))
                            {
                             $d=time();
                             $resizeObj = new resize($profile_path.$actual_image_profile);
                             $thumb_path_146x109 = '/var/www/clients/client2/web211/web/webadmin/upload/userprofile/thumb/';
                             $resizeObj->resizeImage(50,50,'exact');
                             $t=$resizeObj->saveImage($thumb_path_146x109.$actual_image_profile,100);
                                 if($t == '1')
                                 {
                                 $sql="UPDATE twitter_users SET image='$actual_image_profile' WHERE id='$session_id'";
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
 //}
//else{
//         $sql="UPDATE twitter_users SET fullname='$profileName',location='$profileLoc',description ='$profileDesc' WHERE id='$session_id'";
//        $res=mysql_query($sql)or die(mysql_error());
//        $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
//        $data = mysql_fetch_array($sql_sel);
//
// }  
//echo json_encode($data);
//}
?>