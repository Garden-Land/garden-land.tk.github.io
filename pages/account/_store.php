
<div class="pole">

<?PHP
$_OPTIMIZATION["title"] = "Моя ферма";
$usid = $_SESSION["user_id"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

	if(isset($_POST["sbor"])){
	
		if($user_data["last_sbor"] < (time() - 600) ){
		
			$tomat_s = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
			$straw_s = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
			$pump_s = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
			$peas_s = $func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);
			$pean_s = $func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);
			$apel_s = $func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"]);
			
			$db->Query("UPDATE db_users_b SET 
			a_b = a_b + '$tomat_s', 
			b_b = b_b + '$straw_s', 
			c_b = c_b + '$pump_s', 
			d_b = d_b + '$peas_s', 
			e_b = e_b + '$pean_s', 
			f_b = f_b + '$apel_s', 
			all_time_a = all_time_a + '$tomat_s',
			all_time_b = all_time_b + '$straw_s',
			all_time_c = all_time_c + '$pump_s',
			all_time_d = all_time_d + '$peas_s',
			all_time_e = all_time_e + '$pean_s',
			all_time_f = all_time_f + '$apel_s',
			last_sbor = '".time()."' 
			WHERE id = '$usid' LIMIT 1");
			
			
			$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
			$user_data = $db->FetchArray();
			
$all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"] + $user_data["f_b"];

	if($all_items > 0){
	
		$money_add = $func->SellItems($all_items, $sonfig_site["items_per_coin"]);
		
		$tomat_b = $user_data["a_b"];
		$straw_b = $user_data["b_b"];
		$pump_b = $user_data["c_b"];
		$pean_b = $user_data["d_b"];
		$peas_b = $user_data["e_b"];
		$apel_b = $user_data["f_b"];
		
		$money_b = ( (100 - $sonfig_site["percent_sell"]) / 100) * $money_add;
		$money_p = ( ($sonfig_site["percent_sell"]) / 100) * $money_add;
		
		# Обновляем юзверя
		$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b', money_p = money_p + '$money_p', a_b = 0, b_b = 0, c_b = 0, d_b = 0, e_b = 0, f_b = 0  
		WHERE id = '$usid'");
		
		$da = time();
		$dd = $da + 60*60*24*15;
		
		# Вставляем запись в статистику
		$db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, d_s, e_s, f_s, amount, all_sell, date_add, date_del) VALUES 
		('$usname','$usid','$tomat_b','$straw_b','$pump_b','$pean_b','$peas_b','$apel_b','$money_add','$all_items','$da','$dd')");
		
		?>
			                            <div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h5>Кристаллы собраны</h5>
                Вы обменяли урожай на кристаллы. 
                </div>

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>
				<?
		
		$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
		$user_data = $db->FetchArray();
		
	}else    						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>Ошибка</h4>
                Вам нечего собирать, купите семена в лавке. 
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

		}else{
					?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>Ошибка</h4>
                Вы можете собирать урожай не чаще 1-ого раза за 10 минут. 
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

<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="myfarm">

<div style="float:left; width:300px; padding:25px 0px 0px 260px;">
<form action="" method="post">
<input type="submit" name="sbor" value="Собрать урожай" class="button-sbor">
</form>
</div>

<div style="float:left; padding:5px 0px 0px 40px; width:78px; color:#fdd465; font-size:27px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; text-align:center;">
<b><?=$func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"])/100;?></b>
</div>

<div class="clr"></div>

<div style="float:left; padding:4px 0px 0px 155px; width:78px; color:#fdd465; font-size:27px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; text-align:center;">
<b><?=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"])/100;?></b>
</div>

<div style="float:left; padding:3px 0px 0px 128px; width:78px; color:#fdd465; font-size:27px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; text-align:center;">
<b><?=$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"])/100;?></b>
</div>

<div class="clr"></div>

<div style="float:left; padding:41px 0px 0px 211px; width:20px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; color:#ffff00; font-size:27px; text-align:center;">
<b><?=$user_data["a_t"]; ?></b>
</div>

<div style="float:left; padding:41px 0px 0px 184px; width:20px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; color:#ffff00; font-size:27px; text-align:center;">
<b><?=$user_data["b_t"]; ?></b>
</div>

<div class="clr"></div>

<div style="float:left; padding:7px 0px 0px 65px; width:78px; color:#fdd465; font-size:27px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; text-align:center;">
<b><?=$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"])/100;?></b>
</div>

<div style="float:left; padding:8px 0px 0px 110px; width:78px; color:#fdd465; font-size:27px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; text-align:center;">
<b><?=$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"])/100;?></b>
</div>

<div style="float:left; padding:9px 0px 0px 105px; width:78px; color:#fdd465; font-size:27px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; text-align:center;">
<b><?=$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"])/100;?></b>
</div>

<div class="clr"></div>

<div style="float:left; padding:57px 0px 0px 118px; width:20px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; color:#ffff00; font-size:27px; text-align:center;">
<b><?=$user_data["c_t"]; ?></b>
</div>

<div style="float:left; padding:57px 0px 0px 166px; width:20px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; color:#ffff00; font-size:27px; text-align:center;">
<b><?=$user_data["d_t"]; ?></b>
</div>

<div style="float:left; padding:57px 0px 0px 168px; width:20px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; color:#ffff00; font-size:27px; text-align:center;">
<b><?=$user_data["e_t"]; ?></b>
</div>

<div style="float:left; padding:5px 0px 0px 135px; width:20px; text-shadow: 0px 2px 0px black, 0 0 0.1em black; color:#ffff00; font-size:27px; text-align:center;">
<b><?=$user_data["f_t"]; ?></b>
</div>

</div>


<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>

</div>


<?PHP include("pages/account/_chat.php"); ?>









