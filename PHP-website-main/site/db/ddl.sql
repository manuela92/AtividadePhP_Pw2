CREATE DATABASE IF NOT EXISTS db_pw2;
USE db_pw2;

CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    email VARCHAR(100) NOT NULL,
    idade VARCHAR(40),
    id_login INT NOT NULL,
    FOREIGN KEY (id_login) REFERENCES login(id) ON DELETE CASCADE
);

CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(100) NOT NULL,
    preco FLOAT NOT NULL,             
    tamanho VARCHAR(20) NOT NULL,
    descricao VARCHAR(250) NOT NULL,
    marca VARCHAR(100),
    categoria VARCHAR(100) NOT NULL,  
    data_cadastro DATE,
    quantidade INT NOT NULL,
    ativo BOOLEAN
);
