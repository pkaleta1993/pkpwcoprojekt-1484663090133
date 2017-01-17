<?php
/*
Instalacja bazy danych.
All rights reserved.
*/
printf('<html>
<head>
<title>INSTALACJA</title>
<link rel="Stylesheet" type="text/css" href="style/style.css" />
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="pl" />
</head><br /><br />
<div id="menu">
<div id="tresctekst">');


if ($_GET["install"] == "")
{
printf('
Zostaną stworzone następujące tabele:<br />'." - $users<br /> - $news<br /> -  $cat<br /> - $ka<br /> - $newscom<br /> - $notes<br /> - $wpisy<br /><br />".'
<br />

</div>
</div>
<br />
<form action="index.php" method="get">
<div id="urmail">
Twój mail: <input type="text" name="urmail" /></div>
<input type="hidden" name="install" value="yes" />
<input type="submit" value="Zainstaluj baze" id="input">
</form>
');
} else {
printf('</div>
</div>');
}
?>