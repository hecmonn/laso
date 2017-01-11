<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
require_once("/Applications/XAMPP/htdocs/laso/_includes/init.php");
class User {
	public $user_id;
	public $user_username;
	public $password;
	public $id;
	public $supp_name="";
	public $supp_id;
	public $supp_cont;
	public $supp_address;
	public $supp_email;
	public $supp_cell;

	public function supplier_name(){
		global $con;
		$this->user_id = $_SESSION["id_pis"];
		$this->user_username = $_SESSION["user_pis"];
		$sql = "SELECT * FROM suppliers WHERE id_user = " . $this->user_id . " LIMIT 1";
		$res = exec_query($sql);
		if ($supp_arr = mysqli_fetch_assoc($res)) {
			$this->supp_name = $supp_arr["name"];
			$this->supp_id = $supp_arr["idsuppliers"];
			$this->supp_cont = ucfirst($supp_arr["contact"]);
			$this->supp_address =ucfirst($supp_arr["address"]);
			$this->supp_email = $supp_arr["email"];
			$this->supp_cell = $supp_arr["telephone"];
		}

		$sql_us = "SELECT * FROM users where id = " . $this->user_id . " LIMIT 1";
		$res_us = exec_query($sql_us);
		while ($row = mysqli_fetch_assoc($res_us)){
			$this->id = $row["id"];
			$this->password = $row["password"];
		}
	}

	public function show_orders(){
		$output ="";
		$result="";
		$sql =  "SELECT * FROM comp_ent WHERE id_supp = ". $this->supp_id . " ORDER BY created_date DESC";
		$res_set = exec_query($sql);
		while($row = mysqli_fetch_assoc($res_set)){
			$po_id = $row["idcomp_ent"];
			//$output = mysqli_num_rows($res_set);
			$output = "<tr><td>" . htmlentities($row["idcomp_ent"]) . "</td>";
			$output .= "<td>" . htmlentities($row["person_name"]) . "</td>";
			$output .= "<td>" . htmlentities($row["created_date"]) . "</td>";
			$output .= "<div class =\"views\"><td><a href=\"view_orders.php?po_number=$po_id\">View</a></td></div></tr>";
			$result .= $output;
		}
	return $result;
	}

	public function accepted_orders(){
		$accepted_pis=[];
		$sql = "SELECT * FROM pi_accepted";
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
					$output ="<tr><td><img src=\"../../uploads/".$row["photo_path"]."\" alt=\"". $row["style"]."\" width=\"100\" height=\"100\"></td>";
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
					$output = "<tr><input type=\"hidden\" name=\"id[]\" value=\"".$row["id"]."\">";
					$output .= "<td><img src=\"../../uploads/".$row["photo_path"]."\" width=\"100\" height=\"100\"></td>";
					$output .= "<td><input type=\"text\" name = style[] class=\"form-control style_list\" value=\"".htmlentities($row["style"])."\" disabled></td>";
					$output .= "<td><input type=\"text\" class=\"form-control comp_list\" value=\"".htmlentities($row["composition"])."\" disabled></td>";
					$output .= "<td><input type=\"text\" class=\"form-control style_list\" value=\"".htmlentities($row["color"])."\" disabled></td>";
					$output .= "<td><input type=\"number\" name = moq[] class=\"form-control style_list\" value=\"".htmlentities($row["moq"])."\" min=\"1\" required></td>";
					$output .= "<td><input type=\"number\" name = fob_sh[] class=\"form-control style_list\" value=\"". htmlentities(sprintf('%01.2f',$row["fob_sh"]))."\" min=\".01\" step=\".01\" required></td></tr>";
					$table .= $output;
				}
		return $table;
	}

	public function count_rec(){
		$sql_tr = "SELECT COUNT(*) from comp_ent WHERE id_supp = " . $this->supp_id;
		$res_set = exec_query($sql_tr);
		$row = mysqli_fetch_array($res_set);
		return array_shift($row);
	}

	public function notifications(){
		$this->supplier_name();
		$sql_acc ="select * from comp_ent c, pi_accepted p where c.id = p.idcomp_ent";
		$sql_acc .= " and c.id_supp = ". $this->supp_id;
		$sql_acc .= " order by p.created_date desc";
		$res_acc = exec_query($sql_acc);
		$sql_req = "select * from requests order by created_date desc";
		$res_req = exec_query($sql_req);
		$result="";
		while ($row=mysqli_fetch_assoc($res_acc)){
			$po_id = htmlentities($row["idcomp_ent"]);
			$date = htmlentities($row["created_date"]);
			$output = "<tr><td><a href=\"view_orders.php?po_id=".$po_id."\">";
			$output .= "Order No. " . $po_id . "</a> ";
			$output .= "was accepted on " . date("jS F, Y H:i", strtotime($date)) . "</tr>";
			$result .= $output;
		}
		while ($row_req = mysqli_fetch_assoc($res_req)){
			$req_id = $row_req["id"];
			$output_req = "<tr><td>You have a new <a href=\"view_request.php?req_id=".$req_id."\">request</a>";
			$output_req .= " created on " .date("jS F, Y H:i", strtotime($row_req["created_date"]))."</tr></td>";
			$result .= $output_req;
		}
		return $result;
	}
}

$User = new User();
?>
