<?php

namespace UI;

class ViewUser {


    //Funzione che mostra la form di registrazione 
    public function mostraFormRegistrazione () { 

        // implementazione html form oppure chiamata a funzione che lo fa

    }

    //Funzione che recupera dati inseriti nella form di registrazione

    public function getDatiRegistrazione() : array {
        
        return [
            'nome' => $_POST['nome'] ?? '',
            'cognome' => $_POST['cognome'] ?? '',
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? ''
        ];

    }
   
}