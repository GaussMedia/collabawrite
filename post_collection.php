<?php
//include('db.php');
include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id']; //$session id
$path = "webadmin/upload/collection/original/";
$thumb_path = "webadmin/upload/collection/thumb/";
include('webadmin/k.php');
include('resize-class.php');

$obj=new KARAMJEET();

$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
$name = strtolower($_FILES['fileUpload']['name']);
$size = $_FILES['fileUpload']['size'];
$collection_name = addslashes($_POST['collection_name']);
$collection = addslashes($_POST['collection']);
$collection_type = $_POST['collection_type'];


if(strlen($name))
        {
                list($txt, $ext) = explode(".", $name);
                if(in_array($ext,$valid_formats))
                {
                if($size < 10485760)
                        {
                    $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
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
                         $sql="INSERT INTO collections(collection_name,collection,image,contribute_type,collection_author,creation_date) VALUES('$collection_name','$collection','$actual_image_name','$collection_type','$session_id','$d')";
                 $res=mysql_query($sql)or die(mysql_error());

                       echo  $last_ins_id =  mysql_insert_id();
                        }
                //$collec=$obj->fetch_one('collections',"`id`='".$last_ins_id."'");
                //echo json_encode($collec);
                //echo 'Collection added successfully';   
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
                    echo "Please select image..!";

            exit;
}
?>