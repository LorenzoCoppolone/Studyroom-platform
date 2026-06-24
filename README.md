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
- XAMPP (o equivalente con Apache + MySQL)

##  Setup e Installazioni

### 1. Clona il repository
```bash
git clone https://github.com/utente/studyroom-platform.git
cd studyroom-platform
```

### 2. Installa Composer
Scaricare composer dal seguente link: `https://getcomposer.org/download/`

### 3. Installa le dipendenze
```bash
composer install
```

### 4. Configura l'ambiente
```bash
cp .env.example .env
```
Modifica il file `.env` con i tuoi parametri (le variabili riportate sotto sono fittizie):
```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=DataBaseExample
DB_USER=User
DB_PASSWORD=psw
```

---

### 5. Configurazione del Database

#### 5.1 Avvia XAMPP
Apri il pannello di controllo di XAMPP e avvia i servizi:
-  **Apache**
-  **MySQL**

#### 5.2 Crea il database vuoto
Vai su `http://localhost/phpmyadmin`, accedi e crea un nuovo database con lo **stesso nome** indicato nel tuo `.env` (es. `DataBaseExample`).

In alternativa, puoi crearlo da terminale:
```bash
mysql -u root -p
CREATE DATABASE DataBaseExample;
exit;
```

#### 5.3 Se necessario, installa la dipendenza per la cache di Doctrine
```bash
composer require symfony/cache
```

#### 5.4 Genera le tabelle tramite Doctrine
```bash
# Crea lo schema da zero (primo avvio)
php bin/doctrine.php orm:schema-tool:create

# Visualizza l'SQL che verrà eseguito, senza applicarlo
php bin/doctrine.php orm:schema-tool:update --dump-sql

# Cancella il DB esistente
php bin/doctrine.php orm:schema-tool:drop --force

# Aggiorna lo schema se hai modificato i Model
php bin/doctrine.php orm:schema-tool:update --force
```

#### 5.5 Installazione documentazione
```bash
php vendor/bin/doctum.php update config/doctum.php
```

#### 5.6 Visualizzazione DB

Per visualizzare il DB appena creato , andare su  **phpMyAdmin** oppure installare su VS l`estensione **"DataBase Client"** e connettersi al db impostando le variabili dambiente .


---

studyroom-platform/
├── bin/
│   └── doctrine.php                        # CLI Doctrine per gestione schema DB (migrate, update, validate)
│
├── config/                                 # Bootstrap dell’applicazione
│   ├── StartSmarty.php                     # Inizializzazione motore Smarty
│   ├── bootstrap-Smarty.php                # Configurazione template engine
│   ├── doctrine-bootstrap.php              # Configurazione EntityManager Doctrine
│   ├── doctrine.php                        # Setup generale Doctrine ORM
│   └── mailer-bootstrap.php                # Configurazione PHPMailer per invio email
│
├── src/
│   ├── Controller/                         # Controller MVC: gestiscono il flusso applicativo
│   │   ├── AdminController.php             # Funzioni amministratore (ban, moderazione, gestione corsi)
│   │   ├── CaricaMaterialeController.php   # Upload appunti/esami con validazioni
│   │   ├── DownloadMaterialeController.php # Gestione download e statistiche
│   │   ├── FrontController.php             # Router principale dell’applicazione
│   │   ├── GestionePreferitiController.php # Aggiunta/rimozione materiali dai preferiti
│   │   ├── HomeController.php              # Homepage e dashboard utente
│   │   ├── RecensioneMaterialeController.php # Inserimento e gestione recensioni
│   │   ├── RicercaMaterialeController.php  # Ricerca avanzata per corso/insegnamento/tag
│   │   ├── SegnalazioneContenutiController.php # Segnalazioni utenti/materiali
│   │   └── UserController.php              # Login, registrazione, profilo utente
│
│   ├── Foundation/
│   │   ├── Session.php                     # Gestione sessioni utente
│   │   └── Persistent/                     # Accesso al DB tramite Doctrine
│   │       ├── PersistentManager.php       # Factory per EntityManager
│   │       ├── AdminRepository.php         # Query personalizzate per Amministratore
│   │       ├── InsegnamentoRepository.php  # Query per insegnamenti
│   │       ├── MaterialeRepository.php     # Query per materiali (appunti/esami)
│   │       └── UtenteRepository.php        # Query per utenti e studenti
│
│   ├── Model/                              # Entità Doctrine (mappate su tabelle DB)
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
│
│   └── View/                               # Classi View che preparano i dati per Smarty
│       ├── ViewAdmin.php
│       ├── ViewCaricaMateriale.php
│       ├── ViewDownloadMateriale.php
│       ├── ViewHome.php
│       ├── ViewInfo.php
│       ├── ViewPreferiti.php
│       ├── ViewRecensioneMateriale.php
│       ├── ViewRicercaMateriale.php
│       ├── ViewSegnalazioni.php
│       └── ViewUser.php
│
├── templates/                              # Template Smarty (.tpl)
│
├── CSS/                                     # Stili e layout
├── JS/                                      # Script lato client
├── img/                                     # Risorse grafiche
│
├── vendor/                                  # Dipendenze Composer (auto-generata)
│
├── index.php                                # Entry point dell’applicazione (Front Controller)
├── composer.json                            # Configurazione Composer
├── composer.lock
├── .env                                     # Variabili ambiente (DB, mail, ecc.)
└── README.md

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
| symfony/cache     | *        | Cache richiesta da Doctrine ORM    |

> Vedi `composer.json` per la lista completa.
