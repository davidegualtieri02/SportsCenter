<?php
class CCampi{
    public static function caricaCampi(){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VCampi();
        if (CAmministratore::Loggato()){
            $amm= unserialize($sessione->LeggiValore('Amministratore'));
            // Recupera i campi da tutte le tabelle specificate usando recuperaOggetto        
            if(UServer::getRichiestaMetodo()=='GET'){
                $campi_basket[] = $pm::RecuperaTuple(FCampo_Basket::getTabella());
                 $campi_pallavolo[] = $pm::RecuperaTuple(FCampo_Pallavolo::getTabella());
                $campi_calcio[] = $pm::RecuperaTuple(FCampo_Calcio::getTabella());
                $campi_tennis[] = $pm::RecuperaTuple(FCampo_Tennis::getTabella());
                 $campi_padel[] = $pm::RecuperaTuple(FCampo_Padel::getTabella());
            // Aggiunge tutti i campi contenuti negli array sopra  in un unico array campi
                 $campi = array_merge($campi_basket[], $campi_pallavolo[], $campi_calcio[], $campi_tennis[],$campi_padel[]);

            // quando aggiungiamo un campo , siccome fotocampo è un attributo del campo viene caricata e visualizzata anche l'immagine del campo insieme a tutto il campo
             // Passa i dati alla vista per la visualizzazione
                $view->mostraCampi($campi,$amm);//la view mostra i campi e per ogni campo mostra la propria foto.
            }
         }
        else{
        header("Location: SportsCenter/Amministratore/login");
       }
    }
}