<?php

include_once "../utils/autoloader.php";
include_once '../utils/check-if-connected.php';
require_once './partials/header.php';
$roleRepostory= new RoleRepository();
$roles = $roleRepostory->findAllExceptAdmin();

?>


    <main>
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
                <form class="flex flex-col justify-center w-full items-center gap-8 p-10" action="../process/processregister.php" method="post">

                    <div class="flex flex-col justify-center items-center gap-3 p-10">

                        <label for="firstname" class="text-xs font-bold">Prénom :</label>
                        <input type="text" id="firstname" name="firstname" required class="rounded-md text-center">
                        <label for="lastname" class="text-xs font-bold">Nom de famille :</label>
                        <input type="text" id="lastname" name="lastname" required class="rounded-md text-center">
                        <label for="pseudo" class="text-xs font-bold">Username :</label>
                        <input type="text" id="pseudo" name="pseudo" required class="rounded-md text-center">
                        <label for="mail" class="text-xs font-bold">E-Mail :</label>
                        <input type="email" id="mail" name="mail" required class="rounded-md text-center">
                        <label for="password" class="text-xs font-bold">Mot de passe :</label>
                        <input type="password" id="password" name="password" required class="rounded-md text-center">
                        <select id="role" name="role" class="text-sm">
                            <?php
                            foreach ($roles as $role) {
                            ?>
                                <option value="<?= htmlspecialchars($role->getId()); ?>"><?= htmlspecialchars($role->getRole()); ?></option>
                            <?php
                             }
                            ?>
                        </select>
                        <input type="submit" class="bg-primary-purple px-4 py-2 rounded-md text-off-white text-sm">

                </form>
                </div>



                <p class="text-sm">Dejà un compte? <a href="./loginpage.php" class="font-bold">Connectez vous</a></p>

            </main>
        </section>
    </main>
    <?php
    require_once './partials/footer.php';