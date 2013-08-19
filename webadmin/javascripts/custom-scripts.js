$(document).ready(function() {
						   
$('.publish').bind('click',function(e){
	 $table  = $('#dbtable').val();
	 $id = $(this).attr('id');
         var $this = $(this);
	var action = $(this).val();
		$.ajax({
			type: 'get',
			dataType: 'json',
			data:{'id':$id,'table':$table,'action':action},
			url: 'http://reportedly.pnf-sites.info/webadmin/Status_Selected.php',
			success: function(response){
			}
		});
		if(action == 'Publish'){
			$(this).val('Unpublish');
			$(this).removeClass('btn-success');
			$(this).addClass('btn-error');
		}
		else if(action == 'Unpublish'){
			$(this).removeClass('btn-error');
			$(this).addClass('btn-success');
			$(this).val('Publish');
		}
	});
        
        //edotor pick
        $('.picked').bind('click',function(e){
	 $table  = $('#dbtable').val();
	 $id = $(this).attr('id');
         var $this = $(this);
	var action = $(this).val();
		$.ajax({
			type: 'get',
			dataType: 'json',
			data:{'id':$id,'table':$table,'action':action},
			url: 'http://reportedly.pnf-sites.info/webadmin/editorpick.php',
			success: function(response){
			}
		});
		if(action == 'Picked'){
			$(this).val('Unpicked');
			$(this).removeClass('btn-success');
			$(this).addClass('btn-error');
		}
		else if(action == 'Unpicked'){
			$(this).removeClass('btn-error');
			$(this).addClass('btn-success');
			$(this).val('Picked');
		}
	});
        
	
	$('.delete').bind('click',function(e){
		var $table  = $('#dbtable').val();
		var $id = $(this).attr('id');
		var action = $(this).val();
		var conf = confirm('Are you sure id Number='+ $id +'?');
		if(conf == true){
			$.ajax({
				type: 'get',
				dataType: 'json',
				data:{'id':$id,'table':$table,'action':action},
				url: 'http://reportedly.pnf-sites.info/webadmin/Status_Selected.php',
				success: function(response)
				{
			
                                }
			});
                        $('#'+$id).parent().parent().remove();
		}
               //$(".delete" + $id+"").parent().parent().parent().remove();
			
	});	
	
	$('#go').bind('click',function(e){
		var action = $('select').val();
		//alert(action);
		var $table  = $('#dbtable').val();
		//alert($table);
		var conf=confirm('Are You Sure To Want '+ action +' ?');
		if(conf==true)
		{
		$('.checkbox').each(function(e,i){
		var $this = $(this);
		id=$this.val();
		//alert('checked inputs:\n'+id);
			$.ajax({
			type: 'get',
			dataType: 'json',
			data:{'id':id,'table':$table,'action':action},
			url: 'http://reportedly.pnf-sites.info/webadmin/All_Status_Selected.php',
			success: function(response){
	
			 //alert(response);
			}
			});
			});
			if(action == 'Publish'){
			$('#'+id).val('Unpublish');
			$(this).removeClass('btn-success');
			$(this).addClass('btn-error');
			}
			else if(action == 'Unpublish'){
			$(this).removeClass('btn-error');
			$(this).addClass('btn-success');
			$('#'+id).val('Publish');
			}else if(action=='delete'){
			$(this).parent().parent().remove();
			}


                  
alert('Sucessfully '+ action +'d');
				   }


                });
			//$("#"+$this.val()).attr('title',response).html(response);


//popup payments
$(document).ready(function(){
//open popup
$(".pop").click(function(){
    var id=$(this).attr('id');
   // alert(id);
$("#overlay_form").fadeIn(1000);
positionPopup();
});
 
//close popup
$(".closex").click(function(){
$("#overlay_form").fadeOut(500);
});
});
 
//position the popup at the center of the page
function positionPopup(){
if(!$("#overlay_form").is(':visible')){
return;
}
$("#overlay_form").css({
left: ($(window).width() - $('#overlay_form').width()) / 4,
top: ($(window).width() - $('#overlay_form').width()) / 7,
position:'absolute'
});
}
 
//maintain the popup at center of the page when browser resized
$(window).bind('resize',positionPopup);


//fetch edit Id
$('.pop').bind('click',function(){
var id=($(this).attr('id'));
var table  = $('#paytable').val();
////alert(id);
////alert(table);

$.ajax({
    type: "POST",
    url: "fetchone.php",
    data: {id:id,table:table},
    success: function(response){
        var tokens = response.split(',');
        
      // console.log(response);
      $("#payment_type").val(tokens[2]);
       $("#first_name").val(tokens[9]);
        $("#last_name").val(tokens[10]);
        
    }
    
});


});
              
 //Update 
$(document).on('click','.updateButn',function(){
	var first_name=$("#first_name").val();
    var last_name=$("#last_name").val();
	var user_name=$("#user_name").val();
	var email=$("#email").val();
	var page = window.location.hash;
	var sp = page.split('-');
	var table = $("#dbtable").val();
	$.ajax({
		type: 'post',
		dataType: 'json',
		data:{'first_name':first_name,'last_name':last_name,'user_name':user_name,'email':email,'id':sp[1],'table':table},
		//url: 'http://localhost/PC-112/jquery/jquery/update.php',
		success: function(text){
			alert(text.response);
		}
	});
		return false;
 });

            });
			