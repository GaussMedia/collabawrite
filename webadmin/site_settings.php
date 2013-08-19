<?php
$query = "SELECT * FROM site_settings WHERE id='1' ";
$res = mysql_query($query)or die(mysql_error());
$fetch = mysql_fetch_array($res);

                if($_POST['submit'])
                {
                    $obj=new KARAMJEET();
                    extract($_POST);
                    $table = 'site_settings';
                    $address = strip_tags($_POST['adrs']);
                    $meta_des = stripslashes($_POST['meta_des']);
                    $seo_k = stripslashes($_POST['seo_k']);
                    
                    $data = array('Owner' => $Owner,'email' => $email,'adrs' => $address,'phone' => $phone,'mobile' => $mobile,'seo_t' => $seo_t,'seo_k' => $seo_k,'meta_des' => $meta_des);
                    $edit_id=1;
                    $r=$obj->update($table,$data,'id='.$edit_id);
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
echo " Updateed successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=site_settings" >';
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
          <label for="required"><strong>Owner:</strong></label>
          <div class="field">
            <input type="text" name="Owner" size="48"  value="<?php echo $fetch['Owner']; ?>" />
          </div>
          
          <br>
          
          <div class="field-group">
              <label for="required"><strong>Email:</strong></label>
          <div class="field">
            <input type="text" name="email" size="48"  value="<?php echo $fetch['email']; ?>" />
          </div>
        </div>
          
          <br>
          
          <div class="field-group">
          <label for="required"><strong>Address:</strong></label>
          <div class="field">
           <textarea id="editor1" name="adrs" cols="45" rows="3"  ><?php echo  $fetch['adrs']; ?></textarea>
            <script type="text/javascript">
//            CKEDITOR.replace( 'editor1',
//            {
//                            filebrowserBrowseUrl : 'browser.php',
//                            filebrowserUploadUrl : 'upload.php'
//
//            });
	</script> 
          </div>
        </div>
          
          <br>
          
          <div class="field-group">
          <label for="required"><strong>Phone:</strong></label>
          <div class="field">
            <input type="text" name="phone" size="48"  value="<?php echo $fetch['phone']; ?>" />
          </div>
        </div>
          
          <br>
          
        </div>
        <div class="field-group">
          <label for="required"><strong>Mobile:</strong></label>
          <div class="field">
            <input type="text" name="mobile" size="48"  value="<?php echo $fetch['mobile']; ?>" />
          </div>
        </div>
        <br>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="date"><strong>SEO Meta Title:</strong></label>
          <div class="field">
            <input type="text" name="seo_t"  size="48" value="<?php echo $fetch['seo_t']; ?>" />
            <label for="date"></label>
          </div>
        </div>
        <br>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="password1"><strong>SEO Meta Keyword(s):</strong></label>
          <div class="field">
            <input type="text" name="seo_k"  size="48" value="<?php echo $fetch['seo_k']; ?>" />
          </div>
        </div>
        <br>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="password2"><strong>Seo Meta Description:</strong></label>
          <div class="field">
            <textarea name="meta_des"  cols="45" rows="3" ><?php echo $fetch['meta_des']; ?></textarea>
          </div>
        </div>
        <br>
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
