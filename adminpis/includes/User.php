<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
require_once("sessions.php");
require_once("Database.php");
class User {
	public $user_id;
	public $user_username;
	public $supp_name="";
	public $supp_id;
	public $supp_cont;
	public $supp_address;
	public $supp_email;
	public $supp_cell;

	public function __construct(){
		$this->user_id = $_SESSION["id_admin"];
		$this->user_username = $_SESSION["user_admin"];
	}
	public function order_status($status){
		$accepted_pis=[];
		$sql = "SELECT * FROM {$status}";
		$res = exec_query($sql);
		while($row=mysqli_fetch_assoc($res)){
			$accepted_pis[] = $row["idcomp_ent"];
		}
		return $accepted_pis;
	}

	public function show_order_detail($po_id){
		$table ="";
		$sql =  "SELECT * FROM pi_entries WHERE id_comp_ent = ". $po_id;
			$res_set = exec_query($sql);
				while($row = mysqli_fetch_assoc($res_set)){
					//add image not found
            		$output = "<tr><td><img class=\"img-responsive\" src=\"../../uploads/" . $row["photo_path"]."\" width=\"100\" height=\"100\" alt=\"Short alt text\">";
            		$output .="</td></div>";
					$output .= "<td>" . htmlentities($row["style"]) . "</td>";
					$output .= "<td>" . htmlentities($row["composition"]) . "</td>";
					$output .= "<td>" . htmlentities($row["color"]) . "</td>";
					$output .= "<td>" . htmlentities($row["moq"]) . "</td>";
					$output .= "<td>" . "$" . sprintf('%01.2f',$row["fob_sh"]) . " USD</td></tr>";
					$table .= $output;
				}
		return $table;
	}
	public function edit_orders($po_id){
		$table ="";
		$sql =  "SELECT * FROM pi_entries WHERE id_comp_ent = ". $po_id;
		$res_set = exec_query($sql);
			while($row = mysqli_fetch_assoc($res_set)){
				//add image not found
				$id_pi = $row["id"];
				$output = "<tr><input type=\"hidden\" name=\"id[]\" value=\"".$row["id"]."\">";
				$output .= "<td><img src=\"../../uploads/" . $row["photo_path"]."\" width=\"100\" height=\"100\"></td>";
				$output .= "<td><input type=\"text\" name = style[] class=\"form-control style_list\" value=\"".htmlentities($row["style"])."\" disabled></td>";
				$output .= "<td><input type=\"text\" name=liv_ref[] class=\"form-control syle_list\" required></td>";
				$output .= "<td><input type=\"text\" class=\"form-control comp_list\" value=\"".htmlentities($row["composition"])."\" disabled></td>";
				$output .= "<td><input type=\"text\" class=\"form-control style_list\" value=\"".htmlentities($row["color"])."\" disabled></td>";
				$output .= "<td><input type=\"number\" name = moq[] class=\"form-control style_list\" value=\"".htmlentities($row["moq"])."\" min=\"1\" required></td>";
				$output .= "<td><input type=\"number\" name = fob_sh[] class=\"form-control style_list\" value=\"". htmlentities(sprintf('%01.2f',$row["fob_sh"]))."\" min=\".01\" step=\".01\" required></td></tr>";
				$table .= $output;
				}
		return $table;
	}
	public function count_rec(){
		$sql_tr = "SELECT COUNT(*) from comp_ent"; 
		$res_set = exec_query($sql_tr);
		$row = mysqli_fetch_array($res_set);
		return array_shift($row);
	}
	public function count_supp(){
		$sql_supp = "SELECT COUNT(*) from suppliers"; 
		$res_set = exec_query($sql_supp);
		$row = mysqli_fetch_array($res_set);
		return array_shift($row);
	}
	public function count_status($status){
		$sql_supp = "SELECT COUNT(*) from {$status}"; 
		$res_set = exec_query($sql_supp);
		$row = mysqli_fetch_array($res_set);
		return array_shift($row);
	}
	public function count_date_query($start, $end){
		$sql_supp = "SELECT COUNT(*) from comp_ent where created_date between {$start} and {$end}"; 
		$res_set = exec_query($sql_supp);
		$row = mysqli_fetch_array($res_set);
		return array_shift($row);
	}
	public function count_supp_query($name){
		$sql_supp = "SELECT COUNT(*) from comp_ent where id_supp in ";
		$sql_supp.= "(SELECT idsuppliers FROM suppliers where name = '{$name}')"; 
		$res_set = exec_query($sql_supp);
		$row = mysqli_fetch_array($res_set);
		return array_shift($row);
	}
	public function count_rec_mx(){
		$sql = "SELECT COUNT(*) FROM pis_mx"; 
		$res = exec_query($sql);
		$row = mysqli_fetch_array($res);
		return array_shift($row);
	}
	public function placed_orders($id_supp) {
		$sql = "SELECT * FROM comp_ent WHERE id_supp =" . $id_supp; 
		$cont_rows = exec_query($sql);
		$rows = mysqli_num_rows($cont_rows);
		return $rows;
	}
	public function orders_status($id_supp,$table) {
		$sql="SELECT * FROM {$table} p, comp_ent c WHERE p.idcomp_ent=c.id AND c.id_supp={$id_supp}";
		$cont_rows = exec_query($sql);
		$rows = mysqli_num_rows($cont_rows);
		return $rows;
	}
}

$User = new User();
?>