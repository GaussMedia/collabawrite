<?php

session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$table="collections";
$collection_name=  addslashes($_GET['collection']);
$obj=new KARAMJEET();
$fetch_coll=$obj->fetch_one($table,"`collection_name`='".$collection_name."'");
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
//echo '<pre>';
//print_r($fetch_coll);
//die;
//$_POST['collection_id']=$fetch_coll['id'];
if($_SESSION['id'] == ''){
    header('location:signin.php');
}else{
?>
<!DOCTYPE HTML>
<html><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Write Report</title>

<!----------------------- main css and js --------------!---->
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/alertify.core.css" />
<link rel="stylesheet" href="css/alertify.default.css" id="toggleCSS" />
<link href="source/inettuts.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="html/css/custom.css" rel="stylesheet" type="text/css">

<link href="html/css/inettuts.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 

<script>

	$(document).ready(function(){
//		 $(document).mousemove(function(e){
//                                        $('#column4').offset({left:e.pageX,top:e.pageY+20});    
//                                    });
                                        
		 $( "#column4" ).draggable({ containment: "#columns", scroll: false });
		 //$( "#draggable5" ).draggable({ containment: "parent" });
                                    //$("#post").click(function(e){
                                   //$('#status2').html(e.pageX +', '+ e.pageY);
                                    //var pos  = e.pageX + ', '+ e.pageY;
                                    //$('#column4').css({'left': e.pageX-330}).show();    
                                                  //alert(pos);
                              // }); 
		
	});
        
            
//                   $(document).on('click',function(){
//                           $(document).mousemove(function(e){
//                              
//                              //$('#status').html();
//                           }); 
//                 })
        
	
</script>


<script type="text/javascript" src="js/bootstrap.js"></script>

<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>-->
<!-- 
 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 


<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"></script>-->
    



<!--<script src="js/alertify.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>-->
<script type="text/javascript" src="ajaximage/scripts/jquery.form.js"></script>

<!-----------------------/ main css and js --------------!---->
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
		
		.nowbrowse
		{
			
		}
		
    </style>
<script type="text/javascript" src="js/rangy-core.js">
</script>
<script type="text/javascript" src="js/rangy-cssclassapplier.js">
</script>
<script type="text/javascript">
        function gEBI(id) {
            return document.getElementById(id);
        }

        var texth1Applier,texth2Applier,italicYellowBgApplier, boldRedApplier, pinkLinkApplier;

        function toggleItalicYellowBg() {
            italicYellowBgApplier.toggleSelection();
        }

        function toggleBoldRed() {
            boldRedApplier.toggleSelection();
        }

        function togglePinkLink() {
            
            pinkLinkApplier.toggleSelection();
        }
        
        function toggleH1() {
            texth1Applier.toggleSelection();
        }

        window.onload = function() {
            rangy.init();

            // Enable buttons
            var cssClassApplierModule = rangy.modules.CssClassApplier;

            // Next line is pure paranoia: it will only return false if the browser has no support for ranges,
            // selections or TextRanges. Even IE 5 would pass this test.
            if (rangy.supported && cssClassApplierModule && cssClassApplierModule.supported) {
                boldRedApplier = rangy.createCssClassApplier("boldRed");

                italicYellowBgApplier = rangy.createCssClassApplier("italicYellowBg", {
                    tagNames: ["span", "a", "b"]
                });
                //$Url = $('#linktab').val();
                getRandom = 1 + Math.floor(Math.random() * 99999999999999);
                document.getElementById('RandomId').value = getRandom ;
                pinkLinkApplier = rangy.createCssClassApplier("pinkLink", {
                    elementTagName: "a",
                    //elementTagName: "u",
                    elementProperties: {
                        //href: "http://"+$Url,
                        //elementTagName: "u",
                        id:getRandom,
                        title: "Click to follow link"
                    }
                });

                var textbold = gEBI("textbold");
                textbold.disabled = false;
                textbold.ontouchstart = textbold.onmousedown = function() {
                    toggleBoldRed();
                    return false;
                };

                var itext = gEBI("itext");
                itext.disabled = false;
                itext.ontouchstart = itext.onmousedown = function() {
                    toggleItalicYellowBg();
                    return false;
                };
                
//                var hone = gEBI("hone");
//                //hone.disabled = false;
//                hone.ontouchstart = itext.onmousedown = function() {
//                    toggleH1();
//                    return false;
//                };
                
                

                var togglePinkLinkButton = gEBI("togglePinkLinkButton");
                togglePinkLinkButton.disabled = false;
                togglePinkLinkButton.ontouchstart = togglePinkLinkButton.onmousedown = function() {
                    togglePinkLink();
                    return false;
                };
            }
        };
        

  



    </script>

<style>
/* container of the file upload elements and look of the field */
#profile{
    min-height: 115px;
}
/*.file {
	display: inline-block;
	width:100%;
        overflow: hidden;
	position: relative;
	top:50%;
        min-height: 115px;
}*/
/*.file:hover {
    background: rgba(0,0,0,0.3);
}*/
/* style text of the upload field and add an attachment icon */


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

jQuery().ready(function() {
 $.noConflict(true);
     //jQuery('<p>').focus();
//  jQuery('#title').focus(); 
	/* on change, focus or click call function fileName */
	//$('input[type=file]').bind('change focus click', function() {$(this).fileName()});
});
</script>

<script type="text/javascript" >
  // Editor of Post
  
    jQuery(document).ready(function(){
        
     
    var pname = Math.floor(Math.random()*1011321354);
    jQuery('.editor').append('<p name="'+pname+'">Type your post</p>');

        
         jQuery(".comment_position").hide();
            jQuery(document).on('mouseup','.post',function(e){
              var $text = window.getSelection(this);
              if($text!=''){
                  jQuery(".comment_position").show();
                  jQuery(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
                 // $("#pageslide").offset({top:e.pageY});
              }else{
                  if(jQuery(".comment_position").show()){
                jQuery(".comment_position").hide();
                 }
                  //if($text!=''){
                  //jQuery(".comment_position").hide();
                  //}
                  //$(".comment").trigger('click');
              }


           })
        
         jQuery(document).on('click','#subtitle',function(){ 
             jQuery(".comment_position").hide();
         })
         jQuery(document).on('click','#title',function(){ 
             jQuery(".comment_position").hide();
         })
    })
    //======

           
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
//$(document).ready(function(){
    function onFileLoad(e) { 
            //jQuery('.file').show();
             jQuery('#fileUpload').hide();
            jQuery('#spanimg').hide();
            var form=document.getElementById("preview").style.display='block';
            document.getElementById("preview").innerHTML='<img id="resize" src="'+e.target.result +'"/>';
                 
             }                   

            function displayPreview(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad;
                reader.readAsDataURL(files[0]);
            } 
                
                function onFileLoad1(e) { 
              //$(".editor").click(function(e){

                       //var x = e.pageX - this.offsetLeft;
                      // var y = e.pageY - this.offsetTop;
                     // alert(x +', '+ y);
                     //$('#status2').html(x +', '+ y);
                 // });
           $('#columns').show();
           $('#column4').children().show();
            $('.widget-head').html('<img src="'+e.target.result +'"/>');
          // $('.img_hover_box').append('<span>(drag image)</span>');
//               $(".post").next().html('<div contenteditable="false" id="columns">\
//                    \
//                    <div id="column4" class="column">\
//                       <div class="widget">\
//                           <div class="widget-head">\
//                                <img  src="'+e.target.result +'">\
//                            </div>\
//                        </div>\
//                    </div>\
//                    \
//                    <div id="column2" class="column"> </div>\
//                    <div id="column3" class="column"> </div>\
//                </div>');  
          
             } 
            
            function displayPreview1(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad1;
                reader.readAsDataURL(files[0]);
            } 
//})
</script>
<link rel="stylesheet" href="css/alertify.core.css" />
<link rel="stylesheet" href="css/alertify.default.css" id="toggleCSS" />

<script src="js/alertify.min.js"></script>
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
       
           <div class="btns_right_box position_fixed">
    <h4 class="pull-left light_grey" style="margin:10px 0 0 80px;">Contributing</h4>
    	<div class="pull-right btn_box ">
        <a  href="#" role="button" id="bootstrap" class="btn btn-success pull-right custom_margin publish" data-toggle="modal">Publish</a>
          <input type="button" class="btn savedraft pull-right custom_margin" value="Save draft">
          <input type="button" class="btn pull-right cancel custom_margin" value="Cancel">
      <small class="custom_margin pull-right savedraft" style="display:none;">Draft saved</small>
    </div>
    </div>
        
 <form id="imageform" method="post" action="post_upload" onsubmit="return false;" enctype="multipart/form-data" >
    <input type="hidden" id="collection_id" name="collection_id" value="<?=$fetch_coll['id']?>">
    <input type="hidden" id="hidtitle" name="title" value="">
    <input type="hidden" id="RandomId" name="RandomId" value="">
    <input type="hidden" id="hidsubtitle" name="subtitle" value="">
    <input type="hidden" id="hidpost" name="post" value="">
    <input type="hidden" id="hidimagename" name="hidimagename" value="">
    <input type="hidden" id="post_id" name="postid" value="">
    <input type="hidden" name="cover" id="coverPhoto" value="fit">
    <div class="wrapper left_zero margin50">
        
   <div class="width100">

   
            
    
    <div class="well well-small text-center img_small zero_padding margin50" id='profile'>
    
        
    <div class="file">

    <input type="file" id="fileUpload" style="z-index:3;"  onChange="displayPreview(this.files);" name="fileUpload" />
    <span id="spanimg" class="button" style="z-index:2;">Add optional feature image</span>
    <div id='preview'>
        
      </div>
              
    <a href="javascript:void(0);" class="btn btn-large" id="remove"><i class="icon-remove"></i>Remove</a>
    <a href="javascript:void(0);" class="btn btn-large" id="img_upload"><i class="icon-resize-full"></i> Full Width</a>
    <a href="javascript:void(0);" class="btn btn-large" id="img_upload_large"><i class="icon-white icon-resize-small"></i> Fit to text</a>
    
	</div>
    
    <div class="clearfix"></div>
    </div>
            
    <div class="zero_auto span6 paddin_bottom200">
        
    <h4><a href="#"><?=$fetch_coll['collection_name']?></a></h4>
   
    <p contenteditable="true" id='title' class="font50 margin_botm_zero" autofocus>Type your title</p>

    <p contenteditable="true"  id='subtitle' class="margin10 margin_botm_zero font18">Type your subtitle(optional)</p>
    
    <div contenteditable="true" id='post' class="margin10 post margin_botm_zero font14" >
        <div class="post_content">
        <div class="editor">
        </div>
<!--            <div class="img_show">
                <div class="img_hover_box">
                    <span>
                        (drag image)
                    </span>
                    <div class="icon-remove icon-white">
                    </div>
                </div>
            </div>-->
<div id="columns" style="display:none;">
        
        <div id="column4" class="column">
           <div class="widget">  
               <div class="widget-head">
                     <div class="img_show"> 
                    <div class="img_hover_box">
                    	<span>(drag image)</span>
                        <div class="icon-remove icon-white"></div>
                    </div>
                    </div>
                   
                </div>
            </div>
        </div>
        
    </div>
        
        </div>
        </div>
<!--    <div id="columns">
        
        <div id="column4" class="column">
           <div class="widget">  
               <div class="widget-head">
                     <div class="img_show"> 
                     <img src="img/yo.png">
                    <div class="img_hover_box">
                    	<span>(drag image)</span>
                        <div class="icon-remove icon-white"></div>
                    </div>
                    </div>
                   
                </div>
            </div>
        </div>
        
        <div id="column3" class="column"> </div>
        <div id="column4" class="column"> </div>
       
        
        
    </div>-->
   <!--  <div id='preview1'></div> -->
    

    
   <!--
                  <div id="columns" style="display:none;">
                        <div id="column2" class="column">
                           <div class="widget">  
                               <div class="widget-head">
                                     <div class="img_show">
                               <img src="img/yo.png">
                                    <div class="img_hover_box">
                                         <span>
                                             (drag image)
                                         </span>
                                         <div class="icon-remove icon-white">
                                         </div>
                                     </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div id="column3" class="column"> </div>
                        <div id="column4" class="column"> </div>
                   </div>
                  <div class="comment_position" style="display:none;">

       <div class="toggle_comment">
   <div class="text_hide"> 
   <a href="javascript:void(0);"><img id="textbold" src="img/bold.png"></a>
   <a href="javascript:void(0);"><img id="itext" src="img/italic.png"></a>
   <a href="javascript:void(0);"><img id="h1" src="img/h1.png"></a>
   <a href="javascript:void(0);"><img id="h2" src="img/h2.png"></a>
   <a href="javascript:void(0);"><img id="togglePinkLinkButton" class="link_click" src="img/link.png"></a>
    <a href="javascript:void(0);"><img class="addbullet" src="img/ul.png"></a>
     <a href="javascript:void(0);"><img class="addnumlist" src="img/ol.png"></a>

   </div>
   <div class="link" id="editor_link"> 
   <input id="linktab" type="text" placeholder="Link Here"> 
   <a href="javascript:void(0);" class="close"> <img src="img/close.png"></a></div>     
   </div>
   <div class="text-center comment_botm_img"><img src="img/botm.png" alt=""/></div>



   </div>
                -->
      <div class="browse_box nowbrowse">
        <div class="file">
        <input id="fileUpload1" type="file" onChange="displayPreview1(this.files);" name="fileUpload1">
        <span id="spanimg1" class="button" >Add image</span>
        
        </div>
    </div>
                
    <!----- ends editor here---->
  
            </div>
            
	<div class="clearfix"></div>	
    </div>


    </div>
    
 </form>    
        <div class="contenthover">
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
        
        jQuery(document).ready(function() {
                
                 jQuery(document).on('click','.cancel',function(){
                    var id = $('#post_id').val();
                    var conf = confirm('Are you sure to cancel?');
                    if(conf){
                        $.ajax({
                            url: 'cancel_draft.php',
                            type: 'POST',  
                            dataType: 'json',
                            data : {id:id},
                            success: function (res) {
                               window.location.href="http://reportedly.pnf-sites.info/";
                            }
                         });
                    }else{
                        return false;
                    }   
                })
                
//                $(document).on('mouseover','#columns',function(){
//                //$(this).before().find('img').html('<div class="img_show"></div>');
//                var img = $('.widget-head').find('img').attr('src');
//                //alert(img);exit;
//                  $('.widget-head').html('<img src="'+img+'"><div class="img_show"><div class="img_hover_box2">\
//                                         <span>\
//                                             (drag image)\
//                                         </span>\
//                                         <div class="icon-remove icon-white">\
//                                         </div>\
//                                     </div></div>');
//                })
              
//                $(document).on('mouseover','img', function () {
//                    //$(this).next().html('<span>drag image<span>');
//                                     if($('.widget-head').next().find('div').length>0){
//                                       $('.widget-head').next().find('div').html('<span>\
//                                            (drag image)\
//                                        </span>\
//                                         <div class="icon-remove icon-white">\
//                                        </div>');
//                                        }else{
//                                          $('.widget-head').parent().append('<div style="margin-top: -251px;\
//    opacity: 1;\
//    position: relative;\
//    z-index: 99999;">\
//                                         <span>\
//                                            (drag image)\
//                                        </span>\
//                                         <a class="remove" href="#"></a>\
//                                        </div>\
//                                     </div>');
//                                                     }
//                       
//                });
                
                
                // $(document).on('mouseout','img', function () {
                    //alert('jgkjdflkjgldfkljkljfd');exit;
                       // if($(this).next().find('div').length>0){
                      //  $(this).parent().next().remove();
                       // }
                       
             //  });
                
                
                
//                 $(document).on('mouseout','#columns',function(){
//                //$(this).before().find('img').html('<div class="img_show"></div>');
//                  //$(this).after().find('img').html('');
//                  var img = $('.widget-head').find('img').attr('src');
//                  $('.widget-head').html('<img src="'+img+'">');
//                })
                
                $(document).on('keyup' , '#post' ,function(e){
                   //(e.which);exit;
                    if(e.which==13){
                       var numRand = Math.floor(Math.random()*1011321354);
                      $('.editor').find("p:last").attr('name' , numRand);
                       
                    }
                     if(e.which==8){
                         if($(this).find('p').length<1){
                             var numRand = Math.floor(Math.random()*1011321354);
                                 $('.editor').html('<p name="'+numRand+'">Type your post</p>');
                         }
                     }
                     if(e.which==46){
                         if($(this).find('p').length<1){
                             var numRand = Math.floor(Math.random()*1011321354);
                                 $('.editor').html('<p name="'+numRand+'">Type your post</p>');
                         }
                     }
                        
                })
                
                
             
                var defaulttitle = "Type your title";
                var defaultsubtitle = "Type your subtitle(optional)";
                var defaultpost = jQuery('#post').find('p').html();
                // title
                $ron =
                jQuery("#title").blur(function(){
                    if( jQuery(this).html() == "<br>" || jQuery(this).html() == "" ){
                        jQuery(this).html(defaulttitle);
                        jQuery(this).removeClass('diss');
                    }
                });
                // subtitle
                
                jQuery("#subtitle").blur(function(){
                    if( jQuery(this).html() == "<br>" || jQuery(this).html() == "" ){
                        jQuery(this).html(defaultsubtitle);
                        jQuery(this).removeClass('diss');
                    }
                });
                
                jQuery("#post").blur(function(){
                    //alert(jQuery(this).html());
                    if(jQuery(this).find('p').html() == "" || jQuery(this).html() =='Type your post' || jQuery(this).html()== '<br>' || jQuery(this).html()== '<br><br>' || jQuery(this).html()== '<br><br><br>' || jQuery(this).html()== '<br><br><br><br>'|| jQuery(this).html()== '<br><br><br><br><br>'|| jQuery(this).html()== '<br><br><br><br><br>' ) {
                        $('.nowbrowse').show();
                        //var poname = 1+ Math.floor(Math.random());
                       // jQuery('#post').html('<p contenteditable="true" name="'+poname+'">Type your post</p>');
                       // jQuery(this).removeClass('diss');
                    }
                });
                jQuery('#title').keypress(function(){
                    var defaulttitle = "Type your title";
                    if( jQuery(this).html() == defaulttitle){
                        jQuery(this).html('');
                        if($(this).text().length > 10) {
                            alert('jkd');
                            } //else {
                            // Disable submit button
                            //}
                   }
                })
                jQuery('#subtitle').keypress(function(){
                    var defaultsubtitle = "Type your subtitle(optional)";
                    if( jQuery(this).html() == defaultsubtitle){
                        jQuery(this).html('');
                    }
                })
                jQuery('#post').keypress(function(){
                    if( jQuery(this).find('p').html() == "Type your post" ){
                        jQuery(this).find('p').html('');
                        jQuery(this).removeClass('diss');
                    }
                })
                
            });
            
   jQuery(document).on( 'mouseover' ,'#resize1',function(){
           
           //if(jQuery("#preview1").children('img').attr("id")=='resize1'){ 
               // jQuery('#fileUpload1').show();
               // jQuery('#spanimg1').show();
                jQuery('#spanimg1').html('Add image');
              //  jQuery('#img_upload').show();
                jQuery('#remove').show();
          /// }
       });
       
       jQuery(document).on( 'mouseout' ,'#resize1',function(){
         //if(jQuery("#preview1").children('img').attr("id")=='resize1'){  
            //jQuery('#fileUpload1').hide();
            //jQuery('#spanimg1').hide();
            jQuery('#spanimg1').html('Add image');
            //jQuery('#img_upload').hide();
            jQuery('#remove').hide();
        // }
       });
        
        jQuery(document).on( 'mouseover' ,'.file',function(){
           
           if(jQuery("#preview").children('img').attr("id")=='resize'){ 
                jQuery('#fileUpload').show();
                jQuery('#spanimg').show();
                jQuery('#spanimg').html('Replace image');
                jQuery('#img_upload').show();
                jQuery('#remove').show();
           }
       });
       
       jQuery(document).on( 'mouseout' ,'.file',function(){
         if(jQuery("#preview").children('img').attr("id")=='resize'){  
            jQuery('#fileUpload').hide();
            jQuery('#spanimg').hide();
            jQuery('#spanimg').html('Add additional feature image');
            jQuery('#img_upload').hide();
            jQuery('#remove').hide();
         }
       });
       
   

//       jQuery(document).on('submit','#linktab',function(){
//           jQuery('.link').hide();
//           jQuery(".text_hide").show();
//       })
     //=========editor ends=====      
           
//jQuery(document).on('click','.link_click',function(){
//       //alert('hi');
//        var mytext = window.getSelection('#post');
//        
//        var spn = "<a id='addurl' target='_blank' href=''>"+mytext+"</a>";
//        //alert(spn);
//        
//        //return false;
////        
////       var spn = "<a id='addurl' href=''><u>"+mytext+"</u></a>";
////       jQuery("#post").wrapInner(spn);
//       jQuery(".link").show();
//       jQuery('.text_hide').hide();
//  });
  jQuery(document).on('click','.close',function(){
        
        jQuery('.link').hide();
        jQuery(".text_hide").show();
        
  });
  

    </script>
    
    <script>
        
        
jQuery(document).ready(function(){
   var globalTimeout = null;
   
   // Text Editor 
         jQuery(document).on('click','#h1',function(){
         
       var mytext = window.getSelection('#post');
       var spn = jQuery("<span></span>").html(mytext).addClass("comment_h1");
       jQuery(".post").wrapInner(spn);
        if(globalTimeout != null){ clearTimeout(globalTimeout);  
          globalTimeout =setTimeout(queryMe,1000);}
       //jQuery('.post').append('<span class="comment_h1">'+mytext+'</span>');
       //jQuery('.comment_position').hide();  
       });
// text h2
       jQuery(document).on('click','#h2',function(){
       var mytext = window.getSelection('#post');
       var spn = jQuery("<span></span>").html(mytext).addClass("comment_h2");
       jQuery(".post").wrapInner(spn);
        if(globalTimeout != null){ clearTimeout(globalTimeout);  
          globalTimeout =setTimeout(queryMe,1000);}
       });
       //});
       var getRandom;
       jQuery(document).on('click','.link_click',function(){
               jQuery(".link").show();
             jQuery("#linktab").focus();
             jQuery('.text_hide').hide();
        });
        
    
    $('#post').keypress("c",function(e) {
         if( e.shiftKey ){
           //alert("Ctrl+C was pressed!!");///////|| e.shiftKey e.ctrlKey ||
           $('.comment_position').show();
           jQuery(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
         }else{
             $('.comment_position').hide();
         }
    });


        jQuery(document).on('keyup','#linktab',function(e){
            if(e.which=="13"){
                var id = $('#RandomId').val();
                 $url = $('#linktab').val();
                jQuery('#'+id).attr('target' , '_blank');   
                jQuery('#'+id).attr('href' , 'http://'+$url);
                jQuery('.savedraft').show().html('SAVING...');
                
                queryMe();
                //}
//               $('#linktab').hide();
//               $('.close').hide();
//               $('.comment_botm_img').hide();
//               $('.link_click').hide();
               $('.comment_position').hide();
            }
            //alert('control here');
             
             //$('.link_click').show();
            //alert('hdjkshfkjsdhkj');
            //return false;
            //$url = $('#linktab').val();
            //$url = $url.replace('http://' , '');
           //var spn = "<u>"+mytext+"</u>";
        });
        
   
   jQuery('#fileUpload').change(function () {
       jQuery('.savedraft').show().html('SAVING...');
        if(globalTimeout != null) clearTimeout(globalTimeout);  
        globalTimeout =setTimeout(queryMe,1000);
       
//       var myInterval = setTimeout(function () {
//            queryMe(this);
//        },5000);
   });
   
     
function queryMe(){       
        //Title
        
        jQuery("#imageform").attr('onsubmit' , '');
        var title = jQuery('#title').html();
        jQuery('#hidtitle').val(title);
        if(title == 'Type your title')
        {
            jQuery('#hidtitle').val('');
        }
        else
            {
        jQuery('#hidtitle').val(title);
            }
            //Subtitle
        var subtitle = jQuery('#subtitle').html();
        jQuery('#hidsubtitle').val(subtitle);
        if(subtitle == 'Type your subtitle(optional)')
        {
            jQuery('#hidsubtitle').val('');
        }
        else
            {
        jQuery('#hidsubtitle').val(subtitle);
            }
            //Post
        var post = jQuery('#post').html();
        jQuery('#hidpost').val(post);
        if(post == 'Type your post')
        {
            jQuery('#hidpost').val('');
        }
        else
            {
        jQuery('#hidpost').val(post);
            }
        var form = new FormData(jQuery('#imageform')[0]);
        jQuery.ajax({
            url: 'post_upload.php',
            type: 'POST',              
            success: function (res) {
                if(res.id != '')
                {
                    jQuery('#post_id').val(res.id);
                }
                jQuery('.savedraft').show().html('SAVED');
            },
           data: form,
           cache: false,
           contentType: false,
           processData: false
        });   
    }
    
    
jQuery('#title').keyup(function () {
        //clearTimeout(myInterval);
        jQuery(this).removeClass('diss');
        jQuery('.savedraft').show().html('SAVING...');
        
        
        if(globalTimeout != null) clearTimeout(globalTimeout);  
        globalTimeout =setTimeout(queryMe,1000);
        
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//        },5000);
    });    

jQuery('#subtitle').keyup(function () {
        jQuery(this).removeClass('diss');
        jQuery('.savedraft').show().html('SAVING...');
        if(globalTimeout != null) clearTimeout(globalTimeout);  
        globalTimeout =setTimeout(queryMe,1000);
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//	},5000);
    });
  
jQuery('#post').on('keyup',function () {
    jQuery('.comment_postion').hide();
    jQuery(this).removeClass('diss');
    jQuery('.savedraft').show().html('SAVING...');
    if(globalTimeout != null) clearTimeout(globalTimeout);  
    globalTimeout =setTimeout(queryMe,1000);
    
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//        },5000);
    });
    
function imageUpdate(action){ 
             //alert(action);
             //Title
             jQuery('.savedraft').show().html('SAVING...');
        var title = jQuery('#title').html();
        jQuery('#hidtitle').val(title);
        if(title == 'Type your title')
        {
            jQuery('#hidtitle').val('');
        }
        else
            {
        jQuery('#hidtitle').val(title);
            }
            //Subtitle
        var subtitle = jQuery('#subtitle').html();
        jQuery('#hidsubtitle').val(subtitle);
        if(subtitle == 'Type your subtitle(optional)')
        {
            jQuery('#hidsubtitle').val('');
        }
        else
            {
        jQuery('#hidsubtitle').val(subtitle);
            }
            //Post
        var post = jQuery('#post').html();
        jQuery('#hidpost').val(title);
        if(post == 'Type your post')
        {
            jQuery('#hidpost').val('');
        }
        else
            {
        jQuery('#hidpost').val(post);
            }
             if(action == 'remove')
                 {
                 var form = new FormData(jQuery('#imageform')[0]);
                     jQuery.ajax({
                         url: 'image-delete.php',
                         type: 'POST',              
                         success: function (res) {

                             jQuery('.savedraft').show();
                             if(res.id != '')
                                {
                                    jQuery('#post_id').val(res.id);
                                }
                         },
                         data: form,
                         cache: false,
                         contentType: false,
                         processData: false
                     });
                 }
                 else
                 {
                    var form = new FormData(jQuery('#imageform')[0]);
                     jQuery.ajax({
                         url: 'image-update.php',
                         type: 'POST',              
                         success: function (res) {

                             jQuery('.savedraft').show();
                             if(res.id != '')
                                {
                                    jQuery('#post_id').val(res.id);
                                }
                         },
                         data: form,
                         cache: false,
                         contentType: false,
                         processData: false
                     });   
                 }
    } 
    
jQuery(document).on('click','#img_upload',function(){
    //alert('sojgr');
    jQuery(".img_small").removeClass("img_small, margin50").addClass("img_large");
    jQuery("#img_upload_large").show();
    jQuery("#coverPhoto").val("cover");
    jQuery(this).hide();
    jQuery('#fileUpload').show();
    jQuery('#spanimg').show().html('replace image');
    imageUpdate(jQuery('#img_upload').attr('id'));
})
jQuery("#img_upload_large").on('click',function(){
    jQuery(".img_large").removeClass("img_large").addClass("img_small margin50");
    jQuery("#img_upload").show();
    jQuery(this).hide();
    jQuery("#coverPhoto").val("fit");
    jQuery('#fileUpload').show();
    jQuery('#spanimg').show().html('replace image');
    imageUpdate(jQuery("#img_upload_large").attr('id'));
 })
jQuery("#remove").on('click',function(){
    jQuery(".img_large").removeClass("img_large").addClass("img_small margin50");
    jQuery("#preview").html("");
    jQuery(this).hide();
    jQuery("#img_upload_large").hide();
    jQuery("#img_upload").hide();
    jQuery('.file').show();
    jQuery('#fileUpload').show();
    jQuery('#spanimg').show().html('Add optional feature image');
    imageUpdate(jQuery('#remove').attr('id'));
  })
  
 }); 
       
  //Save draft
    $(document).on('click','.savedraft',function(){
        var form = new FormData(jQuery('#imageform')[0]);
        jQuery.ajax({
            url: 'post_upload.php?saveD=save',
            type: 'POST',
            //data : {saveD : "save"}, 
            success: function (res) {
             window.location.href='http://reportedly.pnf-sites.info/drafts.php'
            },
           data: form,
           cache: false,
            contentType: false,
            processData: false
        });
           
})

  //publish draft
    
    $(document).on('click','.publish',function(){
    //alert(jQuery('#title').html());
    
    if(jQuery('#title').html() == 'Type your title' && jQuery('#post').html()=="Type your post")
        {
            alert('To publish your post please fill title and post!');
            return false;
        }
        else{
            var conf=confirm('Are you sure to publish this post?');
    if(conf){
            var form = new FormData(jQuery('#imageform')[0]);
 if(conf){
            var form = new FormData(jQuery('#imageform')[0]);
                     jQuery.ajax({
                         url: 'publish-draft.php',
                         type: 'POST',              
                         success: function (res) {
                             window.location.href="http://reportedly.pnf-sites.info/";
                         },
                         data: form,
                         cache: false,
                         contentType: false,
                         processData: false
                     });
                     
    }

    }
            }
       })
             
	</script>
        
        
        
<script>
   

function deleteCookies(name) {
    //alert('cookiedelete');
    //jQuery.cookie("myDraftId", null);
    document.cookie = name+'="";-1; path=/';
}
</script>
<?php
        
        if(isset($_COOKIE['myDraftId']) and $_COOKIE['myDraftId']!='' and $_COOKIE['myDraftId']!='""'){
        
            ?>
        <script>
            jQuery(document).ready(function(){
     
    jQuery.ajax({
        url: 'post_upload.php',
        type: 'GET',  
        dataType: 'json',
        data : {set : "true"},
        success: function (res) {
        if(res){
            //alert(res.collection_id);
            if(res.image == '')
            {
                jQuery('#preview').hide();
            }
            else{
                jQuery('#hidimagename').val(res.image);
                jQuery('#preview').show();
                jQuery('#preview').html("<img id='resize'>");
                jQuery('#preview').find('img').attr('src' , 'webadmin/upload/posts/original/'+res.image);
        
            }
            if(res.collection_id == '')
            {
                alert('Collection Undefined');
                window.location.href='';
            }
            else
                {
                    jQuery('#collection_id').val(res.collection_id);
                }
            if(res.id != '')
                {
                    jQuery('#post_id').val(res.id);
                }
            if(res.title == '')
                {
                    jQuery('#title').html('Type your title');
                }else{
                     jQuery('#title').html(res.title);
                     jQuery('#post').removeClass('diss');
                     jQuery('#hidtitle').val(res.title);
                }
            if(res.sub_title == '')
                {
                    jQuery('#subtitle').html('Type your subtitle(optional)');
                }else{
                    jQuery('#subtitle').html(res.sub_title);
                     jQuery('#post').removeClass('diss');
                     jQuery('#hidsubtitle').val(res.sub_title);
                }
           if(res.post == '')
                {
                    jQuery('#post').html('Type your post');
                }else{
                    jQuery('#post').removeClass('diss');
                    jQuery('#post').html(res.post);
                    jQuery('#hidpost').val(res.post);
                }
        }else{
            jQuery('#preview').hide();
        }
        }
    });
});






</script>
<?php
        }
        ?>
        
<?php
//unset($_COOKIE['myDraftId']);?>
<script>
    var ulM = false;
    jQuery(document).on('click','.addbullet',function (){
        if(ulM){
            ulM = true;
            $('#post').append("<span></span>");
        }else{
            ulM = false;
            $('#post').append("<ul><li></li></ul>");
        }
        jQuery('.new_list').hide();
       
})
jQuery(document).on('click','.addnumlist',function (){
  jQuery('.new_list').hide();
       $('#post').append("<ol><li></li></ol>");
})
jQuery(document).on('click','.addimage',function (){
   $('#post').append('</p><input type="file">');
//$("input").append('#post');
   // jQuery('#post').append('<div class="file"><input type="file" id="fileUpload"  onChange="displayPreview(this.files);" name="fileUpload" /><span id="spanimg" class="button">Add optional feature image</span><div id="preview"></div>');
    //$('<img src="no-img.jpg">').appendTo("#post");
   //$('#post').append('<input type="file" id="fileUpload"  onChange="displayPreview('+this.files+');" name="fileUpload" />');
  //$('#post').prepend('<img id="theImg" src="tno-img.png" />')
})
//$('.icon-remove').on('','',function(){
//})
</script>

</body>

<script type="text/javascript" src="html/js/jquery-1.2.6.min.js"></script>

<script type="text/javascript" src="html/js/jquery-ui-personalized-1.6rc2.min.js"></script>
<script type="text/javascript" src="html/js/inettuts.js"></script>
</html>
<?php
}
?>
