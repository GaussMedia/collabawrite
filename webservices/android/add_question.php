<?php
if($_POST['submit'])
{
	extract($_POST);
	$d=time();
	$table=array('faq','(`ques`,','`ans`,','`creation_date`)');
	$where=array("'$ques',","'$ans',","'$d'");
			//print_r($where);
			//die;
	getConnection();
	$obj=new KARAMJEET();
	$r=$obj->check_null($where,$table);
	if((!isset($r)) && ($r == ''))
	{
		$where[0]="('".$ques."',";
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
    <div id="login_panel">
<?php
if((!is_array($r)) && ($r  != ""))
{
?>
<div class="alert alert-success">
<a class="close" data-dismiss="alert">×</a>
<p><?php
echo $r;
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_question" >';
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
      <form method="post"  class="" action="" name="frm1">
        <div class="field-group">
          <label for="required">Type Question Here:</label>
          <div class="field">
            <input type="text" name="ques" size="60"  value="<?php echo $ques; ?>" />
          </div>
        </div>
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="email">Type Answer Here:</label>
          <div class="field">
            <textarea id="editor1" name="ans" cols="45" rows="10"  ><?php echo $ans; ?></textarea>
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
