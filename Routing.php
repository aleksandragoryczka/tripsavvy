<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';

class Routing{
    public static $routes; // tablica przechowyjaca url i sciezke kontorlera, ktory zostanie otwarty

    //metoda, ktora pozowli wstawic do tablicy $routes wstawic odpoweidni kontorler przydzielony do odpoweidniego urla
    public static function get($url, $controller){
        self::$routes[$url] = $controller;
    }


    public static function post($url, $controller){
        self::$routes[$url] = $controller;
    }

    //metoda, ktora uruchomi kontroler przypisany pod dany url
    public static function run($url){
        $action = explode("/", $url)[0];

        if(!array_key_exists($action, self::$routes)){
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $object->$action();
        
    }
}