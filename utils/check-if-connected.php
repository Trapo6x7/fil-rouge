<?php

session_start();

if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    header('Location: ../public/profilpage.php?id=' . $_SESSION['user']->getId());
    die();
}


?>