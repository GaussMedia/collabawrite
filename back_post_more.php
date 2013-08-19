<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$GETpostid=base64_decode($_GET['post']);
$_SESSION['getpostid'] = $getpostid;
$sqlGET = "SELECT * FROM drafts WHERE id='$GETpostid'";
$resGET = mysql_query($sqlGET)or die(mysql_error());
$fetchpost=  mysql_fetch_array($resGET);
//echo '<pre>';
//print_r($fetchpost);
//die;
//$fetchpost=$obj->fetch_one('drafts',"`id`='".$getpostid."'");
$fetchcollection=$obj->fetch_one('collections',"`id`='".$fetchpost['collection_id']."'");
$fetchauthor=$obj->fetch_one('twitter_users',"`id`='".$fetchpost['author']."'");
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION['id']."'");
$fetch_com=mysql_query("SELECT * FROM notes WHERE note_on_post='$GETpostid'" );
$counter_com=  mysql_num_rows($fetch_com);
//echo '<pre>';   
//print_r($fetchpost);
//die;
if(empty($fetchpost)){
    header('location:http://reportedly.pnf-sites.info/error404.php');
}else{

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php 
if($fetchpost['title'] == ''){
    echo 'Untitled';
}else{
echo $fetchpost['title'];
}
?></title>
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
<link href="css/tagmanager.css" rel="stylesheet"/>
<!--<link href="http://welldonethings.com/managed/docs.css" rel="stylesheet"/>-->
<link rel="stylesheet" type="text/css" href="css/jquery.pageslide.css" />

<script>

$(document).on('click','.edit',function(){
    //var $postid=$(this).attr('id');
    //alert($postid);
    $('#content').load("http://reportedly.pnf-sites.info/edit_post");
    
 //window.location.href="http://reportedly.pnf-sites.info/unpublish_draft";
});    
</script>
<style>
    .textcol
    {
        background-color:#ACCD8A;
    }
    /* Mozilla based browsers */
::-moz-selection {
       background-color: #ACCD8A;
       
}

/* Works in Safari */
::selection {
       background-color: #ACCD8A;
       
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
 .tm-tag {
  color: #638421;
  background-color: #cde69c;
  border-color: #a5d24a;
}
    
</style>
<script>
   

//function chklogin(){
//            alert('chal raha hai');
//        }
</script>
<script>
    $(document).ready(function() { 
        
       //$id = $('#sessionuser').val();
       $postid = $('#postid').val();
       $collectionid = $('#collectionid').val();
        //alert($collectionid);
        
        
        
       $('.recommend').on('click', function(){ 
           $postid = $(this).attr('id');
           $sid = $('.sessid').attr('id');
           if($sid == "")
               {
                   alert('Please login to recommend this post');
               }
               else{
          // alert($sid);
         $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{'postid':$postid,'collectionid':$collectionid},
                url: 'http://reportedly.pnf-sites.info/recommend',
                success: function(response){
                    //window.location.href="";
                    if(response==1){
                        $('.recommend').attr('src' , 'img/rec.png');
                    }else{
                        $('.recommend').attr('src' , 'img/rec_active.png');
                    }
                }
		});
               }
       });
    });
    $(document).ready(function() { 
        $postid = $('.postid').attr('id');
       
        $collectionid = $('.colectionid').attr('id');
        $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{'postid':$postid,'collectionid':$collectionid},
                url: 'http://reportedly.pnf-sites.info/add_view_count',
                success: function(response){
                    alert(res);
                }
		});
       //alert($postid+$collectionid);
      $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://reportedly.pnf-sites.info/read_notes',
            data: {'postid':$postid,'collectionid':$collectionid},
            success: function(response){
                        tempId = response.data;
                        //forum = json.forum;
                       //alert(tempId.length)
                    for (var i = 0; i < tempId.length; i++) {
                        var object = tempId[i];
                        //for (property in object) {
                            var key = object['random'];
                            var value = object['note'];
                           // alert(value);
                            $('div#notetext'+i).html('<p class="input_custom zero_margin editableText" >'+value+'</p>');
                            $('div#notetext'+i).attr('name' , key);
                            $('div#notetext'+i).addClass("hoverTextChange");
                       // }
                    }
               //result = jQuery.parseJSON(result);
                        //$('.highlite ').html('p',response.note);
                    // alert(response.note);
                    ///NOT how to print the result and decode in html or php///
                       //alert(response.note); 
                        //$(".highlite").append('<img src='+response.img+'>');
                        //$(".posttitle").val(response.title);
                        //$(".postsubtitle").val(response.sub_title);
                        //$(".post").val(response.post);
                       // $("#editid").val(response.id);
                       
            }
            
         });
    });
    $(document).ready(function(){
        
        $(".comment_position").hide();
        $(document).on('mouseup','p.margin20',function(e){
           var $text = window.getSelection(this);
           if($text!=''){
               $(".comment_position").show();
               $(".comment_position").offset({left:e.pageX-100,top:e.pageY-80});
              // $("#pageslide").offset({top:e.pageY});
           }else{
               
               $(".comment_position").hide();
               //$(".comment").trigger('click');
           }
            
        })
        //$(document).on('click','.row-fluid',function(){
           // if($(".comment_position").show()){
           $(".comment_position").hide();
           // }
         //})
        $(document).on('click','.comment123',function(e){
            $(".comment_position").hide();
            $(".comment").trigger('click');
            $("#pageslide").offset({top:e.pageY-40});
            var range = window.getSelection().getRangeAt(0);
            var selectionContents = range.extractContents();
            var div = document.createElement("span");
            div.style.background = "#ACCD8A";
            randomNum = Math.floor(Math.random()*99999999999999);
            $(".savenote").attr('name' , randomNum);
            div.setAttribute('id', randomNum);
            //setAttribute("name", "submit_content");
            div.appendChild(selectionContents);
            range.insertNode(div);
            //}
        });
        
        $(document).on('click','.comment',function(e){
            //alert('kfglf');
            $("#pageslide").offset({top:e.pageY});
        });
        
//        $(document).on('click','.savenote',function(){
//            alert('jfjkjk');
//        });
        
        $(document).click('.savenote',function(){
            var postid = $('.postid').attr('id');
            alert(postid);
            var $note = $(this).prev().children().html();
            var $text = $('.highlite').html();
            var $randnum = $(this).attr('name');
            //alert($randnum);exit;
            if($note == 'Leave a note')
                {
                    return false;
                }
                else{
                $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{'postid':postid,'note':$note,'text':$text,'randnum':$randnum},
                url: 'http://reportedly.pnf-sites.info/add_note',
                success: function(response){
                    //alert(response.note);
                    $('#notetext').html(response.note);
                    //$('.cancelee').hide();
                    $('.savenote').html('Edit');
                    $('.savenote').attr("id","editnote");
                    //$().html('<a href="javascript:void(0);" class="font_zise13 savenote editee">Edit</a>');
                }
		});
            }
        });
        
    });
  //send post using email
  

</script>    

</head>

<body>
     
<input type="hidden" id="<?php echo $_SESSION['id'];?>" class="sessid">
<input type="hidden" id="<?php echo $fetchpost['collection_id'];?>" class="colectionid">
<input type="hidden" id="<?php echo base64_decode($_GET['post']);?>" class="postid">
<input type="hidden" id="<?php echo $_GET['post'];?>" class="encodepostid">
<input type="hidden" value="<?php //echo $fetch_profile['email'];?>" id="postemail">  
    
<div class="row-fluid" id="content">
  <div class="logo_drop_down"> 
  <a class="dropdown-toggle logo" data-toggle="dropdown" href="index.html"><img src="img/logo.png" alt=""/></a>
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
     if($fetch_profile['image' == ''])
     ?>
            <img class="" src="img/user.png" alt="">
            <?php
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
  if(!empty($_SESSION['id']) and ($_SESSION['id'] == $fetchpost['author']))
  {
?>
  <div class="btns_right_box position_fixed">
    <h4 class="pull-left" style="margin:10px 0 0 80px;">Unpublished Draft <span class="light_grey font_zise13">(Updated 2 hrs ago)</span></h4>
    <div class="row-fluid">
    	<div class="span4 pull-right">
            <input type='hidden' id="<?php echo $fetchpost['id'];?>" class=''>
            <a id="<?php echo $fetchpost['id'];?>" onClick="deleteCookies('myDraftId');"  href="javascript:void(0);" class="btn pull-right custom_margin editpostid">Edit</a>
    	<a href="javascript:void(0);" class="btn pull-right delete custom_margin">Delete</a>
        <a href="#myModal" role="button" class="btn pull-right custom_margin" data-toggle="modal">Invite Collaborators</a>
        
        </div>
    </div>
    </div>
    <?php
  }?>
  

    
  <div class="wrapper left_zero">
      <?php
      
            if($fetchpost['image_type'] == 'cover')
              {
                ?>
      
    <div class="width100">
         <div class="well well-small text-center img_large zero_padding" id="profile">
   <img alt="" src="ajaximage/uploads/<?php echo 
   $fetchpost['image'];?>">

    <div class="clearfix"></div>
              </div>
                  <?php }?>
        
       <div class="wrapper_inner top_padding_zero">  
       <div class="row-fluid margin30">
          
           <div class="span3 <?php if($_SESSION['id'] != '' ){ echo 'margin50'; } ?>">   
      <div class="text-center relative post_more_pic_box">
     <div class="custom_padding">
      <div class="profile img-polaroid zero_margin pull-right z_index1"> 
      <?php
        //$author=$obj->fetch_one('twitter_users',"`id`='".$author['author']."'");
                        if($fetchauthor['oauth_provider'] == 'twitter')
            {
                ?>
            <img title="<?php echo $fetchauthor['fullname'];?>"  src="<?php echo $fetchauthor['image'];?>" alt=""/>
            <?php
            }
            else
            {
                if($fetchauthor['oauth_provider']== 'facebook')
                {
            ?>
            <img title="<?=$fetchauthor['fullname']?>"  src="https://graph.facebook.com/<?=$fetchauthor['username']?>/picture?width=48&height=48">
            <?php
                }
 else {
     if($author['image' == ''])
     ?>
            <img  src="img/user.png" alt="">
            <?php
 }
              }
              if($fetchauthor['oauth_provider'] == "twitter")
              {
                  ?>
              
              <img style='width:100px; height:130px;' src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$fetchauthor['username']?>&size=bigger">
          <?php
              }
              
              if($fetchauthor['oauth_provider'] == "facebook")
              {
              ?>
              <img src="https://graph.facebook.com/<?=$fetchauthor['username']?>/picture?type=normal">
              <?php
              }
              if($fetchauthor['oauth_provider'] == "")
              {
                  if($fetchauthor['image'] == "")
                      {
                      ?>
              <img style='width:100px; height:130px;' src="http://reportedly.pnf-sites.info/developer/webadmin/no-img.jpg">
                  <?php
                      }
                     else {
                         ?>
              <img style='width:100px; height:130px;' src="http://reportedly.pnf-sites.info/developer/ajaximage/uploads/<?=$fetchauthor['image']?>">
              <?php
                     }
              }
            
              ?>
      </div>
      <div class="clearfix"></div>
      <div class="row-fluid text-right font_zise14">
         <h4 class="margin30"><?=$fetchauthor['fullname'];?></h4>

      <p><?=$fetchauthor['description'];?> </p>
      
      <hr/>
      
      <strong>Published</strong><p> <br/> <?php echo date('M d , ',$fetchauthor['creation_date']);
      echo date('Y',$fetchauthor['creation_date']);?></p>
      
      </div>
      </div>
      </div>
      </div>
           
        <div class="span9 margin50">
        	 <?php
              if($fetchpost['image_type'] == 'fit')
              {
               ?> 
            <div class="post_img well well-small text-center  img_small
             zero_padding margin50">
          <img alt="" src="ajaximage/uploads/<?php echo $fetchpost['image'];?>">
            </div>
              <?php
              
              }
              ?>
<!--            <div class="post_img">
            	<img src="ajaximage/uploads/<?php
          //echo $fetchpost['image'];?>" alt=""/>
            </div>-->
            
          <h2 class="zero_margin"><?php
          echo $fetchpost['title'];
          ?></h2>
          <small class="light_grey">In 
               
          <?php
          echo $fetchcollection['collection_name'];
          ?>
          </small>
          
        <div class="clearfix"></div>
        <p class="margin20 relative highlite">
             <?=$fetchpost['post'];?>
            <?php
            if($_SESSION['id'] == '')
            {
            ?>
            <a href="#myModal3" data-toggle="modal" class="comment">+</a>
            <?php
            }
            if($_SESSION['id'] != '')
            {
            ?>
            <span id="notechk"><a href="#modal" class="second comment">
                     <?php
                     if($counter_com == '0')
                     {?>
                        +
                    <?php
                     }  else {

echo $counter_com;}?></a></span>
            <?php
            }
            ?>
        </p>
              
   <div class="comment_position">
    <div class="toggle_comment">
    <a href="javascript:(function(){var D=550,A=280,C=screen.height,B=screen.width,H=Math.round((B/2)-(D/2)),G=0,F=document,url,text; if(C&gt;A){G=Math.round((C/2)-(A/2))}; url=encodeURIComponent(window.location); text=encodeURIComponent(window.getSelection?window.getSelection().toString():(document.selection?document.selection.createRange().text:'')); if(text==''){ window.alert('Please, select text on the page first');}else{ window.open('http://twitter.com/share?url='+url+'&amp;text='+text,'','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1');}}());"><img src="img/tw_white.png"/></a>
    
    <a href="javascript:(function(){var D=680,A=450, C=screen.height, B=screen.width, H=Math.round((B/2)-(D/2)), G=0, F=document, url, text; if(C&gt;A){ G=Math.round((C/2)-(A/2)) }; url = encodeURIComponent(window.location); text = encodeURIComponent(window.getSelection ? window.getSelection().toString() : (document.selection ? document.selection.createRange().text : '')); title = encodeURIComponent(document.title); if(text=='') window.alert('Select text on the page first'); else window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]='+title+'&amp;p[url]='+url+'&amp;p[summary]='+text,'','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1'); }());"><img src="img/fb_white.png"/></a>
    <?php
        if($_SESSION['id'] == ''){
            ?>
    <a href="#myModal3" data-toggle="modal"><img src="img/comment_white.png"/></a>
    <?php
        }else{
            ?>
     <a href="javascript:void(0);"  class="comment123"><img src="img/comment_white.png"/></a>  
     <?php
        }
         ?>       
    
    </div>
    <div class="text-center comment_botm_img"><img src="img/botm.png" alt=""/></div>
    </div>  
        
       </div> 
       </div>
      
      
    
      <div class="row-fluid padding_top15 margin20">
        
   
       
      <span class="span5 pull-right zero_margin"> 
     <form action="" method="post" id="recommendsss">
    <input type="hidden" id="sessionuser" name="sessionuser" value="<?=$_SESSION['id']?>">
    <input type="hidden" id="postid" name="postid" value="<?=$fetchpost['id']?>">
    <input type="hidden" id="collectionid" name="collectionid" value="<?=$fetchpost['collection_id']?>">
    </form>
          <?php
          $chk_recm=mysql_query("SELECT * FROM recommends WHERE recommend_user='$_SESSION[id]' AND recommend_post='$fetchpost[id]'");
          //$fetch_recm =  mysql_fetch_array($chk_recm);
          
          if(mysql_num_rows($chk_recm)>0)
          {?>
          <a href="javascript:void(0)"><img src="img/rec_active.png" class="recommend" id="<?=$fetchpost['id']?>" alt="Recommend" title="Unrecommend this"/> &nbsp; </a>
       <?php
          }
        else 
            {
          ?>
      <a href="javascript:void(0)" ><img id="<?=$fetchpost['id']?>" src="img/rec.png" class="recommend" alt="Recommend" title="Recommend this"/> &nbsp; </a>
      <?php
        }
        ?>
      <a href="#" class="trigger"><img src="img/add.png" alt="Add more"/> &nbsp; </a>
      <a href="javascript:(function(){var D=680,A=450, C=screen.height, B=screen.width, H=Math.round((B/2)-(D/2)), G=0, F=document, url, text; if(C&gt;A){ G=Math.round((C/2)-(A/2)) }; url = encodeURIComponent(window.location); text = encodeURIComponent(window.getSelection ? window.getSelection().toString() : (document.selection ? document.selection.createRange().text : '')); title = encodeURIComponent(document.title);  window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]='+title+'&amp;p[url]='+url+'&amp;p[summary]='+text,'','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1'); }());" ><img src="img/black_fb.png" alt="Share on Facebook">&nbsp;</a> 
      <a href="javascript:(function(){var D=550,A=280,C=screen.height,B=screen.width,H=Math.round((B/2)-(D/2)),G=0,F=document,url,text; if(C&gt;A){G=Math.round((C/2)-(A/2))}; url=encodeURIComponent(window.location); text=encodeURIComponent(window.getSelection?window.getSelection().toString():(document.selection?document.selection.createRange().text:'')); window.open('http://twitter.com/share?url='+url+'&amp;text='+text,'','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1');}());" ><img src="img/black_tw.png" alt="Share on Twitter"> &nbsp;</a>
      <a href="#myModal2" data-toggle="modal" ><img src="img/email.png" alt="Email"> &nbsp; </a>
<!--      <a href="#"><img src="img/heart.png" alt="Donation"/> &nbsp; </a>-->
      
      </span>
        		 
         </div>   
    
    
 
    <div class="row-fluid margin30"> <span class="read_more"><a id="readnext" href="javascript:void(0);">Read Next</a></span>
        <?php
$sql_btmpost = "SELECT * FROM `c2_reportedly`.`drafts` WHERE id > '$GETpostid' LIMIT 1";
$res_btmpost = mysql_query($sql_btmpost)or die(mysql_error());
if(mysql_num_rows($res_btmpost)>0){
    $fetch_btmpost =  mysql_fetch_array($res_btmpost);
    //$fetch_btmpost['id'] = base64_encode($fetch['id']);
   
}else{
    $sql_btmpost = "SELECT * FROM `c2_reportedly`.`drafts` order by `id` ASC LIMIT 1";
    $res_btmpost = mysql_query($sql_btmpost)or die(mysql_error());
    $fetch_btmpost =  mysql_fetch_array($res_btmpost);
    //$fetch['id'] = base64_encode($fetch['id']);
    
}  
        
        ?>
        
      <hr/>
    </div>
    <div class="row-fluid">
      <div class="wrapper_inner">
        <div id="blog">
          <ul>
            <li>
              <div class="media padding_top15 zero_margin">
                <div class="media-body">
                    <h5 class="media-heading" ><a class="btmposttitle" href="http://reportedly.pnf-sites.info/post_more?post=<?php echo base64_encode($fetch_btmpost['id']);?>">                <?php 
                    if($fetch_btmpost['title'] == ''){
                        echo 'Untitled';
                    }else{
                    echo $fetch_btmpost['title'];
                    }
                    ?></a> </h5>
                  <p><a href="http://reportedly.pnf-sites.info/post_more?post=<?php echo base64_encode($fetch_btmpost['id']);?>" class="btmpostsubtitle"><small>
                      <?php 
                    if($fetch_btmpost['sub_title'] == ''){
                     echo '';
                    }else{
                    echo $fetch_btmpost['sub_title'];
                    }

                      ?></small></a></p>
                  <p class="btmpost">
                      <a href="http://reportedly.pnf-sites.info/post_more?post=<?php echo base64_encode($fetch_btmpost['id']);?>" >
                      <?php 
                    if($fetch_btmpost['post'] == ''){
                   echo '';
                    }else{
                    echo substr($fetch_btmpost['post'],'0','50');
                    }
                      ?></a></p>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <hr/>
        <div class="row-fluid">
  <?php
$sql_nxt3 = "SELECT * FROM `c2_reportedly`.`drafts` WHERE id > '$fetch_btmpost[id]' LIMIT 3";
$res_nxt3 = mysql_query($sql_nxt3)or die(mysql_error());
if(mysql_num_rows($res_nxt3)>0){
while($fetch_nxt3 =  mysql_fetch_array($res_nxt3))
 {
    $collectionnxt3=$obj->fetch_one('collections',"`id`='".$fetch_nxt3['collection_id']."'");
?>
<div class="span4">
    <p><a href="http://reportedly.pnf-sites.info/post_more?post=<?php echo base64_encode($fetch_nxt3['id']);?>"><strong>
                <?php
                if($fetch_nxt3['title'] == ''){
                        echo 'Untitled';
                    }else{
                    echo $fetch_nxt3['title'];
                    }
                ?>
            </strong></a></p>
    <p><a href="http://reportedly.pnf-sites.info/collection?collection_name=<?php echo $collectionnxt3['id'];?>" class="light_grey">in <?php echo $collectionnxt3['collection_name']; ?></a></p>
  </div>          
<?php
 }

}else{
$sql_nxt3 = "SELECT * FROM `c2_reportedly`.`drafts` order by `id` ASC LIMIT 3";
$res_nxt3 = mysql_query($sql_nxt3)or die(mysql_error());
while($fetch_nxt3 =  mysql_fetch_array($res_nxt3))
{
    $collectionnxt3=$obj->fetch_one('collections',"`id`='".$fetch_nxt3['collection_id']."'");
?>
    <div class="span4">
    <p><a href="http://reportedly.pnf-sites.info/post_more?post=<?php echo base64_encode($fetch_nxt3['id']);?>"><strong>
                <?php
                if($fetch_nxt3['title'] == ''){
                        echo 'Untitled';
                    }else{
                    echo $fetch_nxt3['title'];
                    }
                ?>
            </strong></a></p>
    <p><a href="http://reportedly.pnf-sites.info/collection?collection_name=<?php echo $collectionnxt3['id'];?>" class="light_grey">in <?php echo $collectionnxt3['collection_name']; ?></a></p>
  </div>
<?php
}  
}
 ?>
<!--          <div class="span4">
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
          </div>-->
        </div>
      </div>
    </div>
</div>
   </div>
     </div> 
    </div>
  </div>
</div>



<div id="modal">
    <div class="row-fluid">
    <div class="span2">
    <div class="span12 img-polaroid margin10 pull-left pading2">
<!--        <img src="img/profile_bg.jpg" alt=""/>-->
        <?php
        if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img src="<?=$fetch_profile['image']?>" width="119px" alt=""/>
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
    </div>			    </div>
    <div class="span10">
     <h4 class="font14"><?=$fetch_profile['fullname'];?></h4>
<!--     <input type="text"   placeholder="Leave a note">-->
     <div contenteditable="true"><p id="editableText" class="input_custom zero_margin editableText" >Leave a note</p></div>
     
     <a href="javascript:void(0);" class="font_zise13 savenote">Save</a>
     &nbsp; <a href="javascript:$.pageslide.close()" class="font_zise13 cancelee">Cancel</a>
     <hr/>

     <p class="font_zise13 light_grey">This note is only visible to you and the author, unless the author chooses to make it public.</p>
    </div>
    
    </div>
    
    
    
    
    <?php
    $i = 0;
    while($all_com =  mysql_fetch_array($fetch_com))
    {
    ?>
    <div class="row-fluid">
    <div class="span2">
    <div class="span12 img-polaroid margin10 pull-left pading2">
<!--        <img src="img/profile_bg.jpg" alt=""/>-->
        <?php
            $com_user = $obj->fetch_one('twitter_users',"`id`='".$all_com['note_author']."'");
            if($com_user['oauth_provider'] == 'twitter')
            {
                ?>
            <img src="<?=$com_user['image']?>" width="119px" alt=""/>
            <?php
            }
            else
            {
                if($com_user['oauth_provider']== 'facebook')
                {
            ?>
            <img src="https://graph.facebook.com/<?=$com_user['username']?>/picture?type=normal">
            <?php
                }
              }
             ?>
    </div>			    </div>
    <div class="span10">
     <h4 class="font14"><?=$com_user['fullname'];?></h4>
<!--     <input type="text"   placeholder="Leave a note">-->
     <div id='notetext<?php echo $i; ?>' >
         <?php //echo $all_com['note'];?>
     </div>
     <?php
      if($_SESSION['id'])
      {
     ?>
     <a id="editnote" href="javascript:void(0);" class="font_zise13 editnote">Edit</a>
     <?php
      }
      ?>
<!--     &nbsp; <a href="javascript:$.pageslide.close()" class="font_zise13">Cancel</a>-->
     <hr/>
<!--
     <p class="font_zise13 light_grey">This note is only visible to you and the author, unless the author chooses to make it public.</p>-->
    </div>
    
    </div>
    <?php
    $i++;
    }
    ?>
  
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

<div class="slider_body"></div>

<div class="panel">
  <h4>Select the collection you'd like to add this post to.</h4>
  <ul class="nav nav-tabs nav-stacked">
    <li class="colection">Collections</li>
    <?php
    $sql_collec=mysql_query("SELECT * FROM `collections` ")or die(mysql_error());
     while($fetch_collec =  mysql_fetch_array($sql_collec))
     {
    ?>
       
    <li id="showbtns"><a id="showbtn" href="javascript:void(0);"><?php echo $fetch_collec['collection_name']; ?> </a> 
        <input type="hidden" id="<?php echo $fetch_collec['id']; ?>" class="crosscollectionid" value="<?php echo $fetch_collec['id']; ?>">
        <span id="<?php echo $fetch_collec['id']; ?>" class="btn_div">
      <input type="button" id="cancel" class="btn btn-small " value="Cancel">
      <input type="button" id="postcross" class="btn btn-success btn-small" value="Add">
      
      </span></li>
      
      <?php
     }?>
<!--    
      <li><a href="#">Slide <span class="btn_div">
      <input type="button" class="btn btn-small" value="Cancel">
      <input type="button" class="btn btn-success btn-small" value="Add">
      </span> </a></li>
    
      <li><a href="#">Direction <span class="btn_div">
      <input type="button" class="btn btn-small" value="Cancel">
      <input type="button" class="btn btn-success btn-small" value="Add">
      </span> </a></li>
    <li><a href="#">Function <span class="btn_div">
      <input type="button" class="btn btn-small" value="Cancel">
      <input type="button" class="btn btn-success btn-small" value="Add">
      </span> </a></li>
    <li><a href="#">Showcomment <span class="btn_div">
      <input type="button" class="btn btn-small" value="Cancel">
      <input type="button" class="btn btn-success btn-small" value="Add">
      </span> </a></li>
    <li><a href="#">AddClass <span class="btn_div">
      <input type="button" class="btn btn-small" value="Cancel">
      <input type="button" class="btn btn-success btn-small" value="Add">
      </span> </a></li>-->
  </ul>
</div>
    <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel"> Email Report to a Friend </h3>
</div>
<div class="modal-body">
	<div class="row-fluid">
    	
        <div class="span8 offset2">
          <textarea class="span12" name="something" placeholder="write something...(optional)" ></textarea>
        <input type="text" name="tags" id="whichkey" placeholder="Enter email address and press Enter/Tab" class="tm-input span12"/>
       
        </div>
        
    </div>
</div>
<div class="modal-footer">
<span id="saving">Sending...</span>
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary" id="emailpost">Send</button>
</div>
</div>	

<div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel"> Login/Signup to write note</h3>
</div>

    <div class="row-fluid">
<a href="signin" ><input class="btn black_btn span5 margin10" type="button" value="Login"></a>
<a href="signup" ><input class="btn black_btn span5 margin10" type="button" value="Signup"></a>
</div>
<!--<div class="span4"> 
      <a href="Twitter_Login/login-twitter" class="pull-right twi"></a>
      <a href="Twitter_Login/login-facebook" class="margin_botm_zero pull-right fb3"></a> </div>-->
   
          
</div>	
<script src="js/tagmanager.js"></script> 
<script src="js/jquery.pageslide.min.js"></script> 
<script>
    jQuery(document).ready(function() {
                //jQuery("#emails").focus();
                var defaulttext = "Type your title";
                jQuery("#emails").blur(function(){
                        if(jQuery(this).html() == "" || jQuery(this).html() =='Enter Email') {
                            jQuery(this).html(defaulttext);
                            jQuery(this).removeClass('diss');
                        }
               });
                jQuery('#emails').keypress(function(){
                    var defaulttext = "Enter Email";
                    if( jQuery(this).html() == defaulttext){
                        jQuery(this).html('');
                        jQuery(this).removeClass('diss');
                   }
                });
    })
</script>   

<script>
        /* Default pageslide, moves to the right */
        $(".first").pageslide();
        
        /* Slide to the left, and make it model (you'll have to call $.pageslide.close() to close) */
        $(".second").pageslide({ direction: "left", modal: true  });
		
		$('.second').click(function(e){
                    //alert("df");
                    var randomNum = Math.floor(Math.random()*99999999999999);
                    $(".savenote").attr('name' , randomNum);
                    $("#pageslide").offset({top:e.pageY-40});
		})
   
		
    </script>
<script type="text/javascript">
    
$(document).ready(function(){
     
          
                    $(".trigger").click(function(){
                        $postid = $(this).attr('id');
                        $sid = $('.sessid').attr('id');
                        if($sid == "")
                            {
                                alert('Please login to add this post to your posts');
                            }
                            else{
                            $(".panel").toggle("fast");
                            $(".slider_body").fadeIn();
                            $(this).toggleClass("active");
                            //$(".slider_body").addClass("trigger");
                            return false;
                            }
                    });
                    $(".slider_body").click(function(){
                            $(".slider_body").fadeOut();
                            $(".panel").toggle("fast");
                    });
               
       
});
$(document).on('click','#showbtn',function(){
    $('.btn_div').hide();
    $(this).parent().children('.btn_div').show();
    //$('.btn_div').show()
})

$(document).on('click','#postcross',function(){
    //alert($(this).parent().parent().text());
    //alert($('.postid').attr('id'));
     var id = $('.postid').attr('id');
     // var collection = $('.crosscollectionid').val();
     var collection = $(this).parent().attr('id');
     //alert(collection);
            $.ajax({
            url: 'crosspost.php',
            type: 'POST',  
            dataType: 'json',
            data : {post:id,collection:collection},
            success: function (res) {
                $('.btn_div').hide();
                alert(res);
               //window.location.href = "http://reportedly.pnf-sites.info/drafts.php";
            }
         });
})
$(document).on('click','#cancel',function(){
    $('.btn_div').hide();
    return false;
})
//$(document).on('click','.postcross',function(){
    
//        $.ajax({
//            url: 'jhgjhg.php',
//            type: 'POST',  
//            dataType: 'json',
//            data : {id:id},
//            success: function (res) {
//               window.location.href = "http://reportedly.pnf-sites.info/drafts.php";
//            }
//         });
   //    })
</script>
<script>
    $("#saving").hide();
   $(document).on('click','#emailpost', function(){ 
           //var email = $('#postemail').val();
           var postid = $('.encodepostid').attr('id');
           
           $emails = $("[name=hidden-tags]").val();
           $text = $("[name=something]").val();
           //alert($emails);
           if($emails == ''){
               alert('Enter email address to post');
               return false;
           }else{
           var conf = confirm('Do you want to email this post ?');
           if(conf){
               $("#saving").show();
           $.ajax({
            type: 'POST',
            dataType: 'json',
            data:{'email':$emails,postid: postid,text:$text},
            url: 'http://reportedly.pnf-sites.info/post-link',
            success: function(response){
               $("#saving").html('Email link posted successfully');
        //alert(response);
               if(response){
               window.location.href = 'http://reportedly.pnf-sites.info/post_more?post='+postid;
               }    
            }
            });
           }else{
              return false;
           }
           }
              
       });
       $(document).on('click','#readnext',function(){
       var postid = $('.postid').attr('id');
       $.ajax({
            type: 'POST',
            dataType: 'json',
            data:{postid: postid},
            url: 'http://reportedly.pnf-sites.info/read-next',
            success: function(response){
               if(response){
                   //alert(response.id);
               window.location.href = 'http://reportedly.pnf-sites.info/post_more?post='+response.id;
               }    
            }
            });
       })

//$(document).on('click','#postcross',function(){
//    alert('dhsjkf');
//})

$(document).ready(function(){

       var postid = $('.postid').attr('id');
       $.ajax({
            type: 'POST',
            dataType: 'json',
            data:{postid: postid},
            url: 'http://reportedly.pnf-sites.info/read-next',
            success: function(response){
               if(response){
                   
                   //alert(response.id);
               //window.location.href = 'http://reportedly.pnf-sites.info/post_more?post='+response.id;
               }    
            }
            });   

        $(document).on('mouseover','.hoverTextChange',function(){
           
            $key = $(this).attr('name');
            //alert($key);
             $.ajax({
                url: 'readonhover.php',
                type: 'POST',  
                dataType: 'json',
                data : {key:$key},
                success: function (res) {
                    var string = res.text;
                    $('.highlite').html(string);
                   }
                });
            
        });
        
        
        $(document).on('mouseout','.hoverTextChange',function(){
           var id = $('.postid').attr('id');
           $.ajax({
                url: 'readmouseout.php',
                type: 'POST',  
                dataType: 'json',
                data : {id : id},
                success: function (res) {
                    var string = res.post;
                    $('.highlite').html(string);
                   }
                });
            });


    
    $(document).on('click','.editpostid',function(){
        var id = $(this).attr('id');
        window.location.href='http://reportedly.pnf-sites.info/edit_post?post='+id;
        
    })
$('.delete').click(function(){
    var id = $('.postid').attr('id');
    var conf = confirm('Are you sure to delete this draft ?');
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



function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( email ) ) {
    return false;
  } else {
    return true;
  }
}

jQuery(".tm-input").tagsManager({
    typeahead: true,
    //typeaheadSource: your_function_here(),
    blinkBGColor_1: '#FFFF9C',
    blinkBGColor_2: '#CDE69C',
    validator : function(){
        email = $('#whichkey').val();   
        if(validateEmail(email)){
            $('#whichkey').focus();
            return true;
        }else{
            alert("Please enter valid email");
            $('#whichkey').focus();
            return false;
        }
        
    }
});


//     jQuery(".tm-input").tagsManager({
//        typeahead: true,
//        //typeaheadSource: your_function_here(),
//        blinkBGColor_1: '#FFFF9C',
//        blinkBGColor_2: '#CDE69C',
//    });


$(document).on('click','#editnote',function(){
    alert('karo edit');
           // $(this).hide();
//        $('.savenote').show();
//        $('.cancelee').show();
        });


});
</script>

    
</body>
</html>
<?php

}
?>
