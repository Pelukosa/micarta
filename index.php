<?php
include 'application/config.php';

$productFamily = new ProductFamily();
$productFamilies = $productFamily->getHostFamilies();

$product = new Product();
$products = $product->getPublicList();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi carta</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav id="header" class="fixed w-full z-10 top-0">

        <div id="progress" class="h-1 z-20 top-0" style="background:linear-gradient(to right, #4dc0b5 var(--scroll), transparent 0);"></div>

        <div class="w-full md:max-w-4xl mx-auto flex flex-wrap items-center justify-between mt-0 py-3">

            <div class="pl-4">
                <a class="text-gray-900 text-base no-underline hover:no-underline font-extrabold text-xl" href="#">

                </a>
            </div>

            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-100 md:bg-transparent z-20" id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <?php foreach ($productFamilies as $row) { ?>
                        <li class="mr-3">
                            <a class="inline-block py-2 px-4 text-gray-900 font-bold no-underline" href="#"><?php echo $row["NAME"]; ?></a>
                        </li>
                    <?php } ?>
                    <li class="mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-2 px-4" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Container-->
    <div class="container w-full md:max-w-3xl mx-auto pt-20">

        <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal"">

            <!--Title-->
            <div class=" font-sans">
            <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">Hamburguesería</h1>
            <p class="text-sm md:text-base font-normal text-gray-600">Actualizada 27 de ocubre de 2020</p>
        </div>
        <?php if ($user->showFamilyIcons()) { ?>
            <div class="grid grid-cols-6 sm:grid-cols-6 md:grid-cols-6 xl:grid-cols-6 gap-3 ">
                <?php foreach ($productFamilies as $row) { ?>
                    <div class="flex flex-col items-center justify-center bg-white p-3 shadow rounded-lg">
                        <img src="assets/icons/<?php echo $row["ICON"]; ?>.svg" alt="">
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="fgrid grid-cols-6 sm:grid-cols-6 md:grid-cols-6 xl:grid-cols-6 gap-3 ">
            <?php foreach ($products as $row) { ?>
                <div class="flex flex-col justify-center items-center max-w-sm mx-auto my-8">
                    <div style="background-image: url('assets/img/<?php echo $user->id . "/" . $row["CODE"]; ?>.png')" class="bg-gray-300 h-64 w-full rounded-lg shadow-md bg-cover bg-center"></div>
                    <div class="w-10/12 md:w-64 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden">
                        <div class="py-2 text-center font-bold uppercase tracking-wide text-2x1 text-gray-900"><?php echo $row["NAME"]; ?></div>
                        <div class="flex items-center justify-between py-2 px-3 bg-gray-200">
                            <p class="py-4 text-gray-600 text-sm">
                                <?php echo $row["INGREDIENTS"]; ?>
                            </p>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!--Divider-->
        <hr class="border-b-2 border-gray-400 mb-8 mx-4">

    </div>
    <!--/container-->

    <footer class="bg-white border-t border-gray-400 shadow">
        <div class="container max-w-4xl mx-auto flex py-8">

            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full md:w-1/2 ">
                    <div class="px-8">
                        <h3 class="font-bold text-gray-900">Nuestro restaurante</h3>
                        <p class="py-4 text-gray-600 text-sm">
                            Dispone de información sobre alérgenos, y todos nuestros productos
                        </p>
                    </div>
                </div>

                <div class="flex w-full md:w-1/2">
                    <div class="px-8">
                        <h3 class="font-bold text-gray-900">Síguenos!</h3>
                        <ul class="list-reset items-center text-sm pt-3">
                            <li>
                                <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Instagram</a>
                            </li>
                            <li>
                                <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Facebook</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>



        </div>
    </footer>

    <script>
        /* Progress bar */
        //Source: https://alligator.io/js/progress-bar-javascript-css-variables/
        var h = document.documentElement,
            b = document.body,
            st = 'scrollTop',
            sh = 'scrollHeight',
            progress = document.querySelector('#progress'),
            scroll;
        var scrollpos = window.scrollY;
        var header = document.getElementById("header");
        var navcontent = document.getElementById("nav-content");

        document.addEventListener('scroll', function() {

            /*Refresh scroll % width*/
            scroll = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
            progress.style.setProperty('--scroll', scroll + '%');

            /*Apply classes for slide in bar*/
            scrollpos = window.scrollY;

            if (scrollpos > 10) {
                header.classList.add("bg-white");
                header.classList.add("shadow");
                navcontent.classList.remove("bg-gray-100");
                navcontent.classList.add("bg-white");
            } else {
                header.classList.remove("bg-white");
                header.classList.remove("shadow");
                navcontent.classList.remove("bg-white");
                navcontent.classList.add("bg-gray-100");

            }

        });


        //Javascript to toggle the menu
        document.getElementById('nav-toggle').onclick = function() {
            document.getElementById("nav-content").classList.toggle("hidden");
        }
    </script>

</body>

</html>