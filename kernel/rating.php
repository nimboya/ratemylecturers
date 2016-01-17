<?php
/*
@ Author: Ewere Diagboya
@ Date: 13-01-2016
@ Time: 8:04pm
@ Location: Ajah, Lagos
@ Project: RateMyProfessor
*/
class Rating {

public static function SendRating($rating) {
	$db = Utility::mysqlRes();
	$response = array();
	$errors = array();
	
	$coursecode = isset($rating['coursecode']) ? $rating['coursecode'] : null;
	$helpfulness = isset($rating['helpfulness']) ? $rating['helpfulness'] : null;
	$clarity = isset($rating['clarity']) ? $rating['clarity'] : null;
	$easiness = isset($rating['easiness']) ? $rating['easiness'] : null;
	$takenforcredit = isset($rating['takenforcredit']) ? $rating['takenforcredit'] : null;
	$comment = isset($rating['comment']) ? $rating['comment'] : null;
	$interest = isset($rating['interest']) ? $rating['interest'] : null;
	$textbookuse = isset($rating['textbookuse']) ? $rating['textbookuse'] : null;
	
	if(strlen(trim($coursecode)) === 0) {
        $errors[] = "Please enter course code!";
	}
	if(strlen(trim($helpfulness)) === 0) {
        $errors[] = "Please select helpfulness!";
	}
	if(strlen(trim($clarity)) === 0) {
        $errors[] = "Please select clarity!";
	}
	if(strlen(trim($easiness)) === 0) {
        $errors[] = "Please select easiness!";
	}
	if(strlen(trim($takenforcredit)) === 0) {
        $errors[] = "Please select an option!";
	}
	if(strlen(trim($comment)) === 0) {
        $errors[] = "Please enter comment!";
	}
	if(strlen(trim($interest)) === 0) {
        $errors[] = "Please select your interest!";
	}
	if(strlen(trim($textbookuse)) === 0) {
        $errors[] = "Please select if textbook was used!";
	}
	
	if(empty($errors)) {
		// Inserting Rating Data
		$proc = $db->ratings->insert($rating);
		$response = array('error_code'=>'0','status'=>'success','description'=>"Rating Sent");
	} else {
		$response = array('error_code'=>'1','status'=>'failed','description'=>$errors);
	}
	return $response;
  }	
	

}