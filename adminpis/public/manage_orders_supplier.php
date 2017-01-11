<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
$title="Manage orders";
require_once("../includes/header.php"); 
$supp = isset($_POST["supp"])?$_POST["supp"]:"Supplier";

require_once("../includes/Pagination.php"); 
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
$per_page = 10;
$total_count = $User->count_supp_query($supp);
$Pagination = new Pagination($page, $per_page, $total_count);
$sql = "select c.id, c.person_name, s.name, c.created_date from";
$sql .= " comp_ent c, suppliers s where c.id_supp = s.idsuppliers AND s.name= '{$supp}'";
$sql .= " ORDER BY created_date DESC";
$sql .= " LIMIT " . $Pagination->per_page . " OFFSET " . $Pagination->offset();
$res_set = exec_query($sql);
$output="";
while($row = mysqli_fetch_assoc($res_set)){
	$po_id = $row["id"];
	$output .= "<tr><td>" . htmlentities($row["id"]) . "</td>";
	$output .= "<td>" . ucfirst(htmlentities($row["name"])) . "</td>";
	$output .= "<td>" . ucfirst(htmlentities($row["person_name"])) . "</td>";
	$output .= "<td>" . date("jS F, Y", strtotime(htmlentities($row["created_date"]))) . "</td>";
	$output .= "<div class =\"views\"><td><a href=\"view_orders.php?po_id=$po_id\">View </a>";
	$output .= "<a href=\"edit_orders.php?po_id=$po_id\">Edit</a></td></div></tr>";			
}
?>
<div class="container">
		<h2>Orders from <?php echo " ".$supp; ?></h2>
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
			<div class="col-md-6">
			<form action="manage_orders_supplier.php" method="post">
				<div class="col-md-6">
					<label for="supp">Supplier</label>
					<select name="supp" class="form-control">
						<?php 
							$sql_supp = "SELECT * FROM suppliers";
							$res_supp = exec_query($sql_supp);
							while($row =mysqli_fetch_assoc($res_supp)){
								echo "<option>".$row["name"]."</option>";
							} ?>
					</select><br>
				</div>
				<div class="col-md-3">
					<br><input type="submit" name="submit" value="Go" class="btn btn-success">
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<a href="../includes/create_order_supplier_excel.php?supp=<?php echo $supp ?>" class="btn btn-default pull-right">Export Excel</a>
		</div>
	<table class="table table-striped">
		<tr>
			<th>Order number</th>
			<th>Supplier</th>
			<th>Responsable</th>
			<th>Date issued</th>
			<th>Options</th>
		</tr>
		<?php echo $output; ?>
	</table>
</div>
<?php include_once("../includes/footer.php"); ?>