<?php
printf('
<div id="tresc">');
include "login.php";

if((empty($_GET['id'])))
{
$_GET['id'] = "home";
}
$id=$_GET['id'];

if(isset($_SESSION['login']))
	{
		
		if($_SESSION['privileges'] == 1)
			{
				if($id == "home")
				{				
				include "informations.php";
				} else if($id == "configuration")
				{				
				include "configuration.php";
				} else if($id == "users")
				{				
				include "users.php";
				} else if($id == "news")
				{				
				include "news.php";
				} else if($id == "newscat")
				{
					include "cat.php";
				}
			} else echo "Nie posiadasz uprawnień administratora";
	}
printf('</div>');
?>