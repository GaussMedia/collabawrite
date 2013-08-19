<?php

if($_POST['submit'])
{
	extract($_POST);
        $slogan  = strip_tags($_POST['slogan']);
	$filetype=$_FILES['image']['name'];
	$filesize=$_FILES['image']['size'];
	$location=$_FILES['image']['tmp_name'];

	$path="upload/sloganimage/real/";
	$thumb_path="upload/sloganimage/thumb/";
	$d=time();
	$table=array('imageslogan','(`title`,','`slogan`,','`image`,','`creation_date`)');
	$where=array("'$title',","'$slogan',","'$filetype',","'$d'");
	getConnection();
	$obj=new KARAMJEET();
	$r=$obj->check_null($where,$table);
        if(empty($r))
        {
        $r=$obj->validate_filetype($filetype);
        if(empty($r)){
        
        $r=$obj->validate_image_size($filesize);
        }
        }
        
	if((!isset($r)) or (empty($r)))
        {
            
            $img_name=time()."-". $filetype;
            if(move_uploaded_file($location,$path.$img_name))
            {
                $resizeObj = new resize($path.$img_name);
                $thumb_path_146x109 = $thumb_path;
                $resizeObj->resizeImage(554,642,'exact');
                $t=$resizeObj->saveImage($thumb_path_146x109.$img_name,100);
               if($t)
               {
                    $where[0]="('".$slogan."',";
                    $where[1]="'".$img_name."',";
                    $where[2]="'".$d."')";
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
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_image_and_slogan" >';
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
          <label for="date">Title:</label>
          <div class="field">
            <input type="text" name="title"  size="45" value="<?php echo $title; ?>" />
            <label for="date"></label>
          </div>
        </div>

            <div class="field-group">
      <label for="email">Slogan Description:</label>
      <div class="field">
            <textarea id="editor1"  name="slogan"><?php echo $bslogan; ?></textarea>
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
          <label for="date">Image:</label>
          <div class="field">
            <input type="file" name="image"  size="15" value="" />
            <label for="date"></label>
          </div>
        </div>
        <!-- .field-group -->
        
        
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
