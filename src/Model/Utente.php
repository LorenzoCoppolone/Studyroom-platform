<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\MappedSuperclass]
abstract class Utente {

    // Protected properties

    #[ORM\Column(type: Types::INTEGER)]
   
    #[ORM\Id]

    #[ORM\GeneratedValue(strategy: "AUTO")]
    protected int $id;

    #[ORM\Column(type: Types::STRING)]
    protected string $nome;

    #[ORM\Column(type: Types::STRING)]
    protected string $cognome; 

    #[ORM\Column(type: Types::STRING)]
    protected string $email;

    #[ORM\Column(type: Types::STRING)]
    protected string $passwordHash;

    /**
     * Costruttore di utente.
     * @param string $nome Nome dell'utente.
     * @param string $cognome Cognome dell'utente.
     * @param string $email Email dell'utente.
     * @param string $passwordHash Password dell'utente.
     */
    
    public function __construct( 
        string $nome, 
        string $cognome, 
        string $email, 
        string $passwordHash
        ) {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    /**
     * Inserisce l'ID dell'utente.
     * @param int $id The ID of the utente.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

     /**
     * Ritorna l'ID dell'utente.
     * @return int ID dell'utente.
     */
    public function getId(): int{
        return $this->id;
    }

     /**
     * Inserisce il nome dell'utente.
     * @param string $nome Nome dell'utente.
     */
    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    /**
     * Ritorna il nome dell'utente.
     * @return string Nome dell'utente.
     */
    public function getNome(): string {
        return $this->nome;
    }
    /**
    * Inserisce il cognome dell'utente.
    * @param string $cognome Cognome dell'utente.
    */
    public function setCognome(string $cognome): void {
        $this->cognome = $cognome;
    }

     /**
     * Ritorna il cognome dell'utente.
     * @return string Cognome dell'utente.
     */
    public function getCognome(): string{
        return $this->cognome;
    }

    /**
    * Inserisce l'email dell'utente.
    * @param string $email Email dell'utente.
    */
    public function setEmail(string $email): void {
        $this->email = $email;
    }

     /**
     * Ritorna l'email dell'utente.
     * @return string Email dell'utente.
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
    * Inserisce la password dell'utente.
    * @param string $passwordHash Password dell'utente.
    */
    public function setPassword(string $passwordHash): void {
        $this->passwordHash = $passwordHash;
    }

    /**
     * Ritorna la password dell'utente.
     * @return string Password dell'utente.
     */
    public function getPassword(): string {
        return $this->passwordHash;
    }

}