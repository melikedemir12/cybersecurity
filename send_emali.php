<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Form verilerini alın
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];

  // E-posta içeriği oluşturun
  $to = "shovqi043@gmail.com"; // e-posta adresimiz buraya yazın
  $subject = "Yeni Anket Formu Mesajı";
  $body = "Ad: $name\nE-posta: $email\nTelefon: $phone\nMesaj:\n$message";
  $headers = "From: $email";

  // E-posta gönderme
  if (mail($to, $subject, $body, $headers)) {
    echo "Mesajınız başarıyla gönderildi!";
  } else {
    echo "Mesaj gönderilirken bir hata oluştu.";
  }
}
?>
