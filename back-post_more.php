<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$getpostid=base64_decode($_GET['post']);
$fetchpost=$obj->fetch_one('posts',"`id`='".$getpostid."'");
$fetchcollection=$obj->fetch_one('collections',"`id`='".$fetchpost['collection_id']."'");
$fetchauthor=$obj->fetch_one('twitter_users',"`id`='".$fetchpost['author']."'");
$sessionuser=$obj->fetch_one('twitter_users',"`id`='".$_SESSION['id']."'");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Report More</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-----------------------/ main css and js --------------!---->
<link rel="stylesheet" type="text/css" href="css/jquery.pageslide.css" />

</head>

<body>
<div class="row-fluid" id="content">
  <div class="logo_drop_down"> 
  <a class="dropdown-toggle logo" data-toggle="dropdown" href="index.html"><img src="img/logo.png" alt=""/></a>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <?php
        if(!empty($_SESSION['id']))
        {
        ?>
      <li><a href="index">Home</a></li>
      <li><a href="profile"><?=$sessionuser['fullname']?></a></li>
      <li><a href="stats">Stats</a></li>
      <li><a href="drafts">Drafts</a></li>
      <li><a href="settings">Settings</a></li>
      <li><?php
      echo '<a href="logout">Logout </a>'?></li> 
      <?php
      }
      else
      {
      ?>

      <li><a href="index">Home</a></li>
      <li><a href="signin">Signin</a></li>
      <?php
      }
      ?>
    </ul>
  </div>

  <div class="pepl text-center relative">
    
    <div class="profile img-polaroid margin50 pull-right">
<!--        <img src="img/profile_bg.jpg" alt=""/>-->
        <?php
                    if($fetchauthor['oauth_provider'] == 'twitter')
            {
                ?>
            <img src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$fetchauthor['username']?>&size=bigger" width="119px" alt=""/>
            <?php
            }
            else
            {
                if($fetchauthor['oauth_provider']== 'facebook')
                {
            ?>
            <img src="https://graph.facebook.com/<?=$fetchauthor['username']?>/picture?type=normal">
            <?php
                }
              }
             ?>
    </div>
    <div class="clearfix"></div>
    <div class="row-fluid text-right font_zise13">
      <h4 class="margin30"><?=$fetchauthor['fullname']?></h4>
<p class="zero_margin font_zise13"><?=$fetchauthor['location']?></p>
      <p><?=$fetchauthor['description']?></p>
       </div>
    <div class="clearfix"></div>
  </div>
  <div class="wrapper">
    <div class="wrapper_inner">
      <div class="row-fluid  margin20">
        <div class="span10">
          <h2 class="zero_margin">
          <?php
          echo $fetchpost['title'];
          ?></h2>
          <small class="light_grey">In <?=$fetchcollection['collection_name']?> </small> </div>
        <div class="clearfix"></div>
        <p class="margin20 relative">
            <?=$fetchpost['post'];?>
<!--            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered.-->
<?php
if(!$_SESSION['id'] == "")
{
?>
            <span><a href="#modal" class="second comment">+</a></span> </p>
                    <?php
                    }
                    ?>
        <p class="relative">
<!--            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered.-->
            <?php
if(!$_SESSION['id'] == "")
{
?><span><a href="#modal" class="second comment">+</a></span>
        <?php
}?></p>
        <p class="p_left_border relative">
<!--            The first high-growth segment was power buyers and power sellers on eBay. These people bought and sold a ton of stuff. The high velocity of money going through the system was linked to the virality of customer growth. By the time people understood how and why PayPal took off on eBay, it was too late for them to catch up. The eBay segment was locked in. And the virality in every other market segment—e.g. sending money to family overseas—was much lower. Money simply didn't move as fast in those segments. Capturing segment one and making your would-be competitors scramble to think about second and third-best segments is key. -->
            <span><a  href="#modal" class="second comment">5</a></span> </p>
      </div>
      <div class="row-fluid padding_top15 margin20">
  
      <span class="span3 pull-right zero_margin"> 
      <a href="#" class=""><img src="img/rec.png" alt="Recommend"/> &nbsp; </a>
      <a href="#" class=""><img src="img/add.png" alt="Add more"/> &nbsp; </a>
      <a href="#"class=""><img src="img/black_fb.png" alt="Share on Facebook"> &nbsp; </a> 
      <a href="#"class=""><img src="img/black_tw.png" alt="Share on Twitter"> &nbsp; </a>
      
      
      </span>
        		 
         </div>
         
    </div>
    <div class="row-fluid margin30"> <span class="read_more"><a href="#">More</a></span>
      <hr/>
    </div>
    <div class="row-fluid">
      <div class="wrapper_inner">
        <div id="blog">
          <ul>
            <li>
              <div class="media padding_top15 zero_margin">
                <div class="media-body">
                  <h5 class="media-heading"><a href="#">Doctor Hoon</a> </h5>
                  <p><a href="#"><small>Dale Franks in The Joy of Automotion</small></a></p>
                  <p>At about the same time that Britain was giving us Doctor Who, they also gave us the original Mini. Badly underpowered by today's standards, it was so responsive and fun that it quickly became the original hot hatch, and began tearing up rally and racing tracks all over Europe...</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <hr/>
        <div class="row-fluid">
          <div class="span4">
            <p><a href="#"><strong>Merging book stores..</strong></a></p>
            <p><a href="#" class="light_grey">in Adventures in..</a></p>
          </div>
          <div class="span4">
            <p><a href="#"><strong>Merging book stores..</strong></a></p>
            <p><a href="#" class="light_grey">in Adventures in..</a></p>
          </div>
          <div class="span4">
            <p><a href="#"><strong>Merging book stores..</strong></a></p>
            <p><a href="#" class="light_grey">in Adventures in..</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div id="modal">
	
    <div class="row-fluid">
    <div class="span2">
    <div class="span12 img-polaroid margin10 pull-left pading2"><?php
                    if($sessionuser['oauth_provider'] == 'twitter')
            {
                ?>
            <img src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$sessionuser['username']?>&size=bigger" width="119px" alt=""/>
            <?php
            }
            else
            {
                if($sessionuser['oauth_provider']== 'facebook')
                {
            ?>
            <img src="https://graph.facebook.com/<?=$sessionuser['username']?>/picture?type=normal">
            <?php
                }
              }
             ?></div>			    </div>
    <div class="span10">
     <h4 class="font14"><?=$sessionuser['fullname']?></h4>
     <input type="text" class="input_custom zero_margin" placeholder="Leave a note">
     <a href="#" class="font_zise13">Save</a> &nbsp; <a href="javascript:$.pageslide.close()" class="font_zise13">Cancel</a>
     <hr/>
     <p class="font_zise13 light_grey">This note is only visible to you and the author, unless the author chooses to make it public.</p>
    </div>
    
    </div>
  
</div>

<script src="js/jquery.pageslide.min.js"></script> 
<script>
        /* Default pageslide, moves to the right */
        $(".first").pageslide();
        
        /* Slide to the left, and make it model (you'll have to call $.pageslide.close() to close) */
        $(".second").pageslide({ direction: "left", modal: true });
		
		$('.comment').click(function(){
			if($(this).hasClass('showcomment')){
            				$(this).removeClass('showcomment');
			}else{
				$(this).addClass('showcomment');
				}
		})
		
    </script>
</body>
</html>
