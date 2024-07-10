<?php
/*
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequestFactory;

// Crea un'istanza del router
$router = new Router;

// Imposta la strategia di applicazione per il router
$strategy = new ApplicationStrategy;
$router->setStrategy($strategy);

// Definisci le rotte
$router->map('GET', '/'){
    $response = new Response;
    $response->getBody()->write('Hello, World!');
    return $response;
});

$router->map('GET', '/Servizi',CPrenotaCampo::mostraCampi()) {
    $response = new Response;
    $response->getBody()->write('About Us Page');
    return $response;
});

// Restituisci il router configurato
return $router;


*/

function route($uri){
    $smarty = new Smarty();
    $smarty->setTemplateDir('/smarty/libs/templates');
    $smarty->setCompileDir('/smarty/libs/templates_c');
   //rimuove la query string
    $uri = strtok($uri,'?');
    switch($uri){
        default:
            http_response_code(404);
            echo "404 Not Found";
            break;
        
        case '/home':
            require 'Controller/CUtente.php';
            $controller = new CUtente();
            $controller->home();
            break;
        case '/':
            $smarty->dispaly('index.tpl');
            break;
        case '/servizi':
            require 'Controller/CPrenotaCampo.php';
            $controller = new CPrenotaCampo();
            $controller->mostraCampi();
            break;
        case '/calendario':
            require 'Controller/CPrenotaCampo.php';
            $controller = new CPrenotaCampo();
            $controller->MostraCalendario($idCampo);
            break;
        case '/calendario/orario' :
            require 'Controller/CPrenotaCampo.php';
            $controller = new CPrenotaCampo();
            $controller->MostraOrari($idCampo,$giorno);
            break;
        case '/calendario/orario/attrezzatura' :
            require 'Controller/CPrenotaCampo.php';
            $controller = new CPrenotaCampo();
            $controller->MostraAttrezzatura($idCampo,$giorno,$ora);
            break;
        case '/calendario/orario/attrezzatura/pagamento':
            require 'Controller/CPrenotaCampo.php';
            $controller = new CPrenotaCampo();
            $controller->MostraPagamento($idCampo,$giorno,$ora,$attrezzatura);
            break;
        case '/calendario/orario/attrezzatura/pagamento/ConfermaPrenotazione':
            require 'Controller/CPrenotaCampo.php';
            $controller = new CPrenotaCampo();
            $controller->MostraConfermaPrenotazione($idCampo,$giorno,$ora,$attrezzatura,$idCarta);
            break;
        case '/profilo':
            require 'Controller/CUtente.php';
            $controller = new CUtente();
            $controller->profilo();
            break;
        case '/profilo/tesseramento':
            require 'Controller/CTesseramento.php';
            $controller = new CTesseramento();
            $controller->MostraConfermaTesseramento($idTessera,$idUtente,$dataScadenza);//dataScadenza la dobbiamo mettere nel template
            break;
        
        case '/contattaci':
            $smarty->display('contattaci.tpl');
            break;
        case '/prenotazioni':
            require 'Controller/CUtente.php';
            $controller = new CUtente();
            $controller->prenotazioniUtente();
            break;

        case '/logout':
            session_destroy();
            header('Location: /');
            break;
        case '/prenotazioni/prenotazione' :
            require 'Controller/CPrenotaCampo.php';
            $controller = new CPrenotaCampo();
            $controller->annullaPrenotazione($idPrenotazione);
            $smarty->display('prenotazioni.tpl');
            break;
        case '/registrazione' :
            require 'Controller/CUtente.php' ;
            $controller= new CUtente();
            $controller->registrazione();
            $smarty->display('registrazione.tpl');

    }
}