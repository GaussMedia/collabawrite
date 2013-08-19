<?php
if($_POST['submit'])
{
	extract($_POST);
	$filetype=$_FILES['song']['name'];
	$filesize=$_FILES['song']['size'];
	$location=$_FILES['song']['tmp_name'];

	$path="upload/song/real/";
	$d=time();
	$table=array('song','(`song_title`,','`song_des`,','`song`,','`artist`,','`creation_date`)');
	$where=array("'$song_title',","'$song_des',","'$song',","'$artist',","'$d'");
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
			   $t=$obj->upload_image($img_name,$path);
			   if($t == '1')
			   {
				   $where[0]="('".$blog_t."',";
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
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=player" >';
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
          <label for="required">Song Title:</label>
          <div class="field">
            <input type="text" name="song_title" size="20"  value="<?php echo $blog_t; ?>" />
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="email">Song Description:</label>
          <div class="field">
            <textarea id="editor1"  name="song_des"><?php echo $blog_des; ?></textarea>
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
          <label for="date">Song:</label>
          <div class="field">
            <input type="file" name="song"  size="15" value="" />
            <label for="date"></label>
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="password1">Song Artist:</label>
          <div class="field">
            <input type="text" name="artist"  size="25" value="<?php echo $blog_tag; ?>" />
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
