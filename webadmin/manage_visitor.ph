<?php
if($_POST['go'])
{
	$all_id=$_POST['chkall'];
	$action=$_POST['action'];
	if($action=='publish')
    {
		foreach($all_id as $v)
		{
	     $sql="UPDATE visitor SET status='1' WHERE id='$v' ";
	     $res=mysql_query($sql);
		}
		if($res)
		{
			$true_msg[]=" Selected Visitor Avtivated";
		}
    }
	if($action=='unpublish')
    {
		foreach($all_id as $v)
		{
	     $sql="UPDATE visitor SET status='0' WHERE id='$v' ";
	     $res=mysql_query($sql);
		}
		if($res)
		{
			$true_msg[]= "Selected Visitor Suspended";
		}
    }
	if($action=='delete')
    {
		foreach($all_id as $v)
		{
	     $sql="DELETE FROM visitor WHERE id='$v' ";
	     $res=mysql_query($sql);
		}
		if($res)
		{
			$true_msg[]= "Selected Visitor Deleted";
		}
    }
}
?>
<!--        Script by hscripts.com          -->
<!--        copyright of HIOX INDIA         -->
<!-- Free javascripts @ http://www.hscripts.com -->
<script type="text/javascript">
checked=false;
function checkedAll (frm1) {
	var aa= document.getElementById('frm1');
	 if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = checked;
	}
      }
</script>
<!-- Script by hscripts.com -->
<div class="widget widget-table">
					<input type="hidden" id="dbTable" value="visitor" />
					<div class="widget-header">
						<span class="icon-list"></span>
						<h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
					</div> <!-- .widget-header -->
					
					<div class="widget-content">
<?php
if((!is_array($r)) && ($r  != ""))
{
?>
<div class="alert alert-success">
<a class="close" data-dismiss="alert">×</a>
<p><?php
echo $r;

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
        <form id="frm1" method="post">                  
            <table class="table table-bordered table-striped data-table">
        <thead>
            <tr>
             <td class="tc"><input type="checkbox" value="" class="checkbox"  name='checkall' onclick='checkedAll(frm1);' /></td>
                <th>Name</th>
                <th>Email</th>
                <th>Added Date</th>
                <th>Status</th>
                <th>Reply</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php
        $sql=mysql_query("SELECT * FROM visitor  ");
        while($fetch=mysql_fetch_array($sql))
        {
        ?>
        <tr class="gradeA">
         <td class="tc"><input type="checkbox" class="checkbox"  name='chkall[]' value="<?php echo $fetch['id'];?>" /></td>
                <td><?php echo ucwords($fetch['name']); ?></td>
                <td><?php echo $fetch['email']; ?>
                  </td>
                </td>
                <td><?php echo date('d-M-Y',$fetch['creation_date']); ?>
                <td class="center"><?php if($fetch['status']=='1')
                {?>
                 <!--<a href="index.php?mode=manage_visitor&p_id=<?php  echo $fetch['id']; ?>" title="Publish"  >-->
<input type="button" class="btn publish btn-success" id="<?php  echo $fetch['id'];?>" value="Publish" />
<!--</a>-->   
<?php
}
else
{
?>
<!--<a href="index.php?mode=manage_visitor&up_id=<?php  echo $fetch['id'];?>" title="Unpublish" >-->
 <input type="button" class="btn publish btn-error" id="<?php  echo $fetch['id'];?>" value="Unpublish" />
<!--</a>   -->
<?php
				   }
				    ?></td>
                    <td>
                         <a href="index.php?mode=reply&edit_id=<?php echo $fetch['id']; ?>" title="Edit "><img class="btn btn-warning" src="images/mail_reply.png" /></a> </td>
                         <td>
                <input  type="button" id="<?php  echo $fetch['id'];?>" class="btn delete btn-error" value="Delete" />
                    </td>
							</tr>
                            <?php
						}?>
					<tr>
                    <td> </td>
                    <td> </td>
                     <td></td> 
                     <td><select name="action">
                    <option value="">---Select Action---</option>
                    <option value="publish">Publish</option>
                    <option value="unpublish">Unpublish</option>
                    <option value="delete">Delete</option>
                    </select>
<input type="submit" name="go" value="GO"></td>
                      <td></td>
                       <td></td>
                        <td></td>
                    </tr>
                               </tbody>
                        
					</table>
						</form> <!-- .widget-content -->
					
				</div>
                </div></div>