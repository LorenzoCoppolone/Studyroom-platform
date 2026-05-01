<?php
namespace Model;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Studente extends Utente {

    // Private properties
    
    #[ORM\Column(type: Types::STRING)]
    private string $username;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $stato;

    /** @var Collection<int, Segnalazione> 
     * un utente può segnalare più utenti, 
     * quindi è una relazione OneToMany tra Utente e Segnalazione, 
     * ma ogni segnalazione e associata a un solo utente segnalante.
    */

    #[ORM\OneToMany(targetEntity: Segnalazione::class, mappedBy: "segnalante")]
    private Collection $segnalazioniFatte;

    /** @var Collection<int, Materiale>
     * un utente può caricare più materiali, 
     * quindi è una relazione OneToMany tra Utente e Materiale,  
     * ma ogni materiale è associato a un solo utente.
    */

    #[ORM\OneToMany(targetEntity: Materiale::class, mappedBy: "studente")]
    private Collection $uploadEffettuati;

    /** @var Collection<int, Download>
     * un utente può effettuare più download, 
     * quindi è una relazione OneToMany tra Utente e Download,  
     * ma ogni download è associato a un solo utente.
    */

    #[ORM\OneToMany(targetEntity: Download::class, mappedBy: "studente")]
    private Collection $downloadEffettuati;

    /** @var Collection<int, Preferito>
     * un utente può avere più preferiti, 
     * quindi è una relazione OneToMany tra Utente e Preferito, 
     * ma ogni preferito è associato a un solo utente.
    */

    #[ORM\OneToMany(targetEntity: Preferito::class, mappedBy: "studente")]
    private Collection $preferiti;

    /**
     * Costruttore di studente.
     * 
     * @param int $id ID dello studente.
     * @param string $nome Nome dello studente.
     * @param string $cognome Cognome dello studente.
     * @param string $email Email dello studente.
     * @param string $passwordHash Password dello studente.
     * @param string $username Username dello studente.
     * @param bool $stato Stato dello studente (attivo o non attivo).
     * @param Collection<int, Segnalazione> $segnalazioniFatte Segnalazioni effettuate dallo studente.
     * @param Collection<int, Materiale> $uploadEffettuati Materiali caricati dallo studente.
     * @param Collection<int, Download> $downloadEffettuati Download effettuati dallo studente.
     * @param Collection<int, Preferito> $preferiti Preferiti dello studente.
     */

    public function __construct(
        int $id,
        string $nome, 
        string $cognome, 
        string $email, 
        string $passwordHash, 
        string $username, 
        bool $stato, 
        Collection $segnalazioniFatte = new ArrayCollection(), 
        Collection $uploadEffettuati = new ArrayCollection(), 
        Collection $downloadEffettuati = new ArrayCollection(), 
        Collection $preferiti = new ArrayCollection()
        ) {
        parent::__construct(
            $id, 
            $nome, 
            $cognome, 
            $email, 
            $passwordHash
            );
        $this->username = $username;
        $this->stato = $stato;
        $this->segnalazioniFatte = $segnalazioniFatte;
        $this->uploadEffettuati = $uploadEffettuati;
        $this->downloadEffettuati = $downloadEffettuati;
        $this->preferiti = $preferiti;
    }

    /**
     * Inserisce lo username dello studente.
     * 
     * @param string $username Username dello studente.
     */ 
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * Inserisce lo stato dello studente.
     * 
     * @param bool $stato Stato dello studente (attivo o non attivo).
     */
    public function setStato(bool $stato): void {
        $this->stato = $stato;
    }

    /**
     * Ottiene lo username dello studente.
     * 
     * @return string Username dello studente.
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Ottiene lo stato dello studente.
     * 
     * @return bool Stato dello studente (attivo o non attivo).
     */
    public function getStato(): bool {
        return $this->stato;
    }

     /** @return Collection<int, segnalazione>
      * Restituisce le segnalazioni effettuate dallo studente.
      */
    public function getSegnalazioneEffettuata(): Collection {
         return $this->segnalazioniFatte;
    }
    
     /** @param Segnalazione $segnalazioneEffettuata
      * Aggiunge una segnalazione effettuata dallo studente alla collezione delle segnalazioni fatte.
      */
    public function setSegnalazioneEffettuata(Segnalazione $segnalazioneEffettuata): void {
        $this->segnalazioniFatte[] = $segnalazioneEffettuata;
    }
    
     /** @return Collection<int, Materiale> 
      * Restituisce i materiali caricati dallo studente.
     */
    public function getUploadEffettuati(): Collection {
         return $this->uploadEffettuati;
    }
    
     /** @param Materiale $uploadEffettuati
      * Aggiunge un materiale caricato dallo studente alla collezione dei materiali caricati.
      */
    public function setUploadEffettuati(Materiale $uploadEffettuati): void {
        $this->uploadEffettuati[] = $uploadEffettuati;
    }
    
     /** @return Collection<int, Download>
      * Restituisce i download effettuati dallo studente.
      */
    public function getDownloadEffettuati(): Collection {
         return $this->downloadEffettuati;
    }
    
     /** @param Download $downloadEffettuati
      * Aggiunge un download effettuato dallo studente alla collezione dei download effettuati.
      */
    public function setDownloadEffettuati(Download $downloadEffettuati): void {
        $this->downloadEffettuati[] = $downloadEffettuati;
    }
    
     /** @return Collection<int, Preferito> 
      * Restituisce i preferiti dello studente.
     */
    public function getPreferiti(): Collection {
         return $this->preferiti;
    }
    
     /** @param Preferito $preferiti
      * Aggiunge un preferito dello studente alla collezione dei preferiti.
      */
    public function setPreferiti(Preferito $preferiti): void {
        $this->preferiti[] = $preferiti;
    }
    
}