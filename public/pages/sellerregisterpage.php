<?php

include_once "../../utils/autoloader.php";
require_once "../../utils/connectdb.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookMarket</title>
    <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-off-white font-inter min-h-screen flex flex-col">

    <header class="flex flex-col">
        <nav class="bg-primary-yellow flex justify-between items-center p-4 w-full">

            <div class="flex w-3/12 justify-start">
                <a href="../index.php" alt="">
                    <img src="../asset/logobookmarket.png" alt="logobookmarket" class="w-12">
                </a>
            </div>

            <form action="" method="get" class="flex w-6/12 justify-center">
                <div>
                    <input id="example" type="search" name="search" placeholder="Rechercher..." class="rounded-md w-96" />
                </div>
            </form>

            <div class="flex w-3/12 gap-1 right-0 justify-end">
                <a href="" alt="">
                    <img src="../asset/iconuser.png" alt="user" class="w-12">
                </a>
                <a href="" alt="">
                    <img src="../asset/iconcontact.png" alt="contact" class="w-12">
                </a>
                <a href="" alt="">
                    <img src="../asset/iconshop" alt="shop" class="w-12">
                </a>
            </div>
        </nav>
        <nav class="p-2 flex justify-around bg-secondary-gray">

            <a href="" alt="" class="text-off-white hover:text-primary-purple">Tous les produits</a>
            <a href="" alt="" class="text-off-white hover:text-primary-purple">Idées lecture</a>
            <a href="" alt="" class="text-off-white hover:text-primary-purple">Notre selection</a>
            <a href="" alt="" class="text-off-white hover:text-primary-purple">Promos</a>
            <a href="" alt="" class="text-off-white hover:text-primary-purple">Meilleures ventes</a>
            <a href="" alt="" class="text-off-white hover:text-primary-purple">Coup de coeur</a>
            <a href="" alt="" class="text-off-white hover:text-primary-purple">Aide</a>

        </nav>
    </header>

    <main class="grow">
        <section class="text-secondary-gray">
            <main class="flex flex-col p-10 justify-between items-center">

                <h1 class="font-bold text-lg">Creez votre compte sur BookMarket</h1>

                <?php if (isset($_GET['error']) && $_GET['error'] === '1') {
                ?>
                    <p class="font-jaro pb-4">Il faut remplir tous les champs</p>
                <?php
                }
                ?>

                <?php if (isset($_GET['error']) && $_GET['error'] === '2') {
                ?>
                    <p class="font-jaro pb-4">L'utilisateur existe déjà ou l'email est déjà utilisé</p>
                <?php
                }
                ?>
                <form class="flex flex-col justify-center w-full items-center gap-8 p-10" action="../process/processregisterseller.php?id=<?= $_GET['id'] ?>" method="post">

                    <div class="flex flex-col justify-center items-center gap-3 p-10">

                        <label for="companyname" class="text-xs font-bold">Nom de votre société</label>
                        <input type="text" id="companyname" name="companyname" required class="rounded-md text-center">
                        <label for="companyadress" class="text-xs font-bold">Adresse de votre société</label>
                        <input type="text" id="companyadress" name="companyadress" required class="rounded-md text-center">



                        <input type="submit" class="bg-primary-purple px-4 py-2 rounded-md text-off-white text-sm">

                </form>
                </div>
                <p class="text-sm">Dejà un compte? <a href="./loginpage.php" class="font-bold">Connectez vous</a></p>

            </main>
        </section>
    </main>

    <footer class="bg-secondary-gray p-10 text-off-white flex justify-between">

        <div class="flex flex-col gap-24">
            <div class="text-lg">
                <h2>BookMarket</h2>
            </div>
            <div class="flex gap-2 text-xs">
                <a href="" alt="">
                    <p>Tous les produits</p>
                </a>
                <p>/</p>
                <a href="" alt="">
                    <p>Idées lecture</p>
                </a>
                <p>/</p>
                <a href="" alt="">
                    <p>Notre sélection</p>
                </a>
                <p>/</p>

                <a href="" alt="">
                    <p>Promo</p>
                </a>
                <p>/</p>
                <a href="" alt="">
                    <p>Meilleures ventes</p>
                </a>
                <p>/</p>
                <a href="" alt="">
                    <p>Coup de coeur</p>
                </a>
                <p>/</p>
                <a href="" alt="">
                    <p>Aide</p>
                </a>
            </div>
        </div>

        <div class="flex flex-col justify-end items-end gap-5">
            <div class="text-end">
                <p class="text-xs">Contact us</p>
                <p class="text-md">+1 999 888-76-54</p>
            </div>

            <div class="text-end">
                <p class="text-xs">Email</p>
                <p class="text-md">hello@bookmarket.com</p>
            </div>
        </div>


    </footer>


</body>

</html>