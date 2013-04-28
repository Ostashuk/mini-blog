<?php

/**
 * Description of MessagesModel
 *
 * @author Andriy Ostashuk  
 * @package Messages
 * @subpackage Models
 */
class MessageModel extends Model{
    /**
     * Зберігає повідомлення в БД
     * @param string $theme
     * @param string $text
     * @return boolean
     */
    public function saveMessage($theme, $shortText, $text){
        $sqlQuery = "INSERT INTO $this->_messageTable(theme, short_text, full_text, creating_date))
            VALUES('$theme', '$shortText', '$text', NOW())";
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return FALSE;
        }
        return TRUE;        
    }
    /**
     * Редагує повідомлення в БД
     * @param int $messageId
     * @param string $theme
     * @param string $shorText
     * @param string $text
     * @return boolean
     */
    public function updateMessage($messageId, $theme, $shortText, $text){
        $sqlQuery = "UPDATE $this->_table 
            SET theme='$theme', short_text='$shortText', text='$text'
            WHERE id_message='" . (int)$messageId . "'";
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return FALSE;
        }
        return TRUE;
    }
    /**
     * Видалаяє повідомлення з БД
     * @param int $messageId
     * @return boolean
     */
    public function deleteMessage($messageId){
        $sqlQuery = "DELETE FROM $this->_table
            WHERE id_message='" . (int)$messageId . "'";
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return FALSE;
        }
        return TRUE;
    }
    /**
     * Витягує кілька повідомлень з БД
     * @param int $startIndex
     * @param int $endIndex
     * @param string $sortBy 
     * @return null
     * @return array 
     */
    public function getMessages($startIndex = null, $endIndex = null, $sortBy = "editing_date"){
        $sqlQuery = "SELECT theme, short_text, editing_date, id_author, nickname
            FROM $this->_messagesTable
            LEFT JOIN $this->_usersTable ON messages_list.id_author = users.id_user
            ORDER BY $sortBy";
        if(empty($startIndex) && empty($endIndex)){
            $sqlQuery .= " LIMIT " . (int)$startIndex . "," . (int)$endIndex;
        }
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return NULL;
        }
        $messages = array();
        while($message = mysqli_fetch_array($result)){
            $messages[] = $message;
        }
        return $messages;
    }
    /**
     * Витягує одне повідомлення
     * @param int $messageId
     * @return null 
     * @return array 
     */
    public function getMessage($messageId){
        $sqlQuery = "SELECT theme, full_text, editing_date, id_author, nickname
            FROM $this->_messagesTable
            LEFT JOIN $this->_usersTable ON messages_list.id_author = users.id_user
            WHERE id_message='" . (int)$messageId . "'";
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return NULL;
        }
        $message = mysqli_fetch_array($result);
        return $message;
        
    }
    /**
     * Рахує кількість повідомлень в БД
     * @return null
     * @return int 
     */
    public function countMessages(){
        $sqlQuery = "SELECT COUNT(id_message) FROM $this->_messagesTable";
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return null;
        }
        $count = mysqli_fetch_field($result);
        return $count;
    }
}
