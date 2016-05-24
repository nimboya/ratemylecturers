<?php
require 'plugins/NotORM.php';
/* Database Configuration */
$config = array();
// MySQL CONFIG
$config['mysqldbhost']   = 'localhost';
<<<<<<< HEAD
$config['mysqldbuser']   = 'ratemyle_rml';
$config['mysqldbpass']   = 'Password@12!@';
$config['mysqldbname']   = 'ratemyle_rmp';
=======
$config['mysqldbuser']   = 'root';
$config['mysqldbpass']   = '';
$config['mysqldbname']   = 'rmp';
>>>>>>> 1c1f9426c2ef9739c7a77982d800affc33aea455
$config['dbmethod'] = 'mysql:dbname=';
// API Auth Key
$config['authkey'] = "f7403b0ea9af1e8276c030a577d315cb";

Utility::saveConfig($config);
Utility::mysqlRes();


class Utility {
	static $config = array();
	public static function getConfig($key){
		return self::$config[$key];
	}

	public static function saveConfig($config){
		self::$config = $config;
	}

	public static function getConfigAll(){
		return self::$config;
	}
	
	public static function mysqlRes() {     
            try {
                $dsn = self::getConfig('dbmethod').self::getConfig('mysqldbname');//$dbmethod.$dbname;
		$pdo = new PDO($dsn, self::getConfig('mysqldbuser'), self::getConfig('mysqldbpass'));
		return $db = new NotORM($pdo);
            } catch (Exception $ex) {
                $response = array ('status'=>"failed",'description'=>$ex->getMessage());
                header("Content-Type: application/json");
                die (json_encode($response));
            }
		
	}
}
?>