$(document).ready(function(){
var admin_root = 'http://localhost/canvas/Status_Selected.php';
$('.publish').bind('click',function(e){
	var action=$(this).val();
	//alert($action);
		var $table = $('#dbTable').val();
		var $id = $(this).attr('id');
		$.ajax({
			type: 'get',
			data:{'id':$id,'table':$table,'action':action},
			dataType: 'json',
			url:'http://localhost/canvas/Status_Selected.php',
			success: function(response){
				text = response;
			}
		});
		if(action == 'Publish'){
			$('#'+$id).val('Unpublish');
			$(this).removeClass('btn-success');
			$(this).addClass('btn-error');
		}
		else if(action == 'Unpublish'){
			$(this).removeClass('btn-error');
			$(this).addClass('btn-success');
			$('#'+$id).val('Publish');
		}
	});
	
	
	$('.delete').bind('click',function(e){
		var $id = $(this).attr('id');
		var $table = $('#dbTable').val();
		var action=$(this).val();
		var conf = confirm('Are you sure?');
		if(conf == true){
		$.ajax({
			type: 'get',
			data:{'id':$id,'table':$table,'action':action},
			dataType: 'json',
			url:'http://localhost/canvas/Status_Selected.php',
			success: function(response){
				text = response;
			}
		});
			
			$(this).parent().parent().remove();
		}
	});		
$(function(){
    // add multiple select / deselect functionality
	var $action=$('#action').val();
    $("#selectall").click(function () {
		$('.case').attr('checked', this.checked);
	      var val=[];
		  $('.case').each(function(i){
		  val[i] = $(this).val();
	      // alert(val[i]);
			var $btngo=$('#go').click(function(){
				var $action=$('#action').val();
				//alert($action);
				var $table = $('#dbTable').val();
				if($action == "publish" || $action == "unpublish"){
					 //alert(val[i]);
					  $.ajax({
					type: 'get',
					dataType: 'json',
					 //url: 'manageuser/status_selected/'+val[i]+'/'+$table+'/'+$action, 
					url: admin_root+'/status_selected/'+val[i]+'/'+$table+'/'+$action,
					success: function(response){
					}
				  });
				  }
				//alert($action);
				if($action == "delete"){
					$('.case').each(function(i){
					val[i] = $(this).val();
					//alert(val[i]);
					
					//alert($action);
					 $.ajax({
				     type: 'get',
					 dataType: 'json',
					 //url: 'manageuser/status_selected/'+val[i]+'/'+$table+'/'+$action, 
					 url: admin_root+'/status_selected/'+val[i]+'/'+$table+'/'+$action,
					 success: function(response){
						
					}
					
				});
				 $(this).parent().parent().parent().remove();
				 });
				}
				if($action == 'unpublish'){
					$('#'+val[i]).html('unpublish');
					$('#'+val[i]).removeClass('btn-success');
					$('#'+val[i]).addClass('btn-error');
				}
				else if($action == 'publish'){
					$('#'+val[i]).removeClass('btn-error');
					$('#'+val[i]).addClass('btn-success');
					$('#'+val[i]).html('publish');
				}
				});		   
		 
            
			  });
	
	

    });
		
		
		
		

 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });

		
});

});