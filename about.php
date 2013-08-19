<?php
session_start();
include('Twitter_Login/config/dbconfig.php');

$query_profile = "SELECT * FROM `twitter_users` WHERE id = '$_SESSION[id]'";
$res_profile = mysql_query($query_profile)or die(mysql_error());
$fetch_profile = mysql_fetch_array($res_profile);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>About</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-----------------------/ main css and js --------------!---->

</head>

<body>

<div class="row-fluid">
  <div class="logo_drop_down">
    
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="#">
            <?php
            $query_logo = "SELECT * FROM `logo` WHERE status='1' ";
            $res_logo = mysql_query($query_logo)or die(mysql_error());
            $fetch_logo = mysql_fetch_array($res_logo);
            ?>
            <img src="webadmin/upload/logo/real/<?php echo $fetch_logo['logo_image']; ?>" alt=""/>
            
        </a>

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
  <div class="pepl text-center">
  
 <!-- <div class="half_cover">
      <a href="#" data-toggle="tooltip" data-placement="left" title="Change background image" class="plus_icon">+</a>
      </div>-->
        
     <div class="content margin30 top30 text-left">
         <div class="profile img-polaroid"> <?php
            if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$fetch_profile['username']?>&size=bigger" width="119px" alt=""/>
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
             ?></div>
    <div class="clearfix"></div>
    
    <div class="row-fluid">
    	
     <h4 class="margin30"><?=$fetch_profile['fullname']?></h4><!--&nbsp;&nbsp;(<a href="#">10 Followers</a>)-->
       
       <!--<div class="span3"> <a href="#" class="btn btn-info">Follow</a></div>-->
     <p>UX Researcher at Facebook. Formerly of @hugeinc in Brooklyn and @npr in DC. Vermont native. Thoughts are mine alone.</p>
     <a href="#myModal" data-toggle="modal" class="btn btn-success"><i class="icon-white icon-edit"></i> New Report</a>
     
    </div>
    </div>
    
<div class="clearfix"></div>
   
    
   
    
  </div>
  <div class="wrapper">
    <div class="wrapper_inner"> 
      <!-- <h2 class="zero_margin">Design/UX</h2>
        <hr/>-->
      
      <div class="row-fluid  margin50">
        <div class="span11">
          <h1 class="zero_margin">Welcome to Reportedly</h1>
          <h4 class="light_grey">A simple place to read and write things that matter to you and your community.</h4>
          </div>
        <div class="clearfix"></div>
        <p>Reportedly is a new place on the Internet where people share ideas and stories that are longer than a simple tweet and not just meant to share with your friends. It's designed for simple little stories that bring a smile to your face and manifestos that could bring needed change to your community. It's used by everyone from the 8th grade class president, the high school valedictorian, your favorite local journalist, local political figures and even your neighbors. </p>
<p>It's simple, beautiful, collaborative, and it helps you find the right audience for whatever you have to say.</p>
<p>If you're here to read, start on the homepage where you'll find links to our editor's picks of interesting new articles, as well as the most popular pieces among readers right now. If you register and sign in you can leave notes for authors and recommend the pieces you like.
If you're interested in writing, here are three things to know about how reportedly is different:</p>
          
          <h1 class="zero_margin">1. Reportedly is about your words</h1>
          <p>Reportedly is a beautifully simple space for reading and writing. Your words are important and will be treated that way. You can add images to emphasize your point. There is nothing to set up or customize.</p>
<p>When you write on reportedly, you'll know that your words and pictures will look great on all devices; automatically adjust to the latest technology and even get better over time.
Reportedly composing tool is truly what-you-see-is-what-you-get (WYSIWYG) and is simple enough to tell your stories without getting in the way. </p>
	
    <h1>2. Reportedly is collaborative</h1>
	<p>On Reportedly, you're not alone. You can write alone or invite people to collaborate on your report. We believe people create better things together and draw inspiration from others to move forward. Even professional journalists need editors and Reportedly makes it simple for you to invite others to join you. Collaborators can share private notes with you and as the author, you will determine what notes are shown publicly.</p>
    
    <h1>3. Reportedly helps you find your audience</h1>
    <p>Your local community is your audience. We think great ideas can come from anywhere and should compete on their own merits. On Reportedly, you can contribute often or when you get the whim, without the commitment of a blog. And either way, you're publishing into a thriving, vibrant network — not a personal blog, which you alone are responsible for keeping alive.</p>
	<p>Through a combination of community and editorial curation, reports on Reportedly get spread around based on interest and engagement. Reportedly is not about who you are or whom you know, but about what you have to say.</p>
    
    <hr/>
    
    <h1>Why We Built Reportedly</h1>
          <p>We love the idea that everyone's voice should be heard- not just the people with the loudest voices or the largest pulpit. <p>
	<p>We noticed local information being squashed in the middle of funny jokes and cat pictures on Facebook and with Facebook changing their rules often, it is really hard to know who will see your content and when, unless of course you buy their ad products.</p>
	<p>We love Twitter as much as anyone but as simple as 140 characters is to think about, it's not as simple to get a full thought out. We strive to strengthen local reporting by allowing our users to report on anything they wish and create an audience around it.</p>
    
    <h4 class="light_grey">In short, we think that your point of view matters, so we built a better system for sharing them.</h4>
    
    <h1>Join Us</h1>
    
    <p>Reportedly is being built for everyone, but because we're still testing and rolling out new features, creating content is limited right now. 
We plan to open one community at a time to ensure we can share our best practices and learn from local contributors.
To get on the list, please register and sign in with your Twitter account. (We're inviting more people daily.)
Thanks for your interest.</p>
          
      </div>
      
      <!--<div class="row-fluid margin10 hover_text">
             <div class="span2"><a href="#">10 &nbsp; <img src="img/up.png" alt=""></a></div>
             <div class="span2 zero_margin"><a href="#">20 &nbsp; <img src="img/down.png" alt=""></a></div>
             <div class="span2 zero_margin"><a href="#">0 &nbsp; <img src="img/comment2.png" alt=""></a></div>
             
             </div>-->
      
      <!--<div class="row-fluid padding_top15 margin20"> <a href="#" class="btn btn-success  pull-left"><img src="img/check.png" > Recommend</a>
      
     
     <a href="https://twitter.com/share" class="pull-right twitter-share-button" data-via="adisood24"><img src="img/twitterr.png" > Twitter</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> 
      
      </div>-->
      
    </div>
    <!--<div class="row-fluid margin30"> <span class="read_more"><a href="#">More</a></span>
      <hr/>
    </div>-->
  </div>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Write Report</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Headline</label>
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="headline">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Body</label>
    <div class="controls">
      <textarea placeholder="Body"></textarea>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Topic</label>
    <div class="controls">
      <input type="text" id="inputPassword" placeholder="topic">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Location</label>
    <div class="controls">
      <input type="text" id="inputPassword" placeholder="Location">
    </div>
  </div>
  
<!--  <div class="control-group">
    <label class="control-label" for="inputPassword">Give some Evidence</label>
    <div class="controls">
      <input type="file">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Invite Collaborators</label>
    <div class="controls">
      <input type="text" placeholder="Invite Collaborators">
    </div>
  </div>-->
  
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn black_btn">Publish</button>
      <button type="submit" class="btn black_btn">Save</button>
    </div>
  </div>
</form>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
</body>
</html>
