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
}