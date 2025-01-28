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
$validator->addStrategy('firstname', new StringValidator(30)); // Pas obligatoire
$validator->addStrategy('lastname', new StringValidator(30)); // Pas obligatoire
$validator->addStrategy('pseudo', new StringValidator(30)); // Pas obligatoire
$validator->addStrategy('mail', new StringValidator(50)); // Pas obligatoire
$validator->addStrategy('password', new PasswordValidator(30)); // Pas obligatoire
$validator->addStrategy('role', new IntegerValidator()); // Pas obligatoire

$isValid = $validator->validate($data);

if (!$isValid) {
    header('location: ../public/profilpage.php?error=validation_failed');
    return;
}

// Instancier les repositories nécessaires
$roleRepository = new RoleRepository();
$userRepository = new UserRepository();

try {
    // Vérifier si l'utilisateur existe
    $user = $userRepository->findById($data['id']);
    if (!$user) {
        header('location: ../public/profilpage.php?error=user_not_found');
        return;
    }

    // Vérifier si un rôle est fourni et qu'il existe
    if (!empty($data['role'])) {
        $role = $roleRepository->findById($data['role']);
        if (!$role) {
            header('location: ../public/profilpage.php?error=invalid_role');
            return;
        }
        $user->setRole($role);
    }

    // Mettre à jour uniquement les champs fournis
    if (!empty($data['firstname'])) {
        $user->setFirstname($data['firstname']);
    }
    if (!empty($data['lastname'])) {
        $user->setLastname($data['lastname']);
    }
    if (!empty($data['pseudo'])) {
        $user->setPseudo($data['pseudo']);
    }
    if (!empty($data['mail'])) {
        $user->setMail($data['mail']);
    }
    if (!empty($data['password'])) {
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
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
