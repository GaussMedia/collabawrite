<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

ob_start();
session_start();
include("resize-class.php");
include("config.php");
getConnection();
//print_r($_SESSION);
//include('resize-class.php');

if(empty($_SESSION['username']))
{
	header('location:login.php');
}
//if(!$_SESSION['company'])
//{
//	header('location:company_login.php');
//}
$mode=$_REQUEST['mode'];
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

	<title>Reportedly Admin - <?php 
	if($mode)
	{	
	echo ucwords(str_replace("_"," ",$_REQUEST['mode'])); 
	}
	else
	{?>
    index
    <?php
	}
	?>
     </title>
	<meta charset="utf-8" />
	<meta name="description" content="" />
	<meta name="author" content="" />	
    <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>	
	<meta name="viewport" content="width=device-width,initial-scale=1" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="stylesheets/all.css" type="text/css" />
    <script type="text/javascript" src="javascripts/custom-scripts.js"></script>
    <!--<script type="text/javascript" src"javascripts/custom-scripts.js"></script>-->
  
<script type="text/javascript"> 
 $(function(){
			$('.alert').click(function(){
				$(this).hide();
				});
		});
	</script>
    
    <link href="stylesheets/font-awesome-ie7.css" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.css" rel="stylesheet" type="text/css" />
    
    </head>

<body>

<div id="wrapper">
	
	<div id="header">
            <?php
            $query_logo = "SELECT * FROM `logo` WHERE status='1' ";
            $res_logo = mysql_query($query_logo)or die(mysql_error());
            $fetch_logo = mysql_fetch_array($res_logo);
            ?>
            <img src="upload/logo/real/<?php echo $fetch_logo['logo_image']; ?>" alt=""/>
		<!--<h1><a href="">Canvas Admin</a></h1>	-->	
		<a href="javascript:;" id="reveal-nav">
			<span class="reveal-bar"></span>
			<span class="reveal-bar"></span>
			<span class="reveal-bar"></span>
		</a>
	</div> <!-- #header -->
	
	<div id="search">
<!--		<form>
			<input type="text" name="search" placeholder="Search..." id="searchField" />
		</form>		-->
	</div> <!-- #search -->
	
	<div id="sidebar">		
		
    <ul id="mainNav">			
            <li id="navDashboard" class="nav">
                    <span class="icon-home"></span>
                    <a href="index.php">Dashboard</a>				
            </li>
     
            <li id="navPages" class="nav">
    <span class="icon-document-alt-stroke"></span>
    <a href="javascript:;">Site Management</a>				

    <ul class="subNav">
            <li><a href="index.php?mode=site_settings">Site Settings</a></li>
    </ul>						
    </li>
            
    <li id="navPages" class="nav">
    <span class="icon-document-alt-stroke"></span>
    <a href="javascript:;">logo Management</a>				

    <ul class="subNav">
            <li><a href="index.php?mode=manage_logo">Manage Logo</a></li>
    </ul>						
    </li>
    
        <li id="navPages" class="nav">
        <span class="icon-document-alt-stroke"></span>
        <a href="javascript:;">Slogan and Image Management</a>				
           <ul class="subNav">
      <li><a href="index.php?mode=add_image_and_slogan">Add Slogan and Image</a></li>
      <li><a href="index.php?mode=manage_image_and_slogan">Manage Slogan and Image</a></li>
                </ul>						
        </li> 
                        
                		
        <li id="navPages" class="nav">
                <span class="icon-document-alt-stroke"></span>
                <a href="javascript:;">Page Management</a>				

                <ul class="subNav">
<?php
                $sql=mysql_query("SELECT * FROM pages");
                while($fetch=mysql_fetch_array($sql))
                {
                ?>
<li><a href="index.php?mode=edit_page&edit_id=<?php echo $fetch['id']; ?>"><?php echo ucwords($fetch['page_title']); ?></a></li>
<?php
                }
                ?>
                        <li><a href="index.php?mode=add_page">Add Page</a></li>
                        <li><a href="index.php?mode=manage_page">Manage Page</a></li>
                </ul>						
        </li>	
        
        <li id="navPages" class="nav">
          <span class="icon-document-alt-stroke"></span>
          <a href="javascript:;">User Management</a>				

              <ul class="subNav">
               <!--<li><a href="index.php?mode=add_user">Add User</a></li>-->
              <li><a href="index.php?mode=manage_users">Manage Users</a></li>
              </ul>						
      </li>
                        
       <li id="navPages" class="nav">
                <span class="icon-document-alt-stroke"></span>
                <a href="javascript:;">Collection Management</a>				
           <ul class="subNav">
<!--      <li><a href="index.php?mode=add_blog">Add Blog</a></li>-->
      <li><a href="index.php?mode=manage_collections">Manage Collections</a></li>
                </ul>						
	</li>         
        
        <li id="navPages" class="nav">
        <span class="icon-document-alt-stroke"></span>
        <a href="javascript:;">Post Management</a>				

        <ul class="subNav">
                <li><a href="index.php?mode=manage_posts">Manage posts</a></li>
        </ul>						
	</li>
        
        <li id="navPages" class="nav">
        <span class="icon-document-alt-stroke"></span>
        <a href="javascript:;">Notes Management</a>				

        <ul class="subNav">
                <li><a href="index.php?mode=manage_notes">Manage posts</a></li>
        </ul>						
	</li>
                        
                        
          <!--   <li id="navPages" class="nav">
				<span class="icon-document-alt-stroke"></span>
				<a href="javascript:;">Blog Management</a>				
				
				<ul class="subNav">
                      <li><a href="index.php?mode=add_blog">Add Blog</a></li>
					<li><a href="index.php?mode=manage_blog">Manage Blog</a></li>
				</ul>						
			</li>	
            	
                        
                      
            
           <li id="navPages" class="nav">
				<span class="icon-document-alt-stroke"></span>
				<a href="javascript:;">FAQ Management</a>				
				
				<ul class="subNav">
                <li><a href="index.php?mode=add_question">Add Question</a></li>
					<li><a href="index.php?mode=manage_question">Manage Question</a></li>
				</ul>						
			</li>	
            <li id="navPages" class="nav">
				<span class="icon-document-alt-stroke"></span>
				<a href="javascript:;">Visitor Management</a>				
				
				<ul class="subNav">
					<li><a href="index.php?mode=manage_visitor">Manage Visitor</a></li>
				</ul>						
			</li>-->
			
			
                       
            
<li id="navPages" class="nav">
         <span class="icon-document-alt-stroke"></span>
         <a href="javascript:;">Admin Settings</a>				

         <ul class="subNav">
          <li><a href="index.php?mode=change_password">Change Password</a></li>
         </ul>						
 </li>	
			<li id="navCharts" class="nav">
				<span class="icon-chart"></span>
				<a href="logout.php">Logout</a>
			</li>
			</ul></div>
						
<div id="content">	
<div id="contentHeader">
			<h1>
            <?php
			$mode=$_REQUEST['mode'];
			echo ucwords(str_replace("_"," ",$_REQUEST['mode']));
            ?></h1>
		</div>	<!-- content header-->
		<div class="container">
				<div class="grid-24">	
                	
                    
                    
                    
					<?php
					if($mode)
					{
						include($mode.'.php');
					}
 else {
     ?>
                    
                    <div class="grid-5 border">
                            <a href="index.php?mode=manage_logo"><i class="icon-picture"></i>
                            <h4>logo Management</h4></a>
                    </div></a>
                    
                    <a href="index.php?mode=manage_users">
                    <div class="grid-5 border">
                            <i class="icon-user"></i>
                            <h4>User Management</h4>
                    </div></a>
                    
                    <a href="index.php?mode=manage_collections">
                    <div class="grid-5 border">
                            <i class="icon-list"></i>
                            <h4>Collection Management</h4>
                    </div></a>
                    
                    <a href="index.php?mode=manage_posts">
                    <div class="grid-5 border">
                            <i class="icon-envelope-alt"></i>
                            <h4>Post Management</h4>
                    </div></a>
                    
                     <a href="index.php?mode=manage_notes">                
                    <div class="grid-5 border">
                            <i class="icon-copy"></i>
                            <h4>Notes Management</h4>
                    </div></a>
                    
                     <a href="index.php?mode=change_password">               
                     <div class="grid-5 border">
                            <i class="icon-lock"></i>
                            <h4>Change Password</h4>
                    </div></a>
     <?php
 }
					
					?>
			</div> <!-- .grid -->
			</div> <!-- .container -->
		</div> <!-- #content -->
</div> <!-- #wrapper -->
<div id="topNav">
		 <ul>
		 	<li>
                             <a href="#menuProfile" class="menu">Welcome  Admin<?php  //print_r(ucwords($_SESSION['username'])); ?></a>
		 		
		 		<div id="menuProfile" class="menu-container menu-dropdown">
					<div class="menu-content">
						<ul class="">
							<li><a href="index.php?mode=change_password">Change Password</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
				</div>
	 		</li>
		 	<li><a href="#">View Site</a></li>
		 	<li><a href="logout.php">Logout</a></li>
		 </ul>
	</div>
<div id="footer">
    Powered by Collabawrite © 2013 by Sociality Inc All rights reserved. (&hearts;) Made In New Jersey.
</div>


<script src="javascripts/all.js"></script>

</body>
</html>