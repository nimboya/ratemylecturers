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
	$password = isset($loginparams['password']) ? $loginparams['password'] : null;
	
	if(!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid!";
	}
	
	if(strlen(trim($password)) === 0) {
        $errors[] = "Please enter password!";
	}
	
	if(empty($errors)) {
		$login = $db->students()->where("email",$loginparams['email'])->where("password",$loginparams['password']);
		
		if($login->count()) {
			$response = array('error_code'=>'0','status'=>'success','description'=>"Login Successful");
		} else {
			$response = array('error_code'=>'1','status'=>'failed','description'=>"Invalid Login Details, Try Again");
		}
	} else {
		$response = array('error_code'=>'1','status'=>'failed','description'=>$errors);
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
	
	if(empty($errors)) {
		$student = $db->students()->where("email",$forgotparams['email']);
		if($student->count()) {
			try {
				// Send a New Password
				$newpassword = "RMP".mt_rand(00000000,999999);
				$data = array("email"=>$forgotparams['email'],"password"=>$newpassword);
				$student->update($data);
				mail($forgotparams['email'],"Your new password","Dear user, your new password is: $newpassword");
				$response = array('error_code'=>'0','status'=>'ok','description'=>'password changed');
			} 
			catch (Exception $ex) {
				$response = array('error_code'=>'0','status'=>"failed",'description'=>$ex->getMessage());
			}
		}
		else {
			$response = array('error_code'=>'1','status'=>'failed','description'=>$errors);
		}
	} else {
		$response = array('error_code'=>'1','status'=>'failed','description'=>$errors);
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
			$data = array("password"=>$newpass);
			$license = $db->students()->where('email',$chparams['email']);
			$students->update($data);
			
			$response = array('error_code'=>'0','status'=>'success','description'=>"Password Changed Succesfully");
		} else {
			$response = array('error_code'=>'1','status'=>'failed','description'=>"Old Password is Incorrect");
		}
	} else {
		$response[] = array('error_code'=>'1','status'=>'failed','description'=>$errors);
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
	  
	  $firstname = isset($regparams['firstname']) ? trim($regparams['firstname']) : null;
	  $lastname = isset($regparams['lastname']) ? trim($regparams['lastname']) : null;
	  $email = isset($regparams['email']) ? trim($regparams['email']) : null;
	  $password = isset($regparams['password']) ? trim($regparams['password']) : null;
	  $rpass = isset($regparams['rpass']) ? trim($regparams['rpass']) : null;
	  
	  // Input Validation
	  if(strlen(trim($firstname)) === 0){
        $errors['firstname'] = "Please enter your firstname!";
	  }
	  
	  if(strlen(trim($lastname)) === 0){
        $errors['lastname'] = "Please enter your lastname!";
	  }
	  
	  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email is not valid!";
	  }
	  
	  if(strlen(trim($password)) === 0){
        $errors['password'] = "Please enter your password!";
	  }
	  /*
	  if(trim($password) || trim($rpass)) {
		$errors[] = "Your passwords does not match.";
	  }
	  */
	  if(empty($errors)) {
		
		$regparams = array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'password'=>$password);
		
        //Process Registration.
		$proc = $db->students->insert($regparams);
		$response = array('error_code'=>'0','status'=>'ok','description'=>'Success'); 
      } else {
		$response = array('error_code'=>'1','status'=>'failed','description'=>$errors);
	  }
	  return $response; 
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
	  
	  // DeviceID Parameter
	  
	  if(empty($errors)){
        //Process Registration.
		$proc = $db->store->insert($regparams);
		$response[] = array('error_code'=>'0','status'=>'ok','description'=>'Success'); 
      } else {
		$response[] = array('error_code'=>'1','status'=>'failed','description'=>$errors);
	  }
	  return $response; 
  }
  
  public static function GetProfProfile($profid) {
	$db = Utility::mysqlRes();
	$response = array();
	
	try {
	  $professor = $db->profs()->where("id",$profid);
	  $response = $professor;
	} catch (Exception $ex) {
	   $response[] = array('error_code'=>'0','status'=>"failed",'description'=>$ex->getMessage());
	}
	return $response;
  }
  
  public static function GetUserProfile($profid) {
	$db = Utility::mysqlRes();
	$response = array();
	
	try {
	  $professor = $db->students()->where("id",$profid);
	  $response = $professor;
	} catch (Exception $ex) {
	   $response[] = array('error_code'=>'0','status'=>"failed",'description'=>$ex->getMessage());
	}
	return $response;
	}
  
}