--Probabilmente non posso creare una database che tiene conto dell'ereditarietà perchè sennò un oggetto amministratore starebbe nella tabella utente e questa cosa non è esatta.
CREATE TABLE Utente(
    'id_utente' INT PRIMARY KEY,
    'nome' VARCHAR(50),
    'cognome'  VARCHAR(50),
    'pass' VARCHAR(50),
    'email'VARCHAR (50),
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci; --ENGINE=InnoDB è il motore di storage predefinito di my sql, il motore di storage è la componente che gestisce come vengono memorizzati i dat ,gestiti e recuoerati 
--DEFAULT CHARSET=utf8 imposta il set di caratteri predefinito per la tabella . utf8 è un set di caratteri che può rappresentare qualsiasi carattere universale.
--COLLATE = utf8_unicode_ci questo imposta il collation predefinito per la tabella.Un collation determina come i dati di stringa vengono confrontati e ordinati
--utf8_unicode_ci è una collation che confronta le syringhe in modo case-sensitive, cioè non si fa distinzione tra lettere maiuscole e minuscole.
CREATE TABLE UtenteRegistrato(
    'id_utenteRegistrato' INT PRIMARY KEY,
    'nome'VARCHAR (50),
    'cognome' VARCHAR (50),
    'pass' VARCHAR(50),
    'email' VARCHAR(50),
    ' ban ' TINYINT(1) NOT NULL;-- tinyint assume 1 quando il campo ban è pari a true per quella tupla , 0 quando il ban è impostato a false per quella tupla.
    --il NOT NULL vicino a tinyint mi dice che la colonna ban non può avere valori null in una delle tuple della tabella.
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE UtenteTesserato(
    'id_utenteTesserato' INT PRIMARY KEY,
    'nome'VARCHAR (50),
    'cognome' VARCHAR (50),
    'pass'VARCHAR (50),
    'email' VARCHAR(50),
    'ban ' TINYINT NOT NULL; 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Amministratore(
    'id_amministratore' INT PRIMARY KEY,
    'nome'VARCHAR (50),
    'cognome' VARCHAR (50),
    'pass'VARCHAR (50),
    'email' VARCHAR(50),
    'ban ' TINYINT(1) NOT NULL;
 )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Tessera(
    'id_tessera' INT PRIMARY KEY,
    'codice tessera' INT;
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;

CREATE TABLE Campo(
    'id_campo' INT PRIMARY KEY,
    'copertura'VARCHAR (50),
    'terreno'VARCHAR (50),
    'pavimento' VARCHAR (50);
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Attrezzatura(
    'id_attrezzatura' INT PRIMARY KEY;
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaCalcio(
    'id_attrezzaturaCalcio' INT PRIMARY KEY,
    'palloneCalcio' INT,
    'casacca' INT;
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaTennis(
    'id_attrezzaturaTennis' INT PRIMARY KEY,
    'pallaTennis' INT ,
    'racchettaTennis' INT ;
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaPadel(
    'id_attrezzaturaPadel' INT PRIMARY KEY,
    'pallaPadel' INT,
    'racchettaPadel' INT;
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaBasket(
    'id_attrezzaturaBasket' INT PRIMARY KEY,
    'pallaBasket' INT,
    'casacca' INT;
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaPallavolo(
    'id_attrezzaturaPallavolo' INT PRIMARY KEY,
    'pallonePallavolo' INT,
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Prenotazione(
    'id_prenotazione' INT PRIMARY KEY,
    'data' DATE ,
    'orario ' INT,
    'pagata' TINYINT(1);
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE CartadiPagamento(
    'id_cartadiPagamento' INT
    'nomeTitolare' VARCHAR(50),
    'cognomeTitolare' VARCHAR (50),
    'numeroCarta' INT,
    'DataScadenza' DATE,
    'CVV' INT,
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Recensione(
    'id_recensione' INT
    'valutazione' INT,
    'Commento' VARCHAR(50),
    'foto' BLOB,-- BLOB è un tipo che permette di salvare dati binari come le immagini in una tabella del database 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;