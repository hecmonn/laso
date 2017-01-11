<?php 
if(isset($_POST["submit"])){
	$para      = 'hecmonn@gmail.com';
	$titulo    = 'El título';
	$mensaje   = 'Hola';
	$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    	'Reply-To: webmaster@example.com' . "\r\n" .
    '	X-Mailer: PHP/' . phpversion();
	$m=mail($para, $titulo, $mensaje, $cabeceras);
	if($m){
		echo "Sent";
	}
	else{
		echo "Not sentd";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Mail</title>
 </head>
 <body>
 <form action="mail.php" method="post">
 	<input type="submit" name="submit" value="Send">
 </form>
 </body>
 </html>