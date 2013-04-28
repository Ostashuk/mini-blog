<?php

/**
 * Клас для роботи з sql
 *
 * @author Andriy Ostashuk
 */

class Sql{

    /**
     * Локальна копія обєкту класу
     * @var Sql 
     */
    private static $_database;
    
    /**
     * Обєкт, що прдеставляє зєднання з MySQL
     * @var mysqli  
     */
    private $_link;
    

    /**
     * Конструктор
     * Виконує зєднання з БД
     */
    private function __construct(){
        $this->_link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    }
    
    /**
     * Перевіряє існування обєкту класу
     * Якщо він існує, метод його повертає
     * @return Sql
     */
    public static function getInstance() {    
        if (is_null(self::$_database)) {
            self::$_database = new Database();
        }
        return self::$_database;
    }
             
    /**
     * Надсилає запит в БД
     * Повертає результат виконання запиту
     * @param string $sqlQuery Sql запит
     * @return mixed Результат виконання запиту  
     */
    public function query($sqlQuery){
            return mysqli_query($this->_link, $sqlQuery);
    }
    
    /**
     * Повертає опис останньої помилки при роботі з БД
     * @return string
     */
    public function error(){
        return mysqli_error($this->_link);
    }
}

