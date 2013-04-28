<?php

//url сайту
define("WEB_ROOT", $_SERVER["HTTP_HOST"] . $_SERVER["SERVER_NAME"]);
//розділювач шляху
define("DS", DIRECTORY_SEPARATOR);
//коренева папка сайту
define("ROOT", dirname(dirname(__FILE__)));

//встановлюєм шлях до основний папок сайту
define("CONTROLLERS", ROOT . DS . "controllers" . DS);
define("MODELS", ROOT . DS . "models" . DS);
define("CORE", ROOT . DS . "core" . DS);
define("HELPERS", ROOT . DS . "helpers" . DS);
define("TEMPLATES", ROOT . DS . "templates" . DS);

//вказуєм папки пошуку файлів
set_include_path(
        CONTROLLERS . PATH_SEPARATOR . 
        MODELS  . PATH_SEPARATOR . 
        HELPERS . PATH_SEPARATOR .
        CORE);

function __autoload($className) {
    require_once $className . ".php";
}

//перевіряємо опцію для показу всіх помилок під час виконання програми
if(SHOW_ERRORS){
    error_reporting(E_ALL);
    ini_set("display_errors", "on");
}