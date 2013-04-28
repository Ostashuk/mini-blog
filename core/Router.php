<?php

/**
 * Маршрутизатор
 *
 * @author Andriy Ostashuk
 */
class Router{
    /**
     * Метод, який перенаправляє користувача на вказаний в url шлях
     * @param Request $r Обєкт класу, який обро,ляє url(по замовчуванюю NULL)
     */
    public static function route(Request $r = null){
        //Якщо параметр явно не вказаний, створюєм обєкт класудля роботи з url
        //передаючи йому запит з url, наприклад /index.php?controller=action
        if(is_null($r)){
            $r = new Request($_SERVER["REQUEST_URI"]);
        }
        //Отримуєм елементи шляху в url
        $routes = $r->getPath();
        
        //Визначаєм імя контроллера і екшена,
        if(isset($routes["1"])  && isset($routes["2"])){
            $controller = $routes["1"];
            $action = $routes["2"];
        }else{
            $controller = "message";
            $action = "list";
        }
        
        //Добавляємо суфікси
        $controller = ucfirst(strtolower($controller)) . 'Controller';
        $action = strtolower($action) . 'Action';
        
        //Перевірям наявність контроллера
        if(file_exists($controller)){
            //Створюєм обєкт контроллера
            $controller = new $controller;
            //Перевіряєм наявність метода
            if(method_exists($controller, $action)){
                if(isset($routes["3"]) && is_numeric($routes["3"])){
                    $controller->$action($routes["3"]);
                }else{
                    $controller->$action();
                }
            }else{
                $view = new View();
                $view->generate("not_found", array("description" => "Виконання дії неможливе"));
            }
        }else{
            $view = new View();
            $view->generate("not_found", array("description" => "Файл не знайдено"));
        }       
    }
}

