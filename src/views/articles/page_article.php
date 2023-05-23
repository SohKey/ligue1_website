<?php

if (isset($_SESSION['UserInfo']))
    include('./src/views/header/header_auth.php');
else
    include('./src/views/header/header.php');

$commentaires = $gestionCommentaire->getListCommentaire($article->getId_article());

$status = (object) ['main' => 'hidden', 'statusMessage' => '', 'style' => ''];

//$user = $userController->get_user_byid($_SESSION['UserInfo']->id);

if (isset($_POST['commentaire'])) {

    if (!isset($_SESSION['UserInfo'])) {
        header("Location: /login");
    }

    $text_commentaire = $_REQUEST['text'];
    $id_article = $article->getId_article();
    $id_autor = $_SESSION['UserInfo']->id;

    $commentaire = new Commentaire(0, $text_commentaire, $id_article, $id_autor);
    $status = $gestionCommentaire->addCommentaire($commentaire);
    header("Location: /articles/" . $article->getId_article());
}
/*
if (isset($_POST['removeArticle'])) {
    if($article->getId_uti() == $user->getIdUti() || $user->isAdminUti()) {
        
    }
}*/

?>

<div class="w-full h-screen pt-20">
    <div class="flex h-fit justify-center flex-col">
        <section class="flex flex-col md:flex-row w-full h-full bg-white shadow-2xl shadow-slate-800 p-5">
            <div
                class="block md:w-[40%] h-fit max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <?php echo $article->getTitre_article() ?>
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">
                    <?php echo $article->getContent_article() ?>
                </p>
            
                <form class="mt-5">
                        <button
                        type="submit"
                        name="removeArticle"
                        class="bg-red-500 text-xs font-medium text-white hover:bg-red-600 p-2 rounded-md w-fit"
                        >Supprimer</button>
                    </form>

            </div>
            <div class="w-full h-full mt-5 md:mt-0 md:ml-5">
                <form method="POST">
                    <div
                        class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea name="text" rows="4"
                                class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                placeholder="Write a comment..." required></textarea>
                        </div>
                        <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                            <button type="submit" name="commentaire"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Post comment
                            </button>
                        </div>
                        <p <?php $status->main ?> class="<?php $status->style ?>">
                            <?php $status->statusMessage ?>
                        </p>
                    </div>
                </form>
            </div>

        </section>

        <div class="px-5 pt-5 border-t h-fit bg-white w-full space-y-5">
            <h1 class="font-bold text-grey-800 text-xl">Commentaires</h1>
            <?php
            if ($commentaires == null) {
                echo "Aucun commentaire enregistré";
            } else {
                foreach ($commentaires as $key => $commentaire) {
                    include('./src/views/articles/template_commentaire.php');
                }
            }
            ?>
        </div>
    </div>
</div>