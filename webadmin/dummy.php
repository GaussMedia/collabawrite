<?php
$p_id=$_GET['p_id'];
$up_id=$_GET['up_id'];
$del_id=$_GET['del_id'];
if($p_id)
{
	$sql="UPDATE  pages SET status='0' WHERE id='$p_id' ";
	$res=mysql_query($sql)or die(mysql_error());
	if($res)
	{
		$true_msg[]="Page Deleted Successfully";
	}
}
if($up_id)
{
	$sql="UPDATE  pages SET status='1' WHERE id='$up_id' ";
	$res=mysql_query($sql)or die(mysql_error());
	if($res)
	{
		$true_msg[]="Page Deleted Successfully";
	}
}
if($del_id)
{
	$sql="DELETE FROM  pages  WHERE id='$p_id' ";
	$res=mysql_query($sql)or die(mysql_error());
	if($res)
	{
		$true_msg[]="Page Deleted Successfully";
	}
}
if($_POST['go'])
{
	$all_id=$_POST['chkall'];
	$action=$_POST['action'];
	if($action=='publish')
    {
		foreach($all_id as $v)
		{
	     $sql="UPDATE pages SET status='1' WHERE id='$v' ";
	     $res=mysql_query($sql);
		}
		if($res)
		{
			$true_msg[]=" Selected Page Avtivated";
		}
    }
	if($action=='unpublish')
    {
		foreach($all_id as $v)
		{
	     $sql="UPDATE pages SET status='0' WHERE id='$v' ";
	     $res=mysql_query($sql);
		}
		if($res)
		{
			$true_msg[]= "Selected Pages Suspended";
		}
    }
	if($action=='delete')
    {
		foreach($all_id as $v)
		{
	     $sql="DELETE FROM pages WHERE id='$v' ";
	     $res=mysql_query($sql);
		}
		if($res)
		{
			$true_msg[]= "Selected Pages Deleted";
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
<div class="grid-16"  style="width:auto;">
					<div class="widget" >

<div class="widget widget-table">
					
						<div class="widget-header">
							<span class="icon-list"></span>
							<h3 class="icon chart"><?php echo ucwords(str_replace('_',' ',$mode)); ?></h3>		
                            
						</div>
					 
						<div class="widget-content">
							         <?php
						if($res)
						{
							?>
                            <div class="notify notify-success">
						<a href="javascript:;" class="close">&times;</a>
						<h3>Success Notifty</h3>
						
						<p><?php foreach($true_msg as $v)
						{
							echo "<br>".$v;
							echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_visitor"';
						}
						 ?></p>
					</div> <!-- .notify -->
                    <?php
						}
						?>  
                        <form id="frm1" method="post">                  
							<table class="table table-bordered table-striped data-table">
						<thead>
							<tr>
                             <td class="tc"><input type="checkbox" value="" class="checkbox"  name='checkall' onclick='checkedAll(frm1);' /></td>
								<th>Visiter Name</th>
								<th> Email </th>
								<th>Added Date</th>
								<th>Status</th>
                                <th>Actions</th>
							</tr>
						</thead>
                        <?php
						$sql1=mysql_query("SELECT * FROM `contacts`  ORDER BY  `pages`.`id` DESC ");
						while($fetch=mysql_fetch_array($sql1))
						{
						?>
                        <tr class="gradeA">
                         <td class="tc"><input type="checkbox" class="checkbox"  name='chkall[]' value="<?php echo $fetch['id'];?>" /></td>
								<td><?php echo $fetch['unm']; ?></td>
								<td><?php echo $fetch['email']; ?></td>
								<td><?php echo $fetch['added_date']; ?></td>
								<td class="center"><?php if($fetch['status']=='1')
								{?>
								 <a href="index.php?mode=manage_visitor&p_id=<?php  echo $fetch['id']; ?>" title="Publish"  >
   <img src="img/icons/small/publish.png" >
</a>   
<?php
			}
			else
			{
?>
   <a href="index.php?mode=manage_visitor&up_id=<?php  echo $fetch['id'];?>" title="Unpublish" >
   <img src="img/icons/small/unpublish_.png" >
</a>   
<?php
				   }
				    ?></td>
                    <td>
                         <a href="index.php?mode=reply&edit_id=<?php echo $fetch['id']; ?>" title="Edit User"><img src="img/icons/small/user_edit.png" alt="edit user" border="0" /></a> 
                  <a href="index.php?mode=manage_visitor&del_id=<?php echo $fetch['id']; ?>" title="Delete User" onClick="return confirm('Are You Sure To Want Delete ? ');"><img src="img/icons/small/user_delete.png" alt="delete user" border="0" /></a>
                    </td>
							</tr>
                            <?php
						}?>
					<tr>
                    <td>
                    
                    </td>
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
                </div></div><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>