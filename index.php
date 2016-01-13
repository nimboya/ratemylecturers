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
   $response = User::StuRegister($params);
   $app->response()->header("Content-Type", "application/json");
   echo json_encode($response, JSON_FORCE_OBJECT);
});

$app->post('/login', function () use($app) {
	$params = $app->request()->post();
    $response = User::Login($params);
	$app->response()->header("Content-Type", "application/json");
	echo json_encode($response, JSON_FORCE_OBJECT);
});

$app->post("/forgot", function () use($app) {
   $params = $app->request()->post();
   $response = User::Forgot($params);
   $app->response()->header("Content-Type", "application/json");
   echo json_encode($response, JSON_FORCE_OBJECT);
});

$app->post("/change", function () use($app) {
   $params = $app->request()->post();
   $response = User::ChangePassword($params);
   $app->response()->header("Content-Type", "application/json");
   echo json_encode($response, JSON_FORCE_OBJECT);
});

$app->post("/proregister", function () use($app) {
   $params = $app->request()->post();
   $response = User::ProfRegister($params);
   $app->response()->header("Content-Type", "application/json");
   echo json_encode($response, JSON_FORCE_OBJECT);
});

$app->run();