<?php
//include('db.php');
include('../../Twitter_Login/config/dbconfig.php');
session_start();
include('webadmin/k.php');
include('../../resize-class.php'); 
$session_id=$_GET['id']; //$session id

//print_r($_FILES);
//die;
$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");

$profile_name = strtolower($_FILES['postimage']['name']);
$profile_size = $_FILES['postimage']['size'];


//$sql="UPDATE drafts SET post='$actual_image_profile' , image_type='fit'  WHERE id='$session_id'";
//$res=mysql_query($sql)or die(mysql_error());
//$sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
//$data = mysql_fetch_array($sql_sel);
//echo json_encode(array('Message'=>'true','UpdatedId'=>$session_id));
//
// exit;
         list($profile_txt, $profile_ext) = explode(".", $profile_name);
         if(in_array($profile_ext,$valid_formats))
         {
         if($profile_size<(2048*2048))
                 {
                         $actual_image_profile=time().'-'.$profile_name;
                         $actual_image_profile = str_replace(' ','-',$actual_image_profile);
                         $tmp_profile = $_FILES['postimage']['tmp_name'];
                         if(move_uploaded_file($tmp_profile, '/var/www/clients/client2/web211/web/webadmin/upload/testing/'.$actual_image_profile))
                            {
//                                 $sql="UPDATE drafts SET image='$actual_image_profile' , image_type='fit'  WHERE id='$session_id'";
//                                 $res=mysql_query($sql)or die(mysql_error());
//                                  $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
//                                 $data = mysql_fetch_array($sql_sel);
//                                  echo json_encode(array('Message'=>'true','UpdatedId'=>$session_id));
                                //$imagedata = file_get_contents("/var/www/clients/client2/web211/web/webadmin/upload/testing/".$actual_image_profile);
                                            // alternatively specify an URL, if PHP settings allow
                                //$base64 = base64_encode($imagedata);
                               // $text = '<img src="'.$base64.'">';
                             
                                //$type = pathinfo( '/var/www/clients/client2/web211/web/webadmin/upload/testing/'.$actual_image_profile, PATHINFO_EXTENSION);
                                //$data = file_get_contents( '/var/www/clients/client2/web211/web/webadmin/upload/testing/'.$actual_image_profile);
                               // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                $text = '<img src="'.$url.'"><br>';
                                $gettext = $_GET['Path'];
                                if($gettext == '' or $gettext == 'null' ){
                                     //$gettext = $gettext.$url;
                                     $post = $text;
                                     $url = 'http://reportedly.pnf-sites.info/webadmin/upload/testing/'.$actual_image_profile;
                                }else{
                                        $url = 'http://reportedly.pnf-sites.info/webadmin/upload/testing/'.$actual_image_profile;
                                        $gettext = $gettext.','.$url;
                                        $url_ary  = explode(',',$gettext);
                                        //print_r($url_ary);
                                        //exit;
                                        $url_ary = array_filter($url_ary); 
                                        //$post = $text;
                                        foreach($url_ary as $v){
                                                    $post .=  '<div id="columns">
                                                        <div id="column2" class="column">
                                                        <div class="widget">
                                                        <div class="widget-head">
                                                        <div class="img_show">
                                                        <img src="'.$v.'">
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div></div><br>';
                                                   
                                      }
                                       $url = implode(',' , $url_ary);
                                }
                                $d = time();
                                $sql="UPDATE drafts SET post='$post', updated_time='$d' WHERE id='$session_id' ";
                                //$sql="UPDATE drafts SET post='CONCAT(post,'$text ')' WHERE id='$session_id' ";
                                $res=mysql_query($sql)or die(mysql_error());
                                //$sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
                                //$data = mysql_fetch_array($sql_sel);
                                //$img = strip_slashes('/var/www/clients/client2/web211/web/webadmin/upload/testing/'.$actual_image_profile);
                                //$post = base64_encode($post);
                                echo json_encode(array('Message'=>'true','UpdatedId'=>$session_id,'Path'=>stripslashes($url)));
                              }
                         else{
                                 echo  json_encode(array('Message'=>'false','status'=>'failed'));
                         }
                 }
                 else
                 {
                 echo json_encode(array('Message'=>'false','status'=>'This image size unable to upload for profile image.Size allowded 4 mb .'));
                 }
                 }
                 else{
                echo json_encode(array('Message'=>'false','status'=>'Invalid file format..!'));
                 }
exit;
?>

<?php
include('../../Twitter_Login/config/dbconfig.php');
session_start();
include('webadmin/k.php');
include('../../resize-class.php'); 
$session_id=$_GET['id']; //$session id

$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");
$profile_name = strtolower($_FILES['userfile']['name']);
$profile_size = $_FILES['userfile']['size'];
 echo json_encode(array('Message'=>'true','UpdatedId'=>$_FILES['userfile']['path']));
$file_ary = reArrayFiles($_FILES['filename']);
foreach($file_ary as $file)
{
    echo $file['path'].'<br>';
}
die;
foreach($file_ary as $file)
{
    list($profile_txt, $profile_ext) = explode(".", $file['name']);
         if(in_array($profile_ext,$valid_formats))
         {
         if($file['size']<(2048*2048))
                 {
                         $actual_image_profile=time().'-'.$file['name'];
                         $actual_image_profile = str_replace(' ','-',$actual_image_profile);
                         $tmp_profile = $file['tmp_name'];
                         if(move_uploaded_file($tmp_profile, '/var/www/clients/client2/web211/web/webadmin/upload/testing/'.$actual_image_profile))
                            {
//                                 $sql="UPDATE drafts SET image='$actual_image_profile' , image_type='fit'  WHERE id='$session_id'";
//                                 $res=mysql_query($sql)or die(mysql_error());
//                                  $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
//                                 $data = mysql_fetch_array($sql_sel);
//                                  echo json_encode(array('Message'=>'true','UpdatedId'=>$session_id));
                                //$imagedata = file_get_contents("/var/www/clients/client2/web211/web/webadmin/upload/testing/".$actual_image_profile);
                                            // alternatively specify an URL, if PHP settings allow
                                //$base64 = base64_encode($imagedata);
                               // $text = '<img src="'.$base64.'">';
                             
                                $type = pathinfo( '/var/www/clients/client2/web211/web/webadmin/upload/testing/'.$actual_image_profile, PATHINFO_EXTENSION);
                                $data = file_get_contents( '/var/www/clients/client2/web211/web/webadmin/upload/testing/'.$actual_image_profile);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                $text .= '<img src="'.$base64.'"><br>';
                              }
                         else{
                                 echo  json_encode(array('Message'=>'false','status'=>'failed'));
                         }
                 }
                 else
                 {
                 echo json_encode(array('Message'=>'false','status'=>'This image size unable to upload for profile image.Size allowded 4 mb .'));
                 }
                 }
                 else{
                echo json_encode(array('Message'=>'false','status'=>'Invalid file format..!'));
                 }
}
//print_r($text);die;
if(!empty($text)){
    $sql="UPDATE drafts SET post='$text' WHERE id='$session_id' ";
    $res=mysql_query($sql)or die(mysql_error());
    $sql_sel = mysql_query("SELECT image,profile_cover FROM twitter_users WHERE id = '$session_id'");
    $data = mysql_fetch_array($sql_sel);
    echo json_encode(array('Message'=>'true','UpdatedId'=>$session_id));
}

?>
