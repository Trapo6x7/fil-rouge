<?php

session_start();


// Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: http://localhost/poo/filrouge/public/loginpage.php");
    exit;
}
?>