<?php

/**
 * Description of Model
 *
 * @author Fake
 */
class Model {
    
    protected $_database;
    protected $_messagesTable = "messages_list";
    protected $_usersTable = "users";
    protected function __construct() {
        $this->_database = Database::getInstance();
    }
}

