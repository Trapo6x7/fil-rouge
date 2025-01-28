<?php
include_once "../utils/autoloader.php";

$validator = new ValidatorService();

// Vérifier que la méthode HTTP est POST
$validator->checkMethods('POST');

// Si les données ne sont pas valides, redirection vers la page de profil
if (!$validator->validate($_POST)) {
    header('location: ../public/profilpage.php?error=invalid_data');
    return;
}

// Nettoyer les données reçues
$data = $validator->sanitize($_POST);

// Ajouter les stratégies de validation
$validator->addStrategy('id', new RequiredValidator());
$validator->addStrategy('id', new IntegerValidator());
$validator->addStrategy('firstname', new RequiredValidator());
$validator->addStrategy('firstname', new StringValidator(30));
$validator->addStrategy('lastname', new RequiredValidator());
$validator->addStrategy('lastname', new StringValidator(30));
$validator->addStrategy('pseudo', new RequiredValidator());
$validator->addStrategy('pseudo', new StringValidator(30));
$validator->addStrategy('mail', new RequiredValidator());
$validator->addStrategy('mail', new StringValidator(50));
$validator->addStrategy('password', new PasswordValidator(30)); // Le mot de passe peut être optionnel
$validator->addStrategy('role', new RequiredValidator());
$validator->addStrategy('role', new IntegerValidator());

$isValid = $validator->validate($data);

if (!$isValid) {
    header('location: ../public/profilpage.php?error=validation_failed');
    return;
}

// Hacher le mot de passe uniquement si un nouveau mot de passe est fourni
if (!empty($data['password'])) {
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
}

// Instancier les repositories nécessaires
$roleRepository = new RoleRepository();
$userRepository = new UserRepository();

try {
    // Vérifier si le rôle existe
    $role = $roleRepository->findById($data['role']);
    if (!$role) {
        header('location: ../public/profilpage.php?error=invalid_role');
        return;
    }

    // Vérifier si l'utilisateur existe
    $user = $userRepository->findById($data['id']);
    if (!$user) {
        header('location: ../public/profilpage.php?error=user_not_found');
        return;
    }

    // Mettre à jour les informations de l'utilisateur
    $user->setFirstname($data['firstname']);
    $user->setLastname($data['lastname']);
    $user->setPseudo($data['pseudo']);
    $user->setMail($data['mail']);
    $user->setRole($role);

    if (!empty($data['password'])) {
        $user->setPassword($data['password']);
    }

    // Mettre à jour en base de données
    $updated = $userRepository->update($user);

    if (!$updated) {
        header('location: ../public/profilpage.php?error=update_failed');
        return;
    }

    // Mettre à jour la session si l'utilisateur connecté est modifié
    session_start();
    if ($_SESSION['user']->getId() == $user->getId()) {
        $_SESSION['user'] = $user;
    }

    header('location: ../public/profilpage.php?success=update_successful');
} catch (\Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
