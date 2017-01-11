<?php
require_once("includes.php");

class Database{
	private $server;
	private $user;
	private $password;
	private $database;
	public $con;

	public function __construct(){
		$this->connect_db();
		}

	private function connect_db(){
		//use in production
		/*defined('DB_SERVER') ? null : define("DB_SERVER","localhost");
		defined('DB_USER') ? null : define("DB_USER","lasovpco_master");
		defined('DB_PASS') ? null: define("DB_PASS","4dm1n!!");
		defined('DB') ? null: define("DB", "lasovpco_pis");*/
		defined('DB_SERVER') ? null : define("DB_SERVER","localhost");
		defined('DB_USER') ? null : define("DB_USER","root");
		defined('DB_PASS') ? null: define("DB_PASS","admin");
		defined('DB') ? null: define("DB", "pis_development");
		$this->con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB);
		if (mysqli_errno($this->con)){
				die("Database connection failed: ".
					mysqli_connect_error() .
					"(". mysqli_connect_error() .")"
					);
		}
	}

}

$Database = new Database();
?>
