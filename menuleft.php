<?php
/*
Plik, który odpowiada za wyświetlanie pozycji lewego menu.
*/


			printf('<div class="menuleft">
			<div id="menu_text">
				<li><a href="?id=" >Strona główna</a></li>
				
         
			<li><a href="?id=contact">Kontakt</a></li>');
				if(isset($_SESSION['login']))
					{
						$PA = mysql_query("SELECT privileges FROM $dbre.users WHERE login = \"".$_SESSION['login']."\"") or die("Wystapil blad".mysql_error());
						$PA = mysql_fetch_assoc($PA);
						if($PA['privileges'] == 1)
						{
							printf('<li><a href="?id=write">Dodaj post</a></li>');
							printf('<li><a href="admin">Panel Administratora</a></li>');	
						}
					}	
			printf('
			<li><a href="?id=adrb">Książka adresowa</a></li>
			</ul>
</div>
</div>');

?>