<?php
if(!isset($_GET['how']))
{
$x=4;
} else $x = $_GET['how'];
printf('<div class="tab">
<a href="?id=news&tab=1">Lista newsów</a>
<a href="?id=news&tab=2">Inne</a>
<a href="?id=news&tab=3">Inne</a>
</div><br />');
printf('<br /><br />Liczba newsów do wyświetlenia:<form action="?id=news" method="get">
<input type="hidden" name="id" value="news">
<input type="text" value='.$x.' name="how">
<input type="submit" value="Wyślij">
</form>
<br />
Szukaj konkretnego newsa(po tytule):
<form action="?id=news" method="get">
<input type="hidden" name="id" value="news">
<input type="text" value="" name="search">
<input type="submit" value="Wyślij"></form><hr size=5><br />');
#$option = isset($_GET['option']);
if(isset($_GET['option']))
{
$option = $_GET['option'];
}
$change = isset($_POST['change']);
if(isset($_GET['option']) and ($option == "del_news"))
{
	$e_id = $_GET['news_id'];
	$del_sql = mysql_query("DELETE FROM $dbre.`news` WHERE id = \"$e_id\"") and printf("News został usunięty. <a href=\"index.php?id=news\"><b>Powrót</b></a><br />");
	$del_sql_com = mysql_query("DELETE FROM $dbre.`news_komentarze` WHERE id =\"$e_id \""); #usuniecie komentarzy do newsa
} else if(isset($_GET['option']) and ($option == "edit_news"))
	{
		$e_id = $_GET['news_id'];
		if(($change == "yes"))
		{
		$e_author = $_POST['e_author'];
		$e_title = $_POST['e_title'];
		$e_d = $_POST['e_d'];
		$e_t = $_POST['e_t']; 
		$e_content = $_POST['e_content'];
		$sql_change = "UPDATE $dbre.`news` SET
				`autor` = \"$e_author\",
				`tytul` = \"$e_title\",
				`data` = \"$e_d\",
				`godzina` = \"$e_t\",
				`tresc` = \"$e_content\" WHERE id=$e_id";
		mysql_query($sql_change) or die("Nie udalo sie modyfikować newsa".mysql_error());  # Modyfikuje konto
		}
		$search_sql = mysql_query("SELECT * FROM $dbre.`news` WHERE id = \"$e_id\"");
		$news_search_list = mysql_fetch_assoc($search_sql);
		printf('<form action="" method="post">
					<input type="text" name="e_author" value='.$news_search_list['autor'].'>
					<input type="text" name="e_d" value='.$news_search_list['data'].'>
					<input type="text" name="e_t" value='.$news_search_list['godzina'].'><br />
					<textarea rows="1" cols="20" name="e_title" id="input">'.$news_search_list['tytul'].'</textarea><br />
					<textarea rows="20" cols="80" name="e_content" id="input">'.$news_search_list['tresc'].'</textarea>
					<input type="hidden" name="change" value="yes"><input type="submit" value="Zmień"></form>');
	} else if(isset($_GET['search']))
		{
			$search_news = $_GET['search'];
			$search_sql = mysql_query("SELECT * FROM $dbre.`news` WHERE tytul LIKE \"%$search_news%\"");
			while($search_sql && $news_list = mysql_fetch_assoc($search_sql)) # wyświetlanie konkretnego użytkownika
			{
				printf("<b><center>".wrap_br($news_list['tytul'])."</center></b>
				<br />Napisany dnia: <b>$news_list[data]</b> o godzinie: <b>$news_list[godzina]</b>
				przez <b>$news_list[autor]</b><br /><br />".show_content(wrap_br($news_list['tresc']),100) ."<br />
				<br /><a href=\"../?read=".$news_list['id']."\">Czytaj calosc</a><br /><br />
				<a href=\"?id=news&option=edit_news&news_id=$news_list[id]\">Edytuj</a><br />
				<a href=\"?id=news&option=del_news&news_id=$news_list[id]\">Usuń</a><hr>");
			} 
} else { 
	
		$news_sql = mysql_query("SELECT * FROM $dbre.`news` LIMIT 0,".$x);
		while($news_sql && $news_list = mysql_fetch_assoc($news_sql)) # wyświetlanie listy użytkowników
			{
				printf("<b><center>".wrap_br($news_list['tytul'])."</center></b>
				Napisany dnia: <b>$news_list[data]</b> o godzinie: <b>$news_list[godzina]</b>
				przez <b>$news_list[autor]</b><br /><br />".show_content(wrap_br($news_list['tresc']),100) ."<br />
				<br /><a href=\"../?read=".$news_list['id']."\">Czytaj calosc</a><br /><br />
				<a href=\"?id=news&option=edit_news&news_id=$news_list[id]\">Edytuj</a>
				<a href=\"?id=news&option=del_news&news_id=$news_list[id]\">Usuń</a><br /><hr>");
			} 
		
		}


?>