<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../includes/app.php';

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "Correo inválido: " . $this->email;
            return;
        }

        $mail = new PHPMailer(true);

        try {
            // Configuración SMTP de Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;

            // Remitente y destinatario
            $mail->setFrom('aaaveir@gmail.com', 'App Salon');
            $mail->addAddress($this->email);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Confirma tu cuenta';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has creado tu cuenta en App Salon. Confirmala presionando el siguiente enlace:</p>";
            $contenido .= "<p><a href='" . BASE_URL . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
            $contenido .= "<p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

            $mail->send();
            // echo 'Correo enviado correctamente'; // Puedes quitar esto en producción
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}<br>";
        }
    }

    public function enviaInstrucciones()
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;

            $mail->setFrom('acaaveir@gmail.com', 'App Salon');
            $mail->addAddress($this->email);

            $mail->isHTML(true);
            $mail->Subject = 'Reestablece tu Password';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has solicitado restablecer tu password. Haz clic en el siguiente enlace:</p>";
            $contenido .= "<p><a href='" . BASE_URL . "/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
            $contenido .= "<p>Si no solicitaste este cambio, puedes ignorar el mensaje.</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;

            $mail->send();
            // echo 'Correo de recuperación enviado'; // Puedes quitarlo si quieres
        } catch (Exception $e) {
            echo "Error al enviar correo de recuperación: {$mail->ErrorInfo}";
        }
    }
}
