<?php

require_once "../utils/connectdb.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/loginpage.php');
    exit();
}


// Vérifie que les champs requis sont envoyés
if (
    !isset($_POST['email'], $_POST['password']) ||
    empty(trim($_POST['email'])) ||
    empty($_POST['password'])
) {
    header('Location: ../public/loginpage.php');
    exit();
}

// Nettoie les données utilisateur
$email = htmlspecialchars(trim($_POST['email']));
$password = $_POST['password'];

try {
    // Prépare et exécute la requête
    $request = $pdo->prepare("SELECT * FROM user WHERE mail = :mail");
    $request->bindParam(":mail", $email);
    $request->execute();

    $user = $request->fetch(PDO::FETCH_ASSOC);

   
    // Vérifie si l'utilisateur existe
    if (!$user) {
        header("Location: ../public/loginpage.php?error=2"); // Compte n'existe pas
        exit();
    }

    // Vérifie le mot de passe
    if (password_verify($password, $user["password"])) {
      
        $_SESSION["user"] = $user; 
    
        header("Location: ../public/profilpage.php?id=" . $_SESSION['user']['id']);
        exit();
    } else {
      
        header("Location: ../public/loginpage.php?error=1"); // Mot de passe incorrect
        exit();
    }

} catch (\PDOException $error) {
    // Gestion des erreurs PDO
    error_log("Erreur de connexion à la base de données : " . $error->getMessage());
    header("Location: ../public/loginpage.php?error=3"); // Erreur interne
    exit();
}
