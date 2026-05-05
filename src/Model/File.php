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

    #[ORM\Column(type: Types::BLOB)]
    private mixed $contenutoFile;

    #[ORM\Column(type: Types::STRING)]
    private string $MimeTypeFile;

    #[ORM\Column(type: Types::FLOAT)]
    private float $dimensioneFile;

    /**
     * Costruttore di file.
     * 
     * @param string $contenutoFile contenuto del file.
     * @param float $dimensioneFile Dimensione del file in megabyte.
     * @param string $MimeTypeFile tipo del file.
     */
    
    public function __construct(
        string $contenutoFile,
        string $MimeTypeFile, 
        float $dimensioneFile
        ) {
        $this->contenutoFile = $contenutoFile;
        $this->MimeTypeFile = $MimeTypeFile;
        $this->dimensioneFile = $dimensioneFile;
    }

    /**
     * Ottiene il tipo del file.
     * 
     * @return string tipo del file.
     */
    public function getmimeTypeFile(): string {
        return $this->MimeTypeFile;
    }

    /**
     * Imposta il tipo del file.
     * 
     * @param string $MimeTypeFile Tipo del file.
     */
    public function setMimeTypeFile(string $MimeTypeFile): void {
        $this->MimeTypeFile = $MimeTypeFile;
    }


    /**
     * Ottiene la dimensione del file.
     * 
     * @return float La dimensione del file in megabyte.
     */
    public function getDimensioneFile(): float {
        return $this->dimensioneFile;
    }

    /**
     * Imposta la dimensione del file.
     * 
     * @param float $dimensioneFile La dimensione del file in megabyte.
     */
    public function setDimensioneFile(float $dimensioneFile): void {
        $this->dimensioneFile = $dimensioneFile;
    }

    /**
     * Ottiene il contenuto del file.
     * 
     * @return string Il contenuto del file.
     */
   public function getContenutoFile(): string
    {
        if (is_resource($this->contenutoFile)) {
            return stream_get_contents($this->contenutoFile);
        }
        return $this->contenutoFile;
    }

    /**
     * Imposta il contenuto del file.
     * 
     * @param string $contenutoFile Il contenuto del file.
     */
    public function setContenutoFile(string $contenutoFile): void {
        $this->contenutoFile = $contenutoFile;
    }
}