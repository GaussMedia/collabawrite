<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
$table_user="twitter_users";
$obj=new KARAMJEET();

$uid=$_SESSION['id'];
$fetch_profile=$obj->fetch_one($table_user,"`id`='".$uid."'");
//echo '<pre>';
//print_r($fetch_profile);
//die;
$ip = $_SERVER['REMOTE_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//echo '<pre>';
//print_r($ip_data);
//die;
//$addrress = $ip_data->geoplugin_city." ".$ip_data->geoplugin_region;



//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if($_POST['submit'])
{
	$email=$_POST['email'];
        $location=$_POST['location'];
         if(empty($location))
            {
                $error='1';
                $err_msg[]="Please fill your location";
            }
	if(empty($email))
	{
		$error='1';
		$err_msg[]="Please Fill your email address";
	}
	if(!empty($email))
        {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
            // Run the preg_match() function on regex against the email address
            if (!preg_match($regex, $email))
             {
                $error='1';
                $err_msg[]='you entered an invalid email. We cannot accept it.';
             }
        }
	if($error != '1')
	{
            $query = "SELECT * FROM `twitter_users` WHERE email = '$email' AND    oauth_provider = 'twitter'";
            $res = mysql_query($query)or die(mysql_error());
            $result = mysql_fetch_array($res);
            if(mysql_num_rows($result) > 0)
            {
                $error='1';
                $err_msg[]='Email alredy exists.try another account.';
            }
            else {
            $confirm_code=substr(md5(uniqid(rand($pwd), true)), 16, 16); 
                //send email to who?
//                $to = $email;
//        //
//        //        //email subject
//                $subject = 'Your confirmation link here';
//        //
//        //        //From
//                $headers = 'From: hello@reportedly.co' . "\r\n" .
//                           'Reply-To: admin@Reportedly.com' . "\r\n" .'X -Mailer: PHP/' . phpversion();
//        //
//        //Thanks for creating an account on ChangeFuel! To verify your account, please click the link below
//
//
//        //        //Message content
//                $message = "Thanks for creating an account on ChangeFuel! To verify your account, please click the link below\r\n";
//                $message .= "http://reportedly.pnf-sites.info/confirm.php?passkey=$confirm_code";
//                $message .= "\r\n If you believe you received this in error, feel free to ignore. You may contact us at hello@reportedly.co \r\n";
//                $message .= "Thanks!";
        //
        //        //send mail
        //        //SMTP setting
        //        //ini_set(SMTP,'localhost'); 
        //        //ini_set(smtp_port,'25');
        //        //ini_set(sendmail_from,'adminElectonic@pnf.com');
                $sentmail = mail($to, $subject, $message, $headers);
                if($sentmail)
                {
		$pwd=md5($pwd);
		 $sql="UPDATE twitter_users SET confirm_code='$confirm_code',location='$location',email='$email',status='1' WHERE id='$_SESSION[id]'";
                 
                $res=mysql_query($sql)or die(mysql_error());
                if($res)
                {
                    echo 'user addded successfully.';
                    echo "<meta http-equiv='refresh' content='=5;index.php' />";
                }
                }
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
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	initialize();
});
//autocomplete
function initialize() {
	var input = document.getElementById('location');
	var autocomplete = new google.maps.places.Autocomplete(input);
}
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
      <li><a href="index"><i class="icon-white"> </i>Home</a></li>
      <li><a href="profile"><i class="user_icon">
                  <?php
                  if($fetch_profile['oauth_provider'] == 'twitter')
            {
                ?>
            <img title="<?=$fetch_profile['fullname']?>" class="media-object img-polaroid pading2" src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$fetch_profile['username']?>&size=normal" alt=""/>
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
              
              </i> <?=$fetch_profile['fullname']?></a></li>
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

      <li><a href="index">Home</a></li>
      <li><a href="signin">Signin</a></li>
      <?php
      }
      ?>
    </ul>
  </div>
 
    
    <div class="pepl"> <img class="cover_img" alt="" src="img/phillylove.jpg">
    <div class="row-fluid">
      <div class="content margin30 top30">
        <div class="black_bar">
          <h1 class="font_white top_margin_zero"><strong><span class="light_grey">Reportedly</span></strong></h1>
          <hr class="top_margin_zero"/>
          <p class="slogn">Ideas are the fuel to create the change needed
            to make the world a healthier, happier and more sustainable place to live. Change your mind, Change the World. Reportedly is a simple place to write and share your views. <a href="#" class="font_white"><u>Learn More</u></a></p>
        </div>
        
          
          <div class="row-fluid">
<!--          <a href="signin.php"><input type="button" class="btn black_btn span5 margin30" value="Login"/></a>-->
          <a href="signup.php" ><input type="button" class="btn black_btn span5 margin30" value="Signup"/></a>
        </div>
      </div>
    </div>
  </div>
  
    
    
    <div class="wrapper">
    <div class="row-fluid">
      <div class="span8">
        <div class="setpadding">
          <h5 class="margin30">Entering your location and Email  will help you write & find relevant reports your community.</h5>
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
          <form method="post" action="">
          
             <input type="text" id="location" name="location" value="<?=$location?>" placeholder="Location" class="span10">
               <input type="text" value="<?=$email?>" name="email" placeholder="Email Address" class="span10">
            <div class="clearfix"></div>
            <input type="submit" name="submit" value="Submit" class="btn black_btn btn-large pull-left">
            <div class="clearfix"></div>
          </form>
          
          <div class="clearfix"></div>
        </div>
      </div>
      
    </div>
  </div>
</div>
</body>
</html>
