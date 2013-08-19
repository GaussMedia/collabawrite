<?php

// upload the images
/*				$filetype = $_FILES['image[$i]']['type'];
				$filename = $_FILES['image[$i]']['tmp_name'];
				$imageName = "../users_files/".$filename;
				$tempFile->validate_extentsion($filename, $extensionCheck = array(".jpg", ".jpeg", ".gif", ".png"));
				$tempFile->validate_image($filetype);
				$tempFile->validate_filesize($filename);
				$tempFile->uploadImage($filename, $imageName);
*/
	/*$file=$_FILES['blog_image']['name'];
		$handlers = array(
    'jpg'  => 'imagecreatefromjpeg',
    'jpeg' => 'imagecreatefromjpeg',
    'png'  => 'imagecreatefrompng',
    'gif'  => 'imagecreatefromgif'
);

$extension = strtolower(substr($file, strrpos($file, '.')+1));
if ($handler = $handlers[$extension]){
	//print_r($handlers['png']);
   $image = $handler($file);
	print_r($handler);
	 echo "Valid Image";
    //do the rest of your thumbnail stuff here
}else{
    echo "//throw an 'invalid image' error";
}
die;*/

if($_POST['submit'])
{
	extract($_POST);
	$filetype=$_FILES['blog_img']['name'];
	$filesize=$_FILES['blog_img']['size'];
	$location=$_FILES['blog_img']['tmp_name'];

	$path="upload/blog/real/";
	$thumb_path="upload/blog/thumb/";
	$d=time();
	$table=array('blog','(`blog_title`,','`blog_des`,','`blog_img`,','`blog_tag`,','`creation_date`)');
	$where=array("'$blog_title',","'$blog_des',","'$filetype',","'$blog_tag',","'$d'");
	getConnection();
	$obj=new KARAMJEET();
	$r=$obj->check_null($where,$table);
	if((!isset($r)) && ($r == ''))
		{
			$img_name=time()."-". $filetype;
			$r[]=$obj->validate_filetype($filetype);
			$r[]=$obj->validate_image_size($filesize);
			if(move_uploaded_file($location,$path.$img_name))
			{
			   $t=$obj->upload_image($img_name,$path,$thumb_path);
			   if($t == '1')
			   {
				   $where[0]="('".$blog_title."',";
				   $where[2]="'".$img_name."',";
		           $where[4]="'".$d."')";
				   $r=$obj->insert($table,$where);
			   }
			}
		}
}

?>

<div class="widget widget-table">
  <div class="widget-header"> <span class="icon-list"></span>
    <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
  </div>
  <!-- .widget-header -->
  
  <div class="widget-content">
    <div id="login_panel">
<?php
if((!is_array($r)) && ($r  != ""))
{
?>
<div class="alert alert-success">
<a class="close" data-dismiss="alert">×</a>
<p><?php
echo $r;
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_blog" >';
?></p>
</div> <!-- .notify -->
<?php
}
else{
if((is_array($r)) && ($r != ""))
{
?>
<div class="alert alert-error">
<a class="close" data-dismiss="alert">×</a>
<p><?php
foreach($r as $v)
{
	 echo '<br>'.$v;
}
?></p>
</div> <!-- .notify -->
<?php
}
}
?>
      <form method="post"  class="" action="" name="frm1" enctype="multipart/form-data">
        <div class="field-group">
          <label for="required">Blog Title:</label>
          <div class="field">
            <input type="text" name="blog_title" size="20"  value="<?php echo $blog_title; ?>" />
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="email">Blog Description:</label>
          <div class="field">
            <textarea id="editor1"  name="blog_des"><?php echo $blog_des; ?></textarea>
            <script type="text/javascript">
                                            CKEDITOR.replace( 'editor1',
                                            {
                                                filebrowserBrowseUrl : 'browser.php',
                                                filebrowserUploadUrl : 'upload.php'
                                            });
                                        </script> 
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="date">Blog Image:</label>
          <div class="field">
            <input type="file" name="blog_img"  size="15" value="" />
            <label for="date"></label>
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="password1">Blog Tag:</label>
          <div class="field">
            <input type="text" name="blog_tag"  size="25" value="<?php echo $blog_tag; ?>" />
          </div>
        </div>
        <!-- .field-group --> 
        
        <!-- .field-group -->
        
        <div class="actions">
          <input type="submit" class="btn btn-red" name="submit" value="Submit Query">
        </div>
        <!-- .actions -->
        
      </form>
    </div>
    <!-- .widget-content --> 
    
  </div>
  <!-- .widget --> 
</div>
