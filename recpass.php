<?php
if(!isset($_GET['loginToPassRec']))
{
?>
<div  class="small-boxinp">
<form action="" method="get"  id="rec_pass">
<h2>Twój login</h2>
<br />
<br />
<div class="form-group"><span class="label label-primary label-pos">Twój login: </span><br /><input type="text" class="sinp-box" name="loginToPassRec" /></div>
<div class="form-group"><input type="hidden" name="id" value="recpass"></div>
<br />
<div style=""><input type="submit" class="btn btn-primary"  value="Submit" /></div>
</form>

</div>

<?php	
	
} else {
$user_login = $_GET['loginToPassRec'];
$temp_lpassrec_user=mysql_query("SELECT * FROM $dbre.users WHERE login =\"$user_login\"") or die("Wystapil blad".mysql_error());
$lpassrec = mysql_fetch_assoc($temp_lpassrec_user);	
if(isset($_POST['asw']))
{
	if($_POST['asw'] == $lpassrec['asw'])
	{
		$newpass = randomPass();
		echo "Nowe hasło: ";
		echo $newpass;
		$newpass = md5($newpass);
		mysql_query("UPDATE $dbre.users SET `password` = \"$newpass\" WHERE login=\"$user_login\"");
		
	} else {
		printf('Zła odpowiedź. <a href="?id=recpass">Powrót</a>');
	}
} else {


?>
<div  class="small-boxinp">

<h2>Odpowiedz na pytanie:</h2>
<br />
<br />
<div class="form-group"><span class="label label-primary label-pos">Pytanie pomocnicze: </span><br /><div id="qst_h"></div></div>
<form action="" method="post"  id="rec_pass">
<div class="form-group"><span class="label label-primary label-pos">Odpowiedź: </span><br /><input type="text" class="sinp-box" name="asw" /></div>
<br />
<div style=""><input type="submit" class="btn btn-primary" value="Submit" /></div>
</form>
</div>
<script type="text/javascript">
$(function() {
$("#qst_h").append("<?php echo $lpassrec['qst']; ?>");
});
</script>
<?php
}
}
?>
