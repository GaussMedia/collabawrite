<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');

$query = "SELECT * FROM `twitter_users` WHERE id = '$_SESSION[id]'";
$res = mysql_query($query)or die(mysql_error());
$result = mysql_fetch_array($res);
if(empty($_SESSION[id]))
{
    header('location:http://reportedly.pnf-sites.info/developer/index.php');
}

if($_POST['submit_collection'])
{
    extract($_POST);
    if(empty($collection_name))
            {
                $error='1';
                $err_msg[]="Please fill collection name";
            }
            
    if(empty($collection))
    {
        $error='1';
        $err_msg[]="Please fill collection data";
    }
    if($error != '1')
    {
        $d=time();
        
    $sql="INSERT INTO `c2_reportedly`.`collections` (
    `collection_name` ,
    `collection` ,
    `contribute_type` ,
    `collection_author` ,
    `creation_date`
    )
    VALUES (
    '$collection_name', '$collection', '', '$_SESSION[id]', '$d'
    )";
    $res=mysql_query($sql)or die(mysql_error());
    if($res)
    {
        $true_msg[]="Your Collection added succesfully";
    }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Create Collection</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Noto+Serif' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-----------------------/ main css and js --------------!---->

<link href="css/font-awesome.css" rel="stylesheet" type="text/css">


</head>

<body>

<div class="row-fluid">

    
    <div class="logo_drop_down">
    
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="index.php"><img src="img/logo.png" alt=""/></a>

    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
        <?php
        if(!empty($_SESSION['id']))
        {
        ?>
      <li><a href="index.php">Home</a></li>
      <li><a href="stats.php">Stats</a></li>
      <li><a href="drafts.php">Drafts</a></li>
      <li><a href="settings.php">Settings</a></li>
      <li><?php
      echo '<a href="Twitter_Login/logout.php?logout">Logout </a>'?></li> 
      <?php
      }
      else
      {
      ?>

      <li><a href="index.php">Home</a></li>
      <li><a href="Twitter_Login/login-twitter.php">Sign in with twitter</a></li>
      <?php
      }
      ?>
    </ul>
    
    </div>

    <div class="pepl font_white grey_bg">
  
      <!--<img class="cover_img" alt="" src="img/phillylove.jpg">-->
   
    <div class="content margin50 top30">
        <form method="post" action="">
       <div class="row-fluid text-center">
        <a href="#" data-toggle="tooltip" data-placement="left" title="Change background image" class="plus_icon text-center">+</a></div>
    

        <input type="text" name="collection_name" class="input_custom margin30 margin_botm_zero font18" placeholder="Name your collection here">
        <input type="text" name="collection" class="input_custom light_grey font14" placeholder="Discribe your collection here">
        <small class="light_grey"><em>By <?=$result['fullname']?></em></small>
        <hr/>
        <input type="submit" name="submit_collection" class="btn btn-success" value="Create">
        <input type="reset" class="btn btn-success" value="Cancel">
    </div>
    </div>
    
</form>
        
    <div class="wrapper">
        
   	<div class="wrapper_inner">
       
       <div class="row-fluid">
       <hr/>
       <?php
 if($error == '1')
 {
     foreach($err_msg as $v)
     {
         echo $v.'<br>';
     }
 }
 else
 {
     if($true_msg)
     {
       foreach($true_msg as $v)
     {
        echo $v.'<br>';
        $table="collections";
        $obj=new KARAMJEET();
        $fetch_coll=$obj->fetch_one($table,"`collection_name`='".$collection_name."'"); 
        $coll=$fetch_coll['collection_name'];
        echo "<meta http-equiv='refresh' content='=0;url=write-post.php?collection=$coll' />";
     }  
     }
 }
 ?>
       <h2> Who can Contribute ?</h2>
        <hr/>
        <div class="row-fluid margin20">
            
    <div class="well img-polaroid span6 text-center height200 box_position">
<div class="box aligncenter">
        <div class="aligncenter icon">
         <i class="icon-group icon-circled icon-64 active"></i>
        </div>
        <div class="text">
                <h6>Anyone</h6>
                <p>Anyone can add to this collection and you'll have the ability to remove any content</p>

        </div>
</div>
<div class="select_option"><span class="icon-ok"></span></div>
    </div>

    <div class="well img-polaroid span6 text-center height200 box_position">
    <div class="box aligncenter">
            <div class="aligncenter icon">
             <i class="icon-user icon-circled icon-64 active"></i>
            </div>
            <div class="text">
                    <h6>Invite only</h6>
                    <p>Only you this collection.(You can invite people from the collection's setting once it's created.)</p>

            </div>
                                        </div>
                <div class="select_option"><span class="icon-ok"></span></div>
    </div>

    </div>

    </div>




    </div>

        	
    
        </div>
        
    </div>
    

<!--<script>$('#example').tooltip(options)</script>-->

</body>
</html>
