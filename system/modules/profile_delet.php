<?php
/* 
	Appointment: Страница удалена
	File: profile_delet.php
	Author: vii zona 
	Engine: Vii Engine
	Copyright: vii zona (с) 2011
	e-mail: vii zona
	URL: http://viirips.ru/
	ICQ: viirips.ru
	Данный код защищен авторскими правами
*/
if(!defined('MOZG'))
	die("Hacking attempt!");

if($user_info['user_group'] != '1'){
	$tpl->load_template('profile_deleted.tpl');
	$tpl->compile('main');
	echo str_replace('{theme}', '/templates/'.$config['temp'], $tpl->result['main']);
	die();
}
?>