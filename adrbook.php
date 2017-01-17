
<?php
if(isset($_SESSION['login']))
{
	?>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
	<script src="js/validate.js"></script>
	<style>
		#addcon .form-group label.error {
			color: #337AB7;
			display: inline-block;
			margin: 4px 0 5px 125px;
		   
		   
		}
		input.error {
			border: 2px solid #337AB7;
		}
		input.valid {
			border: 2px solid #337AB7;
		}

	</style>
	<div class="form-group"><span class="label label-primary label-pos">Wyszukaj</span><br /><input type="text" class="sinp-box" name="lsearch" id="lsearch" placeholder="Wpisz dane wyszukiwania" /></div>
	
	<button class="btn btn-success" data-toggle="collapse" data-target="#showHide">Dodaj kontakt</button>

	<div class="form-group sinp-box">
	<div class="collapse" id="showHide" aria-expanded="false" style="height: 0px;"><div class="well">

	<form action="" method="post" id="addcon" data-toggle="validator">
	<div class="form-group"><span class="label label-primary label-pos">Imię</span><br /><input type="text" class="inp-box" name="conName" placeholder="Wpisz tutaj imię" value=""></div>
	<div class="form-group"><span class="label label-primary label-pos">Nazwisko</span><br /><input type="text" class="inp-box"  name="conSurname" placeholder="Wpisz tutaj nazwisko" value=""></div>
	<div class="form-group"><span class="label label-primary label-pos">Nr telefonu</span><br /><input type="text" class="inp-box" name="conPhone" placeholder="Wpisz tutaj numer telefonu" value=""></div>
	<div class="form-group"><span class="label label-primary label-pos">Adres</span><br /><input type="text" class="inp-box" name="conAd" placeholder="Wpisz tutaj adres" value=""></div>
	<div class="form-group"><span class="label label-primary label-pos">Miejscowość</span><br /><input type="text" class="inp-box" name="conCit" placeholder="Wpisz tutaj miasto" value=""></div>
	<input type="submit" class="btn btn-primary" id="buttonaddcon" name="submit" value="Dodaj" />
	</form>
	 </div> </div>
	</div>
	<?php
	$addCuid = $_SESSION['user_id'];
	if(isset($_POST['conName']) and isset($_POST['conSurname']) and isset($_POST['conPhone']) and isset($_POST['conAd']) and isset($_POST['conCit']))
	{
		
		$addCname = $_POST['conName'];
		$addCsurname = $_POST['conSurname'];
		$addCphone = $_POST['conPhone'];
		$addCad = $_POST['conAd'];
		$addCcit = $_POST['conCit'];
		$addcToMysql = "INSERT INTO $dbre.ka (
					`cuid` ,
					`cname` ,
					`csname` ,
					`cphone` ,
					`cad`,
					`ccit`
					)
					VALUES (\"$addCuid\" , \"$addCname\", \"$addCsurname\" , \"$addCphone\", \"$addCad\" , \"$addCcit\");";
		mysql_query($addcToMysql) && printf('Wprowadzono kontakt do bazy danych') or die("Nie udalo sie dodac kontaktu".mysql_error());  

	}

if (isset($_POST['delGrp'])) 
{
	$delGrpId = $_POST['delGrp'];
	 foreach ($delGrpId as $dgid=>$value) {

			mysql_query("DELETE FROM $dbre.ka WHERE cid = \"$value\"") or die("Nie udalo sie usunąć kontaktu".mysql_error());

        }
    //print_r($_POST['delGrp']); 
}

	if(isset($_GET['id']) and isset($_GET['delCuid']))
	{
		$delCidId = $_GET['delCuid'];
		mysql_query("DELETE FROM $dbre.ka WHERE cid = \"$delCidId\"") or die("Nie udalo sie usunąć kontaktu".mysql_error());
	}
	if(isset($_POST['econName']) and isset($_POST['econSurname']) and isset($_POST['econPhone']) and isset($_POST['econAd']) and isset($_POST['econCid']) and isset($_POST['econCit']))
	{
		$eName = $_POST['econName'];
		$eSname = $_POST['econSurname'];
		$ePhone = $_POST['econPhone'];
		$eAd = $_POST['econAd'];
		$eCit = $_POST['econCit'];
		$eCid = $_POST['econCid'];
		mysql_query("UPDATE ka SET
						`cname` = \"$eName\",
						`csname` = \"$eSname\",
						`cphone` = \"$ePhone\",
						`cad` = \"$eAd\",
						`ccit` = \"$eCit\" WHERE cid=$eCid");
	}
		printf('<div class="kt" id="kt"><form action="" method="post"><div id="contable"><table class="multicol" id="addlshere">
		<tr id=solblue>	
			<th><center>X</center></th>
			<th>Nazwisko</th>
			<th>Imie</th>	
			<th>Nr telefonu</th>
			<th>Adres</th>
			<th>Miejscowość</th>
			<th>Edytuj</th>
			<th>Usuń</th>
		</tr>');
		$wp_sql = mysql_query("SELECT * FROM $dbre.ka WHERE cuid = \"$addCuid\" ORDER BY csname ASC") or printf("<br />\tPowod - \"".mysql_error()."\"<br />");
		while($wp_sql && $sql_read = mysql_fetch_assoc($wp_sql))
									{
										printf('
										<tr id="fade">
											<th> <input type="checkbox" name="delGrp[]" value="'.$sql_read['cid'].'"></th>
											<th>'.$sql_read['csname'].'</th>
											<th>'.$sql_read['cname'].'</th>
											<th>'.$sql_read['cphone'].'</th>
											<th>'.$sql_read['cad'].'</th>
											<th>'.$sql_read['ccit'].'</th>
											<th><button type="button" class="label label-warning label-pos" data-toggle="modal" data-target="#myModal'.$sql_read['cid'].'">Edytuj</button></a></th>
											');
											?>
											<div class="modal fade" id="myModal<?php echo $sql_read['cid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											  <div class="modal-dialog" role="document">
												<div class="modal-content">
												
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" style="color: #559AD7;" id="myModalLabel">Edycja kontaktu</h4>
												  </div>
												  <div class="modal-body">
													<?php 
														printf('<form action="" method="post" id="edsavcon'.$sql_read['cid'].'" data-toggle="validator">
														<div class="form-group"><span class="label label-primary label-pos">Imię</span><br /><input type="text" class="inp-box" name="econName" value="'.$sql_read['cname'].'" /></div>
														<div class="form-group"><span class="label label-primary label-pos">Nazwisko</span><br /><input type="text" class="inp-box"  name="econSurname"  value="'.$sql_read['csname'].'" /></div>
														<div class="form-group"><span class="label label-primary label-pos">Nr telefonu</span><br /><input type="text" class="inp-box" name="econPhone" value="'.$sql_read['cphone'].'" /></div>
														<div class="form-group"><span class="label label-primary label-pos">Adres</span><br /><input type="text" class="inp-box" name="econAd" value="'.$sql_read['cad'].'" /></div>
														<div class="form-group"><span class="label label-primary label-pos">Miejscowość</span><br /><input type="text" class="inp-box" name="econCit" value="'.$sql_read['ccit'].'" /></div>
														<div class="form-group"><input type="hidden" name="econCid" value="'.$sql_read['cid'].'" /></div>
													

														');
														?>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
													<button type="submit" class="btn btn-success" id="buttonedsavcon" name="submit">Zapisz</button>
													</form>
												  </div>
												  
												</div>
											  </div>
											</div>
											<?php
											printf('<th><a href="?id=adrb&delCuid='.$sql_read['cid'].'"><span class="label label-danger label-pos">Usuń</span></a></th>
										</tr>
										');
										
										printf('');
										
									}
	printf('</table></div><br /><button type="submit" class="btn btn-danger">Usuń zaznaczone</button></form><br /><br /><br /></div>');
} else echo "Nie jesteś zalogowany";
?>

