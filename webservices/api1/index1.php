<?php
session_start();
///print_r($_SESSION);
//die;
require 'Slim/Slim.php';
$app = new Slim();
$app->get('/', 'Index');
$app->get('/city/:page', 'getUsersDratfs');
$app->get('/login/:email/:pass', 'loginUser');
$app->get('/users', 'getUsers');
$app->get('/users/:id',	'getUser');
$app->get('/users/search/:query', 'findByName');
$app->get('/adduser/:first_name/:last_name/:email/:pass', 'addUser');
$app->get('/users/:id/:first_name/:last_name/:email/:pass', 'updateUser');
$app->get('/deluser/:id','deleteUser');
$app->get('/changepwd/:id/:oldpwd/:newpass','ChangePassword');
$app->get('/read','readData');
$app->get('/maxdate','maxDate');
$app->get('/fetch','fetch');
$app->get('/test/:fst/:lst/:eml/:pwd','test');

$app->run();
function getUsersDratfs($page) {
        
	$num = 5*$page;
	$end_page = $num+5;
	$i =0;
        $ip = $_SERVER['SERVER_ADDR'];
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
	$city=$ip_data->geoplugin_city;
        $addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;
    $app=Slim::getInstance();

        $sql = "SELECT * FROM `drafts` WHERE status='1' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$city%')";
	try {
            
        $db = getConnection();
        $stmt = $db->query($sql);
        $drafts = $stmt->fetchAll(PDO::FETCH_OBJ);
        //$drafts->post = strip_tags($drafts->post);
        //foreach($drafts as $k=>$draft)
       // {
        //echo $author_id = $draft->id;
        //}
//        echo '<pre>';
//        print_r($drafts);
//        exit;
          //echo count($drafts);
        //$k = 1;
         $count = count($drafts);
        for($j=0;$j<$count;$j++)
        //foreach($drafts as $k=>$draft)
        {	
            //$k = $k+1;
            $author_id = $drafts[$j]->author;
            $sql1 = "SELECT * FROM `twitter_users`  WHERE id='$author_id' ";
            $stmt1 = $db->prepare($sql1);  
            $stmt1->execute();
            $author = $stmt1->fetchObject();
           
            $collection_id = $drafts[$j]->collection_id;
            $sql2 = "SELECT * FROM `collections` WHERE id='$collection_id' ";
            $stmt2 = $db->prepare($sql2);  
            $stmt2->execute();
            $collection = $stmt2->fetchObject();
            
            $draft_id = $drafts[$j]->id;
            $sql3 = "SELECT * FROM `drafts` WHERE id='$draft_id' ";
            $stmt3 = $db->prepare($sql3);  
            $stmt3->execute();
            $dd = $stmt3->fetchObject(); 

                //echo $draft->id;
                 // echo '<br>';
                if(json_encode($author)=="false" AND json_encode($collection)=="false")
                {
                        $i++;	
                        if($i >= $num and $i < $end_page)
                        {
                                $arr[] = array(
                                        'id' => $drafts[$j]->id,
                                        'image' => $image,
                                        'title' => $drafts[$j]->title,
                                        'post' => $drafts[$j]->post,
                                        'creation_date' => $drafts[$j]->creation_date,
                                        'status' => $drafts[$j]->status 
                                        );
                        }							
                }
                if(json_encode($author) != "false" AND json_encode($collection) != "false")
                {

                    $i++;
                    if($i >= $num and $i < $end_page)
                    {
                        //$info2->image = stripslashes($info2->image);
                        $dd->post =  strip_tags($dd->post);
                        $drafts[$j]->post =  strip_tags($drafts[$j]->post);
                        if($drafts[$j]->image == ''){
                        $image = '';
                        }else{
                        $image = 'http://reportedly.pnf-sites.info/ajaximage/uploads/'.$drafts[$j]->image;
                        }
                        $arr[] = array(
                                'id' => $drafts[$j]->id,
                                'image' => $image,
                                'title' => $drafts[$j]->title,
                                'post' => $drafts[$j]->post,
                                'creation_date' => $drafts[$j]->creation_date,
                                'status' => $drafts[$j]->status 
                                );
                    }	
                }

        }
        //exit;
        $db = null;
        if(!empty($arr)){
            echo json_encode(array('Data'=>$arr)) ;}else{
            echo '{"error":"Sorry! Record not found"}';
        }

	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
function Index(){
    $ip = $_SERVER['SERVER_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//    echo '<pre>';
//    print_r($ip_data);
//    die;
$city=$ip_data->geoplugin_city;
$addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;//die;
    $app=Slim::getInstance();
        $sql_user = "SELECT id FROM twitter_users WHERE location LIKE '%$city%'";
	//$sql = "SELECT * FROM `drafts` WHERE status='1' ";
        //$sqlcollec ="SELECT * FROM `collections` WHERE status = '1' LIMIT 0,3 ORDER BY id DESC"; 
	try {
            $db = getConnection();
            $stmt = $db->query($sql_user);  
            $sql1 = "SELECT * FROM `drafts` WHERE author IN (SELECT id FROM twitter_users WHERE location LIKE '%$city%') ";

            $stmt1 = $db->query($sql1);  
            $drafts = $stmt1->fetchAll(PDO::FETCH_OBJ);
           //foreach ($drafts as $key){
             $count = count($drafts);
            for($i=0;$i<$count;$i++){
            $drafts[$i]->post =  strip_tags($drafts[$i]->post);
            $author_id = $drafts[$i]->author;
            $sql2 = "SELECT * FROM `twitter_users`  WHERE id='$author_id'  ";
            $stmt2 = $db->query($sql2);  
            $author = $stmt2->fetch(PDO::FETCH_OBJ);
            
            
            $collection_id = $drafts[$i]->collection_id;
            $sql3 = "SELECT * FROM `collections`  WHERE id='$collection_id'  ";
            $stmt3 = $db->query($sql3);  
            $collection = $stmt3->fetch(PDO::FETCH_OBJ);
            
            
//            $collection_id = $drafts[$i]->collection_id;
//            $sql3 = "SELECT * FROM `drafts`  WHERE id='$collection_id'  ";
//            $stmt3 = $db->query($sql3);  
//            $collection = $stmt3->fetchAll(PDO::FETCH_OBJ);
            
            //$ss[$i]['user'] = $drafts[$i];
           // $ss['data'][$i]=$i;
            $ss[$i]['draft'] = $drafts[$i];
            $ss[$i]['user'] = $author;
            $ss[$i]['collection'] = $collection;
            //$collection[$key]['collection']=$collection[$key];
            }
                //$drafts[]->post =  strip_tags($drafts[]->post);
                
            //}
            //echo "<pre>";
            //print_r($ss);
           // exit;
            echo json_encode(array("Data"=>$ss));
            
            //$stmtcollec = $db->query($sqlcollec);  
            //$collec3 = $stmtcollec->fetchAll(PDO::FETCH_OBJ);
                
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
function Index11(){
    $ip = $_SERVER['SERVER_ADDR'];
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
//    echo '<pre>';
//    print_r($ip_data);
//    die;
$city=$ip_data->geoplugin_city;
$addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;//die;
    $app=Slim::getInstance();
        $sql_user = "SELECT id FROM twitter_users WHERE location LIKE '%$city%'";
	$sql = "SELECT * FROM `drafts` WHERE status='1' ";
        //$sqlcollec ="SELECT * FROM `collections` WHERE status = '1' LIMIT 0,3 ORDER BY id DESC"; 
	try {
            $db = getConnection();
            $stmt = $db->query($sql_user);  
            $drafts = $stmt->fetchAll(PDO::FETCH_OBJ);
            //$db = null;
             //echo "<pre>";
             //print_r($drafts);
             //die;
            $count = count($drafts);
//            for($i=0;$i<$count;$i++){
//            //print_r($drafts[$i]);
//                $collection_id = $drafts[$i]->collection_id;
//                $sql1 = "SELECT * FROM `collections` WHERE id='$collection_id' ";
//                $stmt1 = $db->query($sql1);  
//                $collection = $stmt1->fetch(PDO::FETCH_OBJ);
//                //die;
//                //User
//                $author_id = $drafts[$i]->author;
//                $sql2 = "SELECT fullname,image FROM `twitter_users` WHERE id='$author_id' ";
//                $stmt2 = $db->query($sql2);  
//                $author = $stmt2->fetch(PDO::FETCH_OBJ);
//                
//                
//                $drafts[$i]->post =  strip_tags($drafts[$i]->post);
//                
//                $ss[$i]['draft'] = $drafts[$i];
//                //print_r($ss[$i]['draft']);
//                $ss[$i]['collection'] = $collection;
//                $ss[$i]['User'] = $author;
//                
//            }
            //echo "<pre>";
            //print_r($ss);
           // exit;
            echo json_encode(array('data'=>$ss));
            
            //$stmtcollec = $db->query($sqlcollec);  
            //$collec3 = $stmtcollec->fetchAll(PDO::FETCH_OBJ);
                
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
function test($fnm,$lnm,$email,$pass){
	$db=getConnection();
	$sql="INSERT INTO test(`fnm`,`lnm`,`email`,`pass`) VALUES('$fnm','$lnm','$email','$pass')";
	try{
	$stmt=$db->prepare($sql);
	$stmt->bindParam('',$fnm);
	$stmt->bindParam('',$lnm);
	$stmt->bindParam('',$email);
	$stmt->bindParam('',$pass);
	$stmt->execute();
	 print_r($stmt);
	}catch(Exception $e){
		print $e->getMessage();
	}
}
function fetch(){
	$db=getConnection();
	$sth = $db->prepare("SELECT first_name,email FROM users");
	$sth->execute();
	
	// Exercise PDOStatement::fetch styles 
	print("PDO::FETCH_ASSOC: ");
	print("Return next row as an array indexed by column name\n");
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	print_r($result);
	print("<br>");
	
}
function maxDate()
{
	$sql="SELECT max(id) AS maxid FROM users";
	try{
		$db=getConnection();
		$stmt=$db->query($sql);
		$d=$stmt->fetch(PDO::FETCH_OBJ);
		print_r($d);
	}catch(Exception $e){
	}
		
}

function readData() {
  $sql = 'SELECT id,first_name,last_name,email FROM users';
  try {
	$db=getConnection();
	$stmt = $db->prepare($sql);
	$stmt->execute();
    
	
	
    /* Bind by column number */
    $stmt->bindColumn(1, $id);
    $stmt->bindColumn(2, $first_name);
    
    /* Bind by column name */
        $stmt->bindColumn('last_name', $cals);
	$stmt->bindColumn('email', $email);
        echo "<table style=text-align:left;>";
        echo "<th>Id</th><th>First Name</th><th>Last Name</th><th>Email</th>";
        while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
      $data = "<tr style=text-align:left;><td>".$id . "</td><td>" . $first_name . "</td><td>" . $cals .  "</td><td>" . $email . "</td></tr>";
      print $data;
    }
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}

function loginUser($email,$pass) {
  
	$pass=md5($pass);
	 $sql = "SELECT id FROM twitter_users WHERE username='$email' AND password='$pass' ";
         
	
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("email", $email);
                $stmt->bindParam("username", $pass);
		$stmt->execute();
		$wine = $stmt->fetchObject();
                $db = null;
                
                if($wine){
                    $wine->message = "true";
                    echo json_encode($wine);
                //echo '{"message": '."success"."," . .'}' ;
                }else{
                   echo '{"message": "false"}';
                }
		//echo json_encode($wine); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
//	try {
//		$db = getConnection();
//		$stmt = $db->prepare($sql);  
//		$stmt->execute();
//		$exist = $stmt->fetchObject();
//		//print_r($stmt);
//		if($exist)
//		{
//			echo "Login Id ". json_encode($id); ;
//		}
//		else{
//		echo 'Username Or Password is Wrong';	
//		}
		//$db = null;
	
	//json_encode($stmt);
	//} catch(PDOException $e) {
		//echo '{"error":{"text":'. $e->getMessage() .'}}';
	//}
}


function getUsers() {
	$app=Slim::getInstance();
  
	$sql = "select * FROM twitter_users ORDER BY id";
        
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"users": ' . json_encode($users) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function ChangePassword($id,$oldpwd,$newpass)
{
	$oldpwd=md5($oldpwd);
	$sql1="SELECT pass FROM users WHERE id='$id' AND pass='$oldpwd' ";
	$db1 = getConnection();
	$stmt1 = $db1->prepare($sql1);
	$stmt1->execute();
	$exist = $stmt1->fetchObject();
	try {
	if($exist)
		{
			$newpass=md5($newpass);
			$sql2="UPDATE users SET pass='$newpass' WHERE  id='$id' AND pass='$oldpwd'";
			$db2 = getConnection();
			$stmt2 = $db2->prepare($sql2);
			$stmt2->execute();
			echo "Password Changed Successfully @ ID = ".$id;
		}
		else
		{
			echo 'Old Password Is = '.json_encode($exist);
			//echo 'Old Password Is Wrong='.md5($oldpwd).'';
		}
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}

}
