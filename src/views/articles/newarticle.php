<?php

if (!isset($_SESSION['UserInfo'])) {
    header("Location: /login");
}

$message;

if (isset($_POST['newarticle'])) {

    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];
    $autor = $_SESSION['UserInfo']->id;
    $image = $_FILES['image']['name'];

    define('PATH', './assets/articles/'); // Repertoire cible

    if (isset($image) and !empty($image)) {
        $tabExt = array('jpg', 'gif', 'png', 'jpeg'); // Extensions autorisees
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $temp_name = $_FILES['image']['tmp_name'];

        if (in_array(strtolower($extension), $tabExt)) {
            $nomImage = md5(uniqid()) . '.' . $extension;
            $image = PATH . $nomImage;

        }
    } else
        $image = PATH . "defaultuser.png";

    $newArticle = new Article(0, $title, $content, $autor, $image);
    if($articleController->newArticle($newArticle)) {
        move_uploaded_file($temp_name, $image);
        header('Location: /articles');
    }

    $message = "error";


}


?>

<div class="h-screen w-full flex justify-center items-center">
    <form method="POST" class="w-full flex justify-center items-center" enctype="multipart/form-data">
        <div class="w-[80%] md:w-[50%] shadow-2xl border border-slate-200 p-3 rounded-md space-y-5">
            <h1 class="text-2xl font-bold">Rédaction d'un article</h1>
            <div class="space-y-5">
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Titre</label>
                    <input placeholder="Titre" pattern="[A-Za-z]{2,30}" value="<?php if (isset($nom))
                        echo $nom; ?>"
                        name="title"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Contenu</label>
                    <textarea required name="content" pattern="[A-Za-z]{2,30}" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Le football il a changé..."></textarea>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Image (optionnel)</label>
                    <span class="sr-only">Choisir une image</span>
                    <input 
                    type="file" 
                    name="image"
                    accept=".png, .jpg, .jpeg"
                    class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-500 file:text-white
                        hover:file:bg-blue-600
                    " />
                </div>

                <button 
                type="submit"
                name="newarticle"
                class="text-white bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>


            </div>

            <div>
                <p class="text-red-500 font-bold"> <?php echo $message; ?> </p>
            </div>
        </div>
    </form>

</div>