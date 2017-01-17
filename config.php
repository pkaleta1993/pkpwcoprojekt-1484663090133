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

define('db_database','[baza]'); # Nazwa bazy danych.
define('db_user','[uzytkownik]'); # Użytkownik bazy danych.
define('db_pass','[twoje_haslo]'); # Hasło bazy danych.
define('db_server','[adres_serwera_bazy_danych]'); # Serwer bazy danych.
$bodystyle="css/main.css"; # Ścieżka do głównych styli, które odpowiadają za ogólny wygląd strony.
$bodystylebootstrap="css/bootstrapadd.css"; # Ścieżka do głównych styli, które odpowiadają za ogólny wygląd strony.
$title="PWCO - Projekt"; # Tytuł strony.
$text="ffffff"; # Kolor tekstu
$styleaccount="css/accountstyle.css"; # Ścieżka do styli, które odpowiadają za wygląd panelu logowania.
$favicon="images/favicon.ico"; # Ścieżka do faviconu.
?>