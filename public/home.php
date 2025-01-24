<?php
include_once "../utils/autoloader.php";
require_once './partials/header.php';
$productRepo = new ProductRepository;
$authorRepo = new AuthorRepository;
$genreRepo = new GenreRepository;
$articleRepo = new ArticleRepository;
$products = $productRepo->findAll();
$articles = $articleRepo->findAll();
// Sélectionner 4 indices aléatoires
$randomKeys1 = array_rand($products, 4);
$randomKeys2 = array_rand($articles, 3);
// Initialiser un tableau pour les produits aléatoires
$randomProducts = [];

$randomArticles = [];
// Récupérer les objets produits en utilisant les indices
foreach ($randomKeys1 as $key) {
    $randomProducts[] = $products[$key];
}
foreach ($randomKeys2 as $key) {
    $randomArticles[] = $articles[$key];
}

?>


<main>

    <section>
        <article>
            <--caroussel
                </article>
    </section>

    <section class="bg-primary-yellow p-10 flex gap-5 justify-between">
        <?php
foreach ($randomProducts as $randomProduct):
        ?>
        <article class="bg-off-white rounded-md flex flex-col p-5 w-1/4 gap-3">
            <div class="flex justify-end">
                <img src="./asset/coeuricon.png" alt="" id="like" class="w-4">
            </div>

            <div class="flex justify-center">
               <img src="<?php $randomProduct->getImageUrl() ?>" alt="" id="cover" class="h-72 rounded-md">
            </div>

            <div class="flex flex-col">
                <h3 id="auteur" class="text-sm font-extralight"><?= $authorRepo->findById($randomProduct->getIdAuthor())->getAuthor() ?></h3>
                <h2 id="titre" class="text-lg font-extrabold text-secondary-gray"><?= $randomProduct->getName() ?></h2>
                <!-- <p id="price" class="text-md font-bold text-primary-purple">Prix</p> -->
            </div>

            <div class="flex justify-center text-sm">
                <a href="" alt="" class="text-off-white bg-secondary-gray p-2 rounded-md">Ajouter au panier</a>
            </div>
        </article>
        <?php
endforeach;
        ?>
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
<?php foreach ($randomArticles as $randomArticle):
?>
        <article class="bg-off-white rounded-md flex flex-col p-5 w-1/3 gap-3">

            <div class="flex justify-center">
                <img src="<?= $randomArticle->getImageUrl()?>" alt="" id="cover" class="h-auto rounded-md">
            </div>

            <div class="flex flex-col">
                <h3 class="text-md font-bold"><?= $randomArticle->getName()?></h3>
                <p class="text-sm"><?= $randomArticle->getBody()?></p>
            </div>

            <div class="flex justify-end text-sm">
                <a href="" alt="" class="text-off-white bg-secondary-gray p-2 w-1/2 text-center rounded-md">Lire l'article</a>
            </div>
        </article>
<?php endforeach;
?>
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
<?php
require_once './partials/footer.php';
