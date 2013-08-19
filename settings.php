<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();

$edit_id=$_GET['id'];
$query = "SELECT * FROM `twitter_users` WHERE id = '$edit_id'";
$res = mysql_query($query)or die(mysql_error());
$result = mysql_fetch_array($res);
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION['id']."'");
if($_SESSION['id'] == ''){
    header('location:http://reportedly.pnf-sites.info/signin');
}else{
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Settings</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-----------------------/ main css and js --------------!---->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript">
    
 
    
jQuery(document).ready(function($) {
	initialize();
        $(document).on('focus' , 'input' ,function(){
            $(this).css('border' , '1px solid #CCCCCC');
        })
});
//autocomplete
function initialize() {
	var input = document.getElementById('location');
	var autocomplete = new google.maps.places.Autocomplete(input);
}
</script>

<script>

       
      
       

$(document).ready(function(){
    
    
    $(document).on('click','#deleteaccount',function(){
        var conf = confirm('By doing this you cant access your account any more. Are you sure to Delete?');
        if(conf){
         $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'http://reportedly.pnf-sites.info/delete_account',
                success: function(response){
                    if(response){
                        alert(response);
                        window.location.href='http://reportedly.pnf-sites.info';
                    }
                   }
            });
        }else{
        return false;
        }
    })
    

   function NewLocation(){
      
        var newlocation = $('#changelocation').find('input').val();
            //alert(newlocation);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{'newlocation':newlocation},
                url: 'http://reportedly.pnf-sites.info/change-location',
                success: function(response){
                    //var newlocation = $('#changelocation').find('input').val();
                    $('#save-location').val('Edit');
                    $('#save-location').attr('id','editlocation');
                    $('#cancel-location').remove();
                    $('#changelocation').html('<p>'+response.location+'</p>');
                   }
            });
       }    

        $(document).on('click','#editemail',function(){
          
        $(this).val('Save');
        $(this).attr('id','saveemail');
        $(this).parent().append('<input type="button" id="cancel-email" class="btn btn-large margin30" value="Cancel">');
        $('#cancel-email').show();
        var text = $('#email').html();
         $('#email').attr('contenteditable',"true" );
         $('#email').focus();
     
  
   })
   
   $(document).on('click','#editlocation',function(){
       $(this).val('Save');
       $(this).attr('id','save-location');
       var oldlocation = $('#changelocation').find('p').html();
        $('#changelocation').html('<input id="location" class="span12" type="text" placeholder="Location" value="'+oldlocation+'" name="location" style="border: 1px solid rgb(204, 204, 204);">');
        //$('#changelocation').html('<input type="button" id="save-location" class="btn margin30 black_btn span1" value="Save">');
        $(this).parent().append('<input type="button" id="cancel-location" class="btn btn-large margin30" value="Cancel">');
        initialize();
  })
   
   function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( email ) ) {
      return false;
    } else {
      return true;
    }
  }
   
   $(document).on('click','#saveemail',function(){
        var email = $(this).parent().parent().find('p').html();
        var $this = $(this);
        if( validateEmail( email ) ) { 

        $.ajax({
               type: 'POST',
               dataType: 'json',
               data:{'email':email},
               url: 'http://reportedly.pnf-sites.info/change-email',
               success: function(response){
                   $('#cancel-email').remove();
                   $($this).val('Edit');
                   $($this).attr('id','editemail');
                   alert(response);
                  }
               });
               }else{
                alert('Please enter valid url');
               }
       })
       
//       $(document).on('keyup',"#location",function(){     
//            //alert('ffds');          
//           
//      })
      
      $(document).on('click','#save-location',function(){
          NewLocation();
      })
       
       var oldlocation = $('#changelocation').find('p').html();
       
        $(document).on('click','#cancel-email',function(){
            var email = $('#email').html();
            $('#email').attr('contenteditable',"false" );
            $('#email').html('<p>'+email+'</p>');
            $(this).parent() .children(':first-child').attr("value", 'Edit');
            $(this).parent().children(':first-child').attr('id','editemail');
            $(this).remove();
         })
         
        // var oldlocation = $('#changelocation').find('p').html();
         
    $(document).on('click','#cancel-location',function(){
            $('#changelocation').html('<p>'+oldlocation+'</p>');
            $(this).parent() .children(':first-child').attr("value", 'Edit');
            $(this).parent().children(':first-child').attr('id','editlocation');
            $(this).remove();
            
         })
         
         
         
        })
       
  
   
</script>
<link href="css/bootstrapSwitch.css" rel="stylesheet" type="text/css">


</head>

<body>

<div class="row-fluid">
 
  <div class="logo_drop_down">
    
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="">
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
    
    </div>

  <div class="pepl text-center">
	
    <img class="cover_img" alt="" src="img/setting.png">    
    
    <div class="clearfix"></div>
    
    <div class="content margin30 top30 text-left">
    <div class="row-fluid">
    	
     <h4 class="margin30">Settings</h4><!--&nbsp;&nbsp;(<a href="#">10 Followers</a>)-->
       
       <!--<div class="span3"> <a href="#" class="btn btn-info">Follow</a></div>-->
     <p>Viewing the account settings for User name</p>
     <a href="Twitter_Login/logout.php?logout" class="btn btn-success">Sign out</a>
     
    </div>
    </div>
    
<div class="clearfix"></div>
   
    
   
    
  </div>
  
  <div class="wrapper">
    <div class="wrapper_inner"> 
      <!-- <h4 class="zero_margin">Design/UX</h4>
        <hr/>-->
      
      <div class="row-fluid">
        <div class="span12">
          	<h2 class="zero_margin top_botm_border">Settings</h4>
           
            </div>
         </div>
         
         <div class="row-fluid margin10">
         	<h4 class="span8">Location</h4> 
                <div class="row-fluid">
                    <div id="changelocation" class="span8">
                <p class="span4 margin10"><?=$fetch_profile['location']?></p>
                </div>
                <div class="span4"><input id="editlocation" type="button" class="btn black_btn btn-large margin30" value="Edit"></div>
                    
                    
                </div>
         </div>
              <hr/>
          <div class="row-fluid margin10">
          	<div class="span8">
            <h4>Your email</h4>
            <p id="email"><?php echo $fetch_profile['email'];?></p>
            </div>
            <div class="span4"><input id="editemail" type="button" class="btn black_btn btn-large margin30" value="Edit"></div>
          
          </div>
            <hr/>
          
          <div class="row-fluid margin10">
          <div class="span8">
          <h4>Email notifications</h4>
          <p>When notifications are on, we'll send you an email when there's a new post in your collection and give you updates when your post gets votes.</p>
          </div>
          
          <div class="span4">
          	    <div class="switch margin50" data-on="info" data-off="success">
                	<input type="checkbox" checked />
                </div>
          </div>
          
          </div>
          
            <hr/>
            
            <div class="row-fluid margin10">
	            <div class="span8">
                <h4>Export your content</h4>
                <p>Anything you've created on Reportedly can be exported to a zip file. This includes all text and media.</p>
                </div>
                <div class="span4">
                <input type="button" class="disabled btn btn-large margin30" value="No content to export">
                </div>
            </div>
            
            <hr/>
            
            <div class="row-fluid margin10">
          <div class="span8">
          <h4>Delete your account</h4>
          <p>We'd hate to see you leave before we even get started, but we'll understand and always welcome you back.</p>
          <a id='deleteaccount' href="javascript:void(0);"><u>Delete account</u></a>
          </div>
          </div>
            
            <hr>

<div class="row-fluid font14">
        <div class="span3"><a href="#" class="wrapper-footer-link">Work at Reportedly</a></div>
        <div class="span3"><a href="http://reportedly.pnf-sites.info/privacy_policy?page=privacy_policy" class="wrapper-footer-link">Privacy Policies</a></div>
        <div class="span1"><a href="http://reportedly.pnf-sites.info/privacy_policy?page=why_we_built_reportedly" class="wrapper-footer-link">Help</a></div>
    </div>

          
        <div class="clearfix"></div>
       
          
      </div>
      
      
      
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

<script>
$('#normal-toggle-button').toggleButtons();
</script>

<script src="http://twitter.github.com/bootstrap/assets/js/google-code-prettify/prettify.js"></script>
<script src="js/bootstrapSwitch.js"></script>

</body>
</html>
<?php
}
?>
