<div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        <?php echo $userController->get_user_byid($commentaire->getId_uti())->getNomUti() ?>
    </h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">
    <?php echo $commentaire->getText_commentaire() ?>
    </p>
</div>