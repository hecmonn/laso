<?php
require_once("PHPMailer/class.phpmailer.php");
require_once("PHPMailer/class.smtp.php");

//$to
// $to = "Hector Monarrez <hecmonn@gmail.com>"; shows the name of the recipient
// $to = "hecmonn@gmail.com, hecmonn@live.com";
$to = "hecmonn@live.com";
$to_name ="Liverpool Intern";
$subject = "Some subject at:" . strftime("%T", time());
$message = "This is a test.";
$from = "lasonotifications@qq.com"; //set it in the headers
$from_name="Hector Monarrez";
$headers = "From: {$from}";
//$res_mail = mail($to, $subject, $message);
//echo $res_mail? 'Sent' : 'Not';

$mail = new PHPMailer();
//through sendmail
$mail->FromName = $from_name;
$mail->from = $from;
$mail->AddAddress($to, $to_name);
$mail->Subject = $subject;
$mail->Body = $message;

//through SMTP
$mail->IsSMTP();
$mail->Host = "smtp.qq.com";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "lasonotifications@qq.com";
$mail->Password = "LivLas5436$";
$res = $mail->Send();
echo $res ? 'Email Sent' : 'Mail Not Sent';
?>

<html>
<head>
	<title>Send Email</title>
</head>
<body>

</body>
</html>