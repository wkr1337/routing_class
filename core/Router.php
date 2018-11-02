<?php 

class Router {
    /**
     * 
     * set the controller to the first part of the url and make the first letter upper case
     * set the method to the second part of the url and add Action to it.
     * set the params to the remaining part of the url
     * 
     * If the controller and method exists it will call the given method with the given parameters
     * so ie for the url: newMVC/home/index/henk/10/12
     * "Home" will become the controller
     * "indexAction" will become the method 
     * ["henk", "10", "12"] are the parameters
     * 
     */
    public static function route($url) {
        // set controller to the first item of the url if none given, set default controller
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]): DEFAULT_CONTROLLER;
        $controller_name = $controller;
        array_shift($url);

     
        // action 
        $action = (isset($url[0]) && $url[0] != '') ? $url[0]: 'index';
        array_shift($url);


        // params
        $queryParams = $url;
        
        // this calls the method of the controller class if it exists.
        if (method_exists($controller, $action)) {
            $dispatch = new $controller($controller, $action);
            call_user_func_array([$dispatch, $action], $queryParams);
        } else {
            die('That method does not exist in the controller \"' . $controller_name . '\"');
        }
    }

    public static function redirect($location) {
        $location = implode(DS,explode('/', $location));
        if(!headers_sent()) {
            header('Location: '.PROOT.$location);
            exit();
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.PROOT.$location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
            echo '</noscript>'; exit;
        }
    }
}