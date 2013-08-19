<?php
/*$edit_id=$_GET['edit_id'];
$sql=mysql_query("SELECT * FROM faq WHERE id='$edit_id'")or die(mysql_error());
$fetch=mysql_fetch_array($sql);
if($_POST['sub'])
{
	$ques=addslashes($_POST['ques']);
	$ans=addslashes($_POST['ans']);
	if(empty($ques))
	{
		$error='1';
		$err_msg[]="Please Type Any Question";
	}
	if($error !='1')
	{
     $sql="UPDATE `faq` SET `ques`='$ques',`ans`='$ans' WHERE id='$edit_id'";
	 $res=mysql_query($sql);
	 if($res)
	 {
	 $true_msg[]="Question Updated Successfully";
	 }
	}
}*/

$edit_id=base64_decode($_GET['faq_id']);
$table="faq";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`id`='".$edit_id."'");

if($_POST['submit'])
{
	extract($_POST);
	$data = array('ques' => $ques,'ans' => $ans);
	$r=$obj->update($table,$data,'id='.$edit_id);
}

?>

<div class="widget widget-table">
  <div class="widget-header"> <span class="icon-list"></span>
  <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
  <span style="float:right;">
  <a href="index.php?mode=manage_question">
  <button type="button" class="btn btn-error">Manage Faq</button>
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
echo "Question Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_question&faq_id='.base64_encode($edit_id).'" >';
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
          <label for="required">Type Question Here:</label>
          <div class="field">
            <input type="text" name="ques" size="60"  value="<?php echo $fetch['ques']; ?>" />
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="email">Type Answer Here:</label>
          <div class="field">
            <textarea id="editor1" name="ans" cols="45" rows="10"  ><?php echo $fetch['ans']; ?></textarea>
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
