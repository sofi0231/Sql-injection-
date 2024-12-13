CREATE DATABASE IF NOT EXISTS db; /* Se non esiste creo il db*/
USE db;

CREATE TABLE IF NOT EXISTS users ( /* Se non esiste creo la tabella users*/
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('root', 'root'); /* Aggiungo utente root*/
