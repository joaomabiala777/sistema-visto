CREATE DATABASE visto_db;
USE visto_db;


CREATE TABLE usuario (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
usertype VARCHAR(50)
);

INSERT INTO usuario(id, username, password, usertype) VALUES (1,'admin','1234','admin');

CREATE TABLE tbagenda (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL,
data_Nasc VARCHAR(50),
sexo VARCHAR(50),
country VARCHAR(50),
entrada VARCHAR(50),
tipo VARCHAR(50),
foto VARCHAR(255),
estado ENUM('Pendente','Aprovado','Recusado') DEFAULT 'Pendente',
data_create date default (current_date),
FOREIGN KEY (id) REFERENCES usuario(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

CREATE TABLE tbvisto (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL,
data_Nasc VARCHAR(50),
sexo VARCHAR(50),
country VARCHAR(50),
entrada VARCHAR(50),
tipo VARCHAR(50),
foto VARCHAR(255),
data_create date,
data_exp date,
FOREIGN KEY (id) REFERENCES usuario(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);
