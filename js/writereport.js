/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

   
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
                
                var leftPosition;
                var rightPosition;
                 var pName;
                $(document).on('click','#fileUpload1',function(e){
                    leftPosition = e.pageX;
                    rightPosition = e.pageY;
                   // alert(e.pageX +',' +e.pageY);
                })

                
//                
                function onFileLoad1(e) { 
                
              //$(".editor").click(function(e){

                       //var x = e.pageX - this.offsetLeft;
                      // var y = e.pageY - this.offsetTop;
                     // alert(x +', '+ y);
                     //$('#status2').html(x +', '+ y);
                 // });
           //$('#columns').show();
           //$('#column4').children().show();
            //widget-head').html('<img src="'+e.target.result +'"/>');
            //                    <div class="img_hover_box">\
            //<span>(drag image)</span>\
            ///           <div class="icon-remove icon-white"></div>\
             //       </div>\
             //alert(pName);
        $('[name='+pName+']').after('<div id="columns" >\
        \
        <div id="column2" class="column">\
           <div class="widget">  \
               <div class="widget-head">\
                     <div class="img_show"> \
                     <img src="'+e.target.result+'">\
                    	\
                    </div>\
                   \
                </div>\
            </div>\
        </div>\
        \
        <div id="column3" class="column"> </div>\
        <div id="column4" class="column"> </div>\
\    </div>');
                           
                         //$('#columns').css({'left':leftPosition,'top':rightPosition,'position' : 'inherit'});
                       
          
             } 
            
            function displayPreview1(files) {
                var reader = new FileReader();
                reader.onload = onFileLoad1;
                reader.readAsDataURL(files[0]);
            } 
//})


        jQuery(document).ready(function() {
//                $('.nowbrowse').hide();
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
              
                $(document).on('mouseover','.column img', function () {
                    $(this).css('opacity',0.50);
                    $(this).parent().append('<span contenteditable="false" class="hoverspan" style="color:#0000FF;left: 150px;position: absolute;top: 180px;">(drag image)</span>');
                    //alert($(this).attr('src'));
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
                });
                
                
                 $(document).on('mouseout','img', function () {
                     $(this).css('opacity',1);
                     $('.hoverspan').remove();
                     //var len = $(this).parent().find("span").length;
                     //var i;
                     //alert(len);
//                     for(i=0;i<length;i++){
//                         $(this).parent().find('span').remove();
//                     }
                         //alert($(this).text());
                    //alert('jgkjdflkjgldfkljkljfd');exit;
                       // if($(this).next().find('div').length>0){
                      //  $(this).parent().next().remove();
                       // }
                       
               });
                
                
                
//                 $(document).on('mouseout','#columns',function(){
//                //$(this).before().find('img').html('<div class="img_show"></div>');
//                  //$(this).after().find('img').html('');
//                  var img = $('.widget-head').find('img').attr('src');
//                  $('.widget-head').html('<img src="'+img+'">');
//                })
                
                //$(document).on('keyup','#post',function(e){
                $(document).keyup('.editor',function(e) {
                    switch ( e.keyCode ) {
                    case 13: // Enter
                        //alert(e.pageX +' ,'+e.pageY);
//                         if(($('.editor').find('p').length)>1){
//                                        var ll = $('.editor').find('p').length;
//                                        alert(ll);
//                                    }
//                            $('.nowbrowse').show();
                            var numRand = Math.floor(Math.random()*1011321354);
                            $('.editor').find("p:last").attr('name' , numRand);
//                           $('.nowbrowse').css({'left': e.pageX,'top':e.pageY}).show(); 
                        break;
                    case 8: // Backspace
                        if($(this).find('p').length<1){
                             var numRand = Math.floor(Math.random()*1011321354);
                                 $('.editor').html('<p name="'+numRand+'">Type your post</p>');
                         }   
                        break; 
                    case 46: // Delete
                       if($(this).find('p').length<1){
                             var numRand = Math.floor(Math.random()*1011321354);
                                 $('.editor').html('<p name="'+numRand+'">Type your post</p>');
                         }
                        break;
                    } 
  
                    //alert(e.pageX +' ,'+e.pageY);
                    //var pos  = e.pageX + ', '+ e.pageY;alert(pos);exit;
                   //(e.which);exit;
                   // if(e.keyCode==13){
                     //  var numRand = Math.floor(Math.random()*1011321354);
                       //var poso = textbox(this);
                       //alert(poso);
                      //$('.editor').find("p:last").attr('name' , numRand).append('\
//                                         <div class="browse_box nowbrowse">\
//        <div class="file">\
//        <input id="fileUpload1" type="file" onChange="displayPreview1(this.files);" name="fileUpload1">\
//        <span id="spanimg1" class="button" >Add image</span>\
//        \
//        </div>\
//    </div>');
               //$('.editor').find("p:last").attr('name' , numRand);
               //alert(e.pageX +' Top ' +e.pageY);
              // $('.nowbrowse').css({'left': e.pageX,'top':e.pageY}).show();   
                //    }
//                     if(e.keyCode==8){
//                         if($(this).find('p').length<1){
//                             var numRand = Math.floor(Math.random()*1011321354);
//                                 $('.editor').html('<p name="'+numRand+'">Type your post</p>');
//                         }
//                     }
//                     if(e.keyCode==46){
//                         if($(this).find('p').length<1){
//                             var numRand = Math.floor(Math.random()*1011321354);
//                                 $('.editor').html('<p name="'+numRand+'">Type your post</p>');
//                         }
//                     }
                        
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
//                        $('.nowbrowse').show();
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
       
       
       
       
       $(document).on('mouseover','.editor p',function(e){
                    pName = $(this).attr('name');
                    var arr = $('.editor p').length;
                       //alert(e.pageX+','+e.pageY);
                       if(arr >1){
                           //alert(arr);
//                           $('.nowbrowse').show();
                           $('.nowbrowse').css({'top':e.pageY-405});
                           
                       }
            //$('#column4').offset({left:e.pageX,top:e.pageY+20});   
            //$('.nowbrowse').css({'left': e.pageX,'top':e.pageY}).show(); 
        });
        $(document).on('mouseleave','.editor p',function(e){
            //alert('chaklo');
            //var arr = $('.editor p').length;
                 //   if(arr >1){
                     //$('.nowbrowse').hide();
                //    }
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
             
	

