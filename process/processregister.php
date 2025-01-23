<?php
include_once "../utils/autoloader.php";
require_once "../utils/connectdb.php";

$validator = new ValidatorService();

$validator->checkMethods('POST');

if (!$validator->validate($_POST)) {
    header('location: ../public/home.php');
    return;
}

$data = $validator->sanitize($_POST);

$validator->addStrategy('firstname', new RequiredValidator());
$validator->addStrategy('firstname', new StringValidator(30));
$validator->addStrategy('lastname', new RequiredValidator());
$validator->addStrategy('lastname', new StringValidator(30));
$validator->addStrategy('pseudo', new RequiredValidator());
$validator->addStrategy('pseudo', new StringValidator(30));
$validator->addStrategy('mail', new RequiredValidator());
$validator->addStrategy('mail', new StringValidator(30));
$validator->addStrategy('password', new RequiredValidator());
$validator->addStrategy('password', new PasswordValidator(30));
$validator->addStrategy('id_role', new RequiredValidator());
$validator->addStrategy('id_role', new IntegerValidator());

// Instancier les repositories nécessaires
$userRepository = new UserRepository();
$roleRepository = new RoleRepository(); 
try {
    // Récupérer l'ID du rôle
    $role = $roleRepository->findByRoleName($data['role']);
    if (!$role) {
        header('location: ../public/registerpage.php?error=invalid_role');
        return;
    }

    // Vérifier si l'utilisateur existe déjà
    $existingUser = $userRepository->findByMail($data['mail']);
    if ($existingUser) {
        header('location: ../public/registerpage.php?error=2');
        return;
    }

    // Créer une instance de User
    $user = new User(0, $data['firstname'], $data['lastname'], $data['pseudo'], $data['mail'], $data['password'],$role->getId(), "", "");

    // Insérer l'utilisateur en base de données
    $insertedUser = $userRepository->insert($user);

    if (!$insertedUser) {
        header('location: ../public/registerpage.php?error=3');
        return;
    }

    // Démarrer la session
    session_start();
    $_SESSION["user_id"] = $insertedUser->getId();
    $_SESSION["pseudo"] = $insertedUser->getPseudo();
    $_SESSION["mail"] = $insertedUser->getMail();
    $_SESSION["role"] = $data['role'];


    // Rediriger en fonction du rôle
    if ($_SESSION['role'] === 'Seller') {
        header("location: ../public/sellerregisterpage.php?id=" . $insertedUser->getId());
        return;
    }

    header("location: ../public/profilpage.php?id=" . $insertedUser->getId());
} catch (\Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

