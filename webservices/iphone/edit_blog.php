<?php
$edit_id=base64_decode($_GET['blog_id']);
$table="blog";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`id`='".$edit_id."'");


if($_POST['submit'])
{
	extract($_POST);
	$filetype=$_FILES['blog_img']['name'];
	$filesize=$_FILES['blog_img']['size'];
	$location=$_FILES['blog_img']['tmp_name'];
    $path="upload/blog/real/";
    $thumb_path="upload/blog/thumb/";
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
			  
	           $data = array('blog_title' => $blog_title,'blog_des' => $blog_des,'blog_img' => $img_name,'blog_tag' => $blog_tag);
		   $r=$obj->update($table,$data,'id='.$edit_id);
		   }
		}
	}
	else
	{
		$data = array('blog_title' => $fetch['blog_title'],'blog_des' => $fetch['blog_des'],'blog_img' => $fetch['blog_img'],'blog_tag' => $fetch['blog_tag']);
		$r=$obj->update($table,$data,'id='.$edit_id);
	}
}

?>

<div class="widget widget-table">
<div class="widget-header"> <span class="icon-list"></span>
  <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
  <span style="float:right;">
  <a href="index.php?mode=manage_blog">
  <button type="button" class="btn btn-error">Manage Blogs</button>
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
echo "Blog Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_blog&blog_id='.base64_encode($edit_id).'" >';
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
        <label for="required">blog Title:</label>
        <div class="field">
          <input type="text" name="blog_title" size="20"  value="<?php echo $fetch['blog_title'];?>" />
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="email">blog Description:</label>
        <div class="field">
          <textarea id="editor1" name="blog_des" cols="45" rows="10"  ><?php echo $fetch['blog_des'];?></textarea>
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
        <label for="date">Blog Image:</label>
        <div class="field">
          <input type="file" name="blog_img"  size="15" value="<?php echo $fetch['blog_img']; ?>"  />
          <label for="date"></label>
          <img src="upload/blog/thumb/<?php echo $fetch['blog_img']; ?>" width="100" height="120" /> </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="password1">BLog Tag:</label>
        <div class="field">
          <input type="text" name="blog_tag"  size="25" value="<?php echo $fetch['blog_tag'];?>" />
        </div>
      </div>
      <div class="actions">
        <input type="submit" class="btn btn-red" name="submit" value="Submit Query">
      </div>
      <!-- .actions -->
      
    </form>
  </div>
  <!-- .widget-content --> 
  
</div>
<!-- .widget --> 
