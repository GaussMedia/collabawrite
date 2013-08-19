<?php
class KARAMJEET{


/* ========================== Insert =============*/	
	public function insert($table,$where)
	{
		$TBL=$table[0];
		//print_r(implode($where));
		//die;
		if($TBL == 'users')
		{
			$email=str_replace(',','',$where[2]);
			$pwd=str_replace(',','',$where[3]);
			$pwd=md5($pwd);
			$where[3]="'".$pwd."',";
			//print_r(implode($where));

		    $res1=$this->Query('SELECT email FROM '.$TBL.' WHERE email='.$email.'');
			if(mysql_num_rows($res1)>0)
			{
				$T[]= "Email Already Exist";
			}
			else
			{
			    $res=$this->Query('INSERT INTO '.implode($table).' VALUES '.implode($where).'');
				if($res)
				{
					$T="Query Executed Successfully  Inserted Id ".mysql_insert_id()."";
				}
		    }
		}else{
			
			$res=$this->Query('INSERT INTO '.implode($table).' VALUES '.implode($where).'');
			if($res)
			{
				$T="Query Executed Successfully  Inserted Id ".mysql_insert_id()."";
			}
		}
		return($T);
		
	}

/* ========================== Check Null Fields =============*/	
public function check_null($where,$table)
{
	//print_r($where=implode($where));
	//die;
	//print_r($where);
	//list($slug,$fnm, $lnm, $email,$pass,$d) =preg_split("' '", $where);
	//print_r(list($slug,$fnm, $lnm, $email,$pass,$d) = preg_split("' '", $where));
	//print_r(($slug));
	//die;
	$TBL=$table[0];
	
	
	// ======== Users =========//
	if($TBL == 'users')
	{
		//print_r($where);
		//die;
			$fnm=(str_replace("',","", $where[0]));
     		$fnm=(str_replace("'","", $fnm));
            
			$lnm=(str_replace("',","", $where[1]));
    		$lnm=(str_replace("'","", $lnm));
            
			$email=(str_replace("',","", $where[2]));
    		$email=(str_replace("'","", $email));
            
			$pwd=(str_replace("',","", $where[3]));
    		$pwd=(str_replace("'","", $pwd));
//die;
	if($fnm=="")
	{
		$err[]="Please Fill First Name";
	}
	if($lnm=="")
	{
		$err[]="Please Fill Last Name";
	}
	if($email=="")
	{
		$err[]="Please Fill Email";
	}
	if($pwd=="")
	{
		$err[]="Please Fill Password";
	}
	if(!empty($email))
	{
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		if(!preg_match($regex, $email))
		{
			$err[]="Please Fill Valid Email";
		}
	}
	if(!empty($pwd))
	{
	    if(strlen($pwd) < 6)
		{
			$err[]="Password must be atlest 6 characters";
		}
	}
	}//main If
	
	//========= Song ==========//
	if($TBL == 'song')
	{
	   
		//print_r($where);
		//die;
			
		$blog_t=(str_replace("',","", $where[0]));
		$blog_t=(str_replace("'","", $blog_t));
		
		$blog_des=(str_replace("',","", $where[1]));
		$blog_des=(str_replace("'","", $blog_des));
		
		$blog_image=(str_replace("',","", $where[2]));
		$blog_image=(str_replace("'","", $blog_image));
		
		$blog_tag=(str_replace("',","", $where[3]));
		$blog_tag=(str_replace("'","", $blog_tag));
		
		if($blog_t=="")
		{
			$err[]="Please Fill Song Title";
		}
		if($blog_des=="")
		{
			$err[]="Please Fill Song Description";
		}
		if($blog_image=="")
		{
			$err[]="Please Select Song";
		}
		if($blog_tag=="")
		{
			$err[]="Please Fill Song Artist";
		}
		
		
	}
	
	//========= Blog ==========//
	if($TBL == 'blog')
	{
		//print_r($where);
		//die;
			
		$blog_t=(str_replace("',","", $where[0]));
		$blog_t=(str_replace("'","", $blog_t));
		
		$blog_des=(str_replace("',","", $where[1]));
		$blog_des=(str_replace("'","", $blog_des));
		
		$blog_image=(str_replace("',","", $where[2]));
		$blog_image=(str_replace("'","", $blog_image));
		
		$blog_tag=(str_replace("',","", $where[3]));
		$blog_tag=(str_replace("'","", $blog_tag));
		
		if($blog_t=="")
		{
			$err[]="Please Fill Blog Title";
		}
		if($blog_des=="")
		{
			$err[]="Please Fill Blog Description";
		}
		if($blog_image=="")
		{
			$err[]="Please Select Image";
		}
		if($blog_tag=="")
		{
			$err[]="Please Fill Blog Tag";
		}
		
		}
		
		
	//========= Page ==========//
	if($TBL == 'page')
	{
		    //print_r($where);
			//die;
	        $page_t=(str_replace("',","", $where[1]));
		$page_t=(str_replace("'","", $page_t));
            $page_des=(str_replace("',","", $where[2]));
		$page_des=(str_replace("'","", $page_des));
            $seo_t=(str_replace("',","", $where[3]));
		$seo_t=(str_replace("'","", $seo_t));
            $seo_k=(str_replace("',","", $where[4]));
		$seo_k=(str_replace("'","", $seo_k));
            $meta=(str_replace("',","", $where[5]));
		$meta=(str_replace("'","", $meta));
//die;
		if($page_t=="")
		{
			$err[]="Please Fill Page Title";
		}
		if($page_des=="")
		{
			$err[]="Please Fill Page Description";
		}
		if($seo_t=="")
		{
			$err[]="Please Fill SEO Title";
		}
		if($seo_k=="")
		{
			$err[]="Please Fill SEO Keyword";
		}
		if($meta=="")
		{
			$err[]="Please Fill Meta Description";
		}

		
		}//main If
		
	//========= Slogan and Image ========//
        if($TBL == 'imageslogan')
	{
//		    print_r($where);
//			die;
	    $logo_title=(str_replace("',","", $where[0]));
		$logo_title=(str_replace("'","", $logo_title));
                
            $logo_text=(str_replace("',","", $where[1]));
		$logo_text=(str_replace("'","", $logo_text));
           
	    $logo_image=(str_replace("',","", $where[2]));
		$logo_image=(str_replace("'","", $logo_image));
//die;
		if($logo_title=="")
		{
			$err[]="Please Type title for slogan";
		}
                if($logo_text=="")
		{
			$err[]="Please Type Slogan for home page";
		}
		if($logo_image=="")
		{
			$err[]="Please Select background Image";
		}
		
	}
	// ============end here =============//
	//----------Logo --------//
	if($TBL == 'logo')
	{
		   // print_r($where);
			//die;
	    $logo_title=(str_replace("',","", $where[0]));
		$logo_title=(str_replace("'","", $logo_title));
           
	    $logo_image=(str_replace("',","", $where[1]));
		$logo_image=(str_replace("'","", $logo_image));
//die;
		if($logo_title=="")
		{
			$err[]="Please Type Logo Title";
		}
		if($logo_image=="")
		{
			$err[]="Please Select Logo Image";
		}
		
	}
        
        //----------Logo --------//
	if($TBL == 'pay_amount')
	{
		   // print_r($where);
			//die;
	    $logo_title=(str_replace("',","", $where[0]));
		$logo_title=(str_replace("'","", $logo_title));
           
	    $logo_image=(str_replace("',","", $where[1]));
		$logo_image=(str_replace("'","", $logo_image));
                
                $logo_image1=(str_replace("',","", $where[2]));
		$logo_image1=(str_replace("'","", $logo_image1));
//die;
		if($logo_title=="")
		{
			$err[]="Please Select payment type";
		}
		if($logo_image=="")
		{
			$err[]="Please fill amount";
		}
                if($logo_image1=="")
		{
			$err[]="Please fill some text";
		}
		
	}
	
	
	//-------- Top Navs  -----------//
	
	if($TBL == 'top_navs')
	{
		   // print_r($where);
			//die;
	    $nav_title=(str_replace("',","", $where[0]));
		$nav_title=(str_replace("'","", $nav_title));
		
		$page_title=(str_replace("',","", $where[1]));
		$page_title=(str_replace("'","", $page_title));
		if($nav_title=="")
		{
			$err[]="Please Type Navigation Title";
		}
		if($page_title=="")
		{
			$err[]="Please Type Page Title";
		}
		
	}
	
	//----------- Slider Images------//
	if($TBL == 'slider_images')
	{
	 
		//print_r($where);
		//die;
			
		$image_title=(str_replace("',","", $where[0]));
		$image_title=(str_replace("'","", $image_title));
		
		$image_des=(str_replace("',","", $where[1]));
		$image_des=(str_replace("'","", $image_des));
		
		$slider_image=(str_replace("',","", $where[2]));
		$slider_image=(str_replace("'","", $slider_image));
		
		
		if($image_title=="")
		{
			$err[]="Please Fill Image Title";
		}
		if($image_des=="")
		{
			$err[]="Please Fill Some Description";
		}
		if($slider_image=="")
		{
			$err[]="Please Select Slider Image";
		}
		
	}
	//========= Country Code ==========//
	if($TBL == 'country')
	{
		    //print_r($where);
			//die;
	    $ques=(str_replace("',","", $where[0]));
		$ques=(str_replace("'","", $ques));
           
	    $ans=(str_replace("',","", $where[1]));
		$ans=(str_replace("'","", $ans));
//die;
		if($ques=="")
		{
			$err[]="Please Fill Country Name";
		}
		if($ans=="")
		{
			$err[]="Please Fill Country Code";
		}
		
	}
        
        
        //========= Country Code ==========//
	if($TBL == 'employees')
	{
		    //print_r($where);
			//die;
	    $feild1=(str_replace("',","", $where[2]));
		$feild1=(str_replace("'","", $feild1));
            
            $feild2=(str_replace("',","", $where[3]));
		$feild2=(str_replace("'","", $feild2));
              
            $feild3=(str_replace("',","", $where[4]));
		$feild3=(str_replace("'","", $feild3));
            
            $feild4=(str_replace("',","", $where[5]));
		$feild4=(str_replace("'","", $feild4));
                
            $feild5=(str_replace("',","", $where[6]));
		$feild5=(str_replace("'","", $feild5));    
           
	    $feild6=(str_replace("',","", $where[7]));
		$feild6=(str_replace("'","", $feild6));
//die;
		if($feild1=="")
		{
			$err[]="Please Fill First Name";
		}
		if($feild2=="")
		{
			$err[]="Please Fill Last Name";
		}
		if($feild3=="")
		{
			$err[]="Please Fill Email address";
		}
                if(!empty($feild3))
	        {
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		if(!preg_match($regex, $feild3))
		{
			$err[]="Please Fill Valid Email";
		}
	        }
                if($feild4 =="")
		{
			$err[]="Please Fill your Phone ";
		}
                
                
	}
        
	//???????????????????????	
	
	
	//========= Faq ==========//
	if($TBL == 'faq')
	{
		    //print_r($where);
			//die;
	    $ques=(str_replace("',","", $where[0]));
		$ques=(str_replace("'","", $ques));
           
	    $ans=(str_replace("',","", $where[1]));
		$ans=(str_replace("'","", $ans));
//die;
		if($ques=="")
		{
			$err[]="Please Type A Question";
		}
		if($ans=="")
		{
			$err[]="Please Fill Answer";
		}
		
		}//main If	
		return $err;

}
//****************   VALIDATION  OF IMAGES   *************//

//============      Image File Type      =============//
function validate_filetype($file)
{
	//echo $file;
	$handlers = array(
	'jpg'  => 'imagecreatefromjpeg',
	'jpeg' => 'imagecreatefromjpeg',
	'png'  => 'imagecreatefrompng',
	'gif'  => 'imagecreatefromgif'
	);
	
	$extension = strtolower(substr($file, strrpos($file, '.')+1));
	if ($handler = $handlers[$extension])
	{
		//print_r($handlers['png']);
		$image = $handler($file);
		//print_r($handler);
		return NULL;
		
		//do the rest of your thumbnail stuff here
	}
	else
	{
		$f[]="It's invalid image select only [gif,jpeg,png,jpg]. ";
		return $f;
	}

}

//============      Image File Size       ============//

function validate_image_size($size)
{
	if($size > '2097152')
	{
		$f[]="Image more than 2 MB cannot be uploaded";
		return $f;
	}
	else
	{
		return NULL;
	}
}

//============    Upload Image File ============//

function upload_image($filename,$path, $thumb_path)
{
         include("resize-class.php");
	$resizeObj = new resize($path.$filename);
	// thumb size 554X642
	list($width, $height) = getimagesize($path.$filename);
	$new_width = floor($width/2);
	$new_height =floor($height/2);
	$thumb_path_146x109 = $thumb_path;
	$resizeObj->resizeImage(554,642,'exact');
	if($t=$resizeObj->saveImage($thumb_path_146x109.$filename, 100))
	{
		return $t;
	}
	
}

/*=========================== Fetch All ==================*/
function fetch_all($table)
{
	$sql=$this->Query("SELECT * FROM $table ORDER BY id DESC");
    while($r = mysql_fetch_array($sql))
	{
		//print_r($r);
		//die;
		
	    $res[] = $r;
		//print_r($res);
		//die;
	   }
     	return $res;
}
/*=========================== Update One ==================*/

function update($table=null,$array_of_values=array(),$conditions='FALSE') {
	if ($table===null || empty($array_of_values))
	{
		 return false;
	}
	$what_to_set = array();
	/*echo '<pre>';
	print_r($array_of_values);*/
	foreach ($array_of_values as $field => $value) 
	{
		if (is_array($value) && !empty($value[0]))
		{
			 $what_to_set[]="`$field`='{$value[0]}'";
		}
		else
		{
			 $what_to_set []= "`$field`='".mysql_real_escape_string($value)."'";
			 /*print_r($what_to_set);*/
		}
	}
        $what_to_set_string = implode(',',$what_to_set);
//	print_r($what_to_set_string);
//	die;
	return $this->Query("UPDATE $table SET $what_to_set_string WHERE $conditions");
	/*die;*/
} 


/*=========================== Fetch One ==================*/
function fetch_one($table,$conditions)
{
	$sql=$this->Query("SELECT * FROM `$table` WHERE $conditions ");
        $res = mysql_fetch_assoc($sql);
     	return $res;
}

/*=========================== Status Changed ==================*/
function Status_Changed($id,$table,$status)
{
	if($status=='0')
	{
		$sql1=$this->Query("UPDATE $table SET status='1' WHERE id='$id'");
		//$res=Query($sql1);
		if($sql1)
		{
		  $t="Published";
		}
	}
	else
	{
		$sql1=$this->Query("UPDATE $table SET status='0' WHERE id='$id'");
		//$res=Query($sql1);
		if($sql1)
		{
		  $t='Unpublished';
		}
	}
	return $t;
}

	
/* ========================== Query =============*/		
	function Query($sql)
	{
		$result=mysql_query($sql) or die(mysql_error());
		if(!$result)
		{
			return NULL;
		}
		else{
			return $result;
		}
		
	}
	
/* ========================== Delete User =============*/		
	
	public function delete($table,$where)
	{
		$sql='SELECT * FROM '.$table.' WHERE '.$where.'';
		$res=mysql_query($sql)or die(mysql_error());
		if(mysql_num_rows($res)>0)
		{
			$sql1='DELETE FROM '.$table.' WHERE '.$where.'';
			$res1=mysql_query($sql1)or die(mysql_error());
			if($res1)
			{
				echo "Deleted ".$where;
			}
		}
		else
		{
			echo $where."Already Deleted";
		}
	}
	
//Escapes bad values for MySQL to prevent SQL injections.
    public function EscapeString($badstring)
    {
        if(!get_magic_quotes_gpc())
        {
            $goodstring = addslashes($badstring);
        }
        else
        {
            $goodstring = stripslashes($badstring);
        }
        
        $goodstring = mysql_real_escape_string($badstring);
        
        return $goodstring;
    }


	
/* ========================== Encrypt Password =============*/	
    public function EncryptPassword($password)
    {
      return md5($password);  
    } 

	
/* ========================== Login Admin =============*/		
public function CheckLogin($username,$password)
    {
        $this->username = $this->EscapeString($username); 
        $this->password = $this->EscapeString($this->EncryptPassword($password));
                                                   
        $result=$this->Query("SELECT * FROM `admin` WHERE `admin` = '$this->username' AND `pwd` = '$this->password' LIMIT 1");
		
       
        //If we get one result we know the login is right.
        if(mysql_num_rows($result) == 1)
        {
			session_start();
            $this->username = $username;
	    $_SESSION['username'] = $this->username;
            $_SESSION['authorized'] = 1; 
            header('location:index.php');
        }
        else 
        {
            $t[]='Invalid Username Or Password';
			return $t;
        }
            
    }
    
   /* ==========================  Login  All =============*/		
public function CheckCompany($username,$password,$type)
    {
        $this->username = $this->EscapeString($username); 
        $this->password = $this->EscapeString($this->EncryptPassword($password));
                                                   
        $result=$this->Query("SELECT * FROM `user_type` WHERE user_type='$type' AND `username` = '$this->username' AND `password` = '$this->password' LIMIT 1");
        //echo $r=mysql_num_rows($result);
        //die;
		
       
        //If we get one result we know the login is right.
        if(mysql_num_rows($result) == 1)
        {
	    session_start();
            $this->username = $username;
	    $_SESSION['username'] = $this->username;
            $_SESSION['type'] = $type;
//            if($type == 'Company')
//            {
//                $
//            }
            //$_SESSION['authorized'] = 1; 
            header('location:index.php');
        }
        else 
        {
            $t[]='Invalid Email Or Password';
			return $t;
        }
            
    }
    
   //================ SELECT ALL FROM ONE =====================//
    
   public function SelectFromOne($table,$conditions)
   {
       $sql=$this->Query("SELECT * FROM $table WHERE $conditions LIMIT 1");
       if(mysql_num_rows($sql) == 1)
        {
           $res = mysql_fetch_assoc($sql);
           return $res;
        }
        else
        {
            $empty = "Query is empty";
            return $empty;
        }
   }
	 
	
/*=========================== Ststus According To Selected Id's =========================*/	

function selected_status($all_id,$action,$table)
{
	if($action == 'publish')
	{
		foreach($all_id as $v)
		{
			$res=$this->Query("UPDATE `$table` SET status='1' WHERE id='$v'");
		}
		if($res)
		{
			$r='Selected Ids Are Published Sucessfully';
			return $r;
		}
	}
	if($action == 'unpublish')
	{
		foreach($all_id as $v)
		{
		 $res=$this->Query("UPDATE `$table` SET status='0' WHERE id='$v'");
		}
		if($res)
		{
			$r='Selected Ids Are Unpublished Sucessfully';
			return $r;
		}
	}
	if($action == 'delete')
	{
		foreach($all_id as $v)
		{
		 //$res=$this->Query("DELETE FORM `$table` WHERE id='$v'");
		}
		if($res)
		{
			$r='Selected Ids Are Sucessfully Deleted';
			return $r;
		}
	}


}
	


} /// main Class=============================


///// Class Connection
class connection{
	//protected $link;
    //private $host, $user, $password, $db;

	public function construct($host,$user,$password,$db)
	{
		//$link;
	$this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
        $this->connect();
	}

/* ========================== Connection =============*/	
	private function connect()
	{
		$this->link=mysql_connect($this->host,$this->user,$this->password);
		mysql_select_db($this->db,$this->link);
	}

//============== Mysql Close ==================//
    public function Disconnect()
    {
		mysql_close($this->link);
		session_start();
		//session_destroy() ;
                session_unset();
		header('location:index.php');

    }
	
	

	/*public function __sleep()
    {
        return array('host', 'user', 'password', 'db');
    }

	public function __wakeup()
    {
        $this->connect();
    }*/
	
} //class

?>