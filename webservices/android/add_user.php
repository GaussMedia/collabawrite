<?php
if($_POST['submit'])
{
	extract($_POST);
	$d=time();
	$table=array('test','(`fnm`,','`lnm`,','`email`,','`pass`,','`creation_date`)');
	$where=array("'$fnm',","'$lnm',","'$email',","'$password',","'$d'");
	getConnection();
	$obj=new KARAMJEET();
	$r=$obj->check_null($where,$table);
	if((!isset($r)) && ($r == ''))
	{
		$d=time();
		$where[0]="('".$fnm."',";
		$where[4]="'".$d."')";
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
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_users" >';
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
      <label for="required">First Name:</label>
      <div class="field">
        <input type="text" name="fnm" size="20"  value="<?php echo $fnm; ?>" />
      </div>
    </div>
    <!-- .field-group -->
    <div class="field-group">
      <label for="required">Last Name:</label>
      <div class="field">
        <input type="text" name="lnm" size="20"  value="<?php echo $lnm; ?>" />
      </div>
    </div>
    
    <div class="field-group">
      <label for="date">Email:</label>
      <div class="field">
        <input type="text" name="email"  size="30" value="<?php echo $email; ?>" />
        <label for="date"></label>
      </div>
    </div>
    <!-- .field-group -->
    
    <div class="field-group">
      <label for="password1">Password:</label>
      <div class="field">
        <input type="password" name="password"  size="15" value="" />
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
