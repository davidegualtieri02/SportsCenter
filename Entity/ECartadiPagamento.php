<?php 
class ECartadiPagamento{
    private String $Nome_Titolare;
    private String $Cognome_Titolare;
    private int $Numero_Carta;
    private Data $Data_Scadenza;
    private int $CVV;
    private int $Id_Carta;

    private static $entità = ECartadiPagamento::class;

    public function __construct($Nome_Titolare,$Cognome_Titolare,$Numero_Carta,$Data_Scadenza,$CVV,$Id_Carta){
        $this->Nome_Titolare = $Nome_Titolare;
        $this->Cognome_Titolare = $Cognome_Titolare;
        $this->Numero_Carta = $Numero_Carta;
        $this->Data_Scadenza= $Data_Scadenza;
        $this->$CVV= $CVV;
        $this->Id_Carta= $Id_Carta;
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
    public function getCVV(){
        return $this->CVV;
    }
    public function setCVV($CVV){
        $this->$CVV= $CVV;
    }
    public function getIdCarta(){
        return $this->Id_Carta;
    }
    public function setIdCarta($Id_Carta){
        $this->Id_Carta= $Id_Carta;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    
}