<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
if($_GET['user'] != '' )
{
    $id = base64_decode($_GET[user]);
$query_collections = "SELECT * FROM `collections` WHERE status = '1' AND collection_author='".$id."'";
}
else{
    $query_collections = "SELECT * FROM `collections` WHERE status = '1' AND collection_author='$_SESSION[id]'";
}
$res_query_collections = mysql_query($query_collections)or die(mysql_error());
$id = base64_decode($_GET[user]);
$obj=new KARAMJEET();
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
$fetch_user=$obj->fetch_one('twitter_users',"`id`='".$id."'");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Reportedly - collections</title>


<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>

</head>

<body>
	
    <div class="row-fluid">

    <div class="logo_drop_down">
    
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="index.php"><img src="img/logo.png" alt=""/></a>

    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
             <?php
        if(!empty($_SESSION['id']))
        {
        ?>
      <li><a href="index"><i><img src='img/logo_hover.png'></i> Home</a></li>
      <li><a href="profile"><i class="user_icon">
                  <?php
                  if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img title="<?php echo $fetch_profile['fullname'];?>" class="" src="<?php echo $fetch_profile['image'];?>" alt=""/><!--https://api.twitter.com/1/users/profile_image?screen_name=<?php //echo $fetch_profile['username']?>&size=normal-->
            <?php
            }
            else
            {
                if($fetch_profile['oauth_provider']== 'facebook')
                {
            ?>
            <img title="<?=$fetch_profile['fullname']?>" class="" src="https://graph.facebook.com/<?=$fetch_profile['username']?>/picture?width=48&height=48">
            <?php
                }
 else {
     if($fetch_profile['image'] == ''){
     ?>
            <img class="" src="img/user.png" alt="">
            <?php
 }else{
      ?>
            <img class="" src="webadmin/upload/userprofile/original/<?php echo $fetch_profile['image'];  ?>" alt="">
            <?php
 }
 }
              }
             ?>
      </i> <?php echo $fetch_profile['fullname'];?></a></li>
      <li><a href="status"><i class="icon-white icon-signal"></i> Stats</a></li>
      <li><a href="drafts"><i class="icon-white icon-list-alt"></i> Drafts</a></li>
      <li><a href="settings"><i class="icon-white icon-wrench"></i> Settings</a></li>
      <li><?php
      echo '<a href="logout"><i class="icon-white icon-off"></i> Logout </a>'?></li> 
      <?php
      }
      else
      {
      ?>

      <li><a href="index"><i><img src='img/logo_hover.png'></i>Home</a></li>
      <li><a href="signin"><i class="icon-white icon-off"></i> Signin</a></li>
      <?php
      }
      ?>
    </ul>
    
     <p class="font_white margin20 margin_botm_zero left_margin75"><small><?php
             //$ip = $_SERVER['SERVER_ADDR'];
////$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//echo '<pre>';
//print_r($ip_data);
//die;
//echo $addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$//ip_data->geoplugin_countryName;
?></small></p>

    </div>
<!--    <div class="pepl text-center">
     <?php
if(($r == '1'))
{
?>
    <div class="alert alert-success"> <a class="close" data-dismiss="alert">×</a>
      <p>
        <?php
echo "Blog Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_blog&blog_id='.base64_encode($edit_id).'" >';
?>
      </p>
    </div>
     .notify 
    <?php
}
else{
if((is_array($r))  && ($r != ""))
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
     .notify 
    <?php
}
}
?>
        <div class="half_cover imageFormDiv" id="half_cover">
          <?php
          //if($fetch_profile['profile_cover'] == "")
          //{
          ?>
         
        <form id="imageform" action="cover_upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="save" value="Save">
            <input type="hidden" id="cancel" value="Cancel">
         <div class="file">
		<input type="file" onChange="displayPreview(this.files);" class="photoimg" id="fileUpload" name="photoimg" />
                <div id='preview'>
                </div>
		<span class="button"></span>
	   </div>
        </form>
            <?php
          //}
          //else
          //{
              ?>
            
            <form style="border: 2px dotted; left: 2%;position: absolute;top: 15px; width: 95%; min-height: 366px; display:none;" id="imageform" action="cover_upload" method="post" enctype="multipart/form-data">
            <input type="hidden" id="profileName" name="profileName" value="">
            <input type="hidden" id="profileLoc"  name="profileLoc"  value="">
            <input type="hidden" id="profileDesc" name="profileDesc" value="">
         <div class="file">
		<input type="file" onChange="displayPreview(this.files);" class="photoimg" id="fileUpload" name="photoimg" />
                <div id='preview'>
                </div>
		<span class="button"></span>
	   </div>
            <div class="clearfix"></div>
        </form>
            
            
            <img id='yyyyy' style='width:100%; height:100%;' src="ajaximage/uploads/<?=$fetch_profile['profile_cover']?>">
            <?php
         // }
          ?>
    
       </div>
        
        <div class="profile img-polaroid">
                <img src="img/profile_bg.jpg" alt=""/>
            <?php
            if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img src="<?=$fetch_profile['image']?>" width="119px" alt=""/>
            <?php
            }
            else
            {
                if($fetch_profile['oauth_provider']== 'facebook')
                {
            ?>
            <img src="https://graph.facebook.com/<?=$fetch_profile['username']?>/picture?type=normal">
            <?php
                }
              }
             ?>
                </div>
                <div class="clearfix"></div>
                
               <h4 class="margin20 userProfileName" ><?=$fetch_profile['fullname']?></h4>
               <p class="zero_margin font_zise13 userProfileLocation"><?=$fetch_profile['location']?></p>
             
<span class="userProfileDesc">
    <?php
     echo $fetch_profile['description'];
//    if($fetch_profile['description'] == '')
//    {
//        echo 'Describe your profile here';
//    }
//    else
//    {
//        echo $fetch_profile['description'];
//    }
    ?>
</span>
  <br>

  <?php 
  if($_SESSION['id'])
  {
      ?>
   <a href="javascript:void(0)" id='edituser' class="btn btn-success"><i  class="icon-white icon-edit"></i> Edit Profile</a>
   <?php
  }
  ?>
      
    </div>
    -->
    <div class="pepl text-center">
     
     <div class="cover_table">
      
      <div class="cover_row">
        <div class="half_cover">
            <?php
            if($fetch_profile['profile_cover'] == '')
            {
            ?>
                <img id='yyyyy' style='width:100%; height:100%;' src="no-img.jpg">
        <?php
                    }
         else {
             ?><img id='yyyyy' style='width:100%; height:100%;' src="webadmin/upload/usercover/original/<?=$fetch_profile['profile_cover']?>">
                <?php

         }
            ?>
       </div>
       </div>
      
       <div class="cover_row">  
       <div class="cover_text_inner">
        <div class="profile img-polaroid">
                              <?php
                              if($fetch_profile['oauth_provider'] != ''){
            if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img src="<?=$fetch_profile['image']?>" width="119px" alt=""/>
            <?php
            }
            else
            {
                                               if($fetch_profile['oauth_provider']== 'facebook')
                {
            ?>
            <img src="https://graph.facebook.com/<?=$fetch_profile['username']?>/picture?type=normal">
            <?php
                }
              }
                              }else{
                       if($fetch_profile['image'] == ""){
     ?>
            <img class="media-object myprofile " src="img/user.png" alt="">
            <?php
     }else{
         ?>
          <img class="media-object myprofile" src="webadmin/upload/userprofile/original/<?php echo $fetch_profile['image'];?>" alt="">
          <?php
     }
              }
             ?>  
    
                </div>
        
        <div class="clearfix"></div>
                
               <h4 class="margin20"> &nbsp; &nbsp; &nbsp;&nbsp;<?php
               echo $fetch_profile['fullname'];
               ?></h4>
               <p class="zero_margin font_zise13"><?php
               echo $fetch_profile['location'];
               ?></p>
               <p><?php
               echo $fetch_profile['description'];
               ?></p>
               <?php
               if($_SESSION['id'] == $fetch_profile['id'])
               {
               ?>
               <br>
<!--               <a class="btn btn-success" id="edituser" href="javascript:void(0)"><i class="icon-white icon-edit"></i> Edit Profile</a>-->
               <?php
               }
               ?>
		
        </div>
        </div>
        </div>
        
    </div>
    
    <div class="wrapper">
   <div class="wrapper_inner">
    <hr/>
        <span class="zero_margin"><a href="index" class="light_grey">Posts</a></span>&nbsp;&nbsp; / &nbsp;
        <span class="zero_margin"><a href="collections" class="light_grey">Collections</a></span>
        <hr/>
    <div class="row-fluid">
        <div class="row-fluid">
        <?php
        $i = 1;
 while($result_query_collections = mysql_fetch_array($res_query_collections))
  {
      if($i%4 == 0)
      {
          echo '</div><div class="row-fluid">';
      }
            else{
                 ?><?php
        

        ?>
        <div class="span4 botm_margin20">

        <div class="location_img">
            <?php
            if($_SESSION['id'] != "")
            {
            ?>
<a href="edit-collection.php?collection=<?php echo $result_query_collections['id']?>">
            <?php }else{?>
             <a href="collection?collection_name=<?php echo $result_query_collections['collection_name']?>"> 
            <?php }?>
    
            <img src="webadmin/upload/collection/original/<?=$result_query_collections['image']?>" alt=""/></a>
        <div class="location_text width89">
            <a href="collection?collection_name=<?php echo $result_query_collections['id'];?>">
                <p class="zero_margin"><?=$result_query_collections['collection_name']?> <br/><small>
                        <?php
        $sqk="SELECT * FROM posts WHERE collection_id='".$result_query_collections['id']."'";
        $fetch_post=mysql_query($sqk)or die (mysql_error());
        $counter=  mysql_num_rows($fetch_post);
        if($counter > 0)
        {
        echo $counter;
        }
        else
        {
        echo '0';
        }
        ?> Posts</small></p></a>
        </div>
        </div>

        </div>
        <?php
            }
            $i++;
        }
        ?>
	</div>
    </div>
   </div>
  </div>
 	
<script type="text/javascript">
 $('document').ready(function(e) {
  //$('.well_custom_light').hide();    
   $('.open_fom').click(function(){
console.log('open_fom');
   $('.well_custom_light').show();
   $('.well_custom_two').hide();
  });
  $('.well_custom_two').hide();
   $('.open_fom_two').click(function(){
	   console.log('open_fom_two');
	   	$('.well_custom_two').show();
		$('.well_custom_light').hide();
   });
 })
   </script>
   
  <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Posting to  ChangeFuel</h4>
    <p>Please choose a collection you'd like to contribute to: </p>
  </div>
  <div class="modal-body">
     
     <p class="top_botm_border grey_bg text-center" style="padding:10px;">Alernatively, you can create your &nbsp; <a href="createcollection.php" class="btn btn-success"><i class="icon-white icon-plus"></i> Create a collection</a>
     </p>
     
     
     <h5>Recommended</h5>
     <?php
     $sql_collec=mysql_query("SELECT * FROM `collections` WHERE status = '1' ORDER BY id DESC LIMIT 5")or die(mysql_error());
     while($fetch_collec =  mysql_fetch_array($sql_collec))
     {
     ?>
     <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="write-post?collection=<?php echo $fetch_collec['collection_name'];?>"><strong><?php echo $fetch_collec['collection_name'];?></strong></a> </p>
    <p><a href="#"><small><?php
$sqk="SELECT * FROM posts WHERE collection_id='".$fetch_collec['id']."'";
$fetch_post=mysql_query($sqk)or die (mysql_error());
$counter=  mysql_num_rows($fetch_post);
if($counter > 0)
{
    echo $counter;
}
else
{
    echo '0';
}
?>
 posts</small></a></p>
    </div>
    </div>
     <?php
     }
     ?>

     

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
   

</body>
</html>
