<?PHP
# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига 
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);



$fk_merchant_id = '30246'; //merchant_id ID мазагина в free-kassa.ru (https://free-kassa.ru/merchant/cabinet/help/)
$fk_merchant_key = 'k6kfn7b9'; //Секретное слово https://free-kassa.ru/merchant/cabinet/profile/tech.php
$fk_merchant_key2 = 'ugjmunmi'; //Секретное слово2 (result) https://free-kassa.ru/merchant/cabinet/profile/tech.php

$ik_payment_amount = round(floatval($_POST['AMOUNT']),2);
$user_id = $_POST['us_id'];
	
$hash = md5($fk_merchant_id.":".$_POST['AMOUNT'].":".$fk_merchant_key2.":".$_POST['MERCHANT_ORDER_ID']);

if ($hash != $_POST['SIGN']) die("SumError");
    
   
   	# Настройки
	$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
	$sonfig_site = $db->FetchArray();
   
   $db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
   $user_ardata = $db->FetchArray();
   $user_name = $user_ardata["user"];
   $refid = $user_ardata["referer_id"];
   
   # Зачисляем баланс
   $serebro = sprintf("%.4f", floatval($sonfig_site["ser_per_wmr"] * $ik_payment_amount) );
   
   $db->Query("SELECT insert_sum FROM db_users_b WHERE id = '{$user_id}' LIMIT 1");
   $ins_sum = $db->FetchRow();
   
   $serebro = intval($ins_sum <= 0.01) ? ($serebro + ($serebro * 0.2) ) : $serebro;
   $lsb = time();
   $to_referer = ($serebro * 0.10);
   
   $db->Query("UPDATE db_users_b SET money_b = money_b + '$serebro', e_t = e_t + '$add_tree', to_referer = to_referer + '$to_referer', last_sbor = '$lsb', insert_sum = insert_sum + '$ik_payment_amount' WHERE id = '{$user_id}'");
   


   # Зачисляем средства рефереру и дерево
  
   $db->Query("UPDATE db_users_b SET money_p = money_p + $to_referer, from_referals = from_referals + '$to_referer'  WHERE id = '$refid'");
   
   # Статистика пополнений
   $da = time();
   $dd = $da + 60*60*24*15;
   $db->Query("INSERT INTO db_insert_money (user, user_id, money, serebro, date_add, date_del) 
   VALUES ('$user_name','$user_id','$ik_payment_amount','$serebro','$da','$dd')");
   
   
   $db->Query("SELECT * FROM db_invcompetition_users WHERE user_id = '{$user_id}'");
$in = $db->FetchArray();

		
$a=$in["user_id"];
if($a > 0)
{
$usname = $user_name;
}
else
{
$usname = $user_name;
$db->Query("INSERT INTO db_invcompetition_users (user, user_id, points) VALUES ('$usname','$user_id','0')");
}

$db->Query("SELECT * FROM db_invcompetition WHERE status = '0' LIMIT 1");
$invcomp = $db->FetchArray();

$db->Query("SELECT COUNT(*) FROM db_invcompetition_users WHERE user_id = '{$user_id}'");
$rett = $db->FetchArray();

if ($invcomp["date_add"] >= 0 AND $invcomp["date_end"] > $da)
{
$db->Query("UPDATE db_invcompetition_users SET points = points + '$ik_payment_amount' WHERE user_id = '$user_id'");
}
else
{
$db->Query("UPDATE db_invcompetition_users SET points = points + '0' WHERE user_id = '$user_id'");
}

 








   # Конкурс
   $competition = new competition($db);
   $competition->UpdatePoints($user_id, $ik_payment_amount);
   #--------  
   # Обновление статистики сайта
   $db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");


?>