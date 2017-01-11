<?php
class DbObjects extends Database {
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
}
?>