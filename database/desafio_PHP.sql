CREATE DATABASE desafio_PHP;

USE desafio_PHP;

CREATE TABLE produtos(
	id INT(4) AUTO_INCREMENT,
	nome varchar(200) NOT NULL,
    categoria varchar(50) NOT NULL,
    descricao varchar(300) NOT NULL,
    quantidade INT(4)NOT NULL,
    preco decimal(2) NOT NULL,
    foto MEDIUMBLOB,
    PRIMARY KEY (id)
    );
    
    CREATE TABLE users(
		id INT(4)auto_increment,
        nome varchar(200) NOT NULL,
        email varchar(50) NOT NULL UNIQUE,
        senha varchar(20)NOT NULL,
        primary key(id)
        );