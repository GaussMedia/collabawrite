<?php
if($_POST['sub'])
{
	$file_t=$_POST['file_t'];
	$file_des=addslashes($_POST['file_des']);
	$location=$_FILES['file_name']['tmp_name'];
	$name=$_FILES['file_name']['name'];
	$path='upload/pdf/';
	if(empty($file_t))
	{
		$error='1';
		$err_msg[]="Please Fill File Title";
	}
	if(empty($file_des))
	{
		$error='1';
		$err_msg[]="Please Fill File Description";
	}
	/*if(empty($name))
	{
		$error='1';
		$err_msg[]="Please Select File ";
	}*/
	if($error !='1')
	{
	$d=date('d-M-Y');
	$file_name=time()."-".$name;
	move_uploaded_file($location,$path.$file_name);
     $sql="INSERT INTO `pdf`(`file_t`, `file_des`, `file_name`, `added_date`) VALUES ('$file_t','$file_des','$file_name','$d')";
	 $res=mysql_query($sql);
	 if($res)
	 {
	 $true_msg[]="File Added Successfully";
	 }
	}
}
?>
<div class="widget widget-table">
					
					<div class="widget-header">
						<span class="icon-list"></span>
						<h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
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
                            echo '<meta http-equiv="refresh" content="2;url=index.php?mode=download" >';
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
		
							<form method="post"  class="" action="" name="frm1" enctype="multipart/form-data">
								<div class="field-group">
									<label for="required">File Title:</label>
									<div class="field">
										<input type="text" name="file_t" size="20"  value="" />	
									</div>
								</div> <!-- .field-group -->
								
								<div class="field-group">
									<label for="email">File Description:</label>
									<div class="field">
										<textarea id="editor1" name="file_des" cols="45" rows="10"  ></textarea>	
                                        <script type="text/javascript">
                                        //<![CDATA[
                                        
                                        CKEDITOR.replace( 'editor1',
                                        {
                                        
                                        });
                                        
                                        //]]>
                                        </script>
									</div>
								</div> <!-- .field-group -->
								
								<div class="field-group">
									<label for="date">File Input:</label>
									<div class="field">
										<input type="file" name="file_name"  size="15" value="" />
										<label for="date"></label>	
									</div>
								</div> <!-- .field-group -->
								
                               
							
								<div class="actions">						
									<input type="submit" class="btn btn-red" name="sub" value="Submit Query">
								</div> <!-- .actions -->
								
							</form>
							
							
						</div> <!-- .widget-content -->
						
					</div> <!-- .widget -->	
	</div>