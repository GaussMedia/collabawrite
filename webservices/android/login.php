<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 

session_start();
include('config.php');
getConnection();

/*function getConnection()
{
	$host='localhost';
	$user='c2_electronic';
	$password='123456';
	$db='c2_electronic';
	$dbh=new connection();
	$dbh->construct($host,$user,$password,$db);
}*/
//$db=getConnection();

if($_POST['sub'])
{   
    $obj=new KARAMJEET();
    $username = $obj->EscapeString($_POST['email']);
    $password = $obj->EscapeString($_POST['pwd']);
    //$user_type= $obj->EscapeString($_POST['user_type']);	
    $res=$obj->CheckLogin($username,$password);   
if(is_array($res))
{
	$err_msg=$res;
}

      
}
/*else {
 header("location:login.php"); 

}
*/?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

	<title>Reportedly Admin - Login</title>

	<meta charset="utf-8" />
	<meta name="description" content="" />
	<meta name="author" content="" />		
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" href="stylesheets/all.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="stylesheets/reset.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="stylesheets/text.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="stylesheets/buttons.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="stylesheets/theme-default.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="stylesheets/login.css" type="text/css" media="screen" title="no title" />
        <link rel="stylesheet" href="css/all.css" type="text/css" media="screen" />
        <script type="text/javascript">
var cookieEnabled=(navigator.cookieEnabled)? true : false

//if not IE4+ nor NS6+
if (typeof navigator.cookieEnabled=="undefined" && !cookieEnabled){ 
document.cookie="testcookie"
cookieEnabled=(document.cookie.indexOf("testcookie")!=-1)? true : false
}
if (cookieEnabled) //if cookies are enabled on client's browser
{
   document.write('.');
}
else
    {
        alert('Cookies are Disabled on this browser');
    }
//do whatever

</script>
        <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script> 
        <script type="text/javascript"> 
         $(function(){
        $('.alert').click(function(){
                $(this).hide();
                });
        });
	</script>
</head>

<body>

<div id="login">
	<!--<h1>Dashboard</h1>-->
      
            
	<div id="login_panel">
            <?php   $query_logo = "SELECT * FROM `logo` WHERE status='1' ";
            $res_logo = mysql_query($query_logo)or die(mysql_error());
            $fetch_logo = mysql_fetch_array($res_logo);
            ?>
            <h5 class="zero_margin text_center top_margin">
            <img src="upload/logo/real/<?php echo $fetch_logo['logo_image']; ?>" alt=""/>						   			<!--<font face="+8"><strong>Change Fuel Admin</strong></font>-->
            </h5>
    	<?php
						//if(($res))
						//{
							?>
<!--<div class="alert alert-success">
  <a href="javascript:;" class="close">&times;</a>
						<p><?php 
							//echo 'Login Success!Redirecting ... <br>';
                            //echo '<meta http-equiv="refresh" content="2;url=index.php?mode=download" >';
						 ?></p>
					</div>--> <!-- .notify -->
                    <?php
						//}
						?>
                        
                        <?php
						if($err_msg)
						{
							?>
<div class="alert alert-error">
  <a href="javascript:;" class="close">&times;</a>
						<p><?php
						foreach($err_msg as $v)
						{
							echo $v.'<br>';
						}
						 ?></p>
					</div> <!-- .notify -->
                    <?php
						}
						?>
                    
		<form action="" method="post" accept-charset="utf-8">		
                    
                    <div class="login_fields p_none">
                     <div class="login_fields top_padding">
<!--   				<div class="field">
					<label for="email">Select Type</label>
                                            <select class="ful" name="user_type">
                                            <option value=""> Select Type</option>
                                            <option value="Super User"> Super User</option>    
                                            <option value="Company"> Company</option>
                                            </select>	
				</div>-->
                        
				<div class="field">
					<label for="email">Email</label>
					<input type="text" name="email" value="" id="email" tabindex="1" placeholder="email@example.com" />		
				</div>
				
				<div class="field">
					<label for="password">Password <small><a href="javascript:;">Forgot Password?</a></small></label>
					<input type="password" name="pwd" value="" id="password" tabindex="2" placeholder="password" />			
				</div>
			</div> <!-- .login_fields -->
			
			<div class="login_actions">
				<input type="submit" class="btn btn-primary" value="Login" name="sub" tabindex="3">
			</div>
            </div>
		</form>
	</div> <!-- #login_panel -->		
</div> <!-- #login -->

<script src="javascripts/all.js"></script>


</body>
</html>