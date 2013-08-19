<?php
/*include('k.php');

function getConnection()
{
	$host='localhost';
	$user='root';
	$password='';
	$db='api1';
	$dbh=new connection();
	$dbh->construct($host,$user,$password,$db);
}
*/
include('config.php');
getConnection();
//Status Selected
$id=$_GET['id'];
$table=$_GET['table'];
$action=$_GET['action'];
//print_r($action);
//print_r($table);
//die;
    
Status_Selected($id,$table,$action);
function Status_Selected($id, $table ,$action){
	$obj=new KARAMJEET();
        if($table == 'companies')
     {
          $idddd='company_id';
     }
     else{
         if ($table == 'employees') {  $idddd='Employee_id';    }
         else {  $idddd='id'; }
         }
 if($action == "Unpublish")  
      {
     
         $res=$obj->Query("UPDATE  $table SET status='1' WHERE `$idddd`='$id' ");
         //die;
         //$res=mysql_query($sql)or die(mysql_error());
		 if($res)
		 {
          echo 'Publish';
		 }

      }

 else if($action == "Publish") 

   {
     
 
	  $res=$obj->Query("UPDATE  $table SET status='0' WHERE `$idddd`='$id' ");
	  //$res=mysql_query($sql)or die(mysql_error());
	  if($res)
	  {
	   echo 'Unpublish'; 
	  }

   }
   else if($action == "Delete") 

   {
	  $res=$obj->Query("DELETE FROM $table WHERE `$idddd`='$id' ");
	  //$res=mysql_query($sql)or die(mysql_error());
	  if($res)
	  {
	   echo 'Delete'; 
	  }

   }
 }
?>