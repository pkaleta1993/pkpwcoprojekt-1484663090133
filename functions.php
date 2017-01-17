<?php 
/* 
Plik, w którym zawarte są funkcje:
 - podglądu newsów - skracanie wyświetlonej zawartości.
*/


function show_content($content,$lenght) # Funkcja, która za zadanie ma skrócenie wyświetlanego tekstu o "lenght", o ile tekst ma więcej niż "lenght" znaków.
{
  if (strlen($content) > $lenght)
  {
    return substr($content, 0, strrpos(substr($content, 0, $lenght), " ")).'[...]';
  } else return $content;
}


function wrap_br($str, $len = 100, $br =" ") # Funkcja dodaje znak nowej linii po długości określonej poprzez "len".
{ 
while($str){
$str_part = substr($str, $len); # Dzieli tekst na części
$wh = strpos($str_part," "); # Szuka spacji
$br .= substr($str, 0, $wh+$len)."<br />"; # Łączy fragmenty tekstu.
$str = substr($str, $wh+$len); # "Odejmuje" tekst, w którym nie potrzeba już wstawiać znaków nowej linii.
}
return $br; # Zwraca tekst.
}
function bbCode($bbStr){
	
	$bbStr= htmlspecialchars($bbStr);
	$bbStr = preg_replace("#\[b\](.*?)\[/b\]#si",'<b>\\1</b>',$bbStr);
	$bbStr = preg_replace("#\[i\](.*?)\[/i\]#si",'<i>\\1</i>',$bbStr);
	$bbStr = preg_replace("#\[u\](.*?)\[/u\]#si",'<u>\\1</u>',$bbStr);
	$bbStr = preg_replace("#\[s\](.*?)\[/s\]#si",'<s>\\1</s>',$bbStr);
	$bbStr = preg_replace("#\[img\](.*?)\[/img\]#si",'<img src="\\1" alt="" />',$bbStr);
	$bbStr = preg_replace("#\[url=(.*?)\](.*?)\[/url\]#si", "<a href=\"http://\\1\">\\2</A>", $bbStr);
	$bbStr = preg_replace("#\[quote\](.*?)\[/quote\]#si",'<blockquote class="cytat">\\1</blockquote>',$bbStr);
	$bbStr = preg_replace("#\[code\](.*?)\[/code\]#si",'<pre>\\1</pre>',$bbStr);


	return($bbStr);
}

function randomPass() {
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $npass = array();
    $newpassL = strlen($letters) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $newpassL);
        $npass[] = $letters[$n];
    }
    return implode($npass);
}
?>