<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$table="collections";
$obj=new KARAMJEET();
$query = "SELECT * FROM `twitter_users` WHERE id = '$_SESSION[id]'";
$res   = mysql_query($query)or die(mysql_error());
$fetch_profile = mysql_fetch_array($res);
$getpostid=base64_decode($_GET['post']);
$drafat_id = base64_decode($_GET['post']);
$draft=$obj->fetch_one('drafts',"`id`='".$drafat_id."'");
$author=$obj->fetch_one('twitter_users',"`id`='".$draft['author']."'");
//echo '<pre>';
//print_r($draft);
//die;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Unpublished Draft</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="html/css/custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link href="html/css/inettuts.css" rel="stylesheet" type="text/css" />
<script>


$(document).ready(function(){
    $('.removeonhover').hide();
    $(document).on('click','.editpostid',function(){
        var id = $(this).attr('id');
        window.location.href='http://reportedly.pnf-sites.info/edit_post?post='+id;
        
    })


});
</script>
<style type="text/css">
        *.italicYellowBg {
            font-style: italic;
            /*background-color: yellow;*/
        }

        *.boldRed {
            font-weight: bold;
            /*color: red;*/
        }
        
        *.texth1 {
            p.h1;
            /*color: red;*/
        }

        a.pinkLink {
            color: #f66;
            font-size: 1.2em;
            text-decoration: underline;
        }
       
        .diss{
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
/*            user-select: none;
            -webkit-user-select: none; 
            -moz-user-select: none; 
            -khtml-user-select: none; */
            -ms-user-select: none;
        }
	
        /* container of the file upload elements and look of the field */
#profile{
    min-height: 115px;
}
#post .file input {
	width:75%;
/*        overflow: hidden;
	position: relative;
	top:50%;
        min-height: 115px;*/
}
.nowbrowse
    {
        contentediable : false;
        position: absolute;
        top: -14px;
        left: -21px;
        width:3%;
        
    }
/*.file:hover {
    background: rgba(0,0,0,0.3);
}*/
/* style text of the upload field and add an attachment icon */

   
    
#post{position: relative;}
    
.removeonhover{
                position: absolute;
                right:60px;
                top: 40px;
                z-index: 999999;
                cursor:pointer;
                background: url('img/close2.png') no-repeat;
                width: 30px;
                height:30px;
	}

/*#post .post_content .nowbrowse{
        display: none;
}*/
/*
#post .post_content:hover .nowbrowse{
        display: block;
}*/

#column2 .removeonhover, #column3 .removeonhover, #column4 .removeonhover
{
	display:none;
}

#column2:hover .removeonhover, #column3:hover .removeonhover, #column4:hover .removeonhover
{
	display:block;
}

/*#columns:hover{
    background:rgba(0,0,0,0.8) 
    
        
}*/
    
    
    


    </style>

<script>
   

function deleteCookies(name) {
    //alert('cookiedelete');
    //jQuery.cookie("myDraftId", null);
    document.cookie = name+'="";-1; path=/';
}
</script>

<!-----------------------/ main css and js --------------!---->
<link rel="stylesheet" type="text/css" href="css/jquery.pageslide.css" />

</head>

<body>
    
<div class="row-fluid" id="content">

  <div class="logo_drop_down"> <a class="dropdown-toggle logo" data-toggle="dropdown" href="index.php"><img src="img/logo.png" alt=""/></a>
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
    
    <?php
  if(!empty($_SESSION['id']))
  {
?>
  <div class="btns_right_box position_fixed">
      
    <h4 class="pull-left" style="margin:10px 0 0 80px;">Unpublished Draft <span class="light_grey font_zise13">
        <?php 
        $dif=con_time_stamp($draft['updated_time']);
    echo '(Updated '.$dif.')';?>
        </span></h4>
    <div class="row-fluid">
    	<div class="span4 pull-right">
            <input type='hidden' id="<?=$draft['id']?>" class=''>
            <a id="<?=$draft['id'];?>" onClick="deleteCookies('myDraftId');"  href="javascript:void(0);" class="btn pull-right custom_margin editpostid">Edit</a>
    	
        <a href="#myModal" role="button" class="btn pull-right custom_margin" data-toggle="modal">Invite Collaborators</a>
        
        </div>
    </div>
    </div>
    <?php
  }?>
  
    
     <div class="wrapper left_zero margin50">
            <?php
            if($draft['image_type'] == 'cover')
              {
                ?>
   	<div class="width100">
            
    <div class="well well-small text-center img_large zero_padding" id="profile">
   <img alt="" src="webadmin/upload/posts/original/<?php echo $draft['image'];?>">

    <div class="clearfix"></div>
              </div>
                  <?php }?>
    
      <div class="wrapper_inner top_padding_zero">  
       <div class="row-fluid margin30">
       <div class="span3">   
      <div class="text-center relative post_more_pic_box">
     <div class="custom_padding">
      <div class="profile img-polaroid zero_margin pull-right z_index1"> 
                 <?php
            if($author['oauth_provider'] == 'twitter')
            {
                ?>
            <img title="<?php echo $author['fullname'];?>" class="media-object myprofile " src="<?php echo $author['image'];?>" alt=""/>
            <?php
            }
            else
            {
                if($author['oauth_provider']== 'facebook')
                {
            ?>
            <img title="<?=$author['fullname']?>" class="media-object myprofile " src="https://graph.facebook.com/<?=$author['username']?>/picture?width=200&height=200">
            <?php
                }
 else {
     if($author['image'] == ""){
     ?>
            <img class="media-object myprofile " src="img/user.png" alt="">
            <?php
     }else{
         ?>
          <img class="media-object myprofile" src="webadmin/upload/userprofile/original/<?php echo $author['image'];?>" alt="">
          <?php
     }
 }
              }
             ?>
      </div>
      <div class="clearfix"></div>
      <div class="row-fluid text-right font_zise13">
         <h4 class="margin30"><?=$author['fullname'];?></h4>

      <p><?=$author['description'];?></p>
      
      <hr/>
      <?php
      if($draft['status']   ==  '1'){
          ?>
      <strong>Published</strong><p> <br/> <?php echo date('M d , ',$draft['creation_date']);
      echo date('Y',$draft['creation_date']);?></p>
      <?php
      }
      ?>
      </div>
      </div>
      </div>
      </div>
      
      <div class="span9">
     	<div class="span12">
            
               <?php
               //echo 'jkjl';
               //echo $draft['image_type'];
              if($draft['image_type'] == 'fit')
              {
               ?> 
            <div class="post_img well well-small text-center  img_small
             zero_padding margin50">
          <img alt="" src="webadmin/upload/posts/original/<?php echo $draft['image'];?>">
            </div>
              <?php
              
              }
              ?>
 <!-- <div class="post_img"> <img src="img/post.jpg" alt=""/> </div>-->
          <h2 class="zero_margin"><?=$draft['title']?></h2>
            
          <small class="light_grey">in  <?php
          $collection=$obj->fetch_one('collections',"`id`='".$draft['collection_id']."'");
          echo $collection['collection_name'];
          ?></small> 
          
       
        <div class="clearfix"></div>
         <p class="margin20 relative"><?=$draft['post']?>
          <span><a href="#modal" class="second comment">+</a></span> </p>
         
      </div>
      </div>
      
      </div>
            
	<div class="clearfix"></div>	
    </div>


    </div>
  
  
  
</div>



<div id="modal">
	
    <div class="row-fluid">
    <div class="span2">
    <div class="span12 img-polaroid margin10 pull-left pading2">
<!--        <img src="img/profile_bg.jpg" alt=""/>-->
                <?php
              if($fetch_profile['oauth_provider'] == "twitter")
              {
                  ?>
              
              <img  src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$fetch_profile['username']?>&size=bigger">
          <?php
              }
              
              if($fetch_profile['oauth_provider'] == "facebook")
              {
              ?>
              <img src="https://graph.facebook.com/<?=$fetch_profile['username']?>/picture?type=normal">
              <?php
              }
              if($fetch_profile['oauth_provider'] == "")
              {
                  if($fetch_profile['image'] == "")
                      {
                      ?>
              <img  src="http://reportedly.pnf-sites.info/developer/webadmin/no-img.jpg">
                  <?php
                      }
                     else {
                         ?>
              <img src="http://reportedly.pnf-sites.info/developer/ajaximage/uploads/<?=$fetch_profile['image']?>">
              <?php
                     }
              }
            
              ?>
    </div>			    </div>
    <div class="span10">
     <h4 class="font14"><?=$fetch_profile['fullname']?></h4>
     <form method="post" action="save-note.php" id="savenote">
     <input type="text" name="note" class="input_custom savedtext zero_margin" placeholder="Leave a note">
     <a href="#" class="font_zise13 savenote">Save</a> &nbsp;
     <a href="" class="font_zise13">Cancel</a>
     <hr/>
     </form>
     <p class="font_zise13 light_grey">This note is only visible to you and the author, unless the author chooses to make it public.</p>
    </div>
    
    </div>
  
</div>


<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Invite Collaborators</h4>
  </div>
  <div class="modal-body text-center">
    <p>Get feedback on your post before publishing it by sharing the following link. Anyone with this link will be able to view your unpublished draft and leave notes for you to review. If they leave a note, you'll also have the chance to thank them on your published post.</p>
    <input type="text" value="http://reportedly.pnf-sites.info/unpublish_draft?post=<?php echo $_GET['post'];?>" class="span5">
  </div>
  <div class="modal-footer">
    <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>

<script src="js/jquery.pageslide.min.js"></script> 
<script>
        /* Default pageslide, moves to the right */
        $(".first").pageslide();
        
        /* Slide to the left, and make it model (you'll have to call $.pageslide.close() to close) */
        $(".second").pageslide({ direction: "left", modal: true });
		
		$('.comment').click(function(){
			$(this).addClass('showcomment');
		})
		
    </script>
    <?php
    // Time Function
    function con_time_stamp($session_time) 
{ 
	
	$time_difference = time() - $session_time ; 
	$seconds = $time_difference ; 
	$minutes = round($time_difference / 60 );
	$hours = round($time_difference / 3600 ); 
	$days = round($time_difference / 86400 ); 
	$weeks = round($time_difference / 604800 ); 
	$months = round($time_difference / 2419200 ); 
	$years = round($time_difference / 29030400 ); 
	
	if($seconds <= 60)
	{
	return "$seconds second ago"; 
	}
	else if($minutes <=60)
	{
	if($minutes==1)
	{
	return "1 minute ago"; 
	}
	else
	{
	return "$minutes minutes ago"; 
	}
	}
	else if($hours <=24)
	{
	if($hours==1)
	{
	return "1 hour ago";
	}
	else
	{
	return "$hours hours ago";
	}
	}
	else if($days <=7)
	{
	if($days==1)
	{
	return "1 day ago";
	}
	else
	{
	return "$days days ago";
	}
	
	
	
	}
	else if($weeks <=4)
	{
	if($weeks==1)
	{
	return "1 week ago";
	}
	else
	{
	return "$weeks weeks ago";
	}
	}
	else if($months <=12)
	{
	if($months==1)
	{
	return "1 month ago";
	}
	else
	{
	return "$months months ago";
	}
	
	
	}
	
	else
	{
	if($years==1)
	{
	return "1 year ago";
	}
	else
	{
	return "$years years ago";
	}
	
	
	}
	
	
	
	}
    ?>
</body>
</html>
