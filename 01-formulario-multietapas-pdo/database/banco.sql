create database pedrdb;
use pedrodb;

create table usr (
	id INT auto_increment primary key,
    nome varchar(255) not null,
    email varchar(100) not null unique,
    senha varchar(255) not null,
    telefone varchar(20),
    rua varchar(255),
    bairro varchar(255),
    cidade varchar(255),
    estado char(2),
    cep char(9),
    cpf char(11) unique
);

select * from usr;