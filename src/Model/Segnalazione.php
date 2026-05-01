<?php
namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Segnalazione {

    #[ORM\Column(type: Types::INTEGER), ORM\Id, ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[ORM\Column(type: Types::STRING)]
    private string $motivo;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $timeStamp;
    
    #[ORM\ManyToOne(targetEntity: Studente::class, inversedBy: "segnalazioniFatte")]
    private Studente $segnalante;

    #[ORM\ManyToOne(targetEntity: Materiale::class, inversedBy: "segnalazioni")]
    private Materiale $materialeSegnalato;

    #[ORM\ManyToOne(targetEntity: Amministratore::class, inversedBy: "segnalazioni")]
    private Amministratore $amministratore;

    /**
     * Costruttore di segnalazione.
     * @param int $id ID della segnalazione.
     * @param string $motivo Motivo della segnalazione.
     * @param Studente $segnalante studente che ha segnalato.
     * @param Materiale $materialeSegnalato materiale segnalato.
     * @param Amministratore $amministratore amministratore che gestisce la segnalazione.
     */

    public function __construct(
        int $id, 
        string $motivo,  
        Studente $segnalante,
        Materiale $materialeSegnalato,
        Amministratore $amministratore
        ) {
        $this->id = $id;
        $this->motivo = $motivo;
        $this->timeStamp = new \DateTimeImmutable();
        $this->segnalante = $segnalante;
        $this->materialeSegnalato = $materialeSegnalato;
        $this->amministratore = $amministratore;
    }

    /**
     * Restituisce l'ID della segnalazione.
     * 
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Imposta/modifica l'ID della segnalazione.
     * 
     * @param int $id Nuovo ID.
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Restituisce il motivo della segnalazione.
     * 
     * @return string
     */
    public function getMotivo(): string {
        return $this->motivo;
    }

    /**
     * Imposta/modifica il motivo della segnalazione.
     * 
     * @param string $motivo Nuovo motivo.
     * @return void
     */
    public function setMotivo(string $motivo): void {
        $this->motivo = $motivo;
    }

    /**
     * Restituisce la data/ora della segnalazione.
     * 
     * @return \DateTimeImmutable
     */
    public function getTimeStamp(): \DateTimeImmutable {
        return $this->timeStamp;
    }

    /**
     * Imposta/modifica il timestamp della segnalazione.
     * 
     * @param \DateTimeImmutable $timeStamp Nuova data/ora.
     * @return void
     */
    public function setTimeStamp(\DateTimeImmutable $timeStamp): void {
        $this->timeStamp = $timeStamp;
    }

    /**
     * Restituisce lo studente che ha effettuato la segnalazione.
     * 
     * @return Studente
     */
    public function getSegnalante(): Studente {
        return $this->segnalante;
    }

    /**
     * Imposta/modifica lo studente segnalante.
     * 
     * @param Studente $segnalante Nuovo segnalante.
     * @return void
     */
    public function setSegnalante(Studente $segnalante): void {
        $this->segnalante = $segnalante;
    }
  
    /**
     * Restituisce il materiale segnalato.
     * 
     * @return Materiale
     */
    public function getMateriale(): Materiale {
        return $this->materialeSegnalato;
    }

    /**
     * Imposta/modifica il materiale segnalato.
     * 
     * @param Materiale $materiale Nuovo materiale.
     * @return void
     */
    public function setMateriale(Materiale $materiale): void {
        $this->materialeSegnalato = $materiale;
    }

    /**
     * Restituisce l'amministratore che gestisce la segnalazione.
     * 
     * @return Amministratore
     */
    public function getAmministratore(): Amministratore {
        return $this->amministratore;
    }

    /**
     * Imposta/modifica l'amministratore.
     * 
     * @param Amministratore $amministratore Nuovo amministratore.
     * @return void
     */
    public function setAmministratore(Amministratore $amministratore): void {
        $this->amministratore = $amministratore;
    }

}