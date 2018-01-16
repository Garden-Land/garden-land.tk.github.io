<style>
.pollot {
font-size: 15pt;
font-family: 'PT Sans', sans-serif;
border: 1px solid #c1d0d1;
height: 35px;
width: 120px;
padding-left: 10px;
}
.ttb td {
background: #33A049;
color: #FFFFFF;
border: 1px solid #33A049;
}
.ltb {
background: #E1FFC4;
border-bottom: 1px solid #33A049;
}
.ltb td {
border: 1px solid #33A049;
}
</style>
<?PHP
$_OPTIMIZATION["title"] = "Лотерея";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# Настройки лотерея
$amount_lottery = 10; // Стоимость лотерейного билета
$num_bil = 5; // Количество билетов

?>
<div class="s-bk-lf">
	<div class="acc-title">Лотерея</div>
</div>
<div class="silver-bk">
<div class="clr"></div>	
<?PHP

# список предыдущих лотерей
if(isset($_GET["winners"])){ ?>

<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="6" align="center"><h4>Завершенные лотереи</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">№</td>
    <td align="center" class="m-tb">Пользователь<BR />[Билет]</td>
	
	<td align="center" class="m-tb">Банк</td>
	<td align="center" class="m-tb">Дата</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_payeerlottery_winners ORDER BY id DESC");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["id"]; ?></td>
			<td align="center"><?=$ref["user_a"]; ?><BR />Билет: <?=$ref["bil_a"]; ?></td>
			
			<td align="center"><?=$ref["bank"]; ?></td>
			<td align="center"><?=date("d.m.Y",$ref["date_add"]); ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="6">Нет записей</td></tr>'
  ?>

  
</table>

<div class="clr"></div></div>
<?PHP return; } ?>

<?PHP
	
	function ViewPurse($purse){
		
	if( substr($purse,0,1) != "P" ) return false;
if( !preg_match("/^[0-9]{7,8}$/", substr($purse,1)) ) return false;
return $purse;
}
	
	if(isset($_POST["purse"])){
		
		$purse = ViewPurse($_POST["purse"]);
		
		if($purse !== false){
		

	if(isset($_POST["set_paylottery"], $_POST["hash"]) AND $_SESSION["lotpay_hash"] == $_POST["hash"]){
	
	
	
$sum = 10;


# Заносим в БД
$db->Query("INSERT INTO db_payeerlottery_insert (user_id, user, purse, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$purse','$sum','".time()."')");

$desc = base64_encode($_SERVER["HTTP_HOST"]." - USER ".$_SESSION["user"]);
$m_shop = $config->shopIDlot;
$m_orderid = $db->LastInsert();
$m_amount = number_format($sum, 2, ".", "");
$m_curr = "RUB";
$m_desc = $desc;
$m_key = $config->secretWlot;

$arHash = array(
 $m_shop,
 $m_orderid,
 $m_amount,
 $m_curr,
 $m_desc,
 $m_key
);
$sign = strtoupper(hash('sha256', implode(":", $arHash)));

?>
<center>
<form method="GET" action="//payeer.com/merchant/">
	<input type="hidden" name="m_shop" value="<?=$config->shopIDlot; ?>">
	<input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
	<input type="hidden" name="m_amount" value="<?=number_format($sum, 2, ".", "")?>">
	<input type="hidden" name="m_curr" value="RUB">
	<input type="hidden" name="m_desc" value="<?=$desc; ?>">
	<input type="hidden" name="m_sign" value="<?=$sign; ?>">
	<input type="submit" name="m_process" value="Оплатить билет" class="blue-button"  />
</form>
</center>
<div class="clr"></div>		
</div>
<?PHP

return;
	}

		}else echo "<center><div class='error'>Неверный формат кошелька</div></center><BR />";
		
	}
?>
<div style="border: 4px dashed #33A049; padding: 20px 40px 20px 40px;">
<p><center>Вы лотерее вы можете попытать удачу и выиграть весь банк в размере 45 рублей (90% от банка). Всего имеется 5 билетов, после того как все билеты будут проданы система случайным образом выберет одного победителя и автоматически отправит банк лотереи на указанный вами кошелёк.</center> </p>
</div>
<br>
<center>
<?PHP
$_SESSION["lotpay_hash"] = rand(1, 9999999);
?>
<form action="" method="post">
<table width="220" border="0" align="center">
  <tbody>
  <tr>
    <td align="right">Кошелёк:</td>
    <td align="center"><input type="text"  name="purse" class="pollot" value="<?=$prof_data["purse"]; ?>"></td>
  </tr>
</tbody></table>
<br>
<input type="submit" name="set_paylottery" value="Купить билет" class="blue-button" style="padding:7px;" />
<input type="hidden" name="hash" value="<?=$_SESSION["lotpay_hash"]; ?>" />
</form>
</center>


<br>


<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b># билета</b></td>
	<td><b>E-mail</b></td>
	<td><b>Дата покупки</b></td>
</tr>
  <?PHP
  
 $db->Query("SELECT * FROM db_payeerlottery, db_users_a WHERE db_payeerlottery.user = db_users_a.user ORDER BY db_payeerlottery.id DESC LIMIT 20 ");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
<tr align="center" class="ltb">
		<td><?=$ref["user"]; ?></td>
		<td><?=$ref["id"]; ?></td>
		<td><?=str_replace(substr($ref["email"],2,3), '<font color="red">***</font>', $ref["email"]); ?></td>
		<td><?=date("d.m.Y H:i",$ref["date_add"]); ?></td>
	</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
  ?>
</tbody></table>
  
</table><div class="clr"></div>	


</div>