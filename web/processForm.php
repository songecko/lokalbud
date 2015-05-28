<?php 

header("Content-Type: text/html;charset=utf-8");

$contact = $_POST['contact'];
$email = $contact['email'];

//Envio de email
$to = "songecko@gmail.com";
$subject = "[LokalBuddy] nueva subscripción";
$body = ' 
<html> 
	<head> 
		<title>LokalBuddy - nueva subscripción</title> 
	</head> 
	<body>  
		<h3>Nueva subscripción</h3>
		<p><b>Email: </b> '.$email.'</p> 
	</body> 
</html>
'; 

//Envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 

//Dirección del remitente 
$headers .= "From: ".$email."\r\n"; 

$sended = mail($to, $subject, $body, $headers);

echo $sended;