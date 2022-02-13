<?php
// Връзка с ДБ
 $connection = mysql_connect("localhost","root","") or die("Не валидини настройки на: Сървър, потребител или парола !"); // Сървар, потребител, парола
 mysql_select_db("urocheta", $connection) or die("Не валидини настройки на: Базата данни !"); // БД
 mysql_query("SET NAMES UTF8"); // оправя енкодинга
// Край на връзката с ДБ

$SITE_TITLE = "М-Урочета * За всеки по нещо :)"; // заглавие на сайта 
$SITE_DESC = "Описание на сайта !"; // описание на сайта.. 
$SITE_KEYS = "ключови ,думи, на, сайта ,... !"; // ключови думи на сайта.. ( със запетайка (,))
$SITE_EMAIL = "Твоя имейл"; // Имейла на който хората ще отговарят ако сайта им прати имейл ! (Трябва да е валиден)



/// Изчистване на старите гласове, на който им е изтекло времето
 $time = time()+3600;
 $dd = "`vote_ips` WHERE `timestamp` < $time";
 $count = mysql_num_rows(mysql_query("SELECT `id` FROM ".$dd));
 if( $count >= 1)
 {
	 mysql_query("DELETE FROM ".$dd);
 }
 