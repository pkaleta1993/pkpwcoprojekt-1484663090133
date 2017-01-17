<?php
/*
Plik odpowiadający za połączenie z bazą mySQL na podstawie konfiguracji zawartej w pliku "config.php".
*/

require_once "config.php"; # Deklaracja zawartości pliku "config.php".
//include "config.php"; # Deklaracja zawartości pliku "config.php".
$connection = mysql_connect(db_server,db_user,db_pass); # Połączenie z serwerem bazy danych za pomocą loginu i hasła.
$db = mysql_select_db(db_database, $connection); # Połączenie z bazą o nazwie zadeklarowanej w "db_database".
echo "test w dbconnect";
?>