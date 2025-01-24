<?php
include_once "../utils/autoloader.php";
include_once '../utils/check-if-connected.php';
require_once './partials/header.php';

?>

    <main class="grow flex justify-center items-between">
        <section class="text-secondary-gray">
            <section class="flex flex-col p-28 justify-between items-center">

                <h1 class="font-bold text-lg">Connectez vous sur BookMarket</h1>
                <?php if (isset($_GET['error']) && $_GET['error'] === '1') {
                ?>
                    <p class="">L'email ou le mot de passe est incorrect</p>
                <?php
                }
                ?>

                <?php if (isset($_GET['error']) && $_GET['error'] === '2') {
                ?>
                    <p class="">Ce compte n'existe pas</p>
                <?php
                }
                ?>
                <form class="flex flex-col justify-center w-full items-center gap-8 p-24" action="../process/process_login.php" method="post">
                    <div class="flex flex-col justify-between items-center gap-3 p-28">
                        <input class="rounded-md text-center" type="email" id="email" name="email" placeholder="Email" required>
                        <input class="rounded-md text-center" type="password" id="password" name="password" placeholder="Mot de passe" required>
                        <input type="submit" class="bg-primary-purple px-4 py-2 rounded-md text-off-white text-sm" value="Se connecter">
                    </div>
                </form>

                <p class="text-sm">Pas encore de compte ?<a class="font-bold" href="./registerpage.php"> Inscrivez vous</a></p>

            </section>
        </section>
    </main>

    <?php
    require_once './partials/footer.php';