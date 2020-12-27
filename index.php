<?php
include 'application/config.php';

$product = new Product();
$products = $product->getPublicList();
$accountConfig = new AccountConfig($account->account_config["ID"]);

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
    <link href="<?php echo $accountConfig->getCartStyle(); ?>" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal c-body">

    <nav id="header" class="fixed w-full z-10 top-0">
        <div id="progress" class="h-1 z-20 top-0" style="background:linear-gradient(to right, #4dc0b5 var(--scroll), transparent 0);"></div>
    </nav>
    <!--Container-->
    <div class="container w-full md:max-w-3xl mx-auto pt-10">

        <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal">

            <!--Title-->
            <div class="font-sans c-account-name">
                <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl"><?php echo $account->fields["NAME"]; ?></h1>
            </div>
            <div class="fgrid grid-cols-6 sm:grid-cols-6 md:grid-cols-6 xl:grid-cols-6 gap-3 ">
                <div class="c-menu">
                    <h1>Menú</h1>
                </div>
                <?php foreach ($products as $k => $v) {
                    $k =  explode("-", $k);
                    $k = $k[1]; ?>
                    <div class="c-container">
                        <div class="c-hero">
                            <p><?php echo $k; ?></p>
                        </div>
                        <?php foreach ($v as $row) { ?>
                            <div class="c-product">
                                <div class="c-info">
                                    <div class="c-name">
                                        <p><?php echo $row["NAME"]; ?></p>
                                    </div>
                                    <div class="c-description">
                                        <p><?php echo $row["DESCRIPTION"]; ?></p>
                                    </div>
                                </div>
                                <div class="c-price">
                                    <p><?php echo $row["PRICE"]; ?> €</p>
                                </div>
                            </div>
                        <?php } ?>
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
                            <h3 class="font-bold text-gray-900">Síguenos</h3>
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