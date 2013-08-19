<?php
$edit_id=base64_decode($_GET['collection_id']);
$table="collections";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`id`='".$edit_id."'");

$fetchauthor=$obj->fetch_one('twitter_users',"`id`='".$fetch['collection_author']."'");

if($_POST['submit'])
{
	extract($_POST);
	$filetype=$_FILES['image']['name'];
	$filesize=$_FILES['image']['size'];
	$location=$_FILES['image']['tmp_name'];
        $path="../ajaximage/uploads/";
        //$thumb_path="upload/blog/thumb/";
 	if($filetype != '')
	{
		$img_name=time()."-". $filetype;
		$r[]=$obj->validate_filetype($filetype);
		$r[]=$obj->validate_image_size($filesize);
		if(move_uploaded_file($location,$path.$img_name))
		{
		   $t=$obj->upload_image($img_name,$path, $thumb_path);
		   if($t == '1')
		   {
			  
	           $data = array('collection_name' => $collection_name,'collection' => $collection,'image' => $img_name);
		   $r=$obj->update('collections',$data,'id='.$edit_id);
		   }
		}
	}
	else
	{
		$data = array('collection_name' => $fetch['collection_name'],'collection' => $fetch['collection'],'image' => $fetch['image']);
		$r=$obj->update('collections',$data,'id='.$edit_id);
	}
}

?>

<div class="widget widget-table">
<div class="widget-header"> <span class="icon-list"></span>
    <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>Collection By: <strong><?=$fetchauthor['fullname']?></strong>
  <span style="float:right;">
  <a href="index.php?mode=manage_collections">
  <button type="button" class="btn btn-error">Manage Collections</button>
  </a>
  </span>
</div>
<!-- .widget-header -->

<div class="widget-content">
  <div id="login_panel">
    <?php
if(($r == '1'))
{
?>
    <div class="alert alert-success"> <a class="close" data-dismiss="alert">×</a>
      <p>
        <?php
echo "Collection Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_collection&collection_id='.base64_encode($edit_id).'" >';
?>
      </p>
    </div>
    <!-- .notify -->
    <?php
}
else{
if((is_array($r))  && ($r != ""))
{
?>
    <div class="alert alert-error"> <a class="close" data-dismiss="alert">×</a>
      <p>
        <?php
foreach($r as $v)
{
	echo $v.'<br>';
}
?>
      </p>
    </div>
    <!-- .notify -->
    <?php
}
}
 ?>
    <form method="post"  class="" action="" name="frm1" enctype="multipart/form-data">
      <div class="field-group">
        <label for="required">Collection Name:</label>
        <div class="field">
          <input type="text" name="collection_name" size="20"  value="<?php echo $fetch['collection_name'];?>" />
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="email">collection Description:</label>
        <div class="field">
          <textarea id="editor1" name="collection" cols="45" rows="10"  ><?php echo $fetch['collection'];?></textarea>
          <script type="text/javascript">
                                        //<![CDATA[
                                        
                                        CKEDITOR.replace( 'editor1',
                                        {
                                        
                                        });
                                        
                                        //]]>
                                        </script> 
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="date">collection Image:</label>
        <div class="field">
          <input type="file" name="image"  size="15" value="<?php echo $fetch['blog_img']; ?>"  />
          <label for="date"></label>
          <img src="../ajaximage/uploads/<?php echo $fetch['image']; ?>" width="100" height="120" /> </div>
      </div>
      <!-- .field-group -->
      
<!--      <div class="field-group">
        <label for="password1">BLog Tag:</label>
        <div class="field">
          <input type="text" name="blog_tag"  size="25" value="<?php //echo $fetch['blog_tag'];?>" />
        </div>
      </div>-->
      <div class="actions">
        <input type="submit" class="btn btn-red" name="submit" value="Submit Query">
      </div>
      <!-- .actions -->
      
    </form>
  </div>
  <!-- .widget-content --> 
  
</div>
<!-- .widget --> 
