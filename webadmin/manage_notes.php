<?php
getConnection();
$obj=new KARAMJEET();
//send Table name
$table="collections";
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
<form id="frm1" method="post">
<input type="hidden" id="dbtable" value="notes" />
  <div class="widget-header"> <span class="icon-list"></span>
    <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
    <span>
    <select name="action" class="select_action">
                <option value="">---Select Action---</option>
                <option value="Publish">Publish</option>
                <option value="Unpublish">Unpublish</option>
                <option value="Delete">Delete</option>
              </select>
              <input id="go" type="submit" name="go" value="GO">
    </span>
<!--    <span>
    <a href="index.php?mode=add_blog">
    <button type="button" class="btn btn-error">Add Blog</button>
    </a>
    </span>-->
  </div>
  <!-- .widget-header -->
  
  <div class="widget-content">
    <?php
if((!is_array($r)) && ($r  != ""))
{
?>
    <div class="alert alert-success"> <a class="close" data-dismiss="alert">×</a>
      <p>
        <?php
//echo $r;
//echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_users" >';
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
    
      <table class="table table-bordered table-striped data-table" id="tbl1">
        <thead>
          <tr>
            <td class="tc"><input type="checkbox" value="" class="checkbox1"  name='checkall' onclick='checkedAll(frm1);' /></td>
            <th>Note</th>
            <th>Note text</th>
            <th>Comment By</th>
            <th>On Post</th>
            <th>Status</th>
           <th>Added Date</th>
              <!--         
                        <th>Reply</th>-->
            <th>Actions</th>
          </tr>
        </thead>
        <?php
                
                $fetch=$obj->fetch_all("notes");
                $counter=count($fetch);
                    for($i=0;$i<$counter;$i++)
                    {
                ?>
        <tr class="gradeA">
          <td class="tc"><input type="checkbox" class="checkbox"  name='chkall[]' value="<?php echo $fetch[$i]['id'];?>" />
            <?php
                  //echo $fetch['id'];?></td>
          <td><?php echo ucwords($fetch[$i]['note']); ?></td>
          <td>
		  <?php echo substr($fetch[$i]['text'],'0','300')."..."; ?>
          <a href="#">read more</a>
          </td>
           <td><?php $author_id=$fetch[$i]['note_author'];
           $fetch_auther=$obj->fetch_one('twitter_users',"`id`='".$author_id."'");
           echo $fetch_auther['fullname'];
           ?></td>
           <td>
               <?php
               $fetch_post=$obj->fetch_one('posts',"`id`='".$fetch[$i]['note_on_post']."'");
               echo $fetch_post['title'];?>
           </td>
          <td class="center"><?php
		  $status=$fetch[$i]['status'];
		   if($fetch[$i]['status']=='1')
                {
					$id=$fetch[$i]['id'];
					?>
               
<input type="button"  class="btn publish btn-success" id="<?php  echo $fetch[$i]['id'];?>" value="Publish" />
<?php
}
else
{
?>
 <input  type="button" class="btn publish btn-error" id="<?php echo $fetch[$i]['id'];?>" value="Unpublish" />
<?php
				   }
				    ?></td>
                    <td><?php echo date('d-M-Y',$fetch[$i]['creation_date']); ?></td>
              <td>
          <input  type="button" id="<?php  echo $fetch[$i]['id'];?>" class="btn delete btn-error" value="Delete" />
         
          <!-- Edit Button-->
          
          <a href="#">
          <input  type="button" id="<?php  echo $fetch[$i]['id'];?>" class="btn edit btn-warning" value="Edit" /></a>
          
          </td>
        </tr>
        <?php
                }?>
          </tbody>
        
      </table>
    </form>
    <!-- .widget-content --> 
    
  </div>
</div>
</div>
