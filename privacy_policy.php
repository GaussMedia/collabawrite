<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$session_id = $_SESSION['id'];

$sessionuser=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
$query = "SELECT * FROM `twitter_users` WHERE id = '$session_id'";
$res = mysql_query($query)or die(mysql_error());
$fetch_profile = mysql_fetch_array($res);
$page = $_GET['page'];
?>

<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ucwords(str_replace('_',' ',$page)) ?></title>


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
    <a href="#" class="font_white"><u>Learn More</u></a></p>
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

 	<div id="blog">
            <?php
            $sql_ep = "SELECT * FROM page WHERE slug ='$page'  ";
            $res_ep = mysql_query($sql_ep)or die(mysql_error());
            $fetch_ep =  mysql_fetch_array($res_ep);
            
//            echo '<pre>';
      echo $fetch_ep['page_des'];
//            die;
            ?>
     
 </div>
 
       <hr>
	
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
