<?php

class Amministratore extends Utente{



    /**
     * Costruttore di amministratore.
     * 
     * @param int $id ID dell'amministratore.
     * @param string $nome Nome dell'amministratore.
     * @param string $cognome Cognome dell'amministratore.
     * @param string $email Email dell'amministratore.
     * @param string $password Password dell'amministratore.
     */
    public function __construct(int $id, string $nome, string $cognome, string $email, string $password){
        parent::__construct($id, $nome, $cognome, $email, $password);
    }
}