<?php
$edit_id=base64_decode($_GET['Employee_id']);
$table="employees";
//$pay_table="payments";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`Employee_id`='".$edit_id."'");
//$pay_fetch=$obj->fetch_one($pay_table,"`payment_id`='".$edit_id."'");
//extract($_POST);
//$data = array('page_title' => $page_title,'page_des' => $page_des,'seo_t' => $seo_t,'seo_k' => $seo_k,'meta_des' => $meta_des);
//$r=$obj->update($table,$data,'id='.$edit_id);

$obj=new KARAMJEET();
////$fetch_company=$obj->SelectFromOne($table,"`email`='$_SESSION[username]'");
//echo '<pre>';
//print_r($fetch_company);
//die;
if($_POST['submit'])
{
        extract($_POST);
	$d=time();
	$data = array('first_name' => $first_name,'last_name' => $last_name,'cell_phone'=>$cell_phone);
        $r=$obj->update($table,$data,'Employee_id='.$edit_id);
        //$page_des=addslashes($page_des);
	
	
}

?>

<div class="widget widget-table">
<div class="widget-header"> <span class="icon-list"></span>
  <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$fetch['company_name'])); ?></h3>
  <span style="float: right;">
    <a href="index.php?mode=manage_employees">
    <button type="button" class="btn btn-error">Manage Employees</button>
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
echo "Employee Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_employee&Employee_id='.base64_encode($edit_id).'" >';
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
<!--      <div class="field-group">
        <label for="required">Page Title:</label>
        <div class="field">
          <input type="text" name="page_title" size="20"  value="<?php //echo $fetch['page_title'];?>" />
        </div>
      </div>-->
      <!-- .field-group -->
      
<!--      <div class="field-group">
        <label for="email">Page Description:</label>
        <div class="field">
          <textarea id="editor1" name="page_des" cols="45" rows="10"  ><?php //echo $fetch['page_des'];?></textarea>
          <script type="text/javascript">
                                        //<![CDATA[
                                        
                                        CKEDITOR.replace( 'editor1',
                                        {
                                        
                                        });
                                        
                                        //]]>
                                        </script> 
        </div>
      </div>-->
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="date">First Name:</label>
        <div class="field">
          <input type="text" name="first_name"  size="15" value="<?php echo $fetch['first_name'];?>" />
          <label for="date"></label>
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="password">Last Name:</label>
        <div class="field">
          <input type="text" name="last_name"  size="25" value="<?php echo $fetch['last_name'];?>" />
        </div>
      </div>
      
       <!-- .field-group -->
      
<!--      <div class="field-group">
        <label for="password">Email:</label>
        <div class="field">
          <input type="text" name="email"  size="25" value="<?php echo $fetch['email'];?>" />
        </div>
      </div>-->
      <!-- .field-group -->
      <div class="field-group">
        <label for="password">Phone:</label>
        <div class="field">
          <input type="text" name="cell_phone"  size="25" value="<?php echo $fetch['cell_phone'];?>" />
        </div>
      </div>
      
<!--      <div class="field-group">
        <label for="password2">Meta Description:</label>
        <div class="field">
          <input type="text" name="meta_des"  size="25" value="<?php //echo $fetch['meta_des'];?>" />
        </div>
      </div>-->
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
