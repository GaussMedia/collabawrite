<?php
include('Twitter_Login/config/dbconfig.php');
session_start();
echo $session_id=$_SESSION['id'];
echo '<pre>';

if($_POST['note'] == "")
{
    echo 'empty filed';
    exit;
}
print_r($_POST);
?>
