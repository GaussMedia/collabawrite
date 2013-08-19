<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
$ip = $_SERVER['SERVER_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//echo '<pre>';
//print_r($ip_data);
//die;
$addrress = $ip_data->geoplugin_city." ".$ip_data->geoplugin_region." ".$ip_data->geoplugin_countryName;

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



</head>

<body>
	
    <div class="row-fluid">

    <div class="logo_drop_down">
    
	<a class="dropdown-toggle logo" data-toggle="dropdown" href="#"><?php
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
    	<?php
        if($_POST['submit'])
        {
            extract($_POST);
            if(empty($username))
            {
                $error='1';
                $err_msg[]="Please fill username";
            }
            if(empty($name))
            {
                $error='1';
                $err_msg[]="Please fill your full name";
            }
            if(empty($email))
            {
                $error='1';
                $err_msg[]="Please fill your email";
            }
            if(!empty($email))
            {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
            // Run the preg_match() function on regex against the email address
            if (!preg_match($regex, $email)) {
                    $error='1';
                    $err_msg[]='you entered an invalid email. We cannot accept it.';
                  }
            }
            if(empty($password))
            {
                $error='1';
                $err_msg[]="Please fill your password";
            }
            if(empty($confirm_password))
            {
                $error='1';
                $err_msg[]="Please confirm your password";
            }
            if((!empty($confirm_password)) && (!empty($confirm_password)))
            {
                if($password != $confirm_password)
                {
                $error='1';
                $err_msg[]="Password mis matches";
                }
            }
            if(!empty($email))
            {
                $chk_email=  mysql_query("SELECT * FROM `twitter_users` WHERE email='$email'")or die(mysql_error());
                if(mysql_num_rows($chk_email)>=1)
                {
                   $error='1';
                   $err_msg[]="email already exists";
                }
            }
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
                $headers = 'From: admin@Reportedly.com' . "\r\n" .
                           'Reply-To: admin@Reportedly.com' . "\r\n" .'X -Mailer: PHP/' . phpversion();
        //
        //
        //        //Message content
                $message = "Your confirmation link\r\n";
                $message .= "Click on this link to activate your sccount\r\n";
                $message .= "http://reportedly.pnf-sites.info/developer/confirm.php?passkey=$confirm_code";
        //
        //        //send mail
        //        //SMTP setting
        //        //ini_set(SMTP,'localhost'); 
        //        //ini_set(smtp_port,'25');
        //        //ini_set(sendmail_from,'adminElectonic@pnf.com');
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
                '$confirm_code','$username', '$name', '$email', '$password', '$addrress', '$d')";
                $res =  mysql_query($sql)or die(mysql_error());
                if($res)
                {
                    $true_msg[] = 'User added successfully.check your email account';
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
     }  
     }
 }
 ?>
  <form action="" method="post">
    <input type="text" name="username" value='' placeholder="User Name" class="span10">
    <input type="text" name="name" value='' placeholder="Name" class="span10">
    <input type="text" name="location" value="<?=$addrress?>" placeholder="Location" class="span10">
    <input type="text" placeholder="Email" value='' name="email" class="span10">
    <input type="password" placeholder="Password" value='' name="password" class="span10">
    <input type="password" placeholder="Confirm Password" value='' name='confirm_password' class="span10">
    <div class="clearfix"></div>
    <input type="submit" name='submit' value="Sign up" class="btn black_btn btn-large pull-left">
    <div class="clearfix"></div>
    
    </form>
	<span  class="out">OR</span>
    </div>
      </div>  
    
       <div class="span4">
       <a href="" class="margin50_p pull-left twi"></a>
       <a href="#" class="pull-left fb3"></a>
      </div>
        
        
    
    </div>
    


    </div>
    
    
    
    </div>
    

		

</body>
</html>
