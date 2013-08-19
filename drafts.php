<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$table_user="twitter_users";
$collection_id=$_GET['collection'];
$obj=new KARAMJEET();
$fetch_profile=$obj->fetch_one($table_user,"`id`='".$_SESSION[id]."'");
if($_SESSION['id'] == ''){
    header('location:http://reportedly.pnf-sites.info/signin');
}else{
        ?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Draft</title>


<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
 $('#myTextBox').click(function() {
    var rr=find('a:selected').text();
    alert(rr);
});
</script>
</head>

<body>
	
    <div class="row-fluid">

    <div class="logo_drop_down span3">
    
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
    
    </div>

    <div class="pepl">
    <img src="img/draft.png" alt="" class="cover_img"/>
   
    <div class="content margin30 top30">
    <h1><strong>Draft</strong></h1>
    <!--<hr class="zero_margin"/>
    <p class="slogn">It's not news until you report it</p>-->
     
    </div>
   
    </div>
    
    
    
    <div class="wrapper">
   <div class="wrapper_inner">
    <hr/>
    <?php
    //$table_posts="posts";
    
   ?>
    <span class="zero_margin light_grey">Drafts</span>
    <hr/>
    
    <?php
    $sess_id = $_SESSION['id'];
    $sql_posts = "SELECT * FROM drafts WHERE author='$sess_id' AND status='0' ORDER BY id DESC ";
    $res_posts = mysql_query($sql_posts)or die(mysql_error());
    while($fetch_posts =  mysql_fetch_array($res_posts))
    {
        
    ?>
    <h1><a href="unpublish_draft.php?post=<?php echo base64_encode($fetch_posts['id']); ?>"><?php 
    
    if($fetch_posts['title'] == ""){
        echo 'Untitled';
    }else{
     echo ucfirst($fetch_posts['title']);   
    }
    ?></a></h1>
    
    <p class="light_grey">in <a href="#">
     <?php
     $coll=$obj->fetch_one('collections',"`id`='".$fetch_posts['collection_id']."'");
     echo $coll['collection_name'];
     ?>
     </a></p>
    <h5><a href="unpublish_draft.php?post=<?php echo base64_encode($fetch_posts['id']); ?>" id="myTextBox"><?php
    echo substr($fetch_posts['post'],'0','100').'...';
    ?></a></h5>
    <?php
    }
    ?>
<!--    <hr/>
    <h1><a href="#">tt</a></h1>
    <p class="light_grey">in <a href="#">I.M.H.O.</a></p>
    <h5><a href="unpublish_drafts.html">tderfdfgdfh</a></h5>-->

    
    </div>


    </div>
    
    
    
    </div>
       
   
 <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Posting to Reportedly</h4>
    <p>Please choose a collection you'd like to contribute to: </p>
  </div>
  <div class="modal-body">
     
     <p class="top_botm_border grey_bg text-center" style="padding:10px;">Alernatively, you can create your &nbsp; <a href="create_collection.html" class="btn btn-success"><i class="icon-white icon-plus"></i> Create a collection</a>
     </p>
     
     
     <h5>Recommended</h5>
     
     <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>825 posts</small></a></p>
    </div>
    </div>
    
    <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>825 posts</small></a></p>
    </div>
    </div>
    
    <div class="media padding_top15 zero_margin">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>825 posts</small></a></p>
    </div>
    </div>
     

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
   

    
</body>
</html>
<?php
        }
        ?>