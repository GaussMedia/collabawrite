<?php
$edit_id=base64_decode($_GET['user_id']);
$table="twitter_users";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`id`='".$edit_id."'");

if($_POST['submit'])
{
	extract($_POST);
	$data = array('fullname' => $fnm,'username' => $lnm,'email' => $email);
	$r=$obj->update($table,$data,'id='.$edit_id);
}
?>

<div class="widget widget-table">
<div class="widget-header"> <span class="icon-list"></span>
  <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
  <span style="float:right;">
  <a href="index.php?mode=manage_users">
  <button type="button" class="btn btn-error">Manage Users</button>
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
echo "User Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_user&user_id='.base64_encode($edit_id).'" >';
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
        <label for="required">Full Name:</label>
        <div class="field">
          <input type="text" name="fnm" size="20"  value="<?php echo $fetch['fullname'];?>" />
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="date">User Name:</label>
        <div class="field">
          <input type="text" name="lnm"  size="15" value="<?php echo $fetch['username'];?>" />
          <label for="date"></label>
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="password1">Email:</label>
        <div class="field">
          <input type="text" name="email"  size="25" value="<?php echo $fetch['email'];?>" />
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
