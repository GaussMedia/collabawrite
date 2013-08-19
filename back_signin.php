<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
$ip = $_SERVER['SERVER_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//echo '<pre>';
//print_r($ip_data);
//die;
//$addrress = $ip_data->geoplugin_city." ".$ip_data->geoplugin_region;



//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if($_POST['sub'])
{
	$admin=$_POST['admin'];
	$pwd=$_POST['pwd'];
	if(empty($admin))
	{
		$error='1';
		$err_msg[]="Please Fill User Name";
	}
	if(empty($pwd))
	{
		$error='1';
		$err_msg[]="Please Fill Password";
	}
	if($error != '1')
	{
		$pwd=md5($pwd);
		$sql=mysql_query("SELECT * FROM users WHERE username='$admin' AND password='$pwd'")or die(mysql_error());
		if($result=mysql_num_rows($sql)>0)
		{
			$f=mysql_fetch_array($sql)or die(mysql_error());
			$_SESSION['id']=$f['id'];
			$true_msg[]="Login Successsfully <br>Redircting....";
		}
		else
		{
			$error='1';
			$err_msg[]="Wrong User Name Or Password";
		}
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Sign in</title>

<!----------------------- main css and js --------------!---->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-----------------------/ main css and js --------------!---->



</head>

<body>
	
    <div class="row-fluid">

    <div class="logo_drop_down">
    
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="#">
            <?php
            $query_logo = "SELECT * FROM `logo` WHERE status='1' ";
            $res_logo = mysql_query($query_logo)or die(mysql_error());
            $fetch_logo = mysql_fetch_array($res_logo);
            ?>
            <img src="webadmin/upload/logo/real/<?php echo $fetch_logo['logo_image']; ?>" alt=""/></a>

    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
      <li><a href="index.php">Home</a></li>
      <li><a href="Twitter_Login/login-twitter.php">Sign in with twitter</a></li>
    </ul>
    
    </div>

    <div class="pepl">
    <img class="cover_img" alt="" src="img/phillylove.jpg">
   
       <?php
   if(empty($_SESSION))
   {
   ?>
    <div class="content margin30 top30">
    <h2 class="font_white">Reportedly</h2>
    <hr class="zero_margin">
    <p class="slogn">It's not news until you report it</p>
    <a href="signin.php"><input type="button" class="btn black_btn span5 margin30" value="Login"/></a>
    <a href="signup.php" ><input type="button" class="btn black_btn span5 margin30" value="Signup"/></a>
    <?php
   }
   ?>
    </div>
    </div>
    
    
    
    <div class="wrapper">
   
		<div class="row-fluid">
        	
            <div class="span6">
            	<div class="setpadding">

    <h2 class="margin30">Sign in</h2>
        	<?php
if($result)
{
        ?>
<?php foreach($true_msg as $v)
{
       // echo $v.'<br>';
echo '<meta http-equiv="refresh" content="0;url=profile.php" >';
}
 ?> <!-- .notify -->
<?php
}
?>

<?php
if($error == '1')
{
        ?>
<?php
foreach($err_msg as $v)
{
        echo $v.'<br>';
}
 ?> <!-- .notify -->
<?php
}
?>
            <form action='' method='post'>
    <input type="text" name='admin' placeholder="User Name" class="span10">
    <input type="password" name='pwd' placeholder="Password" class="span10">
    <div class="clearfix"></div>
    <input type="submit" name='sub' value="Sign in" class="btn black_btn btn-large pull-left">
    <div class="clearfix"></div>
   
    </form>
	<span  class="in">OR</span>
    <div class="clearfix"></div>
    </div>
            </div>
            
            <div class="span4">
             <a href="Twitter_Login/login-twitter.php" class="margin33_p pull-left twi"></a>
             <a href="#" class="pull-left fb3"></a>
            </div>
        
        </div>

    </div>
    
    
    
    </div>
    

		

</body>
</html>
