<?php
$user = 'root';
$password = ''; // ajoute ton mot de passe MySQL si tu en as un

try {
    $pdo = new PDO('mysql:host=localhost;dbname=geek.io',$user ,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    print "Reussie";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
    print "Echec";
}
?>