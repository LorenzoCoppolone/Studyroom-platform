## 02 – Casi d’Uso 


## UC1 — Sistema di Registrazione e Autenticazione

### Attori
- Utente Non Registrato
- Utente Registrato
- Amministratore

### Descrizione
Il sistema permette:
- Registrarsi al sistema
- Effettuare il Login

Entrambe le operazioni includono:
- Compilare form dati/credenziali

La registrazione include:
- Verifica email universitaria

Il login può estendere:
- Gestire errore credenziali errate


## SD1 — Registrazione e Login

### Registrazione Utente
1A) L’utente accede alla sezione di registrazione  
1B) Il sistema mostra il form con: Nome, Cognome, Username, Email, Password, Conferma Password 
2A) L’utente inserisce i dati e conferma  
2B) Il sistema verifica i dati e invia una mail di conferma  
3A) L’utente conferma la mail tramite il link di verifica che riceve sulla sua casella di posta elettronica (quella universitaria)
3B) Il sistema valida l’utente e mostra una schermata di successo

### Login
1A) L’utente accede alla sezione login  
1B) Il sistema mostra il form con Email e Password  
2A) L’utente inserisce le credenziali  
2B) Il sistema verifica e mostra la Home 


# UC2 — Ricerca Materiale

### Attori
- Utente Registrato
- Utente Non Registrato

### Descrizione
L’utente può cercare materiale (appunti/esami).

Include:
- Selezionare corso di laurea
- Selezionare insegnamento
- Inserire il titolo

Può estendere:
- Applicare filtri avanzati (corso di laurea, insgnamento, tipologia, tag, ordina per)


## SD2 —  Ricerca Materiale

### Modalità 1 — Barra di Ricerca
1A) L’utente inserisce il titolo
1B) Il sistema mostra una lista di materiali con  titolo, insegnamento, corso di laurea, tipologia, valutazione media, numero recensioni, numero download, filtri

#### Caso 1 — Apertura materiale
2A) L’utente seleziona un materiale  
2B) Il sistema mostra i dettagli del materiale, quali titolo, tipologia, username di chi ha caricato quel materiale, insegnamento, corso di laurea, valutazione media, numero download, e il file navigabile, `Lascia una recensione`, `Segnala materiale`, `Scarica`, `Aggiungi ai preferiti` 

#### Caso 2 — Filtri
2A) L’utente applica filtri (Corso di laurea, insegnamento, tipologia, tag(se applicabile), ordina per) 
2B) Il sistema aggiorna la lista  
3A) L’utente seleziona un materiale  
3B) Il sistema mostra i dettagli come sopra

### Modalità 2 — “Prepara i tuoi esami”
1A) L’utente clicca sulla sezione  
1B) Il sistema mostra gli appunti più popolari, ovvero con valutazione media, numero recensioni e numero download maggiori
2A) L’utente applica filtri (Corso di laurea, insegnamento, tipologia, tag(se applicabile), ordina per) 
2B) Il sistema aggiorna i risultati


# UC3 — Caricamento Materiale

### Attori
- Utente Registrato

### Descrizione
L’utente può caricare appunti o esami.

Include:
- Effettuare il Login
- Selezionare file PDF
- Inserire metadati documento
- Accettare Termini e Condizioni

Estende:
- Errore file non valido/troppo grande
- Errore campi mancanti


## SD3 — Caricamento Materiale
1A) L’utente accede alla sezione upload  
1B) Il sistema mostra il form con: tipologia materiale, file, corso di laurea, insegnamento, titolo, tag,  T&C  
2A) L’utente compila tutti i campi del form, accetta T&C e clicca su "Carica Materiale" 
2B) Il sistema mostra un messaggio di successo/errore


# UC4 — Recensione Appunti/Esami

### Attori
- Utente Registrato

### Descrizione
L’utente può inserire una recensione (1–5 stelle) e un commento.

Include:
- Effettuare il Login
- Selezionare il materiale


## SD4 — Recensione Materiale
1A) L’utente seleziona un materiale  
1B) Il sistema mostra i dettagli del materiale, quali titolo, tipologia, username di chi ha caricato quel materiale, insegnamento, corso di laurea, valutazione media, numero download, e il file navigabile, `Lascia una recensione`, `Segnala materiale`, `Scarica`, `Aggiungi ai preferiti` 
2A) L’utente clicca “Recensisci”  
2B) Il sistema mostra il form recensione  con un campao per selezionare un voto (da 1 a 5 stelle) e un campo per inserire un commento 
3A) L’utente inserisce valutazione + commento
3B) Il sistema conferma e mostra un pop up di conferma


# UC5 — Inserimento tra i Preferiti

### Attori
- Utente Registrato

### Descrizione
L’utente può aggiungere o rimuovere un materiale dai preferiti.

Include:
- Effettuare il Login
- Selezionare il materiale

Estende:
- Rimuovere dai preferiti


## SD5 — Preferiti
1A) L’utente clicca `Aggiungi ai preferiti` 
1B) Il sistema mostra un pop-up di aggiunta o rimozione


# UC6 — Download Materiale

### Attori
- Utente Registrato

### Descrizione
Include:
- Effettuare il Login
- Selezionare il materiale

Estende:
- Aggiornare contatore download


## SD6 — Download Materiale
1A) L’utente clicca `Scarica`
1B) Il sistema verifica autenticazione, avvia il download e mostra un pop up di  conferma


# UC7 — Moderazione Contenuti

### Attori
- Amministratore

### Descrizione
Include:
- Effettuare il Login
- Visualizzare contenuti segnalati
- Selezionare contenuto

Estende:
- Eliminare contenuto


## SD7 — Scenario Dinamico: Moderazione

### Dashboard
1A) L’amministratore accede al pannello  
1B) Il sistema mostra la lista dei materiali segnalati con numero segnalazioni e e un tasto `Gestisci`

### Caso 1 — Gestisci segnalazione
2A) L’amministratore clicca `Gestisci`
2B) Il sistema mostra il materiale segnalato, il titolo, l'username, nome, cognome e email dell'utente che ha caricato quel materiale, `Anulla segnalazione` , `Rimuovi materiale` e `Banna utente` 
3A) L’amministratore sceglie una tra le tre opzioni disponibili: `Anulla segnalazione` , `Rimuovi materiale` e `Banna utente` 
3B) Il sistema esegue il commando



# UC8 — Segnalazione Materiale innappropriato

### Attori
- Utente Registrato

### Descrizione
Include:
- Effettuare il Login
- Selezionare il materiale

Estende:
- Inserire motivazione segnalazione


## SD9 — Scenario Dinamico: Segnalazione
1A) L’utente seleziona un materiale  
1B) Il sistema mostra i dettagli del materiale, quali titolo, tipologia, username di chi ha caricato quel materiale, insegnamento, corso di laurea, valutazione media, numero download, e il file navigabile, `Lascia una recensione`, `Segnala materiale`, `Scarica`, `Aggiungi ai preferiti` 
2A) L’utente clicca  `Segnala materiale`
2B) Il sistema mostra il form con un campo per inserire una motivazione
3A) L’utente inserisce la motivazione e clicca `Invia segnalazione`
3B) Il sistema valida e mostra un pop up di conferma


# UC10 — Profilo Utente

### Attori
- Utente Registrato

### Descrizione
Include:
- Effettuare il Login


## SD10 —  Profilo Utente
1A) L’utente clicca sulla foto profilo o sul username in alto a destra
1B) Il sistema mostra i dati profilo: `modifica`, `preferiti`, `recensioni`, `caricati`, `scaricati`

