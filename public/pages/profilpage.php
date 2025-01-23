<?php
include_once "../../utils/autoloader.php";
require_once "../../utils/connectdb.php";
include_once "../../utils/check-if-not-connected.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookMarket</title>
    <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-off-white font-inter">

    <header>
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

    <main>
        <main class="text-secondary-gray">
            
            <section class="flex p-10 justify-between items-center divide-x">


                <section class="flex flex-col gap-8 w-1/6">

                    <div class="flex flex-col gap-1 items-center justify-start">
                        <img src="../asset/photos/chill_guy1731936768520.png" alt="" class="w-1/3">
                        <h2 class="font-bold text-md"><?= strtoupper($_SESSION['user']['pseudo']) ?></h2>
                        <p class="font-normal text-sm"><?= $_SESSION['user']['mail'] ?></p>
                    </div>

                    <div class="flex flex-col gap-1 items-center justify-start">
                        <a href="">
                            <p class="font-normal text-sm">Tableau de bord</p>
                        </a>
                        <a href="">
                            <p class="font-normal text-sm">Mes articles</p>
                        </a>
                        <a href="">
                            <p class="font-normal text-sm">Toutes les commandes</p>
                        </a>
                    </div>

                    <div class="flex flex-col gap-1 items-center justify-start">
                        <a href="">
                            <p class="font-bold text-sm">Modifier le profil</p>
                        </a>
                        <a href="" class="text-red-600">

                            <form action="../process/process_logout.php" method="POST">
                                <button type="submit">
                                    <p class="font-bold text-sm ">Deconnexion</p>
                                </button>
                            </form>
                        </a>
                    </div>

                </section>

                <section class="flex flex-col gap-8 w-5/6 p-5">

             
            <div class="flex justify-center">
                <h1 class="text-lg">Bonjour <span class="font-bold"><?=strtoupper($_SESSION['user']['pseudo'])?></span>, prêt a lire aujourd'hui?</h1>
            </div>
            

                    <article class="bg-off-white rounded-md flex flex-col p-5 w-1/4 gap-3">
                        <div class="flex justify-end">
                            <img src="../asset/coeuricon.png" alt="" id="like" class="w-4">
                        </div>

                        <div class="flex justify-center">
                            <img src="../asset/cover/onepiece.jpg" alt="" id="cover" class="h-72 rounded-md">
                        </div>

                        <div class="flex flex-col">
                            <h3 id="auteur" class="text-sm font-extralight">Auteur</h3>
                            <h2 id="titre" class="text-lg font-extrabold text-secondary-gray">Titre</h2>
                            <p id="price" class="text-md font-bold text-primary-purple">Prix</p>
                        </div>

                        <div class="flex justify-center text-sm">
                            <a href="" alt="" class="text-off-white bg-secondary-gray p-2 rounded-md">Ajouter au panier</a>
                        </div>
                    </article>
                </section>

            </section>
        </main>
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