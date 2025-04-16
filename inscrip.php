<?php 

    include_once "..";
// Récupération des données du formulaire
if (isset($_POST["submit"])) {

    $name = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification de l'unicité de l'email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        die("Cet email est déjà utilisé !");
    }

    // Hachage du mot de passe
    $hashed_password = md5($password);

    // Insertion dans la base de données
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    if($stmt->execute()) {
        echo "Inscription réussie !";
        header("Location: ../connect.html");
    } else {
        echo "Erreur lors de l'inscription";
    }

}
    
//  } catch(PDOException $e) {
//     echo "Erreur de connexion : " . $e->getMessage();
// }


?>