<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$fetch_profile=$obj->fetch_one('twitter_users',"`id`='".$_SESSION[id]."'");
if($_SESSION['id'] == ''){
    header('location:http://reportedly.pnf-sites.info/signin');
}else{
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Stats</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
 
<!--<script type="text/javascript" src="js/bootstrap.js"></script>-->

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>	
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<!--<script type="text/javascript" src="http://www.highcharts.com/samples/data/usdeur.js"></script>-->
<script type="text/javascript" src="/data.js"></script>

<script>
   
var $arr = [];
                $('#container').highcharts('StockChart',{
	    
	    chart: {
		type :'column',
	    },
	    
	    rangeSelector: {
	    	buttonTheme: { // styles for the buttons
	    		fill: 'none',
	    		stroke: 'none',
	    		'stroke-width': 0,
	    		r: 8,
	    		style: {
	    			color: '#039',
	    			fontWeight: 'bold'
	    		},
	    		states: {
	    			hover: {
	    			},
	    			select: {
	    				fill: '#039',
	    				style: {
	    					color: 'white'
	    				}
	    			}
	    		}
	    	},
	    	inputStyle: {
	    		color: '#039',
	    		fontWeight: 'bold'
	    	},
	    	labelStyle: {
	    		color: 'silver',
	    		fontWeight: 'bold'
	    	},
	    	selected: 1
	    },
	    
	    series: [{
	        name: 'Reads',
	        data:[
                                    [Date.UTC(2013, 00, 15, 11, 11, 47, 7), 10],
                                    [Date.UTC(2013, 07, 11, 11, 11, 47, 7), 9],
                                    [Date.UTC(2013, 07, 12, 11, 11, 47, 7), 6],
                                    [Date.UTC(2013, 07, 15, 11, 11, 47, 7), 6],
                                    [Date.UTC(2013, 07, 16, 11, 11, 47, 7), 1],
                                    [Date.UTC(2013, 07, 19, 11, 11, 47, 7), 1],
                                    [Date.UTC(2013, 07, 24, 11, 11, 47, 7), 3],
                                    [Date.UTC(2013, 07, 25, 11, 11, 47, 7), 16],
                                    [Date.UTC(2013, 07, 26, 11, 11, 47, 7), 7],
                                    [Date.UTC(2013, 07, 29, 11, 11, 47, 7), 8],
                                    [Date.UTC(2013, 07, 31, 11, 11, 47, 7), 6],
                                    [Date.UTC(2013, 08, 03, 11, 11, 47, 7), 3]
                                ]
                    }]
	});

  
</script>


<script>

$(document).ready(function(){
    
    
    
  

    
    $.ajax({
                type: 'GET',
                dataType: 'json',
                url: 'http://reportedly.pnf-sites.info/rvr',
                success: function(response){
                    //alert(response);
                    $('#views').find('h4').html(response.Views);
                    $('#reads').find('h4').html(response.Views);
                    $('#recommends').find('h4').html(response.Recommends);
                 }
       });
       
})    

</script>

<!-----------------------/ main css and js --------------!---->

<link href="css/font-awesome.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="row-fluid">
    
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
        
    <div class="wrapper left_zero">
        
   	<div class="wrapper_inner width100">
       
       <div class="row-fluid">
          
               <div class="row-fluid">
                   <div class="dashboard span7"> <h1 class="zero_margin">Your Dashboard <small>All posts</small></h1></div>
                    <div class="chart-title span6" style="display:none;"><h1 class="zero_margin"></h1></div>
                    <div class="span5 text-right"><span class="pul-right viewfullchart">Click post below to view in chart</span>
                   <input type="button" value="Back to dashboard" class="blank_btn span4 text-right backbutton"/>
               </div>
               </div>
       
        <hr/>
        <div class="row-fluid margin20">
         <ul class="nav nav-tabs" id="myTab">
            <li id="views" class="active"><a  href="#views" data-toggle="tab"><h4>
<!--                        60-->
                    </h4> Views  <span>(30 days)</span></a></li>
            <li id="reads" ><a href="#reads" data-toggle="tab">
                    <h4>
<!--                        10-->
                    </h4> 
                    Reads  <span>(30 days)</span></a></li>
            <li id="recommends"><a href="#recs" data-toggle="tab">
                    <h4>
<!--                        30-->
                    </h4>  Recs 
                    <span>(30 days)</span></a></li>
         </ul>
             
         <div class="tab-content">
           
            <div class="tab-pane active" id="views">
<!--            <div class="row-fluid">
            	<img src="img/graph.png" alt=""/>
            </div>-->
              <table class="table margin20">
             	
                <tr>
                	<td width="43%">Post</td>
                    <td width="13%">Views</td>
                    <td width="11%">Reads</td>
                    <td width="20%">Recommendations</td>
                    <td width="13%">Share <img src="img/share.png" alt=""/></td>
                </tr>
              


<div id="container" style="width: 100%; height: 300px;"></div>
<input type="hidden" name="single_view_id" class="single_view_id" value="" >
<!--<button id="button">Reads</button>
<button id="button1">Recommends</button>
<button id="button2">Views</button>-->
                <?php
                 $session_id = $_SESSION['id'];
                $sql_post ="SELECT * FROM drafts WHERE status = '1' AND author = '$session_id' ";
                $res_post = mysql_query($sql_post);
                while($Result_post = mysql_fetch_array($res_post)){
                   // echo '<br><span class="button3" id="'.$Result_post['id'].'">'.$Result_post['title'].'</span>';
            
                    $collection=$obj->fetch_one('collections',"`id`='".$Result_post[collection_id]."'");
                ?>
                <tr>
    <td><div class="media padding_top15 zero_margin">
<!--    <a class="pull-left" href="#">
    <img class="media-object img-polaroid pading2" src="img/user.png" alt="">
    </a>-->
    <div class="media-body">
    <h4 class="zero_margin button3" id="<?php echo $Result_post['id'];?>">
        <a href="#"> <!-- javascript:void(0);-->
         <?php
         if($Result_post['title'] == ""){
             echo 'Untitled';
         }else{
            echo $Result_post['title'];
         }
         ?></a>
<!--        <a href="post_more?post=<?php //echo base64_encode($Result_post['id']);?>">
           
        </a> </h4>-->
    <p><a href="post_more?post=<?php echo base64_encode($Result_post['id']);?>"><small><em>in</em>  <?php echo $collection[collection_name];?>. view post</small></a></p>
    </div>
    </div></td>
                 <td>
                        <?php
                            $sql_view ="SELECT * FROM views WHERE view_post = '$Result_post[id]'  ";
                            $res_view = mysql_query($sql_view);
                            echo $view =  mysql_num_rows($res_view);
                        ?>
<!--                        64-->
                    </td>
                 <td>
                           <?php  echo $view; ?> 
<!--                            75-->
                        </td>
                 <td>
                <?php
                //recommendations
                $sqk="SELECT * FROM recommends WHERE recommend_post='".$Result_post['id']."'";
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
                ?>
             </td>
            <td><small class="font_zise13"><a href="#">
                <?php
                $sql_shares = "SELECT * FROM shares WHERE post_id ='".$Result_post['id']."' AND share_on ='Facebook'  ";
                $res_shares = mysql_query($sql_shares);
                $total_shares = mysql_num_rows($res_shares);
                //echo $total_shares;
                if($total_shares > 0)
                {
                    echo $total_shares;
                }
                else
                {
                    echo '0';
                }
                ?>
<!--                                20 shares-->

                    </a> / <a href="#">
                        <?php
                $sql_tweets  = "SELECT * FROM shares WHERE post_id ='".$Result_post['id']."' AND share_on ='Facebook' ";
                $res_tweets = mysql_query($sql_tweets);
                $total_tweets  = mysql_num_rows($res_tweets);
                //echo $total_shares;
                if($total_tweets  > 0)
                {
                    echo $total_tweets;
                }
                else
                {
                    echo '0';
                }
                ?>
<!--                        10-->
                        tweets</a></small>
            </td>
                </tr>
                <?php
                }
                ?>
                

              </table>
            
            </div>
            

          </div>
               
        </div>
                    
       </div>
       
       
                     
        
        </div>
    
        </div>
        
    </div>
    

<!--<script>$('#example').tooltip(options)</script>-->

</body>
</html>
<?php
}?>