<?php
abstract class Utente {
    // Private properties
    private int $id_utente;
    private string $nome;
    private string $cognome;  
    private string $email;
    private string $password;



    /**
     * Costruttore di utente.
     * 
     * @param int $id ID dell'utente.
     * @param string $nome Nome dell'utente.
     * @param string $cognome Cognome dell'utente.
     * @param string $email Email dell'utente.
     * @param string $password Password dell'utente.
     */
    public function __construct(int $id, string $nome, string $cognome, string $email, string $password) {
        $this->id_utente = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Inserisce l'ID dell'utente.
     * 
     * @param int $id The ID of the utente.
     */
    public function setId(int $id): void {
        $this->id_utente = $id;
    }




     /**
     * Inserisce il nome dell'utente.
     * 
     * @param string $nome Nome dell'utente.
     */
    public function setNome(string $nome): void {
        $this->nome = $nome;
    }




    /**
    * Inserisce il cognome dell'utente.
    * 
    * @param string $cognome Cognome dell'utente.
    */
    public function setCognome(string $cognome): void {
        $this->cognome = $cognome;
    }




    /**
    * Inserisce l'email dell'utente.
    * 
    * @param string $email Email dell'utente.
    */
    public function setEmail(string $email): void {
        $this->email = $email;
    }




    /**
    * Inserisce la password dell'utente.
    * 
    * @param string $password Password dell'utente.
    */
    public function setPassword(string $password): void {
        $this->password = $password;
    }




    /**
     * Ritorna l'ID dell'utente.
     * 
     * @return int ID dell'utente.
     */
    public function getId(): int{
        return $this->id_utente;
    }



    /**
     * Ritorna il nome dell'utente.
     * 
     * @return string Nome dell'utente.
     */
    public function getNome(): string {
        return $this->nome;
    }





    /**
     * Ritorna il cognome dell'utente.
     * 
     * @return string Cognome dell'utente.
     */
    public function getCognome(): string{
        return $this->cognome;
    }




    /**
     * Ritorna l'email dell'utente.
     * 
     * @return string Email dell'utente.
     */
    public function getEmail(): string {
        return $this->email;
    }




    /**
     * Ritorna la password dell'utente.
     * 
     * @return string Password dell'utente.
     */
    public function getPassword(): string {
        return $this->password;
    }
}