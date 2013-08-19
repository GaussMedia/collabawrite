<?php
//$edit_id=base64_decode($_GET['company_id']);
$table="companies";
//$pay_table="payments";
//$obj=new KARAMJEET();
//$fetch=$obj->fetch_one($table,"`company_id`='".$edit_id."'");
//$pay_fetch=$obj->fetch_one($pay_table,"`payment_id`='".$edit_id."'");
//extract($_POST);
//$data = array('page_title' => $page_title,'page_des' => $page_des,'seo_t' => $seo_t,'seo_k' => $seo_k,'meta_des' => $meta_des);
//$r=$obj->update($table,$data,'id='.$edit_id);

$obj=new KARAMJEET();
$fetch_company=$obj->SelectFromOne($table,"`email`='$_SESSION[username]'");
//echo '<pre>';
//print_r($fetch_company);
//die;
if($_POST['submit'])
{
        extract($_POST);
	$d=time();
	$page_slug = preg_replace("/[^a-zA-Z0-9 ]/", "", $page_t);
	$slug = strtolower(str_replace(" ", "_", $page_slug));
	
        //$page_des=addslashes($page_des);
	$table=array('employees','(`company_id`,',
                                  '`company_name`,',  
                                  '`first_name`,',
                                  '`last_name`,',
                                  '`email_address`,', 
                                  '`cell_phone`,',
                                  '`classification`,',
                                  '`pay_roll_id`,',
                                  '`union_code`,',
                                  '`creation_date`)');
	$where=array("'$fetch_company[company_id]',","'$fetch_company[company_name]',","'$first_name',","'$last_name',","'$email',","'$cell_phone',","'$classfication',","'$pay_rol_id',","'$union',","'$d'");
			
	getConnection();
	$obj=new KARAMJEET();
	$r=$obj->check_null($where,$table);
	if((!isset($r)) && ($r == ''))
	{
		$where[0]="('".$fetch_company[company_id]."',";
		$where[9]="'".$d."')";
        $r=$obj->insert($table,$where);
//        prnit_r($r);
//        die;
	}
}

?>

<div class="widget widget-table">
<div class="widget-header"> <span class="icon-list"></span>
  <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$fetch['company_name'])); ?></h3>
  
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
echo "Employee Added Successfully";
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
          <input type="text" name="first_name"  size="15" value="<?php echo $first_name;?>" />
          <label for="date"></label>
        </div>
      </div>
      <!-- .field-group -->
      
      <div class="field-group">
        <label for="password">Last Name:</label>
        <div class="field">
          <input type="text" name="last_name"  size="25" value="<?php echo $last_name;?>" />
        </div>
      </div>
      
       <!-- .field-group -->
      
      <div class="field-group">
        <label for="password">Email:</label>
        <div class="field">
          <input type="text" name="email"  size="25" value="<?php echo $email;?>" />
        </div>
      </div>
      <!-- .field-group -->
      <div class="field-group">
        <label for="password">Phone:</label>
        <div class="field">
          <input type="text" name="cell_phone"  size="25" value="<?php echo $cell_phone;?>" />
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
