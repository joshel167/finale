<?php

define('ROOT', dirname(__DIR__));
define('APP', __DIR__);
define('PUB', ROOT . DIRECTORY_SEPARATOR . 'public');
define('VIEWS', APP . DIRECTORY_SEPARATOR . 'views');
define('MODELS', APP . DIRECTORY_SEPARATOR . 'models');
define('CONTROLLERS', APP . DIRECTORY_SEPARATOR . 'controllers');

require '../vendor/autoload.php';
require ROOT . DIRECTORY_SEPARATOR . 'secret.php';


function autoloadController($class)
{
    $file = CONTROLLERS . DIRECTORY_SEPARATOR . $class . ".php";
    if (file_exists($file)){
        require $file;
    }


}function autoloadModel($class)
{

    $file = MODELS . DIRECTORY_SEPARATOR . $class . ".php";
    if (file_exists($file)) {
        require $file;
    }
}function autoloadView($class)
{

    $file = VIEWS . DIRECTORY_SEPARATOR . $class . ".php";
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('autoloadController');
spl_autoload_register('autoloadModel');
spl_autoload_register('autoloadView');

function view(string $dir, string $view, array $data){
    $loader = new \Twig\Loader\FilesystemLoader(VIEWS . DIRECTORY_SEPARATOR. $dir );
    $twig = new \Twig\Environment($loader, []);
    $template = $twig->load($view .'html');
    echo $template->render($data);
}
