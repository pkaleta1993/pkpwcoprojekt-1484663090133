<?php 
if(isset($_SESSION['login']))
{
	$PA = mysql_query("SELECT privileges FROM $dbre.users WHERE login = \"".$_SESSION['login']."\"") or die("Wystapil blad".mysql_error());
	$PA = mysql_fetch_assoc($PA);
}
 if(isset($_GET['option']) and ($_GET['option'] == "edit_news"))
	{
		if(isset($_SESSION['login']))
		{
			if($PA['privileges'] == 1)
			{
				$e_id = $_GET['read'];
				if((isset($_POST['change'])) and ($_POST['change'] == "yes"))
				{
				$e_author = $_POST['e_author'];
				$e_title = $_POST['e_title'];
				$e_d = $_POST['e_d'];
				$e_t = $_POST['e_t']; 
				$e_content = $_POST['e_content'];
				$sql_change = "UPDATE news SET
						`autor` = \"$e_author\",
						`tytul` = \"$e_title\",
						`data` = \"$e_d\",
						`godzina` = \"$e_t\",
						`tresc` = \"$e_content\" WHERE id=$e_id";
				mysql_query($sql_change) or die("Nie udalo sie modyfikować newsa".mysql_error());  # Modyfikuje konto
				}
				$search_sql = mysql_query("SELECT * FROM news WHERE id = \"$e_id\"");
				$news_search_list = mysql_fetch_assoc($search_sql);
				printf('<div  class="small-boxinp"><form action="" method="post">
							<div class="form-group"><span class="label label-primary label-pos">Autor</span><input type="text" class="sinp-box" name="e_author" value='.$news_search_list['autor'].'></div>
							<div class="form-group"><span class="label label-primary label-pos">Data</span><input type="text" class="sinp-box"  name="e_d" value='.$news_search_list['data'].'></div>
							<div class="form-group"><span class="label label-primary label-pos">Godzina</span><input type="text" class="sinp-box"  name="e_t" value='.$news_search_list['godzina'].'></div>
							<div class="form-group"><span class="label label-primary label-pos">Tytuł</span><textarea  class="sinp-box"  name="e_title" id="input">'.$news_search_list['tytul'].'</textarea></div>
							<div class="form-group"><span class="label label-primary label-pos">Treść</span><textarea rows=15 class="sinp-box"  name="e_content" id="input">'.$news_search_list['tresc'].'</textarea></div>
							<input type="hidden" name="change" value="yes">
							<input type="submit" class="btn btn-primary" name="submit" value="Zapisz" />
							</form></div>');
			}
		}
	} else if(isset($_GET['option']) and ($_GET['option'] == "edit_com"))
	{
		if(isset($_SESSION['login']))
		{
				
				$sql_del_newscom_user = mysql_query("SELECT * FROM $dbre.news_komentarze where i_id=".$_GET['news_edit_com_id']);
				$sql_del_newscom_user_assoc = mysql_fetch_assoc($sql_del_newscom_user);
	
			if(($PA['privileges'] == 1) or ($sql_del_newscom_user_assoc['autor'] == $_SESSION['login']))
			{
				$e_id = $_GET['news_edit_com_id'];
				if((isset($_POST['changecom'])) and ($_POST['changecom'] == "yes"))
				{
				$e_content = $_POST['news_kom'];
				$sql_change = "UPDATE news_komentarze SET `tresc` = \"$e_content\" WHERE i_id=$e_id";
				mysql_query($sql_change) and printf('Zmieniono treść komentarza. <a href="?read='.$_GET['read'].'">Wróć do newsa.</a>') or die("Nie udalo sie modyfikować newsa".mysql_error());  # Modyfikuje konto
				}
				
				
				printf('<hr>	
										<div  class="medium-boxinp" style="margin-top: 10px">

											
										<form action="" method="post">
										<span class="label label-default label-pos">Treść komentarza</span><br />	
										<textarea rows="11" style="width: 80%%;float: left; resize:none;"  name="news_kom" id="news_textbox" onfocus="updateFocus(this)" />'.$sql_del_newscom_user_assoc['tresc'].'</textarea>
										<div class="h-smallbox">
										<input type="button" class="btn btn-blog space" value="b" onclick="insertTag(\'[b]\',\'[/b]\')">
										<input type="button" class="btn btn-blog space" value="i" onclick="insertTag(\'[i]\',\'[/i]\')">
										<input type="button" class="btn btn-blog space" value="u" onclick="insertTag(\'[u]\',\'[/u]\')">
										<input type="button" class="btn btn-blog space" value="s" onclick="insertTag(\'[s]\',\'[/s]\')">
										<input type="button" class="btn btn-blog space" value="link" onclick="insertTag(\'[url=\',\'][/url]\')">
										<input type="button" class="btn btn-blog space" value="cytat" onclick="insertTag(\'[quote]\',\'[/quote]\')">
										<input type="button" class="btn btn-blog space" value="kod" onclick="insertTag(\'[code]\',\'[/code]\')">
										<input type="hidden" name="changecom" value="yes">
										</div><input type="submit" class="btn btn-primary xsmall-boxinp" style="margin-top: 8px;"  name="submit" value="Opublikuj" />
										</form></div>');
		}
		}		
	} else { 
if(isset($_GET['read']))
{
	$news_id = $_GET['read'];	
}

if (!empty($_POST['news_kom'])) 
	{
		if(isset($_SESSION['login']) and isset($_SESSION['privileges']) and isset($_SESSION['user_id']))
		{
			if(isset($_POST['g-recaptcha-response'])){
				$captcha=$_POST['g-recaptcha-response'];
			}
			 if(!$captcha){
				 ?>
				 <script type="text/javascript">
					$(document).ready(
					function() {
					alert("Captcha nie została wypełniona!");
					}
)
</script>
				 <?php
				 
			} else
				{
				$resp=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcIZRQTAAAAAHdWUxfHXj2CoaP6R5HqrBjZKvRA&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
					
					
				$sr_oc_sql = mysql_query("SELECT * FROM $dbre.news WHERE id = ".$news_id);
				$sr_oc = mysql_fetch_assoc($sr_oc_sql);
				$sr_oc_update = "";
				$tresc_kom = $_POST['news_kom'];
				$news_login = $_SESSION['login'];
				$news_login = $_SESSION['login'];
				$sql_n_kom = "INSERT INTO $dbre.news_komentarze (
							`id` ,
							`autor` ,
							`data_k` ,
							`godzina`,
							`tresc`
							)
							VALUES ($news_id, \"$news_login\", SYSDATE(), CURRENT_TIME(), \"$tresc_kom\")";
				mysql_query($sql_n_kom) or die("Nie udalo sie dodac newsa".mysql_error());
				}
		} else printf('Musisz być zalogowany!');
	} 

if(isset($_GET['news_del_id']))
{	
	
	$sql_del_news_user = mysql_query("SELECT * FROM $dbre.news_komentarze where i_id=".$_GET['news_del_id']."");
	$sql_del_news_user_assoc = mysql_fetch_assoc($sql_del_news_user);
	
	if(isset($_SESSION['privileges']) and (($_SESSION['privileges'] == 1) or $sql_del_news_user_assoc['autor'] == $_SESSION['login']))
	{
		
		$news_del_id = $_GET['news_del_id'];
		$del_sql= mysql_query("DELETE FROM $dbre.news_komentarze WHERE i_id = \"$news_del_id\"");
	}
}
if(isset($_GET["read"])) # Jeżeli zmienna "read", pobierana metodą GET, nie jest pusta, to wykonaj poniższe polecenia.
{
	if(isset($_GET['p']))
	{
		$p=$_GET['p'];	
		$p1 = ($p*5)-5;
		$p2 = $p*5;
	} else {
				$p1 = 0;
				$p2 = 5;
			 }
$news_kom_sql = mysql_query("SELECT * FROM $dbre.news_komentarze WHERE id = $news_id ORDER BY data_k DESC, godzina DESC LIMIT $p1,$p2") or printf("<br />\tPowod - \"".mysql_error()."\"<br />");
$how_news_kom_sql = mysql_num_rows(mysql_query("SELECT * FROM $dbre.news_komentarze WHERE id = $news_id"));
$how_news_kom = $how_news_kom_sql/5;
$com_page = ceil($how_news_kom);
$sql_read = mysql_query("SELECT * FROM $dbre.news where id=".$news_id."") or die("Nie udalo sie wyciagnac newsa z bazy, bo ".mysql_error()); # Wyciągnij news o podanym id.
$news_assoc = mysql_fetch_assoc($sql_read); # Przyłącz rekord do zmiennej "news_assoc".
$sql_cat_read = mysql_query("SELECT * FROM $dbre.cat where id_cat=".$news_assoc['cat_id']);
$news_cat_assoc = mysql_fetch_assoc($sql_cat_read);
printf("<h3><center>$news_assoc[tytul]</center></h3>
<br /><br />
Napisany dnia: <b>$news_assoc[data]</b> o godzinie: <b>$news_assoc[godzina]</b> przez <b>$news_assoc[autor]</b><br /><br />".bbCode($news_assoc['tresc'])."<br /><br /><span class=\"label label-default label-pos\">$news_cat_assoc[cat_name]</span><br /><hr><hr>");
	if(isset($_SESSION['login']))
					{
						
						if($PA['privileges'] == 1)
						{
							
							if(isset($_GET['option']))
							{
								if($_GET['option'] == 'del')
								{
									$e_id = $_GET['read'];
									$del_sql = mysql_query("DELETE news FROM news WHERE id = \"$e_id\"") and printf("News został usunięty. <a href=\"index.php\"><b>Powrót</b></a><br />");
								}
							} else {
								printf('<li><a href="?read='.$news_assoc["id"].'&option=edit_news">Edytuj post</a></li>');	
								printf('<li><font id="#del"><a href="?read='.$news_assoc["id"].'&option=del">Usuń post</a></font></li><hr><hr>');	
							}
						}
					}	
if($how_news_kom_sql == 0)
{
	printf("<center><b>Brak komentarzy!</b></center>");
} else while($news_kom_sql && $sql_read = mysql_fetch_assoc($news_kom_sql))
							{
								printf('Komentarz zamieszczony przez: <b>'.$sql_read['autor'].', dnia '.$sql_read['data_k'].' o godzinie '.$sql_read['godzina'].'</b><br /><br />
								'.bbCode($sql_read['tresc']).'<br /><br />');
								if(isset($_SESSION['privileges']) and (($_SESSION['privileges'] == 1) or $sql_read['autor'] == $_SESSION['login']))
								{
								printf('<font id="del"><a href="?read='.$news_id.'&option=edit_com&news_edit_com_id='.$sql_read['i_id'].'" style="padding-right: 10px;">Edytuj komentarz</a></font>');
								printf('<font id="del"><a href="?read='.$news_id.'&option=del_com&news_del_id='.$sql_read['i_id'].'">Usuń komentarz</a></font>');
								}
								printf('<hr><br />');
								
							}
							printf('<center><b>');
							for($c=1; $c<$com_page+1; $c++)
							{	
									if(isset($_GET["p"]))
									{
										if($_GET["p"]==$c) printf('<a style="text-decoration: none;font-weight: bold;color: #5C8DFF;"  href="?read='.$news_id.'&p='.$c.'">'.$c.'&#009;</a>'); else printf('<a style="text-decoration: none;" href="?read='.$news_id.'&p='.$c.'">'.$c.'&#009;</a>');	
									}
									if(!isset($_GET["p"]))
									{
										printf('<a style="text-decoration: none;"  href="?read='.$news_id.'&p='.$c.'">'.$c.'&#009;</a>');
									}
									
							}
							printf('</b></center><hr>');
							if(isset($_SESSION['login']) and isset($_SESSION['privileges']) and isset($_SESSION['user_id']))
							{
									if(!isset($_GET['option']) or ($_GET['option'] != 'del'))
									{
									
										printf('<hr>	
										<div  class="medium-boxinp" style="margin-top: 10px">

											
										<form action="" method="post">
										<span class="label label-default label-pos">Treść komentarza</span><br />	
										<textarea rows="11" style="width: 80%%;float: left; resize:none;"  name="news_kom" id="news_textbox" onfocus="updateFocus(this)" /></textarea>
										<div class="h-smallbox">
										<input type="button" class="btn btn-blog space" value="b" onclick="insertTag(\'[b]\',\'[/b]\')">
										<input type="button" class="btn btn-blog space" value="i" onclick="insertTag(\'[i]\',\'[/i]\')">
										<input type="button" class="btn btn-blog space" value="u" onclick="insertTag(\'[u]\',\'[/u]\')">
										<input type="button" class="btn btn-blog space" value="s" onclick="insertTag(\'[s]\',\'[/s]\')">
										<input type="button" class="btn btn-blog space" value="link" onclick="insertTag(\'[url=\',\'][/url]\')">
										<input type="button" class="btn btn-blog space" value="cytat" onclick="insertTag(\'[quote]\',\'[/quote]\')">
										<input type="button" class="btn btn-blog space" value="kod" onclick="insertTag(\'[code]\',\'[/code]\')">
										</div>');
										printf('<div class="g-recaptcha" style=" float: left; margin-top: 8px; margin-bottom: 10px;" data-theme="dark" data-sitekey="6LduCRYTAAAAAO4tfLiyF6zlCjdFEKPoEQx1BtyP"></div>
										<input type="submit" class="btn btn-primary xsmall-boxinp" style="margin-top: 8px;"  name="submit" value="Opublikuj" />
										</form></div>');
									}
							}
} # Wyswietl newsa o podanym id.
}
?>
<script>
var holdFocus;

function updateFocus(x)
{
    holdFocus = x;
}

function appendTextToLastFocus(text)
{
    holdFocus.value += text;
}
function insertTag(sAreaTag,stAreaTag){
   var newsTxtArea = document.getElementById("news_textbox");
   if(!newsTxtArea.setSelectionRange) {
      var sRange = document.selection.createRange().text; 
      if(sRange.length <= 0) {
         newsTxtArea.value +=sAreaTag + stAreaTag;
      } else {
         document.selection.createRange().text = sAreaTag + sRange + stAreaTag;
      }
   } else {
      var pretext = newsTxtArea.value.substring(0, newsTxtArea.selectionStart);
	   var codetext = sAreaTag + newsTxtArea.value.substring(newsTxtArea.selectionStart,   newsTxtArea.selectionEnd) + stAreaTag;
      var posttext = newsTxtArea.value.substring(newsTxtArea.selectionEnd, newsTxtArea.value.length)
      if(codetext == sAreaTag + stAreaTag) {
         newsTxtArea.value +=sAreaTag + stAreaTag;
      } else {
         newsTxtArea.value = pretext + codetext + posttext;
      }
   }
   newsTxtArea.focus ();
}
</script>