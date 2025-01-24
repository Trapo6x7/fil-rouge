<?php

include_once "../utils/autoloader.php";
session_start();
$validator = new ValidatorService();

$validator->checkMethods('POST');

if (!$validator->validate($_POST)) {
    header('location: ../public/home.php');
    return;
}

$data = $validator->sanitize($_POST);

$validator->addStrategy('email', new RequiredValidator());
$validator->addStrategy('email', new StringValidator(30));
$validator->addStrategy('password', new RequiredValidator());
$validator->addStrategy('password', new PasswordValidator(30));

$userRepo = new UserRepository;
$user = $userRepo->findByMail($data['email']);

var_dump($user->getPassword());

try {
    // Vérifie si l'utilisateur existe
    if (!$user) {
        header("Location: ../public/loginpage.php?error=2"); // Compte n'existe pas
        exit();
    }

    // Vérifie le mot de passe
    if (password_verify( $data["password"],$user->getPassword())) {

        $_SESSION["user"] = $user;
        
        header("Location: ../public/profilpage.php?id=" . $_SESSION["user"]->getId());
        exit();
    } else {
        var_dump($_SESSION);
        die();
        header("Location: ../public/loginpage.php?error=1"); // Mot de passe incorrect
        exit();
    }
} catch (\PDOException $error) {
    // Gestion des erreurs PDO
    error_log("Erreur de connexion à la base de données : " . $error->getMessage());
    header("Location: ../public/loginpage.php?error=3"); // Erreur interne
    exit();
}
