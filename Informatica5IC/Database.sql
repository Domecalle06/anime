CREATE DATABASE IF NOT EXISTS Database_callea;
USE Database_callea;

CREATE TABLE IF NOT EXISTS Utente
(
    IdUtente INT NOT NULL AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL DEFAULT "",
    Password VARCHAR(50) NOT NULL DEFAULT "",
    PRIMARY KEY (IdUtente)
);

INSERT INTO Utente (Username, Password) VALUES
('admin','abc')