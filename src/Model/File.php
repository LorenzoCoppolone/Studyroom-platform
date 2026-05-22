<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;


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
        string $contenutoFile,
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
    public function setmimeTypeFile(string $mimeTypeFile): void {
        $this->mimeTypeFile = $mimeTypeFile;
    }

    /**
     * Ottiene il tipo del file.
     * @return string tipo del file.
     */
    public function getmimeTypeFile(): ?string {
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
    public function setContenutoFile(string $contenutoFile): void {
        $this->contenutoFile = $contenutoFile;
    }

    /**
     * Ottiene il contenuto del file.
     * @return string Il contenuto del file.
     */
   public function getContenutoFile(): string
    {
        if (is_resource($this->contenutoFile)) {
            return stream_get_contents($this->contenutoFile);
        }
        return $this->contenutoFile;
    }

}