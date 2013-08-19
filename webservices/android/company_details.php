<?php
$edit_id=base64_decode($_GET['company_id']);
$table="payments";
$company_table="companies";
$obj=new KARAMJEET();
$fetch=$obj->fetch_one($table,"`company_id`='".$edit_id."'");
$fetch_company=$obj->fetch_one($company_table,"`company_id`='".$edit_id."'");
?>

<!--        Script by hscripts.com          -->
<!--        copyright of HIOX INDIA         -->
<!-- Free javascripts @ http://www.hscripts.com -->
<script type="text/javascript">
 

 
</script>

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

<style>
.closex{right:-10px; top:-10px; background:#999; border:1px solid #333; position:absolute; font:bold 26px "Arial Black"; color:#fff; padding:0 10px 2px; }
#overlay_form{
position: absolute;
border: 5px solid gray;
padding: 10px;
background: white;
min-width: 470px;
min-height: 390px;

}
#pop{
display: block;
text-align: center;
text-decoration: none;
margin: 0 auto;
}
</style>
<!-- Script by hscripts.com -->


<div class="widget widget-table">
<form id="frm1" method="post">
<input type="hidden" id="dbtable" value="companies" />
<input type="hidden" id="paytable" value="payments" />
  <div class="widget-header"> <span class="icon-list"></span>
    <h3 class="icon aperture"><?php echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>
    <span>
    <select name="action">
                <option value="">---Select Action---</option>
                <option value="Publish">Publish</option>
                <option value="Unpublish">Unpublish</option>
                <option value="Delete">Delete</option>
              </select>
              <input id="go" type="submit" name="go" value="GO">
    </span>
    
  </div>
  <!-- .widget-header -->
  
  <div class="widget-content">
    <?php
if((!is_array($r)) && ($r  != ""))
{
?>
    <div class="alert alert-success"> <a class="close" data-dismiss="alert">�</a>
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
    <div class="alert alert-error"> <a class="close" data-dismiss="alert">�</a>
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
    
      <table class="table table-bordered table-striped data-table">
        <thead>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="tc"><input type="checkbox" value="" class="checkbox"  name='checkall' onclick='checkedAll(frm1);' /></td>
            <th>First Name</th>
            <th>Last Name</th>
             <th>User Name</th>
             <th>Company Name</th>
             <th>Address</th>
            <th>Subscription Type</th>
            <th>Last Payment</th>
              <th>Status</th>
            <!--<th>Added Date</th>
                      
                        <th>Reply</th>-->
            <th>Actions</th>
          </tr>
        </thead>
       
        <tr class="gradeA">
          <td class="tc"><input type="checkbox" class="checkbox"  name='chkall[]' value="<?php echo $fetch['company_id'];?>" />
            <?php
                  //echo $fetch['id'];?></td>
          <td><?php echo ucwords($fetch['first_name']); ?></td>
		   <td><?php echo ucwords($fetch['last_name']); ?></td>
		   <td><?php echo ucwords($fetch_company['username']); ?></td>
		   <td><?php echo ucwords($fetch_company['company_name']); ?></td>
		   <td><?php echo ucwords($fetch['street_adrs']).'<br>';
                             echo ucwords($fetch['state']).'<br>';          
                             echo ucwords($fetch['city']).'<br>';
                             echo ucwords($fetch['country']);
                             ?></td>
		   <td><?php
                   echo $fetch['payment_type']; ?></td>
                   <td><?php
                   echo date('d M,Y ',$fetch['creation_date']).'On <br> ';
                   echo date('( h : m :s  a ) ',$fetch['creation_date']); 
                       ?></td>
                   <td class="center"><?php
		  $status=$fetch['status'];
		   if($fetch['status']=='1')
                {
		$id=$fetch['payment_id'];
					?>
               
<input type="button"  class="btn publish btn-success" id="<?php  echo $fetch['payment_id'];?>" value="Publish" />
<?php
}
else
{
?>
 <input  type="button" class="btn publish btn-error" id="<?php echo $fetch['payment_id'];?>" value="Unpublish" />
<?php
				   }
				    ?></td>
          <td>
          <span><input  type="button" id="<?php  echo $fetch['payment_id'];?>" class="btn delete btn-error" value="Delete" />
          </span>
<!--              <span>
              <a href="index.php?mode=reply_pwd&company_id=<?php echo base64_encode($fetch[$i]['payment_id']); ?>">
          <img src="images/mail_reply.png"></a>
          </span>-->
          <span>
          <a href="index.php?mode=edit_company_details&company_id=<?php echo base64_encode($fetch['company_id']); ?>">
          <input  type="button" name="edit" id="<?php  echo $fetch['payment_id'];?>" class="btn edit btn-warning" value="Edit" /></a>
          </span> <!---->
          
          </td>
        </tr>
     
          </tbody>
        
      </table>
    </form>
    <!-- .widget-content --> 
    
  </div>
</div>
</div>
<div id="overlay_form" style="display:none"><a href="#" class="closex" >X</a>

<!----------put your content here------------>
<h2> Company Payment Details </h2>
<div class="widget widget-table">
  <div class="widget-header"> <span class="icon-list"></span>
      
<!--    <h3 class="icon aperture"><?php  //echo  ucwords(str_replace("_"," ",$_REQUEST['mode'])); ?></h3>-->
  </div>
  <!-- .widget-header -->
  
  <div class="widget-content">
    <div id="login_panel">
<?php
if((!is_array($r)) && ($r  != ""))
{
?>
<div class="alert alert-success">
<a class="close" data-dismiss="alert">×</a>
<p><?php
echo $r;
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=manage_companies" >';
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

  <form method="post"  class="" action="">
       <div class="field-group">
          <label for="required">Payment Type:</label>
          <div class="field">
            <input type="text" id="payment_type" name="page_title" size="20"  value="" />
          </div>
        </div>
        <!-- .field-group -->
        <div class="field-group">
          <label for="required">First Name:</label>
          <div class="field">
            <input type="text" id="first_name" name="page_title" size="20"  value="" />
          </div>
        </div>
  
        <!-- .field-group -->
        
        <div class="field-group">
          <label for="date">Last Name:</label>
          <div class="field">
            <input type="text" id="last_name" name="seo_t"  size="30" value="" />
            <label for="date"></label>
          </div>
        </div>
        
        <div class="field-group">
          <label for="date">Last Payment:</label>
          <div class="field">
            <input type="text" id="date" name="seo_t"  size="30" value="" />
            <label for="date"></label>
          </div>
        </div>
        <!-- .field-group -->
<!--        <div class="field-group">
          <label for="email">Say Few words:</label>
          <div class="field">
            <textarea id="editor1" name="des" cols="45" rows="10"  ><?php //echo $page_des; ?></textarea>
            <script type="text/javascript">
		//<![CDATA[
		
		CKEDITOR.replace( 'editor1',
		{
				 filebrowserBrowseUrl : 'browser.php',
				 filebrowserUploadUrl : 'upload.php'

		});
		
		//]]>
		</script> 
          </div>
        </div>-->
        <!-- .field-group -->
        
<!--        
        <div class="actions">
          <input type="submit" class="btn btn-red" name="submit" value="Submit Query">
        </div>-->
        <!-- .actions -->
        
      </form>
    </div>
    <!-- .widget-content --> 
    
  </div>
  <!-- .widget --> 
</div>
</div>
		
			