<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Model\Studente;

/**
 * Classe che rappresenta un file associato a un materiale.
 * La classe è definita come un'entità Doctrine ma non è mappata in una tabella separata, 
 * poiché è incorporata all'interno della classe Materiale.
 * lo notiamo dalla presenza dell'annotazione #[ORM\Embeddable] 
 * e dall'uso di #[ORM\Embedded] nella classe Materiale.
 */

#[ORM\Embeddable]
class File{

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private mixed $contenutoFile;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $mimeTypeFile;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    private ?float $dimensioneFile;

    /**
     * Costruttore di file.
     * 
     * @param string $contenutoFile contenuto del file.
     * @param float $dimensioneFile Dimensione del file in megabyte.
     * @param string $mimeTypeFile tipo del file.
     */
    
    public function __construct(
        mixed $contenutoFile,
        string $mimeTypeFile, 
        float $dimensioneFile
        ) {
        $this->contenutoFile = $contenutoFile;
        $this->mimeTypeFile = $mimeTypeFile;
        $this->dimensioneFile = $dimensioneFile;
    }

    /**
     * Imposta il tipo del file.
     * @param string $mimeTypeFile Tipo del file.
     */
    public function setMimeTypeFile(string $mimeTypeFile): void {
        $this->mimeTypeFile = $mimeTypeFile;
    }

    /**
     * Ottiene il tipo del file.
     * @return string tipo del file.
     */
    public function getMimeTypeFile(): ?string {
        return $this->mimeTypeFile;
    }

     /**
     * Imposta la dimensione del file.
     * @param float $dimensioneFile La dimensione del file in megabyte.
     */
    public function setDimensioneFile(float $dimensioneFile): void {
        $this->dimensioneFile = $dimensioneFile;
    }

    /**
     * Ottiene la dimensione del file.
     * @return float La dimensione del file in megabyte.
     */
    public function getDimensioneFile(): ?float {
        return $this->dimensioneFile;
    }

    /**
     * Imposta il contenuto del file.
     * @param string $contenutoFile Il contenuto del file.
     */
    public function setContenutoFile(?string $contenutoFile): void {
        $this->contenutoFile = $contenutoFile;
    }

    /**
     * Ottiene il contenuto del file.
     * @return string Il contenuto del file.
     */
   public function getContenutoFile(): ?string
    {
        if (is_resource($this->contenutoFile)) {
            return stream_get_contents($this->contenutoFile);
        }
        return $this->contenutoFile;
    }

    public function getBase64(Studente $studente): ?string {
      $img = $studente->getImmagineProfilo();
$base64 = null;

if ($img) {

    $contenuto = $img->getContenutoFile();

    // Caso: Doctrine restituisce uno stream
    if (is_resource($contenuto)) {
        rewind($contenuto); // fondamentale
        $contenuto = stream_get_contents($contenuto);
    }

    // Caso: Doctrine restituisce già una stringa binaria
    if (is_string($contenuto) && strlen($contenuto) > 0) {
        $base64 = 'data:' . $img->getMimeTypeFile() . ';base64,' . base64_encode($contenuto);
    }
}

return $base64;
    }

    public function fileToBase64(): ?string
    {

        $contenuto = $this->getContenutoFile();

        if (!$contenuto) {
            return null;
        }

    // Caso 1: Doctrine restituisce uno stream (tipico dei BLOB)
        if (is_resource($contenuto)) {
            rewind($contenuto); // fondamentale
            $contenuto = stream_get_contents($contenuto);
        }

    // Caso 2: Doctrine restituisce già una stringa binaria
        if (is_string($contenuto) && strlen($contenuto) > 0) {
            return 'data:' . $this->getMimeTypeFile() . ';base64,' . base64_encode($contenuto);
        }
        return null;
    }

}