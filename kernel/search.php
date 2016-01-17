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

}