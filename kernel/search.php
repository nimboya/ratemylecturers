<?php
/*
@ Author: Ewere Diagboya
@ Date: 13-01-2016
@ Time: 8:04pm
@ Location: Ajah, Lagos
@ Project: RateMyProfessor
*/
class Search {
	/*
		- Name of Professor - name
	*/
<<<<<<< HEAD
	
	/*
		- Name of School - schname
		- Location of School - state
	*/
	public static function findlecturer($params) {
		$db = Utility::mysqlRes();
		$response = array();	
		$name = strip_tags($params['fullname']);
		$department=strip_tags($params['department']);
		$school= strip_tags($params['school']);
		
		$results= $db->Lecturers->where("fullname", $name)->where("school", $school)->where("department", $department);
		
		$response = $results;
		return $response;
	}

	public static function findschool($params) {
		$db = Utility::mysqlRes();
		$response = array();
		$school= trim(strip_tags($params['school']));
		$results = $db->schools->select("schoolnames")->where("schoolnames", $school);
		
		$response = $results;
		
		return $response;
	}
	
	public static function lecturerlist($params) {
		$db = Utility::mysqlRes();
		$response = array();
		$results= $db->Lecturers()->select("fullname");
		foreach ($results as $result) {
			$response[] = $result['fullname'];
		}
		return $response;
	}
=======
	public static function FindProfessor($params) {
		$db = Utility::mysqlRes();
		$response = array();
		
		$name = trim($params['name']);
		$state = trim($params['state']);
		
		$results= $db->profs()->where("name LIKE ?", $name);
		if($results->count() > 0) {
			$response = $results;
		} else {
			$response = array('error_code'=>'0','status'=>'failed','description'=>"No Results Found");
		}
		return $response;
	}
	/*
		- Name of School - schname
		- Location of School - state
	*/
	public static function FindSchool($params) {
		$db = Utility::mysqlRes();
		$response = array();
		$nameofschool = trim($params['schname']);
		try {
			$results = $db->schools()->where("schoolacro",$nameofschool);
			if($results->count() > 0) {
				$response = $results;
			} else {
				$response = array('error_code'=>'0','status'=>'ok','description'=>"No Results Found");
			}
		} catch (Exception $ex) {
			$response = array('error_code'=>'1','status'=>'failed','description'=>"Connection Error: ".$ex->getMessage());
		}	
		return $response;
	}

>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
}