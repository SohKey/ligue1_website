<?php

$userController = new GestionUser($cnx);

$form = "";
$message = "";

function check_mdp_format($mdp) {
	$majuscule = preg_match('@[A-Z]@', $mdp);
	$minuscule = preg_match('@[a-z]@', $mdp);
	$chiffre = preg_match('@[0-9]@', $mdp);
	
	if(!$majuscule || !$minuscule || !$chiffre || strlen($mdp) < 8) return false;
	return true;
}

if (isset($_POST['updateEmail'])) {
    $form = "updateEmail";
    $new_mail = $_REQUEST['newmail'];
    $password = $_REQUEST['password'];

    if (!$userController->isAlreadyUsed($new_mail)) {
        if (password_verify($password, $user->getPasswordUti())) {
            $updatedUser = $user->setMailUti($new_mail);
            if ($userController->updateUser($updatedUser)) {
                header('Location: /profile');
            } else $message = "Erreur lors de l'enregistrement";
        } else $message = "Incorrect password";
	} else $message = "Le mail ". $new_mail . " est déjà enregistré";
}

if (isset($_POST['updatePassword'])) {
    $form = "updatePassword";
    $new_password = $_REQUEST['confirm-password'];
    $new_password2 = $_REQUEST['password'];
    $password = $_REQUEST['old_password'];

    if($new_password == $new_password2) {
        if(check_mdp_format($new_password)) {
            if (password_verify($password, $user->getPasswordUti())) {
                $updatedUser = $user->setPasswordUti(password_hash($new_password, PASSWORD_DEFAULT));
                if ($userController->updateUser($updatedUser)) {
                    header('Location: /logout');
                } else $message = "Erreur lors de l'enregistrement";
            } else $message = "Mot de passe incorrect";
        } else $message = "Format de mot de passe incorrect";  
    } else $message = "Le mot de passe n'est pas similaire";

}

if (isset($_POST['deleteAccount'])) {
    $form = "deleteAccount";
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    if ($user->getMailUti() == $email) {
        if (password_verify($password, $user->getPasswordUti())) {
            if ($userController->deleteUser($user->getIdUti())) {
                header('Location: /logout');
            } else $message = "Erreur lors de l'enregistrement";
        } else $message = "Incorrect password";
	} else $message = "Le mail ". $email . " ne correspond pas";
}

?>

<script>
    window.addEventListener("DOMContentLoaded", () => {

        function selectItem(item, vitem) {
            const selected = ["text-blue-600", "border-blue-600"];
            const unselected = ["border-transparent", "hover:text-gray-600", "hover:border-gray-300"];
            const buttons = [uti, pwd, del];
            const views = [vuti, vpwd, vdel];

            views.forEach(el => {
                el.classList.add("hidden");
            });

            buttons.forEach(el => {
                el.classList.remove(...selected);
                el.classList.add(...unselected);
            });

            item.classList.remove(...unselected);
            item.classList.add(...selected);
            vitem.classList.remove("hidden");
        }
        const form = document.getElementById("form")

        const uti = document.getElementById("uti");
        const pwd = document.getElementById("pwd");
        const del = document.getElementById("del");

        const vuti = document.getElementById("vuti");
        const vpwd = document.getElementById("vpwd");
        const vdel = document.getElementById("vdel");

        selectItem(uti, vuti);

        if (form.innerText) {
            switch (form.innerText) {
                case 'updateEmail':
                    selectItem(uti, vuti);
                    break;
                
                case 'updatePassword':
                    selectItem(pwd, vpwd);
                    break;
                case 'deleteAccount':
                    selectItem(del, vdel);
                    break;
                default:
                    break;
            }
        }

        uti.addEventListener("click", () => selectItem(uti, vuti));
        pwd.addEventListener("click", () => selectItem(pwd, vpwd));
        del.addEventListener("click", () => selectItem(del, vdel));
    })
</script>
<p id="form" hidden><?php echo $form ?></p>
<div class="pt-10 h-full">
    <div class="border-b border-gray-200">
        <ul class="w-full justify-center flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
            <li class="mr-2">
                <a href="#" id="uti"
                    class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group">
                    Email
                </a>
            </li>
            <li class="mr-2">
                <a href="#" id="pwd"
                    class="inline-flex p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active group"
                    aria-current="page">
                    Mot de passe
                </a>
            </li>
            <li class="mr-2">
                <button type="submit" name="updateEmail" id="del"
                    class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group">
                    Supprimer le compte
                </button>
            </li>
        </ul>
    </div>

    <section id="vuti" class="bg-gray-50">
        <div class="flex flex-col items-center justify-center h-[92%] px-6 mx-auto lg:py-0">
            <div class="w-full p-6 bg-white rounded-lg shadow md:mt-0 sm:max-w-md sm:p-8">
                <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Update Email
                </h2>
                <form method="POST" class="mt-4 space-y-4 lg:mt-5 md:space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Nouveau Email</label>
                        <input type="email" name="newmail" placeholder="new@mail.com"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Mot de passe</label>
                        <input type="password" name="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required=>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input aria-describedby="newsletter" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300"
                                required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="newsletter" class="font-light text-gray-500">I accept the <a
                                    class="font-medium text-primary-600 hover:underline" href="#">Terms and
                                    Conditions</a></label>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <button type="submit" name="updateEmail"
                            class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Update Email</button>
                    </div>
                    <p>
                        <?php echo $message ?>
                    </p>


                </form>
            </div>
        </div>
    </section>

    <section id="vpwd" class="bg-gray-50">
        <div class="flex flex-col items-center justify-center h-[92%] px-6 mx-auto lg:py-0">
            <div class="w-full p-6 bg-white rounded-lg shadow md:mt-0 sm:max-w-md sm:p-8">
                <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Update Password
                </h2>
                <form method="POST" class="mt-4 space-y-4 lg:mt-5 md:space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Nouveau mot de passe</label>
                        <input name="password" type="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required="">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Confirmer le mot de passe</label>
                        <input type="password" name="confirm-password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Ancien mot de passe</label>
                        <input name="old_password" type="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required="">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input aria-describedby="newsletter" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300"
                                required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="newsletter" class="font-light text-gray-500">I accept the <a
                                    class="font-medium text-primary-600 hover:underline" href="#">Terms and
                                    Conditions</a></label>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <button type="submit"
                        name="updatePassword"
                            class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Update Password</button>
                    </div>
                    <p>
                        <?php echo $message ?>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <section id="vdel" class="bg-gray-50">
        <div class="flex flex-col items-center justify-center h-[92%] px-6 mx-auto lg:py-0">
            <div class="w-full p-6 bg-white rounded-lg shadow md:mt-0 sm:max-w-md sm:p-8">
                <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Delete Account
                </h2>
                <form method="POST" class="mt-4 space-y-4 lg:mt-5 md:space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 ">Your email</label>
                        <input type="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input aria-describedby="newsletter" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300"
                                required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="newsletter" class="font-light text-gray-500">I accept the <a
                                    class="font-medium text-primary-600 hover:underline" href="#">Terms and
                                    Conditions</a></label>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <button type="submit"
                            name="deleteAccount"
                            class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete
                            Account</button>
                    </div>
                    <p>
                        <?php echo $message ?>
                    </p>
                </form>
            </div>
        </div>
    </section>
</div>