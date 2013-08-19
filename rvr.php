<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$session_id = $_SESSION['id'];
?>
<?php
//Total Views
  $session_id = $_SESSION['id'];
  $sql_post ="SELECT * FROM drafts WHERE status = '1' AND author = '$session_id' ";
  $res_post = mysql_query($sql_post);
  while($Result_post = mysql_fetch_array($res_post)){
      $ars = array();
      $Result_post['id'];
      $sql_view ="SELECT * FROM views WHERE view_post = '$Result_post[id]'  ";
      $res_view = mysql_query($sql_view);
      $count =  mysql_num_rows($res_view);
      while($rowResult = mysql_fetch_array($res_view)){
          $date = date('Y m d' , $rowResult['creation_date']);
          if(key_exists($date, $dateArray)){
              $dateArray[$date] = $dateArray[$date]+1;
          }else{
              $dateArray[$date] = 1;
          }
      }

  }
  $views = 0;
  foreach($dateArray as $key=>$value){
      $views = $views + $value;
  }
  //echo $views;  
  if($views == 0){
      $ars['Views'] = 0;
  }else{
      $ars['Views'] = $views;
  }
          
        ?>
 <?php
 //Recomends
    $sql_post ="SELECT * FROM drafts WHERE status = '1' AND author = '$session_id' ";
    $res_post = mysql_query($sql_post);
    $recs = 0;
    while($Result_post = mysql_fetch_array($res_post)){
    $ars = array();
    $Result_post['id'];
    $sql_recs =  "SELECT * FROM recommends WHERE recommend_post = '$Result_post[id]'  ";
    $res_recs = mysql_query($sql_recs);
    $count =  mysql_num_rows($res_recs);
    $recs = $recs + $count;
    }
   // echo $recs; 
    if($recs == 0){
        $recs = 0;
    }else{
        $ars['Recomends'] = $recs;
    }
    
    echo json_encode(array('Views'=>$views,'Recommends'=>$recs));
?>