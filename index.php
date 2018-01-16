<?PHP

# �������
function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}

$_timer_a = TimerSet();

# ����� ������
@session_start();

# ����� ������
@ob_start();

# Default
$_OPTIMIZATION = array();
$_OPTIMIZATION["title"] = "���� � ������� �������!";
$_OPTIMIZATION["description"] = "����� � �����������!";
$_OPTIMIZATION["keywords"] = "��������� ������, ������ � ���������, garden-land, ������-����, ���� � ������� �����, ���������� � ����";

# ��������� ��� Include
define("CONST_RUFUS", true);

# ������������� �������
function __autoload($name){ include("classes/_class.".$name.".php");}

# ����� ������� 
$config = new config;

# �������
$func = new func;

# ��������� REFERER
include("inc/_set_referer.php");

# ���� ������
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

# �����
@include("inc/_header.php");

		if(isset($_GET["menu"])){
		
			$menu = strval($_GET["menu"]);
			
			switch($menu){
			
				case "404": include("pages/_404.php"); break; // �������� ������
				case "rules": include("pages/_rules.php"); break; // ������� �������
				case "about": include("pages/_about.php"); break; // � �������
				case "faq": include("pages/_faq.php"); break; // � �������
				case "contacts": include("pages/_contacts.php"); break; // ��������
				case "news": include("pages/_news.php"); break; // �������
				case "signup": include("pages/_signup.php"); break; // �����������
				case "recovery": include("pages/_recovery.php"); break; // �������������� ������
				case "authorization": include("pages/_authorization.php"); break;
				case "account": include("pages/_account.php"); break; // �������
                                case "invcompetition": include("pages/_invcompetition.php"); break; // ��������
				case "users": include("pages/_users_list.php"); break; // ������������
				case "stat": include("pages/_stat.php"); break; // ����������
                                case "online": include("pages/_online.php"); break; // ��� ������
                                case "competition-referrals": include("pages/_competition-referrals.php"); break; // ������� ���������
				
				case "gardener": include("pages/_admin.php"); break; // �������
				
			# �������� ������
			default: @include("pages/_404.php"); break;
			
			}
			
		}else @include("pages/_index.php");


# ������
@include("inc/_footer.php");


# ������� ������� � ����������
$content = ob_get_contents();

# ������� �����
ob_end_clean();
	
	# �������� ������
	$content = str_replace("{!TITLE!}",$_OPTIMIZATION["title"],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION["description"],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION["keywords"],$content);
	$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", (TimerSet() - $_timer_a)) ,$content);
	
	# ����� �������
	if(isset($_SESSION["user_id"])){
	
		$user_id = $_SESSION["user_id"];
		$db->Query("SELECT money_b, money_p FROM db_users_b WHERE id = '$user_id'");
		$balance = $db->FetchArray();
		
		$content = str_replace('{!BALANCE_B!}', sprintf("%.2f", $balance["money_b"]) ,$content);
		$content = str_replace('{!BALANCE_P!}', sprintf("%.2f", $balance["money_p"]) ,$content);
	}
	
// ������� �������
echo $content;
?>