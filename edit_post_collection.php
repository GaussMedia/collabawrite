<?php
//include('db.php');
include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id=$_SESSION['id']; //$session id
$path = "webadmin/upload/collection/original/";
$thumb_path = "webadmin/upload/collection/thumb/";
include('webadmin/k.php');
include('resize-class.php');

$valid_formats = array("jpg","jpeg", "png", "gif", "bmp");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
    $name = strtolower($_FILES['fileUpload']['name']);
    $size = $_FILES['fileUpload']['size'];
    $collection_name = addslashes($_POST['collection_name']);
    $collection = addslashes($_POST['collection']);
    $edit_coll_id = $_POST['collection_id'];

    if(strlen($name)){
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
                                    $sql="UPDATE collections SET image = '$actual_image_name' WHERE id = '$edit_coll_id' ";
                                    $res=mysql_query($sql)or die(mysql_error());
                                    }
                             }
                            else{
                            echo  json_encode(array('Message'=>"image upload failed")); exit;
                            }
                    }
                            else{
                            echo  json_encode(array('Message'=>"Image file size max 10 MB"));exit;					 
                            }
                            }
                            else{
                            echo  json_encode(array('Message'=>"invalid file format...!"));	exit;}
            }

    if(!empty($collection_name)){
        $sql="UPDATE collections SET collection_name = '$collection_name'  WHERE id = '$edit_coll_id'";
        $res=mysql_query($sql)or die(mysql_error());
    }

    if(!empty($collection)){
        $sql="UPDATE collections SET collection = '$collection'  WHERE id = '$edit_coll_id'";
        $res=mysql_query($sql)or die(mysql_error());
    }

    if(!empty($collection_name) or !empty($collection) or !empty($name)){
             $sql_sel = mysql_query("SELECT * FROM collections WHERE id = '$edit_coll_id' ");
             $res_sql = mysql_fetch_array($sql_sel);
             echo json_encode($res_sql);  
             exit;
        }
        
}        


?>