
<div  class="small-boxinp">
<form action="" method="post"  id="register-form" data-toggle="validator">
<h2>Wyślij zgłoszenie:</h2>
<br />
<br />
<div class="form-group"><span class="label label-primary label-pos">Twój mail: </span><br /><input type="text" class="sinp-box" name="mail" placeholder="przykladowymail@przykladowadomena.pl" /></div>
<div class="form-group"><span class="label label-primary label-pos">Temat wiadomości: </span><br /><input type="text" class="sinp-box" name="t" placeholder="Przykladowy temat" /></div>
<div class="form-group"><span class="label label-primary label-pos">Treść wiadomości: </span><br /><textarea class="sinp-box" name="msg" placeholder="Przykladowa tresc" ></textarea></div>
<br />
<div style=""><input type="submit" class="btn btn-primary" name="submit" value="Submit" /></div>
</form>


<?php

if(isset($_POST['mail'])  and isset($_POST['t']) and isset($_POST['msg']))
{
$t = $_POST['t'];
$msg =$_POST['msg'];
$mail =$_POST['mail'];
if (mail('pkaleta1993@gmail.com', $t, $msg.'Mail nadawcy: '.$mail))
{
printf("mail został wysłany");
}
else
{
printf("mail  NIE został wysłany");
}
}
?>
</div>