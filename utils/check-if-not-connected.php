<?php

session_start();

if (
    !isset($_SESSION["user"]) || empty($_SESSION["user"])

) {

    // Redirection vers l'URL
    header('Location: ' . $url);
    exit;
}
