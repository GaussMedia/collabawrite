<?php
if($_POST['submit'])
{
	extract($_POST);
	$filetype=$_FILES['slider_image']['name'];
	$filesize=$_FILES['slider_image']['size'];
	$location=$_FILES['slider_image']['tmp_name'];

	$path="upload/slider_images/real/";
	$d=time();
	$table=array('slider_images','(`image_title`,','`image_des`,','`image_name`,','`creation_date`)');
	$where=array("'$slider_image_title',","'$slider_image_des',","'$filetype',","'$d'");
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
			    $d=time();
				$where[0]="('".$slider_image_title."',";
				$where[2]="'".$img_name."',";
				$where[3]="'".$d."')";
			    $r=$obj->insert($table,$where);
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
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_slider_images" >';
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
          <label for="required">Image Title:</label>
          <div class="field">
            <input type="text" name="slider_image_title" size="20"  value="<?php echo $logo_title; ?>" />
          </div>
        </div>
        <!-- .field-group -->
       
	   <div class="field-group">
          <label for="email">Image Description:</label>
          <div class="field">
            <textarea id="editor1" name="slider_image_des" cols="45" rows="10"  ><?php echo $page_des; ?></textarea>
            <script type="text/javascript">
		//<![CDATA[
		
		CKEDITOR.replace( 'editor1',
		{
				 filebrowserBrowseUrl : 'browser.php',
				 filebrowserUploadUrl : 'upload.php'

		});
		
		//]]>
		</script> 
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="date">Slider Image:</label>
          <div class="field">
            <input type="file" name="slider_image"  size="15" value="" />
            <label for="date"></label>
          </div>
        </div>
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
