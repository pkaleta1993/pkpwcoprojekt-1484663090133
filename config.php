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

define('db_database','ad_e2f587706a9e4cc'); # Nazwa bazy danych.
define('db_user','b556eb936d7b5a'); # Użytkownik bazy danych.
define('db_pass','b7aeecf3'); # Hasło bazy danych.
define('db_server','us-cdbr-iron-east-04.cleardb.net'); # Serwer bazy danych.
$bodystyle="css/main.css"; # Ścieżka do głównych styli, które odpowiadają za ogólny wygląd strony.
$bodystylebootstrap="css/bootstrapadd.css"; # Ścieżka do głównych styli, które odpowiadają za ogólny wygląd strony.
$title="PWCO - Projekt"; # Tytuł strony.
$text="ffffff"; # Kolor tekstu
$styleaccount="css/accountstyle.css"; # Ścieżka do styli, które odpowiadają za wygląd panelu logowania.
$favicon="images/favicon.ico"; # Ścieżka do faviconu.
echo "test w config";
?>