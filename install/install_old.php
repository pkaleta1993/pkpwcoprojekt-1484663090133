<?php
include("../dbconnect.php");

$sql1="create table if not exists user(
                            id int(11) NOT NULL auto_increment,
                            login varchar(50) NOT NULL,
                            password varchar (40) NOT NULL,                
							PRIMARY KEY (id))";
mysql_query($sql1) or die(mysql_error());
echo('Baza danych utworzona poprawnie')

?>