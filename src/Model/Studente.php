<?php
namespace Model;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Table(name: "studente")]
#[ORM\Entity]
class Studente extends Utente {

    // Private properties
    
    /**
     * @var string
     * username dello studente
     */
    #[ORM\Column(type: Types::STRING, length: 50, unique: true)]
    private string $username; 

    /**
     * @var bool
     * indica se l'utente è bannato
     */
    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isBanned = false;

    /**
     * @var string
     * stringa generata per l'autenticazione dell'utente
     * via email
     */
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $validationToken; //stringa generata per l'autenticazione dell'utente via email

    /**
     * @var \DateTime
     * data di scadenza del token di autenticazione
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $validationTokenTime; //data di scadenza del token

    /**
     * @var string
     * stringa generata per l'auto login dell'utente
     * via cookie
     */
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $rememberMeToken; //stringa generata per l'autenticazione dell'utente via cookie

    /**
     * @var \DateTime
     * data di scadenza del token per l'auto login
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $rememberMeTokenTime; //data di scadenza del token di autenticazione via cookie

    /**
     * @var bool
     * indica se l'utente ha verificato la propria email
     */
    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isVerified = false; //indica se l'utente ha verificato la propria email

    /**
     * @var File
     * immagine di profilo dell'utente
     */
    #[ORM\Embedded(class: File::class)]
    private ?File $immagineProfilo = null;



    /** @var Collection<int, Segnalazione> 
     * un utente può segnalare più utenti, 
     * quindi è una relazione OneToMany tra Utente e Segnalazione, 
     * ma ogni segnalazione e associata a un solo utente segnalante.
    */
    #[ORM\OneToMany(targetEntity: Segnalazione::class, mappedBy: "segnalante", fetch: "EXTRA_LAZY")]
    private Collection $segnalazioniFatte;

    /** @var Collection<int, Materiale>
     * un utente può caricare più materiali, 
     * quindi è una relazione OneToMany tra Utente e Materiale,  
     * ma ogni materiale è associato a un solo utente.
    */
    #[ORM\OneToMany(targetEntity: Materiale::class, mappedBy: "studente", fetch: "EXTRA_LAZY")]
    private Collection $uploadEffettuati;

    /** @var Collection<int, Download>
     * un utente può effettuare più download, 
     * quindi è una relazione OneToMany tra Utente e Download,  
     * ma ogni download è associato a un solo utente.
    */
    #[ORM\OneToMany(targetEntity: Download::class, mappedBy: "studente", fetch: "EXTRA_LAZY")]
    private Collection $downloadEffettuati;

    /** @var Collection<int, Preferito>
     * un utente può avere più preferiti, 
     * quindi è una relazione OneToMany tra Utente e Preferito, 
     * ma ogni preferito è associato a un solo utente.
    */
    #[ORM\OneToMany(targetEntity: Preferito::class, mappedBy: "studente", fetch: "EXTRA_LAZY")]
    private Collection $preferiti;

    /** @var Collection<int, Recensione>
     * un utente può avere più recensioni, 
     * quindi è una relazione OneToMany tra Utente e Recensione, 
     * ma ogni recensione è associata a un solo utente.
    */
    #[ORM\OneToMany(targetEntity: Recensione::class, mappedBy: "studente", fetch: "EXTRA_LAZY")]
    private Collection $recensioni;

    /**
     * Costruttore di studente.
     * @param string $nome Nome dello studente.
     * @param string $cognome Cognome dello studente.
     * @param string $email Email dello studente.
     * @param string $passwordHash Password dello studente.
     * @param string $username Username dello studente.
     */
    public function __construct(
        string $nome, 
        string $cognome, 
        string $email, 
        string $passwordHash, 
        string $username,
        ) {
        parent::__construct(
            $nome, 
            $cognome, 
            $email, 
            $passwordHash
            );
        $this->username = $username;

        $this->segnalazioniFatte = new ArrayCollection();
        $this->uploadEffettuati = new ArrayCollection();
        $this->downloadEffettuati = new ArrayCollection();
        $this->preferiti = new ArrayCollection();
        $this->recensioni = new ArrayCollection();
    }


    /**
     * Inserisce lo username dello studente.
     * @param string $username Username dello studente.
     */ 
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * Ottiene lo username dello studente.
     * @return string Username dello studente.
     */
    public function getUsername(): string {
        return $this->username;
    }
     
    /**
    * Imposta se lo studente è bannato o meno.
    * @param bool $isBanned Indica se lo studente è bannato.
    */
    public function setIsBanned(bool $isBanned): void {
        $this->isBanned = $isBanned;
    }
   
    /**
     * Ottiene lo stato di ban dello studente.
     * @return bool Indica se lo studente è bannato.
     */
    public function getIsBanned(): bool {
        return $this->isBanned;
    }

    /**
    * Imposta lo stato di verifica dello studente.
    * @param bool $isVerified Indica se lo studente ha verificato la propria email.
    */
    public function setIsVerified(bool $isVerified): void {
        $this->isVerified = $isVerified;
    }

    /**
     * Ottiene lo stato della verifica dello studente.
     * @return string Token di autenticazione dello studente.
     */
    public function getIsVerified(): bool {
        return $this->isVerified;
    }

    /** @param Segnalazione $segnalazioneEffettuata
      * Aggiunge una segnalazione effettuata dallo studente alla collezione delle segnalazioni fatte.
      */
    public function setSegnalazioneEffettuata(Segnalazione $segnalazioneEffettuata): void {
        $this->segnalazioniFatte[] = $segnalazioneEffettuata;
    }

     /** @return Collection<int, segnalazione>
      * Restituisce le segnalazioni effettuate dallo studente.
      */
    public function getSegnalazioneEffettuata(): Collection {
         return $this->segnalazioniFatte;
    }
    
     /** @param Materiale $uploadEffettuati
      * Aggiunge un materiale caricato dallo studente alla collezione dei materiali caricati.
      */
    public function setUploadEffettuati(Materiale $uploadEffettuati): void {
        $this->uploadEffettuati[] = $uploadEffettuati;
    }

     /** @return Collection<int, Materiale> 
      * Restituisce i materiali caricati dallo studente.
     */
    public function getUploadEffettuati(): Collection {
         return $this->uploadEffettuati;
    }
    
     /** @param Download $downloadEffettuati
      * Aggiunge un download effettuato dallo studente alla collezione dei download effettuati.
      */
    public function setDownloadEffettuati(Download $downloadEffettuati): void {
        $this->downloadEffettuati[] = $downloadEffettuati;
    }

     /** @return Collection<int, Download>
      * Restituisce i download effettuati dallo studente.
      */
    public function getDownloadEffettuati(): Collection {
         return $this->downloadEffettuati;
    }
    
     /** @param Preferito $preferiti
      * Aggiunge un preferito dello studente alla collezione dei preferiti.
      */
    public function setPreferiti(Preferito $preferiti): void {
        $this->preferiti[] = $preferiti;
    }

     /** @return Collection<int, Preferito> 
      * Restituisce i preferiti dello studente.
     */
    public function getPreferiti(): Collection {
         return $this->preferiti;
    }
    
     /** @param Recensione $recensioni
     * Aggiunge una recensione effettuata dallo studente alla collezione delle recensioni effettuate.
     */
    public function setRecensioni(Recensione $recensioni): void {
        $this->recensioni[] = $recensioni;
    }

     /** @return Collection<int, Recensione>
      * Restituisce le recensioni effettuate dallo studente.
      */
    public function getRecensioni(): Collection {
         return $this->recensioni;
    }

    /**
    * Imposta il token di autenticazione dello studente.
    * @param string $token Token di autenticazione.
    */
    public function setValidationToken(?string $token): void {
        $this->validationToken = $token;
    }

    /**
     * Ottiene il token di autenticazione dello studente.
     * @return string Token di autenticazione.
     */
    public function getValidationToken(): ?string {
        return $this->validationToken;
    }

    /**
     * Imposta la data di validazione del token di autenticazione dello studente.
     * @param \datetime $validazioneToken Data di validazione del token.
     */
    public function setValidationTokenTime(?\DateTime $validazioneToken): void {
        $this->validationTokenTime = $validazioneToken;
    }

    /**
     * Ottiene la data di validazione del token di autenticazione dello studente.
     * @return \datetime Data di validazione del token.
     */
    public function getValidationTokenTime(): ?\DateTime {
        return $this->validationTokenTime;
    }

    /**
    * Imposta l'immagine del profilo dello studente.
    * @param File $immagineProfilo Immagine del profilo.
    */
    public function setImmagineProfilo(?File $immagineProfilo): void {
        $this->immagineProfilo = $immagineProfilo;
    }

    /**
     * Ottiene l'immagine del profilo dello studente.
     * @return File Immagine del profilo.
     */
    public function getImmagineProfilo(): ?File {
        return $this->immagineProfilo;
    }

    /**
     * Imposta il token di autenticazione via cookie dello studente.
     * @param string $rememberMeToken Token di autenticazione via cookie.
     */
    public function setRememberToken(?string $rememberMeToken): void {
        $this->rememberMeToken = $rememberMeToken;
    }

    /**
     * Ottiene il token di autenticazione via cookie dello studente.
     * @return string Token di autenticazione via cookie.
     */
    public function getRememberToken(): ?string {
        return $this->rememberMeToken;
    }

    /**
     * Imposta la data di scadenza del token di autenticazione via cookie dello studente.
     * @param \datetime $rememberMeTokenTime Data di scadenza del token di autenticazione via cookie.
     */
    public function setRememberTokenTime(?\DateTime $rememberMeTokenTime): void {
        $this->rememberMeTokenTime = $rememberMeTokenTime;
    }

    /**
     * Ottiene la data di scadenza del token di autenticazione via cookie dello studente.
     * @return \datetime Data di scadenza del token di autenticazione via cookie.
     */
    public function getRememberTokenTime(): \DateTime|null {
        return $this->rememberMeTokenTime;
    }
}