<?php
if($_POST['sub'])
{
 if($_SESSION['username'])
{
  $table='admin';
}
 if($_SESSION['company'])
{
  $table='companies';
}

	$o_pwd=$_POST['o_pwd'];
	$n_pwd=$_POST['n_pwd'];
	$cpwd=$_POST['cpwd'];
	if(empty($o_pwd))
	{
		$error='1';
		$err_msg[]="PLease Fill Old Password";
	}
	if(empty($n_pwd))
	{
		$error='1';
		$err_msg[]="PLease Fill New Password";
	}
	if(empty($cpwd))
	{
		$error='1';
		$err_msg[]="PLease Confirm New Password";
	}
        if($error !='1')
        {
            $o_pwd=md5($o_pwd);
            $sql="SELECT password FROM $table WHERE password='$o_pwd'";
            $res=mysql_query($sql);
            if(mysql_num_rows($res)>0)
            {
                                 if($n_pwd == $cpwd)
                                 {
                                         $pwd=md5($cpwd);
                                         $sql1="UPDATE $table  SET password='$pwd'  WHERE password = '$o_pwd' ";
                                         $result=mysql_query($sql1)or die(mysql_error());
                                         $true_msg[]="Password Successfully Changed";
                                  }
                                  else
                                 {
                                         $error='1';
                                         $err_msg[]="Confirm Password is not Equal with New Password";
                                 }
            }
            else
            {
                 $error='1';
                 $err_msg[]="Old password  is wrong";
             }
}// if error chk
}//main if


?>
<div class="widget widget-table">
					
					<div class="widget-header">
						<span class="icon-list"></span>
						<h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
					</div> <!-- .widget-header -->
					
					<div class="widget-content">
              	<?php
						if($result)
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

		
<form method="post"  class="" action="" name="frm1">
                    <div class="field-group">
                    <label for="required">Old Password:</label>
                    <div class="field">
                    <input type="password" name="o_pwd" size="20"  value="" />	
                    </div>
                    </div> <!-- .field-group --> 
                    
                    
                    <div class="field-group">
                    <label for="required">New Password:</label>
                    <div class="field">
                    <input type="password" name="n_pwd" size="20"  value="" />	
                    </div>
                    </div> <!-- .field-group -->
                    
                    
                    <div class="field-group">
                    <label for="required">Confirm New Password:</label>
                    <div class="field">
                    <input type="password" name="cpwd" size="20"  value="" />	
                    </div>
                    </div> <!-- .field-group -->
              
              <div class="field-group">
                <label for="required"></label>
                <div class="controls">
                     <input type="submit" name="sub" value="Submit Query" class="btn btn-red" >
                </div>
              </div>
             
              </fieldset>
                  </form>
   				
						</div> <!-- .widget-content -->
						
					</div> <!-- .widget -->	
	</div>