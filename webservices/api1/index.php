<?php
session_start();
///print_r($_SESSION);
//die;
require 'Slim/Slim.php';
$app = new Slim();
$app->get('/home/:uid/:page', 'Index');
$app->get('/collections/:page', 'Collections');
$app->get('/mostrecent/:uid/:page', 'MostRecentReport');
$app->get('/recommend/:uid/:page', 'MostRecommend');
//All locations
$app->get('/allloc','AllLocations');


//LoginUser
$app->get('/user/:id', 'LoginUserPrifile');
$app->get('/collectionreport/:id/:page', 'CollectionReports');
$app->get('/userreports/:id/:page', 'LoginUserReports');
$app->get('/collections/:id/:page', 'UserCollections');

//Guest
$app->get('/guestindex/:location/:page', 'IndexGuests');
$app->get('/collections/:location/:page', 'CollectionsGuests');
$app->get('/guestmostrecent/:location/:page', 'MostRecentReportGuests');
$app->get('/guestrecommend/:location/:page', 'MostRecommendGuests');

//Single Report & Collection
$app->get('/report/:id', 'ReportUserssss');
$app->get('/post/:id/:kk', 'Report');
$app->get('/mytest/:id', 'Mytest');
$app->get('/collectionm/:colid', 'CollectionModified');
$app->get('/collection/:id/:kk', 'collection');

$app->get('/collectionuserreports/:collectionid/:userid/:page', 'CollectionUserReports');

//user
$app->get('/signup/:usrname/:fullname/:eml/:pwd/:location','Signup');
$app->get('/updateuser/:id/:first_name/:email/:description/:website', 'updateUser');

//Create,Update,Delete Collection
$app->get('/createcollection/:id/:name/:description/:type','CreateCollection');
$app->get('/usercollection/:uid/:collid','UserCollection');
$app->get('/editcollection/:uid/:collid/:colname/:coll/:type','EditCollection');
$app->get('/deletecollection/:uid/:collid','DeleteCollection');

//Create,Update,Delete Report
$app->get('/addreport/:uid/:collid/:title/:subtitle/:decription','AddReport');
$app->get('/updatereport/:uid/:collid/:postid/:title/:subtitle/:decription','UpdateReport');

//Recommend
$app->get('/like/:uid/:collid/:postid','Recommend');

//Share
$app->get('/share/','Share');

//Add Invitee
$app->get('/addinvitee/:uid/:collid/:email','AddInvitee');
$app->get('/Removeinvitee/:uid/:collid/:email','RemoveInvitee');

//Stats
$app->get('/stats/:uid/:page','Status');


//Demo's
$app->get('/demo/:page','DemoPagination');
$app->get('/city/:page', 'getUsersDratfs');

$app->get('/login/:email/:pass', 'loginUser');
$app->get('/users', 'getUsers');
$app->get('/users/:id','getUser');
$app->get('/users/search/:query', 'findByName');
$app->get('/adduser/:first_name/:last_name/:email/:pass', 'addUser');
$app->get('/deluser/:id','deleteUser');
$app->get('/changepwd/:id/:oldpwd/:newpass','ChangePassword');
$app->get('/read','readData');
$app->get('/maxdate','maxDate');
$app->get('/fetch','fetch');
$app->get('/test/:fst/:lst/:eml/:pwd','test');

$app->get('/sendemail/:email', 'Email'); 



//$app->get('/usersm', function () use ($app) {
//
//    $users = twitter_users::all();
//
//    $res = $app->response();
//    $res['Content-Type'] = 'application/json';
//    $res->body($users);
//});

$app->run();

//Share
//function Share()
//{
//    
//}

function AllLocations(){

  $sql1 = "SELECT location FROM drafts GROUP BY location  ";
        
       try{
              $db = getConnection();
              $stmt = $db->query($sql1);
              $drafts = $stmt->fetchAll(PDO::FETCH_OBJ);
              //echo count($drafts);die;
                 if(!empty($drafts)){
                    $count = count($drafts);
                    for($j=0;$j<$count;$j++)
                   {
                        $location = $drafts[$j]->location;
                        if(!empty($location)){
                        $sql2 = "SELECT * FROM drafts WHERE location='$location' ";
                        $stmt1 = $db->query($sql2);
                        $counter = $stmt1->fetchAll(PDO::FETCH_OBJ);
                        if(!empty($count)){
                              $cnt = count($counter);
                              $arr[] = array(
                                   'location'=>$location,
                                   'Total_posts'=>$cnt
                                    );
                        }
                        //echo $cnt = count($counter).'<br>';
                        }
                   }
                    if(!empty($arr)){
                    echo json_encode(array('Message'=>'true','Data'=>$arr));
                }else{
               echo json_encode(array('Message'=>'false'));
           }
            
            }else{
               echo json_encode(array('Message'=>'false'));
           }
        }catch(Exception $e){
                   print $e->getMessage();
                }
}

function AddReport($uid,$collid,$title,$subtitle,$desc)
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    //    echo '<pre>';
    //    print_r($ip_data);
    //    die;
    $addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;
    $d = time();
    $sql="INSERT INTO drafts(location,collection_id,title,sub_title,post,author,creation_date) VALUES('$addrress','$collid','$title','$subtitle','$desc','$uid','$d')";
    try{
          $db = getConnection();
          $pre = $db->prepare($sql);
          if($pre->execute()){
               echo  json_encode(array('Message'=>'true','Insertedid'=>$db->lastInsertId(),'collection_id'=>$collid));
          }
          else{
              echo  json_encode(array('Message'=>'false'));
          }

   }
    catch(Exception $e){
                   print $e->getMessage();
                }
}

function UpdateReport($uid,$collid,$postid,$title,$subtitle,$desc)
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    //    echo '<pre>';
    //    print_r($ip_data);
    //    die;
    $addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;
    $d = time();
    $sql="UPDATE drafts SET  title='$title',sub_title='$subtitle',post='$desc' WHERE collection_id='$collid' AND id='$postid' AND author='$uid' ";
    try{
          $db = getConnection();
          $pre = $db->prepare($sql);
          if($pre->execute()){
               echo  json_encode(array('Message'=>'true','Updatedid'=>$postid));
          }
          else{
              echo  json_encode(array('Message'=>'false'));
          }

   }
    catch(Exception $e){
                   print $e->getMessage();
                }
}

function DeleteCollection($uid,$collid){
    $sql_chk_p = "SELECT * FROM drafts WHERE status = '1' AND collection_id = '$collid' ";
    
    try{
        $db = getConnection();
        $res_chk_p =  $db->query($sql_chk_p);
        $fetch = $res_chk_p->fetch();
//        echo '<pre>';
//        print_r($fetch);
//        die;
        if(count($fetch)>0)
        {
            echo json_encode(array('Message'=>'false','status'=>'collection could not be deleted'));
        }else{
            $sql = "SELECT * FROM collections WHERE id='$collid' AND collection_author='$uid' ";
        
        $ss = $db->query($sql);
        $coll = $ss->fetch();
        if(!empty($coll)){
                  $sql_del = "DELETE FROM collections WHERE id='$collid' AND collection_author='$uid' ";
                  $del = $db->prepare($sql_del);
                  if($del->execute()){
                      echo json_encode(array('Message'=>'true','status'=>'collection deleted'));
                  }
        }else{
            echo json_encode(array('Message'=>'false','status'=>'collection does not exist'));
        }
        }
        
        }catch(Exception $e){
                   print $e->getMessage();
                }
}

//Recommend
function Recommend($uid,$collid,$postid)
{
    $sql_user = "SELECT * FROM twitter_users WHERE id='$uid' AND status='1' ";
    $sql_coll = "SELECT * FROM collections WHERE id='$collid' AND status='1' ";
    $sql_post = "SELECT * FROM drafts WHERE id='$postid' AND status='1' ";
    try
    {
        $db = getConnection();
        
        $res_user = $db->query($sql_user);
        $fetch_user = $res_user->fetch();
        //echo '<pre>';
        //print_r($fetch_user);
        $res_coll = $db->query($sql_coll);
        $fetch_coll = $res_coll->fetch();
        //print_r($fetch_coll);
        $res_post = $db->query($sql_post);
        $fetch_post = $res_post->fetch();
        //print_r($fetch_post);
       // exit;
        if(empty($fetch_user) or empty($fetch_coll) or empty($fetch_post) ){
            echo json_encode(array('Message'=>'false'));
        }else{
        $sql_chk = "SELECT * FROM recommends WHERE recommend_user='$uid' AND recommend_post='$postid' ";
        $res_chk = $db->query($sql_chk);
        $fetch = $res_chk->fetch();
        if(empty($fetch))
            {
            $d = time();
            $sql="INSERT INTO recommends (recommend_user,recommend_post,recommend_collection,creation_date) VALUES('$uid','$postid','$collid','$d')";
            $res = $db->prepare($sql);
            if($res->execute()){
                echo json_encode(array('Message'=>'true','status'=>'Liked'));
            }
        }
        else
            {
            $sql1 = "DELETE FROM recommends WHERE recommend_user='$uid' AND recommend_post='$postid' ";
            $res1 = $db->prepare($sql1);
            if($res1->execute()){
                echo json_encode(array('Message'=>'true','status'=>'Unliked'));
            }
        }
        }
    }catch(Exception $e){
        print $e->getMessage();
    }
}


function AddInvitee($uid,$collid,$email)
{
    if(!empty($email)){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    if (!preg_match($regex, $email)) {
        echo  json_encode(array('Message'=>'false','status'=>'there is something wrong with your email. check your email and try again'));
    } 
    else{
                 $sql_chk = "SELECT  *  FROM `twitter_users` WHERE `email`='$email'";
                 
	try{
                            $db = getConnection();
                            $stmt_chk = $db->query($sql_chk);
                            $user_chk= $stmt_chk->fetchObject();
                             if (!empty($user_chk)){
                            $sql_coll = "SELECT  *  FROM `collections` WHERE `id`='$collid'";
                            $stmt_coll = $db->query($sql_coll);
                            $user_coll= $stmt_coll->fetchObject();
                            
                            //check invitee
                            $chk_invitee = "SELECT * FROM collection_invitee WHERE author_id=$uid AND collection_id='$collid'
 AND invitee_id ='$user_chk->id' ";
                            $stmt_invitee = $db->query($chk_invitee);
                            $invitee  = $stmt_invitee->fetchObject();
                           //echo $user_chk->fullname;
                            //print_r($user_coll);
                            //exit;
                            if(empty($invitee)){
                           // if(!empty($user_chk) AND !empty($user_coll)){
                                
                                include "PHPMailer_v5.1/class.phpmailer.php"; // something like this include include "PHPMailer_v2.0.0/class.phpmailer.php";
                                $mail = new PHPMailer();
                                $mail->IsSMTP(); // set mailer to use SMTP
                                $mail->Host = "ssl://smtp.gmail.com"; // specify main and backup server
                                $mail->Port = 465; // set the port to use
                                $mail->SMTPAuth = true; // turn on SMTP authentication
                                $mail->Username = "karamjeetpnf@gmail.com"; // your SMTP username or your gmail username
                                $mail->Password = "#karampnf#"; // your SMTP password or your gmail password
                                $from = "webmaster@example.com"; // Reply to this email
                                $to=$email; // Recipients email ID
                                $name="Karamjeet"; // Recipient's name
                                $mail->From = $from;
                                $mail->FromName = "Reportedly"; // Name to indicate where the email came from when the recepient received
                                $mail->AddAddress($to,$name);
                                $mail->AddReplyTo($from,"Reportedly");
                                $mail->WordWrap = 50; // set word wrap
                                $mail->IsHTML(true); // send as HTML
                                $mail->Subject = $user_chk->fullname." has invited you in a collection to write reports";
                                $mail->Body ='<table cellpadding="10" style="border-color: #666;"><tbody><tr style="background: #fddea7;"><td><font color="#990000"><strong> '.$user_chk->fullname.',</strong></font>has invited you to contribute to the following collection on Reportedly.<br><br><br>
<a target="_blank" href="http://reportedly.pnf-sites.info/collection?collection_name='.$user_coll->id.'">'.$user_coll->collection_name.' </a><br>Thank you,<br>Team Reportedly <br>Thanks! </td></tr></tbody></table>' ; //HTML Body
                                //$mail->Body = "Thanks for creating an account on Reportedly! To verify your account, please click the link below <br>http://reportedly.pnf-sites.info/confirm.php?passkey=$confirm_code<br>If you believe you received this in error, feel free to ignore. You may contact us at hello@Reportedly.co <br>Thanks!"; //HTML Body
                                $mail->AltBody = "This is the body when user views in plain text format"; //Text Body
                                if(!$mail->Send())
                                {
                                 echo  json_encode(array('Message'=>'false','status'=>'Email not sent check email'));
                                }
                                else
                                {
                                    $d = time();
                                       $sql="INSERT INTO `collection_invitee`(`invitee_id`,`author_id`,`collection_id`,`email`,`creation_date`) VALUES('$user_chk->id','$uid','$collid','$email','$d')";
                                        $stmt=$db->prepare($sql);
                            //            $stmt->bindParam('invitee_id',$inv_id);
                            //            $stmt->bindParam('author_id',$uid);
                            //            $stmt->bindParam('collection_id',$collid);
                            //            $stmt->bindParam('email',$email);
                                        if($stmt->execute()){
                                        echo  json_encode(array('Message'=>'true','status'=>'Invitation sent'));
                                        }
                                }


//                        include "PHPMailer_v5.1/class.phpmailer.php"; // something like this include include "PHPMailer_v2.0.0/class.phpmailer.php";
//                        //$confirm_code=md5($email); 
//                        $mail = new PHPMailer();
//                        $mail->IsSMTP(); // set mailer to use SMTP
//                        $mail->Host = "ssl://smtp.gmail.com"; // specify main and backup server
//                        $mail->Port = 465; // set the port to use
//                        $mail->SMTPAuth = true; // turn on SMTP authentication
//                        $mail->Username = "karamjeetpnf@gmail.com"; // your SMTP username or your gmail username
//                        $mail->Password = "#karampnf#"; // your SMTP password or your gmail password
//                        $from = "webmaster@example.com"; // Reply to this email
//                        $to=$email; // Recipients email ID
//                        $name="Karamjeet"; // Recipient's name
//                        $mail->From = $from;
//                        $mail->FromName = "Reportedly"; // Name to indicate where the email came from when the recepient received
//                        $mail->AddAddress($to,$name);
//                        $mail->AddReplyTo($from,"Reportedly");
//                        $mail->WordWrap = 50; // set word wrap
//                        $mail->IsHTML(true); // send as HTML
//                        $mail->Subject = " Sending Email From Php Using Gmail";
//                        $mail->Body ='<table cellpadding="10" style="border-color: #666;"><tbody><tr style="background: #fddea7;"><td><font color="#990000"><strong> '.$user_chk->fullname.',</strong></font>has invited you to contribute to the following collection on Reportedly.<br><br><br>
//<a target="_blank" href="http://reportedly.pnf-sites.info/collection?collection_name='.$user_coll->id.'">'.$user_coll->collection_name.' </a><br>Thank you,<br>Team Reportedly <br>Thanks! </td></tr></tbody></table>' ; //HTML Body
////        $mail->Body ='<table cellpadding="10" style="border-color: #666;"><tbody><tr style="background: #fddea7;"><td><font color="#990000"><strong>karam</strong></font>has invited you to contribute to the following collection on Reportedly.<br><br><br>
////<a target="_blank" href="http://reportedly.pnf-sites.info/collection?collection_name=127">Karam</a><br>Thank you,<br>Team Reportedly <br>Thanks! </td></tr></tbody></table>' ; //HTML Body
//        $mail->AltBody = "This is the body when user views in plain text format"; //Text Body
//
//        if(!$mail->Send())
//        {
//        echo  json_encode(array('Message'=>'Email not sent check email'));
//        }
//        else
//        {
//$sql="INSERT INTO `collection_invitee`(`invitee_id`,`author_id`,`collection_id`,`email`,`creation_date`) VALUES('$user_chk[id]','$uid','$collid','$email','$pass','$d')";
//            $stmt=$db->prepare($sql);
////            $stmt->bindParam('invitee_id',$inv_id);
////            $stmt->bindParam('author_id',$uid);
////            $stmt->bindParam('collection_id',$collid);
////            $stmt->bindParam('email',$email);
//            $stmt->execute();
//            echo  json_encode(array('Message'=>'Invitation sent'));
//        }
//                    
}
                            else{
                                echo  json_encode(array('Message'=>'false','status'=>'Already invited'));
                            }  
                        }
                        else{
                            echo  json_encode(array('Message'=>'false','status'=>'User not avialable'));

                                            }
        }
                 catch(Exception $e){
                   print $e->getMessage();
                        }
           }
    }
}

//function RemoveInvitee($id,$collid){
//    
//}
   

function Status($uid,$page){
    $num = 5*$page;
    $end_page = $num+5;
    $i =0;
    $sql_posts ="SELECT * FROM drafts WHERE status = '1' AND author = '$uid' ";
      
   try{
        $db = getConnection();
        $stmt1 = $db->query($sql_posts);
        $dartfs = $stmt1->fetchAll(PDO::FETCH_OBJ);
        $count = count($dartfs);
       
        for($j=0;$j<$count;$j++)
        {
            //$collections[$j]->collection = strip_tags($collections[$j]->collection);
            $dartfs_id = $dartfs[$j]->id;
            $dartfs_author = $dartfs[$j]->author;
            $dartfs_collection_id = $dartfs[$j]->collection_id;
            //View Count
            $sql_views ="SELECT * FROM views WHERE view_post = '$dartfs_id'  ";
            $stmt_views = $db->prepare($sql_views);  
            $stmt_views->execute();
            $views = $stmt_views->fetchAll(PDO::FETCH_OBJ);
            $View_count = count($views);
            
            //Read Count
            $Read_count = count($views);
            
            //Reacommend Count
            $sql_recs =  "SELECT * FROM recommends WHERE recommend_post = '$dartfs_id'  ";
            $stmt_recs = $db->prepare($sql_recs);  
            $stmt_recs->execute();
            $recs = $stmt_recs->fetchAll(PDO::FETCH_OBJ);
            $Rec_count = count($recs);
            
            //Drafts Author
            $sql2 = "SELECT * FROM `twitter_users` WHERE id='$dartfs_author' ";
            $stmt2 = $db->prepare($sql2);  
            $stmt2->execute();
            $user = $stmt2->fetch(PDO::FETCH_OBJ);
            
            if(!empty($user)){
            $fullName = $user->fullname;
            }else{
                $fullName ='User name not available';    
            }
             if(!empty($user)){
            $user_link = 'http://reportedly.pnf-sites.info/profile?profile='.$user->username;
            }else{
                $user_link = 'Link not available';    
            }
            
            ////======Drafts Author======/////
            
            
            //Drafts collection
            $sql4 = "SELECT * FROM `collections` WHERE id='$dartfs_collection_id' AND status='1'  ";
            $stmt4 = $db->prepare($sql4);  
            $stmt4->execute();
            $collection = $stmt4->fetch(PDO::FETCH_OBJ);
            
            if(!empty($collection)){
            $collection_name = $collection->collection_name;
             }else{
                 $collection_name = 'Not Available';
             }
             if(!empty($collection)){
            $collection_link = 'http://reportedly.pnf-sites.info/collection?collection_name='.$collection->id;
             }else{
                 $collection_link = 'Not Available';
             }
             
             //=====Collection======////
             
             
             //==== Facebook Shares ====//
            $sql_fb_shrs =  "SELECT * FROM shares WHERE post_id = '$dartfs_id' AND  share_on='Facebook'  ";
            $stmt_fb_shrs = $db->prepare($sql_fb_shrs);  
            $stmt_fb_shrs->execute();
            $fb_shrs = $stmt_fb_shrs->fetchAll(PDO::FETCH_OBJ);
            $Total_fb_shrs = count($fb_shrs);
             
             //====== facebook shares====//
             

           //==== Facebook Shares ====//
            $sql_t_shrs =  "SELECT * FROM shares WHERE post_id = '$dartfs_id' AND  share_on='Twiiter'  ";
            $stmt_t_shrs = $db->prepare($sql_t_shrs);  
            $stmt_t_shrs->execute();
            $t_shrs = $stmt_t_shrs->fetchAll(PDO::FETCH_OBJ);
            $tweets = count($t_shrs);
             
             //====== facebook shares====//
 


           //=====Data Array=====////
             if(json_encode($dartfs) != "false")
            {

                $i++;
                if($i > $num and $i <= $end_page)
                {
                    if(!empty($dartfs[$j])){
                        $post_link = 'http://reportedly.pnf-sites.info/post_more?post='.base64_encode($dartfs[$j]->id);
                    }else{
                        $post_link = 'Link not available';
                    }
            
                    $arr[] = array(
                        'id' => $dartfs[$j]->id,
                        'title' => $dartfs[$j]->title,
                        'views' => $View_count,     
                        'reads' => $Read_count,
                        'recommendations' => $Rec_count,
                        'status' => $dartfs[$j]->status ,
                        'creation_date' => $dartfs[$j]->creation_date,
                        'Collection_name'=>$collection_name,
                        'Post_author'=>$fullName,
                        'post_link' => $post_link,
                        'user_link'=>$user_link,
                        'collection_link'=>$collection_link,
                        'Facebook_shares'=>$Total_fb_shrs,
                        'Tweets'=>$tweets
               );
                }
            }
            
        }
       //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['data']  = $arr;
            
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function Signup($username,$fullname,$email,$pass,$location){
	$db=getConnection();
        
   
    if(!empty($email)){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    if (!preg_match($regex, $email)) {
        echo  json_encode(array('Message'=>'there is something wrong with your email. check your email and try again'));
    } 
    else{
        
//        $err_email = '';
//    }
//    
//    }
    
//     if(strlen($pass)<6){
//        //echo  json_encode(array('status'=>'password must be atleast 6 characters long'));
//       $err_pwd = 'password must be atleast 6 characters long';
//    }else{
//        $err_pwd = '';
//    }
    
    //if(empty($err_email) && empty($err_pwd))
    //{        
	$sql_chk="SELECT  email FROM `twitter_users` WHERE `email`='$email'";
	try{
            $db = getConnection();
            $stmt_chk = $db->query($sql_chk);
            $user_chk= $stmt_chk->fetchObject();
            //print_r($user_chk);
            //exit;
            if(empty($user_chk)){
                $pass = md5($pass);
       include "PHPMailer_v5.1/class.phpmailer.php"; // something like this include include "PHPMailer_v2.0.0/class.phpmailer.php";
        $confirm_code=md5($email); 
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "ssl://smtp.gmail.com"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = "karamjeetpnf@gmail.com"; // your SMTP username or your gmail username
        $mail->Password = "#karampnf#"; // your SMTP password or your gmail password
        $from = "webmaster@example.com"; // Reply to this email
        $to=$email; // Recipients email ID
        $name="Karamjeet"; // Recipient's name
        $mail->From = $from;
        $mail->FromName = "Reportedly"; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to,$name);
        $mail->AddReplyTo($from,"Reportedly");
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = " Reportedly Confirmationl";
        $mail->Body = "Thanks for creating an account on Reportedly! To verify your account, please click the link below <br>http://reportedly.pnf-sites.info/confirm.php?passkey=$confirm_code<br>If you believe you received this in error, feel free to ignore. You may contact us at hello@Reportedly.co <br>Thanks!"; //HTML Body
        $mail->AltBody = "This is the body when user views in plain text format"; //Text Body

        if(!$mail->Send())
        {
        echo  json_encode(array('Message'=>'there is something wrong with your email. check your email and try again'));
        }
        else
        {
        $sql="INSERT INTO `twitter_users`(`confirm_code`,`username`,`fullname`,`email`,`password`,`location`) VALUES('$confirm_code','$username','$fullname','$email','$pass','$location')";
            $stmt=$db->prepare($sql);
            $stmt->bindParam('confirm_code',$confirm_code);
            $stmt->bindParam('username',$username);
            $stmt->bindParam('email',$email);
            $stmt->bindParam('password',$pass);
            $stmt->execute();

            echo  json_encode(array('Message'=>'User Inserted successfully'));
        }
                    
}
            else{
                echo  json_encode(array('Message'=>'false','status'=>'Username or Email already exits'));
            }  
}catch(Exception $e){
        print $e->getMessage();
}
    }
    }
        
}


function CreateCollection($uid,$name,$description,$type){
$sql_conut_coll = "SELECT * FROM collections WHERE collection_author='$uid' ";
        $db=getConnection();
        try{
            $db = getConnection();
                    $chk = $db->query($sql_conut_coll);
                    $count_coll = $chk->fetchAll(PDO::FETCH_OBJ);
                    $count = count($count_coll);
                    if($count >7){
                        echo  json_encode(array('Message'=>'false','status'=>'User can create only 7 collections'));
                    }else{
                    $d = time();
                    $sql="INSERT INTO `collections`(`collection_name`,`collection`,`contribute_type`,`collection_author`,`creation_date`) VALUES('$name','$description','$type','$uid','$d')";
                    $db = getConnection();
                    $stmt = $db->prepare($sql);
                    if($stmt->execute()){
//                    $stmt=$db->prepare($sql);
//                    $stmt->bindParam('collection_name',$name);
//                    $stmt->bindParam('collection',$description);
//                    $stmt->bindParam('contribute_type',$type);
//                    $stmt->bindParam('creation_date',$d);
//                    $stmt->execute();
                     echo  json_encode(array('Message'=>'true','id'=>$db->lastInsertId()));
                    }else{
                        echo  json_encode(array('Message'=>'false'));
                    }
                    }
        }catch(Exception $e){
                print $e->getMessage();
        }

}

function UserCollection($uid,$colid){
    
        $sql = "SELECT * FROM `collections` WHERE id='$colid' AND collection_author='$uid' ";

        try{
             $db = getConnection();
             $stmt1 = $db->query($sql);
             $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $count = count($dd);
//        echo '<pre>';
//        print_r($dd);exit;
             $total_recmnds = 0;
        foreach($dd as $k=>$val){
         //print_r($dd[$k]);
            if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/collection/original/'.$val->image);
            }
            $val->collection = strip_tags($val->collection);
            
             $sql1 = "SELECT * FROM `recommends` WHERE recommend_post='$val->id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $recmnds = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$val->collection_author' ";
             $stmt2 = $db->prepare($sql2);  
             $stmt2->execute();
             $user = $stmt2->fetch(PDO::FETCH_OBJ);
             
             $sql3 = "SELECT * FROM `drafts` WHERE status='1' AND collection_id='$val->id' ";
             $stmt3 = $db->prepare($sql3);  
             $stmt3->execute();
             $collection = $stmt3->fetchAll(PDO::FETCH_OBJ);
//             echo '<pre>';
//             print_r($collection[0]->id);
//             exit;
             if(empty($collection)){
                 $reports ='0';
             }else{
             for($i =0;$i<count($collection);$i++){
                 
             $author_id =  $collection[$i]->author;
             $sql4 = "SELECT * FROM `twitter_users` WHERE id='$author_id' ";
             $stmt4 = $db->prepare($sql4);  
             $stmt4->execute();
             $reportauthor = $stmt4->fetch(PDO::FETCH_OBJ);
             
             $reports[]=array(
                 'id'=>$collection[$i]->id,
                 'title'=>$collection[$i]->title,
                 'author'=>$reportauthor->fullname);
             }
              
             
             $total_recmnds = count($collection);
  }
                    $arr[] = array(
                        'id' => $val->id,
                        'collection_name' => $val->collection_name,
                        'collection' => $val->collection,
                        'image' => $image,
                        'contribute_type' => $val->contribute_type,
                        'status' => $val->status ,
                        'creation_date' => $val->creation_date,
                        'reports' =>    $reports 
                    );
        }
       
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             if(!empty($user)){
                 $fullname  = $user->fullname;
             }else{
                 $fullname  = "not available";
             }
             echo json_encode(array('Message' => 'true','User'=>$fullname,'Posts'=>$count,'Total-reports'=>$total_recmnds,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
}

function EditCollection($uid,$collection,$col_name,$coll,$type) {
    //if(strlen($description) < 100){
$sql = "UPDATE collections SET collection_name='$col_name', collection='$coll', contribute_type='$type'  WHERE id='$collection ' AND collection_author='$uid' ";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
                                    $user = $stmt->execute();
                                    if(!empty($user)){
		   echo json_encode(array("Message"=>'true',"Updated Id"=>$collection));
                                    }else{
                                        echo json_encode(array("Message"=>'false'));
                                    }
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
    //}else{
     //   echo json_encode(array("Message"=>'false','Error'=>'Description too large only 100 characters allowed'));
    //}
}

function DemoPagination($page){
    	$num = 5*$page;
	$end_page = $num+5;
	$i =0;
        //$prev = $end_page-5;
        //if($prev == '0'){
            $sql = "SELECT * FROM `drafts` WHERE status='1' ORDER BY id DESC ";
        //}else{
         //   $sql = "SELECT * FROM `drafts` WHERE id <= $prev AND status='1' ORDER BY id DESC ";
       // }
	
        
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$dd = $stmt->fetchAll(PDO::FETCH_OBJ);
		$count = count($dd);
		$arr['total'] = $count;
                
                
		foreach($dd as $k=>$d)
		{
			//$message = trim($user->message);
			//$followUserId = $user->uid_fk;
			//$sel_stream = "select id from user_streamlist where user_id='$Loginid' and user_str_id='$followUserId'";
			//$stmt2 = $db->prepare($sel_stream);  
			//$stmt2->execute();
			//$info2 = $stmt2->fetchObject(); 
			if(json_encode($dd)=="false")
			{
				$i++;	
				if($i > $num and $i <= $end_page)
				{
                                $arr[] = array(
                                    'id' => $d->id,
                                    'title' => $d->title,
                                    'sub_title' => $d->sub_title,
                                    'status' => $d->status,
                                    'creation_date' => $d->creation_date);
				} $arr['total'] = $count;							
			}
			if(json_encode($dd) != "false")
			{
				
				$i++;
				if($i > $num and $i <= $end_page)
				{
				$arr[] = array(
                                    'id' => $d->id,
                                    'title' => $d->title,
                                    'sub_title' => $d->sub_title,
                                    'status' => $d->status,
                                    'creation_date' => $d->creation_date);
				}
                                $prev = $dd[$end_page-5]->id;
			}
			
		}
		$db = null;
                $arr['prev'] = $prev;
		echo json_encode($arr) ;
		
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}

}

//Index
function Index($uid,$page) {
        $num = 5*$page;
        $end_page = $num+5;
        $i =0;
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        $city=$ip_data->geoplugin_city;
        $addrress = $ip_data->geoplugin_city." ,".$ip_data->geoplugin_region." ,".$ip_data->geoplugin_countryName;
    $app=Slim::getInstance();
           //if($page==0){
        $sql = "SELECT * FROM `drafts` WHERE status='1' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$city%' ) ORDER BY id DESC  ";
//           }else{
//               $sql = "SELECT * FROM `drafts` WHERE status='0' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$city%' ) and id<$page ORDER BY id DESC  limit 5";
//           }
	try {
            
        $db = getConnection();
        $stmt = $db->query($sql);
        $drafts = $stmt->fetchAll(PDO::FETCH_OBJ);

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
              
            $sql_chk = "SELECT * FROM recommends WHERE recommend_user='$uid' AND recommend_post='".$drafts[$j]->id."' ";
            $res_chk = $db->query($sql_chk);
            $fetch = $res_chk->fetch();
            if(!empty($fetch))
            {
                $rec = '1';
            }
            else
            {
                $rec = '0';
            }
            
            $drafts[$j]->post =  strip_tags($drafts[$j]->post);
            if($drafts[$j]->image == ''){
                $image = '';
            }else{
                $image = 'http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$drafts[$j]->image;
            }
            if(json_encode($drafts) != "false")
            {

                $i++;
                if($i > $num and $i <= $end_page)
                {
                    if($drafts[$j]->post == ""){
                        $post = "";
                    }else{
                    $post = substr($drafts[$j]->post,'0','50');
                    }
                    if(!empty($drafts[$j]->location))
                        {
                            $location = $drafts[$j]->location;
                        }
                        else{
                            $location = "";
                        }
                   $link = "http://reportedly.pnf-sites.info/post_more?post=".base64_encode($drafts[$j]->id)."";
                    $arr[] = array(
                        'id' => $drafts[$j]->id,
                        'collection' => $collection_id,
                        'image' => $image,
                        'title' => $drafts[$j]->title,
                        'post' => $post,
                        'link'=>$link,
                        'like'=>$rec,
                        'location' => $location,
                        'creation_date' => $drafts[$j]->creation_date,
                        'status' => $drafts[$j]->status 
                    );
                    }
            }
            
        }
        //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message']  = 'true';
            $finale['data']  = $arr;
            $finale['counter'] = $count;
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }

	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

//Guest Index
function IndexGuests($location,$page){

    $num = 5*$page;
    $end_page = $num+5;
    $j =0;
   $sql_user = "SELECT * FROM `drafts` WHERE status='1' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$location%') ";
try {
            $db = getConnection();
            $stmt1 = $db->query($sql_user);  
            $drafts = $stmt1->fetchAll(PDO::FETCH_OBJ);
            //echo '<pre>';
           // print_r($drafts);
            
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
            if(empty($collection)){
              $collection = "";  
            }else{
            $collection->collection = strip_tags($collection->collection);
            }
            
//            $collection_id = $drafts[$i]->collection_id;
//            $sql3 = "SELECT * FROM `drafts`  WHERE id='$collection_id'  ";
//            $stmt3 = $db->query($sql3);  
//            $collection = $stmt3->fetchAll(PDO::FETCH_OBJ);
            
            //$ss[$i]['user'] = $drafts[$i];
           // $ss['data'][$i]=$i;
             if(json_encode($drafts) != "false")
                {
                    $j++;
                    if($drafts[$i]->image == ''){
                        $drafts[$i]->image = '';
                    }else{
                        $drafts[$i]->image = $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$drafts[$i]->image);
                    }
                    if($drafts[$i]->post == ''){
                        $drafts[$i]->post = '';
                    }else{
                        $drafts[$i]->post = substr($drafts[$i]->post,'0','50');
                    }
                    $link = "http://reportedly.pnf-sites.info/post_more?post=".base64_encode($drafts[$i]->id)."";
                    //$collection['collection']=  strip_tags($collection['collection']);
                    if($j >= $num and $j <= $end_page)
                    {
                        if(!empty($drafts[$i]->location))
                        {
                            $location = $drafts[$i]->location;
                        }
                        else{
                            $location = "";
                        }
                        
                        $arr[] = array(
                        'id' => $drafts[$i]->id,
                        'collection' => $collection_id,
                        'image' => $image,
                        'title' => $drafts[$i]->title,
                        'post' => $drafts[$i]->post,
                        'creation_date' => $drafts[$i]->creation_date,
                        'link'=>$link,   
                        'location' =>$location,    
                        'status' => $drafts[$i]->status 
                    );
                    //$ss[]  = $drafts[$i];
                    //$ss[$j]['user'] = $author;
                    //$ss[$j]['collection'] = $collection;
                    }
                }
            //$collection[$key]['collection']=$collection[$key];
            //}
                //$drafts[]->post =  strip_tags($drafts[]->post);
                
            }
            //echo "<pre>";
            //print_r($ss);
            //exit;
            if(!empty($arr)){ 
            $finale['Message']  = 'true';
            $finale['data']  = $arr;
            $finale['counter'] = $count;
            echo json_encode($finale) ;
            }else{
            echo '{"Message":"false"}';
            }
            } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

//Drafts
function getUsersDratfs($page){
    $num = 5*$page;
    $end_page = $num+5;
    $j =0;

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
             if(json_encode($drafts) != "false")
                {
                    $j++;
                   // $collection['collection']=  strip_tags($collection['collection']);
                    if($j >= $num and $j <= $end_page)
                    {
                    $ss[$j]['draft'] = $drafts[$j];
                    //$ss[$j]['user'] = $author;
                    //$ss[$j]['collection'] = $collection;
                    }
                }
            //$collection[$key]['collection']=$collection[$key];
            }
                //$drafts[]->post =  strip_tags($drafts[]->post);
                
            //}
            //echo "<pre>";
            //print_r($ss);
           // exit;
            if(!empty($ss)){
            echo json_encode(array("Data"=>$ss,'Message'=>'true','total'=>$count));
            }else{
            echo '{"Message":"false"}';}
            
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

//collections
function Collections($page){
    
        $num = 5*$page;
        $end_page = $num+5;
        $i =0;
   //if($page == 0){
        $sql = "SELECT * FROM `collections`  ORDER BY `collections`.`id` DESC";
         //  }else{
         //       $sql = "SELECT * FROM `collections` WHERE  id<$page ORDER BY `collections`.`id` DESC LIMIT 0 , 5";
        //   }  
   try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $collections = $stmt1->fetchAll(PDO::FETCH_OBJ);
//        echo '<pre>';
//        print_r($collections);
//        die;
        $count = count($collections);
       
        for($j=0;$j<$count;$j++)
        {
            $collections[$j]->collection = strip_tags($collections[$j]->collection);
            $collection_author = $collections[$j]->collection_author;
//            $sql2 = "SELECT * FROM `twitter_users` WHERE id='$collection_author' AND status='1' ";
//            $stmt2 = $db->prepare($sql2);  
//            $stmt2->execute();
//            $user = $stmt2->fetchObject();
//            $Ucount = count($user);
            
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$collection_author' ";
             $stmt2 = $db->prepare($sql2);  
             $stmt2->execute();
             $user = $stmt2->fetch(PDO::FETCH_OBJ);
            
           // echo '<pre>';
           //print_r($user);
            if(!empty($user)){
            $fullName = $user->fullname;
            }else{
                $fullName ='User name not available';    
            }
            //$collections[$j]->collection_author
            $collection_id = $collections[$j]->id;
            $sql4 = "SELECT * FROM `drafts` WHERE collection_id='$collection_id' AND status='1'  ";
            $stmt4 = $db->prepare($sql4);  
            $stmt4->execute();
            $drafts = $stmt4->fetchAll(PDO::FETCH_OBJ);
            if(!empty($drafts)){
            $total_drafts = count($drafts);
             }else{
                 $total_drafts = 0;
             }
             if(json_encode($collections) != "false")
            {

                $i++;
                if($i > $num and $i <= $end_page)
                {
                    
                     if($collections[$j]->image == ''){
                     $image = '';
                 }else{
                     $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/collection/original/'.$collections[$j]->image);
                 }
            
                $arr[] = array(
                    'id' => $collections[$j]->id,
                    'collection_name' => $collections[$j]->collection_name,
                    'collection' => $collections[$j]->collection,     
                    'image' => $image,
                    'contribute_type' => $collections[$j]->contribute_type,
                    'status' => $collections[$j]->status ,
                    'author' => $collections[$j]->collection_author,
                    'User'  => $fullName,
                    'creation_date' => $collections[$j]->creation_date,
                    'Total_Drafts' => "$total_drafts"
               );
                }
            }
            
        }
       //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['data']  = $arr;
            $finale['Total'] = $count;
            
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

//Guest collections
function CollectionsGuests($location,$page){
    
        $num = 5*$page;
        $end_page = $num+5;
        $i =0;
   //if($page == 0){
$sql = "SELECT * FROM `collections` WHERE status='1' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$location%' ) ORDER BY id DESC  ";         //  }else{
         //       $sql = "SELECT * FROM `collections` WHERE  id<$page ORDER BY `collections`.`id` DESC LIMIT 0 , 5";
        //   }  
   try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $collections = $stmt1->fetchAll(PDO::FETCH_OBJ);
        $count = count($collections);
       
        for($j=0;$j<$count;$j++)
        {
            $collections[$j]->collection = strip_tags($collections[$j]->collection);
            $collection_author = $collections[$j]->collection_author;
//            $sql2 = "SELECT * FROM `twitter_users` WHERE id='$collection_author' AND status='1' ";
//            $stmt2 = $db->prepare($sql2);  
//            $stmt2->execute();
//            $user = $stmt2->fetchObject();
//            $Ucount = count($user);
            
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$collection_author' ";
             $stmt2 = $db->prepare($sql2);  
             $stmt2->execute();
             $user = $stmt2->fetch(PDO::FETCH_OBJ);
            
           // echo '<pre>';
           //print_r($user);
            if(!empty($user)){
            $fullName = $user->fullname;
            }else{
                $fullName ='User name not available';    
            }
            //$collections[$j]->collection_author
            $collection_id = $collections[$j]->id;
            $sql4 = "SELECT * FROM `drafts` WHERE collection_id='$collection_id' AND status='1'  ";
            $stmt4 = $db->prepare($sql4);  
            $stmt4->execute();
            $drafts = $stmt4->fetchAll(PDO::FETCH_OBJ);
            if(!empty($drafts)){
            $total_drafts = count($drafts);
             }else{
                 $total_drafts = 0;
             }
             if(json_encode($collections) != "false")
            {

                $i++;
                if($i > $num and $i <= $end_page)
                {
                    
                     if($collections[$j]->image == ''){
                     $image = '';
                 }else{
                     $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/collection/thumb/'.$collections[$j]->image);
                 }
            
                $arr[] = array(
                    'id' => $collections[$j]->id,
                    'collection_name' => $collections[$j]->collection_name,
                    'collection' => $collections[$j]->collection,     
                    'image' => $image,
                    'contribute_type' => $collections[$j]->contribute_type,
                    'status' => $collections[$j]->status ,
                    'author' => $collections[$j]->collection_author,
                    'User'  => $fullName,
                    'creation_date' => $collections[$j]->creation_date,
                    'Total_Drafts' => "$total_drafts"
               );
                }
            }
            
        }
       //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['data']  = $arr;
            $finale['Total'] = $count;
            
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function CollectionUserReports($collectionid,$userid,$page){
        $num = 5*$page;
	$end_page = $num+5;
	$i =0;
        $sql = "SELECT * FROM `drafts` WHERE collection_id='$collectionid' AND status='1' ";

        try{
             $db = getConnection();
             $stmt1 = $db->query($sql);
             $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $count = count($dd);
//        echo '<pre>';
//        print_r($dd);exit;
             $total_recmnds = 0;
        foreach($dd as $k=>$val){
         //print_r($dd[$k]);
            if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$val->image);
            }
            $val->post = strip_tags($val->post);
            
             $sql1 = "SELECT * FROM `recommends` WHERE recommend_post='$val->id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $recmnds = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $total_recmnds += count($recmnds);

            if(json_encode($dd) != "false")
            {
                
                $i++;
                if($i > $num and $i <= $end_page)
                {
                    $post = substr($val->post,'0','50');
                    $arr[] = array(
                        'id' => $val->id,
                        'title' => $val->title,
                        'subtitle' => $val->sub_title,
                        'post' => $post,
                        'image' => $image,
                        'status' => $val->status ,
                        'creation_date' => $val->creation_date
                    );
                }
                    
            }
        }
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             echo json_encode(array('Message' => 'true','Posts'=>$count,'Total-recommends'=>$total_recmnds,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
        
}

function LoginUserReports($id,$page){
        $num = 5*$page;
	$end_page = $num+5;
	$i =0;
        $sql = "SELECT * FROM `drafts` WHERE author='$id' AND status='1' ";

        try{
             $db = getConnection();
             $stmt1 = $db->query($sql);
             $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $count = count($dd);
//        echo '<pre>';
//        print_r($dd);exit;
             $total_recmnds = 0;
        foreach($dd as $k=>$val){
         //print_r($dd[$k]);
            if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$val->image);
            }
            $val->post = strip_tags($val->post);
            
             $sql1 = "SELECT * FROM `recommends` WHERE recommend_post='$val->id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $recmnds = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $total_recmnds += count($recmnds);
             $post_id = base64_encode($val->id);
             $link = "http://reportedly.pnf-sites.info/post_more?post=".$post_id."";
            if(json_encode($dd) != "false")
            {
                
                $i++;
                
                $sql_chk_rec = "SELECT * FROM recommends WHERE recommend_user='$id' AND recommend_post='$val->id' ";
                $res_chk_rec = $db->query($sql_chk_rec);
                $fetch_rec = $res_chk_rec->fetch();
                if(empty($fetch_rec))
                    {
                    $like = '0';
                }else
                {
                    $like = '1';
                }
                if($i > $num and $i <= $end_page)
                {
                    if($val->post == "")
                    {
                        $val->post = "";
                    }else{
                        $val->post = substr($val->post,'0','50');
                    }
                    $arr[] = array(
                        'id' => $val->id,
                        'collection' =>$val->collection_id,
                        'title' => $val->title,
                        'subtitle' => $val->sub_title,
                        'post' => $val->post,
                        'image' => $image,
                        'status' => $val->status ,
                        'liked' => $like, 
                        'link' => $link,
                        'creation_date' => $val->creation_date
                    );
                }
                    
            }
        }
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             echo json_encode(array('Message' => 'true','Posts'=>$count,'Total-recommends'=>$total_recmnds,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
        
}

//Single post
function Report($id,$kk){
   
       $sql = "SELECT * FROM `drafts` WHERE id='$id' AND status='1' ";

        try{
             $db = getConnection();
             $stmt1 = $db->query($sql);
             $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $count = count($dd);
//        echo '<pre>';
//        print_r($dd);exit;
             $total_recmnds = 0;
        foreach($dd as $k=>$val){
         //print_r($dd[$k]);
           
            //$val->post = strip_tags($val->post);
            
            
             $sql1 = "SELECT * FROM `recommends` WHERE recommend_post='$val->id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $recmnds = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$val->author' ";
             $stmt2 = $db->prepare($sql2);  
             $stmt2->execute();
             $user = $stmt2->fetch(PDO::FETCH_OBJ);
             
             $sql3 = "SELECT * FROM `collections` WHERE id='$val->collection_id' ";
             $stmt3 = $db->prepare($sql3);  
             $stmt3->execute();
             $collection = $stmt3->fetch(PDO::FETCH_OBJ);
             
             $val->post = base64_encode(stripslashes($val->post));
             $total_recmnds += count($recmnds);
              if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$val->image);
            }
            $post_id = base64_encode($val->id);
            $link = "http://reportedly.pnf-sites.info/post_more?post=".$post_id."";
          // $good_post = str_replace('\"', '', $image);
             //$string = rtrim($string, '/');
                    $arr[] = array(
                        'id' => $val->id,
                        'title' => $val->title,
                        'subtitle' => $val->sub_title,
                        'post' => $val->post,
                        'image' => $image,
                        'link'=>$link,
                        'status' => $val->status ,
                        'creation_date' => $val->creation_date
                    );
        }
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             if($user->oauth_provider == 'twitter'){
                 $user_image = $user->image;
             }else{
                 if($user->oauth_provider == 'facebook'){
                     $user_image = "https://graph.facebook.com/".$user->username."/picture?width=48&height=48";
                 }else{
                      if($user->image == "")
                      {
                         $user_image = "http://reportedly.pnf-sites.info/img/user.png";
                      }
                 }
             }
             echo json_encode(array('Message' => 'true','User'=>$user->fullname,'User_image'=>$user_image,'Collection'=>$collection->collection_name,'Posts'=>$count,'Total-recommends'=>$total_recmnds,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
}

function ReportUserssss($id){
        $sql = "SELECT * FROM `drafts` WHERE id='$id' AND status='1' ";
         
        try{
             $db = getConnection();
             $stmt1 = $db->query($sql);
             $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $count = count($dd);
//            echo '<pre>';
//            print_r($dd);exit;
             $total_recmnds = 0;
        foreach($dd as $k=>$val){
         //print_r($dd[$k]);
           
            //$val->post = strip_tags($val->post);
            
            
             $sql1 = "SELECT * FROM `recommends` WHERE recommend_post='$val->id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $recmnds = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$val->author' ";
             $stmt2 = $db->prepare($sql2);  
             $stmt2->execute();
             $user = $stmt2->fetch(PDO::FETCH_OBJ);
             if(empty($user))
             {
                 $user_id = '';
             }else{
                 $user_id = $user->id;
             }
             
             $sql3 = "SELECT * FROM `collections` WHERE id='$val->collection_id' ";
             $stmt3 = $db->prepare($sql3);  
             $stmt3->execute();
             $collection = $stmt3->fetch(PDO::FETCH_OBJ);
             if(empty($collection))
             {
                 $collection_id = '';
             }else{
                 $collection_id = $collection->id;
             }
             $val->post = base64_encode(stripslashes($val->post));
             $total_recmnds += count($recmnds);
              if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$val->image);
            }
            $post_id = base64_encode($val->id);
            $link = "http://reportedly.pnf-sites.info/post_more?post=".$post_id."";
          // $good_post = str_replace('\"', '', $image);
             //$string = rtrim($string, '/');
                    $arr[] = array(
                        'id' => $val->id,
                        'title' => $val->title,
                        'subtitle' => $val->sub_title,
                        'post' => $val->post,
                        'image' => $image,
                        'link'=>$link,
                        'collection_id' => $collection_id ,
                        'user_id' => $user_id ,
                        'status' => $val->status ,
                        'creation_date' => $val->creation_date
                    );
        }
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             if($user->oauth_provider == 'twitter'){
                 $user_image = $user->image;
             }else{
                 if($user->oauth_provider == 'facebook'){
                     $user_image = "https://graph.facebook.com/".$user->username."/picture?width=48&height=48";
                 }else{
                      if($user->image == "")
                      {
                         $user_image = "http://reportedly.pnf-sites.info/img/user.png";
                      }else{
                          $user_image = "http://reportedly.pnf-sites.info/webadmin/upload/userprofile/original/".$user->image."";
                      }
                 }
             }
             echo json_encode(array('Message' => 'true','User_image'=>$user_image,'User'=>$user->fullname,'Posts'=>$count,'Total-recommends'=>$total_recmnds,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
}

function CollectionReports($id,$page){
        $num = 5*$page;
	$end_page = $num+5;
	$i =0;
   //if($page == 0){
        $sql = "SELECT * FROM `drafts` WHERE status='1' AND collection_id='$id'  ORDER BY `drafts`.`id` DESC
";
           //}else{
             //   $sql = "SELECT * FROM `drafts` WHERE collection_id='$id' AND  id<$page ORDER BY `drafts`.`id` DESC LIMIT 0 , 5";
          // }  
   try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
        $sql_collec = "SELECT * FROM `collections` WHERE id='$id' ";
        $stmt2 = $db->query($sql_collec);
        $collection = $stmt2->fetch(PDO::FETCH_OBJ);
        
       foreach($dd as $k=>$val){
         //print_r($dd[$k]);
            if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$val->image);
            }
            $val->post = strip_tags($val->post);
            if(json_encode($dd) != "false")
            {
                
                $i++;
                if($i > $num and $i <= $end_page)
                {
                    $arr[] = array(
                        'id' => $val->id,
                        'title' => $val->title,
                        'subtitle' => $val->sub_title,
                        'post' => $val->post,
                        'image' => $image,
                        'status' => $val->status ,
                        'creation_date' => $val->creation_date
                    );
                }
                    
            }
        }
        
        //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['author'] = $collection->collection_author;
            $finale['data']  = $arr;
            
            echo json_encode($finale) ;}else{
                 $finale['Message'] = 'false';
            $finale['author'] = $collection->collection_author;
            echo json_encode($finale) ;
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function Collection($id,$kk){
    
        $sql = "SELECT * FROM `collections` WHERE id='$id' AND status='1' ";

        try{
             $db = getConnection();
             $stmt1 = $db->query($sql);
             $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
            // $count = count($dd);
//        echo '<pre>';
//        print_r($dd);exit;
             $total_recmnds = 0;
        foreach($dd as $k=>$val){
         //print_r($dd[$k]);
            if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$val->image);
            }
            $val->collection = strip_tags($val->collection);
            
             $sql1 = "SELECT * FROM `recommends` WHERE recommend_post='$val->id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $recmnds = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$val->collection_author' ";
             $stmt2 = $db->prepare($sql2);  
             $stmt2->execute();
             $user = $stmt2->fetch(PDO::FETCH_OBJ);
             
             $sql3 = "SELECT * FROM `drafts` WHERE status='1' AND collection_id='$val->id' ";
             $stmt3 = $db->prepare($sql3);  
             $stmt3->execute();
             $collection = $stmt3->fetchAll(PDO::FETCH_OBJ);
//             echo '<pre>';
//             print_r($collection[0]->id);
//             exit;
             if(empty($collection)){
                 $reports ='0';
             }else{
             for($i =0;$i<count($collection);$i++){
                 
             $author_id =  $collection[$i]->author;
             $sql4 = "SELECT * FROM `twitter_users` WHERE id='$author_id' ";
             $stmt4 = $db->prepare($sql4);  
             $stmt4->execute();
             $reportauthor = $stmt4->fetch(PDO::FETCH_OBJ);
             
             $reports[]=array(
                 'id'=>$collection[$i]->id,
                 'title'=>$collection[$i]->title,
                 'author'=>$reportauthor->fullname);
             }
              
             
             $total_recmnds = count($collection);
  }
                    $arr[] = array(
                        'id' => $val->id,
                        'collection_name' => $val->collection_name,
                        'collection' => $val->collection,
                        'image' => $image,
                        'status' => $val->status ,
                        'creation_date' => $val->creation_date,
                        'reports' =>    $reports 
                    );
        }
       
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             if(!empty($user)){
                 $fullname  = $user->fullname;
             }else{
                 $fullname  = "not available";
             }
             echo json_encode(array('Message' => 'true','User'=>$fullname,'Total-reports'=>$total_recmnds,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
}

function CollectionModified($colid){
    
        $sql = "SELECT * FROM `collections` WHERE id='$id' AND status='1' ";

        try{
             $db = getConnection();
             $stmt1 = $db->query($sql);
             $dd = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $count = count($dd);
//        echo '<pre>';
//        print_r($dd);exit;
             $total_recmnds = 0;
        foreach($dd as $k=>$val){
         //print_r($dd[$k]);
            if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$val->image);
            }
            $val->collection = strip_tags($val->collection);
            
             $sql1 = "SELECT * FROM `recommends` WHERE recommend_post='$val->id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $recmnds = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$val->collection_author' ";
             $stmt2 = $db->prepare($sql2);  
             $stmt2->execute();
             $user = $stmt2->fetch(PDO::FETCH_OBJ);
             
             $sql3 = "SELECT * FROM `drafts` WHERE status='1' AND collection_id='$val->id' ";
             $stmt3 = $db->prepare($sql3);  
             $stmt3->execute();
             $collection = $stmt3->fetchAll(PDO::FETCH_OBJ);
//             echo '<pre>';
//             print_r($collection[0]->id);
//             exit;
             if(empty($collection)){
                 $reports ='0';
             }else{
             for($i =0;$i<count($collection);$i++){
                 
             $author_id =  $collection[$i]->author;
             $sql4 = "SELECT * FROM `twitter_users` WHERE id='$author_id' ";
             $stmt4 = $db->prepare($sql4);  
             $stmt4->execute();
             $reportauthor = $stmt4->fetch(PDO::FETCH_OBJ);
             
             $reports[]=array(
                 'id'=>$collection[$i]->id,
                 'title'=>$collection[$i]->title,
                 'author'=>$reportauthor->fullname);
             }
              
             
             $total_recmnds = count($collection);
  }
                    $arr[] = array(
                        'id' => $val->id,
                        'collection_name' => $val->collection_name,
                        'collection' => $val->collection,
                        'image' => $image,
                        'status' => $val->status ,
                        'creation_date' => $val->creation_date,
                        'reports' =>    $reports 
                    );
        }
       
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             if(!empty($user)){
                 $fullname  = $user->fullname;
             }else{
                 $fullname  = "not available";
             }
             echo json_encode(array('Message' => 'true','User'=>$fullname,'Posts'=>$count,'Total-reports'=>$total_recmnds,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
}

function UserCollections($id,$page){
        $num = 5*$page;
        $end_page = $num+5;
        $i =0;
        $sql = "SELECT * FROM `collections` WHERE collection_author='$id' AND status='1' ";

        try{
             $db = getConnection();
             $stmt = $db->query($sql);
             $collections = $stmt->fetchAll(PDO::FETCH_OBJ);
             
             $count = count($collections);
//        echo '<pre>';
//        print_r($dd);exit;
             $total_drafts = 0;
        foreach($collections as $k=>$val){
         //print_r($dd[$k]);
            if($val->image == ''){
                $image = '';
            }else{
                $image = stripslashes('http://reportedly.pnf-sites.info/webadmin/upload/collection/thumb/'.$val->image);
            }
            $val->collection = strip_tags($val->collection);
            $collection_id = $val->id;
            $sql1 = "SELECT * FROM `drafts` WHERE collection_id='$collection_id' AND status='1' AND author='$id' ";
             $stmt1 = $db->prepare($sql1);  
             $stmt1->execute();
             $drafts = $stmt1->fetchAll(PDO::FETCH_OBJ);
             
             
             $sql2 = "SELECT * FROM `twitter_users` WHERE id='$id' AND status='1' ";
            $stmt2 = $db->prepare($sql2);  
            $stmt2->execute();
            $user = $stmt2->fetchObject();
             $total_drafts += count($drafts);

            if(json_encode($collections) != "false")
            {
                
                $i++;
                if($i > $num and $i <= $end_page)
                {
                    $arr[] = array(
                        'id' => $val->id,
                        'collection_name' => $val->collection_name,
                        'collection' => $val->collection,
                        'contribute_type' => $val->contribute_type,
                        'image' => $image,
                        'status' => $val->status ,
                        'User'  => $user->fullname,
                        'creation_date' => $val->creation_date,
                        'Total-Drafts'=>$total_drafts
                    );
                }
                    
            }
        }
        
        $db = null;
         if(!empty($arr)){
            //echo json_encode($arr);
             echo json_encode(array('Message' => 'true','collections'=>$count,'data'=>$arr));
         }else{
             echo json_encode(array('Message' => 'false'));
         }
           
        }catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
}

function LoginUserPrifile($id){
        $sql = "SELECT * FROM `twitter_users` WHERE id='$id'";
   try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $user = $stmt1->fetch(PDO::FETCH_OBJ);
        //echo $user->image;
        //echo '<pre>';
//        print_r($user);
//        die;
         if(!empty($user)){
        if($user->profile_cover == ''){
            $cover = '';
            }else{
                $user->image = 'http://reportedly.pnf-sites.info/webadmin/upload/userprofile/original/'.$user->image;
            }
        $db = null;
        
       
                $finale['Message'] = 'true';
                $finale['User']  = $user;
                
                //echo '<pre>';
                //print_r($finale);
                echo json_encode($finale);
            }else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
 
}

//Most Recommend
function MostRecommend($uid,$page){
    $num = 5*$page;
        $end_page = $num+5;
        $i =0;
    //if($page==0){
        $sql = " SELECT * FROM `drafts` WHERE status='1'  AND drafts.id IN (SELECT `recommend_post` FROM recommends) ORDER BY drafts.id DESC";
          // }else{
            //   $sql = "SELECT * FROM `drafts` WHERE drafts.id IN (SELECT `recommend_post` FROM recommends)  and id<$page ORDER BY drafts.id DESC LIMIT 0 , 5";//
      //     }
              try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $drafts = $stmt1->fetchAll(PDO::FETCH_OBJ);
//        echo '<pre>';
//        print_r($collections);
//        echo $lastID = $collections[4]->id;
//        exit;
        $count = count($drafts);
       
        for($j=0;$j<$count;$j++)
        {
            $drafts[$j]->post =  strip_tags($drafts[$j]->post);
            if($drafts[$j]->image == ''){
                $image = '';
            }else{
                $image = 'http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$drafts[$j]->image;
            }
            if(json_encode($drafts) != "false")
            {
                
                $i++;
                if($i > $num and $i <= $end_page)
                {
                    if(!empty($drafts[$j]->location))
                        {
                            $location = $drafts[$j]->location;
                        }
                        else{
                            $location = "";
                        }
                        $sql_chk = "SELECT * FROM recommends WHERE recommend_user='$uid' AND recommend_post='".$drafts[$j]->id."' ";
                        $res_chk = $db->query($sql_chk);
                        $fetch = $res_chk->fetch();
                        if(!empty($fetch))
                        {
                            $rec = '1';
                        }
                        else
                        {
                            $rec = '0';
                        }
                    $post = substr($drafts[$j]->post,'0','50');
                    $link = "http://reportedly.pnf-sites.info/post_more?post=".base64_encode($drafts[$j]->id)."";
                    $arr[] = array(
                        'id' => $drafts[$j]->id,
                        'collection' => $drafts[$j]->collection_id,
                        'image' => $image,
                        'title' => $drafts[$j]->title,
                        'post' => $post,
                        'link'=>$link,
                        'like'=>$rec,
                        'location' => $location,
                        'creation_date' => $drafts[$j]->creation_date,
                        'status' => $drafts[$j]->status
                   );
                }
            }
            
        }
        //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['data']  = $arr;
            $finale['Total'] = $count;
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

//Guest Most Recommend
function MostRecommendGuests($location,$page){
    $num = 5*$page;
        $end_page = $num+5;
        $i =0;
    //if($page==0){
        $sql = " SELECT * FROM `drafts` WHERE status='1' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$location%') AND drafts.id IN (SELECT `recommend_post` FROM recommends) ORDER BY drafts.id DESC";
          // }else{
            //   $sql = "SELECT * FROM `drafts` WHERE drafts.id IN (SELECT `recommend_post` FROM recommends)  and id<$page ORDER BY drafts.id DESC LIMIT 0 , 5";//
      //     }
              try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $drafts = $stmt1->fetchAll(PDO::FETCH_OBJ);
//        echo '<pre>';
//        print_r($collections);
//        echo $lastID = $collections[4]->id;
//        exit;
        $count = count($drafts);
       
        for($j=0;$j<$count;$j++)
        {
            if($drafts[$j]->image == ''){
                $image = '';
            }else{
                $image = 'http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$drafts[$j]->image;
            }
             if($drafts[$j]->post == ''){
                $post = '';
            }else{
                $post = strip_tags(substr($drafts[$j]->post,'0','50'));
            }
            $link = "http://reportedly.pnf-sites.info/post_more?post=".base64_encode($drafts[$j]->id)."";
            if(json_encode($drafts) != "false")
            {
                
                $i++;
                if($i > $num and $i <= $end_page)
                {
                   if(!empty($drafts[$j]->location))
                        {
                            $location = $drafts[$j]->location;
                        }
                        else{
                            $location = "";
                        } 
                    $arr[] = array(
                        'id' => $drafts[$j]->id,
                        'collection' => $drafts[$j]->collection_id,
                        'image' => $image,
                        'title' => $drafts[$j]->title,
                        'post' => $post,
                        'link'=>$link,
                        'location' => $location,
                        'creation_date' => $drafts[$j]->creation_date,
                        'status' => $drafts[$j]->status
                   );
                }
            }
            
        }
        //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['data']  = $arr;
            $finale['Total'] = $count;
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

//Most Recent
function MostRecentReport($uid,$page){
        $num = 5*$page;
        $end_page = $num+5;
        $i =0;
        //if($previous_page == 0){
    //if($page==0){
        $sql = " SELECT * FROM `drafts` WHERE status='1' ORDER BY drafts.id DESC ";
         //  }else{
           //    $sql = "SELECT * FROM `drafts` WHERE status='1' and   id<$page ORDER BY drafts.id DESC LIMIT 0 , 5";
           //}
//        }
//        else{
//            $sql = "SELECT * FROM `drafts` WHERE status='1' and   id>$previous_page ORDER BY drafts.id DESC LIMIT 0 , 5";
//        }
              try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $drafts = $stmt1->fetchAll(PDO::FETCH_OBJ);
//        echo '<pre>';
//        print_r($drafts);
//        //echo $lastID = $collections[4]->id;
//        exit;
        $count = count($drafts);
        $previous_page = $drafts[0]->id;
        for($j=0;$j<$count;$j++)
        {
            $drafts[$j]->post =  strip_tags($drafts[$j]->post);
            if($drafts[$j]->image == ''){
                $image = '';
            }else{
                $image = 'http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$drafts[$j]->image;
            }
            $sql_chk = "SELECT * FROM recommends WHERE recommend_user='$uid' AND recommend_post='".$drafts[$j]->id."' ";
            $res_chk = $db->query($sql_chk);
            $fetch = $res_chk->fetch();
            if(!empty($fetch))
            {
                $rec = '1';
            }
            else
            {
                $rec = '0';
            }
           if(json_encode($drafts) != "false")
            {
               if(!empty($drafts[$j]->post))
               {
                   $post = substr($drafts[$j]->post,'0','50');
               }else{
                   $post = "";
               }
                
                if(!empty($drafts[$j]->location))
                {
                    $location = $drafts[$j]->location;
                }
                else{
                    $location = "";
                }
                
                $i++;
                if($i > $num and $i <= $end_page)
                { 
                $arr[] = array(
                    'id' => $drafts[$j]->id,
                    'collection' => $drafts[$j]->collection_id,
                    'image' => $image,
                    'title' => $drafts[$j]->title,
                    'post' => $post,
                    'location' => $location,
                    'like' => $rec,
                    'creation_date' => $drafts[$j]->creation_date,
                    'status' => $drafts[$j]->status
               );
                }
            }
            
            
        }
        //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['data']  = $arr;
            $finale['Total'] = $count;
            
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

//Guest Most Recent
function MostRecentReportGuests($location,$page){
        $num = 5*$page;
        $end_page = $num+5;
        $i =0;
        //if($previous_page == 0){
    //if($page==0){
        $sql = " SELECT * FROM `drafts` WHERE status='1' AND author IN (SELECT id FROM twitter_users WHERE location LIKE '%$location%')  ORDER BY drafts.id DESC ";
         //  }else{
           //    $sql = "SELECT * FROM `drafts` WHERE status='1' and   id<$page ORDER BY drafts.id DESC LIMIT 0 , 5";
           //}
//        }
//        else{
//            $sql = "SELECT * FROM `drafts` WHERE status='1' and   id>$previous_page ORDER BY drafts.id DESC LIMIT 0 , 5";
//        }
              try{
        $db = getConnection();
        $stmt1 = $db->query($sql);
        $drafts = $stmt1->fetchAll(PDO::FETCH_OBJ);
//        echo '<pre>';
//        print_r($drafts);
//        //echo $lastID = $collections[4]->id;
//        exit;
        $count = count($drafts);
        for($j=0;$j<$count;$j++)
        {
            //$drafts[$j]->post =  strip_tags($drafts[$j]->post);
            if($drafts[$j]->image == ''){
                $image = '';
            }else{
                $image = 'http://reportedly.pnf-sites.info/webadmin/upload/posts/original/'.$drafts[$j]->image;
            }
            if($drafts[$j]->post == ''){
                $post = '';
            }else{
                $post = strip_tags(substr($drafts[$j]->post,'0','50'));
            }
            $link = "http://reportedly.pnf-sites.info/post_more?post=".base64_encode($drafts[$j]->id)."";
           if(json_encode($drafts) != "false")
            {
                //$post = strip_tags(substr($drafts[$j]->post,'0','50'));
                $i++;
                if($i > $num and $i <= $end_page)
                { 
                     if(!empty($drafts[$j]->location))
                        {
                            $location = $drafts[$j]->location;
                        }
                        else{
                            $location = "";
                        }
                $arr[] = array(
                    'id' => $drafts[$j]->id,
                    'collection' => $drafts[$j]->collection_id,
                    'image' => $image,
                    'title' => $drafts[$j]->title,
                    'post' => $post,
                    'link'=>$link,
                    'location'=>$location,
                    'creation_date' => $drafts[$j]->creation_date,
                    'status' => $drafts[$j]->status
               );
                }
            }
            
            
        }
        //exit;
        $db = null;
        if(!empty($arr)){
            $finale['Message'] = 'true';
            $finale['data']  = $arr;
            $finale['Total'] = $count;
            
            echo json_encode($finale) ;}else{
            echo '{"Message":"false"}';
        }
        
	}catch(PDOException $e) {
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

function maxDate(){
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
	 $sql = "SELECT id,status FROM twitter_users WHERE username='$email' AND password='$pass' ";
         
	
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("email", $email);
                                   $stmt->bindParam("username", $pass);
		$stmt->execute();
		$wine = $stmt->fetchObject();
                                   $db = null;
//                                   echo '<pre>';
//                                   print_r($wine);
//                                   die;
                         
                                    if(!empty($wine)){
                                        $wine->Message = 'true';
                                        echo json_encode($wine);
                                    //echo '{"message": '."success"."," . .'}' ;
                                    }else{
                                       echo '{"Message": "false"}';
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

function ChangePassword($id,$oldpwd,$newpass){
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

function updateUser($id,$first_name,$email,$description,$website) {
    if(!empty($email)){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    if (!preg_match($regex, $email)) {
        echo  json_encode(array('Message'=>'false','status'=>'there is something wrong with your email. check your email and try again'));
    } 
    else{
    if(strlen($description) < 100){
$sql = "UPDATE twitter_users SET fullname='$first_name', email='$email', description='$description',website='$website'  WHERE id='$id' ";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
                                    $user = $stmt->execute();
                                    if($user){
		   echo json_encode(array("Message"=>'true',"Updated Id"=>$id));
                                    }else{
                                        echo json_encode(array("Message"=>'false'));
                                    }
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
    }else{
        echo json_encode(array("Message"=>'false','Error'=>'Description too large only 100 characters allowed'));
    }
    }
    }
}

function updateUser1($id,$first_name,$last_name,$email,$pass) {
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

function img_unautop($pee) {
    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<div class="figure">$1</div>', $pee);
    return $pee;
}

function Email($email){
 include "PHPMailer_v5.1/class.phpmailer.php"; // something like this include include "PHPMailer_v2.0.0/class.phpmailer.php";
$confirm_code=md5($email); 
$mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "ssl://smtp.gmail.com"; // specify main and backup server
$mail->Port = 465; // set the port to use
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "karamjeetpnf@gmail.com"; // your SMTP username or your gmail username
$mail->Password = "#karampnf#"; // your SMTP password or your gmail password
$from = "webmaster@example.com"; // Reply to this email
$to=$email; // Recipients email ID
$name="Karamjeet"; // Recipient's name
$mail->From = $from;
$mail->FromName = "Reportedly"; // Name to indicate where the email came from when the recepient received
$mail->AddAddress($to,$name);
$mail->AddReplyTo($from,"Reportedly");
$mail->WordWrap = 50; // set word wrap
$mail->IsHTML(true); // send as HTML
$mail->Subject = " Sending Email From Php Using Gmail";
$mail->Body = "Thanks for creating an account on Reportedly! To verify your account, please click the link below <br>http://reportedly.pnf-sites.info/confirm.php?passkey=$confirm_code<br>If you believe you received this in error, feel free to ignore. You may contact us at hello@Reportedly.co <br>Thanks!"; //HTML Body
$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}

}

?>
