<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$collection_id = $_GET[collection_name];
$name = "Editor's Picks";
$coll_name = addslashes($name);
$query_collections = "SELECT * FROM `collections` WHERE status = '1' AND collection_name='$coll_name' ";
$res_collections = mysql_query($query_collections)or die(mysql_error());
$fetch_collection= mysql_fetch_array($res_collections);
$obj=new KARAMJEET();
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'Editor Picks'; ?></title>

<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-----------------------/ main css and js --------------!---->
<script>
    $(document).on('click','#editcollection',function(){
        var colid=$('.colid').attr('id');
       window.location.href="http://reportedly.pnf-sites.info/edit-collection.php?collection="+colid; 
    })
</script>

</head>

<body>
	
    <div class="row-fluid">

    <div class="logo_drop_down">
   <input id="<?php echo $_GET['collection_name']; ?>" class="colid" type="hidden">
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="#"><img src="img/logo.png" alt=""/></a>

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
    
    </div>

    <div class="pepl font_white">
  
        <div  class="cover_img" style="background:url('webadmin/upload/collection/original/<?=$fetch_collection['image']?>') ">
          
        </div>
    <div class="content margin30 top30">
        <div class="content_inner">
    <h4 class="font_white"><?=$fetch_collection['collection_name']?></h4>
    <p><small><?php echo substr($fetch_collection['collection'],'0','85');?></small></p>

    <hr class="top_margin_zero"/>
    <p><i>By
  <?php
  $auth_id = $fetch_collection['collection_author'];
  $fetch_author=$obj->fetch_one('twitter_users',"`id`='".$auth_id."'");
  echo $fetch_author['fullname'];
   ?> · <?php
$sqk="SELECT * FROM drafts WHERE editor_pick='1' ORDER BY id DESC ";
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
   Posts
        </i>
    <?php
    if($fetch_collection['contribute_type'] != 'Anyone' )
    {
        echo 'Invite Only';
    }?>
    </p>
    
    
    
    <div class="clearfix"></div>
    <?php

    if(($fetch_collection['contribute_type'] == 'Anyone') or ($fetch_collection['collection_author'] == $_SESSION['id']))
    {
        ?>
  
    <a class="btn btn-success custom_padding" data-toggle="modal" href="write-post?collection=<?php echo $fetch_collection['collection_name'];?>">
<img alt="" src="img/new.png">
</a>
    <?php
    }
    
    
    if($fetch_collection['collection_author'] == $_SESSION['id'] )
    {
    ?>
    <input id='editcollection' type="button" class="btn btn-success" value="Edit">
    <?php
    }?>
    </div>
    </div>
    
    <div class="clearfix"></div>
    </div>
        <?php
        $sql_post=mysql_query("SELECT * FROM `drafts` WHERE  editor_pick = '1' ORDER BY id DESC ") or die(mysql_error());
         $count =  mysql_num_rows($sql_post);
         
         if($count == 0)
         {
          ?>
        <div class="wrapper">
            <div class="wrapper_inner">
                <div id="blog">
                 There is nothing here yet
                 <?php
                 if(($fetch_collection['contribute_type'] != 'Anyone') AND ($fetch_collection['collection_author'] == $_SESSION['id'])){
                     ?>
                 <a class="btn btn-success custom_padding" data-toggle="modal" href="write-post?collection=<?php echo $fetch_collection['collection_name'];?>">
            <img alt="" src="img/new.png">
            </a>
           <?php
             }
          ?>
            </div>  </div>
           
        </div>
        <?php
         }
         else
         {
        ?>
    
    <div class="wrapper">
   <div class="wrapper_inner">
    <hr/>
<!--        <span class="zero_margin"><a href="#" class="light_grey">Most Recent</a></span>
-->
        <span class="zero_margin "><a href="javascript:void(0);" class="light_grey">Latest</a></span>
        <hr/>
    
 	<div id="blog">
     <ul>
     
       <li>
           <?php
       
      while($fetch_post = mysql_fetch_array($sql_post))
     {
          $fetchauthor=$obj->fetch_one('twitter_users',"`id`='".$fetch_post['author']."'");
           ?>
    <div class="media padding_top15 border_botm zero_margin">
    <a class="pull-left" href="profile?profile=<?=$fetchauthor['username']?>">
<!--    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">-->
        <?php
    
        if($fetchauthor['image'] == ''){
     ?>
            <img class="media-object img-polaroid pading2" width="48px" src="img/user.png" alt="">
            <?php
 }else{
      ?>
            <img class="media-object img-polaroid pading2" width="48px" height="48px" src="webadmin/upload/userprofile/original/<?php echo $fetchauthor['image'];  ?>" alt="">
            <?php
              }
        ?>
    </a>
    <div class="media-body">
    <h5 class="media-heading"><a href="post_more.php?post=<?php echo base64_encode($fetch_post['id']); ?>"><?php 
    if($fetch_post['title'] == '')
    {
        echo 'Untitled';
    }  else {
        echo $fetch_post['title'];
    }
    //echo $fetch_rec_post[id];
    
    ?></a> </h5>
    <p><a href="profile?profile=<?=$fetchauthor['username']?>"><small><?php
    
    echo $fetchauthor['fullname'];
    ?></small></a></p>
    <p><?php //echo substr($fetch_post['post'],'0','50').'...'; ?></p>
    </div>
    </div>
           <?php
           
        }
        ?>
       </li>
       

       
     </ul>
 </div>
	
	
    </div>


    </div>
    <?php
         }?>
    
    
    </div>
    

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Posting to  Reportedly</h4>
    <p>Please choose a collection you'd like to contribute to: </p>
  </div>
  <div class="modal-body">
     
     <p class="top_botm_border grey_bg text-center" style="padding:10px;">Alernatively, you can create your &nbsp; <a href="createcollection.php" class="btn btn-success"><i class="icon-white icon-plus"></i> Create a collection</a>
     </p>
     
     
     <h5>Recommended</h5>
     <?php
     $sql_collec=mysql_query("SELECT * FROM `collections` WHERE editor_pick='1' ORDER BY id DESC LIMIT 10")or die(mysql_error());
     while($fetch_collec =  mysql_fetch_array($sql_collec))
     {
         
         $fetch_collec_author=$obj->fetch_one('twitter_users',"`id`='".$fetch_collec[collection_author]."'");
         echo '<pre>';
         print_r($fetch_collec_author);
     ?>
     <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <?php
     if($fetch_collec_author['image'] == ''){
     ?>
            <img class="" src="img/user.png" alt="">
            <?php
 }else{
      ?>
            <img class="" src="webadmin/upload/userprofile/original/<?php echo $fetch_profile_author['image'];  ?>" alt="">
            <?php
 }
    ?>
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="write-post.php?collection=<?php echo $fetch_collec['collection_name'];?>"><strong><?php echo $fetch_collec['collection_name'];?></strong></a> </p>
    <p><a href="#"><small><?php
$sqk="SELECT * FROM drafts WHERE collection_id='".$fetch_collec['id']."' AND status='1' ";
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
<!--     <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>825 posts</small></a></p>
    </div>
    </div>-->
    
<!--    <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>25 posts</small></a></p>
    </div>
    </div>-->
    
<!--    <div class="media padding_top15 zero_margin">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>80 posts</small></a></p>
    </div>
    </div>-->
     

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
</body>
</html>
