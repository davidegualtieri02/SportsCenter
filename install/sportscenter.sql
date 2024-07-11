CREATE TABLE Utente(
    id_utente INT AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(50),
    cognome VARCHAR(50),
    password VARCHAR(50),
    email VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci; 
CREATE TABLE UtenteRegistrato(
    id_utenteRegistrato INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT, 
    nome VARCHAR(50),
    cognome VARCHAR (50),
    password VARCHAR(50),
    email VARCHAR(50),
    ban TINYINT(1) NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES Utente(id_utente) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE UtenteTesserato(
    id_utenteTesserato INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT,
    nome VARCHAR (50),
    cognome VARCHAR (50),
    password VARCHAR (50),
    email VARCHAR(50),
    ban TINYINT NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES Utente(id_utente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Amministratore(
    id_amministratore INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT,
    nome VARCHAR (50),
    cognome VARCHAR (50),
    password VARCHAR (50),
    email VARCHAR(50),
    FOREIGN KEY (id_utente) REFERENCES Utente(id_utente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Tessera(
    id_tessera INT AUTO_INCREMENT PRIMARY KEY,
    id_utenteRegistrato INT,
    Data_Inizio DATE,
    Data_Scadenza DATE,
    FOREIGN KEY (id_utente) REFERENCES UtenteRegistrato(id_utenteRegistrato)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Campo(
    id_campo INT AUTO_INCREMENT PRIMARY KEY,
    copertura VARCHAR (50),
    titoloCampo VARCHAR(50),
    prezzo INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE CampoBasket(
    id_campoBasket INT AUTO_INCREMENT PRIMARY KEY,
    id_campo INT,
    copertura VARCHAR (50),
    pavimento VARCHAR (50),
    fotoCampo VARBINARY(255),
    titoloCampo VARCHAR(50),
    prezzo INT,
    FOREIGN KEY (id_campo) REFERENCES Campo(id_campo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE CampoCalcio(
    id_campoCalcio INT AUTO_INCREMENT PRIMARY KEY,
    id_campo INT,
    copertura VARCHAR (50),
    fotocampo VARBINARY(255),
    titoloCampo VARCHAR(50),
    prezzo INT,
    FOREIGN KEY (id_campo) REFERENCES Campo(id_campo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE CampoPadel(
    id_campoPadel INT AUTO_INCREMENT PRIMARY KEY,
    id_campo INT,
    copertura VARCHAR(50),
    fotocampo VARBINARY(255),
    titoloCampo VARCHAR(50),
    prezzo INT,
    FOREIGN KEY (id_campo) REFERENCES Campo(id_campo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE CampoPallavolo(
    id_campoPallavolo INT AUTO_INCREMENT PRIMARY KEY,
    id_campo INT,
    copertura VARCHAR(50),
    pavimento VARCHAR(50),
    fotocampo VARBINARY(255),
    titoloCampo VARCHAR(50),
    prezzo INT,
    FOREIGN KEY (id_campo) REFERENCES Campo(id_campo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE CampoTennis(
    id_campoTennis INT AUTO_INCREMENT PRIMARY KEY,
    id_campo INT,
    copertura VARCHAR(50),
    terreno VARCHAR(50),
    fotocampo VARBINARY(255),
    titoloCampo VARCHAR(50),
    prezzo INT,
    FOREIGN KEY (id_campo) REFERENCES Campo(id_campo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Attrezzatura(
    id_attrezzatura INT AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaCalcio(
    id_attrezzaturaCalcio INT AUTO_INCREMENT PRIMARY KEY,
    id_attrezzatura INT,
    numPalloni_Calcio INT,
    numCasacca INT,
    FOREIGN KEY (id_attrezzatura) REFERENCES Attrezzatura(id_attrezzatura)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaTennis(
    id_attrezzaturaTennis INT AUTO_INCREMENT PRIMARY KEY,
    id_attrezzatura INT,
    numPalla_Tennis INT,
    numRacchetta_Tennis INT,
    FOREIGN KEY (id_attrezzatura) REFERENCES Attrezzatura(id_attrezzatura)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaPadel(
    id_attrezzaturaPadel INT AUTO_INCREMENT PRIMARY KEY,
    id_attrezzatura INT,
    numPalla_Padel INT,
    numRacchetta_Padel INT,
    FOREIGN KEY (id_attrezzatura) REFERENCES Attrezzatura(id_attrezzatura)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaBasket(
    id_attrezzaturaBasket INT AUTO_INCREMENT PRIMARY KEY,
    id_attrezzatura INT,
    numPalla_Basket INT,
    numCasacca INT,
    FOREIGN KEY (id_attrezzatura) REFERENCES Attrezzatura(id_attrezzatura)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE AttrezzaturaPallavolo(
    id_attrezzaturaPallavolo INT AUTO_INCREMENT PRIMARY KEY,
    id_attrezzatura INT,
    numPalla_Pallavolo INT,
    FOREIGN KEY (id_attrezzatura) REFERENCES Attrezzatura(id_attrezzatura)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Prenotazione(
    id_prenotazione INT AUTO_INCREMENT PRIMARY KEY,
    data DATE ,
    orario INT,
    pagata TINYINT(1),
    id_campo INT,
    id_attrezzatura INT,
    id_utente INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE CartadiPagamento(
    id_cartadiPagamento INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Titolare VARCHAR(50),
    Cognome_Titolare VARCHAR (50),
    Numero_Carta INT,
    Data_Scadenza DATE,
    CVV INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Recensione (
    id_recensione INT AUTO_INCREMENT PRIMARY KEY,
    commento VARCHAR(50),
    valutazione INT,
    DataOra DATETIME,
    removed TINYINT(1),
    id_utente INT,
    image LONGBLOB,
    id_campo INT,
    FOREIGN KEY (id_utente) REFERENCES Utente(id_utente),
    FOREIGN KEY (id_campo) REFERENCES Campo(id_campo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE Image(
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    grandezza VARCHAR(50),
    tipi VARCHAR(50),
    imageData VARBINARY(255),
    id_recensione INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_unicode_ci;
CREATE TABLE Orario(
    id_orario INT AUTO_INCREMENT PRIMARY KEY,
    orario INT
)