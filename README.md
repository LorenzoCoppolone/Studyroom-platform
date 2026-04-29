# StudyRoom Platform

Piattaforma web per la condivisione e gestione di materiali di studio universitari.
Gli studenti possono caricare, cercare, recensire e segnalare materiali didattici.

##  Stack tecnologico

- **PHP 8.x** — logica backend
- **Doctrine ORM** — gestione del database tramite entità
- **Composer** — gestione delle dipendenze
- **CSS** — stile e layout dell'interfaccia

##  Requisiti

- PHP >= 8.1
- Composer
- MySQL (o altro DB compatibile con Doctrine)

##  Installazione

### 1. Clona il repository
```bash
git clone https://github.com/utente/studyroom-platform.git
cd studyroom-platform
```
### 2. Installa Composer
Scaricare composer dal seguente link : ```https://getcomposer.org/download/```


### 3. Installa le dipendenze
```bash
composer install
```

### 4. Configura l'ambiente
```bash
cp .env.example .env
```
Modifica il file `.env` con i tuoi parametri:
```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=studyroom
DB_USER=root
DB_PASSWORD=
```
### 5. Crea il Database
```bash
mysql -u root -p
CREATE DATABASE studyroom;
exit;
```

### 6. Genera il database tramite Doctrine
```bash
# Crea lo schema da zero
php vendor/bin/doctrine orm:schema-tool:create

# Oppure aggiorna uno schema esistente
php vendor/bin/doctrine orm:schema-tool:update --force
```

##  Struttura del progetto
```
studyroom-platform/
├── src/
│   ├── Controller/                         # Logica di controllo (MVC)
│   │   ├── LoginUtenteController.php
│   │   ├── ModerazioneContenutiController.php
│   │   ├── RecensioneMaterialeController.php
│   │   ├── RegistrazioneUtenteController.php
│   │   ├── RicercaMaterialeController.php
│   │   └── SegnalazioneContenutiController.php
│   ├── Foundation/
│   │   └── Persistent/                     # Configurazione e accesso Doctrine
│   ├── Model/                              # Entità Doctrine
│   │   ├── Utente.php
│   │   ├── Studente.php
│   │   ├── Amministratore.php
│   │   ├── Materiale.php
│   │   ├── File.php
│   │   ├── Recensione.php
│   │   ├── Segnalazione.php
│   │   ├── Appunto.php
│   │   ├── Preferito.php
│   │   ├── Download.php
│   │   ├── Tag.php
│   │   ├── Esame.php
│   │   ├── Insegnamento.php
│   │   └── CorsoDiLaurea.php
│   └── UI/                                 # Template e interfaccia utente
├── vendor/                                 # Dipendenze Composer (auto-generata)
├── composer.json
├── composer.lock
└── .env
```
##  Funzionalità principali

- **Registrazione e login** degli utenti
- **Caricamento e ricerca** di materiali di studio
- **Recensione** dei materiali da parte degli studenti
- **Segnalazione** di contenuti inappropriati
- **Moderazione** dei contenuti da parte degli amministratori
- **Download e salvataggio** dei materiali preferiti

##  Dipendenze principali

| Pacchetto         | Versione | Descrizione                        |
|-------------------|----------|------------------------------------|
| doctrine/orm      | ^3.0     | ORM per la gestione delle entità   |
| doctrine/dbal     | ^4.0     | Astrazione del database            |

> Vedi `composer.json` per la lista completa.

