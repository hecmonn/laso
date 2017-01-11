<?php 
require_once("includes.php");
require_once("User.php");
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
		defined('DB_SERVER') ? null : define("DB_SERVER","localhost");
		defined('DB_USER') ? null : define("DB_USER","lasovpco_master");
		defined('DB_PASS') ? null: define("DB_PASS","4dm1n!!");
		defined('DB') ? null: define("DB", "lasovpco_pis");
		$this->con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB);
		if (mysqli_errno($this->con)){
				die("Database connection failed: ".
					mysqli_connect_error() .
					"(". mysqli_connect_error() .")"
					);
		}
	}

	public function create(){
		$attributes = self::get_attributes();
		$sql ="INSERT INTO ".self::table_name." (";
		$sql .= join(",", array_keys($attributes)) .") VALUES ('";
		$sql .= join("','", array_values($attributes))."')";
		exec_query($sql);
	}

	public function update(){
		$attributes = self::get_attributes();
		$attributes_kv = [];
		foreach($attributes as $key => $value){
			$attributes_kv[] = $key."='".$value."'";
		}
		$sql = "UPDATE ".self::table_name." SET ";
		$sql .= join (", ", $attributes_kv) . " WHERE $id = ";
		$sql .=  mysql_prep($po_number);
		exec_query($sql);
	}

	private function has_attributes($attribute){
		$object_vars = get_object_vars($this);
		return array_key_exists($attribute, $object_vars);
	}

	protected static function get_attributes(){
		$attributes = get_object_vars($this);
		$clean_attributes =[];
		foreach($attributes as $key => $value){
			$clean_attributes[$key] = mysql_prep($value);
		}
		return $clean_attributes;	
	}
}

$Database = new Database();
?>