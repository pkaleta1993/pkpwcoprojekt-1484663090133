<?php
/*
Plik odpowiada za wyświetlenie górnego menu strony.
*/
@session_start(); //start sesji
printf('
<body text="'.$text.'" link="'.$text.'" vlink="'.$text.'">
<div class="menutop">
			<div id="top_l">
				<img src="images/logo.png">
			
			</div>
			<div id="top_l">
				
				Książka adresowa<br />
			
</div>');
?>
<script type="text/javascript">
$(document).ready(function(){
$("#add_err").css('display', 'none', 'important');
$("#password_l").click(function(){
$(this).css({'border-style' : 'none'});
});
$("#login_l").click(function(){
$(this).css({'border-style' : 'none'});
});
var input = $( "#login_l" );
input.val(localStorage.savLogin);
$("#button_l").click(function(){
  username=$("#login_l").val();
  password=$("#password_l").val();

$.ajax({
	type: "POST",
	url: "login.php",
	data: "login_l="+username+"&password_l="+password,
	success: function(html){ 
$("#button_l").html("Zaloguj");

if($.trim(html) == 'true')   {
localStorage.setItem("savLogin", username);
$("#add_err").html("Dane poprawne");
window.location="index.php";

} else if($.trim(html) == 'falserecpass')   {
alert('Proponujemy zmianę hasła. Zostaniesz przekierowany do zmiany hasła.');
window.location="index.php?id=recpass";
} else {
alert('Złe dane');
$("#add_err").css('display', 'inline', 'important');
$("#password_l").css({'border' : '2px solid #ff0000'});
$("#login_l").css({'border' : '2px solid #ff0000'});
}

},
  beforeSend:function()
   {
	   
$("#add_err").css('display', 'inline', 'important');
$("#button_l").html("<img src='images/ajax-loader.gif' /> Ładuję...")
  
   }
  });
return false;
});
});
</script>
<?php
if(isset($_POST["wyloguj"]))
{
	include "logout.php";
}
printf('<div id="top_r">');
if (isset($_SESSION['login'])) # Jeżeli login sesyjny nie jest pusty, to wyświetl informacje o użytkowniku(login).
{
printf('
<form  action="" method="post">
<font>Login: '.$_SESSION['login'].'<br /></font><input type="submit" class="btn btn-primary" name="wyloguj" value="Wyloguj" /></form></div>');
} else # W przeciwnym wypadku wyswietl okno logowania.
{

printf('

<form  action="./" method="post" id="form_l">
	<input type="text" name="login_l" id="login_l"  placeholder="Login" />
	<br />
	<input type="password" name="password_l" id="password_l" placeholder="Password" />
	<br />
	<button type="submit" class="btn btn-primary buttonfw" id="button_l"  name="button_l" value="Zaloguj">Zaloguj</button><br />
	<font>lub<a href="?id=recpass"> Przypomij hasło </a> lub </font>
	
</form>
<a href="?id=reg"><input type="submit" class="btn btn-success buttonw" id="button" name="submit" value="Zarejestruj" /></a>
</div>

');
}# Dołącz plik "login.php"
?>