<?php
if(!isset($_GET['how']))
{
$x=4;
} else $x = $_GET['how'];
printf('<div class="tab">
<a href="?id=users&tab=1">Lista użytkowników</a>
<a href="?id=users&tab=2">Inne</a>
<a href="?id=users&tab=3">Inne</a>
</div><br /><table>');
if(isset($_GET['option']))
{
$option = $_GET['option'];
} else $option = "";
$change = isset($_POST['change']);

if(($option == "edit_user"))
	{
		$e_id = $_GET['user_id'];
		if(($change == "yes"))
		{
		$e_login = $_POST['e_login'];
		$e_name =  $_POST['e_name'];
		$e_surname = $_POST['e_surname']; 
		$e_mail = $_POST['e_mail'];
		$e_last_login_d = $_POST['e_last_login_d'];
		$e_last_login_t = $_POST['e_last_login_t']; 
		$sql_change = "UPDATE $dbre.users SET
									`login` = \"$e_login\",
									`name` = \"$e_name\",
									`surname` = \"$e_surname\",
									`mail` = \"$e_mail\",
									`last_login_d` = \"$e_last_login_d\",
									`last_login_t` = \"$e_last_login_t\" WHERE id=$e_id";
		mysql_query($sql_change) or die("Nie udalo sie modyfikować konta użytkownika".mysql_error());  # Modyfikuje konto
		}
		$search_sql = mysql_query("SELECT * FROM $dbre.users WHERE id = \"$e_id\"");
		$user_search_list = mysql_fetch_assoc($search_sql);
		printf('<form action="" method="post"><input type="text" name="e_login" value='.$user_search_list['login'].'><input type="text" name="e_name" value='.$user_search_list['name'].
		'><input type="text" name="e_surname" value='.$user_search_list['surname'].'><input type="text" name="e_mail" value='.$user_search_list['mail'].'
		><input type="text"  name="e_last_login_d" value='.$user_search_list['last_login_d'].'><input type="text" name="e_last_login_t" value='.$user_search_list['last_login_t'].'><input type="hidden" name="change" value="yes"><input type="submit" value="Zmień"></form>');
	} else if(($option == "del_user"))
	{
		$udel_id = $_GET['user_id'];
		$del_sql = mysql_query("DELETE FROM $dbre.users WHERE id = \"$udel_id\"") and printf("Użytkownik został usunięty.");
								
		
	}else if(($option == "send_mail"))
	{
		require_once "sendmsg.php";
	} else if(($option == "block_user"))
	{
		$e_id = $_GET['user_id'];
		$block_user_sql = mysql_query("SELECT * FROM $dbre.users WHERE id = \"$e_id\"");
		$user_block = mysql_fetch_assoc($block_user_sql);
		if($user_block['privileges'] == 0)
		{
			$block_sql = "UPDATE $dbre.users SET `privileges` = 2 WHERE id =\"$e_id\"";
			mysql_query($block_sql);
			printf('Użytkownik zablokowany. <a href="?id=users">Powrót</a>');
		} else if($user_block['privileges'] == 2)
		{
			$block_sql = "UPDATE $dbre.users SET `privileges` = 0 WHERE id =\"$e_id\"";
			mysql_query($block_sql);
			printf('Użytkownik odblokowany. <a href="?id=users">Powrót</a>');
		}
		
	}	else if(isset($_GET['search']))
		{
			$search_login = $_GET['search'];
			$search_sql = mysql_query("SELECT * FROM $dbre.users WHERE login LIKE \"%$search_login%\"");
			printf('<tr><td>ID</td><td>Login</td><td>Imię</td><td>Nazwisko</td><td>Mail</td><td>Ostatnie logowanie dnia</td><td>O godzinie</td></tr>');
			while($search_sql && $user_search_list = mysql_fetch_assoc($search_sql)) # wyświetlanie konkretnego użytkownika
			{
				printf("<tr><td>".$user_search_list['id']."</td><td>".$user_search_list['login']."</td><td>".$user_search_list['name']."</td><td>".$user_search_list['surname']."</td><td>".$user_search_list['mail']."</td><td>".$user_search_list['last_login_d']."</td><td>".$user_search_list['last_login_t']."</td></tr>
				");
			} 
} else { 
$user_sql = mysql_query("SELECT * FROM $dbre.users LIMIT 0,".$x);
printf('<tr><td>ID</td><td>Login</td><td>Imię</td><td>Nazwisko</td><td>Mail</td><td>Ostatnie logowanie dnia</td><td>O godzinie</td><td>Grupa użytkownika</td></tr>');
while($user_sql && $user_list = mysql_fetch_assoc($user_sql)) # wyświetlanie listy użytkowników
								{
									printf('<tr>
									<td>'.$user_list['id'].'</td><td>'.$user_list['login'].'</td><td>'.$user_list['name'].'</td><td>'.$user_list['surname'].'</td><td>'.$user_list['mail'].'</td><td>'.$user_list['last_login_d'].'</td><td>'.$user_list['last_login_t'].'</td>');
									if($user_list['privileges'] == 1)
									{
										printf('<td><span class="label label-danger">Administrator</span></td>');
									} else if($user_list['privileges'] == 0)
									{
										printf('<td><span class="label label-info">Użytkownik</span></td>');
									} else if($user_list['privileges'] == 2)
									{
										printf('<td><span class="label label-default">Zablokowany</span></td>');
									}
									printf('<td><a href="?id=users&option=edit_user&user_id='.$user_list['id'].'">Edytuj</a><td/><td><a href="?id=users&option=block_user&user_id='.$user_list['id'].'">Blokuj/Odblokuj</a></td><td><a href="?id=users&option=send_mail&user_id='.$user_list['id'].'">Wyślij wiadomość</a><td/><td><a href="?id=users&option=del_user&user_id='.$user_list['id'].'">Usuń użytkownika</a><td/></tr>');
								} 
}
printf('</table><br /><br />Liczba użytkowników do wyświetlenia:<form action="?id=users" method="get">
<input type="hidden" name="id" value="users">
<input type="text" value='.$x.' name="how">
<input type="submit" value="Wyślij">
</form>
<br />
Szukaj użytkownika
<form action="?id=users" method="get">
<input type="hidden" name="id" value="users">
<input type="text" value="" name="search">
<input type="submit" value="Wyślij"></form>');

?>