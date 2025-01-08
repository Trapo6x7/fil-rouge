<?php

session_start();

if(
    isset($_SESSION["user"]) && !empty($_SESSION["user"]) 
    
) {
    header("Location: http://localhost/php/filrouge/pages/profilpage.php");
    exit;
}