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
//print_r($id);
//print_r($action);
//print_r($table);
//die;
//All_Status_Selected($id,$table,$action);
//$data = array('status' => '0');
 
$obj=new KARAMJEET();
if($table == 'companies')
     {
          $idddd='company_id';
     }
else{
    if ($table == 'employees') { echo $idddd='Employee_id';    }
    else {  $idddd='id'; }
    }   
 
 if($action == "Unpublish")  
  {
   $data = array('status' => '0');
  }
  if($action == "Publish")  
  {
   $data = array('status' => '1');
  }
  
     $res=$obj->update($table,$data,"$idddd='$id'");
                 if($res)
		 {echo $action;}
                 else{ echo 'not done'; }
   
  if($action == "Delete") 
   {

	  $res=$obj->Query("DELETE FROM $table WHERE `$idddd`='$id' ");
	  if($res)
	  {
	   echo 'Delete'; 
	  }

   }
     
 /*function All_Status_Selected($id, $table ,$action){

 if($action == "Unpublish")  
  {
     
     //$data = array('status' => '0');
     //$res=$obj->update($table,$data,'$idddd='.$id);
         //$res=$obj->Query("UPDATE  $table SET status='0' WHERE `".$idddd."`='".$id."' ");
         die;
     //print_r($res);
     
		 if($res)
		 {echo 'Unpublish';}
                 else{ echo 'not done'; }

      }

 else if($action == "Publish") 

   {
     
     //$data = array('status' => '1');
     //$res=$obj->update($table,$data,'$idddd='.$id);
	$res=$obj->Query("UPDATE  $table SET status='1' WHERE `".$idddd."`='".$id."' ");
     //print_r($res);
     //echo $res;
     //die;
	  if($res)
	  {
	   echo 'Publish'; 
	  }
          else
          {
              echo 'not done';
          }

   }
   else */

?>