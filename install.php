<!--
	Appointment: �����������
	File: install.php
	Author: vii zona 
	Engine: Vii Engine
	Copyright: vii zona (�) 2011
	e-mail: vii zona
	URL: http://viirips.ru/
	ICQ: viirips.ru
	������ ��� ������� ���������� �������
-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru"><head>
<title>Vii Engine - ������ ����������</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<link media="screen" href="/install/style.css" type="text/css" rel="stylesheet">
<div class="box clr">
<div class="head"><a href="install.php"><div class="logo"></div></a></div>
<?

if(file_exists('system/data/config.php')) {
  echo '��������� ������������� ������ /system/data/config.php. ������� ���� ���� � ���������� �����.';
} else {
//�������� �� ������� ����� ������������ (���� ������ �� ������ ������������)

$page=$_GET["page"] ? (int)$_GET["page"] : "1";
//����������� ��� ����������� �������� ��������� $page
switch($page)
  { 
  
  case "1": 
  $str.="
<div class='message unspecified'>
    <div class=\"h1\" style=\"margin-top:10px\">��������� ����������</div>
    <strong>Apache:</strong>  2.0 ��� ����<br />
    <strong>PHP:</strong>  5.0 ��� ����<br />
    <strong>MySQL:</strong>  5.0 ��� ����<br />
    <strong>Zlib:</strong>  �����������<br />
    <strong>XML:</strong>  �����������<br />
    <strong>GD2:</strong>  �����������<br />
    <strong>iconv:</strong>  �����������<br />
    ����������� ������ ����������� ������ 8 ��������, ������������� ������ ����������� ������ 16 ��������. 
����� �������������, ����� ��� �������� ���������� ����� PHP <strong>(Safe Mode)</strong>.
    </div>";
  $str.="<br><br><form action='?page=2' method='post' ><center><input type='submit' name='bsubmit' value='�����' class=\"inp\" /></center></form>";
  echo $str;
  break; 
  
    case "2": 
	$vii zona=fopen("install/license.txt","r");
$license=fread($vii zona,40000);
fclose($vii zona);
  $str.="
<div class='message unspecified'>
    <div class=\"h1\" style=\"margin-top:10px\">���������������� ����������</div>
<textarea class=\"inpu\" style=\"margin: 0px 0px 5px; height: 466px; width: 597px;\"> $license
</textarea>
<div class=\"fllogall\">������� ��� ������������ ����:</div> <input type=\"text\" name=\"licensekey\" style=\"width: 315px;\" class=\"inpu\" value=\"Vii Zona\" disabled>
<div class=\"mgcler\"></div>
    </div>";
  $str.="<br><form action='?page=3' method='post' ><center><input type='submit' name='bsubmit' value='��������' class=\"inp\" /></center></form>";
  echo $str;
  break; 

  case "3":
  $str.="<div class=\"h1\" style=\"margin-top:10px\">��������� ���� ������</div>";
$str.="
<form action='?page=4' method='post' >
<div class=\"fllogall\">���� ���� ������:</div> <input type=\"text\" name=\"hostdb\" class=\"inpu\" value=\"localhost\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">��� ���� ������:</div> <input type=\"text\" name=\"namedb\" class=\"inpu\" value=\"\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">������������ ���� ������:</div> <input type=\"text\" name=\"userdb\" class=\"inpu\" value=\"root\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">������ ���� ������:</div> <input type=\"password\" name=\"passdb\" class=\"inpu\" value=\"\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">���������:</div> <input type=\"text\" name=\"COLLATE\" class=\"inpu\" value=\"utf8\" readonly>
<div class=\"mgcler\"></div>
<div class=\"fllogall\">������� ���� ������:</div> <input type=\"text\" name=\"PREFIX\" class=\"inpu\" value=\"vii\" readonly>
<div class=\"mgcler\"></div>";

  $str.="<br><center><input type='submit' name='bsubmit' value='�����' class=\"inp\" /></center></form>";
  echo $str;
  break;

  case "4":
$fp = fopen ("system/data/db.php","w");
fputs($fp,"<?php\n\n");  
fputs($fp,'define ("DBHOST", "'.$_POST['hostdb']."\");\n\n");
fputs($fp,'define ("DBNAME", "'.$_POST['namedb']."\");\n\n");
fputs($fp,'define ("DBUSER", "'.$_POST['userdb']."\");\n\n");
fputs($fp,'define ("DBPASS", "'.$_POST['passdb']."\");\n\n");
fputs($fp,'define ("PREFIX", "'.$_POST['PREFIX']."\");\n\n");
fputs($fp,'define ("COLLATE", "'.$_POST['COLLATE']."\");\n\n");
fputs($fp,'$db = new db; '.$_POST['DB']."\n");
fputs($fp,"?>\n");  
fclose($fp);
 $db = mysql_connect($_POST['hostdb'],$_POST['userdb'],$_POST['passdb']) or die ("�");
 mysql_select_db($_POST['namedb'],$db)or die ("could not connect");

 $sqlfile = 'install/install.sql';
 if (!file_exists($sqlfile));
 $open_file = fopen ($sqlfile, "r");
 $buf = fread($open_file, filesize($sqlfile));
 fclose ($open_file);

$a = 0;

while ($b = strpos($buf,";",$a+1)){
 $i++;
 $a = substr($buf,$a+1,$b-$a);
 mysql_query($a);
 $a = $b;
 }

echo "<div class=\"h1\" style=\"margin-top:10px\">����������</div>";
echo "<strong>Vii Engine 2.0 ������� ��������� � ����. ������� ��������� " .$i; echo " �������.</strong>";


  $str.="<br/><br/>";
   $str.="<form action='?page=5' method='post' ><center><input type='submit' name='bsubmit' value='�����' /></center></form><br/>";
  echo $str;
  break;

      case "5": 
  $str.="
<div class='message unspecified'>
    <div class=\"h1\" style=\"margin-top:10px\">��������������</div>
	<strong>����������� ������ �������������� � ��������� �����.</strong>
<form action='?page=6' method='post' >
<div class=\"fllogall\">���:</div> <input type=\"text\" name=\"admname\" class=\"inpu\" value=\"�������������\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">�������:</div> <input type=\"text\" name=\"admlname\" class=\"inpu\" value=\"�����\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">E-mail:</div> <input type=\"text\" name=\"admmail\" class=\"inpu\" value=\"admin@mail.ru\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">������:</div> <input type=\"text\" name=\"admpass\" class=\"inpu\" value=\"AhG2E4FD\">
<div class=\"mgcler\"></div></div>";

  $str.="<br><center><input type='submit' name='bsubmit' value='�����' class=\"inp\" /></center></form>
    </div>";
	echo $str;
  break; 
  
 case "6": 
  $str.="
<div class='message unspecified'>
    <div class=\"h1\" style=\"margin-top:10px\">��������� �����</div>
    <form action='?page=7' method='post' >
<div class=\"fllogall\">�������� �����:</div> <input type=\"text\" name=\"sitename\" class=\"inpu\" value=\"Vii Engine - ���������� ����\">
<div class=\"mgcler\"></div>
<div class=\"fllogall\">����� �����:</div> <input type=\"text\" name=\"siteurl\" class=\"inpu\" value=\"http://site.com/\">
<div class=\"mgcler\"></div>";

  $str.="<br><center><input type='submit' name='bsubmit' value='�����' class=\"inp\" /></center></form>
    </div>";
  echo $str;
  break; 

  case "7": 
$fp = fopen ("system/data/config.php","w");
fputs($fp,"<?php\n\n");  
fputs($fp,'//System Configurations '.$_POST['DB']."\n\n");
fputs($fp,'$config = array ( '.$_POST['DB']."\n\n");
fwrite($fp, "'home' => \"".$_POST['sitename']."\", \n\n");
fwrite($fp, "'charset' => \"utf-8\", \n\n");
fwrite($fp, "'home_url' => \"".$_POST['siteurl']."\", \n\n");
fwrite($fp, "'temp' => \"Default\", \n\n");
fwrite($fp, "'online_time' => \"150\", \n\n");
fwrite($fp, "'lang' => \"Russian\", \n\n");
fwrite($fp, "'gzip' => \"no\", \n\n");
fwrite($fp, "'gzip_js' => \"no\", \n\n");
fwrite($fp, "'offline' => \"no\", \n\n");
fwrite($fp, "'offline_msg' => \"���� ��������� �� ������� �������������, ����� ���������� ���� ����� ���� ����� ������. 
�������� ��� ���� ��������� �� ������������ ����������.\", \n\n");
fwrite($fp, "'lang_list' => \"������� | Russian\", \n\n");
fwrite($fp, "'bonus_rate' => \"\", \n\n");
fwrite($fp, "'cost_balance' => \"10\", \n\n");
fwrite($fp, "'video_mod' => \"yes\", \n\n");
fwrite($fp, "'video_mod_comm' => \"yes\", \n\n");
fwrite($fp, "'video_mod_add' => \"yes\", \n\n");
fwrite($fp, "'video_mod_add_my' => \"yes\", \n\n");
fwrite($fp, "'video_mod_search' => \"yes\", \n\n");
fwrite($fp, "'audio_mod' => \"yes\", \n\n");
fwrite($fp, "'audio_mod_add' => \"yes\", \n\n");
fwrite($fp, "'audio_mod_search' => \"yes\", \n\n");
fwrite($fp, "'album_mod' => \"yes\", \n\n");
fwrite($fp, "'max_albums' => \"20\", \n\n");
fwrite($fp, "'max_album_photos' => \"500\", \n\n");
fwrite($fp, "'max_photo_size' => \"5000\", \n\n");
fwrite($fp, "'photo_format' => \"jpg, jpeg, jpe, png, gif\", \n\n");
fwrite($fp, "'albums_drag' => \"yes\", \n\n");
fwrite($fp, "'photos_drag' => \"yes\", \n\n");
fwrite($fp, "'rate_price' => \"1\", \n\n");
fwrite($fp, "'admin_mail' => \"admin@site.com\", \n\n");
fwrite($fp, "'mail_metod' => \"php\", \n\n");
fwrite($fp, "'smtp_host' => \"localhost\", \n\n");
fwrite($fp, "'smtp_port' => \"25\", \n\n");
fwrite($fp, "'smtp_user' => \"\", \n\n");
fwrite($fp, "'smtp_pass' => \"\", \n\n");
fwrite($fp, "'news_mail_1' => \"no\", \n\n");
fwrite($fp, "'news_mail_2' => \"no\", \n\n");
fwrite($fp, "'news_mail_3' => \"no\", \n\n");
fwrite($fp, "'news_mail_4' => \"no\", \n\n");
fwrite($fp, "'news_mail_5' => \"no\", \n\n");
fwrite($fp, "'news_mail_6' => \"no\", \n\n");
fwrite($fp, "'news_mail_7' => \"no\", \n\n");
fwrite($fp, "'news_mail_8' => \"no\", \n\n");
fwrite($fp, "'code_word' => \"code_word\", \n\n");
fwrite($fp, "'sms_number' => \"123456\", \n\n");
fwrite($fp, "); \n\n");
fputs($fp,"?>\n");  
fclose($fp);
  echo "<div class=\"h1\" style=\"margin-top:10px\">��������� ���������</div>";
  echo "<strong>Vii Engine 2.0 ������� ����������. <b style=\"color:red;\">������� install.php � ����� install</b>.";
  echo "<br><form action='/controlpanel.php' method='post' ><center><input type='submit' name='bsubmit' value='������ ����������' class=\"inp\" /></center></form>";
  break; 
  
  }

}

?> 
</div>
</div>
</body>
</html>