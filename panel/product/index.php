<?php
include("../config/config.php");

$productFamilies = new ProductFamily();
$families = $productFamilies->getUserFamilies();

$familyCodesByUser = array();
foreach ($families as $family) {
    $familyCodesByUser[] = $family["CODE"];
}

$product = new Product();
$auxQuery = "";
if ($_GET["f"]) {
    $auxQuery = " AND FAMILY_CODE = '" . $_GET['f'] . "'";
} else {
    $auxQuery = " AND FAMILY_CODE IN ('" . implode("','", $familyCodesByUser) . "')";
}

$products = $product->getList($auxQuery);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos | Panel de control</title>
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
                                <h3 class="font-bold text-3xl"><?php echo $product->countActiveProducts(); ?> <span class="text-orange-500"><i class="fas fa-exchange-alt"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>

            <!--Divider-->
            <hr class="border-b-2 border-gray-400 my-8 mx-4">
            <div class="md:flex flex-row">
                <div class="sm:w-full lg:w-1/6 mr-2 justify-between" style="max-height: 300px; overflow: auto;">
                    <a href="?">
                        <div class="w-full p-2 bg-white shadow-xs mb-1 rounded flex <?php if ($_GET["f"] == "" || !$_GET["f"]) {
                                                                                        echo "bg-green-500 text-white";
                                                                                    } ?>">
                            TODO
                        </div>
                    </a>
                    <?php foreach ($families as $row) { ?>
                        <a href="?f=<?php echo $row["CODE"]; ?>">
                            <div class="w-full p-2 bg-white shadow-xs mb-1 rounded flex <?php if ($_GET["f"] == $row["CODE"]) {
                                                                                            echo "bg-green-500 text-white";
                                                                                        } ?>">
                                <?php echo $row["NAME"]; ?>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <div class="sm:w-full lg:w-5/6 flex flex-row flex-wrap flex-grow">
                    <a href="object.php">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-3">
                            Nuevo Plato
                        </button>
                    </a>
                    <?php foreach ($products as $row) { ?>
                        <div class="w-full shadow-md p-6 bg-white mb-1 rounded md:flex">
                            <div class="w-full flex">
                                <div class="h-full">
                                    <div class="rounded-full flex items-center justify-center" style="width: 100px; height: 100px; background-image: url('../../assets/img/<?php echo $user->id . "/" . $row["CODE"]; ?>.png'); background-position: center; background-size: cover;"></div>
                                </div>
                                <div class="md:flex w-full">
                                    <div class="ml-4 md:w-10/12">
                                        <h5 class="font-bold"><?php echo $row["NAME"]; ?></h5>
                                        <p class="my-2"><?php echo $row["INGREDIENTS"]; ?></p>
                                        <p class="font-bold mt-2"><?php echo $row["PRICE"]; ?> €</p>
                                    </div>
                                    <div class="ml-4 md:w-2/12">
                                        <a href="object.php?ID=<?php echo $row["ID"]; ?>">
                                            <button class="bg-gray-500 mt-2 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                Editar
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
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