<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');

$query = "SELECT * FROM `twitter_users` WHERE id = '$_SESSION[id]'";
$res = mysql_query($query)or die(mysql_error());
$fetch_profile = mysql_fetch_array($res);
if(empty($_SESSION[id]))
{
    header('location:http://reportedly.pnf-sites.info/developer/index.php');
}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Create Collection</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="ajaximage/scripts/jquery.form.js"></script>


<script type="text/javascript" >
    var fileUploadMe = false;
 $(document).ready(function() { 
     
      //collection name length
        $("#collection_name").keypress(function(e) {
        if($(this).val().length > 42) {
          // Enable submit button
          //alert(e.which);
           if(e.which == '8' || e.which == '0')
               {
                return true;   
               }
               else{
                   $('#collection_name').attr('title', 'collection name must be of maximum 40 Characters');
                   e.preventDefault(e.type);
               }
          //e.preventDefault(e.type);
        } else {
          // Disable submit button
        }
        });
      //collection length  
        $("#collection").keypress(function(e) {
        if($(this).val().length > 139) {
          // Enable submit button
             if(e.which == '8' || e.which == '0')
               {
                return true;   
               }
               else{
                   $('#collection').attr('title', 'Description must be of maximum 140 Characters');
                   e.preventDefault(e.type);
               } 
          //e.preventDefault(e.type);
        } else {
          // Disable submit button
        }
        });

        $(".select_option:first").show();
         $("#collection_name").focus();
         $("#submit_collection").attr("disabled", "disabled");
	 var collection = $("#collection_name").html();
         if(collection == 'Name your collection here')
             {
                 $("#collection_name").focus();
                 //alert('Please enter collection name');
                 return false;
             }
//             else{
//                 $("#submit_collection").removeAttr("disabled");
//             }
        

            
        }); 
        $(document).on("keyup",'#collection' , function(e) { // text written
           
           $("#submit_collection").attr("disabled" , false);
        });
        
        $(document).on("keyup",'#collection_name' , function(e) { 
           /// $('#collection_name').hide();
           var collection = $("#collection_name").html();
           if(collection == 'Name your collection here')
             {
               $(this).html("");
             }
             else{
                 $(this).html(collection);
             }
        });

           function onFileLoad(e) { 
                
                $(".before").html('');
                $("#preview").html('');
                fileUploadMe = true;
		//$("#preview").append('<img src="ajaximage/loader.gif" alt="Uploading...."/>');
                $('.font_white').find('img').remove();
                $('.font_white').append('<img style="height: 100%;" src="'+e.target.result +'"/>'); 
                
                $('.file').show();
                
            }


            function displayPreview(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad;
                reader.readAsDataURL(files[0]);
            } 
            $(document).ready(function(){
               
                $(document).on('click' , '.wellStatic' , function(){
                    $(".select_option").css("display" , "none");
                    $(this).children(".select_option").css("display" , "block");
                    //alert($(this).find('h6').attr('class')+' clicked!');
                    $('.pictext').attr('value',$(this).find('h6').attr('class'));
                    var clicked = $('.pictext').attr('value');
                    var ss=$("."+ clicked).html();
                    //alert(ss);
                });
              $(document).on('click','#submit_collection',function(){
                 
                 var collection = $("#collection_name").val();
                
                 if(fileUploadMe){
                 }else{
                     alert("Please upload image");
                     return false;
                 }
                 if(collection == 'Name your collection here')
                  {
                           alert("Please enter Collection name");
                           $("#collection_name").focus();
                            return false;   
                  }
                  
                if(collection != 'Name your collection here')
                {
                   var array = collection.split(' ');
                    if(array[1]){
                        
                    }else{
                        alert("Please enter atleast two words for collection name");
                        return false;
                    }
                 }
                  
                  
                 
                   $("#imageform").ajaxForm({
                    success : function(response){
//                        if(response == "false")
//                            {
//                                alert(response);
//                            }
//                            else{
//                                window.location.href="http://reportedly.pnf-sites.info/edit-collection.php?collection="+response;
//                            }
                        if(response != '')
                        {
                            //alert(response);
                            window.location.href="http://reportedly.pnf-sites.info/edit-collection.php?collection="+response;
                       }
                       else
                           {
                               alert(response);
                               return false; 
                           }
                    },
                   }).submit();
         //  });
           return false;
//                   success : function(res){
//                                $(".well").html(res);
//                            },
//                            }).submit();
                      
                });
            });
</script>

<!-----------------------/ main css and js --------------!---->

<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<style>
/* container of the file upload elements and look of the field */
.file {
	display: inline-block;
	width:105px;
	position: relative;
	top:50%;
}
/* style text of the upload field and add an attachment icon */
.file .button {
	background:url(img/add_img.png) no-repeat 97% 50%;
	text-indent:10px;
	font-family:Arial, sans-serif;
	font-size:12px;
	color:#555;
	height:85px;
	line-height:40px;
	display: block;
}
/* hide the real file upload input field */
.file input {
	cursor: pointer;
	height: 100%;
	position: absolute;
	right: 0;
	top: 0;
	filter: alpha(opacity=1);
	-moz-opacity: 0.01;
	opacity: 0.01;
	font-size: 100px;
}
</style>
<script type="text/javascript">
/* function to display file name when selected */
$.fn.fileName = function() {
	var $this = $(this),
	$val = $this.val(),
	valArray = $val.split('\\'),
	newVal = valArray[valArray.length-1],
	$button = $this.siblings('.button');
	if(newVal !== '') {
		$button.text(newVal);
  	}
};

$().ready(function() {
    $('#invitecollb').hide();
    //alert('alert here');
	/* on change, focus or click call function fileName */
	$('input[type=file]').bind('change focus click', function() {$(this).fileName()});
});
</script>

</head>

<body>
<div class="row-fluid">
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
    <form id="imageform" encoding="multipart/form-data" action="post_collection.php" enctype="multipart/form-data"  method='post' >
        <input name='collection_type' type='hidden' class='pictext' value='Anyone'>
  <div class="pepl font_white grey_bg">
    <div class="content margin50 top30">
        <div class="content_inner">
      <div class="row-fluid text-center">
        <div class="file">
          <input type="file" id="fileUpload"  onChange="displayPreview(this.files);" name="fileUpload" />
          <span class="button before"></span>
        <div id='preview'>
                  </div>
        </div>
      </div>
<!--        <div id="collection_name" data-default-value="" class="margin30 default-value cover_title" contenteditable="true">
        <p>Name your collection here</p>
        </div>
        <div id="collection" data-default-value=""  class="margin10 default-value color_grey margin_botm_zero font16"  contenteditable="true">
        <p>Describe your collection here</p>
        </div>-->
<input title="Name your collection" type="text" id="collection_name"  name="collection_name"  class="input_custom margin30 margin_botm_zero font18 font_white" placeholder="Name your collection here">
      <input title="Describe your collection" type="text" id="collection" name="collection" class="input_custom font_white font14" placeholder="Describe your collection here">
      <small class="light_grey"><em>By <?=$fetch_profile['fullname']?></em></small>
      <hr/>
      <input type="button" id='submit_collection' name="submit_collection" class="btn btn-success" value="Create">
      <input type='hidden' name='author' value=' <?=$fetch_profile['id']?>'>
      <a href='index'><input id='cancel_collection' type="button" class="btn btn-danger" value="Cancel"></a>
    </div>
    </div>
  </div>
    
  <div class="wrapper">
    <div class="wrapper_inner">
      <div class="row-fluid">
        <hr/>
        <?php

// echo $v.'<br>';
//        $table="collections";
//        $obj=new KARAMJEET();
//        $fetch_coll=$obj->fetch_one($table,"`collection_name`='".$collection_name."'"); 
//        $coll=$fetch_coll['collection_name'];
//        echo "<meta http-equiv='refresh' content='=0;url=write-post.php?collection=$coll' />";
 ?>
        <h2> Who can Contribute ?</h2>
        <hr/>
        <div class="row-fluid margin20">
          <div class="wellStatic well img-polaroid span6 text-center height200 box_position">
            <div class="box aligncenter">
              <div class="aligncenter icon"> <i class="icon-group icon-circled icon-64 active"></i> </div>
              <div class="text">
                <h6 class='Anyone'>Anyone</h6>
                <p class="font16">Anyone can add to this collection and you'll have the ability to remove any content</p>
              </div>
            </div>
            <div class="select_option"><span class="icon-ok"></span></div>
          </div>
          <div class="wellStatic well img-polaroid span6 text-center height200 box_position">
            <div class="box aligncenter">
              <div class="aligncenter icon"> <i class="icon-user icon-circled icon-64 active"></i> </div>
              <div class="text">
                <h6 class='Invite'>Invite only</h6>
                <p class="font16">Only you and those invited by you can add post to this collection.(You can invite people from the collection's setting once it's created.)</p>
              </div>
            </div>
            <div class="select_option"><span class="icon-ok"></span></div>
            
            
            
          </div>
            
            <div class="clearfix"></div>
          <hr/>
          <div class="clearfix"></div>
          <div id="invitecollb">
         <div class="row-fluid">
          <input type="text" placeholder="Type a contributor Twitter handle here" class="span9 zero_margin">
          <input type="button" value="Add" class="btn btn-success pull-right">
         </div>
         <div class="row-fluid">
         	<div class="clearfix"></div>
          	<hr/>
          <div class="span9 zero_margin">
          	<div class="media zero_margin">
    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>
    <div class="media-body">
    <p class="zero_margin"><a href="#"><strong>Johnnie Manzari</strong></a></p>
    </div>
    </div>
    	  </div>
    
          <div class="span3"><input type="button" class="btn pull-right" value="remove"></div>
         </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        
        </form>
</div>
    
<!--<script>$('#example').tooltip(options)</script>-->
</body>
</html>
