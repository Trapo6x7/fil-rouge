<?php

require_once "../utils/connectdb.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location: ../pages/registerpage.php');
    return;
}

if (
    !isset(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['pseudo'],
        $_POST['mail'],
        $_POST['password'],
        $_POST['role'],

    )
) {
    header('location: ../pages/registerpage.php');
    return;
}


if (
    empty($_POST['firstname']) ||
    empty($_POST['lastname']) ||
    empty($_POST['pseudo']) ||
    empty($_POST['mail']) ||
    empty($_POST['password']) ||
    empty($_POST['role'])

) {
    header('location: ../pages/registerpage.php');
    return;
}


if (
    strlen($_POST['firstname']) > 100 ||
    strlen($_POST['lastname']) > 50 ||
    strlen($_POST['pseudo']) > 50 ||
    strlen($_POST['mail']) > 50 ||
    strlen($_POST['password']) > 50

) {
    header('location: ../pages/registerpage.php');
    return;
}

// Après avoir récupéré les données du formulaire (nom, prénom, etc.)
// et effectué les vérifications :

$firstname = htmlspecialchars(trim($_POST['firstname']));
$lastname = htmlspecialchars(trim($_POST['lastname']));
$pseudo = htmlspecialchars(trim($_POST['pseudo']));
$mail = htmlspecialchars(trim($_POST['mail']));
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = htmlspecialchars(trim($_POST['role']));

// Récupérer l'ID du rôle correspondant
try {
    // Récupérer l'ID du rôle à partir de la table `roles`
    $request = $pdo->prepare("SELECT id FROM role WHERE role = :role");
    $request->bindParam(':role', $role);
    $request->execute();

    $roleData = $request->fetch(PDO::FETCH_ASSOC);

    if (!$roleData) {
        // Si le rôle n'existe pas, rediriger ou gérer l'erreur
        header('location: ../pages/registerpage.php?error=invalid_role');
        return;
    }

    $id_role = $roleData['id']; // Récupérer l'ID du rôle

} catch (\PDOException $error) {
    throw $error;
}

// Vérification si le compte existe déjà (reste inchangé)
try {
    $request = $pdo->prepare("SELECT * FROM user WHERE pseudo = :pseudo OR mail = :mail");
    $request->bindParam(':pseudo', $pseudo);
    $request->bindParam(':mail', $mail);
    $request->execute();

    $user = $request->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        header('location: ../pages/registerpage.php?error=2');
        return;
    }
} catch (\PDOException $error) {
    throw $error;
}

// Insertion en base de données avec l'ID du rôle
try {
    $request = $pdo->prepare("INSERT INTO user (firstname, lastname, pseudo, id_role, mail, password) 
                                  VALUES (:firstname, :lastname, :pseudo, :id_role, :mail, :password)");
    $request->bindParam(':firstname', $firstname);
    $request->bindParam(':lastname', $lastname);
    $request->bindParam(':pseudo', $pseudo);
    $request->bindParam(':mail', $mail);
    $request->bindParam(':password', $password);
    $request->bindParam(':id_role', $id_role); // Utilisation de l'ID du rôle
    $request->execute();

    $userId = $pdo->lastInsertId(); // Récupère l'ID de l'utilisateur inséré

    // Démarrer une session et définir les variables de session
    session_start();
    $_SESSION["user_id"] = $userId;
    $_SESSION["pseudo"] = $pseudo;
    $_SESSION["mail"] = $mail;
    $_SESSION["role"] = $role; // Facultatif si utile

    // Suite de ton code pour la redirection, session, etc.
    try {
        $request = $pdo->prepare("SELECT * FROM user WHERE mail = :mail");
        $request->bindParam(":mail", $mail); // Correction ici (tu avais une variable $email)
        $request->execute();

        $user = $request->fetch(PDO::FETCH_ASSOC);

        if ($role === 'seller') {
            header("location: ../pages/sellerregisterpage.php?id=" . $userId);
            return;
        }

        if (!$user) {
            header('location: ../pages/registerpage.php?error=1');
        } else {
            session_start();
            $_SESSION["pseudo"] = $pseudo;
        }
    } catch (\PDOException $error) {
        throw $error;
    }

    header("Location: ./pages/profilpage.php");
} catch (\PDOException $error) {
    throw $error;
}
