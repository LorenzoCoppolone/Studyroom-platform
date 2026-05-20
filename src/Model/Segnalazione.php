<?php
namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity]
#[ORM\Table(uniqueConstraints: [
        new ORM\UniqueConstraint(
            name: "unique_segnalazione",
            columns: ["materialeSegnalato_id", "segnalante_id"])]
)]
class Segnalazione {

    #[ORM\Column(type: Types::INTEGER), ORM\Id, ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[ORM\Column(type: Types::STRING)]
    private string $motivo;
    
    #[ORM\ManyToOne(targetEntity: Studente::class, inversedBy: "segnalazioniFatte")]
    private Studente $segnalante;

    #[ORM\ManyToOne(targetEntity: Materiale::class, inversedBy: "segnalazioni")]
    private Materiale $materialeSegnalato;

    #[ORM\ManyToOne(targetEntity: Amministratore::class, inversedBy: "segnalazioni")]
    private Amministratore $amministratore;

    /**
     * Costruttore di segnalazione.
     * @param string $motivo Motivo della segnalazione.
     * @param Studente $segnalante studente che ha segnalato.
     * @param Materiale $materialeSegnalato materiale segnalato.
     * @param Amministratore $amministratore amministratore che gestisce la segnalazione.
     */

    public function __construct(
        string $motivo,  
        Studente $segnalante,
        Materiale $materialeSegnalato,
        Amministratore $amministratore
        ) {
        $this->motivo = $motivo;
        $this->segnalante = $segnalante;
        $this->materialeSegnalato = $materialeSegnalato;
        $this->amministratore = $amministratore;
    }

    /**
     * Imposta/modifica l'ID della segnalazione.
     * @param int $id Nuovo ID.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Restituisce l'ID della segnalazione.
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Imposta/modifica il motivo della segnalazione.
     * @param string $motivo Nuovo motivo.
     */
    public function setMotivo(string $motivo): void {
        $this->motivo = $motivo;
    }

    /**
     * Restituisce il motivo della segnalazione.
     * @return string
     */
    public function getMotivo(): string {
        return $this->motivo;
    }

    /**
     * Imposta/modifica lo studente segnalante.
     * @param Studente $segnalante Nuovo segnalante.
     */
    public function setSegnalante(Studente $segnalante): void {
        $this->segnalante = $segnalante;
    }

    /**
     * Restituisce lo studente che ha effettuato la segnalazione.
     * @return Studente
     */
    public function getSegnalante(): Studente {
        return $this->segnalante;
    }

     /**
     * Imposta/modifica il materiale segnalato.
     * @param Materiale $materiale Nuovo materiale.
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materialeSegnalato = $materiale;
    }

    /**
     * Restituisce il materiale segnalato.
     * @return Materiale
     */
    public function getMateriale(): Materiale {
        return $this->materialeSegnalato;
    }

     /**
     * Imposta/modifica l'amministratore.
     * @param Amministratore $amministratore Nuovo amministratore.
     */
    public function setAmministratore(Amministratore $amministratore): void {
        $this->amministratore = $amministratore;
    }

    /**
     * Restituisce l'amministratore che gestisce la segnalazione.
     * @return Amministratore
     */
    public function getAmministratore(): Amministratore {
        return $this->amministratore;
    }

}