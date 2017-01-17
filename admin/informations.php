<?php 
$last_login = mysql_query("SELECT last_login_d, last_login_t FROM $dbre.`users` WHERE login =  \"$_SESSION[login]\"");
$last_login = mysql_fetch_array($last_login);
$last_login_d = $last_login['last_login_d'];
$last_login_t = $last_login['last_login_t'];
if(!empty($_POST['note']))
{
	echo "cos";
$sql_note = mysql_query("UPDATE $dbre.`notes` SET `notes` = \"".$_POST['note']."\"") or die("Wystapil blad".mysql_error());
#$sql_note = mysql_query("INSERT INTO  `pa`.`notes` (  `notes` ) VALUES (\"".$_POST['note']."\"'jakas tresc');

}
$notes = mysql_query("SELECT * FROM $dbre.notes");
$notes = mysql_fetch_array($notes);
$notes = $notes['notes'];
$userx = mysql_num_rows(mysql_query("SELECT * FROM $dbre.users"));
$newsx = mysql_num_rows(mysql_query("SELECT * FROM $dbre.news"));
$comx = mysql_num_rows(mysql_query("SELECT * FROM $dbre.news_komentarze"));

printf('<div id="tab">
<h1>Informacje:</h1>
Login: '.$_SESSION['login'].'<br />
Ostatnio obecny dnia <b>'.$last_login_d.'</b> o godzinie: <b>'.$last_login_t.'</b></div><br />
Łączna liczba użytkowników: '.$userx.'<br />
Łączna liczba newsów: '.$newsx.'<br />
Łączna liczba komentarzy: '.$comx.'<br />
<form action="" method="post">Notatnik: <br><textarea rows="20" cols=80 name="note" class="post" id="input">'.$notes.'</textarea>
<input type="submit" class="btn btn-primary btn-sm" style="margin-top: 8px;"  name="submit" value="Zapisz" />
</form>');
?>