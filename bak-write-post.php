<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$table="collections";
$collection_name=$_GET['collection'];
$obj=new KARAMJEET();
$fetch_coll=$obj->fetch_one($table,"`collection_name`='".$collection_name."'");
$sessionuser=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");

//$_POST['collection_id']=$fetch_coll['id'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Write Report</title>

<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/alertify.bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/alertify.default.css" rel="stylesheet" type="text/css">


<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="ajaximage/scripts/jquery.form.js"></script>
<!-----------------------/ main css and js --------------!---->




<style>
/* container of the file upload elements and look of the field */
.file {
	display: inline-block;
	width:100%;
	position: relative;
	top:50%;
}
/* style text of the upload field and add an attachment icon */
.file .button {
	background:url(img/add_img.png) no-repeat center;
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
	/* on change, focus or click call function fileName */
	//$('input[type=file]').bind('change focus click', function() {$(this).fileName()});
});
</script>

<script type="text/javascript" >
    //$(document).on('click','','.publish',function(){
       
//             $.ajax({
//			type: 'get',
//			dataType: 'json',
//			data:{'id':$editid},
//			url: 'http://reportedly.pnf-sites.info/fetchpost',
//			success: function(response){
//                            //alert(response.title);
//                            
//                            var $src= "ajaximage/uploads/"+response.image;
//                            //alert(src);
//                            $("#preview").html('<img src='+$src+'>');
//                            $(".posttitle").val(response.title);
//                            $(".postsubtitle").val(response.sub_title);
//                            $(".post").val(response.post);
//                            $("#editid").val(response.id);
//			}
//		});
                //});

           function onFileLoad(e) { 
                $("#fileUpload").hide();
                $("#spanimg").hide();
                $("#preview").html('');
                $("#img_upload").show();
                $("#remove").show();
		$("#preview").html('<img src="ajaximage/loader.gif" alt="Uploading...."/>');
                $('#preview').html('<img src="'+e.target.result +'"/>'); 
                $('#fileUpload').show();
                $("#spanimg").show();
                
               }                   

            function displayPreview(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad;
                reader.readAsDataURL(files[0]);
            } 
//            $(document).ready(function(){
//                $('.publish').click(function(){
//                    var aa=$(this).val();
//                    var vaa=$("#profile").attr('class');
//                    alert(vaa);
//                    $("#imageform").ajaxForm({
//                    success : function(res){
//                       if(res === "Draft Published")
//                       {
//                          alert(res);
//                          window.location.href="http://reportedly.pnf-sites.info/drafts";
//                        }
//                       else
//                           {
//                               alert(res);
//                           }
//                    },
//                   }).submit();
//                
//                });
//            });
</script>
</head>

<body>
	
    <div class="row-fluid">

     <div class="logo_drop_down"> <a class="dropdown-toggle logo" data-toggle="dropdown" href="index.php">
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
      <li><a href="profile">
            <?=$sessionuser['fullname']?></a></li>
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
       
           <div class="btns_right_box position_fixed">
    <h4 class="pull-left light_grey" style="margin:10px 0 0 80px;">Contributing</h4>
    	<div class="pull-right btn_box">
        <a  href="#" role="button" id="bootstrap" class="btn btn-success pull-right custom_margin" data-toggle="modal">Publish</a>
          <input type="button" class="btn pull-right custom_margin" value="Save draft">
          <input type="button" class="btn pull-right custom_margin" value="Cancel">
        <!--<small class="custom_margin pull-right">Draft saved</small>-->
    </div>
    </div>
        
 <form id="imageform" method="post" action="post_upload" enctype="multipart/form-data" >
    <input type="hidden" name="collection_id" value="<?=$fetch_coll['id']?>">
    <input type="hidden" name="cover" id="coverPhoto" value="fit">
    <div class="wrapper left_zero margin50">
        
   	<div class="width100">

   
            
    
    <div class="well well-small text-center img_small zero_padding margin50" id='profile'>
    
        
    <div class="file">
       
		<input type="file" id="fileUpload"  onChange="displayPreview(this.files);"  name="fileUpload" />
		<span id="spanimg" class="button">Add optional feature image</span>
                <div id='preview'>
                    
        
                  </div>
              
    <a href="javascript:void(0);" class="btn btn-large" id="remove"><i class="icon-remove"></i>Remove</a>
    <a href="javascript:void(0);" class="btn btn-large" id="img_upload"><i class="icon-resize-full"></i> Full Width</a>
    <a href="javascript:void(0);" class="btn btn-large" id="img_upload_large"><i class="icon-white icon-resize-small"></i> Fit to text</a>
    
	</div>
    
    <div class="clearfix"></div>
    </div>
            
    <div class="zero_auto span6">
        
    <h4><a href="#"><?=$fetch_coll['collection_name']?></a></h4>
   
    <p contenteditable="true" id='title' class="font50 margin_botm_zero">Type your title</p>
    
    <p contenteditable="true" id='subtitle' class="margin10 margin_botm_zero font18">Type your subtitle (optional)</p>
    
    
    
    <p contenteditable="true" id='post' class="margin10 margin_botm_zero font14">Type your post</p>
    
<!--    <input type="text" name="title" value="" class="input_custom margin_botm_zero font50" placeholder="Type your title">
    <input type="text" name="sub_title" value="" class="input_custom margin10 margin_botm_zero font18" placeholder="Type your subtitle (optional)">
    <textarea type="text"  name="post"  class="input_custom margin10 margin_botm_zero font14" placeholder="Type your post"></textarea>
   -->
            </div>
            
	<div class="clearfix"></div>	
    </div>


    </div>
    
 </form>    <div class="contenthover">
</div>
    
    </div>
    

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 id="myModalLabel" class="text-center">Uh oh!</h4>
</div>
<div class="modal-body">
<p>You haven't written anything yet, so there is nothing to post!</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>	
        
    <script>

$("#img_upload").on('click',function(){
    $(".img_small").removeClass("img_small, margin50").addClass("img_large");
    $("#img_upload_large").show();
    $("#coverPhoto").val("cover");
    $(this).hide();
    $('#fileUpload').show();
    //$('#spanimg').show();
})
$("#img_upload_large").on('click',function(){
    $(".img_large").removeClass("img_large").addClass("img_small margin50");
    $("#img_upload").show();
    $(this).hide();
    $("#coverPhoto").val("fit");
    $('#fileUpload').show();
    //$('#spanimg').show();
 })
$("#remove").on('click',function(){
    $(".img_large").removeClass("img_large").addClass("img_small margin50");
    $("#preview").html("");
    $(this).hide();
    $("#img_upload_large").hide();
    $("#img_upload").hide();
    
    //$('#spanimg').show();
  })
//$(document).ready(function() { 
//	$('#title').focus();
//        var $title = $('#title').html();
//        var $subtitle = $('#subtitle').html();
//        var $post = $('#post').html();
//        var $image_type = $("#coverPhoto").val();
//        $(document).on('click','.publish',function(){
//        alert('title:'+$title+',subtitle'+$subtitle+',Post:'+$post+'image type:'+$image_type);
//        });
//         
//        }); 


</script>

<script>
		"use strict";
		var
		$ = function (id) {
			return document.getElementById(id);
		},
		reset = function () {
			$("toggleCSS").href = "css/alertify.default.css";
			alertify.set({
				labels : {
					ok     : "OK",
					//cancel : "Cancel"
				},
				delay : 5000,
				buttonReverse : false,
				buttonFocus   : "ok"
			});
		};


		// ==============================
		// Custom Themes
		$("bootstrap").onclick = function () {
			reset();
			$("toggleCSS").href = "css/alertify.bootstrap.css";
			alertify.confirm("You haven't written anything yet, so there is nothing to post!", function (e) {
				if (e) {
					alertify.success("You are successfully posted your post");
				} else {
					alertify.error("You've clicked Cancel");
				}
			});
			return false;
		};
	</script>


</body>
</html>
