<div class="w-full h-screen">
    <div class="flex justify-center">
        <section class="w-full h-full mt-20">
            <div class="container mx-auto py-8 space-y-10">
                <div class="flex w-full justify-between items-center px-5">
                    <h1 class="text-2xl font-bold">Liste d'articles</h1>
                    <a href="/articles/new"
                        class="font-bold bg-blue-500 hover:bg-blue-600 text-slate-100 rounded-md p-2">Ecrire un
                        article</a>
                </div>

                <div class="flex flex-wrap justify-center space-y-5 md:space-x-5">
                    <?php
                    if ($articles == null) {
                        echo "Aucun article enregistré";
                    } else {
                        foreach ($articles as $key => $article) {
                            include('./src/views/articles/template_article.php');
                        }
                    }

                    ?>
                    
                </div>
            </div>

        </section>
    </div>
</div>