<?php
/* 
	Appointment: Вывод формы регистрации на главной
	File: register_main.php 
	Author: vii zona 
	Engine: Vii Engine
	Copyright: vii zona (с) 2011
	e-mail: vii zona
	URL: http://viirips.ru/
	ICQ: viirips.ru
	Данный код защищен авторскими правами
*/
if(!defined('MOZG'))
	die('Hacking attempt!');

$tpl->load_template('reg.tpl');

//################## Загружаем Страны ##################//
$sql_country = $db->super_query("SELECT * FROM `".PREFIX."_country` ORDER by `name` ASC", true, "country", true);
foreach($sql_country as $row_country)
	$all_country .= '<option value="'.$row_country['id'].'">'.stripslashes($row_country['name']).'</option>';
			
$tpl->set('{country}', $all_country);

$tpl->compile('content');
?>