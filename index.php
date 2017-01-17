<?php
/*
Index strony odpowiadający za zaincludowanie plików, które budują stronę.

*/
session_start();

include("http://lamp.ii.us.edu.pl/~ii292684/PAW");
include "functions.php"; # Dołączenie pliku odpowiadającego za funkcje.
include "dbconnect.php"; # Dołączenie pliku odpowiadającego za połączenie z bazą.
include "head.php"; # Dołączenie pliku odpowiadającego za nagłówek.
include "menutop.php"; # Dołączenie pliku odpowiadającego za górne okno - logo i logowanie.
include "menuleft.php"; # Dołączenie pliku odpowiadającegoz a boczne - lewe - menu.
include "center.php"; # Dołączenie  pliku odpowiadającego za środkowe okno treści.
include "foot.php"; # Dołączenie pliku odpowiadającego za stopkę™.
?>
