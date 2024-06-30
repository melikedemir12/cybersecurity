<?php
session_start();

include 'config.php';

// Hata raporlamayı aç
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Output buffering başlat
ob_start();

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['register'])) {
            // Kullanıcı bilgileri
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // SQL sorgusu
            $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";

            // Sorguyu hazırla ve çalıştır
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                echo "Veri başarıyla eklendi.";
                // Kullanıcı ekledikten sonra index.html sayfasına yönlendir
                header("Location: index.html");
                exit();
            } else {
                echo "Veri ekleme başarısız.";
            }
        }

        if (isset($_POST['login'])) {
            // Kullanıcı bilgileri
            $enteredUsername = $_POST['username'];
            $enteredPassword = $_POST['password'];

            // SQL sorgusu
            $selectUserSQL = "SELECT * FROM users WHERE username = :username";
            $stmt = $db->prepare($selectUserSQL);
            $stmt->bindParam(':username', $enteredUsername);
            $stmt->execute();

            // Kullanıcı var mı kontrol et
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Şifre kontrolü
                if (password_verify($enteredPassword, $user['password'])) {
                    $_SESSION['username'] = $enteredUsername;
                    // Oturum açma başarılı, anasayfaya yönlendir
                    header("Location: index.html");
                    exit();
                } else {
                    echo "Şifre yanlış!";
                }
            } else {
                echo "Kullanıcı bulunamadı!";
            }
        }
    }
} catch (PDOException $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
} catch (Exception $e) {
    echo "Genel hata: " . $e->getMessage();
}

// Output buffering bitir ve çıktıyı gönder
ob_end_flush();

?>

