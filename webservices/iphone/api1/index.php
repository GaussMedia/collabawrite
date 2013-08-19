<?php

require 'Slim/Slim.php';
$app = new Slim();
$app->get('/', 'Index');
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
function Index(){
    $app=Slim::getInstance();
  
	$sql = "select * FROM twitter_users ORDER BY id";
        
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"users": ' . json_encode($users) . '}<br>';
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


function getUser($id) {
	$app=Slim::getInstance();
	$sql = "SELECT * FROM users WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$user = $stmt->fetchObject();  
		//$db = null;
		echo json_encode($user); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addUser($first_name,$last_name,$email,$pass) {
	$CHK="SELECT email FROM users WHERE email='$email'";
	$db1 = getConnection();
	$stmt1 = $db1->prepare($CHK);
	$stmt1->execute();
	$exist = $stmt1->fetchObject();
	if($exist)
	{
		
		echo 'Email Already Exists'; 
	}
	else{
	    $sql = "INSERT INTO users (first_name, last_name, email, pass) VALUES ( '$first_name', '$last_name', '$email', '$pass')";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->execute();
		echo "Inserted Id=".$db->lastInsertId();
		//echo json_encode($stmt); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
	}
	

}

function updateUser($id,$first_name,$last_name,$email,$pass) {
$sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', pass='$pass'  WHERE id='$id' ";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->execute();
		echo "Updated Id=".$id;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteUser($id) {
	$app=Slim::getInstance();
	$sql = "DELETE FROM users WHERE id='$id' ";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->execute();
		echo "Id No. ".$id." Deleted Successfully";
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function findByName($query) {
	$app=Slim::getInstance();
	 $sql = "SELECT * FROM users WHERE UPPER(first_name) LIKE '$query' ORDER BY first_name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"Users": <br>' . json_encode($users) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getConnection() {
	$app=Slim::getInstance();
	$dbhost="localhost";
	$dbuser="c2_reportedly";
	$dbpass="123456";
	$dbname="c2_reportedly";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>
