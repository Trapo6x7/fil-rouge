<?php
include_once "../utils/autoloader.php";
include_once '../utils/check-if-not-connected.php';
require_once './partials/header.php';

$userRepo = new UserRepository;

/**
 * @var User $user
 */
$user = $_SESSION['user'];


$orderRepo = new OrderRepository;
$orders = $orderRepo->findAllByUserId($user->getId());
$anounceRepo = new AnounceRepository;
?>

<main>
    <main class="text-secondary-gray">

        <section class="flex p-10 justify-between items-center divide-x">


            <section class="flex flex-col gap-8 w-1/6">

                <div class="flex flex-col gap-1 items-center justify-start">
                    <img src="./asset/photos/chill_guy1731936768520.png" alt="" class="w-1/3">
                    <h2 class="font-bold text-md"><?= strtoupper($user->getPseudo()) ?></h2>
                    <p class="font-normal text-sm"><?= $user->getMail() ?></p>
                </div>

                <div class="flex flex-col gap-1 items-center justify-start">
                    <a href="">
                        <p class="font-normal text-sm">Tableau de bord</p>
                    </a>
                    <!-- <a href="">
                            <p class="font-normal text-sm">Mes articles</p>
                        </a> -->
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
                    <h1 class="text-lg">Bonjour <span class="font-bold"><?= strtoupper($user->getPseudo()) ?></span>, prêt a lire aujourd'hui?</h1>
                </div>
<div class="flex">
                <?php
                foreach ($orders as $order) :
                    $anounces = $anounceRepo->findAnouncesByOrderId($order->getId());
                    foreach ($anounces as $anounce):
                    $imageUrl = $anounce->getImageUrl(); 
                    $price = $anounce->getPrice();
              
                ?>
                
                <article class="bg-off-white rounded-md flex flex-col p-5 w-1/4 gap-3">
                    <div class="flex justify-end">
                        <img src="../asset/coeuricon.png" alt="" id="like" class="w-4">
                    </div>

              

                    <div class="flex justify-center">
                        <img src="<?= $imageUrl ?>" alt="" id="cover" class="h-72 rounded-md">
                    </div>

                    <div class="flex flex-col">
                        <h3 id="auteur" class="text-sm font-extralight"><?= $order->getProduct()->getAuthor()->getAuthor()?></h3>
                        <h2 id="titre" class="text-lg font-extrabold text-secondary-gray"><?= $order->getProduct()->getName()?></h2>
                        <p id="price" class="text-md font-bold text-primary-purple"> <?= $price ?> €</p>
                    </div>

                    <div class="flex justify-center text-sm">
                        <a href="" alt="" class="text-off-white bg-secondary-gray p-2 rounded-md">Ajouter au panier</a>
                    </div>
                </article>

                <?php
                      endforeach;
                endforeach;
                ?>
            </section>
            </div>
        </section>
    </main>
</main>

<?php
require_once './partials/footer.php';
