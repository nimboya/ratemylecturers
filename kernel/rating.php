<?php
/*
@ Author: Ewere Diagboya
@ Date: 13-01-2016
@ Time: 8:04pm
@ Location: Ajah, Lagos
@ Project: RateMyProfessor
*/
class Rating {
// Send Rating
  public static function PostRating($rating) {
	$db = Utility::mysqlRes();
	$response = array();
	$errors = array();
	
<<<<<<< HEAD
	$userid = isset($rating['userid']) ? $rating['userid'] : null;
	$profid = isset($rating['profid']) ? $rating['profid'] : null;
	$school = isset($rating['school']) ? $rating['school'] : null;
	$lecturer= isset($rating['lecturer']) ? $rating['lecturer'] : null;
=======
	$userid = isset($rating['userid']) ? $rating['userid'] : null;;
	$profid = isset($rating['profid']) ? $rating['profid'] : null;;
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	$helpfulness = isset($rating['helpfulness']) ? $rating['helpfulness'] : null;
	$clarity = isset($rating['clarity']) ? $rating['clarity'] : null;
	$uptodate = isset($rating['uptodate']) ? $rating['uptodate'] : null;
	$lecturer_student = isset($rating['lecturer_student']) ? $rating['lecturer_student'] : null;
	$superstar = isset($rating['superstar']) ? $rating['superstar'] : null;
	$comment = isset($rating['comment']) ? $rating['comment'] : null;
	
<<<<<<< HEAD
	
	
=======
	if(strlen(trim($userid)) === 0) {
        $errors[] = "Please enter User ID!";
	}
	if(strlen(trim($profid)) === 0) {
        $errors[] = "Please enter Prof ID!";
	}
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	if(strlen(trim($helpfulness)) === 0) {
        $errors[] = "Please select Helpfulness!";
	}
	if(strlen(trim($clarity)) === 0) {
        $errors[] = "Please select Clarity!";
	}
	if(strlen(trim($uptodate)) === 0) {
        $errors[] = "Please select Up-to-date!";
	}
	if(strlen(trim($superstar)) === 0) {
        $errors[] = "Please select Superstar!";
	}
	if(strlen(trim($lecturer_student)) === 0) {
        $errors[] = "Please select rating for Lectuer-Student!";
	}
	if(strlen(trim($comment)) === 0) {
        $errors[] = "Please enter comment!";
	}
	
	if(empty($errors)) {
		// Insert Rating Data
<<<<<<< HEAD
		$rating = array('userid'=>$userid,'profid'=>$profid, 'lecturer'=>$lecturer, 'helpfulness'=>$helpfulness,
				  'clarity'=>$clarity, 'uptodate'=>$uptodate, 'lecturer_student'=>$lecturer_student, 'superstar'=>$superstar,
				  'comment'=>$comment, 'school'=>$school);
=======
		$rating = array('userid'=>$userid,'profid'=>$profid, 'helpfulness'=>$helpfulness,
				  'clarity'=>$clarity, 'uptodate'=>$uptodate, 'lecturer_student'=>$lecturer_student, 'superstar'=>$superstar,
				  'comment'=>$comment);
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
		$proc = $db->ratings->insert($rating);
		$response = array('error_code'=>0,'status'=>'success','description'=>"Rating Sent");
	} 
	else {
		$errors = implode(",",$errors);
		$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
	}
	return $response;
  }	
	
  public static function ViewRatings($params) {
	$db = Utility::mysqlRes();
	if(!isset($params['profid']) || $params['profid'] == "") {
	   //$pglimt = isset($params['pg']) ? $params['pg']*10 : "";
	   $pglimit = isset($params['pg']) ? $params['pg'] : 0;
	   $lt=20; $offset=20*$pglimit;
	   $ratings = $db->ratesum()->limit($lt,$offset);
	}
	else {
	   // Search with ProfID
<<<<<<< HEAD
           //$profid = $db->profs() ->select ("id");
=======
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	   $profid = strip_tags($params['profid']);
	   $pglimit = isset($params['pg']) ? $params['pg'] : 0;
	   $lt=20; $offset=20*$pglimit;
	   $ratings = $db->ratesum()->where("profid",$profid)->limit($lt,$offset);
	}
	return $ratings;
  }
  
  public static function RatingDetails($params) {
		$db = Utility::mysqlRes();
		$profid = strip_tags($params['profid']);
		$pglimit = isset($params['pg']) ? $params['pg'] : 0;
		$lt=20; $offset=20*$pglimit;
		$profratings = $db->ratings()->where("profid",$profid)->limit($lt,$offset);
		// 1:2,0 ; 2:2,2 ; 3:2,4  // Pagination
		// 10,0,...10,....20,...... // Pagination
		$response = $profratings;
		return $response;
  }
  
  public static function UserRatings($params) {
	$db = Utility::mysqlRes();
	$userid = strip_tags($params['userid']);
<<<<<<< HEAD
	$pglimit = isset($params['pg']) ? $params['pg'] : 0;
	$lt=20; $offset=20*$pglimit;
	$myratings = $db->ratings()->where("userid",$userid)->limit($lt,$offset);
	$response = $myratings;
	return $response;
  }
  public static function schoolratings($params) {
	$db = Utility::mysqlRes();
	$school = strip_tags($params['school']);
	$pglimit = isset($params['pg']) ? $params['pg'] : 0;
	$lt=20; $offset=20*$pglimit;
	$schoolratings = $db->ratesum()->where("school LIKE ?","%$school%")->limit($lt,$offset);
	$response = $schoolratings;
=======
	$profratings = $db->ratings()->where("userid",$userid);
	$response = $profratings;
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
	return $response;
  }
  
}