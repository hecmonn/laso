<?php //AUTHOR:HECTOR MONARREZ 
$title ="Manage orders";
require_once("../includes/header.php");
require_once("../includes/Pagination.php");
$status="pi_accepted";
$est="Accepted";
$sql="SELECT s.name,c.id,c.person_name,p.created_date FROM comp_ent c, pi_accepted p, suppliers s WHERE c.id=p.idcomp_ent AND s.idsuppliers=c.id_supp";
if(isset($_POST["submit"])){
	if($_POST["status"]==0){
		$sql="SELECT s.name,c.id,c.person_name,p.created_date FROM comp_ent c, pi_declined p, suppliers s WHERE c.id=p.idcomp_ent AND s.idsuppliers=c.id_supp";
		$status="pi_declined";
		$est="Declined";
	}
	elseif($_POST["status"]==1){
		$sql="SELECT s.name,c.id,c.person_name,p.created_date FROM comp_ent c, pi_accepted p, suppliers s WHERE c.id=p.idcomp_ent AND s.idsuppliers=c.id_supp";
		$status="pi_accepted";
		$est="Accepted";
	}
	elseif($_POST["status"]==2){
		$sql="SELECT s.name,c.id,c.person_name,c.created_date FROM comp_ent c, suppliers s WHERE c.id_supp=s.idsuppliers AND id NOT IN(select idcomp_ent from pi_accepted) AND id NOT IN(select idcomp_ent from pi_declined)";
		$status="comp_ent";
		$est="Pending";
	}
}
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
$per_page = 10;
$total_count = $User->count_status($status);
$Pagination = new Pagination($page, $per_page, $total_count);
$sql .= " ORDER BY created_date DESC";
$sql .= " LIMIT " . $Pagination->per_page . " OFFSET " . $Pagination->offset();
$res_set = exec_query($sql);
?>
<div class="container">
	<h2><?php echo ucfirst($est) ?> Orders</h2>
	<div class="dropdown pull-right">
  				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filters
  				<span class="caret"></span></button>
  				<ul class="dropdown-menu">
  					<li><a href="manage_orders.php">All orders</a></li>
  					<li><a href="manage_orders_mx.php">Orders to Mexico</a></li>
  					<li><a href="orders_by_status.php">Orders by status</a></li>
  					<li><a href="date_orders.php">Orders by date</a></li>
  					<li><a href="manage_orders_supplier.php">Orders by supplier</a></li>
  				</ul>
  	</div><br><hr>
	<div class="col-md-3">
	<form action="orders_by_status.php" method="post">
		<select name="status" class="form-control">
			<option value=0>Declined</option>
			<option value=1>Accepted</option>
			<option value=2>Pending</option>
		</select>
	</div>
	<div class="col-md-3">
		<input type="submit" name="submit" value="Go" class="btn btn-success">
	</form>
</div>
	<table class = "table table-striped">
			<tr>
				<th>Order Number</th>
				<th>Supplier</th>
				<th>Responsable</th>
				<th>Date</th>
				<th>Options</th>
			</tr>
<?php 
	while($row = mysqli_fetch_assoc($res_set)){
		$po_id = $row["id"];
		$output = "<tr><td>" . htmlentities($row["id"]) . "</td>";
		$output .= "<td>" . ucfirst(htmlentities($row["name"])) . "</td>";
		$output .= "<td>" . ucfirst(htmlentities($row["person_name"])) . "</td>";
		$output .= "<td>" . date("jS F, Y", strtotime(htmlentities($row["created_date"]))) . "</td>";
		$output .= "<div class =\"views\"><td><a href=\"view_orders.php?po_id=$po_id\">View </a>";
		$output .= "<a href=\"edit_orders.php?po_id=$po_id\">Edit</a></td></div></tr>";
		echo $output;
	}
?>
</table>
</div>
<?php include_once("../includes/footer.php"); ?>