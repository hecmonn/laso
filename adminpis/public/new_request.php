<?php //AUTHOR: HECTOR MONARREZ
$title ="New request";
require_once("../includes/header.php");
require_once("../includes/Photograph.php");

if(isset($_POST["submit"])){
	$desc = mysql_prep($_POST["description"]);
	$id_user=$User->user_id;
	$file = $_FILES["photo"];
	$attach = $Photo->attach_file($file);
	if($attach){
		$upload = $Photo->save_file();
		$sql_req = "INSERT INTO requests(description, photo_path, id_admin)";
		$sql_req .=" VALUES('{$desc}', '{$upload}', '{$id_user}')";
		$res_req = exec_query($sql_req);
		if($res_req){
			$_SESSION["message"] = "Request sended succesfully.";
			redirect_to("index.php");
		}
		else{
			$_SESSION["message"] ="Please submit request again.";
			redirect_to("new_request.php");
		}	
	}	//$attach
}//submit
?>
<div class="container">
	<h2>New request</h2><hr>
	<?php echo session_message(); ?>
	<form action="new_request.php" method="post" enctype="multipart/form-data">
		<div class="col-md-4">
			<textarea rows="8" cols="8" name="description" class="form-control"></textarea><br>
		</div>

		<div class="col-md-4">
			<input type="file" name="photo" class="form-control btn-sm"><br>
			<input type="submit" name="submit" value="Request" class="btn btn-success pull-right">
		</div>
		<div class="col-md-4">
		</div>
</div>
</form>
<?php require_once("../includes/footer.php"); ?>