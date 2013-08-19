<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$session_id = $_SESSION['id'];
$sql_post ="SELECT * FROM drafts WHERE status = '1' AND author = '$session_id' ";
$res_post = mysql_query($sql_post);
while($Result_post = mysql_fetch_array($res_post)){
    $ars = array();
    $Result_post['id'];
    $sql_view ="SELECT * FROM views WHERE view_post = '$Result_post[id]'  ";
    $res_view = mysql_query($sql_view);
    $count =  mysql_num_rows($res_view);
    //$dateArray = array();
    while($rowResult = mysql_fetch_array($res_view)){
        $date = date('Y m d' , $rowResult['creation_date']);
        if(key_exists($date, $dateArray)){
            $dateArray[$date] = $dateArray[$date]+1;
        }else{
            $dateArray[$date] = 1;
        }
    }
    //$fullDate[$Result_post['id']] = $dateArray;

}

//echo "<pre>";



foreach($dateArray as $key=>$value){
   // $fullArray['value'][$key] = $value;
    
    $rowdata[0] = $key;
    $rowdata[1] = $value;
    //[$i]['view'] = "22";
    $ars[] = $rowdata;
    
}
//print_r($ars);
//exit;
echo json_encode($ars);

?>
