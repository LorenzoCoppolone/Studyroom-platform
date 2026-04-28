<?php
class PerstistentManager {

    public function cercaMateriale( String $titolo) : Array{
        $tuttiIMateriali = [
            new Appunto("M001", "Fondamenti di Informatica", "Rossi",    2020),
            new Appunto("M002", "Programmazione Web",        "Bianchi",  2021),
            new Esame("M003", "Basi di Dati",              "Verdi",    2019),
            new Esame("M004", "Programmazione OO",         "Rossi",    2022),
            new Esame("M005", "Reti di Calcolatori",       "Neri",     2020),
            new Esame("M006", "Algoritmi e Strutture Dati","Bianchi",  2021),
        ];
        return $tuttiIMateriali;
    }

}