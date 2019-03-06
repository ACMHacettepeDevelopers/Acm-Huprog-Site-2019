<?php

  require_once "vendor/autoload.php";

  use PHPMailer\PHPMailer\PHPMailer;

  if(empty($_POST['username']) && empty($_POST['email']) && empty($_POST['message'])) header('Location: ./#iletisim');

  $mailer = new PHPMailer();
  $mailer->CharSet = 'utf-8';
  $mailer->IsSMTP();
  $mailer->SMTPDebug = 2;
  $mailer->SMTPAuth = true;
  $mailer->Host = 'smtp.gmail.com';
  $mailer->Port = 2525;
  // $mailer->Port = 465;
  $mailer->Username = 'postayi gonderecek eposta kullanici adi';
  $mailer->Password = 'postayi gonderecek eposta sifre';

  $body = 'Gönderen: ' . $_POST['username'] . '<br>Mesaj: ' . $_POST['message'] . '<br>Tarih: ' . date("Y-m-d H:i:s");

  $mailer->SetFrom($_POST['email'], $_POST['username']);
  $mailer->AddAddress('postanin gonderilecegi adres', 'HUPROG Yetkilileri');
  $mailer->Subject = 'HUPROG Yeni İleti';
  $mailer->AltBody = "HUPROG";
  $mailer->MsgHTML($body);

  if($mailer->Send()) {
    header('Location: ./');
  }else{
    header('Location: ./#iletisim');
  }

?>
