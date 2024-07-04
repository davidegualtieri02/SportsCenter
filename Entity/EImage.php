<?php

//Definizione la classe EImage
class EImage{

    //Dichiarazione di una variabile privata per l'ID dell'immagine
    private int $id_image = 0;

    //Dichiarazione di una variabile privata per il nome dell'immagine
    private string $nome;

    //Dichiarazione di una variabile privata per la grandezza dell'immagine
    private int $grandezza;

    //Dichiarazione di una variabile privata per il tipo dell'immagine
    private string $tipo;

    //Dichiarazione di una variabile privata per i dati dell'immagine
    private string $imageData;

    //Dichiarazione di una variabile privata per la recensione a cui l'immagine appartiene
    private int $id_recensione;

    //Dichiarazione di una variabile statica privata per l'entità dell'immagine
    private static $entità = EImage::class;

    //Definizione del costruttore della classe
    public function __construct($nome, $grandezza, $tipo, $imageData, $id_recensione){
        $this->nome = $nome; //Assegnazione del valore del parametro al campo nome
        $this->grandezza = $grandezza; //Assegnazione del valore del parametro al campo grandezza
        $this->tipo = $tipo; //Assegnazione del valore del parametro al campo tipo
        $this->imageData = $imageData; //Assegnazione del valore del parametro al campo imageData
        $this->id_recensione = $id_recensione;
    }

    //Definizione di un metodo statico che restituisce l'entità dell'immagine
    public static function getEntità(){
        return self::$entità; //Restituise il valore dell'entità
    }

    //Definizione di un metodo per ottenere l'ID dell'immagine
    public function getId(){
        return $this->id_image; //Restituisce il valore dell'ID dell'immagine
    }

    //Definizione di un metodo per impostare l'ID dell'immagine
    public function setId($id){
        $this->id_image = $id; //Assegna il valore del parametro al campo idImage
    }

    //Definizione di un metodo per ottenere il nome dell'immagine
    public function getNome(){
        return $this->nome; //Restituisce il valore del nome dell'immagine
    }

    //Definizione di un metodo per ottenere la grandezza dell'immagine
    public function getGrandezza(){
        return $this->grandezza; //Restituisce il valore della grandezza dell'immagine
    }

    //Definizione di un metodo per ottenere il tipo dell'immagine
    public function getTipo(){
        return $this->tipo; //Restituisce il valore del tipo dell'immagine
    }

    //Definizione di un metodo per ottenere i dati dell'immagine
    public function getImageData(){
        return $this->imageData; //Restituisce il valore dei dati dell'immagine
    }

    //Definizione di un metodo per ottenere i dati codificati dell'immagine
    public function getEncodedData(){
        return base64_encode($this->imageData); //Restituisce i dati dell'immagine codificati in base64, per inserire i dati dell'immagine nel DB
    }

    //Definizione di un metodo per ottenere la recensione a cui l'immagine appartiene
    public function getRecensione(){
        return self::$id_recensione; //Restituisce il valore della recensione a cui l'immagine appartiene
    }

    //Definizione di un metodo per impostare la recensione a cui è collegata l'immagine
    public function setRecensione($id_recensione){
         $this->id_recensione = $id_recensione ; //Assegna il valore del parametro al campo recensione
    }
}