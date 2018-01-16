
<?PHP


$wallet_yad = 410014046737723;

$_OPTIMIZATION["title"] = "Пополненить баланс";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();


?>

<?PHP include("inc/_user-menu.php"); ?>


<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer3">
<h3>
<center><img src="/img/yandex.png"><img src="/img/visa.png"><img src="/img/master.png"></center>
</h3>



<?PHP

/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>Технические работы</font></b></center>";
return;
}
*/

?>


<?php

if(isset($_POST["sum"])){

$sum = round(floatval($_POST["sum"]),2);


# Заносим в БД
$db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

$orderid = $db->LastInsert();

?>
	<div align="center">

		<form action="https://money.yandex.ru/quickpay/confirm.xml" method="POST">

		 <table>

		  <tbody>

		<input type="hidden" name="receiver" value="<?=$wallet_yad;?>">
		<input type="hidden" name="label" value="<?=$orderid;?>">
		<input type="hidden" name="formcomment" value="Золотые монеты">
		<input type="hidden" name="short-dest" value="Покупка золотых монет">
        <input type="hidden" name="quickpay-form" value="donate">
		<input type="hidden" name="targets" value="Покупка золотых монет">
		<input type="hidden" name="successURL" value="<?=$_SERVER['SERVER_NAME'];?>/success.html">

		    <tr style="padding-bottom:15px;">


				 <td><input type="hidden" name="sum" value="<?=number_format($sum, 2, ".", "")?>" placeholder="Введите сумму пополнения"></td>
		    </tr>

			<label><input type="radio" name="paymentType" value="PC">Яндекс.Деньгами</label><br>
			<label><input type="radio" name="paymentType" value="AC">Банковской картой VISA/MASTER</label>
			</tr>

			<br>

		   <tr><td><input type="submit" class="button" value="Оплатить"></td></tr>

	      </tbody>

		 </table>

		 </form>

		 </div>
		 </div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>


<?PHP

return;

}
?>
<script type="text/javascript">
	var min = 0.01;
	var ser_pr = 100;
	function calculate(st_q) {

		var sum_insert = parseFloat(st_q);
		$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );
}
</script>

<div id="error3"></div>

<center>
<form method="POST" action="">
    <input type="hidden" name="m" value="<?=$fk_merchant_id?>">
Сумма рублей:  
<input type="text" value="100" name="sum" size="7" class="box" style="margin:0px; height:40px; width:170px;" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)">
	<BR /><BR />
    <div align="center"><input type="submit" id="submit" class="button" value="Пополнить баланс" ></div>
</form>

<script type="text/javascript">
	calculate(100);
</script>
</center>
</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>	
