<?php
/*
Plik odpowiadający za przechodzenie pomiędzy konkretnymi kartami menu. 
Również odpowiada za wyświetlanie newsów na stronie głównej
*/
if (!isSet($_GET["id"])) # Jeżeli w zmiennej "id", pobieranej metodą GET, nie znajduje się żadna wartość, to ustaw wartość zmiennej na "".
{
	$_GET["id"] = "";
}
$p3 = 5;
if(isset($_GET['p']))
	{
		$p=$_GET['p'];	
		$p1 = ($p*5)-5;
		$p2 = $p*5;
	} else {
				$p1 = 0;
				$p2 = 5;
			 }
printf('
<div class="center">
<div id="tresctekst">'); # Odniesienie do ID styli, które odpowiadają za wyświetlenie pola, na którym ukazane są dane oraz tekstu na owym polu.
if ($_GET["id"] == 'contact')
{
	include "contact.php";
	
} else if($_GET["id"] == 'reg')
	{
				include "register.php";
	} else if($_GET["id"] == 'recpass')
		{
			include "recpass.php";
		} else if($_GET["id"] == 'adrb')
		{
			include "adrbook.php";
		}	else if ($_GET["id"] == 'write') # Jeżeli wartośćią zmiennej "id" jest "write", to załącz plik "write.php", który odpowiada za wprowadzanie newsów.
				{
					include "write.php";
				}  else if(isset($_GET["read"]))
						{
							include "read.php"; # Dołącz plik "read.php", który odpowiada za wyświetlanie konkretnych newsów.
						} else if (($_GET["id"] == "") or ($_GET["id"] != "")) # Jeżeli zmienna id nie posiada wartości lub jej wartość jest nieznana, to załaduj newsy.
							{
								
								$sql=mysql_query("SELECT * FROM $dbre.news ORDER BY id DESC LIMIT $p1,$p3"); # Wyciągnij wszystkie rekordy z tabeli "news" i wyświetl jedynie 3, sortując je wg godziny.
								
								while($sql && $wn = mysql_fetch_assoc($sql)) # wyświetlanie newsów i, o ile zajdzie taka potrzeba, skracanie wyświetlanego tekstu(funkcja) i załamanie wierszy(funkcja).
								{
									$sql_cat_read = mysql_query("SELECT * FROM $dbre.cat where id_cat=".$wn['cat_id']);
									$news_cat_assoc = mysql_fetch_assoc($sql_cat_read);
									printf("<h4><center>".wrap_br($wn['tytul'])."</center></h4>
									<br />
									Dodany dnia <b>$wn[data]</b> o godzinie <b>$wn[godzina]</b> przez <b>$wn[autor]</b><br /><br />".show_content(bbCode($wn['tresc']),1500) ."<br /><br /><b><a href=\"?read=".$wn['id']."&p=1\">Czytaj calosc</a></b><br /><br /><span class=\"label label-default label-pos\">$news_cat_assoc[cat_name]</span><br /><hr>");
								}
								$news_sql = mysql_query("SELECT * FROM $dbre.news ORDER BY data DESC, godzina DESC") or printf("<br />\tPowod - \"".mysql_error()."\"<br />");
$howm_news_sql = mysql_num_rows($news_sql);
$howm_news= $howm_news_sql/5;
$news_page = ceil($howm_news);
printf('<center>');
for($c=1; $c<$news_page+1; $c++)
							{
									if(isset($_GET["p"]))
									{
										if($_GET["p"]==$c) printf('<a style="text-decoration: none;font-weight: bold;color: #5C8DFF;" href="?p='.$c.'">'.$c.'&#009;</a>'); else printf('<a style="text-decoration: none;" href="?p='.$c.'">'.$c.'&#009;</a>');	
									}
									if(!isset($_GET["p"]))
									{
										printf('<a style="text-decoration: none;" href="?p='.$c.'">'.$c.'&#009;</a>');
									}
							}
							printf('</center>');
							} 

printf('</div></div>');
	

?>