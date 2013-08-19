<?php
//echo '<pre>';
//print_r($_FILES);
//die;
if($_POST['submit'])
{
	extract($_POST);
	$filetype=$_FILES['logo_image']['name'];
	$filesize=$_FILES['logo_image']['size'];
	$location=$_FILES['logo_image']['tmp_name'];

	$path="upload/logo/real/";
	$d=time();
	$table=array('logo','(`logo_title`,','`logo_image`,','`creation_date`)');
	$where=array("'$logo_title',","'$filetype',","'$d'");
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
                        $where[0]="('".$logo_title."',";
                        $where[1]="'".$img_name."',";
                        $where[2]="'".$d."')";
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
<a class="close" data-dismiss="alert">�</a>
<p><?php
echo $r;
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_logo" >';
?></p>
</div> <!-- .notify -->
<?php
}
else{
if((is_array($r)) && ($r != ""))
{
?>
<div class="alert alert-error">
<a class="close" data-dismiss="alert">�</a>
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
          <label for="required">logo Title:</label>
          <div class="field">
            <input type="text" name="logo_title" size="20"  value="<?php echo $logo_title; ?>" />
          </div>
        </div>
        <!-- .field-group -->
       
        
        <div class="field-group">
          <label for="date">logo Image:</label>
          <div class="field">
            <input type="file" name="logo_image"  size="15" value="" />
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
