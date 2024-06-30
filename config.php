<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {
    // Veritabanı bağlantısı
    $db = new PDO('mysql:host=localhost;dbname=cyberse2_siberkubra', 'cyberse2_siberkubra', 'jt2Tq2w3ME3ZXH7u7gS4');

    // Hata modunu ayarla
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>