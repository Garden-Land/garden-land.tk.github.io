<?PHP
######################################
# Модуль YandexMoney Скрипт Fruit Farm
# Автор APTEMOH
# E-mail: ArtIncProject@yandex.ru
# Skype: ArtIncProject
######################################

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

# Серкретный ключ
$secret_key = 'xRLAYKaC08mrWqPgKxdf9k0n';


$wallet = $_POST['sender'];

$ik_payment_amount = $_POST['amount'];

$operation_id = $_POST['operation_id'];

$secret_hashy = $_POST['notification_type'];

$id_insert = $_POST['label'];

// возможно некоторые из нижеперечисленных параметров вам пригодятся
// $_POST['operation_id'] - номер операция
// $_POST['amount'] - количество денег, которые поступят на счет получателя
// $_POST['withdraw_amount'] - количество денег, которые будут списаны со счета покупателя
// $_POST['datetime'] - тут понятно, дата и время оплаты
// $_POST['sender'] - если оплата производится через Яндекс Деньги, то этот параметр содержит номер кошелька покупателя
// $_POST['label'] - лейбл, который мы указывали в форме оплаты
// $_POST['email'] - email покупателя (доступен только при использовании https://)

$sha1 = sha1( $_POST['notification_type'] . '&'. $_POST['operation_id']. '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&'. $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key. '&' . $_POST['label'] );

if ($sha1 != $_POST['sha1_hash'] ) {
	// тут содержится код на случай, если верификация не пройдена
	exit();
}

	// тут код на случай, если проверка прошла успешно
	//exit();

	$db->Query("SELECT * FROM `db_payeer_insert` WHERE id = '".intval($_POST['label'])."'");
	if($db->NumRows() == 0){ echo $_POST['label']."|error"; exit;}

	$payeer_row = $db->FetchArray();

	if($payeer_row["status"] > 0){ echo $_POST['label']."|success"; exit;}

	$db->Query("UPDATE db_payeer_insert SET status = '1' WHERE id = '".intval($_POST['label'])."'");

	$ik_payment_amount = $_POST['amount']; #$payeer_row["sum"];
	$user_id = $payeer_row["user_id"];


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

	# Обновление статистики сайта
	$db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");

?>