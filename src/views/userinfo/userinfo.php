<div class="flex w-full">
  <section class="hidden md:flex w-[50%] md:w-[20%] h-full pt-28 bg-white overflow-auto z-10">
    <div class="flex flex-col justify-start items-center w-[80%] pl-5">
      <?php
      $admin = $user->isAdminUti();
      if ($admin)
        include('./src/views/userinfo/menu_admin/admin_menu.php');
      ?>
      <div class="space-y-5 py-5 border-b w-full">
        <h1 class="text-md text-gray-500">PARAMETRES DU COMPTE</h1>
        <ul class="flex flex-col text-neutral-800 font-bold text-sm space-y-2">
          <a class="cursor-pointer flex" href="/profile">
          <svg aria-hidden="true" class="w-5 h-5 mr-2 text-blue-500 group-hover:text-gray-500 dark:text-blue-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
            Profil
          </a>
          <a class="cursor-pointer flex" href="/profile/parametres">
            <svg aria-hidden="true" class="w-5 h-5 mr-2 text-blue-500 group-hover:text-gray-500 dark:text-blue-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
            Parametres
          </a>
          <a class="cursor-pointer flex" href="mailto:contact@ligue1.fr?subject=Le football, il a changé&body=Bonjour...">
          <svg aria-hidden="true" class="w-5 h-5 mr-2 text-blue-500 group-hover:text-gray-500 dark:text-blue-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
            Nous contacter
          </a>
        </ul>
      </div>
    </div>
  </section>
  <section class="w-full md:w-[80%] h-screen pt-10 right-0 bg-slate-100">
    <?php
    $request_uri = $_SERVER['REQUEST_URI'];

    if (isset($request_uri)) {
      $route = preg_split('[/]', $request_uri);
      if (isset($route[2])) {
        switch ($route[2]) {
          case 'parametres':
            include('./src/views/userinfo/menu_compte/parametres.php');
            break;
          case "gestionuti":
            if(!$user->isAdminUti()) header('Location: /profile');
            include('./src/views/userinfo/menu_admin/gestion_uti.php');
            break;
        }
        return;
      }
      include('./src/views/userinfo/menu_compte/profil.php');
    }

    ?>
  </section>
</div>