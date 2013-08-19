<?php
session_start();
include('Twitter_Login/config/dbconfig.php');


$ip = $_SERVER['REMOTE_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

if($_SESSION['id'] == ''){
if($_POST['submit'])
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
		$sql=mysql_query("SELECT * FROM twitter_users WHERE username='$admin' AND password='$pwd'")or die(mysql_error());
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
      <li><a href="index">Home</a></li>
      <li><a href="profile"><?=$sessionuser['fullname']?></a></li>
      <li><a href="stats">Stats</a></li>
      <li><a href="drafts">Drafts</a></li>
      <li><a href="settings">Settings</a></li>
      <li><?php
      echo '<a href="logout">Logout </a>'?></li> 
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
 
    
    <div class="pepl">
        <?php
        $sql_simg = "SELECT * FROM imageslogan WHERE status='1' ORDER BY id DESC LIMIT 1";
         $res_simg = mysql_query($sql_simg)or die(mysql_error());
         $fetch_simg = mysql_fetch_array($res_simg);
        ?>
        <img src="webadmin/upload/sloganimage/thumb/<?php echo $fetch_simg['image'];?>" alt="" class="cover_img"/>
    <div class="row-fluid">
      <div class="content margin30 top30">
          <div class="content_inner">
          <div class="black_bar">
          <h1 class="font_white top_margin_zero">
<img src="img/logo_report.png">
</h1>
          <hr class="top_margin_zero"/>
          <p class="slogn"> <?php echo strip_tags($fetch_simg['slogan']);?> <a href="#" class="font_white"> <a href="#" class="font_white"><u>Learn More</u></a></p>
        </div>
        
          
          <div class="row-fluid">
<!--          <a href="signin.php"><input type="button" class="btn black_btn span5 margin30" value="Login"/></a>-->
          <a href="signup.php" ><input type="button" class="btn black_btn span5 margin30" value="Signup"/></a>
        </div>
          
          </div> 
      </div>
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
echo '<meta http-equiv="refresh" content="0;url=index.php" >';
}
 ?> <!-- .notify -->
<?php
}
?>

<?php
if($error == '1')
{
        ?>
      <div class="alert alert-error span12" style="margin-left:0">
         <button data-dismiss="alert" class="close" type="button">×</button>
<?php
foreach($err_msg as $v)
{
        echo $v.'<br>';
}
 ?>
      </div><!-- .notify -->
<?php
}
?>
 


    
          <form method="post" action="">
            <input type="text" name="admin" value="<?php echo $admin; ?>" placeholder="User Name" class="span10">
            <input type="password" name="pwd" placeholder="Password" class="span10">
            <div class="clearfix"></div>
            <input type="submit" name="submit" value="Sign in" class="btn black_btn btn-large pull-left">
            <div class="clearfix"></div>
          </form>
<!--          <span  class="in">OR</span>-->
          <div class="clearfix"></div>
        </div>
      </div>
<!--      <div class="span4 social_btn"> 
      <a href="Twitter_Login/login-twitter" class="pull-left twi"></a>
      <a href="Twitter_Login/login-facebook" class="margin_botm_zero pull-left fb3"></a> </div>-->
    </div>
  </div>
</div>
</body>
</html>
<?php
}else{
    echo "<meta http-equiv='refresh' content='0;url=http://reportedly.pnf-sites.info/'>";
    //header('location:http://reportedly.pnf-sites.info/');
}
?>
