<a href=<?php echo "/articles/" . $article->getId_article(); ?> class="ml-5 mt-5 bg-white shadow-md rounded-lg p-5 w-[50%] md:w-[25%]">
    <img src=<?php echo $article->getImage_article() ?> class="w-20 h-auto object-cover rounded-t-lg">
    <div class="p-4">
        <h2 class="text-xl font-bold mb-2">
            <?php echo $article->getTitre_article() ?>
        </h2>
        <p class="text-gray-700">
            <?php echo $article->getContent_article() ?>
        </p>
        <p class="text-gray-500 mt-4">Auteur:
            <?php echo $userController->get_user_byid($article->getId_uti())->getNomUti() ?>
        </p>
    </div>
</a>