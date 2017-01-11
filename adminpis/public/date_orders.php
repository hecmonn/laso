<?php //AUTHOR:HECTOR MONARREZ 
$title ="Manage orders";
require_once("../includes/header.php");
require_once("../includes/Pagination.php");
$from_date = !empty($_GET["start"])?$_GET["start"]:date("Y-m-d",strtotime("today"));
$to_date = !empty($_GET["finish"])?$_GET["finish"]:date("Y-m-d",strtotime("today"));
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
$per_page = 10;
$total_count = $User->count_date_query($from_date, $to_date);
$Pagination = new Pagination($page, $per_page, $total_count);
$sql = "select c.id, c.person_name, s.name, c.created_date from";
$sql .= " comp_ent c, suppliers s where c.id_supp = s.idsuppliers AND c.created_date between '{$from_date} 00:00:01' and '{$to_date} 23:59:59'";
$sql .= " ORDER BY created_date DESC";
$sql .= " LIMIT " . $Pagination->per_page . " OFFSET " . $Pagination->offset();
$res_set = exec_query($sql);
?>
<div class="container">
	<h2>Orders from <?php echo date("jS F, Y", strtotime($from_date))." to ". date("jS F, Y", strtotime($to_date)); ?>  </h2>
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
	<a href="../includes/create_dateorder_excel.php?from_date=<?php echo $from_date ."&"; ?>to_date=<?php echo $to_date; ?>" class="btn btn-default pull-right">Export Excel</a>
	<div class="col-md-3">
	<form action="date_orders.php" name="date" method="get">
		<label for="start">From:</label>
		<input type="date" name="start" class="form-control">
	</div>
	<div class="col-md-3">
		<label for="finish">To:</label>
		<input type="date" name="finish" class="form-control">
	</div>
	<div class="col-md-3"><br>
		<input type="submit" name="submit" value="Go" class="btn btn-success">
	</form>
	</div>
	<table class = "table table-striped">
			<tr>
				<th>Order Number</th>
				<th>Supplier</th>
				<th>Responsable</th>
				<th>Date Issued</th>
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