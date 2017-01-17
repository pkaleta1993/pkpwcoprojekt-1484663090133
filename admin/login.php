<?php
/**
Skrypt, który odpowiada za logowanie użytkowników.
**/
#include "../dbconnect.php";

#session_register('user_id', 'login', 'privileges');
	
		
	session_start(); //start sesji
		if(isset($_POST["wyloguj"]))
{
	
	include "logout.php";
}
printf('<div id="logintext">');
#if(isset($_SESSION['privileges']))
#{
#if((isset($_SESSION['privileges'])) && $_SESSION['privileges']!= 1)
#{	

if (isset($_POST['login_l']) and isset($_POST['password_l']) ) # Jeżeli zmienne "login" i "passport" nie są puste, to wprowadź ich wartości odpowiednio do zmiennych "login" i "password"/
{
	$login=mysql_real_escape_string(trim($_POST['login_l']));
	$password=mysql_real_escape_string(trim($_POST['password_l']));
	if (($login != "") and ($password != ""))
	{
   	$password = md5($password);  
   	$temp=mysql_query("SELECT * FROM $dbre.users WHERE login=\"$login\" and password = \"$password\"") or die("Wystapil blad".mysql_error());
   	$how=mysql_num_rows($temp) or $how=0;
   	if ($how!=0) $temp=mysql_fetch_array($temp) or die("Wystapil blad".mysql_error()); 
   	if ($how==1)
   		{	  
	
   			$id_sess=$temp['id'];
  				$login_sess=$temp['login'];
  				$privileges_sess=$temp['privileges']; 
  				$_SESSION['user_id']=$id_sess;
				$_SESSION['login']=$login_sess;
				$_SESSION['privileges']= $privileges_sess;
				if (isset($_SESSION['agent']))  # Sprawdzanie, czy nikt nie podmienil nagłówka
				{
					
				if ($_SESSION['agent'] <> $_SERVER['HTTP_USER_AGENT'])
					{  
						session_unset();
						session_destroy();
						exit;
						echo "Sesja zniszczona";
					}
  				 }
  				 $_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
  			} else echo "Nie ma takiego użytkownika albo hasło jest nieprawidłowe."; 
	}
}
#}
#}
if (isset($_SESSION['login'])) # Jeżeli login sesyjny nie jest pusty, to wyświetl informacje o użytkowniku(login).
{

printf('
<form  action="" method="post">
<center><font>Login: '.$_SESSION['login'].'</font><br /><input type="submit" class="btn btn-primary btn-sm"  name="wyloguj" value="Wyloguj" /></center></form></div>');
$PA = mysql_query("SELECT privileges FROM $dbre.users WHERE login = \"".$_SESSION['login']."\"") or die("Wystapil blad".mysql_error());
$PA = mysql_fetch_assoc($PA);
if($PA['privileges'] == 1)
{	
	include "menu.php";
}
} else # W przeciwnym wypadku wyswietl okno logowania.
{
printf('
<form  action="" method="post">
Login:<input name="login_l" type="text" value="" id="input"/><br>
Haslo:<input name="password_l" type="password" value="" id="input"/><br>
<input type="submit" class="btn btn-primary btn-sm" style="margin-top: 8px;"  name="submit" value="Zaloguj" />
</form></div>
</body>');
}
?>