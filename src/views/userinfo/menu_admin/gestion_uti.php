<div class="pt-10 px-5 w-full space-y-5">
    <h1 class="text-xl text-gray-700 font-bold">Gestion des utilisateurs </h1>
    <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        mail
                    </th>
                    <th scope="col" class="px-6 py-3">
                        admin
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!$user->isAdminUti()) header('Location: /profile');

                if ($users == null) {
                    echo "Aucun utilisateur enregistré";
                    return;
                }

                foreach ($users as $key => $guy) {
                    include('./src/views/userinfo/menu_admin/uti_template.php');
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>