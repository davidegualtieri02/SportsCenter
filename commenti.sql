--Probabilmente non posso creare una database che tiene conto dell'ereditarietà perchè sennò un oggetto amministratore starebbe nella tabella utente e questa cosa non è esatta.
--ENGINE=InnoDB è il motore di storage predefinito di my sql, il motore di storage è la componente che gestisce come vengono memorizzati i dat ,gestiti e recuoerati 
--DEFAULT CHARSET=utf8 imposta il set di caratteri predefinito per la tabella . utf8 è un set di caratteri che può rappresentare qualsiasi carattere universale.
--COLLATE = utf8_unicode_ci questo imposta il collation predefinito per la tabella.Un collation determina come i dati di stringa vengono confrontati e ordinati
--utf8_unicode_ci è una collation che confronta le syringhe in modo case-sensitive, cioè non si fa distinzione tra lettere maiuscole e minuscole.

-- tinyint assume 1 quando il campo ban è pari a true per quella tupla , 0 quando il ban è impostato a false per quella tupla.
    --il NOT NULL vicino a tinyint mi dice che la colonna ban non può avere valori null in una delle tuple della tabella.

    --Riferimento alla chiave esterna, quella della superclasse