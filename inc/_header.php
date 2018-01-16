
<?PHP
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<html>
	<head>
                <link rel="icon" type="image/png" href="favicon.png" />
		<title>Garden-Land.net - {!TITLE!}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
		<meta name="description" content="{!DESCRIPTION!}">
		<meta name="keywords" content="{!KEYWORDS!}">
		<link href="/style/style.css" rel="stylesheet" type="text/css" /
                <link rel='stylesheet' href='/style/styletable.css' type='text/css' />
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/functions.js"></script>
		<script type="text/javascript" src="/js/modernizr.custom.79639.js"></script> 
		<link rel="stylesheet" type="text/css" href="/style/common.css" />
        <link rel="stylesheet" type="text/css" href="/style/style.css" />
		<link href='https://fonts.googleapis.com/css?family=Andika&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
	<?
	$dadd=time()-60*60*24*14;
	$db->Query("DELETE FROM tb_posetitel WHERE  datein < '$dadd'");
 $ip = $func->UserIP;

$ip2 = ip2long($ip);
$db->Query("SELECT * FROM tb_posetitel WHERE ip = '$ip2' limit 1");
if($db->NumRows() == 0){
if(isset($_GET["i"])){
$_rid = (intval($_GET["i"]) > 0) ? intval($_GET["i"]) : 1; 

$polzovatel_id = $_rid;
} else{ $polzovatel_id = 1;}
	$db->Query("SELECT user FROM db_users_a WHERE id = '$polzovatel_id' LIMIT 1");
							
							if($db->NumRows() > 0){
							
								$polzovatel_name = $db->FetchRow();
							
							}else{ $polzovatel_id = 1; $polzovatel_name = "First"; }
						
						

$http_ref=$func->Userparse();  
if(strlen($http_ref) >= 3){
if($http_ref!=="timemoney.org" ){
$db->Query("INSERT INTO tb_posetitel (sitein, referer, referer_id, datein, ip) 
				VALUES ('$http_ref','$polzovatel_name','$polzovatel_id','".time()."','$ip2')");
				$db->Query("UPDATE db_users_b SET posetitel = posetitel + 1 WHERE id = '$polzovatel_id'");
			$db->Query("SELECT * FROM tb_posetitel_list WHERE referer_id = '$polzovatel_id' and sitein='$http_ref' limit 1");	
	if($db->NumRows() == 0){
	$db->Query("INSERT INTO tb_posetitel_list (sitein, referer, referer_id) 
				VALUES ('$http_ref','$polzovatel_name','$polzovatel_id')");
	} else {
	$db->Query("UPDATE tb_posetitel_list SET vsego = vsego + 1 WHERE  referer_id = '$polzovatel_id' and sitein='$http_ref'");
			
	}
			
	}			
    }
     }
		
     
		
	
	?>
	</head>
	<body>
	<div class="all">
<?PHP include("inc/_navigation.php"); ?>
<div class="clr"></div>


