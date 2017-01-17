<?php
/*
Plik, który odpowiada za wylogowanie użytkownika i zapisanie czasu tej czynności.
*/

#$sql_lastlogin_d = "UPDATE `re`.`users` SET last_login_d = SYSDATE() WHERE login = \"".$_SESSION['login']."\"";
#mysql_query($sql_lastlogin_d) or die("Wystapil blad".mysql_error()); 
#$sql_lastlogin_t = "UPDATE `re`.`users` SET last_login_t = CURRENT_TIME('') WHERE login = \"".$_SESSION['login']."\"";
#mysql_query($sql_lastlogin_t);
#session_unset(); 
session_destroy();
?>