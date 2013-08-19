<?php

include('config.php');
getConnection();
$id=$_GET['id'];
$table=$_GET['table'];
$action=$_GET['action'];
//print_r($action);
//print_r($table);
//die;
    
Status_Selected($id,$table,$action);
function Status_Selected($id, $table ,$action){
$obj=new KARAMJEET();
 if($action == "Unpicked")  
      {
         $res=$obj->Query("UPDATE  $table SET editor_pick='1' WHERE `id`='$id' ");
         //die;
         //$res=mysql_query($sql)or die(mysql_error());
		 if($res)
		 {
          echo 'Picked';
		 }

      }

 else if($action == "Picked") 

   {
	  $res=$obj->Query("UPDATE  $table SET editor_pick='0' WHERE `id`='$id' ");
	  //$res=mysql_query($sql)or die(mysql_error());
	  if($res)
	  {
	   echo 'Unpicked'; 
	  }

   }
   
 }
?>