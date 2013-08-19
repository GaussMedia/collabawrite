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
<link rel="stylesheet" href="css/alertify.core.css" />
<link rel="stylesheet" href="css/alertify.default.css" id="toggleCSS" />

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script src="js/alertify.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="ajaximage/scripts/jquery.form.js"></script>


<script type="text/javascript" src="webadmin/ckeditor/ckeditor.js"></script>
<script src="webadmin/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="webadmin/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />


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
    </style>
<script type="text/javascript" src="js/rangy-core.js"></script>
    <script type="text/javascript" src="js/rangy-cssclassapplier.js"></script>
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
                pinkLinkApplier = rangy.createCssClassApplier("pinkLink", {
                    elementTagName: "a",
                    //elementTagName: "u",
                    elementProperties: {
                        //href: "http://"+$Url,
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

     //jQuery('<p>').focus();
  jQuery('#title').focus(); 
	/* on change, focus or click call function fileName */
	//$('input[type=file]').bind('change focus click', function() {$(this).fileName()});
});
</script>

<script type="text/javascript" >
  // Editor of Post
  
    jQuery(document).ready(function(){
        
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
            //jQuery('.file').show();
            // jQuery('#fileUpload1').hide();
            //jQuery('#spanimg1').hide();
            //var form=document.getElementById("post").style.display='block';
            //document.getElementById("post").innerHTML='<img id="resize1" src="'+e.target.result +'"/>';
            $("#post").append('<img id="resize1" src="'+e.target.result +'"/>');
                 
             } 
                
            function displayPreview1(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad1;
                reader.readAsDataURL(files[0]);
            } 
//})
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
      <li><a onClick="deleteCookies('myDraftId');"  href="index"><i><img onClick="deleteCookies('myDraftId');"  src='img/logo_hover.png'></i > Home</a></li>
      <li><a href="profile"><i class="user_icon">
                  <?php
                  if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img title="<?php echo $fetch_profile['fullname'];?>" class="media-object img-polaroid pading2" src="<?php echo $fetch_profile['image'];?>" alt=""/><!--https://api.twitter.com/1/users/profile_image?screen_name=<?php //echo $fetch_profile['username']?>&size=normal-->
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
      </i> <?php echo $fetch_profile['fullname'];?></a></li>
      <li><a onClick="deleteCookies('myDraftId');"  href="status"><i class="icon-white icon-signal"></i> Stats</a></li>
      <li><a onClick="deleteCookies('myDraftId');"  href="drafts"><i class="icon-white icon-list-alt"></i> Drafts</a></li>
      <li><a onClick="deleteCookies('myDraftId');"  href="settings"><i class="icon-white icon-wrench"></i> Settings</a></li>
      <li><a onClick="deleteCookies('myDraftId');"  href="logout"><i class="icon-white icon-off"></i> Logout </a></li> 
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
          <input type="button" class="btn pull-right custom_margin" value="Cancel">
      <small class="custom_margin pull-right savedraft" style="display:none;">Draft saved</small>
    </div>
    </div>
        
 <form id="imageform" method="post" action="post_upload" enctype="multipart/form-data" >
    <input type="hidden" id="collection_id" name="collection_id" value="<?=$fetch_coll['id']?>">
    <input type="hidden" id="hidtitle" name="title" value="">
    <input type="hidden" id="hidsubtitle" name="subtitle" value="">
    <input type="hidden" id="hidpost" name="post" value="">
    <input type="hidden" id="hidimagename" name="hidimagename" value="">
    <input type="hidden" id="post_id" name="postid" value="">
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
            
    <div class="zero_auto span6 paddin_bottom200">
        
    <h4><a href="#"><?=$fetch_coll['collection_name']?></a></h4>
   
    <p contenteditable="true" id='title' class="font50 margin_botm_zero">Type your title</p>
    <em> </em>
    <strong> </strong>
    
    <p contenteditable="true"  id='subtitle' class="diss margin10 margin_botm_zero font18">Type your subtitle(optional)</p>
    
    
    
    <p contenteditable="true" id='editor2' class="diss margin10 post margin_botm_zero font14" >Type your post
    <div id='preview1'>
        
      </div>
    </p>
    <script type="text/javascript">
		//<![CDATA[
		
		//CKEDITOR.replace( 'editor1',
                		CKEDITOR.replace( 'editor2',
                                {toolbar : [ {name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ]},
                                        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] }, 
                                        { name: 'clipboard', items : [ 'Cut','Copy','-','Undo','Redo' ] },
                                        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                                        { name: 'colors', items : [ 'TextColor','BGColor' ] } ]});
		//{
				// filebrowserBrowseUrl : 'browser.php',
				// filebrowserUploadUrl : 'upload.php'

		//});
		
		//]]>
		</script>
    <div class="browse_box">
        <div class="file">
        <input id="fileUpload1" type="file" onChange="displayPreview1(this.files);" name="fileUpload1">
        <span id="spanimg1" class="button">Add image</span>
        
        </div>
    </div>
    
  <!--  <div class="comment_position">
         
             <div class="toggle_comment">
    <div class="text_hide"> 
    <a href="javascript:void(0);"><img id="textbold" src="img/bold.png"></a>
    <a href="javascript:void(0);"><img id="itext" src="img/italic.png"></a>
    <a href="javascript:void(0);"><img id="h1" src="img/h1.png"></a>
    <a href="javascript:void(0);"><img id="h2" src="img/h2.png"></a>
    <a href="javascript:void(0);"><img id="togglePinkLinkButton" class="link_click" src="img/link.png"></a>
    <a href="javascript:void(0);"><img  class="addbullet" src="img/link.png"></a>
    <a href="javascript:void(0);"><img  class="addnumlist" src="img/link.png"></a>
    </div>
             </div>
                 
    <div class="link" id="editor_link"> 
        <input id="linktab" type="text" placeholder="Link Here" value=""> 
    <a href="#" class="close"> <img src="img/close.png"></a></div> 
    
    </div> Editor -->
      
    
    
         <div class="comment_position">

                          <div class="toggle_comment">
                 <div class="text_hide"> 
                 <a href="javascript:void(0);"><img id="textbold" src="img/bold.png"></a>
                 <a href="javascript:void(0);"><img id="itext" src="img/italic.png"></a>
                 <a href="javascript:void(0);"><img id="h1" src="img/h1.png"></a>
                 <a href="javascript:void(0);"><img id="h2" src="img/h2.png"></a>
                 <a href="javascript:void(0);"><img class="link_click" src="img/link.png"></a>
                  <a href="javascript:void(0);"><img class="addbullet" src="img/ul.png"></a>
                   <a href="javascript:void(0);"><img class="addnumlist" src="img/ol.png"></a>
                  
                 </div>
                 <div class="link" id="editor_link"> 
                 <input id="linktab" type="text" placeholder="Link Here"> 
                 <a href="javascript:void(0);" class="close"> <img src="img/close.png"></a></div>     
                 </div>
                 <div class="text-center comment_botm_img"><img src="img/botm.png" alt=""/></div>



                 </div>

         
        
    </div>
    
    <!----- ends editor here---->
    
    
<!--    <input type="text" name="title" value="" class="input_custom margin_botm_zero font50" placeholder="Type your title">
    <input type="text" name="sub_title" value="" class="input_custom margin10 margin_botm_zero font18" placeholder="Type your subtitle (optional)">
    <textarea type="text"  name="post"  class="input_custom margin10 margin_botm_zero font14" placeholder="Type your post"></textarea>
   -->
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
                
                var defaulttitle = "Type your title";
                var defaultsubtitle = "Type your subtitle(optional)";
                var defaultpost = jQuery('#post').html();
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
                    if(jQuery(this).html() == "" || jQuery(this).html() =='Type your post') {
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
           
                    if( jQuery(this).html() == "Type your post"){
                        
                        jQuery(this).html('');
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
       
   
      jQuery(document).on('click','#h1',function(){
         
       var mytext = window.getSelection('#post');
       var spn = jQuery("<span></span>").html(mytext).addClass("comment_h1");
       jQuery(".post").wrapInner(spn);
       //jQuery('.post').append('<span class="comment_h1">'+mytext+'</span>');
       //jQuery('.comment_position').hide();  
       });
// text h2
       jQuery(document).on('click','#h2',function(){
       var mytext = window.getSelection('#post');
       var spn = jQuery("<span></span>").html(mytext).addClass("comment_h2");
       jQuery(".post").wrapInner(spn);
       //jQuery('.post').append('<span class="comment_h2">'+mytext+'</span>');
       //jQuery('.comment_position').hide();  
       });
       //});
       jQuery(document).on('keyup','#linktab',function(e){
           $url = $('#linktab').val();
           $url = $url.replace('http://' , '');
           //var spn = "<u>"+mytext+"</u>";
           //jQuery.wrapInner(spn);
           jQuery('.pinkLink').attr('href' , 'http://'+$url);
           if(e.which == '13'){
            var form = new FormData(jQuery('#imageform')[0]);
            jQuery.ajax({
             url: 'post_upload.php',
             type: 'POST',              
             success: function (res) {
                 if(res.id != '')
                 {
                     jQuery('.link').hide();
                     jQuery(".text_hide").show();
                 }
                 //jQuery('.savedraft').show();
             },
            data: form,
            cache: false,
            contentType: false,
            processData: false
         });   
           }
       })
//       jQuery(document).on('submit','#linktab',function(){
//           jQuery('.link').hide();
//           jQuery(".text_hide").show();
//       })
     //=========editor ends=====      
           
jQuery(document).on('click','.link_click',function(){
       //alert('hi');
//        var mytext = window.getSelection('#post');
//        
//       var spn = "<a id='addurl' href=''><u>"+mytext+"</u></a>";
//       jQuery("#post").wrapInner(spn);
       jQuery(".link").show();
       jQuery('.text_hide').hide();
  });
  jQuery(document).on('click','.close',function(){
        
        jQuery('.link').hide();
        jQuery(".text_hide").show();
        
  });
  

    </script>
    
    <script>
        
        
jQuery(document).ready(function(){
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
                jQuery('.savedraft').show();
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
        
        
        if(globalTimeout != null) clearTimeout(globalTimeout);  
        globalTimeout =setTimeout(queryMe,2000);
        
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//        },5000);
    });    

jQuery('#subtitle').keyup(function () {
        jQuery(this).removeClass('diss');
        
        if(globalTimeout != null) clearTimeout(globalTimeout);  
        globalTimeout =setTimeout(queryMe,2000);
//        var myInterval = setTimeout(function () {
//            queryMe(this);
//	},5000);
    });
  
jQuery('#post').keyup(function () {
    jQuery('.comment_postion').hide();
    jQuery(this).removeClass('diss');
    
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
                     jQuery.ajax({
                         url: 'post_upload.php?saveD=save',
                         type: 'POST',  
                         //data : {saveD : "save"}, 
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
                jQuery('#preview').find('img').attr('src' , 'ajaximage/uploads/'+res.image);
        
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
</script>
</body>
</html>
