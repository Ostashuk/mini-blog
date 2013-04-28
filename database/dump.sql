CREATE DATABASE IF NOT EXISTS messages 
        CHARACTER SET utf8
        COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS messages_list 
        (
            id_message INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            theme VARCHAR(50) NOT NULL,
            short_text VARCHAR(255) NOT NULL,
            full_text TEXT,
            creating_date TIMESTAMP NULL,
            editing_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                    ON UPDATE CURRENT_TIMESTAMP,
            id_author VARCHAR(30) NOT NULL,
            INDEX(editing_date)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS users
        (
            id_user INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            login VARCHAR(16) NOT NULL UNIQUE,
            password VARCHAR(32) NOT NULL,
            nickname VARCHAR(30) NOT NULL UNIQUE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
