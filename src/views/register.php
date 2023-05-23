<form method="POST" enctype="multipart/form-data">
    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Création de compte</h2>

                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Informations Personelles</p>
                            <p>Merci de remplir tout les champs.</p>
                            <div class="w-full my-5">
                                <p class="w-full text-red-500 font-bold"><?php echo $message; ?></p>
                            </div>

                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <label for="full_name">Nom</label>
                                    <input type="text" name="nom"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" 
                                        pattern="[A-Za-z]{2,30}"
                                        value="<?php if (isset($prenom))
                                            echo $prenom; ?>" />
                                </div>

                                <div class="md:col-span-5">
                                    <label for="full_name">Prenom</label>
                                    <input type="text" name="prenom"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" 
                                        pattern="[A-Za-z]{2,30}"
                                        value="<?php if (isset($prenom))
                                            echo $prenom; ?>" />
                                </div>

                                <?php echo '<input class="hidden" type="text" name="verif" value="">'; ?>

                                <div class="md:col-span-5">
                                    <label for="email">Mail</label>
                                    <input type="text" name="email"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        placeholder="email@domain.com"
                                        pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php if (isset($email)) {
                                            echo $email;
                                        } ?>" />
                                </div>


                                <script>
                                    window.addEventListener("DOMContentLoaded", () => {

                                        const password = document.getElementById("password");
                                        const status = document.getElementById('passwordStatus');
                                        const xhr_object = new XMLHttpRequest();

                                        password.addEventListener('input', event => {
                                            const data = password.value;
                                            const valueLength = event.target.value.length;
                                            if (valueLength > 3) {
                                                xhr_object.open("GET", `./src/controller/check.php?password=${data}`, true);
                                                xhr_object.send();
                                            } else {
                                                status.className = "text-red-500 font-bold"
                                            }
                                        });

                                        xhr_object.onload = function () {
                                            const message = xhr_object.response;

                                            if (message == "ok") {
                                                status.innerHTML = "<p class='help is-success'>Nice password !</p>"
                                                status.className = "text-emerald-500 font-bold"
                                            } else {
                                                status.innerHTML = `<p class='help is-danger'>Need ${message}</p>`
                                                status.className = "text-yellow-500 font-bold"
                                            }
                                        }
                                    })

                                </script>

                                <div class="md:col-span-3">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" id="password"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" value="<?php if (isset($password))
                                            echo $password; ?>" />
                                    <div id="passwordStatus"></div>
                                </div>

                                


                                <div class="md:col-span-2">
                                    <label for="country">Club favori</label>
                                    <select
                                        class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1"
                                        name="club" required>
                                        <option selected disabled>Club</option>
                                        <?php
                                        foreach ($clubs as $key => $value) {
                                            echo "<option value='" . $value->getIdClub() . "'>" . $value->getNomClub() . '</option>';
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="">Photo de profil
                                        (optionnel)</label>
                                    <span class="sr-only">Choisir une image</span>
                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-500 file:text-white
                        hover:file:bg-blue-600
                    " />
                                </div>

                                <div class="md:col-span-2">
                                    <label class="label">Sexe</label>
                                    <div class="flex space-x-5 mt-1">
                                        <label>
                                            <input type="radio" name="sexe" value="H" required>
                                            Homme
                                        </label>
                                        <label>
                                            <input type="radio" name="sexe" value="F" required>
                                            Femme
                                        </label>
                                    </div>
                                </div>

                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button
                                            type="submit"
                                            name="register"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>