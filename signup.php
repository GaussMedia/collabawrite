<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
$ip = $_SERVER['REMOTE_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

require_once('lib/recaptchalib.php');
$publickey = "6LfwIuISAAAAAJngQSqKFEywX_gzj3_oq6M-7ipK"; // you got this from the signup page
//echo recaptcha_get_html($publickey);

  
//echo '<pre>';
//print_r($ip_data);
//die;
//$addrress = $ip_data->geoplugin_city." ".$ip_data->geoplugin_region." ".$ip_data->geoplugin_countryName;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Sign up</title>

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
        $(document).on('focus' , 'input' ,function(){
            $(this).css('border' , '1px solid #CCCCCC');
        })
});
//autocomplete
function initialize() {
	var input = document.getElementById('location');
	var autocomplete = new google.maps.places.Autocomplete(input);
}
</script>
<style>
	/* Optional Styling: */
	body { background: #fafafa; font-size: 13px; font-family: Verdana; padding: 40px; }
	fieldset { width: 280px; background: #fff; padding: 10px; display: block; }
	legend { font-size: 18px; margin: 0; }
	input, textarea { margin: 0; padding: 3px; border: 1px solid #aaa; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; width: 278px }
	label { width: 100%; font-weight: bold; float: left; }
	.submit { background: #444; color: #fff; width: inherit; border: none; padding: 5 10px; cursor: pointer; } .submit:hover { background: #000; }
	.msg { padding: 10px; border: 1px solid #ccc; background: #fff; width: 285px; margin: 0 0 20px; }
	.msg.success { border-color: #86a62f; background: #faffec; }
	.msg.error { border-color: #cd5a5a; background: #fff7f7; }
	
	/* Required for Honey Pot: */
/*	.robotic { display: none; }*/
</style>
<script type="text/javascript">
	function showpot() {
		document.getElementById("pot").className = "";
		return false;
	}
</script>
</head>

<body>
<div class="row-fluid">
  <div class="logo_drop_down"> 
      <a class="dropdown-toggle logo" data-toggle="dropdown" href="index.php">
          <?php
            $query_logo = "SELECT * FROM `logo` WHERE status='1' ";
            $res_logo = mysql_query($query_logo)or die(mysql_error());
            $fetch_logo = mysql_fetch_array($res_logo);
            ?>
            <img src="webadmin/upload/logo/real/<?php echo $fetch_logo['logo_image']; ?>" alt=""/></a>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
      <li><a href="index"><i><img src='img/logo_hover.png'></i>Home</a></li>
      <li><a href="signin"><i class="icon-white icon-off"></i> Signin</a></li>
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
          <p class="slogn"> <?php echo strip_tags($fetch_simg['slogan']);?> <a href="#" class="font_white"><u>Learn More</u></a></p>
        </div>
        
              <div class="row-fluid">
          <a href="signin"><input type="button" class="btn black_btn span5 margin30" value="Login"/></a>
<!--    <a href="signup.php" ><input type="button" class="btn black_btn span5 margin30" value="Signup"/></a>-->
        </div>
              
          </div>
      </div>
    </div>
  </div>
  <div class="wrapper">
    <div class="row-fluid">
      <?php
        if($_POST['submit'])
        {
            extract($_POST);
            if(empty($username))
            {
                $error='1';
                $err_msg['username']="Please fill username";
            }
            if(empty($name))
            {
                $error='1';
                $err_msg['fullname']="Please fill your full name";
            }
            if(empty($location))
            {
                $error='1';
                $err_msg['location']="Please fill your location";
            }
            if(empty($email))
            {
                $error='1';
                $err_msg['email']="Please fill your email";
            }
            if(!empty($email))
            {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
            // Run the preg_match() function on regex against the email address
            if (!preg_match($regex, $email)) {
                    $error='1';
                    $err_msg['email']='you entered an invalid email. We cannot accept it.';
                  }
            }
            if(empty($password))
            {
                $error='1';
                $err_msg['password']="Please fill your password";
            }
            if(!empty($password))
            {
                if(strlen($password) < 6){
                $error='1';
                $err_msg['password']="Password must be atleast 6 character long";
                }
            }
            if(empty($confirm_password))
            {
                $error='1';
                $err_msg['confirm']="Please confirm your password";
            }
            if((!empty($confirm_password)) && (!empty($confirm_password)))
            {
                if($password != $confirm_password)
                {
                $error='1';
                $err_msg['equal']="Password mis matches";
                }
            }
            if(!empty($email))
            {
                $location = addslashes($_POST['location']);
                $chk_email=  mysql_query("SELECT * FROM `twitter_users` WHERE email='$email' AND oauth_provider='NULL'")or die(mysql_error());
                if(mysql_num_rows($chk_email)>=1)
                {
                   $error='1';
                   $err_msg['email']="email already exists";
                }
            }
            $robotest = $_POST['robotest'];
            if(!empty($robotest)){	
                $error = '1';
                $err_msg['robot'] = "You are a gutless robot.";
            }
            
            //if ($_POST["recaptcha_response_field"]) {
                $resp = recaptcha_check_answer ("6LfwIuISAAAAAEDGnUs5k-YHLzMZg6vUYNykikng",$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],
                     $_POST["recaptcha_response_field"]);

                if (!$resp->is_valid) {
                       $error = '1';
                       $err_msg['capcha'] = "You entered incorrect captcha code";
                }
            //}
		
            if($error != '1')
            {
                $confirm_code=substr(md5(uniqid(rand($pwd), true)), 16, 16); 
                //send email to who?
                $to = $email;
        //
        //        //email subject
                $subject = 'Your confirmation link here';
        //
        //        //From
                $headers.="From: hello@Reportedly.co \r\n"; 
                $headers.="Content-type: text/html;charset=utf-8 \r\n"; 
                $headers.="X-Priority: 3\r\n"; 
                $headers.="X-Mailer: smail-PHP ".phpversion()."\r\n";        
                $message = '<table cellpadding="10" style="border-color: #666;"><tbody><tr style="background: #fddea7;"><td><font color="#990000"><strong> '.$name.',</strong></font><br><br>Thanks for creating an account on Reportedly! To verify your account, please click the link below. .<br>
		<a target="_blank" href="http://reportedly.pnf-sites.info/confirm.php?passkey='.$confirm_code.'"> Click Here </a><br>Thank you,<br>If you believe you received this in error, feel free to ignore. You may contact us at hello@Reportedly.co <br>Thanks! </td></tr></tbody></table>';
            
                $sentmail = mail($to, $subject, $message, $headers);
                    if($sentmail)
                    {
                $password=md5($password);
                $d=time();
                $sql="INSERT INTO `c2_reportedly`.`twitter_users` (
                `confirm_code`,    
                `username` ,
                `fullname` ,
                `email` ,
                `password` ,
                `location` ,
                `creation_date`
                
                )
                VALUES (
                '$confirm_code','$username', '$name', '$email', '$password', '$location', '$d')";
                $res =  mysql_query($sql)or die(mysql_error());
                if($res)
                {
                    $true_msg[] = 'Thanks. Your account has been registered and a verification email has been sent. Please check your email and verify your account. ';
                    $id = mysql_insert_id();
                    $query = mysql_query("SELECT * FROM `twitter_users` WHERE id = '$id'");
                    $result = mysql_fetch_array($query);
                    $_SESSION['id'] = $result['id'];
                }
                }

            }
               
        }
        
        ?>
        
        
      <div class="span6">
      	<div class="setpadding">
 <h2 class="margin30">Create an account</h2>
 <?php
 if($error == '1')
 {
     ?>
     <div class="alert alert-error span10" style="margin-left:0">
         <button data-dismiss="alert" class="close" type="button">×</button>
    <?php
        if($err_msg['equal']){
            echo $err_msg['equal'];
            echo "<br>";
       }
       if($err_msg['email']){
            echo $err_msg['email'];
            echo "<br>";
       }
       if($err_msg['password']){
            echo $err_msg['password']; 
            echo "<br>";
       }
       if($err_msg['robot']){
            echo $err_msg['robot']; 
            echo "<br>";
       }
     if($err_msg['capcha']){
            echo $err_msg['capcha'];   
       }
       
       ?>
     </div>
       <?php
 }
 else
 {
     if($true_msg)
     {
         ?>
     <div class="alert alert-success">
     <button data-dismiss="alert" class="close" type="button">×</button>
    <?php
       foreach($true_msg as $v)
     {
         echo $v.'<br>';
         echo "<meta http-equiv='refresh' content='5;url=http://reportedly.pnf-sites.info'>";
         //echo "<meta http-equiv='refresh' content='5;url=http://reportedly.pnf-sites.info/' />";
           
     } 
     ?>
     </div>
       <?php
     }
 }
 ?>
  <form action="" method="post">
     
    <input <?php if($err_msg['username']){ ?> style=" border: 1px solid #f00;" <?php } ?> type="text" name="username" value='<?=$username?>' placeholder="User Name" class="span10">
    <input <?php if($err_msg['fullname']){ ?> style=" border: 1px solid #f00;" <?php } ?> type="text" name="name" value='<?=$name?>' placeholder="Name" class="span10">
    <input <?php if($err_msg['location']){ ?> style=" border: 1px solid #f00;" <?php } ?> type="text" id="location" name="location" value="<?=$location?>" placeholder="Location" class="span10">
    <input <?php if($err_msg['email']){ ?> style=" border: 1px solid #f00;" <?php } ?> type="text" placeholder="Email" value='<?=$email?>' name="email" class="span10">
    <input <?php if($err_msg['password'] or $err_msg['equal']){ ?> style=" border: 1px solid #f00;" <?php } ?> type="password" placeholder="Password" value='' name="password" class="span10">
    <input <?php if($err_msg['confirm'] or $err_msg['equal']){ ?> style=" border: 1px solid #f00;" <?php } ?> type="password" placeholder="Confirm Password" value='' name='confirm_password' class="span10">
    <div class="clearfix"></div>
    <p class="robotic" id="pot">
    <label>If you're human leave this blank:</label>
    <input <?php if($err_msg['robot']){ ?> style=" border: 1px solid #f00;" <?php } ?> name="robotest" type="text" id="robotest" class="robotest span10" />
		</p>
<!--		<a href="#" onclick="showpot();">Show honey pot field?</a><br />-->
<?php echo recaptcha_get_html($publickey);?>
    <input type="submit" name='submit' value="Sign up" class="btn submit black_btn btn-large pull-left">
    <div class="clearfix"></div>
    
    </form>
<!--          <span  class="out">OR</span> --></div>
      </div>
<!--      <div class="span4 social_btn"> 
      <a href="Twitter_Login/login-twitter" class="pull-left twi"></a>
      <a href="Twitter_Login/login-facebook" class="margin_botm_zero pull-left fb3"></a>  
      </div>-->
    </div>
  </div>
</div>
</body>
</html>
