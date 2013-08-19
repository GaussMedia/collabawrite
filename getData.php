<?php
session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$sql = " SELECT * FROM `recommends` ";
$res = mysql_query($sql);
//$numResults = mysql_num_rows($res);
$i = 0;
$ars = array();
while($rowResult = mysql_fetch_array($res))
{
   // $rowdata[] =date("Y m d, g  i ",$rowResult[$i]['creation_date']);
    //$da = strtotime('d/m/Y h:i s' , strtotime($rowResult['creation_date']) );
     $sql_views ="SELECT * FROM views WHERE view_post = '$rowResult[recommend_post]' ";
     $res_views = mysql_query($sql_views);
     $count = mysql_num_rows($res_views);
     $rowdata[0] = date('Y, m, d' , $rowResult['creation_date']);
     $rowdata[1] = $count;
    //[$i]['view'] = "22";
    $ars[] = $rowdata;
    $i++;
    //$rowdata[] = date('d-M-Y',$rowResult[$i]['creation_date']);
}

echo json_encode($ars);

?>
