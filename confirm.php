<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj=new KARAMJEET();
$session_id = $_SESSION['id'];
$passkey = $_GET['passkey'];
if(empty($session_id))
{
 $sql1 = "SELECT * FROM twitter_users WHERE confirm_code='$passkey'";
 $result1 = mysql_query($sql1)or die(mysql_error());

//If successfully queried
if ($result1)
{
    $count = mysql_num_rows($result1);
   if ($count == 1)
    {
        $sql2 = "UPDATE twitter_users SET status='1' WHERE confirm_code='$passkey'"; 
        $result2 = mysql_query($sql2)or die(mysql_error());
    }

    else
    {
        echo "Wrong activation code";
    }

}
 header('location:http://reportedly.pnf-sites.info/signin');
 
}else{
include('Twitter_Login/config/dbconfig.php');
//Passkey that got from link
 


//Retrieve data from table where row that match this passkey
 $sql1 = "SELECT * FROM twitter_users WHERE confirm_code='$passkey'";
$result1 = mysql_query($sql1)or die(mysql_error());

//If successfully queried
if ($result1)
{
    //Count how many has this passkey
    $count = mysql_num_rows($result1);

    //if found this passkey,retieve data from table temp_members
    if ($count == 1)
    {

        //Insert data that retrieve from "temp_members" into "registered_member"
        $sql2 = "UPDATE twitter_users SET status='1' WHERE confirm_code='$passkey'"; 
        $result2 = mysql_query($sql2)or die(mysql_error());
    }

    else
    {
        echo "Wrong activation code";
    }

    //if successfully moved data,display message account has been activated and delete confirmation code from
    //"temp_members"

    if ($result2)
    {
        $link = '';
        echo "Thanks for verifying your account. Your account has been activated. Click here to sign in ";
        if(!empty($session_id)){
            header('location:http://reportedly.pnf-sites.info');
        }else{
        echo "(";
        ?>
<a href="http://reportedly.pnf-sites.info/signin">Login</a>
        <?php
        echo ")";
        }
        //Delete user information form "temp_members" that has the passkey
        //$sql3 = "DELETE FROM $table1 WHERE confirm_code = '$passkey'";
        //$result3 = mysql_query($sql3);
       // echo "<meta http-equiv='refresh' content='=5;index.php' />";
    }


}
}
?>
