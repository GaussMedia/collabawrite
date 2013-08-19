<?php
if($_POST['submit'])
{
	extract($_POST);
	$table=array('top_navs','(`nav_title`,','`page_title`,','`creation_date`)');
	$where=array("'$nav_title',","'$page_title',","'$d'");
	getConnection();
	$obj=new KARAMJEET();
	$r=$obj->check_null($where,$table);
	if((!isset($r)) && ($r == ''))
		{
			    $d=time();
				$where[0]="('".$nav_title."',";
				$where[1]="'".$d."')";
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
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_top_navs" >';
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
          <label for="required">Nav Title:</label>
          <div class="field">
            <input type="text" name="nav_title" size="20"  value="<?php echo $nav_title; ?>" />
          </div>
        </div>
        <!-- .field-group -->
		<div class="field-group">
        <label for="required">Page Title:</label>
        <div class="field">
          <input type="text" name="nav_title" size="20"  value="<?php echo $page_title;?>" />
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
</div>
