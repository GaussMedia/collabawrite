<?php
//include('db.php');
include('Twitter_Login/config/dbconfig.php');
session_start();
$session_id='1'; //$session id
?>
<html>
<head>
<title>Ajax Image Upload 9lessons blog</title>
</head>

<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>

<script type="text/javascript" >
                $(document).ready(function() { 
                $('#photoimg').live('change', function()
                { 
                       $("#preview").html('');
                $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
                                $("#imageform").ajaxForm({
                                  target: '#preview'
                                }).submit();
		
			});
        }); 
</script>

<style>

body
{
font-family:arial;
}
.preview
{
width:200px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}

</style>
<body>
<a href='http://9lessons.info'>9lessons.info</a>


<div style="width:600px">

<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
Upload your image <input type="file" name="photoimg" id="photoimg" />
</form>
<div id='preview'>
</div>


</div>
</body>
</html>