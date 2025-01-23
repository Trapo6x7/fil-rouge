<?php
require_once "./utils/connectdb.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookMarket</title>
    <link rel="stylesheet" href="./css/output.css">
</head>

<body class="bg-off-white font-inter">

    <header>
        <nav class="bg-primary-yellow flex justify-between items-center p-4 w-full">

            <div class="flex w-3/12 justify-start">
                <a href="" alt="">
                    <img src="./asset/logobookmarket.png" alt="logobookmarket" class="w-12">
                </a>
            </div>

            <form action="" method="get" class="flex w-6/12 justify-center">
                <div>
                    <input id="example" type="search" name="search" placeholder="Rechercher..." class="rounded-md w-96" />
                </div>
            </form>

            <div class="flex w-3/12 gap-1 right-0 justify-end">
                <a href="./pages/profilpage.php" alt="">
                    <img src="./asset/iconuser.png" alt="user" class="w-12">
                </a>
                <a href="" alt="">
                    <img src="./asset/iconcontact.png" alt="contact" class="w-12">
                </a>
                <a href="" alt="">
                    <img src="./asset/iconshop" alt="shop" class="w-12">
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

        <section>
            <article>
                <--caroussel
                    </article>
        </section>

        <section class="bg-primary-yellow p-10 flex gap-5 justify-between">

            <article class="bg-off-white rounded-md flex flex-col p-5 w-1/4 gap-3">
                <div class="flex justify-end">
                    <img src="./asset/coeuricon.png" alt="" id="like" class="w-4">
                </div>

                <div class="flex justify-center">
                    <img src="./asset/cover/onepiece.jpg" alt="" id="cover" class="h-72 rounded-md">
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

        <section class="flex justify-around">
            <article class="text-primary-purple w-1/3 flex flex-col items-center justify-center p-10 gap-2">
                <img src="./asset/iconsearch.png" alt="" class="w-20">
                <h2 class="font-bold text-md">Facilité d'accès et de recherche</h2>
                <p class="font-light text-sm text-center">Les applications spécialisées
                    permettent de rechercher
                    rapidement des livres en fonction
                    de critères précis.</p>
            </article>
            <article class="text-primary-purple w-1/3 flex flex-col items-center justify-center p-5 gap-2">
                <img src="./asset/iconcomuno.png" alt="" class="w-20">
                <h2 class="font-bold text-md">Transaction simplifiée et sécurisée</h2>
                <p class="font-light text-sm text-center">Vous avez accès à une vaste
                    communauté d'acheteurs et de vendeurs,
                    ce qui augmente les chances de
                    trouver des livres rares ou spécifiques.</p>
            </article>
            <article class="text-primary-purple w-1/3 flex flex-col items-center justify-center p-5 gap-2">
                <img src="./asset/iconhalass.png" alt="" class="w-20">
                <h2 class="font-bold text-md">Large communauté et choix varié</h2>
                <p class="font-light text-sm text-center"> Les plateformes offrent des systèmes
                    de paiement sécurisés et des fonctionnalités
                    de messagerie intégrées.</p>
            </article>
        </section>

        <section class="bg-primary-yellow p-10 flex gap-5 justify-between">

            <article class="bg-off-white rounded-md flex flex-col p-5 w-1/3 gap-3">

                <div class="flex justify-center">
                    <img src="./asset/photos/actu-visuel.jpg" alt="" id="cover" class="h-auto rounded-md">
                </div>

                <div class="flex flex-col">
                    <h3 class="text-md font-bold">Titre Article</h3>
                    <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolorce magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                </div>

                <div class="flex justify-end text-sm">
                    <a href="" alt="" class="text-off-white bg-secondary-gray p-2 w-1/2 text-center rounded-md">Lire l'article</a>
                </div>
            </article>

        </section>

        <section class="bg-primary-purple relative">
            <article class="px-28 py-16 flex flex-col gap-3 text-end">
                <h2 class="text-8xl font-bold text-off-white">Offrez une nouvelle vie à vos livres</h2>
                <p class="text-3xl text-off-white">Estimez vos livres avec notre application.</p>
                <div class="flex justify-end mt-8 gap-8">
                    <img src="./asset/logoapp/logogooglestore.png" alt="googleplay" class="w-1/5 h-auto">
                    <img src="./asset/logoapp/logoapplestore.png" alt="appstore" class="w-1/5 h-auto">
                </div>
                <img src="./asset/photos/mockupappli.png" alt="screenshot" class="absolute h-[78%] mt-16">
            </article>
        </section>

        <section>
            <article class="bg-off-white text-secondary-gray p-10 flex flex-col gap-3 text-sm">
                <h2 class="font-bold">Pourquoi acheter des livres d'occasion ?</h2>

                <p>Faire le choix de l'occasion permet d'acheter des livres pas chers. Leur prix est bien plus bas que les livres neufs et ils sont le plus souvent en très bon état. L'état des livres que nous vendons est
                    scrupuleusement vérifié et répond à une charte de qualité précise. Les livres d'occasion ont un très bon impact sur l'environnement. Saviez-vous que plus de 142 millions de livres sont pilonnés
                    chaque année en France ? Pourtant, la plupart sont encore en état d'être lus. Pour mettre fin à cette aberration, faisons de l'occasion une norme !</p>

                <h2 class="font-bold">Pourquoi acheter des livres sur BookMarket ?</h2>

                <p> En achetant sur la boutique en ligne de BookMarket, vous faites le choix d'une boutique 100% française qui participe à l'économie circulaire. En effet, tous les livres auxquels nous offrons
                    une seconde vie ont été collectés en France. En achetant des livres d'occasion sur notre site, vous bénéficiez de la livraison gratuite et les commandes sont traitées et expédiées en 24h. Pour permettre à chacun d'acheter des livres pas chers, nous faisons notre maximum pour proposer les meilleurs prix.</p>

                <h2 class="font-bold">Qui sommes-nous ?</h2>

                <p>BookMarket est la plateforme pour vendre et acheter des livres d'occasion. Nous permettons à chacun d'offrir une seconde vie à ses livres. Notre mission est de revaloriser les livres
                    d’occasion en proposant à chacun un service simple et transparent. Nous voulons proposer une alternative crédible à l'achat de biens neufs avec une vision claire et ambitieuse : faire de l'occasion
                    une norme.</p>

                <h2 class="font-bold">Comment vendre ses livres ?</h2>

                <p>La Bourse aux Livres n'est pas simplement une boutique en ligne, nous sommes avant tout un dépôt-vente. Nous vous proposons de nous confier vos livres et nous les vendons à votre place. Il s'agit
                    de la meilleure solution pour vendre ses livres simplement et au meilleur prix. En téléchargeant notre application pour smartphone, vous pouvez obtenir une estimation immédiate de combien vous
                    rapporteront vos livres. Il vous suffit ensuite de nous les envoyer et nous nous occupons de tout de A à Z. Vous n'avez plus qu'à attendre vos gains !</p>
            </article>
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