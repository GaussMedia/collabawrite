<?php
$edit_id=$_GET['edit_id'];
$sql=mysql_query("SELECT * FROM visitor WHERE id='$edit_id'")or die(mysql_error());
$fetch=mysql_fetch_array($sql);
if($_POST['sub'])
{
	$name=$_POST['name'];
	$email=addslashes($_POST['email']);
	/*if(empty($message))
	{
		$error='1';
		$err_msg[]="Please Fill tag";
	}
	
	if($error !='1')
	{
	$d=date('d-M-Y');
	$img_name=time()."-".$name;
     $sql="UPDATE `blogs` SET `blog_title`='$blog_t',`blog_des`='$blog_des',`blog_image`='$img_name',`blog_tag`='$blog_tag'  WHERE id='$edit_id' ";
	 $res=mysql_query($sql)or die(mysql_error());
	 $true_msg[]="blog Updated Successfully";
	}*/
}
?>
<div class="widget widget-table">
					
					<div class="widget-header">
						<span class="icon-list"></span>
						<h3 class="icon aperture"><?php echo  ucwords($fetch['blog_t']); ?></h3>
					</div> <!-- .widget-header -->
					
					<div class="widget-content">
          <div id="login_panel">
    	<?php
						if($res)
						{
							?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert">×</a>
						<p><?php foreach($true_msg as $v)
						{
							echo $v.'<br>';
                            echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_visitor&edit_id='.$edit_id.' " >';
						}
						 ?></p>
					</div> <!-- .notify -->
                    <?php
						}
						?>
                        
                        <?php
						if($error == '1')
						{
							?>
<div class="alert alert-error">
  <a class="close" data-dismiss="alert">×</a>
						<p><?php
						foreach($err_msg as $v)
						{
							echo $v.'<br>';
						}
						 ?></p>
					</div> <!-- .notify -->
                    <?php
						}
						?>
							<form method="post"  class="" action="" name="frm1">
								<div class="field-group">
									<label for="required">Visitor Name:</label>
									<div class="field">
										<input type="text" name="name" size="20"  value="<?php echo $fetch['name'];?>" />	
									</div>
								</div> <!-- .field-group -->
								<div class="field-group">
									<label for="required">Visitor Email:</label>
									<div class="field">
										<input type="text" name="email" size="20"  value="<?php echo $fetch['email'];?>" />	
									</div>
								</div>
								<div class="field-group">
									<label for="email">Message:</label>
									<div class="field">
										<textarea id="email" name="msg" cols="45" rows="10"  ><?php e//cho $fetch['email'];?></textarea>
                                        <script type="text/javascript">
                                        //<![CDATA[
                                        
                                        CKEDITOR.replace( 'editor1',
                                        {
                                        
                                        });
                                        
                                        //]]>
                                        </script>	
									</div>
								</div> <!-- .field-group -->
								
								 <!-- .field-group -->
								
                                 
							
								<div class="actions">						
									<input type="submit" class="btn btn-red" name="sub" value="Reply ">
								</div> <!-- .actions -->
								
							</form>
							
							
						</div> <!-- .widget-content -->
						
					</div> <!-- .widget -->	
	