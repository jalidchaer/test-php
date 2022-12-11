<?php

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();


Class DbConnection{

    
    protected static $instance;

	protected function __construct() {}

	public static function getInstance() {

		if(empty(self::$instance)) {

			$db_info = array(
				"db_host" => $_ENV['DB_HOST'],
				"db_port" => $_ENV['DB_PORT'],
				"db_user" => $_ENV['DB_USER'],
				"db_pass" => $_ENV['DB_PASS'],
				"db_name" => $_ENV['DB_NAME'],
				"db_charset" => "UTF-8");

			try {
				self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);  
				self::$instance->query('SET NAMES utf8');
				self::$instance->query('SET CHARACTER SET utf8');

			} catch(PDOException $error) {
				echo $error->getMessage();
			}

		}

		return self::$instance;
	}
}


