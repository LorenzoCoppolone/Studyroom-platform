<?php
namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Table(name: "insegnamento")]
#[ORM\Entity]
class Insegnamento {
    
    /** @var int|null
     * La proprietà "id" rappresenta l'identificatore univoco dell'insegnamento.
     * E' una chiave primaria e viene generato automaticamente dal database.
    */
    #[ORM\Column(type: Types::INTEGER), ORM\Id, ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    /** @var string
     * La proprietà "nomeInsegnamento" rappresenta il nome dell'insegnamento.
    */
    #[ORM\Column(type: Types::STRING)]
    private string $nomeInsegnamento;

    /** @var Collection<int, Materiale> 
     * un insegnamento può avere più materiali associati,
     * quindi è una relazione OneToMany tra Insegnamento e Materiale,
     * ma ogni materiale è associato a un solo insegnamento.
    */
    #[ORM\OneToMany(mappedBy: 'insegnamento', targetEntity: Materiale::class, fetch: 'EXTRA_LAZY')]
    private Collection $materiali;
    
    /** @var CorsoDiLaurea
    * un insegnamento può essere associato a un solo corso di laurea,
    * ma ogni corso di laurea può avere più insegnamenti associati,
    * quindi è una relazione molti a uno tra Insegnamento e CorsoDiLaurea,
    * La proprietà "corsoDiLaurea" rappresenta il corso di laurea a cui l'insegnamento è associato.
    * La colonna "corso_di_laurea_id" nella tabella "insegnamento" fa riferimento alla colonna "id" della tabella "corso_di_laurea".
    */
    #[ORM\ManyToOne(targetEntity: CorsoDiLaurea::class, inversedBy: 'insegnamenti')]
    #[ORM\JoinColumn(name: "corsoDiLaurea_codice", referencedColumnName: "codiceCorso")]
    private CorsoDiLaurea $corsoDiLaurea; //relazione molti a uno

    /**
     * Costruttore di Insegnamento.
     * @param string $nomeInsegnamento Nome dell'insegnamento.
     * @param CorsoDiLaurea $corsoDiLaurea Corso di laurea a cui l'insegnamento è associato (opzionale).
     */
    public function __construct(
        string $nomeInsegnamento,
        CorsoDiLaurea $corsoDiLaurea,
        ){
        $this->nomeInsegnamento = $nomeInsegnamento;
        $this->corsoDiLaurea = $corsoDiLaurea;
        $this->materiali = new ArrayCollection();
    }

     /**
     * Imposta/modifica il codice dell'insegnamento.
     * @param int $codiceInsegnamento Nuovo codice.
     */
    public function setIdInsegnamento(int $codiceInsegnamento): void {
        $this->id = $codiceInsegnamento;
    }

    /**
     * Restituisce il codice dell'insegnamento.
     * @return int Il codice dell'insegnamento.
     */
    public function getIdInsegnamento(): int {
        return $this->id;
    }

     /**
     * Imposta/modifica il nome dell'insegnamento.
     * @param string $nomeInsegnamento Nuovo nome.
     */
    public function setNomeInsegnamento(string $nomeInsegnamento): void {
        $this->nomeInsegnamento = $nomeInsegnamento;
    }
   
    /**
     * Restituisce il nome dell'insegnamento.
     * @return string Il nome dell'insegnamento.
     */
    public function getNomeInsegnamento(): string {
        return $this->nomeInsegnamento;
    }

   /**
     * Aggiunge un materiale alla collezione dei materiali associati all'insegnamento.
     * @param Materiale $materiale Il materiale da aggiungere.
     */
    public function aggiungiMateriale(Materiale $materiale): void {
        $this->materiali[] = $materiale;
    }

    /**
     * Restituisce la collezione di materiali associati all'insegnamento.
     * @return Collection|Materiale[] La collezione di materiali associati all'insegnamento.
     */
    public function getMateriali(): Collection {
        return $this->materiali;
    }

     /**
     * Imposta/modifica il corso di laurea associato all'insegnamento.
     * @param CorsoDiLaurea $corsoDiLaurea Il nuovo corso di laurea da associare.
     */
    public function setCorsoDiLaurea(CorsoDiLaurea $corsoDiLaurea): void {
    $this->corsoDiLaurea = $corsoDiLaurea;
    }

    /**
     * Restituisce il corso di laurea a cui l'insegnamento è associato.
     * @return CorsoDiLaurea Il corso di laurea associato all'insegnamento.
     */
    public function getCorsoDiLaurea(): CorsoDiLaurea {
        return $this->corsoDiLaurea;
    }
  
}