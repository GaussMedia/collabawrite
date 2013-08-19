<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$table="twitter_users";
$obj=new KARAMJEET();
$fetch_profile=$obj->fetch_one($table,"`id`='".$_SESSION[id]."'");
//if($_FILES)
//{
//echo '<pre>';
//print_r($_FILES);
//die;
//}




//$query_profile = "SELECT * FROM `twitter_users` WHERE id = '$_SESSION[id]'";
//$res_profile = mysql_query($query_profile)or die(mysql_error());
//$fetch_profile = mysql_fetch_array($res_profile);
//echo '<pre>';
//print_r($fetch_profile);
//die;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Profile</title>
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
 $(document).ready(function() { 
       $('#edituser').on('click', function(){ 
           $("#imageform").show();
           //$(".imageFormDiv").css({'border':'2px dotted'});
           $pr = $(".userProfileName").html();
            $(".userProfileName").html("<input type='text' class=\"input_custom margin_center  t_bold\" value='"+$pr+"'>");
            $prl = $(".userProfileLocation").html();
             $(".userProfileLocation").html("<input type='text'  class=\"input_custom margin_center  addrs\" value='"+$prl+"'>");
             $('.forpost').hide();
           $prD = $(".userProfileDesc").html();
            $(".userProfileDesc").html("<input type='text' class=\"input_custom margin_center  tym\" value='"+$prl+"'>");
           // $(".userProfileDesc").find('textarea').val($prD);
            $(this).parent().append('<a class="btn m_tnon btn-success custom_padding m_10 saveuserprofile " href="javascript:void(0);">Save</a>');
            $(this).parent().append('<a class="btn m_tnon btn-danger custom_padding m_10 " href="javascript:void(0)" id="canceledituser" >Cancel</a>');
            $(this).hide();
            $(".userProfileName").find('input').focus();
       });
       
       $(document).on('click','#canceledituser', function(){
           $("#imageform").hide();
           $(".imageFormDiv").css({'border': ''});
           $va = $(".userProfileName").find('input').val();
           $(".userProfileName").html($va);
           $va1 = $(".userProfileLocation").find('input').val();
           $(".userProfileLocation").html($va1);
           $va2 =  $(".userProfileDesc").find('textarea').val();
           $('.forpost').show();
           $(".userProfileDesc").html($va2);
           $(this).prev().remove();
           $(this).remove();
           $("#edituser").show();
       });
       
       
       $(document).on('click' ,'.saveuserprofile' ,function(){
            var action = $(this).html();
            $va = $(".userProfileName").find('input').val();
            $va1 = $(".userProfileLocation").find('input').val();
            $va2 =  $(".userProfileDesc").find('input+').val();
            $("#profileName").val($va);
            $("#profileLoc").val($va1);
            $("#profileDesc").val($va2);
            //alert(action);
           $("#imageform").ajaxForm({
           //target: '#half_cover',
                success : function(res){
                    alert(res);
                    $("#canceledituser").trigger("click");
                },
            }).submit();

        });
       
       
 });
           function onFileLoad(e) { 
                $("#imageform").hide();
                $('#half_cover').find('img').attr('src' , e.target.result); 
                //$('#half_cover').append('<a href="javascript:void(0);" class="btn btn-success custom_padding m_10 pull-left">Save</a>');
               // $('#half_cover').append('<a href="" class="btn btn-danger custom_padding m_10 pull-right">Cancel</a>');
                
                $(document).on('click' ,'.saveuserprofile' ,function(){
                    var action = $(this).html();
                    $va = $(".userProfileName").find('input').val();
                    $va1 = $(".userProfileLocation").find('input').val();
                    $va2 =  $(".userProfileDesc").find('textarea').val();
                    $("#profileName").val($va);
                    $("#profileLoc").val($va1);
                    $("#profileDesc").val($va2);
                    //alert(action);
                   $("#imageform").ajaxForm({
                   //target: '#half_cover',
                        success : function(res){
                            alert(res);
                            $("#canceledituser").trigger("click");
                        },
                    }).submit();
                        
                });  
                }
                
            function displayPreview(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad;
                reader.readAsDataURL(files[0]);
            } 
//            $(document).ready(function() {
//            $("#half_cover").hover(function(){
//                $("#half_cover");
//            },function(){
//            $("#half_cover").add('<input type="file" onChange="displayPreview(this.files);" class="photoimg" id="fileUpload" name="photoimg" />');
//            }); 
//            });
        //}); 
</script>
<style>

body
{
font-family:arial;
}
.preview
{
width:200px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}
#save
{
background-image:url("img/save-button.png");    
}
#cancel
{
background-image:url("img/cancel-button.png");    
}

</style>
<!-----------------------/ main css and js --------------!---->

<style>
/* container of the file upload elements and look of the field */
.file {
	display: inline-block;
	width:100%;
	position: relative;
	top:50%;
        min-height: 366px;
        
}
/* style text of the upload field and add an attachment icon */
.file .button {
	background:url(img/add_img.png) no-repeat 50% 48%;
	text-indent:10px;
	font-family:Arial, sans-serif;
	font-size:12px;
	color:#555;
	height:300px;
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
.m_10{margin: 10px;}
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
	/* on change, focus or click call function fileName */
	$('input[type=file]').bind('change focus click', function() {$(this).fileName()});
});
</script>

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
      <li><a href="index"><i class="icon-white"> </i>Home</a></li>
      <li><a href="profile"><i class="user_icon">
                  <?php
                  if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img title="<?=$fetch_profile['fullname']?>" class="media-object img-polaroid pading2" src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$fetch_profile['username']?>&size=normal" alt=""/>
            <?php
            }
            else
            {
                if($fetch_profile['oauth_provider']== 'facebook')
                {
            ?>
            <img title="<?=$fetch_profile['fullname']?>" class="media-object img-polaroid pading2" src="https://graph.facebook.com/<?=$fetch_profile['username']?>/picture?width=48&height=48">
            <?php
                }
 else {
     if($fetch_profile['image' == ''])
     ?>
            <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
            <?php
 }
              }
             ?>
              
              </i> <?=$fetch_profile['fullname']?></a></li>
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

      <li><a href="index">Home</a></li>
      <li><a href="signin">Signin</a></li>
      <?php
      }
      ?>
    </ul>
    
    </div>

    <div class="pepl text-center">
     <?php
if(($r == '1'))
{
?>
    <div class="alert alert-success"> <a class="close" data-dismiss="alert">×</a>
      <p>
        <?php
echo "Blog Updated Successfully";
echo '<meta http-equiv="refresh" content="2;url=index.php?mode=edit_blog&blog_id='.base64_encode($edit_id).'" >';
?>
      </p>
    </div>
    <!-- .notify -->
    <?php
}
else{
if((is_array($r))  && ($r != ""))
{
?>
    <div class="alert alert-error"> <a class="close" data-dismiss="alert">×</a>
      <p>
        <?php
foreach($r as $v)
{
	echo $v.'<br>';
}
?>
 </p>
    </div>
    <!-- .notify -->
    <?php
}
}
?>
        <div class="half_cover imageFormDiv" id="half_cover">
          <?php
          //if($fetch_profile['profile_cover'] == "")
          //{
          ?>
         
<!--        <form id="imageform" action="cover_upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="save" value="Save">
            <input type="hidden" id="cancel" value="Cancel">
         <div class="file">
		<input type="file" onChange="displayPreview(this.files);" class="photoimg" id="fileUpload" name="photoimg" />
                <div id='preview'>
                </div>
		<span class="button"></span>
	   </div>
        </form>-->
            <?php
          //}
          //else
          //{
              ?>
            
            <form style="border: 2px dotted; left: 2%;position: absolute;top: 15px; width: 95%; min-height: 366px; display:none;" id="imageform" action="cover_upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="profileName" name="profileName" value="">
            <input type="hidden" id="profileLoc"  name="profileLoc"  value="">
            <input type="hidden" id="profileDesc" name="profileDesc" value="">
         <div class="file">
		<input type="file" onChange="displayPreview(this.files);" class="photoimg" id="fileUpload" name="photoimg" />
                <div id='preview'>
                </div>
		<span class="button"></span>
	   </div>
            <div class="clearfix"></div>
        </form>
            
            
            <img id='yyyyy' style='width:100%; height:100%;' src="ajaximage/uploads/<?=$fetch_profile['profile_cover']?>">
            <?php
         // }
          ?>
    
       </div>
        
        <div class="profile img-polaroid">
<!--                <img src="img/profile_bg.jpg" alt=""/>-->
            <?php
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
             ?>
                </div>
                <div class="clearfix"></div>
                
               <h4 class="margin20 userProfileName" ><?=$fetch_profile['fullname']?></h4>
               <p class="zero_margin font_zise13 userProfileLocation"><?=$fetch_profile['location']?></p>
             
<span class="userProfileDesc">
    <?php
     echo $fetch_profile['description'];
//    if($fetch_profile['description'] == '')
//    {
//        echo 'Describe your profile here';
//    }
//    else
//    {
//        echo $fetch_profile['description'];
//    }
    ?>
</span>
  <br>
   <a href="#myModal" data-toggle="modal" class="forpost btn btn-success custom_padding"><img src="img/new.png" alt=""/></a>
   <a href="javascript:void(0)" id='edituser' class="btn btn-success"><i  class="icon-white icon-edit"></i> Edit Profile</a>
      
          <!--settings.php?id=<?php //$_SESSION['id']?>-->
    </div>
        
    <div class="wrapper">
        
   	<div class="wrapper_inner">
       
       <div class="row-fluid">
       <hr/>
        <span class="zero_margin"><a href="#" class="light_grey">Latest Reports</a></span>
        <span class="zero_margin pull-right"><a href="#" class="light_grey">More</a></span>
        <hr/>
        
        <div class="row-fluid margin20">
                        <div class="span10">
                        <h2 class="zero_margin"><a href="#">When Good Design Isn't Enough</a></h2>
                        <small class="light_grey"> <a href="#" class="light_grey"></a></small>
                        
                        </div> 
                        
                        <div class="clearfix"></div>
                        
          <p class="margin20"><a href="#">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered...</a></p>
                       <!--<hr class="zero_margin"/> -->
                        
                    </div>
                    
       </div>
       
       
       <div class="row-fluid">
       <hr/>
        <span class="zero_margin"><a href="collections.php" class="light_grey">Collections</a></span>
        <span class="zero_margin pull-right"><a href="collections.php" class="light_grey">More</a></span>
        <hr/>
        
          <div class="row-fluid">
<?php
$query_collections = "SELECT * FROM `collections` WHERE status = '1'  ORDER BY id DESC LIMIT 0,3";
$res_query_collections = mysql_query($query_collections)or die(mysql_error());
while($fetchcoll=mysql_fetch_array($res_query_collections))
{
?>
                        <div class="span4 botm_margin20">
                        <div class="location_img"><img src="ajaximage/uploads/<?=$fetchcoll['image']?>" alt=""/>
                        <div class="location_text width89"><a href="#"><p class="zero_margin">UK Education <br/><small>
<?php
$sqk="SELECT * FROM posts WHERE collection_id='".$fetchcoll['id']."'";
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

?>  Posts</small></p></a></div></div>
                        
                        </div>
<!--                        <div class="span4 botm_margin20">
                        <div class="location_img"><img src="img/location.png" alt=""/>
                        <div class="location_text width89"><a href="#"><p class="zero_margin">UK Education <br/><small>20 reports</small></p></a></div></div>
                        
                        </div>
                        <div class="span4 botm_margin20">
                        <div class="location_img"><img src="img/location.png" alt=""/>
                        <div class="location_text width89"><a href="#"><p class="zero_margin">UK Education <br/><small>20 reports</small></p></a></div></div>
                        
                        </div>-->
<?php
}
?>
               </div>
        
        </div>
        
        
        
        
        <div class="row-fluid">
       <hr/>
        <span class="zero_margin"><a href="#" class="light_grey">Recommended by Pierreolivier Carles </a></span>
        <span class="zero_margin pull-right"><a href="#" class="light_grey">More</a></span>
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
        
        	<div class="row-fluid margin30">
    <span class="read_more"><a href="#">More</a></span><hr/>
    </div>
    
        </div>
        
    </div>
    
    
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel" class="text-center">Write Report</h4>
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

<script>//$('#example').tooltip(options)</script>

</body>
</html>
