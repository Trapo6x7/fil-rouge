<?php

include_once "../utils/autoloader.php";
require_once './partials/header.php';
?>

    </header>

    <main class="grow">
        <section class="text-secondary-gray">
            <main class="flex flex-col p-28 justify-between items-center">

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
                <form class="flex flex-col justify-center w-full items-center gap-8 p-24" action="../process/processregisterseller.php?id=<?= $_GET['id'] ?>" method="post">

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

    <?php
    require_once './partials/footer.php';