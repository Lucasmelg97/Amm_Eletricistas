
<?php

ob_start();

include ('index.php');

 //Limpeza de texto
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$nomecliente = $_SESSION['nome'];
$email = $_SESSION['email'];
$telefone = $_SESSION['telefone'];
$assunto = $_SESSION['assunto'];

try {
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'lucasmelg97@gmail.com';
	$mail->Password = 'osvaldo1996';
	$mail->Port = 587;

	$mail->setFrom('lucasmelg97@gmail.com');
	$mail->addAddress('ammeletricistas@gmail.com');
	header('Content-type: text/html; charset=utf-8');
    setlocale( LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
	$mail->isHTML(true);
	$mail->Subject = "Contato de Cliente - AMM Eletricistas - $nomecliente";
	$mail->Body =  "Email : $email<br>
	Telefone : $telefone<br> 
	Assunto :  $assunto <br>";

	$mail->AltBody =  "Email : $email<br>
	Telefone : $telefone<br> 
	Assunto :  $assunto <br>";

	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
ob_end_clean();?>

