<?php
if($_POST['submit'])
{
	extract($_POST);
	$d=time();
	$page_slug = preg_replace("/[^a-zA-Z0-9 ]/", "", $page_t);
	$slug = strtolower(str_replace(" ", "_", $page_slug));
	
        //$page_des=addslashes($page_des);
	$table=array('page','(`slug`,','`page_title`,','`page_des`,','`seo_t`,','`seo_k`,','`meta_des`,','`creation_date`)');
	$where=array("'$slug',","'$page_title',","'$page_des',","'$seo_t',","'$seo_k',","'$meta_des',","'$d'");
			
	getConnection();
	$obj=new KARAMJEET();
	$r=$obj->check_null($where,$table);
	if((!isset($r)) && ($r == ''))
	{
		$where[0]="('".$slug."',";
		$where[6]="'".$d."')";
        $r=$obj->insert($table,$where);
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
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_page" >';
?></p>
</div> <!-- .notify -->
<?php
}
else{
if((is_array($r)))
{
?>
<div class="alert alert-error">
<a class="close" data-dismiss="alert">×</a>
<p><?php
foreach($r as $v)
{
	echo $v.'<br>';
}
?></p>
</div> <!-- .notify -->
<?php
}
}
?>
      <form method="post"  class="" action="" name="frm1" enctype="multipart/form-data">
        <div class="field-group">
          <label for="required">Page Title:</label>
          <div class="field">
            <input type="text" name="page_title" size="20"  value="<?php echo $page_t; ?>" />
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="email">Page Description:</label>
          <div class="field">
            <textarea id="editor1" name="page_des" cols="45" rows="10"  ><?php echo $page_des; ?></textarea>
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
          <label for="date">SEO Title:</label>
          <div class="field">
            <input type="text" name="seo_t"  size="15" value="<?php echo $seo_t; ?>" />
            <label for="date"></label>
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="password1">SEO Keyword:</label>
          <div class="field">
            <input type="text" name="seo_k"  size="25" value="<?php echo $seo_k; ?>" />
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="password2">Meta Description:</label>
          <div class="field">
            <input type="text" name="meta_des"  size="25" value="<?php echo $meta; ?>" />
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
