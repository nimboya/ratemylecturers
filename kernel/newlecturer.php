<?php
/*
@ Author: Aloagbaye Momodu
@ Date: 22-04-2016
@ Time: 8:45pm
@ Location: Toronto, Canada
@ Project: RateMyProfessor
*/
class newlecturers {
//Add New Lecturer
  public static function addlecturer($addlecturer) {
	$db = Utility::mysqlRes();
	$response = array();
	$errors = array();
	
	$userid = isset($addlecturer['userid']) ? $addlecturer['userid'] : null;;
	$lecturertitle = isset($addlecturer['title']) ? $addlecturer['title'] : null;
	$fullname = isset($addlecturer['fullname']) ? $addlecturer['fullname'] : null;
	$department = isset($addlecturer['department']) ? $addlecturer['department'] : null;
	$faculty = isset($addlecturer['faculty']) ? $addlecturer['faculty'] : null;
	$position = isset($addlecturer['position']) ? $addlecturer['position'] : null;
	$school = isset($addlecturer['school']) ? $addlecturer['school'] : null;
	$url = isset($addlecturer['url']) ? $addlecturer['url'] : null;
	
	
	if(strlen(trim($userid)) === 0) {
        $errors[] = "Please enter User ID!";
	}
	if(strlen(trim($lecturertitle)) === 0) {
        $errors[] = "Please select Lecturer Title!";
	}
	if(strlen(trim($fullname)) === 0) {
        $errors[] = "Please enter Lecturer's name!";
	}
	if(strlen(trim($department)) === 0) {
        $errors[] = "Please enter department!";
	}
        if(strlen(trim($position)) === 0) {
        $errors[] = "Please enter Lecturer's position!";
	}
	if(strlen(trim($faculty)) === 0) {
        $errors[] = "Please enter faculty!";
	}
	
	if(strlen(trim($school)) === 0) {
        $errors[] = "Please enter school!";
	}
	
	if(empty($errors)) {
		// New Lecturer
		$addlecturer = array('title'=>$lecturertitle, 'fullname'=>$fullname, 'position'=>$position,
				  'department'=>$department, 'faculty'=>$faculty,  'school'=>$school,'userid'=>$userid, 'url' =>$url
				  );
                try {
                    $proc = $db->Lecturers->insert($addlecturer);
                    $ids = $db->Lecturers()-> where("fullname", $fullname) -> where("userid", $userid) -> where("department", $department);
                    
                    foreach( $ids as $id) {
                     $id= $id['id'];
                    }
                    
		    $response = array('error_code'=>0,'status'=>'success','description'=>"Thank you for adding this Lecturer", 'id' =>$id); 
                } catch (Exception $e)
                {
                  $response = array('error_code'=>1,'status'=>'failed','description'=>$e);
                }
	} 
	else {
		$errors = implode(",",$errors);
		$response = array('error_code'=>1,'status'=>'failed','description'=>$errors);
	}
	return $response;
  }	
}