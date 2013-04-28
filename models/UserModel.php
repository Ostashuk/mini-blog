<?php
/**
 * Description of UserModel
 *
 * @author Fake
 */
class UserModel extends Model{
    /**
     * Добавляє корисутвача в БД
     * @param string $login
     * @param string $password
     * @param string $nickname
     * @return boolean
     */
    public function addUser($login, $password, $nickname){
        $sqlQuery = "INSERT INTO $this->_usersTable(theme, password, nickname)
                VALUES('$login', '$password', '$nickname')";
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return FALSE;
        }
        return TRUE;
    }
    /**
     * Витягує користувача з БД
     * @param string $login
     * @param string $password
     * @return null
     * @return array 
     */
    public function getUser($login, $password){
        $sqlQuery = "SELECT id_user, nickname FROM $this->_usersTable
                WHERE login='$login' AND password='$password'";
        $result = $this->_database->query($sqlQuery);
        if(empty($result)){
            return NULL;
        }
        $user = mysqli_fetch_array($result);
        return $user;
    }
}

