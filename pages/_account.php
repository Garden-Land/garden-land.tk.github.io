<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Аккаунт";
$_OPTIMIZATION["description"] = "Аккаунт пользователя";
$_OPTIMIZATION["keywords"] = "Аккаунт, личный кабинет, пользователь";

# Блокировка сессии
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		
		case "404": include("pages/_404.php"); break; // Страница ошибки
		case "statistics": include("pages/account/_statistics.php"); break; // Статистика
		case "referrals": include("pages/account/_referrals.php"); break; // Рефералы
		case "farm": include("pages/account/_farm.php"); break; // Моя ферма
		case "store": include("pages/account/_store.php"); break; // Склад
		case "exchange": include("pages/account/_exchange.php"); break; // Обменный пункт
		case "market": include("pages/account/_market.php"); break; // Рынок
		case "withdrawals": include("pages/account/_withdrawals.php"); break; // Выплата пользователю
		case "qiwi_payment": include("pages/account/_qiwi_payment.php"); break; // 
		case "yandex_payment": include("pages/account/_yandex_payment.php"); break; // 
		case "payeer_payment": include("pages/account/_payeer_payment.php"); break; //
		case "refill": include("pages/account/_refill.php"); break; // Пополнение баланса
		case "insert_fk": include("pages/account/_insert_fk.php"); break; // Пополнение баланса
		case "insert_yandex": include("pages/account/_insert_yandex.php"); break; // Пополнение баланса
		case "insert_payeer": include("pages/account/_insert_payeer.php"); break; // Пополнение баланса
		case "settings": include("pages/account/_settings.php"); break; // Настройки
		case "bonus": include("pages/account/_bonus.php"); break; // Ежедневный бонус
		case "vip-bonus": include("pages/account/_vip-bonus.php"); break; // Ежедневный бонус паер
		case "chat": include("pages/account/_chat.php"); break; // Ежедневный бонус
				
		case "output": @session_destroy(); Header("Location: /"); return; break; // Выход
				
	# Страница ошибки
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/account/_user_account.php");

?>