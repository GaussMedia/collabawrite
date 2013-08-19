<?php
session_start();
include('/var/www/clients/client2/web211/web/Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$query_seo = "SELECT * FROM site_settings WHERE id='1' ";
$res_seo = mysql_query($query_seo)or die(mysql_error());
$fetch_seo = mysql_fetch_array($res_seo);

$obj=new KARAMJEET();
$session_id = $_SESSION['id'];

$sessionuser=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
$query = "SELECT * FROM `twitter_users` WHERE id = '$session_id'";
$res = mysql_query($query)or die(mysql_error());
$fetch_profile = mysql_fetch_array($res);

?>

<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Reportedly</title>


<meta name="keywords" content="<?php echo $fetch_seo['seo_k']; ?>" >

<meta name="description" content="<?php echo $fetch_seo['meta_des']; ?>">


<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
   

function deleteCookies(name) {
    //alert('cookiedelete');
    //jQuery.cookie("myDraftId", null);
    document.cookie = name+'="";-1; path=/';
}

$(document).on('click','#resendlink',function (){
    var email = $('#linkemail').val();
  $.ajax({
        type: 'POST',
        dataType: 'json',
        data:{'email':email},
        url: 'http://reportedly.pnf-sites.info/resend-link',
        success: function(response){
           alert(response);
           window.location.href = 'http://reportedly.pnf-sites.info';
        }
        });
})
</script>
</head>

<body>
    
    <div class="row-fluid">

    <div class="logo_drop_down">
    
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="index.php">
            <?php
            $query_logo = "SELECT * FROM `logo` WHERE status='1' ";
            $res_logo = mysql_query($query_logo)or die(mysql_error());
            $fetch_logo = mysql_fetch_array($res_logo);
            ?>
            <img src="webadmin/upload/logo/real/<?php echo $fetch_logo['logo_image']; ?>" alt=""/></a>

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
    
     <p class="font_white margin20 margin_botm_zero left_margin75"><small>
<?php
//$ip=$_SERVER['REMOTE_ADDR'];
// $addr_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
// $city = stripslashes(ucfirst($addr_details[geoplugin_city]));
// $countrycode = stripslashes(ucfirst($addr_details[geoplugin_countryCode]));
// $country = stripslashes(ucfirst($addr_details[geoplugin_countryName]));
// echo  $city.",".$country;
$ip = $_SERVER['REMOTE_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//    echo '<pre>';
//    print_r($ip_data);
//    die;
echo $addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;
?></small></p>
    
    </div>
        
<input type="hidden" id="linkemail" name="email" value="<?php echo $fetch_profile['email']; ?>">
     <div class="pepl">
         <?php
         $sql_simg = "SELECT * FROM imageslogan WHERE status='1' ORDER BY id DESC LIMIT 1";
         $res_simg = mysql_query($sql_simg)or die(mysql_error());
         $fetch_simg = mysql_fetch_array($res_simg);
         ?>
         <img src="webadmin/upload/sloganimage/thumb/<?php echo $fetch_simg['image'];?>" alt="" class="cover_img"/>
<!--    <img src="img/phillylove.jpg" alt="" class="cover_img"/>-->
   <div class="row-fluid">
       <?php
        if($_SESSION['id'] ==  "")
        {
        ?>
   <div class="content margin30 top30">
       <div class="content_inner">
	 <div class="black_bar">   
        <h1 class="font_white top_margin_zero"><img src="img/logo_report.png"></h1>
        <hr class="top_margin_zero"/>
      
        <p class="slogn font_white">
            <?php 
            $stirng = strip_tags($fetch_simg['slogan']);
            echo $stirng;?>
<!--    <a href="javascript:void(0);" class="font_white"><u>Learn More</u></a>-->
        
        </p>
    </div>
         <div class="row-fluid">
     <a href="signin.php"><input type="button" class="btn black_btn span5 margin10" value="Login"/></a>
      <a href="signup.php" ><input type="button" class="btn black_btn span5 margin10" value="Signup"/></a>
    </div>
       <?php
        }
        else
        {
       ?>
<div class="content margin30 top30">
<div class="content_inner">	
    <div class="black_bar">   
        <h1 class="font_white top_margin_zero"><img src="img/logo_report.png"></h1>
        <hr class="top_margin_zero"/>
        <p class="slogn font_white">
           <?php echo $fetch_simg['slogan'];?>  
<!--            Ideas are the fuel to create the change needed
    to make the world a healthier, happier and more sustainable place to live. Change your mind, Change the World. ChangeFuel is a simple place to write and share your views. -->
    <a href="http://reportedly.pnf-sites.info/privacy_policy?page=why_we_built_reportedly" class="font_white"><u>Learn More</u></a></p>
    </div>
    <?php
        }
  ?>
    <?php
        if(!empty($_SESSION['id']) and $fetch_profile['status'] != '0')
        {
        ?>
    
    <a href="#myModal" data-toggle="modal" class="btn btn-success custom_padding" style="margin-top:5%;"><img src="img/new.png" alt=""/></a>
    <?php
        }?>
     
    </div>
</div>
   </div>
    </div>
     
     </div>
    
    
    
    <div class="wrapper">
        <?php
        if($fetch_profile['status'] == '0')
        {
        echo '<font color="red">We sent an email to ('.$fetch_profile[email].') Please confirm your email address to begin writing reports on Reportedly. If you didn’t receive the email, click <a id="resendlink" href="javascript:void(0);">here</a> to resend it.</font>';
        }
        ?>
   <div class="wrapper_inner">
    <hr/>
        <span class="zero_margin"><a href="editor-picks" class="light_grey">Editor's Pick</a></span>
        <span class="zero_margin pull-right"><a href="editor-picks" class="light_grey">More</a></span>
        <hr/>
    
 	<div id="blog">
            <?php
            $sql_ep = "SELECT * FROM drafts WHERE editor_pick ='1' ORDER by id DESC LIMIT 1  ";
            $res_ep = mysql_query($sql_ep)or die(mysql_error());
            $fetch_ep =  mysql_fetch_array($res_ep);
            $fetch_ep_author=$obj->fetch_one('twitter_users',"`id`='".$fetch_ep['author']."'");
            $fetch_ep_collec=$obj->fetch_one('collections',"`id`='".$fetch_ep['collection_id']."'");
//            echo '<pre>';
//            print_r($fetch_ep_author);
//            die;
            ?>
     <ul>
     
       <li>
	<div class="media padding_top15 zero_margin">
    <a class="pull-left" href="profile?profile=<?=$fetch_ep_author['username']?>">

    </a>
    <div class="media-body">
    <h5 class="media-heading">
        <a href="post_more?post=<?php echo base64_encode($fetch_ep['id']);?>">
            <?php if($fetch_ep['title'] == ''){
             echo 'Untitled';   
            }  else {
 echo ucwords($fetch_ep['title']);               
} ?>
<!--            When Good Design Isn't Enough-->
        </a> </h5>
    <p>
        <small>By</small>
        <a href="profile?profile=<?=$fetch_ep_author['username']?>">
                <?php echo $fetch_ep_author['fullname']; ?></a><small>
<!--                Johnnie Manzari-->
in <a href="collection?collection_name=<?php echo $fetch_ep_collec['id'];?>"> <?php echo $fetch_ep_collec['collection_name']; ?></small></a></p>
    <p>
        <a href="post_more?post=<?php echo base64_encode($fetch_ep['id']);?>"><?php //echo substr($fetch_ep['post'],'0','150'); ?>
        </a>
<!--        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen...-->
    </p>
    </div>
    </div>
       </li>

       <p class="top_botm_border light_grey">Most Recommended Today</p>
       <?php
       //$query_rec_post = "SELECT * FROM `drafts` WHERE status = '1'";
       //$city = $ip_data->geoplugin_city;
       //$query_rec_post = " SELECT * FROM `drafts` WHERE status='1' AND editor_pick = '0'  AND drafts.id IN (SELECT DISTINCT(`recommend_post`) FROM recommends) ORDER BY drafts.id DESC LIMIT 20";
       $query_rec_post = "SELECT * FROM `drafts` WHERE status='1' AND editor_pick = '0' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$city%' ) ORDER BY id DESC  ";
       $res_rec_post = mysql_query($query_rec_post)or die(mysql_error());
       while($fetch_rec_post = mysql_fetch_array($res_rec_post))
       {
       ?>
       <li>
	<div class="media padding_top15 border_botm zero_margin">

<!--    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">-->
    <?php
    $post_author=$obj->fetch_one('twitter_users',"`id`='".$fetch_rec_post['author']."'");
    $post_collection=$obj->fetch_one('collections',"`id`='".$fetch_rec_post['collection_id']."'");
           
             ?>
   
    <div class="media-body">
    <h5 class="media-heading"><a href="post_more?post=<?php echo base64_encode($fetch_rec_post['id']);?>"><?php 
    if($fetch_rec_post['title'] == '')
    {
        echo 'Untitled';
    }  else {
        echo ucwords($fetch_rec_post['title']);
    }
    //echo $fetch_rec_post[id];
    
    ?></a> </h5>
    <p><small>By</small>
        <a href="profile?profile=<?=$post_author['username']?>" title="Go to <?=$post_author['fullname']?>"><small>
                <?=$post_author['fullname']?>
                 </small></a><small>In</small>
        <a title="Go to  <?=$post_collection['collection_name'];?>" href="collection.php?collection_name=<?=$post_collection['id'];?>"><small>
                <?php
                echo $post_collection['collection_name'];
                ?></small></a></p>
                <?php
                //echo substr($fetch_rec_post['post'],'0','20').' ...';
                ?>
    </div>
    </div>
       </li>
       <?php
       }
       ?>
       
     </ul>
 </div>
 
 	<div class="row-fluid">
    <hr/>
        <span class="zero_margin"><a href="collections" class="light_grey">Featured Collections</a></span>
        <span class="zero_margin pull-right"><a href="collections" class="light_grey">More</a></span>
        <hr/>

<div class="row-fluid">
                    <?php
//                    $col3 = mysql_query("SELECT posts.collection_id,COUNT(posts.
//                    id) AS NumberOfposts FROM posts
//                    LEFT OUTER JOIN collections
//                    ON posts.collection_id=collections.id;        
//                    ");
//                    $col = mysql_fetch_array($col3);
//                    //echo $col[NumberOfposts];
$name = "Editor's Picks";
$coll_name = addslashes($name);
$query_collections = "SELECT * FROM `collections` WHERE status = '1' AND collection_name <> '$coll_name' ORDER BY id DESC LIMIT 3 ";
$res_query_collections = mysql_query($query_collections)or die(mysql_error());
while($fetchcoll=mysql_fetch_array($res_query_collections))
{
//    if($fetchcoll['collection_name'] == "Editor's Picks")
//     {
//      echo '';   
//     }else{
?>
<div class="span4 botm_margin20">
     <a href="collection?collection_name=<?=$fetchcoll['id']?>">
          <?php
                   list($width,$height) = getimagesize('webadmin/upload/collection/original/'.$fetchcoll['image']);
                   ?>
<!--         style="background: url(webadmin/upload/collection/original/<?=$fetchcoll['image']?>);"-->
     <div class="location_img" >
         <img src="timthumb.php?src=webadmin/upload/collection/original/<?=$fetchcoll['image']?>&h=<?php echo $height; ?>&w=<?php echo $width; ?>&zc=1" alt=""/>
     </a>     
<!--                   <img src="webadmin/upload/collection/original/<?=$fetchcoll['image']?>" alt=""/>-->
        <div class="location_text width89">
            <a href="collection?collection_name=<?=$fetchcoll['id']?>">
   <?php echo $fetchcoll['collection_name']; ?> </a><br/>
                                   <?php
$sqk="SELECT * FROM drafts WHERE collection_id='".$fetchcoll['id']."' AND status='1'";
$fetch_post=mysql_query($sqk)or die (mysql_error());
$counter=  mysql_num_rows($fetch_post);

?><small>
    <a href="collection?collection_name=<?=$fetchcoll['id']?>">
    <?php
if($counter > 0)
{
    echo $counter;
}
else
{
    echo '0';
}
?> Posts</a></small></p></div> </div>
                        
                        </div>
                    <?php
    //}
}
?> </div>
    
    </div>
	
<!--        <small class="powered_text">Powered by <a title="Click here to go" target="_blank" href="http://www.picnframes.com/">PICNFRAMES TECHNOLOGIES</a></small>-->
	<small class="powered_text">
            Powered by Collabawrite © 2013 by Sociality Inc All rights reserved. (&hearts;) Made In New Jersey.
            <!--<a title="Click here to go" target="_blank" href="http://www.picnframes.com/">PICNFRAMES TECHNOLOGIES</a>-->
        </small>
        
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
   <?php
    $sql_conut_coll = "SELECT * FROM collections WHERE collection_author='$_SESSION[id]' ";
    $res_count_coll = mysql_query($sql_conut_coll)or die(mysql_error());
    
   ?>
   <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <?php
            if(mysql_num_rows($res_count_coll) > 7)
            {
                echo "<h1 align='center' style='color:red;'>Oops..!</h1>";
                echo "<br><span style='padding:60px;color:red;'>User is allowed to create only 7 collections</span>";
                 echo "<br><span style='padding:110px;color:red;'>You have reached at that limit.</span>";
                ?>
    <h4 id="myModalLabel">Posting to  Reportedly</h4>
    <p>Please choose a collection you'd like to contribute to: </p>
  </div>
  <div class="modal-body">
     <h5>Recommended</h5>
     <?php
     $sql_collec = "SELECT * FROM `collections` WHERE status='1' AND collection_author = '$_SESSION[id]' UNION SELECT * FROM `collections` WHERE status='1' AND id IN (SELECT DISTINCT(recommend_collection) FROM recommends where recommend_user = '$_SESSION[id]') ORDER BY id DESC LIMIT 6";
     $res_collec = mysql_query($sql_collec);
     if(mysql_num_rows($res_collec)<=0){
         echo 'You have no collection yet create a new one or recommend others posts.';
     }else{
     //$sql_collec=mysql_query("SELECT * FROM `collections` WHERE status = '1'  AND contribute_type='Anyone'  ORDER BY id DESC LIMIT 6")or die(mysql_error());
     while($fetch_collec =  mysql_fetch_array($res_collec))
     {
     ?>
     <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a onClick="deleteCookies('myDraftId');" href="write-post?collection=<?php echo $fetch_collec['collection_name'];?>"><strong><?php echo $fetch_collec['collection_name'];?></strong></a> </p>
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
     }
     ?>
  </div>
    <?php
            }
            else{
    ?>
    <h4 id="myModalLabel">Posting to  Reportedly</h4>
    <p>Please choose a collection you'd like to contribute to: </p>
  </div>
  <div class="modal-body">
     
     <p class="top_botm_border grey_bg text-center" style="padding:10px;">Alernatively, you can create your &nbsp; <a href="createcollection.php" class="btn btn-success"><i class="icon-white icon-plus"></i> Create a collection</a>
     </p>
     
     
     <h5>Recommended</h5>
     <?php
     $sql_collec = "SELECT * FROM `collections` WHERE status='1' AND collection_author = '$_SESSION[id]' UNION SELECT * FROM `collections` WHERE status='1' AND id IN (SELECT DISTINCT(recommend_collection) FROM recommends where recommend_user = '$_SESSION[id]') ORDER BY id DESC LIMIT 10";
     $res_collec = mysql_query($sql_collec);
     if(mysql_num_rows($res_collec)<=0){
         echo 'You have no collection yet create a new one or recommend others posts.';
     }else{
     //$sql_collec=mysql_query("SELECT * FROM `collections` WHERE status = '1'  AND contribute_type='Anyone'  ORDER BY id DESC LIMIT 6")or die(mysql_error());
     while($fetch_collec =  mysql_fetch_array($res_collec))
     {
     ?>
     <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a onClick="deleteCookies('myDraftId');" href="write-post?collection=<?php echo $fetch_collec['collection_name'];?>"><strong><?php echo $fetch_collec['collection_name'];?></strong></a> </p>
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
     }
     ?>
<!--    
    <div class="media padding_top15 zero_margin border_botm">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>25 posts</small></a></p>
    </div>
    </div>
    
    <div class="media padding_top15 zero_margin">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>When Good Design Isn't Enough</strong></a> </p>
    <p><a href="#"><small>80 posts</small></a></p>
    </div>
    </div>-->
     

  </div>
       <?php
            }
       ?>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
   
   
   
   <script>
     jQuery(document).ready(function(){ 

	jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() <= 100) {
                jQuery(".logo_drop_down").removeClass("site_logo_hidden");
            } else {
                jQuery(".logo_drop_down").addClass("site_logo_hidden");
            }
        });
		
	jQuery(".dropdown-toggle").click(function(){
		jQuery(".pepl,.wrapper").addClass("transform");
		jQuery('.dropdown-menu').addClass('box_shadow left_zero2');
		jQuery('.logo_drop_down').addClass('left_zero2');
		})
		jQuery('.dropdown-menu').click(function(){
			jQuery(".pepl,.wrapper").removeClass("transform");
			})
			jQuery(".dropdown-menu").click(function(){
				jQuery(".logo_drop_down").removeClass("left_zero2");
				
			})
	
	 });
    </script>

</body>
</html>
