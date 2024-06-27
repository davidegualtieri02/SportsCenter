<?php
//use DateTime; //Utilizzo di una classe di default, quindi non è necessario usare use

class ECartadiPagamento{
    private String $Nome_Titolare;
    private String $Cognome_Titolare;
    private int $Numero_Carta;
    private DateTime $Data_Scadenza;
    private int $CVV;
    private int $id_cartadiPagamento;

    private static $entità = ECartadiPagamento::class;

    public function __construct($Nome_Titolare, $Cognome_Titolare, $Numero_Carta, $Data_Scadenza, $CVV){
        $this->Nome_Titolare = $Nome_Titolare;
        $this->Cognome_Titolare = $Cognome_Titolare;
        $this->Numero_Carta = $Numero_Carta;
        $this->Data_Scadenza = $Data_Scadenza;
        $this->$CVV = $CVV;
    
    }
    public function getNomeTitolare(){
        return $this->Nome_Titolare;
    }
    public function setNomeTitolare($nometitolare){
        $this->Nome_Titolare = $nometitolare;

    }
    public function getCognomeTitolare(){
        return $this->Cognome_Titolare;
    }
    public function setCognomeTitolare($cognometitolare){
        $this->Cognome_Titolare = $cognometitolare;
    }
    public function getNumeroCarta(){
        return $this->Numero_Carta;
    }
    public function setNumeroCarta($numerocarta){
        $this->Numero_Carta = $numerocarta;
    }
    public function getDataScadenza():DateTime{
        return $this->Data_Scadenza;
    }
    public function setDataScadenza(DateTime $Data_Scadenza){
        $this->Data_Scadenza = $Data_Scadenza;
    }
    public function getCVV(){
        return $this->CVV;
    }
    public function setCVV($CVV){
        $this->CVV = $CVV;
    }
    public function getIdCarta(){
        return $this->id_cartadiPagamento;
    }
    public function setIdCarta($id_cartadiPagamento){
        $this->id_cartadiPagamento = $id_cartadiPagamento;
    }
    public static function getEntità():string{
        return self::$entità;
    }
     //metodo toString esiste predefinito
}