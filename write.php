<?php
@$PA = mysql_query("SELECT privileges FROM $dbre.users WHERE login = \"".$_SESSION['login']."\"") or die("Wystapil blad".mysql_error());
$PA = mysql_fetch_assoc($PA);
if (isset($_SESSION['login']) and ($PA['privileges'] == 1))
{
	if ((!empty($_POST['news_title'])) and (!empty($_POST['news_content']))) # Jeżeli zmienne "news_title" oraz "content" nie są puste, to wykonaj poniższe polecenia
	{
		$news_title = $_POST["news_title"]; 
		$news_content = $_POST["news_content"];
		$login_w = $_SESSION['login'];
		$sql_news = "INSERT INTO $dbre.news (
					`id` ,
					`autor` ,
					`tytul` ,
					`data` ,
					`godzina`,
					`tresc`
					)
					VALUES (NULL , \"$login_w\", \"$news_title\" ,SYSDATE(), CURRENT_TIME() , \"$news_content\");";
		mysql_query($sql_news) && printf('Wprowadzono newsa do bazy danych') or die("Nie udalo sie dodac newsa".mysql_error());  # Wprowadź newsa do bazy danych
	}
						
} else echo "Nie jesteś zalogowany lub nie masz odpowiednich uprawnień.";
?>
<div  class="medium-boxinp" style="margin-top: 10px">
<h1>Formularz newsa</h1>
<form action="" method="post" id="news_write">
<span class="label label-default label-pos">Tytul:</span><br />
<input name="news_title" type="text" value="" id="news_title" maxlenght="255" /><br /><br />
<span class="label label-default label-pos">Treść:</span><br />
<textarea name="news_content" id="newsArea" style="width: 80%;float: left;" rows="20"  id="news_textbox" onfocus="updateFocus(this)" /></textarea>
<div class="h-smallbox">
<input type="button" class="btn btn-primary space" value="b" onclick="insertTag('[b]','[/b]')">
<input type="button" class="btn btn-primary space" value="i" onclick="insertTag('[i]','[/i]')">
<input type="button" class="btn btn-primary space" value="u" onclick="insertTag('[u]','[/u]')">
<input type="button" class="btn btn-primary space" value="s" onclick="insertTag('[s]','[/s]')">
<input type="button" class="btn btn-primary space" value="link" onclick="insertTag('[url=','][/url]')">
<input type="button" class="btn btn-primary space" value="obrazek" onclick="insertTag('[img]','[/img]')">
<input type="button" class="btn btn-primary space" value="cytat" onclick="insertTag('[quote]','[/quote]')">
<input type="button" class="btn btn-primary space" value="kod" onclick="insertTag('[code]','[/code]')">
</div>
<input type="submit" class="btn btn-primary" name="submit" value="Opublikuj" />
</form>
</div>
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
   var newsTxtArea = document.getElementById("newsArea");
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