
<?PHP
$_OPTIMIZATION["title"] = "Бонус";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# Настройки бонусов
$bonus_min = 100;
$bonus_max = 500;

?>
<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer2">
<h3>
<center>Ежедневный бонус<br><img src="/img/coin.png" width="40"><img src="/img/coin.png" width="40"><img src="/img/coin.png" width="40"></center>
</h3>
<center>Каждый пользователь может получить бонус от <b>1</b>-ой до <b>5</b>-и Золотых монет в сутки.</center>
<br>
<?PHP
$ddel = time() + 60*60*24;
$dadd = time();
$db->Query("SELECT COUNT(*) FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'");

$hide_form = false;

	if($db->FetchRow() == 0){
	
		# Выдача бонуса
		if(isset($_POST["bonus"])){
		
			$sumrad = rand($bonus_min, rand($bonus_min, $bonus_max) );
			$sum=$sumrad/100;
			# Зачилсяем юзверю
			$db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' WHERE id = '$usid'");
			
			# Вносим запись в список бонусов
			
			
			$db->Query("INSERT INTO db_bonus_list (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
			
			# Случайная очистка устаревших записей
			$db->Query("DELETE FROM db_bonus_list WHERE date_del < '$dadd'");
			
			echo "<center><div class='success'>Вам зачислен бонус в размере {$sum} Золотых монет</div></center><BR />";
			
			$hide_form = true;
			
		}
			
			# Показывать или нет форму
			if(!$hide_form){
?>

<form action="" method="post">
<table width="330" border="0" align="center">
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="bonus" value="Получить бонус" class="button"></td>
  </tr>
</table>
</form>

<?PHP 

			}

	}else echo "<center><div style='color:#ba2f24; background:#f4e7bf; padding:10px 0px 10px 0px; border-bottom:1px solid #c9b67c;'>Вы получали бонус за последние 24 часа, возвращайтесь завтра!<div></center><BR />"; ?>





<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Дата</b></td>
	<td><b>Логин</b></td>
	<td><b>Золотых монет</b></td>
</tr>
  <?PHP

  $db->Query("SELECT * FROM db_bonus_list, db_users_a WHERE  db_users_a.user = db_bonus_list.user ORDER BY db_bonus_list.id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($bon = $db->FetchArray()){
		
		?>
<tr align="center" class="ltb">
        <td><?=date("d.m (H:i)",$bon["date_add"]); ?></td>
		<td><?=$bon["user"]; ?></td>
		<td><?=$bon["sum"]; ?></td>
		
	</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
  ?>
</tbody></table>

</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>




