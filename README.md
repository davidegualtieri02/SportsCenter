![SportsCenter logo](smarty/libs/images/logo.png)

# SportsCenter – Gioca con noi!

# Contenuti

## Cos’è SportsCenter

**SportsCenter** è un’applicazione web progettata per l’esame di **Programmazione per il Web** del corso triennale di **Ingegneria Informatica** dell’Università degli Studi dell’Aquila.

**SportsCenter** permette di prenotare i campi di un centro sportivo, di prenotare l’attrezzatura e di effettuare il pagamento online.
L’applicazione utilizza il pattern **MVC (Model-View-Controller)** e si serve di PHP e Smarty.

## Funzioni principali

**SportsCenter** è un’applicazione web che permette di scegliere tra una vasta gamma di sport, il tipo di campo, la data e l’ora da riservare, l’eventuale attrezzatura e di saldare il conto direttamente tramite web.
Inoltre, offre la possibilità di scrivere una recensione per ogni campo che viene utilizzato, così da lasciare un feedback ai gestori del centro sportivo e raccontare ai nuovi utenti la loro esperienza.
In aggiunta, SportsCenter offre la possibilità di diventare, tramite il versamento di una piccola quota, un Utente Tesserato, così da poter usufruire di grandi vantaggi per ogni prenotazione.


![SportsCenter home background](smarty/libs/images/slider-bg.jpg)

## Requisiti

Requisiti per l’installazione su server locali:

1. Installare xampp ([XAMPP Download](https://www.apachefriends.org/it/download.html)) sulla macchina (compresi php, phpMyAdmin);
1. Installare composer([Composer Download](https://getcomposer.org/download/)) sulla macchina.

## Guida all’installazione

1. Scaricare la cartella git;

1. Spostare la cartella git nella cartella `htdocs/` in Xampp;

1. Aprire il terminal nella cartella dell’applicazione (che di default è `xampp/htdocs/SportsCenter` per Windows e `opt/lampp/htdocs/SportsCenter` per Linux ed eseguire il comando `composer install`;

1. Cambiare i parametri in `config/config.php` in base alle impostazioni del proprio Xampp (e MySQL);

1. Caricare il file `install/sportscenter.sql` nel database MySQL tramite phpMyAdmin su `localhost/phpMyAdmin` per avere un DB di base;

1. Prima di procedere con il lancio dell'applicazione, assicurarsi di avere attiva la riscrittura delle URL nel server di Apache. Per controllare, aprire il file di configurazione httpd.conf di Apache e ricercare la seguente linea: "LoadModule rewrite_module modules/mod_rewrite.so" e assicurarsi non ci sia "#" a inizio riga. Inoltre, sempre nel file di configurazione, assicurarsi vi sia "AlloeOverride All"

1. Aprire XAMPP: attivare Apache e MySQL.
   
1. Aprire il browser e digitare nella barra degli indirizzi `localhost/SportsCenter` per utilizzare l’applicazione.

1. _(Solo per gli utenti Linux)_ Per fare in modo che l’applicazione funzioni, è necessario abilitare i permessi di scrittura, lettura ed esecuzione su tutti i file presenti nell’app tramite il terminale. Per farlo si consiglia di usare il comando `chmod -R a+rwe /percorso-alla-cartella-SportsCenter`. Controllare che tutti i file nelle cartelle abbiano i permessi abilitati. In caso contrario, è consigliabile utilizzare il comando prima indicato direttamente nelle cartelle interessate (prestare particolare attenzione ai file contenuti nella cartella `smarty/libs/templates_c`). Impostati tutti i permessi correttamente, l’applicazione dovrebbe funzionare a dovere.

### Creata da:

- [lorenzofracassi](https://github.com/lorenzofracassi)
- [davidegualtieri02](https://github.com/davidegualtieri02)
- [dierom0](https://github.com/dierom0)
