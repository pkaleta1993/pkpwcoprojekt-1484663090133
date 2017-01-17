<?php 
printf('<div class="tab">
<a href="?id=configuration&tab=1">Config</a>
<a href="?id=configuration&tab=2">Kontakt</a>
<a href="?id=configuration&tab=3">Ustawienia dodatków</a>
<a href="?id=configuration&tab=4">Inne</a>
</div>');
if(!isset($_GET['tab']))
{
	$_GET['tab'] = 1;
}
if($_GET['tab'] == 1)
{
if (isset($_POST['title']) and isset($_POST['ctext']) and isset($_POST['fav']) and isset($_POST['bodyspath']) and isset($_POST['styleapath']) and isset($_POST['path'])) #Jeżeli wszystkie pola zostały wypełnione, to wykonaj poniższe polecenia
{
	$file = fopen("../config.php", "w+");
	$conf = "<?php
/*
Ustawienia:
 - tytułu trony.
 - faviconu.
 - połączenia z bazą danych.
 - ścieżek do styli.
 - koloru tekstu.
*/
include \"var.php\";
define('db_database','dbre'); # Nazwa bazy danych.
define('db_user','root'); # Użytkownik bazy danych.
define('db_pass','asd'); # Hasło bazy danych.
define('db_server','127.0.0.1'); # Serwer bazy danych.
".'$bodystyle'."=\"".$_POST['bodyspath']."\"; # Ścieżka do głównych styli, które odpowiadają za ogólny wygląd strony.
".'$title'."=\"".$_POST['title']."\"; # Tytuł strony.
".'$text'."=\"".$_POST['ctext']."\"; # Kolor tekstu
".'$styleaccount'."=\"".$_POST['styleapath']."\"; # Ścieżka do styli, które odpowiadają za wygląd panelu logowania.
".'$favicon'."=\"".$_POST['fav']."\"; # Ścieżka do faviconu.
?>";
fputs($file,$conf);
fclose($file);
}
printf('
<div>
<h1>Konfiguracja:</h1>
<form action="" method="post">
<label>
<span>Tytuł strony:</span><br />
<input type="text" name="title" value="'.$title.'"/>
</label><br />
<label>
<span>Kolor tekstu:</span><br />
<input type="text" name="ctext" value="'.$text.'"/>
</label><br />
<label>
<span>Ścieżka faviconu:</span><br />
<input type="text" name="fav" value="'.$favicon.'"/>
</label><br />
<label>
<span>URL stylów ogólnych:</span><br />
<input type="text" name="bodyspath" value="'.$bodystyle.'">
</label><br />
<label>
<span>URL stylów konta:</span><br />
<input type="text" name="styleapath" value="'.$styleaccount.'">
</label><br />
<label>
<span>Nazwa i ścieżka configa:</span><br />
<input type="text" name="path" value="../config.php">
</label><br />

<input type="submit" class="btn btn-primary btn-sm" style="margin-top: 8px;"  name="submit" value="Zapisz" />
</form>
</div>');
} else if($_GET['tab'] == 2)
{
	printf("Aktualny kontakt:<br />");
	$contact_users = mysql_query("SELECT * FROM USERS where privileges=1");
	printf('<table><tr><td>ID</td><td>Login</td><td>Imię</td><td>Nazwisko</td><td>Mail</td><td>Ostatnie logowanie dnia</td><td>O godzinie</td></tr>');
	while($contact_users && $contact_list = mysql_fetch_assoc($contact_users)) # wyświetlanie listy użytkowników
								{
									printf('<tr>
									<td>'.$contact_list['sname'].'</td><td>'.$contact_list['login'].'</td><td>'.$contact_list['name'].'</td><td>'.$contact_list['surname'].'</td><td>'.$contact_list['mail'].'</td><td>'.$contact_list['last_login_d'].'</td><td>'.$contact_list['last_login_t'].'</td>
									<td><a href="?id=users&option=edit_user&user_id='.$contact_list['id'].'">Edytuj</a><td/></tr>');
								}
								printf('</table>');
}
?>