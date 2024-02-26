<?php

add_action('phpmailer_init', 'send_smtp_email');

function send_smtp_email( $phpmailer )
{
    // Define que estamos enviando por SMTP
    $phpmailer->isSMTP();
 
    // La dirección del HOST del servidor de correo SMTP p.e. smtp.midominio.com
    $phpmailer->Host = "smtp-relay.sendinblue.com";
 
    // Uso autenticación por SMTP (true|false)
    $phpmailer->SMTPAuth = true;
 
    // Puerto SMTP - Suele ser el 25, 465 o 587
    $phpmailer->Port = "587";
 
    // Usuario de la cuenta de correo
    $phpmailer->Username = "sebastian@wcanvas.com";
 
    // Contraseña para la autenticación SMTP
    $phpmailer->Password = "9qJtNXCZT6gfdEF5";
 
    // El tipo de encriptación que usamos al conectar - ssl (deprecated) o tls
    $phpmailer->SMTPSecure = "tls";
 
    $phpmailer->From = "no-reply@doctorpedia.com";
    $phpmailer->FromName = "Doctorpedia";
}