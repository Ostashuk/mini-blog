<?php

/**
 * Клас для роботи з url
 * 
 * @author Andriy Ostashuk
 */
class Request{
    /**
     * Містить компоненти url
     * @var array 
     */
    private $_components;
    /**
     * Конструктор
     * Розбиває url на компоненти
     * @param string $url
     */
    public function __construct($url){
        $this->_components = parse_url($url);
    }
    /**
     * Повератє протокол url, наприклад http://
     * @return string Протокол url
     * @return null Якщо прокол не вказаний
     */
    public function getScheme(){
        if(isset($this->_components["sheme"])){
            return $this->_components["scheme"];
        }else{
            return null;
        }
    }
    /**
     * Повератє хост url, наприклад www.example.com
     * @return string Хост url
     * @return null Якщо хост не вказаний
     */
    public function getHost(){
        if(isset($this->_components["host"])){
            return $this->_components["host"];
        }else{
            return null;
        }
    }
    /**
     * Повератє порт url, наприклад 8080
     * @return int Порт url
     * @return null Якщо Порт не вказаний
     */
    public function getPort(){
        if(isset($this->_components["port"])){
            return (int)$this->_components["port"];
        }else{
            return null;
        }
    }
    /**
     * Повератє користувача, який вказаний в url
     * @return string Користувач
     * @return null Якщо корстувач не вказаний
     */
    public function getUser(){
        if(isset($this->_components["user"])){
            return $this->_components["user"];
        }else{
            return null;
        }
    }
    /**
     * Повератє пароль користувача в url
     * @return int Пароль
     * @return null Якщо пароль не вказаний
     */
    public function getPass(){
        if(isset($this->_components["pass"])){
            return (int)$this->_components["pass"];
        }else{
            return null;
        }
    }
    /**
     * Повертає масив з елементами шляху url
     * @return array Массив з елементами шляху
     * @return null Якщо шлях не вказаний
     */
    public function getPath(){
        if(isset($this->_components["path"])){
            $elements = explode("/", $this->_components["path"]);
            return $elements;
        }else{
            return null;
        }
    }
    /**
     * Повертає асоціативний масив з елементів запиту url
     * наприклад ?controller=action виглядатиме array("controller" => "action")
     * @return array Асоціативний масив елементів запиту
     * @return null Якщо запит відсутній
     */
    public function getQuery(){
        if(isset($this->_components["query"])){
            $elements = explode("&", $this->_components["query"]);
            foreach($elements as $index => $element){
                unset($elements["$index"]);
                $element = explode("=", $element);
                $elements[$element["0"]] = isset($element["1"]) ? $element["1"] : $element["0"];
            }
            return $elements;
        }else{
            return null;
        }
    }
    /**
     * Повертає асоціативний масив з елементів фрагменту url
     * наприклад #controller=action виглядатиме array("controller" => "action")
     * @return array Асоціативний масив елементів фрагмента
     * @return null Якщо запит відсутній
     */
    public function getFragment(){
        print_r($this->_components["fragment"]);
        die("in frag");
        if(isset($this->_components["fragment"])){
            
            $elements = explode("&", $this->_components["fragment"]);
            foreach($elements as $index => $element){
                
                unset($elements["$index"]);
                $element = explode("=", $element);
                $elements[$element["0"]] = isset($element["1"]) ? $element["1"] : $element["0"];
            }
            return $elements;
        }else{
            return null;
        }
    }
}

