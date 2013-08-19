<?php
include('../../Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id']; //$session id
include('../../resize-class.php');
$id = $_GET['id'];
//print_r($_FILES);
//  exit
$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");
$name = $_FILES['userfile']['name'];
$size = $_FILES['userfile']['size'];

                list($txt, $ext) = explode(".", $name);
                if(in_array($ext,$valid_formats))
                {
                if($size < 10485760)
                        {
                    $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
                    $actual_image_name=str_replace(' ','-',$actual_image_name);
                    $tmp = $_FILES['userfile']['tmp_name'];
                    if(move_uploaded_file($tmp, '/var/www/clients/client2/web211/web/webadmin/upload/collection/original/'.$actual_image_name))
                         {
                            $d=time();
                            $resizeObj = new resize('/var/www/clients/client2/web211/web/webadmin/upload/collection/original/'.$actual_image_name);
                            $thumb_path_146x109 = '/var/www/clients/client2/web211/web/webadmin/upload/collection/thumb/';
                            $resizeObj->resizeImage(434,180,'exact');
                            $t=$resizeObj->saveImage($thumb_path_146x109.$actual_image_name,100);
                            if($t == '1')
                                {
                                    $sql="UPDATE collections SET  image = '$actual_image_name' WHERE id = '$id'  ";
                                    $res=mysql_query($sql)or die(mysql_error());
                                    if($res){
                                        echo json_encode(array('Message'=>'true'));
                                   }
                                    else{
                                       echo json_encode(array('Message'=>'false'));
                                   }
                        }
                //$collec=$obj->fetch_one('collections',"`id`='".$last_ins_id."'");
                //echo json_encode($collec);
                //echo 'Collection added successfully';   
                    }
                        else
                                 echo json_encode(array('Message'=>'false','status'=>'failed')); //echo "failed";
                }
                        else
                         echo json_encode(array('Message'=>'false','status'=>'This image size unable to upload.max size allowed 10 mb'));//echo "Image file size max 1 MB";					
                        }
                        else
                            echo json_encode(array('Message'=>'false','status'=>'Invalid file format..'));// echo "Invalid file format..";	
            exit;
  
  

 ?>
