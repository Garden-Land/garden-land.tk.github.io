<?PHP
######################################
# ������ Fruit Farm
# ����� Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "���������������� ������";
$_OPTIMIZATION["description"] = "������� ������������";
$_OPTIMIZATION["keywords"] = "�������, ������ �������, ������������";
$not_counters = true;
# ���������� ������
if(!isset($_SESSION["admin"])){ include("pages/admin/_login.php"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		
		case "404": include("pages/_404.php"); break; // �������� ������
                case "config": include("pages/admin/_config.php"); break; // ���������� ����������
                case "users": include("pages/admin/_users.php"); break; // ���������� ����������
                case "invcompconfig": include("pages/admin/_invcompconfig.php"); break; // ���������� ����������
                case "compconfig": include("pages/admin/_compconfig.php"); break; // ���������� ����������
		case "stats": include("pages/admin/_stats.php"); break; // ����������
		case "config": include("pages/admin/_config.php"); break; // ���������
		case "contacts": include("pages/admin/_contacts.php"); break; // ��������
		case "rules": include("pages/admin/_rules.php"); break; // �������
		case "about": include("pages/admin/_about.php"); break; // � �����
		case "story_buy": include("pages/admin/_story_buy.php"); break; // ������� ������� ��������
		case "story_swap": include("pages/admin/_story_swap.php"); break; // ������� ������ � ���������
		case "story_insert": include("pages/admin/_story_insert.php"); break; // ������� ���������� �������
		case "story_sell": include("pages/admin/_story_sell.php"); break; // ������� �����
		case "news": include("pages/admin/_news_a.php"); break; // �������
		case "users": include("pages/admin/_users.php"); break; // ������ �������������
		case "sender": include("pages/admin/_sender.php"); break; // �������� �������������	
		case "payments": include("pages/admin/_payments.php"); break; // ������� �� ������� WM
			
	# �������� ������
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/admin/_stats.php");

?>