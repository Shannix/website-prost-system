<?php

switch ($_SERVER['REQUEST_METHOD']) {
  case("OPTIONS"): //Allow preflighting to take place.
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: content-type");
    exit;
  case("POST"): //Send the email;
    header("Access-Control-Allow-Origin: *");

    $json = file_get_contents('php://input');

    $params = json_decode($json);

    $email = $params->email;
    $emaildestination = $params->emailDestinataire;
    $name = $params->name;
    $message = $params->message;

    $recipient = $emaildestination;
    $subject = 'BON DE COMMANDE - ' . $name;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: $name <$email>";


    mail($recipient, $subject, $message, $headers);
    break;
  default: //Reject any non POST or OPTIONS requests.
    header("Allow: POST", true, 405);
    exit;
}

?>
