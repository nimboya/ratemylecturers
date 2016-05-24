<?php
/*
@ Author: Ewere Diagboya
@ Date: 08-01-2016
@ Time: 4:00pm
@ Location: Ajah, Lagos
@ Project: RateMyProfessor
*/
class User {
// User
  /*
  @params
	- $username
	- $password
  */
  public static function Login($loginparams) {
	$db = Utility::mysqlRes();
	$response = array();
	$errors = array();
   
	// Input Validation
	$email = isset($loginparams['email']) ? $loginparams['email'] : null;
<<<<<<< HEAD
	$password = isset($loginparams['password']) ? sha1($loginparams['password']) : null;
=======
	$password = isset($loginparams['password']) ? $loginparams['password'] : null;
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	
	if(!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid!";
	}
	
	if(strlen(trim($password)) === 0) {
        $errors[] = "Please enter password!";
	}
	
	if(empty($errors)) {
<<<<<<< HEAD
		//$login = $db->students()->where("email",$loginparams['email'])
		//$pverify = password_verify($loginparams['password'],$login['password']);
		//$login = $db->students()->where("email",$loginparams['email'])->where("password",$pverify);
		$pswd = sha1($loginparams['password']);
		$login = $db->students()->where("email",$loginparams['email'])->where("password",$pswd);
=======
		$login = $db->students()->where("email",$loginparams['email'])->where("password",$loginparams['password']);
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
		
		if($login->count()) {
			$response = array('error_code'=>0,'status'=>'success','description'=>"Login Successful");
		} else {
			$response = array('error_code'=>1,'status'=>'failed','description'=>"Invalid Login Details");
		}
	} else {
		$errors = implode(",", $errors);
		$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
	}
	return $response;
  }
  
<<<<<<< HEAD
  public static function SocialLogin($params) {	 
	 $regresp = self::StuRegister($params);
	 $regres = json_decode($regresp);
	 if($regres->status == "ok") {
		$response = array('error_code'=>0,'status'=>'success','description'=>"Login Successful");
	 }
	 else if(strstr($regres->description,"Email Already Used")) {
		//session_start();
		//$_SESSION['activeuser'] = $params['email'];
=======
  public static function SocialLogin($params) {
	 $regresp = self::StuRegister($params);
	 $regres = json_decode($regresp);
	 if($regres->status == "ok") {
		session_start();
		$_SESSION['activeuser'] = $params['email'];
		$response = array('error_code'=>0,'status'=>'success','description'=>"Login Successful");
	 }
	 else if(strstr($regres->description,"Email Already Used")) {
		session_start();
		$_SESSION['activeuser'] = $params['email'];
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
		$response = array('error_code'=>0,'status'=>'success','description'=>"Login Successful");
	 }
	 return $response;
  }  
	  

  public static function Forgot($forgotparams) {
	$db = Utility::mysqlRes();
	$response = array();
	$errors = array();
	
	if(!filter_var($forgotparams['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid!";
	}
	// Check Mail Existence
	if(self::EmailExists($forgotparams['email']) == true) {
		$errors[] = "Email Does Not Exist";
	}
	
	if(empty($errors)) {
		$student = $db->students()->where("email",$forgotparams['email']);
<<<<<<< HEAD
		if($student->count()>0) {			
			// Send a New Password
			$newpassword = "RMP".mt_rand(10000000,99999999);
			$dbnewpassword = sha1($newpassword);
			$data = array("email"=>$forgotparams['email'],"password"=>$dbnewpassword);
			$student->update($data);
			$headers="From: contactus@ratemylecturers.com.ng";
			$sendmail= mail($forgotparams['email'],"Your new password","Dear user, your new password is: $newpassword", $headers);
			
			if ($sendmail) {
			$response = array('error_code'=>0,'status'=>'ok','description'=>'Password Changed Successfully');
			} else {$response=array('error_code'=>0,'status'=>'ok','description'=>'Mail could not be sent now');}
		
		}else {
			$errors = implode(",",$errors);
			$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
		}
		}
	 else {
=======
		if($student->count()) {			
			// Send a New Password
			$newpassword = "RMP".mt_rand(10000000,99999999);
			$data = array("email"=>$forgotparams['email'],"password"=>$newpassword);
			$student->update($data);
			mail($forgotparams['email'],"Your new password","Dear user, your new password is: $newpassword, <p>Thank you for using RateMyLectuers");
			$response = array('error_code'=>0,'status'=>'ok','description'=>'Password Changed Successfully');
		}
		else {
			$errors = implode(",",$errors);
			$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
		}
	} else {
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
		$errors = implode(",",$errors);
		$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
	}
	return $response;
  }
  
  public static function ChangePassword($chparams) {
	$db = Utility::mysqlRes();
	$response = array();
	$errors = array();
	
	$oldpass = isset($chparams['oldpass']) ? $chparams['oldpass'] : null;
	$newpass = isset($chparams['newpass']) ? $chparams['newpass'] : null;
	$rnewpass = isset($chparams['rnewpass']) ? $chparams['rnewpass'] : null;
	
	if(strlen(trim($oldpass)) === 0){
        $errors[] = "Please enter your old password.";
	}
	
	if(strlen(trim($oldpass)) < 6){
        $errors[] = "Password must be greater than 5 characters.";
	}
	
	if(strlen(trim($newpass)) === 0){
        $errors[] = "Please enter your new password.";
	}
	
	if(strlen(trim($rnewpass)) === 0){
        $errors[] = "Please enter your new password again.";
	}
	
	if(trim($rnewpass) || trim($oldpass)) {
		$errors[] = "Your new password does not match.";
	}
	
	if(empty($errors)) {
		$loginparams = array('email'=>$chparams['email'],'password'=>$oldpass);
		$loginresp[] = User::Login($loginparams);
		if($status['error_code'] == 0) {
			// Change the Password
<<<<<<< HEAD
			$dbnewpass = sha1($newpass);
			$data = array("password"=>$dbnewpass);
=======
			$data = array("password"=>$newpass);
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
			$license = $db->students()->where('email',$chparams['email']);
			$students->update($data);
			
			$response = array('error_code'=>0,'status'=>'success','description'=>"Password Changed Succesfully");
		} else {
			$response = array('error_code'=>1,'status'=>'failed','description'=>"Old Password is Incorrect");
		}
	} else {
		$response[] = array('error_code'=>1,'status'=>'failed','description'=>$errors);
	}
	return $response;	
  }

  
  public static function UpdateProfile($regparams) {
	   // Db Connection Utility
	  $db = Utility::mysqlRes();
	  $response = array();
	  $errors = array();
	  
	  //$name = isset($storeparams['name']) ? $storeparams['name'] : null;
  }
  
  public static function StuRegister($regparams) {
	  // Db Connection Utility
	  $db = Utility::mysqlRes();
	  $response = array();
	  $errors = array();
	  
	  $fullname = isset($regparams['fullname']) ? trim($regparams['fullname']) : null;
	  $email = isset($regparams['email']) ? trim($regparams['email']) : null;
	  $password = isset($regparams['password']) ? trim($regparams['password']) : null;
<<<<<<< HEAD
	  
=======
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	  $rpass = isset($regparams['rpass']) ? trim($regparams['rpass']) : null;
	  
	  // Input Validation
	  if(strlen(trim($fullname)) === 0){
        $errors[] = "Please enter your fullname!";
	  }
	  
	  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid!";
	  }
	  
	  if(strlen(trim($password)) === 0){
        $errors[] = "Please enter your password!";
	  }
	  
	  if(trim($password) != trim($rpass)) {
		$errors[] = "Your passwords do not match";
	  }
	  
	  if(self::EmailExists($email) == false) {
		$errors[] = "Email Already Used";
	  }
	  
	  if(empty($errors)) {
<<<<<<< HEAD
	       // $salt= mcrypt_create_iv(12, MCRYPT_DEV_URANDOM);
	    $password = crypt($password);
=======
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
		$regparams = array('fullname'=>$fullname,'email'=>$email,'password'=>$password);
        //Process Registration.
		$proc = $db->students->insert($regparams);
		$response = array('error_code'=>0,'status'=>'ok','description'=>'Successfully Registered'); 
      } else {
		$errors = implode(",",$errors);
		$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
	  }
	  return $response; 
  }
  
<<<<<<< HEAD
  private static function EmailExists($email) { 
=======
  public static function EmailExists($email) {
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	  $db = Utility::mysqlRes();
	  $status = false;
	  $response = array();
	  $total = $db->students()->where("email",$email)->count();
	  
	  if ($total > 0) {
<<<<<<< HEAD
		  // Email Exists
		  $status = false;
	  } else {
		  // Email Does not Exist
=======
		  $status = false;
	  } else {
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
		  $status = true;
	  }
	  return $status;
  }
  
<<<<<<< HEAD
   private static function EmailExistsProf($email) {
=======
   public static function EmailExistsProf($email) {
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	  $db = Utility::mysqlRes();
	  $status = false;
	  $response = array();
	  $total = $db->students()->where("email",$email)->count();
	  
	  if ($total > 0) {
		  $status = false;
	  } else {
		  $status = true;
	  }
	  return $status;
  }
  
  public static function ProfRegister($regparams) { 
	// Db Connection Utility
	  $db = Utility::mysqlRes();
	  $response = array();
	  $errors = array();
	  
	  $name = isset($regparams['name']) ? $regparams['name'] : null;
	  $email = isset($regparams['email']) ? $regparams['email'] : null;
	  $password = isset($regparams['password']) ? $regparams['password'] : null;
	  $school = isset($regparams['school']) ? $regparams['school'] : null;
	  // Input Validation
	  
	  if(strlen(trim($name)) === 0){
        $errors[] = "Please enter your full name!";
	  }
	  
	  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid!";
	  }
	  
	  if(strlen(trim($password)) === 0){
        $errors[] = "Please enter your password!";
	  }
	  
	  if(strlen(trim($password)) <= 6){
        $errors[] = "Your password must not be less than 6 characters!";
	  }
	  
	  if(self::EmailExistsProf($email) == false) {
		$errors[] = "Email Already Used";
	  }
	  
	  if(empty($errors)){
        //Process Registration.
		$proc = $db->store->insert($regparams);
		$response = array('error_code'=>0,'status'=>'ok','description'=>'Success'); 
      } else {
		$errors = implode(",",$errors);
		$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
	  }
	  return $response; 
  }
  
  public static function GetProfProfile($getparams) {
	$db = Utility::mysqlRes();
<<<<<<< HEAD
          
	$profid = isset($getparams['profid']) ? $getparams['profid'] : null;
	try {
	  $Lecturers = $db->Lecturers()->where("id", $profid);
	  foreach($Lecturers as $Lecturer) {
		$response = $Lecturer;
=======
	$profid = isset($getparams['userid']) ? $getparams['userid'] : null;
	try {
	  $professors = $db->profs()->where("id",$profid);
	  foreach($professors as $professor) {
		$response = $professor;
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	  }
	} catch (Exception $ex) {
	   $response = array('error_code'=>0,'status'=>"failed",'description'=>$ex->getMessage());
	}
	return $response;
  }
  
<<<<<<< HEAD
  public static function GetUserProfile_bad($params) {
	$db = Utility::mysqlRes();
	$userid = $params['userid'];
	  $username = $db->students()->select("fullname")->where("email",$userid);
	  $response = $username;
	 
	try {
	  if($members->count() == 0)
	  {
		 $response = array('error_code'=>1,'status'=>"success",'description'=>"empty"); 
	  } 
	 else {
		foreach ($members as $member) {
				
		}
	 }
	} catch (Exception $ex) {
			$response = array('error_code'=>1,'status'=>"failed",'description'=>$ex->getMessage());
	}
	 return $response;
  }
  
=======
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
  public static function GetUserProfile($getparams) {
	$db = Utility::mysqlRes();
	$memberid = isset($getparams['userid']) ? $getparams['userid'] : null;
	try {
	  $members = $db->students()->where("email",$memberid);
	  if($members->count() == 0)
	  {
		 $response = array('error_code'=>1,'status'=>"success",'description'=>"empty"); 
	  } 
	  else {
		 foreach ($members as $member) {
			$response = $member;
		 }
	  }
	} catch (Exception $ex) {
			$response = array('error_code'=>1,'status'=>"failed",'description'=>$ex->getMessage());
	}
	return $response;
  }
  
<<<<<<< HEAD
  
=======
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
  public static function FindProfessor($params) {
	  $db = Utility::mysqlRes();
	  $q = strip_tags($params['q']);
	  
	  $results = $db->profs()->where("name LIKE ?","%$q%");
	  return $results;
  }
  
}