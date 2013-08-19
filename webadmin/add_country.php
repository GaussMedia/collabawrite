<?php
if($_POST['submit'])
{
extract($_POST);
$d=time();
$table=array('logo','(`country`,','`countryCode`,','`creation_date`)');
$where=array("'$cnt_name',","'$cnt_code',","'$d'");
getConnection();
$obj=new KARAMJEET();
$r=$obj->check_null($where,$table);
if((!isset($r)) && ($r == ''))
        {
            $where[0]="('".$logo_title."',";

            $where[2]="'".$d."')";
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
    <a class="close" data-dismiss="alert">&Chi;</a>
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
          <label for="required">Country Name:</label>
          <div class="field">
            <input type="text" name="cnt_name" size="20"  value="<?php echo $logo_title; ?>" />
          </div>
        </div>
        <!-- .field-group -->
       
        
        <div class="field-group">
          <label for="date">Country Code:</label>
          <div class="field">
            <input type="text" name="cnt_code"  size="15" value="" />
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
