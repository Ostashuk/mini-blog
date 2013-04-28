<?php

/**
 * Description of UserHepler
 *
 * @author Andriy Ostashuk
 */
class UserHepler{
    /**
     * Масив містить помилки, виникнувші при перевірці даних корисутвача
     * @var array  
     */
    private $_errors = array();
    /**
     * Перевірка правильності введення e-mail
     * @param string $mail
     * @return boolean
     */
    public function isValidEmail($mail){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            return TRUE;
        }else{
            $this->_errors["mail"] = "Неправильно введений e-mail";
            return FALSE;
        }
    }
    /**
     * Перевірка правильності введення нікнейму
     * @param string $nickname
     * @return boolean
     */
    public function isValidNickname($nickname){
        $length = strlen($nickname);
        if($length < 3 || $length > 30){
            $this->_errors["nickname"] = "Не менше 3 і не більше 30 символів";
            return FALSE;
        }
        return TRUE;
    }
    /**
     * Перевірка правильності введення паролю
     * @param string $pass
     * @return boolean
     */
    public function isValidPassword($pass){
        $length = strlen($pass);
        if($length < 6){
            $this->errors["password"] = "Не менше 6 символів";
            return FALSE;
        }
        return TRUE;
    }
    /**
     * Повертає помилки виникнувші під час валідації
     * @return array
     */
    public function getErrors(){
        return $this->_errors;
    }
    /**
     * Фільтрація тексту для БД і відображення в шаблонах
     * @param string $text
     * @return string
     */
    public function filterText($text){
        $text = mysqli_real_escape_string(htmlspecialchars($text));
        return $text;
    }
    /**
     * Запускає сесію і встановлює дані передані в параметрах
     * @param string $nickname 
     * @param int $idUser 
     */
    public function startSession($nickname, $userId){
        session_start();
        $_SESSION["nickname"] = $nickname;
        $_SESSION["id_user"] = $idUser;
    }
    /**
     * Завершує сесію
     */
    public function endSession(){
        session_unset();
    }
    /**
     * Встановлює куки 
     * @param string $mail E-mail користувача
     * @param string $pass Пароль користувача
     */
    public function setCookie($mail, $pass){
        $time = 24*60*60;
        setcookie("mail", $mail, time()+$time, "/");
        setcookie("pass", $pass, time()+$time, "/");
    }
    /**
     * Очищає куки
     */
    public function unsetCookie(){
        $time = -1;
        setcookie("mail", "", time()+$time, "/");
        setcookie("pass", "", time()+$time, "/");
    }
    /**
     * Шифрує пароль
     * @param string $pass
     * @return string
     */
    public function encryptPassword($pass){
        $salt = CRYPT_BLOWFISH;
        $pass = crypt($pass, $salt);
        return $pass;
    }
    
}
