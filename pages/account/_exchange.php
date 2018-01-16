<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer3">
<h3>
<center>Обменник</center>
</h3>


<?PHP
$_OPTIMIZATION["title"] = "Обмен";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
?>  
<?PHP

if(isset($_POST["sum"])){

$sum = intval($_POST["sum"]);

	if($sum >= 5){
	
		if($user_data["money_p"] >= $sum){
		
		$add_sum = ($sonfig_site["percent_swap"] > 0) ? ( ($sonfig_site["percent_swap"] / 100) * $sum) + $sum : $sum;
		
		$ta = time();
		$td = $ta + 60*60*24*15;
		
		$db->Query("UPDATE db_users_b SET money_b = money_b + $add_sum, money_p = money_p - $sum WHERE id = '$usid'");
		$db->Query("INSERT INTO db_swap_ser (user_id, user, amount_b, amount_p, date_add, date_del) VALUES ('$usid','$usname','$add_sum','$sum','$ta','$td')");
		
		?>
			                            <div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h5>Успешно!</h5>
                Вы обменяли Кристаллы на Золотые монеты. 
                </div>
                

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>
				<?
					
					}else 						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>Ошибка</h4>
                Недостаточно Кристаллов для совершения обмена. 
                </div>

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
				
				}else {
					?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>Ошибка</h4>
                Минимальная сумма для обмена составляет 5 Кристаллов. 
                </div>

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?
			}
	
	}

?>

<center>Обменивайте Кристаллы на Золотые монеты с выгодой для вас в 10%</center><br>

<form action="" method="post">

<table width="330" border="0" align="center">
  <tbody><tr>
    <td align="right"><img src="/img/diamon.png" width="50" style="margin-top:-14px;"></td>
     <td align="center"><input type="text" class="box" name="sum" id="sum" value="10" onkeyup="GetSumPer();" style="margin:0px; width:175px;"/></td>
  </tr>
  <tr>
    <td align="right"><img src="/img/coin.png" width="50"></td>
    <td align="center"><span id="res_sum" name="res">0.00</span>
		<input type="hidden" name="per" id="percent" value="<?=$sonfig_site["percent_swap"]; ?>" disabled="disabled"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br><input type="submit" name="swap" value="Совершить обмен" class="button"></td>
  </tr>
</tbody></table>
</form>



<script language="javascript">GetSumPer();</script>

</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>


