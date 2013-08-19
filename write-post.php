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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Write Report</title>

<!----------------------- main css and js --------------!-- -->
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
$('.editor').find('br').remove();
$(document).ready(function(){

    $(document).bind('keyup','.editor',function(e){
        //alert($(this).caret().start);
                        if ( e.shiftKey && (e.which  >= 33 && e.which  <= 40) ){
                          var $text = document.getSelection(this);
                                if($text!=''){
                                    //alert($text);
                                    $(".comment_position").show();
                                    //$(".comment_position").offset({left:-50 ,top:-50});
                                   // $("#pageslide").offset({top:e.pageY});
                                }else{
                                    if($(".comment_position").show()){
                                          $(".comment_position").hide();
                                      }
                                }    
                        }
        });

        // $( "#column4" ).draggable({ containment: "#columns", scroll: false });hdfkgjhdfkjhk

});
        
</script>


<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="ajaximage/scripts/jquery.form.js"></script>

<!-----------------------/ main css and js --------------!---->

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
                getRandom = 1 + Math.floor(Math.random() * 99999999999999);
                document.getElementById('RandomId').value = getRandom ;
                pinkLinkApplier = rangy.createCssClassApplier("pinkLink", {
                    elementTagName: "a",
                    elementProperties: {
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
    })

            var leftPosition;
            var rightPosition;
            var pName;
            
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
                
         $(document).on('click','#fileUpload1',function(e){
                    leftPosition = e.pageX;
                    rightPosition = e.pageY;
                   // alert(e.pageX +',' +e.pageY);
                })

         function onFileLoad1(e) { 
          
                    $('[name='+pName+']').after('<div id="columns" >\
                   \
                    <div id="column2" class="column">\
                    <a contenteditable="false" class="removeonhover" href="javascript:void(0);"></a> \
                       <div class="widget">  \
                           <div class="widget-head">\
                                 <div class="img_show"> \
                                 <img _moz_resizing="false" src="'+e.target.result+'">\
                                    \
                                </div>\
                               \
                            </div>\
                        </div>\
                    </div>\
                    \
                    <div id="column3" class="column">\
                    <a contenteditable="false" class="icon-remove removeonhover" href="javascript:void(0);" ></a> \
                     </div>\
                    <div id="column4" class="column">\
                    <a contenteditable="false" class="icon-remove removeonhover" href="javascript:void(0);" ></a> \
                     </div>\
            \    </div>');
                           
                         //$('#columns').css({'left':leftPosition,'top':rightPosition,'position' : 'inherit'});
                       
          
             } 
            
         function displayPreview1(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad1;
                reader.readAsDataURL(files[0]);
            } 
</script>
<link rel="stylesheet" href="css/alertify.core.css" />
<link rel="stylesheet" href="css/alertify.default.css" id="toggleCSS" />

<script src="js/alertify.min.js"></script>

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
                <!--<input type="button" class="btn pull-right cancel custom_margin" value="Cancel">-->
                <a href="javascript:void(0);" class="btn pull-right delete custom_margin">Delete</a>
            <small class="custom_margin pull-right savedraft" style="display:none;">Draft saved</small>
        </div>
    </div>
        
 <form id="imageform" method="post" action="post_upload" enctype="multipart/form-data" >
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

                <div contenteditable="false" class="browse_box nowbrowse">
                        <div class="file">
                        <input id="fileUpload1" type="file" onChange="displayPreview1(this.files);" name="fileUpload1">
                        <span id="spanimg1" class="button" >Add image</span>

                        </div>
                    </div>

                 <div class="comment_position">
                     <div class="setcenter">
                       <div class="toggle_comment">
                        <div class="text_hide"> 
                            <a href="javascript:void(0);"><img id="textbold" src="img/bold.png"></a>
                            <a href="javascript:void(0);"><img id="itext" src="img/italic.png"></a>
                            <a href="javascript:void(0);"><img id="h1" src="img/h1.png"></a>
                            <a href="javascript:void(0);"><img id="h2" src="img/h2.png"></a>
                            <a href="javascript:void(0);"><img class="addbullet" src="img/ul.png"></a>
                            <a href="javascript:void(0);"><img class="addnumlist" src="img/ol.png"></a>
                            <a href="javascript:void(0);"><img id="togglePinkLinkButton" class="link_click" src="img/link.png"></a>
                        </div>
                   <div class="link" id="editor_link" style="display: none;"> 
                     <input id="linktab" type="text" placeholder="Link Here"> 
                   <a href="javascript:void(0);" class="close"> <img src="img/close.png"></a></div>     
                   </div>
                   <div class="text-center comment_botm_img"><img src="img/botm.png" alt=""/></div>
                     </div> 
                </div>
    
            </div>
    </div>
 <div class="clearfix"></div>

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
                // Text Editor
        $(document).on('click','.delete',function(){
            var id = $('#post_id').val();
            var conf = confirm('Are you sure to delete this post ?');
            if(conf){
                $.ajax({
                    url: 'delete_draft.php',
                    type: 'POST',  
                    dataType: 'json',
                    data : {id:id},
                    success: function (res) {
                       window.location.href = "http://reportedly.pnf-sites.info/drafts.php";
                    }
                 });
            }
            else
            {
            return false
            }
   });
                
         jQuery(document).on('mouseup','.editor',function(e){
              var $text = window.getSelection(this);
              if($text!=''){
                  //alert($text);
                  jQuery(".comment_position").show();
                  jQuery(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
                 // $("#pageslide").offset({top:e.pageY});
              }else{
                  if(jQuery(".comment_position").show()){
                        jQuery(".comment_position").hide();
                    }
              }


           })
        
         jQuery(document).on('click','#subtitle',function(){ 
             jQuery(".comment_position").hide();
         })
         
         jQuery(document).on('click','#title',function(){ 
             jQuery(".comment_position").hide();
         })
                
        jQuery(document).on('mouseover','.editor p',function(e){
                 pName = $(this).attr('name');
                 var arr = $('.editor p').length;
                    //alert(e.pageX+','+e.pageY);
                    if(arr >1){
                        //alert(arr);
                               $('.nowbrowse').show();
                        $('.nowbrowse').css({'top':e.pageY-405});

                    }
         //$('#column4').offset({left:e.pageX,top:e.pageY+20});   
         //$('.nowbrowse').css({'left': e.pageX,'top':e.pageY}).show(); 
     });

        //check if anchor
              var anchorid;
              var anchortext;
              
       $(document).on('mouseup','.editor p',function(e){
                var $text = window.getSelection(this);
                if(e.target.text==$text){
                    anchortext = $("#"+e.target.id).html();
                    anchorid = e.target.id;
                    $(".comment_position").show();
                    //$('a.link_click').removeClass('link_click').addClass('removeanchor');
                    $('.link_click').attr('src','img/1375365192_link_delete.png');
                    $('.link_click').attr('class', function() {
                        return $(this).attr('class').replace('link_click', 'removeanchor');
                    });
                    
                    $(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
                    //$("#"+e.target.id).before($("#"+e.target.id).html());
                    //$("#"+e.target.id).remove();
                }
                else{
                    $(".comment_position").show();
                    $('.removeanchor').attr('src','img/link.png');
                    $('.removeanchor').attr('class', function() {
                        return $(this).attr('class').replace('removeanchor', 'link_click');
                    });
                    
                    $(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
                }
            });
            
      //Remove anchor
            
      $(document).on('click','.removeanchor',function(){
            //alert('karde a remove');
            //alert(anchortext);alert(anchorid);
               $("#"+anchorid).before(anchortext);
               $("#"+anchorid).remove();
               $('.removeanchor').attr('src','img/link.png');
                $('.removeanchor').attr('class', function() {
                    return $(this).attr('class').replace('removeanchor', 'link_click');
                });
                $(".comment_position").hide();
                $('.savedraft').show().html('SAVING...');
                   //$('div.editor').find('br').remove();
                   $(".editor p > br:gt(0)").remove();
                   setTimeout(queryMe,1000);
            })

         // Add ,Remove h1        
       jQuery(document).on('click','#h1',function(){
            if(jQuery('[name='+pName+']').hasClass("comment_h1"))
                {
                  jQuery('[name='+pName+']').removeClass("comment_h1");  
                }else{
                    jQuery('[name='+pName+']').addClass("comment_h1");  
                }
                $('.savedraft').show().html('SAVING...');
                setTimeout(queryMe,1000);
       });
       
       // Add ,Remove h2
       jQuery(document).on('click','#h2',function(){
   
        if(jQuery('[name='+pName+']').hasClass("comment_h2"))
          {
            jQuery('[name='+pName+']').removeClass("comment_h2");  
          }else{
              jQuery('[name='+pName+']').addClass("comment_h2");  
          }
          //setTimeout(queryMe,1000);
          $('.savedraft').show().html('SAVING...');
          queryMe();
       });
       
       // Add unorder list
       var ulM = false;
       jQuery(document).on('click','.addbullet',function (){
        //alert(pName);
        if(ulM){
            ulM = true;
            $('[name='+pName+']').append("<span></span>");
        }else{
            ulM = false;
            $('[name='+pName+']').append("<ul><li></li></ul>");
        }
        jQuery('.new_list').hide();
       
})
   
      // Add number list
      jQuery(document).on('click','.addnumlist',function (){
      jQuery('.new_list').hide();
           $('[name='+pName+']').append("<ol><li></li></ol>");
    })
    
       // add url
       var globalTimeout = null;
       var getRandom;
       jQuery(document).on('click','.link_click',function(){
            var $text = window.getSelection('.editor p');
            if($text != ""){
               jQuery(".link").show();
               jQuery("#linktab").focus();
               jQuery('.text_hide').hide();
           }else{
               alert('Please select text to add link');
           }
        });
   
        jQuery(document).on('keyup','#linktab',function(e){
               if(e.which == "13"){
                   
                   $('.link').hide();
                   $('.text_hide').show();
                   $(".comment_position").hide();
                   var id = $('#RandomId').val();
                   $url = $('#linktab').val();
                   
                   jQuery('#'+id).attr('target' , '_blank');   
                   jQuery('#'+id).attr('href' , 'http://'+$url);
                   jQuery('.savedraft').show().html('SAVING...');
                   $(".editor p > br:gt(0)").remove();
                   queryMe();
                    
               }
           });

       //close link tab
        jQuery(document).on('click','.close',function(){
               jQuery('.link').hide();
               jQuery(".text_hide").show();
         });                            

    //// editor //// editor //// editor //// editor //// editor //// editor //// editor //// editor //// editor ////
</script>

<script>

       jQuery(document).ready(function() {
                 $('.nowbrowse').hide();
               jQuery('.editor').change(function(){
                    $('.savedraft').show().html('SAVING...');
                    setTimeout(queryMe,1000);
                })   
                 
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

             $(document).on('mouseover','.column img', function () {
                    //var ima = this.naturalWidth
                   //alert(ima);
                  //alert($(this).css('height'));  
                  //alert($(this).attr('height',$(this).height())[0]);    
                 $(this).css({'opacity':0.50});
                 $(this).parent().append('<span contenteditable="false" class="hoverspan" style="color:#000;left: 5px;position: absolute;top: 180px;"><strong>(drag image)</strong></span>');
                 //$(this).parent().append('<a contenteditable="false" class="icon-remove removeonhover"></a>');
             });
                 
             $(document).on('click','.removeonhover',function(){
                     $('#columns').remove();
                    //alert($(this).attr(id)); 
                 })
                   
             $(document).on('mouseout','img', function () {
                  $(this).css('opacity',1);
                  $('.hoverspan').remove();
                  //$('.removeonhover').remove();

            });
               //Text editor
             $(document).keyup('.editor',function(e) {
                 
                 switch ( e.keyCode ) {
                            case 13: // Enter
                                    var numRand = Math.floor(Math.random()*1011321354);
                                    $('.editor').find("p:last").attr('name' , numRand);
                                    break;
                            case 8: // Backspace
                                   if($(this).find('p').length<1){
                                        var numRand = Math.floor(Math.random()*10113213545);
                                            $('.editor').html('<p name="'+numRand+'">Type your post</p>');
                                            return false;
                                    }   
                                   break; 
                             case 46: // Delete
                                   if($(this).find('p').length<1){
                                         var numRand = Math.floor(Math.random()*1011321354);
                                             $('.editor').html('<p name="'+numRand+'">Type your post</p>');
                                              return false;
                                     }
                                    break;
                       }//switch off here
                 })



             var defaulttitle = "Type your title";
             var defaultsubtitle = "Type your subtitle(optional)";
             var defaultpost = jQuery('#post').find('p').html();
             // title
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
             //post  
             jQuery("#post").blur(function(){
                 //alert(jQuery(this).html());
                 if(jQuery(this).find('p').html() == "" || jQuery(this).html() =='Type your post' || jQuery(this).html()== '<br>' || jQuery(this).html()== '<br><br>' || jQuery(this).html()== '<br><br><br>' || jQuery(this).html()== '<br><br><br><br>'|| jQuery(this).html()== '<br><br><br><br><br>'|| jQuery(this).html()== '<br><br><br><br><br>' ) {
    //                        $('.nowbrowse').show();
                     //var poname = 1+ Math.floor(Math.random());
                    // jQuery('#post').html('<p contenteditable="true" name="'+poname+'">Type your post</p>');
                    // jQuery(this).removeClass('diss');
                 }
             });
             //title keypress
             jQuery('#title').keypress(function(){
                 var defaulttitle = "Type your title";
                 if( jQuery(this).html() == defaulttitle){
                     jQuery(this).html('');
                    // if($(this).text().length > 10) {
                         //alert('jkd');
                         //} //else {
                         // Disable submit button
                         //}
                }
             })
             //subtitle keypress
             jQuery('#subtitle').keypress(function(){
                 var defaultsubtitle = "Type your subtitle(optional)";
                 if( jQuery(this).html() == defaultsubtitle){
                     jQuery(this).html('');
                 }
             })
             //post keypress
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
       
    </script>
    
<script>
        
        
      jQuery(document).ready(function(){


         jQuery('#fileUpload').change(function () {
               jQuery('.savedraft').show().html('SAVING...');
                if(globalTimeout != null) clearTimeout(globalTimeout);  
                globalTimeout =setTimeout(queryMe,1000);

        //       var myInterval = setTimeout(function () {
        //            queryMe(this);
        //        },5000);
           });
           
            jQuery('#imageform').submit(function () {
               if(jQuery('.link').is(':visible')){
                  $('.link').hide();
                   $('.text_hide').show();
                   $(".comment_position").hide();
                   var id = $('#RandomId').val();
                   $url = $('#linktab').val();
                   
                   jQuery('#'+id).attr('target' , '_blank');   
                   jQuery('#'+id).attr('href' , 'http://'+$url);
                   jQuery('.savedraft').show().html('SAVING...');
                   $(".editor p > br:gt(0)").remove();
                   queryMe();
                   return false;
               }
           });
           


        function queryMe(){       
                //Title

                jQuery("#imageform").attr('onsubmit' , '');
                
                //if($('.link').is(':visible')){
                
                //}
                
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
                var post = jQuery('.editor').html();
                jQuery('#hidpost').val(post);
                if($('.editor p') == 'Type your post')
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
    
    if($('#title').html() == 'Type your title' || $('#title').html() == ' ' || $('#title').html() == '<br>' || $('#title').html() == '  ')
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
                    //jQuery('#post').removeClass('diss');
                    jQuery('.editor').html(res.post);
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


</body>

<script type="text/javascript" src="html/js/jquery-1.2.6.min.js"></script>

<script type="text/javascript" src="html/js/jquery-ui-personalized-1.6rc2.min.js"></script>
<script type="text/javascript" src="html/js/inettuts.js"></script>
</html>
<?php
}
?>
