<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$query = "SELECT * FROM `twitter_users` WHERE id = '$_SESSION[id]'";
$res = mysql_query($query)or die(mysql_error());
$fetch_profile = mysql_fetch_array($res);
$collection_id = $_GET['collection'];
$collec=$obj->fetch_one('collections',"`id`='".$collection_id."'");
//$sql_collec="SELECT * FROM `collections` WHERE id = '$_SESSION[last_collection_id]'  ";
//$re_collec=mysql_query($sql_collec)or die(mysql_error());
//$fetch_collec =  mysql_fetch_array($re_collec);
  
if(empty($_SESSION[id]))
{
    header('location:http://reportedly.pnf-sites.info/signin.php');
}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edit Collection</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="ajaximage/scripts/jquery.form.js"></script>




<!-----------------------/ main css and js --------------!---->

<link href="css/font-awesome.css" rel="stylesheet" type="text/css">

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
function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( email ) ) {
    return false;
  } else {
    return true;
  }
}

$().ready(function() {
     
        
        $(document).on('click','#add',function(){
    var emailaddress = jQuery('#username').val();
    var collection = $('.colid').attr('id');
    if( validateEmail( emailaddress ) ) { 
        $.ajax({
                type: 'get',
                dataType: 'json',
                data : {email:emailaddress,collection:collection},
                url: 'http://reportedly.pnf-sites.info/email-collaborate.php',
                success: function(response){
                 alert(response);   
                }  
                })
        }
    else
        {
    
    $.ajax({
    type: 'get',
    dataType: 'json',
    data : {username:emailaddress,collection:collection},
    url: 'http://reportedly.pnf-sites.info/fetch-collaborate.php',
    success: function(response){

          if(response.oauth_provider == 'twitter'){
              $('#username').val('').focus();
        $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://api.twitter.com/1/users/profile_image?screen_name="+response.username+"&size=normal' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button'  id='"+response.id+"' class='btn pull-right removeinvitee'  value='remove'></div></div>");
        }
        else{
            if(response.oauth_provider == 'facebook'){

            $('#username').val('').focus();
            $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://graph.facebook.com/"+response.username+"/picture?width=48&height=48' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button'  id='"+response.id+"'  class='btn pull-right removeinvitee' value='remove'></div></div>");
            }
            else{
                if(response.oauth_provider == '' || response.oauth_provider == null){
                    if(response.image == ''){
                    $('#username').val('').focus();
                        $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img  width='50' height='50'  class='media-object img-polaroid pading2' src='http://reportedly.pnf-sites.info/webadmin/no-img.jpg' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right  id='"+response.id+"' removeinvitee' value='remove'></div></div>");
                    }
                    else{
                        $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img  width='50' height='50'  class='media-object img-polaroid pading2' src='webadmin/upload/userprofile/original/"+response.image+"' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right removeinvitee'  id='"+response.id+"' value='remove'></div></div>");
                    }
                }
            }
        }
    }
    });
return false;
    }
    });
    
     //$('.file').hide();

    $('#invitecollb').hide();
    $(document).on('click' , '.wellStatic' , function(){
            $('.pictext').attr('value',$(this).find('h6').attr('class'));
            var clicked = $('.pictext').attr('value');
            var ss=$("."+ clicked).html();
            var collec_id = $('.colid').attr('id'); 
            if(ss == "Anyone"){
                $('#invitecollb').hide();
            $(".select_option").css("display" , "none");
            $(this).children(".select_option").css("display" , "block");
            //alert($(this).find('h6').attr('class')+' clicked!');
            $('.pictext').attr('value',$(this).find('h6').attr('class'));
            var clicked = $('.pictext').attr('value');
            var ss=$("."+ clicked).html();
            var collec_id = $('.colid').attr('id');    
            $.ajax({
                    type:'get',
                    dataTyoe:'json',
                    data :{contrbute_type:ss,collection:collec_id},
                    url:'http://reportedly.pnf-sites.info/update-collection.php',  
                    success: function(data){
                        //alert(data);
                          $('#invitecollb').hide();
                    }
                    });
            }
            else{
                $.ajax({
                    type:'get',
                    dataTyoe:'json',
                    data :{contrbute_type:ss,collection:collec_id},
                    url:'http://reportedly.pnf-sites.info/update-collection.php',  
                    success: function(data){
                        //alert(data);
                          $('#invitecollb').show();
                    }
                    });


                    $('#invitecollb').show();
                    $(".select_option").css("display" , "none");
                    $(this).children(".select_option").css("display" , "block");
                    

//Fetch all invitees on collection
                    var collection = $('.colid').attr('id');
                    $.ajax({
                    type:'get',
                    dataType:'json',
                    data:{collecton:collection},
                    url:'http://reportedly.pnf-sites.info/fetch-invitees.php',  
                    success: function(data){
                    $('.invite-user').html('');   
                    //alert(data);
                    $.each(data , function(i , v){
                    // alert(v.fullname);

                     if(v.oauth_provider == 'twitter'){
                          $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://api.twitter.com/1/users/profile_image?screen_name="+v.username+"&size=normal' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' id='"+v.id+"' class='btn pull-right removeinvitee'  value='remove'></div></div>");
                                             }
                                             else{
                                                 if(v.oauth_provider == 'facebook'){
                                                 $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://graph.facebook.com/"+v.username+"/picture?width=48&height=48' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button'  id='"+v.id+"'  class='btn pull-right removeinvitee' value='remove'></div></div>");
                                                 }
                                                 else{
                                                     if(v.oauth_provider == ''){
                                                         if(v.image == ''){
                                                             $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='http://reportedly.pnf-sites.info/webadmin/no-img.jpg' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right removeinvitee'  id='"+v.id+"' value='remove'></div></div>");
                                                         }
                                                         else{
                                                             $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='webadmin/upload/userprofile/original/"+v.image+"' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right removeinvitee'  id='"+v.id+"' value='remove'></div></div>");
                                                         }
                                                     }
                                                 }
                                             }
                                    });


                                    }

                });
                                  // $(".select_option").css("display" , "block");

                                   $('#invitecollb').show();
            }
    

            $(document).on('click' , '.wellStatic' , function(){
            $('#invitecollb').show();
            $(".select_option").css("display" , "none");
            $(this).children(".select_option").css("display" , "block");
            })
    
   });
   
   var $id = $('.colid').attr('id');
    $.ajax({
            type: 'get',
            dataType: 'json',
            data:{'id':$id},
            url: 'http://reportedly.pnf-sites.info/fetch-collec.php',
            success: function(response){
                 //alert(response.id);
                 //$('.file').show();
                 //$('#preview').show();
                 $('.cover_img').css('background-image', 'url(webadmin/upload/collection/original/' + response.image + ')');
                  //$('.font_white').append('<img style="height: 100%;" src="ajaximage/uploads/'+response.image+'">');
                 $('#collection_name').val(response.collection_name);
                 $('#collection').val(response.collection);
                 //alert(response.contribute_type);
                 if(response.contribute_type == 'Anyone')
                  {
                        
                  $(".Anyone").parent().parent().next().css("display" , "block");
                    //$(".select_option").css("display" , "block");
                    //$('.wellStatic').children(".select_option").css("display" , "none");                    
                   }
                   else
                       {
                           $(".Invite").parent().parent().next().css("display" , "block");
                           //Fetch all invitees on collection
                           var collection = $('.colid').attr('id');
                           $.ajax({
                            type:'get',
                            dataType:'json',
                            data:{collecton:collection},
                            url:'http://reportedly.pnf-sites.info/fetch-invitees.php',  
                           success: function(data){
                           $.each(data , function(i , v){
                               //alert(v.username);
                              //alert(v.username);
                            //alert(v.oauth_provider);
                              //alert(v.image); 
                              //if(v.image == ''){
                              if(v.oauth_provider == ' ' || v.oauth_provider == null){
                                   //alert('gjhjkgkjdf');
                                                 if(v.image == ''){
                                                     //alert('Null Image');
                                                     $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img width='50' height='50' class='media-object img-polaroid pading2' src='http://reportedly.pnf-sites.info/no-img.jpg' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right removeinvitee'  id='"+v.id+"' value='remove'></div></div>");
                                                 }
                                                 else{
                                                    // alert('Image');
                                                     $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img  width='50' height='50'  class='media-object img-polaroid pading2' src='webadmin/upload/userprofile/original/"+v.image+"' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right removeinvitee'  id='"+v.id+"' value='remove'></div></div>");
                                                 }
                                   } 
                               else{
                                             if(v.oauth_provider == 'twitter'){
                                     $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://api.twitter.com/1/users/profile_image?screen_name="+v.username+"&size=normal' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' id='"+v.id+"' class='btn pull-right removeinvitee'  value='remove'></div></div>");
                                     }
                                                else{
                                                 if(v.oauth_provider == 'facebook'){
                                         $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://graph.facebook.com/"+v.username+"/picture?width=48&height=48' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+v.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button'  id='"+v.id+"'  class='btn pull-right removeinvitee' value='remove'></div></div>");
                                         }
                                                }
                                              }
                            });
                             
                            
                            }
               
        });
                          // $(".select_option").css("display" , "block");
                    
                           $('#invitecollb').show();
                       }
                     }
                    
            });
    //alert('alert here');
	/* on change, focus or click call function fileName */
	$('input[type=file]').bind('change focus click', function() {$(this).fileName()});
       
    
    //add invitee
//        $('#add').on('click',function(){
//          var username = $('#username').val();
//          var collection = $('.colid').attr('id');
//                $.ajax({
//                    type: 'get',
//                    dataType: 'json',
//                    data : {username:username,collection:collection},
//                    url: 'http://reportedly.pnf-sites.info/fetch-collaborate.php',
//                    success: function(response){
//                        
//                          if(response.oauth_provider == 'twitter'){
//                              $('#username').val('').focus();
//                        $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://api.twitter.com/1/users/profile_image?screen_name="+response.username+"&size=normal' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button'  id='"+response.id+"' class='btn pull-right removeinvitee'  value='remove'></div></div>");
//                        }
//                        else{
//                            if(response.oauth_provider == 'facebook'){
//                                
//                            $('#username').val('').focus();
//                            $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='https://graph.facebook.com/"+response.username+"/picture?width=48&height=48' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button'  id='"+response.id+"'  class='btn pull-right removeinvitee' value='remove'></div></div>");
//                            }
//                            else{
//                                if(response.oauth_provider == ''){
//                                    if(response.image == ''){
//                                       
//                                    $('#username').val('').focus();
//                                        $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='http://reportedly.pnf-sites.info/webadmin/no-img.jpg' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right  id='"+response.id+"' removeinvitee' value='remove'></div></div>");
//                                    }
//                                    else{
//                                        $('.invite-user').append("<div class='clearfix'></div><div><hr/><div class='span9 zero_margin'><div class='media zero_margin'><a class='pull-left' href='#'><img class='media-object img-polaroid pading2' src='ajaximage/uploads/"+response.image+"' alt=''></a><div class='media-body'><p class='zero_margin'><a href='#'><strong>"+response.fullname+"</strong></a></p></div></div></div><div class='span3'><input type='button' class='btn pull-right removeinvitee'  id='"+response.id+"' value='remove'></div></div>");
//                                    }
//                                }
//                            }
//                        }
//                    }
//                       });
//                return false;
//        });
        
        //Remove invitee
        
        $(document).on('click','.removeinvitee',function(){
           $this = $(this);
           var $id = $(this).attr('id');
           var collection = $('.colid').attr('id');
           var conf = confirm('Are you sure to want delete this contributer?');
           //alert($id);
           if(conf)
               {
           $.ajax({
            type: 'get',
            dataType: 'json',
            data:{'id':$id,collection:collection},
            url: 'http://reportedly.pnf-sites.info/remove-invitee.php',
            success: function(response){
                if(response)
                    {
                $this.parent().parent().remove();
                    }
            }
           });
               }
        })
        
        //Delete Collection
        $('.delete_collection').on('click',function(){
           var id=$(this).attr('id');
           var collection = $('.colid').attr('id');
           var conf = confirm('Are you sure you want to delete this collection?');
           if(conf)
               {
           $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data : {id:id},
                    url: 'http://reportedly.pnf-sites.info/delete-collection.php',
                    success: function(resp){
                        if(resp == 'true')
                            {
                                window.location.href="http://reportedly.pnf-sites.info/";
                            }
                    }
           });
           return false;
               }
           
        });
        

            
});
</script>
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
</head>

<body>
    <input type='hidden' id='<?php echo $collection_id; ?>' class='colid'>
<div class="row-fluid">
  <div class="logo_drop_down"> <a class="dropdown-toggle logo" data-toggle="dropdown" href="index.html"><img src="img/logo.png" alt=""/></a>
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
    <form id="imageform" encoding="multipart/form-data" action='edit_post_collection' enctype="multipart/form-data"  method='post' >
        <input type='hidden' name ='collection_id' value='<?php echo $collection_id;?>'>
        <input type='hidden' id='hidcollection_name' value=''>
        <input type='hidden' id='hidcollection' value=''>
        <input name='collection_type' type='hidden' class='pictext' value='<?php echo $collec['contribute_type'];?>'>
  <div class="pepl font_white grey_bg">
      <div class="cover_img"></div>
      <div class="content margin50 top30">
        <div class="content_inner">
      <div class="fetch_collec">
        <div class="file">
          <input type="file" id="fileUpload"  onChange="displayPreview(this.files);" name="fileUpload" />
          <span class="button before"></span>
  
        </div>
                <div id='preview'>
            
                  </div>
      </div>
      <input type="text" id="collection_name"  name="collection_name" value='<?php echo $collec['collection_name'];?>'  class="input_custom margin30 margin_botm_zero font18 font_white" placeholder="Name your collection here">
      <input type="text" id="collection" value='<?php echo $collec['collection'];?>' name="collection" class="input_custom font_white font14" placeholder="Discribe your collection here">
      <small class="light_grey"><em>By <?=$fetch_profile['fullname']?></em> </small>
      <hr/>
      
<!--      <input type="button" id='save' name="submit_collection" class="btn btn-success" value="Save">-->
      <input type='hidden' name='author' value=' <?=$fetch_profile['id']?>'>
      <input id='editcollection' type="button" class="btn btn-success" value="Edit">
<!--      <input type="button" value="Save" class="btn btn-success savecollection" id="savecollection">-->
      

      <?php
      $sql_chk_p = "SELECT * FROM drafts WHERE status = '1' AND collection_id = '$collection_id' ";
      $res_chk_p = mysql_query($sql_chk_p);
      if(mysql_num_rows($res_chk_p)<=0){
      ?>
      <input id='<?php echo $collection_id;?>' type="button" value="Delete" class="btn btn-danger delete_collection" id="" style="margin: 0px 0px 0px 250px;">
      <?php
      }
      ?>
    </div>
    </div>
  </div>
    
  <div class="wrapper">
    <div class="wrapper_inner">
      <div class="row-fluid">
        <hr/>
        
        <h2> Who can Contribute ?</h2>
        <hr/>
        <div class="row-fluid margin20">
          <div class="wellStatic well img-polaroid span6 text-center height200 box_position">
            <div class="box aligncenter">
              <div class="aligncenter icon"> <i class="icon-group icon-circled icon-64 active"></i> </div>
              <div class="text">
                <h6 class='Anyone'>Anyone</h6>
                <p>Anyone can add to this collection and you'll have the ability to remove any content</p>
              </div>
            </div>
            <div class="select_option"><span class="icon-ok"></span></div>
          </div>
          <div class="wellStatic well img-polaroid span6 text-center height200 box_position">
            <div class="box aligncenter">
              <div class="aligncenter icon"> <i class="icon-user icon-circled icon-64 active"></i> </div>
              <div class="text">
                <h6 class='Invite'>Invite only</h6>
                <p>Only you this collection.(You can invite people from the collection's setting once it's created.)</p>
              </div>
            </div>
            <div class="select_option"><span class="icon-ok"></span></div>
            
            
            
          </div>
            
            <div class="clearfix"></div>
          <hr/>
          <div class="clearfix"></div>
          <div id="invitecollb">
         <div class="row-fluid">
          <input id='username' type="text" placeholder="Type a contributor Twitter handle here" class="span9 zero_margin">
          <input type="submit" id='add' value="Add" class="btn btn-success pull-right">
         </div>
         <div class="row-fluid invite-user">
<!--         	<div class="clearfix"></div>
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
    
          <div class="span3"><input type="button" class="btn pull-right" value="remove"></div>-->
         </div>
          
          
        <!--cvbvcbvcb-->
          </div>
        </div>
      </div>
    </div>
  </div>
        
        </form>
</div>
    
<!--<script>$('#example').tooltip(options)</script>-->
</body>
<script type="text/javascript" >
 $(document).ready(function(e) { 

     $("#collection_name").prop('disabled', true);
     $("#collection").prop('disabled', true);
            $('.file').hide();
            $('#fileUpload').hide();
            $('.before').hide();
            var oldcover = $('.cover_img').attr('style');
            
        $(document).on('click','#editcollection', function(){ 
                    $("#collection_name").prop('disabled', false);      
                    $("#collection").prop('disabled', false);
                    $(".delete_collection").hide();
                    $('.file').show();
                    $('#fileUpload').show();
                    $('.before').show();
                    $(".logohide").hide();
                    $('#collection_name').focus();
                    $(".cover_img").css({'border':'2px dotted'});
                    $collection_name = $("#collection_name").val();
                    $collection = $("#collection").val();

                    $("#hidcollection_name").val($collection_name);
                    $("#hidcollection").val($collection);

                    $(this).val('Save');
                    $(this).removeClass('editcollection');
                    $(this).attr('id','savecollection');
                    $(this).addClass('savecollection');
                    $(this).parent().append('<a class="btn m_tnon btn-orange custom_padding m_10 " href="javascript:void(0)" id="canceleditcollection" >Cancel</a>');
                    return false;
       });
       
            $(document).on('click','#canceleditcollection', function(){
                     //$(this).prev().val('Edit');
                     
                     $("#collection_name").prop('disabled', true);      
                     $("#collection").prop('disabled', true);
                     $('.savecollection').attr('value','Edit');
                     $('.savecollection').attr('id','editcollection');
                     $(this).prev().removeClass('savecollection');
                     //$('.editcollection').removeClass('savecollection');
                     $('.delete_collection').show();
                     $(this).prev().addClass('editcollection');
                     //return false;
                     $(this).remove();
                     $('.file').hide();
                     $('#fileUpload').hide();
                     $('.before').hide();
                     $(".cover_img").css({
                         'text-decoration': 'none',
                         'border': 'none',
                          });
//           $va = $(".userProfileName").find('input').val();
//           $(".userProfileName").html($va);
//           $va1 = $(".userProfileLocation").find('input').val();
//           $(".userProfileLocation").html($va1);
//           $("#edituser").show();
//           $('.profile').find('div').hide();
//           var oldcover = $('#hidprofilecover').val();
//           var oldimage = $('#hidprofileimage').val();
//           $('.profile').html('<img src="'+oldimage+'" class="media-object myprofile ">');
           //$('#half_cover').html('<div id="half_cover" style="'+oldcover+'" id="half_cover" class="half_cover imageFormDiv">');
           $('#half_cover').show().attr('style',oldcover);
       });
        
            //$("#imageform").css('border-bottom', 'none');
            
            $(document).on('keyup','#collection_name',function(){
                var name = $(this).val();
                $('#hidcollection_name').val(name);
            })
            
            $(document).on('keyup','#collection',function(){
                var name = $(this).val();
                $('#hidcollection').val(name);
            })
            
            $(document).on('click','#savecollection' ,function(){
                $('.delete_collection').show();
                $("#collection_name").prop('disabled', true);      
                $("#collection").prop('disabled', true);
                $(this).attr('value','Edit');
                $(this).removeClass('savecollection');
                //$(this).next().show();
                $('#canceleditcollection').remove();
                $(this).attr('id','editcollection');
                var name = $('#collection_name').val();
                var des = $('#collection').val();
                var id = $('.colid').attr('id');
                $.ajax({
                           type: "POST",
                           url: 'edit_post_collection.php',
                           data: {collection_name:name,collection:des,collection_id:id},
                           success:  function(res){
                                   //alert(res);
                                   $('.file').hide();
                                   $('#fileUpload').hide();
                                   $('.before').hide();
                                   $(".cover_img").css({
                                     'text-decoration': 'none',
                                     'border': 'none',
                                      });
                                   var newcover = "background:url(webadmin/upload/collection/original/"+res.image+")";
                                   $('#collection_name').val(res.collection_name);
                                   $('#collection').val(res.collection);
                           },
                           dataType: 'json'
                           });
            
        });
       
 });
                
                function onFileLoad(e) { 
                    $(".file").show('');
                    $(".before").show('');
                    $("#fileUpload").show('');
                    fileUploadMe = true;
	
                $('.cover_img').css('background', 'url(' + e.target.result + ')');
                
                $(document).on('click','.savecollection' ,function(){
                    
                     $(this).attr('value','Edit');
                     $(this).removeClass('savecollection');
                     $('canceleditcollection').remove();
                     //$(this).next().show();
                     //$(this).next().next().remove();
                     $(this).attr('id','editcollection');
                    $("#imageform").ajaxForm({
                    //target: '#half_cover',
                         //dataType: 'json',
                         success : function(res){
                             //if(res.Message != ''){
                               //  alert(res.Message);
                            // }else{
                               // return false;
                             //}
                             //alert(res);
//                              var newcover = "background:url(webadmin/upload/collection/original/"+res.image+")";
//                                $('#collection_name').val(res.collection_name);
//                                $('#collection').val(res.collection);
//                                $('.cover_img').attr('style','newcover');
//                             $('.file').hide();
//                             $('#fileUpload').hide();
//                             $('.before').hide();
//                             $(".cover_img").css({
//                               'text-decoration': 'none',
//                               'border': 'none',
//                                });
 
                             
                             //$(".logohide").show();
                             //$("#canceledituser").trigger("click");
                         },
                     }).submit();
            
        });
                
//                      $(document).on('click' ,'.savecollection' ,function(){
//                            $("#collection_name").prop('disabled', true);      
//                            $("#collection").prop('disabled', true);
//                            $("#imageform").ajaxForm({
//                                dataType:'json',
//                                success : function(res){
//                                   // alert(res);
//                                        $('.file').hide();
//                                        $('#fileUpload').hide();
//                                        $('.before').hide();
//                                        $(".cover_img").css({
//                                          'text-decoration': 'none',
//                                          'border': 'none',
//                                           });
//
//                             var newcover = "background:url(webadmin/upload/collection/original/"+res.image+")";
//                             $('#collection_name').val(res.collection_name);
//                             $('#collection').val(res.collection);
//                             ('.cover_img').attr('style','newcover');
//                                 },
//                             }).submit();
//                         }); 
                }
                
                function displayPreview(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad;
                reader.readAsDataURL(files[0]);
            } 
 
</script>
</html>
