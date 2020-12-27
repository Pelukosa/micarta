<?php
include("../../config/config.php");

if (!empty($_POST)) {
    $account->storePost($_POST);
}
?>

<!DOCTYPE html>
<html lang="es">

<?php $template->renderHeadPanel("Estilo de carta"); ?>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <?php $template->renderPanelMenu(); ?>

    <!--Container-->
    <div class="container w-full mx-auto pt-20">

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <div class="grid grid-cols-6 gap-4">
                <?php echo Template::renderAccountNav("settings"); ?>
                <div class="col-span-5 p-5 bg-white">
                    <div class="grid grid-cols-1 gap-4 flex ">
                        <div class="w-100 flex content-center">
                            <form class="w-full max-w-2xl" action="index.php?cmd=saved" method="POST">
                                <div class="w-100 inline-block">
                                    <?php echo Form::renderSavebutton(); ?>
                                    <?php if (!empty($_POST)) { ?>
                                        <p id="saved" class="py-2 px-4 text-gray-400 italic float-left">Guardado !</p>
                                    <?php } ?>
                                </div>
                                <hr class="border-b-1 w-100 border-gray-200 my-4">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="local-name">
                                            Nombre de mi local
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="local-name" name="name" type="text" placeholder="MacLaren's restaurant" value="<?php echo $account->fields["NAME"]; ?>">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="local-slogan">
                                            Eslogan
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="local-slogan" name="slogan" type="text" placeholder="Sabor a parrilla" value="<?php echo $account->fields["SLOGAN"]; ?>">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="local-address">
                                            Dirección de mi local
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="local-address" name="address" type="text" placeholder="C/ Bodegas reales 111" value="<?php echo $account->fields["ADDRESS"]; ?>">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-5 mb-2">
                                    <div class="w-full md:w-2/5 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="local-city">
                                            Población
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="local-city" name="city" type="text" placeholder="Barcelona" value="<?php echo $account->fields["CITY"]; ?>">
                                    </div>
                                    <div class="w-full md:w-2/5 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="local-county">
                                            Provincia
                                        </label>
                                        <div class="relative">
                                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="local-county" name="county">
                                                <option>Seleccionar</option>
                                                <?php foreach (App::getCounties() as $k => $v) { ?>
                                                    <option <?php if ($account->fields["COUNTY"] == $k) {
                                                                echo "selected";
                                                            } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="local-postalcode">
                                            Código postal
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="local-postalcode" name="phone" type="number" placeholder="08025" value="<?php echo $account->fields["POSTAL_CODE"]; ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    </div>
</body>

</html>