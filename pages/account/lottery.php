<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига 
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);





if (isset($_POST["m_operation_id"]) && isset($_POST["m_sign"]))
{
	$m_key = $config->secretWlot;
	$arHash = array($_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$m_key);
	
	$sign_hash = strtoupper(hash('sha256', implode(":", $arHash)));
	if ($_POST["m_sign"] == $sign_hash && $_POST['m_status'] == "success")
	{
		
	$db->Query("SELECT * FROM db_payeerlottery_insert WHERE id = '".intval($_POST['m_orderid'])."'");
	if($db->NumRows() == 0){ echo htmlspecialchars($_POST['m_orderid'])."|error"; exit;} 
	
	$payeer_row = $db->FetchArray();
	$usid = $payeer_row["user_id"];
	$amountmy = 10;
$amountin = number_format($_POST['m_amount'], 2, ".", "");

if( $amountmy != $amountin ){
echo $_POST['m_orderid']."|error";
exit;
}
	if($payeer_row["status"] > 0){ echo htmlspecialchars($_POST['m_orderid'])."|success"; exit;} 
	
	$db->Query("UPDATE db_payeerlottery_insert SET status = '1' WHERE id = '".intval($_POST['m_orderid'])."'");
	
	$ik_payment_amount = $payeer_row["sum"];
	
   $purse = $payeer_row["purse"];
   $uname = $payeer_row["user"];
 $num_bil=5;
   
   # Зачисляем баланс
$db->Query("INSERT INTO db_insertlot_money (user_id, user, money, date_add) VALUE ('$usid','$uname','$ik_payment_amount','".time()."')");
			
   $db->Query("INSERT INTO db_payeerlottery (user_id, user, purse, date_add) VALUE ('$usid','$uname','$purse','".time()."')");
			$lid = $db->LastInsert();
			
			if( $lid >= 5){
			$all_bank = 50;
				# Розыгрываем призы
			
				
					$winner_a = rand(1, $num_bil);
						
				
				
				# Пользователь 1
				# 1 место
				$money_a = $all_bank * 0.9;
				$db->Query("SELECT * FROM db_payeerlottery WHERE id = '$winner_a'");
				$userwin_a=$db->FetchArray();
				$user_a = $userwin_a["user"];
				$usid_a = $userwin_a["user_id"];
				$purse_a = $userwin_a["purse"];
				
				
				
				$db->Query("INSERT INTO db_payeerlottery_winners (user_a, bil_a,  bank, date_add, purse_a) 
				VALUES ('$user_a','$winner_a','$all_bank','".time()."','$purse_a')");
				$lidpayment = $db->LastInsert();
			
				### Делаем выплату 1###	
							$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
							if ($payeer->isAuth())
							{
								
								$arBalance = $payeer->getBalance();
								if($arBalance["auth_error"] == 0)
								{
									$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
									if( ($balance) >= ($money_a+0)){
								
									$arTransfer = $payeer->transfer(array(
									'curIn' => 'RUB', // счет списания
									'sum' => $money_a, // сумма получения
									'curOut' => 'RUB', // валюта получения
									'to' => $purse_a, // получатель (email)
									'comment' => iconv('windows-1251', 'utf-8', "Выплата пользователю {$user_a} с проекта ")
									
									));
									
										if (!empty($arTransfer["historyId"]))
										{	
										$ppid_a = $arTransfer["historyId"];
										# Вносим запись в список бонусов
			# Зачилсяем юзверю
			$db->Query("UPDATE db_payeerlottery_winners SET status_a ='3' WHERE id = '$lidpayment'");
			
			$db->Query("INSERT INTO db_lotpayment (user, user_id, sum, purse, payment_id, date_add) VALUES ('$user_a','$usid_a','$money_a','$purse_a','$ppid_a','".time()."')");
			
										}
									}
								}
							}
						
				
				
				# чистим таблицу
				$db->Query("TRUNCATE TABLE db_payeerlottery");
				
				
			}
			
   
	# Обновление статистики сайта
	$db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");
	
	echo htmlspecialchars($_POST['m_orderid'])."|success"; 
	exit;
	
	
	}
	echo htmlspecialchars($_POST['m_orderid'])."|error"; 
}
?>