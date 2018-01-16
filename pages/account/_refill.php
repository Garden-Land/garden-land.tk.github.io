<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer3">
<h3>
<center>Покупка Кристаллов</center>
</h3>

<?PHP
$_OPTIMIZATION["title"] = "Пополнить баланс";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>Технические работы</font></b></center>";
return;
}
*/
?>

<center>
<h5>Во время предстарта проекта пополнения недоступны</h5>
<a href="/insert"><img src="/img/fk.png"></a>
<a href="/insert"><img src="/img/yandex.png"></a>
<a href="/insert"><img src="/img/payeer.png"></a>
</center>


</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>