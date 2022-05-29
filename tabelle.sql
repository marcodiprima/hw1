
drop DATABASE if exists utenti;
create database utenti;

use utenti;

CREATE TABLE utenti(
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    nome varchar(255) not null,
    cognome varchar(255) not null,
    email varchar(255) not null unique
) Engine = InnoDB;


CREATE TABLE likes (
    titolo varchar(20) primary key,
    descrizione varchar(256) not null,
    titolino varchar(20) not null,
    img varchar(256) not null
) Engine = InnoDB;
