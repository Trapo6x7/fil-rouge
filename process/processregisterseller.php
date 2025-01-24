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


$userId = (int)$_GET['id'];  // Récupère l'ID de l'utilisateur passé en GET
$userRepo = new UserRepository;
$user = $userRepo->findById($userId);
$user->setCompanyName($_POST['companyname']);
$user->setCompanyAdress($_POST['companyadress']);

$updatedUser = $userRepo->updateSeller($user);
var_dump($_GET, $_POST, $user, $updatedUser);


try {

    // Démarrer une session et mettre à jour les informations de session
    session_start();
    $_SESSION['user'] = $updatedUser;
    $_SESSION['company_name'] = $updatedUser->getCompanyName();
    $_SESSION['company_adress'] = $updatedUser->getCompanyAdress();

    // Redirection après mise à jour réussie
    header("Location: ../public/profilpage.php?id=" . $_SESSION['user']->getId());
    exit;
} catch (\PDOException $error) {
    // Gestion des erreurs
    error_log($error->getMessage());  // Journaliser l'erreur
    header('location: ../pages/sellerregisterpage.php?error=database');
    exit;
}
