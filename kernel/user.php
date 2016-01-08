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
  
  
  }

  public static function Forgot($forgotparams) {
	$db = Utility::mysqlRes();
	$response = array();
	$errors = array();  

	
  }
  
  public static function ProfRegister($regparams) {
	  
  }
  
  
  public static function StuRegister($regparams) {
	  
	  $db = Utility::mysqlRes();
	  $response = array();
	  $errors = array();
	  
	  $name = isset($storeparams['name']) ? $storeparams['name'] : null;
	  $email = isset($storeparams['email']) ? $storeparams['email'] : null;
	  $address = isset($storeparams['address']) ? $storeparams['address'] : null;
	  $phone = isset($storeparams['phone']) ? $storeparams['phone'] : null;
	  $state = isset($storeparams['state']) ? $storeparams['state'] : null;
	  $city = isset($storeparams['city']) ? $storeparams['city'] : null;
	  $lga = isset($storeparams['lga']) ? $storeparams['lga'] : null;
	  $country = isset($storeparams['country']) ? $storeparams['country'] : null;
	  $deviceid = isset($storeparams['deviceid']) ? $storeparams['deviceid'] : null;
	  // Input Validation
	  if(strlen(trim($name)) === 0){
        $errors[] = "Please enter your store name!";
	  }
	  
	  if(strlen(trim($address)) === 0){
        $errors[] = "Please enter your store address!";
	  }
	  
	  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid!";
	  }
	  
	  if(strlen(trim($state)) === 0){
        $errors[] = "Please enter your state!";
	  }
	  
	  if(strlen(trim($city)) === 0){
        $errors[] = "Please enter your city!";
	  }
	  
	  if(strlen(trim($lga)) === 0){
        $errors[] = "Please enter your local government!";
	  }
	  
	  if(strlen(trim($country)) === 0){
        $errors[] = "Please enter your country!";
	  }
	  
	  if(strlen(trim($deviceid)) === 0){
        $errors[] = "Please enter your DeviceID!";
	  }
	  // DeviceID Parameter
	  
	  if(empty($errors)){
        //Process Registration.
		$proc = $db->store->insert($storeparams);
		$response[] = array('error_code'=>'0','status'=>'ok','description'=>'Success'); 
      } else {
		$response[] = array('error_code'=>'1','status'=>'failed','description'=>$errors);
	  }
	  return $response; 
  }
  
  
}