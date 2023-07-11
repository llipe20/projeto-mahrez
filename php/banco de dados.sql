CREATE DATABASE mahrez;

CREATE TABLE conta (
	login INT AUTO_INCREMENT,
    nome VARCHAR (100),
    email VARCHAR (100),
    senha VARCHAR (12),
    valorHora DECIMAL,
    PRIMARY KEY (login)
);

CREATE TABLE folha (
	cod INT AUTO_INCREMENT,
    dia VARCHAR(10),
    entrada VARCHAR(5),
    saida VARCHAR(5),
    atividade VARCHAR(50),
    equipe VARCHAR(200),
    descricao VARCHAR(800),
    horas INT,
    usuario INT,
    PRIMARY KEY (cod),
    FOREIGN KEY (usuario)
    REFERENCES conta (login)
    );
