<?php
/*
	Plik odpowiada za rejestracje użytkowników portalu.
*/
if (!isset($_SESSION['login']))
{

if (isset($_POST['login']) and isset($_POST['password']) and isset($_POST['password_repeat']) and isset($_POST['mail'])) #Jeżeli wszystkie pola zostały wypełnione, to wykonaj poniższe polecenia
{
	if(isset($_POST['g-recaptcha-response']))
			{
				$captcha=$_POST['g-recaptcha-response'];
			}
			 if(!$captcha){
				 ?>
				 <script type="text/javascript">
					$(document).ready(
					function() {
					alert("Captcha nie wypełniona!");
					}
)
</script>
				 <?php
				 
			} 
else {
	if ($_POST['password']==$_POST['password_repeat'])
	{
		$mail =  htmlspecialchars(mysql_real_escape_string(trim($_POST['mail'])));
		$login = $_POST['login'];
		$check = mysql_query("SELECT * FROM $dbre.users WHERE mail = \"$mail\"");
		$checkmail = mysql_num_rows($check);
		if ($checkmail==0)  # Jeżeli nie ma użytkownika o tym samym mailu, to wykonaj poniższe polecenia.
		{
			# Pobieranie wartości do zmiennych z formularza, zabezpieczając wprowadzane wartości 
			$name = "";
			$surname = "";
			
			if(isset($_POST['name']))
			{
				$name = htmlspecialchars(mysql_real_escape_string(trim($_POST['name'])));      
			} 
			if(isset($_POST['surname']))
			{
				$surname= htmlspecialchars(mysql_real_escape_string(trim($_POST['surname'])));
			}
			if(isset($_POST['qst']))
			{
				$qst= htmlspecialchars(mysql_real_escape_string(trim($_POST['qst'])));
			}
			if(isset($_POST['asw']))
			{
				$asw= htmlspecialchars(mysql_real_escape_string(trim($_POST['asw'])));
			}
			$password =  htmlspecialchars(md5(mysql_real_escape_string(trim($_POST['password'])))); 
			
			//$login = $name." ".$surname;    # login przyjmuje wartość "name", dodaje do niego spacje, dokleja "surname" 
			$check = mysql_query("SELECT * FROM $dbre.users WHERE login = \"$login\"");
			$check = mysql_num_rows($check); # Sprawdzanie, czy w bazie nie ma użytkownika o tym samym loginie.
			if ($check==0)  # Jeżeli nie ma użytkownika o tym samym loginie, to wykonaj poniższe polecenia(Wprowadzanie użytkownika do bazy).
			{
				$sql="INSERT INTO $dbre.users(login, name, surname, password,mail, privileges, points, value, qst, asw) VALUES(\"$login\", \"$name\", \"$surname\",\"$password\",\"$mail\", 0, 0, 100, \"$qst\",\"$asw\")";
				mysql_query($sql) or die("Nie udało się stworzyć konta".mysql_error());
				echo('Konto '.$login.' zostalo utworzone');
				mail($mail,'Konto '.$login.' czeka na aktywacje', 'Kliknij w link, aby dokonac aktywacji konta'); # Wysyła @ na podany przez użytkownia adres.
			} else  {
						echo("Taki uzytkownik juz istnieje. Kliknij wstecz aby zarejestrowac sie ponownie");
					}
		} else echo("Użytkownik o takim mailu już istnieje.");
		} else echo ("Podane hasła nie zgadzają się.");
		} 
	} 

printf('<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="js/validate.js"></script>
<div  class="small-boxinp">

<h1>Rejestracja</h1>

<form action="" method="post" id="register-form" data-toggle="validator">
<div class="form-group"><span class="label label-primary label-pos">Login*</span><br />
<input name="login" type="text" class="sinp-box"  value="" /></div>
<div class="form-group"><span class="label label-primary label-pos">Mail*</span><br />
<input name="mail" type="text" class="sinp-box" value="" /></div>
<div class="form-group"><span class="label label-primary label-pos">Hasło*</span><br />
<input name="password" id="pass" type="password" class="sinp-box" value="" /></div>
<div class="form-group"><span class="label label-primary label-pos">Powtórz hasło*</span><br />
<input name="password_repeat" type="password" class="sinp-box" value="" /></div>
<div class="form-group"><span class="label label-primary label-pos">Imię</span><br />
<input name="name" type="text" class="sinp-box" value="" /></div>
<div class="form-group"><span class="label label-primary label-pos">Nazwisko</span><br />
<input name="surname" type="text" class="sinp-box" value="" /></div>
<div class="form-group"><span class="label label-primary label-pos">Pytanie pomocnicze*</span><br />
<input name="qst" type="text" class="sinp-box" value="" /></div>
<div class="form-group"><span class="label label-primary label-pos">Odpowiedź*</span><br />
<input name="asw" type="text" class="sinp-box" value="" /></div>
<input type="submit" class="btn btn-primary sinp-box" name="submit" value="Zarejestruj" />
<center><div class="g-recaptcha"  data-theme="dark" data-sitekey="6LduCRYTAAAAAO4tfLiyF6zlCjdFEKPoEQx1BtyP"></div>
<font style="color: #dd0000;">Pola z * są wymagane.</font></center>
</form>

</div>
');
} else printf('Jesteś już naszym użytkownikiem.');
?>
<style>
#register-form .form-group label.error {
    color: #FB3A3A;
    display: inline-block;
    margin: 4px 0 5px 125px;
   
   
}
input.error {
    border: 2px solid #ff0000;
}
input.valid {
    border: 2px solid #00ff00;
}

</style>
