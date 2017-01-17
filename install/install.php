<?php
//include "../dbconnect.php";
echo "testoawnie";
$user = "users";
$news = "news";
$text = "text";
$terminarz = "teminarz";
$cat="cat";
$ka="ka";
$newscom="news_komentarze";
$notes="notes";
$wpisy="wpisy";
$install = 1;
if (!isset($_GET["install"]))
{
	$_GET["install"] ="";
} else if(($_GET["install"] != "yes") and ($_GET["install"] != ""))
{
	echo 'Baza danych nie zostala zainstalowana z powodu zle wybranej opcji';
} else if ($_GET["install"] == "yes") {
if (isset($_GET["urmail"]))
{
	$mail = $_GET["urmail"];
	
$sql1="CREATE TABLE IF NOT EXISTS $user (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `privileges` tinyint(4) NOT NULL,
  `last_login_d` date NOT NULL,
  `last_login_t` time NOT NULL,
  `points` float NOT NULL,
  `value` float NOT NULL,
  `qst` varchar(50) NOT NULL,
  `asw` varchar(50) NOT NULL,
  `last_l_time` datetime NOT NULL,
  `login_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
";
		
$sql2="CREATE TABLE IF NOT EXISTS $news (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `autor` varchar(50) NOT NULL,
  `tytul` tinytext NOT NULL,
  `data` date NOT NULL,
  `godzina` time NOT NULL,
  `tresc` text NOT NULL,
  `sr_ocen` float NOT NULL,
  `cat_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;
";

$sql3="CREATE TABLE IF NOT EXISTS $cat (
  `id_cat` tinyint(4) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
";

$sql4="CREATE TABLE IF NOT EXISTS $ka (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cuid` int(11) NOT NULL,
  `cname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `csname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `cphone` varchar(12) COLLATE utf8_polish_ci NOT NULL,
  `cad` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `ccit` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=107 ;
";

$sql5="CREATE TABLE IF NOT EXISTS $news_komentarze (
  `i_id` int(10) NOT NULL AUTO_INCREMENT,
  `autor` varchar(50) NOT NULL,
  `data_k` date NOT NULL,
  `godzina` time NOT NULL,
  `tresc` text NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql6="CREATE TABLE IF NOT EXISTS $notes (
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql7="CREATE TABLE IF NOT EXISTS $wpisy (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(15) NOT NULL,
  `nazwisko` varchar(15) NOT NULL,
  `nr` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql8="INSERT INTO $cat (`id_cat`, `cat_name`) VALUES
(0, 'Bez kategorii');";

$sql9="INSERT INTO $news (`id`, `autor`, `tytul`, `data`, `godzina`, `tresc`, `sr_ocen`, `cat_id`) VALUES
(22, 'Administrator', 'Witamy na naszej książce adresowej', '2016-12-13', '15:13:57', 'Jest nam przyjemnie powitać Państwa na stronie, która ma na celu [b]przechowywanie adresów [/b]przyjaciół, kolegów, współpracowników.', 0, 0);
";

$sql10="INSERT INTO $user (`id`, `login`, `password`, `mail`, `name`, `surname`, `privileges`, `last_login_d`, `last_login_t`, `points`, `value`, `qst`, `asw`, `last_l_time`, `login_count`) VALUES
(1, 'Administrator', '8c2e680c62c356e648d8b8cfcfe23751', '".$mail."', 'Pawel', 'Kaleta', 1, '2016-12-13', '00:00:00', 0, 0, 'Ulubiony kolor?', 'Czarny', '2016-03-16 19:49:01', 0);
";

$sql11="INSERT INTO `notes` (`notes`) VALUES
('Witamy w panelu administratora stworzonym na potrzeby projektu z PAW');
";
echo "<div id=\"tresctekst\">Tworzenie tabeli $user...\n";
mysql_query($sql1) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie tabeli $news...\n";
mysql_query($sql2) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie tabeli $cat...\n";
mysql_query($sql3) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie tabeli $ka...\n";
mysql_query($sql4) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie tabeli $news_komentarze...\n";
mysql_query($sql5) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie tabeli $notes...\n";
mysql_query($sql6) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie tabeli $wpisy...\n";
mysql_query($sql7) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie kategorii...\n";
mysql_query($sql8) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie newsa...\n";
mysql_query($sql9) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie konta Administratora...\n";
mysql_query($sql10) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
echo "Tworzenie notatki w PA...\n";
mysql_query($sql11) and printf("OK.<br />") or printf("NOT OK. <br />\tPowod - \"".mysql_error()."\"<br />") and $install--;
if($install == 1)
{
	printf('<br /><br />Baza danych utworzona poprawnie.<br />Przejdz do strony książki <a href="../">PRZEZ TEN LINK</a></div>');
} else {
	printf('<br /><br />Tworzenie bazy nie udalo sie.</div>');
}
} else {
	echo '<br />Nie podano maila';
}
}
?>
