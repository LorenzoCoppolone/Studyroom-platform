<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'tipo', type: 'string')] // Definisce la colonna che identifica i tipi di materiale (nel db ci saranno solo materiali in un unica tabella, ma in php ci saranno appunti ed esami che estendono materiale)
#[ORM\DiscriminatorMap(['Materiale' => Materiale::class, 'appunto' => Appunto::class, 'esame' => Esame::class])]
abstract class Materiale {
    // Protected properties
    protected int $id;
    protected string $titolo;
    protected File $file; //relazione 1:1

    /** @var Collection<int, Segnalazione> 
     * un materiale può essere segnalato più volte,
     * quindi è una relazione OneToMany tra Materiale e Segnalazione,
     * ma ogni segnalazione è associata a un solo materiale.
    */
    #[ORM\OneToMany(targetEntity: "Segnalazione", mappedBy: "materiale")]
    protected Collection $segnalazioni;

    /** @var Collection<int, Recensione> 
     * un materiale puo' avere piu' recensioni,
     * quindi è una relazione OneToMany tra Materiale e Recensione,
     * ma ogni recensione associata a un solo materiale
    */
    #[ORM\OneToMany(targetEntity: "Recensione", mappedBy: "materiale")]
    protected Collection $recensioni;

    /** @var Collection<int, Download> 
     * un materiale puo' essere scaricato più volte,
     * quindi è una relazione OneToMany tra Materiale e Download,
     * ma ogni download associato a un solo materiale
    */
    #[ORM\OneToMany(targetEntity: "Download", mappedBy: "materiale")]
    protected Collection $downloads;

    /** @var Collection<int, Preferito>
     * un materiale puo' essere aggiunto più volte ai preferiti,
     * quindi è una relazione OneToMany tra Materiale e Preferito,
     * ma ogni preferito associato a un solo materiale
     */
    #[ORM\OneToMany(targetEntity: "Preferito", mappedBy: "materiale")]
    protected Collection $preferiti;


    //???????? bisogna vedere se bidirezionale
    #[ORM\ManyToOne(targetEntity: "Insegnamento", inversedBy: "materiali")]
    protected Insegnamento $insegnamento; //relazione molti a uno


    //???????? bisogna vedere se bidirezionale
    #[ORM\ManyToOne(targetEntity: "Studente")]
    protected Studente $studente; //relazione molti a uno

  /**
     * Costruttore della classe Materiale.
     * @param int $id L'ID del materiale.
     * @param string $titolo Il titolo del materiale.
     * @param File $file Il file del materiale.
     * @param Insegnamento $insegnamento L'insegnamento associato al materiale.
     * @param Studente $studente Lo studente che ha caricato il materiale.
     */
    public function __construct(
        int $id,
        string $titolo, 
        File $file,
        Insegnamento $insegnamento,
        Studente $studente,
        Collection $segnalazioni = new ArrayCollection(),
        Collection $recensioni = new ArrayCollection(),
        Collection $downloads = new ArrayCollection(),
        Collection $preferiti = new ArrayCollection()
        
        ) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->file = $file;
        $this->insegnamento = $insegnamento;
        $this->studente = $studente;
        $this->segnalazioni = $segnalazioni;
        $this->recensioni = $recensioni;
        $this->downloads = $downloads;
        $this->preferiti = $preferiti;
    }

    /**
     * Ottiene l'ID del materiale.
     * @return int L'ID del materiale.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Imposta l'ID del materiale.
     * @param int $id L'ID del materiale.
     */
    public function setId(int $id): void {
        $this->id= $id;
    }

    /**
     * Ottiene il titolo del materiale.
     * 
     * @return string Il titolo del materiale.
     */
    public function getTitolo(): string {
        return $this->titolo;
    }

    /**
     * Imposta il titolo del materiale.
     * 
     * @param string $titolo Il titolo del materiale.
     */
    public function setTitolo(string $titolo): void {
        $this->titolo = $titolo;
    }

    /**
     * Ottiene il file associato al materiale.
     * 
     * @return File $file
     */
    public function getFile(): File {
        return $this->file;
    }

    /**
     * Imposta il file associato al materiale.
     * 
     * @param File $file
     */
    public function setFile(File $file): void {
        $this->file = $file;
    }

    /**
     * Ottiene Segnalazioni
     * @return Collection<int, Segnalazione>
     */
    public function getSegnalazioni() : Collection {
        return $this->segnalazioni;
    }

    /**
     * Aggiunge Segnalazione
     * @param Segnalazione
     */
    public function aggiungiSegnalazione(Segnalazione $segnalazione): void {
        $this->segnalazioni[] = $segnalazione;
    }

    /**
     * Ottiene Recensioni
     * @return Collection<int, Recensione>
     */
    public function getRecensioni() : Collection {
       return $this->recensioni;
    }



    /**
     * Ottiene Download
     * @return Collection<int, Download>
     */
    public function getDownload() : Collection {
        return $this->downloads;
    }

    /**
     * Ottiene Preferiti
     * @return Collection<int, Preferito>
     */
    public function getPreferiti() : Collection {
        return $this->preferiti;
    }



    /**
     * Aggiunge una recensione al materiale.
     * 
     * @param Recensione $recensione Recensione da aggiungere.
     * @return void
     */
    public function aggiungiRecensione(Recensione $recensione): void {
        $this->recensioni[] = $recensione;
    }

    /**
     * Aggiunge un download al materiale.
     * 
     * @param Download $download Download da aggiungere.
     * @return void
     */
    public function aggiungiDownload(Download $download): void {
        $this->downloads[] = $download;
    }

    /**
     * Aggiunge un preferito al materiale.
     * 
     * @param Preferito $preferito Preferito da aggiungere.
     * @return void
     */
    public function aggiungiPreferito(Preferito $preferito): void {
        $this->preferiti[] = $preferito;
    }
}