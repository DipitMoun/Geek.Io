<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie → redirection
        header('D:\COURS\LOGICIELS\wampserver\www\test\GeeK.Io\login.html');
        echo "<script>window.location.href = 'Index.html';</script>";
        exit();
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>