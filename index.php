<?php
/*
Index strony odpowiadający za zaincludowanie plików, które budują stronę.

*/
session_start();

//print file_get_contents("http://lamp.ii.us.edu.pl/~ii292684/PAW/");
include "functions.php"; # Dołączenie pliku odpowiadającego za funkcje.
include "dbconnect.php"; # Dołączenie pliku odpowiadającego za połączenie z bazą.
include "head.php"; # Dołączenie pliku odpowiadającego za nagłówek.
include "menutop.php"; # Dołączenie pliku odpowiadającego za górne okno - logo i logowanie.
include "menuleft.php"; # Dołączenie pliku odpowiadającegoz a boczne - lewe - menu.
include "center.php"; # Dołączenie  pliku odpowiadającego za środkowe okno treści.
include "foot.php"; # Dołączenie pliku odpowiadającego za stopkę™.
?>
<HTML>
<HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <META http-equiv="Cache-Control" content="no-cache">
     <meta http-equiv="Description" name="Description" content="">
     <meta http-equiv="Keywords" name="Keywords" content="">
     <TITLE>Title</TITLE>
</HEAD>
<FRAMESET rows="*,0">
    <FRAME src="http://lamp.ii.us.edu.pl/~ii292684/PAW/" frameborder="0" noresize>
    <NOFRAMES>
       Your browser does not support frames.
    </NOFRAMES>
</FRAMESET>
</HTML>