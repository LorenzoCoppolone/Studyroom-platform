<?php
namespace Controller;
use Model\Esame;
use Model\Appunto;
use Model\Materiale;
use Model\Insegnamento;
use Model\CorsoDiLaurea;
use Model\File;
use Model\Studente;
use Foundation\Persistent\PersistentManager;
use PDOException;
use Exception;
use InvalidArgumentException;
use RuntimeException;
use Model\Tag;

class CaricaMaterialeController {

    private bool $termini_condizioni; // Variabile per memorizzare se l'utente ha accettato i termini e condizioni

    /**
     * Costruttore della classe Caricamento_Materiale
     * @param bool $termini_condizioni
     */
    public function __construct(bool $termini_condizioni = false) {
        $this->termini_condizioni = $termini_condizioni?: false;
    }


    /**
     * Restituisce lo stato dei termini e condizioni
     * @return bool
     */
    public function getTerminiCondizioni(): bool {
        return $this->termini_condizioni;
    }

    /**
     * Imposta lo stato dei termini e condizioni
     * @param bool $termini_condizioni
     */
    public function setTerminiCondizioni(bool $termini_condizioni): void {
        $this->termini_condizioni = $termini_condizioni;
    }



    /**
     * Richiede il caricamento del materiale, mostrando il modulo di caricamento
     * @return string
     */
    public function Richiedi_caricamento(): string {
        return "__";
        // logica per richiedere il caricamento del materiale, mostrando il modulo di caricamento
    }


    /**
     * Carica il materiale nel sistema
     * @param string $titolo
     * @param string $insegnamento
     * @param string $corso_di_laurea
     * @param string $tag
     * @param File $file
     * @param bool $termini_condizioni
     * @return bool
     */
  
    
 public function caricaMateriale(): void
{


    try {



    // 1. Recupero corso di laurea dal DB
    $pm = PersistentManager::getInstance();

    $corso_di_laurea = $pm->findOneBy("Model\CorsoDiLaurea", [
        "nomeCorsoDiLaurea" => $corso_di_laurea
    ]);



    if (!$corso_di_laurea) {
        throw new \RuntimeException("Corso di laurea '$corso_di_laurea' non trovato");
    }


    // 2. Recupero insegnamento dal DB
    $insegnamento = $pm->findOneBy("Model\Insegnamento", [
        "nomeInsegnamento" => $insegnamentoInput,
        "corsoDiLaurea_codice" => $corso_di_laurea->getIdCorsoDiLaurea()
    ]);


    if (!$insegnamento) {
        throw new \RuntimeException("Insegnamento '$insegnamentoInput' non trovato");
    }

    // 3. Recupero studente loggato
    $studente = $pm->findOneBy("Model\Studente", [
        "id" => $id_studente
    ]);

    if (!$studente) {
        throw new \RuntimeException("Studente non trovato");
    }

    // 4. Creo l’oggetto materiale in base al tipo
    if ($tipo === "appunto") {

        if ($tag === null) {
            throw new \RuntimeException("Il tag è obbligatorio per gli appunti"); //siamo sicuri che il tag non puo essere null?
        }

        // converto il tag in enum
        $tagEnum = Tag::tryFrom(strtolower($tag));
        if (!$tagEnum) {
            throw new \RuntimeException("Tag '$tag' non valido");
        }

        $materiale = new Appunto(
            $titolo,
            $file,
            $insegnamento,
            $studente,
            $tagEnum
        );

    } else{

        $materiale = new Esame(
            $titolo,
            $file,
            $insegnamento,
            $studente
        );

    }

        // 5. Salvo il materiale
        $pm->save($materiale);
        
    } catch (\Exception $e) {
        throw new \RuntimeException("Errore durante il caricamento del materiale: " . $e->getMessage());
    }
}




    /**
     * Esegue l'accettazione dei termini e condizioni da parte dell'utente.
     * @return void
     */
    public function Accetta_termini_condizioni(): void {
        $this->termini_condizioni = true;
    }

}

