<?php
/**
Skrypt, który odpowiada za logowanie użytkowników.
**/
include "dbconnect.php";
session_start(); //start sesji
#session_register('user_id', 'login','privileges');


if (isset($_POST['login_l']) and isset($_POST['password_l']) ) # Jeżeli zmienne "login" i "password" nie są puste, to wprowadź ich wartości odpowiednio do zmiennych "login" i "password"/
{
	
	$login=mysql_real_escape_string(trim($_POST['login_l']));
	$password=mysql_real_escape_string(trim($_POST['password_l']));
	if (($login != "") and ($password != ""))
	{
	$temp_lc_user=mysql_query("SELECT * FROM $dbre.users WHERE login =\"$login\"") or die("Wystapil blad".mysql_error());
	$howlc = mysql_fetch_assoc($temp_lc_user);
	$temp_mysql_now = mysql_query("SELECT now() AS czas");
	$temp_mysql_time_as = mysql_fetch_assoc($temp_mysql_now);
	
	if($howlc['last_l_time']<= $temp_mysql_time_as['czas'])
	{
		
		mysql_query("UPDATE $dbre.users SET `login_count` = 0 WHERE login=\"$login\"");
		
	}
	
   	$password = md5($password);  
   	$temp=mysql_query("SELECT * FROM $dbre.users WHERE login =\"$login\" and password = \"$password\"") or die("Wystapil blad2".mysql_error());
	$temp_user=mysql_query("SELECT * FROM $dbre.users WHERE login =\"$login\" and password = \"$password\"");
	$user_sql_assoc = mysql_fetch_assoc($temp_user);
	
	$how=mysql_num_rows($temp) or $how=0;
   	if ($how!=0) $temp=mysql_fetch_array($temp) or die("Wystapil blad".mysql_error()); 
   	if ($how==1)
   		{	
			
			if($user_sql_assoc['privileges'] == 2)
			{
				
			
				
			} else {
				
				$id_sess=$temp['id'];
  				$login_sess=$temp['login'];
  				$privileges_sess=$temp['privileges'];
				
  				$_SESSION['user_id']=$id_sess;
				$_SESSION['login']=$login_sess;
				$_SESSION['privileges']= $privileges_sess;
				$sql_lastlogin_t = "UPDATE $dbre.`users` SET last_login_t = CURRENT_TIME('') WHERE login = \"".$_SESSION['login']."\"";
				mysql_query($sql_lastlogin_t);
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
			
				 echo 'true';
  				 $_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
				 }
  			} else {
				echo 'false';
				$temp_lc_user=mysql_query("SELECT * FROM $dbre.users WHERE login =\"$login\"") or die("Wystapil blad2".mysql_error());
				
				
				$howlc=mysql_num_rows($temp_lc_user) or $howlc=0;
				if($howlc!=0) $temp_lc_user=mysql_fetch_array($temp_lc_user) or die("Wystapil blad".mysql_error()); 
				if($howlc==1)
				{
				
				$lc = $temp_lc_user['login_count'] + 1;
				mysql_query("UPDATE $dbre.users SET `login_count` = \"$lc\", `last_l_time` = (SELECT ADDTIME(now(), '500')) WHERE login=\"$login\"");
				if($lc>=3)
				{
					echo 'recpass';
					
					 

				}

				}
			}
	}
}
if(isset($_POST["wyloguj"]))
{
	include "logout.php";
}
if (isset($_SESSION['login'])) # Jeżeli login sesyjny nie jest pusty, to wyświetl informacje o użytkowniku(login).
{
} else # W przeciwnym wypadku wyswietl okno logowania.
{

}
?>
	