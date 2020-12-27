<?php
include("../config/config.php");

$productFamilies = new ProductFamily();
$families = $productFamilies->getAccountFamilies();

$product = new Product();


if ($_GET["ID"]) {
    $id = $_GET["ID"];
    $productToEdit = $product->getObject($id);
} else {
    $productToEdit = "";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi carta</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@next/dist/tailwind.min.css" rel="stylesheet">
    <link href="../../assets/css/master.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/03a10de34c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../assets/js/main.js"></script>



</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <?php $template->renderPanelMenu(); ?>

    <!--Container-->
    <div class="container w-full mx-auto pt-20">

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <!--Console Content-->

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-600"><i class="fa fa-book-open fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Categorías</h5>
                                <h3 class="font-bold text-3xl"><?php echo $productFamilies->count(); ?> <span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-orange-600"><i class="fas fa-utensils fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">Productos</h5>
                                <h3 class="font-bold text-3xl"><?php echo $product->count(); ?> <span class="text-orange-500"><i class="fas fa-exchange-alt"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>

            <!--Divider-->
            <hr class="border-b-2 border-gray-400 my-8 mx-4">
            <div class="md:flex flex-row">
                <!-- component -->
                <form class="w-11/12 lg:w-6/12 bg-white rounded shadow-xl p-6" action="../php/productIn.php" method="POST" enctype="multipart/form-data" style="float: none; margin: 0 auto;">

                    <input type="text" class="hidden" value="<?php echo $id; ?>" name="ID">
                    <div class="flex">
                        <div class="w-6/12">
                            <div class="flex w-full items-center justify-center bg-grey-lighter">
                                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white" style="background-image: url('../../../assets/img/<?php echo $user->id . "/" . $productToEdit["CODE"]; ?>.png');background-position: center; background-size: cover;">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Subir una imagen</span>
                                    <input type='file' class="hidden" name="fileToUpload" id="fileToUpload" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-800 font-medium">Información del plato</p>
                    <div class="inline-block mt-2 w-1/2 pr-1">
                        <label class="hidden block text-sm text-gray-600" for="name">Nombre del plato</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="name" name="NAME" type="text" required="" value="<?php echo $productToEdit["NAME"]; ?>" placeholder="ej: Hamburguesa caprichosa" aria-label="Nombre">
                    </div>
                    <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                        <label class="hidden block text-sm text-gray-600" for="description">Eslogan del plato</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="description" name="DESCRIPTION" type="text" value="<?php echo $productToEdit["DESCRIPTION"]; ?>" required="" placeholder="ej: Para los amantes del bacon" aria-label="Descripción">
                    </div>
                    <div class="w-full md:w-1/3 mt-2 mb-6 md:mb-0">
                        <label class="text-gray-800 font-medium" for="grid-state">
                            Categoría
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="FAMILY_CODE" id="grid-state">
                                <?php foreach ($families as $row) { ?>
                                    <option value="<?php echo $row["CODE"]; ?>"><?php echo $row["NAME"]; ?></option>
                                <?php } ?>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class=" block text-sm text-gray-600" for="ingredients">Descripción de ingredientes</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="ingredients" name="INGREDIENTS" value="<?php echo $productToEdit["INGREDIENTS"]; ?>" type="text" required="" placeholder="ej: 180gr de carne de vacuno con una ligera cap..." aria-label="Ingredientes">
                    </div>
                    <div class="mt-2">
                        <label class=" block text-sm text-gray-600" for="price">Precio</label>
                        <input class="xs:w-3/12 m:w-3/12 lg:w-3/12 px-2 py-2 text-gray-700 bg-gray-200 rounded" id="price" name="PRICE" step=".01" value="<?php echo $productToEdit["PRICE"]; ?>" type="number" required="" placeholder="" aria-label="Precio">
                    </div>
                    <div class="mt-4">
                        <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" value="<?php if ($_GET["ID"]) {
                                                                                                                                        echo "Modificar plato";
                                                                                                                                    } else {
                                                                                                                                        echo "Crear plato";
                                                                                                                                    } ?>">
                    </div>
                    <div class="mt-4">
                        <a href="../php/delete.php?ID=<?php echo $productToEdit["ID"]; ?>" class="text-sm mt-2 text-grey-500 py-2 px-4">
                            Borrar
                        </a>
                    </div>

                </form>
            </div>


        </div>
        <!--/container-->

        <footer class="bg-white border-t border-gray-400 shadow">
            <div class="container max-w-md mx-auto flex py-8">

                <div class="w-full mx-auto flex flex-wrap">
                    <div class="flex w-full md:w-1/2 ">
                        <div class="px-8">
                            <h3 class="font-bold font-bold text-gray-900">About</h3>
                            <p class="py-4 text-gray-600 text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
                            </p>
                        </div>
                    </div>

                    <div class="flex w-full md:w-1/2">
                        <div class="px-8">
                            <h3 class="font-bold font-bold text-gray-900">Social</h3>
                            <ul class="list-reset items-center text-sm pt-3">
                                <li>
                                    <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Add social link</a>
                                </li>
                                <li>
                                    <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Add social link</a>
                                </li>
                                <li>
                                    <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Add social link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>



            </div>
        </footer>

        <script>
            /*Toggle dropdown list*/
            /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

            var userMenuDiv = document.getElementById("userMenu");
            var userMenu = document.getElementById("userButton");

            var navMenuDiv = document.getElementById("nav-content");
            var navMenu = document.getElementById("nav-toggle");

            document.onclick = check;

            function check(e) {
                var target = (e && e.target) || (event && event.srcElement);

                //User Menu
                if (!checkParent(target, userMenuDiv)) {
                    // click NOT on the menu
                    if (checkParent(target, userMenu)) {
                        // click on the link
                        if (userMenuDiv.classList.contains("invisible")) {
                            userMenuDiv.classList.remove("invisible");
                        } else {
                            userMenuDiv.classList.add("invisible");
                        }
                    } else {
                        // click both outside link and outside menu, hide menu
                        userMenuDiv.classList.add("invisible");
                    }
                }

                //Nav Menu
                if (!checkParent(target, navMenuDiv)) {
                    // click NOT on the menu
                    if (checkParent(target, navMenu)) {
                        // click on the link
                        if (navMenuDiv.classList.contains("hidden")) {
                            navMenuDiv.classList.remove("hidden");
                        } else {
                            navMenuDiv.classList.add("hidden");
                        }
                    } else {
                        // click both outside link and outside menu, hide menu
                        navMenuDiv.classList.add("hidden");
                    }
                }

            }

            function checkParent(t, elm) {
                while (t.parentNode) {
                    if (t == elm) {
                        return true;
                    }
                    t = t.parentNode;
                }
                return false;
            }
        </script>

</body>

</html>