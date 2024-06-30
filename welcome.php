<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Siber Güvenlik</title>
    <link rel="stylesheet" href="./css/giris.css">
</head>
<body>
<a class="" href="index.html">Ana Sayfa</a> <a class="" href="hakkımızda.html">Hakkımızda</a>

<h1 style="text-align: center; margin-top: 20px;">Hoş Geldiniz, <?php echo $_SESSION['username']; ?></h1>

<section>
    <img src="images/Cyber-secruity-awareness-2022.jpg" alt="">
</section>

</body>
</html>
