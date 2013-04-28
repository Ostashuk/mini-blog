<?php

/**
 * Description of MessageHelper
 *
 * @author Fake
 */
class MessageHelper{
    /**
     * Фільтрує текст для БД і відображення в шаблонах
     * @param type $text
     * @return type
     */
    public function filterText($text){
        $text = mysqli_real_escape_string(htmlspecialchars($text));
        return $text;
    }
    /**
     * Обрізає текст для короткого опису
     * @param string $text
     * @return string
     */
    public function cutToShort($text){
        $length = strlen($text);
        $short = $length > 255 ? substr($text, 0, 252) . "..." : $text;
        return $short;
    }
    //public function antiMat($text){
    //    $mats = array("");
    //}
    
}
