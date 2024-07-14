-- Assicurati che non ci siano tabelle esistenti con lo stesso nome
DROP TABLE IF EXISTS Prenotazione;
DROP TABLE IF EXISTS Image;
DROP TABLE IF EXISTS Attrezzatura;
DROP TABLE IF EXISTS Campo;
DROP TABLE IF EXISTS Tessera;
DROP TABLE IF EXISTS UtenteRegistrato;

-- Crea la tabella UtenteRegistrato
CREATE TABLE UtenteRegistrato (
    id_utenteRegistrato INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    ban BOOLEAN DEFAULT FALSE,
    id_tessera INT DEFAULT 0
);

-- Crea la tabella Tessera
CREATE TABLE Tessera (
    id_tessera INT PRIMARY KEY,
    id_utenteRegistrato INT NOT NULL,
    Data_Inizio DATE NOT NULL,
    Data_Scadenza DATE NOT NULL,
    FOREIGN KEY (id_utenteRegistrato) REFERENCES UtenteRegistrato(id_utenteRegistrato)
);

-- Delimitatore per i trigger
DELIMITER //

-- Trigger after insert
CREATE TRIGGER after_insert_trigger
AFTER INSERT ON Tessera
FOR EACH ROW
BEGIN
    UPDATE UtenteRegistrato
    SET id_tessera = NEW.id_tessera
    WHERE id_utenteRegistrato = NEW.id_utenteRegistrato;
END;
//

-- Trigger before insert
CREATE TRIGGER before_insert_tessera
BEFORE INSERT ON Tessera
FOR EACH ROW
BEGIN
    SET NEW.id_tessera = NEW.id_utenteRegistrato;
END;
//

-- Ripristina il delimitatore
DELIMITER ;

-- Crea la tabella Image
CREATE TABLE Image (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    grandezza VARCHAR(50) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    imageData LONGBLOB NOT NULL
);


-- Crea la tabella Campo
CREATE TABLE Campo (
    id_campo VARCHAR(50) PRIMARY KEY,
    titoloCampo VARCHAR(255) NOT NULL,
    prezzo INT NOT NULL
);

CREATE TABLE Recensione (
    id_recensione INT AUTO_INCREMENT PRIMARY KEY,
    commento VARCHAR(1000),
    giorno VARCHAR(50),
    id_utenteRegistrato INT,
    id_campo VARCHAR(50),
    id_image INT,
    FOREIGN KEY (id_utenteRegistrato) REFERENCES UtenteRegistrato(id_utenteRegistrato),
    FOREIGN KEY (id_campo) REFERENCES Campo(id_campo),
    FOREIGN KEY (id_image) REFERENCES Image(id_image)
);

CREATE TABLE Orario(
    orario INT NOT NULL PRIMARY KEY
);

-- Crea la tabella Prenotazione
CREATE TABLE Prenotazione (
    id_prenotazione INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    orario INT NOT NULL,
    pagata TINYINT(1),
    id_campo VARCHAR(50) NOT NULL,
    attrezzatura BOOLEAN DEFAULT FALSE,
    id_utenteRegistrato INT NOT NULL,
    FOREIGN KEY (orario) REFERENCES Orario(orario),
    FOREIGN KEY (id_utenteRegistrato) REFERENCES UtenteRegistrato(id_utenteRegistrato)
);