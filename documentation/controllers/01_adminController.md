# AdminController – Documentazione Tecnica dei Flussi

# 1) Metodo: verificaAccessoAdmin()

### Scopo
Verifica che l’utente sia un amministratore autenticato.

## Flusso dei dati

### Controller → Session
- `getSessionElement('admin')`

### Session → Controller
- ritorna `null` oppure `id`

### Controller → View
- se `admin === null` → `mostra404()`

### Dati salvati
- **Sessione:** nessun dato nuovo salvato  
- **DB:** nessuna operazione

# 2) Metodo: dashboard()

### Scopo
Mostrare la dashboard admin con la lista dei materiali segnalati.

## Flusso dei dati

### Controller → Session
- (indiretto) tramite `verificaAccessoAdmin()`

### Controller → View
- `getPage()` → per ottenere il numero pagina

### View → Controller
- ritorna `page` (int)

### Controller → PersistentManager
- `trovaSegnalazioniAdmin(offset, limit)`
- `countAll(Segnalazione::class)`

### PersistentManager → Controller
- array di segnalazioni
- numero totale di segnalazioni

### Controller → View
- `mostraDashboardAdmin($segnalazioni, $page, $totPage, $url)`

## Dati salvati
- **Sessione:** nessun dato salvato
- **DB:** nessuna modifica (solo lettura)

# 3) Metodo: gestisciSegnalazione(int $id)

### Scopo
Mostrare i dettagli di un materiale segnalato.

## Flusso dei dati

### Controller → Session
- (indiretto) tramite `verificaAccessoAdmin()`

### Controller → PersistentManager
- `gestisciSegnalazioneMaterialeAdmin($id)`

### PersistentManager → Controller
- ritorna array con:
  - dati materiale
  - dati studente

### Controller → View
- `mostraGestisciSegnalazione($dati)`

## Dati salvati
- **Sessione:** nessun dato salvato
- **DB:** nessuna modifica (solo lettura)


# 4) Metodo: eseguiAzione()

### Scopo
Eseguire una delle azioni dell’amministratore:
- accettare segnalazione
- bannare utente
- eliminare materiale

## Flusso dei dati

### Controller → Session
- (indiretto) tramite `verificaAccessoAdmin()`

### Controller → View
- `getDatiSegnalazione()`

### View → Controller
ritorna array:
- `idMaterialeSegnalato`
- `bottonePremuto`
- `idUtente`

## CASO 1 — ACCETTA SEGNALAZIONE

### Controller → PersistentManager
- `eliminaSegnalazioniAdmin($idMaterialeSegnalato)`

### PersistentManager → DB
- elimina tutte le segnalazioni relative al materiale

### Controller → View
- `mostraSuccesso()`

## CASO 2 — BAN UTENTE

### Controller → PersistentManager
- `find(Studente::class, $idUtente)`

### PersistentManager → Controller
- ritorna oggetto Studente

### Controller → Studente (Model)
- `setIsBanned(true)`

### Controller → PersistentManager
- `update()`

### PersistentManager → DB
- aggiorna campo `isBanned = true`

### Controller → View
- `mostraSuccesso()`

## CASO 3 — ELIMINA MATERIALE

### Controller → PersistentManager
- `find(Materiale::class, $idMaterialeSegnalato)`

### PersistentManager → Controller
- ritorna oggetto Materiale

### Controller → PersistentManager
- `delete($materiale)`

### PersistentManager → DB
- elimina:
  - materiale
  - segnalazioni collegate 

### Controller → View
- `mostraSuccesso()`

## Dati salvati
### Sessione
- nessun dato salvato

### DB
- CASO 1 → elimina segnalazioni  
- CASO 2 → aggiorna `Studente.isBanned = true`  
- CASO 3 → elimina materiale + segnalazioni


# RIASSUNTO GRAFICO

## AdminController
- verificaAccessoAdmin()
  - Controller → Session: get('admin')
  - Session → Controller: valore admin
  - Controller → View: mostra404() (se non admin)

- dashboard()
  - Controller → View: getPage()
  - View → Controller: page
  - Controller → PM: countAll(), trovaSegnalazioniAdmin()
  - PM → Controller: dati segnalazioni + totali
  - Controller → View: mostraDashboardAdmin()

- gestisciSegnalazione()
  - Controller → PM: gestisciSegnalazioneMaterialeAdmin()
  - PM → Controller: dati materiale
  - Controller → View: mostraGestisciSegnalazione()

- eseguiAzione()
  - Controller → View: getDatiSegnalazione()
  - View → Controller: idMateriale, bottone, idUtente

  **ACCETTA**
  - Controller → PM: eliminaSegnalazioniAdmin()
  - PM → DB: elimina segnalazioni
  - Controller → View: mostraSuccesso()

  **BAN**
  - Controller → PM: find(Studente)
  - Controller → Studente: setIsBanned(true)
  - Controller → PM: update()
  - PM → DB: aggiorna studente
  - Controller → View: mostraSuccesso()

  **ELIMINA**
  - Controller → PM: find(Materiale)
  - Controller → PM: delete(Materiale)
  - PM → DB: elimina materiale + segnalazioni
  - Controller → View: mostraSuccesso()

