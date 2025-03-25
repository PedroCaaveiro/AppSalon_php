<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

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

    // objeto email 

    // Looking to send emails in production? Check out our Email API/SMTP product!
    $email = new PHPMailer();
    $email->isSMTP();
    $email->Host = 'sandbox.smtp.mailtrap.io';
    $email->SMTPAuth = true;
    $email->Port = 2525;
    $email->Username = 'b45ca7be279d0f';
    $email->Password = '315a187376ff35';



    $email->setFrom('appsalon@appsalon.com');
    $email->addAddress('appsalon@appsalon.com');
    $email->Subject = 'Confirma tu cuenta';

    $email->isHTML(TRUE);
    $email->CharSet = 'UTF-8';

    $contenido = '<html>';
    $contenido .= "<p><strong> Hola " . $this->nombre . "</strong> Has creado tu cuenta en App Salon, debes confirmar presionando el siguiente enlace.</p>";
    $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
    $contenido .= "<p> Si tu no solicitaste esta cuenta puedes ignonar este mensaje</p>";
    $contenido .= "</html>";
    $email->Body = $contenido;



    if ($email->send()) {
      // echo "enviado";
    } else {
      // echo "no enviado";
    }
  }
}
