<?php

session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$table="collections";
$collection_name=$_GET['collection'];
$obj=new KARAMJEET();
$fetch_coll=$obj->fetch_one($table,"`collection_name`='".$collection_name."'");
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
$postid =  $_GET['post'];

//$_POST['collection_id']=$fetch_coll['id'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edit Report</title>

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
$(document).on('click','.delete',function(){
    var id = $('#del_draft_id').val();
    //alert(id);
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
    $(document).ready(function(){
        jQuery("#title").focus();

        $(".comment_position").hide();
        
        $(document).on('mouseup','.editor',function(e){
              var $text = window.getSelection(this);
              if($text!=''){
                  //alert($text);
                  $(".comment_position").show();
                  $(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
                 // $("#pageslide").offset({top:e.pageY});
              }else{
                  if($(".comment_position").show()){
                        $(".comment_position").hide();
                    }
              }
           })
           
        jQuery(document).on('keypress','.editor p',function(){
               jQuery(".comment_position").hide();
           })
        
         jQuery(document).on('click','#subtitle',function(){ 
             jQuery(".comment_position").hide();
         })
         
         jQuery(document).on('click','#title',function(){ 
             jQuery(".comment_position").hide();
         })

    })
 
    function onFileLoad(e) { 
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
</head>

<body>
<input id="del_draft_id" type="hidden" name="drafat_id" value="<?php echo $_GET['post']; ?>">
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
            <a href="javascript:void(0);" class="btn pull-right delete custom_margin">Delete</a>
            <!--<input type="button" class="btn cancel pull-right custom_margin" value="Cancel">-->
            <small class="custom_margin pull-right savedraft" style="display:none;">SAVED</small>
        </div>
    </div>
        
 <form id="imageform" method="post" action="edit_draft" enctype="multipart/form-data" >
    <input type="hidden" id="collection_id" name="collection_id" value="<?=$fetch_coll['id']?>">
    
    <input type="hidden" id="hidtitle" name="title" value="">
    <input type="hidden" id="hidsubtitle" name="subtitle" value="">
    <input type="hidden" id="hidpost" name="post" value="">
    <input type="hidden" id="hidimagename" name="hidimagename" value="">
    <input type="hidden" id="post_id" name="postid" value="<?php echo $psotids;?>">
    <input type="hidden" name="cover" id="coverPhoto" value="fit">
   
    <div class="wrapper left_zero margin50">
        
   	<div class="width100">

                <div class="well well-small text-center img_small zero_padding margin50" id='profile'>


                 <div class="file">

                 <input type="file" id="fileUpload"  onChange="displayPreview(this.files);" name="fileUpload" />
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
                     <?php
                 $fetch_coll=$obj->fetch_one('collections',"`id`='".$_post['collection_id']."'");
                 ?>
                 <h4><a href="#"><?=$fetch_coll['collection_name']?></a></h4>

                 <p contenteditable="true" id='title' class="font50 margin_botm_zero">Type your title</p>
                 <em> </em>
                 <strong> </strong>

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
                // Text Editor
                
                
//         jQuery(document).on('mouseup','.editor',function(e){
//              var $text = window.getSelection(this);
//              if($text!=''){
//                  //alert($text);
//                  jQuery(".comment_position").show();
//                  jQuery(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
//                 // $("#pageslide").offset({top:e.pageY});
//              }else{
//                  if(jQuery(".comment_position").show()){
//                        jQuery(".comment_position").hide();
//                    }
//              }
//
//
//           })
        
        
        
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
     
     // submit form
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

        //check if anchor
              var anchorid;
              var anchortext;
              
       $(document).on('mouseup','.editor p',function(e){
                var $text = window.getSelection(this);
                if(e.target.text==$text){
                    anchortext = $("#"+e.target.id).html();
                    anchorid = e.target.id;
//                    alert(anchortext);
//                    alert(anchorid);
                    
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
            var $text = document.getSelection('.editor p');
            //alert($text);exit;
//            if($text == ""){
//                 alert('Please select text to add link');
//           }else{
                jQuery(".link").show();
                jQuery("#linktab").focus();
                jQuery('.text_hide').hide();
           //}
        });
        
    
//    $('.editor p').on("keyup",function(e) {
//         if(e.shiftKey ){
//           alert("Ctrl+C was pressed!!");///////|| e.shiftKey e.ctrlKey ||
//           $('.comment_position').show();
//           jQuery(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
//         }else{
//             $('.comment_position').hide();
//         }
//    });


        jQuery(document).on('keyup','#linktab',function(e){
              //alert($('.pinkLink').attr('id'));exit;
                      
              
               if(e.which == "13"){
                   //$('.comment_position').hide();   
                   //$('.comment_botm_img').hide();   
                   //$('#linktab').hide();
                   //$('.link').hide();
                   $('.link').hide();
                   $('.text_hide').show();
                   ///jQuery(".text_hide").show();
                   $(".comment_position").hide();
                   var id = $('#RandomId').val();
                   //jQuery('[name='+pname+']').find('<br>').remove();
                   $url = $('#linktab').val();
                   
                   //alert(id);return false;
                   jQuery('#'+id).attr('target' , '_blank');   
                   jQuery('#'+id).attr('href' , 'http://'+$url);
                   //return false;exit;
                   jQuery('.savedraft').show().html('SAVING...');
                   //$('div.editor').find('br').remove();
                   $(".editor p > br:gt(0)").remove();
                   queryMe();
                   //$('.editor').find('<br>').remove();
                    
               }
           });

       //close link tab
        jQuery(document).on('click','.close',function(){
               jQuery('.link').hide();
               jQuery(".text_hide").show();
         });                            

    //// editor //// editor //// editor //// editor //// editor //// editor //// editor //// editor //// editor ////
    
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
</script>
    
<script>
        jQuery(document).ready(function() {
                jQuery(document).on('click','.cancel',function(){
                    var conf = confirm('Are you sure to cancel changes?');
                    if(conf){
                        window.location.href="http://reportedly.pnf-sites.info/";
                    }else{
                        return false;
                    }
                })
                
                var defaulttitle = "Type your title";
                var defaultsubtitle = "Type your subtitle(optional)";
                var defaultpost = "Type your post";
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
            
                jQuery("#post").blur(function(){
                    
                    if(jQuery(this).html() == "" || jQuery(this).html() =='Type your post' || jQuery(this).html()== '<br>')  {
                        jQuery(this).html(defaultpost);
                        jQuery(this).removeClass('diss');
                    }
                });
                jQuery('#title').keypress(function(){
                    var defaulttitle = "Type your title";
                    if( jQuery(this).html() == defaulttitle){
                        jQuery(this).html('');
                   }
                })
                jQuery('#subtitle').keypress(function(){
                    var defaultsubtitle = "Type your subtitle(optional)";
                    if( jQuery(this).html() == defaultsubtitle){
                        jQuery(this).html('');
                    }
                })
                jQuery('#post').keypress(function(){
                      var defaultpost = "Type your post";
                    if( jQuery(this).html() == defaultpost){
                        jQuery(this).html('');
                        //jQuery(this).removeClass('diss');
                    }
                })
                
            });
        
      
       //});
     //=========editor ends=====      

    
//    $('.editor p').keypress("c",function(e) {
//         if( e.shiftKey ){
//           //alert("Ctrl+C was pressed!!");///////|| e.shiftKey e.ctrlKey ||
//           $('.comment_position').show();
//           jQuery(".comment_position").offset({left:e.pageX-50 ,top:e.pageY-50});
//         }else{
//             $('.comment_position').hide();
//         }
//    });


    </script>
    
<script>
   jQuery(document).ready(function(){
       $('.nowbrowse').hide();
   var globalTimeout = null;
   
   jQuery('#fileUpload').change(function () {
        if(globalTimeout != null) clearTimeout(globalTimeout);  
        globalTimeout =setTimeout(queryMe,2000);
       
//       var myInterval = setTimeout(function () {
//            queryMe(this);
//        },5000);
   });
   
     
function queryMe(){       
        //Title
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
            url: 'edit_draft.php',
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
        globalTimeout =setTimeout(queryMe,2000);
        
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//        },5000);
    });    

jQuery('#subtitle').keyup(function () {
        jQuery(this).removeClass('diss');
        jQuery('.savedraft').show().html('SAVING...');
        if(globalTimeout != null) clearTimeout(globalTimeout);  
        globalTimeout =setTimeout(queryMe,2000);
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//	},5000);
    });
    
jQuery('#post').keyup(function () {
   
    jQuery('.comment_postion').hide();
    jQuery(this).removeClass('diss');
    jQuery('.savedraft').show().html('SAVING...');
    if(globalTimeout != null) clearTimeout(globalTimeout);  
    globalTimeout =setTimeout(queryMe,2000);
    
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//        },5000);
    });
    
function imageUpdate(action){ 
             //alert(action);
             //Title
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
            url: 'edit_draft.php',
            type: 'POST',              
            success: function (res) {
             window.location.href='http://reportedly.pnf-sites.info/drafts.php'
            },
            data: form,
            cache: false,
            contentType: false,
            processData: false
        });
           
})
$(document).on('click','.publish',function(){
    //alert(jQuery('#title').html());
    
    if(jQuery('#title').html() == 'Type your title' && jQuery('#post').html()=="Type your post")
        {
            alert('To publish your post please fill title and post!')
        }
        else{
            var conf=confirm('Are you sure to publish this post?');
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
       })
       
jQuery(document).ready(function(){
   var id = jQuery('#post_id').val();
    jQuery.ajax({
        url: 'edit_draft.php',
        type: 'GET', 
        data : {postid : "<?php echo $_GET[post] ?>"},
        dataType: 'json',
        success: function (res) {
             if(res){
            //alert(res.collection_id);
            if(res.id != '')
            {
               jQuery('#post_id').val(res.id);
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
            if(res.image == '')
            {
                jQuery('#preview').hide();
            }
            else{
                jQuery('#hidimagename').val(res.image);
                jQuery('#preview').show();
                jQuery('#preview').html("<img id='resize'>");
                jQuery('#preview').find('img').attr('src' , 'webadmin/upload/posts/original/'+res.image);
                if(res.image_type == 'cover')
                {
                    jQuery('#profile').removeClass('img_small');
                    jQuery('#profile').addClass('img_large');
                    jQuery('#img_upload').hide();
                    jQuery('#img_upload_large').show();
                    jQuery('#coverPhoto').val(res.image_type);
                }
                else{
                    jQuery('#img_upload').show();
                    jQuery('#img_upload_large').hide();
                    jQuery('#profile').removeClass('img_large');
                    jQuery('#profile').addClass('img_small');
                    jQuery('#coverPhoto').val(res.image_type);
                }   
        
            }
            
            if(res.id != '')
                {
                    jQuery('#post_id').val(res.id);
                }
            if(res.title == '')
                {
                    jQuery('#title').html('Type your title');
                }else{
                    jQuery('#title').html(res.title).focus();
                     jQuery('#post').removeClass('diss');
                }
            if(res.sub_title == '')
                {
                    jQuery('#subtitle').html('Type your subtitle(optional)');
                }else{
                    jQuery('#subtitle').html(res.sub_title);
                     jQuery('#post').removeClass('diss');
                }
           if(res.post == '')
                {
                    var pname = Math.floor(Math.random()*1011321354);
                     jQuery('.editor').append('<p name="'+pname+'">Type your post</p>');
                }else{
                    //jQuery('.editor p').removeClass('diss');
                    jQuery('.editor').html(res.post);
                }
        }else{
            jQuery('#preview').hide();
        }
        }
    })
});


                
	</script>
        
<script>
   

function deleteCookies(name) {
    //alert('cookiedelete');
    //jQuery.cookie("myDraftId", null);
    document.cookie = name+'="";-1; path=/';
}
</script>

<?php
//unset($_COOKIE['myDraftId']);?>
</body>
<script type="text/javascript" src="html/js/jquery-1.2.6.min.js"></script>

<script type="text/javascript" src="html/js/jquery-ui-personalized-1.6rc2.min.js"></script>
<script type="text/javascript" src="html/js/inettuts.js"></script>
</html>
