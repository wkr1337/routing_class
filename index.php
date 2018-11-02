<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

// load configuration and loader functions first
require_once(ROOT . DS . 'config' . DS . 'config.php');


function dnd($dump) {
    echo '<pre>'; 
    var_dump($dump);
    echo '</pre>';
    die();
}

// autoload classes
function autoload($className) {
    if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')) {
        

        require_once(ROOT . DS . 'core' . DS . $className . '.php');
    } elseif(file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
    } elseif(file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
    }
}
// calls the function autoload
spl_autoload_register('autoload');

session_start();
if(!isset($_SESSION['logged_in'])) $_SESSION['logged_in'] = false;
// make array from url and trim off the / if no url given set url to array.
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
//  Route the request 
dnd($url);

Router::route($url);