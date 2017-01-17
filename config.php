<?php
/*
Ustawienia:
 - tytułu trony.
 - faviconu.
 - połączenia z bazą danych.
 - ścieżek do styli.
 - koloru tekstu.
*/
include "var.php";

define('db_database','ii292684'); # Nazwa bazy danych.
define('db_user','ii292684'); # Użytkownik bazy danych.
define('db_pass','Jg*4KM81=<5pM'); # Hasło bazy danych.
define('db_server','lamp.ii.us.edu.pl'); # Serwer bazy danych.
$bodystyle="css/main.css"; # Ścieżka do głównych styli, które odpowiadają za ogólny wygląd strony.
$bodystylebootstrap="css/bootstrapadd.css"; # Ścieżka do głównych styli, które odpowiadają za ogólny wygląd strony.
$title="PWCO - Projekt"; # Tytuł strony.
$text="ffffff"; # Kolor tekstu
$styleaccount="css/accountstyle.css"; # Ścieżka do styli, które odpowiadają za wygląd panelu logowania.
$favicon="images/favicon.ico"; # Ścieżka do faviconu.
echo "test w config";
?>