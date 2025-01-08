<?php

require_once "../utils/connectdb.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location: ../pages/sellerregisterpage.php');
    return;
}

if (
    !isset(
        $_POST['companyname'],
        $_POST['companyadress'],
        $_GET['id']  // Vérifie que l'ID est bien passé dans l'URL
    )
) {
    header('location: ../pages/sellerregisterpage.php');
    return;
}

if (
    empty($_POST['companyname']) ||
    empty($_POST['companyadress']) ||
    empty($_GET['id'])
) {
    header('location: ../pages/sellerregisterpage.php');
    return;
}

if (
    strlen($_POST['companyname']) > 100 ||
    strlen($_POST['companyadress']) > 50
) {
    header('location: ../pages/sellerregisterpage.php');
    return;
}

// Récupération des données du formulaire et de l'ID de l'utilisateur à mettre à jour
$companyname = htmlspecialchars(trim($_POST['companyname']));
$companyadress = htmlspecialchars(trim($_POST['companyadress']));
$userId = (int)$_GET['id'];  // Récupère l'ID de l'utilisateur passé en GET

try {
    // Mise à jour des données de l'utilisateur dans la base de données
    $request = $pdo->prepare("UPDATE user SET company_name = :company_name, company_adress = :company_adress WHERE id = :id");
    $request->bindParam(':company_name', $companyname);
    $request->bindParam(':company_adress', $companyadress);
    $request->bindParam(':id', $userId, PDO::PARAM_INT);  // On passe l'ID de l'utilisateur à mettre à jour
    $request->execute();

    // Redirection après mise à jour réussie
    session_start();
    header("Location: ../index.php");
    exit;
} catch (\PDOException $error) {
    // Gestion des erreurs
    error_log($error->getMessage());  // Journaliser l'erreur
    header('location: ../pages/sellerregisterpage.php?error=database');
    exit;
}

