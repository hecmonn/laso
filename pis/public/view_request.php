<?php 
$req_id = $_GET["req_id"];
$title ="Request";
require_once("../includes/header.php");
$sql_supp ="select * from suppliers where id_user in(select id_user from requests where id={$req_id})";
$res_supp = exec_query($sql_supp);
$sql_req = "SELECT * FROM requests WHERE id = {$req_id}";
$res_req = exec_query($sql_req);
while($row=mysqli_fetch_assoc($res_req)){
	$desc = $row["description"];
	$photo = $row["photo_path"];
} ?>
<div class="container">
	<div class="col-md-6">
		<h3><strong>Description </strong> </h3>
		<textarea class="form-control" rows="8" cols="8" disabled><?php echo $desc; ?></textarea>
	</div>
	<div class="col-md-6">
		<h3><strong>Photo</strong> </h3>
		<img src= "../../requests/<?php echo $photo; ?>" height="300" width="400"><br><br>
		<a href="new_entry.php" class="btn btn-lg btn-info pull-right">Create order</a>
	</div>
</div>
<?php include_once("../includes/footer.php"); ?>