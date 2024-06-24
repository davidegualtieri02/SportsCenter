//funzione chiamata quando si clicca sul metodo prenotaCampo in CPrenotacampo
function prenotaCampo(){
    //esegue una chiamata AJAX per ottenere i campi sportivi disponibili. il formato JSON è comunemente utilizzato per trasmettere dati tra il client(il nostro browser) e il server 
    $(documento).ready(function(){ // quando il documento con i campi è pronto 
        $('#prenota_campo-btn').click(function(){//la stringa dovrebbe contenere l'id del campo
             $.ajax({
                url :'CCampo.php',
                type : 'GET',
                dataType : 'json',
                success : function(campi){ // se la funzione AJAX ha successo, cioè vengono ripresi i dati dei campi, viene richiamata la funzione function(campi)
                //campi rappresenta i dati ottenuti dal server, cioè i campi
                    console.log(campi);//possiamo stampare i dati nella console per verificarli 
                    mostraCampiSportivi(campi); // chiamata riuscita visualizziamo i campi sportivi
                }
            });
        });
    });
};