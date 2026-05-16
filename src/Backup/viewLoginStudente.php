<?php
namespace UI;

class viewLoginStudente {

    public function getDatiLogin() : array {
        return [ 
            "email" => $_POST['email'] ?? '',
            "password" => $_POST['password'] ?? ''
        ];
       
    }
    /**
     * Visualizza la pagina di login dello studente
     * @return void
     */
    public function mostraSchermataLogin() : void {
    
    }

}

