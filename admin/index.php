<?php
/*
Panel administratorski.
*/
include "../dbconnect.php"; # połączenie z bazą
include "../config.php";

include "../functions.php"; # załączenie funkcji
printf('<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>'.$title.'</title>
<link rel="Stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="Stylesheet" type="text/css" href="style/style.css" />
<link rel="Stylesheet" type="text/css" href="style/menustyle.css" />
<link rel="Stylesheet" type="text/css" href="style/tabs.css" />
<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<meta http-equiv="Content-Language" content="pl" />
</head>
<body text="'.$text.'" link="'.$text.'" vlink="'.$text.'">
<div id="menu_top">
<font id="AP" size=12>ADMIN PANEL</font>');
printf('</div>');
include "center.php";
include "foot.php";
?>