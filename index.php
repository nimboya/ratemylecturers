<?php
/*
@ Author: Ewere Diagboya
@ Date: 08-01-2016
@ Time: 4:00pm
@ Location: Ajah, Lagos
@ Project: RateMyProfessor
*/
require_once "Slim/Slim.php";
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


// Import Kernel/Db Functions
$kernel = (array)glob('kernel/*.php');
foreach ($kernel as $kernelFile) {
    require $kernelFile;
}

$app->post("/sturegister", function () use($app) {
   $params = $app->request()->post();
   if($params['authkey'] == Utility::getConfig('authkey')) {
	  $response = User::StuRegister($params);
      $app->response()->header("Content-Type", "application/json");
	  echo json_encode($response, JSON_FORCE_OBJECT);
   } else {
	  $app->response->setStatus(401);
	  $resp = array('error'=>'true','description'=>'Unauthorized Access');
      json_encode($resp);
   }
});


$app->post('/login', function () use($app) {
	$params = $app->request()->post();
	if($params['authkey'] == Utility::getConfig('authkey')) {
		$response = User::Login($params);
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
    } else {
	    $app->response->setStatus(401);
	    $resp = array('error'=>'true','description'=>'Unauthorized Access');
	    echo json_encode($resp);
	}
});

$app->post('/sociallogin', function() use($app) {
	$params = $app->request()->post();
	if($params['authkey'] == Utility::getConfig('authkey')) {
		$response = User::SocialLogin($params);
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
    } else {
	    $app->response->setStatus(401);
	    $resp = array('error'=>'true','description'=>'Unauthorized Access');
	    echo json_encode($resp);
	}
});


$app->post("/forgot", function () use($app) {
   $params = $app->request()->post();
   if($params['authkey'] == Utility::getConfig('authkey')) {
		$response = User::Forgot($params);
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
   } else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
   }
});

$app->post("/change", function () use($app) {
	if($params['authkey'] == Utility::getConfig('authkey')) {
		$params = $app->request()->post();
		$response = User::ChangePassword($params);
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->post("/proregister", function () use($app) {
	$params = $app->request()->post();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = User::ProfRegister($params);
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->get("/getprofdata", function() use($app) {
	$params = $app->request()->get();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = User::GetProfProfile($params);
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->get("/getuser", function() use($app) {
  $params = $app->request()->get();
  if($params['authkey'] == Utility::getConfig('authkey')) {
	 $response = User::GetUserProfile($params);
	 $app->response()->header("Content-Type", "application/json");
	 echo json_encode($response, JSON_FORCE_OBJECT);
  } else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
  }
});

$app->post("/postrating",function() use($app) {
	$params = $app->request()->post();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Rating::PostRating($params);
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
	}
});



$app->get("/getrating",function() use($app) {
	$params = $app->request()->get();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Rating::ViewRatings($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->get("/ratingdetails",function() use($app) {
	$params = $app->request()->get();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Rating::RatingDetails($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->post("/newlecturer",function() use($app) {
	$params = $app->request()->post();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = newlecturers::addlecturer($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});
$app->get("/schoolratings",function() use($app) {
	$params = $app->request()->get();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Rating::schoolratings($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});
$app->post("/getlecturerid",function() use($app) {
	$params = $app->request()->post();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Search::findlecturer($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});
$app->get("/myratings",function() use($app) {
	$params = $app->request()->get();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Rating::Userratings($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response, JSON_FORCE_OBJECT);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->post("/searchschool",function() use($app) {
	$params = $app->request()->post();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Search::findschool($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->get("/lecturerlist",function() use($app) {
	$params = $app->request()->get();
	if($params['authkey'] == Utility::getConfig('authkey')) {	
		$response = Search::lecturerlist($params);	
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($response);
	} else {
		$app->response->setStatus(401);
		$resp = array('error'=>'true','description'=>'Unauthorized Access');
		echo json_encode($resp);   
    }
});

$app->run();