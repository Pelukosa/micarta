<?php
include("../config/config.php");

$productfamilies = new ProductFamily();
$product = new Product();
$userProductFamilies = $productfamilies->getAccountFamilies();
$families = $productfamilies->getList(" AND ID NOT IN ('" . implode("','", array_keys($userProductFamilies)) . "') ORDER BY NAME");
?>

<!DOCTYPE html>
<html lang="es">

<?php $template->renderHeadPanel($productfamilies->_realPluralName); ?>

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
                                <h3 class="font-bold text-3xl count-active-families"><?php echo $productfamilies->count(); ?> <span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
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
            <hr class="border-b-1 border-gray-400 my-8 mx-4">
            <div class="md:flex p-3">
                <div class="sm:w-100">
                    <h3 class="font-bold text-gray-900 text-2xl mr-2 p-2">Mis categorías activas</h3>
                </div>
                <div class="relative pull-right pl-4 pr-4 md:pr-0">
                    <input type="search" placeholder="Buscar" class="w-full bg-gray-100 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                        <svg class="fill-current pointer-events-none text-gray-800 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </div>
                <div style="float: right;">
                    <button onclick="location.reload()" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mr-2 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                        Guardar
                    </button>
                </div>
                <p id="save-text" class="font-bold text-green-500 align-middle p-3" style="display: none;">Guardado!</p>
            </div>
            <form action="index.php" method="POST">
                
            </form>
            <div class="flex flex-row flex-wrap flex-grow mt-2">
                <?php foreach ($userProductFamilies as $row) { ?>
                    <div class="m-3">
                        <button class="familie bg-white text-gray-500 font-bold rounded border-b-2 border-green-500 shadow-md py-2 px-6 inline-flex items-center panel-category panel-category-active" id="<?php echo $row["CODE"]; ?>">
                            <span class=" mr-2"><?php echo $row["NAME"]; ?> </span>
                            <img class="icon-category" src="../../assets/icons/<?php echo $row["ICON"]; ?>.svg" alt="<?php echo $row["NAME"]; ?>">
                        </button>
                    </div>
                <?php } ?>

            </div>

            <hr class="border-b-1 border-gray-400 my-8 mx-4">

            <div class="flex flex-row flex-wrap flex-grow mt-2">
                <?php foreach ($families as $row) { ?>
                    <div class="m-3">
                        <button class="familie bg-white text-gray-500 font-bold rounded border-b-2 border-green-500 shadow-md py-2 px-6 inline-flex items-center panel-category" id="<?php echo $row["CODE"]; ?>">
                            <span class=" mr-2"><?php echo $row["NAME"]; ?> </span>
                            <img class="icon-category" src="../../assets/icons/<?php echo $row["ICON"]; ?>.svg" alt="<?php echo $row["NAME"]; ?>">
                        </button>
                    </div>
                <?php } ?>
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