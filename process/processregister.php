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


$firstname = htmlspecialchars(trim($_POST['firstname']));
$lastname = htmlspecialchars(trim($_POST['lastname']));
$pseudo = htmlspecialchars(trim($_POST['pseudo']));
$mail = htmlspecialchars(trim($_POST['mail']));
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = htmlspecialchars(trim($_POST['role']));

// Verifiation si le compte existe déjà 
try {

    $request = $pdo->prepare("SELECT * FROM user WHERE pseudo = :pseudo OR mail = :mail");
    $request->bindParam(':pseudo', $pseudo);
    $request->bindParam(':mail', $email);
    $request->execute();

    $user = $request->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        header('location: ../pages/registerpage.php?error=2');
        return;
    }
} catch (\PDOException $error) {
    throw $error;
}


// Insertion en base de données
try {

    $request = $pdo->prepare("INSERT INTO user (firstname, lastname, pseudo, mail, password) VALUES ( :firstname, :lastname, :pseudo, :mail, :password);
");
    $request->bindParam(':firstname', $firstname);
    $request->bindParam(':lastname', $lastname);
    $request->bindParam(':pseudo', $pseudo);
    $request->bindParam(':mail', $mail);
    $request->bindParam(':password', $password);
    $request->execute();
    $userId = $pdo->lastInsertId(); // Récupère l'ID de l'utilisateur inséré
    // FAIRE LA REDIRECTION VERS LA PAGE D'ACCUEIL, DE PROFIL OU AUTRE ...


    try {

        $request = $pdo->prepare("SELECT * FROM user WHERE mail = :mail");
        $request->bindParam(":mail", $email);
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
};
