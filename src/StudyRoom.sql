CREATE DATABASE if not exists StudyRoom;
USE StudyRoom;

CREATE TABLE if not exists Studente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cognome VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    passcode VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists Amministratore (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cognome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    passcode VARCHAR(255) NOT NULL
);


CREATE TABLE if not exists Corso_di_laurea (
    codice INT PRIMARY KEY AUTO_INCREMENT,
    nome_Cdl VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists Insegnamento (
    codice INT PRIMARY KEY AUTO_INCREMENT,
    nome_Insegnamento VARCHAR(255) NOT NULL,
    codice_Cdl INT NOT NULL,

    FOREIGN KEY (codice_Cdl) REFERENCES Corso_di_laurea(codice)
);

CREATE TABLE if not exists Appunto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) NOT NULL,
    tag ENUM('Note','Riassunto','Esercizi') NOT NULL,
    codice_Insegnamento INT NOT NULL,
    id_Studente INT NOT NULL,
    url_File VARCHAR(255) NOT NULL,
    dimensione_File FLOAT NOT NULL,

    FOREIGN KEY (codice_Insegnamento) REFERENCES Insegnamento(codice),
    FOREIGN KEY (id_Studente) REFERENCES Studente(id)
);

CREATE TABLE if not exists Esame (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) NOT NULL,
    codice_Insegnamento INT NOT NULL,
    id_Studente INT NOT NULL,
    url_File VARCHAR(255) NOT NULL,
    dimensione_File FLOAT NOT NULL,

    FOREIGN KEY (codice_Insegnamento) REFERENCES Insegnamento(codice),
    FOREIGN KEY (id_Studente) REFERENCES Studente(id)
)


CREATE TABLE if not exists Recensione (
    id INT PRIMARY KEY AUTO_INCREMENT,
    commento VARCHAR(255) NOT NULL,
    voto SMALLINT NOT NULL,
    id_Appunto INT NULLABLE,
    id_Esame INT NULLABLE,
    id_Studente INT NOT NULL,

    FOREIGN KEY (id_Appunto) REFERENCES Appunto(id),
    FOREIGN KEY (id_Esame) REFERENCES esame(id),
    FOREIGN KEY (id_Studente) REFERENCES Studente(id)
);

CREATE TABLE if not exists Download (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_Appunto INT NULLABLE,
    id_Esame INT NULLABLE,
    id_Studente INT NOT NULL,

    FOREIGN KEY (id_Appunto) REFERENCES Appunto(id),
    FOREIGN KEY (id_Esame) REFERENCES esame(id),
    FOREIGN KEY (id_Studente) REFERENCES Studente(id)
);

CREATE TABLE if not exists Segnalazione (
    id INT PRIMARY KEY AUTO_INCREMENT,
    motivo VARCHAR(255) NOT NULL,
    id_Appunto INT NULLABLE,
    id_Esame INT NULLABLE,
    id_Studente_Segnalatore INT NOT NULL,
    id_Studente_Segnalato INT NOT NULL,
    id_Amministratore INT NOT NULL,

    FOREIGN KEY (idd_appunto) REFERENCES Appunto(id),
    FOREIGN KEY (id_esame) REFERENCES esame(id),
    FOREIGN KEY (id_Studente_Segnalatore) REFERENCES Studente(id),
    FOREIGN KEY (id_Studente_Segnalato) REFERENCES Studente(id),
    FOREIGN KEY(id_Amministratore) REFERENCES Amministratore(id)
    
);


CREATE TABLE if not exists Preferito (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_Appunto INT NULLABLE,
    id_Esame INT NULLABLE,
    id_Studente INT NOT NULL,

    FOREIGN KEY (id_Appunto) REFERENCES Appunto(id),
    FOREIGN KEY (id_Esame) REFERENCES esame(id),
    FOREIGN KEY (id_Studente) REFERENCES Studente(id)

);