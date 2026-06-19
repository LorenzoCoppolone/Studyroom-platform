# CaricaMaterialeController – Documentazione Tecnica dei Flussi

# 1) Metodo: carica()

### Scopo
Mostrare il form di caricamento materiale **solo se**:
- l’utente è loggato
- l’utente è verificato
- l’utente non è bannato

## Flusso dei dati

### Controller → Session
`getSessionElement('studente') : int|null`

### Session → Controller
- ritorna:
  - `int` → ID studente loggato  
  - `null` → utente non loggato → errore

### Controller → PersistentManager
`find(Studente::class, int $idStudente)`

### PersistentManager → Controller
- ritorna: `Studente`

### Controller → Model\Studente
- `getIsVerified() : bool`
- `getIsBanned() : bool`
- `getUsername() : string`
- `getImmagineProfilo()->getBase64($studente) : string`

### Controller → PersistentManager
- `trovaCorsiDiLaurea() : array<CorsoDiLaurea>`
- `trovaInsegnamenti() : array<Insegnamento>`

### PersistentManager → Controller
- ritorna array di entità

### Controller → View
`mostraFormCaricaMateriale(array $corsi, array $insegnamenti, string $username, string $imgProfiloBase64) : void`

## Dati salvati
- **Sessione:** nessun dato scritto  
- **DB:** nessuna modifica (solo lettura)

# 2) Metodo: salva()

### Scopo
Ricevere i dati del form, validarli, costruire le entità corrette (Appunto o Esame), salvare nel DB.

---

# 2.1 – Lettura dati dalla View

### Controller → View
- `getTipologia() : string`
- `getFile() : array`
- `getIdCorsoDiLaurea() : int`
- `getIdInsegnamento() : int`
- `getTitolo() : string`
- `getTag() : ?string`
- `getTac() : bool`

### View → Controller
ritorna:
- `tipologia      : "appunto" | "esame"`
- `fileCaricato   : array (tmp_name, size, error, name)`
- `idCdl          : int`
- `idInsegnamento : int`
- `titolo         : string`
- `tag            : string|null`
- `tac            : bool`

# 2.2 – Lettura dati dalla Sessione

### Controller → Session
`getSessionElement('studente') : int|null`

### Session → Controller
- ritorna ID studente loggato

# 2.3 – Validazione

### Controller → Controller (metodo interno)
`validaDatiCaricamento(...) : void`

Controlla:
- tipologia valida
- titolo non vuoto
- tag obbligatorio se appunto
- cdl valido
- insegnamento valido
- tac === true
- file PDF valido, dimensione ≤ 2MB

Se qualcosa non va → `InvalidArgumentException`

# 2.4 – Lettura file

### Controller → PHP native
- `file_get_contents($fileCaricato['tmp_name']) : string`
- `finfo(FILEINFO_MIME_TYPE)->file(tmp_name) : string`
- `$fileCaricato['size'] : float`

### Controller ottiene:
- `contenutoFile  : string (binario)`
- `mimeTypeFile   : string (es. "application/pdf")`
- `dimensioneFile : float`

# 2.5 – Recupero entità dal DB

### Controller → PersistentManager
`find(Studente::class, int $idUtente) : ?Studente`  
`find(CorsoDiLaurea::class, int $idCdl) : ?CorsoDiLaurea`  
`find(Insegnamento::class, int $idInsegnamento) : ?Insegnamento`

### PersistentManager → Controller
ritorna entità o null

# 2.6 – Costruzione entità File

### Controller → Model\File
`new File(string $contenuto, string $mimeType, float $dimensione)`

### Risultato
`$file : File`

# 2.7 – Costruzione entità Materiale

## CASO 1 — tipologia = "appunto"

### Controller → Model\Tag
`Tag::tryFrom(strtoupper($tag)) : ?Tag`

### Controller → Model\Appunto
`new Appunto(string $titolo, File $file, Insegnamento $ins, Studente $stud, Tag $tagEnum)`

### Risultato
`$materiale : Appunto`

## CASO 2 — tipologia = "esame"

### Controller → Model\Esame
`new Esame(string $titolo, File $file, Insegnamento $ins, Studente $stud)`

### Risultato
`$materiale : Esame`

# 2.8 – Salvataggio nel DB

### Controller → PersistentManager
`save(Materiale $materiale) : void`

### PersistentManager → DB
- INSERT in tabella `Materiale`
- INSERT in tabella `File`
- INSERT in tabella `Appunto` o `Esame`
- Relazioni:
  - materiale → studente
  - materiale → insegnamento
  - materiale → file

---

# 2.9 – Risposta finale

### Controller → View
`mostraFormSuccesso("Materiale caricato con successo!") : void`

---

## Dati salvati
### Sessione
- nessun dato scritto

### DB
- nuovo record `Materiale`
- nuovo record `File`
- eventuale record `Appunto` o `Esame`
- relazioni con Studente e Insegnamento


# RIASSUNTO GRAFICO

## carica()
Controller → Session: get('studente') : int|null  
Controller → PM: find(Studente)  
Controller → PM: trovaCorsiDiLaurea()  
Controller → PM: trovaInsegnamenti()  
Controller → View: mostraFormCaricaMateriale(corsi[], insegnamenti[], username, imgBase64)

---

## salva()
Controller → View: getTipologia(), getFile(), getIdCdl(), getIdInsegnamento(), getTitolo(), getTag(), getTac()  
Controller → Session: get('studente')  

Controller → validaDatiCaricamento()  

Controller → PHP: file_get_contents(), finfo->file(), size  

Controller → PM: find(Studente), find(CorsoDiLaurea), find(Insegnamento)  

Controller → Model\File: new File()  

**Se appunto:**  
Controller → Tag::tryFrom()  
Controller → new Appunto()  

**Se esame:**  
Controller → new Esame()  

Controller → PM: save($materiale)  

Controller → View: mostraFormSuccesso()

