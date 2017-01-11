<?php
$title="modal";
require_once("../includes/header.php");
?>
<div class="container">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Email order</button>
	<div class="modal fade" id="modal-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Send email</h3>
				</div>
				<div class="modal-body">
					<form action="mail.php">
						<input type="text" name="to" placeholder="To" class="form-control"><br>
						<input type="text" name="subject" placeholder="Subject" class="form-control"><br>
						<textarea col=4 rows=3 placeholder="Message" class="form-control"></textarea><br>
					
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
						<input type="submit" name="submit" value="Send"  class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once("../includes/footer.php"); ?>
