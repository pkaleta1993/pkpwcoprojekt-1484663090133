<?php
/*
Plik, który odpowiada za zdefiniowanie sekcji "head".
*/
printf('<!DOCTYPE html>
<html>
<head>
<title>'.$title.'</title>
<link rel="Stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="Stylesheet" type="text/css" href="'.$bodystyle.'" />
<link rel="Stylesheet" type="text/css" href="'.$styleaccount.'" />
<link rel="Stylesheet" type="text/css" href="'.$bodystylebootstrap.'" />
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/kt.js"></script>
<script type="text/javascript" src="js/ls.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="pl" />
<link rel="icon" type="image/ico" href="'.$favicon.'" />

</head>');
?>