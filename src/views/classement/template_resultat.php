
<div class="flex flex-col bg-white border shadow-sm rounded-xl items-center justify-center ml-2 mb-2 w-[46%] md:w-[30%]">
  <img class="w-48 h-auto self-center rounded-t-xl" src=<?php echo '/assets/clubs/'. $saison->getLogo() ?>>
  <div class="p-5">
    <h3 class="text-lg font-bold text-gray-800">
        <?php echo $saison->getNomClub() ?>
    </h3>
    <p class="mt-1 text-gray-800">
        Rank: <?php echo $rank ?>
    </p>
    <div class="mt-5 text-xs text-gray-500">
            <p class="font-bold">nb points: <?php echo $saison->getNbPoints() ?></p>
            <p>But marqués: <?php echo $saison->getNbButsMarques() ?></p>
            <p>But encaissés: <?php echo $saison->getNbButsEncaisse() ?></p>
    </div>
  </div>
</div>