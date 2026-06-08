-- =====================================================================
-- StudyRoom Platform — Dati di test per popolare il database
-- =====================================================================
-- Credenziali di accesso generate con password_hash(..., PASSWORD_BCRYPT):
--   STUDENTI  -> password: Password1
--   ADMIN     -> password: Admin123!
--
-- Uso (da Laragon/HeidiSQL o terminale):
--   mysql -u root StudyRoom < database/seed_test.sql
--
-- ATTENZIONE: la sezione "RESET" qui sotto svuota le tabelle e azzera gli
-- auto_increment, così gli ID sono deterministici. Commentala se vuoi
-- soltanto AGGIUNGERE dati senza cancellare quelli esistenti.
-- =====================================================================

-- ---------- RESET (svuota tutto, rispettando le foreign key) ----------
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE Download;
TRUNCATE TABLE Preferito;
TRUNCATE TABLE Recensione;
TRUNCATE TABLE Segnalazione;
TRUNCATE TABLE Materiale;
TRUNCATE TABLE Insegnamento;
TRUNCATE TABLE CorsoDiLaurea;
TRUNCATE TABLE Studente;
TRUNCATE TABLE Amministratore;
SET FOREIGN_KEY_CHECKS = 1;

-- ---------- CORSI DI LAUREA ----------
INSERT INTO CorsoDiLaurea (codiceCorso, nomeCorso) VALUES
('INF01', 'Informatica'),
('ING02', 'Ingegneria Informatica e Automatica'),
('MAT03', 'Matematica');

-- ---------- INSEGNAMENTI ----------
INSERT INTO Insegnamento (id, nomeInsegnamento, corsoDiLaurea_codice) VALUES
(1, 'Programmazione I',            'INF01'),
(2, 'Basi di Dati',               'INF01'),
(3, 'Analisi Matematica I',       'INF01'),
(4, 'Reti di Calcolatori',        'ING02'),
(5, 'Algoritmi e Strutture Dati', 'ING02'),
(6, 'Algebra Lineare',            'MAT03');

-- ---------- STUDENTI ----------
-- password di tutti gli studenti: Password1
INSERT INTO Studente
(id, nome, cognome, email, passwordHash, username, isBanned, isVerified) VALUES
(1, 'Mario',  'Rossi',   'mario.rossi@student.univaq.it',   '$2y$10$r06WwxQmpOemBgSabS37AO7FXLOJ4sU4oM/LxJVqDnZT7eaeFqmbm', 'mariorossi',  0, 1),
(2, 'Luigi',  'Verdi',   'luigi.verdi@student.univaq.it',   '$2y$10$r06WwxQmpOemBgSabS37AO7FXLOJ4sU4oM/LxJVqDnZT7eaeFqmbm', 'luigiverdi',  0, 1),
(3, 'Anna',   'Bianchi', 'anna.bianchi@student.univaq.it',  '$2y$10$r06WwxQmpOemBgSabS37AO7FXLOJ4sU4oM/LxJVqDnZT7eaeFqmbm', 'annabianchi', 0, 1),
-- studente bannato (per testare il blocco accesso / gestione admin)
(4, 'Paolo',  'Neri',    'paolo.neri@student.univaq.it',    '$2y$10$r06WwxQmpOemBgSabS37AO7FXLOJ4sU4oM/LxJVqDnZT7eaeFqmbm', 'paoloneri',   1, 1),
-- studente non verificato (per testare il gating della verifica email)
(5, 'Giulia', 'Gialli',  'giulia.gialli@student.univaq.it', '$2y$10$r06WwxQmpOemBgSabS37AO7FXLOJ4sU4oM/LxJVqDnZT7eaeFqmbm', 'giuliagialli',0, 0);

-- ---------- AMMINISTRATORE ----------
-- password: Admin123!
INSERT INTO Amministratore (id, nome, cognome, email, passwordHash) VALUES
(1, 'Admin', 'StudyRoom', 'admin@univaq.it', '$2y$10$yVH5SyyEnPMTmcdW.XxsfeA4zYmDF/E14Ey/vWURJJatpC1/Xd9hW');

-- ---------- MATERIALI ----------
-- tipo = 'appunto'  -> tag valorizzato (RIASSUNTO | NOTE | ESERCIZI)
-- tipo = 'esame'    -> tag NULL
-- NB: il contenuto del file (BLOB) resta NULL: liste, ricerca, dettaglio e
--     recensioni si testano, ma il DOWNLOAD effettivo del PDF richiede un
--     upload reale dall'interfaccia (vedi nota finale).
INSERT INTO Materiale
(id, titolo, insegnamento_id, studente_id, tipo, tag) VALUES
(1, 'Appunti completi di Programmazione I', 1, 1, 'appunto', 'RIASSUNTO'),
(2, 'Raccolta esercizi Basi di Dati',       2, 1, 'appunto', 'ESERCIZI'),
(3, 'Note del corso di Analisi I',          3, 2, 'appunto', 'NOTE'),
(4, 'Esame Programmazione I - Gennaio 2024',1, 2, 'esame',   NULL),
(5, 'Esame Basi di Dati - Giugno 2024',     2, 3, 'esame',   NULL),
(6, 'Appunti Reti di Calcolatori',          4, 3, 'appunto', 'RIASSUNTO');

-- ---------- RECENSIONI ----------
-- (voto 1-5). Vincolo unique: una recensione per (materiale, studente).
INSERT INTO Recensione (id, voto, commento, materiale_id, studente_id) VALUES
(1, 5, 'Appunti chiarissimi, mi hanno salvato all''esame!', 1, 2),
(2, 4, 'Molto utili, ben organizzati.',                     1, 3),
(3, 3, 'Esame utile ma incompleto in alcune parti.',        4, 1),
(4, 5, 'Ottima raccolta di esercizi.',                      2, 3);

-- ---------- SEGNALAZIONI ----------
-- amministratore_id = NULL  -> segnalazione ancora DA GESTIRE (compare nella dashboard admin)
INSERT INTO Segnalazione (id, motivo, segnalante_id, materialeSegnalato_id, amministratore_id) VALUES
(1, 'Contenuto non pertinente allo studio', 2, 6, NULL),
(2, 'Possibile violazione di copyright',    3, 2, NULL),
-- una già gestita dall'admin 1 (per testare lo storico)
(3, 'Materiale duplicato',                  1, 5, 1);

-- ---------- PREFERITI ----------
-- Vincolo unique: un preferito per (studente, materiale).
INSERT INTO Preferito (id, studente_id, materiale_id) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 2, 1),
(4, 3, 1);

-- ---------- DOWNLOAD ----------
-- Vincolo unique: un download per (studente, materiale).
INSERT INTO Download (id, studente_id, materiale_id) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 1),
(4, 1, 6);

-- =====================================================================
-- FINE SEED
-- =====================================================================
