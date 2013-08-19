<?php
$reply_id=base64_decode($_GET['company_id']);
$table="companies";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table, "`company_id`='".$reply_id."'");

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

//$pwd=randomPassword();
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
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_companies" >';
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
          <label for="required">User name:</label>
          <div class="field">
            <input type="text" name="page_title" size="20"  value="<?php echo $fetch['username']; ?>" />
          </div>
        </div>
        <!-- .field-group -->
        <div class="field-group">
          <label for="required">Company name:</label>
          <div class="field">
            <input type="text" name="page_title" size="20"  value="<?php echo $fetch['company_name']; ?>" />
          </div>
        </div>
  
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="date">Email:</label>
          <div class="field">
            <input type="text" name="seo_t"  size="40" value="<?php echo $fetch['email']; ?>" />
            <label for="date"></label>
          </div>
        </div>
        <!-- .field-group -->
        <div class="field-group">
          <label for="email">Say Few words:</label>
          <div class="field">
            <textarea id="editor1" name="des" cols="45" rows="10"  ><?php echo $page_des; ?></textarea>
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

