<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');

$query_collections = "SELECT * FROM `collections` WHERE status = '1' ORDER BY collection_name ASC ";
$res_query_collections = mysql_query($query_collections)or die(mysql_error());

$obj=new KARAMJEET();
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
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
             $ip = $_SERVER['SERVER_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//echo '<pre>';
//print_r($ip_data);
//die;
echo $addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;
?></small></p>

    </div>
     <div class="pepl height">
   <?php
         $sql_simg = "SELECT * FROM imageslogan WHERE status='1' ORDER BY id DESC LIMIT 1";
         $res_simg = mysql_query($sql_simg)or die(mysql_error());
         $fetch_simg = mysql_fetch_array($res_simg);
         ?>
<!--    <img src="img/phillylove.jpg" alt="" class="cover_img"/>-->
   <img src="webadmin/upload/sloganimage/thumb/<?php echo $fetch_simg['image'];?>" alt="" class="cover_img"/>
    <div class="row-fluid">
    <div class="content margin30 top30">
	<div class="content_inner">
        <div class="black_bar">   
        <h1 class="font_white top_margin_zero"><strong><span>Reportedly</span></strong></h1>
        <hr class="top_margin_zero"/>
        <p class="slogn">
<!--            Ideas are the fuel to create the change needed
    to make the world a healthier, happier and more sustainable place to live. Change your mind, Change the World. Reportedly is a simple place to write and share your views.--><?php
 $stirng = strip_tags($fetch_simg['slogan']);
            echo $stirng;?>
    <a href="#" class="font_white"><u>Learn More</u></a></p>
    </div>

<!--         <div class="row-fluid">
    <input type="button" class="btn black_btn span5 margin10" value="Login"/>
    <input type="button" class="btn black_btn span5 margin10" value="Signup"/>
    </div>-->
    
    <!--<a href="#myModal" data-toggle="modal" class="btn btn-success custom_padding" style="margin-top:5%;"><img src="img/new.png" alt=""/></a>-->
    
        </div>
    </div>
   
    </div>
    
    </div>
    
    
    
    <div class="wrapper">
   <div class="wrapper_inner">
    <hr/>
        <span class="zero_margin"><a href="index" class="light_grey">Posts</a></span>&nbsp;&nbsp;&nbsp;
        <span class="zero_margin"><a href="collections" class="light_grey">Collections</a></span>
        <hr/>
    <div class="row-fluid">
        <div class="row-fluid">
<?php
$i = 1;
   $count=mysql_num_rows($res_query_collections);
       
    while($result_query_collections = mysql_fetch_array($res_query_collections))
   //for($j=0;$j<$count;$j++)     
   {
        //echo $i;
        
     //echo '<pre>';
     //print_r($result_query_collections);
     ?>
    
 <?php
     if($result_query_collections['collection_name'] == "Editor's Picks")
     {
      echo '';   
     }else{
      if($i%4 == 0)
      {
           $i =1;
          //echo '</div><div class="row-fluid">';
          ?>
        </div>
        <div class="row-fluid">
             <div class="span4 botm_margin20">

        <div class="location_img">
            <a href="collection?collection_name=<?php echo $result_query_collections['id'];?>">
            <img src="webadmin/upload/collection/original/<?=$result_query_collections['image']?>" alt=""/>
        <div class="location_text width89">
            
                <p style="color:#fff;" class="zero_margin"><?=$result_query_collections['collection_name']?> <br/><small>
                        <?php
        $sqk="SELECT * FROM drafts WHERE collection_id='".$result_query_collections['id']."' AND status = '1' ";
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
        ?> Posts</small></p>
        </div></a>
        </div>

        </div>       

            <?php
          
      }
        else{
             ?>
        <div class="span4 botm_margin20">

        <div class="location_img">
<a href="collection?collection_name=<?php echo $result_query_collections['id'];?>">
            <img src="webadmin/upload/collection/original/<?=$result_query_collections['image']?>" alt=""/>
        <div class="location_text width89">
            
                <p style="color:#fff;" class="zero_margin"><?=$result_query_collections['collection_name']?> <br/><small>
                        <?php
        $sqk="SELECT * FROM drafts WHERE collection_id='".$result_query_collections['id']."' AND status = '1' ";
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
        ?> Posts</small></p>
        </div></a>
        </div>

        </div>
        <?php
           }
           $i++;
     }
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
    <h4 id="myModalLabel">Posting to  Reportedly</h4>
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
