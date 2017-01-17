<?php
/*
Plik odpowiadający za połączenie z bazą mySQL na podstawie konfiguracji zawartej w pliku "config.php".
*/

require_once "config.php"; # Deklaracja zawartości pliku "config.php".
//include "config.php"; # Deklaracja zawartości pliku "config.php".
echo "test w dbconnect1";
//$connection = mysql_connect(db_server,db_user,db_pass); # Połączenie z serwerem bazy danych za pomocą loginu i hasła.
$connection = mysqli_connect("lamp.ii.us.edu.pl","ii292683","Jg*4KM81=<5pM"); # Połączenie z serwerem bazy danych za pomocą loginu i hasła.
echo "test w dbconnect2";
$db = mysql_select_db(db_database, $connection); # Połączenie z bazą o nazwie zadeklarowanej w "db_database".
echo "test w dbconnect3";
?>