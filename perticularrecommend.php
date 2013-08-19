<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$session_id = $_SESSION['id'];
$post_id  = $_GET['post_id'];

    $sql_recs =  "SELECT * FROM recommends WHERE recommend_post = '$post_id'  ";
    $res_recs = mysql_query($sql_recs);
    $count =  mysql_num_rows($res_recs);
    //$dateArray = array();
    while($rowResult = mysql_fetch_array($res_recs)){
        $date = date('Y m d' , $rowResult['creation_date']);
        if(key_exists($date, $dateArray)){
            $dateArray[$date] = $dateArray[$date]+1;
        }else{
            $dateArray[$date] = 1;
        }
    }
    //$fullDate[$Result_post['id']] = $dateArray;

//}

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
