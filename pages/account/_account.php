<?PHP
######################################
# ������ Fruit Farm
# ����� Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "�������";
$_OPTIMIZATION["description"] = "������� ������������";
$_OPTIMIZATION["keywords"] = "�������, ������ �������, ������������";

# ���������� ������
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		
		case "404": include("pages/_404.php"); break; // �������� ������
		case "statistics": include("pages/account/_statistics.php"); break; // ����������
		case "referrals": include("pages/account/_referrals.php"); break; // ��������
		case "farm": include("pages/account/_farm.php"); break; // ��� �����
		case "store": include("pages/account/_store.php"); break; // �����
		case "exchange": include("pages/account/_exchange.php"); break; // �������� �����
		case "market": include("pages/account/_market.php"); break; // �����
		case "withdrawals": include("pages/account/_withdrawals.php"); break; // ������� ������������
		case "qiwi_payment": include("pages/account/_qiwi_payment.php"); break; // 
		case "yandex_payment": include("pages/account/_yandex_payment.php"); break; // 
		case "payeer_payment": include("pages/account/_payeer_payment.php"); break; //
		case "refill": include("pages/account/_refill.php"); break; // ���������� �������
		case "insert_fk": include("pages/account/_insert_fk.php"); break; // ���������� �������
		case "insert_yandex": include("pages/account/_insert_yandex.php"); break; // ���������� �������
		case "insert_payeer": include("pages/account/_insert_payeer.php"); break; // ���������� �������
		case "settings": include("pages/account/_settings.php"); break; // ���������
		case "bonus": include("pages/account/_bonus.php"); break; // ���������� �����
		case "vip-bonus": include("pages/account/_vip-bonus.php"); break; // ���������� ����� ����
		case "chat": include("pages/account/_chat.php"); break; // ���������� �����
				
		case "output": @session_destroy(); Header("Location: /"); return; break; // �����
				
	# �������� ������
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/account/_user_account.php");

?>