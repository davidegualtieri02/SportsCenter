<?php
class CCampi{
    public static function caricaCampi(){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VCampi();
        if (CAmministratore::Loggato()){
            $amm= unserialize($sessione->LeggiValore('Amministratore'));
            // Recupera i campi da tutte le tabelle specificate usando recuperaOggetto
            $campi_basket = $pm::recuperaOggetto('FCampo_Basket', ECampo_Basket::getIdCampoBasket()); //ogni variabile $campi_tipocampo sarà un array di campi di quel tipo che poi saranno messi in un unico array
            $campi_pallavolo = $pm::recuperaOggetto('FCampo_Pallavolo', ECampo_Pallavolo::getIdCampoPallavolo());
            $campi_calcio = $pm::recuperaOggetto('FCampo_Calcio', ECampo_Calcio::getIdCampoCalcio());
            $campi_tennis = $pm::recuperaOggetto('FCampo_Tennis', ECampo_Tennis::getIdCampoTennis());
            $campi_padel = $pm::recuperaOggetto('FCampo_Padel', ECampo_Padel::getIdCampoPadel());
             // Combina tutti i campi in un unico array
             $campi = array_merge($campi_basket, $campi_pallavolo, $campi_calcio, $campi_tennis,$campi_padel);

            // Carica le foto dei campi sportivi
            $campi_foto = []; // è un array che ha ogni campo come chiave e la foto del campo come valore 
            foreach ($campi as $campo) {
                $foto = $pm::recuperaOggetto('FImage',EImage::getId()); // recupero una foto per ogni campo che sarà aggiunta per ogni campo 
                $campi_foto[$campo->getId()] = $foto; // Usa l'id del campo come chiave per l'array delle foto
            }

             // Passa i dati alla vista per la visualizzazione
             $view->mostraCampi($campi, $campi_foto);//la view mostra i campi e per ogni campo mostra la propria foto.
        }
        else{
        header("Location: SportsCenter/Amministratore/login");
       }
    }
}