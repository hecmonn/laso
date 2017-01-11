<?php 
$title="Supplier statistics";
require_once("../includes/header.php");
require_once("../includes/User.php");
$id_s=$_GET["s"];
$sql_ns="select name from suppliers where idsuppliers={$id_s}";
$res_ns=exec_query($sql_ns);
$supp=array_shift($res_ns);
$placed_orders=$User->placed_orders($id_s);
$accepted_orders=$User->orders_status($id_s,"pi_accepted");
$dec_orders=$User->orders_status($id_s,"pi_declined");
$sql_pen="SELECT * FROM comp_ent WHERE id NOT IN(select idcomp_ent from pi_accepted) AND";
$sql_pen.=" id NOT IN(select idcomp_ent from pi_declined) AND id_supp={$id_s}";
$res_pen=exec_query($sql_pen);
$pen_orders=mysqli_num_rows($res_pen);
$avg_acc=number_format((float)$accepted_orders/$placed_orders, 2, '.', '');
$avg_dec=number_format((float)$dec_orders/$placed_orders, 2, '.', '');
?>
<div class="container">
	<h2><?php echo $title; ?></h2>
	<h3><?php echo $supp; ?></h3>
	<a href="view_supplier.php?id_supp=<?php echo $id_s; ?>">&laquo;Back</a><hr>
	<div class="col-md-4">
		<h3><strong>Placed orders: <?php echo "</strong>".$placed_orders; ?></h3>
		<h3><strong>Accepted orders: <?php echo "</strong>".$accepted_orders; ?></h3>
		<h3><strong>Declined orders: <?php echo "</strong>".$dec_orders; ?></h3>
		<h3><strong>Pending orders: <?php echo "</strong>".$pen_orders; ?></h3>
	</div>
	<div class="col-md-4">
		<br>
		<h3><strong>Accepted ratio: <?php echo "</strong>".$avg_acc; ?></h3>
		<h3><strong>Declined ratio: <?php echo "</strong>".$avg_dec; ?></h3>
	</div>
</div>
<?php require_once("../includes/footer.php"); ?>