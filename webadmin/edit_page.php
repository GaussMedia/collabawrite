<?php
/*$edit_id=$_GET['edit_id'];
$sql=mysql_query("SELECT * FROM pages WHERE id='$edit_id'")or die(mysql_error());
$fetch=mysql_fetch_array($sql);
if($_POST['sub'])
{
	$page_t=$_POST['page_t'];
	$page_des=addslashes($_POST['page_des']);
	$seo_t=$_POST['seo_t'];
	$seo_k=$_POST['seo_k'];
	$meta=$_POST['meta'];
	if(empty($page_t))
	{
		$error='1';
		$err_msg[]="Please Fill Page Title";
	}
	if(empty($page_des))
	{
		$error='1';
		$err_msg[]="Please Fill Page Description";
	}
	if(empty($seo_t))
	{
		$error='1';
		$err_msg[]="Please Fill SEO Title";
	}
	if(empty($seo_k))
	{
		$error='1';
		$err_msg[]="Please Fill SEO Keyword";
	}
	if(empty($meta))
	{
		$error='1';
		$err_msg[]="Please Fill Meta Description";
	}
	
	if($error !='1')
	{
	$d=date('d-M-Y');
	$page_slug = preg_replace("/[^a-zA-Z0-9 ]/", "", $page_t);
	$slug = str_replace(" ", "-", $page_slug);
     $sql="UPDATE `pages` SET `page_title`='$page_t',`page_des`='$page_des',`seo_t`='$seo_t',`seo_k`='$seo_k',`meta_des`='$meta',`slug`='$slug'  WHERE id='$edit_id' ";
	 $res=mysql_query($sql)or die(mysql_error());
	 $true_msg[]="Page Updated Successfully";
	}
}
*/

$edit_id=base64_decode($_GET['page_id']);
$table="page";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`id`='".$edit_id."'");

if($_POST['submit'])
{
	extract($_POST);
	$data = array('page_title' => $page_title,'page_des' => $page_des,'seo_t' => $seo_t,'seo_k' => $seo_k,'meta_des' => $meta_des);
	$r=$obj->update($table,$data,'id='.$edit_id);
}

?>

<div class="widget widget-table">
<div class="widget-header"> <span class="icon-list"></span>
  <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
  <span style="float:right;">
  <a href="index.php?mode=manage_page">
  <button type="button" class="btn btn-error">Manage Pages</button>
  </a>
  </span>
</div>
<!-- .widget-header -->

<div class="widget-content">
  <div id="login_panel">
    <?php
if($r  == "1")
{
?>
    <div class="alert alert-success"> <a class="close" data-dismiss="alert">×</a>
      <p>
        <?php
echo "Page Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_page&page_id='.base64_encode($edit_id).'" >';
?>
      </p>
    </div>
    <!-- .notify -->
    <?php
}
else{
if((is_array($r)))
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
    <form method="post"  class="" action="" name="frm1">
      <div class="field-group">
        <label for="required">Page Title:</label>
        <div class="field">
          <input type="text" name="page_title" size="20"  value="<?php echo $fetch['page_title'];?>" />
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="email">Page Description:</label>
        <div class="field">
          <textarea id="editor1" name="page_des" cols="45" rows="10"  ><?php echo $fetch['page_des'];?></textarea>
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
        <label for="date">SEO Title:</label>
        <div class="field">
          <input type="text" name="seo_t"  size="15" value="<?php echo $fetch['seo_t'];?>" />
          <label for="date"></label>
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="password1">SEO Keyword:</label>
        <div class="field">
          <input type="text" name="seo_k"  size="25" value="<?php echo $fetch['seo_k'];?>" />
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="password2">Meta Description:</label>
        <div class="field">
          <input type="text" name="meta_des"  size="25" value="<?php echo $fetch['meta_des'];?>" />
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
