CREATE DATABASE if not exists StudyRoom;
USE StudyRoom;

CREATE TABLE if not exists Studente (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Cognome VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists Amministratore (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Cognome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists Corso_di_laurea (
    codice INT PRIMARY KEY AUTO_INCREMENT,
    Nome_corso_di_laurea VARCHAR(255) NOT NULL
);

CREATE TABLE if not exists Insegnamento (
    codice INT PRIMARY KEY AUTO_INCREMENT,
    Nome_insegnamento VARCHAR(255) NOT NULL,
    Codice_corso_di_laurea INT NOT NULL,
    FOREIGN KEY (Codice_corso_di_laurea) REFERENCES Corso_di_laurea(codice)
);

CREATE TABLE if not exists Appunto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Titolo VARCHAR(255) NOT NULL,
    tag ENUM('appunto','riassunto','esercizi') NOT NULL,
    Codice_insegnamento INT NOT NULL,
    Id_studente INT NOT NULL,
    Url_file VARCHAR(255) NOT NULL,
    Dimensione_file FLOAT NOT NULL,
    FOREIGN KEY (Codice_insegnamento) REFERENCES Insegnamento(codice),
    FOREIGN KEY (Id_studente) REFERENCES Studente(Id)
);

CREATE TABLE if not exists esame (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Titolo VARCHAR(255) NOT NULL,
    Codice_insegnamento INT NOT NULL,
    Id_studente INT NOT NULL,
    Url_file VARCHAR(255) NOT NULL,
    Dimensione_file FLOAT NOT NULL,
    FOREIGN KEY (Codice_insegnamento) REFERENCES Insegnamento(codice),
    FOREIGN KEY (Id_studente) REFERENCES Studente(Id)
)

CREATE TABLE if not exists Recensione (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Testo VARCHAR(255) NOT NULL,
    Voto SMALLINT NOT NULL,
    Id_appunto INT NULLABLE,
    Id_esame INT NULLABLE,
    Id_studente INT NOT NULL,
    FOREIGN KEY (Id_appunto) REFERENCES Appunto(id),
    FOREIGN KEY (Id_esame) REFERENCES esame(id),
    FOREIGN KEY (Id_studente) REFERENCES Studente(Id)
);

CREATE TABLE if not exists Download (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Id_appunto INT NULLABLE,
    Id_esame INT NULLABLE,
    Id_studente INT NOT NULL,
    FOREIGN KEY (Id_appunto) REFERENCES Appunto(id),
    FOREIGN KEY (Id_esame) REFERENCES esame(id),
    FOREIGN KEY (Id_studente) REFERENCES Studente(Id)
);

CREATE TABLE if not exists Segnalazione (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Testo VARCHAR(255) NOT NULL,
    Id_appunto INT NULLABLE,
    Id_esame INT NULLABLE,
    Id_studente INT NOT NULL,
    FOREIGN KEY (Id_appunto) REFERENCES Appunto(id),
    FOREIGN KEY (Id_esame) REFERENCES esame(id),
    FOREIGN KEY (Id_studente) REFERENCES Studente(Id)
);

CREATE TABLE if not exists Preferito (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Id_appunto INT NULLABLE,
    Id_esame INT NULLABLE,
    Id_studente INT NOT NULL,
    FOREIGN KEY (Id_appunto) REFERENCES Appunto(id),
    FOREIGN KEY (Id_esame) REFERENCES esame(id),
    FOREIGN KEY (Id_studente) REFERENCES Studente(Id)
);