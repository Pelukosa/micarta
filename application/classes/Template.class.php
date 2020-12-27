<?php

class Template
{

    public static function renderPanelMenu()
    {
        $ret = require  $_SERVER['DOCUMENT_ROOT'] . "/application/templates/panel/menu.php";
        return $ret;
    }

    public static function renderProductsStats()
    {
        $ret = require  $_SERVER['DOCUMENT_ROOT'] . "/application/templates/panel/products-stats.php";
        return $ret;
    }

    public static function renderHeadPanel($name)
    {
        $ret = "<head>";
        $ret .= '<meta charset="UTF-8">';
        $ret .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $ret .= '<meta http-equiv="X-UA-Compatible" content="ie=edge">';
        $ret .= '<title>' . $name . ' | Panel de control</title>';
        $ret .= '<meta name="description" content="description here">';
        $ret .= '<meta name="keywords" content="keywords,here">';
        $ret .= '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">';
        $ret .= '<link href="https://unpkg.com/tailwindcss@next/dist/tailwind.min.css" rel="stylesheet">';
        $ret .= '<link href="' . App::getHost() . '/assets/css/master.css" rel="stylesheet">';
        $ret .= '<script src="https://kit.fontawesome.com/03a10de34c.js" crossorigin="anonymous"></script>';
        $ret .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>';
        $ret .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
        $ret .= '<script src="' . App::getHost() . '/assets/js/main.js"></script>';
        echo $ret;
    }

    public static function renderAccountNav($active = false) {
        $activeStyle = "bg-green-300";
        if ($active == "summary") {
            $summary = $activeStyle;
        }
        else if ($active == "settings") {
            $settings = $activeStyle;
        }
        else if ($active == "menu") {
            $menu = $activeStyle;
        }
        else if ($active == "security") {
            $security = $activeStyle;
        }
        else if ($active == "contact") {
            $contact = $activeStyle;
        }

        $ret = '<div class="col-span-1 bg-white">';
        $ret .= '<div class="">';
        $ret .= '<ul class="list-reset">';
        $ret .= '<li><p class="block p-4 text-grey-darker border-purple hover:bg-grey-lighter border-r-4">Boxes</p></li>';
        $ret .= '<li class="border-b-2 border-black-500 hover:bg-green-100 '.$summary.'">';
        $ret .= '<a href="' . App::getHost() . '/panel/profile" class="block p-4 text-grey-darker font-bold border-purple hover:bg-grey-lighter border-r-4">Resumen</a></li>';
        $ret .= '<li class="border-b-2 border-black-500 hover:bg-green-100 '.$settings.'">';
        $ret .= '<a href="' . App::getHost() . '/panel/profile/settings" class="block p-4 text-grey-darker font-bold border-purple hover:bg-grey-lighter border-r-4">Preferencias</a></li>';
        $ret .= '<li class="border-b-2 border-black-500 hover:bg-green-100 '.$menu.'">';
        $ret .= '<a href="' . App::getHost() . '/panel/profile/menu" class="block p-4 text-grey-darker font-bold border-purple hover:bg-grey-lighter border-r-4">Estilo de carta</a></li>';
        $ret .= '<li class="border-b-2 border-black-500 hover:bg-green-100 '.$security.'">';
        $ret .= '<a href="' . App::getHost() . '/panel/profile/security" class="block p-4 text-grey-darker font-bold border-purple hover:bg-grey-lighter border-r-4">Seguridad</a></li>';
        $ret .= '<li class="border-b-2 border-black-500 hover:bg-green-100 '.$contact.'">';
        $ret .= '<a href="' . App::getHost() . '/panel/profile/contact" class="block p-4 text-grey-darker font-bold border-purple hover:bg-grey-lighter border-r-4">Contacto</a></li>';
        $ret .= '</ul></div></div>';
        
        echo $ret;
                
    }

    public static function renderInputButton() {
        $ret = '<div id="ck-button"><label>';
        $ret .= '<input type="checkbox" value="1"><span>Guardar</span>';
        $ret .= '</label></div>';

        echo $ret;
    }

}
