<div class="flex h-screen w-full bg-slate-100 items-center justify-center px-2">
    <div class="w-full rounded-xl p-12 shadow-2xl shadow-blue-200 md:w-8/12 lg:w-6/12 bg-white">
        <div class="w-fit flex flex-col justify-center items-center md:space-x-20">
            <div class="w-fit flex flex-col md:flex-row space-x-5 pb-2">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-100">
                    <img src="<?php echo $user->getImageUti(); ?>" alt="">
                </div>

                <div class="text-start">
                    <h2 class="text-2xl font-bold text-zinc-700">
                        <?php echo $user->getNomUti() ?>
                    </h2>
                    <p class="mt-4 font-semibold text-zinc-700">
                        <?php echo $user->getPrenomUti() ?>
                    </p>
                    <p class="mt-4 text-zinc-500">
                        <?php echo $user->getMailUti() ?>
                    </p>
                </div>
            </div>
            <div class="flex border-t pt-2 w-full items-center justify-center flex-row space-x-10 md:space-y-0 md:space-x-10">
                <div>
                    <p class="font-bold text-zinc-700">
                        <?php echo $user->getDateInscription() ?>
                    </p>
                    <p class="text-sm font-semibold text-zinc-700">Inscription</p>
                </div>

                <div>
                    <p class="font-bold text-zinc-700">
                        <?php echo $gclubs->getClubById($user->getIdClub())->getNomClub() ?>
                    </p>
                    <p class="text-sm font-semibold text-zinc-700">Club favori</p>
                </div>


            </div>
        </div>
    </div>
</div>