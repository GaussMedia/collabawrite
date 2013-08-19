<?php
//include('db.php');
include('Twitter_Login/config/dbconfig.php');
session_start();
    $profile_path = "webadmin/upload/userprofile/original/";
    $profile_thumb_path = "webadmin/upload/userprofile/thumb/";
    $cover_path = "webadmin/upload/usercover/original/";
   //$cover_thumb_path = "webadmin/upload/userprofile/thumb/";
    include('webadmin/k.php');
    include('resize-class.php');
 $session_id=$_SESSION['id']; //$session id
//$path = "ajaximage/uploads/";

	$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$cover_name = strtolower($_FILES['photoimg']['name']);
$cover_size = $_FILES['photoimg']['size'];

$profile_name = strtolower($_FILES['profilepic']['name']);
$profile_size = $_FILES['profilepic']['size'];
//echo "<pre>";
//print_r($_FILES);
//exit;
$profileName = $_POST['profileName'];
$profileLoc    =  $_POST['profileLoc'];
$profileDesc = $_POST['profileDesc'];


if(strlen($cover_name ))
        {
                list($cover_txt, $cover_ext) = explode(".", $cover_name);
                if(in_array($cover_ext,$valid_formats) )
                {
                if($cover_size<(10485760) )
                        {
                                $actual_image_cover=time().'-'.$cover_name;
                                $actual_image_cover  = str_replace(' ','-',$actual_image_cover);
                                $tmp_cover = $_FILES['photoimg']['tmp_name'];
                                if((move_uploaded_file($tmp_cover, $cover_path.$actual_image_cover)) )
                                   {
                                    $d=time();
                                      $sql="UPDATE twitter_users SET fullname='$profileName',location='$profileLoc',description ='$profileDesc',profile_cover='$actual_image_cover' WHERE id='$session_id'";
                                        $res=mysql_query($sql)or die(mysql_error());
                                        $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
                                        $data = mysql_fetch_array($sql_sel);
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
 else{
                $sql="UPDATE twitter_users SET fullname='$profileName',location='$profileLoc',description ='$profileDesc' WHERE id='$session_id'";
               $res=mysql_query($sql)or die(mysql_error());
                $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
                $data = mysql_fetch_array($sql_sel);
                        }
            
                        
if(strlen($profile_name))
     {
         list($profile_txt, $profile_ext) = explode(".", $profile_name);
         if(in_array($profile_ext,$valid_formats))
         {
         if($profile_size<(4194304))
                 {
                         $actual_image_profile=time().'-'.$profile_name;
                         $actual_image_profile = str_replace(' ','-',$actual_image_profile);
                         $tmp_profile = $_FILES['profilepic']['tmp_name'];
                         if((move_uploaded_file($tmp_profile, $profile_path.$actual_image_profile))  )
                            {
                             $d=time();
                             $resizeObj = new resize($profile_path.$actual_image_profile);
                             $thumb_path_146x109 = $profile_thumb_path;
                             $resizeObj->resizeImage(50,50,'exact');
                             $t=$resizeObj->saveImage($thumb_path_146x109.$actual_image_profile,100);
                                 if($t == '1')
                                 {
                                 $sql="UPDATE twitter_users SET fullname='$profileName',location='$profileLoc',description ='$profileDesc',image='$actual_image_profile' WHERE id='$session_id'";
                                 $res=mysql_query($sql)or die(mysql_error());
                                  $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
                                 $data = mysql_fetch_array($sql_sel);
                                 }
                              }
                         else
                                 echo "failed";
                 }
                 else
                 echo "Image file size max 4 MB";					
                 }
                 else
                 echo "Invalid file format..";	
 }
else{
         $sql="UPDATE twitter_users SET fullname='$profileName',location='$profileLoc',description ='$profileDesc' WHERE id='$session_id'";
        $res=mysql_query($sql)or die(mysql_error());
        $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
         $data = mysql_fetch_array($sql_sel);

 }  
echo json_encode($data);
        exit;
}
?>