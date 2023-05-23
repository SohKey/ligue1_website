<div class="w-full h-full">
    <div class="w-full h-full flex justify-center absolute z-10">
        <section class="w-full h-full">
            <div class="pb-10 pt-5 bg-white shadow-2xl shadow-slate-800 px-5">
                <h1 class="text-3xl pt-20 text-center font-bold mb-10">Classement saison</h1>
                <div class="flex flex-wrap justify-center">
                    <?php

                    if ($saisons == null) {
                        echo "Aucune données de saison enregistrée";
                        return;
                    }
                    
                    $rank = 0;
                    foreach ($saisons as $key => $saison) {
                        $rank++;
                        include('./src/views/classement/template_resultat.php');
                    }
                    ?>

                </div>


            </div>
        </section>
    </div>
</div>