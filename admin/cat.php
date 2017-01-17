<?php
printf('<div class="tab">
<a href="?id=news">Lista newsów</a>
<a href="?id=newscat">Kategorie</a>

</div><br />');
if(isset($_GET['option']) and (isset($_GET['id_cat'])) and ($_GET['option'] == "del_cat"))
{
	$del_id = $_GET['id_cat'];
	$cat_del_sql = mysql_query("DELETE FROM $dbre.cat WHERE id_cat = $del_id");  
	$cat_del_news_set = mysql_query("UPDATE $dbre.`news` SET `cat_id` = 0 WHERE `cat_id` = $del_id"); 
} else if(isset($_GET['option']) and (isset($_GET['id_cat'])) and ($_GET['option'] == "del_catandnews"))
{
	$del_id = $_GET['id_cat'];
	$cat_del_sql = mysql_query("DELETE FROM $dbre.cat WHERE id_cat = $del_id");  
	$cat_del_news_set = mysql_query("DELETE FROM $dbre.news WHERE cat_id = $del_id"); 
} else if(isset($_POST['cat_name']))
{
$cat_name = $_POST['cat_name'];
$add_cat ="INSERT INTO $dbre.cat(cat_name) VALUES(\"$cat_name\")";
mysql_query($add_cat);
}
$cat_sql = mysql_query("SELECT * FROM $dbre.cat");
printf('<table style="height:auto;"><tr><td>Kategoria</td><td>Edycja</td><td>Usuń</td><td>Usuń wszystkie</td></tr>');
while($cat_sql && $cat_list = mysql_fetch_assoc($cat_sql)) 
								{
									printf('<tr style="margin-top: 115px;"><td>'.$cat_list['cat_name'].'</td>');
									if($cat_list['id_cat'] == 0)
									{
										printf('<td></td><td></td><td></td></tr>');
									} else {
										printf('<td><a href="?id=newscat&option=edit_cat&id_cat='.$cat_list['id_cat'].'">Edytuj</a></td>
										<td><a href="?id=newscat&option=del_cat&id_cat='.$cat_list['id_cat'].'">Usuń kategorię</a></td>
										<td><a href="?id=newscat&option=del_catandnews&id_cat='.$cat_list['id_cat'].'">Usuń kategorię i posty</a></td></tr>');
								
									}
								}
printf('</table><br /><br />
<form action="" method="post">
<div class="form-group"><span class="label label-primary label-pos">Nazwa</span><br />
<input type="text" name="cat_name" /></div>
<input type="submit" class="btn btn-primary btn-sm" style="margin-top: 8px;"  name="submit" value="Dodaj" /></form>');								
?>