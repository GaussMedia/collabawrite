<?php
getConnection();
$obj=new KARAMJEET();
//send Table name
$table="drafts";
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
<input type="hidden" id="dbtable" value="drafts" />
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
            <th>Post Tilte</th>
            <th>Post Subtilte</th>
<!--            <th>Post data</th>-->
            <th>image</th>
            <th>Posted In</th>
            <th>Status</th>
            <th>Editor' Pick</th>
           <th>Added Date</th>
              <!--         
                        <th>Reply</th>-->
            <th>Actions</th>
          </tr>
        </thead>
        <?php
                
               $sql="SELECT * FROM drafts ORDER BY id DESC";
                $res=mysql_query($sql)or die(mysql_error());
                while($fetch=  mysql_fetch_array($res))
                {
                ?>
               
        <tr class="gradeA">
          <td class="tc"><input type="checkbox" class="checkbox"  name='chkall[]' value="<?php echo $fetch['id'];?>" />
            <?php
                  //echo $fetch['id'];?></td>
          <td><?php
           if($fetch['title'] == '')
                   {
                     echo 'Untitled';
                   }
                   else{
                       echo ucwords(substr($fetch['title'],'0','15'));
                   }
          
          
          ?></td>
          <td><?php if($fetch['sub_title'] != '')
                   {
                     echo ucwords(substr($fetch['sub_title'],'0','15'));
                   }
                   else{
                       echo 'no subtitle';
                   } ?></td>
<!--          <td>
              <?php
              
                   //if($fetch['post'] != '')
                   //{
                    //echo substr($fetch['post'],'0','30')."...";
                    //echo 'no text '; ?>

                    <a href="#">read more</a>
                    <?php
                   //}
                   //else{
                      // echo 'no text in post';
                  // }
                   ?>
          </td>-->
          <td>
              <img src="upload/posts/original/<?php echo $fetch['image'];?>" width="120px" height="100px">
          </td>
<!--           <td><?php //$author_id=$fetch[$i]['author'];
           //$fetch_auther=$obj->fetch_one('twitter_users',"`id`='".$author_id."'");
          // echo $fetch_auther['fullname'];
           ?>
           </td>-->
           <td><?php $col_id=$fetch['collection_id'];
           $fetch_col=$obj->fetch_one('collections',"`id`='".$col_id."'");
           echo $fetch_col['collection_name'];
           ?></td>
          <td class="center">
              <?php
             $status=$fetch['status'];
             if($fetch['status']=='1')
                {
                    $id=$fetch['id'];
                    ?>

<input type="button"  class="btn publish btn-success" id="<?php  echo $fetch['id'];?>" value="Publish" />
<?php
}
else
{
?>
 <input  type="button" class="btn publish btn-error" id="<?php echo $fetch['id'];?>" value="Unpublish" />
<?php
				   }
				    ?></td>
          <td class="center">
              <?php
             if($fetch['editor_pick']=='1')
                {
                    $id=$fetch['id'];
                    ?>

<input type="button"  class="btn picked btn-success" id="<?php  echo $fetch['id'];?>" value="Picked" />
<?php
}
else
{
?>
 <input  type="button" class="btn picked btn-error" id="<?php echo $fetch['id'];?>" value="Unpicked" />
<?php
				   }
				    ?></td>
        
          <td><?php echo date('d-M-Y',$fetch['creation_date']); ?></td>
         
          <td>
          <span><input  type="button" id="<?php  echo $fetch['id'];?>" class="btn delete btn-error" value="Delete" />
          </span>
          <!-- Edit Button-->
          <span>
          <a href="index.php?mode=edit_post&post_id=<?php echo base64_encode($fetch['id']); ?>">
          <input  type="button" id="<?php  echo $fetch['id'];?>" class="btn edit btn-warning" value="Edit" /></a>
          </span>
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
