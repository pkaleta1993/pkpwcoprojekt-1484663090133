<?php


if(!empty($_GET['q']))
{
	include "dbconnect.php";
	$q = $_GET['q'];
	$query="select * from ka where ((csname like '%$q%') or (cname like '%$q%') or (cphone like '%$q%') or (cad like '%$q%') or (ccit like '%$q%'))";
	$tablest =  "<tr id=solblue>	
					<th><center>X</center></th>
					<th>Nazwisko</th>
					<th>Imie</th>	
					<th>Nr telefonu</th>
					<th>Adres</th>
					<th>Miejscowość</th>
					<th>Edytuj</th>
					<th>Usuń</th>
				</tr>";
	$result = mysql_query($query);
	$textsrch = "";
	while($output=mysql_fetch_assoc($result))
	{
		
		$textsrch = "<tr id=\"fade\">
						<th><input type=\"checkbox\" name=\"delGrp[]\" value=\"$output[cid]\"></th>
						<th>$output[csname]</th>
						<th>$output[cname]</th>
						<th>$output[cphone]</th>
						<th>$output[cad]</th>
						<th>$output[ccit]</th>
						<th><button type=\"button\" class=\"label label-warning label-pos\" data-toggle=\"modal\" data-target=\"#myModal$output[cid]\">Edytuj</button></a></th>
						<th><a href=\"?id=adrb&delCuid=$output[cid]\"><span class=\"label label-danger label-pos\">Usuń</span></a></th>
					</tr>
					";
		$tablest = $tablest.$textsrch;		
		
	}
	echo $tablest;
}
?>