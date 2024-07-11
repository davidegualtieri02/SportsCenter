<?php

//Connessione al database
define('DB_NAME', 'DB'); //Definisco la costante DB_NAME
define('DB_HOST', 'localhost'); //Definisco la costante DB_HOST
define('DB_USER', 'root'); //Definisco la costante DB_USER
define('DB_PASS', ''); //Definisco la costante DB_PASS
define('SQL_FILE_PATH', 'sportscenter.sql');
//Tutte le costanti definite in precedenza vengono utilizzate in /Foundation/FEntityManager.php

//Web APP parameter for custom app
define('MAX_VIP', 3);
define('MAX_POST_EXPLORE', 10);
define('MAX_WARNINGS', 3);
define('MAX_IMAGE_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPE',['image/jpeg', 'image/png', 'image/jpg']);

//session coockie expiration
define('TEMPO_COOKIE', 2592000); // 30 days in seconds