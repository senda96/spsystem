<?php

function enviarMail($destinatarios,$asunto,$mensaje){
    
	require 'PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();                                      
	$mail->Host = 'smtp.gmail.com';                      
	$mail->SMTPAuth = true;                               // Activamos la autenticacion
	$mail->Username = 'spsystemsv@gmail.com';       // Correo SMTP 
	$mail->Password = 'contra123';                  // Contraseña SMTP
	$mail->SMTPSecure = 'ssl';                            // Activamos la encriptacion ssl
	$mail->Port = 465;                                    // Seleccionamos el puerto del SMTP
	$mail->From = 'spsystemsv@gmail.com';
	$mail->FromName = 'SPSystem';                       
	$mail->isHTML(true); 
	$mail->CharSet = 'UTF-8';  
	
	$mail->addAddress($destinatarios);

	$mail->Subject = $asunto; 

	//Mensaje del email
	$mail->Body    = $mensaje;

	//comprobamos si el mail se envio correctamente y devolvemos la respuesta al servidor
	if(!$mail->send()) {
		return false;
	} else {
		return true;
	} 
}
?>