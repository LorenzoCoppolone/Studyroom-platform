<?php
namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
#[ORM\Entity]
class Insegnamento {

    
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 10, unique: true)]
    private int $codiceInsegnamento;

    #[ORM\Column(type: Types::STRING)]
    private string $nomeInsegnamento;

    /** @var Collection<int, Materiale> 
     * un insegnamento può avere più materiali associati,
     * quindi è una relazione OneToMany tra Insegnamento e Materiale,
     * ma ogni materiale è associato a un solo insegnamento.
    */
    #[ORM\OneToMany(mappedBy: 'insegnamento', targetEntity: Materiale::class)]
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
     * 
     * @param int $codiceInsegnamento Codice dell'insegnamento.
     * @param string $nomeInsegnamento Nome dell'insegnamento.
     * @param Collection $materiali Collezione di materiali associati all'insegnamento.
     * @param CorsoDiLaurea $corsoDiLaurea Corso di laurea a cui l'insegnamento è associato (opzionale).
     */
    public function __construct(
        int $codiceInsegnamento,
        string $nomeInsegnamento,
        CorsoDiLaurea $corsoDiLaurea,
        Collection $materiali = new ArrayCollection()
        ){
        $this->codiceInsegnamento = $codiceInsegnamento;
        $this->nomeInsegnamento = $nomeInsegnamento;
        $this->corsoDiLaurea = $corsoDiLaurea;
        $this->materiali = $materiali;
    }




    /**
     * Restituisce il codice dell'insegnamento.
     * 
     * @return int Il codice dell'insegnamento.
     */
    public function getCodiceInsegnamento(): int {
        return $this->codiceInsegnamento;
    }

    /**
     * Imposta/modifica il codice dell'insegnamento.
     * 
     * @param int $codiceInsegnamento Nuovo codice.
     * @return void
     */
    public function setCodiceInsegnamento(int $codiceInsegnamento): void {
        $this->codiceInsegnamento = $codiceInsegnamento;
    }

    /**
     * Restituisce il nome dell'insegnamento.
     * 
     * @return string Il nome dell'insegnamento.
     */
    public function getNomeInsegnamento(): string {
        return $this->nomeInsegnamento;
    }

    /**
     * Imposta/modifica il nome dell'insegnamento.
     * 
     * @param string $nomeInsegnamento Nuovo nome.
     * @return void
     */
    public function setNomeInsegnamento(string $nomeInsegnamento): void {
        $this->nomeInsegnamento = $nomeInsegnamento;
    }

    /**
     * Restituisce la collezione di materiali associati all'insegnamento.
     * 
     * @return Collection|Materiale[] La collezione di materiali associati all'insegnamento.
     */
    public function getMateriali(): Collection {
        return $this->materiali;
    }

    /**
     * Aggiunge un materiale alla collezione dei materiali associati all'insegnamento.
     * 
     * @param Materiale $materiale Il materiale da aggiungere.
     * @return void
     */
    public function aggiungiMateriale(Materiale $materiale): void {
        $this->materiali[] = $materiale;
    }

    /**
     * Restituisce il corso di laurea a cui l'insegnamento è associato.
     * 
     * @return CorsoDiLaurea Il corso di laurea associato all'insegnamento.
     */
    public function getCorsoDiLaurea(): CorsoDiLaurea {
        return $this->corsoDiLaurea;
    }

    /**
     * Imposta/modifica il corso di laurea associato all'insegnamento.
     * 
     * @param CorsoDiLaurea $corsoDiLaurea Il nuovo corso di laurea da associare.
     * @return void
     */
    public function setCorsoDiLaurea(CorsoDiLaurea $corsoDiLaurea): void {
    $this->corsoDiLaurea = $corsoDiLaurea;
    }
    
}