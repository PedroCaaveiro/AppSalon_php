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

   
    $email = new PHPMailer();
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->SMTPAuth = true;
    $email->Port = 587;
    $email->Username = 'acaaveir@gmail.com';
    $email->Password = 'edhlqxwitoofzdow';



    $email->setFrom('acaaveir@gmail.com', 'App Salon');
    $email->addAddress($this->email);
    $email->Subject = 'Confirma tu cuenta';

    $email->isHTML(TRUE);
    $email->CharSet = 'UTF-8';

    $contenido = '<html>';
    $contenido .= "<p><strong> Hola " . $this->nombre . "</strong> Has creado tu cuenta en App Salon, debes confirmar presionando el siguiente enlace.</p>";
    $contenido .= "<p>Presiona aquí: <a href='" . BASE_URL . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
    $contenido .= "<p> Si tu no solicitaste esta cuenta puedes ignoRar este mensaje</p>";
    $contenido .= "</html>";
    $email->Body = $contenido;



    if ($email->send()) {
      // echo "enviado";
    } else {
      // echo "no enviado";
    }
  }

  public function enviaInstrucciones()
  {
    // objeto email 

    
    $email = new PHPMailer();
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->SMTPAuth = true;
    $email->Port = 587;
    $email->Username = 'acaaveir@gmail.com';
    $email->Password = 'edhlqxwitoofzdow';



    $email->setFrom('acaaveir@gmail.com', 'App Salon');
    $email->addAddress($this->email);
    $email->Subject = 'Reestablece tu Password';

    $email->isHTML(TRUE);
    $email->CharSet = 'UTF-8';

    $contenido = '<html>';
    $contenido .= "<p><strong> Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para recuperarlo. </p>";
    $contenido .= "<p>Presiona aquí: <a href='" . BASE_URL . "/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
    $contenido .= "<p> Si tu no solicitaste este cambio puedes ignonar este mensaje</p>";
    $contenido .= "</html>";
    $email->Body = $contenido;



    if ($email->send()) {
      // echo "enviado";
    } else {
      // echo "no enviado";
    }
  }
}
