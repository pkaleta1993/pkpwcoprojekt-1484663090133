



<?php
if(!empty($_POST['grp'])  and isset($_POST['t']) and isset($_POST['msg']))
{
	if($_POST['grp'] == "users")
	{
		$us_mail_pr = 0;
	
	} else if($_POST['grp'] == "blocked")
	{
		$us_mail_pr = 2;
	
	}
$t = $_POST['t'];
$msg =$_POST['msg'];	
$sql_mails = mysql_query("SELECT `mail` FROM $dbre.users WHERE `privileges` = \"$us_mail_pr\"");

while ($row = mysql_fetch_row($sql_mails)) {
mail("$row[0]", $t, $msg.'Mail nadawcy: pkaleta1993@gmail.com');
}
	
} else if(isset($_POST['mail'])  and isset($_POST['t']) and isset($_POST['msg']))
{
$t = $_POST['t'];
$msg =$_POST['msg'];
$mail =$_POST['mail'];
if (mail($mail, $t, $msg.'Mail nadawcy: pkaleta1993@gmail.com'))
{
printf("mail został wysłany");
}
else
{
printf("mail  NIE został wysłany");
}
}
if(isset($_GET['user_id']) and (!isset($_POST['grp'])))
{
	
	$us_id = $_GET['user_id'];
	$search_sql = mysql_query("SELECT * FROM $dbre.users WHERE id = \"$us_id\"");
	$user_search_list = mysql_fetch_assoc($search_sql);
	$us_mail = $user_search_list['mail'];
	
}
printf('<div  class="medium-boxinp">
<form action="" method="post"  id="register-form" data-toggle="validator">
<h2>Wyślij zgłoszenie:</h2>
<br />
<br />');
if(isset($_GET['user_id']) and (!isset($_POST['grp'])))
{
	printf('<div class="form-group"><span class="label label-primary label-pos">Mail</span><br /><input type="text" class="sinp-box" name="mail" placeholder="przykladowymail@przykladowadomena.pl" value="'.$us_mail.'" /></div>');

} else 
{
		printf('<div class="form-group"><span class="label label-primary label-pos">Mail</span><br /><input type="text" class="sinp-box" name="mail" placeholder="przykladowymail@przykladowadomena.pl" /></div>');

}
printf('lub wybierz grupę<br /><br />
<div class="form-group"><span class="label label-primary label-pos">Grupa</span><br />
<select class="form-control sinp-box" id="grp" name="grp">
	<option label=" "></option>

    <option value="users">Użytkownicy</option>
	<option value="blocked">Zablokowani</option>
</select><br /><br /><br />
<div class="form-group"><span class="label label-primary label-pos">Temat wiadomości</span><br /><input type="text" class="sinp-box" name="t" placeholder="Przykladowy temat" /></div>
<div class="form-group"><span class="label label-primary label-pos">Treść wiadomości</span><br /><textarea class="sinp-box" style="color: #000000;" name="msg" placeholder="Przykladowa tresc" ></textarea></div>
<br />
<div style=""><input type="submit" class="btn btn-primary" name="submit" value="Submit" /></div>
</form>
</div>');
?>
