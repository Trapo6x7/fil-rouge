<?php

include_once "../utils/autoloader.php";

$validator = new ValidatorService();

$validator->checkMethods('POST');

if (!$validator->validate($_POST)) {
    header('location: ../public/sellerregisterpage.php');
    return;
}

$validator->addStrategy('companyname', new RequiredValidator());
$validator->addStrategy('companyname', new StringValidator(30));
$validator->addStrategy('companyadress', new RequiredValidator());
$validator->addStrategy('companyadress', new PasswordValidator(30));


session_start();

/**
 * @var User $user
 */
$user = $_SESSION['user'];

 // Récupère l'ID de l'utilisateur passé en GET
$userRepo = new UserRepository;

$user->setCompanyName($_POST['companyname']);
$user->setCompanyAdress($_POST['companyadress']);

$updatedUser = $userRepo->updateSeller($user);
// var_dump($_GET, $_POST, $user, $updatedUser);


try {

    // Démarrer une session et mettre à jour les informations de session
    session_start();
    $_SESSION['user'] = $updatedUser;
    // Redirection après mise à jour réussie
    header("Location: ../public/profilpage.php");
    exit;
} catch (\PDOException $error) {
    // Gestion des erreurs
    error_log($error->getMessage());  // Journaliser l'erreur
    header('location: ../pages/sellerregisterpage.php?error=database');
    exit;
}
